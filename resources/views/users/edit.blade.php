<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Edit User</h2>
                    <form method="POST" action="{{ route('users.update', $user) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Name</label>
                            <input type="text" name="name" class="w-full border rounded px-3 py-2" required value="{{ old('name', $user->name) }}">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Email</label>
                            <input type="email" name="email" class="w-full border rounded px-3 py-2" required value="{{ old('email', $user->email) }}">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Role</label>
                            <select name="role" class="w-full border rounded px-3 py-2" required>
                                <option value="admin" @if($user->role=='admin') selected @endif>Admin</option>
                                <option value="receptionist" @if($user->role=='receptionist') selected @endif>Receptionist</option>
                                <option value="mechanic" @if($user->role=='mechanic') selected @endif>Mechanic</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Password <span class="text-xs text-gray-400">(leave blank to keep current)</span></label>
                            <input type="password" name="password" class="w-full border rounded px-3 py-2">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="w-full border rounded px-3 py-2">
                        </div>
                        <div class="flex justify-end">
                            <a href="{{ route('users.index') }}" class="mr-4 text-gray-600">Cancel</a>
                            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
