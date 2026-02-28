<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with(['user', 'kuliner.ratings'])->latest()->get();
        return view('manageulasan', compact('reviews'));
    }

    public function destroy($id)
    {
        $review = Review::with(['user', 'kuliner'])->findOrFail($id);

        // Mark as hidden (Deleted status)
        $review->is_hidden = true;
        $review->save();

        // Log Activity
        $userName = $review->user ? $review->user->name : 'Anonymous';
        $kulinerName = $review->kuliner ? $review->kuliner->name : 'Unknown Kuliner';

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Delete Review',
            'description' => "Admin deleted review by {$userName} in kuliner {$kulinerName}"
        ]);

        return redirect()->back()->with('success', 'Ulasan berhasil dihapus.');
    }
}
