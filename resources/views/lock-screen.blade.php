@extends('layout.mainlayout')
@section('content')
<style>
    body {
        margin: 0;
        min-height: 100vh;
        background: #f4f6f9;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .lock-screen-container {
        max-width: 400px;
        width: 100%;
        background: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
        text-align: center;
    }
    .user-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        margin-bottom: 20px;
        object-fit: cover;
        border: 4px solid #fff;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .user-name {
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 10px;
        color: #333;
    }
    .lock-message {
        font-size: 14px;
        color: #777;
        margin-bottom: 25px;
    }
    .input-group {
        margin-bottom: 20px;
        position: relative;
    }
    .input-group input {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 16px;
        outline: none;
        transition: 0.3s;
    }
    .input-group input:focus {
        border-color: #3d8bff;
        box-shadow: 0 0 5px rgba(61, 139, 255, 0.4);
    }
    .unlock-btn {
        width: 100%;
        padding: 12px;
        background: #3d8bff;
        border: none;
        color: #fff;
        font-size: 16px;
        border-radius: 8px;
        cursor: pointer;
        transition: 0.3s;
    }
    .unlock-btn:hover {
        background: #2466cc;
    }
    .logout-link {
        display: block;
        margin-top: 15px;
        color: #777;
        text-decoration: none;
        font-size: 14px;
    }
    .logout-link:hover {
        color: #333;
    }
</style>

<div class="lock-screen-container">
    @php
        $user = auth()->user();
        $avatar = $user->avatar ? asset('storage/' . $user->avatar) : asset('build/img/profileuser.svg');
    @endphp
    <img src="{{ $avatar }}" alt="User Avatar" class="user-avatar">
    <div class="user-name">{{ $user->name }}</div>
    <div class="lock-message">Enter your password to unlock the screen</div>

    <form action="{{ route('user.unlockScreen') }}" method="POST">
        @csrf
        <div class="input-group">
            <input type="password" name="password" placeholder="Password" required autofocus>
        </div>
        
        @if(session('error'))
            <div class="alert alert-danger" style="font-size: 14px; padding: 10px; margin-bottom: 15px;">
                {{ session('error') }}
            </div>
        @endif

        <button type="submit" class="unlock-btn">Unlock</button>
    </form>
    
    <a href="{{ route('logout') }}" class="logout-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>
@endsection
