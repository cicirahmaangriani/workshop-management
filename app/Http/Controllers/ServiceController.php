<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceItem;
use App\Models\SparePart;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = \App\Models\Service::paginate(10);
        return view('services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vehicles = \App\Models\Vehicle::all();
        $mechanics = \App\Models\Mechanic::all();
        $spareParts = \App\Models\SparePart::all();
        return view('services.create', compact('vehicles', 'mechanics', 'spareParts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_number' => 'nullable|string|max:20',
            'vehicle_id' => 'required|exists:vehicles,id',
            'mechanic_id' => 'nullable|exists:mechanics,id',
            'service_date' => 'required|date',
            'complaint' => 'nullable|string',
            'diagnosis' => 'nullable|string',
            'action_taken' => 'nullable|string',
            'status' => 'required|string',
            'labor_cost' => 'nullable|numeric',
            'completion_date' => 'nullable|date',
            'total_cost' => 'nullable|numeric',
        ]);
        if (empty($validated['service_number'])) {
            $validated['service_number'] = 'SRV' . now()->format('YmdHis');
        }

        $service = \App\Models\Service::create($validated);

        // handle spare parts if any
        $spareParts = $request->input('spare_parts', []);
        foreach ($spareParts as $part) {
            if (empty($part['spare_part_id']) || empty($part['quantity'])) continue;
            $sparePart = SparePart::find($part['spare_part_id']);
            if (!$sparePart) continue;

            $price = $sparePart->selling_price ?? 0;

            ServiceItem::create([
                'service_id' => $service->id,
                'spare_part_id' => $sparePart->id,
                'quantity' => (int) $part['quantity'],
                'price' => $price,
            ]);

            // decrease stock (if column exists)
            if (isset($sparePart->stock)) {
                $sparePart->decrement('stock', (int) $part['quantity']);
            }
        }

        // calculate totals: sum of spare parts + labor cost
        $partsTotal = ServiceItem::where('service_id', $service->id)->get()->sum(function ($item) {
            return ($item->price ?? 0) * ($item->quantity ?? 0);
        });
        $labor = isset($validated['labor_cost']) ? (float) $validated['labor_cost'] : 0;
        $total = $partsTotal + $labor;
        $service->update(['total_cost' => $total]);
        return redirect()->route('services.index')->with('success', 'Service created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        return view('services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        $vehicles = \App\Models\Vehicle::all();
        $mechanics = \App\Models\Mechanic::all();
        $spareParts = \App\Models\SparePart::all();
        return view('services.edit', compact('service', 'vehicles', 'mechanics', 'spareParts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'mechanic_id' => 'nullable|exists:mechanics,id',
            'service_date' => 'required|date',
            'complaint' => 'nullable|string',
            'diagnosis' => 'nullable|string',
            'action_taken' => 'nullable|string',
            'status' => 'required|string',
            'labor_cost' => 'required|numeric|min:0',
            'estimated_days' => 'nullable|integer|min:0',
            'completion_date' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);
        
        // Calculate total cost
        $partsTotal = $service->serviceItems->sum(function ($item) {
            return ($item->price ?? 0) * ($item->quantity ?? 0);
        });
        $validated['total_cost'] = $partsTotal + ($validated['labor_cost'] ?? 0);
        
        $service->update($validated);
        return redirect()->route('services.show', $service)->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success', 'Service deleted successfully.');
    }
}
