<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_id', 'image_id', 'content'];

    public function image() {
        return $this->belongsTo(Image::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
