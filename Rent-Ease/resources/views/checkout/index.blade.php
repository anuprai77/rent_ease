@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8 max-w-3xl">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Checkout</h2>

        <form method="POST" action="{{ route('checkout.process') }}" class="bg-white rounded-lg shadow-md p-6">
            @csrf

            <div class="space-y-4 mb-8">
                <h3 class="text-lg font-medium text-gray-800 mb-4">Contact Information</h3>

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <input type="text" id="name" name="name" placeholder="John Doe" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="email" name="email" placeholder="john@example.com" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Shipping Address</label>
                    <textarea id="address" name="address" rows="3" placeholder="123 Main St, City, Country" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
            </div>

            <div class="mb-8">
                <h3 class="text-lg font-medium text-gray-800 mb-4">Order Summary</h3>
                <div class="space-y-3 border-b border-gray-200 pb-4">
                    @foreach ($cart as $item)
                        <div class="border p-4 rounded-md mb-3">
                            <h3 class="font-semibold">{{ $item['name'] }}</h3>
                            <p>Weeks: {{ $item['weeks'] }}</p>
                            <p>Base Price: Rs. {{ number_format($item['price'] * $item['weeks'], 2) }}</p>

                            @if ($item['discount'] > 0)
                                <p class="text-green-600">Discount: {{ $item['discount'] * 100 }}%</p>
                                <p class="text-green-600">You save: Rs. {{ number_format($item['discount_amount'], 2) }}</p>
                            @endif

                            <p><strong>Final Price: Rs. {{ number_format($item['final_price'], 2) }}</strong></p>
                        </div>
                    @endforeach

                    <div class="mt-4 text-right font-bold text-lg">
                        Total: Rs. {{ number_format($total, 2) }}
                    </div>
                </div>

            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="px-6 py-3 bg-blue-600 text-white font-medium rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                    Confirm and Pay
                </button>
            </div>
        </form>
    </div>
@endsection
