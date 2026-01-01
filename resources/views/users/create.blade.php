<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Add New User</h2>
                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Name</label>
                            <input type="text" name="name" class="w-full border rounded px-3 py-2" required value="{{ old('name') }}">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Email</label>
                            <input type="email" name="email" class="w-full border rounded px-3 py-2" required value="{{ old('email') }}">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Role</label>
                            <select name="role" class="w-full border rounded px-3 py-2" required>
                                <option value="admin">Admin</option>
                                <option value="receptionist">Receptionist</option>
                                <option value="mechanic">Mechanic</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Password</label>
                            <input type="password" name="password" class="w-full border rounded px-3 py-2" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="w-full border rounded px-3 py-2" required>
                        </div>
                        <div class="flex justify-end">
                            <a href="{{ route('users.index') }}" class="mr-4 text-gray-600">Cancel</a>
                            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
