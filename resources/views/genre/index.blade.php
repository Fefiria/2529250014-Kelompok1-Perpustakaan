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
                    <div class="card-body">
                        @if($genres->isEmpty())
                            <p>Belum ada genre yang ditambahkan</p>
                            <a href="{{ route('genre.create') }}" class="btn btn-primary align-items-center gap-2">
                                <i class="bi bi-plus-circle-fill"></i>
                                <span>Tambah Genre</span>
                            </a>
                        @else
                            <div class="table-responsive">
                                <table class="table table-lg">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%">NO</th>
                                            <th style="width: 30%">NAMA GENRE</th>
                                            <th style="width: 50%">DESKRIPSI GENRE</th>
                                            <th style="width: 15%">AKSI</th>
                                            Catatan Update Nanti: Jumlah Buku
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($genres as $index => $genre)
                                        <tr>
                                            <td class="text-bold-500">{{ $genres->firstItem() + $index}}</td>
                                            <td class="text-bold-500">{{ $genre->nama }}</td>
                                            <td class="text-bold-200">{{ $genre->deskripsi }}</td>
                                            <td class="d-flex align-items-center gap-2">
                                                <a class="btn btn-sm border text-primary" href="editgenre.html">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form method="POST" action="{{ route('genre.destroy', $genre->idGenre) }}" onsubmit="displayAlert(event, this, '{{ $genre->nama }}', 'warning')">
                                                    @csrf
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <button class="btn btn-sm border text-danger" type="submit"><i class="bi bi-trash"></i></button>
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
                        @endif
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
