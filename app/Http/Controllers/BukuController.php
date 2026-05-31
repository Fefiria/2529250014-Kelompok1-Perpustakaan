<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Genre;
use Illuminate\Http\Request;

use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;

use Illuminate\Support\Facades\Http;

class BukuController extends Controller
{    

    // Proxy cover image dari cloudinary untuk memghubungkan otomatis dengan filepond
    public function proxyCover(Request $request)
    {
        // Mendapatkan URl dari Cover Buku (Jika ada)
        $url = $request->query('url');
        
        if (!$url) {
            return response('URL tidak ditemukan', 404);
        }

        // Ambil gambar dari Cloudinary secara aman lewat backend
        $response = Http::get($url);

        if ($response->failed()) {
            return response('Gagal mengambil gambar', 500);
        }

        // Kembalikan sebagai file gambar asli ke FilePond
        return response($response->body(), 200)->header('Content-Type', $response->header('Content-Type'));
    }


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
            'status'=> 'required',
            'stok' => 'required|integer|min:0'
        ], [
            'judul.required' => 'Judul buku harus di isi',
            'pengarang.required' => 'Pengarang buku harus di isi',
            'penerbit.required' => 'Penerbit buku harus di isi',
            'tanggalTerbit.required' => 'Tanggal terbit buku harus di isi',
            'jumlahHalaman.required' => 'Jumlah halaman buku harus di isi',
            'idGenre.required' => 'Pilih minimal 1 genre untuk buku ini',   
            'status.required' => 'Status buku harus di isi',
            'stok.required' => 'Stok buku harus di isi',
            'stok.integer' => 'Stok buku harus berupa angka',
            'stok.min' => 'Minimal stok tidak boleh kurang dari 0'
        ]);

        // Jika stok buku 0, otomais set status buku menjadi tidak tersedia
        if($input['stok'] == 0){
            $input['status'] = 'tidak tersedia';
        }

        // Mengsortir data input ke database
        $buku = Buku::create([
            'judul' => $input['judul'],
            'pengarang' => $input['pengarang'],
            'penerbit' => $input['penerbit'],
            'tanggalTerbit' => $input['tanggalTerbit'],
            'jumlahHalaman' => $input['jumlahHalaman'],
            'status' => $input['status'],
            'stok' => $input['stok']
        ]);

        // Cek apakah user menambahkan photo buku? jika ditambahkan maka upload via cloudinary
        if($request->hasFile('photoUrl')){
            // Memanggil Cloudinary
            Configuration::instance();

            // Mengupload file ke cloudinary
            $update = (new UploadApi())->upload($request->file('photoUrl')->getRealPath(), [
                'folder' => 'buku'
            ]);

            // Ambil URL Gambar dari Cloudinary
            $photoUrl = $update['secure_url'];

            // Menyimpan URL Gambar dari Cloudinary ke Database
            $buku->update([
                'photoUrl' => $photoUrl
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
    public function edit($idBuku)
    {
        try {
            $buku = Buku::findOrFail($idBuku);
            $genre = Genre::all();
            return view('buku.edit', compact('buku', 'genre'));
        } catch (ModelNotFoundException $e) {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $idBuku)
    {
        // Cek apakah id buku yang di update ada di database?
        $buku = Buku::findOrFail($idBuku);

        // Validasi input dari user
        $input = $request->validate([
            'judul' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'tanggalTerbit' => 'required',
            'jumlahHalaman' => 'required',
            'idGenre' => 'required|array',
            'idGenre.*' => 'integer|exists:genres,idGenre',
            'status'=> 'required',
            'stok'=> 'required|integer|min:0'
        ], [
            'judul.required' => 'Judul buku harus di isi',
            'pengarang.required' => 'Pengarang buku harus di isi',
            'penerbit.required' => 'Penerbit buku harus di isi',
            'tanggalTerbit.required' => 'Tanggal terbit buku harus di isi',
            'jumlahHalaman.required' => 'Jumlah halaman buku harus di isi',
            'idGenre.required' => 'Pilih minimal 1 genre untuk buku ini',   
            'status.required' => 'Status buku harus di isi',
            'stok.required' => 'Stok buku harus di isi',
            'stok.integer' => 'Stok buku harus berupa angka',
            'stok.min' => 'Minimal stok tidak boleh kurang dari 0'
        ]);

        // Jika stok buku 0, otomais set status buku menjadi tidak tersedia
        if($input['stok'] == 0){
            $input['status'] = 'tidak tersedia';
        }

        // Mengsortir data input ke database
        $dataUpdate = [
            'judul' => $input['judul'],
            'pengarang' => $input['pengarang'],
            'penerbit' => $input['penerbit'],
            'tanggalTerbit' => $input['tanggalTerbit'],
            'jumlahHalaman' => $input['jumlahHalaman'],
            'status' => $input['status'],
            'stok' => $input['stok'],
            'photoUrl' => null
        ];

        // Cek apakah user menambahkan photo buku? jika ditambahkan maka upload via cloudinary
        if($request->hasFile('photoUrl')){
            // Memanggil Cloudinary
            Configuration::instance();

            // Mengupload file ke cloudinary
            $update = (new UploadApi())->upload($request->file('photoUrl')->getRealPath(), [
                'folder' => 'buku'
            ]);

            // Ambil URL Gambar dari Cloudinary
            $dataUpdate['photoUrl'] = $update['secure_url'];
        } else {
            // Jika cover buku di hapus dan tidak menambahkan cover baru
            if($buku->photoUrl && !$request->has('photoUrl')){
                $dataUpdate['photoUrl'] = null;
            }
        }

        // Mengupdate data buku
        $buku->update($dataUpdate);

        // Mengsinkron id genre ke dalam tabel relasi antara buku dan genre
        $buku->genre()->sync($request->idGenre);

        // Kembalikan user ke index dan beritahu bahwa buku yang ditambahkan telah berhasil
        return redirect()->route('buku.index')->with('success', 'Berhasil mengupdate buku dengan nama ' . $buku->judul);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($idBuku)
    {
        $buku = Buku::findOrFail($idBuku);

        $namaBuku = $buku->judul;

        $buku->delete();

        return redirect()->route('buku.index')->with('success','Berhasil menghapus buku ' . $namaBuku);
    }

}
