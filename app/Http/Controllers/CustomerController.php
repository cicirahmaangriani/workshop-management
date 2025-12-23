<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::query()->with('vehicles');

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('id', $search)
                    ->orWhere('name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $customers = $query->latest()->paginate(10);

        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric|digits_between:10,15',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
        ]);

        Customer::create($validated);

        return redirect()->route('customers.index')
            ->with('success', 'Customer berhasil ditambahkan.');
    }

    public function show(Customer $customer)
    {
        $customer->load(['vehicles', 'services' => function ($query) {
            $query->latest()->limit(10);
        }]);

        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric|digits_between:10,15',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
        ]);

        $customer->update($validated);

        return redirect()->route('customers.index')
            ->with('success', 'Customer berhasil diupdate.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('customers.index')
            ->with('success', 'Customer berhasil dihapus.');
    }
}