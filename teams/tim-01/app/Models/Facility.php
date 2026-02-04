<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'icon_class', // Contoh: 'fa-solid fa-wifi'
    ];

    /**
     * Relasi ke Destination (Many-to-Many)
     * Ini berguna jika nanti kamu mau menampilkan "Wisata apa saja yang punya fasilitas WiFi"
     */
    public function destinations()
    {
        return $this->belongsToMany(Destination::class, 'destination_facilities', 'facility_id', 'destination_id');
    }
}