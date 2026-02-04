<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'destinations';

    // 1. Kolom yang bisa diisi (Wajib sama dengan Controller)
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'address',      // <--- Pastikan ini ada
        'price',
        'status',
        'price_note',
        'latitude',
        'longitude',
        'opening_hours',
    ];

    // ==========================
    // RELASI DATABASE
    // ==========================

    // 2. Relasi ke Category
    // 2. Relasi ke Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // 3. Relasi ke Facilities (Pivot)
    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'destination_facilities');
    }

    // 4. Relasi ke Images 
    // (Fungsi ini memanggil file DestinationImage.php di bawah)
    public function images()
    {
        return $this->hasMany(DestinationImage::class);
    }

    // 5. Relasi ke Reviews
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function approvedReviews()
    {
        // Kita pakai relasi reviews, tapi difilter statusnya
        return $this->hasMany(Review::class)->where('status', 'approved');
    }

    // Accessor for thumbnail
    public function getThumbnailAttribute()
    {
        // 1. Cek jika ada gambar primary
        $primary = $this->images->where('is_primary', true)->first();
        if ($primary) {
            return asset('storage/' . $primary->image_path);
        }

        // 2. Jika tidak ada, ambil gambar pertama apa saja
        $first = $this->images->first();
        if ($first) {
            return asset('storage/' . $first->image_path);
        }

        // 3. Fallback placeholder
        return 'https://images.unsplash.com/photo-1596401057633-565652f56878?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';
    }
}