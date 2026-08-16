<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Surah;
use App\Models\User;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index(): View
    {
        $totalUsers = User::count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalSurahs = Surah::count();
        $totalAyahs = Surah::sum('ayah_count');

        $recentSurahs = Surah::orderBy('number', 'asc')->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalAdmins',
            'totalSurahs',
            'totalAyahs',
            'recentSurahs'
        ));
    }
}
