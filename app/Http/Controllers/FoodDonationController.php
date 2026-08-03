<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FoodDonation;

class FoodDonationController extends Controller
{
    public function create()
    {
     return view('donations.create');
    }
  public function index()
{
    $donations = FoodDonation::where('donor_id', auth()->id())
                    ->get();

    return view('donations.index', compact('donations'));
}

public function editDonations()

{
    $donations = FoodDonation::where('donor_id', auth()->id())
                    ->get();

    return view('donations.edit-index', compact('donations'));
}
public function deleteDonations()
{
    $donations = FoodDonation::where('donor_id', auth()->id())
                    ->get();

    return view('donations.delete-index', compact('donations'));
}


public function edit($id)
{
    $donation = FoodDonation::findOrFail($id);

    return view('donations.edit', compact('donation'));
}
public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required',
        'quantity' => 'required|integer',
        'expiry_time' => 'required',
        'pickup_address' => 'required',
    ]);

    $donation = FoodDonation::findOrFail($id);

    $donation->update([
        'title' => $request->title,
        'quantity' => $request->quantity,
        'expiry_time' => $request->expiry_time,
        'description' => $request->description,
        'pickup_address' => $request->pickup_address,
    ]);

    return redirect()->route('donations.edit.list');
}

public function destroy($id)
{
    $donation = FoodDonation::where('id', $id)
        ->where('donor_id', auth()->id())
        ->firstOrFail();

    if ($donation->status != 'available') {
        return redirect()->route('donations.delete.list')
            ->with('error', 'Only available donations can be deleted.');
    }

    $donation->delete();

    return redirect()->route('donations.delete.list')
        ->with('success', 'Donation deleted successfully.');
}
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'quantity' => 'required|integer',
        'expiry_time' => 'required',
        'pickup_address' => 'required',
        'food_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Default value
    $imagePath = null;

    // যদি user image select করে
    if ($request->hasFile('food_image')) {

        $imagePath = $request->file('food_image')
                             ->store('food_images', 'public');

    }

    FoodDonation::create([
        'donor_id' => auth()->id(),
        'food_category_id' => 1,
        'title' => $request->title,
        'description' => $request->description,
        'quantity' => $request->quantity,
        'expiry_time' => $request->expiry_time,
        'pickup_address' => $request->pickup_address,

        // Image থাকলে path save হবে, না থাকলে NULL
        'food_image' => $imagePath,

        'status' => 'available',
    ]);

    return redirect()
        ->route('donations.create')
        ->with('success', 'Food Donation Created Successfully');
}

    public function uploadPhoto()
    {
        return view('donations.upload-photo');
    }

    public function storePhoto(Request $request)
    {
        $request->validate([
            'food_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = $request->file('food_image')->store('food_images', 'public');

        // Temporary session এ save থাকবে
        session([
            'food_image' => $imagePath
        ]);

        return redirect()
            ->route('donations.create')
            ->with('success', 'Photo Uploaded Successfully.');
    }
}