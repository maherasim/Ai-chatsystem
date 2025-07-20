<?php $page = 'signup'; ?>
@extends('layout.mainlayout')
@section('content')

<div class="container-fuild">
    <div class=" w-100 overflow-hidden position-relative flex-wrap d-block vh-100">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="row justify-content-center align-items-center vh-100 overflow-auto flex-wrap login-bg1 ">
                    <div class="col-md-9 mx-auto p-4">
                        <form action="{{ route('register.custom') }}" method="POST" class="flex-fill">
                            @csrf
                            <div>
                                <div class=" mx-auto mb-5 text-center">
                                    <img src="{{URL::asset('/build/img/full-logo.svg')}}"
                                        class="img-fluid" alt="Logo">
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class=" mb-4">
                                            <h2 class="mb-2">Register</h2>
                                            <p class="mb-0 fs-16">Sign up to share moments with friends!</p>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-12">
                                                <div class="mb-3 ">
                                                    <label class="form-label">First Name</label>
                                                    <div class="input-icon mb-3 position-relative">
                                                        <input type="text"   id="name" name="name" class="form-control">
                                                        <span class="input-icon-addon">
                                                            <i class="ti ti-user"></i>
                                                        </span>
                                                    </div>
                                                    <div class="text-danger pt-2">
                                                        @error('0')
                                                            {{ $message }}
                                                        @enderror
                                                        @error('name')
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Last Name</label>
                                                    <div class="input-icon mb-3 position-relative">
                                                        <input type="text" id="last_name" name="last_name" class="form-control">
                                                        <span class="input-icon-addon">
                                                            <i class="ti ti-user"></i>
                                                        </span>
                                                    </div>
                                                    <div class="text-danger pt-2">
                                                        @error('0')
                                                            {{ $message }}
                                                        @enderror
                                                        @error('last_name')
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Email</label>
                                                    <div class="input-icon mb-3 position-relative">
                                                        <input type="email"  id="email" name="email" class="form-control">
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
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Phone Number</label>
                                                    <div class="input-icon mb-3 position-relative">
                                                        <input type="tel"  id="phone_number" name="phone_number" class="form-control">
                                                        <span class="input-icon-addon">
                                                            <i class="ti ti-phone"></i>
                                                        </span>
                                                    </div>
                                                    <div class="text-danger pt-2">
                                                        @error('0')
                                                            {{ $message }}
                                                        @enderror
                                                        @error('phone_number')
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="mb-3 ">
                                                    <label class="form-label">User Name</label>
                                                    <div class="input-icon mb-3 position-relative">
                                                        <input type="text"  id="user_name" name="user_name" class="form-control">
                                                        <span class="input-icon-addon">
                                                            <i class="ti ti-user"></i>
                                                        </span>
                                                    </div>
                                                    <div class="text-danger pt-2">
                                                        @error('0')
                                                            {{ $message }}
                                                        @enderror
                                                        @error('user_name')
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Password</label>
                                                    <div class="input-icon ">
                                                        <input type="password"  id="password" name="password" class="pass-input form-control">
                                                        <span class="ti toggle-password ti-eye-off"></span>
                                                    </div>
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
                                           
                                        </div>
                                        <div class="form-wrap form-wrap-checkbox mb-3">
                                            <div class="d-flex align-items-center">
                                                <div class="form-check form-check-md mb-0">
                                                    <input class="form-check-input mt-0" type="checkbox">
                                                </div>
                                                <p class=" mb-0 ">I agree to
                                                    <a href="{{url('terms-of-use')}}" class="link-primary">Terms of use </a>&
                                                    <a href="{{url('privacy-policy')}}" class="link-primary">Privacy policy </a>
                                                        
                                                </p>
                                            </div>
                                            
                                        </div>												
                                        <div class="mb-4">
                                            <button type="submit" class="btn btn-primary w-100 justify-content-center">Sign Up</button>
                                        </div>
                                        <div class="login-or mb-3">
                                            <span class="span-or">Or sign up with </span>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center flex-wrap">
                                            <div class="text-center me-2 flex-fill">
                                                <a href="javascript:void(0);" class="fs-16 btn btn-white btn-shadow d-flex align-items-center justify-content-center">
                                                    <img class="img-fluid me-3" src="{{URL::asset('/build/img/icons/google.svg')}}" alt="Facebook">
                                                    Google
                                                </a>
                                            </div>
                                            <div class="text-center flex-fill">
                                                <a href="javascript:void(0);" class="fs-16 btn btn-white btn-shadow d-flex align-items-center justify-content-center">
                                                    <img class="img-fluid me-3" src="{{URL::asset('/build/img/icons/facebook.svg')}}" alt="Facebook">
                                                    Facebook
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-5 text-center">
                                    <p class="mb-0 text-gray-9">Already have a account? <a href="{{url('signin')}}" class="link-primary">Sign In</a></p>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
            <div class="col-lg-6 p-0">
                <div class="d-lg-flex align-items-center justify-content-center position-relative d-lg-block d-none flex-wrap vh-100 overflowy-auto login-bg2 ">
                    <div class="floating-bg">
                        <img src="{{URL::asset('/build/img/bg/circle-1.png')}}" alt="Img">
                        <img src="{{URL::asset('/build/img/bg/circle-2.png')}}" alt="Img">
                        <img src="{{URL::asset('/build/img/bg/emoji-01.svg')}}" alt="Img">
                        <img src="{{URL::asset('/build/img/bg/emoji-02.svg')}}" alt="Img">
                        <img src="{{URL::asset('/build/img/bg/emoji-03.svg')}}" alt="Img">
                        <img src="{{URL::asset('/build/img/bg/emoji-04.svg')}}" alt="Img">
                        <img src="{{URL::asset('/build/img/bg/right-arrow-01.svg')}}" alt="Img">
                        <img src="{{URL::asset('/build/img/bg/right-arrow-02.svg')}}" alt="Img">
                        
                    </div>
                    <div class="floating-avatar ">
                        <span class="avatar avatar-xl avatar-rounded border border-white">
                            <img src="{{URL::asset('/build/img/profiles/avatar-12.jpg')}}" alt="img">
                        </span>
                        <span class="avatar avatar-xl avatar-rounded border border-white">
                            <img src="{{URL::asset('/build/img/profiles/avatar-03.jpg')}}" alt="img">
                        </span>
                        <span class="avatar avatar-xl avatar-rounded border border-white">
                            <img src="{{URL::asset('/build/img/profiles/avatar-02.jpg')}}" alt="img">
                        </span>
                        <span class="avatar avatar-xl avatar-rounded border border-white">
                            <img src="{{URL::asset('/build/img/profiles/avatar-05.jpg')}}" alt="img">
                        </span>
                    </div>
                    <div class="text-center">
                        <img src="{{URL::asset('/build/img/bg/login-bg-1.svg')}}" class="login-img" alt="Img">
                    </div>
                </div>
            </div>

        </div>



    </div>
</div>




@endsection