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
@php
  $overlaySetting = App\Models\Setting::first();
  $ovImages = $overlaySetting && $overlaySetting->login_backgrounds ? json_decode($overlaySetting->login_backgrounds, true) : [];
  $ovIdx = $overlaySetting->selected_login_background ?? null;
  $ovCandidate = ($ovIdx !== null && array_key_exists($ovIdx, $ovImages)) ? $ovImages[$ovIdx] : null;
  if (!$ovCandidate || !is_string($ovCandidate) || $ovCandidate === '') {
      foreach ($ovImages as $img) { if ($img) { $ovCandidate = $img; break; } }
  }
  $overlayBgSrc = $ovCandidate ? asset($ovCandidate) : URL::asset('/build/img/bg/chatlogo.jpg');
@endphp
<style>
  #lockOverlay { position: fixed; inset: 0; background: rgba(15, 27, 61, 0.9); backdrop-filter: blur(10px); display: none; align-items: center; justify-content: center; z-index: 9999; }
  #lockCard { background: transparent; border-radius: 16px; padding: 24px; width: 100%; max-width: 460px; text-align: center; }
  #lockBackground { position: absolute; inset: 0; overflow: hidden; z-index: 0; }
  #lockBackgroundImage { position: absolute; inset: 0; background-image: url('{{ $overlayBgSrc }}'); background-position: center; background-size: cover; transition: filter 250ms, transform 250ms; }
  #lockOverlay[data-step="pin"] #lockBackgroundImage { filter: blur(8px); transform: scale(1.2); }
  .lock-info { display: flex; align-items: flex-end; justify-content: center; gap: 14px; margin-bottom: 12px; }
  .lock-info .time { color: #f5f7fb; font-size: 72px; line-height: 1; text-shadow: 2px 2px 2px rgba(0,0,0,.15); }
  .lock-info .weather { display: inline-flex; align-items: center; gap: 6px; height: 24px; margin-bottom: 8px; }
  .lock-info .weather i { color: #ffd54f; font-size: 14px; }
  .lock-info .weather span { color: #fff; font-size: 16px; opacity: .9; }

  #app-pin { display: flex; gap: 12px; justify-content: center; margin: 18px 0 6px; }
  .app-pin-digit { align-items: center; background-color: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.25); border-radius: 12px; box-shadow: 2px 2px 2px rgba(0,0,0,0.06); color: #f5f7fb; display: inline-flex; font-size: 28px; height: 68px; width: 60px; justify-content: center; position: relative; transition: background-color 250ms, border-color 250ms; }
  .app-pin-digit.focused:before { content: ""; position: absolute; bottom: 10px; left: 15%; width: 70%; height: 3px; background: #f5f7fb; border-radius: 10px; opacity: 1; animation: blink 2s ease-in-out infinite; }
  .app-pin-digit.hidden .app-pin-digit-value { opacity: 0; transform: scale(0.25); }
  .app-pin-digit.hidden:after { content: ""; position: absolute; width: 14px; height: 14px; border-radius: 50%; background: #f5f7fb; opacity: 1; transform: scale(1); }
  .app-pin-digit-value { transition: opacity 250ms, transform 250ms; }

  #app-pin-label { color: #e8edf7; font-size: 14px; margin: 6px 0 12px; opacity: .85; }
  #lockError { color: #ef5350; display: none; margin-bottom: 8px; font-size: 14px; }
  .lock-actions { display: flex; gap: 10px; justify-content: center; margin-top: 10px; }
  .lock-actions .btn { min-width: 120px; }
  #pinHiddenInput { position: absolute; opacity: 0; pointer-events: none; }
  #signInButtonWrapper { display: flex; justify-content: center; margin: 16px 0 6px; }
  #lockGoBtn { backdrop-filter: blur(3px); background-color: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.2); color: #f5f7fb; border-radius: 999px; padding: 12px 28px; font-size: 16px; }
  #pinSection { display: none; }
  #lockOverlay[data-step="pin"] #signInButtonWrapper { display: none; }
  #lockOverlay[data-step="pin"] #pinSection { display: block; }
  @keyframes blink { 0%,25%,100%{opacity:1} 50%{opacity:0} }
</style>
<div id="lockOverlay" data-step="out">
  <div id="lockBackground"><div id="lockBackgroundImage" class="background-image"></div></div>
  <div id="lockCard">
    <div class="lock-info">
      <span id="lockTime" class="time">12:34</span>
      <span class="weather">
        <i class="ti ti-sun"></i>
        <span id="lockTemp">75</span><span>°F</span>
      </span>
    </div>
    <div id="signInButtonWrapper">
      <button id="lockGoBtn" type="button">Go</button>
    </div>
    <div id="pinSection">
      <div id="app-pin">
        <div class="app-pin-digit"><span class="app-pin-digit-value"></span></div>
        <div class="app-pin-digit"><span class="app-pin-digit-value"></span></div>
        <div class="app-pin-digit"><span class="app-pin-digit-value"></span></div>
        <div class="app-pin-digit"><span class="app-pin-digit-value"></span></div>
      </div>
      <h3 id="app-pin-label">Enter PIN</h3>
      <div id="lockError">Incorrect PIN. Try again.</div>
      <input id="pinHiddenInput" type="tel" inputmode="numeric" maxlength="4" autocomplete="one-time-code" />
      <div class="lock-actions">
        <button id="clearPinBtn" class="btn btn-outline-secondary btn-sm">Clear</button>
        <form id="forceLogoutForm" method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn btn-outline-secondary btn-sm">Logout</button>
        </form>
      </div>
    </div>
  </div>
  </div>
<script>
  (function(){
    var overlay = document.getElementById('lockOverlay');
    var pinInput = document.getElementById('pinHiddenInput');
    var errorBox = document.getElementById('lockError');
    var clearBtn = document.getElementById('clearPinBtn');
    var goBtn = document.getElementById('lockGoBtn');
    var timeEl = document.getElementById('lockTime');
    var tempEl = document.getElementById('lockTemp');
    var digitBoxes = Array.from(document.querySelectorAll('#app-pin .app-pin-digit'));
    var digitVals  = Array.from(document.querySelectorAll('#app-pin .app-pin-digit-value'));

    function seg(n){ return n < 10 ? ('0'+n) : (''+n); }
    function hr(h){ var x = h % 12; return x === 0 ? 12 : x; }
    function tick(){ try { var d=new Date(); timeEl.textContent = hr(d.getHours())+':'+seg(d.getMinutes()); }catch(e){} }
    setInterval(tick,1000); tick();
    function rnd(a,b){ return Math.floor(Math.random()*(b-a+1))+a; }
    function setTemp(){ try{ tempEl.textContent = String(rnd(65,85)); }catch(e){} }
    setTemp();

    function resetUI(){ pinInput.value=''; digitVals.forEach(function(s){s.textContent='';}); digitBoxes.forEach(function(b){b.classList.remove('hidden','focused');}); if(digitBoxes[0]) digitBoxes[0].classList.add('focused'); errorBox.style.display='none'; }
    function focusRing(len){ digitBoxes.forEach(function(b){b.classList.remove('focused');}); if(len>=0 && len<digitBoxes.length){ digitBoxes[len].classList.add('focused'); } }
    function maskLater(i){ setTimeout(function(){ digitBoxes[i].classList.add('hidden'); }, 500); }

    function submitPin(pin){
      fetch('{{ route('user.unlockScreen') }}', {
        method:'POST', headers:{ 'Content-Type':'application/json', 'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').getAttribute('content') },
        body: JSON.stringify({ pin: pin })
      }).then(function(r){return r.json();}).then(function(res){
        if(res && res.ok){ overlay.style.display='none'; resetUI(); document.dispatchEvent(new Event('mousemove')); }
        else{ errorBox.style.display='block'; resetUI(); pinInput.focus(); }
      }).catch(function(){ errorBox.style.display='block'; resetUI(); pinInput.focus(); });
    }

    pinInput.addEventListener('input', function(){
      var raw = pinInput.value.replace(/\D+/g,'').slice(0,4); pinInput.value = raw;
      digitVals.forEach(function(s,i){ s.textContent = raw[i] ? raw[i] : ''; });
      focusRing(Math.min(raw.length,3));
      for(var i=0;i<raw.length;i++){ if(!digitBoxes[i].classList.contains('hidden')){ maskLater(i); } }
      for(var j=raw.length;j<digitBoxes.length;j++){ digitBoxes[j].classList.remove('hidden'); }
      if(raw.length===4){ submitPin(raw); }
    });

    overlay.addEventListener('click', function(e){ if(e.target===overlay){ pinInput.focus(); }});
    clearBtn.addEventListener('click', function(){ resetUI(); pinInput.focus(); });

    window.showLockOverlay = function(){ overlay.style.display='flex'; overlay.setAttribute('data-step','out'); setTemp(); resetUI(); };
    window.hideLockOverlay = function(){ overlay.style.display='none'; resetUI(); };
    if (goBtn) { goBtn.addEventListener('click', function(){ overlay.setAttribute('data-step','pin'); setTimeout(function(){ pinInput.focus(); },50); }); }
    var obs = new MutationObserver(function(){ if(overlay.style.display!=='none'){ overlay.setAttribute('data-step','out'); resetUI(); }});
    obs.observe(overlay,{ attributes:true, attributeFilter:['style'] });
  })();
</script>
</html>