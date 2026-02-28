<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $kuliner_id
 * @property string $ulasan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ReviewLike[] $likes
 * @mixin \Eloquent
 */
class Review extends Model
{
    protected $fillable = ['user_id', 'kuliner_id', 'ulasan', 'is_hidden', 'report_reason'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kuliner()
    {
        return $this->belongsTo(Kuliner::class);
    }

    public function likes()
    {
        return $this->hasMany(ReviewLike::class);
    }

    public function isLikedBy(User $user)
    {
        return $this->likes()->where('user_id', $user->getKey())->exists();
    }
}
