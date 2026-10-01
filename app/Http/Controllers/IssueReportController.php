<?php

namespace App\Http\Controllers;

use App\Models\IssueReport;
use Illuminate\Http\Request;

class IssueReportController extends Controller
{
    /**
     * Store a new issue report.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'issue_type' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'required',
                'string',
                'min:10',
            ],

            'screenshot' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],
        ]);

        $screenshotPath = null;

        if ($request->hasFile('screenshot')) {
            $screenshotPath = $request
                ->file('screenshot')
                ->store('issue-reports', 'public');
        }

        IssueReport::create([
            'user_id' => auth()->id(),
            'issue_type' => $validated['issue_type'],
            'description' => $validated['description'],
            'screenshot' => $screenshotPath,
            'status' => 'pending',
        ]);

        return redirect()
            ->route('appointments.settings')
            ->with(
                'success',
                'Your issue has been reported successfully. Thank you for helping us improve the system.'
            );
    }
}
