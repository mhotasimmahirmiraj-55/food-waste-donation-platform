<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\Delivery;
use Illuminate\Http\Request;

class AdminClaimController extends Controller
{
    public function index(Request $request)
    {
        $query = Claim::with([
            'foodDonation',
            'receiver',
        ]);

        // Filter by claim status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $claims = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.claims.index', [
            'claims' => $claims,
        ]);
    }

    public function show(Claim $claim)
    {
        $claim->load([
            'foodDonation',
            'receiver',
        ]);

        return view('admin.claims.show', [
            'claim' => $claim,
        ]);
    }

    public function edit(Claim $claim)
    {
        $claim->load([
            'foodDonation',
            'receiver',
        ]);

        return view('admin.claims.edit', [
            'claim' => $claim,
        ]);
    }

    public function update(Request $request, Claim $claim)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected,completed,cancelled',
        ]);

        $newStatus = $request->status;

        $claim->update([
            'status' => $newStatus,
        ]);

        // Create a delivery when an approved claim is ready
        // for volunteer assignment.
        if ($newStatus === 'approved') {
            Delivery::firstOrCreate(
                [
                    'claim_id' => $claim->id,
                ],
                [
                    'status' => 'pending',
                    'volunteer_id' => null,
                ]
            );
        }

        return redirect()
            ->route('admin.claims')
            ->with('success', 'Claim status updated successfully.');
    }
}