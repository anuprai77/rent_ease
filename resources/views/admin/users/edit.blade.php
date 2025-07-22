@extends('admin.dashboard')


@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white shadow-md rounded-lg p-6">
    <h2 class="text-xl font-semibold mb-6">Edit User</h2>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2" for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2" for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Admin Privileges</label>
            <select name="is_admin" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300">
                <option value="0" {{ !$user->is_admin ? 'selected' : '' }}>Regular User</option>
                <option value="1" {{ $user->is_admin ? 'selected' : '' }}>Admin</option>
            </select>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('admin.users.index') }}"
               class="mr-4 px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">Cancel</a>
            <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update User</button>
        </div>
    </form>
</div>
@endsection