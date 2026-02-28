<?php

namespace App\Http\Controllers;

use App\Models\Kuliner;
use App\Models\Place;
use App\Models\Category;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KulinerController extends Controller
{
    public function create()
    {
        $places = Place::all();
        $categories = Category::all();
        return view('createkuliner', compact('places', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kuliner' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'asal_daerah' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'external_image_url' => 'nullable|url',
            'google_maps_url' => 'nullable|url',
            'place_id' => 'required|exists:places,id',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'is_halal' => 'required|boolean',
        ]);

        $data = $request->only([
            'nama_kuliner',
            'deskripsi',
            'asal_daerah',
            'place_id',
            'google_maps_url',
            'external_image_url',
            'is_halal'
        ]);

        $data['is_vegetarian'] = $request->has('is_vegetarian');
        $data['created_by'] = Auth::id();

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('kuliner', 'public');
            $data['gambar'] = $path;
        }

        $kuliner = Kuliner::create($data);

        if ($request->has('categories')) {
            $kuliner->categories()->attach($request->categories);
        }

        // Log activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'created',
            'description' => "Admin created kuliner: {$kuliner->nama_kuliner}"
        ]);

        return redirect()->route('admin.kuliner.manage')->with('success', 'Kuliner berhasil ditambahkan!');
    }

    public function manage(Request $request)
    {
        $query = Kuliner::query()->with(['categories', 'place']);

        if ($request->filled('search')) {
            $query->where('nama_kuliner', 'like', '%' . $request->search . '%')
                ->orWhere('asal_daerah', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('nama_kategori', $request->category);
            });
        }

        $kuliners = $query->latest()->get();
        $categories = Category::all();

        return view('managekuliner', compact('kuliners', 'categories'));
    }

    public function edit($id)
    {
        $kuliner = Kuliner::with(['categories', 'place'])->findOrFail($id);
        $places = Place::all();
        $categories = Category::all();

        return view('editkuliner', compact('kuliner', 'places', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $kuliner = Kuliner::findOrFail($id);

        $request->validate([
            'nama_kuliner' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'asal_daerah' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'external_image_url' => 'nullable|url',
            'google_maps_url' => 'nullable|url',
            'place_id' => 'required|exists:places,id',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'is_halal' => 'required|boolean',
        ]);

        $data = $request->only([
            'nama_kuliner',
            'deskripsi',
            'asal_daerah',
            'place_id',
            'google_maps_url',
            'external_image_url',
            'is_halal'
        ]);

        $data['is_vegetarian'] = $request->has('is_vegetarian');

        // Handle image upload
        if ($request->hasFile('gambar')) {
            // Delete old image if exists
            if ($kuliner->gambar) {
                Storage::disk('public')->delete($kuliner->gambar);
            }
            $path = $request->file('gambar')->store('kuliner', 'public');
            $data['gambar'] = $path;
        }

        // If external URL is provided, remove local image
        if ($request->filled('external_image_url') && $kuliner->gambar) {
            Storage::disk('public')->delete($kuliner->gambar);
            $data['gambar'] = null;
        }

        $kuliner->update($data);

        // Sync categories
        if ($request->has('categories')) {
            $kuliner->categories()->sync($request->categories);
        }

        // Log activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'updated',
            'description' => "Admin updated kuliner: {$kuliner->nama_kuliner}"
        ]);

        return redirect()->route('admin.kuliner.manage')->with('success', 'Kuliner berhasil diperbarui!');
    }

    public function show($id)
    {
        try {
            $kuliner = Kuliner::with(['categories', 'place', 'creator'])->findOrFail($id);
            return response()->json($kuliner);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $kuliner = Kuliner::findOrFail($id);

            // Delete image if exists
            if ($kuliner->gambar) {
                Storage::disk('public')->delete($kuliner->gambar);
            }

            // Detach categories first (many-to-many)
            $kuliner->categories()->detach();

            // Delete related ratings
            $kuliner->ratings()->delete();

            // Delete related review likes first, then reviews
            foreach ($kuliner->reviews as $review) {
                $review->likes()->delete();
            }
            $kuliner->reviews()->delete();

            // Delete related favorites
            $kuliner->favorites()->delete();

            // Delete the kuliner
            $kuliner->delete();

            ActivityLog::create([
                'user_id' => Auth::id(),
                'action' => 'delete_kuliner',
                'description' => "Deleted kuliner: {$kuliner->nama_kuliner}"
            ]);

            return redirect()->route('admin.kuliner.manage')->with('success', 'Kuliner berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('admin.kuliner.manage')->with('error', 'Gagal menghapus kuliner: ' . $e->getMessage());
        }
    }

    public function landing(Request $request)
    {
        $query = Kuliner::query()->with(['categories', 'place', 'ratings', 'reviews.user']);

        if ($request->filled('search')) {
            $query->where('nama_kuliner', 'like', '%' . $request->search . '%')
                ->orWhere('asal_daerah', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('nama_kategori', $request->category);
            });
        }

        $kuliners = $query->latest()->get();
        $categories = Category::all();

        return view('landingpage', compact('kuliners', 'categories'));
    }

    public function showGuest($id)
    {
        try {
            $kuliner = Kuliner::with(['categories', 'place', 'reviews.user', 'ratings'])->findOrFail($id);

            $reviews = $kuliner->reviews()->with('user')->latest()->get()->map(function ($review) {
                return [
                    'id' => $review->id,
                    'ulasan' => $review->ulasan,
                    'created_at' => $review->created_at,
                    'user' => [
                        'id' => $review->user->id,
                        'name' => $review->user->name,
                    ],
                    'likes_count' => $review->likes()->count(),
                ];
            });

            return response()->json([
                'kuliner' => $kuliner,
                'reviews' => $reviews,
                'average_rating' => $kuliner->average_rating
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }
    }
}

