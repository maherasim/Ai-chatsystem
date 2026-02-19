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
	<link rel="icon" href="{{ ($setting && $setting->favicon) ? asset($setting->favicon) : asset('/build/img/gallery/gallery-01.jpg') }}"
        class="rounded-circle">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />


    @include('layout.partials.head')
</head>

<body>
    <!-- Main Wrapper -->
    @if (Route::is(['signup', 'signin', 'success', 'reset-password', 'otp', 'forgot-password']))
        <div class="main-wrapper d-block">
    @endif
    @if (!Route::is(['signup', 'signin', 'success', 'reset-password', 'otp', 'forgot-password']))
        <div class="main-wrapper">
    @endif
    @yield('content')
    </div>
    <!-- /Main Wrapper -->
    @include('layout.partials.footer-scripts')
    
    @auth
    <!-- Global Chat Notifications -->
    <meta name="user-id" content="{{ Auth::id() }}">
    <script>
        window.currentUserId = "{{ Auth::id() }}";
        window.baseUrl = "https://logiteam.it-supportline.de";
    </script>
    <script src="{{ asset('js/global-notifications.js') }}"></script>
    @endauth
</body>
@auth
<script>
    (function() {
        try {
            var LOCK_KEY = 'appLocked';
            var PREV_URL_KEY = 'prev_url_before_lock';
            var LOCKED_URL = '{{ url('/locked') }}';
            var screenLockEnabled =
                {{ auth()->check() ? ($userSetting && ($userSetting->screen_lock ?? false) ? 'true' : 'false') : 'false' }};
            var minutes = {{ auth()->check() ? (int) ($userSetting->screen_lock_minutes ?? 0) : 0 }};
            if (!screenLockEnabled || !minutes) {
                return;
            }

            var ms = minutes * 60 * 1000;
            var timerId;

            function setLockedUrl() {
                try {
                    var currentHref = window.location.href;
                    var alreadyLocked = currentHref === LOCKED_URL;
                    if (!alreadyLocked) {
                        sessionStorage.setItem(PREV_URL_KEY, currentHref);
                        history.replaceState({ locked: true }, document.title, LOCKED_URL);
                    }
                } catch(e) {}
            }

            function restoreUrl() {
                try {
                    var prev = sessionStorage.getItem(PREV_URL_KEY);
                    if (prev && window.location.href === LOCKED_URL) {
                        history.replaceState({}, document.title, prev);
                    }
                    sessionStorage.removeItem(PREV_URL_KEY);
                } catch(e) {}
            }

            function showLock() {
                var overlay = document.getElementById('lockOverlay');
                if (overlay) {
                    overlay.style.display = 'flex';
                    overlay.setAttribute('data-step', 'out');
                    setLockedUrl();
                    try { localStorage.setItem(LOCK_KEY, '1'); } catch(e) {}
                    // Inform server that session is locked
                    try {
                        fetch('{{ route('user.lockScreen') }}', { method:'POST', headers:{ 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content } });
                    } catch(e) {}
                    var btn = document.getElementById('lockGoBtn');
                    if (btn) btn.focus();
                }
            }

            function hideLock() {
                var overlay = document.getElementById('lockOverlay');
                if (overlay) overlay.style.display = 'none';
                restoreUrl();
                try { localStorage.removeItem(LOCK_KEY); } catch(e) {}
            }

            function resetTimer() {
                if (timerId) clearTimeout(timerId);
                var overlay = document.getElementById('lockOverlay');
                // If already locked, ensure overlay is visible and do not reset timer
                try {
                    if (localStorage.getItem(LOCK_KEY) === '1') {
                        if (overlay) {
                            overlay.style.display = 'flex';
                        }
                        setLockedUrl();
                        return;
                    }
                } catch(e) {}
                timerId = setTimeout(showLock, ms);
            }

            ['click', 'mousemove', 'keydown', 'scroll', 'touchstart', 'touchmove', 'visibilitychange'].forEach(
                function(evt) {
                    window.addEventListener(evt, resetTimer, {
                        passive: true
                    });
                });
            resetTimer();
            // On history navigation or refresh, if locked, ensure overlay is shown
            function ensureLockedOnShow() {
                try {
                    if (localStorage.getItem(LOCK_KEY) === '1') {
                        var overlay = document.getElementById('lockOverlay');
                        if (overlay) overlay.style.display = 'flex';
                        setLockedUrl();
                        // Try to focus something so typing works immediately
                        setTimeout(function() {
                            var btn = document.getElementById('lockGoBtn');
                            if (btn && overlay && overlay.getAttribute('data-step') === 'out') btn.focus();
                        }, 200);
                    } else {
                        restoreUrl();
                    }
                } catch(e) {}
            }
            window.addEventListener('pageshow', ensureLockedOnShow);
            window.addEventListener('popstate', ensureLockedOnShow);

            // Expose helpers for other scripts
            window.__lockSetUrl = setLockedUrl;
            window.__lockRestoreUrl = restoreUrl;
        } catch (_) {}
    })();
    // Toggle minutes field visibility live on change
    (function() {
        var checkbox = document.querySelector('#screen-lock-form input[name="screen_lock"]');
        var panel = document.getElementById('screen-lock-minutes');
        if (checkbox && panel) {
            checkbox.addEventListener('change', function() {
                panel.style.display = this.checked ? 'block' : 'none';
            });
        }
    })();

    // Global focus handling for lock screen
    window.addEventListener('focus', function() {
        var overlay = document.getElementById('lockOverlay');
        var pinInput = document.getElementById('pinHiddenInput');
        if (overlay && overlay.style.display === 'flex') {
            if (overlay.getAttribute('data-step') === 'pin' && pinInput) {
                pinInput.focus();
            } else {
                var btn = document.getElementById('lockGoBtn');
                if (btn) btn.focus();
            }
        }
    });

    // Allow typing to activate PIN step
    document.addEventListener('keydown', function(e) {
        var overlay = document.getElementById('lockOverlay');
        var goBtn = document.getElementById('lockGoBtn');
        if (overlay && overlay.style.display === 'flex' && overlay.getAttribute('data-step') === 'out') {
            // If it's a character key or enter, switch to pin
            if (e.key.length === 1 || e.key === 'Enter') {
                if (goBtn) goBtn.click();
            }
        }
    });
