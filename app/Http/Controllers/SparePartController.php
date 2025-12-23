<?php

namespace App\Http\Controllers;

use App\Models\SparePart;
use Illuminate\Http\Request;

class SparePartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $spareParts = \App\Models\SparePart::paginate(10);
        return view('spare_parts.index', compact('spareParts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('spare_parts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'category' => 'required|string|max:50',
            'description' => 'nullable|string',
            'purchase_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'stock' => 'required|integer',
            'min_stock' => 'required|integer',
        ]);
        $validated['code'] = 'SP' . time();
        \App\Models\SparePart::create($validated);
        return redirect()->route('spare-parts.index')->with('success', 'Spare part created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SparePart $sparePart)
    {
        return view('spare_parts.show', compact('sparePart'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SparePart $sparePart)
    {
        return view('spare_parts.edit', compact('sparePart'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SparePart $sparePart)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:20',
            'name' => 'required|string|max:100',
            'category' => 'required|string|max:50',
            'description' => 'nullable|string',
            'purchase_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'stock' => 'required|integer',
            'min_stock' => 'required|integer',
        ]);
        $sparePart->update($validated);
        return redirect()->route('spare-parts.index')->with('success', 'Spare part updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SparePart $sparePart)
    {
        $sparePart->delete();
        return redirect()->route('spare-parts.index')->with('success', 'Spare part deleted successfully.');
    }
}
