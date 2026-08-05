<?php

namespace App\Http\Controllers;

use App\Models\FoodCategory;
use App\Models\FoodDonation;
use Illuminate\Http\Request;

class AdminDonationController extends Controller
{
    public function index()
    {
        $donations = FoodDonation::with([
            'donor',
            'category',
        ])->paginate(10);

        return view('admin.donations.index', [
            'donations' => $donations,
        ]);
    }

    public function show(FoodDonation $donation)
    {
        $donation->load([
            'donor',
            'category'
        ]);

        return view('admin.donations.show', [
            'donation' => $donation,
        ]);
    }

    public function edit(FoodDonation $donation)
    {
        if ($donation->status !== 'available') {
            abort(403);
        }

        $categories = FoodCategory::all();

        return view('admin.donations.edit', [
            'donation' => $donation,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, FoodDonation $donation)
    {
        if ($donation->status !== 'available') {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'food_category_id' => 'required|exists:food_categories,id',
            'quantity' => 'required|integer|min:1',
            'expiry_time' => 'required|date',
            'pickup_address' => 'required|string|max:255',
            'pickup_date' => 'nullable|date',
            'pickup_time' => 'nullable',
        ]);

        $donation->update($validated);

        return redirect()
            ->route('admin.donations')
            ->with('success', 'Donation updated successfully.');
    }

    public function destroy(FoodDonation $donation)
    {
        if ($donation->status !== 'available') {
            abort(403);
        }

        $donation->delete();

        return redirect()
            ->route('admin.donations')
            ->with('success', 'Donation deleted successfully.');
    }

    
}
