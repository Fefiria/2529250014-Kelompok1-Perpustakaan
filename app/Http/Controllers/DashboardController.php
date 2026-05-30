<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahBuku = Buku::count();
        $jumlahAnggota = User::count();
        $jumlahPeminjaman = Peminjaman::count();

        return view('dashboard', compact(
            'jumlahBuku',
            'jumlahAnggota',
            'jumlahPeminjaman'
        ));
    }
}
