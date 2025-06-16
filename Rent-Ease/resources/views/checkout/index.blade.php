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
                @foreach($cart as $item)
                <div class="flex justify-between">
                    <div>
                        <span class="font-medium">{{ $item['name'] }}</span>
                        <span class="text-gray-600 text-sm">({{ $item['weeks'] }} week(s))</span>
                    </div>
                    <div class="font-medium">Rs.{{ number_format($item['price'] * $item['weeks'], 2) }}</div>
                </div>
                @endforeach
            </div>
            
            <div class="flex justify-between mt-4">
                <span class="font-medium text-gray-700">Subtotal</span>
                <span class="font-medium">Rs.{{ number_format(array_reduce($cart, function($total, $item) { 
                    return $total + ($item['price'] * $item['weeks']); 
                }, 0), 2) }}</span>
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