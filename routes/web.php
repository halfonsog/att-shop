<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
/*
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CommissionController;
*/

// Public routes
Route::get('/', function () {
    return view('welcome');
});

// For guests (non-logged-in users)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

// For authenticated users only
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// For admin users only
Route::prefix('admin')->group(function() {
    Route::get('/', 'AdminController@dashboard')->name('admin.dashboard');
    
    // Products management
    Route::get('/products/pending', 'ProductController@pendingApproval');
    Route::post('/products/{id}/approve', 'ProductController@approve');
    
    // Suppliers management
    Route::get('/suppliers', 'SupplierController@list');
});

