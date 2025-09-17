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
        $userSetting = auth()->check() ? App\Models\Setting::where('user_id', auth()->id())->first() : null;
    @endphp
    <title>{{ $setting->app_name ?? '' }}</title>
     @dd($setting->favicon);
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
            var screenLockEnabled = {{ auth()->check() ? (($userSetting && ($userSetting->screen_lock ?? false)) ? 'true' : 'false') : 'false' }};
            var minutes = {{ auth()->check() ? (int)($userSetting->screen_lock_minutes ?? 0) : 0 }};
            if (!screenLockEnabled || !minutes) { return; }

            var ms = minutes * 60 * 1000;
            var timerId;
            function showLock() {
                var overlay = document.getElementById('lockOverlay');
                if (overlay) {
                    overlay.style.display = 'flex';
                    var input = document.getElementById('unlockPassword');
                    if (input) input.focus();
                }
            }
            function hideLock() {
                var overlay = document.getElementById('lockOverlay');
                if (overlay) overlay.style.display = 'none';
            }
            function resetTimer() {
                if (timerId) clearTimeout(timerId);
                var overlay = document.getElementById('lockOverlay');
                if (overlay && overlay.style.display === 'flex') return; // don't reset when locked
                timerId = setTimeout(showLock, ms);
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
<style>
    #lockOverlay {
        position: fixed;
        inset: 0;
        background: rgba(15, 27, 61, 0.9);
        backdrop-filter: blur(6px);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    }
    #lockCard {
        background: #fff;
        border-radius: 12px;
        padding: 24px;
        width: 100%;
        max-width: 380px;
        box-shadow: 0 8px 28px rgba(0,0,0,0.15);
        text-align: center;
    }
    #lockCard h3 { margin-bottom: 8px; color: #0f1b3d; }
    #lockCard p { margin-bottom: 16px; color: #4a5568; }
    #lockCard input[type="password"] { width: 100%; margin-bottom: 12px; }
    #lockError { color: #e53935; display: none; margin-bottom: 8px; font-size: 14px; }
    .lock-actions { display: flex; gap: 8px; justify-content: center; }
    .lock-actions .btn { min-width: 110px; }
    .lock-avatar { width: 64px; height: 64px; border-radius: 50%; margin: 0 auto 12px; background: #eef2f7; display:flex; align-items:center; justify-content:center; font-size:28px; color:#0f1b3d; }
  </style>
  <div id="lockOverlay">
    <div id="lockCard">
      <div class="lock-avatar"><i class="bi bi-lock"></i></div>
      <h3>Screen Locked</h3>
      <p>Enter your password to continue</p>
      <div id="lockError">Incorrect password. Try again.</div>
      <input id="unlockPassword" type="password" class="form-control" placeholder="Password" autocomplete="current-password">
      <div class="lock-actions">
        <button id="unlockBtn" class="btn btn-primary">Unlock</button>
        <form id="forceLogoutForm" method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn btn-outline-secondary">Logout</button>
        </form>
      </div>
    </div>
  </div>
<script>
  (function() {
    var overlay = document.getElementById('lockOverlay');
    var unlockBtn = document.getElementById('unlockBtn');
    var pwd = document.getElementById('unlockPassword');
    var err = document.getElementById('lockError');
    function submitUnlock() {
      if (!pwd.value) return;
      fetch('{{ route('user.unlockScreen') }}', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') },
        body: JSON.stringify({ password: pwd.value })
      }).then(function(r){ return r.json(); }).then(function(res){
        if (res && res.ok) {
          err.style.display = 'none';
          pwd.value = '';
          overlay.style.display = 'none';
          // restart idle timer after unlock
          document.dispatchEvent(new Event('mousemove'));
        } else {
          err.style.display = 'block';
        }
      }).catch(function(){ err.style.display = 'block'; });
    }
    if (unlockBtn) unlockBtn.addEventListener('click', submitUnlock);
    if (pwd) pwd.addEventListener('keydown', function(e){ if (e.key === 'Enter') submitUnlock(); });
  })();
</script>
</html>