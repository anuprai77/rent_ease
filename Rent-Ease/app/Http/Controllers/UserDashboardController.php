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

        $rentedItems = OrderItem::whereHas('order', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->with(['item', 'order'])->get();


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
        $items = Item::with(['user', 'category'])
            ->latest()
            ->paginate(10);

    $totalRevenue = Order::sum('total');


        return view('user.dashboard', compact('items', 'user', 'rentedItems', 'rentedItems', 'totalRentals', 'activeRentals', 'upcomingReturns', 'overdueRentals','totalRevenue'));
    }

    public function itemIndex(Request $request, ItemService $itemService)
    {
        $data = $itemService->getItems($request);
        return view('user.items.index', compact('data'));
    }
}
