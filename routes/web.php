<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RumahController;
use App\Http\Controllers\TuwebController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

// ======================================
// Default route (biar login / welcome jalan)
// ======================================
Route::get('/', function () {
    return view('welcome'); // kalau pakai Laravel Breeze/Jetstream akan otomatis ke login
});

// ======================================
// Dashboard (contoh rumah)
// ======================================
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ======================================
// Group route yang butuh auth
// ======================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ======================================
// TUWEB routes
// ======================================
// Halaman utama TUWEB (akses via /tuweb, bukan root /)
Route::get('/rumah', [TuwebController::class, 'index'])->name('rumah.index');
Route::get('/tuweb', [TuwebController::class, 'index'])->name('tuweb.index');

// Search jadwal (POST dari form)
Route::post('/search', [SearchController::class, 'search'])->name('search');

// ======================================
// Resource TUWEB (opsional, kalau perlu CRUD penuh)
// ======================================
// Route::resource('/tuweb', TuwebController::class)->except(['index']);

// ======================================
// Auth routes (login, register, dll)
// ======================================
require __DIR__.'/auth.php';
