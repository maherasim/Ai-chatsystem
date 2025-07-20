<?php $page = 'reset-password-success'; ?>
@extends('layout.mainlayout_admin')
@section('content')
<div class="container-fluid">
    <div class="login-wrapper">
        <header class="logo-header">
            <a href="{{url('admin/index_admin')}}" class="logo-brand">
                <img src="{{URL::asset('assets/img/full-logo.svg')}}" alt="Logo" class="img-fluid logo-dark">
            </a>
        </header>
        <div class="login-inbox">
            <div class="log-auth">
                <div class="success-pass d-flex align-items-center justify-content-center mb-2">
                    <img src="{{URL::asset('assets/img/success.png')}}" alt="Success" class="img-fluid">
                </div>
                <div class="login-auth-wrap">
                    <div class="login-content-head">
                        <h3>Reset Password Success</h3>
                        <p class="text-center">Your new password has been successfully saved.<br>
                            Now you can login with your new password</p>
                    </div>
                </div>
                 <a href="{{url('admin/login')}}" class="btn btn-primary w-100 btn-size justify-content-center">Login</a> 
            </div>
        </div>                
    </div>            
</div>
@component('admin.components.themesettings')
@endcomponent
@endsection