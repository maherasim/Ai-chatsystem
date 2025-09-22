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
    <link rel="icon" href="{{ $setting->favicon ?? asset('/build/img/gallery/gallery-01.jpg') }}"
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
</body>
<script>
    (function() {
        try {
            var screenLockEnabled =
                {{ auth()->check() ? ($userSetting && ($userSetting->screen_lock ?? false) ? 'true' : 'false') : 'false' }};
            var minutes = {{ auth()->check() ? (int) ($userSetting->screen_lock_minutes ?? 0) : 0 }};
            if (!screenLockEnabled || !minutes) {
                return;
            }

            var ms = minutes * 60 * 1000;
            var timerId;

            function showLock() {
                var overlay = document.getElementById('lockOverlay');
                if (overlay) {
                    overlay.style.display = 'flex';
                    overlay.setAttribute('data-step', 'out');
                    var btn = document.getElementById('lockGoBtn');
                    if (btn) btn.focus();
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

            ['click', 'mousemove', 'keydown', 'scroll', 'touchstart', 'touchmove', 'visibilitychange'].forEach(
                function(evt) {
                    window.addEventListener(evt, resetTimer, {
                        passive: true
                    });
                });
            resetTimer();
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
        filter: blur(8px);
        transform: scale(1.2);
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
        backdrop-filter: blur(3px);
        background-color: rgba(255, 255, 255, 0.12);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #f5f7fb;
        border-radius: 999px;
        width: 64px;
        height: 64px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
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
  font-size: 32px;     /* ✅ bigger date text */
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
        pointer-events: none;
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
      </div>
      <h3 id="app-pin-label">
        Enter PIN (1234)
        <span id="app-pin-cancel-text" style="cursor:pointer; text-decoration: underline; opacity:.9;">
          Cancel
        </span>
      </h3>
      <div id="lockError">Incorrect PIN. Try again.</div>
      <input id="pinHiddenInput" type="tel" inputmode="numeric" maxlength="4" autocomplete="one-time-code" />
    </div>
    <!-- /pinSection -->
  </div>
  <!-- /lockCard -->
</div>
<!-- /lockOverlay -->

<script>
    (function() {
        var overlay = document.getElementById('lockOverlay');
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
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content')
                },
                body: JSON.stringify({
                    pin: pin
                })
            }).then(function(r) {
                return r.json();
            }).then(function(res) {
                if (res && res.ok) {
                    overlay.style.display = 'none';
                    resetUI();
                    document.dispatchEvent(new Event('mousemove'));
                } else {
                    errorBox.style.display = 'block';
                    resetUI();
                    pinInput.focus();
                }
            }).catch(function() {
                errorBox.style.display = 'block';
                resetUI();
                pinInput.focus();
            });
        }

        pinInput.addEventListener('input', function() {
            var raw = pinInput.value.replace(/\D+/g, '').slice(0, 4);
            pinInput.value = raw;
            digitVals.forEach(function(s, i) {
                s.textContent = raw[i] ? raw[i] : '';
            });
            focusRing(Math.min(raw.length, 3));
            for (var i = 0; i < raw.length; i++) {
                if (!digitBoxes[i].classList.contains('hidden')) {
                    maskLater(i);
                }
            }
            for (var j = raw.length; j < digitBoxes.length; j++) {
                digitBoxes[j].classList.remove('hidden');
            }
            if (raw.length === 4) {
                submitPin(raw);
            }
        });

        overlay.addEventListener('click', function(e) {
            if (e.target === overlay) {
                pinInput.focus();
            }
        });
        if (clearBtn) {
            clearBtn.addEventListener('click', function() {
                resetUI();
                pinInput.focus();
            });
        }

        window.showLockOverlay = function() {
            overlay.style.display = 'flex';
            overlay.setAttribute('data-step', 'out');
            setTemp();
            resetUI();
        };
        window.hideLockOverlay = function() {
            overlay.style.display = 'none';
            resetUI();
        };
        if (goBtn) {
            goBtn.addEventListener('click', function() {
                overlay.setAttribute('data-step', 'pin');
                setTimeout(function() {
                    pinInput.focus();
                }, 50);
            });
        }
        if (cancelText) {
            cancelText.addEventListener('click', function() {
                overlay.setAttribute('data-step', 'out');
                resetUI();
            });
        }
        var obs = new MutationObserver(function() {
            if (overlay.style.display !== 'none') {
                overlay.setAttribute('data-step', 'out');
                resetUI();
            }
        });
        obs.observe(overlay, {
            attributes: true,
            attributeFilter: ['style']
        });
    })();
</script>

</html>
