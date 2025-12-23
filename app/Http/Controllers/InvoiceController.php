<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = \App\Models\Invoice::paginate(10);
        return view('invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = \App\Models\Service::all();
        return view('invoices.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'invoice_number' => 'required|string|max:20',
            'service_id' => 'required|exists:services,id',
            'invoice_date' => 'required|date',
            'due_date' => 'required|date',
            'subtotal' => 'required|numeric',
            'tax' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'total' => 'required|numeric',
            'paid' => 'nullable|numeric',
            'payment_status' => 'required|string',
            'payment_method' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);
        \App\Models\Invoice::create($validated);
        return redirect()->route('invoices.index')->with('success', 'Invoice created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        return view('invoices.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        $services = \App\Models\Service::all();
        return view('invoices.edit', compact('invoice', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        $validated = $request->validate([
            'invoice_number' => 'required|string|max:20',
            'service_id' => 'required|exists:services,id',
            'invoice_date' => 'required|date',
            'due_date' => 'required|date',
            'subtotal' => 'required|numeric',
            'tax' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'total' => 'required|numeric',
            'paid' => 'nullable|numeric',
            'payment_status' => 'required|string',
            'payment_method' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);
        $invoice->update($validated);
        return redirect()->route('invoices.index')->with('success', 'Invoice updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('invoices.index')->with('success', 'Invoice deleted successfully.');
    }
}
