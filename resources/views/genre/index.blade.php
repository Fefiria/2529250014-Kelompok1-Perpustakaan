@extends('layouts.main')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>List Genre</h3>
                <p class="text-subtitle text-muted">Gunakan halaman ini untuk melihat daftar genre.</p>
            </div>
            
            <div class="col-12 col-md-6 order-md-2 order-first d-flex flex-column align-items-start align-items-md-end justify-content-between">
                
                <nav aria-label="breadcrumb" class="breadcrumb-header mb-3 mb-md-0">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">List Genre</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card">
                        @if($genres->isEmpty())
                            <p>Belum ada genre yang ditambahkan</p>
                            <a href="{{ route('genre.create') }}" class="btn btn-primary align-items-center gap-2">
                                <i class="bi bi-plus-circle-fill"></i>
                                <span>Tambah Genre</span>
                            </a>
                        @else
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="card-title">Daftar Genre</h4>
                                <a href="{{ route('genre.create') }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-plus-circle"></i> Tambah Genre
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-lg">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%">NO</th>
                                                <th style="width: 25%">NAMA GENRE</th>
                                                <th style="width: 40%">DESKRIPSI GENRE</th>
                                                <th style="width: 15%">JUMLAH BUKU</th>
                                                <th style="width: 15%">AKSI</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($genres as $index => $genre)
                                            <tr>
                                                <td class="text-bold-500">{{ $genres->firstItem() + $index}}</td>
                                                <td class="text-bold-500">{{ $genre->nama }}</td>
                                                <td class="text-bold-200">{{ $genre->deskripsi }}</td>
                                                <td class="text-bold-200">{{ $genre->buku_count }}</td>
                                                <td class="d-flex align-items-center gap-2">
                                                    <a href="{{ route('genre.edit', $genre->idGenre )}}" class="btn btn-sm border text-primary" data-bs-toggle="tooltip"title="Edit Genre">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    </span>
                                                    <form method="POST" action="{{ route('genre.destroy', $genre->idGenre) }}" onsubmit="displayAlert(event, this, '{{ $genre->nama }}', 'warning')">
                                                        @csrf
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <button class="btn btn-sm border text-danger" type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Genre"><i class="bi bi-trash"></i></button>
                                                    </form> 
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex justify-content-center align-items-center">
                                    {{ $genres->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
