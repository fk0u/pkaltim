<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $guarded = ['id'];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}