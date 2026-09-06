<?php

namespace App\Http\Controllers;

use App\Models\PatientRecords;
use App\Models\Treatment;
use Illuminate\Http\Request;

class DentistTreatmentController extends Controller
{

    public function index(Request $request)
    {
        $query = Treatment::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where(
                    'name',
                    'like',
                    "%{$search}%"
                )->orWhere(
                    'description',
                    'like',
                    "%{$search}%"
                );
            });
        }

        if (
            $request->filled('category') &&
            $request->category !== 'all'
        ) {
            $query->where(
                'category',
                $request->category
            );
        }

        if (
            $request->filled('status') &&
            $request->status !== 'all'
        ) {
            $query->where(
                'status',
                $request->status
            );
        }

        $treatments = $query
            ->latest()
            ->get();

        $patients = PatientRecords::query()
            ->orderBy('id', 'asc')
            ->get();

        return view(
            'dentist.treatments',
            compact(
                'treatments',
                'patients'
            )
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:150',
            ],

            'category' => [
                'required',
                'string',
                'max:100',
            ],

            'duration' => [
                'required',
                'integer',
                'min:1',
            ],

            'price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'description' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'status' => [
                'required',
                'in:active,inactive',
            ],
        ]);

        Treatment::create($validated);

        return redirect()
            ->route('dentist.treatments')
            ->with(
                'success',
                'Treatment added successfully.'
            );
    }

    public function update(
        Request $request,
        Treatment $treatment
    ) {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:150',
            ],

            'category' => [
                'required',
                'string',
                'max:100',
            ],

            'duration' => [
                'required',
                'integer',
                'min:1',
            ],

            'price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'description' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'status' => [
                'required',
                'in:active,inactive',
            ],
        ]);

        $treatment->update($validated);

        return redirect()
            ->route('dentist.treatments')
            ->with(
                'success',
                'Treatment updated successfully.'
            );
    }

    public function destroy(Treatment $treatment)
    {
        $treatment->delete();

        return redirect()
            ->route('dentist.treatments')
            ->with(
                'success',
                'Treatment deleted successfully.'
            );
    }


    public function toggleStatus(Treatment $treatment)
    {
        $treatment->update([
            'status' => $treatment->status === 'active'
                ? 'inactive'
                : 'active',
        ]);

        return redirect()
            ->route('dentist.treatments')
            ->with(
                'success',
                'Treatment status updated.'
            );
    }
}
