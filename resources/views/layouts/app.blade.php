<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="images/logo-stir-zwart.png">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;700&family=Rubik:wght@400;500;700&display=swap"
        rel="stylesheet">

    <!-- Plugins CSS -->
    <link rel="stylesheet" type="text/css" href="../vendor/font-awesome/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../vendor/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="../vendor/tiny-slider/tiny-slider.css">
    <script src="../vendor/vanilla-lazyload/lazyload.min.js"></script>

    <link id="style-switch" rel="stylesheet" type="text/css" href="../css/style.css">


    <!-- Scripts -->
    @vite(['resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <div class="preloader">
        <div class="preloader-item">
            <div class="spinner-grow text-primary"></div>
        </div>
    </div>
    <x-navigation />

    <main>
        @yield('content')
    </main>

    <x-footer />

    <!-- Back to top -->
    <div class="back-top"><i class="bi bi-arrow-up-short"></i></div>

    <!-- Bootstrap JS -->
    <script src="../vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Vendors -->
    <script src="../vendor/tiny-slider/tiny-slider.js"></script>

    <!-- Template Functions -->
{{--    <script src="../js/functions.js"></script>--}}
    @vite(['resources/js/functions.js'])
    @livewireScripts
</body>

</html>
