<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DestinationImage extends Model
{
    protected $guarded = ['id'];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}