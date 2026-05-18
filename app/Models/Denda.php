<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Denda extends Model
{
    protected $fillable = [
        'idPeminjaman',
        'jumlahDenda',
        'status'
    ];

    public function peminjaman(): belongsTo {
        return $this->belongsTo(Peminjaman::class, 'idPeminjaman', 'idPeminjaman');
    }
}
