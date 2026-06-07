@extends('admin.layouts.main');

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit Profile: {{ $user->nama }}</h3>
            </div>
        </div>
    </div>
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
    <section class="section mt-2">
        <form action="{{ route('admin.user.update', $user->idUser) }}" method="POST" enctype="multipart/form-data" onsubmit="tampilLoadingAnimation()">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="card text-center py-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-center mb-3">
                                <div class="position-relative">
                                    <img id="profile-avatar" src="{{ $user->photoUrl ?? asset('assets/compiled/jpg/1.jpg') }}" alt="Profile Picture" class="rounded-circle img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="avatar-input" class="btn btn-sm btn-primary me-2 cursor-pointer mb-0">
                                    <i class="bi bi-upload"></i> Ganti Foto
                                </label>
                                <input type="file" id="avatar-input" name="avatar" class="d-none" accept="image/*">
                                
                                <button type="button" id="btn-delete-avatar" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </div>

                            <input type="hidden" id="is-avatar-deleted" name="is_avatar_deleted" value="0">

                            <hr class="border-secondary opacity-25">

                            <h4 class="mt-3 text-dark-theme-white fw-bold mb-1">{{ $user->nama }}</h4>
                            <p class="text-muted fs-6">@<span>{{ $user->username }}</span></p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Informasi Anggota</h4>
                        </div>
                        <div class="card-body">
                            
                            <!-- 1. EDIT NAMA -->
                            <div class="form-group mb-3">
                                <label for="name" class="form-label text-muted fw-semibold">Nama Lengkap</label>
                                <input type="text" id="name" name="nama" class="form-control form-control-lg" value="{{ old('nama', $user->nama) }}">
                            </div>

                            <!-- 2. EDIT USERNAME -->
                            <div class="form-group mb-3">
                                <label for="username" class="form-label text-muted fw-semibold">Username</label>
                                <input type="text" id="username" name="username" class="form-control form-control-lg" value="{{ old('username', $user->username) }}">
                            </div>

                            <!-- 3. EDIT EMAIL -->
                            <div class="form-group mb-3">
                                <label for="email" class="form-label text-muted fw-semibold">Email</label>
                                <input type="email" id="email" name="email" class="form-control form-control-lg" value="{{ old('email', $user->email) }}">
                            </div>

                            <div class="row">
                                <!-- 4. EDIT NOMOR TELEPON -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group mb-3">
                                        <label for="no_telp" class="form-label text-muted fw-semibold">Nomor Telepon</label>
                                        <input type="text" id="no_telp" name="nomorTelp" class="form-control form-control-lg" value="{{ old('nomorTelp', $user->nomorTelp) }}">
                                    </div>
                                </div>

                                <!-- 5. EDIT JENIS KELAMIN -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group mb-3">
                                        <label for="jenis_kelamin" class="form-label text-muted fw-semibold">Jenis Kelamin</label>
                                        <select id="jenis_kelamin" name="jenisKelamin" class="form-select form-control-lg">
                                            <option value="Laki-laki" {{ old('jenis_kelamin', $user->jenisKelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="Perempuan" {{ old('jenis_kelamin', $user->jenisKelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- 6. EDIT ALAMAT -->
                            <div class="form-group mb-4">
                                <label for="alamat" class="form-label text-muted fw-semibold">Alamat</label>
                                <textarea id="alamat" name="alamat" class="form-control" rows="3" placeholder="Masukkan alamat...">{{ old('alamat', $user->alamat) }}</textarea>
                            </div>
                            
                            
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.user.index') }}" class="btn btn-light-secondary fw-semibold">
                                    <i class="bi bi-arrow-left me-1"></i> Kembali ke List
                                </a>
                                <button id="editUser" type="submit" class="btn btn-primary px-4 py-2 fw-semibold">
                                    <span id="textSimpan">
                                        <i class="bi bi-check-circle me-1"></i> Simpan Perubahan
                                    </span>
                                    <div id="spinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></div>                   
                                    <span id="text-loading" class="d-none">Loading...</span>   
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
</div>
@endsection

@push('scripts')
    <script>
        function tampilLoadingAnimation(){
            const button = document.getElementById('editUser');
            const textSimpan = document.getElementById('textSimpan');
            const animasi = document.getElementById('spinner');
            const textLoading = document.getElementById('text-loading');
            
            button.disabled = true;
            textSimpan.classList.add('d-none');

            animasi.classList.remove('d-none');
            textLoading.classList.remove('d-none');
        }

        const avatarInput = document.getElementById('avatar-input');
        const profileAvatar = document.getElementById('profile-avatar');
        const btnDeleteAvatar = document.getElementById('btn-delete-avatar');
        const isAvatarDeleted = document.getElementById('is-avatar-deleted');

        const defaultAvatarUrl = "{{ asset('assets/compiled/jpg/1.jpg') }}";
        if(avatarInput) {
            avatarInput.addEventListener('change', function () {
                if(this.files && this.files[0]) {
                    const reader = new FileReader();
                    
                    reader.onload = function (e) {
                        profileAvatar.src = e.target.result;
                        isAvatarDeleted.value = "0"; 
                    }
                    
                    reader.readAsDataURL(this.files[0]);
                }
            });
        }

        if(btnDeleteAvatar) {
            btnDeleteAvatar.addEventListener('click', function () {
                profileAvatar.src = defaultAvatarUrl;
                isAvatarDeleted.value = "1";
                avatarInput.value = ""; 
            });
        }
    </script>
@endpush