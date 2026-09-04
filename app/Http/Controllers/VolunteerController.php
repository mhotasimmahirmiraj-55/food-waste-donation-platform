<?php

namespace App\Http\Controllers;

use App\Helpers\NotificationHelper;
use App\Models\Delivery;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class VolunteerController extends Controller
{
    /**
     * Volunteer dashboard.
     */
    public function dashboard(): View
    {
        $volunteerId = auth()->id();

        $availableDeliveries = Delivery::whereNull('volunteer_id')
            ->where('status', 'pending')
            ->count();

        $myDeliveries = Delivery::where('volunteer_id', $volunteerId)
            ->count();

        $activeDeliveries = Delivery::where('volunteer_id', $volunteerId)
            ->whereIn('status', ['accepted', 'picked_up'])
            ->count();

        $completedDeliveries = Delivery::where('volunteer_id', $volunteerId)
            ->where('status', 'delivered')
            ->count();

        $recentDeliveries = Delivery::with([
            'claim.foodDonation.category',
            'claim.receiver',
        ])
            ->where('volunteer_id', $volunteerId)
            ->latest()
            ->take(5)
            ->get();

        $availableAssignments = Delivery::with([
            'claim.foodDonation.category',
            'claim.receiver',
        ])
            ->whereNull('volunteer_id')
            ->where('status', 'pending')
            ->latest()
            ->take(5)
            ->get();

        return view('volunteer.dashboard', compact(
            'availableDeliveries',
            'myDeliveries',
            'activeDeliveries',
            'completedDeliveries',
            'recentDeliveries',
            'availableAssignments'
        ));
    }


    /**
     * Show all available and assigned deliveries.
     */
    public function index(): View
    {
        $volunteerId = auth()->id();

        $availableDeliveries = Delivery::with([
            'claim.foodDonation.category',
            'claim.receiver',
        ])
            ->whereNull('volunteer_id')
            ->where('status', 'pending')
            ->latest()
            ->paginate(8, ['*'], 'available_page');

        $myDeliveries = Delivery::with([
            'claim.foodDonation.category',
            'claim.receiver',
        ])
            ->where('volunteer_id', $volunteerId)
            ->latest()
            ->paginate(8, ['*'], 'my_page');

        return view('volunteer.deliveries.index', compact(
            'availableDeliveries',
            'myDeliveries'
        ));
    }


    /**
     * Show one delivery.
     */
    public function show(Delivery $delivery): View
    {
        $delivery->load([
            'claim.foodDonation.donor',
            'claim.foodDonation.category',
            'claim.receiver',
            'deliveryProof',
            'rating',
        ]);

        $isOwner = $delivery->volunteer_id === auth()->id();
        $isAvailable = is_null($delivery->volunteer_id)
            && $delivery->status === 'pending';

        abort_unless($isOwner || $isAvailable, 403);

        return view('volunteer.deliveries.show', compact(
            'delivery',
            'isOwner',
            'isAvailable'
        ));
    }


    /**
     * Accept an available delivery.
     */
    public function accept(Delivery $delivery): RedirectResponse
    {
        if (
            !is_null($delivery->volunteer_id)
            || $delivery->status !== 'pending'
        ) {
            return back()->with(
                'error',
                'This delivery is no longer available.'
            );
        }

        $delivery->update([
            'volunteer_id' => auth()->id(),
            'status'       => 'accepted',
            'accepted_at'  => now(),
        ]);

        $delivery->load('claim.foodDonation');
        if ($delivery->claim) {
            $foodTitle = $delivery->claim->foodDonation->title ?? 'your claimed food';
            NotificationHelper::send(
                $delivery->claim->receiver_id,
                'Volunteer Assigned',
                "A volunteer has accepted the delivery for '{$foodTitle}'. Delivery is on the way soon!"
            );
        }

        return redirect()
            ->route('volunteer.deliveries.show', $delivery)
            ->with(
                'success',
                'Delivery accepted successfully. You can now manage this delivery.'
            );
    }


    /**
     * Reject an available delivery — puts it back in the pool for other volunteers.
     */
    public function reject(Delivery $delivery): RedirectResponse
    {
        // Only unassigned pending deliveries can be rejected
        if (
            !is_null($delivery->volunteer_id)
            || $delivery->status !== 'pending'
        ) {
            return back()->with(
                'error',
                'This delivery is no longer available to reject.'
            );
        }

        // Delivery stays pending and unassigned — another volunteer can pick it up
        return redirect()
            ->route('volunteer.deliveries.index')
            ->with(
                'success',
                'You have declined this delivery. It is now available for other volunteers.'
            );
    }


    /**
     * Update delivery status.
     */
    public function updateStatus(
        Request $request,
        Delivery $delivery
    ): RedirectResponse {
        abort_unless(
            $delivery->volunteer_id === auth()->id(),
            403
        );

        $request->validate([
            'status' => [
                'required',
                'in:picked_up,delivered',
            ],
        ]);

        $newStatus = $request->status;

        if (
            $newStatus === 'picked_up'
            && $delivery->status !== 'accepted'
        ) {
            return back()->with(
                'error',
                'A delivery must be accepted before it can be marked as picked up.'
            );
        }

        if (
            $newStatus === 'delivered'
            && $delivery->status !== 'picked_up'
        ) {
            return back()->with(
                'error',
                'A delivery must be picked up before it can be marked as delivered.'
            );
        }

        $updates = [
            'status' => $newStatus,
        ];

        if ($newStatus === 'picked_up') {
            $updates['picked_up_at'] = now();
        }

        if ($newStatus === 'delivered') {
            $updates['delivered_at'] = now();
        }

        $delivery->update($updates);

        $delivery->load('claim.foodDonation');
        if ($delivery->claim) {
            $foodTitle = $delivery->claim->foodDonation->title ?? 'your claimed food';

            if ($newStatus === 'picked_up') {
                NotificationHelper::send(
                    $delivery->claim->receiver_id,
                    'Food Picked Up',
                    "Your food donation '{$foodTitle}' has been picked up by the volunteer and is on its way!"
                );
            } elseif ($newStatus === 'delivered') {
                // Update claim status to completed
                $delivery->claim->update(['status' => 'completed']);

                // Update food donation status to delivered
                if ($delivery->claim->foodDonation) {
                    $delivery->claim->foodDonation->update(['status' => 'delivered']);
                }

                NotificationHelper::send(
                    $delivery->claim->receiver_id,
                    'Delivery Completed',
                    "Your food donation '{$foodTitle}' has been safely delivered! Please rate the donor and volunteer."
                );
            }
        }

        return back()->with(
            'success',
            'Delivery status updated successfully.'
        );
    }


    /**
     * Upload delivery proof.
     */
    public function storeProof(
        Request $request,
        Delivery $delivery
    ): RedirectResponse {
        abort_unless(
            $delivery->volunteer_id === auth()->id(),
            403
        );

        if ($delivery->status !== 'delivered') {
            return back()->with(
                'error',
                'Delivery proof can only be uploaded after the delivery is completed.'
            );
        }

        $request->validate([
            'proof_image' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
            ],
            'notes' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        if ($delivery->deliveryProof) {
            if ($delivery->deliveryProof->proof_image) {
                Storage::disk('public')->delete(
                    $delivery->deliveryProof->proof_image
                );
            }

            $delivery->deliveryProof->delete();
        }

        $imagePath = $request
            ->file('proof_image')
            ->store('delivery-proofs', 'public');

        $delivery->deliveryProof()->create([
            'proof_image' => $imagePath,
            'notes' => $request->notes,
        ]);

        return back()->with(
            'success',
            'Delivery proof uploaded successfully.'
        );
    }
}