<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TransporterController;
use App\Http\Controllers\RecipientController;
/*
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
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
Route::prefix('admin')->middleware([AdminMiddleware::class])->group(function() {
    // All existing admin routes (unchanged)
    Route::get('/', [AdminController::class, 'dashboard']);
    Route::get('/dashboard', [AdminController::class, 'dashboard']);
    
    // Products management
    Route::get('/products/pending', 'ProductController@pendingApproval');
    Route::post('/products/{id}/approve', 'ProductController@approve');
    
    // Suppliers management
    Route::get('/suppliers', 'SupplierController@list');
});

Route::prefix('customer')->middleware([RoleMiddleware::class.':customer'])->group(function() {
    Route::get('/dashboard', [CustomerController::class, 'dashboard']);
    // Add other customer routes here
});

// Supplier routes
Route::prefix('supplier')->middleware([RoleMiddleware::class.':supplier'])->group(function() {
    Route::get('/dashboard', [SupplierController::class, 'dashboard']);
    // Add other supplier routes here
});

// Transporter routes
Route::prefix('transporter')->middleware([RoleMiddleware::class.':transporter'])->group(function() {
    Route::get('/dashboard', [TransporterController::class, 'dashboard']);
    // Add other transporter routes here
});

// Recipient routes
Route::prefix('recipient')->middleware([RoleMiddleware::class.':recipient'])->group(function() {
    Route::get('/dashboard', [RecipientController::class, 'dashboard']);
    // Add other recipient routes here
});