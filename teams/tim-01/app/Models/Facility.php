<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $guarded = ['id'];

    public function destinations()
    {
        return $this->belongsToMany(Destination::class, 'destination_facilities');
    }
}