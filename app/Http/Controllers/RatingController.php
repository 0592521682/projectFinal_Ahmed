<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceRequest;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController
{
    public function store(Request $r, MaintenanceRequest $maintenanceRequest)
    {
        // Rating only for completed requests
        if ($maintenanceRequest->status !== 'completed') {
            return back()->withErrors([
                'rating' => 'Rating is allowed only for completed requests.'
            ]);
        }

        // Only one rating per request
        if ($maintenanceRequest->rating()->exists()) {
            return back()->withErrors([
                'rating' => 'This request has already been rated.'
            ]);
        }

        $v = $r->validate([
            'customer_id' => ['required', 'exists:customers,id'],
            'rating' => ['required', 'integer', 'between:1,5'],
            'comment' => ['nullable', 'string', 'max:1000'],
        ]);

        // Customer must be the customer linked to the request
        if ((int) $v['customer_id'] !== (int) $maintenanceRequest->customer_id) {
            return back()->withErrors([
                'customer_id' => 'You can only rate your own request.'
            ]);
        }

        Rating::create([
            'maintenance_request_id' => $maintenanceRequest->id,
            'customer_id' => $v['customer_id'],
            'rating' => $v['rating'],
            'comment' => $v['comment'] ?? null,
        ]);

        return back()->with('success', 'Rating saved successfully.');
    }
}