<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    protected $fillable = [
        'titulo',
        'artista',
        'album',
        'playlist',
        'dur',
        'kbps',
        'barras',
    ];

    protected $casts = [
        'barras' => 'array',
    ];
}