<?php $page = 'index'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Tabler Icons CSS (required for ti ti-play, ti-pause, etc.) -->
    <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.39.0/tabler-icons.min.css" rel="stylesheet">

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
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="ti ti-x"></i></button>
                    </div>
                @endif

                <!-- Profile sidebar -->
                <div class="sidebar-content active slimscroll">
                    <div class="slimscroll">


                        <div class="sidebar-body chat-body">

                            <!-- Account setting -->
                            <div class="content-wrapper">
                                <h5 class="sub-title">Account</h5>
                                <div class="chat-file">
                                    <div class="file-item">
                                        <div class="accordion accordion-flush chat-accordion" id="account-setting">
                                            <div class="accordion-item others">
                                                <h2 class="accordion-header">
                                                    <a href="#" class="accordion-button" data-bs-toggle="collapse"
                                                        data-bs-target="#chatuser-collapse" aria-expanded="true"
                                                        aria-controls="chatuser-collapse">
                                                        <i class="ti ti-user me-2"></i>Profile Info
                                                    </a>
                                                </h2>
                                                <form action="{{ route('chatuser.store') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div id="chatuser-collapse" class="accordion-collapse collapse"
                                                        data-bs-parent="#account-setting">
                                                        <div class="accordion-body">
                                                            <div>
                                                                <div
                                                                    class="d-flex justify-content-center align-items-center">
                                                                    <span
                                                                        class="set-pro avatar avatar-xxl rounded-circle mb-3 p-1">
                                                                        @php
                                                                            $profileImg = URL::asset('/build/img/profiles/avatar-16.jpg');
                                                                            $user = auth()->user();
                                                                            // Check image field first (upload/users/) for consistency
                                                                            if ($user && !empty($user->image)) {
                                                                                if (strpos($user->image, 'upload/') === 0) {
                                                                                    $profileImg = asset($user->image);
                                                                                } else {
                                                                                    $profileImg = asset('storage/' . $user->image);
                                                                                }
                                                                            } elseif ($setting && $setting->image) {
                                                                                if (str_starts_with($setting->image, 'upload/') || str_starts_with($setting->image, 'http')) {
                                                                                    $profileImg = asset($setting->image);
                                                                                } else {
                                                                                    $profileImg = asset('storage/' . $setting->image);
                                                                                }
                                                                            } elseif ($user && !empty($user->profile_image)) {
                                                                                // Fallback to profile_image if image field is empty
                                                                                $profileImg = asset('storage/' . $user->profile_image);
                                                                            }
                                                                        @endphp
                                                                        <img id="preview-image"
                                                                            src="{{ $profileImg }}"
                                                                            class="rounded-circle" alt="user"
                                                                            onerror="this.onerror=null; this.src='{{ URL::asset('/build/img/profiles/avatar-16.jpg') }}';">
                                                                        <span
                                                                            class="add avatar avatar-sm d-flex justify-content-center align-items-center">
                                                                            <label for="profile_img" class="m-0"
                                                                                style="cursor:pointer;">
                                                                                <i
                                                                                    class="ti ti-plus rounded-circle d-flex justify-content-center align-items-center"></i>
                                                                            </label>
                                                                            <input type="file" id="profile_img"
                                                                                name="image" accept="image/*"
                                                                                style="display:none;">
                                                                        </span>
                                                                    </span>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <div class="input-icon mb-3 position-relative">
                                                                            <input type="text" name="first_name"
                                                                                class="form-control"
                                                                                value="{{ old('first_name', $setting->first_name ?? '') }}"
                                                                                placeholder="First Name" required>
                                                                            <span class="icon-addon"><i
                                                                                    class="ti ti-user"></i></span>
                                                                        </div>
                                                                    </div>



                                                                    <div class="col-lg-12 d-flex">
                                                                        <button type="submit"
                                                                            class="btn btn-primary flex-fill"><i
                                                                                class="ti ti-device-floppy me-2"></i>Save
                                                                            Changes</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>

                                                {{-- Preview uploaded image --}}
                                                <script>
                                                    document.getElementById('profile_img').addEventListener('change', function(e) {
                                                        const reader = new FileReader();
                                                        reader.onload = function() {
                                                            document.getElementById('preview-image').src = reader.result;
                                                        };
                                                        reader.readAsDataURL(e.target.files[0]);
                                                    });
                                                </script>

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
                                            @php
                                                $setting = \App\Models\Setting::where('user_id', auth()->id())->first();
                                            @endphp

                                            <div class="accordion-item others">
                                                <h2 class="accordion-header">
                                                    <a href="#" class="accordion-button collapsed"
                                                        data-bs-toggle="collapse" data-bs-target="#set-email"
                                                        aria-expanded="false" aria-controls="set-email">
                                                        <i class="ti ti-mail me-2"></i>Email
                                                    </a>
                                                </h2>
                                                <div id="set-email" class="accordion-collapse collapse"
                                                    data-bs-parent="#pwd-setting">
                                                    <div class="accordion-body">
                                                        <form method="POST" action="{{ route('chatuser.updateEmail') }}"
                                                            autocomplete="off">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="input-group mb-3">
                                                                        <span class="input-group-text"><i
                                                                                class="ti ti-mail"></i></span>
                                                                        <input type="email" class="form-control"
                                                                            name="old_email"
                                                                            value="{{ auth()->user()->email }}" readonly
                                                                            autocomplete="off" autocorrect="off"
                                                                            autocapitalize="off" spellcheck="false">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="input-group mb-3">
                                                                        <span class="input-group-text"><i
                                                                                class="ti ti-mail-check"></i></span>
                                                                        <input type="email" class="form-control"
                                                                            name="new_email" placeholder="New Email"
                                                                            required autocomplete="off" autocorrect="off"
                                                                            autocapitalize="off" spellcheck="false">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 d-flex">
                                                                    <button type="submit"
                                                                        class="btn btn-primary flex-fill">
                                                                        <i class="ti ti-device-floppy me-2"></i>Save
                                                                        Changes
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- /Email -->

                                            <!-- Password -->
                                            <div class="accordion-item others mb-3">
                                                <h2 class="accordion-header">
                                                    <a href="#" class="accordion-button collapsed"
                                                        data-bs-toggle="collapse" data-bs-target="#set-password"
                                                        aria-expanded="false" aria-controls="set-password">
                                                        <i class="ti ti-lock me-2"></i>Password
                                                    </a>
                                                </h2>
                                                <div id="set-password" class="accordion-collapse collapse"
                                                    data-bs-parent="#pwd-setting">
                                                    <div class="accordion-body">
                                                        <form action="{{ route('user.updatePassword') }}" method="POST">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="input-icon mb-3 position-relative">
                                                                        <input type="password" name="old_password"
                                                                            class="form-control"
                                                                            placeholder="Old Password" required>
                                                                        <span
                                                                            class="ti toggle-password ti-eye-off position-absolute end-0 top-50 translate-middle-y me-3"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="input-icon mb-3 position-relative">
                                                                        <input type="password" name="new_password"
                                                                            class="form-control"
                                                                            placeholder="New Password" required>
                                                                        <span
                                                                            class="ti toggle-passwords ti-eye-off position-absolute end-0 top-50 translate-middle-y me-3"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="input-icon mb-3 position-relative">
                                                                        <input type="password"
                                                                            name="new_password_confirmation"
                                                                            class="form-control"
                                                                            placeholder="Confirm Password" required>
                                                                        <span
                                                                            class="ti conform-toggle-password ti-eye-off position-absolute end-0 top-50 translate-middle-y me-3"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 d-flex">
                                                                    <button type="submit"
                                                                        class="btn btn-primary flex-fill">
                                                                        <i class="ti ti-device-floppy me-2"></i>Save
                                                                        Changesas
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /Password -->

                                            <!-- Screen Lock -->
                                            <form action="{{ route('user.saveScreenLock') }}" method="POST"
                                                id="screen-lock-form">
                                                @csrf
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <h6 class="fs-14">
                                                        <a href="javascript:void(0);">
                                                            <i class="ti ti-lock-square text-gray me-2"></i>Screen Lock
                                                        </a>
                                                    </h6>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="screen_lock"
                                                            {{ ($setting && ($setting->screen_lock ?? false)) ? 'checked' : '' }}>
                                                    </div>
                                                </div>
                                                <div id="screen-lock-minutes" class="mt-2" style="display: {{ ($setting && ($setting->screen_lock ?? false)) ? 'block' : 'none' }};">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <label for="screen_lock_minutes" class="me-2">Auto-lock after (minutes)</label>
                                                        <input type="number" min="1" max="1440" step="1" name="screen_lock_minutes" id="screen_lock_minutes" class="form-control" style="max-width: 140px;" value="{{ $setting->screen_lock_minutes ?? 15 }}">
                                                        <button type="submit" class="btn btn-sm btn-outline-primary">Save</button>
                                                    </div>
                                                </div>
                                            </form>

                                            <!-- Divider after Screen Lock -->
                                            <div class="border-top my-3"></div>

                                            <!-- Two-Factor Auth -->
                                            <form action="{{ route('user.toggleTwoFactor') }}" method="POST"
                                                id="two-factor-form">
                                                @csrf
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h6 class="fs-14">
                                                        <a href="javascript:void(0);">
                                                            <i class="ti ti-shield text-gray me-2"></i>Two Factor
                                                            Authentication
                                                        </a>
                                                    </h6>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="two_factor_auth"
                                                            onchange="document.getElementById('two-factor-form').submit();"
                                                            {{ auth()->user()->two_factor_auth ? 'checked' : '' }}>
                                                    </div>
                                                </div>
                                            </form>

                                           



                                        </div>
                                    </div>
                                </div>
                            </div>
                          




                            <!-- App setting -->
                            <div class="content-wrapper">
                                <h5 class="sub-title">App Setting</h5>
                                <div class="chat-file">
                                    <div class="file-item ">
                                        <div class="accordion accordion-flush chat-accordion" id="privacy-setting"
                                            style="padding-bottom: 0px;">
                                            <div class="mb-3">
                                                <!-- chat bg -->
                                                <form action="{{ route('upload.login.backgrounds') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                                                    <div class="border-0 profile-list">
                                                        <div class="accordion-item border-0 border-bottom">
                                                            <h2 class="accordion-header border-0">
                                                                <a href="#"
                                                                    class="accordion-button border-0 collapsed"
                                                                    data-bs-toggle="collapse"
                                                                    data-bs-target="#login-background-collapse"
                                                                    aria-expanded="false"
                                                                    aria-controls="login-background-collapse">
                                                                    <i class="ti ti-photo me-2"></i>Login Background
                                                                </a>
                                                            </h2>
                                                        </div>

                                                        <div id="login-background-collapse"
                                                            class="accordion-collapse border-0 collapse"
                                                            data-bs-parent="#chat-setting">
                                                            <div class="accordion-body border-0 pb-0">
                                                                <div class="chat-user-photo">
                                                                    <div
                                                                        class="chat-img contact-gallery mb-3 d-flex flex-wrap gap-3">
                                                                        @for ($i = 1; $i <= 6; $i++)
                                                                            <div class="img-wrap position-relative"
                                                                                style="width: 200px; height: 120px; overflow: hidden; border: 1px solid #ccc; border-radius: 10px;">
                                                                                <img id="previewImage{{ $i }}"
                                                                                    src="{{ isset($images[$i - 1]) ? asset($images[$i - 1]) : asset('/build/img/gallery/gallery-01.jpg') }}"
                                                                                    alt="Login Background {{ $i }}"
                                                                                    style="width: 100%; height: 100%; object-fit: cover; border-radius: 10px;">
                                                                                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-between p-2"
                                                                                    style="background: rgba(0, 0, 0, 0.25); opacity: 0; transition: opacity 0.2s ease-in-out; border-radius: 10px;"
                                                                                    onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0'">
                                                                                    <button type="button" class="btn btn-sm btn-light"
                                                                                        onclick="document.getElementById('imageUpload{{ $i }}').click();">Upload</button>
                                                                                    <button type="button" class="btn btn-sm {{ (isset($selected_login_background) && $selected_login_background === ($i - 1)) ? 'btn-success' : 'btn-outline-light' }}"
                                                                                        onclick="submitLoginBgSelect({{ $i - 1 }})">Select</button>
                                                                                </div>
                                                                            </div>

                                                                            <input type="file" name="images[{{ $i - 1 }}]"
                                                                                id="imageUpload{{ $i }}"
                                                                                accept=".jpg,.jpeg,.svg,.png"
                                                                                style="display: none;">
                                                                        @endfor
                                                                    </div>

                                                                    <div class="col-lg-12 d-flex">
                                                                        <button type="submit"
                                                                            class="btn btn-primary flex-fill mb-3">
                                                                            <i class="ti ti-device-floppy me-2"></i>Save
                                                                            Changes
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <form id="selectLoginBgForm" action="{{ route('select.login.background') }}" method="POST" style="display:none;">
                                                    @csrf
                                                    <input type="hidden" name="index" id="selectLoginBgIndex" value="">
                                                </form>
                                                <form id="selectChatBgForm" action="{{ route('select.chat.background') }}" method="POST" style="display:none;">
                                                    @csrf
                                                    <input type="hidden" name="index" id="selectChatBgIndex" value="">
                                                </form>
                                                <script>
                                                    function submitLoginBgSelect(idx){
                                                        try{
                                                            var input = document.getElementById('selectLoginBgIndex');
                                                            var form = document.getElementById('selectLoginBgForm');
                                                            if(input && form){ input.value = String(idx); form.submit(); }
                                                        }catch(e){}
                                                    }
                                                    function submitChatBgSelect(idx){
                                                        try{
                                                            var input = document.getElementById('selectChatBgIndex');
                                                            var form = document.getElementById('selectChatBgForm');
                                                            if(input && form){ input.value = String(idx); form.submit(); }
                                                        }catch(e){}
                                                    }
                                                </script>
                                                {{-- chat background --}}
                                                <form action="{{ route('upload.chat.backgrounds') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                                                    <div class="border-0 profile-list">
                                                        <div class="accordion-item border-0 border-bottom">
                                                            <h2 class="accordion-header border-0">
                                                                <a href="#"
                                                                    class="accordion-button border-0 collapsed"
                                                                    data-bs-toggle="collapse"
                                                                    data-bs-target="#chat-background-collapse"
                                                                    aria-expanded="false"
                                                                    aria-controls="chat-background-collapse">
                                                                    <i class="ti ti-photo me-2"></i>Chat Background
                                                                </a>
                                                            </h2>
                                                        </div>

                                                        <div id="chat-background-collapse"
                                                            class="accordion-collapse border-0 collapse"
                                                            data-bs-parent="#chat-setting">
                                                            <div class="accordion-body border-0 pb-0">
                                                                <div class="chat-user-photo">
                                                                    <div
                                                                        class="chat-img contact-gallery mb-3 d-flex flex-wrap gap-3">
                                                                        @for ($i = 1; $i <= 6; $i++)
                                                                            @php
                                                                                $imageSrc =
                                                                                    isset($chat_backgrounds[$i - 1]) &&
                                                                                    $chat_backgrounds[$i - 1]
                                                                                        ? asset(
                                                                                            $chat_backgrounds[$i - 1],
                                                                                        )
                                                                                        : asset(
                                                                                            '/build/img/gallery/gallery-01.jpg',
                                                                                        );
                                                                            @endphp

                                                                            <div class="img-wrap position-relative"
                                                                                style="width: 200px; height: 120px; overflow: hidden; border: 1px solid #ccc; border-radius: 10px; margin: 0; padding: 0; display: block; line-height: 0; background-color: #f0f0f0;">
                                                                                <img id="previewImagechat{{ $i }}"
                                                                                    src="{{ $imageSrc }}"
                                                                                    alt="Chat Background {{ $i }}"
                                                                                    style="width: 100%; height: 120px; min-height: 120px; max-height: 120px; object-fit: cover; object-position: center; border-radius: 10px; display: block; margin: 0; padding: 0; border: none; vertical-align: middle;">

                                                                                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-between p-2"
                                                                                    style="background: rgba(0, 0, 0, 0.25); opacity: 0; transition: opacity 0.2s ease-in-out; border-radius: 10px;"
                                                                                    onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0'">
                                                                                    <button type="button" class="btn btn-sm btn-light"
                                                                                        onclick="document.getElementById('imageUploadChat{{ $i }}').click();">Upload</button>
                                                                                    <button type="button" class="btn btn-sm {{ (isset($selected_chat_background) && $selected_chat_background === ($i - 1)) ? 'btn-success' : 'btn-outline-light' }}"
                                                                                        onclick="submitChatBgSelect({{ $i - 1 }})">Select</button>
                                                                                </div>
                                                                            </div>

                                                                            <input type="file" name="chat_images[{{ $i - 1 }}]"
                                                                                id="imageUploadChat{{ $i }}"
                                                                                accept=".jpg,.jpeg,.svg,.png"
                                                                                onchange="handleChatImageUpload(event, 'previewImagechat{{ $i }}')"
                                                                                style="display: none;">
                                                                        @endfor
                                                                    </div>

                                                                    <div class="col-lg-12 d-flex">
                                                                        <button type="submit"
                                                                            class="btn btn-primary flex-fill mb-3">
                                                                            <i class="ti ti-device-floppy me-2"></i>Save
                                                                            Changes
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>

                                                <script>
                                                    document.addEventListener("DOMContentLoaded", function() {
                                                        const fileInputs = document.querySelectorAll('input[type="file"][id^="imageUpload"]');

                                                        fileInputs.forEach((input, index) => {
                                                            input.addEventListener("change", function(event) {
                                                                const file = event.target.files[0];
                                                                const previewImage = document.getElementById("previewImage" + (index + 1));
                                                                if (file && file.type.startsWith("image/") && previewImage) {
                                                                    const reader = new FileReader();
                                                                    reader.onload = function(e) {
                                                                        previewImage.src = e.target.result;
                                                                    };
                                                                    reader.readAsDataURL(file);
                                                                }
                                                            });
                                                        });
                                                    });
                                                </script>

                                                <script>
                                                    document.addEventListener("DOMContentLoaded", function() {
                                                        const fileInputs = document.querySelectorAll('input[type="file"][id^="imageUploadChat"]');

                                                        fileInputs.forEach((input, index) => {
                                                            input.addEventListener("change", function(event) {
                                                                const file = event.target.files[0];
                                                                const previewImagechat = document.getElementById("previewImagechat" + (index +
                                                                    1));
                                                                if (file && file.type.startsWith("image/") && previewImagechat) {
                                                                    const reader = new FileReader();
                                                                    reader.onload = function(e) {
                                                                        previewImagechat.src = e.target.result;
                                                                    };
                                                                    reader.readAsDataURL(file);
                                                                }
                                                            });
                                                        });
                                                    });
                                                </script>


                                                <script>
                                                    function handleImageUpload(event, previewId) {
                                                        const file = event.target.files[0];
                                                        if (file && file.type.startsWith('image/')) {
                                                            const reader = new FileReader();
                                                            reader.onload = e => {
                                                                document.getElementById(previewId).src = e.target.result;
                                                            };
                                                            reader.readAsDataURL(file);
                                                        }
                                                    }
                                                </script>


                                                <!-- /chat bg -->
                                                <!-- App Logo -->
                                                <div class="border-0 profile-list">
                                                    <div class="accordion-item border-0 border-bottom">
                                                        <h2 class="accordion-header border-0">
                                                            <a href="#" class="accordion-button border-0 collapsed"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#app-logo-collapse" aria-expanded="false"
                                                                aria-controls="app-logo-collapse">
                                                                <i class="ti ti-photo me-2"></i>App Logo
                                                            </a>
                                                        </h2>
                                                        <div id="app-logo-collapse"
                                                            class="accordion-collapse border-0 collapse"
                                                            data-bs-parent="#chat-setting">
                                                            <form action="{{ route('settings.uploadAppLogo') }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="accordion-body border-0 pb-0">
                                                                    <div class="chat-user-photo">
                                                                        <div class="chat-img contact-gallery mb-3">
                                                                            <!-- App Logo Box -->
                                                                            <div class="img-wrap"
                                                                                style="position: relative; width: 200px; height: 120px; overflow: hidden; border: 1px solid #ccc; border-radius: 10px;">
                                                                                <img id="previewAppLogo"
                                                                                    src="{{ $setting->app_logo ?? URL::asset('/build/img/gallery/gallery-01.jpg') }}"
                                                                                    alt="App Logo"
                                                                                    style="width: 100%; height: 100%; object-fit: cover; border-radius: 10px;">
                                                                                <div class="img-overlay-1"
                                                                                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;
                                                                                    background: rgba(0, 0, 0, 0.4); display: flex; align-items: center; 
                                                                                    justify-content: center; opacity: 0; transition: opacity 0.3s ease-in-out; border-radius: 10px;"
                                                                                    onmouseover="this.style.opacity='1'"
                                                                                    onmouseout="this.style.opacity='0'">
                                                                                    <a href="javascript:void(0);"
                                                                                        onclick="document.getElementById('uploadAppLogo').click();"
                                                                                        style="text-decoration: none; font-size: 40px; color: #007bff;">+</a>
                                                                                </div>
                                                                            </div>
                                                                            <input type="file" id="uploadAppLogo"
                                                                                name="app_logo" accept=".png,.svg"
                                                                                style="display:none"
                                                                                onchange="handleImageUpload(event, 'previewAppLogo', ['image/png', 'image/svg+xml'])">
                                                                        </div>

                                                                        <div class="col-lg-12 d-flex">
                                                                            <button type="submit"
                                                                                class="btn btn-primary flex-fill mb-3">
                                                                                <i
                                                                                    class="ti ti-device-floppy me-2"></i>Save
                                                                                Changes
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- URL Favicon -->
                                                <div class="border-0 profile-list">
                                                    <div class="accordion-item border-0 ">

                                                        <form action="{{ route('settings.uploadFavicon') }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="user_id"
                                                                value="{{ auth()->id() }}">

                                                            <div class="border-0 profile-list">
                                                                <div class="accordion-item border-0 border-bottom">
                                                                    <h2 class="accordion-header border-0">
                                                                        <a href="#"
                                                                            class="accordion-button border-0 collapsed"
                                                                            data-bs-toggle="collapse"
                                                                            data-bs-target="#url-favicon-collapse"
                                                                            aria-expanded="false"
                                                                            aria-controls="url-favicon-collapse">
                                                                            <i class="ti ti-photo me-2"></i>URL FavIcon
                                                                        </a>
                                                                    </h2>

                                                                    <div id="url-favicon-collapse"
                                                                        class="accordion-collapse border-0 collapse"
                                                                        data-bs-parent="#chat-setting">
                                                                        <div class="accordion-body border-0 pb-0">
                                                                            <div class="chat-user-photo">
                                                                                <div class="chat-img contact-gallery mb-3">
                                                                                    <!-- Favicon Box -->
                                                                                    <div class="img-wrap"
                                                                                        style="position: relative; width: 200px; height: 120px; overflow: hidden; border: 1px solid #ccc; border-radius: 10px;">
                                                                                        <img id="previewFavIcon"
                                                                                            src="{{ $setting->favicon ?? asset('/build/img/gallery/gallery-01.jpg') }}"
                                                                                            alt="Favicon"
                                                                                            style="width: 100%; height: 100%; object-fit: cover; border-radius: 10px;">
                                                                                        <div class="img-overlay-1"
                                                                                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;
                                                                                        background: rgba(0, 0, 0, 0.4); display: flex; align-items: center; 
                                                                                        justify-content: center; opacity: 0; transition: opacity 0.3s ease-in-out; border-radius: 10px;"
                                                                                            onmouseover="this.style.opacity='1'"
                                                                                            onmouseout="this.style.opacity='0'">
                                                                                            <a href="javascript:void(0);"
                                                                                                onclick="document.getElementById('uploadFavIcon').click();"
                                                                                                style="text-decoration: none; font-size: 40px; color: #007bff;">+</a>
                                                                                        </div>
                                                                                    </div>
                                                                                    <input type="file" name="favicon"
                                                                                        id="uploadFavIcon"
                                                                                        accept=".svg,.png"
                                                                                        style="display: none;"
                                                                                        onchange="handleImageUpload(event, 'previewFavIcon', ['image/svg+xml', 'image/png'])">
                                                                                </div>

                                                                                <div class="col-lg-12 d-flex">
                                                                                    <button type="submit"
                                                                                        class="btn btn-primary flex-fill mb-3">
                                                                                        <i
                                                                                            class="ti ti-device-floppy me-2"></i>Save
                                                                                        Changes
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>

                                                <!-- App Title -->
                                                <form action="{{ route('settings.updateAppTitle') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                                                    <div class="border-0 profile-list">
                                                        <div class="accordion-item border-0 border-bottom">
                                                            <h2 class="accordion-header border-0">
                                                                <a href="#"
                                                                    class="accordion-button border-0 collapsed"
                                                                    data-bs-toggle="collapse"
                                                                    data-bs-target="#url-app-collapse"
                                                                    aria-expanded="false"
                                                                    aria-controls="url-app-collapse">
                                                                    <i class="ti ti-photo me-2"></i>App Title
                                                                </a>
                                                            </h2>
                                                            <div id="url-app-collapse"
                                                                class="accordion-collapse border-0 collapse"
                                                                data-bs-parent="#chat-setting">
                                                                <div class="accordion-body border-0 pb-0">
                                                                    <div class="form-group mb-3">
                                                                        <input type="text" class="form-control"
                                                                            id="app_name" name="app_name"
                                                                            placeholder="Enter App Name"
                                                                            value="{{ $setting->app_name ?? '' }}">
                                                                    </div>

                                                                    <div class="col-lg-12 d-flex">
                                                                        <button type="submit"
                                                                            class="btn btn-primary flex-fill mb-3">
                                                                            <i class="ti ti-device-floppy me-2"></i>Save
                                                                            Changes
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>

                                                <!-- /apps Title-->

                                                <div class="file-item ">

                                                    <div class="card-body">
                                                        <!-- Message Notification Sounds -->
                                                        <form action="{{ route('upload.chat.sounds') }}" method="POST"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="user_id"
                                                                value="{{ auth()->id() }}">

                                                            <div class="border-0 profile-list pb-1 mb-1">
                                                                <div class="accordion-item border-0 border-bottom">
                                                                    <h2 class="accordion-header border-0">
                                                                        <button
                                                                            class="accordion-button border-0 collapsed px-0"
                                                                            type="button" data-bs-toggle="collapse"
                                                                            data-bs-target="#message-sound-collapse"
                                                                            aria-expanded="false"
                                                                            aria-controls="message-sound-collapse">
                                                                            <i class="ti ti-message me-2"></i>Message
                                                                            Notifications
                                                                        </button>
                                                                    </h2>

                                                                    <div id="message-sound-collapse"
                                                                        class="accordion-collapse border-0 collapse"
                                                                        data-bs-parent="#chat-setting">
                                                                        <div class="accordion-body border-0 pb-0">
                                                                            <div class="row">
                                                                                @for ($i = 1; $i <= 4; $i++)
                                                                                    @php
                                                                                        $audioSrc =
                                                                                            isset(
                                                                                                $chat_sounds[$i - 1],
                                                                                            ) && $chat_sounds[$i - 1]
                                                                                                ? asset(
                                                                                                    $chat_sounds[
                                                                                                        $i - 1
                                                                                                    ],
                                                                                                )
                                                                                                : '';
                                                                                    @endphp

                                                                                    <div class="col-6 mb-3">
                                                                                        <div class="sound-box position-relative p-3 border rounded text-center"
                                                                                            style="min-height: 100px;">
                                                                                            <strong>Sound
                                                                                                {{ $i }}</strong><br>

                                                                                            @if ($audioSrc)
                                                                                                <button type="button"
                                                                                                    class="btn btn-sm btn-secondary mt-2"
                                                                                                    onclick="toggleAudio({{ $i }})">
                                                                                                    <i class="ti ti-player-play"
                                                                                                        id="playIcon{{ $i }}"></i>
                                                                                                </button>

                                                                                                <audio
                                                                                                    id="audioPlayer{{ $i }}"
                                                                                                    style="display: none;"
                                                                                                    preload="none">
                                                                                                    <source
                                                                                                        src="{{ $audioSrc }}"
                                                                                                        type="audio/{{ pathinfo($audioSrc, PATHINFO_EXTENSION) }}">
                                                                                                </audio>
                                                                                            @else
                                                                                                <p class="text-muted mt-2">
                                                                                                    No audio uploaded.</p>
                                                                                                <audio
                                                                                                    id="audioPlayer{{ $i }}"
                                                                                                    style="display: none;"
                                                                                                    preload="none"></audio>
                                                                                            @endif

                                                                                            <div class="mt-2">
                                                                                                <button type="button"
                                                                                                    class="btn btn-outline-primary btn-sm"
                                                                                                    onclick="document.getElementById('audioUpload{{ $i }}').click();">
                                                                                                    <i
                                                                                                        class="ti ti-plus"></i>
                                                                                                    Upload New
                                                                                                </button>
                                                                                            </div>

                                                                                            <input type="file"
                                                                                                name="chat_sounds[]"
                                                                                                id="audioUpload{{ $i }}"
                                                                                                accept=".mp3,.wav"
                                                                                                onchange="handleAudioUpload(event, {{ $i }})"
                                                                                                style="display: none;">
                                                                                        </div>
                                                                                    </div>
                                                                                @endfor
                                                                            </div>

                                                                            <div class="col-lg-12 d-flex">
                                                                                <button type="submit"
                                                                                    class="btn btn-primary flex-fill mb-3">
                                                                                    <i
                                                                                        class="ti ti-device-floppy me-2"></i>Save
                                                                                    Changes
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>

                                                        <script>
                                                            function handleAudioUpload(event, index) {
                                                                const file = event.target.files[0];
                                                                if (file && file.type.startsWith('audio/')) {
                                                                    const reader = new FileReader();
                                                                    reader.onload = function(e) {
                                                                        const audio = document.getElementById(`audioPlayer${index}`);
                                                                        const icon = document.getElementById(`playIcon${index}`);
                                                                        if (audio) {
                                                                            // Replace source
                                                                            audio.innerHTML = `<source src="${e.target.result}" type="${file.type}">`;
                                                                            audio.load();
                                                                            audio.pause();
                                                                            audio.style.display = "none"; // Force hide in case browser shows it
                                                                            icon?.classList.remove('d-none');
                                                                            icon?.classList.add('ti-player-play');
                                                                            icon?.classList.remove('ti-player-pause');
                                                                        }
                                                                    };
                                                                    reader.readAsDataURL(file);
                                                                }
                                                            }

                                                            function toggleAudio(index) {
                                                                const audio = document.getElementById(`audioPlayer${index}`);
                                                                const icon = document.getElementById(`playIcon${index}`);

                                                                if (!audio || !icon) return;

                                                                // Pause all other audio before playing current one
                                                                for (let i = 1; i <= 4; i++) {
                                                                    if (i !== index) {
                                                                        const otherAudio = document.getElementById(`audioPlayer${i}`);
                                                                        const otherIcon = document.getElementById(`playIcon${i}`);
                                                                        if (otherAudio && !otherAudio.paused) {
                                                                            otherAudio.pause();
                                                                            otherIcon?.classList.remove('ti-player-pause');
                                                                            otherIcon?.classList.add('ti-player-play');
                                                                        }
                                                                    }
                                                                }

                                                                if (audio.paused) {
                                                                    audio.play();
                                                                    icon.classList.remove('ti-player-play');
                                                                    icon.classList.add('ti-player-pause');
                                                                } else {
                                                                    audio.pause();
                                                                    icon.classList.remove('ti-player-pause');
                                                                    icon.classList.add('ti-player-play');
                                                                }
                                                            }
                                                        </script>



                                                        {{-- <div class="d-flex justify-content-between align-items-center profile-list border-bottom pt-2 pb-3 mb-2">
                                                        <h6 class="fs-14"><a href="javascript:void(0);"><i class="ti ti-trash text-gray me-2 "></i>Show Previews</a></h6>
                                                        <div class="form-check form-switch d-flex justify-content-end align-items-center">
                                                            <input class="form-check-input" type="checkbox" role="switch">
                                                        </div>
                                                    </div> --}}
                                                        <!-- show reaction -->
                                                        <form action="{{ route('settings.toggleReactionNotification') }}"
                                                            method="POST">
                                                            @csrf
                                                            <input type="hidden" name="user_id"
                                                                value="{{ auth()->id() }}">

                                                            <div
                                                                class="d-flex justify-content-between align-items-center profile-list border-bottom pt-2 pb-3 mb-1">
                                                                <h6 class="fs-14">
                                                                    <a href="javascript:void(0);">
                                                                        <i class="ti ti-mood-smile text-gray me-2"></i>Show
                                                                        Reaction Notifications
                                                                    </a>
                                                                </h6>
                                                                <div
                                                                    class="form-check form-switch d-flex justify-content-end align-items-center">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        role="switch" name="show_reaction_notifications"
                                                                        onchange="this.form.submit()"
                                                                        {{ $setting->show_reaction_notifications ?? false ? 'checked' : '' }}>
                                                                </div>
                                                            </div>
                                                        </form>

                                                        <!-- /show reaction -->
                                                        <!-- /notification sound -->
                                                        <form action="{{ route('upload.notification.sounds') }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="user_id"
                                                                value="{{ auth()->id() }}">

                                                            @php
                                                                $setting = \App\Models\Setting::where(
                                                                    'user_id',
                                                                    auth()->id(),
                                                                )->first();
                                                                $uploadedSounds = $setting
                                                                    ? json_decode(
                                                                        $setting->notification_sounds ?? '[]',
                                                                        true,
                                                                    )
                                                                    : [];
                                                            @endphp

                                                            <div class="border-0 profile-list">
                                                                <div class="accordion-item border-0">
                                                                    <h2 class="accordion-header border-0"
                                                                        style="margin-bottom: 0px;">
                                                                        <button
                                                                            class="accordion-button border-0 collapsed px-0"
                                                                            type="button" data-bs-toggle="collapse"
                                                                            data-bs-target="#notification-sound-collapse"
                                                                            aria-expanded="false"
                                                                            aria-controls="notification-sound-collapse">
                                                                            <i
                                                                                class="ti ti-bell-ringing text-gray me-2"></i>
                                                                            Notification Sound
                                                                        </button>
                                                                    </h2>

                                                                    <div id="notification-sound-collapse"
                                                                        class="accordion-collapse border-0 collapse"
                                                                        data-bs-parent="#chat-setting">
                                                                        <div class="accordion-body border-0   pb-0">
                                                                            <div class="row">
                                                                                @for ($i = 0; $i < 4; $i++)
                                                                                    @php
                                                                                        $soundSrc = isset(
                                                                                            $uploadedSounds[$i],
                                                                                        )
                                                                                            ? asset($uploadedSounds[$i])
                                                                                            : asset(
                                                                                                'storage/notification_sounds/default' .
                                                                                                    ($i + 1) .
                                                                                                    '.mp3',
                                                                                            );
                                                                                    @endphp

                                                                                    <div class="col-6 mb-3">
                                                                                        <div class="sound-box position-relative p-3 border rounded text-center"
                                                                                            style="background-color: #f8f9fa;">

                                                                                            {{-- Audio Element --}}
                                                                                            <audio
                                                                                                id="audio-{{ $i + 1 }}"
                                                                                                src="{{ $soundSrc }}"></audio>

                                                                                            {{-- Play Button --}}
                                                                                            <div id="play-{{ $i + 1 }}"
                                                                                                onclick="playSound({{ $i + 1 }})"
                                                                                                style="
                                                                                                  width: 50px; height: 50px; border-radius: 50%;
                                                                                                  background-color: #28a745; display: flex; align-items: center;
                                                                                                  justify-content: center; color: white; font-size: 24px;
                                                                                                  margin: auto; cursor: pointer;">
                                                                                                ▶
                                                                                            </div>

                                                                                            {{-- Stop Button --}}
                                                                                            <div id="stop-{{ $i + 1 }}"
                                                                                                onclick="stopSound({{ $i + 1 }})"
                                                                                                style="
                                                                                                 width: 50px; height: 50px; border-radius: 50%;
                                                                                                 background-color: #dc3545; display: none; align-items: center;
                                                                                                 justify-content: center; color: white; font-size: 20px;
                                                                                                 margin: auto; cursor: pointer;">
                                                                                                ⏹
                                                                                            </div>

                                                                                            {{-- Upload Input --}}
                                                                                            <input type="file"
                                                                                                name="notification_sounds[{{ $i }}]"
                                                                                                id="audioUploads{{ $i }}"
                                                                                                accept=".mp3,.wav,.ogg"
                                                                                                style="display: none;"
                                                                                                onchange="handleAudioSelected(event, {{ $i }})">
                                                                                            <script>
                                                                                                function handleAudioSelected(event, index) {
                                                                                                    const files = event.target.files;
                                                                                                    if (files.length > 0) {
                                                                                                        const firstFile = files[0];
                                                                                                        const audioElement = document.getElementById(`audio-${index+1}`);
                                                                                                        const audioURL = URL.createObjectURL(firstFile);
                                                                                                        audioElement.src = audioURL;
                                                                                                    }
                                                                                                }
                                                                                            </script>


                                                                                            {{-- Upload Button --}}
                                                                                            <button type="button"
                                                                                                class="btn btn-outline-primary btn-sm mt-2"
                                                                                                onclick="document.getElementById('audioUploads{{ $i }}').click();">
                                                                                                <i class="ti ti-plus"></i>
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                @endfor
                                                                            </div>

                                                                            <div class="col-lg-12 d-flex">
                                                                                <button type="submit"
                                                                                    class="btn btn-primary flex-fill mb-3">
                                                                                    <i
                                                                                        class="ti ti-device-floppy me-2"></i>
                                                                                    Save Changes
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>





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
        @php
            use App\Models\Setting;

            $setting = Setting::where('user_id', auth()->id())->first();
            $policy_term = old('policy_term', $setting->policy_term ?? '');
            $require_accept = old('require_accept', $setting->require_accept ?? false);
            $policy_version = $setting->policy_version ?? 0;

            $setting = Setting::where('user_id', auth()->id())->first();
            $agreement_text = $setting->agreement_text ?? '';
            $agreement_require_accept = $setting->agreement_require_accept ?? false;
            $agreement_version = $setting->agreement_version ?? 0;
        @endphp


        <!-- Chat -->
        <div class="chat chat-messages show" id="middle" style="overflow-y: auto;">
            <div class="p-4" style="padding: 3.5rem !important; pt-4">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-header pb-0">
                                <h6 class="mb-1">Policy and Terms</h6>
                                <p class="text-muted small m-0">System policy</p>
                            </div>
                            <div class="card-body">
                                <form id="policyForm" method="POST" action="{{ route('settings.policy.save') }}">
                                    @csrf
                                    <textarea id="policyEditor" name="policy_term">{{ $policy_term }}</textarea>

                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <div class="btn-group">
                                            <button type="button" id="policyEditBtn"
                                                class="btn btn-outline-secondary btn-sm">Edit</button>
                                            <button type="submit" id="policySaveBtn"
                                                class="btn btn-primary btn-sm" disabled>Save</button>
                                        </div>
                                    </div>
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" id="policyRequireAccept"
                                            name="require_accept" value="1" {{ $require_accept ? 'checked' : '' }}>
                                        <label class="form-check-label" for="policyRequireAccept">Require users to
                                            accept next time</label>
                                    </div>
                                    <input type="hidden" name="increment_version" id="policyIncrementVersion"
                                        value="0">
                                </form>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-header pb-0">
                                <h6 class="mb-1">Agreements</h6>
                                <p class="text-muted small m-0">System Agreements</p>
                            </div>
                            <form id="agreementForm" method="POST" action="{{ route('settings.agreement.save') }}">
                                @csrf
                                <div class="card-body">
                                    <textarea id="agreementEditor" name="agreement_text">{{ old('agreement_text', $agreement_text ?? '') }}</textarea>

                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        {{-- <span class="badge bg-light text-dark">Version: <span id="agreementVersion">0</span></span> --}}
                                        <div class="btn-group">
                                            <button type="button" id="agreementEditBtn"
                                                class="btn btn-outline-secondary btn-sm">Edit</button>
                                            <button type="submit" id="agreementSaveBtn"
                                                class="btn btn-primary btn-sm" disabled>Save</button>
                                        </div>
                                    </div>
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" id="agreementRequireAccept"
                                            name="agreement_require_accept" value="1"
                                            {{ old('agreement_require_accept', $agreement_require_accept ?? false) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="agreementRequireAccept">Require users to
                                            accept
                                            next time</label>
                                    </div>
                                    <input type="hidden" name="agreement_increment_version"
                                        id="agreementIncrementVersion" value="0">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            // Load Summernote CSS/JS after jQuery is available, then initialize editors
            window.addEventListener('load', function() {
                var summernoteCss = document.createElement('link');
                summernoteCss.rel = 'stylesheet';
                summernoteCss.href = 'https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css';
                document.head.appendChild(summernoteCss);

                var summernoteJs = document.createElement('script');
                summernoteJs.src = 'https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js';
                summernoteJs.onload = function() {
                    var commonOptions = {
                        placeholder: 'Start typing...',
                        tabsize: 2,
                        height: 220,
                        toolbar: [
                            ['style', ['fontsize']],
                            ['font', ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
                            ['para', ['ul', 'ol', 'paragraph']],
                            ['view', ['codeview']]
                        ],
                        fontSizes: ['12', '14', '16', '18', '20', '24', '28']
                    };

                    $('#policyEditor').summernote(commonOptions);
                    $('#agreementEditor').summernote(commonOptions);

                    // Initially disable editors and save buttons
                    $('#policyEditor').summernote('disable');
                    $('#agreementEditor').summernote('disable');
                    $('#policySaveBtn').prop('disabled', true);
                    $('#agreementSaveBtn').prop('disabled', true);

                    // Edit buttons enable respective editor and save button
                    $('#policyEditBtn').on('click', function() {
                        $('#policyEditor').summernote('enable');
                        $('#policySaveBtn').prop('disabled', false);
                    });
                    $('#agreementEditBtn').on('click', function() {
                        $('#agreementEditor').summernote('enable');
                        $('#agreementSaveBtn').prop('disabled', false);
                    });

                    // Version increment toggles bound to accept checkboxes
                    $('#policyRequireAccept').on('change', function() {
                        $('#policyIncrementVersion').val(this.checked ? 1 : 0);
                    });
                    $('#agreementRequireAccept').on('change', function() {
                        $('#agreementIncrementVersion').val(this.checked ? 1 : 0);
                    });

                    // Ensure textarea gets current HTML on submit; disable back after submit
                    $('#policyForm').on('submit', function() {
                        var html = $('#policyEditor').summernote('code');
                        $('#policyEditor').val(html);
                        $('#policySaveBtn').prop('disabled', true);
                        $('#policyEditor').summernote('disable');
                    });
                    $('#agreementForm').on('submit', function() {
                        var html = $('#agreementEditor').summernote('code');
                        $('#agreementEditor').val(html);
                        $('#agreementSaveBtn').prop('disabled', true);
                        $('#agreementEditor').summernote('disable');
                    });
                };
                document.body.appendChild(summernoteJs);
            });
        </script>

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
    <script>
        function playSound(index) {
            const audio = document.getElementById('audio-' + index);
            const playBtn = document.getElementById('play-' + index);
            const stopBtn = document.getElementById('stop-' + index);

            audio.play();
            playBtn.style.display = 'none';
            stopBtn.style.display = 'flex';

            audio.onended = () => {
                stopSound(index);
            };
        }

        function stopSound(index) {
            const audio = document.getElementById('audio-' + index);
            const playBtn = document.getElementById('play-' + index);
            const stopBtn = document.getElementById('stop-' + index);

            audio.pause();
            audio.currentTime = 0;
            playBtn.style.display = 'flex';
            stopBtn.style.display = 'none';
        }
    </script>

    <script>
        function handleAudioUpload(event, index) {
            const file = event.target.files[0];
            if (file && file.type.startsWith('audio/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const container = document.getElementById(`audioPlayer${index}`);
                    if (container) {
                        container.src = e.target.result;
                        container.load();
                        container.play();
                    } else {
                        const audio = document.createElement('audio');
                        audio.id = `audioPlayer${index}`;
                        audio.controls = true;
                        audio.src = e.target.result;
                        event.target.closest('.sound-box').appendChild(audio);
                        audio.play();
                    }
                };
                reader.readAsDataURL(file);
            }
        }
    </script>

    <script>
        function playSound(index) {
            const audio = document.getElementById(`audio-${index}`);
            const playBtn = document.getElementById(`play-${index}`);
            const stopBtn = document.getElementById(`stop-${index}`);

            // Pause all others
            for (let i = 1; i <= 4; i++) {
                if (i !== index) {
                    document.getElementById(`audio-${i}`).pause();
                    document.getElementById(`audio-${i}`).currentTime = 0;
                    document.getElementById(`play-${i}`).style.display = 'flex';
                    document.getElementById(`stop-${i}`).style.display = 'none';
                }
            }

            audio.play();
            playBtn.style.display = 'none';
            stopBtn.style.display = 'flex';

            audio.addEventListener('ended', () => {
                stopBtn.style.display = 'none';
                playBtn.style.display = 'flex';
            });
        }

        function stopSound(index) {
            const audio = document.getElementById(`audio-${index}`);
            const playBtn = document.getElementById(`play-${index}`);
            const stopBtn = document.getElementById(`stop-${index}`);

            audio.pause();
            audio.currentTime = 0;
            playBtn.style.display = 'flex';
            stopBtn.style.display = 'none';
        }
    </script>


    @component('components.model-popup')
    @endcomponent
@endsection
