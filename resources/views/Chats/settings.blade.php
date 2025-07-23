<?php $page = 'index'; ?>
@extends('layout.mainlayout')
@section('content')
<style>
    /* Ensure base styles don't interfere */
    .task-icon-link {
        position: relative;
        display: inline-block;
        width: 30px;
        height: 30px;
    }

    .task-icon-link img {
        width: 25px !important;
        height: 25px !important;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        transition: opacity 0.2s ease-in-out;
    }


    /* Stack both icons centered */
    .task-icon-link img {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        transition: opacity 0.2s ease-in-out;
        width: 16px;
        height: 16px;
    }

    /* Default: show black icon */
    .task-icon-link .icon-black {
        opacity: 1;
    }

    /* Default: hide white icon */
    .task-icon-link .icon-white {
        opacity: 0;
    }

    /* On hover (only if not active): show white icon */
    .task-icon-link:hover:not(.active) .icon-black {
        opacity: 0;
    }

    .task-icon-link:hover:not(.active) .icon-white {
        opacity: 1;
    }

    /* Active state (white icon always shown) */
    .task-icon-link.active .icon-black {
        opacity: 0;
    }

    .task-icon-link.active .icon-white {
        opacity: 1;
    }
</style>




<!-- content -->
<div class="content main_content">

    <!-- Left Sidebar Menu -->
    <div class="sidebar-menu">

        <div class="logo">
            <a href="{{ url('index') }}" class="logo-normal">
                <img src="{{ URL::asset('/build/img/AI-Logo.svg') }}" alt="Logo" style="max-width: 70% !important;">
            </a>
        </div>

        @include('Chats.chatsidebar')
    </div>
    <!-- /Left Sidebar Menu -->

    <!-- sidebar group -->
    <div class="sidebar-group">
        <div class="tab-content"  style="width: 400px; border-right:1px solid rgba(0, 0, 0, 0.002)">

            <!-- Profile sidebar -->
            <div class="sidebar-content active slimscroll">
                <div class="slimscroll">
                    <div class="chat-search-header">
                        <div class="header-title d-flex align-items-center justify-content-between">
                            <h4 class="mb-3">Settings</h4>
                        </div>

                        <!-- Settings Search -->
                        <div class="search-wrap">
                            <form action="#">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search Settings">
                                    <span class="input-group-text"><i class="ti ti-search"></i></span>
                                </div>
                            </form>
                        </div>
                        <!-- /Settings Search -->
                    </div>

                    <div class="sidebar-body chat-body">

                        <!-- Account setting -->
                        <div class="content-wrapper">
                            <h5 class="sub-title">Account</h5>
                            <div class="chat-file">
                                <div class="file-item">
                                    <div class="accordion accordion-flush chat-accordion" id="account-setting">
                                        <div class="accordion-item others">
                                            <h2 class="accordion-header">
                                                <a href="#" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#chatuser-collapse" aria-expanded="true" aria-controls="chatuser-collapse">
                                                    <i class="ti ti-user me-2"></i>Profile Info
                                                </a>
                                            </h2>
                                            <div id="chatuser-collapse" class="accordion-collapse collapse show" data-bs-parent="#account-setting">
                                                <div class="accordion-body">
                                                    <div>
                                                        <div class="d-flex justify-content-center align-items-center">
                                                            <span class="set-pro avatar avatar-xxl rounded-circle mb-3 p-1">
                                                                <img src="{{URL::asset('/build/img/profiles/avatar-16.jpg')}}" class="rounded-circle" alt="user">
                                                                <span class="add avatar avatar-sm d-flex justify-content-center align-items-center"><i class="ti ti-plus rounded-circle d-flex justify-content-center align-items-center"></i></span>
                                                            </span>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="input-icon mb-3 position-relative">
                                                                    <input type="text" value="" class="form-control" placeholder="First Name">
                                                                    <span class="icon-addon">
                                                                        <i class="ti ti-user"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="input-icon mb-3 position-relative">
                                                                    <input type="text" value="" class="form-control" placeholder="Last Name">
                                                                    <span class="icon-addon">
                                                                        <i class="ti ti-user"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="input-icon mb-3 position-relative">
                                                                    <input type="text" value="" class="form-control" placeholder="Gender">
                                                                    <span class="icon-addon">
                                                                        <i class="ti ti-user-star"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="input-icon mb-3 position-relative">
                                                                    <input type="text" value="" class="form-control datetimepicker" placeholder="Date of birth">
                                                                    <span class="icon-addon">
                                                                        <i class="ti ti-calendar-event"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="input-icon mb-3 position-relative">
                                                                    <input type="text" value="" class="form-control" placeholder="Country">
                                                                    <span class="icon-addon">
                                                                        <i class="ti ti-map-2"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="form-item d-flex justify-content-between mb-3">
                                                                    <textarea class="form-control" placeholder="About" rows="3"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 d-flex">
                                                                <a href="javascript:void(0);" class="btn btn-primary flex-fill"><i class="ti ti-device-floppy me-2"></i>Save Changes</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item others mb-3">
                                            <h2 class="accordion-header">
                                                <a href="#" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#social-id" aria-expanded="false" aria-controls="social-id">
                                                    <i class="ti ti-social me-2"></i>Social Profiles
                                                </a>
                                            </h2>
                                            <div id="social-id" class="accordion-collapse collapse" data-bs-parent="#account-setting">
                                                <div class="accordion-body">
                                                    <div class="chat-video">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="input-icon mb-3 position-relative">
                                                                    <input type="text" value="" class="form-control" placeholder="Facebook">
                                                                    <span class="icon-addon">
                                                                        <i class="ti ti-brand-facebook"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="input-icon mb-3 position-relative">
                                                                    <input type="text" value="" class="form-control" placeholder="Google">
                                                                    <span class="icon-addon">
                                                                        <i class="ti ti-brand-google"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="input-icon mb-3 position-relative">
                                                                    <input type="text" value="" class="form-control" placeholder="Twitter">
                                                                    <span class="icon-addon">
                                                                        <i class="ti ti-brand-twitter"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="input-icon mb-3 position-relative">
                                                                    <input type="text" value="" class="form-control" placeholder="Linkedin">
                                                                    <span class="icon-addon">
                                                                        <i class="ti ti-brand-linkedin"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="input-icon mb-3 position-relative">
                                                                    <input type="text" value="" class="form-control" placeholder="youtube">
                                                                    <span class="icon-addon">
                                                                        <i class="ti ti-brand-youtube"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 d-flex">
                                                                <a href="javascript:void(0);" class="btn btn-primary flex-fill"><i class="ti ti-device-floppy me-2"></i>Save Changes</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h6 class="fs-14"><a href="javascript:void(0);"><i class="ti ti-lock-square text-gray me-2"></i>Screen Lock</a></h6>
                                            <div class="form-check form-switch d-flex justify-content-end align-items-center">
                                                <input class="form-check-input" type="checkbox" role="switch">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Account setting -->

                        <!-- Security setting -->
                        <div class="content-wrapper">
                            <h5 class="sub-title">Security</h5>
                            <div class="chat-file">
                                <div class="file-item">
                                    <div class="accordion accordion-flush chat-accordion" id="pwd-setting">
                                        <div class="accordion-item others mb-3">
                                            <h2 class="accordion-header">
                                                <a href="#" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#set-pwd" aria-expanded="false" aria-controls="set-pwd">
                                                    <i class="ti ti-key me-2"></i>Password
                                                </a>
                                            </h2>
                                            <div id="set-pwd" class="accordion-collapse collapse" data-bs-parent="#pwd-setting">
                                                <div class="accordion-body">
                                                    <div class="">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="input-icon mb-3">
                                                                    <input type="password" class="pass-input form-control" placeholder="Old Password">
                                                                    <span class="ti toggle-password ti-eye-off"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="input-icon mb-3">
                                                                    <input type="password" class="pass-inputs form-control" placeholder="New Password">
                                                                    <span class="ti toggle-passwords ti-eye-off"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="input-icon mb-3">
                                                                    <input type="password" class="conform-pass-input form-control" placeholder="Confirmed Password">
                                                                    <span class="ti conform-toggle-password ti-eye-off"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 d-flex">
                                                                <a href="javascript:void(0);" class="btn btn-primary flex-fill"><i class="ti ti-device-floppy me-2"></i>Save Changes</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h6 class="fs-14"><a href="javascript:void(0);"><i class="ti ti-shield text-gray me-2"></i>Two Factor Authentication</a></h6>
                                            <div class="form-check form-switch d-flex justify-content-end align-items-center">
                                                <input class="form-check-input" type="checkbox" role="switch">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Security setting -->

                        <!-- Privacy setting -->
                        <div class="content-wrapper">
                            <h5 class="sub-title">Privacy</h5>
                            <div class="chat-file">
                                <div class="file-item ">
                                    <div class="accordion accordion-flush chat-accordion" id="privacy-setting">
                                        <div class="mb-3">
                                            <div class="accordion-item border-0 border-bottom">
                                                <h2 class="accordion-header others">
                                                    <a href="#" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#chatuser-collapse3" aria-expanded="true" aria-controls="chatuser-collapse3">
                                                        <i class="ti ti-mood-smile me-2"></i>Profile Info
                                                    </a>
                                                </h2>
                                                <div id="chatuser-collapse3" class="accordion-collapse collapse " data-bs-parent="#privacy-setting">
                                                    <div class="accordion-body">
                                                        <div>
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <select class="form-select">
                                                                        <option>Everyone</option>
                                                                        <option>Except</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item border-0 border-bottom">
                                                <h2 class="accordion-header others">
                                                    <a href="#" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#chatuser-collapse3-1" aria-expanded="true" aria-controls="chatuser-collapse3-1">
                                                        <i class="ti ti-eye me-2"></i>Last Seen
                                                    </a>
                                                </h2>
                                                <div id="chatuser-collapse3-1" class="accordion-collapse collapse " data-bs-parent="#privacy-setting">
                                                    <div class="accordion-body">
                                                        <div>
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <select class="form-select">
                                                                        <option>Everyone</option>
                                                                        <option>Except</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item border-0 border-bottom">
                                                <h2 class="accordion-header others">
                                                    <a href="#" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#chatuser-collapse3-2" aria-expanded="true" aria-controls="chatuser-collapse3-2">
                                                        <i class="ti ti-users-group me-2"></i>Groups
                                                    </a>
                                                </h2>
                                                <div id="chatuser-collapse3-2" class="accordion-collapse collapse " data-bs-parent="#privacy-setting">
                                                    <div class="accordion-body">
                                                        <div>
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <select class="form-select">
                                                                        <option>Everyone</option>
                                                                        <option>Except</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item border-0 border-bottom">
                                                <h2 class="accordion-header others">
                                                    <a href="#" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#chatuser-collapse3-3" aria-expanded="true" aria-controls="chatuser-collapse3-3">
                                                        <i class="ti ti-circle-dot me-2"></i>Status
                                                    </a>
                                                </h2>
                                                <div id="chatuser-collapse3-3" class="accordion-collapse collapse " data-bs-parent="#privacy-setting">
                                                    <div class="accordion-body">
                                                        <div>
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <select class="form-select mb-3">
                                                                        <option>Everyone</option>
                                                                        <option>Except</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-lg-12 d-flex">
                                                                    <a href="javascript:void(0);" class="btn btn-primary flex-fill"><i class="ti ti-device-floppy me-2"></i>Save Changes</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h6 class="fs-14"><a href="javascript:void(0);"><i class="ti ti-checks text-gray me-2"></i>Read Receipients</a></h6>
                                            <div class="form-check form-switch d-flex justify-content-end align-items-center">
                                                <input class="form-check-input" type="checkbox" role="switch">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Privacy setting -->

                        <!-- Chat setting -->
                        <div class="content-wrapper">
                            <h5 class="sub-title">Chat</h5>
                            <div class="chat-file">
                                <div class="file-item ">
                                    <div class="accordion accordion-flush chat-accordion" id="chat-setting">
                                        <div class="border-0 profile-list mb-3">
                                            <div class="accordion-item border-0 border-bottom">
                                                <h2 class="accordion-header border-0">
                                                    <a href="#" class="accordion-button border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#chatuser-collapse4" aria-expanded="true" aria-controls="chatuser-collapse4">
                                                        <i class="ti ti-photo me-2"></i>Background Images
                                                    </a>
                                                </h2>
                                                <div id="chatuser-collapse4" class="accordion-collapse border-0 collapse " data-bs-parent="#chat-setting">
                                                    <div class="accordion-body border-0 pb-0">
                                                        <div class="chat-user-photo">
                                                            <div class="chat-img contact-gallery mb-3">
                                                                <div class="img-wrap">
                                                                    <img src="{{URL::asset('/build/img/gallery/gallery-01.jpg')}}" alt="img">
                                                                    <div class="img-overlay-1">
                                                                        <a class="gallery-img" href="{{URL::asset('/build/imggallery/gallery-01.jpg')}}" title="Demo 01"></a>
                                                                        <span class="check-icon avatar avatar-md d-flex justify-content-center align-items-center">
                                                                            <i class="ti ti-check  d-flex justify-content-center align-items-center"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="img-wrap">
                                                                    <img src="{{URL::asset('/build/img/gallery/gallery-02.jpg')}}" alt="img">
                                                                    <div class="img-overlay-1">
                                                                        <a class="gallery-img" href="{{URL::asset('/build/img/gallery/gallery-02.jpg')}}" title="Demo 02"></a>
                                                                        <span class="check-icon avatar avatar-md d-flex justify-content-center align-items-center">
                                                                            <i class="ti ti-check  d-flex justify-content-center align-items-center"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="img-wrap">
                                                                    <img src="{{URL::asset('/build/img/gallery/gallery-03.jpg')}}" alt="img">
                                                                    <div class="img-overlay-1">
                                                                        <a class="gallery-img" href="{{URL::asset('/build/img/gallery/gallery-03.jpg')}}" title="Demo 03"></a>
                                                                        <span class="check-icon avatar avatar-md d-flex justify-content-center align-items-center">
                                                                            <i class="ti ti-check  d-flex justify-content-center align-items-center"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="img-wrap">
                                                                    <img src="{{URL::asset('/build/img/gallery/gallery-04.jpg')}}" alt="img">
                                                                    <div class="img-overlay-1">
                                                                        <a class="gallery-img" href="{{URL::asset('/build/img/gallery/gallery-04.jpg')}}" title="Demo 04"></a>
                                                                        <span class="check-icon avatar avatar-md d-flex justify-content-center align-items-center">
                                                                            <i class="ti ti-check  d-flex justify-content-center align-items-center"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="img-wrap">
                                                                    <img src="{{URL::asset('/build/img/gallery/gallery-05.jpg')}}" alt="img">
                                                                    <div class="img-overlay-1">
                                                                        <a class="gallery-img" href="{{URL::asset('/build/img/gallery/gallery-05.jpg')}}" title="Demo 04"></a>
                                                                        <span class="check-icon avatar avatar-md d-flex justify-content-center align-items-center">
                                                                            <i class="ti ti-check  d-flex justify-content-center align-items-center"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="img-wrap">
                                                                    <img src="{{URL::asset('/build/img/gallery/gallery-06.jpg')}}" alt="img">
                                                                    <div class="img-overlay-1">
                                                                        <a class="gallery-img" href="{{URL::asset('/build/img/gallery/gallery-06.jpg')}}" title="Demo 04"></a>
                                                                        <span class="check-icon avatar avatar-md d-flex justify-content-center align-items-center">
                                                                            <i class="ti ti-check  d-flex justify-content-center align-items-center"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="img-wrap">
                                                                    <img src="{{URL::asset('/build/img/gallery/gallery-07.jpg')}}" alt="img">
                                                                    <div class="img-overlay-1">
                                                                        <a class="gallery-img" href="{{URL::asset('/build/img/gallery/gallery-07.jpg')}}" title="Demo 04"></a>
                                                                        <span class="check-icon avatar avatar-md d-flex justify-content-center align-items-center">
                                                                            <i class="ti ti-check  d-flex justify-content-center align-items-center"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="img-wrap">
                                                                    <img src="{{URL::asset('/build/img/gallery/gallery-08.jpg')}}" alt="img">
                                                                    <div class="img-overlay-1">
                                                                        <a class="gallery-img" href="{{URL::asset('/build/img/gallery/gallery-08.jpg')}}" title="Demo 04"></a>
                                                                        <span class="check-icon avatar avatar-md d-flex justify-content-center align-items-center">
                                                                            <i class="ti ti-check  d-flex justify-content-center align-items-center"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 d-flex">
                                                                <a href="javascript:void(0);" class="btn btn-primary flex-fill mb-3"><i class="ti ti-device-floppy me-2"></i>Save Changes</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between profile-list align-items-center border-bottom pb-3 mb-3">
                                            <h6 class="fs-14"><a href="javascript:void(0);"><i class="ti ti-clear-all text-gray me-2 "></i>Clear All Chat</a></h6>
                                            <div class="form-check form-switch d-flex justify-content-end align-items-center">
                                                <input class="form-check-input" type="checkbox" role="switch">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center profile-list border-bottom pb-3 mb-3">
                                            <h6 class="fs-14"><a href="javascript:void(0);"><i class="ti ti-trash text-gray me-2 "></i>Delete All Chat</a></h6>
                                            <div class="form-check form-switch d-flex justify-content-end align-items-center">
                                                <input class="form-check-input" type="checkbox" role="switch">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h6 class="fs-14"><a href="javascript:void(0);"><i class="ti ti-restore text-gray me-2 "></i>Chat Backup</a></h6>
                                            <div class="form-check form-switch d-flex justify-content-end align-items-center">
                                                <input class="form-check-input" type="checkbox" role="switch">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- /Chat setting -->

                        <!-- Notification setting -->
                        <div class="content-wrapper">
                            <h5 class="sub-title">Notifications</h5>
                            <div class="chat-file">
                                <div class="file-item ">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center profile-list border-bottom pb-3 mb-3">
                                                <h6 class="fs-14"><a href="javascript:void(0);"><i class="ti ti-message text-gray me-2 "></i>Message Notifications</a></h6>
                                                <div class="form-check form-switch d-flex justify-content-end align-items-center">
                                                    <input class="form-check-input" type="checkbox" role="switch">
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center profile-list border-bottom pb-3 mb-3">
                                                <h6 class="fs-14"><a href="javascript:void(0);"><i class="ti ti-trash text-gray me-2 "></i>Show Previews</a></h6>
                                                <div class="form-check form-switch d-flex justify-content-end align-items-center">
                                                    <input class="form-check-input" type="checkbox" role="switch">
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center profile-list border-bottom pb-3 mb-3">
                                                <h6 class="fs-14"><a href="javascript:void(0);"><i class="ti ti-mood-smile text-gray me-2 "></i>Show Reaction Notifications</a></h6>
                                                <div class="form-check form-switch d-flex justify-content-end align-items-center">
                                                    <input class="form-check-input" type="checkbox" role="switch">
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center ">
                                                <h6 class="fs-14"><a href="javascript:void(0);"><i class="ti ti-bell-ringing text-gray me-2 "></i>Notification Sound</a></h6>
                                                <div class="form-check form-switch d-flex justify-content-end align-items-center">
                                                    <input class="form-check-input" type="checkbox" role="switch">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Notification setting -->

                        <!-- Language setting -->


                    </div>

                </div>

            </div>
            <!-- / Chats sidebar -->
        </div>
    </div>
    <!-- /Sidebar group -->

    <!-- Chat -->


    <div class="chat-screen d-flex justify-content-center align-items-center vh-100 w-100 bg-body">
        <div class="chatbox-input-container w-100 px-4" style="max-width: 1000px;">
            <div class="chatbox-wrapper d-flex align-items-center bg-white border rounded-5 shadow-sm px-4 py-3">
                <input type="text" class="form-control border-0 bg-transparent fs-4 me-3" placeholder="Ask anything..." aria-label="Ask anything" style="min-height: 60px;">
                <button class="btn btn-light btn-icon rounded-circle me-2" type="button" title="Voice" style="width: 50px; height: 50px;">
                    <i class="ti ti-microphone text-muted fs-3"></i>
                </button>
                <button class="btn btn-primary btn-icon rounded-circle" type="button" title="Send" style="width: 50px; height: 50px;">
                    <i class="ti ti-send text-white fs-3"></i>
                </button>
            </div>
        </div>
    </div>



</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>




<!-- Bootstrap JS Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@component('components.model-popup')
@endcomponent
@endsection