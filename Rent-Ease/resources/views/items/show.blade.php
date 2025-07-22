@extends('layouts.app')
@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <!-- Back button and header -->
            <div class="flex justify-between items-center mb-6">
                <a href="{{ route('items.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    Back to Items
                </a>
            </div>

            <!-- Main card -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <!-- Item image -->
                <div class="relative h-64 w-full bg-gray-100 flex items-center justify-center">
                    @if ($item->image_path)
                        <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}"
                            class="h-full w-full object-contain">
                    @else
                        <svg class="h-32 w-32 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    @endif
                    @if ($item->is_featured)
                        <span
                            class="absolute top-4 right-4 bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                            Featured
                        </span>
                    @endif
                </div>

                <!-- Item details -->
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">{{ $item->name }}</h1>
                            <div class="flex items-center mt-1">
                                <span class="text-sm text-gray-500">Category: </span>
                                <span
                                    class="ml-1 text-sm font-medium text-gray-700">{{ $item->category->name ?? 'Uncategorized' }}</span>
                            </div>
                        </div>
                        <span
                            class="px-2.5 py-0.5 rounded-full text-xs font-semibold 
                        {{ $item->is_available ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ $item->is_available ? 'Available' : 'Unavailable' }}
                        </span>
                    </div>

                    <!-- Condition and Delivery -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div class="bg-gray-50 p-3 rounded-lg">
                            <h3 class="text-xs font-medium text-gray-500 mb-1">Condition</h3>
                            <span
                                class="text-sm font-medium 
                            @if ($item->condition === 'new') text-green-600
                            @elseif($item->condition === 'like_new') text-blue-600
                            @elseif($item->condition === 'good') text-yellow-600
                            @elseif($item->condition === 'fair') text-orange-600
                            @else text-red-600 @endif">
                                {{ ucfirst(str_replace('_', ' ', $item->condition)) }}
                            </span>
                        </div>
                        <div class="bg-gray-50 p-3 rounded-lg">
                            <h3 class="text-xs font-medium text-gray-500 mb-1">Delivery Option</h3>
                            <span class="text-sm font-medium text-gray-700">
                                {{ ucfirst(str_replace('_', ' ', $item->delivery_option)) }}
                            </span>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <h3 class="text-sm font-medium text-gray-700 mb-2">Description</h3>
                        <p class="text-gray-600">{{ $item->description ?? 'No description provided.' }}</p>
                    </div>

                    <!-- Pricing -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        <div class="bg-blue-50 p-3 rounded-lg">
                            <h3 class="text-xs font-medium text-blue-500 mb-1">Weekly Rent</h3>
                            <p class="text-lg font-bold text-blue-700">${{ number_format($item->weekly_rent, 2) }}</p>
                        </div>
                        <div class="bg-purple-50 p-3 rounded-lg">
                            <h3 class="text-xs font-medium text-purple-500 mb-1">Minimum Deposit</h3>
                            <p class="text-lg font-bold text-purple-700">${{ number_format($item->min_deposit, 2) }}</p>
                        </div>
                        <div class="bg-green-50 p-3 rounded-lg">
                            <h3 class="text-xs font-medium text-green-500 mb-1">Minimum Rental Duration</h3>
                            <p class="text-lg font-bold text-green-700">{{ $item->min_rental_duration }} days</p>
                        </div>
                    </div>

                    <!-- Owner and dates -->
                    <div class="border-t border-gray-200 pt-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-500">
                            <div>
                                <span class="font-medium">Listed by:</span>
                                <span>{{ $item->user->name }}</span>
                            </div>
                            <div>
                                <span class="font-medium">Last updated:</span>
                                <span>{{ $item->updated_at->format('M d, Y h:i A') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Action buttons -->
                    <div class="mt-6 flex justify-end space-x-3">
                        @if ($item->is_available)
                            @auth
                                @if (Auth()->id() !== $item->user_id)
                                    <form action="{{ route('cart.add', $item->id) }}" method="POST"
                                        class="flex flex-col sm:flex-row items-start sm:items-end gap-4">
                                        @csrf
                                        <small class="text-sm text-green-600 order-first sm:order-none sm:mb-1">
                                            * 10% discount for rentals longer than 4 weeks
                                        </small>

                                        <div class="flex flex-col w-full sm:w-auto">
                                            <label class="text-sm font-medium text-gray-700 mb-1">Weeks:</label>
                                            <input type="number" name="weeks" value="1" min="1"
                                                class="w-full sm:w-16 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                        </div>

                                        <button type="submit"
                                            class="w-full sm:w-auto px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                            Add to Cart
                                        </button>
                                    </form>
                                @else
                                    <div class="text-sm text-red-600 font-semibold">
                                        You cannot rent your own item.
                                    </div>
                                @endif
                            @else
                                <a href="{{ route('login') }}"
                                    class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Login to Rent
                                </a>
                            @endauth
                        @else
                            <span class="text-red-500 font-medium">This item is currently unavailable</span>
                        @endif
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
