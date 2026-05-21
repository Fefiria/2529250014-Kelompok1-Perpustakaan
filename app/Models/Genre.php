<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $table = 'genres';
    protected $primaryKey = 'idGenre';

    protected $fillable = [
        "nama",
        "deskripsi"
    ];
}
