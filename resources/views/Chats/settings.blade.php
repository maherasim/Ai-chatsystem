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


    @include('Chats.chatsidebar')

    <!-- /Left Sidebar Menu -->

    <!-- sidebar group -->
    <div class="sidebar-group">
        <div class="tab-content" style="width: 400px; border-right:1px solid rgba(0, 0, 0, 0.002)">

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
                                                                    <input type="text" value="" class="form-control datetimepicker" placeholder="Date of birth">
                                                                    <span class="icon-addon">
                                                                        <i class="ti ti-calendar-event"></i>
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

                                        <!-- Email -->
                                        <div class="accordion-item others">
                                            <h2 class="accordion-header">
                                                <a href="#" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#set-email" aria-expanded="false" aria-controls="set-email">
                                                    <i class="ti ti-mail me-2"></i>Email
                                                </a>
                                            </h2>
                                            <div id="set-email" class="accordion-collapse collapse" data-bs-parent="#pwd-setting">
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text"><i class="ti ti-mail"></i></span>
                                                                <input type="email" class="form-control" placeholder="Old Email">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text"><i class="ti ti-mail-check"></i></span>
                                                                <input type="email" class="form-control" placeholder="New Email">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 d-flex">
                                                            <a href="javascript:void(0);" class="btn btn-primary flex-fill">
                                                                <i class="ti ti-device-floppy me-2"></i>Save Changes
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Email -->

                                        <!-- Password -->
                                        <div class="accordion-item others mb-3">
                                            <h2 class="accordion-header">
                                                <a href="#" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#set-password" aria-expanded="false" aria-controls="set-password">
                                                    <i class="ti ti-lock me-2"></i>Password
                                                </a>
                                            </h2>
                                            <div id="set-password" class="accordion-collapse collapse" data-bs-parent="#pwd-setting">
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="input-icon mb-3 position-relative">
                                                                <input type="password" class="form-control" placeholder="Old Password">
                                                                <span class="ti toggle-password ti-eye-off position-absolute end-0 top-50 translate-middle-y me-3"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="input-icon mb-3 position-relative">
                                                                <input type="password" class="form-control" placeholder="New Password">
                                                                <span class="ti toggle-passwords ti-eye-off position-absolute end-0 top-50 translate-middle-y me-3"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="input-icon mb-3 position-relative">
                                                                <input type="password" class="form-control" placeholder="Confirm Password">
                                                                <span class="ti conform-toggle-password ti-eye-off position-absolute end-0 top-50 translate-middle-y me-3"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 d-flex">
                                                            <a href="javascript:void(0);" class="btn btn-primary flex-fill">
                                                                <i class="ti ti-device-floppy me-2"></i>Save Changes
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Password -->

                                        <!-- Screen Lock -->
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <h6 class="fs-14">
                                                <a href="javascript:void(0);">
                                                    <i class="ti ti-lock-square text-gray me-2"></i>Screen Lock
                                                </a>
                                            </h6>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch">
                                            </div>
                                        </div>

                                        <!-- Divider after Screen Lock -->
                                        <div class="border-top my-3"></div>

                                        <!-- Two-Factor Auth -->
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6 class="fs-14">
                                                <a href="javascript:void(0);">
                                                    <i class="ti ti-shield text-gray me-2"></i>Two Factor Authentication
                                                </a>
                                            </h6>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch">
                                            </div>
                                        </div>

                                        <!-- Divider after Two-Factor -->
                                        <div class="border-top mt-3"></div>


                                        <!-- Profile Info -->
                                        <div class="accordion-item border-0 border-bottom">
                                            <h2 class="accordion-header others">
                                                <a href="#" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#chatuser-collapse3" aria-expanded="false" aria-controls="chatuser-collapse3">
                                                    <i class="ti ti-mood-smile me-2"></i>Profile Info
                                                </a>
                                            </h2>
                                            <div id="chatuser-collapse3" class="accordion-collapse collapse" data-bs-parent="#pwd-setting">
                                                <div class="accordion-body">
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
                                        <!-- /Profile Info -->

                                       

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Security setting -->




                        <!-- App setting -->
                        <div class="content-wrapper">
                            <h5 class="sub-title">App Setting</h5>
                            <div class="chat-file">
                                <div class="file-item ">
                                    <div class="accordion accordion-flush chat-accordion" id="privacy-setting">
                                        <div class="mb-3">
                                            <!-- chat bg -->
                                            <div class="border-0 profile-list">
                                                <div class="accordion-item border-0 border-bottom">
                                                    <h2 class="accordion-header border-0">
                                                        <a href="#" class="accordion-button border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#chatuser-collapse4" aria-expanded="true" aria-controls="chatuser-collapse4">
                                                            <i class="ti ti-photo me-2"></i>Chats Background
                                                        </a>
                                                    </h2>
                                                     <h2 class="accordion-header border-0">
                                                        <a href="#" class="accordion-button border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#chatuser-collapse4" aria-expanded="true" aria-controls="chatuser-collapse4">
                                                            <i class="ti ti-photo me-2"></i>Login Background
                                                        </a>
                                                    </h2>
                                                    <div id="chatuser-collapse4" class="accordion-collapse border-0 collapse " data-bs-parent="#chat-setting">
                                                        <div class="accordion-body border-0 pb-0">
                                                            <div class="chat-user-photo">
                                                                <div class="chat-img contact-gallery mb-3">
                                                                    <!-- Container for all 6 boxes -->


                                                                    <!-- Loop starts -->
                                                                    <!-- Box 1 -->
                                                                    <div class="img-wrap" style="position: relative; width: 200px; height: 120px; overflow: hidden; border: 1px solid #ccc; border-radius: 10px;">
                                                                        <img id="previewImage1" src="{{ URL::asset('/build/img/gallery/gallery-01.jpg') }}" alt="img"
                                                                            style="width: 100%; height: 100%; object-fit: cover; border-radius: 10px;">
                                                                        <div class="img-overlay-1"
                                                                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;
                   background: rgba(0, 0, 0, 0.4); display: flex; align-items: center; 
                   justify-content: center; opacity: 0; transition: opacity 0.3s ease-in-out; border-radius: 10px;"
                                                                            onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0'">
                                                                            <a href="javascript:void(0);" onclick="document.getElementById('imageUpload1').click();"
                                                                                style="text-decoration: none; font-size: 40px; color: #007bff;">+</a>
                                                                        </div>
                                                                    </div>
                                                                    <input type="file" id="imageUpload1" accept=".jpg,.jpeg,.svg"
                                                                        onchange="handleImageUpload(event, 'previewImage1', ['image/jpeg','image/jpg','image/svg+xml'])"
                                                                        style="display: none;">


                                                                    <!-- Box 2 -->
                                                                    <div class="img-wrap" style="position: relative; width: 200px; height: 120px; overflow: hidden; border: 1px solid #ccc; border-radius: 10px;">
                                                                        <img id="previewImage2" src="{{ URL::asset('/build/img/gallery/gallery-01.jpg') }}" alt="img"
                                                                            style="width: 100%; height: 100%; object-fit: cover; border-radius: 10px;">
                                                                        <div class="img-overlay-1" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.4); display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s ease-in-out; border-radius: 10px;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0'">
                                                                            <a href="javascript:void(0);" onclick="document.getElementById('imageUpload2').click();" style="text-decoration: none; font-size: 40px; color: #007bff;">+</a>
                                                                        </div>
                                                                    </div>
                                                                    <input type="file" id="imageUpload2" accept=".jpg,.jpeg,.svg"
                                                                        onchange="handleImageUpload(event, 'previewImage2', ['image/jpeg','image/jpg','image/svg+xml'])"
                                                                        style="display: none;">

                                                                    <!-- Box 3 -->
                                                                    <div class="img-wrap" style="position: relative; width: 200px; height: 120px; overflow: hidden; border: 1px solid #ccc; border-radius: 10px;">
                                                                        <img id="previewImage3" src="{{ URL::asset('/build/img/gallery/gallery-01.jpg') }}" alt="img"
                                                                            style="width: 100%; height: 100%; object-fit: cover; border-radius: 10px;">
                                                                        <div class="img-overlay-1" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.4); display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s ease-in-out; border-radius: 10px;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0'">
                                                                            <a href="javascript:void(0);" onclick="document.getElementById('imageUpload3').click();" style="text-decoration: none; font-size: 40px; color: #007bff;">+</a>
                                                                        </div>
                                                                    </div>
                                                                    <input type="file" id="imageUpload3" accept=".jpg,.jpeg,.svg"
                                                                        onchange="handleImageUpload(event, 'previewImage3', ['image/jpeg','image/jpg','image/svg+xml'])"
                                                                        style="display: none;">

                                                                    <!-- Box 4 -->
                                                                    <div class="img-wrap" style="position: relative; width: 200px; height: 120px; overflow: hidden; border: 1px solid #ccc; border-radius: 10px;">
                                                                        <img id="previewImage4" src="{{ URL::asset('/build/img/gallery/gallery-01.jpg') }}" alt="img"
                                                                            style="width: 100%; height: 100%; object-fit: cover; border-radius: 10px;">
                                                                        <div class="img-overlay-1" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.4); display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s ease-in-out; border-radius: 10px;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0'">
                                                                            <a href="javascript:void(0);" onclick="document.getElementById('imageUpload4').click();" style="text-decoration: none; font-size: 40px; color: #007bff;">+</a>
                                                                        </div>
                                                                    </div>
                                                                    <input type="file" id="imageUpload4" accept=".jpg,.jpeg,.svg"
                                                                        onchange="handleImageUpload(event, 'previewImage4', ['image/jpeg','image/jpg','image/svg+xml'])"
                                                                        style="display: none;">

                                                                    <!-- Box 5 -->
                                                                    <div class="img-wrap" style="position: relative; width: 200px; height: 120px; overflow: hidden; border: 1px solid #ccc; border-radius: 10px;">
                                                                        <img id="previewImage5" src="{{ URL::asset('/build/img/gallery/gallery-01.jpg') }}" alt="img"
                                                                            style="width: 100%; height: 100%; object-fit: cover; border-radius: 10px;">
                                                                        <div class="img-overlay-1" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.4); display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s ease-in-out; border-radius: 10px;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0'">
                                                                            <a href="javascript:void(0);" onclick="document.getElementById('imageUpload5').click();" style="text-decoration: none; font-size: 40px; color: #007bff;">+</a>
                                                                        </div>
                                                                    </div>
                                                                    <input type="file" id="imageUpload5" accept=".jpg,.jpeg,.svg"
                                                                        onchange="handleImageUpload(event, 'previewImage5', ['image/jpeg','image/jpg','image/svg+xml'])"
                                                                        style="display: none;">

                                                                    <!-- Box 6 -->
                                                                    <div class="img-wrap" style="position: relative; width: 200px; height: 120px; overflow: hidden; border: 1px solid #ccc; border-radius: 10px;">
                                                                        <img id="previewImage6" src="{{ URL::asset('/build/img/gallery/gallery-01.jpg') }}" alt="img"
                                                                            style="width: 100%; height: 100%; object-fit: cover; border-radius: 10px;">
                                                                        <div class="img-overlay-1" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.4); display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s ease-in-out; border-radius: 10px;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0'">
                                                                            <a href="javascript:void(0);" onclick="document.getElementById('imageUpload6').click();" style="text-decoration: none; font-size: 40px; color: #007bff;">+</a>
                                                                        </div>
                                                                    </div>
                                                                    <input type="file" id="imageUpload6" accept=".jpg,.jpeg,.svg"
                                                                        onchange="handleImageUpload(event, 'previewImage6', ['image/jpeg','image/jpg','image/svg+xml'])"
                                                                        style="display: none;">




                                                                </div>
                                                                <div class="col-lg-12 d-flex">
                                                                    <a href="javascript:void(0);" class="btn btn-primary flex-fill mb-3"><i class="ti ti-device-floppy me-2"></i>Save Changes</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /chat bg -->
                                            <!-- App Logo -->
                                            <div class="border-0 profile-list">
                                                <div class="accordion-item border-0 border-bottom">
                                                    <h2 class="accordion-header border-0">
                                                        <a href="#" class="accordion-button border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#app-logo-collapse" aria-expanded="false" aria-controls="app-logo-collapse">
                                                            <i class="ti ti-photo me-2"></i>App Logo
                                                        </a>
                                                    </h2>
                                                    <div id="app-logo-collapse" class="accordion-collapse border-0 collapse" data-bs-parent="#chat-setting">
                                                        <div class="accordion-body border-0 pb-0">
                                                            <div class="chat-user-photo">
                                                                <div class="chat-img contact-gallery mb-3">
                                                                    <!-- App Logo Box -->
                                                                    <div class="img-wrap" style="position: relative; width: 200px; height: 120px; overflow: hidden; border: 1px solid #ccc; border-radius: 10px;">
                                                                        <img id="previewAppLogo" src="{{ URL::asset('/build/img/gallery/gallery-01.jpg') }}" alt="App Logo"
                                                                            style="width: 100%; height: 100%; object-fit: cover; border-radius: 10px;">
                                                                        <div class="img-overlay-1"
                                                                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;
                                       background: rgba(0, 0, 0, 0.4); display: flex; align-items: center; 
                                       justify-content: center; opacity: 0; transition: opacity 0.3s ease-in-out; border-radius: 10px;"
                                                                            onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0'">
                                                                            <a href="javascript:void(0);" onclick="document.getElementById('uploadAppLogo').click();"
                                                                                style="text-decoration: none; font-size: 40px; color: #007bff;">+</a>
                                                                        </div>
                                                                    </div>
                                                                    <input type="file" id="uploadAppLogo" accept=".png,.svg" style="display:none"
                                                                        onchange="handleImageUpload(event, 'previewAppLogo', ['image/png', 'image/svg+xml'])">
                                                                </div>

                                                                <div class="col-lg-12 d-flex">
                                                                    <a href="javascript:void(0);" class="btn btn-primary flex-fill mb-3">
                                                                        <i class="ti ti-device-floppy me-2"></i>Save Changes
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- URL Favicon -->
                                            <div class="border-0 profile-list">
                                                <div class="accordion-item border-0 border-bottom">
                                                    <h2 class="accordion-header border-0">
                                                        <a href="#" class="accordion-button border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#url-favicon-collapse" aria-expanded="false" aria-controls="url-favicon-collapse">
                                                            <i class="ti ti-photo me-2"></i>URL FavIcon
                                                        </a>
                                                    </h2>
                                                    <div id="url-favicon-collapse" class="accordion-collapse border-0 collapse" data-bs-parent="#chat-setting">
                                                        <div class="accordion-body border-0 pb-0">
                                                            <div class="chat-user-photo">
                                                                <div class="chat-img contact-gallery mb-3">
                                                                    <!-- Favicon Box -->
                                                                    <div class="img-wrap" style="position: relative; width: 200px; height: 120px; overflow: hidden; border: 1px solid #ccc; border-radius: 10px;">
                                                                        <img id="previewFavIcon" src="{{ URL::asset('/build/img/gallery/gallery-01.jpg') }}" alt="Favicon"
                                                                            style="width: 100%; height: 100%; object-fit: cover; border-radius: 10px;">
                                                                        <div class="img-overlay-1"
                                                                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;
                                       background: rgba(0, 0, 0, 0.4); display: flex; align-items: center; 
                                       justify-content: center; opacity: 0; transition: opacity 0.3s ease-in-out; border-radius: 10px;"
                                                                            onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0'">
                                                                            <a href="javascript:void(0);" onclick="document.getElementById('uploadFavIcon').click();"
                                                                                style="text-decoration: none; font-size: 40px; color: #007bff;">+</a>
                                                                        </div>
                                                                    </div>
                                                                    <input type="file" id="uploadFavIcon" accept=".svg,.png"
                                                                        style="display: none;"
                                                                        onchange="handleImageUpload(event, 'previewFavIcon', ['image/svg+xml', 'image/png'])">

                                                                </div>

                                                                <div class="col-lg-12 d-flex">
                                                                    <a href="javascript:void(0);" class="btn btn-primary flex-fill mb-3">
                                                                        <i class="ti ti-device-floppy me-2"></i>Save Changes
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- App Title -->
                                            <div class="border-0 profile-list">
                                                <div class="accordion-item border-0 border-bottom">
                                                    <h2 class="accordion-header border-0">
                                                        <a href="#" class="accordion-button border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#url-app-collapse" aria-expanded="false" aria-controls="url-app-collapse">
                                                            <i class="ti ti-photo me-2"></i>App Title
                                                        </a>
                                                    </h2>
                                                    <div id="url-app-collapse" class="accordion-collapse border-0 collapse" data-bs-parent="#chat-setting">
                                                        <div class="accordion-body border-0 pb-0">
                                                            <div class="form-group mb-3">
                                                                <label for="app_name" class="form-label">App Name</label>
                                                                <input type="text" class="form-control" id="app_name" name="app_name" placeholder="Enter App Name">
                                                            </div>

                                                            <div class="col-lg-12 d-flex">
                                                                <a href="javascript:void(0);" class="btn btn-primary flex-fill mb-3">
                                                                    <i class="ti ti-device-floppy me-2"></i>Save Changes
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /apps Title-->

                                            <div class="file-item ">

                                                <div class="card-body">
                                                    <!-- Message Notification Sounds -->
                                                    <div class="border-0 profile-list pb-1 mb-1">
                                                        <div class="accordion-item border-0 border-bottom">
                                                            <h2 class="accordion-header border-0">
                                                                <button class="accordion-button border-0 collapsed px-0" type="button"
                                                                    data-bs-toggle="collapse" data-bs-target="#message-sound-collapse"
                                                                    aria-expanded="false" aria-controls="message-sound-collapse">
                                                                    <i class="ti ti-message me-2"></i>Message Notifications
                                                                </button>
                                                            </h2>
                                                            <div id="message-sound-collapse" class="accordion-collapse border-0 collapse" data-bs-parent="#chat-setting">
                                                                <div class="accordion-body border-0 pb-0">
                                                                    <div class="row">
                                                                        <!-- Sound 1 -->
                                                                        <div class="col-6 mb-3">
                                                                            <div class="sound-box position-relative p-3 border rounded text-center" style="cursor: pointer;">
                                                                                <strong>Ding</strong>
                                                                                <audio id="ding-audio" src="{{ URL::asset('/sounds/ding.mp3') }}"></audio>
                                                                                <span class="check-icon avatar avatar-md d-flex justify-content-center align-items-center position-absolute top-0 end-0 m-1 d-none">
                                                                                    <i class="ti ti-check"></i>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                        <!-- Sound 2 -->
                                                                        <div class="col-6 mb-3">
                                                                            <div class="sound-box position-relative p-3 border rounded text-center" style="cursor: pointer;">
                                                                                <strong>Pop</strong>
                                                                                <audio id="pop-audio" src="{{ URL::asset('/sounds/pop.mp3') }}"></audio>
                                                                                <span class="check-icon avatar avatar-md d-flex justify-content-center align-items-center position-absolute top-0 end-0 m-1 d-none">
                                                                                    <i class="ti ti-check"></i>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                        <!-- Sound 3 -->
                                                                        <div class="col-6 mb-3">
                                                                            <div class="sound-box position-relative p-3 border rounded text-center" style="cursor: pointer;">
                                                                                <strong>Bell</strong>
                                                                                <audio id="bell-audio" src="{{ URL::asset('/sounds/bell.mp3') }}"></audio>
                                                                                <span class="check-icon avatar avatar-md d-flex justify-content-center align-items-center position-absolute top-0 end-0 m-1 d-none">
                                                                                    <i class="ti ti-check"></i>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                        <!-- Sound 4 -->
                                                                        <div class="col-6 mb-3">
                                                                            <div class="sound-box position-relative p-3 border rounded text-center" style="cursor: pointer;">
                                                                                <strong>Chime</strong>
                                                                                <audio id="chime-audio" src="{{ URL::asset('/sounds/chime.mp3') }}"></audio>
                                                                                <span class="check-icon avatar avatar-md d-flex justify-content-center align-items-center position-absolute top-0 end-0 m-1 d-none">
                                                                                    <i class="ti ti-check"></i>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-12 d-flex">
                                                                        <a href="javascript:void(0);" class="btn btn-primary flex-fill mb-3">
                                                                            <i class="ti ti-device-floppy me-2"></i>Save Changes
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    {{-- <div class="d-flex justify-content-between align-items-center profile-list border-bottom pt-2 pb-3 mb-2">
                                                        <h6 class="fs-14"><a href="javascript:void(0);"><i class="ti ti-trash text-gray me-2 "></i>Show Previews</a></h6>
                                                        <div class="form-check form-switch d-flex justify-content-end align-items-center">
                                                            <input class="form-check-input" type="checkbox" role="switch">
                                                        </div>
                                                    </div> --}}
                                                    <!-- show reaction -->
                                                    <div class="d-flex justify-content-between align-items-center profile-list border-bottom pt-2 pb-3 mb-1">
                                                        <h6 class="fs-14"><a href="javascript:void(0);"><i class="ti ti-mood-smile text-gray me-2 "></i>Show Reaction Notifications</a></h6>
                                                        <div class="form-check form-switch d-flex justify-content-end align-items-center">
                                                            <input class="form-check-input" type="checkbox" role="switch">
                                                        </div>
                                                    </div>
                                                    <!-- /show reaction -->
                                                    <!-- /notification sound -->
                                                    <div class="border-0 profile-list ">
                                                        <div class="accordion-item border-0 ">
                                                            <h2 class="accordion-header border-0">
                                                                <button class="accordion-button border-0 collapsed px-0" type="button"
                                                                    data-bs-toggle="collapse" data-bs-target="#notification-sound-collapse"
                                                                    aria-expanded="false" aria-controls="notification-sound-collapse">
                                                                    <i class="ti ti-bell-ringing text-gray me-2"></i> Notification Sound
                                                                </button>
                                                            </h2>
                                                            <div id="notification-sound-collapse" class="accordion-collapse border-0 collapse" data-bs-parent="#chat-setting">
                                                                <div class="accordion-body border-0 pb-0">
                                                                    <div class="row">
                                                                        <!-- Sound 1 -->
                                                                        <div class="col-6 mb-3">
                                                                            <div class="sound-box position-relative p-3 border rounded text-center" style="cursor: pointer;">
                                                                                <strong>Ding</strong>
                                                                                <audio id="ding-audio" src="{{ URL::asset('/sounds/ding.mp3') }}"></audio>
                                                                                <span class="check-icon avatar avatar-md d-flex justify-content-center align-items-center position-absolute top-0 end-0 m-1 d-none">
                                                                                    <i class="ti ti-check"></i>
                                                                                </span>
                                                                            </div>
                                                                        </div>

                                                                        <!-- Sound 2 -->
                                                                        <div class="col-6 mb-3">
                                                                            <div class="sound-box position-relative p-3 border rounded text-center" style="cursor: pointer;">
                                                                                <strong>Pop</strong>
                                                                                <audio id="pop-audio" src="{{ URL::asset('/sounds/pop.mp3') }}"></audio>
                                                                                <span class="check-icon avatar avatar-md d-flex justify-content-center align-items-center position-absolute top-0 end-0 m-1 d-none">
                                                                                    <i class="ti ti-check"></i>
                                                                                </span>
                                                                            </div>
                                                                        </div>

                                                                        <!-- Sound 3 -->
                                                                        <div class="col-6 mb-3">
                                                                            <div class="sound-box position-relative p-3 border rounded text-center" style="cursor: pointer;">
                                                                                <strong>Bell</strong>
                                                                                <audio id="bell-audio" src="{{ URL::asset('/sounds/bell.mp3') }}"></audio>
                                                                                <span class="check-icon avatar avatar-md d-flex justify-content-center align-items-center position-absolute top-0 end-0 m-1 d-none">
                                                                                    <i class="ti ti-check"></i>
                                                                                </span>
                                                                            </div>
                                                                        </div>

                                                                        <!-- Sound 4 -->
                                                                        <div class="col-6 mb-3">
                                                                            <div class="sound-box position-relative p-3 border rounded text-center" style="cursor: pointer;">
                                                                                <strong>Chime</strong>
                                                                                <audio id="chime-audio" src="{{ URL::asset('/sounds/chime.mp3') }}"></audio>
                                                                                <span class="check-icon avatar avatar-md d-flex justify-content-center align-items-center position-absolute top-0 end-0 m-1 d-none">
                                                                                    <i class="ti ti-check"></i>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-12 d-flex">
                                                                        <a href="javascript:void(0);" class="btn btn-primary flex-fill mb-3">
                                                                            <i class="ti ti-device-floppy me-2"></i>Save Changes
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>


                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /App setting -->

                        <!-- Chat setting -->

                        <!-- /Chat setting -->



                        <!-- Language setting -->


                    </div>

                </div>

            </div>
            <!-- / Chats sidebar -->
        </div>
    </div>
    <!-- /Sidebar group -->

    <!-- Chat -->


    



</div>
<script>
    function handleImageUpload(event, previewId, allowedTypes) {
        const file = event.target.files[0];
        if (file) {
            if (!allowedTypes.includes(file.type)) {
                alert('Only allowed file types: ' + allowedTypes.join(', '));
                event.target.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById(previewId).src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    }
</script>




@component('components.model-popup')
@endcomponent
@endsection