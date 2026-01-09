<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\PenyewaController;
use App\Http\Controllers\KontrakSewaController;
use App\Http\Controllers\PembayaranController;


// 1. Route Dashboard (Halaman Utama)
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// 2. Resource Routes untuk CRUD

Route::resource('kamar', KamarController::class);

Route::resource('penyewa', PenyewaController::class);

Route::resource('kontrak', KontrakSewaController::class); 

Route::resource('pembayaran', PembayaranController::class);