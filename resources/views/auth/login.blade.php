<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
</head>

<body>

    <div class="container-fluid vh-100">
        <div class="row h-100 g-0">

            {{-- LEFT PANEL --}}
            <div class="col-lg-7 d-none d-lg-flex left-panel p-0">
                <img src="{{ asset('assets/logo-versi1-finalized.png') }}" alt="Logo">
            </div>

            {{-- RIGHT PANEL --}}
            <div class="col-12 col-lg-5 right-panel p-0">

                <div class="login-box">

                    <h2 class="text-center mb-4">Log In</h2>

                    {{-- SESSION STATUS --}}
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- ERROR --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            Email atau Password salah
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        {{-- EMAIL --}}
                        <div class="mb-3">
                            <label class="form-label">Email</label>

                            <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                                placeholder="Enter your email" required autofocus autocomplete="username">
                        </div>

                        {{-- PASSWORD --}}
                        <div class="mb-3">
                            <label class="form-label">Password</label>

                            <input type="password" name="password" class="form-control"
                                placeholder="Enter your password" required autocomplete="current-password">
                        </div>

                        {{-- REMEMBER --}}
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember_me">

                            <label class="form-check-label" for="remember_me">
                                Remember Me
                            </label>
                        </div>

                        {{-- FORGOT PASSWORD --}}
                        @if (Route::has('password.request'))
                            <div class="text-end mb-3">
                                <a href="{{ route('password.request') }}" class="forgot-password">
                                    Forgot Password?
                                </a>
                            </div>
                        @endif

                        {{-- BUTTON --}}
                        <button type="submit" class="btn login-btn w-100">
                            Log In
                        </button>

                    </form>

                    {{-- REGISTER --}}
                    <p class="text-center mt-4 register-text">
                        Don’t have an account?
                        <a href="{{ route('register') }}">Register</a>
                    </p>

                </div>

            </div>

        </div>
    </div>

</body>

</html>
