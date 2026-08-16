<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AyahController;
use App\Http\Controllers\Admin\DuaCategoryController;
use App\Http\Controllers\Admin\DuaController as AdminDuaController;
use App\Http\Controllers\Admin\HadithBookController;
use App\Http\Controllers\Admin\SurahController;
use App\Http\Controllers\DuaController;
use App\Http\Controllers\HadithController;
use App\Http\Controllers\IslamicCalendarController;
use App\Http\Controllers\PrayerTimeController;
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

// Public Hadith Module Routes
Route::get('/hadith', [HadithController::class, 'index'])->name('hadith.index');
Route::get('/hadith/{hadithBook}', [HadithController::class, 'show'])->name('hadith.show');

// Public Dua & Azkar Module Routes
Route::get('/duas', [DuaController::class, 'index'])->name('duas.index');
Route::get('/duas/{duaCategory}', [DuaController::class, 'category'])->name('duas.category');
Route::redirect('/dua', '/duas');
Route::redirect('/dua-azkar', '/duas');

// Public Prayer Times Module Routes
Route::get('/prayer-times', [PrayerTimeController::class, 'index'])->name('prayer-times.index');
Route::redirect('/prayer-time', '/prayer-times');

// Public Islamic Calendar Module Routes
Route::get('/islamic-calendar', [IslamicCalendarController::class, 'index'])->name('islamic-calendar.index');
Route::redirect('/calendar', '/islamic-calendar');

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

    // Hadith Books CRUD
    Route::resource('hadith-books', HadithBookController::class);

    // Dua Categories CRUD
    Route::resource('dua-categories', DuaCategoryController::class);

    // Duas CRUD
    Route::resource('duas', AdminDuaController::class);

    // Islamic Events CRUD
    Route::resource('islamic-events', \App\Http\Controllers\Admin\IslamicEventController::class);
});

require __DIR__.'/auth.php';
