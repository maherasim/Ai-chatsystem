<?php $page = 'success'; ?>
@extends('layout.mainlayout')
@section('content')

<div class="container-fuild">
    <div class=" w-100 overflow-hidden position-relative flex-wrap d-block vh-100">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="row justify-content-center align-items-center vh-100 overflow-auto flex-wrap login-bg1 ">
                    <div class="col-md-9 mx-auto p-4">
                        <form action="{{url('signin')}}">
                            <div>
                                <div class=" mx-auto mb-5 text-center">
                                    <img src="{{URL::asset('/build/img/full-logo.svg')}}"
                                        class="img-fluid" alt="Logo">
                                </div>
                                <div class="card">
                                    <div class="card-body text-center">
                                        
                                        <div class="bg-soft-success mx-auto success-badge d-flex align-items-center justify-content-center mb-4">

                                            <span class="avatar  avatar-xl rounded-circle bg-success "><i class="ti ti-checks fs-24"></i></span>
                                        </div>
                                        <h3 class="mb-2">All Done!</h3>
                                        <p class="fs-16">Your new password has been successfully saved.<br />Now you can signin with your new password</p>
                                        
                                                                                    
                                        <button type="submit" class="btn btn-primary w-100 justify-content-center">Back to Sign In</button>
                                        
                                    </div>
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