<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\User;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahBuku = Buku::count();
        $jumlahAnggota = User::count();
        $jumlahPeminjaman = Peminjaman::count();
        $jumlahGenre = Genre::count();

        $topBooks = DB::table('detail_peminjamans')
            ->join('bukus', 'detail_peminjamans.idBuku', '=', 'bukus.idBuku')
            ->select('bukus.judul', DB::raw('COUNT(detail_peminjamans.idBuku) as total_dipinjam'))
            ->groupBy('detail_peminjamans.idBuku', 'bukus.judul')
            ->orderBy('total_dipinjam', 'desc')
            ->take(5)
            ->get();

        $labelBukuPopuler = $topBooks->pluck('judul')->toArray();
        $jumlahBukuPopuler = $topBooks->pluck('total_dipinjam')->toArray();

        return view('dashboard', compact(
            'jumlahBuku',
            'jumlahAnggota',
            'jumlahPeminjaman',
            'jumlahGenre',
            'labelBukuPopuler',
            'jumlahBukuPopuler'
        ));
    }
}
