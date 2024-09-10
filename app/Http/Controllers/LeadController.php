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
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'notes' => 'nullable|string',
        ]);

        Lead::create([
            'user_id' => Auth::id(),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'notes' => $request->input('notes'),
        ]);

        return redirect()->route('leads.index')->with('success', 'Lead added successfully.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:json',
        ]);

        $path = $request->file('file')->getRealPath();
        $data = json_decode(file_get_contents($path), true);

        foreach ($data as $leadData) {
            Lead::create(array_merge($leadData, ['user_id' => Auth::id()]));
        }

        return redirect()->route('leads.index')->with('success', 'Leads imported successfully.');
    }
}
