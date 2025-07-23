<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <meta name="description" content="Template Content">
    <meta name="keywords" content="Template Keywords">
    <meta name="author" content="Dreamguys - DreamsChat">

	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:site" content="@dreamguystech">
	<meta name="twitter:title" content="Template Content">
	<meta name="twitter:description" content="Template Content">
	<meta name="twitter:image" content="">
	<meta name="twitter:image:alt" content="">

	<meta property="og:url" content="Template Landing Page URL">
	<meta property="og:title" content="Template Titlte">
	<meta property="og:description" content="Template Content">
	<meta property="og:image" content="">
	<meta property="og:image:secure_url" content="">
	<meta property="og:image:type" content="image/png">
	<meta property="og:image:width" content="1200">
	<meta property="og:image:height" content="600">

	<title>LogiConn</title>

    <!-- Favicon -->
    <link rel="icon" href="{{URL::asset('/build/img/AI-Logo.svg')}}">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    @include('layout.partials.head')
</head>

<body>

    <!-- Main Wrapper -->
    @if (Route::is(['signup','signin','success','reset-password','otp','forgot-password']))
    <div class="main-wrapper d-block">
     @endif
     
     @if (!Route::is(['signup','signin','success','reset-password','otp','forgot-password']))
    <div class="main-wrapper">
     @endif
	
    @yield('content')

        
    </div>
		
    <!-- /Main Wrapper -->
	
    @include('layout.partials.footer-scripts')
	
</body>
</html>