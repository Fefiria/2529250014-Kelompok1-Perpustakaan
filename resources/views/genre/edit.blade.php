@extends('layouts.main')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit Genre</h3>
                <p class="text-subtitle text-muted">Gunakan halaman ini untuk mengedit genre.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Genre</li>
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
                        <form class="form" method="POST" action="{{ route('genre.update', $genre->idGenre) }}">
                            @method('PUT')
                            <div class="row gap-2">
                                <div class="col-12">
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
                                    <div class="form-group has-icon-left">
                                        <label for="nama-genre">Nama Genre</label>
                                        <div class="position-relative">
                                            <input type="text" id="nama-genre" class="form-control mt-1" value="{{ old('nama') ?? $genre->nama }}" name="nama">
                                            <div class="form-control-icon">
                                                <i class="bi bi-pencil-square"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="deskripsi-genre">Deskripsi Genre</label>
                                        <div class="position-relative">
                                            <input type="text" id="deskripsi-genre" class="form-control mt-1" value="{{ old('deskripsi') ?? $genre->deskripsi }}" name="deskripsi">
                                            <div class="form-control-icon">
                                                <i class="bi bi-card-heading"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end gap-2">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Edit Genre</button>
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
@endsection