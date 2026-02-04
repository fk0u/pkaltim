<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Destination;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use App\Models\DestinationImage; // Added Import

class DestinationController extends Controller
{
    public function index()
    {
        // Pastikan relation di Model Destination bernama 'category' (singular) atau 'categories' (plural)
        // Sesuaikan dengan nama function di App\Models\Destination.php
        $destinations = Destination::with('category')->latest()->paginate(10);
        $categories = Category::all();
        $facilities = \App\Models\Facility::all(); // Fetch all facilities

        $totalDestinations = Destination::count();
        $totalReviews = 0;

        return view('admin.Destination', compact('destinations', 'categories', 'facilities', 'totalDestinations', 'totalReviews'));
    }

    public function store(Request $request)
    {
        // 1. Validasi Input (Tambahkan latitude, longitude, status, opening_hours)
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:destinations,slug',
            'category_id' => 'required|exists:categories,id', // Pastikan ID kategori ada di tabel categories
            'description' => 'required',
            'price' => 'required|numeric',
            'address' => 'required|string',
            'opening_hours' => 'nullable|string',
            'status' => 'required|in:active,inactive', // Hanya boleh active atau inactive
            'latitude' => 'nullable',
            'longitude' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'facilities' => 'nullable|array',
            'facilities.*' => 'exists:facilities,id',
        ]);

        // 2. Upload Gambar
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('destinations', 'public');
        }

        // 3. Buat Slug Unik (Sederhana)
        // $slug = Str::slug($request->name); // Already handled by request->slug
        // Jika mau lebih aman dari duplikat, bisa tambahkan time(): $slug . '-' . time();

        // 4. Simpan ke Database
        $destination = Destination::create([
            'name' => $request->name,
            'slug' => Str::slug($request->slug),
            'category_id' => $request->category_id,
            'description' => $request->description,
            'price' => $request->price,

            // --- BAGIAN YANG DIPERBAIKI ---
            'address' => $request->address,
            'opening_hours' => $request->opening_hours,
            'status' => $request->status,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            // ------------------------------

            // REMOVED 'image' => $imagePath, as column does not exist
        ]);

        // Save Image to DestinationImage table
        if ($imagePath) {
            DestinationImage::create([
                'destination_id' => $destination->id,
                'image_path' => $imagePath,
                'is_primary' => true
            ]);
        }

        if ($request->has('facilities')) {
            $destination->facilities()->sync($request->facilities);
        }

        return redirect()->route('admin.destinations.index')->with('success', 'Destinasi berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $destination = Destination::findOrFail($id);

        // 1. Validasi Update
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:destinations,slug,' . $id,
            'category_id' => 'required|exists:categories,id',
            'description' => 'required',
            'price' => 'required|numeric',
            'address' => 'required|string',
            'opening_hours' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'facilities' => 'nullable|array',
            'facilities.*' => 'exists:facilities,id',
        ]);

        // 3. Siapkan data update
        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->slug),
            'category_id' => $request->category_id,
            'description' => $request->description,
            'price' => $request->price,

            // --- BAGIAN YANG DIPERBAIKI ---
            'address' => $request->address,
            'opening_hours' => $request->opening_hours,
            'status' => $request->status,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            // ------------------------------
        ];

        // 4. Handle Gambar (Jika user upload baru)
        if ($request->hasFile('image')) {
            // Cari gambar primary lama
            $oldPrimary = $destination->images()->where('is_primary', true)->first();

            if ($oldPrimary) {
                // Hapus file lama
                if (Storage::disk('public')->exists($oldPrimary->image_path)) {
                    Storage::disk('public')->delete($oldPrimary->image_path);
                }
                // Hapus record lama (atau update) - disini kita hapus lalu buat baru
                $oldPrimary->delete();
            }

            // Simpan yang baru
            $newImagePath = $request->file('image')->store('destinations', 'public');

            DestinationImage::create([
                'destination_id' => $destination->id,
                'image_path' => $newImagePath,
                'is_primary' => true
            ]);
        }

        // 5. Eksekusi Update
        $destination->update($data);

        // Sync facilities
        if ($request->has('facilities')) {
            $destination->facilities()->sync($request->facilities);
        } else {
            $destination->facilities()->detach(); // If clear all
        }

        return redirect()->route('admin.destinations.index')->with('success', 'Destinasi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $destination = Destination::findOrFail($id);

        // Delete all associated images from storage
        foreach ($destination->images as $img) {
            if (Storage::disk('public')->exists($img->image_path)) {
                Storage::disk('public')->delete($img->image_path);
            }
        }

        $destination->delete();

        return redirect()->back()->with('success', 'Destinasi berhasil dihapus!');
    }
}