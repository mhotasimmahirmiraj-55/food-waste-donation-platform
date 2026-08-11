<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use Illuminate\Http\Request;

class AdminDeliveryController extends Controller
{
    public function index(Request $request)
    {
        $query = Delivery::with([
            'claim.foodDonation',
            'claim.receiver',
            'volunteer',
        ]);

        // Filter by delivery status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $deliveries = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.deliveries.index', [
            'deliveries' => $deliveries,
        ]);
    }


    public function show(Delivery $delivery)
    {
        $delivery->load([
            'claim.foodDonation',
            'claim.receiver',
            'volunteer',
            'deliveryProof',
            'rating',
        ]);

        return view('admin.deliveries.show', [
            'delivery' => $delivery,
        ]);
    }


    public function release(Delivery $delivery)
    {
        $delivery->update([
            'volunteer_id' => null,
            'status' => 'pending',
            'accepted_at' => null,
            'picked_up_at' => null,
            'delivered_at' => null,
        ]);

        return redirect()
            ->route('admin.deliveries')
            ->with('success', 'Delivery released and is now available for another volunteer.');
    }
}