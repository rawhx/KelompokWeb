<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['judul', 'deskripsi', 'path', 'user_id'];

    // Kode editan faiz
    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function isLikedBy($user) {
        return $this->likes()->where('user_id', $user->id)->exists();
    }
}
