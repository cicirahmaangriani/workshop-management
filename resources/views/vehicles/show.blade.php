<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Vehicle Details
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('vehicles.edit', $vehicle) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Edit
                </a>
                <a href="{{ route('vehicles.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                    Back
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Vehicle Information -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Vehicle Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm font-medium text-gray-500">License Plate</p>
                            <p class="mt-1 text-lg font-bold text-gray-900">{{ $vehicle->license_plate }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Brand</p>
                            <p class="mt-1 text-sm text-gray-900">{{ $vehicle->brand }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Model</p>
                            <p class="mt-1 text-sm text-gray-900">{{ $vehicle->model }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Year</p>
                            <p class="mt-1 text-sm text-gray-900">{{ $vehicle->year }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Color</p>
                            <p class="mt-1 text-sm text-gray-900">{{ $vehicle->color ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Chassis Number</p>
                            <p class="mt-1 text-sm text-gray-900">{{ $vehicle->chassis_number ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Engine Number</p>
                            <p class="mt-1 text-sm text-gray-900">{{ $vehicle->engine_number ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Owner Information -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Owner Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Name</p>
                            <p class="mt-1 text-sm text-gray-900">{{ $vehicle->customer->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Phone</p>
                            <p class="mt-1 text-sm text-gray-900">{{ $vehicle->customer->phone }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Email</p>
                            <p class="mt-1 text-sm text-gray-900">{{ $vehicle->customer->email ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Address</p>
                            <p class="mt-1 text-sm text-gray-900">{{ $vehicle->customer->address ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('customers.show', $vehicle->customer) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                            View Customer Details →
                        </a>
                    </div>
                </div>
            </div>

            <!-- Service History -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Service History</h3>
                        <a href="{{ route('services.create') }}?vehicle_id={{ $vehicle->id }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm">
                            Add Service
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Service #</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mechanic</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($vehicle->services as $service)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $service->service_number }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $service->service_date->format('d M Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $service->mechanic->name ?? '-' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 py-1 text-xs rounded-full 
                                                @if($service->status == 'completed') bg-green-100 text-green-800
                                                @elseif($service->status == 'in_progress') bg-blue-100 text-blue-800
                                                @elseif($service->status == 'cancelled') bg-red-100 text-red-800
                                                @else bg-yellow-100 text-yellow-800
                                                @endif">
                                                {{ ucfirst($service->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp {{ number_format($service->total_cost, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <a href="{{ route('services.show', $service) }}" class="text-blue-600 hover:text-blue-900">View</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">No service history found</td>
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