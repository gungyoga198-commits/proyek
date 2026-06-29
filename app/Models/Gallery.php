<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'galleries';

    protected $fillable = [
        'judul',
        'deskripsi',
        'kategori',
        'urutan',
        'aktif',
        'foto'
    ];

    protected $casts = [
        'aktif' => 'boolean',
    ];
}