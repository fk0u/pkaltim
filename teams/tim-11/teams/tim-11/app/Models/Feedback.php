<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'subject',
        'sender_name',
        'message',
        'device_info',
        'status',
        'read_at',
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];
}
