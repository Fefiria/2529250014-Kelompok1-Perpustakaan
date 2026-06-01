@extends('layouts.main')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/extensions/choices.js/public/assets/styles/choices.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bukuDisplay.css') }}">
@endpush

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>List Buku</h3>
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
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Daftar Buku</h4>
                        <a href="{{ route('buku.create') }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-plus-circle"></i> Tambah Buku
                        </a>
                    </div>

                    <div class="card-body border-bottom border-secondary pb-3">
                        <form action="{{ route('buku.index') }}" method="GET" id="form-filter-buku">
                            <input type="hidden" name="is_searching" id="is_searching" value="{{ request('is_searching', 'false') }}">

                            <div class="row g-3">
                                <div class="col-md-6 col-12">
                                    <label class="form-label text-white fw-bold small mb-1">Cari Buku menggunakan Judul/Author</label>
                                    <div class="input-group">
                                        <span class="input-group-text border-secondary text-muted search-addon d-flex align-items-center justify-content-center"><i class="bi bi-search"></i></span>
                                        <input type="text" class="form-control border-secondary text-white custom-search-input" id="search-buku" name="search" value="{{ request('search') }}" placeholder="Ketik judul buku atau nama pengarang...">
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <label class="form-label text-white fw-bold small mb-1">Tampil buku berdasarkan kategori</label>
                                    <select class="choices form-select" name="idGenre[]" id="filter-genre" multiple="multiple" onchange="submitForm('false')">
                                        @foreach($genres as $g)
                                            <option value="{{ $g->idGenre }}" 
                                                {{ is_array(request('idGenre')) && in_array($g->idGenre, request('idGenre')) ? 'selected' : '' }}>
                                                {{ $g->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>

                    @if($bukus->isEmpty())
                        <div class="card-body text-center py-5">
                            <i class="bi bi-journal-bookmark text-muted" style="font-size: 3rem;"></i>
                            <p class="mt-2 text-white">Buku tidak ditemukan</p>
                            @if(!request('search') && !request('genreIds'))
                                <a href="{{ route('buku.create') }}" class="btn btn-primary align-items-center gap-2 btn-sm">
                                    <i class="bi bi-plus-circle-fill"></i> Tambah Buku
                                </a>
                            @endif
                        </div>
                    @else
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-lg align-middle">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%">NO</th>
                                            <th style="width: 15%">COVER</th>
                                            <th style="width: 20%">JUDUL</th>
                                            <th style="width: 10%">AUTHOR</th>
                                            <th style="width: 20%">GENRE</th>
                                            <th style="width: 10%">STATUS</th>
                                            <th style="width: 15%">STOK</th>
                                            <th style="width: 15%">AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($bukus as $index => $buku)
                                        <tr>
                                            <td class="text-bold-500">{{ $bukus->firstItem() + $index }}</td>
                                            <td>
                                                @if($buku->photoUrl)
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#coverModal{{ $buku->idBuku }}">
                                                        <img src="{{ $buku->photoUrl }}" alt="Cover {{ $buku->judul }}" class="rounded shadow-sm" style="width: 60px; height: 80px; object-fit: cover; object-position: center;" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $buku->judul }}">
                                                    </a>
                                                @else
                                                    <img src="https://images.unsplash.com/photo-1543002588-bfa74002ed7e?w=200&auto=format&fit=crop&q=60" alt="Default Cover" class="rounded shadow-sm" style="width: 60px; height: 80px; object-fit: cover; object-position: center;">
                                                @endif
                                            </td>
                                            <td class="text-bold-200 text-white">{{ $buku->judul }}</td>
                                            <td class="text-bold-200">{{ $buku->pengarang }}</td>
                                            <td>
                                                <div class="d-flex flex-wrap gap-1">
                                                    @foreach($buku->genre as $genre)
                                                        <span class="badge bg-light-primary text-primary text-xs mb-1">
                                                            {{ $genre->nama }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge {{ $buku->status == 'tersedia' ? 'bg-success' : 'bg-danger' }} text-white text-xs">
                                                    {{ ucwords($buku->status) }}
                                                </span>
                                            </td>
                                            <td class="text-bold-200">{{ $buku->stok }} Buku</td>
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

                                        <div class="modal fade" id="coverModal{{ $buku->idBuku }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content bg-dark border-secondary text-white">
                                                    <div class="modal-header border-secondary">
                                                        <h5 class="modal-title">{{ $buku->judul }}</h5>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center p-4">
                                                        <img src="{{ $buku->photoUrl }}" alt="Cover {{ $buku->judul }}" class="img-fluid rounded shadow-lg" style="max-height: 500px; object-fit: contain;">                    
                                                        <p class="text-muted mt-3 mb-0" style="font-size: 0.85rem;">Author: {{ $buku->pengarang }}</p>
                                                    </div>
                                                    <div class="modal-footer border-secondary">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center align-items-center mt-3">
                                {{ $bukus->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts') 
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('form-filter-buku');
            const searchInput = document.getElementById('search-buku');
            const genreSelect = document.getElementById('filter-genre');
            const isSearchingInput = document.getElementById('is_searching');

            if (genreSelect) {
                const choices = new Choices(genreSelect, {
                    removeItemButton: true,
                    placeholder: true,
                    placeholderValue: 'Pilih kategori...',
                    searchPlaceholderValue: 'Cari kategori...',
                    shouldSort: false,
                    itemSelectText: '',
                });

                genreSelect.addEventListener('change', function() {
                    if (isSearchingInput) isSearchingInput.value = 'false';
                    form.submit();
                });
            }

            let delayTimer;
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    if (isSearchingInput) isSearchingInput.value = 'true';
                    clearTimeout(delayTimer);
                    delayTimer = setTimeout(function() {
                        form.submit(); 
                    }, 500);
                });

                if (isSearchingInput && isSearchingInput.value === 'true') {
                    const strLength = searchInput.value.length;
                    searchInput.focus();
                    searchInput.setSelectionRange(strLength, strLength);
                }
            }
        });
    </script>
@endpush