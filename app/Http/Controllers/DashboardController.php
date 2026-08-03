<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function admin(): View
    {
        return view('admin.dashboard');
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