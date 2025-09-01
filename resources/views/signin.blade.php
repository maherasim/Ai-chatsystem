<?php $page = 'signin'; ?> 
@extends('layout.mainlayout')
@section('content')
<link href="https://fonts.googleapis.com/css2?family=Genos:wght@400&display=swap" rel="stylesheet">

<style>
body, html {
    height: 100%;
    margin: 0;
    font-family: 'Genos', sans-serif;
}

.login-container {
    display: flex;
    height: 100vh;
    width: 100%;
}

/* LEFT PANEL */
.login-left {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255, 255, 255, 0.75);
    backdrop-filter: blur(10px);
    padding: 2rem;
}

.login-box {
    max-width: 400px;
    width: 100%;
    text-align: center;
}

.login-box img {
    max-width: 200px;
    margin-bottom: 1.5rem;
}

.login-box h2 {
    font-size: 22px;
    margin-bottom: 2rem;
    font-weight: 400;
}

/* INPUT STYLES */
.input-icon {
    position: relative;
    margin-bottom: 1rem;
}

.input-icon input {
    width: 100%;
    padding: 12px 40px 12px 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 16px;
    outline: none;
    transition: 0.3s;
}

.input-icon input:focus {
    border-color: #3d8bff;
    box-shadow: 0 0 5px rgba(61, 139, 255, 0.4);
}

.input-icon img {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    width: 20px;
    opacity: 0.6;
}
.custom-modal {
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.15);
    overflow: hidden;
}

.custom-modal .modal-header h5 {
    font-size: 20px;
    font-weight: 600;
}

.sub-header {
    color: #6c757d;
    font-size: 14px;
}

.section-title {
    font-size: 16px;
    font-weight: 600;
}

.accept-btn {
    background: #28a745;
    color: #fff;
    font-size: 16px;
    border-radius: 10px;
    transition: 0.3s;
    border: none;
}
.accept-btn:hover {
    background: #218838;
}

.footer-menu {
    display: flex;
    justify-content: space-around;
    padding: 1rem;
    border-top: 1px solid #ddd;
    background: #f9f9f9;
}
.footer-menu div {
    text-align: center;
    font-size: 13px;
}
.footer-menu img {
    width: 28px;
    margin-bottom: 5px;
}


/* BUTTON STYLE */
.login-box button {
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

.login-box button:hover {
    background: #2466cc;
}

/* RIGHT PANEL IMAGE */
.login-right {
    flex: 1;
    background: url("{{ URL::asset('/build/img/userlogo.png') }}") no-repeat center center;
    background-size: cover;
}

/* MODAL FOOTER MENU */
.footer-menu {
    display: flex;
    justify-content: space-around;
    padding: 1rem;
    border-top: 1px solid #ddd;
}
.footer-menu div {
    text-align: center;
}
.footer-menu img {
    width: 30px;
    display: block;
    margin: 0 auto 5px;
}
</style>

<div class="login-container">
    <!-- LEFT SIDE -->
    <div class="login-left">
        <div class="login-box">
            <img src="{{URL::asset('/build/img/welogo.svg')}}" alt="Logo">
            <h2 style="font-family: Genos">Let’s build tomorrow</h2>

            <form id="loginForm" action="{{ url('custom-login') }}" method="POST">
                @csrf
                <div class="input-icon">
                    <input type="text" name="user_id" placeholder="User ID" style="background-color:#ECECEC">
                    <img src="{{URL::asset('/build/img/User Circle.svg')}}" alt="">
                </div>
                <div class="input-icon">
                    <input type="email" name="email" placeholder="E-Mail" style="background-color:#ECECEC">
                    <img src="{{URL::asset('/build/img/email_icon.svg')}}" alt="">
                </div>
                <div class="input-icon">
                    <input type="password" name="password" placeholder="Password" style="background-color:#ECECEC">
                    <img src="{{URL::asset('/build/img/password_icon.svg')}}" alt="">
                </div>
                <button type="submit" id="enterBtn" style="background: #5F9CE3; color: white;width:50%">
                    ENTER
                </button>
            </form>
        </div>
    </div>

    <!-- RIGHT SIDE -->
    <div class="login-right"></div>
</div>

<!-- MODAL -->
<!-- MODAL -->
<div class="modal fade" id="policyModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content custom-modal">

            <!-- Header -->
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">Hello & Welcome</h5>
            </div>

            <!-- Sub-header -->
            <div class="px-4">
                <p class="text-muted mb-1">Admin or Developer name</p>
                <h6 class="fw-semibold mb-3">Policy and Terms</h6>
            </div>

            <!-- Body -->
            <div class="modal-body px-4" style="max-height: 350px; overflow-y:auto;">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed diam nonummy eirmod tempor
                    invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.
                </p>
                <p>
                    At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren,
                    no sea takimata sanctus est Lorem ipsum dolor sit amet.
                </p>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed diam nonummy eirmod tempor
                    invidunt ut labore et dolore magna aliquyam erat.
                </p>
            </div>

            <!-- Accept Button -->
            <div class="text-center pb-3">
            <div>
                    <img src="{{URL::asset('/build/img/accept.jpg')}}" alt="Accept Icon" style="width:30px;margin-right:10px;">
                    <span>Accept & Continue</span>
                </div>
            </div>

            <!-- Footer -->
            <div class="footer-menu footer-icons">
                <div>
                    <img src="{{URL::asset('/build/img/policy.png')}}" alt="Policy Icon">
                    <span>Policy & Terms</span>
                    <small>Our Connect.ltd Roles</small>
                </div>
                <div>
                    <img src="{{URL::asset('/build/img/agreement.png')}}" alt="Agreement Icon">
                    <span>Agreement</span>
                    <small>Our Connect.ltd Agreement</small>
                </div>
                <div>
                    <img src="{{URL::asset('/build/img/profile.png')}}" alt="Profile Icon">
                    <span>Your Profile</span>
                    <small>Our Connect.ltd Roles</small>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- SCRIPT -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("loginForm");
    const enterBtn = document.getElementById("enterBtn");
    const acceptBtn = document.getElementById("acceptPolicy");

    enterBtn.addEventListener("click", function(event) {
        event.preventDefault(); // stop form submission
        var myModal = new bootstrap.Modal(document.getElementById('policyModal'));
        myModal.show();
    });

    acceptBtn.addEventListener("click", function() {
        form.submit(); // submit after accepting policy
    });
});
</script>
@endsection