</script>
@php
    $overlaySetting = App\Models\Setting::first();
    $ovImages =
        $overlaySetting && $overlaySetting->login_backgrounds
            ? json_decode($overlaySetting->login_backgrounds, true)
            : [];
    $ovIdx = $overlaySetting->selected_login_background ?? null;
    $ovCandidate = $ovIdx !== null && array_key_exists($ovIdx, $ovImages) ? $ovImages[$ovIdx] : null;
    if (!$ovCandidate || !is_string($ovCandidate) || $ovCandidate === '') {
        foreach ($ovImages as $img) {
            if ($img) {
                $ovCandidate = $img;
                break;
            }
        }
    }
    $overlayBgSrc = $ovCandidate ? asset($ovCandidate) : URL::asset('/build/img/bg/chatlogo.jpg');
@endphp
<style>
    #lockOverlay {
        position: fixed;
        inset: 0;
        background: rgba(15, 27, 61, 0.9);
        backdrop-filter: blur(10px);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    }
    .lock-top {
  position: relative;
  z-index: 1; /* ⬅ keeps it below button */
}
    #lockCard {
        background: transparent;
        border-radius: 16px;
        padding: 16px;
        width: 100%;
        max-width: 1280px;
        text-align: left;
        position: relative;
    }

    #lockBackground {
        position: absolute;
        inset: 0;
        overflow: hidden;
        z-index: 0;
    }

    #lockBackgroundImage {
        position: absolute;
        inset: 0;
        background-image: url('{{ $overlayBgSrc }}');
        background-position: center;
        background-size: cover;
        transition: filter 250ms, transform 250ms;
    }

    #lockOverlay[data-step="pin"] #lockBackgroundImage {
        filter: blur(8px) brightness(0.3);
        transform: scale(1.2);
    }
    
    /* Add dark overlay when PIN section is active */
    #lockOverlay[data-step="pin"] #lockBackground::after {
        content: "";
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.6);
        z-index: 1;
    }

    .lock-main {
        position: relative;
        z-index: 999;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-height: 70vh;
        gap: 24px;
        padding: 0 8px;
        pointer-events: auto;
    }

    .lock-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 24px;
    }

    .lock-left {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .lock-right {
        display: flex;
        flex-direction: column;
        gap: 12px;
        align-items: flex-end;
    }

    .lock-info {
        display: flex;
        align-items: flex-end;
        gap: 14px;
    }

    .lock-info .time {
        color: #f5f7fb;
        font-size: 72px;
        line-height: 1;
        text-shadow: 2px 2px 2px rgba(0, 0, 0, .15);
    }

    .lock-info .weather {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        height: 24px;
        margin-bottom: 8px;
    }

    .lock-info .weather i {
        color: #ffd54f;
        font-size: 14px;
    }

    .lock-info .weather span {
        color: #fff;
        font-size: 16px;
        opacity: .9;
    }

    .lock-event {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #e8edf7;
        font-size: 16px;
        opacity: .95;
    }

    .lock-event .time-badge {
        background: rgba(255, 255, 255, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.2);
        padding: 2px 6px;
        border-radius: 6px;
        font-size: 12px;
    }

    .lock-date {
        color: #e8edf7;
        font-size: 16px;
        opacity: .95;
    }

    .quick-cards {
        display: flex;
        gap: 10px;
        margin-top: 6px;
    }

    .quick-card {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 14px;
        border-radius: 20px;
        color: #e8edf7;
        background: rgba(255, 255, 255, 0.12);
        border: 1px solid rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(2px);
        font-weight: 600;
        font-size: 14px;
    }

    .quick-card i {
        font-size: 16px;
    }

    #signInButtonWrapper {
        position: absolute;
        top: 18px;
        right: 12px;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 10001;
    }

    #lockGoBtn {
        position: relative;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0 22px;
        height: 44px;
        min-width: 96px;
        border-radius: 999px;
        color: #f5f7fb;
        background: linear-gradient(180deg, rgba(255, 255, 255, 0.22), rgba(255, 255, 255, 0.12));
        border: 1px solid rgba(255, 255, 255, 0.32);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        box-shadow: 0 6px 12px rgba(18, 28, 45, 0.25), inset 0 1px 0 rgba(255, 255, 255, 0.35), inset 0 -1px 0 rgba(0, 0, 0, 0.08);
        outline: none;
        transition: transform 150ms ease, box-shadow 150ms ease, background-color 150ms ease;
        overflow: hidden;
    }

    #lockGoBtn::before {
        content: "";
        position: absolute;
        inset: 0;
        border-radius: inherit;
        background: radial-gradient(120% 80% at 20% 0%, rgba(255, 255, 255, 0.55) 0%, rgba(255, 255, 255, 0.18) 25%, rgba(255, 255, 255, 0) 55%);
        pointer-events: none;
        mix-blend-mode: overlay;
    }

    #lockGoBtn:hover {
        transform: translateY(-1px);
        box-shadow: 0 10px 16px rgba(18, 28, 45, 0.28), inset 0 1px 0 rgba(255, 255, 255, 0.5), inset 0 -1px 0 rgba(0, 0, 0, 0.1);
    }

    #lockGoBtn:active {
        transform: translateY(0);
        box-shadow: 0 4px 8px rgba(18, 28, 45, 0.24), inset 0 1px 0 rgba(255, 255, 255, 0.38), inset 0 -1px 0 rgba(0, 0, 0, 0.12);
    }

    #lockGoBtn i {
        position: relative;
        z-index: 1;
        font-size: 18px;
        text-shadow: 0 1px 1px rgba(0, 0, 0, 0.25);
    }

    .lock-bottom {
        margin-top: 12px;
    }

    .section-title {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #e8edf7;
        font-weight: 600;
        font-size: 18px;
        margin-left: 6px;
    }

    .section-title i {
        color: #ffd54f;
    }

    #forecastRow {
        display: flex;
        gap: 12px;
        margin-top: 12px;
        overflow-x: auto;
        padding-bottom: 6px;
    }

    .forecast-card {
        flex: 0 0 150px;
        background: rgba(255, 255, 255, 0.12);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 16px;
        padding: 12px;
        color: #fff;
        text-align: center;
        backdrop-filter: blur(2px);
        min-height: 180px;
    }

    .forecast-day {
        font-weight: 700;
        margin-bottom: 4px;
        opacity: .95;
        letter-spacing: .4px;
    }

    .forecast-icon {
        font-size: 28px;
        margin: 6px 0;
    }

    .day-weather-icon {
        --fa-primary-color: #ffd54f;
        --fa-secondary-color: #ffffff;
        --fa-secondary-opacity: .35;
    }

    .forecast-temp {
        font-size: 15px;
        opacity: .95;
    }

    #app-pin {
        display: flex;
        gap: 12px;
        justify-content: center;
        margin: 18px 0 6px;
    }

    .app-pin-digit {
        align-items: center;
        background-color: rgba(255, 255, 255, 0.06);
        border: 1px solid rgba(255, 255, 255, 0.25);
        border-radius: 12px;
        box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.06);
        color: #f5f7fb;
        display: inline-flex;
        font-size: 28px;
        height: 68px;
        width: 60px;
        justify-content: center;
        position: relative;
        transition: background-color 250ms, border-color 250ms;
    }

    .app-pin-digit.focused:before {
        content: "";
        position: absolute;
        bottom: 10px;
        left: 15%;
        width: 70%;
        height: 3px;
        background: #f5f7fb;
        border-radius: 10px;
        opacity: 1;
        animation: blink 2s ease-in-out infinite;
    }

    .app-pin-digit.hidden .app-pin-digit-value {
        opacity: 0;
        transform: scale(0.25);
    }

    .app-pin-digit.hidden:after {
        content: "";
        position: absolute;
        width: 14px;
        height: 14px;
        border-radius: 50%;
        background: #f5f7fb;
        opacity: 1;
        transform: translate(-50%, -50%) scale(1);
        top: 50%;
        left: 50%;
    }

    .app-pin-digit-value {
        transition: opacity 250ms, transform 250ms;
    }

    #app-pin-label {
        color: #e8edf7;
        font-size: 14px;
        margin: 6px 0 12px;
        opacity: .85;
        text-align: center;
    }
    .lock-info .time {
  font-size: 72px;     /* clock stays large */
  font-weight: bold;
  line-height: 1;
}

