<?php
namespace App\Services;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemService
{
    /**
     * Get items with optional filters.
     *
     * @param array $filters
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getItems(Request $request)
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

        return compact('items', 'categories');
    }
}   
