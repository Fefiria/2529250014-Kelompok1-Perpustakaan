<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Buku;
use App\Models\Genre;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
        $now = now()->startOfDay();

        $totalBukuPeminjaman = 0;
        $totalPeminjaman = 0;

        $totalBukuBelumDikembalikan = 0;
        $totalPeminjamanBelumKembali = 0;

        $totalPeminjamanTerlambat = 0;
        $totalBukuTerlambat = 0;

        $isTerlambat = false;

        $peminjaman = Peminjaman::where('idUser', Auth::id())
            ->where('status', '!=', 'Telah Dikembalikan')
            ->with(['details'])
            ->get();

        if ($peminjaman->isNotEmpty()) {
            foreach ($peminjaman as $pinjam) {
                
                $tanggalBatas = Carbon::parse($pinjam->tanggalKembali)->startOfDay();
                
                if ($tanggalBatas->lessThan($now)) {
                    $totalPeminjamanTerlambat++;
                    $isTerlambat = true;
                } else {
                    $totalPeminjamanBelumKembali++;
                    $isTerlambat = false;
                }

                $totalPeminjaman++;

                foreach ($pinjam->details as $detail) {
                    if($detail->status === 'dipinjam') {                        
                        if ($isTerlambat) {
                            $totalBukuTerlambat++;
                        } 
                        $totalBukuBelumDikembalikan++;
                    }
                    $totalBukuPeminjaman++;
                }
            }
        }

        $peminjamanHarian = collect();
    
        // 🎯 LOOPING 30 HARI KE BELAKANG
        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $labelDate = now()->subDays($i)->format('d M'); // Format rapi buat di Chart (Contoh: 12 Jun)

            // Hitung total buku yang dipinjam member ini di tanggal tersebut
            $count = Peminjaman::where('idUser', Auth::id())
                ->whereDate('tanggalPeminjaman', $date)
                ->join('detail_peminjamans', 'peminjamans.idPeminjaman', '=', 'detail_peminjamans.idPeminjaman')
                ->count();

            $peminjamanHarian->push([
                'tanggal' => $labelDate,
                'total' => $count
            ]);
        }

        $genreData = Peminjaman::where('idUser', Auth::id())->whereHas('details', function($query) {
            $query->whereHas('buku.genre'); 
        })->get()->flatMap(function ($pinjam) {
            return $pinjam->details->flatMap(function ($detail) {
                return $detail->buku->genre; 
            });
        })
        ->groupBy('idGenre')
        ->map(function ($group) {
            return [
                'nama' => $group->first()->nama,
                'total' => $group->count()
            ];
        });

        $donutLabels = $genreData->pluck('nama')->toArray();
        $donutValues = $genreData->pluck('total')->toArray();

        $chartLabels = $peminjamanHarian->pluck('tanggal')->toArray();
        $chartData = $peminjamanHarian->pluck('total')->toArray();

        $bukuPopuler = Buku::withCount('detailPeminjamans') // Otomatis menghitung agregat jumlah baris di tabel detail
        ->orderBy('detail_peminjamans_count', 'desc') // Diurutkan dari yang hitungan count-nya paling tinggi
        ->take(5)
        ->get();
    // 🎯 TABEL 2: Top 5 Buku dengan Rata-rata Ulasan/Rating Tertinggi
        $bukuRatingTertinggi = Buku::withAvg('review as rating_avg', 'review_bukus.rating')
            ->withCount('review as review_count') 
            ->orderBy('rating_avg', 'desc') 
            ->take(5)
            ->get();
        return view('dashboard', compact('totalBukuBelumDikembalikan', 'totalPeminjamanBelumKembali', 'totalBukuTerlambat', 'totalPeminjamanTerlambat', 'isTerlambat', 
                'totalBukuPeminjaman',  'totalPeminjaman', 
                'chartLabels', 'chartData',
                'donutLabels', 'donutValues',
                'bukuPopuler', 'bukuRatingTertinggi'));
    }

    public function listbuku(Request $request)
    {
        $query = Buku::with([
            'genre', 
            'review' => function($query) {
                $query->latest();
            }
        ])->withCount('review')->withAvg('review as rating_avg', 'review_bukus.rating');

        // Mencari buku berdasarkan judul atau pengarang
        $query->when($request->filled('search'), function ($q) use ($request) {
            $search = $request->search;
            $q->where(function ($sub) use ($search) {
                $sub->where('judul', 'like', '%' . $search . '%')->orWhere('pengarang', 'like', '%' . $search . '%');
            });
        });

        // Filter by genre dan bisa banyak genre
        $query->when($request->filled('idGenre') && is_array($request->idGenre), function ($q) use ($request) {
            $selectedGenres = array_filter($request->idGenre); 

            if (!empty($selectedGenres)) {
                $q->whereHas('genre', function ($sub) use ($selectedGenres) {
                    $sub->whereIn('genres.idGenre', $selectedGenres);
                });
            }
        });

        // Menampilkan hasil filter
        $bukus = $query->paginate(24)->appends($request->all());
        
        // Mengambil semua genre
        $genres = Genre::all();

        return view('listbuku', compact('bukus', 'genres'));
    }

    public function riwayatpeminjaman()
    {
        $peminjaman = Peminjaman::where('idUser', Auth::id())->paginate(10);

        return view('riwayatpeminjaman', compact('peminjaman'));
    }
}
