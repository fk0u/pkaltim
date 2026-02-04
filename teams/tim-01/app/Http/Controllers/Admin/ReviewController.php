<?php

namespace App\Http\Controllers\Admin;

//package imports
use Illuminate\Routing\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // Menampilkan semua review (Pending di atas)
    public function index()
    {
        $reviews = Review::with('destination')
            ->orderByRaw("FIELD(status, 'pending', 'approved')") // Pending duluan
            ->latest()
            ->paginate(10);

        return view('admin.Review', compact('reviews'));
    }

    // Fungsi untuk menyetujui review
    public function approve($id)
    {
        $review = Review::findOrFail($id);

        $review->update([
            'status' => 'approved'
        ]);

        return redirect()->back()->with('success', 'Review berhasil disetujui dan ditampilkan.');
    }

    // Fungsi untuk menghapus review (misal spam/kata kasar)
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->back()->with('success', 'Review berhasil dihapus.');
    }
}