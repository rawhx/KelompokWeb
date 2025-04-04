<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['judul', 'deskripsi', 'path', 'user_id'];
}
