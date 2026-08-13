<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Delivery;
use App\Models\FoodDonation;
use Illuminate\Support\Facades\Auth;

class VolunteerController extends Controller
{
    public function dashboard()
    {
        $volunteerId = Auth::id();
        
        $availableDeliveries = Delivery::whereNull('volunteer_id')->where('status', 'pending')->count();
        $myActiveDeliveries = Delivery::where('volunteer_id', $volunteerId)->whereIn('status', ['accepted', 'picked_up'])->count();
        $completedDeliveries = Delivery::where('volunteer_id', $volunteerId)->where('status', 'delivered')->count();

        return view('volunteer.dashboard', compact('availableDeliveries', 'myActiveDeliveries', 'completedDeliveries'));
    }

    public function index(Request $request)
    {
        $query = Delivery::with(['foodDonation', 'receiver']);

        if ($request->has('tab') && $request->tab == 'my_deliveries') {
            $deliveries = $query->where('volunteer_id', Auth::id())->latest()->get();
        } else {
            $deliveries = $query->whereNull('volunteer_id')->where('status', 'pending')->latest()->get();
        }

        return view('volunteer.deliveries.index', compact('deliveries'));
    }

    public function show($id)
    {
        $delivery = Delivery::with(['foodDonation.donor', 'receiver'])->findOrFail($id);
        return view('volunteer.deliveries.show', compact('delivery'));
    }

    public function accept($id)
    {
        $delivery = Delivery::findOrFail($id);

        if ($delivery->volunteer_id !== null) {
            return back()->with('error', 'This delivery has already been assigned.');
        }

        $delivery->update([
            'volunteer_id' => Auth::id(),
            'status' => 'accepted'
        ]);

        return redirect()->route('volunteer.deliveries.show', $id)->with('success', 'Delivery accepted successfully!');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:picked_up,delivered',
            'proof_image' => 'nullable|image|max:2048'
        ]);

        $delivery = Delivery::where('id', $id)->where('volunteer_id', Auth::id())->firstOrFail();

        $data = ['status' => $request->status];

        if ($request->hasFile('proof_image')) {
            $path = $request->file('proof_image')->store('delivery_proofs', 'public');
            $data['proof_image'] = $path;
        }

        $delivery->update($data);

        if ($request->status == 'delivered') {
            $delivery->foodDonation()->update(['status' => 'completed']);
        }

        return back()->with('success', 'Delivery status updated successfully!');
    }
}