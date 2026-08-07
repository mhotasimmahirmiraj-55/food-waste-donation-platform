<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use Illuminate\Http\Request;

class AdminClaimController extends Controller
{
    public function index()
    {
        $claims = Claim::with([
            'foodDonation',
            'receiver',
        ])->paginate(10);

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
            'status' => 'required|in:pending,approved,rejected,completed',
        ]);

        $claim->update([
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.claims')
            ->with('success', 'Claim status updated successfully.');
    }

}