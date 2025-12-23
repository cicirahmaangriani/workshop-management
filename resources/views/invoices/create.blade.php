<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create New Invoice
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($services->isEmpty())
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 text-center">
                            <svg class="mx-auto h-12 w-12 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                            <h3 class="mt-2 text-lg font-medium text-yellow-900">No Completed Services Available</h3>
                            <p class="mt-1 text-sm text-yellow-700">
                                There are no completed services without invoices. Please complete a service first before creating an invoice.
                            </p>
                            <div class="mt-6">
                                <a href="{{ route('services.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md">
                                    View Services
                                </a>
                            </div>
                        </div>
                    @else
                        <form method="POST" action="{{ route('invoices.store') }}">
                            @csrf

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Service Selection -->
                                <div class="md:col-span-2">
                                    <label for="service_id" class="block text-sm font-medium text-gray-700">Service <span class="text-red-500">*</span></label>
                                    <select name="service_id" id="service_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('service_id') border-red-500 @enderror">
                                        <option value="">Select Service</option>
                                        @foreach($services as $service)
                                            <option value="{{ $service->id }}" 
                                                    data-cost="{{ $service->total_cost }}"
                                                    data-customer="{{ $service->vehicle->customer->name }}"
                                                    data-vehicle="{{ $service->vehicle->license_plate }}"
                                                    {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                                {{ $service->service_number }} - {{ $service->vehicle->customer->name }} ({{ $service->vehicle->license_plate }}) - Rp {{ number_format($service->total_cost, 0, ',', '.') }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('service_id')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Service Info Display -->
                                <div class="md:col-span-2 bg-gray-50 p-4 rounded-lg" id="serviceInfo" style="display: none;">
                                    <h4 class="text-sm font-semibold text-gray-700 mb-2">Selected Service Information</h4>
                                    <div class="grid grid-cols-2 gap-3 text-sm">
                                        <div>
                                            <span class="text-gray-500">Customer:</span>
                                            <span class="ml-2 text-gray-900 font-medium" id="displayCustomer">-</span>
                                        </div>
                                        <div>
                                            <span class="text-gray-500">Vehicle:</span>
                                            <span class="ml-2 text-gray-900 font-medium" id="displayVehicle">-</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Invoice Date -->
                                <div>
                                    <label for="invoice_date" class="block text-sm font-medium text-gray-700">Invoice Date <span class="text-red-500">*</span></label>
                                    <input type="date" name="invoice_date" id="invoice_date" value="{{ old('invoice_date', date('Y-m-d')) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('invoice_date') border-red-500 @enderror">
                                    @error('invoice_date')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Due Date -->
                                <div>
                                    <label for="due_date" class="block text-sm font-medium text-gray-700">Due Date</label>
                                    <input type="date" name="due_date" id="due_date" value="{{ old('due_date') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('due_date') border-red-500 @enderror">
                                    @error('due_date')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                    <p class="mt-1 text-xs text-gray-500">Leave empty for immediate payment</p>
                                </div>

                                <!-- Service Cost Display -->
                                <div class="md:col-span-2 bg-blue-50 border border-blue-200 p-4 rounded-lg">
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="text-sm font-medium text-gray-700">Service Cost (Subtotal):</span>
                                        <span class="text-lg font-bold text-blue-600" id="serviceCost">Rp 0</span>
                                    </div>
                                </div>

                                <!-- Tax -->
                                <div>
                                    <label for="tax" class="block text-sm font-medium text-gray-700">Tax (Rp)</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 sm:text-sm">Rp</span>
                                        </div>
                                        <input type="number" name="tax" id="tax" value="{{ old('tax', 0) }}" min="0" step="0.01" class="block w-full pl-12 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('tax') border-red-500 @enderror">
                                    </div>
                                    @error('tax')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                    <p class="mt-1 text-xs text-gray-500">e.g., PPN 11%</p>
                                </div>

                                <!-- Discount -->
                                <div>
                                    <label for="discount" class="block text-sm font-medium text-gray-700">Discount (Rp)</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 sm:text-sm">Rp</span>
                                        </div>
                                        <input type="number" name="discount" id="discount" value="{{ old('discount', 0) }}" min="0" step="0.01" class="block w-full pl-12 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('discount') border-red-500 @enderror">
                                    </div>
                                    @error('discount')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                    <p class="mt-1 text-xs text-gray-500">e.g., Member discount</p>
                                </div>

                                <!-- Total Preview -->
                                <div class="md:col-span-2 bg-green-50 border-2 border-green-300 p-6 rounded-lg">
                                    <div class="space-y-3">
                                        <div class="flex justify-between items-center text-sm">
                                            <span class="text-gray-600">Subtotal:</span>
                                            <span class="font-medium text-gray-900" id="displaySubtotal">Rp 0</span>
                                        </div>
                                        <div class="flex justify-between items-center text-sm">
                                            <span class="text-gray-600">Tax:</span>
                                            <span class="font-medium text-gray-900" id="displayTax">Rp 0</span>
                                        </div>
                                        <div class="flex justify-between items-center text-sm">
                                            <span class="text-gray-600">Discount:</span>
                                            <span class="font-medium text-red-600" id="displayDiscount">- Rp 0</span>
                                        </div>
                                        <div class="flex justify-between items-center pt-3 border-t-2 border-green-400">
                                            <span class="text-xl font-bold text-gray-900">Total Amount:</span>
                                            <span class="text-3xl font-bold text-green-600" id="totalAmount">Rp 0</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Notes -->
                                <div class="md:col-span-2">
                                    <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                                    <textarea name="notes" id="notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('notes') border-red-500 @enderror" placeholder="Additional notes for this invoice...">{{ old('notes') }}</textarea>
                                    @error('notes')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-6 flex justify-end gap-3">
                                <a href="{{ route('invoices.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                                    Cancel
                                </a>
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Create Invoice
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if($services->isNotEmpty())
    @push('scripts')
    <script>
        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID').format(number);
        }

        function calculateTotal() {
            const serviceSelect = document.getElementById('service_id');
            const selectedOption = serviceSelect.options[serviceSelect.selectedIndex];
            const serviceCost = parseFloat(selectedOption.dataset.cost || 0);
            
            const tax = parseFloat(document.getElementById('tax').value || 0);
            const discount = parseFloat(document.getElementById('discount').value || 0);
            
            const total = serviceCost + tax - discount;
            
            // Update displays
            document.getElementById('serviceCost').textContent = 'Rp ' + formatRupiah(serviceCost);
            document.getElementById('displaySubtotal').textContent = 'Rp ' + formatRupiah(serviceCost);
            document.getElementById('displayTax').textContent = 'Rp ' + formatRupiah(tax);
            document.getElementById('displayDiscount').textContent = '- Rp ' + formatRupiah(discount);
            document.getElementById('totalAmount').textContent = 'Rp ' + formatRupiah(total);

            // Show service info
            if (serviceCost > 0) {
                document.getElementById('serviceInfo').style.display = 'block';
                document.getElementById('displayCustomer').textContent = selectedOption.dataset.customer || '-';
                document.getElementById('displayVehicle').textContent = selectedOption.dataset.vehicle || '-';
            } else {
                document.getElementById('serviceInfo').style.display = 'none';
            }
        }

        document.getElementById('service_id').addEventListener('change', calculateTotal);
        document.getElementById('tax').addEventListener('input', calculateTotal);
        document.getElementById('discount').addEventListener('input', calculateTotal);

        // Calculate on page load if service is pre-selected
        window.addEventListener('DOMContentLoaded', calculateTotal);
    </script>
    @endpush
    @endif
</x-app-layout>