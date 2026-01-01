<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Service Details
            </h2>
            <div class="flex gap-2">
                @if($service->status == 'completed' && !$service->invoice)
                    <a href="{{ route('invoices.create') }}?service_id={{ $service->id }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Create Invoice
                    </a>
                @endif
                <a href="{{ route('services.edit', $service) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Edit
                </a>
                <a href="{{ route('services.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                    Back
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Service Information -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Service Information</h3>
                            <p class="text-2xl font-bold text-blue-600 mt-2">{{ $service->service_number }}</p>
                        </div>
                        <span class="px-3 py-2 text-sm rounded-full font-semibold
                            @if($service->status == 'completed') bg-green-100 text-green-800
                            @elseif($service->status == 'in_progress') bg-blue-100 text-blue-800
                            @elseif($service->status == 'cancelled') bg-red-100 text-red-800
                            @else bg-yellow-100 text-yellow-800
                            @endif">
                            {{ ucfirst(str_replace('_', ' ', $service->status)) }}
                        </span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Service Date</p>
                            <p class="mt-1 text-sm text-gray-900">{{ $service->service_date->format('d F Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Mechanic</p>
                            <p class="mt-1 text-sm text-gray-900">{{ $service->mechanic->name ?? '-' }}</p>
                        </div>
                        @if($service->estimated_days)
                            <div>
                                <p class="text-sm font-medium text-gray-500">Estimated Days</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $service->estimated_days }} days</p>
                            </div>
                        @endif
                        @if($service->completion_date)
                            <div>
                                <p class="text-sm font-medium text-gray-500">Completion Date</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $service->completion_date->format('d F Y') }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Vehicle & Customer Information -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Vehicle & Customer Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="text-sm font-semibold text-gray-700 mb-2">Vehicle</h4>
                            <p class="text-sm text-gray-900 font-medium">{{ $service->vehicle->license_plate }}</p>
                            <p class="text-sm text-gray-500">{{ $service->vehicle->brand }} {{ $service->vehicle->model }} ({{ $service->vehicle->year }})</p>
                            <p class="text-sm text-gray-500">{{ $service->vehicle->color }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-gray-700 mb-2">Customer</h4>
                            <p class="text-sm text-gray-900 font-medium">{{ $service->vehicle->customer->name }}</p>
                            <p class="text-sm text-gray-500">{{ $service->vehicle->customer->phone }}</p>
                            <p class="text-sm text-gray-500">{{ $service->vehicle->customer->email }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Service Details -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Service Details</h3>
                    
                    @if($service->complaint)
                        <div class="mb-4">
                            <p class="text-sm font-medium text-gray-500">Customer Complaint</p>
                            <p class="mt-1 text-sm text-gray-900">{{ $service->complaint }}</p>
                        </div>
                    @endif

                    @if($service->diagnosis)
                        <div class="mb-4">
                            <p class="text-sm font-medium text-gray-500">Diagnosis</p>
                            <p class="mt-1 text-sm text-gray-900">{{ $service->diagnosis }}</p>
                        </div>
                    @endif

                    @if($service->action_taken)
                        <div class="mb-4">
                            <p class="text-sm font-medium text-gray-500">Action Taken</p>
                            <p class="mt-1 text-sm text-gray-900">{{ $service->action_taken }}</p>
                        </div>
                    @endif

                    @if($service->notes)
                        <div>
                            <p class="text-sm font-medium text-gray-500">Notes</p>
                            <p class="mt-1 text-sm text-gray-900">{{ $service->notes }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Spare Parts Used -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Spare Parts Used</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Code</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Part Name</th>
                                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Qty</th>
                                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Price</th>
                                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($service->serviceItems as $item)
                                    <tr>
                                        <td class="px-4 py-3 text-sm text-gray-900">{{ $item->sparePart->code }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-900">{{ $item->sparePart->name }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-900 text-center">{{ $item->quantity }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-900 text-right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-900 text-right font-semibold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-4 py-3 text-center text-gray-500">No spare parts used</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Cost Summary -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Cost Summary</h3>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Labor Cost:</span>
                            <span class="text-gray-900 font-medium">Rp {{ number_format($service->labor_cost ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Parts Cost:</span>
                            <span class="text-gray-900 font-medium">Rp {{ number_format($service->parts_cost, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between pt-2 border-t-2 border-gray-900">
                            <span class="text-gray-900 font-bold text-lg">Total Cost:</span>
                            <span class="text-gray-900 font-bold text-lg">Rp {{ number_format($service->total_cost ?? 0, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Invoice Information -->
            @if($service->invoice)
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-blue-900 mb-2">Invoice</h3>
                    <p class="text-sm text-blue-700 mb-3">
                        Invoice {{ $service->invoice->invoice_number }} has been created for this service.
                    </p>
                    <a href="{{ route('invoices.show', $service->invoice) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md">
                        View Invoice
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>