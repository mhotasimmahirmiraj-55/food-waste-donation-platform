<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FoodDonation;
use App\Models\FoodCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FoodDonationController extends Controller
{
    // ==========================================
    // CREATE DONATION PAGE
    // ==========================================

    public function create()
    {
        // Category dropdown-এর জন্য সব category নিয়ে আসা হচ্ছে
        $categories = FoodCategory::all();

        return view('donations.create', compact('categories'));
    }


    // ==========================================
    // MY DONATIONS
    // ==========================================

   public function index()
{
    $donations = FoodDonation::where('donor_id', auth()->id())
        ->orderBy('created_at', 'desc')
        ->get();

    return view('donations.index', compact('donations'));
}


// ==========================================
// EDIT DONATIONS LIST
// ==========================================

public function editDonations()
{
    // Expired available donations automatically update হবে
    FoodDonation::where('donor_id', auth()->id())
        ->where('status', 'available')
        ->where('expiry_time', '<', now())
        ->update([
            'status' => 'expired',
        ]);

    // শুধু AVAILABLE donations দেখাবে
    $donations = FoodDonation::with('items.foodCategory')
        ->where('donor_id', auth()->id())
        ->where('status', 'available')
        ->get();

    return view('donations.edit-index', compact('donations'));
}
    // ==========================================
    // DELETE DONATIONS LIST
    // ==========================================

   public function deleteDonations()
{
    $donations = FoodDonation::where('donor_id', auth()->id())
        ->orderByRaw("CASE WHEN status = 'available' THEN 0 ELSE 1 END")
        ->latest()
        ->get();

    return view('donations.delete-index', compact('donations'));
}


    // ==========================================
    // EDIT SINGLE DONATION
    // ==========================================

public function edit($id)
{
    $donation = FoodDonation::with('items.foodCategory')
        ->where('id', $id)
        ->where('donor_id', auth()->id())
        ->where('status', 'available')
        ->firstOrFail();

    $categories = FoodCategory::all();

    return view('donations.edit', compact('donation', 'categories'));
}

 // ==========================================
// UPDATE DONATION
// ==========================================

public function update(Request $request, $id)
{
    // ==========================================
    // 1. VALIDATION
    // ==========================================

    $request->validate([
        'title'            => 'required|string|max:255',
        'description'      => 'nullable|string',
        'expiry_time'      => 'required|date',
        'pickup_address'   => 'required|string|max:255',
        'food_image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'food_images'      => 'nullable|array',
        'food_images.*'    => 'image|mimes:jpg,jpeg,png|max:2048',
        'existing_images'  => 'nullable|array',
        'image_actions'    => 'nullable|array',

        // Multiple Food Items
        'items'                    => 'required|array|min:1',
        'items.*.id'               => 'nullable|integer',
        'items.*.food_category_id' => 'required|exists:food_categories,id',
        'items.*.item_name'        => 'required|string|max:255',
        'items.*.quantity'         => 'required|numeric|min:0.1',
        'items.*.unit'             => 'required|string|max:50',
    ]);


    // ==========================================
    // 2. FIND DONATION
    // ==========================================

    $donation = FoodDonation::where('id', $id)
        ->where('donor_id', auth()->id())
        ->where('status', 'available')
        ->firstOrFail();


    // ==========================================
    // 3. DATABASE TRANSACTION
    // ==========================================

    DB::transaction(function () use ($request, $donation) {

        // Existing images handling: Keep or Delete
        $keptImages = [];
        if ($request->has('existing_images') && is_array($request->existing_images)) {
            foreach ($request->existing_images as $idx => $path) {
                $action = $request->image_actions[$idx] ?? 'keep';
                if ($action === 'delete') {
                    if (Storage::disk('public')->exists($path)) {
                        Storage::disk('public')->delete($path);
                    }
                } else {
                    $keptImages[] = $path;
                }
            }
        } elseif (!$request->boolean('remove_image')) {
            $keptImages = $donation->images;
        }

        // Handle newly uploaded images (multiple and/or single)
        if ($request->hasFile('food_images')) {
            foreach ($request->file('food_images') as $file) {
                $keptImages[] = $file->store('food_images', 'public');
            }
        }
        if ($request->hasFile('food_image')) {
            $keptImages[] = $request->file('food_image')->store('food_images', 'public');
        }

        $newFoodImage = null;
        if (!empty($keptImages)) {
            $newFoodImage = count($keptImages) === 1 ? $keptImages[0] : json_encode(array_values($keptImages));
        }

        // ======================================
        // UPDATE MAIN DONATION
        // ======================================

        $donation->update([
            'title'          => $request->title,
            'description'    => $request->description,
            'expiry_time'    => $request->expiry_time,
            'pickup_address' => $request->pickup_address,
            'food_image'     => $newFoodImage,
        ]);


        // ======================================
        // EXISTING ITEM IDs FROM FORM
        // ======================================

        $submittedItemIds = collect($request->items)
            ->pluck('id')
            ->filter()
            ->map(fn ($id) => (int) $id)
            ->values()
            ->toArray();


        // ======================================
        // DELETE REMOVED ITEMS
        // ======================================

        $donation->items()
            ->whereNotIn('id', $submittedItemIds)
            ->delete();


        // ======================================
        // UPDATE EXISTING / CREATE NEW ITEMS
        // ======================================

        foreach ($request->items as $itemData) {

            // ----------------------------------
            // Existing item
            // ----------------------------------

            if (!empty($itemData['id'])) {

                $item = $donation->items()
                    ->where('id', $itemData['id'])
                    ->firstOrFail();

                $item->update([
                    'food_category_id' => $itemData['food_category_id'],
                    'item_name'        => $itemData['item_name'],
                    'quantity'         => $itemData['quantity'],
                    'unit'             => $itemData['unit'],
                ]);

            }

            // ----------------------------------
            // New item
            // ----------------------------------

            else {

                $donation->items()->create([
                    'food_category_id' => $itemData['food_category_id'],
                    'item_name'        => $itemData['item_name'],
                    'quantity'         => $itemData['quantity'],
                    'unit'             => $itemData['unit'],
                ]);

            }
        }
    });


    // ==========================================
    // 4. REDIRECT
    // ==========================================

    return redirect()
        ->route('donations.edit.list')
        ->with('success', 'Donation updated successfully.');
}
    // ==========================================
    // DELETE DONATION
    // ==========================================

    public function destroy($id)
    {
        $donation = FoodDonation::where('id', $id)
            ->where('donor_id', auth()->id())
            ->firstOrFail();

        // Only available donations can be deleted
        if ($donation->status !== 'available') {
            return redirect()
                ->route('donations.delete.list')
                ->with('error', 'Only available donations can be deleted.');
        }

        $donation->delete();

        return redirect()
            ->route('donations.delete.list')
            ->with('success', 'Donation deleted successfully.');
    }


    // ==========================================
    // STORE NEW DONATION (Step 5 Updated)
    // ==========================================

    public function store(Request $request)
    {
        // 1. Validation for Parent Donation & Child Multiple Items
        $request->validate([
            'title'          => 'required|string|max:255',
            'expiry_time'    => 'required',
            'pickup_address' => 'required',
            'food_image'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'food_images'    => 'nullable|array',
            'food_images.*'  => 'image|mimes:jpg,jpeg,png|max:2048',

            // Multiple Food Items Validation Rules
            'items'                 => 'required|array|min:1',
            'items.*.food_category_id' => 'required|exists:food_categories,id',
            'items.*.item_name'     => 'required|string|max:255',
            'items.*.quantity'      => 'required|numeric|min:0.1',
            'items.*.unit'          => 'required|string|max:50',
        ]);

        // Multi & single food image handling
        $imagePaths = [];
        if ($request->hasFile('food_images')) {
            foreach ($request->file('food_images') as $file) {
                $imagePaths[] = $file->store('food_images', 'public');
            }
        }
        if ($request->hasFile('food_image')) {
            $imagePaths[] = $request->file('food_image')->store('food_images', 'public');
        }

        $imagePath = null;
        if (!empty($imagePaths)) {
            $imagePath = count($imagePaths) === 1 ? $imagePaths[0] : json_encode(array_values($imagePaths));
        }

        // 2. Transaction purely handling safety for both operations
        DB::transaction(function () use ($request, $imagePath) {
            
            // Parent FoodDonation Create
            $donation = FoodDonation::create([
                'donor_id'       => auth()->id(),
                'title'          => $request->title,
                'description'    => $request->description,
                'expiry_time'    => $request->expiry_time,
                'pickup_address' => $request->pickup_address,
                'food_image'     => $imagePath,
                'status'         => 'available',
            ]);

            // Child FoodDonationItems Insert
            foreach ($request->items as $item) {
                $donation->items()->create([
                    'food_category_id' => $item['food_category_id'],
                    'item_name'        => $item['item_name'],
                    'quantity'         => $item['quantity'],
                    'unit'             => $item['unit'],
                ]);
            }
        });

        return redirect()
            ->route('donations.create')
            ->with('success', 'Food Donation Created Successfully');
    }


    // ==========================================
    // UPLOAD PHOTO PAGE
    // ==========================================

    public function uploadPhoto()
    {
        return view('donations.upload-photo');
    }


    // ==========================================
    // STORE PHOTO
    // ==========================================

    public function storePhoto(Request $request)
    {
        $request->validate([
            'food_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = $request->file('food_image')->store('food_images', 'public');

        // Store temporary image path in session
        session(['food_image' => $imagePath]);

        return redirect()
            ->route('donations.create')
            ->with('success', 'Photo Uploaded Successfully.');
    }
}