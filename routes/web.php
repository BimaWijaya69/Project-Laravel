<?php

use App\Http\Controllers\Admin\BrgKeluarController;
use App\Http\Controllers\Admin\BrgMasukController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CetakPDFController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\IsLogin;
use App\Http\Middleware\PreventBackHistory;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

// login
Route::get('/login', [AuthController::class, 'loginView'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');


// midleware


// Middleware auth untuk seluruh route di dalam grup
Route::middleware(IsLogin::class, PreventBackHistory::class)->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // Products
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy']);

    // Categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);

    // Supplier
    Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
    Route::post('/suppliers', [SupplierController::class, 'store'])->name('suppliers.store');
    Route::put('/suppliers/{supplier}', [SupplierController::class, 'update'])->name('suppliers.update');
    Route::delete('/suppliers/{supplier}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');

    //BrgMasuk
    Route::get('/brgmasuks', [BrgMasukController::class, 'index'])->name('brgmasuks.index');
    Route::post('/brgmasuks', [BrgMasukController::class, 'store'])->name('brgmasuks.store');
    Route::put('/brgmasuks/{brgmasuk}', [BrgMasukController::class, 'update'])->name('brgmasuks.update');
    Route::delete('/brgmasuks/{brgmasuk}', [BrgMasukController::class, 'destroy'])->name('brgmasuks.destroy');


    //BrgKeluar
    Route::get('/brgkeluars', [BrgKeluarController::class, 'index'])->name('brgkeluars.index');
    Route::post('/brgkeluars', [BrgKeluarController::class, 'store'])->name('brgkeluars.store');
    Route::put('/brgkeluars/{brgkeluar}', [BrgKeluarController::class, 'update'])->name('brgkeluars.update');
    Route::delete('/brgkeluars/{brgkeluar}', [BrgKeluarController::class, 'destroy'])->name('brgkeluars.destroy');

    // Laporan
    Route::get('/laporans', [LaporanController::class, 'index'])->name('laporans.index');

    // cetak pdf
    Route::get('/laporan-barang/cetak', [CetakPDFController::class, 'generateReport'])->name('laporan-barang.cetak');
    
    // Tambahkan route lainnya yang memerlukan login
});
