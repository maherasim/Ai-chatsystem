<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Template Content">
    <meta name="keywords" content="Template Keywords">
    <meta name="author" content="Dreamguys - DreamsChat">

    <!-- OpenGraph / Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@dreamguystech">
    <meta name="twitter:title" content="Template Content">
    <meta name="twitter:description" content="Template Content">
    <meta property="og:url" content="Template Landing Page URL">
    <meta property="og:title" content="Template Title">
    <meta property="og:description" content="Template Content">
    <meta property="og:image" content="">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- CSRF -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LogiConn') }}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ URL::asset('/build/img/AI-Logo.svg') }}">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Extra head includes -->
    @include('layout.partials.head')
</head>
<body>
    <!-- Main Wrapper -->
    <div class="main-wrapper {{ Route::is(['signup','signin','success','reset-password','otp','forgot-password']) ? 'd-block' : '' }}">
        @yield('content')
    </div>
    <!-- /Main Wrapper -->

    <!-- Footer Scripts -->
    @include('layout.partials.footer-scripts')
</body>
</html>
