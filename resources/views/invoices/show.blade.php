<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Invoice Details
            </h2>
            <div class="flex gap-2">
                <button onclick="window.print()" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Print
                </button>
                <a href="{{ route('invoices.edit', $invoice) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Edit
                </a>
                <a href="{{ route('invoices.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                    Back
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8" id="invoice-content">
                <!-- Invoice Header -->
                <div class="border-b pb-6 mb-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">INVOICE</h1>
                            <p class="text-gray-600 mt-2">{{ $invoice->invoice_number }}</p>
                        </div>
                        <div class="text-right">
                            <h2 class="text-2xl font-bold text-gray-900">Workshop Name</h2>
                            <p class="text-gray-600 mt-2">
                                Jl. Workshop No. 123<br>
                                Jakarta, Indonesia<br>
                                Phone: +62 21 1234 5678<br>
                                Email: info@workshop.com
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Customer & Invoice Info -->
                <div class="grid grid-cols-2 gap-8 mb-8">
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 uppercase mb-2">Bill To</h3>
                        <div class="text-gray-900">
                            <p class="font-semibold text-lg">{{ $invoice->service->vehicle->customer->name }}</p>
                            <p class="text-gray-600 mt-1">{{ $invoice->service->vehicle->customer->phone }}</p>
                            @if($invoice->service->vehicle->customer->email)
                                <p class="text-gray-600">{{ $invoice->service->vehicle->customer->email }}</p>
                            @endif
                            @if($invoice->service->vehicle->customer->address)
                                <p class="text-gray-600 mt-1">{{ $invoice->service->vehicle->customer->address }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="text-right">
                        <div class="mb-4">
                            <p class="text-sm text-gray-500">Invoice Date</p>
                            <p class="text-gray-900 font-semibold">{{ $invoice->invoice_date->format('d F Y') }}</p>
                        </div>
                        @if($invoice->due_date)
                            <div class="mb-4">
                                <p class="text-sm text-gray-500">Due Date</p>
                                <p class="text-gray-900 font-semibold">{{ $invoice->due_date->format('d F Y') }}</p>
                            </div>
                        @endif
                        <div>
                            <p class="text-sm text-gray-500">Payment Status</p>
                            <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full mt-1
                                @if($invoice->payment_status == 'paid') bg-green-100 text-green-800
                                @elseif($invoice->payment_status == 'partial') bg-yellow-100 text-yellow-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst($invoice->payment_status) }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Vehicle Info -->
                <div class="bg-gray-50 p-4 rounded-lg mb-8">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase mb-2">Vehicle Information</h3>
                    <div class="grid grid-cols-2 gap-4 text-gray-900">
                        <div>
                            <p class="text-sm text-gray-500">License Plate</p>
                            <p class="font-semibold">{{ $invoice->service->vehicle->license_plate }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Vehicle</p>
                            <p class="font-semibold">{{ $invoice->service->vehicle->brand }} {{ $invoice->service->vehicle->model }} ({{ $invoice->service->vehicle->year }})</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Service Number</p>
                            <p class="font-semibold">{{ $invoice->service->service_number }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Service Date</p>
                            <p class="font-semibold">{{ $invoice->service->service_date->format('d F Y') }}</p>
                        </div>
                        @if($invoice->service->mechanic)
                            <div>
                                <p class="text-sm text-gray-500">Mechanic</p>
                                <p class="font-semibold">{{ $invoice->service->mechanic->name }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Service Description -->
                @if($invoice->service->complaint || $invoice->service->action_taken)
                    <div class="mb-8">
                        <h3 class="text-sm font-semibold text-gray-500 uppercase mb-2">Service Description</h3>
                        @if($invoice->service->complaint)
                            <div class="mb-2">
                                <p class="text-sm text-gray-500">Complaint:</p>
                                <p class="text-gray-900">{{ $invoice->service->complaint }}</p>
                            </div>
                        @endif
                        @if($invoice->service->action_taken)
                            <div>
                                <p class="text-sm text-gray-500">Action Taken:</p>
                                <p class="text-gray-900">{{ $invoice->service->action_taken }}</p>
                            </div>
                        @endif
                    </div>
                @endif

                <!-- Items Table -->
                <div class="mb-8">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Item</th>
                                <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Qty</th>
                                <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Price</th>
                                <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <!-- Labor Cost -->
                            <tr>
                                <td class="px-4 py-3 text-gray-900">Labor Cost</td>
                                <td class="px-4 py-3 text-center text-gray-900">1</td>
                                <td class="px-4 py-3 text-right text-gray-900">Rp {{ number_format($invoice->service->labor_cost, 0, ',', '.') }}</td>
                                <td class="px-4 py-3 text-right text-gray-900">Rp {{ number_format($invoice->service->labor_cost, 0, ',', '.') }}</td>
                            </tr>

                            <!-- Spare Parts -->
                            @foreach($invoice->service->serviceItems as $item)
                                <tr>
                                    <td class="px-4 py-3 text-gray-900">
                                        {{ $item->sparePart->name }}
                                        <span class="text-xs text-gray-500">({{ $item->sparePart->code }})</span>
                                    </td>
                                    <td class="px-4 py-3 text-center text-gray-900">{{ $item->quantity }}</td>
                                    <td class="px-4 py-3 text-right text-gray-900">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3 text-right text-gray-900">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Totals -->
                <div class="flex justify-end mb-8">
                    <div class="w-64">
                        <div class="flex justify-between py-2 border-b">
                            <span class="text-gray-600">Subtotal:</span>
                            <span class="text-gray-900 font-semibold">Rp {{ number_format($invoice->subtotal, 0, ',', '.') }}</span>
                        </div>
                        
                        @if($invoice->tax > 0)
                            <div class="flex justify-between py-2 border-b">
                                <span class="text-gray-600">Tax:</span>
                                <span class="text-gray-900 font-semibold">Rp {{ number_format($invoice->tax, 0, ',', '.') }}</span>
                            </div>
                        @endif

                        @if($invoice->discount > 0)
                            <div class="flex justify-between py-2 border-b">
                                <span class="text-gray-600">Discount:</span>
                                <span class="text-red-600 font-semibold">- Rp {{ number_format($invoice->discount, 0, ',', '.') }}</span>
                            </div>
                        @endif

                        <div class="flex justify-between py-3 border-b-2 border-gray-900">
                            <span class="text-gray-900 font-bold text-lg">Total:</span>
                            <span class="text-gray-900 font-bold text-lg">Rp {{ number_format($invoice->total, 0, ',', '.') }}</span>
                        </div>

                        @if($invoice->paid > 0)
                            <div class="flex justify-between py-2 border-b">
                                <span class="text-gray-600">Paid:</span>
                                <span class="text-green-600 font-semibold">Rp {{ number_format($invoice->paid, 0, ',', '.') }}</span>
                            </div>

                            <div class="flex justify-between py-2">
                                <span class="text-gray-600 font-semibold">Balance Due:</span>
                                <span class="text-red-600 font-bold">Rp {{ number_format($invoice->remaining, 0, ',', '.') }}</span>
                            </div>
                        @endif

                        @if($invoice->payment_method)
                            <div class="flex justify-between py-2 border-t mt-2 pt-2">
                                <span class="text-gray-600">Payment Method:</span>
                                <span class="text-gray-900 font-semibold">{{ ucfirst(str_replace('_', ' ', $invoice->payment_method)) }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Notes -->
                @if($invoice->notes)
                    <div class="border-t pt-6">
                        <h3 class="text-sm font-semibold text-gray-500 uppercase mb-2">Notes</h3>
                        <p class="text-gray-900">{{ $invoice->notes }}</p>
                    </div>
                @endif

                <!-- Footer -->
                <div class="border-t pt-6 mt-8 text-center text-gray-500 text-sm">
                    <p>Thank you for your business!</p>
                    <p class="mt-2">This is a computer-generated invoice and does not require a signature.</p>
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
            }
            nav, header, .no-print {
                display: none !important;
            }
        }
    </style>
    @endpush
</x-app-layout>