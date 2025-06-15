<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function add(Request $request, Item $item)
    {
        $cart = session()->get('cart', []);

        $cart[$item->id] = [
            'id' => $item->id,
            'name' => $item->name,
            'price' => $item->weekly_rent,
            'image' => $item->image_path,
            'weeks' => $request->weeks ?? 1
        ];

        session(['cart' => $cart]);

        return redirect()->back()->with('success', 'Item added to cart.');
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
