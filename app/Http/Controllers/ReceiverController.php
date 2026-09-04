<?php

namespace App\Http\Controllers;

use App\Helpers\NotificationHelper;
use App\Models\Bookmark;
use App\Models\Claim;
use App\Models\Delivery;
use App\Models\FoodCategory;
use App\Models\FoodDonation;
use App\Models\Rating;
use App\Models\Report;
use App\Models\VolunteerRating;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ReceiverController extends Controller
{
    /**
     * Receiver Dashboard.
     */
    public function dashboard(): View
    {
        $receiverId = auth()->id();

        // High-level counts
        $availableDonations = FoodDonation::where('status', 'available')->count();
        $myClaims = Claim::where('receiver_id', $receiverId)->count();
        $activeClaimsCount = Claim::where('receiver_id', $receiverId)
            ->whereIn('status', ['pending', 'approved'])
            ->count();
        $completedClaims = Claim::where('receiver_id', $receiverId)
            ->where('status', 'completed')
            ->count();
        $bookmarkCount = Bookmark::where('user_id', $receiverId)->count();

        // Impact metrics
        $totalMealsReceived = Claim::where('claims.receiver_id', $receiverId)
            ->where('claims.status', 'completed')
            ->join('food_donations', 'claims.food_donation_id', '=', 'food_donations.id')
            ->sum('food_donations.quantity');

        $uniqueDonors = Claim::where('claims.receiver_id', $receiverId)
            ->where('claims.status', 'completed')
            ->join('food_donations', 'claims.food_donation_id', '=', 'food_donations.id')
            ->distinct('food_donations.donor_id')
            ->count('food_donations.donor_id');

        // Recent deliveries (completed)
        $recentDeliveries = Claim::with([
            'foodDonation.donor',
            'foodDonation.category',
            'delivery.volunteer',
            'delivery.rating',
            'delivery.volunteerRating'
        ])
            ->where('receiver_id', $receiverId)
            ->where('status', 'completed')
            ->latest()
            ->take(5)
            ->get();

        // Active in-progress claims
        $activeClaims = Claim::with([
            'foodDonation.donor',
            'foodDonation.category',
            'delivery.volunteer'
        ])
            ->where('receiver_id', $receiverId)
            ->whereIn('status', ['pending', 'approved'])
            ->latest()
            ->take(4)
            ->get();

        // Available donations preview
        $availableDonationsPreview = FoodDonation::with(['donor', 'items.foodCategory'])
            ->where('status', 'available')
            ->latest()
            ->take(4)
            ->get();

        // Reviews submitted by this receiver
        $donorReviews = Rating::with([
            'delivery.claim.foodDonation',
            'receiver'
        ])
            ->where('giver_id', $receiverId)
            ->latest()
            ->take(5)
            ->get();

        $volunteerReviews = VolunteerRating::with([
            'delivery.claim.foodDonation',
            'volunteer'
        ])
            ->where('giver_id', $receiverId)
            ->latest()
            ->take(5)
            ->get();

        return view('receiver.dashboard', compact(
            'availableDonations',
            'myClaims',
            'activeClaimsCount',
            'completedClaims',
            'bookmarkCount',
            'totalMealsReceived',
            'uniqueDonors',
            'recentDeliveries',
            'activeClaims',
            'availableDonationsPreview',
            'donorReviews',
            'volunteerReviews'
        ));
    }

    /**
     * Browse food donations with search, category & distance filtering.
     */
    public function donations(Request $request): View
    {
        $query = FoodDonation::with(['donor', 'items.foodCategory'])
            ->where('status', 'available');

        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($builder) use ($search) {
                $builder->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('pickup_address', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $categoryId = $request->category;
            $query->whereHas('items', function ($builder) use ($categoryId) {
                $builder->where('food_category_id', $categoryId);
            });
        }

        $categories = FoodCategory::orderBy('name')->get();

        $userLat = $request->input('lat');
        $userLng = $request->input('lng');
        $radius = $request->input('radius');

        // Distance filtering using Haversine formula
        if ($userLat !== null && $userLng !== null && is_numeric($userLat) && is_numeric($userLng)) {
            $userLat = (float) $userLat;
            $userLng = (float) $userLng;

            $allDonations = $query->latest()->get();

            // Calculate distance for each donation
            $allDonations->each(function ($donation) use ($userLat, $userLng) {
                if ($donation->latitude && $donation->longitude) {
                    $donation->distance = $this->calculateHaversineDistance(
                        $userLat,
                        $userLng,
                        (float) $donation->latitude,
                        (float) $donation->longitude
                    );
                } else {
                    $donation->distance = null;
                }
            });

            // Filter by radius if provided
            if ($radius !== null && is_numeric($radius) && (float) $radius > 0) {
                $maxRadius = (float) $radius;
                $allDonations = $allDonations->filter(function ($donation) use ($maxRadius) {
                    return $donation->distance !== null && $donation->distance <= $maxRadius;
                });
            }

            // Sort by distance (nearest first; items with unknown distance placed last)
            $sortedDonations = $allDonations->sortBy(function ($donation) {
                return $donation->distance ?? 999999;
            })->values();

            // Paginate manually with LengthAwarePaginator
            $page = $request->input('page', 1);
            $perPage = 9;
            $itemsForCurrentPage = $sortedDonations->forPage($page, $perPage);

            $donations = new LengthAwarePaginator(
                $itemsForCurrentPage,
                $sortedDonations->count(),
                $perPage,
                $page,
                [
                    'path'  => $request->url(),
                    'query' => $request->query(),
                ]
            );
        } else {
            $donations = $query
                ->latest()
                ->paginate(9)
                ->withQueryString();
        }

        return view('receiver.donations.index', compact(
            'donations',
            'categories',
            'userLat',
            'userLng',
            'radius'
        ));
    }

    /**
     * Show donation details.
     */
    public function showDonation(FoodDonation $donation): View
    {
        $donation->load(['donor', 'items.foodCategory']);

        // Check whether the current receiver has claimed this donation
        $myClaim = Claim::where('food_donation_id', $donation->id)
            ->where('receiver_id', auth()->id())
            ->whereIn('status', ['pending', 'approved', 'completed'])
            ->first();

        // Check whether another receiver has claimed this donation
        $claimedBySomeoneElse = Claim::where('food_donation_id', $donation->id)
            ->where('receiver_id', '!=', auth()->id())
            ->whereIn('status', ['pending', 'approved', 'completed'])
            ->exists();

        return view('receiver.donations.show', compact(
            'donation',
            'myClaim',
            'claimedBySomeoneElse'
        ));
    }

    /**
     * Claim an available donation.
     */
    public function storeClaim(FoodDonation $donation): RedirectResponse
    {
        $receiverId = auth()->id();

        $result = DB::transaction(function () use ($donation, $receiverId) {
            $lockedDonation = FoodDonation::whereKey($donation->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($lockedDonation->status !== 'available') {
                $existingClaim = Claim::where('food_donation_id', $lockedDonation->id)
                    ->where('receiver_id', $receiverId)
                    ->whereIn('status', ['approved', 'completed'])
                    ->exists();

                if ($existingClaim) {
                    return 'duplicate';
                }

                return 'unavailable';
            }

            $existingClaim = Claim::where('food_donation_id', $lockedDonation->id)
                ->where('receiver_id', $receiverId)
                ->whereIn('status', ['approved', 'completed'])
                ->exists();

            if ($existingClaim) {
                return 'duplicate';
            }

            // Auto-approve the claim — goes directly to volunteer pool
            $claim = Claim::create([
                'food_donation_id' => $lockedDonation->id,
                'receiver_id'      => $receiverId,
                'status'           => 'approved',
            ]);

            // Immediately create a pending delivery for volunteers
            Delivery::create([
                'claim_id'     => $claim->id,
                'volunteer_id' => null,
                'status'       => 'pending',
            ]);

            $lockedDonation->update(['status' => 'claimed']);

            // Send notification to receiver
            NotificationHelper::send(
                $receiverId,
                'Claim Submitted',
                "You successfully claimed '{$lockedDonation->title}'. A volunteer will be assigned to deliver it shortly."
            );

            return 'success';
        });

        if ($result === 'duplicate') {
            return redirect()
                ->route('receiver.donations.show', $donation)
                ->with('success', 'You have already claimed this donation.');
        }

        if ($result === 'unavailable') {
            return redirect()
                ->route('receiver.donations.show', $donation)
                ->with('error', 'This donation has already been claimed by another receiver and is no longer available.');
        }

        return redirect()
            ->route('receiver.claims')
            ->with('success', 'Donation claimed! A volunteer will be assigned to deliver it shortly.');
    }

    /**
     * List all claims made by receiver.
     */
    public function claims(): View
    {
        $claims = Claim::with(['foodDonation', 'delivery'])
            ->where('receiver_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('receiver.claims.index', compact('claims'));
    }

    /**
     * Show details of a specific claim.
     */
    public function showClaim(Claim $claim): View
    {
        abort_unless($claim->receiver_id === auth()->id(), 403);

        $claim->load([
            'foodDonation.donor',
            'foodDonation.category',
            'delivery.volunteer',
            'delivery.rating',
            'delivery.volunteerRating',
        ]);

        return view('receiver.claims.show', compact('claim'));
    }

    /**
     * Donation History & Impact Report.
     */
    public function history(Request $request): View
    {
        $receiverId = auth()->id();

        $query = Claim::with([
            'foodDonation.donor',
            'foodDonation.items.foodCategory',
            'delivery.volunteer',
            'delivery.rating',
            'delivery.volunteerRating',
        ])
            ->where('receiver_id', $receiverId)
            ->where('status', 'completed');

        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->whereHas('foodDonation', function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('pickup_address', 'like', "%{$search}%");
            });
        }

        // Calculate impact metrics for completed claims
        $totalDeliveries = Claim::where('receiver_id', $receiverId)
            ->where('status', 'completed')
            ->count();

        $totalMeals = Claim::where('claims.receiver_id', $receiverId)
            ->where('claims.status', 'completed')
            ->join('food_donations', 'claims.food_donation_id', '=', 'food_donations.id')
            ->sum('food_donations.quantity');

        $uniqueDonors = Claim::where('claims.receiver_id', $receiverId)
            ->where('claims.status', 'completed')
            ->join('food_donations', 'claims.food_donation_id', '=', 'food_donations.id')
            ->distinct('food_donations.donor_id')
            ->count('food_donations.donor_id');

        $uniqueVolunteers = Claim::where('claims.receiver_id', $receiverId)
            ->where('claims.status', 'completed')
            ->join('deliveries', 'claims.id', '=', 'deliveries.claim_id')
            ->whereNotNull('deliveries.volunteer_id')
            ->distinct('deliveries.volunteer_id')
            ->count('deliveries.volunteer_id');

        $claims = $query->latest()->paginate(10)->withQueryString();

        return view('receiver.history', compact(
            'claims',
            'totalDeliveries',
            'totalMeals',
            'uniqueDonors',
            'uniqueVolunteers'
        ));
    }

    /**
     * Impact Record.
     * Calculates total weight rescued (kg/lbs), 6-month trends, active streaks, and top supporter.
     */
    public function impact(Request $request): View
    {
        $receiverId = auth()->id();

        // Get all completed claims with donation, items, and donor
        $completedClaims = Claim::with([
            'foodDonation.donor',
            'foodDonation.items.foodCategory',
            'delivery.volunteer',
        ])
            ->where('receiver_id', $receiverId)
            ->where('status', 'completed')
            ->latest()
            ->get();

        // 1. Total Portions Rescued
        $totalPortions = $completedClaims->sum(function ($claim) {
            return $claim->foodDonation->quantity ?? 1;
        });

        // 2. Total Weight Diverted (kg and lbs)
        $totalWeightKg = 0;
        foreach ($completedClaims as $claim) {
            $donation = $claim->foodDonation;
            if (!$donation) continue;

            $itemWeight = 0;
            if ($donation->items && $donation->items->isNotEmpty()) {
                foreach ($donation->items as $item) {
                    $qty = (float) $item->quantity;
                    $unit = strtolower(trim($item->unit ?? ''));

                    switch ($unit) {
                        case 'kg':
                        case 'kilogram':
                            $itemWeight += $qty;
                            break;
                        case 'g':
                        case 'gram':
                            $itemWeight += ($qty / 1000);
                            break;
                        case 'liter':
                        case 'litre':
                        case 'l':
                            $itemWeight += $qty;
                            break;
                        case 'ml':
                        case 'milliliter':
                            $itemWeight += ($qty / 1000);
                            break;
                        default:
                            $itemWeight += ($qty * 0.45);
                            break;
                    }
                }
            }

            if ($itemWeight <= 0) {
                $itemWeight = ($donation->quantity ?? 1) * 0.45;
            }

            $totalWeightKg += $itemWeight;
        }

        $totalWeightKg = round($totalWeightKg, 1);
        $totalWeightLbs = round($totalWeightKg * 2.20462, 1);

        // Environmental metrics
        $co2AvoidedKg = round($totalWeightKg * 2.5, 1);
        $waterSavedLiters = round($totalWeightKg * 800);

        // 3. 6-Month Donation Trends
        $trendMonths = [];
        $trendClaims = [];
        $trendPortions = [];
        $trendWeightKg = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthKey = $date->format('Y-m');
            $monthLabel = $date->format('M Y');
            $trendMonths[] = $monthLabel;

            $monthGroup = $completedClaims->filter(function ($c) use ($monthKey) {
                return $c->created_at && $c->created_at->format('Y-m') === $monthKey;
            });

            $trendClaims[] = $monthGroup->count();
            $trendPortions[] = (int) $monthGroup->sum(fn($c) => $c->foodDonation->quantity ?? 1);

            $mWeight = 0;
            foreach ($monthGroup as $mc) {
                $mWeight += ($mc->foodDonation->quantity ?? 1) * 0.45;
            }
            $trendWeightKg[] = round($mWeight, 1);
        }

        // 4. Active Streaks (consecutive active rescue weeks)
        $currentWeek = now()->startOfWeek();
        $checkWeek = $currentWeek->copy();
        $hasActivityThisWeek = $completedClaims->contains(function ($c) use ($checkWeek) {
            return $c->created_at && $c->created_at >= $checkWeek;
        });

        if (!$hasActivityThisWeek) {
            $checkWeek->subWeek();
        }

        $streakWeeks = 0;
        while (true) {
            $weekStart = $checkWeek->copy()->startOfWeek();
            $weekEnd = $checkWeek->copy()->endOfWeek();
            $hasInWeek = $completedClaims->contains(function ($c) use ($weekStart, $weekEnd) {
                return $c->created_at && $c->created_at->between($weekStart, $weekEnd);
            });

            if ($hasInWeek) {
                $streakWeeks++;
                $checkWeek->subWeek();
            } else {
                break;
            }

            if ($streakWeeks >= 52) break;
        }

        if ($streakWeeks === 0 && $completedClaims->isNotEmpty()) {
            $streakWeeks = 1;
        }

        $streakBadge = 'New Rescuer';
        if ($streakWeeks >= 12) {
            $streakBadge = 'Zero-Waste Champion';
        } elseif ($streakWeeks >= 4) {
            $streakBadge = 'Consistent Sustainer';
        } elseif ($streakWeeks >= 1) {
            $streakBadge = 'Active Community Partner';
        }

        // 5. Dynamic Top Supporter / Donor Recognition
        $topDonor = null;
        $topDonorMeals = 0;
        $topDonorDonations = 0;

        $donorGroups = $completedClaims->groupBy(function ($c) {
            return $c->foodDonation->donor_id ?? null;
        })->filter();

        if ($donorGroups->isNotEmpty()) {
            $sortedGroups = $donorGroups->sortByDesc(function ($group) {
                return $group->sum(fn($c) => $c->foodDonation->quantity ?? 1);
            });

            $topGroup = $sortedGroups->first();
            $topDonor = $topGroup->first()->foodDonation->donor ?? null;
            $topDonorMeals = $topGroup->sum(fn($c) => $c->foodDonation->quantity ?? 1);
            $topDonorDonations = $topGroup->count();
        }

        // 6. Category Breakdown
        $categoryBreakdown = [];
        foreach ($completedClaims as $claim) {
            $catName = $claim->foodDonation->category->name ?? 'General Surplus';
            if (!isset($categoryBreakdown[$catName])) {
                $categoryBreakdown[$catName] = 0;
            }
            $categoryBreakdown[$catName] += ($claim->foodDonation->quantity ?? 1);
        }

        return view('receiver.impact', compact(
            'completedClaims',
            'totalPortions',
            'totalWeightKg',
            'totalWeightLbs',
            'co2AvoidedKg',
            'waterSavedLiters',
            'trendMonths',
            'trendClaims',
            'trendPortions',
            'trendWeightKg',
            'streakWeeks',
            'streakBadge',
            'topDonor',
            'topDonorMeals',
            'topDonorDonations',
            'categoryBreakdown'
        ));
    }

    /**
     * Dedicated Game & Milestone page.
     */
    public function milestones(Request $request): View
    {
        $completedClaims = Claim::with(['foodDonation.donor', 'foodDonation.category', 'delivery.rating', 'delivery.volunteerRating'])
            ->where('receiver_id', Auth::id())
            ->where('status', 'completed')
            ->orderBy('created_at', 'desc')
            ->get();

        $totalCompletedClaims = $completedClaims->count();
        $totalPortions = (int) $completedClaims->sum(fn($c) => $c->foodDonation->quantity ?? 1);

        $totalWeightKg = 0;
        foreach ($completedClaims as $claim) {
            $donation = $claim->foodDonation;
            if ($donation) {
                $totalWeightKg += ($donation->quantity ?? 1) * 0.45;
            }
        }
        $totalWeightKg = round($totalWeightKg, 1);
        $co2AvoidedKg = round($totalWeightKg * 2.5, 1);

        // Calculate Weekly Active Streak
        $currentWeek = now()->startOfWeek();
        $checkWeek = $currentWeek->copy();
        $hasActivityThisWeek = $completedClaims->contains(function ($c) use ($checkWeek) {
            return $c->created_at && $c->created_at >= $checkWeek;
        });

        if (!$hasActivityThisWeek) {
            $checkWeek->subWeek();
        }

        $streakWeeks = 0;
        while (true) {
            $weekStart = $checkWeek->copy()->startOfWeek();
            $weekEnd = $checkWeek->copy()->endOfWeek();
            $hasInWeek = $completedClaims->contains(function ($c) use ($weekStart, $weekEnd) {
                return $c->created_at && $c->created_at->between($weekStart, $weekEnd);
            });

            if ($hasInWeek) {
                $streakWeeks++;
                $checkWeek->subWeek();
            } else {
                break;
            }

            if ($streakWeeks >= 52) break;
        }

        if ($streakWeeks === 0 && $completedClaims->isNotEmpty()) {
            $streakWeeks = 1;
        }

        $streakBadge = 'New Rescuer';
        $nextTierTarget = 1;
        $nextTierName = 'Active Community Partner';

        if ($streakWeeks >= 12) {
            $streakBadge = 'Zero-Waste Champion';
            $nextTierTarget = 24;
            $nextTierName = 'Community Legend';
        } elseif ($streakWeeks >= 4) {
            $streakBadge = 'Consistent Sustainer';
            $nextTierTarget = 12;
            $nextTierName = 'Zero-Waste Champion';
        } elseif ($streakWeeks >= 1) {
            $streakBadge = 'Active Community Partner';
            $nextTierTarget = 4;
            $nextTierName = 'Consistent Sustainer';
        }

        // Top Supporter Recognition
        $topDonor = null;
        $topDonorMeals = 0;
        $topDonorDonations = 0;

        $donorGroups = $completedClaims->groupBy(function ($c) {
            return $c->foodDonation->donor_id ?? null;
        })->filter();

        if ($donorGroups->isNotEmpty()) {
            $sortedGroups = $donorGroups->sortByDesc(function ($group) {
                return $group->sum(fn($c) => $c->foodDonation->quantity ?? 1);
            });

            $topGroup = $sortedGroups->first();
            $topDonor = $topGroup->first()->foodDonation->donor ?? null;
            $topDonorMeals = $topGroup->sum(fn($c) => $c->foodDonation->quantity ?? 1);
            $topDonorDonations = $topGroup->count();
        }

        // User Ratings count
        $ratedCount = $completedClaims->filter(fn($c) => $c->delivery && $c->delivery->rating)->count();

        // Gamification Achievements & Badges
        $badges = [
            [
                'title' => 'First Food Rescue',
                'description' => 'Claim and successfully receive your first donation.',
                'icon' => '🌱',
                'category' => 'Beginner',
                'unlocked' => $totalCompletedClaims >= 1,
                'progress' => min(100, ($totalCompletedClaims / 1) * 100),
                'progress_text' => min(1, $totalCompletedClaims) . ' / 1 delivery',
            ],
            [
                'title' => '10 Meals Club',
                'description' => 'Rescue at least 10 nutritious portions for your shelter or community.',
                'icon' => '🍲',
                'category' => 'Volume',
                'unlocked' => $totalPortions >= 10,
                'progress' => min(100, ($totalPortions / 10) * 100),
                'progress_text' => min(10, $totalPortions) . ' / 10 portions',
            ],
            [
                'title' => '50 Meals Master',
                'description' => 'Reach a cumulative 50 meals saved from going to waste.',
                'icon' => '🍱',
                'category' => 'Volume',
                'unlocked' => $totalPortions >= 50,
                'progress' => min(100, ($totalPortions / 50) * 100),
                'progress_text' => min(50, $totalPortions) . ' / 50 portions',
            ],
            [
                'title' => 'Climate Hero',
                'description' => 'Avoid at least 15 kg of greenhouse emissions (CO₂e).',
                'icon' => '🌍',
                'category' => 'Impact',
                'unlocked' => $co2AvoidedKg >= 15,
                'progress' => min(100, ($co2AvoidedKg / 15) * 100),
                'progress_text' => min(15, $co2AvoidedKg) . ' / 15 kg CO₂e',
            ],
            [
                'title' => 'Weekly Consistency',
                'description' => 'Achieve a 4-week active rescue streak.',
                'icon' => '🔥',
                'category' => 'Streak',
                'unlocked' => $streakWeeks >= 4,
                'progress' => min(100, ($streakWeeks / 4) * 100),
                'progress_text' => min(4, $streakWeeks) . ' / 4 weeks',
            ],
            [
                'title' => 'Gratitude Giver',
                'description' => 'Leave a 5-star review thanking a community food donor.',
                'icon' => '⭐',
                'category' => 'Community',
                'unlocked' => $ratedCount >= 1,
                'progress' => min(100, ($ratedCount / 1) * 100),
                'progress_text' => min(1, $ratedCount) . ' / 1 review',
            ],
        ];

        // Level & XP System
        $totalXP = ($totalPortions * 10) + ($totalCompletedClaims * 50) + ($streakWeeks * 100);
        $level = max(1, (int) floor($totalXP / 200) + 1);
        $xpInCurrentLevel = $totalXP % 200;
        $levelProgressPercent = min(100, round(($xpInCurrentLevel / 200) * 100));

        return view('receiver.milestones', compact(
            'completedClaims',
            'totalCompletedClaims',
            'totalPortions',
            'totalWeightKg',
            'co2AvoidedKg',
            'streakWeeks',
            'streakBadge',
            'nextTierTarget',
            'nextTierName',
            'topDonor',
            'topDonorMeals',
            'topDonorDonations',
            'badges',
            'totalXP',
            'level',
            'xpInCurrentLevel',
            'levelProgressPercent'
        ));
    }

    /**
     * Report an issue with a claim/pickup.
     */
    public function reportIssue(Request $request, Claim $claim): RedirectResponse
    {
        abort_unless($claim->receiver_id === auth()->id(), 403);

        $request->validate([
            'reason' => 'required|string|min:10|max:1000',
        ]);

        $claim->load('foodDonation.donor');

        if (!$claim->foodDonation || !$claim->foodDonation->donor) {
            return back()->with('error', 'The donor information could not be found.');
        }

        Report::create([
            'reporter_id'      => auth()->id(),
            'reported_user_id' => $claim->foodDonation->donor->id,
            'food_donation_id' => $claim->food_donation_id,
            'reason'           => $request->reason,
            'status'           => 'pending',
        ]);

        return redirect()
            ->route('receiver.claims.show', $claim)
            ->with('success', 'Your issue has been reported successfully. An administrator will review it.');
    }

    /**
     * Cancel a claim with a required cancellation reason.
     */
    public function cancelClaim(Request $request, Claim $claim): RedirectResponse
    {
        abort_unless($claim->receiver_id === auth()->id(), 403);

        $request->validate([
            'cancellation_reason' => 'required|string|min:5|max:1000',
        ], [
            'cancellation_reason.required' => 'Please provide a reason for cancelling this claim.',
            'cancellation_reason.min'      => 'The cancellation reason must be at least 5 characters.',
        ]);

        // Load delivery to check if a volunteer has already accepted it
        $claim->load('delivery');

        // Allow cancelling 'approved' claims only if delivery hasn't been accepted yet
        $canCancel = $claim->status === 'approved'
            && $claim->delivery
            && is_null($claim->delivery->volunteer_id)
            && $claim->delivery->status === 'pending';

        if (!$canCancel) {
            return back()->with(
                'error',
                'This claim can no longer be cancelled. A volunteer may have already accepted the delivery.'
            );
        }

        DB::transaction(function () use ($claim, $request) {
            $lockedClaim = Claim::whereKey($claim->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($lockedClaim->receiver_id !== auth()->id()) {
                abort(403);
            }

            // Delete the pending delivery record
            Delivery::where('claim_id', $lockedClaim->id)
                ->where('status', 'pending')
                ->whereNull('volunteer_id')
                ->delete();

            // Cancel the claim with stored reason
            $lockedClaim->update([
                'status'              => 'cancelled',
                'cancellation_reason' => $request->cancellation_reason,
            ]);

            // Free up the food donation back to available
            FoodDonation::whereKey($lockedClaim->food_donation_id)
                ->where('status', 'claimed')
                ->update(['status' => 'available']);

            // Send notification to receiver
            $lockedClaim->load('foodDonation');
            $foodTitle = $lockedClaim->foodDonation->title ?? 'Food donation';
            NotificationHelper::send(
                auth()->id(),
                'Claim Cancelled',
                "Your claim for '{$foodTitle}' has been cancelled. Reason: {$request->cancellation_reason}"
            );
        });

        return redirect()
            ->route('receiver.claims')
            ->with(
                'success',
                'Your claim has been cancelled and the donation is available again.'
            );
    }

    /**
     * Calculate distance between two coordinates in kilometers using Haversine formula.
     */
    private function calculateHaversineDistance(float $lat1, float $lon1, float $lat2, float $lon2): float
    {
        $earthRadius = 6371; // km

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return round($earthRadius * $c, 1);
    }

    /**
     * Help Center page.
     */
    public function help(Request $request): View
    {
        $search = trim($request->input('search', ''));
        $receiverId = auth()->id();

        // My Requests (submitted reports)
        $myReports = Report::where('reporter_id', $receiverId)
            ->with(['foodDonation'])
            ->latest()
            ->get();

        // Active claims that receiver could have issues with
        $activeClaims = Claim::where('receiver_id', $receiverId)
            ->whereIn('status', ['pending', 'approved'])
            ->with(['foodDonation.donor', 'delivery.volunteer'])
            ->latest()
            ->take(5)
            ->get();

        return view('receiver.help', compact('search', 'myReports', 'activeClaims'));
    }

    /**
     * Report a technical problem from the Help Center.
     */
    public function reportTechnicalProblem(Request $request): RedirectResponse
    {
        $request->validate([
            'subject'     => 'required|string|max:200',
            'description' => 'required|string|min:10|max:2000',
        ]);

        $admin = \App\Models\User::where('role_id', 1)->first();

        Report::create([
            'reporter_id'      => auth()->id(),
            'reported_user_id' => $admin ? $admin->id : auth()->id(),
            'reason'           => "[Technical Problem - {$request->subject}]: {$request->description}",
            'status'           => 'pending',
        ]);

        NotificationHelper::send(
            auth()->id(),
            'Support Request Received',
            "Your technical report '{$request->subject}' has been submitted. Our support team will look into it."
        );

        return back()->with('success', 'Thank you! Your technical problem report has been submitted to customer support.');
    }
}