<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">User Details</h2>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Name</label>
                        <div class="text-gray-900">{{ $user->name }}</div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Email</label>
                        <div class="text-gray-900">{{ $user->email }}</div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Role</label>
                        <div class="text-gray-900 capitalize">{{ $user->role }}</div>
                    </div>
                    <div class="flex justify-end">
                        <a href="{{ route('users.edit', $user) }}" class="px-6 py-2 bg-indigo-600 text-white rounded mr-2">Edit</a>
                        <a href="{{ route('users.index') }}" class="px-6 py-2 bg-gray-200 text-gray-700 rounded">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
