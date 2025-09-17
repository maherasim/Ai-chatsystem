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
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php
        $setting = App\Models\Setting::first();
    @endphp
    <title>{{ $setting->app_name ?? '' }}</title>
     
    <!-- Favicon -->
    <link rel="icon" href="{{ $setting->favicon ?? asset('/build/img/gallery/gallery-01.jpg') }}" class="rounded-circle">
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
<script>
    (function() {
        try {
            var screenLockEnabled = {{ auth()->check() ? ((App\Models\Setting::where('user_id', auth()->id())->first()->screen_lock ?? false) ? 'true' : 'false') : 'false' }};
            var minutes = {{ auth()->check() ? (int)(App\Models\Setting::where('user_id', auth()->id())->first()->screen_lock_minutes ?? 0) : 0 }};
            if (!screenLockEnabled || !minutes) { return; }

            var ms = minutes * 60 * 1000;
            var timerId;

            function resetTimer() {
                if (timerId) clearTimeout(timerId);
                timerId = setTimeout(function() {
                    try {
                        var form = document.createElement('form');
                        form.method = 'POST';
                        form.action = '{{ route('logout') }}';
                        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                        var input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = '_token';
                        input.value = token;
                        form.appendChild(input);
                        document.body.appendChild(form);
                        form.submit();
                    } catch (e) {
                        window.location.href = '{{ url('/login') }}';
                    }
                }, ms);
            }

            ['click','mousemove','keydown','scroll','touchstart','touchmove','visibilitychange'].forEach(function(evt) {
                window.addEventListener(evt, resetTimer, { passive: true });
            });
            resetTimer();
        } catch (_) {}
    })();
    // Toggle minutes field visibility live on change
    (function(){
        var checkbox = document.querySelector('#screen-lock-form input[name="screen_lock"]');
        var panel = document.getElementById('screen-lock-minutes');
        if (checkbox && panel) {
            checkbox.addEventListener('change', function(){
                panel.style.display = this.checked ? 'block' : 'none';
            });
        }
    })();
</script>
</html>