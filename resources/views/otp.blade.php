<?php $page = 'otp'; ?>
@extends('layout.mainlayout')
@section('content')

<div class="container-fuild">
    <div class=" w-100 overflow-hidden position-relative flex-wrap d-block vh-100">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="row justify-content-center align-items-center vh-100 overflow-auto flex-wrap login-bg1 ">
                    <div class="col-md-9 mx-auto p-4">
                        <form action="{{url('reset-password')}}">
                            <div>
                                <div class=" mx-auto mb-5 text-center">
                                    <img src="{{URL::asset('/build/img/full-logo.svg')}}"
                                        class="img-fluid" alt="Logo">
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class=" mb-4">
                                            <h2 class="mb-2">OTP Verification</h2>
                                            <p class="mb-0 fs-16">We send a code to test@example.com</p>
                                        </div>
                                        <div class="text-center digit-group">
                                            <div class="d-flex justify-content-center align-items-center mb-3">
                                                <input type="text" class="border fw-bold border-dark-2 rounded py-sm-3 py-2 text-center fs-32 hw-bold me-3" id="digit-1" name="digit-1" data-next="digit-2" maxlength="1">
                                                <input type="text" class="border fw-bold border-dark-2 rounded py-sm-3 py-2 text-center fs-32 hw-bold me-3" id="digit-2" name="digit-2" data-next="digit-3" data-previous="digit-1" maxlength="1">
                                                <input type="text" class="border fw-bold border-dark-2 rounded py-sm-3 py-2 text-center fs-32 hw-bold me-3" id="digit-3" name="digit-3" data-next="digit-4" data-previous="digit-2" maxlength="1">
                                                <input type="text" class="border fw-bold border-dark-2 rounded py-sm-3 py-2 text-center fs-32 hw-bold" id="digit-4" name="digit-4" data-next="digit-5" data-previous="digit-3" maxlength="1">
                                            </div>
                                            <div>
                                                <div class="badge bg-soft-danger mb-3">
                                                    <p>Otp will expire in 09:59</p>
                                                </div>
                                               
                                            </div>
                                        </div>
                                                                                    
                                        <button type="submit" class="btn btn-primary w-100 justify-content-center">Continue</button>
                                        
                                    </div>
                                </div>
                                <div class="mt-5 text-center">
                                    <p class="mb-0 text-gray-9"> Dont receive an email? <a href="javascript:void(0);" class="link-primary">click to resend</a></p>
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