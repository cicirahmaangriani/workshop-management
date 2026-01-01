<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add New Spare Part
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="bg-gradient-to-r from-[var(--navy)] to-[var(--blue)] p-6">
                    <h3 class="text-2xl font-bold text-white">Add New Spare Part</h3>
                    <p class="text-blue-100 mt-1">Fill in the information below to add a new spare part</p>
                </div>
                <div class="p-6">
                    <form method="POST" action="{{ route('spare-parts.store') }}" id="sparePartForm">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Name <span class="text-red-500">*</span></label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('name') border-red-500 @enderror">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="category" class="block text-sm font-medium text-gray-700">Category <span class="text-red-500">*</span></label>
                                <input type="text" name="category" id="category" value="{{ old('category') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('category') border-red-500 @enderror" placeholder="e.g., Oil & Lubricants">
                                @error('category')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea name="description" id="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="purchase_price" class="block text-sm font-medium text-gray-700">Purchase Price <span class="text-red-500">*</span></label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">Rp</span>
                                    </div>
                                    <input type="number" name="purchase_price" id="purchase_price" value="{{ old('purchase_price', 0) }}" required min="0" step="0.01" class="block w-full pl-12 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('purchase_price') border-red-500 @enderror">
                                </div>
                                @error('purchase_price')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="selling_price" class="block text-sm font-medium text-gray-700">Selling Price <span class="text-red-500">*</span></label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">Rp</span>
                                    </div>
                                    <input type="number" name="selling_price" id="selling_price" value="{{ old('selling_price', 0) }}" required min="0" step="0.01" class="block w-full pl-12 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('selling_price') border-red-500 @enderror">
                                </div>
                                <!-- ✅ Error message untuk validasi real-time -->
                                <p id="price_error" class="mt-1 text-sm text-red-500 hidden">Selling price must be greater than or equal to purchase price!</p>
                                @error('selling_price')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- ✅ Profit Margin Display -->
                            <div class="md:col-span-2">
                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="text-sm font-medium text-blue-900">Profit Margin</p>
                                            <p class="text-xs text-blue-700">Automatically calculated based on purchase and selling price</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-2xl font-bold text-blue-600" id="profit_margin">0%</p>
                                            <p class="text-sm text-blue-700" id="profit_amount">Rp 0</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label for="stock" class="block text-sm font-medium text-gray-700">Current Stock <span class="text-red-500">*</span></label>
                                <input type="number" name="stock" id="stock" value="{{ old('stock', 0) }}" required min="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('stock') border-red-500 @enderror">
                                @error('stock')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="min_stock" class="block text-sm font-medium text-gray-700">Minimum Stock <span class="text-red-500">*</span></label>
                                <input type="number" name="min_stock" id="min_stock" value="{{ old('min_stock', 10) }}" required min="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('min_stock') border-red-500 @enderror">
                                @error('min_stock')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500">Alert will be shown when stock is below this value</p>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end gap-3">
                            <a href="{{ route('spare-parts.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                                Cancel
                            </a>
                            <button type="submit" id="submitBtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Save Spare Part
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // ✅ Real-time validation untuk harga jual tidak boleh kurang dari harga beli
        const purchasePriceInput = document.getElementById('purchase_price');
        const sellingPriceInput = document.getElementById('selling_price');
        const priceError = document.getElementById('price_error');
        const submitBtn = document.getElementById('submitBtn');
        const profitMarginDisplay = document.getElementById('profit_margin');
        const profitAmountDisplay = document.getElementById('profit_amount');

        function validatePrices() {
            const purchasePrice = parseFloat(purchasePriceInput.value) || 0;
            const sellingPrice = parseFloat(sellingPriceInput.value) || 0;

            // Calculate profit
            const profit = sellingPrice - purchasePrice;
            const profitMargin = purchasePrice > 0 ? (profit / purchasePrice) * 100 : 0;

            // Update profit display
            profitMarginDisplay.textContent = profitMargin.toFixed(1) + '%';
            profitAmountDisplay.textContent = 'Rp ' + profit.toLocaleString('id-ID');

            // Validate
            if (sellingPrice < purchasePrice && sellingPrice > 0) {
                priceError.classList.remove('hidden');
                sellingPriceInput.classList.add('border-red-500');
                sellingPriceInput.classList.remove('border-gray-300');
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
                return false;
            } else {
                priceError.classList.add('hidden');
                sellingPriceInput.classList.remove('border-red-500');
                sellingPriceInput.classList.add('border-gray-300');
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                return true;
            }
        }

        // Event listeners
        purchasePriceInput.addEventListener('input', validatePrices);
        sellingPriceInput.addEventListener('input', validatePrices);

        // Form submission validation
        document.getElementById('sparePartForm').addEventListener('submit', function(e) {
            if (!validatePrices()) {
                e.preventDefault();
                alert('Selling price must be greater than or equal to purchase price!');
            }
        });

        // Initial validation
        validatePrices();
    </script>
    @endpush
</x-app-layout>