<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminFeedbackController extends Controller
{
    public function index()
    {
        // Auto-delete old feedback (Retention Policy: 12 days)
        $oldFeedbacks = Feedback::where('created_at', '<', now()->subDays(12))->get();

        foreach ($oldFeedbacks as $feedback) {
            $id = $feedback->id;
            $feedback->delete();

            ActivityLog::create([
                'user_id' => null, // System
                'action' => 'System Auto-Delete',
                'description' => "System auto-deleted feedback ID #{$id}"
            ]);
        }

        $unreadFeedbacks = Feedback::where('status', 'unread')->latest()->get();
        $readFeedbacks = Feedback::where('status', 'read')->latest('read_at')->get();

        return view('admin.feedback.index', compact('unreadFeedbacks', 'readFeedbacks'));
    }

    public function show($id)
    {
        $feedback = Feedback::findOrFail($id);
        return view('admin.feedback.show', compact('feedback'));
    }

    public function markAsRead($id)
    {
        $feedback = Feedback::findOrFail($id);
        
        if ($feedback->status === 'unread') {
            $feedback->update([
                'status' => 'read',
                'read_at' => now(),
            ]);

            ActivityLog::create([
                'user_id' => Auth::id(),
                'action' => 'Read Feedback',
                'description' => "Admin read feedback from {$feedback->email}"
            ]);
        }

        return redirect()->route('admin.feedback.index')->with('success', 'Feedback marked as read.');
    }

    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);

        if ($feedback->status === 'unread') {
            return back()->with('error', 'Cannot delete unread feedback.');
        }

        $email = $feedback->email;
        $feedback->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Delete Feedback',
            'description' => "Admin deleting feedback from {$email}"
        ]);

        return back()->with('success', 'Feedback deleted successfully.');
    }
}
