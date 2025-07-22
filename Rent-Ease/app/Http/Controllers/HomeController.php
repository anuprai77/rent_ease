<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $items= Item::where('is_featured','1')->take(3)->get();
        $categories = Category::withCount('items')->get();

        return view('home',compact('items','categories'));
    }
}
