<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WishlistController;

Route::get('/', function () {
    return view('welcome');
});


// Route utama untuk menampilkan daftar wishlist
Route::get('/wishlists', [WishlistController::class, 'index'])->name('wishlists.index');

// Route untuk menampilkan form tambah wishlist
Route::get('/wishlists/create', [WishlistController::class, 'create'])->name('wishlists.create');

// Route untuk menyimpan wishlist baru
Route::post('/wishlists', [WishlistController::class, 'store'])->name('wishlists.store');

// Route untuk menampilkan form edit wishlist
Route::get('/wishlists/{wishlist}/edit', [WishlistController::class, 'edit'])->name('wishlists.edit');

// Route untuk memperbarui wishlist
Route::put('/wishlists/{wishlist}', [WishlistController::class, 'update'])->name('wishlists.update');

// Route untuk menghapus wishlist
Route::delete('/wishlists/{wishlist}', [WishlistController::class, 'destroy'])->name('wishlists.destroy');
