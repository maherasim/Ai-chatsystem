<?php $page = 'signin'; ?>
@extends('layout.mainlayout')
@section('content')

<style>
.img-fluid {
    max-width: 50%;
    height: auto;
}
</style>
<div class="container-fuild">
    <div class=" w-100 overflow-hidden position-relative flex-wrap d-block vh-100">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12">
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
                                            <label class="form-label">User Name</label>
                                            <div class="input-icon mb-3 position-relative">
                                                <input type="text" name="name" id="name" value="username" class="form-control">
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
           <div class="col-lg-6 p-0">
    <div class="w-100 h-100">
        <img src="{{ URL::asset('/build/img/bg/chatlogo.jpg') }}" class="w-100 h-100 object-fit-cover" alt="Chat Logo">
    </div>
</div>


        </div>



    </div>
</div>

@endsection
