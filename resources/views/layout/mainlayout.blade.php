<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <meta name="description" content="Template Content">
    <meta name="keywords" content="Template Keywords">
    <meta name="author" content="Dreamguys - DreamsChat">

    <!-- Social / SEO -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@dreamguystech">
    <meta property="og:title" content="Template Title">
    <meta property="og:description" content="Template Content">

    <!-- CSRF -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LogiConn') }}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('build/img/AI-Logo.svg') }}">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Project CSS (stored in /public/build/css/) -->
    <link rel="stylesheet" href="{{ asset('build/css/style.css') }}">

    @include('layout.partials.head')
</head>
<body>
    <!-- Main Wrapper -->
    <div class="main-wrapper {{ Route::is(['signup','signin','success','reset-password','otp','forgot-password']) ? 'd-block' : '' }}">
        @yield('content')
    </div>
    <!-- /Main Wrapper -->

    <!-- Project JS (stored in /public/build/js/) -->
    <script src="{{ asset('build/js/script.js') }}"></script>

    @include('layout.partials.footer-scripts')
</body>
</html>
