<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Genre;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bukus = Buku::with('genre')->paginate(10);
        return view('buku.index', compact('bukus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genre = Genre::all();
        return view('buku.create', compact('genre'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input dari user
        $input = $request->validate([
            'judul' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'tanggalTerbit' => 'required',
            'jumlahHalaman' => 'required',
            'idGenre' => 'required|array',
            'idGenre.*' => 'integer|exists:genres,idGenre',
            'status'=> 'required'
        ], [
            'judul.required' => 'Judul buku harus di isi',
            'pengarang.required' => 'Pengarang buku harus di isi',
            'penerbit.required' => 'Penerbit buku harus di isi',
            'tanggalTerbit.required' => 'Tanggal terbit buku harus di isi',
            'jumlahHalaman.required' => 'Jumlah halaman buku harus di isi',
            'idGenre.required' => 'Pilih minimal 1 genre untuk buku ini',   
            'status.required' => 'Status buku harus di isi'
        ]);

        // Mengsortir data input ke database
        $buku = Buku::create([
            'judul' => $input['judul'],
            'pengarang' => $input['pengarang'],
            'penerbit' => $input['penerbit'],
            'tanggalTerbit' => $input['tanggalTerbit'],
            'jumlahHalaman' => $input['jumlahHalaman'],
            'status' => $input['status']
        ]);

        // Cek apakah user menambahkan photo buku? jika maka taruh di folder public/uploads/buku
        if($request->hasFile('photoUrl')){
            $file = $request->file('photoUrl');
            $fileExtension = $file->getClientOriginalExtension();

            $newFileName = $buku->idBuku . '.' . $fileExtension;
            $file->move(public_path('uploads/buku'), $newFileName);

            $buku->update([
                'photoUrl' => $newFileName
            ]);
        }

        // Memasukkan id genre ke dalam tabel relasi antara buku dan genre
        $genre = $request->input('idGenre');
        $buku->genre()->attach($genre);

        // Kembalikan user ke index dan beritahu bahwa buku yang ditambahkan telah berhasil
        return redirect()->route('buku.index')->with('success', 'Berhasil menambahkan buku dengan nama ' . $buku->judul);
    }

    /**
     * Display the specified resource.
     */
    public function show(Buku $buku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Buku $buku)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Buku $buku)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Buku $buku)
    {
        //
    }

}
