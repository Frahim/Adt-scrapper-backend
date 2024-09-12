<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;
use Illuminate\Support\Facades\Auth;

class LeadController extends Controller
{
    public function index()
    {
        $leads = Lead::where('user_id', Auth::id())->get();
        return view('leads.index', compact('leads'));
    }

    public function create()
    {
        return view('leads.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'headline' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        Lead::create([
            'user_id' => Auth::id(),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'headline' => $request->input('headline'),
            'address' => $request->input('address'),
            
        ]);

        return redirect()->route('leads.index')->with('success', 'Lead added successfully.');
    }

    public function import(Request $request)
{
    $request->validate([
        'leads' => 'required|array',
        'leads.*.name' => 'nullable|string|max:255',
        'leads.*.email' => 'nullable|email|max:255',
        'leads.*.phone' => 'nullable|string|max:20',
        'leads.*.headline' => 'nullable|string',
        'leads.*.address' => 'nullable|string',
    ]);

    foreach ($request->input('leads') as $leadData) {
        $leadDataWithUserId = array_merge($leadData, ['user_id' => Auth::id()]);
        Log::info('Importing lead:', $leadDataWithUserId);
        Lead::create($leadDataWithUserId);
    }

    return response()->json(['message' => 'Leads imported successfully.'], 200);
}




}
