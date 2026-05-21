<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Buku;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Genre extends Model
{
    protected $table = 'genres';
    protected $primaryKey = 'idGenre';

    protected $fillable = [
        "nama",
        "deskripsi"
    ];

    public function buku(): HasMany {
        return $this->hasMany(Buku::class, 'idGenre', 'idGenre');
    }
}
