<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Destination;
use App\Models\DestinationImage;
use Illuminate\Support\Facades\Storage;

class DestinationImageController extends Controller
{
    // [BARU] Menampilkan Daftar Destinasi untuk dipilih
    public function selectionList()
    {
        // Ambil ID, Nama, dan jumlah foto untuk info tambahan
        $destinations = Destination::withCount('images')->latest()->get();
        $totalImage = DestinationImage::count();
        return view('admin.gallery.selection', compact('destinations', 'totalImage'));
    }

    // Menampilkan Halaman Upload untuk destinasi yang dipilih
    public function index($id)
    {
        $destination = Destination::with('images')->findOrFail($id);
        return view('admin.gallery.manage', compact('destination'));
    }

    // Proses Upload Foto
    public function store(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $destination = Destination::findOrFail($id);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('destination_images', 'public');

            // LOGIKA THUMBNAIL OTOMATIS:
            // Jika ini foto pertama, set is_primary = 1. Jika tidak, 0.
            $isPrimary = $destination->images()->count() == 0 ? 1 : 0;

            DestinationImage::create([
                'destination_id' => $destination->id,
                'image_path'     => $path,
                'is_primary'     => $isPrimary
            ]);
        }

        return redirect()->back()->with('success', 'Foto berhasil ditambahkan!');
    }

    // Set Foto Jadi Thumbnail (Primary)
    public function setPrimary($id)
    {
        $image = DestinationImage::findOrFail($id);
        
        // 1. Reset semua foto milik destinasi ini jadi 0 (Bukan Thumbnail)
        DestinationImage::where('destination_id', $image->destination_id)->update(['is_primary' => 0]);

        // 2. Set foto yang dipilih jadi 1 (Thumbnail)
        $image->update(['is_primary' => 1]);

        return redirect()->back()->with('success', 'Thumbnail utama berhasil diganti!');
    }

    // Hapus Foto
    public function destroy($id)
    {
        $image = DestinationImage::findOrFail($id);

        // Hapus file fisik
        if (Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }

        // Hapus record database
        $image->delete();

        // Cek jika yang dihapus adalah Primary, kita harus set primary baru (opsional, biar gak kosong)
        // Logika: Ambil foto lain secara acak untuk jadi pengganti primary
        $checkPrimary = DestinationImage::where('destination_id', $image->destination_id)->where('is_primary', 1)->first();
        if(!$checkPrimary) {
             $newPrimary = DestinationImage::where('destination_id', $image->destination_id)->first();
             if($newPrimary) {
                 $newPrimary->update(['is_primary' => 1]);
             }
        }

        return redirect()->back()->with('success', 'Foto berhasil dihapus.');
    }
}