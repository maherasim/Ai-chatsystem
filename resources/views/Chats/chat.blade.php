<?php $page = 'index'; ?>
@extends('layout.mainlayout')
@section('content')
<style>
    body {
        overflow-x: hidden;
    }


    .accordion-button::after {
        display: none !important;
    }

    .dropdown-menu {
        max-height: 300px;
        /* or adjust */
        overflow-y: auto;
        overflow-x: hidden;
    }

    /* Prevent parent containers from overflowing */
    .main_content,
    .sidebar-group {
        overflow: visible !important;
    }

    /* Ensure base styles don't interfere */
    .task-icon-link {
        position: relative;
        display: inline-block;
        width: 30px;
        height: 30px;
    }

    .chat-dropdown {
        display: block !important;
        opacity: 1 !important;
        visibility: visible !important;
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

    .chat-options .btn img {
        box-shadow: none !important;
    }

    .chat-options .btn:focus,
    .chat-options .btn:active,
    .chat-options .btn:focus-visible,
    .chat-options .btn:focus-within {
        box-shadow: none !important;
        outline: none !important;
    }

    .chat-options .btn {
        background: transparent !important;
        border: none !important;
        padding: 0 !important;
    }

    .chat-body {
        height: calc(100vh - 200px); /* Adjust based on header and footer height */
        overflow-y: auto !important;
        display: flex;
        flex-direction: column;
    }

    .messages {
        flex: 1;
    }

    /* Message Bubble Size Reduction */
    .chats .chat-content .message-content,
    .chats-right .chat-content .message-content,
    .chats-right .chat-info .message-content {
        padding: 4px 16px !important; /* Reduced vertical padding (height), increased horizontal padding */
        min-height: unset !important;
        margin-bottom: 4px !important;
        line-height: 1.4 !important; /* Tighter line height to reduce height */
    }

    .chats .chat-content .message-content {
        border-radius: 12px 12px 12px 0 !important;
        max-width: 70% !important; /* Set a reasonable max-width, but allow natural expansion */
        width: auto !important; /* Allow natural width based on content */
        word-wrap: normal !important; /* Only break on spaces, not in middle of words */
        overflow-wrap: normal !important; /* Prevent breaking words unnecessarily */
        white-space: normal !important; /* Allow normal text flow */
        word-break: normal !important; /* Don't break words */
    }
    
    /* Left-side (received) message content styling */
    .chats:not(.chats-right) .chat-info > .message-content {
        max-width: 70% !important; /* Set a reasonable max-width, but allow natural expansion */
        width: auto !important; /* Allow natural width based on content */
        min-width: fit-content !important; /* Ensure minimum width fits content */
        line-height: 1.4 !important; /* Tighter line height to reduce height */
        word-wrap: normal !important; /* Only break on spaces, not in middle of words */
        overflow-wrap: normal !important; /* Prevent breaking words unnecessarily */
        white-space: normal !important; /* Allow normal text flow */
        word-break: normal !important; /* Don't break words */
    }

    .chats-right .chat-content .message-content,
    .chats-right .chat-info .message-content {
        border-radius: 16px 16px 2px 16px !important;
    }

    /* Message Alignment Fix */
    .chats.chats-right {
        justify-content: flex-end !important;
        margin-left: auto !important;
        text-align: right !important;
        flex-direction: row !important;
        margin-bottom: 15px !important;
    }

    .chats.chats-right .chat-content {
        order: 1 !important;
        text-align: right !important;
        align-items: flex-end !important;
        display: flex !important;
        flex-direction: column !important;
    }

    .chats.chats-right .chat-avatar {
        order: 2 !important;
        padding-right: 0 !important;
        padding-left: 8px !important;
    }

    .chats.chats-right .chat-profile-name {
        text-align: right !important;
        width: 100% !important;
        margin-bottom: 5px !important;
    }

    .chats.chats-right .chat-info {
        display: flex !important;
        flex-direction: column !important;
        align-items: flex-end !important;
        gap: 0 !important;
    }

    /* Target ONLY the inner message content to avoid double bubbles */
    .chats.chats-right .message-content .message-content {
        background: none !important;
        padding: 0 !important;
        color: inherit !important;
    }

    .chats.chats-right .chat-info > .message-content {
        background: linear-gradient(135deg, #0d6efd 0%, #0052cc 100%) !important;
        color: #ffffff !important;
        border-radius: 16px 16px 2px 16px !important;
        padding: 4px 16px !important; /* Reduced vertical padding (height), increased horizontal padding */
        display: inline-block !important;
        width: auto !important; /* Changed from fit-content to auto for better text flow */
        min-width: fit-content !important; /* Ensure minimum width fits content */
        max-width: 70% !important; /* Set a reasonable max-width, but allow natural expansion */
        flex: 0 1 auto !important;
        margin-left: auto !important;
        text-align: left !important;
        box-shadow: 0 2px 5px rgba(13, 110, 253, 0.2) !important;
        word-wrap: normal !important; /* Only break on spaces, not in middle of words */
        overflow-wrap: normal !important; /* Prevent breaking words unnecessarily */
        white-space: normal !important; /* Allow normal text flow */
        word-break: normal !important; /* Don't break words */
        min-height: unset !important;
        line-height: 1.4 !important; /* Tighter line height to reduce height */
    }
    
    .chats.chats-right .chat-info > .message-content * {
        color: #ffffff !important;
    }

    .chats.chats-right .chat-time {
        color: #adb5bd !important;
        font-size: 0.75rem !important;
    }
    
    .chats.chats-right .chat-profile-name h6 {
        font-weight: 600 !important;
        color: #495057 !important;
    }
</style>



<!-- content -->
<div class="content main_content">
    @include('Chats.chatsidebar')
    <!-- sidebar group -->
    @include('Chats.notification', ['groups' => $groups ?? collect([])])
    <!-- /Sidebar group -->

    <!-- Chat -->


    <!-- Chat -->
    <div class="chat chat-messages show" id="middle">
        <div>
            <div class="chat-header" style="display: flex; justify-content: space-between; align-items: center; gap: 20px;">

                <!-- LEFT: User Info -->
                <div class="user-details d-flex align-items-center gap-2">
                    <div class="d-xl-none">
                        <a class="text-muted chat-close me-2" href="#">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                    <div class="avatar avatar-lg online flex-shrink-0">
                        @php
    $header = $headers[0] ?? null;
@endphp

@if($header)
    <img id="chatHeaderAvatar" src="{{ !empty($header->image) ? asset('storage/' . $header->image) : asset('build/img/profiles/avatar-16.jpg') }}"
         class="rounded-circle"
         alt="image">
@endif
                    </div>
                    <div class="ms-2 overflow-hidden">
                        <h6 id="chatHeaderName">{{$header->first_name ?? 'Chat'}}</h6>
                        <span class="last-seen">Online</span>
                    </div>
                </div>

                <!-- CENTER: Chat Options -->
                <div class="chat-options">
                    <ul class="d-flex align-items-center gap-3 list-unstyled mb-0">
                        <li>
                            <a href="javascript:void(0)" class="btn chat-search-btn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Search">
                                <img src="{{ asset('/build/img/Search-Black.svg') }}" alt="Search" width="18px">
                                <img src="{{ asset('/build/img/Search-White.svg') }}" alt="Search" width="18px">
                            </a>
                        </li>
                        <li data-bs-toggle="tooltip" data-bs-placement="bottom" title="Video Call">
                            <a href="javascript:void(0)" class="btn" data-bs-toggle="modal" data-bs-target="#video-call">
                                <img src="{{ asset('/build/img/VideoCall-Black.svg') }}" alt="Video Call" width="18px">
                                <img src="{{ asset('/build/img/VideoCall-White.svg') }}" alt="Video Call" width="18px">
                            </a>
                        </li>
                        <li data-bs-toggle="tooltip" data-bs-placement="bottom" title="Voice Call">
                            <a href="javascript:void(0)" class="btn" data-bs-toggle="modal" data-bs-target="#voice_call">
                                <img src="{{ asset('/build/img/Call-Black.svg') }}" alt="Voice Call" width="18px">
                                <img src="{{ asset('/build/img/Call-White.svg') }}" alt="Voice Call" width="18px">
                            </a>
                        </li>
                        <li title="Contact Info" data-bs-toggle="tooltip" data-bs-placement="bottom">
                            <a href="javascript:void(0)" class="btn" data-bs-toggle="offcanvas" data-bs-target="#contact-profile">
                                <img src="{{ asset('/build/img/User-Info-Black.svg') }}" alt="User Info" width="18px">
                                <img src="{{ asset('/build/img/User-Info-White.svg') }}" alt="User Info" width="18px">
                            </a>
                        </li>

                    </ul>
                </div>

                <!-- RIGHT: Settings, Theme Toggle, Logout -->
                <div class="right-icons d-flex align-items-center gap-4">
                    <a href="{{ route('settings') }}" class="{{ request()->is('settings') ? 'active' : '' }}">
                        <img src="{{URL::asset('/build/img/setting.svg')}}" alt="setting" style="height: 25px; cursor: pointer;">
                    </a>

                    <!-- Dark Mode Toggle -->
                    <a href="#" id="dark-mode-toggle">
                        <img src="{{ URL::asset('/build/img/Moon.svg') }}" alt="moon" style="height: 25px; cursor: pointer;">
                    </a>
                    <a href="#" id="light-mode-toggle" style="display: none;">
                        <i class="ti ti-sun" style="font-size: 22px; cursor: pointer;"></i>
                    </a>

                    <!-- Logout -->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" style="background: none; border: none; padding: 0; margin: 0;">
                            <img src="{{ URL::asset('/build/img/exit.svg') }}" alt="Logout" style="height: 25px; cursor: pointer;">
                        </button>
                    </form>
                </div>
                <div class="chat-search search-wrap contact-search">
                    <form>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search Contacts">
                            <span class="input-group-text"><i class="ti ti-search"></i></span>
                        </div>
                    </form>
                </div>

            </div>

            <div class="chat-body chat-page-group slimscroll">
                <div class="messages" id="chatMessagesContainer">
                    <!-- Dynamic messages will be rendered here -->
                    <div id="emptyChatState" style="display: flex; align-items: center; justify-content: center; height: 100%; min-height: 400px; flex-direction: column; color: #7f8ea3;">
                        <i class="ti ti-message-circle" style="font-size: 48px; margin-bottom: 16px; opacity: 0.5;"></i>
                        <p style="font-size: 16px; margin: 0;">Select a group to start chatting</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="chat-footer">
            <form class="footer-form">
                <div class="chats reply-chat reply-div" id="reply-div">
                    <div class="chat-avatar">
                        <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="image">
                    </div>
                    <div class="chat-content">
                        <div class="chat-profile-name">
                            <h6>Edward Lietz<i class="ti ti-circle-filled fs-7 mx-2"></i><span class="chat-time">02:39 PM</span><span class="msg-read success"><i class="ti ti-checks"></i></span></h6>
                        </div>
                        <div class="chat-info">
                            <div class="message-content">
                                <div class="message-reply reply-content">
                                    Thank you for your support
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="close-replay">
                        <i class="ti ti-x"></i>
                    </a>
                </div>
                <div class="chat-footer-wrap">
                    <div class="form-item">
                        <a href="#" class="action-circle"><i class="ti ti-microphone"></i></a>
                    </div>
                    <div class="form-wrap">
                        <input type="text" class="form-control" placeholder="Type Your Message">
                    </div>
                    <div class="form-item emoj-action-foot">
                        <a href="#" class="action-circle"><i class="ti ti-mood-smile"></i></a>
                        <div class="emoj-group-list-foot down-emoji-circle">
                            <ul>
                                <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-02.svg')}}" alt="Icon"></a></li>
                                <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-05.svg')}}" alt="Icon"></a></li>
                                <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-06.svg')}}" alt="Icon"></a></li>
                                <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-07.svg')}}" alt="Icon"></a></li>
                                <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-08.svg')}}" alt="Icon"></a></li>
                                <li class="add-emoj"><a href="javascript:void(0);"><i class="ti ti-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-item position-relative d-flex align-items-center justify-content-center ">
                        <a href="#" class="action-circle file-action position-absolute">
                            <i class="ti ti-folder"></i>
                        </a>
                        <input type="file" class="open-file position-relative" name="files" id="files">
                    </div>
                    <div class="form-item">
                        <a href="#" data-bs-toggle="dropdown">
                            <i class="ti ti-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end p-3">
                            <a href="#" class="dropdown-item"><i class="ti ti-camera-selfie me-2"></i>Camera</a>
                            <a href="#" class="dropdown-item"><i class="ti ti-photo-up me-2"></i>Gallery</a>
                            <a href="#" class="dropdown-item"><i class="ti ti-music me-2"></i>Audio</a>
                            <a href="#" class="dropdown-item"><i class="ti ti-map-pin-share me-2"></i>Location</a>
                            <a href="#" class="dropdown-item"><i class="ti ti-user-check me-2"></i>Contact</a>
                        </div>
                    </div>
                    <div class="form-btn">
                        <button class="btn btn-primary" type="submit">
                            <i class="ti ti-send"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- /Chat -->

    <!-- Contact Info -->
    <div class="chat-offcanvas offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="contact-profile" aria-labelledby="chatUserMoreLabel">
        <div class="offcanvas-header">
            <h4 class="offcanvas-title" id="chatUserMoreLabel">Contact Info</h4>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i class="ti ti-x"></i></button>
        </div>
        <div class="offcanvas-body">
            <div class="chat-contact-info">
                <div class="profile-content">
                    <div class="contact-profile-info">
                        <div class="avatar avatar-xxl online mb-2">
                            <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="img">
                        </div>
                        <h6>Edward Lietz</h6>
                        <p>Last seen at 07:15 PM</p>
                    </div>
                    <div class="row gx-3">
                        <div class="col">
                            <a class="action-wrap">
                                <i class="ti ti-phone"></i>
                                <p>Audio</p>
                            </a>
                        </div>
                        <div class="col">
                            <a class="action-wrap">
                                <i class="ti ti-video"></i>
                                <p>Video</p>
                            </a>
                        </div>
                        <div class="col">
                            <a class="action-wrap">
                                <i class="ti ti-brand-hipchat"></i>
                                <p>Chat</p>
                            </a>
                        </div>
                        <div class="col">
                            <a class="action-wrap">
                                <i class="ti ti-search"></i>
                                <p>Search</p>
                            </a>
                        </div>
                    </div>
                    <div class="content-wrapper">
                        <h5 class="sub-title">Profile Info</h5>
                        <div class="card">
                            <div class="card-body">
                                <ul class="list-group profile-item">
                                    <li class="list-group-item">
                                        <div class="profile-info">
                                            <h6>Name</h6>
                                            <p>Edward Lietz</p>
                                        </div>
                                        <div class="profile-icon">
                                            <i class="ti ti-user-circle"></i>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="info">
                                            <h6>Email Address</h6>
                                            <p>info@example.com</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ti ti-mail-heart"></i>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="info">
                                            <h6>Phone</h6>
                                            <p>555-555-21541</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ti ti-phone-check"></i>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="info">
                                            <h6>Bio</h6>
                                            <p>Hello, I am using DreamsChat</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ti ti-user-check"></i>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="content-wrapper">
                        <h5 class="sub-title">Social Profiles</h5>
                        <div class="card">
                            <div class="card-body">
                                <div class="social-icon">
                                    <a href="javascript:void(0);"><i class="ti ti-brand-facebook"></i></a>
                                    <a href="javascript:void(0);"><i class="ti ti-brand-twitter"></i></a>
                                    <a href="javascript:void(0);"><i class="ti ti-brand-instagram"></i></a>
                                    <a href="javascript:void(0);"><i class="ti ti-brand-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-wrapper">
                        <h5 class="sub-title">Media Details</h5>
                        <div class="chat-file">
                            <div class="file-item action-wrap">
                                <div class="accordion accordion-flush chat-accordion" id="mediafile">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <a href="#" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#chatuser-collapse1" aria-expanded="false" aria-controls="chatuser-collapse1">
                                                <i class="ti ti-photo-shield me-2"></i>Photos
                                            </a>
                                        </h2>
                                        <div id="chatuser-collapse1" class="accordion-collapse collapse" data-bs-parent="#mediafile">
                                            <div class="accordion-body">
                                                <div class="chat-user-photo">
                                                    <div class="chat-img contact-gallery">
                                                        <div class="img-wrap">
                                                            <img src="{{URL::asset('/build/img/gallery/gallery-01.jpg')}}" alt="img">
                                                            <div class="img-overlay">
                                                                <a class="gallery-img" data-fancybox="gallery-img" href="{{URL::asset('/build/imggallery/gallery-01.jpg')}}" title="Demo 01"><i class="ti ti-eye"></i></a>
                                                                <a href="#"><i class="ti ti-download"></i></a>
                                                            </div>
                                                        </div>
                                                        <div class="img-wrap">
                                                            <img src="{{URL::asset('/build/img/gallery/gallery-02.jpg')}}" alt="img">
                                                            <div class="img-overlay">
                                                                <a class="gallery-img" data-fancybox="gallery-img" href="{{URL::asset('/build/img/gallery/gallery-02.jpg')}}" title="Demo 02"><i class="ti ti-eye"></i></a>
                                                                <a href="#"><i class="ti ti-download"></i></a>
                                                            </div>
                                                        </div>
                                                        <div class="img-wrap">
                                                            <img src="{{URL::asset('/build/img/gallery/gallery-03.jpg')}}" alt="img">
                                                            <div class="img-overlay">
                                                                <a class="gallery-img" data-fancybox="gallery-img" href="{{URL::asset('/build/img/gallery/gallery-03.jpg')}}" title="Demo 03"><i class="ti ti-eye"></i></a>
                                                                <a href="#"><i class="ti ti-download"></i></a>
                                                            </div>
                                                        </div>
                                                        <div class="img-wrap">
                                                            <img src="{{URL::asset('/build/img/gallery/gallery-04.jpg')}}" alt="img">
                                                            <div class="img-overlay">
                                                                <a class="gallery-img" data-fancybox="gallery-img" href="{{URL::asset('/build/img/gallery/gallery-04.jpg')}}" title="Demo 04"><i class="ti ti-eye"></i></a>
                                                                <a href="#"><i class="ti ti-download"></i></a>
                                                            </div>
                                                        </div>
                                                        <div class="img-wrap">
                                                            <img src="{{URL::asset('/build/img/gallery/gallery-05.jpg')}}" alt="img">
                                                            <div class="img-overlay">
                                                                <a class="gallery-img" data-fancybox="gallery-img" href="{{URL::asset('/build/img/gallery/gallery-05.jpg')}}" title="Demo     04"><i class="ti ti-eye"></i></a>
                                                                <a href="#"><i class="ti ti-download"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="text-center">
                                                        <a class="gallery-img view-all link-primary d-inline-flex align-items-center justify-content-center mt-3" href="{{URL::asset('/build/img/gallery/gallery-05.jpg')}}" data-fancybox="gallery-img">
                                                            All Images<i class="ti ti-arrow-right ms-2"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <a href="#" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#media-video" aria-expanded="false" aria-controls="media-video">
                                                <i class="ti ti-video me-2"></i>Videos
                                            </a>
                                        </h2>
                                        <div id="media-video" class="accordion-collapse collapse" data-bs-parent="#mediafile">
                                            <div class="accordion-body">
                                                <div class="chat-video">
                                                    <a href="https://www.youtube.com/embed/Mj9WJJNp5wA" data-fancybox="" class="fancybox video-img">
                                                        <img src="{{URL::asset('/build/img/video/video.jpg')}}" alt="img">
                                                        <span><i class="ti ti-player-play-filled"></i></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <a href="#" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#media-links" aria-expanded="false" aria-controls="media-links">
                                                <i class="ti ti-unlink me-2"></i>Links
                                            </a>
                                        </h2>
                                        <div id="media-links" class="accordion-collapse collapse" data-bs-parent="#mediafile">
                                            <div class="accordion-body">
                                                <div class="link-item">
                                                    <span class="link-icon">
                                                        <img src="{{URL::asset('/build/img/icons/github-icon.svg')}}" alt="icon">
                                                    </span>
                                                    <div class="ms-2">
                                                        <p>https://segmentfault.com/u/ans</p>
                                                    </div>
                                                </div>
                                                <div class="link-item">
                                                    <span class="link-icon">
                                                        <img src="{{URL::asset('/build/img/icons/info-icon.svg')}}" alt="icon">
                                                    </span>
                                                    <div class="ms-2">
                                                        <p>https://segmentfault.com/u/ans</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <a href="#" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#media-document" aria-expanded="false" aria-controls="media-document">
                                                <i class="ti ti-unlink me-2"></i>Documents
                                            </a>
                                        </h2>
                                        <div id="media-document" class="accordion-collapse collapse" data-bs-parent="#mediafile">
                                            <div class="accordion-body">
                                                <div class="document-item">
                                                    <div class="d-flex align-items-center">
                                                        <span class="document-icon">
                                                            <i class="ti ti-file-zip"></i>
                                                        </span>
                                                        <div class="ms-2">
                                                            <h6>Ecommerce.zip</h6>
                                                            <p>10.25 MB zip file</p>
                                                        </div>
                                                    </div>
                                                    <a href="javascript:void(0);" class="download-icon">
                                                        <i class="ti ti-download"></i>
                                                    </a>
                                                </div>
                                                <div class="document-item">
                                                    <div class="d-flex align-items-center">
                                                        <span class="document-icon">
                                                            <i class="ti ti-video"></i>
                                                        </span>
                                                        <div class="ms-2">
                                                            <h6>video-1.mp4</h6>
                                                            <p>20.50 MB video file</p>
                                                        </div>
                                                    </div>
                                                    <a href="javascript:void(0);" class="download-icon">
                                                        <i class="ti ti-download"></i>
                                                    </a>
                                                </div>
                                                <div class="document-item">
                                                    <div class="d-flex align-items-center">
                                                        <span class="document-icon">
                                                            <i class="ti ti-music"></i>
                                                        </span>
                                                        <div class="ms-2">
                                                            <h6>Ecommerce.zip</h6>
                                                            <p>6.25 MB audio file</p>
                                                        </div>
                                                    </div>
                                                    <a href="javascript:void(0);" class="download-icon">
                                                        <i class="ti ti-download"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-wrapper other-info">
                        <h5 class="sub-title">Common in 4 Groups</h5>
                        <div class="card">
                            <div class="card-body list-group profile-item">
                                <a href="javascript:void(0);" class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-lg bg-skyblue rounded-circle me-2">
                                            GU
                                        </div>
                                        <div class="chat-user-info">
                                            <h6>Gustov _family</h6>
                                            <p>Mark, Elizabeth, Aaron, <span class="text-primary">More...</span></p>
                                        </div>
                                    </div>
                                    <span class="link-icon"><i class="ti ti-chevron-right"></i></span>
                                </a>
                                <a href="javascript:void(0);" class="list-group-item border-0">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-lg bg-info rounded-circle me-2">
                                            AM
                                        </div>
                                        <div class="chat-user-info">
                                            <h6>AM Technology</h6>
                                            <p>Roper, Deborah, David, <span class="text-primary">More..


                                                    .</span></p>
                                        </div>
                                    </div>
                                    <span class="link-icon"><i class="ti ti-chevron-right"></i></span>
                                </a>
                                <div class="text-center">
                                    <a href="javascript:void(0);" class="view-all link-primary d-inline-flex align-items-center justify-content-center">
                                        More Groups<i class="ti ti-arrow-right ms-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-wrapper other-info mb-0">
                        <h5 class="sub-title">Others</h5>
                        <div class="card mb-0">
                            <div class="card-body list-group profile-item">
                                <a href="javascript:void(0);" class="list-group-item" data-bs-toggle="offcanvas" data-bs-target="#contact-favourite">
                                    <div class="profile-info">
                                        <h6><i class="ti ti-graph me-2 text-default"></i>Favorites</h6>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="badge badge-danger count-message me-1">12</span>
                                        <span class="link-icon"><i class="ti ti-chevron-right"></i></span>
                                    </div>
                                </a>
                                <a href="javascript:void(0);" class="list-group-item">
                                    <div class="profile-info">
                                        <h6><i class="ti ti-volume-off me-2 text-warning"></i>Mute Notifications</h6>
                                    </div>
                                    <div>
                                        <span class="link-icon"><i class="ti ti-chevron-right"></i></span>
                                    </div>
                                </a>
                                <a href="javascript:void(0);" class="list-group-item">
                                    <div class="profile-info">
                                        <h6><i class="ti ti-user-off me-2 text-info"></i>Block Users</h6>
                                    </div>
                                    <div>
                                        <span class="link-icon"><i class="ti ti-chevron-right"></i></span>
                                    </div>
                                </a>
                                <a href="javascript:void(0);" class="list-group-item">
                                    <div class="profile-info">
                                        <h6><i class="ti ti-user-x me-2 text-purple"></i>Report Users</h6>
                                    </div>
                                    <div>
                                        <span class="link-icon"><i class="ti ti-chevron-right"></i></span>
                                    </div>
                                </a>
                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete-chat" class="list-group-item">
                                    <div class="profile-info">
                                        <h6><i class="ti ti-trash me-2 text-danger"></i>Delete Chat</h6>
                                    </div>
                                    <div>
                                        <span class="link-icon"><i class="ti ti-chevron-right"></i></span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Contact Info -->
    <!-- New Chat -->
    <div class="modal fade" id="new-chat">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New Chat</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{url('chat')}}">
                        <div class="search-wrap contact-search mb-3">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search">
                                <a href="javascript:void(0);" class="input-group-text"><i class="ti ti-search"></i></a>
                            </div>
                        </div>
                        <h6 class="mb-3 fw-medium fs-16">Contacts</h6>
                        <div class="contact-scroll contact-select mb-3">
                            <div class="contact-user d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-lg">
                                        <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle" alt="image">
                                    </div>
                                    <div class="ms-2">
                                        <h6>Aaryian Jose</h6>
                                        <p>App Developer</p>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="contact">
                                </div>
                            </div>
                            <div class="contact-user d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-lg">
                                        <img src="{{URL::asset('/build/img/profiles/avatar-02.jpg')}}" class="rounded-circle" alt="image">
                                    </div>
                                    <div class="ms-2">
                                        <h6>Sarika Jain</h6>
                                        <p>UI/UX Designer</p>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="contact">
                                </div>
                            </div>
                            <div class="contact-user d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-lg">
                                        <img src="{{URL::asset('/build/img/profiles/avatar-03.jpg')}}" class="rounded-circle" alt="image">
                                    </div>
                                    <div class="ms-2">
                                        <h6>Clyde Smith</h6>
                                        <p>Web Developer</p>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="contact">
                                </div>
                            </div>
                            <div class="contact-user d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-lg">
                                        <img src="{{URL::asset('/build/img/profiles/avatar-04.jpg')}}" class="rounded-circle" alt="image">
                                    </div>
                                    <div class="ms-2">
                                        <h6>Carla Jenkins</h6>
                                        <p>Business Analyst</p>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="contact">
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-6">
                                <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary w-100">Start Chat</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /New Chat -->
    <!-- Video Call Modal -->
    <div class="modal fade" id="video-call" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header justify-content-center border-0">
                    <span class="model-icon bg-primary d-flex justify-content-center align-items-center rounded-circle me-2">
                        <i class="ti ti-video"></i>
                    </span>
                    <h4 class="modal-title">Video Calling...</h4>
                </div>
                <div class="modal-body pb-0">
                    <div class="card bg-light mb-0">
                        <div class="card-body d-flex justify-content-center">
                            <div>
                                <span class="avatar avatar-xxl">
                                    <img src="{{ URL::asset('/build/img/profiles/avatar-06.jpg') }}" class="rounded-circle" alt="user">
                                </span>
                                <h6 class="fs-14 mt-2">Edward Lietz</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center border-0">
                    <!-- Replaces direct modal trigger with JS -->
                    <a href="javascript:void(0);" onclick="openStartVideoCall()" class="voice-icon btn btn-success rounded-circle d-flex justify-content-center align-items-center me-2">
                        <i class="ti ti-phone fs-20"></i>
                    </a>
                    <a href="javascript:void(0);" class="voice-icon btn btn-danger rounded-circle d-flex justify-content-center align-items-center" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ti ti-phone-off fs-20"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- Voice Call Modal -->
<div class="modal fade" id="voice_call" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header justify-content-center border-0">
                <span class="model-icon bg-primary d-flex justify-content-center align-items-center rounded-circle me-2">
                    <i class="ti ti-phone-call"></i>
                </span>
                <h4 class="modal-title">Audio Calling...</h4>
            </div>
            <div class="modal-body pb-0">
                <div class="card bg-light mb-0">
                    <div class="card-body d-flex justify-content-center">
                        <div>
                            <span class="avatar avatar-xxl">
                                <img src="{{ URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="user">
                            </span>
                            <h6 class="fs-14">Edward Lietz</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center border-0">
                <!-- Attend button -->
                <a href="javascript:void(0);"
                    class="voice-icon btn btn-success rounded-circle d-flex justify-content-center align-items-center me-2"
                    data-bs-dismiss="modal"
                    onclick="setTimeout(() => { new bootstrap.Modal(document.getElementById('voice_attend')).show(); }, 300);">
                    <i class="ti ti-phone fs-20"></i>
                </a>

                <!-- Cancel button -->
                <a href="javascript:void(0);"
                    class="voice-icon btn btn-danger rounded-circle d-flex justify-content-center align-items-center"
                    data-bs-dismiss="modal">
                    <i class="ti ti-phone-off fs-20"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Voice Call Attend Modal -->
<div class="modal fade" id="voice_attend" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-flex border-0 pb-0">
                <div class="card bg-transparent-dark flex-fill border mb-3">
                    <div class="card-body d-flex justify-content-between p-3 flex-wrap row-gap-3">
                        <div class="d-flex align-items-center">
                            <span class="avatar avatar-lg online me-2">
                                <img src="{{ URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="user">
                            </span>
                            <div>
                                <h6>Edward Lietz</h6>
                                <span>+22-555-345-11</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="badge border border-primary text-primary badge-sm me-2">
                                <i class="ti ti-point-filled"></i> 01:15:25
                            </span>
                            <a href="javascript:void(0);" class="user-add bg-primary rounded d-flex justify-content-center align-items-center text-white">
                                <i class="ti ti-user-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body border-0 pt-0">
                <div class="card audio-crd bg-transparent-dark border">
                    <div class="modal-bgimg">
                        <span class="modal-bg1">
                            <img src="{{ URL::asset('/build/img/bg/bg-02.png')}}" class="img-fluid" alt="bg">
                        </span>
                        <span class="modal-bg2">
                            <img src="{{ URL::asset('/build/img/bg/bg-03.png')}}" class="img-fluid" alt="bg">
                        </span>
                    </div>
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-center align-items-center pt-5">
                            <span class="avatar avatar-xxxl bg-soft-primary rounded-circle p-2">
                                <img src="{{ URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="user">
                            </span>
                        </div>
                        <div class="d-flex align-items-end justify-content-end">
                            <span class="call-span border border-2 border-primary d-flex justify-content-center align-items-center rounded">
                                <span class="avatar avatar-xl bg-soft-primary rounded-circle p-2">
                                    <img src="{{ URL::asset('/build/img/profiles/avatar-17.jpg')}}" class="rounded-circle" alt="user">
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer justify-content-center border-0 pt-0">
                <div class="call-controll-block d-flex align-items-center justify-content-center rounded-pill">
                    <a href="javascript:void(0);" class="call-controll mute-bt d-flex align-items-center justify-content-center">
                        <i class="ti ti-microphone"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-volume"></i>
                    </a>

                    <!-- End Call -->
                    <a href="javascript:void(0);" data-bs-dismiss="modal" class="call-controll call-decline d-flex align-items-center justify-content-center">
                        <i class="ti ti-phone"></i>
                    </a>

                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-maximize"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-dots"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @component('components.model-popup')
    @endcomponent
</div>



<!-- New Group -->
<div class="modal fade" id="new-group">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Group</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('index')}}">
                    <div class="d-flex justify-content-center align-items-center">
                        <label for="avatar-upload" class="set-pro avatar avatar-xxl rounded-circle mb-3 p-1">
                            <span class="avatar avatar-xl bg-transparent-dark rounded-circle"></span>
                            <span class="add avatar avatar-sm d-flex justify-content-center align-items-center">
                                <i class="ti ti-plus rounded-circle d-flex justify-content-center align-items-center"></i>
                            </span>
                        </label>
                        <input type="file" id="avatar-upload" style="display: none;" accept="image/*">
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <label class="form-label">Group Name</label>
                            <div class="input-icon mb-3 position-relative">
                                <input type="text" value="" class="form-control" placeholder="First Name">
                                <span class="icon-addon">
                                    <i class="ti ti-users-group"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label class="form-label">About</label>
                            <div class="input-icon mb-3 position-relative">
                                <input type="text" value="" class="form-control" placeholder="Last Name">
                                <span class="icon-addon">
                                    <i class="ti ti-info-octagon"></i>
                                </span>
                            </div>
                        </div>
                        <label class="form-label">Group Type</label>
                        <div class="d-flex">

                            <div class="form-check me-3">
                                <input class="form-check-input" type="radio" name="mute" id="group1">
                                <label class="form-check-label" for="group1">Public</label>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" name="mute" id="group2">
                                <label class="form-check-label" for="group2">Private</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#add-group">Next</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /New Group -->

