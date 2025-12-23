<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicles = \App\Models\Vehicle::paginate(10);
        return view('vehicles.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = \App\Models\Customer::all();
        return view('vehicles.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'license_plate' => 'required|string|max:20',
            'brand' => 'required|string|max:50',
            'model' => 'required|string|max:50',
            'color' => 'required|string|max:30',
            'year' => 'required|integer',
            'chassis_number' => 'nullable|string|max:50',
            'engine_number' => 'nullable|string|max:50',
        ]);

        $vehicle = \App\Models\Vehicle::create($validated);
        return redirect()->route('vehicles.index')->with('success', 'Vehicle created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle)
    {
        return view('vehicles.show', compact('vehicle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
        $customers = \App\Models\Customer::all();
        return view('vehicles.edit', compact('vehicle', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'license_plate' => 'required|string|max:20',
            'brand' => 'required|string|max:50',
            'model' => 'required|string|max:50',
            'color' => 'required|string|max:30',
            'year' => 'required|integer',
            'chassis_number' => 'nullable|string|max:50',
            'engine_number' => 'nullable|string|max:50',
        ]);
        $vehicle->update($validated);
        return redirect()->route('vehicles.index')->with('success', 'Vehicle updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect()->route('vehicles.index')->with('success', 'Vehicle deleted successfully.');
    }
}
