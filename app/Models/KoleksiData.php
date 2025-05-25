<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KoleksiData extends Model
{
    protected $fillable = ['koleksi_id', 'image_id'];

    public function koleksi() {
        return $this->belongsTo(Koleksi::class);
    }

    public function image() {
        return $this->belongsTo(Image::class);
    }
}
