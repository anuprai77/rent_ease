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
            </div>
        </section>

        {{-- featured items --}}
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h3 class="text-3xl font-bold text-gray-900 mb-4">Featured Items</h3>
                    <p class="text-gray-600 text-lg">Handpicked rentals for you</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach ($items as $item)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 max-w-md mx-auto">
                        <div class="relative">
                            <img src="{{ $item->image_path ? asset('storage/' . $item->image_path) : 'https://via.placeholder.com/1000x300?text=No+Image' }}"
                                alt="{{ $item->name }}" class="w-full h-48 object-cover" loading="lazy" />
                            @if ($item->is_featured)
                            <div class="absolute top-4 left-4 bg-primary-600 text-white px-3 py-1 rounded-full text-xs font-semibold shadow-sm">
                                Featured
                            </div>
                            @endif
                        </div>
                        <div class="p-6">
                            <h4 class="text-xl font-semibold text-gray-900 mb-2 line-clamp-2">{{ $item->name }}</h4>
                            <p class="text-gray-600 mb-4 flex items-center text-sm"><span class="material-symbols-outlined text-base mr-1">Category</span>{{ $item->category->name ?? 'Uncategorized' }}</p>
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4">
                                <div class="text-2xl font-bold text-primary-600">Rs. {{ number_format($item->weekly_rent) }}<span class="text-sm text-gray-500 font-normal">/week</span></div>
                                <div class="flex flex-wrap gap-2 text-sm text-gray-500">
                                    <span class="flex items-center bg-gray-100 px-2 py-1 rounded"><span class="material-symbols-outlined text-sm mr-1">Build</span>{{ ucfirst($item->condition) }}</span>
                                </div>
                            </div>
                            <a href="{{ route('items.show', $item->id) }}" class="block text-center py-3 px-4 rounded-lg hover:bg-back/10 font-semibold text-sm sm:text-base">View Details</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="py-16 bg-white overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h3 class="text-3xl font-bold text-gray-900 mb-4">What Our Renters Say?</h3>
                    <p class="text-gray-600 text-lg">Hear from our satisfied customers</p>
                </div>

                <!-- Scroll wrapper -->
                <div id="testimonialScroll" class="flex space-x-6 overflow-x-auto no-scrollbar scroll-smooth">
                    @foreach (range(1, 8) as $i)
                    <div class="min-w-[300px] max-w-sm flex-shrink-0 bg-white rounded-xl shadow-md hover:shadow-2xl hover:shadow-blue-200 transition duration-300 transform hover:-translate-y-2 p-6">
                        <p class="text-gray-600 mb-4 italic">
                            "{{ $i === 1 ? 'Rent-Ease made renting a breeze! I found the perfect furniture for my apartment in no time.' : ($i === 2 ? 'The variety of items and easy booking process is unmatched. Highly recommend!' : 'Listing my items was so simple, and I started earning extra income right away!') }}"
                        </p>
                        <div>
                            <p class="font-semibold text-gray-900">
                                {{ $i === 1 ? 'Sujal Subba' : ($i === 2 ? 'Ramesh Nembang' : ' Manoj Bahadur' ) }}
                            </p>
                            <p class="text-sm text-gray-500">
                                {{ $i === 1 ? 'Kathmandu' : ($i === 2 ? 'Pokhara' : 'Lalitpur') }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- why choose rend-ease --}}
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h3 class="text-3xl font-bold text-gray-900 mb-4">Why Choose Rent-Ease?</h3>
                    <p class="text-gray-600 text-lg">Discover the benefits of renting with us</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div class="text-center bg-white rounded-xl p-6 shadow-md hover:shadow-2xl hover:shadow-blue-200 transition duration-300 transform hover:-translate-y-2">
                        <span class="material-symbols-outlined text-4xl text-blue-600 mb-4">Quality</span>
                        <h4 class="text-xl font-semibold text-gray-900 mb-2">Verified Products</h4>
                        <p class="text-gray-600">Secure transactions and verified listings ensure peace of mind.</p>
                    </div>
                    <div class="text-center bg-white rounded-xl p-6 shadow-md hover:shadow-2xl hover:shadow-blue-200 transition duration-300 transform hover:-translate-y-2">
                        <span class="material-symbols-outlined text-4xl text-blue-600 mb-4">Inventory</span>
                        <h4 class="text-xl font-semibold text-gray-900 mb-2">Wide Selection</h4>
                        <p class="text-gray-600">Choose from a vast range of items and appliances in your area.</p>
                    </div>
                    <div class="text-center bg-white rounded-xl p-6 shadow-md hover:shadow-2xl hover:shadow-blue-200 transition duration-300 transform hover:-translate-y-2">
                        <span class="material-symbols-outlined text-4xl text-blue-600 mb-4">24/7 Support</span>
                        <h4 class="text-xl font-semibold text-gray-900 mb-2">Support Agent</h4>
                        <p class="text-gray-600">Our team is here to assist you anytime, anywhere.</p>
                    </div>
                    <div class="text-center bg-white rounded-xl p-6 shadow-md hover:shadow-2xl hover:shadow-blue-200 transition duration-300 transform hover:-translate-y-2">
                        <span class="material-symbols-outlined text-4xl text-blue-600 mb-4">Affordable </span>
                        <h4 class="text-xl font-semibold text-gray-900 mb-2">Savings</h4>
                        <p class="text-gray-600">Rent high-quality items at budget-friendly prices.</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- call to action --}}
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h3 class="text-3xl font-bold text-gray-900 mb-4">
                        Ready to Find Your Desired Items and Appliances?
                    </h3>
                    <p class="text-xl text-gray-600 mb-8">
                        Join thousands of satisfied renters who found their perfect items
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <!-- Primary button -->
                        <a href="{{ route('items.index') }}"
                            class="px-8 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 shadow-md hover:shadow-lg transition-all duration-200 transform hover:scale-105">
                            Browse Our Catalogue
                        </a>

                        <!-- Secondary button -->
                        @auth
                        <a href="{{ route('items.create') }}"
                            class="px-8 py-3 border-2 border-blue-600 text-blue-600 rounded-lg font-semibold hover:bg-blue-50 transition-all duration-200 transform hover:scale-105">
                            List Your Items
                        </a>
                        @else
                        <a href="{{ route('login') }}"
                            class="px-8 py-3 border-2 border-blue-600 text-blue-600 rounded-lg font-semibold hover:bg-blue-50 transition-all duration-200 transform hover:scale-105">
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