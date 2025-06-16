@extends('admin.dashboard')

@section('content')
<div class="max-w-7xl mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">All Orders</h1>

    @forelse($orders as $order)
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <h2 class="text-lg font-semibold text-gray-800">Order #{{ $order->id }}</h2>
            <p class="text-gray-600">Customer: {{ $order->name }} | Email: {{ $order->email }}</p>
            <p class="text-gray-600">Address: {{ $order->address }}</p>
            <p class="text-gray-600 mb-4">Ordered at: {{ $order->created_at->format('Y-m-d H:i') }}</p>

            <table class="w-full table-auto border">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 text-left">Item</th>
                        <th class="px-4 py-2">Weeks</th>
                        <th class="px-4 py-2">Price</th>
                        <th class="px-4 py-2">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $orderItem)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $orderItem->item->name ?? 'Item Deleted' }}</td>
                            <td class="px-4 py-2 text-center">{{ $orderItem->weeks }}</td>
                            <td class="px-4 py-2 text-center">Rs {{ number_format($orderItem->price, 2) }}</td>
                            <td class="px-4 py-2 text-center">Rs {{ number_format($orderItem->price * $orderItem->weeks, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="text-right mt-4 font-semibold text-lg">
                Total: Rs {{ number_format($order->total, 2) }}
            </div>
        </div>
    @empty
        <p class="text-gray-600">No orders found.</p>
    @endforelse
</div>
@endsection