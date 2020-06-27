<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model 
{
    protected $fillable = [
        'judul',
        'gambar',
        'nama_pemain',
        'sinopsis',
        'user_rate'
    ];
}