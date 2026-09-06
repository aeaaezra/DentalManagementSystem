<?php

namespace App\Http\Controllers;

use App\Models\IssueReport;
use Illuminate\Http\Request;

class IssueReportManagementController extends Controller
{
    /**
     * Display all issue reports.
     */
    public function index(Request $request)
    {
        $query = IssueReport::with('user')
            ->latest();

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search reports
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('issue_type', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery
                            ->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }

        $reports = $query->paginate(15)->withQueryString();

        return view('admin.issue-reports.index', compact('reports'));
    }

    /**
     * Display a single issue report.
     */
    public function show(IssueReport $issueReport)
    {
        $issueReport->load('user');

        return view(
            'admin.issue-reports.show',
            compact('issueReport')
        );
    }

    /**
     * Update the status and admin notes.
     */
    public function update(Request $request, IssueReport $issueReport)
    {
        $validated = $request->validate([
            'status' => [
                'required',
                'in:pending,investigating,resolved,closed',
            ],

            'admin_notes' => [
                'nullable',
                'string',
            ],
        ]);

        $issueReport->update([
            'status' => $validated['status'],
            'admin_notes' => $validated['admin_notes'] ?? null,
        ]);

        return redirect()
            ->route(
                'admin.issue-reports.show',
                $issueReport
            )
            ->with(
                'success',
                'Issue report updated successfully.'
            );
    }

    /**
     * Delete an issue report.
     */
    public function destroy(IssueReport $issueReport)
    {
        $issueReport->delete();

        return redirect()
            ->route('admin.issue-reports.index')
            ->with(
                'success',
                'Issue report deleted successfully.'
            );
    }
}
