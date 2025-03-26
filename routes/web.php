<?php

use Illuminate\Support\Facades\Route;

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

/*
// Authentication
Route::get('/login', '\App\Http\Controllers\AuthController@showLogin')->name('login');
Route::post('/login', '\App\Http\Controllers\AuthController@login')->name('login.post');
Route::get('/register', '\App\Http\Controllers\AuthController@showRegister')->name('register');
Route::post('/register', '\App\Http\Controllers\AuthController@register');
Route::get('/logout', '\App\Http\Controllers\AuthController@logout')->name('logout');

// Products
Route::get('/search', '\App\Http\Controllers\ProductController@search')->name('products.search');
Route::get('/product/{id}', '\App\Http\Controllers\ProductController@show')->name('product.show');

// Cart
Route::post('/cart/add', '\App\Http\Controllers\CartController@add')->name('cart.add');
Route::get('/cart', '\App\Http\Controllers\CartController@view')->name('cart.view');
Route::post('/cart/update', '\App\Http\Controllers\CartController@update')->name('cart.update');
Route::post('/cart/remove', '\App\Http\Controllers\CartController@remove')->name('cart.remove');

// Checkout
Route::get('/checkout', '\App\Http\Controllers\CheckoutController@show')->name('checkout');
Route::post('/checkout/place-order', '\App\Http\Controllers\CheckoutController@placeOrder')->name('checkout.place');

// Suppliers
Route::get('/suppliers', '\App\Http\Controllers\SupplierController@index')->name('suppliers.index');
Route::get('/suppliers/create', '\App\Http\Controllers\SupplierController@create')->name('suppliers.create');
Route::post('/suppliers', '\App\Http\Controllers\SupplierController@store')->name('suppliers.store');
Route::get('/suppliers/{id}', '\App\Http\Controllers\SupplierController@show')->name('suppliers.show');
Route::get('/suppliers/{id}/commissions', '\App\Http\Controllers\SupplierController@commissions')->name('suppliers.commissions');

Route::get('/products', '\App\Http\Controllers\ProductController@index')->name('products.index');
Route::post('/products', '\App\Http\Controllers\ProductController@store')->name('products.store');


// Authenticated routes
Route::middleware(['auth'])->group(function () {
    // Product management (for suppliers)
    Route::get('/products/manage', '\App\Http\Controllers\ProductController@manage')->name('products.manage');
    Route::get('/products/create', '\App\Http\Controllers\ProductController@create')->name('products.create');
//    Route::get('/products', '\App\Http\Controllers\ProductController@index')->name('products.index');
//    Route::post('/products', '\App\Http\Controllers\ProductController@store')->name('products.store');
    
    // Admin-only routes
    Route::middleware(['admin'])->group(function () {
        Route::get('/orders', '\App\Http\Controllers\OrderController@index')->name('orders.index');
        Route::get('/orders/{id}', '\App\Http\Controllers\OrderController@show')->name('orders.show');
        Route::post('/orders/{id}/status', '\App\Http\Controllers\OrderController@updateStatus')->name('orders.status');
        
        Route::get('/commissions', '\App\Http\Controllers\CommissionController@index')->name('commissions.index');
        Route::post('/commissions/{id}/pay', '\App\Http\Controllers\CommissionController@markAsPaid')->name('commissions.pay');
        Route::post('/commissions/process-payments', '\App\Http\Controllers\CommissionController@processMonthlyPayments')->name('commissions.process');
    });
});
*/