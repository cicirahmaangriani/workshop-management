<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Service - {{ $service->service_number }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('services.update', $service) }}">
                        @csrf
                        @method('PUT')

                        <!-- Service Information -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Service Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="vehicle_id" class="block text-sm font-medium text-gray-700">Vehicle <span class="text-red-500">*</span></label>
                                    <select name="vehicle_id" id="vehicle_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('vehicle_id') border-red-500 @enderror">
                                        <option value="">Select Vehicle</option>
                                        @foreach($vehicles as $vehicle)
                                            <option value="{{ $vehicle->id }}" {{ old('vehicle_id', $service->vehicle_id) == $vehicle->id ? 'selected' : '' }}>
                                                {{ $vehicle->license_plate }} - {{ $vehicle->brand }} {{ $vehicle->model }} ({{ $vehicle->customer->name }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('vehicle_id')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="mechanic_id" class="block text-sm font-medium text-gray-700">Mechanic</label>
                                    <select name="mechanic_id" id="mechanic_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('mechanic_id') border-red-500 @enderror">
                                        <option value="">Select Mechanic</option>
                                        @foreach($mechanics as $mechanic)
                                            <option value="{{ $mechanic->id }}" {{ old('mechanic_id', $service->mechanic_id) == $mechanic->id ? 'selected' : '' }}>
                                                {{ $mechanic->name }} - {{ $mechanic->specialization }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('mechanic_id')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="service_date" class="block text-sm font-medium text-gray-700">Service Date <span class="text-red-500">*</span></label>
                                    <input type="date" name="service_date" id="service_date" value="{{ old('service_date', $service->service_date->format('Y-m-d')) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('service_date') border-red-500 @enderror">
                                    @error('service_date')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700">Status <span class="text-red-500">*</span></label>
                                    <select name="status" id="status" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('status') border-red-500 @enderror">
                                        <option value="pending" {{ old('status', $service->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="in_progress" {{ old('status', $service->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="completed" {{ old('status', $service->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="cancelled" {{ old('status', $service->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                    @error('status')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="labor_cost" class="block text-sm font-medium text-gray-700">Labor Cost <span class="text-red-500">*</span></label>
                                    <input type="number" name="labor_cost" id="labor_cost" value="{{ old('labor_cost', $service->labor_cost) }}" min="0" step="0.01" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('labor_cost') border-red-500 @enderror">
                                    @error('labor_cost')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="estimated_days" class="block text-sm font-medium text-gray-700">Estimated Days</label>
                                    <input type="number" name="estimated_days" id="estimated_days" value="{{ old('estimated_days', $service->estimated_days) }}" min="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>

                                <div>
                                    <label for="completion_date" class="block text-sm font-medium text-gray-700">Completion Date</label>
                                    <input type="date" name="completion_date" id="completion_date" value="{{ old('completion_date', $service->completion_date?->format('Y-m-d')) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>

                                <div class="md:col-span-2">
                                    <label for="complaint" class="block text-sm font-medium text-gray-700">Customer Complaint</label>
                                    <textarea name="complaint" id="complaint" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('complaint', $service->complaint) }}</textarea>
                                </div>

                                <div class="md:col-span-2">
                                    <label for="diagnosis" class="block text-sm font-medium text-gray-700">Diagnosis</label>
                                    <textarea name="diagnosis" id="diagnosis" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('diagnosis', $service->diagnosis) }}</textarea>
                                </div>

                                <div class="md:col-span-2">
                                    <label for="action_taken" class="block text-sm font-medium text-gray-700">Action Taken</label>
                                    <textarea name="action_taken" id="action_taken" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('action_taken', $service->action_taken) }}</textarea>
                                </div>

                                <div class="md:col-span-2">
                                    <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                                    <textarea name="notes" id="notes" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('notes', $service->notes) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Current Spare Parts Used -->
                        @if($service->serviceItems->count() > 0)
                            <div class="mb-8">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Current Spare Parts Used</h3>
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-100">
                                            <tr>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Part Name</th>
                                                <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Qty</th>
                                                <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Price</th>
                                                <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach($service->serviceItems as $item)
                                                <tr>
                                                    <td class="px-4 py-3 text-sm text-gray-900">{{ $item->sparePart->name }}</td>
                                                    <td class="px-4 py-3 text-sm text-gray-900 text-center">{{ $item->quantity }}</td>
                                                    <td class="px-4 py-3 text-sm text-gray-900 text-right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                                    <td class="px-4 py-3 text-sm text-gray-900 text-right">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <p class="text-sm text-gray-500 mt-3">
                                        <strong>Note:</strong> To modify spare parts, please delete this service and create a new one, or manage through service items directly.
                                    </p>
                                </div>
                            </div>
                        @endif

                        <div class="flex justify-end gap-3 pt-6 border-t border-gray-200">
                            <a href="{{ route('services.show', $service) }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                                Cancel
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update Service
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>