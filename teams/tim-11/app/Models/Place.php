<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'nama_tempat',
        'alamat',
        'kota',
        'latitude',
        'longitude',
    ];

    public function kuliners()
    {
        return $this->hasMany(Kuliner::class);
    }
}
