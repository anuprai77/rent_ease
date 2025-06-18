@extends('layouts.app')

@section('content')
    <div id="webcrumbs">
        <div class="w-full min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
            {{-- hero --}}
            <section class="relative py-20 lg:py-32">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center ">
                        <h2 class="text-4xl lg:text-6xl font-bold mb-6">Find Your Perfect Rental</h2>
                        <p class="text-xl lg:text-2xl mb-12 ">
                            Browse amazing Products and Items in your desired location
                        </p>
                        <div>
                            <a href="{{ route('items.index') }}"
                                class="inline-block px-6 py-3 bg-blue-500 text-white font-medium text-sm leading-tight uppercase rounded shadow-md hover:bg-blue-600 hover:shadow-lg focus:bg-blue-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-700 active:shadow-lg transition duration-150 ease-in-out">
                                Start Browsing
                            </a>
                        </div>
                    </div>
            </section>


            {{-- featured items --}}
            <section class="py-16 bg-white">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-12">
                        <h3 class="text-3xl font-bold text-gray-900 mb-4">Featured Items</h3>
                        <p class="text-gray-600 text-lg">Handpicked rentals for you</p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                        @foreach ($items as $item)
                            <div
                                class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 max-w-md mx-auto">
                                <div class="relative">
                                    <img src="{{ $item->image_path ? asset('storage/' . $item->image_path) : 'https://via.placeholder.com/1000x300?text=No+Image' }}"
                                        alt="{{ $item->name }}" class="w-full h-48 object-cover" loading="lazy" />

                                    @if ($item->is_featured)
                                        <div
                                            class="absolute top-4 left-4 bg-primary-600 text-white px-3 py-1 rounded-full text-xs font-semibold shadow-sm">
                                            Featured
                                        </div>
                                    @endif
                                </div>

                                <div class="p-6">
                                    <h4 class="text-xl font-semibold text-gray-900 mb-2 line-clamp-2">
                                        {{ $item->name }}
                                    </h4>

                                    <p class="text-gray-600 mb-4 flex items-center text-sm">
                                        <span class="material-symbols-outlined text-base mr-1">Category</span>
                                        {{ $item->category->name ?? 'Uncategorized' }}
                                    </p>

                                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4">
                                        <div class="text-2xl font-bold text-primary-600">
                                            Rs. {{ number_format($item->weekly_rent) }}
                                            <span class="text-sm text-gray-500 font-normal">/week</span>
                                        </div>

                                        <div class="flex flex-wrap gap-2 text-sm text-gray-500">
                                            <span class="flex items-center bg-gray-100 px-2 py-1 rounded">
                                                <span class="material-symbols-outlined text-sm mr-1">Build</span>
                                                {{ ucfirst($item->condition) }}
                                            </span>
                                             
                                        </div>
                                    </div>

                                    <a href="{{ route('items.show', $item->id) }}"
                                        class="block text-center py-3 px-4 rounded-lg hover:bg-back/10 font-semibold text-sm sm:text-base">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
            
            
{{-- category --}}
<section class="mb-16 h-min-96 p-12 m-12 py-12 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl shadow-lg">
    <div class="max-w-7xl mx-auto">
        <h2 class="text-4xl font-extrabold text-center text-gray-900 mb-12">Explore Categories</h2>
        <div class="flex flex-wrap justify-center gap-6 md:gap-8 lg:gap-10">
            @foreach($categories as $category)
                <a href="{{ route('items.index', ['category' => $category->id]) }}"
                   class="flex items-center justify-center px-8 py-4 bg-white text-gray-800 rounded-2xl
                          hover:bg-indigo-100 text-lg font-semibold
                          shadow-md border border-gray-200 transition-all duration-300
                          hover:shadow-lg hover:border-indigo-300 hover:text-indigo-800
                          hover:scale-105 focus:outline-none focus:ring-4 focus:ring-indigo-400 focus:ring-offset-2
                          min-w-[180px] text-center"> {{-- Added min-w and text-center for better sizing --}}
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
    </div>
</section>


            <x-test />

            <!-- Testimonials -->
            <section class="py-16 bg-gray-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-12">
                        <h3 class="text-3xl font-bold text-gray-900 mb-4">Why Choose RentHub?</h3>
                        <p class="text-gray-600 text-lg">We make renting easy and stress-free</p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <div class="text-center p-6 bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow">
                            <div
                                class="w-16 h-16 bg-primary-100 text-primary-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                <span class="material-symbols-outlined text-2xl">verified</span>
                            </div>
                            <h4 class="text-xl font-semibold text-gray-900 mb-3">Verified Properties</h4>
                            <p class="text-gray-600">
                                All properties are thoroughly verified and inspected before listing
                            </p>
                        </div>
                        <div class="text-center p-6 bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow">
                            <div
                                class="w-16 h-16 bg-primary-100 text-primary-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                <span class="material-symbols-outlined text-2xl">support_agent</span>
                            </div>
                            <h4 class="text-xl font-semibold text-gray-900 mb-3">24/7 Support</h4>
                            <p class="text-gray-600">Our dedicated support team is always ready to help you</p>
                        </div>
                        <div class="text-center p-6 bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow">
                            <div
                                class="w-16 h-16 bg-primary-100 text-primary-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                <span class="material-symbols-outlined text-2xl">security</span>
                            </div>
                            <h4 class="text-xl font-semibold text-gray-900 mb-3">Secure Payments</h4>
                            <p class="text-gray-600">Safe and secure payment processing with full protection</p>
                        </div>
                    </div>
                </div>
            </section>

            {{-- waw --}}
<section class="py-16 bg-blue-600">
    <div class="max-w-7xl mx-auto px-4 m-16 sm:px-6 lg:px-8">
        <div class="text-center">
            <h3 class="text-3xl font-bold text-white mb-4">Ready to Find Your Desired Items and Appliances?</h3>
            <p class="text-xl text-blue-100 mb-8">
                Join thousands of satisfied renters who found their perfect items
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <!-- Primary button -->
                <a href="{{ route('items.index') }}"
                    class="px-8 py-3 bg-white text-blue-800 rounded-lg font-semibold hover:bg-blue-50 hover:shadow-lg transition-all duration-200 transform hover:scale-105">
                    Browse Our Catalogue
                </a>
                <!-- Secondary button -->
                @auth
                <a href="{{ route('items.create') }}"
                    class="px-8 py-3 border-2 border-white text-white rounded-lg font-semibold hover:bg-white hover:text-blue-800 transition-all duration-200 transform hover:scale-105">
                    List Your Items
                </a>
                @else
                <a href="{{ route('login') }}"
                    class="px-8 py-3 border-2 border-white text-white rounded-lg font-semibold hover:bg-white hover:text-blue-800 transition-all duration-200 transform hover:scale-105">
                Login First to List your Item
                </a>
                @endauth
            </div>
        </div>
    </div>
</section>

        </div>
    </div>
@endsection
