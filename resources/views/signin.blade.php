<?php $page = 'signin'; ?>
@extends('layout.mainlayout')
@section('content')

<style>
    .img-fluid {
        max-width: 50%;
        height: auto;
    }
    /* Right side login background must always cover the full 8-column area */
    .login-bg-wrapper {
        position: relative;
        width: 100%;
        height: 100%;
        min-height: 100vh;
        overflow: hidden;
    }
    .login-bg-image {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        -o-object-fit: cover;
        object-fit: cover;
        -o-object-position: center;
        object-position: center;
        display: block;
    }
</style>
<div class="container-fuild">
    <div class=" w-100 overflow-hidden position-relative flex-wrap d-block vh-100">
        <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="row justify-content-center align-items-center vh-100 overflow-auto flex-wrap login-bg1 ">
                    <div class="col-md-9 mx-auto p-4">
                        <form action="{{ url('custom-login') }}" method="POST" class="flex-fill">
                            @csrf
                            <div>
                                <div class=" mx-auto mb-5  text-center">
                                    <img src="{{URL::asset('/build/img/welogo.svg')}}"
                                        class="img-fluid " alt="Logo">
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class=" mb-4">
                                            <h2 class="mb-2">Welcome!</h2>
                                            <p class="mb-0 fs-16">Sign in to see what you’ve missed.</p>
                                        </div>
                                        <div class="mb-3 ">
                                            <label class="form-label">Email</label>
                                            <div class="input-icon mb-3 position-relative">
                                                <input type="email" name="email" id="email" placeholder="Enter Your Email" class="form-control">
                                                <span class="input-icon-addon">
                                                    <i class="ti ti-mail"></i>
                                                </span>
                                            </div>
                                            <div class="text-danger pt-2">
                                                @error('0')
                                                {{ $message }}
                                                @enderror
                                                @error('email')
                                                {{ $message }}
                                                @enderror
                                            </div>
                                            <label class="form-label">Password</label>
                                            <div class="input-icon ">
                                                <input type="password" class="pass-input form-control" name="password" id="password" value="123456">
                                                <span class="ti toggle-password ti-eye-off"></span>
                                            </div>
                                            <div class="text-danger pt-2">
                                                @error('0')
                                                {{ $message }}
                                                @enderror
                                                @error('password')
                                                {{ $message }}
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <button type="submit" class="btn btn-primary w-100 justify-content-center">Sign In</button>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>

                </div>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12 p-0">
                <div class="login-bg-wrapper">
                    @php
                    $userSetting = App\Models\Setting::first();
                    $loginImages = $userSetting && $userSetting->login_backgrounds ? json_decode($userSetting->login_backgrounds, true) : [];
                    $selectedIdx = $userSetting->selected_login_background ?? null;
                    $candidate = ($selectedIdx !== null && array_key_exists($selectedIdx, $loginImages)) ? $loginImages[$selectedIdx] : null;
                    if (!$candidate || !is_string($candidate) || $candidate === '') {
                    // if selected slot empty, fallback to first non-empty image
                    foreach ($loginImages as $img) { if ($img) { $candidate = $img; break; } }
                    }
                    $bgSrc = $candidate ? asset($candidate) : URL::asset('/build/img/bg/chatlogo.jpg');
                    @endphp
                    <img src="{{ $bgSrc }}" class="login-bg-image" alt="Login Background">
                </div>
            </div>


        </div>



    </div>
</div>

@endsection