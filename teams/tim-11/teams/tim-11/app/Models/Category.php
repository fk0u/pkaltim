<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    protected $fillable = ['nama_kategori'];

    public function kuliners()
    {
        return $this->belongsToMany(Kuliner::class, 'kuliner_categories', 'category_id', 'kuliner_id');
    }
}
