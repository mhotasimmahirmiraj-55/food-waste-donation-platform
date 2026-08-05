<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\FoodDonation;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function admin(): View
    {
        $totalUsers = User::count();
        $totalDonations = FoodDonation::count();
        $totalAdmins = User::where('role_id', 1)->count();
        $totalDonors = User::where('role_id',2) ->count();
        $totalReceivers = User::where('role_id', 3)->count();
        $totalVolunteers = User::where('role_id', 4)->count();
        return view('admin.dashboard', [
            'totalUsers' => $totalUsers,
            'totalDonations' => $totalDonations,
            'totalAdmins' => $totalAdmins,
            'totalDonors' => $totalDonors,
            'totalReceivers' => $totalReceivers,
            'totalVolunteers' => $totalVolunteers,
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