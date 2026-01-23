<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guarded = ['id']; // Semua kolom bisa diisi kecuali ID

    protected $hidden = [
        'password',
    ];
}