<?php

use App\Http\Controllers\AdminClaimController;
use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminDonationController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FoodDonationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'verified'])->group(function () {


    // Dashboard Redirect
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


    // =========================
    // Dashboard Routes
    // =========================


    Route::get('/admin/dashboard', 
        [DashboardController::class, 'admin']
    )
    ->middleware('role:admin')
    ->name('admin.dashboard');



    Route::get('/donor/dashboard', 
        [DashboardController::class, 'donor']
    )
    ->middleware('role:donor')
    ->name('donor.dashboard');



    Route::get('/receiver/dashboard', 
        [DashboardController::class, 'receiver']
    )
    ->middleware('role:receiver')
    ->name('receiver.dashboard');



    Route::get('/volunteer/dashboard', 
        [DashboardController::class, 'volunteer']
    )
    ->middleware('role:volunteer')
    ->name('volunteer.dashboard');



    // =========================
    // User Management Routes
    // =========================
    
    Route::get('/admin/users', 
        [AdminUserController::class, 'index']
    )
    ->middleware('role:admin')
    ->name('admin.users');

    Route::get('/admin/users/{user}/edit',
        [AdminUserController::class, 'edit']
    )
    ->middleware('role:admin')
    ->name('admin.users.edit');

    Route::put('/admin/users/{user}',
        [AdminUserController::class, 'update']
    )
    ->middleware('role:admin')
    ->name('admin.users.update');

    Route::put('/admin/users/{user}/toggle-status',
        [AdminUserController::class, 'toggleStatus']
    )
    ->middleware('role:admin')
    ->name('admin.users.toggle-status');


    // =========================
    // Donation Management Routes
    // =========================

    Route::get('/admin/donations',
        [AdminDonationController::class, 'index']
    )
    ->middleware('role:admin')
    ->name('admin.donations');

    Route::get('/admin/donations/{donation}',
        [AdminDonationController::class, 'show']
    )
    ->middleware('role:admin')
    ->name('admin.donations.show');

    Route::get('/admin/donations/{donation}/edit',
        [AdminDonationController::class, 'edit']
    )
    ->middleware('role:admin')
    ->name('admin.donations.edit');

    Route::put('/admin/donations/{donation}',
        [AdminDonationController::class, 'update']
    )
    ->middleware('role:admin')
    ->name('admin.donations.update');

    Route::delete('/admin/donations/{donation}',
        [AdminDonationController::class, 'destroy']
    )
    ->middleware('role:admin')
    ->name('admin.donations.destroy');


    // =========================
    // Food Category Management Routes
    // =========================

    Route::get('/admin/categories',
        [AdminCategoryController::class, 'index']
    )
    ->middleware('role:admin')
    ->name('admin.categories');

    Route::get('/admin/categories/create',
        [AdminCategoryController::class, 'create']
    )
    ->middleware('role:admin')
    ->name('admin.categories.create');

    Route::post('/admin/categories',
        [AdminCategoryController::class, 'store']
    )
    ->middleware('role:admin')
    ->name('admin.categories.store');

    Route::get('/admin/categories/{category}/edit',
        [AdminCategoryController::class, 'edit']
    )
    ->middleware('role:admin')
    ->name('admin.categories.edit');

    Route::put('/admin/categories/{category}',
        [AdminCategoryController::class, 'update']
    )
    ->middleware('role:admin')
    ->name('admin.categories.update');

    Route::delete('/admin/categories/{category}',
        [AdminCategoryController::class, 'destroy']
    )
    ->middleware('role:admin')
    ->name('admin.categories.destroy');


    // =========================
    // Report Management Routes
    // =========================

    Route::get('/admin/reports',
        [AdminReportController::class, 'index']
    )
    ->middleware('role:admin')
    ->name('admin.reports');

    Route::get('/admin/reports/{report}',
        [AdminReportController::class, 'show']
    )
    ->middleware('role:admin')
    ->name('admin.reports.show');

    Route::get('/admin/reports/{report}/edit',
        [AdminReportController::class, 'edit']
    )
    ->middleware('role:admin')
    ->name('admin.reports.edit');

    Route::put('/admin/reports/{report}',
        [AdminReportController::class, 'update']
    )
    ->middleware('role:admin')
    ->name('admin.reports.update');


    // =========================
    // Claim Management Routes
    // =========================

    Route::get('/admin/claims',
        [AdminClaimController::class, 'index']
    )
    ->middleware('role:admin')
    ->name('admin.claims');

    Route::get('/admin/claims/{claim}',
        [AdminClaimController::class, 'show']
    )
    ->middleware('role:admin')
    ->name('admin.claims.show');

    Route::get('/admin/claims/{claim}/edit',
        [AdminClaimController::class, 'edit']
    )
    ->middleware('role:admin')
    ->name('admin.claims.edit');

    Route::put('/admin/claims/{claim}',
        [AdminClaimController::class, 'update']
    )
    ->middleware('role:admin')
    ->name('admin.claims.update');

    // =========================
    // Donation Routes
    // =========================



    // Create Donation Page

    Route::get('/donations/{id}/edit',
       [FoodDonationController::class, 'edit']
)
     ->middleware('role:donor')
     ->name('donations.edit');

    Route::get('/donor/donations/create', 
        [FoodDonationController::class, 'create']
    )
    ->middleware('role:donor')
    ->name('donations.create');





    // Store Donation

    Route::post('/donor/donations',
        [FoodDonationController::class,'store']
    )
    ->middleware('role:donor')
    ->name('donations.store');





    // My Donations

    Route::get('/my-donations',
        [FoodDonationController::class, 'index']
    )
    ->middleware('role:donor')
    ->name('donations.index');





    // Edit Donations List

    Route::get('/edit-donations',
        [FoodDonationController::class, 'editDonations']
    )
    ->middleware('role:donor')
    ->name('donations.edit.list');

    // Update Donation

     Route::put('/donations/{id}',
       [FoodDonationController::class, 'update']
    )
    ->middleware('role:donor')
    ->name('donations.update');
    // delete Donation

    Route::get('/delete-donations', [FoodDonationController::class, 'deleteDonations'])
    ->name('donations.delete.list');

    Route::delete('/donations/{id}', [FoodDonationController::class, 'destroy'])
    ->name('donations.destroy');







    // =========================
    // Upload Photo Routes
    // =========================


    Route::get('/donor/donations/upload-photo', 
        [FoodDonationController::class, 'uploadPhoto']
    )
    ->middleware('auth');



    Route::post('/donor/donations/upload-photo', 
        [FoodDonationController::class, 'storePhoto']
    )
    ->middleware('auth');







    // =========================
    // Profile Routes
    // =========================


    Route::get('/profile', 
        [ProfileController::class, 'edit']
    )
    ->name('profile.edit');



    Route::patch('/profile', 
        [ProfileController::class, 'update']
    )
    ->name('profile.update');



    Route::delete('/profile', 
        [ProfileController::class, 'destroy']
    )
    ->name('profile.destroy');


});


require __DIR__ . '/auth.php';