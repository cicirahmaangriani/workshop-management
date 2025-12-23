<?php

namespace App\Http\Controllers;

use App\Models\Mechanic;
use Illuminate\Http\Request;

class MechanicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Mechanic::query();

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('id', $search)
                    ->orWhere('name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('specialization', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $mechanics = $query->latest()->paginate(10);
        return view('mechanics.index', compact('mechanics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mechanics.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:15',
            'email' => 'nullable|email|max:100',
            'address' => 'nullable|string|max:255',
            'specialization' => 'nullable|string|max:100',
            'status' => 'required|string',
        ]);
        \App\Models\Mechanic::create($validated);
        return redirect()->route('mechanics.index')->with('success', 'Mechanic created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mechanic $mechanic)
    {
        return view('mechanics.show', compact('mechanic'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mechanic $mechanic)
    {
        return view('mechanics.edit', compact('mechanic'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mechanic $mechanic)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:15',
            'email' => 'nullable|email|max:100',
            'address' => 'nullable|string|max:255',
            'specialization' => 'nullable|string|max:100',
            'status' => 'required|string',
        ]);
        $mechanic->update($validated);
        return redirect()->route('mechanics.index')->with('success', 'Mechanic updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mechanic $mechanic)
    {
        $mechanic->delete();
        return redirect()->route('mechanics.index')->with('success', 'Mechanic deleted successfully.');
    }
}
