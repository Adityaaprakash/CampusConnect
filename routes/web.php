<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\AdminNotesController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\FoodController;

/*
|--------------------------------------------------------------------------
| Redirect root "/" → Login page
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    if (auth()->check()) {
        return view('home');
    }
    return redirect()->route('login');
})->name('home');

/*
|--------------------------------------------------------------------------
| Authentication Routes (Guest Only)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {

    // Login
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.perform');

    // Register
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.perform');

});

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Student Routes (Auth Only)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    /*
    | Notes Upload
    */
    Route::get('/notes/upload', [NotesController::class, 'uploadForm'])->name('notes.upload');
    Route::post('/notes/upload', [NotesController::class, 'upload'])->name('notes.upload.perform');

    /*
    | Chat Rooms
    */
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat/rooms', [ChatController::class, 'storeRoom'])->name('chat.rooms.store');
    Route::post('/chat/rooms/{room}/join', [ChatController::class, 'join'])->name('chat.rooms.join');
    Route::post('/chat/rooms/{room}/leave', [ChatController::class, 'leave'])->name('chat.rooms.leave');
    Route::get('/chat/rooms/{room}', [ChatController::class, 'show'])->name('chat.rooms.show');
    Route::post('/chat/rooms/{room}/messages', [ChatController::class, 'storeMessage'])->name('chat.messages.store');

    /*
    | Rent & PG
    */
    Route::get('/rent', [RentController::class, 'index'])->name('rent.index');
    Route::get('/rent/listings', [RentController::class, 'listings'])->name('rent.listings');
    Route::get('/rent/create', [RentController::class, 'create'])->name('rent.create');
    Route::post('/rent', [RentController::class, 'store'])->name('rent.store');

    // ⭐️ FIX ADDED HERE → Missing rent.show route
    Route::get('/rent/{rent}', [RentController::class, 'show'])->name('rent.show');

    /*
    | Food Ordering
    */
    Route::get('/food', [FoodController::class, 'index'])->name('food.index');

    Route::get('/food/restaurants', [FoodController::class, 'restaurants'])->name('food.restaurants');

    Route::get('/food/restaurants/{restaurant}', [FoodController::class, 'menu'])->name('food.menu');

    Route::post('/food/menu-items/{menuItem}/add', [FoodController::class, 'addToCart'])->name('food.cart.add');
    Route::post('/food/menu-items/{menuItem}/remove', [FoodController::class, 'removeFromCart'])->name('food.cart.remove');

    Route::get('/food/cart', [FoodController::class, 'cart'])->name('food.cart');
    Route::post('/food/cart/checkout', [FoodController::class, 'placeOrder'])->name('food.checkout');

    Route::get('/food/orders/{order}', [FoodController::class, 'showOrder'])->name('food.orders.show');
});

/*
|--------------------------------------------------------------------------
| Public Notes View
|--------------------------------------------------------------------------
*/
Route::get('/notes', [NotesController::class, 'index'])->name('notes.view');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'isAdmin'])->group(function () {

    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/notes/pending', [AdminNotesController::class, 'pending'])->name('admin.notes.pending');

    Route::post('/admin/notes/{id}/approve', [AdminNotesController::class, 'approve'])->name('admin.notes.approve');
    Route::post('/admin/notes/{id}/reject', [AdminNotesController::class, 'reject'])->name('admin.notes.reject');

    Route::delete('/admin/rent/{rent}', [RentController::class, 'destroy'])->name('admin.rent.destroy');

    Route::get('/admin/food/orders', [FoodController::class, 'adminOrders'])->name('admin.food.orders');
    Route::post('/admin/food/orders/{order}/status', [FoodController::class, 'updateOrderStatus'])->name('admin.food.orders.status');

});
