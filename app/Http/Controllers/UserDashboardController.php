<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\ItemService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Get only this user's orders
        $orders = Order::where('user_id', $user->id)->with('items.item')->get();

        // Flatten all rented items from the user's orders
        $rentedItems = $orders->flatMap->items;

        // Calculate stats
        $totalRentals = $rentedItems->count();

        $activeRentals = $rentedItems->filter(function ($item) {
            return $item->end_date && $item->end_date->isFuture();
        })->count();

        $upcomingReturns = $rentedItems->filter(function ($item) {
            return $item->end_date &&
                $item->end_date->isFuture() &&
                $item->end_date->lte(now()->addDays(3));
        })->count();

        $overdueRentals = $rentedItems->filter(function ($item) {
            return $item->end_date && $item->end_date->isPast();
        })->count();

        // Only items created/listed by the user (if applicable)
        $items = Item::where('user_id', $user->id)
            ->with('category')
            ->latest()
            ->paginate(10);

        // Total revenue from user's orders (what they paid)
$totalRevenue = OrderItem::whereHas('item', function ($query) use ($user) {
    $query->where('user_id', $user->id);
})->sum('price');

        return view('user.dashboard', compact(
            'items',
            'user',
            'rentedItems',
            'totalRentals',
            'activeRentals',
            'upcomingReturns',
            'overdueRentals',
            'totalRevenue'
        ));
    }

    public function itemIndex(Request $request, ItemService $itemService)
    {
        $data = $itemService->getItems($request);
        return view('user.items.index', compact('data'));
    }
}
