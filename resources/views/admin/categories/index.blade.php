@extends('admin.dashboard')
@section('content')
    <div x-data="{ open: false, openEdit: false, editCategory: {} }">
        <!-- Your existing content -->
        <div class="container mx-auto px-4 py-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Categories List</h2>

            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Button to open modal -->
                <button @click="open = true"
                    class="flex items-center justify-center p-6 border-2 border-dashed border-gray-300 rounded-lg text-gray-600 hover:border-gray-400 hover:bg-gray-50 transition-colors">
                    <span class="text-lg font-medium">+ Create Category</span>
                </button>
                @foreach ($categories as $category)
                    <div
                        class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition-shadow duration-300">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $category->name }}</h3>
                            <p class="text-gray-600 mb-4">{{ $category->description }}</p>
                            <div class="flex space-x-2">
                                <button @click="openEdit = true; editCategory = {{ json_encode($category) }}"
                                    class="px-3 py-1 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 transition-colors">
                                    Edit
                                </button>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700 transition-colors"
                                        onclick="return confirm('Are you sure you want to delete this category?')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Edit Modal -->
        <div x-show="openEdit" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" x-cloak>

            <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg" @click.away="openEdit = false">

                <h2 class="text-xl font-bold mb-4">Edit Category</h2>

                <form :action="`/admin/categories/${editCategory.id}`" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1" for="name">Name</label>
                        <input type="text" name="name" x-model="editCategory.name"
                            class="w-full border border-gray-300 px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="flex justify-end space-x-2">
                        <button type="button" @click="openEdit = false"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>


        <div x-show="open" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50" x-cloak>
            <!-- Modal Content -->
            <div @click.away="open = false" class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                <h2 class="text-xl font-bold mb-4">Create Category</h2>

                <form method="POST" action="{{ route('admin.categories.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-medium mb-2">Category Name</label>
                        <input type="text" name="name" id="name" required
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="flex justify-end space-x-2">
                        <button type="button" @click="open = false"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
