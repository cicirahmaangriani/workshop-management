<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center no-print">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Invoice Details
            </h2>
            <div class="flex gap-2">
                <!-- Print Button -->
                <button onclick="window.print()" class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-bold py-2.5 px-5 rounded-lg inline-flex items-center shadow-lg transform hover:scale-105 transition-all duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                    </svg>
                    Print Invoice
                </button>
                <a href="{{ route('invoices.edit', $invoice) }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2.5 px-4 rounded-lg inline-flex items-center transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit
                </a>
                <a href="{{ route('invoices.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2.5 px-4 rounded-lg transition-colors duration-200">
                    Back
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Invoice Container -->
            <div class="bg-white shadow-xl" id="invoice-content" style="max-width: 210mm; margin: 0 auto;">
                
                <!-- Header Section -->
                <div class="px-8 py-6 border-b-2 border-gray-200">
                    <div class="flex justify-between items-start">
                        <!-- Company Info -->
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800 mb-1">Workshop Name</h1>
                            <p class="text-sm text-gray-600">Rent Car</p>
                            <p class="text-sm text-gray-600">456 Maple Ave</p>
                            <p class="text-sm text-gray-600">Instagram: @workshop.id</p>
                        </div>
                        
                        <!-- Invoice Badge -->
                        <div class="text-right">
                            <div class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg">
                                <h2 class="text-2xl font-bold">INVOICE</h2>
                            </div>
                            <div class="mt-3 text-sm">
                                <p class="text-gray-600"><span class="font-semibold">Invoice Number:</span> {{ $invoice->invoice_number }}</p>
                                <p class="text-gray-600"><span class="font-semibold">Date:</span> {{ $invoice->invoice_date->format('d/m/Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bill From / Bill To Section -->
                <div class="px-8 py-6 bg-gray-50">
                    <div class="grid grid-cols-2 gap-8">
                        <!-- Bill From -->
                        <div>
                            <div class="border-l-4 border-gray-400 pl-4">
                                <h3 class="text-sm font-bold text-gray-700 uppercase mb-3">Bill From:</h3>
                                <p class="text-sm text-gray-800 font-semibold">Workshop Name</p>
                                <p class="text-sm text-gray-600">456 Maple Ave</p>
                                <p class="text-sm text-gray-600">0987654321</p>
                            </div>
                        </div>
                        
                        <!-- Bill To -->
                        <div>
                            <div class="border-l-4 border-gray-400 pl-4">
                                <h3 class="text-sm font-bold text-gray-700 uppercase mb-3">Bill To:</h3>
                                <p class="text-sm text-gray-800 font-semibold">{{ $invoice->service->vehicle->customer->name }}</p>
                                <p class="text-sm text-gray-600">{{ $invoice->service->vehicle->customer->address ?? '123 Elm Street' }}</p>
                                <p class="text-sm text-gray-600">{{ $invoice->service->vehicle->customer->phone }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Items Table -->
                <div class="px-8 py-6">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b-2 border-gray-300">
                                <th class="text-left py-3 text-sm font-bold text-gray-700 uppercase">Item</th>
                                <th class="text-center py-3 text-sm font-bold text-gray-700 uppercase w-24">Quantity</th>
                                <th class="text-right py-3 text-sm font-bold text-gray-700 uppercase w-32">Rate</th>
                                <th class="text-right py-3 text-sm font-bold text-gray-700 uppercase w-24">Tax</th>
                                <th class="text-right py-3 text-sm font-bold text-gray-700 uppercase w-32">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Labor Cost -->
                            <tr class="border-b border-gray-200">
                                <td class="py-4 text-sm text-gray-800">Labor Cost / Service Fee</td>
                                <td class="py-4 text-center text-sm text-gray-800">1</td>
                                <td class="py-4 text-right text-sm text-gray-800">Rp {{ number_format($invoice->service->labor_cost, 2, '.', ',') }}</td>
                                <td class="py-4 text-right text-sm text-gray-800">Rp 0.00</td>
                                <td class="py-4 text-right text-sm font-semibold text-gray-900">Rp {{ number_format($invoice->service->labor_cost, 2, '.', ',') }}</td>
                            </tr>
                            
                            <!-- Spare Parts -->
                            @foreach($invoice->service->serviceItems as $item)
                            <tr class="border-b border-gray-200">
                                <td class="py-4 text-sm text-gray-800">{{ $item->sparePart->name }}</td>
                                <td class="py-4 text-center text-sm text-gray-800">{{ $item->quantity }}</td>
                                <td class="py-4 text-right text-sm text-gray-800">Rp {{ number_format($item->price, 2, '.', ',') }}</td>
                                <td class="py-4 text-right text-sm text-gray-800">Rp 0.00</td>
                                <td class="py-4 text-right text-sm font-semibold text-gray-900">Rp {{ number_format($item->subtotal, 2, '.', ',') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Totals Section -->
                <div class="px-8 pb-6">
                    <div class="flex justify-end">
                        <div class="w-96">
                            <!-- Subtotal -->
                            <div class="flex justify-between py-2 text-sm">
                                <span class="font-semibold text-gray-700">Subtotal:</span>
                                <span class="text-gray-900">Rp {{ number_format($invoice->subtotal, 2, '.', ',') }}</span>
                            </div>
                            
                            <!-- Discount -->
                            <div class="flex justify-between py-2 text-sm">
                                <span class="font-semibold text-gray-700">Discount:</span>
                                <span class="text-gray-900">Rp {{ number_format($invoice->discount, 2, '.', ',') }}</span>
                            </div>
                            
                            <!-- Tax -->
                            <div class="flex justify-between py-2 text-sm">
                                <span class="font-semibold text-gray-700">Tax:</span>
                                <span class="text-gray-900">Rp {{ number_format($invoice->tax, 2, '.', ',') }}</span>
                            </div>
                            
                            <!-- Paid -->
                            <div class="flex justify-between py-2 text-sm">
                                <span class="font-semibold text-gray-700">Paid:</span>
                                <span class="text-gray-900">Rp {{ number_format($invoice->paid, 2, '.', ',') }}</span>
                            </div>
                            
                            <!-- Total -->
                            <div class="mt-2">
                                <div class="bg-blue-600 text-white px-4 py-3 rounded-lg flex justify-between items-center">
                                    <span class="text-lg font-bold">Total</span>
                                    <span class="text-xl font-bold">Rp {{ number_format($invoice->total, 2, '.', ',') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="px-8 py-4 bg-gray-50 border-t border-gray-200">
                    <p class="text-center text-sm text-gray-600">
                        Thank you for your business. Payment is due within 30 days.
                    </p>
                </div>

            </div>
        </div>
    </div>

    @push('styles')
    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            #invoice-content, #invoice-content * {
                visibility: visible;
            }
            #invoice-content {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                box-shadow: none !important;
            }
            .no-print {
                display: none !important;
            }
            nav, header, footer {
                display: none !important;
            }
            @page {
                size: A4;
                margin: 10mm;
            }
        }
    </style>
    @endpush
</x-app-layout>