<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Invoice - {{ $invoice->invoice_number }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('invoices.update', $invoice) }}">
                                                <div class="mb-4">
                                                    <label class="block text-sm font-medium text-gray-700">Invoice Number</label>
                                                    <input type="text" value="{{ $invoice->invoice_number }}" readonly class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 cursor-not-allowed">
                                                </div>
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Service Info (Read-only) -->
                            <div class="md:col-span-2 bg-gray-50 p-4 rounded-lg">
                                <h3 class="text-sm font-semibold text-gray-700 mb-2">Service Information</h3>
                                <p class="text-sm text-gray-900">Service: {{ $invoice->service->service_number }}</p>
                                <p class="text-sm text-gray-500">Customer: {{ $invoice->service->vehicle->customer->name }}</p>
                                <p class="text-sm text-gray-500">Vehicle: {{ $invoice->service->vehicle->license_plate }}</p>
                            </div>

                            <!-- Invoice Date -->
                            <div>
                                <label for="invoice_date" class="block text-sm font-medium text-gray-700">Invoice Date <span class="text-red-500">*</span></label>
                                <input type="date" name="invoice_date" id="invoice_date" value="{{ old('invoice_date', $invoice->invoice_date->format('Y-m-d')) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('invoice_date') border-red-500 @enderror">
                                @error('invoice_date')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Due Date -->
                            <div>
                                <label for="due_date" class="block text-sm font-medium text-gray-700">Due Date</label>
                                <input type="date" name="due_date" id="due_date" value="{{ old('due_date', $invoice->due_date?->format('Y-m-d')) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('due_date') border-red-500 @enderror">
                                @error('due_date')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Service Cost Display -->
                            <div class="md:col-span-2 bg-gray-50 p-4 rounded-lg">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-sm text-gray-600">Service Cost:</span>
                                    <span class="text-sm font-medium text-gray-900">Rp {{ number_format($invoice->service->total_cost, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <!-- Tax -->
                            <div>
                                <label for="tax" class="block text-sm font-medium text-gray-700">Tax (Rp)</label>
                                <input type="number" name="tax" id="tax" value="{{ old('tax', $invoice->tax) }}" min="0" step="0.01" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('tax') border-red-500 @enderror">
                                @error('tax')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Discount -->
                            <div>
                                <label for="discount" class="block text-sm font-medium text-gray-700">Discount (Rp)</label>
                                <input type="number" name="discount" id="discount" value="{{ old('discount', $invoice->discount) }}" min="0" step="0.01" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('discount') border-red-500 @enderror">
                                @error('discount')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Payment Amount -->
                            <div>
                                <label for="paid" class="block text-sm font-medium text-gray-700">Paid Amount (Rp)</label>
                                <input type="number" name="paid" id="paid" value="{{ old('paid', $invoice->paid) }}" min="0" step="0.01" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('paid') border-red-500 @enderror">
                                @error('paid')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Payment Method -->
                            <div>
                                <label for="payment_method" class="block text-sm font-medium text-gray-700">Payment Method</label>
                                <select name="payment_method" id="payment_method" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('payment_method') border-red-500 @enderror">
                                    <option value="">Select Method</option>
                                    <option value="cash" {{ old('payment_method', $invoice->payment_method) == 'cash' ? 'selected' : '' }}>Cash</option>
                                    <option value="transfer" {{ old('payment_method', $invoice->payment_method) == 'transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                    <option value="credit_card" {{ old('payment_method', $invoice->payment_method) == 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                                    <option value="debit_card" {{ old('payment_method', $invoice->payment_method) == 'debit_card' ? 'selected' : '' }}>Debit Card</option>
                                </select>
                                @error('payment_method')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Total Preview -->
                            <div class="md:col-span-2 bg-blue-50 p-4 rounded-lg border-2 border-blue-200">
                                <div class="space-y-2">
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-600">Total Amount:</span>
                                        <span class="text-lg font-semibold text-blue-600" id="totalAmount">Rp {{ number_format($invoice->total, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-600">Paid:</span>
                                        <span class="text-sm font-medium text-green-600" id="paidDisplay">Rp {{ number_format($invoice->paid, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between items-center pt-2 border-t">
                                        <span class="text-sm font-semibold text-gray-900">Remaining:</span>
                                        <span class="text-lg font-bold text-red-600" id="remainingAmount">Rp {{ number_format($invoice->remaining, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Notes -->
                            <div class="md:col-span-2">
                                <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                                <textarea name="notes" id="notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('notes') border-red-500 @enderror">{{ old('notes', $invoice->notes) }}</textarea>
                                @error('notes')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end gap-3">
                            <a href="{{ route('invoices.show', $invoice) }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                                Cancel
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update Invoice
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        const serviceCost = {{ $invoice->service->total_cost }};

        function calculateTotal() {
            const tax = parseFloat(document.getElementById('tax').value || 0);
            const discount = parseFloat(document.getElementById('discount').value || 0);
            const paid = parseFloat(document.getElementById('paid').value || 0);
            
            const total = serviceCost + tax - discount;
            const remaining = total - paid;
            
            document.getElementById('totalAmount').textContent = 'Rp ' + total.toLocaleString('id-ID');
            document.getElementById('paidDisplay').textContent = 'Rp ' + paid.toLocaleString('id-ID');
            document.getElementById('remainingAmount').textContent = 'Rp ' + remaining.toLocaleString('id-ID');
        }

        document.getElementById('tax').addEventListener('input', calculateTotal);
        document.getElementById('discount').addEventListener('input', calculateTotal);
        document.getElementById('paid').addEventListener('input', calculateTotal);

        // Calculate on page load
        window.addEventListener('DOMContentLoaded', calculateTotal);
    </script>
    @endpush
</x-app-layout>