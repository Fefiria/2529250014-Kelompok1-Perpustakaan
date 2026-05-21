@extends('layouts.main')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Tambah Buku</h3>
                <p class="text-subtitle text-muted">Gunakan halaman ini untuk menambahkan buku.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Buku</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    
    <div class="row match-height justify-content-center">
        <div class="col-9">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" method="POST" action="{{ route('buku.store') }}">
                            <div class="row gap-2">
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="judul-buku-column">Judul Buku</label>
                                        <div class="position-relative">
                                            <input type="text" id="judul-buku-column" class="form-control mt-1" placeholder="Masukkan judul buku..." name="judul-buku-column">
                                            <div class="form-control-icon">
                                                <i class="bi bi-journal-bookmark"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="pengarang-column">Pengarang</label>
                                        <div class="position-relative">
                                            <input type="text" id="pengarang-column" class="form-control mt-1" placeholder="Masukkan pengarang buku..." name="pengarang-column">
                                            <div class="form-control-icon">
                                                <i class="bi bi-person-lines-fill"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="penerbit-column">Penerbit</label>
                                        <div class="position-relative">
                                            <input type="text" id="penerbit-column" class="form-control mt-1" placeholder="Masukkan penerbit buku..." name="penerbit-column">
                                            <div class="form-control-icon">
                                                <i class="bi bi-globe-americas"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="tanggal-terbit-column">Tanggal Terbit</label>
                                        <div class="position-relative">
                                            <input type="date" id="tanggal-terbit-column" class="form-control mb-3 flatpickr-only-date mt-1" placeholder="Masukkan tanggal terbit buku..." name="penerbit-column">
                                            <div class="form-control-icon">
                                                <i class="bi bi-calendar"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="jumlah-halaman-column">Jumlah Halaman</label>
                                        <div class="position-relative">
                                            <input type="text" id="jumlah-halaman-column" class="form-control mt-1" placeholder="Masukkan jumlah halaman buku..." name="jumlah-halaman-column">
                                            <div class="form-control-icon">
                                                <i class="bi bi-123"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group mb-3">
                                        <label for="foto-buku" class="form-label">Foto Buku</label>
                                        <input type="file" class="form-control" id="foto-buku" name="foto_buku" accept="image/*" onchange="previewImage()">
                                        <small class="text-muted">Format yang didukung: JPG, JPEG, PNG. Maksimal 2MB.</small>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label d-block">Preview Photo Buku</label>
                                        <div class="border rounded p-2 d-flex align-items-center justify-content-center" 
                                            style="max-width: 200px; min-height: 250px; background-color: #f8f9fa;">
                                            
                                            <img id="img-preview" src="https://via.placeholder.com/150x200?text=No+Image" 
                                                class="img-fluid rounded shadow-sm" 
                                                style="max-height: 230px; width: 100%; object-fit: cover;" 
                                                alt="Preview Foto">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<footer>
    <div class="footer clearfix mb-0 text-muted">
        <div class="float-start">
            <p>2023 &copy; Mazer</p>
        </div>
        <div class="float-end">
            <p>Crafted with <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span>
                by <a href="https://saugi.me">Saugi</a></p>
        </div>
    </div>
</footer>
@endsection