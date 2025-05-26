<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlbumData extends Model
{
    protected $fillable = ['album_id', 'image_id'];

    public function koleksi() {
        return $this->belongsTo(Album::class);
    }

    public function image() {
        return $this->belongsTo(Image::class);
    }
}
