<?php $page = 'forgot-password'; ?>
@extends('layout.mainlayout_admin')
@section('content')
<div class="container-fluid">
    <div class="login-wrapper">
        <header class="logo-header">
            <a href="{{url('admin/index')}}" class="logo-brand">
                <img src="{{URL::asset('assets/img/full-logo.svg')}}" alt="Logo" class="img-fluid logo-dark">
            </a>
        </header>
        <div class="login-inbox">
            <div class="log-auth">
                <div class="login-auth-wrap">
                    <div class="login-content-head">
                        <h3>Forgot Password</h3>
                        <p>Enter your email to get a password reset link</p>
                    </div>
                </div>
                <form action="{{url('admin/reset-password')}}">
                    <div class="form-group">
                        <label class="form-label">Email <span>*</span></label>
                        <input class="form-control" id="email" name="email" type="text">
                    </div>                          
                    <button type="submit" class="btn btn-primary w-100 btn-size justify-content-center mb-3">Reset Password</button>     
                    <div class="bottom-text">
                        <p>Remember your password?  <a href="{{url('admin/login')}}">Login</a></p>
                    </div>                      
                </form>
            </div>
        </div>                
    </div>            
</div>


@endsection