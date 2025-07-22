@extends('admin.dashboard')
@section('content')
    <div>
        <div class="w-full min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 p-4 md:p-6 lg:p-8">
            <div class="max-w-7xl mx-auto">
                <header class="mb-8">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <h1 class="text-3xl font-bold text-slate-800 mb-2">Rent-Ease Management Dashboard</h1>
                            <p class="text-slate-600">Manage your rental items and appliances efficiently</p>
                        </div>
                    </div>
            </div>
            </header>


            {{-- header --}}
            <div class="grid grid-cols-1 md:grid-cols-4 py-6 gap-6">
                <!-- Total Items Card -->
                <div
                    class="bg-white rounded-xl p-6 shadow-sm border border-slate-200 hover:shadow-md transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-800 mb-1">{{ $totalItems }}</h3>
                    <p class="text-slate-500 text-sm font-medium">Total Items</p>
                </div>

                <!-- Active Renting Card -->
                <div
                    class="bg-white rounded-xl p-6 shadow-sm border border-slate-200 hover:shadow-md transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-green-50 rounded-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-800 mb-1">{{ $totalOrders }}</h3>
                    <p class="text-slate-500 text-sm font-medium">Active Orders</p>
                </div>

                <!-- Total Revenue Card -->
                <div
                    class="bg-white rounded-xl p-6 shadow-sm border border-slate-200 hover:shadow-md transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-purple-50 rounded-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-800 mb-1">Rs. {{ $totalRevenue }}</h3>
                    <p class="text-slate-500 text-sm font-medium">Total Revenue</p>
                </div>

                {{-- users --}}
                <div
                    class="bg-white rounded-xl p-6 shadow-sm border border-slate-200 hover:shadow-md transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-purple-50 rounded-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-800 mb-1">{{ $totalUsers }}</h3>
                    <p class="text-slate-500 text-sm font-medium">Total Users</p>
                </div>
            </div>

            {{-- recent items --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <div class="lg:col-span-2 bg-white rounded-xl p-6 shadow-sm border border-slate-200">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-semibold text-slate-800">Recent Items</h2>
                        <button class="text-primary-600 hover:text-primary-700 text-sm font-medium transition-colors">
                            View All
                        </button>
                    </div>
                    <div class="space-y-4">
                        @foreach ($recentItems as $item)
                            <div class="flex items-center gap-4 p-4 rounded-lg hover:bg-slate-50 transition-colors">
                                @if ($item->image_path)
                                    <img class="h-10 w-10 rounded-full object-cover"
                                        src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}">
                                @else
                                    <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                        <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                @endif
                                <div class="flex-1">
                                    <h3 class="font-semibold text-slate-800">{{ $item->name }}</h3>
                                    <p class="text-slate-600 text-sm">{{ $item->category->name ?? 'No Category' }}</p>
                                    <div class="flex items-center gap-4 mt-1">
                                        <span class="text-sm text-slate-500">{{ $item->user->name ?? 'No Username' }}</span>
                                        <span class="text-sm font-semibold text-green-600">Rs.
                                            {{ $item->weekly_rent }}/week</span>
                                    </div>
                                </div>
                                <div class="flex flex-col items-end gap-2">
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 text-xs rounded-full font-medium {{ $item->is_available ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-700' }}">
                                        @if ($item->is_available)
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        @else
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        @endif
                                        {{ $item->is_available ? 'Available' : 'Unavailable' }}
                                    </span>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

                {{-- activity --}}
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4 pb-4 border-b border-gray-100">Recent Activity and
                        Orders</h2>
                    <div class="space-y-5">
                        @foreach ($recentOrders as $order)
                            <div class="flex items-start gap-4 hover:bg-gray-50/80 p-3 -mx-3 rounded-lg transition-colors">
                                <div
                                    class="w-9 h-9 bg-blue-50 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <span class="material-symbols-outlined text-blue-500 text-base">receipt</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex justify-between items-start gap-2">
                                        <p class="text-sm font-medium text-gray-800 truncate">
                                            Order #{{ $order->id }} • {{ $order->user->name ?? 'Guest' }}
                                        </p>
                                        <span
                                            class="text-xs font-medium bg-blue-100 text-blue-800 px-2 py-0.5 rounded-full whitespace-nowrap">
                                            Rs {{ number_format($order->total, 2) }}
                                        </span>
                                    </div>
                                    <div class="flex flex-wrap items-center gap-x-3 gap-y-1 mt-1.5">
                                        <p class="text-xs text-gray-500 flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[1.1em]">schedule</span>
                                            {{ $order->created_at->diffForHumans() }}
                                        </p>
                                        @if ($order->status)
                                            <p class="text-xs text-gray-500 flex items-center gap-1">
                                                <span class="material-symbols-outlined text-[1.1em]">flag</span>
                                                {{ ucfirst($order->status) }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- financial overview --}}
            <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-200">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-semibold text-slate-800">Financial Overview</h2>
                    <div class="relative">
                        <details class="relative">
                            <summary
                                class="bg-slate-100 hover:bg-slate-200 px-3 py-2 rounded-lg text-sm cursor-pointer transition-colors">
                                This Month
                            </summary>
                            <div
                                class="absolute right-0 top-full mt-2 bg-white border border-slate-200 rounded-lg shadow-lg p-2 z-10 min-w-32">
                                <button class="block w-full text-left px-3 py-2 text-sm hover:bg-slate-50 rounded">
                                    This Week
                                </button>
                                <button class="block w-full text-left px-3 py-2 text-sm hover:bg-slate-50 rounded">
                                    This Month
                                </button>
                                <button class="block w-full text-left px-3 py-2 text-sm hover:bg-slate-50 rounded">
                                    This Year
                                </button>
                            </div>
                        </details>
                    </div>
                </div>
                <div class="space-y-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-slate-600 text-sm">Total Revenue</p>
                            <p class="text-2xl font-bold text-slate-800">Rs. {{ $totalRevenue }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-green-600 text-sm font-semibold">+15.2%</p>
                            <p class="text-slate-500 text-xs">vs last month</p>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-slate-600">Collected Rent Revenue</span>
                            <span class="font-semibold text-slate-800">Rs. {{ $totalRevenue }}</span>
                        </div>
                        <div class="w-full bg-slate-200 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: 89%"></div>
                        </div>
                    </div>
                    </div>
                    <div class="border-t border-slate-200 pt-4">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-slate-600 text-sm">Discounts</span>
                            <span class="font-semibold text-slate-800">Rs. 00</span>
                        </div>
                            <div class="flex justify-between">
                                <span class="text-slate-500">Other</span> <span>Rs. 00</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
