<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminItemController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\EsewaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::prefix('user')->middleware('auth')->group(function () {
    Route::get('/userdashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    //    Route::get('/items',[UserDashboardController::class,'itemIndex'])->name('user.items.index');
});

Route::resource('items', ItemController::class);

//cart routes
Route::post('/cart/add/{item}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/remove/{itemId}', [CartController::class, 'remove'])->name('cart.remove');

//checoutroutes
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/items', [AdminDashboardController::class, 'itemIndex'])->name('admin.items.index');
    Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::resource('categories', CategoryController::class)->names('admin.categories');
    Route::resource('users', AdminUserController::class)->names('admin.users');
    Route::resource('items', AdminItemController::class)->names('admin.items');
});


// Additional route for availability toggle
Route::patch('/items/{item}/toggle-availability', [ItemController::class, 'toggleAvailability'])
    ->name('items.toggle-availability')
    ->middleware('auth');


Route::get('esewa-checkout/{order}',[EsewaController::class,'checkout'])->name('esewa.checkout');
Route::get('esewa-verification/{order}',[EsewaController::class,'verification'])->name('esewa.verification');


Route::middleware('auth')->group(function () {
    Route::get('/chat/{user?}', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');
    Route::get('/chat/messages/{user}', [ChatController::class, 'fetchMessages'])->name('chat.fetch');
});

require __DIR__ . '/auth.php';
