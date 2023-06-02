<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- admin template --}}
    <link rel="stylesheet" href="{{ asset('assets/admin-style/css/portal.css') }}">
</head>

<body>
    <div id="app">

        @yield('section')
        <main class="py-4">
            @yield('content')
        </main>
    </div>


    <!-- Javascript -->
    <script src="{{ asset('assets/admin-style/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('assets/admin-style/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/admin-style/js/app.js') }}"></script>

    <!-- Charts JS -->
    <script src="{{ asset('assets/admin-style/plugins/chart.js/chart.min.js') }}"></script>
    <script src="{{ asset('assets/admin-style/js/index-charts.js') }}"></script>
</body>

</html>
