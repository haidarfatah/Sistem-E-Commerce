<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\UserProfileController;



use App\Http\Controllers\AuthController;

// Rute login tanpa middleware

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// Rute untuk halaman dengan middleware
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // PROFILR
    Route::get('/profile', [UserProfileController::class, 'show'])->name('profile.show');

    // Rute untuk mengedit profil
    Route::get('/profile/edit', [UserProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [UserProfileController::class, 'update'])->name('profile.update');

    // // User Routes
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::get('/product/{productId}', [ProductController::class, 'show'])->name('products.index');

    Route::get('/history', [OrderController::class, 'history'])->name('history');

    // HALAMAN CART
    Route::post('/cart/update-ajax/{productId}', [CartController::class, 'updateAjax'])->name('cart.updateAjax');


    // Route::post('/cart/update/{productId}', [CartController::class, 'updateCart'])->name('cart.update');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/add-multiple', [CartController::class, 'addMultipleToCart'])->name('cart.addMultiple');
    Route::get('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/remove-from-cart/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::get('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');

    // HALAMAN CHECKOUT
    Route::post('/checkout/complete', [CheckoutController::class, 'completeOrder'])->name('checkout.complete');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/process', [CheckoutController::class, 'processCheckout'])->name('checkout.process');

    // HALAMAN ORDER
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('order.details');
    Route::get('/order/status/{orderId}', [CheckoutController::class, 'status'])->name('order.status');
    Route::get('/order/{orderId}', [OrderController::class, 'details'])->name('order.details');
    // Halaman konfirmasi setelah order
    Route::get('/order/confirmation/{order_id}', [OrderController::class, 'confirmation'])->name('order.confirmation');
    Route::get('/order/confirmation/{id}', [OrderController::class, 'confirmation'])->name('order.confirmation');
    Route::get('/account', [HomeController::class, 'account'])->name('account');

    // Admin Routes
    Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        // Products
        Route::get('/products', [AdminController::class, 'products'])->name('admin.products');
        Route::get('/products/create', [AdminController::class, 'createProduct'])->name('admin.products.create');
        Route::post('/products/store', [AdminController::class, 'storeProduct'])->name('admin.products.store');
        Route::get('/admin/products/{id}/edit', [AdminController::class, 'editProduct'])->name('admin.products.edit');
        Route::put('/admin/products/{id}/update', [AdminController::class, 'updateProduct'])->name('admin.products.update');
        Route::delete('/products/{id}/delete', [AdminController::class, 'deleteProduct'])->name('admin.products.delete');

        // Categories
        Route::get('/categories', [AdminController::class, 'categories'])->name('admin.categories');
        Route::get('/categories/create', [AdminController::class, 'createCategory'])->name('admin.categories.create');
        Route::post('/categories/store', [AdminController::class, 'storeCategory'])->name('admin.categories.store');
        Route::get('/categories/{id}/edit', [AdminController::class, 'editCategory'])->name('admin.categories.edit');
        Route::put('/categories/{id}/update', [AdminController::class, 'updateCategory'])->name('admin.categories.update');
        Route::delete('/categories/{id}/delete', [AdminController::class, 'deleteCategory'])->name('admin.categories.delete');

        // Orders
        Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order_id}', [AdminOrderController::class, 'show'])->name('orders.show');
        Route::post('/orders/{order_id}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
        
        
        // Users
        Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
        Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    });
});