<script>
    const toggleIcon = document.getElementById("toggleIcon");
    const chevron = document.getElementById("chevronIcon");

    toggleIcon.addEventListener("click", () => {
        setTimeout(() => {
            chevron.classList.toggle("ti-chevron-down");
            chevron.classList.toggle("ti-chevron-up");
        }, 150);
    });
</script>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        const body = document.body;
        const darkBtn = document.getElementById('dark-mode-toggle');
        const lightBtn = document.getElementById('light-mode-toggle');

        darkBtn.addEventListener('click', function(e) {
            e.preventDefault();
            body.classList.add('dark-mode');
            darkBtn.style.display = 'none';
            lightBtn.style.display = 'inline';
        });

        lightBtn.addEventListener('click', function(e) {
            e.preventDefault();
            body.classList.remove('dark-mode');
            lightBtn.style.display = 'none';
            darkBtn.style.display = 'inline';
        });
    });
</script>

<!-- Bootstrap JS Bundle (includes Popper) -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->

@component('components.model-popup')
@endcomponent

<!-- Agora Chat SDK -->
<script src="https://download.agora.io/sdk/release/AgoraChat-sdk-Web.js"></script>

<!-- Pass current user ID to JS -->
<script>
    window.currentUserId = "{{ (string)Auth::id() }}";
    window.currentUserAvatar = "{{ Auth::user()->image ? asset(ltrim(Auth::user()->image, '/')) : asset('build/img/profiles/avatar-17.jpg') }}";
</script>

<!-- Group Chat Manager -->
<script src="{{ asset('js/group-chat.js') }}"></script>

<script>
    // Initialize group chat on page load
    document.addEventListener('DOMContentLoaded', () => {
        // Initialize Agora Chat
        if (window.groupChatManager) {
            window.groupChatManager.initAgora().then(() => {
                @if(isset($groups) && count($groups) > 0)
                    @php $firstGroup = $groups[0]; @endphp
                    window.groupChatManager.openGroupChat('{{ $firstGroup['id'] }}', '{{ addslashes($firstGroup['name']) }}', '{{ $firstGroup['team_photo'] }}');
                @endif
            });
        }
    });
</script>

@endsection