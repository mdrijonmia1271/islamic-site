<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AyahController;
use App\Http\Controllers\Admin\SurahController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuranController;
use Illuminate\Support\Facades\Route;

// Public Home Page
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Public Quran Module Routes
Route::get('/quran', [QuranController::class, 'index'])->name('quran.index');
Route::get('/quran/{number}', [QuranController::class, 'show'])->name('quran.show');

// Authenticated User Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// User Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Panel Routes (Protected by Auth & Admin Middleware)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Surahs CRUD
    Route::resource('surahs', SurahController::class);

    // Ayahs Management for a Surah
    Route::get('surahs/{surah}/ayahs', [AyahController::class, 'index'])->name('surahs.ayahs.index');
    Route::post('surahs/{surah}/ayahs', [AyahController::class, 'store'])->name('surahs.ayahs.store');
    Route::get('surahs/{surah}/ayahs/{ayah}/edit', [AyahController::class, 'edit'])->name('surahs.ayahs.edit');
    Route::put('surahs/{surah}/ayahs/{ayah}', [AyahController::class, 'update'])->name('surahs.ayahs.update');
    Route::delete('surahs/{surah}/ayahs/{ayah}', [AyahController::class, 'destroy'])->name('surahs.ayahs.destroy');
});

require __DIR__.'/auth.php';
