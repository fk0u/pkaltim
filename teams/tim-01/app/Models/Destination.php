<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $guarded = ['id'];

    // Relasi ke Kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi ke Gambar
    public function images()
    {
        return $this->hasMany(DestinationImage::class);
    }

    // Helper untuk ambil gambar utama
    public function getCoverImageAttribute()
    {
        $primary = $this->images->where('is_primary', true)->first();
        if ($primary) return $primary->image_path;
        
        // Jika tidak ada primary, ambil gambar pertama
        $first = $this->images->first();
        return $first ? $first->image_path : 'default.jpg';
    }

    // Relasi ke Fasilitas (Many to Many)
    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'destination_facilities');
    }

    // Relasi ke Review
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    
    // Scope untuk menampilkan review yang sudah diapprove saja
    public function approvedReviews()
    {
        return $this->reviews()->where('status', 'approved');
    }
}