.lock-date {
  font-size: 22px;     /* ✅ bigger date text */
  font-weight: 600;
  line-height: 1.2;
  color: #f5f7fb;
  text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
  margin-top: 8px;     /* space below time */
}


    #app-pin-cancel-text {
        color: #111;
        border-radius: 6px;
        padding: 2px 8px;
    }

    #lockError {
        color: #ef5350;
        display: none;
        margin-bottom: 8px;
        font-size: 14px;
        text-align: center;
    }

    .lock-actions {
        display: flex;
        gap: 10px;
        justify-content: center;
        margin-top: 10px;
    }

    .lock-actions .btn {
        min-width: 120px;
    }

    #pinHiddenInput {
        position: absolute;
        opacity: 0;
        pointer-events: auto;
        width: 1px;
        height: 1px;
        left: -9999px;
    }

    #pinSection {
        display: none;
    }

    #lockOverlay[data-step="pin"] #signInButtonWrapper {
        display: none;
    }

    #lockOverlay[data-step="pin"] #pinSection {
        display: block;
    }

    /* Hide activity content and center PIN UI when in PIN step */
    #lockOverlay[data-step="pin"] .lock-main {
        display: none;
    }
    #lockOverlay[data-step="pin"] #lockCard {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 60vh;
    }

    @keyframes blink {

        0%,
        25%,
        100% {
            opacity: 1
        }

        50% {
            opacity: 0
        }
    }
