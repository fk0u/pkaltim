<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $nama_kuliner
 * @property string|null $deskripsi
 * @property string|null $asal_daerah
 * @property string|null $gambar
 * @property string|null $external_image_url
 * @property-read float $average_rating
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $categories
 * @mixin \Eloquent
 */
class Kuliner extends Model
{
    protected $table = 'kuliner';

    protected $fillable = [
        'nama_kuliner',
        'deskripsi',
        'asal_daerah',
        'gambar',
        'google_maps_url',
        'external_image_url',
        'is_vegetarian',
        'is_halal',
        'place_id',
        'created_by',
    ];

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'kuliner_categories', 'kuliner_id', 'category_id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function getAverageRatingAttribute()
    {
        return $this->ratings()->avg('rating') ?: 0;
    }

    public function isFavoritedBy(User $user)
    {
        return $this->favorites()->where('user_id', $user->id)->exists();
    }
}
