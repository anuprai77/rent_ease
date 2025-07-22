@extends('layouts.app')

@section('content')
    <div id="webcrumbs">
        <div class="w-full min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 p-4 md:p-6 lg:p-8">
            <div class="max-w-7xl mx-auto">
                <header class="mb-8">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <h1 class="text-3xl font-bold text-slate-800 mb-2">Item Management Dashboard</h1>
                            <p class="text-slate-600">Manage your rental item and properties efficiently</p>
                        </div>
                        <div class="flex items-center gap-4">
                            <a href="{{ route('items.create') }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Add Item
                            </a>
                        </div>
                </header>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div
                        class="bg-white rounded-xl p-6 shadow-sm border border-slate-200 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <span class="material-symbols-outlined text-blue-600">Total Rentals</span>
                            </div>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-800 mb-1">{{ $totalRentals }}</h3>
                        <p class="text-slate-600 text-sm">Total Numbers</p>
                    </div>
                    <div
                        class="bg-white rounded-xl p-6 shadow-sm border border-slate-200 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <span class="material-symbols-outlined text-green-600">Upcoming Returns</span>
                            </div>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-800 mb-1">{{ $upcomingReturns }}</h3>
                        <p class="text-slate-600 text-sm">Active Bookings</p>
                    </div>
                    <div
                        class="bg-white rounded-xl p-6 shadow-sm border border-slate-200 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                                <span class="material-symbols-outlined text-red-600">Active Rentals</span>
                            </div>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-800 mb-1">{{ $activeRentals }}</h3>
                        <p class="text-slate-600 text-sm">Active Bookings</p>
                    </div>
                    <div
                        class="bg-white rounded-xl p-6 shadow-sm border border-slate-200 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                <span class="material-symbols-outlined text-purple-600">Revenue</span>
                            </div>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-800 mb-1">{{ $totalRevenue }}</h3>
                        <p class="text-slate-600 text-sm">Total Amount</p>
                    </div>
                </div>
                <div class="grid grid-cols-1  gap-6 mb-8">
                    <div class="lg:col-span-2 bg-white rounded-xl p-6 shadow-sm border border-slate-200">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-xl font-semibold text-slate-800">Recent Properties</h2>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center gap-4 p-4 rounded-lg hover:bg-slate-50 transition-colors">
                                <div class="container mx-auto px-4 py-8">
                                    <div class="flex justify-between items-center mb-6">
                                        <h1 class="text-2xl font-bold text-gray-800">Manage Rental Items</h1>
                                        <a href="{{ route('items.create') }}"
                                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Add New Item
                                        </a>
                                    </div>

                                    @if (session('success'))
                                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6"
                                            role="alert">
                                            <span class="block sm:inline">{{ session('success') }}</span>
                                        </div>
                                    @endif

                                    <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                                        <div class="overflow-x-auto">
                                            <table class="min-w-full divide-y divide-gray-200">
                                                <thead class="bg-gray-50">
                                                    <tr>
                                                        <th scope="col"
                                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                            Item
                                                        </th>
                                                        <th scope="col"
                                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                            Category
                                                        </th>
                                                        <th scope="col"
                                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                            Weekly Rent
                                                        </th>
                                                        <th scope="col"
                                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                            Condition
                                                        </th>
                                                        <th scope="col"
                                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                            Status
                                                        </th>
                                                        <th scope="col"
                                                            class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                            Actions
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-gray-200">
                                                    @forelse($items as $item)
                                                        <tr class="hover:bg-gray-50">
                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                <div class="flex items-center">
                                                                    <div class="flex-shrink-0 h-10 w-10">
                                                                        @if ($item->image_path)
                                                                            <img class="h-10 w-10 rounded-full object-cover"
                                                                                src="{{ asset('storage/' . $item->image_path) }}"
                                                                                alt="{{ $item->name }}">
                                                                        @else
                                                                            <div
                                                                                class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                                                                <svg class="h-6 w-6 text-gray-400"
                                                                                    fill="none" stroke="currentColor"
                                                                                    viewBox="0 0 24 24">
                                                                                    <path stroke-linecap="round"
                                                                                        stroke-linejoin="round"
                                                                                        stroke-width="1"
                                                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                                                    </path>
                                                                                </svg>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                    <div class="ml-4">
                                                                        <div class="text-sm font-medium text-gray-900">
                                                                            {{ $item->name }}</div>
                                                                        <div class="text-sm text-gray-500">
                                                                            {{ $item->min_rental_duration }} days min
                                                                            rental
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                <div class="text-sm text-gray-900">
                                                                    {{ $item->category->name ?? 'Uncategorized' }}</div>
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                <div class="text-sm text-gray-900">
                                                                    Rs. {{ number_format($item->weekly_rent, 2) }}</div>
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                <span
                                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                @if ($item->condition === 'new') bg-green-100 text-green-800
                                @elseif($item->condition === 'like_new') bg-blue-100 text-blue-800
                                @elseif($item->condition === 'good') bg-yellow-100 text-yellow-800
                                @elseif($item->condition === 'fair') bg-orange-100 text-orange-800
                                @else bg-red-100 text-red-800 @endif">
                                                                    {{ ucfirst(str_replace('_', ' ', $item->condition)) }}
                                                                </span>
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                <span
                                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $item->is_available ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                                                    {{ $item->is_available ? 'Available' : 'Unavailable' }}
                                                                </span>
                                                            </td>
                                                            <td
                                                                class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                                <div class="flex justify-end space-x-2">
                                                                    <a href="{{ route('items.show', $item->id) }}"
                                                                        class="text-blue-600 hover:text-blue-900"
                                                                        title="View">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            class="h-5 w-5" fill="none"
                                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                                            <path stroke-linecap="round"
                                                                                stroke-linejoin="round" stroke-width="2"
                                                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                            <path stroke-linecap="round"
                                                                                stroke-linejoin="round" stroke-width="2"
                                                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                                        </svg>
                                                                    </a>
                                                                    <a href="{{ route('items.edit', $item->id) }}"
                                                                        class="text-indigo-600 hover:text-indigo-900"
                                                                        title="Edit">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            class="h-5 w-5" fill="none"
                                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                                            <path stroke-linecap="round"
                                                                                stroke-linejoin="round" stroke-width="2"
                                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                                        </svg>
                                                                    </a>
                                                                    <form action="{{ route('items.destroy', $item->id) }}"
                                                                        method="POST" class="inline">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="button"
                                                                            onclick="confirmDelete(this.form)"
                                                                            class="text-red-600 hover:text-red-900"
                                                                            title="Delete">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="h-5 w-5" fill="none"
                                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="2"
                                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                            </svg>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="6"
                                                                class="px-6 py-4 text-center text-sm text-gray-500">
                                                                No items found. <a href="{{ route('items.create') }}"
                                                                    class="text-blue-600 hover:text-blue-800">Create one
                                                                    now</a>.
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>

                                        @if ($items->hasPages())
                                            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                                                {{ $items->links() }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    {{-- rented item --}}
                    <div class="space-y-4">
                        @foreach ($rentedItems as $rented)
                            @php
                                $endDate = \Carbon\Carbon::parse($rented->start_date)->addWeeks($rented->weeks);
                                $now = \Carbon\Carbon::now();
                                $remaining = $endDate->diffForHumans($now, ['parts' => 2, 'short' => true]);
                                $isExpiringSoon = $now->diffInDays($endDate) <= 3;
                            @endphp

                            <div
                                class="bg-white shadow-md rounded-lg overflow-hidden border-l-4 {{ $isExpiringSoon ? 'border-red-500' : 'border-blue-500' }}">
                                <div class="p-5">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="text-lg font-bold text-gray-800 mb-1">
                                                {{ $rented->item->name ?? 'Item removed' }}
                                                @if (!$rented->item)
                                                    <span class="text-xs text-red-500 ml-2">(No longer available)</span>
                                                @endif
                                            </h3>
                                            <div class="flex flex-wrap gap-x-4 gap-y-2 text-sm text-gray-600">
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                    <span>Rented:
                                                        {{ optional($rented->start_date)->format('M j, Y') }}</span>
                                                </div>
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    <span>Duration: {{ $rented->weeks }} week(s)</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="bg-{{ $isExpiringSoon ? 'red' : 'blue' }}-100 text-{{ $isExpiringSoon ? 'red' : 'blue' }}-800 px-3 py-1 rounded-full text-sm font-semibold">
                                            {{ $remaining }}
                                        </div>
                                    </div>

                                    @if ($isExpiringSoon)
                                        <div class="mt-3 p-3 bg-red-50 rounded-lg flex items-center text-red-700">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                            </svg>
                                            <span>Expiring soon! Return before {{ $endDate->format('M j, Y') }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach

                        @if ($rentedItems->isEmpty())
                            <div class="text-center py-10">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                                <h3 class="mt-2 text-lg font-medium text-gray-900">No active rentals</h3>
                                <p class="mt-1 text-gray-500">You don't have any items rented at the moment.</p>
                                <div class="mt-6">
                                    <a href="{{ route('items.index') }}"
                                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Browse available items
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>


                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(form) {
            if (confirm('Are you sure you want to delete this item? This action cannot be undone.')) {
                form.submit();
            }
        }
    </script>
@endsection
