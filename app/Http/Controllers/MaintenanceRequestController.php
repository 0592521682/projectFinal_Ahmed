<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\MaintenanceRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MaintenanceRequestController
{
    public function index(Request $r)
    {
        $query = MaintenanceRequest::with(['customer', 'technician']);

        // Search by request title OR customer name
        if ($r->filled('search')) {
            $search = $r->search;

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhereHas('customer', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            });
        }

        // Filter by status
        if ($r->filled('status')) {
            $query->where('status', $r->status);
        }

        // Filter by priority
        if ($r->filled('priority')) {
            $query->where('priority', $r->priority);
        }

        // Filter by technician
        if ($r->filled('technician_id')) {
            $query->where('technician_id', $r->technician_id);
        }

        // Pagination + keep filters
        $requests = $query
            ->latest()
            ->paginate(5)
            ->withQueryString();

        $technicians = User::where('role', 'technician')
            ->orderBy('name')
            ->get();

        return view('requests.index', compact(
            'requests',
            'technicians'
        ));
    }

    public function create()
    {
        return view('requests.create', [
            'customers' => Customer::orderBy('name')->get(),

            'technicians' => User::where('role', 'technician')
                ->orderBy('name')
                ->get(),
        ]);
    }

    public function store(Request $r)
    {
        $data = $r->validate([
            'customer_id' => [
                'required',
                'exists:customers,id',
            ],

            'technician_id' => [
                'nullable',
                'exists:users,id',
                Rule::exists('users', 'id')
                    ->where(fn ($query) => $query->where('role', 'technician')),
            ],

            'title' => [
                'required',
                'string',
                'min:5',
                'max:100',
            ],

            'description' => [
                'required',
                'string',
                'min:10',
            ],

            'priority' => [
                'required',
                'in:low,medium,high',
            ],

            'requested_at' => [
                'required',
                'date',
            ],
        ]);

        // New requests always start as pending
        $data['status'] = 'pending';

        MaintenanceRequest::create($data);

        return redirect()
            ->route('requests.index')
            ->with('success', 'Request created successfully.');
    }

    public function show(MaintenanceRequest $request)
    {
        $request->load([
            'customer',
            'technician',
            'rating',
        ]);

        return view('requests.show', [
            'm' => $request,
        ]);
    }

    public function edit(MaintenanceRequest $request)
    {
        return view('requests.edit', [
            'maintenanceRequest' => $request,

            'customers' => Customer::orderBy('name')->get(),

            'technicians' => User::where('role', 'technician')
                ->orderBy('name')
                ->get(),
        ]);
    }

    public function update(Request $r, MaintenanceRequest $request)
    {
        // Authorization:
        // Admin can update any request.
        // Technician can update only requests assigned to themselves.
        $user = auth()->user();

        if (
            $user &&
            $user->isTechnician() &&
            (int) $request->technician_id !== (int) $user->id
        ) {
            abort(403, 'You are not authorized to update this request.');
        }

        $data = $r->validate([
            'customer_id' => [
                'required',
                'exists:customers,id',
            ],

            'technician_id' => [
                'nullable',
                'exists:users,id',
                Rule::exists('users', 'id')
                    ->where(fn ($query) => $query->where('role', 'technician')),
            ],

            'title' => [
                'required',
                'string',
                'min:5',
                'max:100',
            ],

            'description' => [
                'required',
                'string',
                'min:10',
            ],

            'priority' => [
                'required',
                'in:low,medium,high',
            ],

            'status' => [
                'required',
                'in:pending,in_progress,completed,cancelled',
            ],

            'requested_at' => [
                'required',
                'date',
            ],
        ]);

        $request->update($data);

        return redirect()
            ->route('requests.show', [
                'request' => $request->id,
            ])
            ->with('success', 'Request updated successfully.');
    }

    public function destroy(MaintenanceRequest $request)
    {
        // Authorization:
        // Admin can delete any request.
        // Technician can delete only requests assigned to themselves.
        $user = auth()->user();

        if (
            $user &&
            $user->isTechnician() &&
            (int) $request->technician_id !== (int) $user->id
        ) {
            abort(403, 'You are not authorized to delete this request.');
        }

        $request->delete();

        return redirect()
            ->route('requests.index')
            ->with('success', 'Request deleted successfully.');
    }
}