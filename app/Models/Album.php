<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = ['album_user_id', 'album_nama'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function data() {
        return $this->hasMany(AlbumData::class, 'album_id');
    }
}
