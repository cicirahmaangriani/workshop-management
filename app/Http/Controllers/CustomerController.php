<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Customer::query();

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $customers = $query->withCount('vehicles')->latest()->paginate(10);
        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
        ], [
            'name.required' => 'Customer name is required',
            'phone.required' => 'Phone number is required',
            'email.email' => 'Please enter a valid email address',
        ]);

        // Check for duplicate (name + phone combination)
        $exists = Customer::where('name', $validated['name'])
                         ->where('phone', $validated['phone'])
                         ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors(['name' => 'A customer with this name and phone number already exists.']);
        }

        Customer::create($validated);

        return redirect()->route('customers.index')
            ->with('success', 'Customer created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        $customer->load('vehicles');
        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
        ], [
            'name.required' => 'Customer name is required',
            'phone.required' => 'Phone number is required',
            'email.email' => 'Please enter a valid email address',
        ]);

        // Check for duplicate (exclude current customer)
        $exists = Customer::where('name', $validated['name'])
                         ->where('phone', $validated['phone'])
                         ->where('id', '!=', $customer->id)
                         ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors(['name' => 'A customer with this name and phone number already exists.']);
        }

        $customer->update($validated);

        return redirect()->route('customers.show', $customer)
            ->with('success', 'Customer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        // Check if customer has vehicles
        if ($customer->vehicles()->count() > 0) {
            return back()->with('error', 'Cannot delete customer with existing vehicles. Please delete or reassign vehicles first.');
        }

        $customer->delete();

        return redirect()->route('customers.index')
            ->with('success', 'Customer deleted successfully.');
    }
}