</style>
<div id="lockOverlay" data-step="out">
  <div id="lockBackground">
    <div id="lockBackgroundImage" class="background-image"></div>
  </div>

  <div id="lockCard">
    <!-- ✅ Sign In button OUTSIDE of .lock-main -->
    <div id="signInButtonWrapper">
      <button id="lockGoBtn" type="button">
        <i class="fa-solid fa-right-to-bracket"></i>
      </button>
    </div>

 
    <div class="lock-main">
      <div class="lock-top">
        <div class="lock-left">
          <div class="lock-info">
            <span id="lockTime" class="time">12:34</span>
          </div>
          <div id="lockDateText" class="lock-date">Date: </div>
        </div>
        <div class="lock-right"></div>
      </div>

      <div class="lock-bottom">
        <div class="section-title">
          <i class="fa-solid fa-sun"></i><span>Current Activity</span>
        </div>
        <div id="forecastRow"></div>
      </div>
    </div>
    <!-- /lock-main -->

    <!-- ✅ Pin section is separate -->
    <div id="pinSection">
      <div id="app-pin">
        <div class="app-pin-digit"><span class="app-pin-digit-value"></span></div>
        <div class="app-pin-digit"><span class="app-pin-digit-value"></span></div>
        <div class="app-pin-digit"><span class="app-pin-digit-value"></span></div>
        <div class="app-pin-digit"><span class="app-pin-digit-value"></span></div>
        <div class="app-pin-digit"><span class="app-pin-digit-value"></span></div>
        <div class="app-pin-digit"><span class="app-pin-digit-value"></span></div>
      </div>
      <h3 id="app-pin-label">
        Enter PIN
        <span id="app-pin-cancel-text" style="cursor:pointer; text-decoration: underline; opacity:.9;">
          Cancel
        </span>
      </h3>
      <div id="lockError">Incorrect PIN. Try again.</div>
      <input id="pinHiddenInput" type="password" autocomplete="current-password" />
    </div>
    <!-- /pinSection -->
  </div>
  <!-- /lockCard -->
