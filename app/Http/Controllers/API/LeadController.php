<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeadController extends Controller
{
    // Get all leads for the authenticated user
    public function index()
    {
        $user = Auth::user();
        $leads = $user->leads; // Get leads for the authenticated user

        return response()->json($leads);
    }

    // Import leads from a JSON request
    public function import(Request $request)
    {
        // Validate the incoming JSON data
        $validatedData = $request->validate([
            'leads' => 'required|array',
            'leads.*.name' => 'required|string|max:255',
            'leads.*.email' => 'required|string|email|max:255|unique:leads,email',
            'leads.*.phone' => 'nullable|string|max:20',
            'leads.*.notes' => 'nullable|string',
        ]);

        // Retrieve the authenticated user
        $user = Auth::user();

        // Loop through the leads array and create leads for the user
        foreach ($validatedData['leads'] as $leadData) {
            $user->leads()->create($leadData);
        }

        return response()->json(['message' => 'Leads imported successfully'], 201);
    }
}
