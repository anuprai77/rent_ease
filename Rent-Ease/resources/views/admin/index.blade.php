@extends('admin.dashboard')
@section('content')
    <div>
        <div class="w-full min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 p-4 md:p-6 lg:p-8">
            <div class="max-w-7xl mx-auto">
                <header class="mb-8">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <h1 class="text-3xl font-bold text-slate-800 mb-2">Rent-Ease Management Dashboard</h1>
                            <p class="text-slate-600">Manage your rental items and properties efficiently</p>
                        </div>
                        <div class="flex items-center gap-4">
                            <button
                                class="bg-black hover:bg-primary-700 hover:bg-black/70 text-white px-6 py-2 rounded-lg transition-colors flex items-center gap-2">
                                Add Property
                            </button>
                        </div>
                    </div>
            </div>
            </header>
            {{-- <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8"> --}}


                {{-- header --}}
<div class="grid grid-cols-1 md:grid-cols-3 py-6 gap-6">
    <!-- Total Items Card -->
    <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-200 hover:shadow-md transition-all duration-300">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            </div>
        </div>
        <h3 class="text-2xl font-bold text-slate-800 mb-1">247</h3>
        <p class="text-slate-500 text-sm font-medium">Total Items</p>
    </div>

    <!-- Active Renting Card -->
    <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-200 hover:shadow-md transition-all duration-300">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-green-50 rounded-lg flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            {{-- <span class="text-xs px-2 py-1 bg-green-50 text-green-600 font-semibold rounded-full">+8%</span> --}}
        </div>
        <h3 class="text-2xl font-bold text-slate-800 mb-1">89</h3>
        <p class="text-slate-500 text-sm font-medium">Active Rentals</p>
    </div>

    <!-- Total Revenue Card -->
    <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-200 hover:shadow-md transition-all duration-300">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-purple-50 rounded-lg flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            {{-- <span class="text-xs px-2 py-1 bg-green-50 text-green-600 font-semibold rounded-full">+15%</span> --}}
        </div>
        <h3 class="text-2xl font-bold text-slate-800 mb-1">$47,280</h3>
        <p class="text-slate-500 text-sm font-medium">Total Revenue</p>
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
                        <div class="flex items-center gap-4 p-4 rounded-lg hover:bg-slate-50 transition-colors">
                            <img src="https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=80&amp;h=80&amp;fit=crop&amp;crop=center"
                                alt="Modern apartment" keywords="apartment, modern, rental, property"
                                class="w-16 h-16 rounded-lg object-cover" />
                            <div class="flex-1">
                                <h3 class="font-semibold text-slate-800">Luxury Downtown Apartment</h3>
                                <p class="text-slate-600 text-sm">123 Main Street, Downtown</p>
                                <div class="flex items-center gap-4 mt-1">
                                    <span class="text-sm text-slate-500">2 bed • 2 bath</span>
                                    <span class="text-sm font-semibold text-green-600">$2,400/month</span>
                                </div>
                            </div>
                            <div class="flex flex-col items-end gap-2">
                                <span
                                    class="px-2 py-1 bg-green-100 text-green-700 text-xs rounded-full font-medium">Occupied</span>
                                <button class="text-slate-400 hover:text-slate-600 transition-colors">
                                    <span class="material-symbols-outlined text-sm">more_vert</span>
                                </button>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 p-4 rounded-lg hover:bg-slate-50 transition-colors">
                            <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=80&amp;h=80&amp;fit=crop&amp;crop=center"
                                alt="Family house" keywords="house, family, rental, suburban"
                                class="w-16 h-16 rounded-lg object-cover" />
                            <div class="flex-1">
                                <h3 class="font-semibold text-slate-800">Suburban Family House</h3>
                                <p class="text-slate-600 text-sm">456 Oak Avenue, Suburbs</p>
                                <div class="flex items-center gap-4 mt-1">
                                    <span class="text-sm text-slate-500">4 bed • 3 bath</span>
                                    <span class="text-sm font-semibold text-green-600">$3,200/month</span>
                                </div>
                            </div>
                            <div class="flex flex-col items-end gap-2">
                                <span
                                    class="px-2 py-1 bg-yellow-100 text-yellow-700 text-xs rounded-full font-medium">Available</span>
                                <button class="text-slate-400 hover:text-slate-600 transition-colors">
                                    <span class="material-symbols-outlined text-sm">more_vert</span>
                                </button>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 p-4 rounded-lg hover:bg-slate-50 transition-colors">
                            <img src="https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=80&amp;h=80&amp;fit=crop&amp;crop=center"
                                alt="Studio apartment" keywords="studio, apartment, compact, urban"
                                class="w-16 h-16 rounded-lg object-cover" />
                            <div class="flex-1">
                                <h3 class="font-semibold text-slate-800">Cozy Studio Apartment</h3>
                                <p class="text-slate-600 text-sm">789 Pine Street, Midtown</p>
                                <div class="flex items-center gap-4 mt-1">
                                    <span class="text-sm text-slate-500">Studio • 1 bath</span>
                                    <span class="text-sm font-semibold text-green-600">$1,800/month</span>
                                </div>
                            </div>
                            <div class="flex flex-col items-end gap-2">
                                <span
                                    class="px-2 py-1 bg-red-100 text-red-700 text-xs rounded-full font-medium">Maintenance</span>
                                <button class="text-slate-400 hover:text-slate-600 transition-colors">
                                    <span class="material-symbols-outlined text-sm">more_vert</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-200">
                    <h2 class="text-xl font-semibold text-slate-800 mb-6">Recent Activity</h2>
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined text-blue-600 text-sm">person_add</span>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-slate-800">New tenant registered</p>
                                <p class="text-xs text-slate-500 mt-1">Sarah Johnson - Apt 204</p>
                                <p class="text-xs text-slate-400">2 hours ago</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined text-green-600 text-sm">payments</span>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-slate-800">Rent payment received</p>
                                <p class="text-xs text-slate-500 mt-1">$2,400 from Mike Chen</p>
                                <p class="text-xs text-slate-400">4 hours ago</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined text-yellow-600 text-sm">build</span>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-slate-800">Maintenance request</p>
                                <p class="text-xs text-slate-500 mt-1">Kitchen faucet - Unit 12B</p>
                                <p class="text-xs text-slate-400">6 hours ago</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined text-purple-600 text-sm">calendar_month</span>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-slate-800">Property inspection</p>
                                <p class="text-xs text-slate-500 mt-1">Scheduled for tomorrow</p>
                                <p class="text-xs text-slate-400">8 hours ago</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined text-red-600 text-sm">warning</span>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-slate-800">Overdue payment alert</p>
                                <p class="text-xs text-slate-500 mt-1">Unit 305 - 5 days overdue</p>
                                <p class="text-xs text-slate-400">1 day ago</p>
                            </div>
                        </div>
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
                            <p class="text-2xl font-bold text-slate-800">$47,280</p>
                        </div>
                        <div class="text-right">
                            <p class="text-green-600 text-sm font-semibold">+15.2%</p>
                            <p class="text-slate-500 text-xs">vs last month</p>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-slate-600">Collected Rent</span>
                            <span class="font-semibold text-slate-800">$42,150</span>
                        </div>
                        <div class="w-full bg-slate-200 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: 89%"></div>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-slate-600">Outstanding Payments</span>
                            <span class="font-semibold text-red-600">$5,130</span>
                        </div>
                        <div class="w-full bg-slate-200 rounded-full h-2">
                            <div class="bg-red-500 h-2 rounded-full" style="width: 11%"></div>
                        </div>
                    </div>
                    <div class="border-t border-slate-200 pt-4">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-slate-600 text-sm">Expenses</span>
                            <span class="font-semibold text-slate-800">$8,450</span>
                        </div>
                        <div class="space-y-2 text-xs">
                            <div class="flex justify-between">
                                <span class="text-slate-500">Maintenance</span> <span>$3,200</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-500">Insurance</span> <span>$2,800</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-500">Property Tax</span> <span>$1,950</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-500">Other</span> <span>$500</span>
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
