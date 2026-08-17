<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Ayah;
use App\Models\Dua;
use App\Models\DuaCategory;
use App\Models\Favorite;
use App\Models\Hadith;
use App\Models\HadithBook;
use App\Models\IslamicEvent;
use App\Models\Surah;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the comprehensive admin dashboard with statistics and recent data.
     */
    public function index(): View
    {
        $stats = [
            'users' => User::count(),
            'today_users' => User::whereDate('created_at', today())->count(),
            'monthly_users' => User::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count(),
            'admins' => User::where('role', 'admin')->count(),
            'articles' => Article::count(),
            'published_articles' => Article::where('status', 'published')->count(),
            'draft_articles' => Article::where('status', 'draft')->count(),
            'duas' => Dua::count(),
            'hadiths' => Hadith::count(),
            'hadith_books' => HadithBook::count(),
            'surahs' => Surah::count(),
            'ayahs' => Ayah::count() ?: Surah::sum('ayah_count'),
            'favorites' => Favorite::count(),
            'events' => IslamicEvent::count(),
            'dua_categories' => DuaCategory::count(),
        ];

        // Legacy variable support for existing view components
        $totalUsers = $stats['users'];
        $totalAdmins = $stats['admins'];
        $totalSurahs = $stats['surahs'];
        $totalAyahs = $stats['ayahs'];
        $totalArticles = $stats['articles'];

        $recentUsers = User::latest()->take(5)->get();
        $recentArticles = Article::with('category')->latest()->take(5)->get();
        $recentFavorites = Favorite::with(['favoritable', 'user'])->latest()->take(5)->get();
        $recentSurahs = Surah::orderBy('number', 'asc')->take(5)->get();

        return view('admin.dashboard', compact(
            'stats',
            'totalUsers',
            'totalAdmins',
            'totalSurahs',
            'totalAyahs',
            'totalArticles',
            'recentUsers',
            'recentArticles',
            'recentFavorites',
            'recentSurahs'
        ));
    }
}
