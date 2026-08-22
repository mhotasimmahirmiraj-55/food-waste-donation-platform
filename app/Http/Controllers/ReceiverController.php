<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\FoodDonation;
use App\Models\Report;
use App\Models\Rating;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ReceiverController extends Controller
{
    public function dashboard(): View
    {
        $receiverId = auth()->id();

        $availableDonations = FoodDonation::where('status', 'available')->count();

        $myClaims = Claim::where('receiver_id', $receiverId)->count();

        $pendingClaims = Claim::where('receiver_id', $receiverId)
            ->where('status', 'pending')
            ->count();

        $completedClaims = Claim::where('receiver_id', $receiverId)
            ->where('status', 'completed')
            ->count();

        $recentClaims = Claim::with('foodDonation')
            ->where('receiver_id', $receiverId)
            ->latest()
            ->take(5)
            ->get();

        return view('receiver.dashboard', compact(
            'availableDonations',
            'myClaims',
            'pendingClaims',
            'completedClaims',
            'recentClaims'
        ));
    }

    public function donations(Request $request): View
    {
        $query = FoodDonation::with(['donor', 'category'])
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
            $query->where('food_category_id', $request->category);
        }

        $donations = $query
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('receiver.donations.index', compact('donations'));
    }

    public function showDonation(FoodDonation $donation): View
    {
        // Do NOT return 404 just because the donation is no longer available.
        // The donation may have already been claimed by the current receiver
        // or by another receiver.

        $donation->load(['donor', 'category']);

        // Check whether the current receiver has already claimed this donation.
        $myClaim = Claim::where('food_donation_id', $donation->id)
            ->where('receiver_id', auth()->id())
            ->whereIn('status', ['pending', 'approved', 'completed'])
            ->first();

        // Check whether another receiver has claimed this donation.
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
                    ->whereIn('status', ['pending', 'approved', 'completed'])
                    ->exists();

                if ($existingClaim) {
                    return 'duplicate';
                }

                return 'unavailable';
            }

            $existingClaim = Claim::where('food_donation_id', $lockedDonation->id)
                ->where('receiver_id', $receiverId)
                ->whereIn('status', ['pending', 'approved', 'completed'])
                ->exists();

            if ($existingClaim) {
                return 'duplicate';
            }

            Claim::create([
                'food_donation_id' => $lockedDonation->id,
                'receiver_id' => $receiverId,
                'status' => 'pending',
            ]);

            $lockedDonation->update([
                'status' => 'claimed'
            ]);

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
            ->with('success', 'Food donation claimed successfully. Your request is pending approval.');
    }

    public function claims(Request $request): View
    {
        $query = Claim::with(['foodDonation', 'delivery'])
            ->where('receiver_id', auth()->id());

        // Search by donation title
        if ($request->filled('search')) {
            $search = trim($request->search);

            $query->whereHas('foodDonation', function ($builder) use ($search) {
                $builder->where('title', 'like', "%{$search}%");
            });
        }

        // Filter by claim status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $claims = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('receiver.claims.index', compact('claims'));
    }

    public function showClaim(Claim $claim): View
    {
        abort_unless($claim->receiver_id === auth()->id(), 403);

        $claim->load([
            'foodDonation.donor',
            'foodDonation.category',
            'delivery'
        ]);

        return view('receiver.claims.show', compact('claim'));
    }

    public function rateDonor(Request $request, Claim $claim): RedirectResponse
    {
        abort_unless($claim->receiver_id === auth()->id(), 403);

        if ($claim->status !== 'completed') {
            return back()->with(
                'error',
                'You can only rate a donor after the donation has been completed.'
            );
        }

        $claim->load('foodDonation.donor', 'delivery');

        if (!$claim->delivery) {
            return back()->with(
                'error',
                'A delivery record could not be found for this claim.'
            );
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        $existingRating = Rating::where('delivery_id', $claim->delivery->id)
            ->where('giver_id', auth()->id())
            ->exists();

        if ($existingRating) {
            return back()->with(
                'error',
                'You have already rated this donation.'
            );
        }

        Rating::create([
            'delivery_id' => $claim->delivery->id,
            'giver_id' => auth()->id(),
            'receiver_id' => $claim->foodDonation->donor->id,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return back()->with(
            'success',
            'Thank you! Your rating has been submitted successfully.'
        );
    }

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
            'reporter_id' => auth()->id(),
            'reported_user_id' => $claim->foodDonation->donor->id,
            'reason' => $request->reason,
            'status' => 'pending',
        ]);

        return redirect()
            ->route('receiver.claims.show', $claim)
            ->with('success', 'Your issue has been reported successfully. An administrator will review it.');
    }

    public function cancelClaim(Claim $claim): RedirectResponse
    {
        abort_unless($claim->receiver_id === auth()->id(), 403);

        if ($claim->status !== 'pending') {
            return back()->with(
                'error',
                'Only pending claims can be cancelled.'
            );
        }

        DB::transaction(function () use ($claim) {
            $lockedClaim = Claim::whereKey($claim->id)
                ->lockForUpdate()
                ->firstOrFail();

            if (
                $lockedClaim->receiver_id !== auth()->id() ||
                $lockedClaim->status !== 'pending'
            ) {
                abort(403);
            }

            $lockedClaim->update([
                'status' => 'cancelled'
            ]);

            FoodDonation::whereKey($lockedClaim->food_donation_id)
                ->where('status', 'claimed')
                ->update([
                    'status' => 'available'
                ]);
        });

        return redirect()
            ->route('receiver.claims')
            ->with(
                'success',
                'Your claim has been cancelled and the donation is available again.'
            );
    }
}