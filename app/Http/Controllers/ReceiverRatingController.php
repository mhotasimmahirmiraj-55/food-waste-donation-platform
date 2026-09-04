<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\Rating;
use App\Models\VolunteerRating;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReceiverRatingController extends Controller
{
    public function store(Request $request, Claim $claim): RedirectResponse
    {
        // Make sure this claim belongs to the logged-in receiver
        abort_unless($claim->receiver_id === auth()->id(), 403);

        // Rating is only allowed after the donation has been delivered
        if ($claim->status !== 'completed') {
            return back()->with(
                'error',
                'You can only rate a donor after the donation has been delivered.'
            );
        }

        // Make sure a delivery exists
        if (!$claim->delivery) {
            return back()->with(
                'error',
                'No delivery record was found for this claim.'
            );
        }

        // Make sure the delivery itself is completed
        if ($claim->delivery->status !== 'delivered') {
            return back()->with(
                'error',
                'You can only rate the donor after the delivery is completed.'
            );
        }

        // Validate the submitted rating
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        // Prevent the receiver from rating the same delivery twice
        $alreadyRated = Rating::where('delivery_id', $claim->delivery->id)
            ->where('giver_id', auth()->id())
            ->exists();

        if ($alreadyRated) {
            return back()->with(
                'error',
                'You have already rated this donation.'
            );
        }

        // Get the donor from the food donation
        $claim->load('foodDonation.donor');

        if (!$claim->foodDonation || !$claim->foodDonation->donor) {
            return back()->with(
                'error',
                'The donor information could not be found.'
            );
        }

        // Create the rating
        Rating::create([
            'delivery_id' => $claim->delivery->id,
            'giver_id' => auth()->id(),
            'receiver_id' => $claim->foodDonation->donor->id,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return redirect()
            ->route('receiver.claims.show', $claim)
            ->with(
                'success',
                'Thank you! Your rating has been submitted successfully.'
            );
    }

    public function storeVolunteerRating(
        Request $request,
        Claim $claim
    ): RedirectResponse {
        // Make sure this claim belongs to the logged-in receiver
        abort_unless($claim->receiver_id === auth()->id(), 403);

        // Rating is only allowed after the donation has been delivered
        if ($claim->status !== 'completed') {
            return back()->with(
                'error',
                'You can only rate a volunteer after the donation has been delivered.'
            );
        }

        // Load the delivery and volunteer
        $claim->load('delivery.volunteer');

        if (!$claim->delivery) {
            return back()->with(
                'error',
                'No delivery record was found for this claim.'
            );
        }

        // Make sure the delivery is actually completed
        if ($claim->delivery->status !== 'delivered') {
            return back()->with(
                'error',
                'You can only rate the volunteer after the delivery is completed.'
            );
        }

        // Make sure a volunteer exists
        if (!$claim->delivery->volunteer) {
            return back()->with(
                'error',
                'No volunteer was assigned to this delivery.'
            );
        }

        // Validate rating
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        // Prevent duplicate rating
        $alreadyRated = VolunteerRating::where(
            'delivery_id',
            $claim->delivery->id
        )
            ->where('giver_id', auth()->id())
            ->exists();

        if ($alreadyRated) {
            return back()->with(
                'error',
                'You have already rated this volunteer.'
            );
        }

        // Create volunteer rating
        VolunteerRating::create([
            'delivery_id' => $claim->delivery->id,
            'giver_id' => auth()->id(),
            'volunteer_id' => $claim->delivery->volunteer->id,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return redirect()
            ->route('receiver.claims.show', $claim)
            ->with(
                'success',
                'Thank you! Your volunteer rating has been submitted successfully.'
            );
    }
}