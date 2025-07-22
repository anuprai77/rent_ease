@extends('layouts.app')

@section('content')
<div class="max-w-4xl min-h-96 p-9 m-9 mx-auto p-6 bg-white shadow rounded">
    <h2 class="text-2xl font-semibold mb-4">Your Cart</h2>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif

    @if(empty($cart) || count($cart) === 0)
        <p class="text-gray-600">Your cart is empty.</p>
    @else
        <div class="divide-y divide-gray-200">
            @foreach ($cart as $item)
                <div class="flex justify-between py-4">
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $item['name'] }}</h3>
                        <p class="text-sm text-gray-600">
                            Rs.{{ number_format($item['price'], 2) }} × {{ $item['weeks'] }} week(s)
                        </p>

                        @if(isset($item['discount_amount']) && $item['discount_amount'] > 0)
                            <p class="text-sm text-green-600">
                                Discount: Rs.{{ number_format($item['discount_amount'], 2) }}
                            </p>
                            <p class="mt-1 text-sm text-red-500 line-through">
                                Original: Rs.{{ number_format($item['price'] * $item['weeks'], 2) }}
                            </p>
                            <p class="font-semibold text-gray-900">
                                Final: Rs.{{ number_format($item['final_price'], 2) }}
                            </p>
                        @else
                            <p class="font-semibold text-gray-900 mt-1">
                                Total: Rs.{{ number_format($item['price'] * $item['weeks'], 2) }}
                            </p>
                        @endif
                    </div>

                    <form action="{{ route('cart.remove', $item['id']) }}" method="POST" class="self-center">
                        @csrf
                        <button type="submit" class="text-red-500 hover:text-red-700">
                            Remove
                        </button>
                    </form>
                </div>
            @endforeach
        </div>

        <div class="mt-6 flex justify-between items-center border-t pt-4">
            <div class="text-xl font-semibold">
                Grand Total:
                Rs.{{ number_format(array_reduce($cart, function ($carry, $item) {
                    return $carry + ($item['final_price'] ?? ($item['price'] * $item['weeks']));
                }, 0), 2) }}
            </div>
            <a href="{{ route('checkout.index') }}"
               class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 transition">
                Proceed to Checkout
            </a>
        </div>
    @endif
</div>
@endsection