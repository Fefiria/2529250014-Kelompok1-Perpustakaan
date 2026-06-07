@extends('layouts.auth')

@section('content')
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <img src="{{ asset('assets/compiled/png/logo.png' )}}" alt="Logo">
                    </div>
                    <h1 class="auth-title">Register</h1>
                    <p class="auth-subtitle mb-5">Input your data to register to our website.</p>
                    <form method="POST" action="{{ route('register') }}" onsubmit="tampilLoadingAnimation()">
                        @csrf

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

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" name="nama" class="form-control form-control-xl" value="{{ old('nama') }}" placeholder="Masukkan nama">
                            <div class="form-control-icon">
                                <i class="bi bi-person-circle"></i>
                            </div>
                        </div>

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" name="username" class="form-control form-control-xl" value="{{ old('username') }}" placeholder="Masukkan username">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="email" name="email" class="form-control form-control-xl" value="{{ old('email') }}" autocomplete="email" placeholder="Masukkan email">
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div>

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" name="nomorTelp" class="form-control form-control-xl" value="{{ old('nomorTelp') }}" placeholder="Masukkan nomor telepon">
                            <div class="form-control-icon">
                                <i class="bi bi-phone"></i>
                            </div>
                        </div>

                        <div class="form-group position-relative mb-4">
                            <div class="input-group" style="height: 53px;"> 
                                <span class="input-group-text bg-white border-end-0 text-muted d-flex align-items-center justify-content-center" style="border-top-left-radius: 0.7rem; border-bottom-left-radius: 0.7rem; width: 50px; padding: 0 !important;">
                                    <i class="bi bi-person fs-4 d-flex align-items-center justify-content-center" style="line-height: 0;"></i>
                                </span>
                                
                                <select name="jenisKelamin" class="form-select form-control-xl border-start-0" style="border-top-right-radius: 0.7rem; border-bottom-right-radius: 0.7rem; padding-left: 0.5rem; font-size: 1.1rem; height: 100%;">
                                    <option value="" disabled {{ old('jenisKelamin') ? '' : 'selected' }}>Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki" {{ old('jenisKelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('jenisKelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" name="alamat" class="form-control form-control-xl" value="{{ old('alamat') }}" placeholder="Masukkan alamat">
                            <div class="form-control-icon">
                                <i class="bi bi-building"></i>
                            </div>
                        </div>
                        
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" name="password" class="form-control form-control-xl" required autocomplete="current-password" placeholder="Masukkan password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" name="password_confirmation" class="form-control form-control-xl" required autocomplete="current-password" placeholder="Masukkan password sekali lagi untuk konfirmasi">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-check"></i>
                            </div>
                        </div>

                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5" id="btn-login" type="submit">
                            <span id="text-login">Daftar</span>
                            <div id="spinner-login" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></div>                   
                            <span id="text-loading" class="d-none">Loading...</span> 
                        </button>
                    </form>
                    
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class="text-gray-600">Sudah punya akun? 
                            <a href="{{ route('login') }}" class="font-bold">
                                Login
                            </a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right"></div>
            </div>
        </div>
    </div>
@endsection
