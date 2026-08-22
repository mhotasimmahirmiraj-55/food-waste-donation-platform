<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class AdminReportController extends Controller
{
    /**
     * Display all reports.
     *
     * MVC:
     * - Controller receives the admin request.
     * - Model (Report) gets the required data from the database.
     * - Controller sends that data to the Blade View.
     *
     * Supports filtering by:
     * - pending
     * - reviewed
     * - resolved
     */
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Start Report Query
        |--------------------------------------------------------------------------
        |
        | with() eager-loads related models.
        |
        | reporter      -> User who submitted the report
        | reportedUser  -> User being reported
        | foodDonation  -> Donation related to the report
        |
        | foodDonation is important because the donor module now creates
        | reports specifically for expired donations.
        |
        */

        $query = Report::with([
            'reporter',
            'reportedUser',
            'foodDonation',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Filter Reports By Status
        |--------------------------------------------------------------------------
        |
        | Example:
        | /admin/reports?status=pending
        |
        | request->filled() checks whether the status filter was provided.
        | where() then adds that condition to the database query.
        |
        */

        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->status
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Get Reports
        |--------------------------------------------------------------------------
        |
        | latest()
        |     Shows newest reports first.
        |
        | paginate(10)
        |     Shows 10 reports per page.
        |
        | withQueryString()
        |     Keeps the status filter when changing pages.
        |
        */

        $reports = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | Send Data To Blade View
        |--------------------------------------------------------------------------
        |
        | This connects the Controller to:
        |
        | resources/views/admin/reports/index.blade.php
        |
        | The Blade file receives the $reports variable.
        |
        */

        return view('admin.reports.index', [
            'reports' => $reports,
        ]);
    }


    /**
     * Display a single report.
     *
     * Route example:
     * /admin/reports/5
     *
     * Laravel automatically finds the Report model using
     * Route Model Binding.
     */
    public function show(Report $report)
    {
        /*
        |--------------------------------------------------------------------------
        | Load Report Relationships
        |--------------------------------------------------------------------------
        |
        | reporter
        |     Person who submitted the report.
        |
        | reportedUser
        |     Person associated with the report.
        |
        | foodDonation
        |     Donation connected to the report.
        |
        | The foodDonation relationship is important for the donor's
        | expired-donation reporting feature.
        |
        */

        $report->load([
            'reporter',
            'reportedUser',
            'foodDonation',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Return Details View
        |--------------------------------------------------------------------------
        |
        | View:
        | resources/views/admin/reports/show.blade.php
        |
        */

        return view('admin.reports.show', [
            'report' => $report,
        ]);
    }


    /**
     * Show the edit report form.
     *
     * This page allows the admin to change only the
     * report status.
     */
    public function edit(Report $report)
    {
        /*
        |--------------------------------------------------------------------------
        | Load Relationships
        |--------------------------------------------------------------------------
        |
        | These relationships are displayed as read-only information
        | on the edit page.
        |
        */

        $report->load([
            'reporter',
            'reportedUser',
            'foodDonation',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Return Edit View
        |--------------------------------------------------------------------------
        |
        | View:
        | resources/views/admin/reports/edit.blade.php
        |
        */

        return view('admin.reports.edit', [
            'report' => $report,
        ]);
    }


    /**
     * Update the report status.
     *
     * The admin can change the status to:
     * - pending
     * - reviewed
     * - resolved
     */
    public function update(Request $request, Report $report)
    {
        /*
        |--------------------------------------------------------------------------
        | Validate Admin Input
        |--------------------------------------------------------------------------
        |
        | The status must be one of the allowed values.
        |
        | This prevents invalid values from being stored in the database.
        |
        */

        $request->validate([
            'status' => 'required|in:pending,reviewed,resolved',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Update Report
        |--------------------------------------------------------------------------
        |
        | Only the status is changed.
        |
        | Reporter, reported user, reason and donation information
        | remain unchanged.
        |
        */

        $report->update([
            'status' => $request->status,
        ]);


        /*
        |--------------------------------------------------------------------------
        | Redirect After Update
        |--------------------------------------------------------------------------
        |
        | After successfully updating the report:
        |
        | 1. Redirect to Admin Report Management.
        | 2. Store a temporary success message in the session.
        |
        | The Blade page can display this using:
        | session('success')
        |
        */

        return redirect()
            ->route('admin.reports')
            ->with(
                'success',
                'Report status updated successfully.'
            );
    }
}