<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\DetailPeminjaman;
use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\User;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peminjamans = Peminjaman::with(['user', 'details.buku'])->get();        
        return view('peminjaman.index', compact('peminjamans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $buku = Buku::all();
        return view('peminjaman.create', compact('users','buku'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'idUser'        => 'required|exists:users,idUser',
            'tanggalPinjam' => 'required',
            'lamaPinjam'    => 'required|integer|min:1',
            'idBuku'        => 'required|array',
            'idBuku.*'      => 'exists:bukus,idBuku',
            'keterangan'    => 'nullable|string'
        ],[
            'idUser.required' => 'Peminjam harus di isi',
            'tanggalPinjam.required' => 'Tanggal pinjam harus di isi',
            'lamaPinjam.required' => 'Lama pinjam harus di isi',
            'lamaPinjam.min' => 'Lama pinjam minimal 1 hari',
            'idBuku.required' => 'Buku minimal 1 harus di isi',
            'idUser.exists' => 'Peminjam tidak ditemukan di database',
            'idBuku.exists' => 'Buku tidak ditemukan di database'
        ]);

        // Mengonversi tanggal pinjam ke date time
        $tanggalPinjam = Carbon::parse($request->tanggalPinjam);

        // Menambahkan durasi pinjam dengan tanggal pinjam sehingga menghasilkan tanggal kembali
        $tanggalKembali = $tanggalPinjam->copy()->addDays((int) $request->lamaPinjam);

        // Menyimpan data peminjaman ke database
        $peminjaman = Peminjaman::create([
            'idUser'         => $request->idUser,
            'tanggalPeminjaman'  => $request->tanggalPinjam,
            'tanggalKembali' => $tanggalKembali->format('Y-m-d'),
            'lamaPinjam' => $request->lamaPinjam,
            'catatan'     => $request->keterangan,
            'status'         => 'dipinjam',
        ]);

        // Sinkronisasi antara buku dan peminjaman serta pengurangan stok buku
        foreach ($request->idBuku as $idBuku) {
            DetailPeminjaman::create([
                'idPeminjaman' => $peminjaman->idPeminjaman,
                'idBuku'       => $idBuku,
                'status'       => 'dipinjam',
            ]);

            $buku = Buku::find($idBuku);
            if ($buku && $buku->stok > 0) {
                $buku->decrement('stok');
                if ($buku->stok == 0) {
                    $buku->update(['status' => 'tidak tersedia']);
                }
            }
        }

        return redirect()->route('peminjaman.index')->with('success', 'Berhasil melakukan peminjaman');
    }

    /**
     * Display the specified resource.
     */
    public function show(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Peminjaman $peminjaman)
    {
        //
    }
}
