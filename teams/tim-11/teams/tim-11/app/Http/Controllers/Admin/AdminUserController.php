<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::where('role', '!=', 'admin')->get(); // Don't manage other admins for now
        return view('admin.manage_users', compact('users'));
    }

    public function show(User $user)
    {
        return response()->json([
            'user' => $user,
            'joined_at' => $user->created_at->format('d F Y'),
            'review_count' => '-', // Placeholder as per instruction
        ]);
    }

    public function toggleBan(Request $request, User $user)
    {
        $user->is_banned = !$user->is_banned;
        $user->save();

        // Log the action
        ActivityLog::create([
            'user_id' => auth::id(), // Admin who performed the action
            'action' => $user->is_banned ? 'ban_user' : 'unban_user',
            'description' => ($user->is_banned ? 'Banned' : 'Unbanned') . " user {$user->name} ({$user->email})",
        ]);

        // Also log for the target user so it shows in their history
        ActivityLog::create([
            'user_id' => $user->id,
            'action' => 'account_status_change',
            'description' => "Account was " . ($user->is_banned ? 'banned' : 'unbanned') . " by admin.",
        ]);

        return response()->json(['success' => true, 'is_banned' => $user->is_banned]);
    }

    public function logs(User $user)
    {
        $logs = $user->activityLogs()->latest()->get()->map(function ($log) {
            return [
                'action' => $log->action,
                'description' => $log->description,
                'created_at' => $log->created_at->format('d M Y H:i'),
            ];
        });

        return response()->json(['logs' => $logs]);
    }
}
