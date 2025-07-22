<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Services\Esewa;
use Illuminate\Http\Request;

class EsewaController extends Controller
{
    // public function checkout(Product $product)
    // {
    //     return (new Esewa)->pay(1000, route('esewa.verification', ['product' => $product->slug]), $product->id, $product->name);
    // }

    public function verification(Request $request, $orderId)
    {
        $esewa = new Esewa();

        $decodedString = base64_decode($request->input('data'));
        $data = json_decode($decodedString, true);

        $transaction_uuid = $data['transaction_uuid'] ?? null;

        $inquiry = $esewa->inquiry($transaction_uuid, $data);

        if ($esewa->isSuccess($inquiry)) {
            $order = Order::with('items')->findOrFail($orderId);

            // Mark items as unavailable
            foreach ($order->items as $orderItem) {
                $item = Item::find($orderItem->item_id);
                $item->is_available = 0;
                $item->save();
            }

            $order->status = 'paid';
            $order->save();

            session()->forget(['cart', 'order_id']);

            return redirect()->route('home')->with('success', 'Payment successful!');
        } else {
            return redirect()->route('home')->with('error', 'Payment failed.');
        }
    }
}
