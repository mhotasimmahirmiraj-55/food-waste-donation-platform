<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\Delivery;
use App\Models\FoodCategory;
use App\Models\Report;
use App\Models\User;
use App\Models\FoodDonation;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function admin(): View
    {
        // ==============================
        // BASIC PLATFORM ANALYTICS
        // ==============================

        $totalUsers = User::count();

        $totalDonations = FoodDonation::count();

        $totalAdmins = User::where('role_id', 1)->count();

        $totalDonors = User::where('role_id', 2)->count();

        $totalReceivers = User::where('role_id', 3)->count();

        $totalVolunteers = User::where('role_id', 4)->count();

        $blockedUsers = User::where('status', 'blocked')->count();

        $totalCategories = FoodCategory::count();

        $totalClaims = Claim::count();

        $totalReports = Report::count();


        // ==============================
        // DONATION ANALYTICS
        // ==============================

        $availableDonations = FoodDonation::where(
            'status',
            'available'
        )->count();

        $claimedDonations = FoodDonation::where(
            'status',
            'claimed'
        )->count();

        $completedDonations = FoodDonation::where(
            'status',
            'completed'
        )->count();


        // ==============================
        // CLAIM ANALYTICS
        // ==============================

        $pendingClaims = Claim::where(
            'status',
            'pending'
        )->count();

        $approvedClaims = Claim::where(
            'status',
            'approved'
        )->count();

        $completedClaims = Claim::where(
            'status',
            'completed'
        )->count();

        $rejectedClaims = Claim::where(
            'status',
            'rejected'
        )->count();


        // ==============================
        // DELIVERY ANALYTICS
        // ==============================

        $totalDeliveries = Delivery::count();

        $pendingDeliveries = Delivery::where(
            'status',
            'pending'
        )->count();

        $acceptedDeliveries = Delivery::where(
            'status',
            'accepted'
        )->count();

        $pickedUpDeliveries = Delivery::where(
            'status',
            'picked_up'
        )->count();

        $completedDeliveries = Delivery::where(
            'status',
            'delivered'
        )->count();


        // ==============================
        // REPORT ANALYTICS
        // ==============================

        $pendingReports = Report::where(
            'status',
            'pending'
        )->count();

        $reviewedReports = Report::where(
            'status',
            'reviewed'
        )->count();

        $resolvedReports = Report::where(
            'status',
            'resolved'
        )->count();


        // ==============================
        // RECENT ACTIVITY
        // ==============================

        $recentDonations = FoodDonation::with([
            'donor',
            'category',
        ])
            ->latest()
            ->take(5)
            ->get();


        $recentClaims = Claim::with([
            'foodDonation',
            'receiver',
        ])
            ->latest()
            ->take(5)
            ->get();


        $recentReports = Report::with([
            'reporter',
            'reportedUser',
        ])
            ->latest()
            ->take(5)
            ->get();


        return view('admin.dashboard', [

            // Basic analytics
            'totalUsers' => $totalUsers,
            'totalDonations' => $totalDonations,
            'totalAdmins' => $totalAdmins,
            'totalDonors' => $totalDonors,
            'totalReceivers' => $totalReceivers,
            'totalVolunteers' => $totalVolunteers,
            'blockedUsers' => $blockedUsers,
            'totalCategories' => $totalCategories,
            'totalClaims' => $totalClaims,
            'totalReports' => $totalReports,

            // Donation analytics
            'availableDonations' => $availableDonations,
            'claimedDonations' => $claimedDonations,
            'completedDonations' => $completedDonations,

            // Claim analytics
            'pendingClaims' => $pendingClaims,
            'approvedClaims' => $approvedClaims,
            'completedClaims' => $completedClaims,
            'rejectedClaims' => $rejectedClaims,

            // Delivery analytics
            'totalDeliveries' => $totalDeliveries,
            'pendingDeliveries' => $pendingDeliveries,
            'acceptedDeliveries' => $acceptedDeliveries,
            'pickedUpDeliveries' => $pickedUpDeliveries,
            'completedDeliveries' => $completedDeliveries,

            // Report analytics
            'pendingReports' => $pendingReports,
            'reviewedReports' => $reviewedReports,
            'resolvedReports' => $resolvedReports,

            // Recent activity
            'recentDonations' => $recentDonations,
            'recentClaims' => $recentClaims,
            'recentReports' => $recentReports,
        ]);
    }


    public function donor(): View
    {
        return view('donor.dashboard');
    }


    public function receiver(): View
    {
        return view('receiver.dashboard');
    }


    public function volunteer(): View
    {
        return view('volunteer.dashboard');
    }
}