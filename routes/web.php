<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Cache;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'role:user'])->group(function () {

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/cart/create/{product_id}', [CartController::class, 'create'])->name('cart.create');
    Route::post('/cart/store/{product_id}', [CartController::class, 'store'])->name('cart.store');

});

// ================== PRODUCTS ==================
Route::middleware('auth')->group(function () {

    // ✅ IMPORTANT: put this BEFORE {product}
    Route::get('/products/update-status-check', function () {
        return response()->json([
            'status' => Cache::get('products_update_status', 'idle')
        ]);
    })->name('products.status.check');

    // Admin only
    Route::middleware('role:admin')->group(function () {
        Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('products', [ProductController::class, 'store'])->name('products.store');
        Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('products/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    });

    // Public access
    Route::get('products', [ProductController::class, 'index'])->name('products.index');
    Route::get('products/updatedSuccessfully', [ProductController::class, 'updatedSuccessfully'])->name('products.updatedSuccessfully');

    // ❗ MUST BE LAST
    Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');

});

// ================== USERS & ROLES ==================
Route::group(['middleware' => ['auth']], function() {
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class)->middleware("role:admin");
});