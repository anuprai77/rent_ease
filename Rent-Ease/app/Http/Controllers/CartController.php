<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class CartController extends Controller
{

public function add(Request $request, Item $item)
{
    $weeks = $request->input('weeks', 1);
    
    // Base total price
    $basePrice = $item->weekly_rent * $weeks;

    // Discount: 10% off if more than 4 weeks
    $discountRate = $weeks > 4 ? 0.10 : 0;
    $discountAmount = $basePrice * $discountRate;
    $finalPrice = $basePrice - $discountAmount;

    // Store in session
    $cart = session()->get('cart', []);
    $cart[$item->id] = [
        'id' => $item->id,
        'name' => $item->name,
        'price' => $item->weekly_rent,
        'weeks' => $weeks,
        'image' => $item->image_path,
        'discount_rate' => $discountRate,
        'discount_amount' => $discountAmount,
        'final_price' => $finalPrice,
    ];

    session(['cart' => $cart]);

    return redirect()->back()->with('success', 'Item added to cart with ' . ($discountRate ? 'discount.' : 'no discount.'));
}

    public function index()
    {
        $cart = session('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function remove($itemId)
    {
        $cart = session()->get('cart', []);
        unset($cart[$itemId]);
        session(['cart' => $cart]);

        return redirect()->route('cart.index')->with('success', 'Item removed.');
    }
}
