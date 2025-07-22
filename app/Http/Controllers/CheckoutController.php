<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Services\Esewa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{

    public function index()
    {
        $cart = session('cart', []);
        $total = 0;

        foreach ($cart as &$item) {
            $weeks = $item['weeks'];
            $basePrice = $item['price'] * $weeks;

            if ($weeks > 4) {
                $item['discount'] = 0.10;
                $item['discount_amount'] = $basePrice * 0.10;
            } else {
                $item['discount'] = 0;
                $item['discount_amount'] = 0;
            }

            $item['final_price'] = $basePrice - $item['discount_amount'];
            $total += $item['final_price'];
        }

        return view('checkout.index', compact('cart', 'total'));
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

        $total = 0;

        foreach ($cart as &$item) {
            $weeks = $item['weeks'];
            $basePrice = $item['price'] * $weeks;

            if ($weeks > 4) {
                $item['discount'] = 0.10;
                $item['discount_amount'] = $basePrice * 0.10;
            } else {
                $item['discount'] = 0;
                $item['discount_amount'] = 0;
            }

            $item['final_price'] = $basePrice - $item['discount_amount'];
            $total += $item['final_price'];
        }

        // Create order (temporary until payment success)
        $order = Order::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'total' => $total,
            'status' => 'pending', // Add this column in DB if needed
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'item_id' => $item['id'],
                'price' => $item['final_price'],
                'weeks' => $item['weeks'],
                'start_date' => now(),
                'discount_rate' => $item['discount'] * 100,
                'discount_amount' => $item['discount_amount'],
            ]);
        }

        // Save cart to session with order_id
        session(['cart' => $cart, 'order_id' => $order->id]);

        // Redirect to payment gateway (eSewa in this case)
        return (new Esewa)->pay(
            $total,
            route('esewa.verification', ['order' => $order->id]),
            $order->id,
            'Order #' . $order->id
        );
    }
}
