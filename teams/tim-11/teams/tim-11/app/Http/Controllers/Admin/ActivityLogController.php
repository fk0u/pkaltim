<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\View\View;

class ActivityLogController extends Controller
{
    /**
     * Display activity logs
     * Read-only, immutable
     */
    public function index(): View
    {
        // Fetch all activity logs with user information, ordered by newest first
        $logs = ActivityLog::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.activity-logs', compact('logs'));
    }
}
