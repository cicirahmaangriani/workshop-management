<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Header with Add Button -->
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">Customers</h2>
                            <p class="text-sm text-gray-500 mt-1">Manage customer information and contacts</p>
                        </div>
                        <a href="{{ route('customers.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold rounded-lg shadow-md">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Add Customer
                        </a>
                    </div>

                    <!-- Search Form -->
                    <form method="GET" action="{{ route('customers.index') }}" class="mb-6">
                        <div class="flex gap-3">
                            <div class="flex-1 relative">
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search customers..." class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <svg class="absolute left-3 top-3 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                            <button type="submit" class="px-6 py-2.5 bg-gray-700 text-white font-semibold rounded-lg">
                                Search
                            </button>
                            @if(request('search'))
                                <a href="{{ route('customers.index') }}" class="px-6 py-2.5 bg-gray-200 text-gray-700 font-semibold rounded-lg">
                                    Clear
                                </a>
                            @endif
                        </div>
                    </form>

                    <!-- Customers Table -->
                    <div class="overflow-x-auto rounded-lg border border-gray-200">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                                <tr>
                                    <th class="px-4 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">ID</th>
                                    <th class="px-4 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Name</th>
                                    <th class="px-4 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Phone</th>
                                    <th class="px-4 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Email</th>
                                    <th class="px-4 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Vehicles</th>
                                    <th class="px-4 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($customers as $customer)
                                    <tr>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <div class="text-sm font-semibold text-gray-900">#{{ $customer->id }}</div>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $customer->name }}</div>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <div class="text-sm text-gray-500">{{ $customer->phone }}</div>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <div class="text-sm text-gray-500">{{ $customer->email ?? '-' }}</div>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <div class="text-sm text-gray-500">{{ $customer->vehicles->count() }}</div>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">
                                            <div class="flex gap-1">
                                                <a href="{{ route('customers.show', $customer) }}" title="View" class="inline-flex items-center p-1.5 bg-blue-100 text-blue-700 rounded-md font-semibold">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                                </a>
                                                <a href="{{ route('customers.edit', $customer) }}" title="Edit" class="inline-flex items-center p-1.5 bg-indigo-100 text-indigo-700 rounded-md font-semibold">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                                </a>
                                                <form action="{{ route('customers.destroy', $customer) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" title="Delete" class="inline-flex items-center p-1.5 bg-red-100 text-red-700 rounded-md font-semibold">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                </button>
                                            </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                            No customers found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $customers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>