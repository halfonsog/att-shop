<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CommissionController;

// Public routes
Route::get('/', function () {
    return view('welcome');
});

// Authentication
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login', 'login')->name('login.post');
    Route::get('/register', 'showRegister')->name('register');
    Route::post('/register', 'register');
    Route::get('/logout', 'logout')->name('logout');
});

// Public product routes
Route::controller(ProductController::class)->group(function () {
    Route::get('/products', 'index')->name('products.index');
    Route::get('/product/{id}', 'show')->name('product.show');
    Route::get('/search', 'search')->name('products.search');
});

// Cart
Route::controller(CartController::class)->group(function () {
    Route::post('/cart/add', 'add')->name('cart.add');
    Route::get('/cart', 'view')->name('cart.view');
    Route::post('/cart/update', 'update')->name('cart.update');
    Route::post('/cart/remove', 'remove')->name('cart.remove');
});

// Checkout
Route::controller(CheckoutController::class)->group(function () {
    Route::get('/checkout', 'show')->name('checkout');
    Route::post('/checkout/place-order', 'placeOrder')->name('checkout.place');
});

// Suppliers
Route::controller(SupplierController::class)->group(function () {
    Route::get('/suppliers', 'index')->name('suppliers.index');
    Route::get('/suppliers/create', 'create')->name('suppliers.create');
    Route::post('/suppliers', 'store')->name('suppliers.store');
    Route::get('/suppliers/{id}', 'show')->name('suppliers.show');
    Route::get('/suppliers/{id}/commissions', 'commissions')->name('suppliers.commissions');
});

// Authenticated routes
Route::middleware(['auth'])->group(function () {
    // Product management
    Route::controller(ProductController::class)->group(function () {
        Route::get('/products/manage', 'manage')->name('products.manage');
        Route::get('/products/create', 'create')->name('products.create');
        Route::post('/products', 'store')->name('products.store');
    });

    // Admin routes
    Route::middleware(['admin'])->group(function () {
        Route::controller(OrderController::class)->group(function () {
            Route::get('/orders', 'index')->name('orders.index');
            Route::get('/orders/{id}', 'show')->name('orders.show');
            Route::post('/orders/{id}/status', 'updateStatus')->name('orders.status');
        });
        
        Route::controller(CommissionController::class)->group(function () {
            Route::get('/commissions', 'index')->name('commissions.index');
            Route::post('/commissions/{id}/pay', 'markAsPaid')->name('commissions.pay');
            Route::post('/commissions/process-payments', 'processMonthlyPayments')->name('commissions.process');
        });
    });
});
