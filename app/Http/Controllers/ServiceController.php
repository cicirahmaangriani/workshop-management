<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Vehicle;
use App\Models\Mechanic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Service::with(['vehicle.customer', 'mechanic']);

        // If user is mechanic, only show services assigned to them
        if (Auth::user()->role === 'mechanic') {
            // Find mechanic profile linked to this user
            $mechanic = Mechanic::where('user_id', Auth::id())->first();
            
            if ($mechanic) {
                $query->where('mechanic_id', $mechanic->id);
            } else {
                // If mechanic profile not found or not linked, show nothing
                $query->whereRaw('1 = 0'); // Return empty result
            }
        }

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('service_number', 'like', "%{$search}%")
                  ->orWhere('complaint', 'like', "%{$search}%")
                  ->orWhereHas('vehicle', function($q) use ($search) {
                      $q->where('license_plate', 'like', "%{$search}%");
                  })
                  ->orWhereHas('vehicle.customer', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $services = $query->latest()->paginate(10);
        
        return view('services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Only admin and receptionist can create services
        if (Auth::user()->role === 'mechanic') {
            abort(403, 'Unauthorized action.');
        }

        $vehicles = Vehicle::with('customer')->get();
        $mechanics = Mechanic::all();
        $spareParts = \App\Models\SparePart::where('stock', '>', 0)->orderBy('name')->get();
        return view('services.create', compact('vehicles', 'mechanics', 'spareParts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Only admin and receptionist can create services
        if (Auth::user()->role === 'mechanic') {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'mechanic_id' => 'nullable|exists:mechanics,id',
            'service_date' => 'required|date',
            'complaint' => 'required|string',
            'diagnosis' => 'nullable|string',
            'action_taken' => 'nullable|string',
            'labor_cost' => 'required|numeric|min:0',
            'status' => 'required|in:pending,in_progress,completed',
            'completion_date' => 'nullable|date',
            'notes' => 'nullable|string',
            'spare_parts' => 'nullable|array',
            'spare_parts.*.spare_part_id' => 'required|exists:spare_parts,id',
            'spare_parts.*.quantity' => 'required|integer|min:1',
        ]);

        // Generate service number
        $validated['service_number'] = $this->generateServiceNumber();

        $service = Service::create($validated);

        // Handle spare parts if provided
        if ($request->has('spare_parts') && is_array($request->spare_parts)) {
            foreach ($request->spare_parts as $item) {
                if (!empty($item['spare_part_id'])) {
                    $sparePart = \App\Models\SparePart::find($item['spare_part_id']);
                    if ($sparePart) {
                        $quantity = $item['quantity'];
                        $price = $sparePart->selling_price; // Get selling price from database
                        $subtotal = $quantity * $price;
                        
                        $service->serviceItems()->create([
                            'spare_part_id' => $item['spare_part_id'],
                            'quantity' => $quantity,
                            'price' => $price,
                            'subtotal' => $subtotal,
                        ]);
                    }
                }
            }
            
            // Calculate total cost
            $service->calculateTotalCost();
        }

        return redirect()->route('services.show', $service)
            ->with('success', 'Service created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        // If mechanic, check if this service is assigned to them
        if (Auth::user()->role === 'mechanic') {
            $mechanic = Mechanic::where('user_id', Auth::id())->first();
            
            if (!$mechanic || $service->mechanic_id !== $mechanic->id) {
                abort(403, 'You can only view services assigned to you.');
            }
        }

        $service->load(['vehicle.customer', 'mechanic', 'serviceItems.sparePart', 'invoice']);
        return view('services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        // CRITICAL: Check mechanic authorization
        if (Auth::user()->role === 'mechanic') {
            $mechanic = Mechanic::where('user_id', Auth::id())->first();
            
            // Debug log
            \Log::info('=== MECHANIC EDIT AUTHORIZATION ===', [
                'user_id' => Auth::id(),
                'user_email' => Auth::user()->email,
                'user_role' => Auth::user()->role,
                'mechanic_found' => $mechanic ? 'YES' : 'NO',
                'mechanic_id' => $mechanic ? $mechanic->id : null,
                'service_id' => $service->id,
                'service_mechanic_id' => $service->mechanic_id,
                'ids_match' => ($mechanic && $service->mechanic_id === $mechanic->id) ? 'YES' : 'NO'
            ]);
            
            // Allow edit ONLY if mechanic is assigned to this service
            if (!$mechanic) {
                \Log::warning('Mechanic profile not found for user', ['user_id' => Auth::id()]);
                abort(403, 'Mechanic profile not found. Please contact administrator.');
            }
            
            if ($service->mechanic_id !== $mechanic->id) {
                \Log::warning('Mechanic trying to access unauthorized service', [
                    'mechanic_id' => $mechanic->id,
                    'service_mechanic_id' => $service->mechanic_id
                ]);
                abort(403, 'You can only edit services assigned to you.');
            }
            
            \Log::info('Mechanic authorization PASSED');
        }

        $vehicles = Vehicle::with('customer')->get();
        $mechanics = Mechanic::all();
        $spareParts = \App\Models\SparePart::where('stock', '>', 0)->orderBy('name')->get();
        return view('services.edit', compact('service', 'vehicles', 'mechanics', 'spareParts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        // Mechanic can only update specific fields
        if (Auth::user()->role === 'mechanic') {
            $mechanic = Mechanic::where('user_id', Auth::id())->first();
            
            if (!$mechanic || $service->mechanic_id !== $mechanic->id) {
                abort(403, 'You can only update services assigned to you.');
            }

            // Mechanic can only update these fields
            $validated = $request->validate([
                'diagnosis' => 'nullable|string',
                'action_taken' => 'nullable|string',
                'status' => 'required|in:pending,in_progress,completed',
                'completion_date' => 'nullable|date',
                'notes' => 'nullable|string',
                'spare_parts' => 'nullable|array',
                'spare_parts.*.spare_part_id' => 'required|exists:spare_parts,id',
                'spare_parts.*.quantity' => 'required|integer|min:1',
            ]);
        } else {
            // Admin and Receptionist can update all fields
            $validated = $request->validate([
                'vehicle_id' => 'required|exists:vehicles,id',
                'mechanic_id' => 'nullable|exists:mechanics,id',
                'service_date' => 'required|date',
                'complaint' => 'nullable|string',
                'diagnosis' => 'nullable|string',
                'action_taken' => 'nullable|string',
                'labor_cost' => 'required|numeric|min:0',
                'status' => 'required|in:pending,in_progress,completed',
                'completion_date' => 'nullable|date',
                'notes' => 'nullable|string',
                'spare_parts' => 'nullable|array',
                'spare_parts.*.spare_part_id' => 'required|exists:spare_parts,id',
                'spare_parts.*.quantity' => 'required|integer|min:1',
            ]);
        }

        // Update service fields
        $service->update($validated);

        // Handle spare parts if provided
        if ($request->has('spare_parts') && is_array($request->spare_parts)) {
            // Delete old service items
            $service->serviceItems()->delete();
            
            // Create new service items
            foreach ($request->spare_parts as $item) {
                if (!empty($item['spare_part_id'])) {
                    $sparePart = \App\Models\SparePart::find($item['spare_part_id']);
                    if ($sparePart) {
                        $quantity = $item['quantity'];
                        $price = $sparePart->selling_price; // Get selling price from database
                        $subtotal = $quantity * $price;
                        
                        $service->serviceItems()->create([
                            'spare_part_id' => $item['spare_part_id'],
                            'quantity' => $quantity,
                            'price' => $price,
                            'subtotal' => $subtotal,
                        ]);
                    }
                }
            }
            
            // Recalculate total cost
            $service->calculateTotalCost();
        }

        return redirect()->route('services.show', $service)
            ->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        // Only admin can delete
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        // Check if service has invoice
        if ($service->invoice) {
            return back()->with('error', 'Cannot delete service with existing invoice.');
        }

        $service->delete();

        return redirect()->route('services.index')
            ->with('success', 'Service deleted successfully.');
    }

    /**
     * Generate unique service number
     */
    private function generateServiceNumber()
    {
        $date = date('Ymd');
        $prefix = 'SRV' . $date;
        
        $lastService = Service::where('service_number', 'like', $prefix . '%')
            ->orderBy('service_number', 'desc')
            ->first();
        
        if ($lastService) {
            $lastNumber = (int) substr($lastService->service_number, -6);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        
        return $prefix . str_pad($newNumber, 6, '0', STR_PAD_LEFT);
    }
}