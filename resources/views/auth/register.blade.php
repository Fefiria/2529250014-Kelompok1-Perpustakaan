<x-auth-layout>
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

                        @if($errors->get('username'))
                            <div class="alert alert-danger alert-dismissible show fade" role="alert">
                                Username ini telah dipakai, Gunakan username lain
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @elseif($errors->get('email'))
                            <div class="alert alert-danger alert-dismissible show fade" role="alert">
                                Email ini telah dipakai, Gunakan email lain
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @elseif($errors->get('password'))
                            @if(Str::contains($errors->first('password'), 'confirmation') || Str::contains($errors->first('password'), 'match'))
                                <div class="alert alert-danger alert-dismissible show fade" role="alert">
                                    Password dan konfirmasi password tidak sesuai
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @elseif(Str::contains($errors->first('password'), 'least'))
                                <div class="alert alert-danger alert-dismissible show fade" role="alert">
                                    Panjang password harus minimal 8 karakter
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                        @endif

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" name="nama" class="form-control form-control-xl" value="{{ old('nama') }}" required autofocus placeholder="Masukkan nama">
                            <div class="form-control-icon">
                                <i class="bi bi-person-circle"></i>
                            </div>
                        </div>

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" name="username" class="form-control form-control-xl" value="{{ old('username') }}" required autofocus placeholder="Masukkan username">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="email" name="email" class="form-control form-control-xl" value="{{ old('email') }}" required autofocus autocomplete="email" placeholder="Masukkan email">
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
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
</x-auth-layout>
