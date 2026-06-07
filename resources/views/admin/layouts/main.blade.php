<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookworm Library</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/static/images/logo/favicon.ico?v=2') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/iconly.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/extensions/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @stack('styles')
</head>

<body>
    <div id="app">

        @include('admin.layouts.sidebar')

        <div id="main">
            @yield('content')
        </div>
    </div>

    <script src="{{ asset('assets/extensions/sweetalert2/sweetalert2.all.js') }}"></script>
    <script src="{{ asset('assets/compiled/js/app.js') }}"></script>
    <script src="{{ asset('assets/static/js/initTheme.js') }}"></script>
    <script src="{{ asset('assets/static/js/components/dark.js') }}"></script>
    <script src="{{ asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/extensions/apexcharts/apexcharts.min.js') }}"></script> --}}
    <script src="{{ asset('assets/static/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('assets/extensions/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/date-picker.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>    
    @stack('scripts')

    @if(session('success'))
        <script>
            displayMessageAnimation('success', 'Sukses', @json(session('success')));
        </script>
    @elseif(session('failed'))
        <script>
            displayMessageAnimation('failed', 'Gagal', @json(session('failed')));
        </script>
    @endif
</body>

</html>
