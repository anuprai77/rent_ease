@extends('layouts.app')
@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white rounded-xl shadow-md overflow-hidden p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Add New Rental Item</h2>
                    <a href="{{ route('items.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z"
                                clip-rule="evenodd" />
                        </svg>
                        Back to Items
                    </a>
                </div>

                <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Basic Information -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-gray-700 border-b pb-2">Basic Information</h3>

                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Item Name*</label>
                                <input type="text" name="name" id="name" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                                <select name="category_id" id="category_id"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Select a category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea name="description" id="description" rows="3"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Image Upload -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-gray-700 border-b pb-2">Item Image</h3>

                            <div>
                                <label for="image" class="block text-sm font-medium text-gray-700">Upload Image</label>
                                <div class="mt-1 flex items-center">
                                    <input type="file" name="image" id="image"
                                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                </div>
                                @error('image')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500">JPEG, PNG, JPG, GIF (Max: 2MB)</p>
                            </div>

                            <div id="image-preview" class="border border-gray-200 rounded-md p-4 flex justify-center">
                                <div class="text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <p class="mt-1 text-sm text-gray-600">Image preview will appear here</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Rental Details -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-4">Rental Details</h3>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="min_rental_duration" class="block text-sm font-medium text-gray-700">Minimum
                                    Rental Duration (days)*</label>
                                <input type="number" name="min_rental_duration" id="min_rental_duration" min="1"
                                    required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    value="{{ old('min_rental_duration', 7) }}">
                                @error('min_rental_duration')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="weekly_rent" class="block text-sm font-medium text-gray-700">Weekly Rent
                                    ($)*</label>
                                <input type="number" name="weekly_rent" id="weekly_rent" min="0" step="0.01"
                                    required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    value="{{ old('weekly_rent') }}">
                                @error('weekly_rent')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="min_deposit" class="block text-sm font-medium text-gray-700">Minimum Deposit
                                    ($)*</label>
                                <input type="number" name="min_deposit" id="min_deposit" min="0" step="0.01"
                                    required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    value="{{ old('min_deposit') }}">
                                @error('min_deposit')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Additional Information -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-4">Additional Information</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="condition" class="block text-sm font-medium text-gray-700">Condition*</label>
                                <select name="condition" id="condition" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    @foreach ($conditions as $condition)
                                        <option value="{{ $condition }}"
                                            {{ old('condition', 'good') == $condition ? 'selected' : '' }}>
                                            {{ ucfirst(str_replace('_', ' ', $condition)) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('condition')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="delivery_option" class="block text-sm font-medium text-gray-700">Delivery
                                    Option*</label>
                                <select name="delivery_option" id="delivery_option" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    @foreach ($deliveryOptions as $option)
                                        <option value="{{ $option }}"
                                            {{ old('delivery_option') == $option ? 'selected' : '' }}>
                                            {{ ucfirst(str_replace('_', ' ', $option)) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('delivery_option')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Featured Item Toggle -->
                    <div class="flex items-center mb-6">
                        <input type="checkbox" name="is_featured" id="is_featured" value="1"
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                            {{ old('is_featured') ? 'checked' : '' }}>
                        <label for="is_featured" class="ml-2 block text-sm text-gray-700">
                            Feature this item on homepage
                        </label>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Create Item
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Image Preview Script -->
    <script>
        document.getElementById('image').addEventListener('change', function(e) {
            const previewContainer = document.getElementById('image-preview');
            const file = e.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    previewContainer.innerHTML = `
          <img src="${event.target.result}" alt="Preview" class="h-48 w-full object-contain rounded-md">
        `;
                };
                reader.readAsDataURL(file);
            } else {
                previewContainer.innerHTML = `
        <div class="text-center">
          <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
          </svg>
          <p class="mt-1 text-sm text-gray-600">Image preview will appear here</p>
        </div>
      `;
            }
        });
    </script>
@endsection
