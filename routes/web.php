<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InventoryController;
use Illuminate\Support\Facades\Route;

// 1. Langsung ke Login (Biar dosen bangga)
Route::get('/', function () {
    return redirect()->route('login');
});

// 2. Dashboard Orange
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 3. Grup Fitur Utama
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Link CRUD Inventaris
    Route::resource('inventories', InventoryController::class);
});

require __DIR__.'/auth.php';