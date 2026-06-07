@extends('admin.layouts.main')

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
                        <form action="{{ route('admin.peminjaman.store') }}" method="POST">
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
                                                        <option value="{{ $user->idUser }}">{{ $user->nama }} - ({{ $user->username }})</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="form-label">Tanggal Pinjam</label>
                                                <input type="text" class="form-control flatpickr-no-config" name="tanggalPinjam" placeholder="Pilih Tanggal..">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="form-label">Lama Pinjam (Hari)</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" name="lamaPinjam" min="1" placeholder="Contoh: 7" required>
                                                    <span class="input-group-text">Hari</span>
                                                </div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="form-label">Catatan / Keterangan <small class="text-muted">(Opsional)</small></label>
                                                <textarea class="form-control" name="keterangan" rows="3" placeholder="Tulis catatan tambahan jika ada..."></textarea>
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
                                                        @if($dataBuku->stok > 0)
                                                            <option value="{{ $dataBuku->idBuku }}">{{ $dataBuku->judul }} (Tersedia: {{ $dataBuku->stok }})</option>
                                                        @else
                                                            <option value="{{ $dataBuku->idBuku }}" disabled>{{ $dataBuku->judul }} (Tidak Tersedia: 0)</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <small class="text-muted mt-1 d-block">Petunjuk: Klik atau ketik untuk menambah lebih dari 1 buku.</small>
                                            </div>

                                            <hr>

                                            <div class="d-flex justify-content-end gap-2 mt-4">
                                                <button type="submit" class="btn btn-success">Tambah Peminjaman</button>
                                                <a href="{{ route('admin.peminjaman.index') }}" class="btn btn-light-secondary">Batal</a>
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
    <script src="{{ asset('assets/extensions/choices.js/public/assets/scripts/choices.min.js') }}"></script>
    <script>
        let choicesInput = document.querySelectorAll('.choices');
        let initChoices;
        for (let i = 0; i < choicesInput.length; i++) {
            initChoices = new Choices(choicesInput[i], {
                delimiter: ',',
                editItems: true,
                maxItemCount: -1,
                removeItemButton: true,
                allowHTML: true,
                searchFields: ['label', 'value']
            });
        }
    </script>
@endpush