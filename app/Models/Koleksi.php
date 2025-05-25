<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Koleksi extends Model
{
    protected $fillable = ['koleksi_user_id', 'koleksi_nama'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function data() {
        return $this->hasMany(KoleksiData::class, 'koleksi_id');
    }
}
