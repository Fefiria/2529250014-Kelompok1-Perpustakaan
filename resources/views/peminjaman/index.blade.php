@extends('layouts.main')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>List Buku</h3>
                <p class="text-subtitle text-muted">Gunakan halaman ini untuk melihat daftar buku.</p>
            </div>
            
            <div class="col-12 col-md-6 order-md-2 order-first d-flex flex-column align-items-start align-items-md-end justify-content-between">
                
                <nav aria-label="breadcrumb" class="breadcrumb-header mb-3 mb-md-0">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">List Buku</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        @if($bukus->isEmpty())
                            <p>Belum ada buku yang ditambahkan</p>
                            <a href="{{ route('buku.create') }}" class="btn btn-primary align-items-center gap-2">
                                <i class="bi bi-plus-circle-fill"></i>
                                <span>Tambah Buku</span>
                            </a>
                        @else
                            <div class="table-responsive">
                                <table class="table table-lg">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%">NO</th>
                                            <th style="width: 20%">COVER</th>
                                            <th style="width: 20%">JUDUL</th>
                                            <th style="width: 20%">GENRE</th>
                                            <th style="width: 20%">STATUS</th>
                                            <th style="width: 15%">AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($bukus as $index => $buku)
                                        <tr>
                                            <td class="text-bold-500">{{ $bukus->firstItem() + $index}}</td>
                                            <td>
                                                @if($buku->photoUrl)
                                                    <img src="{{ $buku->photoUrl }}" alt="Cover {{ $buku->judul }}" class="rounded shadow-sm" style="width: 60px; height: 80px; object-fit: cover; object-position: center;" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $buku->judul }}">
                                                @else
                                                    <img src="https://images.unsplash.com/photo-1543002588-bfa74002ed7e?w=200&auto=format&fit=crop&q=60" 
                                                        alt="Default Cover" 
                                                        class="rounded shadow-sm" 
                                                        style="width: 60px; height: 80px; object-fit: cover; object-position: center;">
                                                @endif
                                            </td>
                                            <td class="text-bold-200">{{ $buku->judul }}</td>
                                            <td>
                                                @foreach($buku->genre as $genre)
                                                    <span class="badge bg-light-primary text-primary text-xs mb-1">
                                                        {{ $genre->nama }}
                                                    </span>
                                                @endforeach
                                            </td>
                                            <td class="text-bold-200">
                                                @if($buku->status == 'tersedia')
                                                    <span class="badge bg-success text-white text-xs">
                                                        {{ ucwords($buku->status) }}
                                                    </span>
                                                @else
                                                    <span class="badge bg-danger text-white text-xs">
                                                        {{ ucwords($buku->status) }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    
                                                    <a href="{{ route('buku.edit', $buku->idBuku) }}" class="btn btn-sm border text-primary" data-bs-toggle="tooltip" title="Edit Buku">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>

                                                    <form method="POST" action="{{ route('buku.destroy', $buku->idBuku) }}" class="m-0" onsubmit="displayAlert(event, this, '{{ $buku->judul }}', 'warning')">
                                                        @csrf
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <button class="btn btn-sm border text-danger" type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Buku">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form> 
                                                    
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center align-items-center">
                                {{ $bukus->links('pagination::bootstrap-5') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
