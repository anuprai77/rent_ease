@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Your Cart</h2>
    
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        @forelse ($cart as $item)
        <div class="p-4 border-b border-gray-200 flex justify-between items-center hover:bg-gray-50 transition-colors duration-150">
            <div class="flex-1">
                <h3 class="text-lg font-medium text-gray-800">{{ $item['name'] }}</h3>
                <p class="text-gray-600">
                    Rs.{{ number_format($item['price'], 2) }} × {{ $item['weeks'] }} week(s)
                </p>
                <p class="text-gray-800 font-medium mt-1">
                    Total: Rs.{{ number_format($item['price'] * $item['weeks'], 2) }}
                </p>
            </div>
            
            <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                @csrf
                <button type="submit" class="text-red-600 hover:text-red-800 transition-colors duration-200 p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            </form>
        </div>
        @empty
        <div class="p-8 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <p class="mt-4 text-gray-600">Your cart is empty</p>
            <a href="{{ route('items.index') }}" class="mt-4 inline-block px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-200">
                Browse Items
            </a>
        </div>
        @endforelse

        @if(count($cart) > 0)
        <div class="p-4 bg-gray-50 flex justify-between items-center">
            <div class="text-lg font-bold text-gray-800">
                Total: Rs.{{ number_format(array_reduce($cart, function($carry, $item) { return $carry + ($item['price'] * $item['weeks']); }, 0), 2) }}
            </div>
            <a href="{{ route('checkout.index') }}" class="px-6 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors duration-200 font-medium">
                Proceed to Checkout
            </a>
        </div>
        @endif
    </div>
</div>
@endsection