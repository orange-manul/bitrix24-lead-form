<?php

namespace App\Http\Controllers;

use App\Jobs\CreateLeadJob;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function create()
    {
        return view('leads.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validated([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20'
            ]);

        CreateLeadJob::dispatch($validated);
    }
}
