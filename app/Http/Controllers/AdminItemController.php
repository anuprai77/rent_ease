<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class AdminItemController extends Controller
{
    public function index()
    {
        $items = Item::with(['user', 'category'])->latest()->paginate(10);
        return view('admin.items.index', compact('items'));
    }

    public function show(Item $item)
    {
        $item->load(['user', 'category']);
        return view('admin.items.show', compact('item'));
    }

    public function edit(Item $item)
    {
        $categories = Category::all();
        $users = User::all();
        return view('admin.items.edit', compact('item', 'categories', 'users'));
    }

    public function update(Request $request, Item $item)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
            'weekly_rent' => 'required|numeric|min:0',
            'min_rental_duration' => 'required|integer|min:1',
            'min_deposit' => 'required|numeric|min:0',
            'condition' => 'required|in:new,like_new,used',
            'delivery_option' => 'required|in:pickup,delivery',
            'is_available' => 'required|boolean',
            'is_featured' => 'required|boolean',
        ]);

        $item->update($validated);

        return redirect()->route('admin.items.index')->with('success', 'Item updated successfully.');
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('admin.items.index')->with('success', 'Item deleted successfully.');
    }
}