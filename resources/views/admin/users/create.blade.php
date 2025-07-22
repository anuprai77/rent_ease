
@extends('admin.dashboard')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white shadow-md rounded-lg p-6">
    <h2 class="text-xl font-semibold mb-6">Create New User</h2>

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2" for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}"
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2" for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}"
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2" for="password">Password</label>
            <input type="password" name="password" id="password"
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2" for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Admin Privileges</label>
            <select name="is_admin" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300">
                <option value="0" {{ old('is_admin') == '0' ? 'selected' : '' }}>Regular User</option>
                <option value="1" {{ old('is_admin') == '1' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('admin.users.index') }}"
               class="mr-4 px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">Cancel</a>
            <button type="submit"
                    class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700">Create User</button>
        </div>
    </form>
</div>
@endsection