</div>
<!-- /lockOverlay -->

<script>
    (function() {
        var overlay = document.getElementById('lockOverlay');
        var LOCK_KEY = 'appLocked';
        var pinInput = document.getElementById('pinHiddenInput');
        var errorBox = document.getElementById('lockError');
        var clearBtn = document.getElementById('clearPinBtn');
        var cancelText = document.getElementById('app-pin-cancel-text');
        var goBtn = document.getElementById('lockGoBtn');
        var timeEl = document.getElementById('lockTime');
        var tempEl = document.getElementById('lockTemp');
        var dateEl = document.getElementById('lockDateText');
        var forecastRow = document.getElementById('forecastRow');
        var digitBoxes = Array.from(document.querySelectorAll('#app-pin .app-pin-digit'));
        var digitVals = Array.from(document.querySelectorAll('#app-pin .app-pin-digit-value'));
        var PIN_LEN = digitBoxes.length;

        var autoLogoutTimer = null;
        var LOGOUT_DELAY = 5 * 60 * 1000; // 5 minutes

        function performLogout() {
            // Attempt to call logout route, then redirect to login
            fetch('{{ route('logout') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            }).finally(function() {
                window.location.href = '{{ route('login') }}';
            });
        }

        function startAutoLogout() {
            stopAutoLogout();
            autoLogoutTimer = setTimeout(performLogout, LOGOUT_DELAY);
        }

        function stopAutoLogout() {
            if (autoLogoutTimer) {
                clearTimeout(autoLogoutTimer);
                autoLogoutTimer = null;
            }
        }

        function seg(n) {
            return n < 10 ? ('0' + n) : ('' + n);
        }

        function hr(h) {
            var x = h % 12;
            return x === 0 ? 12 : x;
        }

        function dayName(i) {
            return ['SUN', 'MON', 'TUES', 'WED', 'THURS', 'FRI', 'SAT'][i];
        }

        function formatDate(d) {
            try {
                var dd = seg(d.getDate());
                var mm = seg(d.getMonth() + 1);
                var yyyy = d.getFullYear();
                var dn = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'][d.getDay()];
                return 'Date : ' + dn + ' ' + dd + '.' + mm + '.' + yyyy;
            } catch (e) {
                return '';
            }
        }

        function tick() {
            try {
                var d = new Date();
                timeEl.textContent = hr(d.getHours()) + ':' + seg(d.getMinutes());
                if (dateEl) dateEl.textContent = formatDate(d);
            } catch (e) {}
        }
        setInterval(tick, 1000);
        tick();

        function rnd(a, b) {
            return Math.floor(Math.random() * (b - a + 1)) + a;
        }

        function setTemp() {
            try {
                tempEl.textContent = String(rnd(65, 85));
            } catch (e) {}
        }
        setTemp();

        function iconForCode(code) {
            code = Number(code);
            // Return FA duotone with solid fallback so it renders even without Pro
            if (code === 0) return 'fa-duotone fa-sun fa-solid';
            if ([1, 2, 3].indexOf(code) !== -1) return 'fa-duotone fa-cloud-sun fa-solid';
            if ([45, 48].indexOf(code) !== -1) return 'fa-duotone fa-cloud fa-solid';
            if ((code >= 51 && code <= 57) || (code >= 61 && code <= 67) || (code >= 80 && code <= 82))
            return 'fa-duotone fa-cloud-rain fa-solid';
            if (code === 95 || code === 96 || code === 99) return 'fa-duotone fa-cloud-bolt fa-solid';
            return 'fa-duotone fa-cloud fa-solid';
        }

        function renderForecast(data) {
            try {
                if (!forecastRow || !data || !data.daily) return;
                var days = data.daily.time || [];
                var wCodes = data.daily.weathercode || [];
                var tMax = data.daily.temperature_2m_max || [];
                var tMin = data.daily.temperature_2m_min || [];
                forecastRow.innerHTML = '';
                for (var i = 0; i < Math.min(days.length, 7); i++) {
                    var d = new Date(days[i]);
                    var card = document.createElement('div');
                    card.className = 'forecast-card';
                    card.innerHTML = '<div class="forecast-day">' + dayName(d.getDay()) + '</div>' +
                        '<div class="forecast-icon"><i class="' + iconForCode(wCodes[i]) +
                        ' day-weather-icon"></i></div>' +
                        '<div class="forecast-temp">' + Math.round(tMax[i]) + '°F / ' + Math.round(tMin[i]) +
                        '°F</div>';
                    forecastRow.appendChild(card);
                }
            } catch (e) {}
        }

        function fetchForecast(lat, lon) {
            var url = 'https://api.open-meteo.com/v1/forecast?latitude=' + lat + '&longitude=' + lon +
                '&daily=weathercode,temperature_2m_max,temperature_2m_min&temperature_unit=fahrenheit&timezone=auto';
            fetch(url).then(function(r) {
                return r.json();
            }).then(renderForecast).catch(function() {});
        }

        try {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(pos) {
                    fetchForecast(pos.coords.latitude, pos.coords.longitude);
                }, function() {
                    fetchForecast(36.19, 44.01);
                }, {
                    timeout: 4000
                });
            } else {
                fetchForecast(36.19, 44.01);
            }
        } catch (e) {}

        function resetUI() {
            // Clear auto-submit timer
            if (autoSubmitTimer) {
                clearTimeout(autoSubmitTimer);
                autoSubmitTimer = null;
            }
            pinInput.value = '';
            digitVals.forEach(function(s) {
                s.textContent = '';
            });
            digitBoxes.forEach(function(b) {
                b.classList.remove('hidden', 'focused');
            });
            if (digitBoxes[0]) digitBoxes[0].classList.add('focused');
            errorBox.style.display = 'none';
        }

        function focusRing(len) {
            digitBoxes.forEach(function(b) {
                b.classList.remove('focused');
            });
            if (len >= 0 && len < digitBoxes.length) {
                digitBoxes[len].classList.add('focused');
            }
        }

        function maskLater(i) {
            setTimeout(function() {
                digitBoxes[i].classList.add('hidden');
            }, 500);
        }

        function submitPin(pin) {
            fetch('{{ route('user.unlockScreen') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content')
                },
                body: JSON.stringify({
                    pin: pin
                })
            }).then(function(r) {
                if (r.status === 419 || r.status === 401) {
                    window.location.reload();
                    return null;
                }
                return r.json();
            }).then(function(res) {
                if (!res) return;
                if (res && res.ok) {
                    stopAutoLogout();
                    overlay.style.display = 'none';
                    resetUI();
                    document.dispatchEvent(new Event('mousemove'));
                    try { localStorage.removeItem('appLocked'); } catch(e) {}
                    try { if (window.__lockRestoreUrl) window.__lockRestoreUrl(); } catch(e) {}
                } else {
                    // Show error message from server or default message
                    var errorMsg = (res && res.message) ? res.message : 'Incorrect PIN. Try again.';
                    errorBox.textContent = errorMsg;
                    errorBox.style.display = 'block';
                    // Do not use resetUI() as it hides the error box
                    pinInput.value = '';
                    digitVals.forEach(function(s) { s.textContent = ''; });
                    digitBoxes.forEach(function(b) { b.classList.remove('hidden', 'focused'); });
                    if (digitBoxes[0]) digitBoxes[0].classList.add('focused');
                    pinInput.focus();
                }
            }).catch(function(err) {
                // Show error on network failure
                // Check if it might be a JSON parse error from a non-JSON 419/500 response
                console.error(err);
                errorBox.textContent = 'Connection error. Reloading...';
                errorBox.style.display = 'block';
                setTimeout(function(){ window.location.reload(); }, 1500);
            });
        }

        var autoSubmitTimer = null;
        pinInput.addEventListener('input', function() {
            // Clear error when user starts typing
            errorBox.style.display = 'none';
            
            // Clear any existing auto-submit timer
            if (autoSubmitTimer) {
                clearTimeout(autoSubmitTimer);
            }
            
            // Accept all characters for password (not just numbers)
            var raw = pinInput.value;
            // Show first 6 characters in digit boxes, but allow longer passwords
            var displayLength = Math.min(raw.length, PIN_LEN);
            digitVals.forEach(function(s, i) {
                if (i < displayLength) {
                    s.textContent = '*'; // Show asterisk for password characters
                } else {
                    s.textContent = '';
                }
            });
            focusRing(Math.min(displayLength, PIN_LEN - 1));
            // Hide digits after entry
            for (var i = 0; i < displayLength; i++) {
                if (!digitBoxes[i].classList.contains('hidden')) {
                    maskLater(i);
                }
            }
            for (var j = displayLength; j < digitBoxes.length; j++) {
                digitBoxes[j].classList.remove('hidden');
            }
            
            // Auto-submit after user stops typing for 500ms (if password length >= 6)
            if (raw.length >= 6) {
                autoSubmitTimer = setTimeout(function() {
                    if (pinInput.value.length >= 6) {
                        submitPin(pinInput.value);
                    }
                }, 500);
            }
        });
        
        // Submit on Enter key
        pinInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && pinInput.value.length > 0) {
                e.preventDefault();
                // Clear auto-submit timer to avoid double submission
                if (autoSubmitTimer) {
                    clearTimeout(autoSubmitTimer);
                }
                submitPin(pinInput.value);
            }
        });

        overlay.addEventListener('click', function(e) {
            // If in PIN mode, ensure input gets focus unless clicking an interactive element
            if (overlay.getAttribute('data-step') === 'pin') {
                if (!e.target.closest('button') && !e.target.closest('a') && e.target !== cancelText) {
                    pinInput.focus();
                }
            } else {
                // In non-PIN mode, keep original behavior if needed (which was focusing if clicking bg)
                if (e.target === overlay) {
                    pinInput.focus(); 
                }
            }
        });
        if (clearBtn) {
            clearBtn.addEventListener('click', function() {
                resetUI();
                pinInput.focus();
            });
        }

        window.showLockOverlay = function() {
            startAutoLogout();
            overlay.style.display = 'flex';
            overlay.setAttribute('data-step', 'out');
            setTemp();
            resetUI();
            try { localStorage.setItem(LOCK_KEY, '1'); } catch(e) {}
            try { if (window.__lockSetUrl) window.__lockSetUrl(); } catch(e) {}
        };
        window.hideLockOverlay = function() {
            stopAutoLogout();
            overlay.style.display = 'none';
            resetUI();
            try { localStorage.removeItem(LOCK_KEY); } catch(e) {}
            try { if (window.__lockRestoreUrl) window.__lockRestoreUrl(); } catch(e) {}
        };
        if (goBtn) {
            goBtn.addEventListener('click', function() {
                overlay.setAttribute('data-step', 'pin');
                // Reset UI first
                resetUI();
                // Focus immediately to maximize reliable focus
                pinInput.focus();
                // Then use a fallback timeout for safety
                setTimeout(function() {
                    if (document.activeElement !== pinInput) {
                        pinInput.focus();
                        // One last attempt
                        setTimeout(function() {
                            if (document.activeElement !== pinInput) {
                                pinInput.focus();
                                pinInput.select();
                            }
                        }, 50);
                    }
                }, 50);
            });
        }
        
        // Also handle focus when PIN section becomes visible via CSS transition
        var observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.type === 'attributes' && mutation.attributeName === 'data-step') {
                    if (overlay.getAttribute('data-step') === 'pin') {
                        setTimeout(function() {
                            pinInput.focus();
                            if (document.activeElement !== pinInput) {
                                pinInput.focus();
                            }
                        }, 150);
                    }
                }
            });
        });
        observer.observe(overlay, { attributes: true });
        if (cancelText) {
            cancelText.addEventListener('click', function() {
                overlay.setAttribute('data-step', 'out');
                resetUI();
                try { localStorage.setItem(LOCK_KEY, '1'); } catch(e) {}
                // Ensure input is ready for next time
                setTimeout(function() {
                    pinInput.value = '';
                    pinInput.blur();
                }, 100);
            });
        }
        // Ensure if locked flag is set on load OR session is locked, show overlay immediately
        try {
            var isLocked = localStorage.getItem(LOCK_KEY) === '1';
            var sessionLocked = {{ auth()->check() && session('screen_locked') === true ? 'true' : 'false' }};
            
            if (isLocked || sessionLocked) {
                startAutoLogout();
                overlay.style.display = 'flex';
                overlay.setAttribute('data-step', 'out');
                resetUI();
                // Set localStorage to keep in sync
                if (sessionLocked) {
                    localStorage.setItem(LOCK_KEY, '1');
                }
            }
        } catch(e) {}
    })();
</script>
@endauth
@guest
<script>(function(){try{localStorage.removeItem('appLocked');sessionStorage.removeItem('prev_url_before_lock');}catch(e){}})();</script>
@endguest

</html>
