<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kuliner;
use App\Models\Review;
use App\Models\Rating;
use App\Models\ActivityLog;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalKuliner = Kuliner::count();
        $totalReviews = Review::where('is_hidden', false)->count();
        $avgRating = Rating::avg('rating') ?? 0;

        $recentKuliner = Kuliner::latest()->take(5)->get();
        $recentReviews = Review::with('kuliner')
            ->where('is_hidden', false)
            ->latest()
            ->take(5)
            ->get();

        return view('dashboardadmin', compact(
            'totalKuliner',
            'totalReviews',
            'avgRating',
            'recentKuliner',
            'recentReviews'
        ));
    }

    public function activityLogs()
    {
        $logs = ActivityLog::with('user')->latest()->paginate(20);
        return view('admin.activity_logs', compact('logs'));
    }

    public function guidelines()
    {
        return view('admin.guidelines');
    }
}
