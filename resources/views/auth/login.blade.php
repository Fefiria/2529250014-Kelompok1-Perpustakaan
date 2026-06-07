@extends('layouts.auth')

@section('content')
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="col-4">
                        <img src="{{ asset('assets/compiled/png/logo.png' )}}" alt="Logo" class="w-100">
                    </div>
                    <h1 class="auth-title">Log in.</h1>
                    <p class="auth-subtitle mb-5">Log in with your data that you entered during registration.</p>

                    <form method="POST" action="{{ route('login') }}" onsubmit="tampilLoadingAnimation()">
                        @csrf

                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible show fade" role="alert">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{  $error }}</li>
                                    @endforeach 
                                </ul> 
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="email" name="email" class="form-control form-control-xl" value="{{ old('email') }}" required autofocus autocomplete="email" placeholder="Masukkan email">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" name="password" class="form-control form-control-xl" required autocomplete="current-password" placeholder="Masukkan password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>

                        <div class="form-check form-check-lg d-flex align-items-end">
                            <input class="form-check-input me-2" type="checkbox" id="formRememberMe" name="remember">
                            <label class="form-check-label text-gray-600" for="formRememberMe">
                                Ingatkan Saya
                            </label>
                        </div>

                        <button id="btn-login" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">
                            <span id="text-login">Login</span>
                            <div id="spinner-login" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></div>                   
                            <span id="text-loading" class="d-none">Loading...</span>     
                        </button>
                    </form>
                    
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class="text-gray-600">Belum punya akun? 
                            <a href="{{ route('register') }}" class="font-bold">
                                Sign up
                            </a>
                        </p>
                        <p>
                            <a class="font-bold" href="{{ route('password.request') }}">
                                Lupa password?
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