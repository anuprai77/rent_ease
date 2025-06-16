<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{

    public function index()
    {
        $cart = session('cart', []);
        return view('checkout.index', compact('cart'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string'
        ]);

        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Cart is empty.');
        }

        // Calculate total
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['weeks']);

        // Create order
        $order = Order::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'total' => $total,
        ]);

        // Create order items
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'item_id' => $item['id'],
                'price' => $item['price'],
                'weeks' => $item['weeks'],
                'start_date' => now(), // Set current time as rental start
            ]);

            // Mark item as unavailable
            $itemModel = \App\Models\Item::find($item['id']);
            $itemModel->is_available = 0;
            $itemModel->save();
        }

        session()->forget('cart');

        return redirect()->route('home')->with('success', 'Order placed successfully.');
    }
}
