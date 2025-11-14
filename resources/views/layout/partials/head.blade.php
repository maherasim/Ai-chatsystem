   
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
   <!-- Genos font (for consistent header typography) -->
   <link href="https://fonts.googleapis.com/css2?family=Genos:wght@400;600;700&display=swap" rel="stylesheet">
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

     /* Standardize chat header across pages and apply Genos font */
     .chat .chat-header,
     .chat .chat-header * {
       font-family: 'Genos', sans-serif;
     }
     .chat .chat-header {
       display: -webkit-flex;
       display: flex;
       -webkit-justify-content: space-between;
       justify-content: space-between;
       padding: 15px 24px;
       align-items: center;
       border-bottom: 1px solid #F8F9FB;
       background: #FFF;
       position: relative;
     }
     .chat .chat-header .user-details {
       display: -webkit-flex;
       display: flex;
       -webkit-align-items: center;
       align-items: center;
     }
     .chat .chat-header .user-details h6 {
       font-size: 15px;
       font-weight: 600;
       margin-bottom: 4px;
       line-height: 1;
       color: #141B27;
     }
     .chat .chat-header .last-seen {
       font-size: 12px;
       opacity: .85;
     }
     .chat .chat-header .chat-options ul {
       margin-bottom: 0;
       display: -webkit-flex;
       display: flex;
       -webkit-align-items: center;
       align-items: center;
     }
     .chat .chat-header .chat-options ul > li > a {
       font-size: 14px;
       color: #141B27;
       cursor: pointer;
       width: 40px;
       height: 40px;
       padding: 0;
       border: none;
       display: -webkit-flex;
       display: flex;
       -webkit-align-items: center;
       align-items: center;
       -webkit-justify-content: center;
       justify-content: center;
     }
     .chat .chat-header .chat-options ul > li > a i {
       font-size: 20px;
     }
     .chat .chat-header .chat-options ul > li > a:not(.no-bg):hover {
       background-color: #D0D1D4;
       border-color: #D0D1D4;
     }
   </style>