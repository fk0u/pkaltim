<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Facility;

class FacilityController extends Controller
{
    // Menampilkan daftar fasilitas
    public function index()
    {
        $facilities = Facility::latest()->paginate(10);
        return view('admin.Facility', compact('facilities'));
    }

    // Menyimpan fasilitas baru
    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'icon_class' => 'required|string|max:255', // User input kode icon fontawesome
        ]);

        Facility::create($request->all());

        return redirect()->back()->with('success', 'Fasilitas berhasil ditambahkan!');
    }

    // Update fasilitas
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'icon_class' => 'required|string|max:255',
        ]);

        $facility = Facility::findOrFail($id);
        $facility->update($request->all());

        return redirect()->back()->with('success', 'Fasilitas berhasil diperbarui!');
    }

    // Hapus fasilitas
    public function destroy($id)
    {
        $facility = Facility::findOrFail($id);
        
        // Opsional: Cek dulu apakah fasilitas ini sedang dipakai oleh destinasi wisata?
        // Jika ingin maksa hapus (cascade), biarkan saja. 
        // Tapi di database sebaiknya setting Foreign Key 'ON DELETE CASCADE' di tabel pivot.
        
        $facility->delete();

        return redirect()->back()->with('success', 'Fasilitas berhasil dihapus!');
    }
}