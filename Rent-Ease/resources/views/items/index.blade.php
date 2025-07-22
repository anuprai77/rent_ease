@extends('layouts.app')
@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Browse Rental Items</h1>
            <p class="text-gray-600">Find the perfect item for your needs</p>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
        <form action="{{ route('items.index') }}" method="GET">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Search Input -->
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                           placeholder="Item name or description">
                </div>
                
                <!-- Category Filter -->
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <select name="category" id="category" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Condition Filter -->
                <div>
                    <label for="condition" class="block text-sm font-medium text-gray-700 mb-1">Condition</label>
                    <select name="condition" id="condition" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">All Conditions</option>
                        <option value="new" {{ request('condition') == 'new' ? 'selected' : '' }}>New</option>
                        <option value="like_new" {{ request('condition') == 'like_new' ? 'selected' : '' }}>Like New</option>
                        <option value="good" {{ request('condition') == 'good' ? 'selected' : '' }}>Good</option>
                        <option value="fair" {{ request('condition') == 'fair' ? 'selected' : '' }}>Fair</option>
                        <option value="poor" {{ request('condition') == 'poor' ? 'selected' : '' }}>Poor</option>
                    </select>
                </div>
                
                <!-- Price Range -->
                <div>
                    <label for="max_price" class="block text-sm font-medium text-gray-700 mb-1">Max Weekly Price</label>
                    <input type="number" name="max_price" id="max_price" value="{{ request('max_price') }}"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                           placeholder="Rs.0 - Rs. 1000+">
                </div>
            </div>
            
            <div class="flex justify-between items-center mt-4">
                <div class="text-sm text-gray-500">
                    {{ $items->total() }} items found
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('items.index') }}" class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Reset
                    </a>
                    <button type="submit" class="px-3 py-1 bg-blue-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-blue-700">
                        Apply Filters
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Items Grid -->
    @if($items->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($items as $item)
                <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                    <!-- Item Image -->
                    <div class="relative h-48 w-full bg-gray-100">
                        @if($item->image_path)
                            <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}" 
                                 class="h-full w-full object-cover">
                        @else
                            <div class="h-full w-full flex items-center justify-center text-gray-400">
                                <svg class="h-16 w-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                        
                        <!-- Featured Badge -->
                        @if($item->is_featured)
                            <span class="absolute top-2 right-2 bg-yellow-100 text-yellow-800 text-xs font-semibold px-2 py-0.5 rounded-full">
                                Featured
                            </span>
                        @endif
                        
                        <!-- Availability Badge -->
                        <span class="absolute bottom-2 left-2 text-xs font-semibold px-2 py-0.5 rounded-full 
                              {{ $item->is_available ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ $item->is_available ? 'Available' : 'Unavailable' }}
                        </span>
                    </div>
                    
                    <!-- Item Details -->
                    <div class="p-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-semibold text-gray-800 truncate">{{ $item->name }}</h3>
                                <p class="text-sm text-gray-500">{{ $item->category->name ?? 'Uncategorized' }}</p>
                            </div>
                            <span class="text-xs px-2 py-1 rounded-full 
                                  @if($item->condition === 'new') bg-green-100 text-green-800
                                  @elseif($item->condition === 'like_new') bg-blue-100 text-blue-800
                                  @elseif($item->condition === 'good') bg-yellow-100 text-yellow-800
                                  @elseif($item->condition === 'fair') bg-orange-100 text-orange-800
                                  @else bg-red-100 text-red-800
                                  @endif">
                                {{ ucfirst(str_replace('_', ' ', $item->condition)) }}
                            </span>
                        </div>
                        
                        <div class="mt-3 flex items-center justify-between">
                            <div>
                                <span class="text-lg font-bold text-gray-900">Rs. {{ number_format($item->weekly_rent, 2) }}</span>
                                <span class="text-xs text-gray-500">/week</span>
                            </div>
                            <span class="text-xs text-gray-500">{{ $item->min_rental_duration }} days min</span>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="px-4 py-3 bg-gray-50 border-t border-gray-100 flex justify-between">
                        <a href="{{ route('items.show', $item->id) }}" 
                           class="text-sm font-medium text-blue-600 hover:text-blue-800">
                            View Details
                        </a>
                        @if(auth()->id() === $item->user_id)
                            <div class="flex space-x-2">
                                <a href="{{ route('items.edit', $item->id) }}" 
                                   class="text-sm font-medium text-indigo-600 hover:text-indigo-800">
                                    Edit
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="mt-6">
            {{ $items->appends(request()->query())->links() }}
        </div>
    @else
        <div class="bg-white rounded-lg shadow-sm p-8 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h3 class="mt-2 text-lg font-medium text-gray-900">No items found</h3>
            <p class="mt-1 text-sm text-gray-500">Try adjusting your search or filter to find what you're looking for.</p>
            <div class="mt-6">
                <a href="{{ route('items.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700">
                    Clear Filters
                </a>
            </div>
        </div>
    @endif
</div>
@endsection