
<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StockMovementController;
use Illuminate\Support\Facades\Route;

// Halaman awal
Route::get('/', function () {
    return redirect()->route('inventory.dashboard');
});

// Dashboard bawaan Breeze
Route::get('/dashboard', function () {
    return redirect()->route('inventory.dashboard');
})->middleware('auth')->name('dashboard');

// Fitur inventaris memerlukan login
Route::middleware('auth')->group(function () {

    // Dashboard inventaris
    Route::get('/dashboard-inventaris', [
        DashboardController::class,
        'index'
    ])->name('inventory.dashboard');

    // CRUD barang
    Route::resource('items', ItemController::class);

    // CRUD kategori
    Route::resource('categories', CategoryController::class);

    // Transaksi stok
    Route::get('/transaksi-stok', [
        StockMovementController::class,
        'index'
    ])->name('movements.index');

    Route::get('/transaksi-stok/create', [
        StockMovementController::class,
        'create'
    ])->name('movements.create');

    Route::post('/transaksi-stok', [
        StockMovementController::class,
        'store'
    ])->name('movements.store');

    // Profil pengguna Breeze
    Route::get('/profile', [
        ProfileController::class,
        'edit'
    ])->name('profile.edit');

    Route::patch('/profile', [
        ProfileController::class,
        'update'
    ])->name('profile.update');

    Route::delete('/profile', [
        ProfileController::class,
        'destroy'
    ])->name('profile.destroy');
});

// Autentikasi Breeze
require __DIR__.'/auth.php';
