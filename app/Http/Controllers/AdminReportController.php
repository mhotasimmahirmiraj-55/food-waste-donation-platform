<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class AdminReportController extends Controller
{
    public function index()
    {
        $reports = Report::with([
            'reporter',
            'reportedUser',
        ])->paginate(10);

        return view('admin.reports.index', [
            'reports' => $reports,
        ]);
    }

    public function show(Report $report)
    {
        $report->load([
            'reporter',
            'reportedUser',
        ]);

        return view('admin.reports.show', [
            'report' => $report,
        ]);
    }

    public function edit(Report $report)
    {
        return view('admin.reports.edit', [
            'report' => $report,
        ]);
    }

    public function update(Request $request, Report $report)
    {
        $request->validate([
            'status' => 'required|in:pending,reviewed,resolved',
        ]);

        $report->update([
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.reports')
            ->with('success', 'Report status updated successfully.');
    }

}