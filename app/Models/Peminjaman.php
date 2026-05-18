<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $fillable = [
        'idUser',
        'idBuku',
        'tanggalPeminjaman',
        'lamaPinjam',
        'jumlahBuku',
        'status',
        'catatan'
    ];

    public function user(): belongsTo {
        return $this->belongsTo(User::class, 'idUser', 'idUser');
    }

    public function buku(): belongsTo {
        return $this->belongsTo(Buku::class, 'idBuku', 'idBuku');
    }

    public function denda(): hasOne {
        return $this->hasOne(Denda::class, 'idDenda', 'idDenda');
    }
}
