<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add New Service
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('services.store') }}" id="serviceForm">
                        @csrf

                        <!-- Service Information -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Service Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="vehicle_id" class="block text-sm font-medium text-gray-700">Vehicle <span class="text-red-500">*</span></label>
                                    <select name="vehicle_id" id="vehicle_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('vehicle_id') border-red-500 @enderror">
                                        <option value="">Select Vehicle</option>
                                        @foreach($vehicles as $vehicle)
                                            <option value="{{ $vehicle->id }}" {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>
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
                                            <option value="{{ $mechanic->id }}" {{ old('mechanic_id') == $mechanic->id ? 'selected' : '' }}>
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
                                    <input type="date" name="service_date" id="service_date" value="{{ old('service_date', date('Y-m-d')) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('service_date') border-red-500 @enderror">
                                    @error('service_date')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700">Status <span class="text-red-500">*</span></label>
                                    <select name="status" id="status" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('status') border-red-500 @enderror">
                                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                    </select>
                                    @error('status')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="labor_cost" class="block text-sm font-medium text-gray-700">Labor Cost <span class="text-red-500">*</span></label>
                                    <input type="number" name="labor_cost" id="labor_cost" value="{{ old('labor_cost', 0) }}" min="0" step="0.01" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('labor_cost') border-red-500 @enderror">
                                    @error('labor_cost')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="estimated_days" class="block text-sm font-medium text-gray-700">Estimated Days</label>
                                    <input type="number" name="estimated_days" id="estimated_days" value="{{ old('estimated_days') }}" min="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>

                                <div class="md:col-span-2">
                                    <label for="complaint" class="block text-sm font-medium text-gray-700">Customer Complaint</label>
                                    <textarea name="complaint" id="complaint" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('complaint') }}</textarea>
                                </div>

                                <div class="md:col-span-2">
                                    <label for="diagnosis" class="block text-sm font-medium text-gray-700">Diagnosis</label>
                                    <textarea name="diagnosis" id="diagnosis" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('diagnosis') }}</textarea>
                                </div>

                                <div class="md:col-span-2">
                                    <label for="action_taken" class="block text-sm font-medium text-gray-700">Action Taken</label>
                                    <textarea name="action_taken" id="action_taken" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('action_taken') }}</textarea>
                                </div>

                                <div class="md:col-span-2">
                                    <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                                    <textarea name="notes" id="notes" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('notes') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Spare Parts -->
                        <div class="mb-8">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold text-gray-900">Spare Parts Used</h3>
                                <button type="button" onclick="addSparePartRow()" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-sm">
                                    + Add Part
                                </button>
                            </div>

                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200" id="sparePartsTable">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Spare Part</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200" id="sparePartsBody">
                                        <!-- Rows will be added here dynamically -->
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="flex justify-end gap-3">
                            <a href="{{ route('services.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                                Cancel
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Create Service
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        let rowIndex = 0;
        const spareParts = @json($spareParts);
        console.log('spareParts for service create:', spareParts);

        function addSparePartRow() {
            const tbody = document.getElementById('sparePartsBody');
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="px-4 py-3">
                    <select name="spare_parts[${rowIndex}][spare_part_id]" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Select Spare Part</option>
                        ${spareParts.map(part => `
                            <option value="${part.id}" data-price="${part.selling_price}">
                                ${part.name} - ${part.code} (Stock: ${part.stock})
                            </option>
                        `).join('')}
                    </select>
                </td>
                <td class="px-4 py-3">
                    <input type="number" name="spare_parts[${rowIndex}][quantity]" min="1" value="1" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </td>
                <td class="px-4 py-3">
                    <button type="button" onclick="removeSparePartRow(this)" class="text-red-600 hover:text-red-900">
                        Remove
                    </button>
                </td>
            `;
            tbody.appendChild(row);
            // attach listeners to the newly added row
            const select = row.querySelector('select');
            const qtyInput = row.querySelector('input[type="number"]');
            select.addEventListener('change', updateTotal);
            qtyInput.addEventListener('input', updateTotal);
            rowIndex++;
            updateTotal();
        }

        function removeSparePartRow(button) {
            button.closest('tr').remove();
            updateTotal();
        }

        // Add initial row
        window.addEventListener('DOMContentLoaded', function() {
            addSparePartRow();
            // recalc when labor cost changes
            const laborInput = document.getElementById('labor_cost');
            if (laborInput) {
                laborInput.addEventListener('input', updateTotal);
            }
        });

        function updateTotal() {
            try {
                const tbody = document.getElementById('sparePartsBody');
                let partsTotal = 0;
                [...tbody.querySelectorAll('tr')].forEach(row => {
                    const select = row.querySelector('select');
                    const qty = row.querySelector('input[type="number"]').value || 0;
                    const selected = select.options[select.selectedIndex];
                    if (selected && selected.dataset && selected.dataset.price) {
                        const price = parseFloat(selected.dataset.price) || 0;
                        partsTotal += price * (parseFloat(qty) || 0);
                    }
                });

                const labor = parseFloat(document.getElementById('labor_cost').value) || 0;
                const total = partsTotal + labor;

                // display total in UI if exists, otherwise create a small display area
                let totalDisplay = document.getElementById('serviceTotalDisplay');
                if (!totalDisplay) {
                    const container = document.createElement('div');
                    container.className = 'mt-4';
                    container.innerHTML = `<strong>Total Cost: </strong> <span id="serviceTotalDisplay">Rp ${total.toLocaleString()}</span>`;
                    const form = document.getElementById('serviceForm');
                    form.insertBefore(container, form.querySelector('.flex.justify-end'));
                } else {
                    totalDisplay.innerText = 'Rp ' + total.toLocaleString();
                }

                // set a hidden input so server also receives it (optional, server recalculates anyway)
                let hidden = document.getElementById('total_cost_input');
                if (!hidden) {
                    hidden = document.createElement('input');
                    hidden.type = 'hidden';
                    hidden.name = 'total_cost';
                    hidden.id = 'total_cost_input';
                    document.getElementById('serviceForm').appendChild(hidden);
                }
                hidden.value = total;
            } catch (e) {
                console.error('Error updating total:', e);
            }
        }
    </script>
    @endpush
</x-app-layout>