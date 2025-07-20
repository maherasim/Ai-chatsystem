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
	<meta name="twitter:image" content="assets/img/meta-image.jpg">
	<meta name="twitter:image:alt" content="">

	<meta property="og:url" content="Template Landing Page URL">
	<meta property="og:title" content="Template Titlte">
	<meta property="og:description" content="Template Content">
	<meta property="og:image" content="/assets/img/meta-image.jpg">
	<meta property="og:image:secure_url" content="assets/img/meta-image.jpg">
	<meta property="og:image:type" content="image/png">
	<meta property="og:image:width" content="1200">
	<meta property="og:image:height" content="600">

	<title>Dreamchat - Dashboard</title>

	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="{{URL::asset('assets/img/favicon.png')}}">

    @include('layout.partials.head_admin')
</head>
@if(!Route::is(['forgot-password','login','reset-password-success','reset-password']))
<body>
@endif
	@if(Route::is(['forgot-password','login','reset-password-success','reset-password']))
	<body class="login-form">
	@endif
	
    @if(Route::is(['index_admin']))
    <div id="global-loader">
		<div class="page-loader"></div>
	</div>
    @endif
    
	@if(!Route::is(['forgot-password','login','reset-password-success','reset-password']))
      <div class="main-wrapper">
	@endif
	@if(Route::is(['forgot-password','login','reset-password-success','reset-password']))
	<div class="main-wrapper register-surv">
		@endif
		@if(!Route::is(['forgot-password','login','reset-password-success','reset-password']))
        @include('layout.partials.header_admin')
        @include('layout.partials.sidebar_admin')
		@endif
       @yield('content')
      </div>
		
    <!-- /Main Wrapper -->
	
    @include('layout.partials.footer_admin-script')
	
</body>
</html>