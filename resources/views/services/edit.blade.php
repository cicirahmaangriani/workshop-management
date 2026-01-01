<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Service
            </h2>
            <span class="text-sm text-gray-600">Service #{{ $service->service_number }}</span>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if(auth()->user()->role === 'mechanic')
                        <!-- Note for Mechanic -->
                        <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-blue-700">
                                        As a mechanic, you can update: <strong>Diagnosis, Action Taken, Status, Completion Date, Notes, and Spare Parts</strong>.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('services.update', $service) }}">
                        @csrf
                        @method('PUT')

                        @if(auth()->user()->role !== 'mechanic')
                            <!-- Service Information (Admin/Receptionist Only) -->
                            <div class="mb-8">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b">Service Information</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="vehicle_id" class="block text-sm font-medium text-gray-700 mb-2">
                                            Vehicle <span class="text-red-500">*</span>
                                        </label>
                                        <select name="vehicle_id" id="vehicle_id" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('vehicle_id') border-red-500 @enderror">
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
                                        <label for="mechanic_id" class="block text-sm font-medium text-gray-700 mb-2">
                                            Assign Mechanic
                                        </label>
                                        <select name="mechanic_id" id="mechanic_id" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('mechanic_id') border-red-500 @enderror">
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
                                        <label for="service_date" class="block text-sm font-medium text-gray-700 mb-2">
                                            Service Date <span class="text-red-500">*</span>
                                        </label>
                                        <input type="date" name="service_date" id="service_date" value="{{ old('service_date', $service->service_date->format('Y-m-d')) }}" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('service_date') border-red-500 @enderror">
                                        @error('service_date')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                            Status <span class="text-red-500">*</span>
                                        </label>
                                        <select name="status" id="status" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('status') border-red-500 @enderror">
                                            <option value="pending" {{ old('status', $service->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="in_progress" {{ old('status', $service->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                            <option value="completed" {{ old('status', $service->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                        </select>
                                        @error('status')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="labor_cost" class="block text-sm font-medium text-gray-700 mb-2">
                                            Labor Cost <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">Rp</span>
                                            <input type="number" name="labor_cost" id="labor_cost" value="{{ old('labor_cost', $service->labor_cost) }}" min="0" step="1000" required class="block w-full pl-10 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('labor_cost') border-red-500 @enderror">
                                        </div>
                                        @error('labor_cost')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="completion_date" class="block text-sm font-medium text-gray-700 mb-2">
                                            Completion Date
                                        </label>
                                        <input type="date" name="completion_date" id="completion_date" value="{{ old('completion_date', $service->completion_date?->format('Y-m-d')) }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('completion_date') border-red-500 @enderror">
                                        @error('completion_date')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="md:col-span-2">
                                        <label for="complaint" class="block text-sm font-medium text-gray-700 mb-2">
                                            Customer Complaint <span class="text-red-500">*</span>
                                        </label>
                                        <textarea name="complaint" id="complaint" rows="3" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('complaint') border-red-500 @enderror">{{ old('complaint', $service->complaint) }}</textarea>
                                        @error('complaint')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Work Details (All Roles) -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b">Work Details</h3>
                            <div class="grid grid-cols-1 gap-6">
                                @if(auth()->user()->role === 'mechanic')
                                    <!-- Status and Completion for Mechanic -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                                Status <span class="text-red-500">*</span>
                                            </label>
                                            <select name="status" id="status" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                                <option value="pending" {{ old('status', $service->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="in_progress" {{ old('status', $service->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                                <option value="completed" {{ old('status', $service->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                            </select>
                                        </div>

                                        <div>
                                            <label for="completion_date" class="block text-sm font-medium text-gray-700 mb-2">
                                                Completion Date
                                            </label>
                                            <input type="date" name="completion_date" id="completion_date" value="{{ old('completion_date', $service->completion_date?->format('Y-m-d')) }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                        </div>
                                    </div>
                                @endif

                                <div>
                                    <label for="diagnosis" class="block text-sm font-medium text-gray-700 mb-2">
                                        Diagnosis
                                    </label>
                                    <textarea name="diagnosis" id="diagnosis" rows="3" placeholder="Enter diagnosis findings..." class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('diagnosis') border-red-500 @enderror">{{ old('diagnosis', $service->diagnosis) }}</textarea>
                                    @error('diagnosis')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="action_taken" class="block text-sm font-medium text-gray-700 mb-2">
                                        Action Taken
                                    </label>
                                    <textarea name="action_taken" id="action_taken" rows="3" placeholder="Describe actions performed..." class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('action_taken') border-red-500 @enderror">{{ old('action_taken', $service->action_taken) }}</textarea>
                                    @error('action_taken')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                                        Notes
                                    </label>
                                    <textarea name="notes" id="notes" rows="2" placeholder="Additional notes..." class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('notes', $service->notes) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Spare Parts -->
                        <div class="mb-8">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold text-gray-900">Spare Parts</h3>
                                <button type="button" onclick="addSparePartRow()" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Add Part
                                </button>
                            </div>

                            <div class="overflow-x-auto bg-gray-50 rounded-lg border border-gray-200">
                                <table class="min-w-full divide-y divide-gray-200" id="sparePartsTable">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Part Name</th>
                                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">Quantity</th>
                                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider w-20">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="sparePartsBody" class="bg-white divide-y divide-gray-200">
                                        @forelse($service->serviceItems as $index => $item)
                                            <tr class="spare-part-row">
                                                <td class="px-4 py-3">
                                                    <select name="spare_parts[{{ $index }}][spare_part_id]" class="block w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 spare-part-select" required>
                                                        <option value="">Select Part</option>
                                                        @foreach($spareParts as $part)
                                                            <option value="{{ $part->id }}" 
                                                                    data-price="{{ $part->selling_price }}" 
                                                                    data-stock="{{ $part->stock }}"
                                                                    {{ $item->spare_part_id == $part->id ? 'selected' : '' }}>
                                                                {{ $part->name }} (Stock: {{ $part->stock }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="px-4 py-3 text-center">
                                                    <input type="number" 
                                                           name="spare_parts[{{ $index }}][quantity]" 
                                                           value="{{ $item->quantity }}" 
                                                           min="1" 
                                                           class="w-20 text-sm text-center rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 quantity-input" 
                                                           required>
                                                </td>
                                                <td class="px-4 py-3 text-center">
                                                    <button type="button" onclick="removeSparePartRow(this)" class="text-red-600 hover:text-red-800 font-bold text-lg" title="Remove">
                                                        ✕
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr id="noPartsRow">
                                                <td colspan="3" class="px-4 py-8 text-center text-gray-500">
                                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                                    </svg>
                                                    <p class="mt-2 text-sm">No spare parts added yet</p>
                                                    <p class="text-xs text-gray-400">Click "Add Part" button to add spare parts</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex items-center justify-end gap-4 pt-6 border-t">
                            <a href="{{ route('services.show', $service) }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Cancel
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Update Service
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        let rowIndex = {{ $service->serviceItems->count() }};
        const spareParts = @json($spareParts);

        function addSparePartRow() {
            // Remove "no parts" message if exists
            const noPartsRow = document.getElementById('noPartsRow');
            if (noPartsRow) {
                noPartsRow.remove();
            }

            const tbody = document.getElementById('sparePartsBody');
            const row = document.createElement('tr');
            row.className = 'spare-part-row';
            
            let options = '<option value="">Select Part</option>';
            spareParts.forEach(part => {
                options += `<option value="${part.id}" data-price="${part.selling_price}" data-stock="${part.stock}">
                    ${part.name} (Stock: ${part.stock})
                </option>`;
            });

            row.innerHTML = `
                <td class="px-4 py-3">
                    <select name="spare_parts[${rowIndex}][spare_part_id]" class="block w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 spare-part-select" required>
                        ${options}
                    </select>
                </td>
                <td class="px-4 py-3 text-center">
                    <input type="number" name="spare_parts[${rowIndex}][quantity]" value="1" min="1" class="w-20 text-sm text-center rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 quantity-input" required>
                </td>
                <td class="px-4 py-3 text-center">
                    <button type="button" onclick="removeSparePartRow(this)" class="text-red-600 hover:text-red-800 font-bold text-lg" title="Remove">✕</button>
                </td>
            `;
            
            tbody.appendChild(row);
            rowIndex++;
        }

        function removeSparePartRow(button) {
            const row = button.closest('tr');
            row.remove();
            updatePartsTotal();

            // Show "no parts" message if table is empty
            const tbody = document.getElementById('sparePartsBody');
            if (tbody.children.length === 0) {
                tbody.innerHTML = `
                    <tr id="noPartsRow">
                        <td colspan="3" class="px-4 py-8 text-center text-gray-500">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            <p class="mt-2 text-sm">No spare parts added yet</p>
                            <p class="text-xs text-gray-400">Click "Add Part" button to add spare parts</p>
                        </td>
                    </tr>
                `;
            }
        }
    </script>
    @endpush
</x-app-layout>