<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use Illuminate\Http\Request;

class AdminDeliveryController extends Controller
{
    public function index()
    {
        $deliveries = Delivery::with([
            'claim.foodDonation',
            'claim.receiver',
            'volunteer',
        ])->paginate(10);

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