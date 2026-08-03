<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {

        $user = auth()->user();

        switch ($user->role_id) {
            case 1:
                return redirect()->route('admin.dashboard');

            case 2:
                return redirect()->route('donor.dashboard');

            case 3:
                return redirect()->route('receiver.dashboard');

            case 4:
                return redirect()->route('volunteer.dashboard');

            default:
                abort(403);
        }

    })->name('dashboard');

    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])
        ->middleware('role:admin')
        ->name('admin.dashboard');

    Route::get('/donor/dashboard', [DashboardController::class, 'donor'])
        ->middleware('role:donor')
        ->name('donor.dashboard');

    Route::get('/receiver/dashboard', [DashboardController::class, 'receiver'])
        ->middleware('role:receiver')
        ->name('receiver.dashboard');

    Route::get('/volunteer/dashboard', [DashboardController::class, 'volunteer'])
        ->middleware('role:volunteer')
        ->name('volunteer.dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__ . '/auth.php';