<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container">

        <section class="left-panel">

        </section>

        <section class="right-panel">

            <div class="login-box">

                <h2 class="login-part-upper">Log In</h2><br>

                <form method="POST" action="{{ route('login') }}" class="login-text">
                    @csrf

                    <label>Email</label><br>

                    <input
                        type="email"
                        name="email"
                        placeholder="Email"
                        required
                    ><br><br>

                    <label>Password</label><br>

                    <input
                        type="password"
                        name="password"
                        placeholder="Password"
                        required
                    ><br><br>

                    <button type="submit">
                        Log In
                    </button>
                </form>

                <p class="login-part-lower">
                    Register?
                    <a href="{{ route('register') }}">
                        Register Here
                    </a>
                </p>

            </div>

        </section>

    </div>
</body>
</html>