<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\FoodDonation;

class ReportController extends Controller
{
    // ==========================================
    // CREATE REPORT PAGE
    // ==========================================

public function create()
{
    $donations = FoodDonation::where('donor_id', auth()->id())
        ->where('status', 'expired')
        ->whereDoesntHave('reports', function ($query) {
            $query->where('reporter_id', auth()->id());
        })
        ->orderBy('expiry_time', 'desc')
        ->get();

    return view('donor.report', compact('donations'));
}
    // ==========================================
    // STORE REPORT
    // ==========================================

    public function store(Request $request, $donationId)
    {
        // ==========================================
        // 1. VALIDATION
        // ==========================================

        $request->validate([
            'reason' => 'required|string|max:1000',
        ]);


        // ==========================================
        // 2. FIND DONATION
        // ==========================================

        $donation = FoodDonation::where('id', $donationId)
            ->where('donor_id', auth()->id())
            ->firstOrFail();


        // ==========================================
        // 3. CREATE REPORT
        // ==========================================

        Report::create([
            'reporter_id'      => auth()->id(),
            'reported_user_id' => auth()->id(),
            'food_donation_id' => $donation->id,
            'reason'           => $request->reason,
            'status'           => 'pending',
        ]);


        // ==========================================
        // 4. REDIRECT
        // ==========================================

        return redirect()
            ->route('donor.dashboard')
            ->with('success', 'Report submitted successfully.');
    }
}