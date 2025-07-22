<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Item::query()->with(['category', 'user']);

        // Search filter
        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Category filter
        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }

        // Condition filter
        if ($request->has('condition')) {
            $query->where('condition', $request->condition);
        }

        // Price filter
        if ($request->has('max_price')) {
            $query->where('weekly_rent', '<=', $request->max_price);
        }

        $items = $query->latest()->paginate(12);
        $categories = Category::all();

        return view('items.index', compact('items', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $conditions = ['new', 'like_new', 'good', 'fair', 'poor'];
        $deliveryOptions = ['self_pickup', 'delivery', 'courier'];

        return view('items.create', compact('categories', 'conditions', 'deliveryOptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'nullable|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'min_rental_duration' => 'required|integer|min:1',
            'weekly_rent' => 'required|numeric|min:0',
            'condition' => 'required|in:new,like_new,good,fair,poor',
            'min_deposit' => 'required|numeric|min:0',
            'delivery_option' => 'required|in:self_pickup,delivery,courier',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'is_featured' => 'sometimes|boolean'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('item_images', 'public');
        }

        // Set the current user as the owner
        $validated['user_id'] = Auth::id();
        // dd($validated);

        Item::create($validated);

        return redirect()->route('user.dashboard')
            ->with('success', 'Item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {

        $categories = Category::all();
        $conditions = ['new', 'like_new', 'good', 'fair', 'poor'];
        $deliveryOptions = ['self_pickup', 'delivery', 'courier'];

        return view('items.edit', compact('item', 'categories', 'conditions', 'deliveryOptions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {

        $validated = $request->validate([
            'category_id' => 'nullable|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'min_rental_duration' => 'required|integer|min:1',
            'weekly_rent' => 'required|numeric|min:0',
            'condition' => 'required|in:new,like_new,good,fair,poor',
            'min_deposit' => 'required|numeric|min:0',
            'delivery_option' => 'required|in:self_pickup,delivery,courier',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'is_featured' => 'sometimes|boolean',
            'is_available' => 'sometimes|boolean'
        ]);

        // Handle image update
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($item->image_path) {
                Storage::disk('public')->delete($item->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('item_images', 'public');
        }

        // dd($validated);
        $item->update($validated);

        return redirect()->route('user.dashboard')
            ->with('success', 'Item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        // $this->authorize('delete', $item);

        // Delete associated image
        if ($item->image_path) {
            Storage::disk('public')->delete($item->image_path);
        }

        $item->delete();

        return redirect()->route('items.index')
            ->with('success', 'Item deleted successfully.');
    }

    /**
     * Toggle item availability
     */
    public function toggleAvailability(Item $item)
    {
        // $this->authorize('update', $item);

        $item->update([
            'is_available' => !$item->is_available
        ]);

        return back()->with('success', 'Availability updated successfully.');
    }
}
