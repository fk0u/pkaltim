<?php

namespace App\Http\Controllers;

use App\Models\Kuliner;
use App\Models\Category;
use App\Models\Rating;
use App\Models\Review;
use App\Models\ReviewLike;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class UserDashboardController extends Controller
{
    /**
     * Get or create anonymous user ID for database operations
     */
    private function anonymousUserId(): int
    {
        $user = \App\Models\User::where('email', 'anonymous@sireta.local')->first();
        if (!$user) {
            $user = \App\Models\User::create([
                'name' => 'Anonymous',
                'email' => 'anonymous@sireta.local',
                'password' => Hash::make(str()->random(16)),
                'role' => 'user',
                'status' => 'active',
            ]);
        }
        return $user->getKey();
    }

    /**
     * Get session-based identifier for likes tracking
     */
    private function getSessionId(): string
    {
        if (!session()->has('guest_id')) {
            session()->put('guest_id', str()->random(32));
        }
        return session()->get('guest_id');
    }

    /**
     * Main landing page - guest dashboard
     */
    public function index(Request $request)
    {
        $query = Kuliner::query()->with(['categories', 'place', 'ratings']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_kuliner', 'like', '%' . $search . '%')
                  ->orWhere('asal_daerah', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('category')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('nama_kategori', $request->category);
            });
        }

        if ($request->filled('status')) {
            $status = strtolower($request->status);
            if ($status === 'halal') {
                $query->where('is_halal', true);
            } elseif ($status === 'non-halal' || $status === 'non_halal') {
                $query->where('is_halal', false);
            } elseif ($status === 'vegetarian') {
                $query->where('is_vegetarian', true);
            }
        }

        $kuliners = $query->latest()->get();
        $categories = Category::all();

        // Get session favorites for highlighting
        $sessionFavorites = session()->get('favorites', []);

        return view('landingpage', compact('kuliners', 'categories', 'sessionFavorites'));
    }

    /**
     * Favorites page - accepts IDs from localStorage via request parameter
     */
    public function favorites(Request $request)
    {
        // Get favorite IDs from request (sent from localStorage) or fallback to session
        $idsParam = $request->input('ids');
        if ($idsParam) {
            // Parse comma-separated IDs from localStorage
            $favoriteIds = array_map('intval', array_filter(explode(',', $idsParam)));
        } else {
            // Fallback to session
            $favoriteIds = session()->get('favorites', []);
        }

        if (empty($favoriteIds)) {
            $kuliners = collect([]);
        } else {
            $query = Kuliner::query()
                ->with(['categories', 'place', 'ratings'])
                ->whereIn('id', $favoriteIds);

            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('nama_kuliner', 'like', '%' . $search . '%')
                      ->orWhere('asal_daerah', 'like', '%' . $search . '%');
                });
            }

            if ($request->filled('category')) {
                $query->whereHas('categories', function ($q) use ($request) {
                    $q->where('nama_kategori', $request->category);
                });
            }

            $kuliners = $query->latest()->get();
        }

        $categories = Category::all();

        return view('favorites', compact('kuliners', 'categories'));
    }

    /**
     * Show kuliner detail - API endpoint
     */
    public function show($id)
    {
        try {
            $kuliner = Kuliner::with(['categories', 'place', 'ratings'])->findOrFail($id);

            /** @var \App\Models\Kuliner $kuliner */
            $sessionFavorites = session()->get('favorites', []);
            $isFavorited = in_array($kuliner->getKey(), $sessionFavorites, true);

            // Get session-based rating if exists
            $sessionRatings = session()->get('ratings', []);
            $userRating = $sessionRatings[$kuliner->getKey()] ?? 0;

            // Get session likes
            $sessionLikes = session()->get('review_likes', []);

            // Transform reviews to anonymous
            $reviews = $kuliner->reviews()
                ->where('is_hidden', false)
                ->latest()
                ->get()
                ->map(function (Review $review) use ($sessionLikes) {
                    return [
                        'id' => $review->getKey(),
                        'ulasan' => $review->ulasan,
                        'created_at' => $review->created_at,
                        'user' => [
                            'id' => 0,
                            'name' => 'Anonymous',
                        ],
                        'is_liked' => in_array($review->getKey(), $sessionLikes, true),
                        'likes_count' => $review->likes()->count(),
                    ];
                });

            return response()->json([
                'kuliner' => $kuliner,
                'user_rating' => $userRating,
                'is_favorited' => $isFavorited,
                'reviews' => $reviews,
                'average_rating' => $kuliner->average_rating
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to load kuliner data: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal memuat data: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Toggle favorite - session based
     */
    public function guestToggleFavorite(Kuliner $kuliner)
    {
        $favorites = session()->get('favorites', []);
        $kulinerId = $kuliner->getKey();
        if (in_array($kulinerId, $favorites, true)) {
            $favorites = array_values(array_filter($favorites, fn($id) => $id !== $kulinerId));
            session()->put('favorites', $favorites);
            return response()->json(['status' => 'removed']);
        } else {
            $favorites[] = $kulinerId;
            session()->put('favorites', $favorites);
            return response()->json(['status' => 'added']);
        }
    }

    /**
     * Rate kuliner - anonymous
     */
    public function guestRate(Request $request, Kuliner $kuliner)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $anonId = $this->anonymousUserId();

        // Store rating in database under anonymous user
        $kulinerId = $kuliner->getKey();
        $rating = Rating::updateOrCreate(
            ['user_id' => $anonId, 'kuliner_id' => $kulinerId],
            ['rating' => $request->rating]
        );

        // Also store in session so user can see their rating
        $sessionRatings = session()->get('ratings', []);
        $sessionRatings[$kulinerId] = $request->rating;
        session()->put('ratings', $sessionRatings);

        // Recalculate average
        $kuliner->refresh();

        return response()->json([
            'status' => 'success',
            'rating' => $request->rating,
                    'average_rating' => $kuliner->average_rating
        ]);
    }

    /**
     * Submit review - anonymous
     */
    public function guestReview(Request $request, Kuliner $kuliner)
    {
        $request->validate([
            'ulasan' => 'required|string|max:1000',
        ]);

        $kulinerId = $kuliner->getKey();
        $review = Review::create([
            'user_id' => $this->anonymousUserId(),
            'kuliner_id' => $kulinerId,
            'ulasan' => $request->ulasan,
        ]);

        ActivityLog::create([
            'user_id' => $this->anonymousUserId(),
            'action' => 'review_kuliner',
            'description' => 'Reviewed: ' . $kuliner->getAttribute('nama_kuliner') . ' (Guest)'
        ]);

        return response()->json([
            'status' => 'success',
            'review' => [
                'id' => $review->getKey(),
                'ulasan' => $review->ulasan,
                'created_at' => $review->created_at,
                'user' => [
                    'id' => 0,
                    'name' => 'Anonymous',
                ],
                'is_liked' => false,
                'likes_count' => 0,
            ]
        ]);
    }

    /**
     * Toggle review like - session based
     */
    public function guestToggleReviewLike(Review $review)
    {
        $sessionLikes = session()->get('review_likes', []);

        $reviewId = $review->getKey();
        if (in_array($reviewId, $sessionLikes, true)) {
            // Unlike - remove from session
            $sessionLikes = array_values(array_filter($sessionLikes, fn($id) => $id !== $reviewId));
            session()->put('review_likes', $sessionLikes);

            // Also remove from database if exists
            $anonId = $this->anonymousUserId();
            ReviewLike::where('user_id', $anonId)->where('review_id', $reviewId)->delete();

            return response()->json(['status' => 'removed', 'likes_count' => $review->likes()->count()]);
        } else {
            // Like - add to session
            $sessionLikes[] = $reviewId;
            session()->put('review_likes', $sessionLikes);

            // Also add to database
            $anonId = $this->anonymousUserId();
            ReviewLike::firstOrCreate([
                'user_id' => $anonId,
                'review_id' => $reviewId
            ]);

            return response()->json(['status' => 'added', 'likes_count' => $review->likes()->count()]);
        }
    }
    public function storeFeedback(Request $request)
    {
        $request->validate([
            'category' => 'required|string',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
            'sender_name' => 'nullable|string|max:255',
        ]);

        \App\Models\Feedback::create([
            'category' => $request->category,
            'subject' => $request->subject ?: 'No Subject',
            'sender_name' => $request->sender_name ?: 'Anonymous',
            'message' => $request->message,
            'device_info' => $request->header('User-Agent'),
            'status' => 'unread',
        ]);

        return response()->json(['status' => 'success', 'message' => 'Feedback sent successfully!']);
    }
}
