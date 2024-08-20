<?php


use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'home'])->name('home');
Route::resource('products', ProductController::class);

Route::post('/cart/add/{product}', [CartController::class, 'addToCart'])->name('cart.add');
Route::delete('/cart/remove/{product}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');



// Route::get('/products', [ProductController::class, 'index'])->name('products.index');
// Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
// Route::post('/products', [ProductController::class, 'store'])->name('products.store');
// Route::get('/product/{products}/edit', [ProductController::class, 'edit'])->name('products.edit');
// Route::put('/product/{products}', [ProductController::class, 'show'])->name('products.show');
// Route::put('/product/{products}', [ProductController::class, 'update'])->name('products.update');
// Route::delete('/product/{products}', [ProductController::class, 'destroy'])->name('products.destroy');

