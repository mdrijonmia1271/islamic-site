<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\AyahController;
use App\Http\Controllers\Admin\DuaCategoryController;
use App\Http\Controllers\Admin\DuaController as AdminDuaController;
use App\Http\Controllers\Admin\HadithBookController;
use App\Http\Controllers\Admin\SurahController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\DuaController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\HadithController;
use App\Http\Controllers\IslamicCalendarController;
use App\Http\Controllers\PrayerTimeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuranController;
use App\Http\Controllers\ReadingHistoryController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

// Public Home Page
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Global Unified Search Route
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/api/search/suggestions', [SearchController::class, 'suggestions'])->name('search.suggestions');

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

// Public Articles Module Routes
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{article:slug}', [ArticleController::class, 'show'])->name('articles.show');

// Public Digital Tasbih Counter Module Routes (DAY 12)
Route::get('/tasbih', function () {
    return view('tasbih.index');
})->name('tasbih');
Route::redirect('/tasbeeh', '/tasbih');
Route::redirect('/tools/tasbih', '/tasbih');

// Public Islamic Quiz Module Routes (DAY 12)
Route::get('/quiz', [QuizController::class, 'index'])->name('quiz.index');
Route::get('/quiz/{category:slug}/start', [QuizController::class, 'start'])->name('quiz.start');
Route::post('/quiz/{category:slug}/submit', [QuizController::class, 'submit'])->name('quiz.submit');
Route::redirect('/tools/quiz', '/quiz');

// Authenticated User Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// User Profile, Account, Favorites, Bookmarks & History Routes (Protected by Auth)
Route::middleware('auth')->group(function () {
    Route::get('/account', function () {
        $user = auth()->user();
        $recentFavorites = $user->favorites()->with('favoritable')->latest()->take(4)->get();
        $favoritesCount = $user->favorites()->count();
        $bookmarksCount = $user->bookmarks()->count();
        $historyCount = $user->readingHistories()->count();
        return view('account.profile', compact('user', 'recentFavorites', 'favoritesCount', 'bookmarksCount', 'historyCount'));
    })->name('account.profile');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Favorites Routes (DAY 11)
    Route::get('/my-favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::get('/favorites', function() { return redirect()->route('favorites.index'); });
    Route::post('/favorites', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('/favorites', [FavoriteController::class, 'destroy'])->name('favorites.destroy');

    // Bookmarks Routes (6️⃣)
    Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmarks.index');
    Route::get('/my-bookmarks', function() { return redirect()->route('bookmarks.index'); });
    Route::post('/bookmark', [BookmarkController::class, 'store'])->name('bookmark.store');
    Route::delete('/bookmark', [BookmarkController::class, 'destroy'])->name('bookmark.destroy');

    // Reading History Routes (1️⃣5️⃣)
    Route::get('/history', [ReadingHistoryController::class, 'index'])->name('history.index');
    Route::post('/history', [ReadingHistoryController::class, 'store'])->name('history.store');
    Route::delete('/history/{id}', [ReadingHistoryController::class, 'destroy'])->name('history.destroy');
    Route::delete('/history', [ReadingHistoryController::class, 'clear'])->name('history.clear');
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

    // Articles CRUD
    Route::resource('articles', AdminArticleController::class);
});

require __DIR__.'/auth.php';
