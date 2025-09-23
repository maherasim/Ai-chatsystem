<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Locked</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body { margin:0; height:100vh; display:flex; align-items:center; justify-content:center; background:#0f1b3d; }
        .card { color:#e8edf7; text-align:center; }
        .pin { display:flex; gap:8px; justify-content:center; margin:16px 0; }
        .pin input { width:46px; height:56px; text-align:center; font-size:26px; border-radius:10px; border:1px solid rgba(255,255,255,.25); background:rgba(255,255,255,.06); color:#f5f7fb; }
        .error{ color:#ef5350; min-height:18px; }
        button { height:44px; padding:0 18px; border-radius:999px; color:#f5f7fb; background:rgba(255,255,255,.15); border:1px solid rgba(255,255,255,.25); backdrop-filter:blur(6px); }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            var inputs = Array.from(document.querySelectorAll('.pin input'));
            var error = document.getElementById('err');
            inputs[0].focus();
            inputs.forEach(function(inp,idx){
                inp.addEventListener('input', function(){
                    this.value = this.value.replace(/\D+/g,'').slice(0,1);
                    if(this.value && idx < inputs.length-1){ inputs[idx+1].focus(); }
                    submitIfReady();
                });
                inp.addEventListener('keydown', function(e){
                    if(e.key==='Backspace' && !this.value && idx>0){ inputs[idx-1].focus(); }
                });
            });
            function submitIfReady(){
                var val = inputs.map(function(i){return i.value||''}).join('');
                if(val.length===8){
                    fetch('{{ route('user.unlockScreen') }}',{
                        method:'POST',
                        headers:{'Content-Type':'application/json','X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').content},
                        body: JSON.stringify({pin:val})
                    }).then(function(r){return r.json()}).then(function(res){
                        if(res && res.ok){
                            var to = sessionStorage.getItem('intended_url') || '{{ url('/home') }}';
                            sessionStorage.removeItem('intended_url');
                            window.location.replace(to);
                        } else {
                            error.textContent = 'Invalid PIN';
                            inputs.forEach(function(i){ i.value=''; });
                            inputs[0].focus();
                        }
                    }).catch(function(){ error.textContent='Error'; });
                }
            }
        });
    </script>
    </head>
<body>
    <div class="card">
        <h2>Screen Locked</h2>
        <div class="pin">
            <input type="tel" inputmode="numeric" maxlength="1">
            <input type="tel" inputmode="numeric" maxlength="1">
            <input type="tel" inputmode="numeric" maxlength="1">
            <input type="tel" inputmode="numeric" maxlength="1">
            <input type="tel" inputmode="numeric" maxlength="1">
            <input type="tel" inputmode="numeric" maxlength="1">
            <input type="tel" inputmode="numeric" maxlength="1">
            <input type="tel" inputmode="numeric" maxlength="1">
        </div>
        <div id="err" class="error"></div>
        <button type="button" onclick="history.back()"><i class="fa-solid fa-arrow-left"></i> Back</button>
    </div>
</body>
</html>

