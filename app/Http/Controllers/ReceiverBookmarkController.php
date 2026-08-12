<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\FoodDonation;
use Illuminate\Http\Request;

class ReceiverBookmarkController extends Controller
{
    /**
     * Display the receiver's saved donations.
     */
    public function index()
    {
        $bookmarks = Bookmark::with('foodDonation.category')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('receiver.bookmarks.index', compact('bookmarks'));
    }

    /**
     * Save a food donation.
     */
    public function store(Request $request, FoodDonation $foodDonation)
    {
        // Only available donations can be bookmarked.
        if ($foodDonation->status !== 'available') {
            return back()->with('error', 'This donation is no longer available.');
        }

        Bookmark::firstOrCreate([
            'user_id' => auth()->id(),
            'food_donation_id' => $foodDonation->id,
        ]);

        return back()->with('success', 'Donation saved to your bookmarks.');
    }

    /**
     * Remove a food donation from bookmarks.
     */
    public function destroy(FoodDonation $foodDonation)
    {
        Bookmark::where('user_id', auth()->id())
            ->where('food_donation_id', $foodDonation->id)
            ->delete();

        return back()->with('success', 'Donation removed from your bookmarks.');
    }
}