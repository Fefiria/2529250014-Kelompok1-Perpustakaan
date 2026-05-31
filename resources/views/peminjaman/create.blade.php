@extends('layouts.main')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/extensions/filepond/filepond.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/extensions/choices.js/public/assets/styles/choices.min.css') }}">
    <style>
        .hoverAnimation:hover{
            text-decoration: underline;
            cursor: pointer;
        }
    </style>
@endpush

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
                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible show fade pb-1" role="alert">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{  $error }}</li>
                                    @endforeach 
                                </ul> 
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <form action="{{ route('peminjaman.store') }}" method="POST">
    @csrf
    <div class="row">
        
        <div class="col-lg-5 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">1. Informasi Peminjam</h4>
                </div>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label class="form-label">Nama Anggota / Peminjam</label>
                        <select class="choices form-select" name="idUser">
                            <option value="">Cari Nama Anggota...</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->nama }} - ({{ $user->username }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">Tanggal Pinjam</label>
                        <input type="text" class="form-control flatpickr-no-config" name="tanggalPinjam" placeholder="Pilih Tanggal..">
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">Tanggal Harus Kembali</label>
                        <input type="text" class="form-control flatpickr-no-config" name="tanggalKembali" placeholder="Pilih Tanggal..">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-7 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">2. Buku yang Dipinjam</h4>
                </div>
                <div class="card-body">
                    <div class="form-group mb-4">
                        <label class="form-label">Pilih Buku</label>
                        <select class="choices form-select" name="idBuku[]" multiple="multiple" data-placeholder="Kamu bisa memilih beberapa buku sekaligus...">
                            @foreach($buku as $dataBuku)
                                <option value="{{ $dataBuku->idBuku }}">{{ $dataBuku->judul }} (Tersedia: {{ $dataBuku->stok }})</option>
                            @endforeach
                        </select>
                        <small class="text-muted mt-1 d-block">Petunjuk: Klik atau ketik untuk menambah lebih dari 1 buku.</small>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('peminjaman.index') }}" class="btn btn-light-secondary">Batal</a>
                        <button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i> Proses Peminjaman</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/filepond-plugin-image-filter/filepond-plugin-image-filter.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/filepond-plugin-file-validate-type/filepond-plugin-file-validate-type.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/filepond-plugin-image-crop/filepond-plugin-image-crop.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/filepond-plugin-image-resize/filepond-plugin-image-resize.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/filepond/filepond.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/filepond.js') }}"></script>
    <script src="{{ asset('assets/extensions/choices.js/public/assets/scripts/choices.min.js') }}"></script>
    <script>
        let choicesInput = document.querySelectorAll('.choices');
        let initChoices;
        for (let i = 0; i < choicesInput.length; i++) {
            initChoices = new Choices(choicesInput[i], {
                delimiter: ',',
                editItems: true,
                maxItemCount: -1, // -1 artinya tidak terbatas, bisa pilih sebanyak mungkin
                removeItemButton: true, // Memunculkan tombol 'x' untuk hapus genre pilihan
                allowHTML: true,
                searchFields: ['label', 'value']
            });
        }
    </script>
@endpush