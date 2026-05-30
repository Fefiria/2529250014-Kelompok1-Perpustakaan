@extends('layouts.main')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/extensions/filepond/filepond.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/extensions/choices.js/public/assets/styles/choices.min.css') }}">
@endpush

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit Buku: {{ $buku->judul }}</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Buku</li>
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
                        <form class="form" method="POST" action="{{ route('buku.update', $buku->idBuku) }}" enctype="multipart/form-data">
                            @method("PUT")
                            @csrf
                            <div class="row gap-2">
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="judul-buku-column">Judul Buku</label>
                                        <div class="position-relative">
                                            <input type="text" id="judul-buku-column" class="form-control mt-1" placeholder="Masukkan judul buku..." name="judul" value="{{ old('judul') ?? $buku->judul }}">
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
                                            <input type="text" id="pengarang-column" class="form-control mt-1" placeholder="Masukkan pengarang buku..." name="pengarang" value="{{ old('pengarang') ?? $buku->pengarang }}">
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
                                            <input type="text" id="penerbit-column" class="form-control mt-1" placeholder="Masukkan penerbit buku..." name="penerbit" value="{{ old('penerbit') ?? $buku->penerbit }}">
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
                                            <input type="text" id="tanggal-terbit-column" class="form-control mb-3 flatpickr-no-config flatpickr-input mt-1" placeholder="Masukkan tanggal terbit buku..." name="tanggalTerbit" readonly="readonly" value="{{ old('tanggalTerbit') ?? $buku->tanggalTerbit }}">
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
                                            <input type="number" id="jumlah-halaman-column" class="form-control mt-1" placeholder="Masukkan jumlah halaman buku..." name="jumlahHalaman" value="{{ old('jumlahHalaman') ?? $buku->jumlahHalaman }}">
                                            <div class="form-control-icon">
                                                <i class="bi bi-123"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="status-column" class="form-label">Status</label>                                                                                        
                                        <div class="position-relative">
                                            <select id="status-column" class="form-control mt-1" name="status">
                                                <option value="tersedia" {{ (old('status') ?? $buku->status) == 'tersedia' ? 'selceted' : ''}}>Tersedia</option>
                                                <option value="tidaktersedia" {{ (old('status') ?? $buku->status) == 'tidak tersedia' ? 'selceted' : ''}}>Tidak Tersedia</option>
                                            </select>
                                            <div class="form-control-icon">
                                                <i class="bi bi-cart2"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="genre-column" class="form-label">Genre</label>                                                                                        
                                        <div class="position-relative">
                                            <select id="genre-column" class="choices form-control form-select mt-1" name="idGenre[]" multiple="multiple" data-placeholder="Pilih genre...">
                                                @foreach($genre as $dataGenre)
                                                    <option value="{{ $dataGenre->idGenre }}" 
                                                        {{ in_array($dataGenre->idGenre, old('idGenre', $buku->genre->pluck('idGenre')->toArray())) ? 'selected' : '' }}>
                                                        {{ $dataGenre->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label">Foto Buku</label>
                                        <input type="file" id="pond-cover" class="image-preview-filepond" name="photoUrl" accept="image/*" data-max-file-size="2MB">
                                        <small class="text-muted">Format yang didukung: JPG, JPEG, PNG. Maksimal 2MB.</small>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end gap-2">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Edit Buku</button>
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
                maxItemCount: -1,
                removeItemButton: true,
                allowHTML: true,
                searchFields: ['label', 'value']
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const inputElement = document.querySelector('#pond-cover');
            
            const pond = FilePond.create(inputElement, {
                credits: false,
                storeAsFile: true,
                name: 'photoUrl'        
            });

            @if($buku->photoUrl)
                pond.setOptions({
                    files: [
                        {
                            source: '{{ $buku->photoUrl }}',
                            options: {
                                type: 'local',
                            }
                        }
                    ],
                    server: {
                        load: (source, load, error, progress, abort, headers) => {
                            fetch(`/buku/proxy-cover?url=${encodeURIComponent(source)}`)
                                .then(res => res.blob())
                                .then(load)
                                .catch(error);
                        }
                    }
                });
            @endif
        });
    </script>
@endpush