<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Spare Part Details
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('spare-parts.edit', $sparePart) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Edit
                </a>
                <a href="{{ route('spare-parts.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                    Back
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Spare Part Information -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Spare Part Information</h3>
                            <p class="text-2xl font-bold text-blue-600 mt-2">{{ $sparePart->code }}</p>
                        </div>
                        @if($sparePart->is_low_stock)
                            <span class="px-3 py-2 text-sm rounded-full font-semibold bg-red-100 text-red-800">
                                ⚠️ Low Stock
                            </span>
                        @else
                            <span class="px-3 py-2 text-sm rounded-full font-semibold bg-green-100 text-green-800">
                                ✓ In Stock
                            </span>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Part Name</p>
                            <p class="mt-1 text-sm text-gray-900 font-semibold">{{ $sparePart->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Category</p>
                            <p class="mt-1 text-sm text-gray-900">{{ $sparePart->category ?? '-' }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-sm font-medium text-gray-500">Description</p>
                            <p class="mt-1 text-sm text-gray-900">{{ $sparePart->description ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pricing & Stock Information -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <p class="text-sm font-medium text-gray-500 mb-2">Purchase Price</p>
                        <p class="text-xl font-bold text-gray-900">Rp {{ number_format($sparePart->purchase_price, 0, ',', '.') }}</p>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <p class="text-sm font-medium text-gray-500 mb-2">Selling Price</p>
                        <p class="text-xl font-bold text-green-600">Rp {{ number_format($sparePart->selling_price, 0, ',', '.') }}</p>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <p class="text-sm font-medium text-gray-500 mb-2">Current Stock</p>
                        <p class="text-xl font-bold {{ $sparePart->is_low_stock ? 'text-red-600' : 'text-gray-900' }}">{{ $sparePart->stock }} pcs</p>
                        <p class="text-xs text-gray-500 mt-1">Min: {{ $sparePart->min_stock }} pcs</p>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <p class="text-sm font-medium text-gray-500 mb-2">Profit Margin</p>
                        <p class="text-xl font-bold text-blue-600">
                            {{ number_format((($sparePart->selling_price - $sparePart->purchase_price) / $sparePart->purchase_price) * 100, 1) }}%
                        </p>
                        <p class="text-xs text-gray-500 mt-1">Rp {{ number_format($sparePart->selling_price - $sparePart->purchase_price, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            <!-- Usage Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Times Used</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $sparePart->serviceItems->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-purple-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Quantity Used</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $sparePart->serviceItems->sum('quantity') }} pcs</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Revenue</p>
                                <p class="text-2xl font-semibold text-gray-900">Rp {{ number_format($sparePart->serviceItems->sum('subtotal'), 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Usage History -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Usage History</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Service #</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Customer</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Vehicle</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Qty</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Price</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($sparePart->serviceItems()->with('service.vehicle.customer')->latest()->get() as $item)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item->service->service_number }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->service->service_date->format('d M Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->service->vehicle->customer->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->service->vehicle->license_plate }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">{{ $item->quantity }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-right">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <a href="{{ route('services.show', $item->service) }}" class="text-blue-600 hover:text-blue-900">View Service</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-6 py-4 text-center text-gray-500">No usage history found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>