<?php $page = 'login'; ?>
@extends('layout.mainlayout_admin')
@section('content')
<div class="container-fluid">
    <div class="login-wrapper">
        <header class="logo-header">
            <a href="{{url('admin/index_admin')}}" class="logo-brand">
                <img src="{{URL::asset('assets/img/full-logo.svg')}}" alt="Logo" class="img-fluid logo-dark">
            </a>
        </header>
        <div class="login-inbox admin-login">
            <div class="log-auth">
                <div class="login-auth-wrap">
                    <div class="login-content-head">
                        <h3>Login</h3>
                    </div>
                </div>
                <form action="{{url('admin/index_admin')}}">
                    <div class="form-group">
                        <label class="form-label">Username  <span>*</span></label>
                        <input type="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Password <span>*</span></label>
                        <div class="pass-group">
                            <input type="password" class="form-control pass-inputs">
                            <span class="fas fa-eye toggle-passwords ti ti-eye"></span>
                        </div>
                    </div>
                    <div class="form-group form-remember d-flex align-items-center justify-content-between">
                        <div class="form-check d-flex align-items-center justify-content-start ps-0">
                            <label class="custom-check mt-0 mb-0">
                                <span class="remember-me">Remember Me</span>
                                <input type="checkbox" name="remeber">                                        
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <span class="forget-pass">
                            <a href="{{url('admin/forgot-password')}}">
                                Forgot Password
                            </a>
                        </span>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 btn-size justify-content-center">Login</button>
                </form>
            </div>
        </div>                
    </div>            
</div>

@endsection