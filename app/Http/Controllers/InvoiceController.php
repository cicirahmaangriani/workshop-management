<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Service;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Invoice::with(['service.vehicle.customer']);

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('invoice_number', 'like', "%{$search}%")
                    ->orWhereHas('service.vehicle.customer', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            });
        }

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('payment_status', $request->status);
        }

        $invoices = $query->latest()->paginate(10);
        return view('invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Get completed services without invoices
        $services = Service::with(['vehicle.customer', 'mechanic'])
            ->where('status', 'completed')
            ->doesntHave('invoice')
            ->latest()
            ->get();

        // If service_id is provided in query string, pre-select it
        $selectedServiceId = $request->query('service_id');

        return view('invoices.create', compact('services', 'selectedServiceId'));
    }

    /**
     * Generate unique invoice number
     */
    private function generateInvoiceNumber()
    {
        $date = date('Ymd');
        $prefix = 'INV-' . $date . '-';
        
        // Get the last invoice number for today
        $lastInvoice = Invoice::where('invoice_number', 'like', $prefix . '%')
            ->orderBy('invoice_number', 'desc')
            ->first();
        
        if ($lastInvoice) {
            // Extract the sequence number and increment
            $lastNumber = (int) substr($lastInvoice->invoice_number, -4);
            $newNumber = $lastNumber + 1;
        } else {
            // First invoice of the day
            $newNumber = 1;
        }
        
        // Format: INV-YYYYMMDD-XXXX
        $invoiceNumber = $prefix . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
        
        // Double check uniqueness (in case of race condition)
        $attempts = 0;
        while (Invoice::where('invoice_number', $invoiceNumber)->exists() && $attempts < 10) {
            $newNumber++;
            $invoiceNumber = $prefix . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
            $attempts++;
        }
        
        return $invoiceNumber;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'invoice_date' => 'required|date',
            'due_date' => 'nullable|date|after_or_equal:invoice_date',
            'tax' => 'nullable|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        // Check if service already has invoice
        $existingInvoice = Invoice::where('service_id', $validated['service_id'])->first();
        if ($existingInvoice) {
            return back()
                ->withInput()
                ->withErrors(['service_id' => 'This service already has an invoice: ' . $existingInvoice->invoice_number]);
        }

        // Get service
        $service = Service::findOrFail($validated['service_id']);

        // Calculate totals
        $subtotal = $service->total_cost;
        $tax = $validated['tax'] ?? 0;
        $discount = $validated['discount'] ?? 0;
        $total = $subtotal + $tax - $discount;

        // Generate unique invoice number
        $validated['invoice_number'] = $this->generateInvoiceNumber();
        $validated['subtotal'] = $subtotal;
        $validated['total'] = $total;
        $validated['paid'] = 0;
        $validated['remaining'] = $total;
        $validated['payment_status'] = 'unpaid';

        try {
            $invoice = Invoice::create($validated);

            return redirect()->route('invoices.show', $invoice)
                ->with('success', 'Invoice created successfully.');
        } catch (\Illuminate\Database\QueryException $e) {
            // If still duplicate, try one more time with new number
            if ($e->getCode() == 23000) {
                $validated['invoice_number'] = $this->generateInvoiceNumber();
                $invoice = Invoice::create($validated);
                
                return redirect()->route('invoices.show', $invoice)
                    ->with('success', 'Invoice created successfully.');
            }
            
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        $invoice->load(['service.vehicle.customer', 'service.mechanic', 'service.serviceItems.sparePart']);
        return view('invoices.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        $invoice->load(['service.vehicle.customer', 'service.mechanic']);
        return view('invoices.edit', compact('invoice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        $validated = $request->validate([
            'invoice_date' => 'required|date',
            'due_date' => 'nullable|date|after_or_equal:invoice_date',
            'tax' => 'nullable|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'paid' => 'nullable|numeric|min:0',
            'payment_method' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        // Recalculate totals
        $subtotal = $invoice->service->total_cost;
        $tax = $validated['tax'] ?? 0;
        $discount = $validated['discount'] ?? 0;
        $total = $subtotal + $tax - $discount;
        $paid = $validated['paid'] ?? 0;
        $remaining = $total - $paid;

        // Determine payment status
        if ($paid >= $total) {
            $paymentStatus = 'paid';
            $remaining = 0;
        } elseif ($paid > 0) {
            $paymentStatus = 'partial';
        } else {
            $paymentStatus = 'unpaid';
        }

        $validated['subtotal'] = $subtotal;
        $validated['total'] = $total;
        $validated['remaining'] = $remaining;
        $validated['payment_status'] = $paymentStatus;

        $invoice->update($validated);

        return redirect()->route('invoices.show', $invoice)
            ->with('success', 'Invoice updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('invoices.index')
            ->with('success', 'Invoice deleted successfully.');
    }

    /**
     * Download invoice as PDF (Optional - requires dompdf)
     */
    public function download(Invoice $invoice)
    {
        $invoice->load(['service.vehicle.customer', 'service.mechanic', 'service.serviceItems.sparePart']);
        
        // If dompdf is installed
        if (class_exists('Barryvdh\DomPDF\Facade\Pdf')) {
            $pdf = Pdf::loadView('invoices.pdf', compact('invoice'));
            return $pdf->download('Invoice-' . $invoice->invoice_number . '.pdf');
        }
        
        // Fallback: redirect to print
        return redirect()->route('invoices.show', $invoice)
            ->with('info', 'Please use Print button to save as PDF.');
    }
}