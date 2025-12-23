<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add New Vehicle
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="bg-gradient-to-r from-[var(--navy)] to-[var(--blue)] p-6">
                    <h3 class="text-2xl font-bold text-white">Add New Vehicle</h3>
                    <p class="text-blue-100 mt-1">Fill in the information below to add a new vehicle</p>
                </div>
                <div class="p-6">
                    <form method="POST" action="{{ route('vehicles.store') }}">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Customer -->
                            <div class="md:col-span-2">
                                <label for="customer_id" class="block text-sm font-medium text-gray-700">Customer <span class="text-red-500">*</span></label>
                                <select name="customer_id" id="customer_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('customer_id') border-red-500 @enderror">
                                    <option value="">Select Customer</option>
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                            {{ $customer->name }} - {{ $customer->phone }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('customer_id')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- License Plate -->
                            <div>
                                <label for="license_plate" class="block text-sm font-medium text-gray-700">License Plate <span class="text-red-500">*</span></label>
                                <input type="text" name="license_plate" id="license_plate" value="{{ old('license_plate') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('license_plate') border-red-500 @enderror" placeholder="B 1234 ABC">
                                @error('license_plate')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Brand -->
                            <div>
                                <label for="brand" class="block text-sm font-medium text-gray-700">Brand <span class="text-red-500">*</span></label>
                                <input type="text" name="brand" id="brand" value="{{ old('brand') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('brand') border-red-500 @enderror" placeholder="Toyota">
                                @error('brand')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Model -->
                            <div>
                                <label for="model" class="block text-sm font-medium text-gray-700">Model <span class="text-red-500">*</span></label>
                                <input type="text" name="model" id="model" value="{{ old('model') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('model') border-red-500 @enderror" placeholder="Avanza">
                                @error('model')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Year -->
                            <div>
                                <label for="year" class="block text-sm font-medium text-gray-700">Year <span class="text-red-500">*</span></label>
                                <input type="number" name="year" id="year" value="{{ old('year', date('Y')) }}" required min="1900" max="{{ date('Y') + 1 }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('year') border-red-500 @enderror">
                                @error('year')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Color -->
                            <div>
                                <label for="color" class="block text-sm font-medium text-gray-700">Color</label>
                                <input type="text" name="color" id="color" value="{{ old('color') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('color') border-red-500 @enderror" placeholder="Silver">
                                @error('color')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Chassis Number -->
                            <div>
                                <label for="chassis_number" class="block text-sm font-medium text-gray-700">Chassis Number</label>
                                <input type="text" name="chassis_number" id="chassis_number" value="{{ old('chassis_number') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('chassis_number') border-red-500 @enderror">
                                @error('chassis_number')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Engine Number -->
                            <div>
                                <label for="engine_number" class="block text-sm font-medium text-gray-700">Engine Number</label>
                                <input type="text" name="engine_number" id="engine_number" value="{{ old('engine_number') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('engine_number') border-red-500 @enderror">
                                @error('engine_number')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end gap-3">
                            <a href="{{ route('vehicles.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                                Cancel
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Save Vehicle
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>