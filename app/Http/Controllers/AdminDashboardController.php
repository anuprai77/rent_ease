<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // Summary Metrics
        $totalUsers = User::count();
        $totalItems = Item::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total');

        // // Active rentals: items with end_date in future
        // $activeRentals = OrderItem::where('end_date', '>', now())->count();

        // // Overdue rentals: items with end_date in the past
        // $overdueRentals = OrderItem::where('end_date', '<', now())->count();

        // Recent activity
        $recentOrders = Order::with('user')->latest()->take(5)->get();
        $recentUsers = User::latest()->take(5)->get();
        $recentItems = Item::with('user', 'category')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.index', compact(
            'totalUsers',
            'totalItems',
            'totalOrders',
            'totalRevenue',
            // 'activeRentals',
            // 'overdueRentals',
            'recentItems',
            'recentOrders',
            'recentUsers'
        ));
    }

    public function itemIndex()
    {
        return view('admin.items.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        //
    }
}
