   
    @if (!Route::is(['signup','signin','success','reset-password','otp','forgot-password']))
   <!-- Theme Script Js -->
   <script src="{{ URL::asset('/build/js/theme-script.js')}}"></script>
	@endif
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="{{ url('/build/css/bootstrap.min.css') }}">

   <!-- Feathericon CSS -->
   <link rel="stylesheet" href="{{ url('/build/css/feather.css') }}">
   
   <!-- Fontawesome CSS -->
   <link rel="stylesheet" href="{{ url('/build/plugins/fontawesome/css/fontawesome.min.css') }}">
   <link rel="stylesheet" href="{{ url('/build/plugins/fontawesome/css/all.min.css') }}">

   <!-- Swiper CSS -->
   <link rel="stylesheet" href="{{ url('/build/plugins/swiper/swiper.min.css') }}">

   <!-- FancyBox CSS -->
   <link rel="stylesheet" href="{{ url('/build/plugins/fancybox/jquery.fancybox.min.css') }}">

   <!-- TablerIcon CSS -->
   <link rel="stylesheet" href="{{ url('/build/plugins/tabler-icons/tabler-icons.min.css') }}">

   <!-- Select CSS -->
   <link rel="stylesheet" href="{{ url('/build/plugins/select2/css/select2.min.css') }}">

   <!-- Datetimepicker CSS -->
   <link rel="stylesheet" href="{{ url('/build/css/bootstrap-datetimepicker.min.css') }}">

  <!-- Style CSS -->
   <link rel="stylesheet" href="{{ url('/build/css/style.css') }}">
   <style>
     /* Global focus/active border override */
     .btn,
     .btn:focus,
     .btn:active,
     .btn:focus-visible,
     .btn.active,
     .btn.show,
     .btn:focus:not(:focus-visible),
     .btn-check:focus + .btn,
     .btn-check:checked + .btn,
     .btn-check:active + .btn,
     .form-control:focus,
     .form-select:focus,
     button:focus,
     button:active,
     a.btn:focus,
     a.btn:active {
       outline: none !important;
       box-shadow: none !important;
       border-color: transparent !important;
     }
   </style>