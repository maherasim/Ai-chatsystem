<?php $page = 'index'; ?>
@extends('layout.mainlayout')
@section('content')

<style>
    /* Ensure base styles don't interfere */
    body {
        overflow-x: hidden;

    }

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

    .elevated-card {
        border-radius: 12px;
        border: 1px solid #dee2e6;
        /* Light-dark border */
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
        /* very light shadow */
        transform: translateY(-2px);
        /* very slight lift */
        background-color: #fff;
        padding: 20px;
        text-align: center;
    }


    .employee-grid img {
        border-radius: 50%;
        width: 80px;
        height: 80px;
        object-fit: cover;
        margin-bottom: 10px;
    }

    .employee-grid h6 {
        margin-bottom: 2px;
        font-weight: 600;
    }

    .employee-grid small {
        color: #888;
        font-size: 12px;
    }

    .progress {
        height: 6px;
        border-radius: 3px;
        background-color: #eee;
    }

    .progress-bar {
        border-radius: 3px;
    }

    .bg-purple {
        background-color: purple;
    }

    /* Thin scrollbar for Webkit browsers */
    .offcanvas-body::-webkit-scrollbar {
        width: 6px;
    }

    .offcanvas-body::-webkit-scrollbar-track {
        background: transparent;
    }

    .offcanvas-body::-webkit-scrollbar-thumb {
        background-color: #ccc;
        border-radius: 10px;
        border: 1px solid transparent;
    }

    /* Thin scrollbar for Firefox */
    .offcanvas-body {
        scrollbar-width: thin;
        scrollbar-color: #ccc transparent;
    }
</style>




<!-- content -->
<div class="content main_content">

    <!-- Left Sidebar Menu -->


    @include('Chats.chatsidebar')

    <!-- /Left Sidebar Menu -->

    <!-- sidebar group -->
    <div class="sidebar-group">
        <div class="tab-content">
            <div class="tab-pane fade active show " id="chat-menu">
                <!-- Chats sidebar -->
                <div id="chats" class="sidebar-content active slimscroll">

                    <div class="slimscroll">
                        <!-- Online user -->
                        <div class="top-online-contacts">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="mb-3">Users Online</h5>
                                <div class="dropdown mb-3">
                                    <a href="#" class="text-default" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-dots-vertical"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end p-3">
                                        <li><a class="dropdown-item mb-1" href="#"><i class="ti ti-eye-off me-2"></i>Hide Recent</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="feather-users me-2"></i>Active Contacts</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <a href="{{url('chat')}}" class="chat-status text-center">
                                            <div class="avatar avatar-lg online d-block">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-11.jpg')}}" alt="Image" class="rounded-circle">
                                            </div>
                                            <p>Nichol</p>
                                        </a>
                                    </div>
                                    <div class="swiper-slide">
                                        <a href="{{url('chat')}}" class="chat-status text-center">
                                            <div class="avatar avatar-lg online d-block">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-12.jpg')}}" alt="Image" class="rounded-circle">
                                            </div>
                                            <p>Titus</p>
                                        </a>
                                    </div>
                                    <div class="swiper-slide">
                                        <a href="{{url('chat')}}" class="chat-status text-center">
                                            <div class="avatar avatar-lg online d-block">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-14.jpg')}}" alt="Image" class="rounded-circle">
                                            </div>
                                            <p>Geoffrey</p>
                                        </a>
                                    </div>
                                    <div class="swiper-slide">
                                        <a href="{{url('chat')}}" class="chat-status text-center">
                                            <div class="avatar avatar-lg online d-block">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-15.jpg')}}" alt="Image" class="rounded-circle">
                                            </div>
                                            <p>Laverty</p>
                                        </a>
                                    </div>
                                    <div class="swiper-slide">
                                        <a href="{{url('chat')}}" class="chat-status text-center">
                                            <div class="avatar avatar-lg online bg-primary avatar-rounded">
                                                <span class="avatar-title fs-14 fw-medium">KG</span>
                                            </div>
                                            <p>Kitamura</p>
                                        </a>
                                    </div>
                                    <div class="swiper-slide">
                                        <a href="{{url('chat')}}" class="chat-status text-center">
                                            <div class="avatar avatar-lg online d-block">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" alt="Image" class="rounded-circle">
                                            </div>
                                            <p>Mark</p>
                                        </a>
                                    </div>
                                    <div class="swiper-slide">
                                        <a href="{{url('chat')}}" class="chat-status text-center">
                                            <div class="avatar avatar-lg online d-block">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-05.jpg')}}" alt="Image" class="rounded-circle">
                                            </div>
                                            <p>Smith</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Online Contacts -->

                        <div class="sidebar-body chat-body" id="chatsidebar">

                            <!-- Left Chat Title -->
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="chat-title">Today Meeting</h5>
                            </div>
                            <!-- Pinned Chats-->
                            <div class="tab-content pb-4" id="innerTabContent">
                                <div class="tab-pane fade show active" id="all-chats" role="tabpanel" aria-labelledby="all-chats-tab">
                                    <div class="chat-users-wrap">
                                        <div class="chat-list">
                                            <a href="#" class="chat-user-list">
                                                <div class="avatar avatar-lg  me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle border border-warning border-2" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Meeting Title</h6>
                                                        <p>In 1 Hours
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- todo list -->
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <h5 class="chat-title">Today ToDO List</h5>
                            </div>
                            <div class="tab-content mb-4" id="innerTabContent">
                                <div class="tab-pane fade show active" id="all-chats" role="tabpanel" aria-labelledby="all-chats-tab">
                                    <div class="chat-users-wrap">
                                        <div class="chat-list">
                                            <a href="#" class="chat-user-list">
                                                <div class="avatar avatar-lg  me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle border border-warning border-2" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>ToDo Title</h6>
                                                        <p> Expired In 2 Hours </p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="favourites-chat" role="tabpanel" aria-labelledby="favourites-chat-tab">
                                    <div class="chat-users-wrap">


                                        <div class="chat-list">
                                            <a href="#" class="chat-user-list">
                                                <div class="avatar avatar-lg  me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-05.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Federico Wells</h6>
                                                        <p><i class="ti ti-photo me-2"></i>Photo</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">Wednesday</span>
                                                        <div class="chat-pin">
                                                            <i class="ti ti-pin me-2"></i>
                                                            <span class="count-message fs-12 fw-semibold">12</span>
                                                            <i class="bx bx-check-double"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="#" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle border border-warning border-2" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Mark Villiamss</h6>
                                                        <p><span class="animate-typing">is typing
                                                                <span class="dot"></span>
                                                                <span class="dot"></span>
                                                                <span class="dot"></span>
                                                            </span>
                                                        </p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">02:40 PM</span>
                                                        <div class="chat-pin">
                                                            <i class="ti ti-pin me-2"></i>
                                                            <span class="count-message fs-12 fw-semibold">12</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="#" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-02.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Sarika Jain</h6>
                                                        <p>Do you know which...</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">06:12 AM</span>
                                                        <div class="chat-pin">
                                                            <i class="ti ti-pin me-2"></i>
                                                            <i class="ti ti-checks text-success"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="#" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Edward Lietz</h6>
                                                        <p><i class="ti ti-file me-2"></i>Document</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">02:40 PM</span>
                                                        <div class="chat-pin">
                                                            <i class="ti ti-checks text-success"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="#" class="chat-user-list">
                                                <div class="avatar avatar-lg bg-skyblue online avatar-rounded me-2">
                                                    <span class="avatar-title fs-14 fw-medium">GU</span>
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Gustov_family</h6>
                                                        <p>Please Check<span class="text-primary ms-1">@rev</span></p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">24 Jul 2024</span>
                                                        <div class="chat-pin">
                                                            <i class="ti ti-heart-filled text-warning me-2"></i>
                                                            <span class="count-message fs-12 fw-semibold">25</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="#" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-07.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Estell Gibson</h6>
                                                        <p class="text-danger"><i class="ti ti-video-off me-2"></i>Missed Video Call</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">02:40 PM</span>
                                                        <div class="chat-pin">
                                                            <i class="ti ti-heart-filled text-warning me-2"></i>
                                                            <i class="ti ti-checks text-success"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="#" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-08.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Sharon Ford</h6>
                                                        <p>Hi How are you 🔥</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">02:40 PM</span>
                                                        <div class="chat-pin">
                                                            <span class="count-message fs-12 fw-semibold">25</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="#" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-09.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Thomas Rethman</h6>
                                                        <p>Do you know which...</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">02:40 PM</span>
                                                        <div class="chat-pin">
                                                            <i class="ti ti-heart-filled text-warning"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="#" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-10.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Wilbur Martinez</h6>
                                                        <p>Haha oh man 🔥</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">02:40 PM</span>
                                                        <div class="chat-pin">
                                                            <i class="ti ti-pin me-2"></i>
                                                            <i class="ti ti-checks text-success"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="#" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-11.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Danielle Baker</h6>
                                                        <p><i class="ti ti-map-pin-plus me-2"></i>Location</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">02:40 PM</span>
                                                        <div class="chat-pin">
                                                            <i class="ti ti-checks text-success"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="#" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-13.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Morkel Jerrin</h6>
                                                        <p><i class="ti ti-video me-2"></i>Video</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">02:40 PM</span>
                                                        <div class="chat-pin">
                                                            <i class="ti ti-heart-filled text-warning me-2"></i>
                                                            <span class="count-message fs-12 fw-semibold">25</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pinned-chats" role="tabpanel" aria-labelledby="pinned-chats-tab">
                                    <div class="chat-users-wrap">
                                        <div class="chat-list">
                                            <a href="{{url('chat')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-04.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Carla Jenkins</h6>
                                                        <p class="text-success"><i class="ti ti-video-plus me-2"></i>Incoming Video Call</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">Sunday</span>
                                                        <div class="chat-pin">
                                                            <i class="ti ti-checks text-success"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('chat')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-05.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Federico Wells</h6>
                                                        <p><i class="ti ti-photo me-2"></i>Photo</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">Wednesday</span>
                                                        <div class="chat-pin">
                                                            <i class="ti ti-pin me-2"></i>
                                                            <span class="count-message fs-12 fw-semibold">12</span>
                                                            <i class="bx bx-check-double"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('chat')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-03.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Clyde Smith</h6>
                                                        <p>Haha oh man 🔥</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">03:15 AM</span>
                                                        <div class="chat-pin">
                                                            <i class="ti ti-pin me-2"></i>
                                                            <span class="count-message fs-12 fw-semibold">55</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('chat')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg bg-pink avatar-rounded me-2">
                                                    <span class="avatar-title fs-14 fw-medium">AG</span>
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Amfr_boys_Group</h6>
                                                        <p><i class="ti ti-photo me-2"></i>Photo</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">Yesterday</span>
                                                        <div class="chat-pin">
                                                            <span class="count-message fs-12 fw-semibold">5</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="#" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle border border-warning border-2" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Mark Villiamss</h6>
                                                        <p><span class="animate-typing">is typing
                                                                <span class="dot"></span>
                                                                <span class="dot"></span>
                                                                <span class="dot"></span>
                                                            </span>
                                                        </p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">02:40 PM</span>
                                                        <div class="chat-pin">
                                                            <i class="ti ti-pin me-2"></i>
                                                            <span class="count-message fs-12 fw-semibold">12</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="#" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-02.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Sarika Jain</h6>
                                                        <p>Do you know which...</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">06:12 AM</span>
                                                        <div class="chat-pin">
                                                            <i class="ti ti-pin me-2"></i>
                                                            <i class="ti ti-checks text-success"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('chat')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Edward Lietz</h6>
                                                        <p><i class="ti ti-file me-2"></i>Document</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">02:40 PM</span>
                                                        <div class="chat-pin">
                                                            <i class="ti ti-checks text-success"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('chat')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg bg-skyblue online avatar-rounded me-2">
                                                    <span class="avatar-title fs-14 fw-medium">GU</span>
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Gustov_family</h6>
                                                        <p>Please Check<span class="text-primary ms-1">@rev</span></p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">24 Jul 2024</span>
                                                        <div class="chat-pin">
                                                            <i class="ti ti-heart-filled text-warning me-2"></i>
                                                            <span class="count-message fs-12 fw-semibold">25</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('chat')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-07.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Estell Gibson</h6>
                                                        <p class="text-danger"><i class="ti ti-video-off me-2"></i>Missed Video Call</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">02:40 PM</span>
                                                        <div class="chat-pin">
                                                            <i class="ti ti-heart-filled text-warning me-2"></i>
                                                            <i class="ti ti-checks text-success"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('chat')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-08.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Sharon Ford</h6>
                                                        <p>Hi How are you 🔥</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">02:40 PM</span>
                                                        <div class="chat-pin">
                                                            <span class="count-message fs-12 fw-semibold">25</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('chat')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-09.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Thomas Rethman</h6>
                                                        <p>Do you know which...</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">02:40 PM</span>
                                                        <div class="chat-pin">
                                                            <i class="ti ti-heart-filled text-warning"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('chat')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-10.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Wilbur Martinez</h6>
                                                        <p>Haha oh man 🔥</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">02:40 PM</span>
                                                        <div class="chat-pin">
                                                            <i class="ti ti-pin me-2"></i>
                                                            <i class="ti ti-checks text-success"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('chat')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-11.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Danielle Baker</h6>
                                                        <p><i class="ti ti-map-pin-plus me-2"></i>Location</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">02:40 PM</span>
                                                        <div class="chat-pin">
                                                            <i class="ti ti-checks text-success"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('chat')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-13.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Morkel Jerrin</h6>
                                                        <p><i class="ti ti-video me-2"></i>Video</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">02:40 PM</span>
                                                        <div class="chat-pin">
                                                            <i class="ti ti-heart-filled text-warning me-2"></i>
                                                            <span class="count-message fs-12 fw-semibold">25</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="archive-chats" role="tabpanel" aria-labelledby="archive-chats-tab">
                                    <div class="chat-users-wrap">
                                        <div class="chat-list">
                                            <a href="{{url('chat')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-03.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Clyde Smith</h6>
                                                        <p>Haha oh man 🔥</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">03:15 AM</span>
                                                        <div class="chat-pin">
                                                            <i class="ti ti-pin me-2"></i>
                                                            <span class="count-message fs-12 fw-semibold">55</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('chat')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg bg-pink avatar-rounded me-2">
                                                    <span class="avatar-title fs-14 fw-medium">AG</span>
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Amfr_boys_Group</h6>
                                                        <p><i class="ti ti-photo me-2"></i>Photo</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">Yesterday</span>
                                                        <div class="chat-pin">
                                                            <span class="count-message fs-12 fw-semibold">5</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('chat')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-04.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Carla Jenkins</h6>
                                                        <p class="text-success"><i class="ti ti-video-plus me-2"></i>Incoming Video Call</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">Sunday</span>
                                                        <div class="chat-pin">
                                                            <i class="ti ti-checks text-success"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('chat')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-05.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Federico Wells</h6>
                                                        <p><i class="ti ti-photo me-2"></i>Photo</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">Wednesday</span>
                                                        <div class="chat-pin">
                                                            <i class="ti ti-pin me-2"></i>
                                                            <span class="count-message fs-12 fw-semibold">12</span>
                                                            <i class="bx bx-check-double"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="#" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle border border-warning border-2" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Mark Villiamss</h6>
                                                        <p><span class="animate-typing">is typing
                                                                <span class="dot"></span>
                                                                <span class="dot"></span>
                                                                <span class="dot"></span>
                                                            </span>
                                                        </p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">02:40 PM</span>
                                                        <div class="chat-pin">
                                                            <i class="ti ti-pin me-2"></i>
                                                            <span class="count-message fs-12 fw-semibold">12</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="#" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-02.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Sarika Jain</h6>
                                                        <p>Do you know which...</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">06:12 AM</span>
                                                        <div class="chat-pin">
                                                            <i class="ti ti-pin me-2"></i>
                                                            <i class="ti ti-checks text-success"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('chat')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Edward Lietz</h6>
                                                        <p><i class="ti ti-file me-2"></i>Document</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">02:40 PM</span>
                                                        <div class="chat-pin">
                                                            <i class="ti ti-checks text-success"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('chat')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg bg-skyblue online avatar-rounded me-2">
                                                    <span class="avatar-title fs-14 fw-medium">GU</span>
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Gustov_family</h6>
                                                        <p>Please Check<span class="text-primary ms-1">@rev</span></p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">24 Jul 2024</span>
                                                        <div class="chat-pin">
                                                            <i class="ti ti-heart-filled text-warning me-2"></i>
                                                            <span class="count-message fs-12 fw-semibold">25</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('chat')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-07.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Estell Gibson</h6>
                                                        <p class="text-danger"><i class="ti ti-video-off me-2"></i>Missed Video Call</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">02:40 PM</span>
                                                        <div class="chat-pin">
                                                            <i class="ti ti-heart-filled text-warning me-2"></i>
                                                            <i class="ti ti-checks text-success"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('chat')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-08.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Sharon Ford</h6>
                                                        <p>Hi How are you 🔥</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">02:40 PM</span>
                                                        <div class="chat-pin">
                                                            <span class="count-message fs-12 fw-semibold">25</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('chat')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-09.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Thomas Rethman</h6>
                                                        <p>Do you know which...</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">02:40 PM</span>
                                                        <div class="chat-pin">
                                                            <i class="ti ti-heart-filled text-warning"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('chat')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-10.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Wilbur Martinez</h6>
                                                        <p>Haha oh man 🔥</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">02:40 PM</span>
                                                        <div class="chat-pin">
                                                            <i class="ti ti-pin me-2"></i>
                                                            <i class="ti ti-checks text-success"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('chat')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-11.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Danielle Baker</h6>
                                                        <p><i class="ti ti-map-pin-plus me-2"></i>Location</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">02:40 PM</span>
                                                        <div class="chat-pin">
                                                            <i class="ti ti-checks text-success"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('chat')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-13.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Morkel Jerrin</h6>
                                                        <p><i class="ti ti-video me-2"></i>Video</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">02:40 PM</span>
                                                        <div class="chat-pin">
                                                            <i class="ti ti-heart-filled text-warning me-2"></i>
                                                            <span class="count-message fs-12 fw-semibold">25</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="trash-chats" role="tabpanel" aria-labelledby="trash-chats-tab">
                                    <div class="chat-users-wrap">
                                        <div class="chat-list">
                                            <a href="#" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-02.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Sarika Jain</h6>
                                                        <p>Do you know which...</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">06:12 AM</span>
                                                        <div class="chat-pin">
                                                            <i class="ti ti-pin me-2"></i>
                                                            <i class="ti ti-checks text-success"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('chat')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-03.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Clyde Smith</h6>
                                                        <p>Haha oh man 🔥</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">03:15 AM</span>
                                                        <div class="chat-pin">
                                                            <i class="ti ti-pin me-2"></i>
                                                            <span class="count-message fs-12 fw-semibold">55</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="#" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle border border-warning border-2" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Mark Villiamss</h6>
                                                        <p><span class="animate-typing">is typing
                                                                <span class="dot"></span>
                                                                <span class="dot"></span>
                                                                <span class="dot"></span>
                                                            </span>
                                                        </p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">02:40 PM</span>
                                                        <div class="chat-pin">
                                                            <i class="ti ti-pin me-2"></i>
                                                            <span class="count-message fs-12 fw-semibold">12</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('chat')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg bg-pink avatar-rounded me-2">
                                                    <span class="avatar-title fs-14 fw-medium">AG</span>
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Amfr_boys_Group</h6>
                                                        <p><i class="ti ti-photo me-2"></i>Photo</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">Yesterday</span>
                                                        <div class="chat-pin">
                                                            <span class="count-message fs-12 fw-semibold">5</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('chat')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-04.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Carla Jenkins</h6>
                                                        <p class="text-success"><i class="ti ti-video-plus me-2"></i>Incoming Video Call</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">Sunday</span>
                                                        <div class="chat-pin">
                                                            <i class="ti ti-checks text-success"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('chat')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-05.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Federico Wells</h6>
                                                        <p><i class="ti ti-photo me-2"></i>Photo</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">Wednesday</span>
                                                        <div class="chat-pin">
                                                            <i class="ti ti-pin me-2"></i>
                                                            <span class="count-message fs-12 fw-semibold">12</span>
                                                            <i class="bx bx-check-double"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('chat')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Edward Lietz</h6>
                                                        <p><i class="ti ti-file me-2"></i>Document</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">02:40 PM</span>
                                                        <div class="chat-pin">
                                                            <i class="ti ti-checks text-success"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('chat')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg bg-skyblue online avatar-rounded me-2">
                                                    <span class="avatar-title fs-14 fw-medium">GU</span>
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Gustov_family</h6>
                                                        <p>Please Check<span class="text-primary ms-1">@rev</span></p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">24 Jul 2024</span>
                                                        <div class="chat-pin">
                                                            <i class="ti ti-heart-filled text-warning me-2"></i>
                                                            <span class="count-message fs-12 fw-semibold">25</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('chat')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-07.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Estell Gibson</h6>
                                                        <p class="text-danger"><i class="ti ti-video-off me-2"></i>Missed Video Call</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">02:40 PM</span>
                                                        <div class="chat-pin">
                                                            <i class="ti ti-heart-filled text-warning me-2"></i>
                                                            <i class="ti ti-checks text-success"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('chat')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-08.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Sharon Ford</h6>
                                                        <p>Hi How are you 🔥</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">02:40 PM</span>
                                                        <div class="chat-pin">
                                                            <span class="count-message fs-12 fw-semibold">25</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('chat')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-09.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Thomas Rethman</h6>
                                                        <p>Do you know which...</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">02:40 PM</span>
                                                        <div class="chat-pin">
                                                            <i class="ti ti-heart-filled text-warning"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('chat')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-10.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Wilbur Martinez</h6>
                                                        <p>Haha oh man 🔥</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">02:40 PM</span>
                                                        <div class="chat-pin">
                                                            <i class="ti ti-pin me-2"></i>
                                                            <i class="ti ti-checks text-success"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('chat')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-11.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Danielle Baker</h6>
                                                        <p><i class="ti ti-map-pin-plus me-2"></i>Location</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">02:40 PM</span>
                                                        <div class="chat-pin">
                                                            <i class="ti ti-checks text-success"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('chat')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-13.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Morkel Jerrin</h6>
                                                        <p><i class="ti ti-video me-2"></i>Video</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">02:40 PM</span>
                                                        <div class="chat-pin">
                                                            <i class="ti ti-heart-filled text-warning me-2"></i>
                                                            <span class="count-message fs-12 fw-semibold">25</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Today Ending task -->
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="chat-title mb-2">Today Ending Tasks</h5>
                            </div>
                            <!-- Pinned Chats-->
                            <div class="tab-content mb-4" id="innerTabContent">
                                <div class="tab-pane fade show active" id="all-chats" role="tabpanel" aria-labelledby="all-chats-tab">
                                    <div class="chat-users-wrap">
                                        <div class="chat-list">
                                            <a href="#" class="chat-user-list">
                                                <div class="avatar avatar-lg  me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle border border-warning border-2" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Meeting Title</h6>
                                                        <p>Expired In 2 Hours
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="chat-title mb-2">Current Active Chats</h5>
                            </div>
                            <div class="tab-content mb-4 " id="innerTabContent">
                                <div class="tab-pane fade show active" id="all-chats" role="tabpanel" aria-labelledby="all-chats-tab">
                                    <div class="chat-users-wrap">
                                        <div class="chat-list">
                                            <a href="#" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle border border-warning border-2" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Mark Villiams</h6>
                                                        <p><span class="animate-typing">is typing
                                                                <span class="dot"></span>
                                                                <span class="dot"></span>
                                                                <span class="dot"></span>
                                                            </span>
                                                        </p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">02:40 PM</span>
                                                        <div class="chat-pin">
                                                            <i class="ti ti-pin me-2"></i>
                                                            <span class="count-message fs-12 fw-semibold">12</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- current active groups -->

                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="chat-title mb-2">Current Active Groups</h5>
                            </div>
                            <div class="tab-content " id="innerTabContent">
                                <div class="tab-pane fade show active" id="all-chats" role="tabpanel" aria-labelledby="all-chats-tab">
                                    <div class="chat-users-wrap">
                                        <div class="chat-list">
                                            <a href="#" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle border border-warning border-2" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Mark Villiams</h6>
                                                        <p><span class="animate-typing">is typing
                                                                <span class="dot"></span>
                                                                <span class="dot"></span>
                                                                <span class="dot"></span>
                                                            </span>
                                                        </p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">02:40 PM</span>
                                                        <div class="chat-pin">
                                                            <i class="ti ti-pin me-2"></i>
                                                            <span class="count-message fs-12 fw-semibold">12</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">

                                <div class="dropdown">
                                    <a href="#" class="text-default fs-16" data-bs-toggle="dropdown" aria-expanded="false"></a>
                                    <ul class=" dropdown-menu dropdown-menu-end p-3" id="innerTab" role="tablist">
                                        <li role="presentation">
                                            <a class="dropdown-item active" id="all-chats-tab" data-bs-toggle="tab" href="#all-chats" role="tab" aria-controls="all-chats" aria-selected="true" onclick="changeChat('All Chats')">All Chats</a>
                                        </li>
                                        <li role="presentation">
                                            <a class="dropdown-item" id="favourites-chat-tab" data-bs-toggle="tab" href="#favourites-chat" role="tab" aria-controls="favourites-chat" aria-selected="false" onclick="changeChat('Favourite Chats')">Favourite Chats</a>
                                        </li>
                                        <li role="presentation">
                                            <a class="dropdown-item" id="pinned-chats-tab" data-bs-toggle="tab" href="#pinned-chats" role="tab" aria-controls="pinned-chats" aria-selected="false" onclick="changeChat('Pinned Chats')">Pinned Chats</a>
                                        </li>
                                        <li role="presentation">
                                            <a class="dropdown-item" id="archive-chats-tab" data-bs-toggle="tab" href="#archive-chats" role="tab" aria-controls="archive-chats" aria-selected="false" onclick="changeChat('Archive Chats')">Archive Chats</a>
                                        </li>
                                        <li role="presentation">
                                            <a class="dropdown-item" id="trash-chats-tab" data-bs-toggle="tab" href="#trash-chats" role="tab" aria-controls="trash-chats" aria-selected="false" onclick="changeChat('Trash')">Trash</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>


                        </div>

                    </div>

                </div>
                <!-- / Chats sidebar -->

            </div>
        </div>
    </div>
    <!-- /Sidebar group -->

    <!-- Chat -->



    <div class="container py-4" style="overflow-y: auto; overflow-x: hidden;scrollbar-width: thin; margin: 0; border-right: none;padding-bottom: 37.5rem !important;visibility:visible ; background-image: none !important;  max-width: 1450px;">
        <div class="chat chat-messages show" id="middle" style="visibility:visible;
          margin-top: -21px;margin-left: -13px;    position: relative;">
            <div>
                <div class="chat-header py-2"
                    style="display: flex; justify-content: space-between; align-items: center; width: 102.4%; overflow-x: hidden; padding: 0 10px;">

                    <!-- User Details -->
                    <div class="user-details" style="display: flex; align-items: center; gap: 10px;">
                        <div class="d-xl-none">
                            <a class="text-muted chat-close me-2" href="#">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                        </div>
                        <div class="avatar avatar-lg online flex-shrink-0">
                            <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}"
                                class="rounded-circle"
                                alt="image"
                                style="width: 48px; height: 48px; object-fit: cover;">
                        </div>
                        <div class="ms-2 overflow-hidden">
                            <h6 style="margin: 0; font-size: 16px;">Username</h6>
                            <p class="last-seen text-truncate" style="margin: 0; font-size: 12px; color: green;">Online</p>
                        </div>
                    </div>

                    <!-- Right Side Icons -->
                    <div class="left-icons d-flex align-items-center gap-5">

                        <li data-bs-toggle="tooltip" data-bs-placement="right" data-bs-custom-class="tooltip-primary" style="list-style: none;">
                            <a href="{{ route('settings') }}" class="{{ request()->is('settings') ? 'active' : '' }}">
                                <img src="{{URL::asset('/build/img/setting.svg')}}" alt="setting" style="height: 25px; cursor: pointer;">
                            </a>
                        </li>

                        <li style="list-style: none;">
                            <!-- Moon Icon -->
                            <a href="#" id="dark-mode-toggle" style="display: inline;">
                                <img src="{{ URL::asset('/build/img/Moon.svg') }}" alt="moon" style="height: 25px; cursor: pointer;">
                            </a>

                            <!-- Sun Icon -->
                            <a href="#" id="light-mode-toggle" style="display: none;">
                                <i class="ti ti-sun" style="font-size: 22px; cursor: pointer;"></i>
                            </a>
                        </li>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" style="background: none; border: none; padding: 0; margin: 0;">
                                <img src="{{ URL::asset('/build/img/exit.svg') }}" alt="Logout" style="height: 25px; cursor: pointer;">
                            </button>
                        </form>
                    </div>

                </div>


            </div>

        </div>
        <!-- EMPLOYEE SECTION TITLE -->
        <div class="d-flex justify-content-between align-items-center mb-3" style="margin-top: -60px;">
            <h3>Users</h3>
            <button
                type="button"
                data-bs-toggle="modal"
                data-bs-target="#add_user"
                style="background-color: #ff7700; 
               color: white; 
               border: none; 
               padding: 8px 14px; 
               border-radius: 6px; 
               font-weight: 500; 
               display: flex; 
               align-items: center; 
               gap: 6px; 
               cursor: pointer; 
               position: relative; 
               z-index: 10;">
                <span style="display: inline-block; 
                     width: 18px; 
                     height: 18px; 
                     border-radius: 50%; 
                     background-color: #e65c00; 
                     color: white; 
                     text-align: center; 
                     line-height: 18px; 
                     font-weight: bold; 
                     font-size: 13px;">
                    +
                </span>
                Add User
            </button>
        </div>

        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3 mb-2" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> &times;</button>
        </div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show mt-3 mb-2" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> &times;</button>
        </div>
        @endif
        <!-- EMPLOYEE STATS -->
        <div class="row mb-4">
            <!-- Total Users -->
            <div class="col-md-3 mb-3">
                <div class="elevated-card" style="display: flex; align-items: center; gap: 12px; padding: 12px;">
                    <span class="avatar avatar-lg bg-dark rounded-circle"><i class="ti ti-user"></i></span>
                    <div>
                        <div style="font-weight: 600;">Total Users</div>
                        <h4 class="text-dark mt-1 mb-0" style="font-size: 20px;">{{$totalUsers}}</h4>
                    </div>
                    <span class="badge badge-soft-purple badge-sm fw-normal" style="margin-left: 20px;">
                        <i class="ti ti-arrow-wave-right-down"></i>
                        +19.01%
                    </span>
                </div>
            </div>

            <!-- Active -->
            <div class="col-md-3 mb-3">
                <div class="elevated-card" style="display: flex; align-items: center; gap: 12px; padding: 12px;">
                    <span class="avatar avatar-lg bg-success rounded-circle"><i class="ti ti-user-share"></i></span>
                    <div>
                        <div style="font-weight: 600;">Active</div>
                        <h4 class="text-success mt-1 mb-0" style="font-size: 20px;">{{$activeUsers}}</h4>
                    </div>
                    <span style="
    display: inline-block;
    background-color: #ffece6;
    color: #f55b23;
    font-size: 0.875rem;
    font-weight: 400;
    border-radius: 0.375rem;
    padding: 0.20rem 0.5rem;
    margin-left: 20px;
">
                        <i class="ti ti-arrow-wave-right-down" style="margin-right: 4px;"></i>
                        +19.01%
                    </span>

                </div>
            </div>

            <!-- Inactive -->
            <div class="col-md-3 mb-3">
                <div class="elevated-card" style="display: flex; align-items: center; gap: 12px; padding: 12px;">
                    <span class="avatar avatar-lg bg-danger rounded-circle"><i class="ti ti-user-pause"></i></span>
                    <div>
                        <div style="font-weight: 600;">Inactive</div>
                        <h4 class="text-danger mt-1 mb-0" style="font-size: 20px;">{{$inactiveUsers}}</h4>
                    </div>
                    <span class="badge badge-soft-dark badge-sm fw-normal" style="margin-left: 20px;">
                        <i class="ti ti-arrow-wave-right-down"></i>
                        +19.01%
                    </span>
                </div>
            </div>

            <!-- New Joiners -->
            <div class="col-md-3 mb-3">
                <div class="elevated-card" style="display: flex; align-items: center; gap: 12px; padding: 12px;">
                    <span class="avatar avatar-lg bg-info rounded-circle"><i class="ti ti-user-plus"></i></span>
                    <div>
                        <div style="font-weight: 600;">New Joiners</div>
                        <h4 class="text-primary mt-1 mb-0" style="font-size: 20px;">{{$newJoinersToday}}</h4>
                    </div>
                    <span class="badge badge-soft-secondary badge-sm fw-normal" style="margin-left: 20px;">
                        <i class="ti ti-arrow-wave-right-down"></i>
                        +19.01%
                    </span>
                </div>
            </div>
        </div>


        <!-- EMPLOYEES GRID -->
        <div class="row employee-grid">
            <!-- Employee Card 1 -->
            @foreach ($users as $user)
            <div class="col-md-3 mb-4">

                <div class="elevated-card" style="position: relative; padding-top: 24px;">
                    <!-- Square Checkbox (top-left) -->
                   
                    <!-- 3-dots Icon (top-right) -->
                    <div class="dropdown" style="position: absolute; top: 20px; right: 10px;">
                        <!-- Just 3 vertical dots -->
                        <span
                            id="actionDropdown"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                            style="cursor: pointer; font-size: 20px;">
                            &#8942;
                        </span>

                        <!-- Dropdown Menu -->
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="actionDropdown">
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <i class="ti ti-edit me-2 "></i> Edit
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center"
                                    href="javascript:void(0);"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteConfirmModal"
                                    data-delete-url="{{ route('user.destroy', $user->_id) }}">
                                    <i class="ti ti-trash me-2"></i> Delete
                                </a>
                            </li>
                        </ul>
                    </div>


                    <!-- Profile -->


                    <img src="{{ asset($user->image) }}"
                        onerror="this.onerror=null; this.src='{{ URL::asset('/build/img/profiles/avatar-01.jpg') }}';"
                        class="rounded-circle"
                        alt="img">

                    <h6 style="cursor: pointer;" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" onclick="showUserPopup(
        '{{ $user->_id }}',
        '{{ $user->name }}',
        '{{ $user->email }}',
        '{{ $user->phone }}',
        '{{ $user->department }}',
        '{{ asset($user->image) }}'
    )">
                        {{$user->name}}
                    </h6>
                    <small style="color: fuchsia; background-color: #ffe6f0; padding: 3px 10px; border-radius: 12px; font-size: 12px; font-weight: 600;">
                        {{$user->department}}
                    </small>

                    <!-- Stats -->
                    <div class="mt-3 d-flex justify-content-between" style="display: flex; justify-content: space-between; margin-top: 15px;">
                        <span><strong>Projects</strong><br>20</span>
                        <span><strong>Done</strong><br>13</span>
                        <span><strong>Progress</strong><br>8</span>
                    </div>

                    <!-- Productivity -->
                    <div class="mt-2">Productivity: 65%</div>
                    <div class="progress mt-1">
                        <div class="progress-bar bg-purple" style="width: 65%"></div>
                    </div>
                </div>

            </div>
            @endforeach

            {{--
            <!-- Employee Card 2 -->
            <div class="col-md-3 mb-4">
                <div class="elevated-card">
                    <!-- Square Checkbox (top-left) -->
                    <input type="checkbox" style="
        position: absolute;
        top: 30px;
        left: 20px;
        width: 26px;
        height: 22px;
        accent-color: orange; /* Optional: purple tint */
        cursor: pointer;
    ">
                    <div class="dropdown" style="position: absolute; top: 20px; right: 10px;">
                        <!-- Just 3 vertical dots -->
                        <span
                            id="actionDropdown"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                            style="cursor: pointer; font-size: 20px;">
                            &#8942;
                        </span>

                        <!-- Dropdown Menu -->
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="actionDropdown">
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <i class="ti ti-edit me-2 "></i> Edit
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center " href="#">
                                    <i class="ti ti-trash me-2"></i> Delete
                                </a>
                            </li>
                        </ul>
                    </div>
                    <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle" alt="img">
            <h6 style="cursor: pointer;" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                Anthony Lewis
            </h6>

            <small style="color: purple; background-color: #f5e6fa; padding: 3px 10px; border-radius: 12px; font-size: 12px; font-weight: 600;">
                Developer
            </small>
            <div class="mt-3 d-flex justify-content-between" style="display: flex; justify-content: space-between; margin-top: 15px;">
                <span><strong>Projects</strong><br>20</span>
                <span><strong>Done</strong><br>13</span>
                <span><strong>Progress</strong><br>8</span>
            </div>

            <div class="mt-2">Productivity: 30%</div>
            <div class="progress mt-1">
                <div class="progress-bar" style="width: 35%; background-color: #ffc107;"></div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="elevated-card">
            <!-- Square Checkbox (top-left) -->
            <input type="checkbox" style="
        position: absolute;
        top: 30px;
        left: 20px;
        width: 26px;
        height: 22px;
        accent-color: orange; /* Optional: purple tint */
        cursor: pointer;
    ">
            <div class="dropdown" style="position: absolute; top: 20px; right: 10px;">
                <!-- Just 3 vertical dots -->
                <span
                    id="actionDropdown"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                    style="cursor: pointer; font-size: 20px;">
                    &#8942;
                </span>

                <!-- Dropdown Menu -->
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="actionDropdown">
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <i class="ti ti-edit me-2 "></i> Edit
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center " href="#">
                            <i class="ti ti-trash me-2"></i> Delete
                        </a>
                    </li>
                </ul>
            </div>
            <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle" alt="img">

            <h6 style="cursor: pointer;" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                Anthony Lewis
            </h6>

            <small style="color: purple; background-color: #f5e6fa; padding: 3px 10px; border-radius: 12px; font-size: 12px; font-weight: 600;">
                Developer
            </small>
            <div class="mt-3 d-flex justify-content-between" style="display: flex; justify-content: space-between; margin-top: 15px;">
                <span><strong>Projects</strong><br>20</span>
                <span><strong>Done</strong><br>13</span>
                <span><strong>Progress</strong><br>8</span>
            </div>

            <div class="mt-2">Productivity: 20%</div>
            <div class="progress mt-1" style="background-color: #e9ecef; border-radius: 4px;">
                <div class="progress-bar" style="width: 20%; background-color: red;"></div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="elevated-card">
            <!-- Square Checkbox (top-left) -->
            <input type="checkbox" style="
        position: absolute;
        top: 30px;
        left: 20px;
        width: 26px;
        height: 22px;
        accent-color: orange; /* Optional: purple tint */
        cursor: pointer;
    ">
            <div class="dropdown" style="position: absolute; top: 20px; right: 10px;">
                <!-- Just 3 vertical dots -->
                <span
                    id="actionDropdown"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                    style="cursor: pointer; font-size: 20px;">
                    &#8942;
                </span>

                <!-- Dropdown Menu -->
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="actionDropdown">
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <i class="ti ti-edit me-2 "></i> Edit
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center " href="#">
                            <i class="ti ti-trash me-2"></i> Delete
                        </a>
                    </li>
                </ul>
            </div>
            <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle" alt="img">

            <h6 style="cursor: pointer;" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                Anthony Lewis
            </h6>

            <small style="color: #212529; background-color: #e9ecef; padding: 3px 10px; border-radius: 12px; font-size: 12px; font-weight: 600;">
                Software Developer
            </small>

            <div class="mt-3 d-flex justify-content-between" style="display: flex; justify-content: space-between; margin-top: 15px;">
                <span><strong>Projects</strong><br>20</span>
                <span><strong>Done</strong><br>13</span>
                <span><strong>Progress</strong><br>8</span>
            </div>

            <div class="mt-2">Productivity: 90%</div>
            <div class="progress mt-1">
                <div class="progress-bar" style="width: 90%; background-color: green;"></div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="elevated-card">
            <!-- Square Checkbox (top-left) -->
            <input type="checkbox" style="
        position: absolute;
        top: 30px;
        left: 20px;
        width: 26px;
        height: 22px;
        accent-color: orange; /* Optional: purple tint */
        cursor: pointer;
    ">
            <div class="dropdown" style="position: absolute; top: 20px; right: 10px;">
                <!-- Just 3 vertical dots -->
                <span
                    id="actionDropdown"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                    style="cursor: pointer; font-size: 20px;">
                    &#8942;
                </span>

                <!-- Dropdown Menu -->
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="actionDropdown">
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <i class="ti ti-edit me-2 "></i> Edit
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center " href="#">
                            <i class="ti ti-trash me-2"></i> Delete
                        </a>
                    </li>
                </ul>
            </div>
            <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle" alt="img">

            <h6 style="cursor: pointer;" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                Anthony Lewis
            </h6>

            <small style="color: #212529; background-color: #e9ecef; padding: 3px 10px; border-radius: 12px; font-size: 12px; font-weight: 600;">
                Full Stack Developer
            </small>

            <div class="mt-3 d-flex justify-content-between" style="display: flex; justify-content: space-between; margin-top: 15px;">
                <span><strong>Projects</strong><br>20</span>
                <span><strong>Done</strong><br>13</span>
                <span><strong>Progress</strong><br>8</span>
            </div>

            <div class="mt-2">Productivity: 10%</div>
            <div class="progress mt-1">
                <div class="progress-bar bg-danger" style="width: 15%"></div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="elevated-card">
            <!-- Square Checkbox (top-left) -->
            <input type="checkbox" style="
        position: absolute;
        top: 30px;
        left: 20px;
        width: 26px;
        height: 22px;
        accent-color: orange; /* Optional: purple tint */
        cursor: pointer;
    ">
            <div class="dropdown" style="position: absolute; top: 20px; right: 10px;">
                <!-- Just 3 vertical dots -->
                <span
                    id="actionDropdown"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                    style="cursor: pointer; font-size: 20px;">
                    &#8942;
                </span>

                <!-- Dropdown Menu -->
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="actionDropdown">
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <i class="ti ti-edit me-2 "></i> Edit
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center " href="#">
                            <i class="ti ti-trash me-2"></i> Delete
                        </a>
                    </li>
                </ul>
            </div>
            <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle" alt="img">

            <h6 style="cursor: pointer;" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                Anthony Lewis
            </h6>

            <small style="color: #ff1493; background-color: #ffe6f0; padding: 3px 10px; border-radius: 12px; font-size: 12px; font-weight: 600;">
                Software Developer
            </small>

            <div class="mt-3 d-flex justify-content-between" style="display: flex; justify-content: space-between; margin-top: 15px;">
                <span><strong>Projects</strong><br>20</span>
                <span><strong>Done</strong><br>13</span>
                <span><strong>Progress</strong><br>8</span>
            </div>
            <div class="mt-2">Productivity: 65%</div>
            <div class="progress mt-1">
                <div class="progress-bar bg-purple" style="width: 65%"></div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="elevated-card">
            <!-- Square Checkbox (top-left) -->
            <input type="checkbox" style="
        position: absolute;
        top: 30px;
        left: 20px;
        width: 26px;
        height: 22px;
        accent-color: orange; /* Optional: purple tint */
        cursor: pointer;
    ">
            <div class="dropdown" style="position: absolute; top: 20px; right: 10px;">
                <!-- Just 3 vertical dots -->
                <span
                    id="actionDropdown"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                    style="cursor: pointer; font-size: 20px;">
                    &#8942;
                </span>

                <!-- Dropdown Menu -->
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="actionDropdown">
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <i class="ti ti-edit me-2 "></i> Edit
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center " href="#">
                            <i class="ti ti-trash me-2"></i> Delete
                        </a>
                    </li>
                </ul>
            </div>
            <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle" alt="img">
            <h6 style="cursor: pointer;" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                Anthony Lewis
            </h6>

            <small style="color: purple; background-color: #f5e6fa; padding: 3px 10px; border-radius: 12px; font-size: 12px; font-weight: 600;">
                Developer
            </small>
            <div class="mt-3 d-flex justify-content-between" style="display: flex; justify-content: space-between; margin-top: 15px;">
                <span><strong>Projects</strong><br>20</span>
                <span><strong>Done</strong><br>13</span>
                <span><strong>Progress</strong><br>8</span>
            </div>
            <div class="mt-2">Productivity: 90%</div>
            <div class="progress mt-1">
                <div class="progress-bar" style="width: 90%; background-color: green;"></div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="elevated-card">
            <!-- Square Checkbox (top-left) -->
            <input type="checkbox" style="
        position: absolute;
        top: 30px;
        left: 20px;
        width: 26px;
        height: 22px;
        accent-color: orange; /* Optional: purple tint */
        cursor: pointer;
    ">
            <div class="dropdown" style="position: absolute; top: 20px; right: 10px;">
                <!-- Just 3 vertical dots -->
                <span
                    id="actionDropdown"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                    style="cursor: pointer; font-size: 20px;">
                    &#8942;
                </span>

                <!-- Dropdown Menu -->
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="actionDropdown">
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <i class="ti ti-edit me-2 "></i> Edit
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center " href="#">
                            <i class="ti ti-trash me-2"></i> Delete
                        </a>
                    </li>
                </ul>
            </div>
            <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle" alt="img">
            <h6 style="cursor: pointer;" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                Anthony Lewis
            </h6>

            <small style="color: #00bfff; background-color: #dff7ff; padding: 3px 10px; border-radius: 12px; font-size: 12px; font-weight: 600;">
                Tester
            </small>

            <div class="mt-3 d-flex justify-content-between" style="display: flex; justify-content: space-between; margin-top: 15px;">
                <span><strong>Projects</strong><br>20</span>
                <span><strong>Done</strong><br>13</span>
                <span><strong>Progress</strong><br>8</span>
            </div>

            <div class="mt-2">Productivity: 80%</div>
            <div class="progress mt-1" style=" background-color: #f0f2f5; border-radius: 10px;">
                <div class="progress-bar" style="width: 80%; background-color: #ff2ea6; border-radius: 10px;"></div>
            </div>

        </div>
    </div>



    <!-- Add more employee cards as needed -->
</div>
</div>
--}}
<!-- Add Contact -->
<div class="modal fade" id="add-contact">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Contact</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('chat')}}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">First Name</label>
                                <div class="input-icon position-relative">
                                    <input type="text" class="form-control">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-user"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Last Name</label>
                                <div class="input-icon position-relative">
                                    <input type="text" class="form-control">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-user"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <div class="input-icon position-relative">
                                    <input type="text" class="form-control">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-mail"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <div class="input-icon position-relative">
                                    <input type="text" class="form-control">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-phone"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Date of Birth</label>
                                <div class="input-icon position-relative">
                                    <input type="text" class="form-control">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-calendar-event"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Website Address</label>
                                <div class="input-icon position-relative">
                                    <input type="text" class="form-control">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-globe"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="card border">
                                <div class="card-header border-bottom">
                                    <h6>Social Information</h6>
                                </div>
                                <div class="card-body pb-1">
                                    <div class="row align-items-center">
                                        <div class="col-md-4">
                                            <label class="form-label text-default fw-normal mb-3">Facebook</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="input-icon position-relative mb-3">
                                                <input type="text" class="form-control">
                                                <span class="input-icon-addon">
                                                    <i class="ti ti-brand-facebook"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label text-default fw-normal mb-3">Twitter</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="input-icon position-relative mb-3">
                                                <input type="text" class="form-control">
                                                <span class="input-icon-addon">
                                                    <i class="ti ti-brand-twitter"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-labe text-default fw-normall mb-3">Instagram</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="input-icon position-relative mb-3">
                                                <input type="text" class="form-control">
                                                <span class="input-icon-addon">
                                                    <i class="ti ti-brand-instagram"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label text-default fw-normal mb-3">Linked in</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="input-icon position-relative mb-3">
                                                <input type="text" class="form-control">
                                                <span class="input-icon-addon">
                                                    <i class="ti ti-brand-linkedin"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label text-default fw-normal mb-3">YouTube</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="input-icon position-relative mb-3">
                                                <input type="text" class="form-control">
                                                <span class="input-icon-addon">
                                                    <i class="ti ti-brand-youtube"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Add Contact</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add Contact -->

<!-- Contact Detail -->
<div class="modal fade" id="contact-details">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Contact Detail</h4>
                <div class="d-flex align-items-center">
                    <div class="dropdown me-2">
                        <a class="d-block" href="#" data-bs-toggle="dropdown">
                            <i class="ti ti-dots-vertical"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end p-3">
                            <li><a class="dropdown-item" href="#"><i class="ti ti-share-3 me-2"></i>Share</a></li>
                            <li><a class="dropdown-item" href="#"><i class="ti ti-edit me-2"></i>Edit</a></li>
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#block-user"><i class="ti ti-ban me-2"></i>Block</a></li>
                            <li><a class="dropdown-item" href="#"><i class="ti ti-trash me-2"></i>Delete</a></li>
                        </ul>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <div class="card bg-light shadow-none">
                    <div class="card-body pb-1">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center mb-3">
                                <span class="avatar avatar-lg">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle" alt="img">
                                </span>
                                <div class="ms-2">
                                    <h6>Aaryian Jose</h6>
                                    <p>App Developer</p>
                                </div>
                            </div>
                            <div class="contact-actions d-flex align-items-center mb-3">
                                <a href="{{url('chat')}}" class="me-2"><i class="ti ti-message"></i></a>
                                <a href="javascript:void(0);" class="me-2" data-bs-toggle="modal" data-bs-target="#voice_call"><i class="ti ti-phone"></i></a>
                                <a href="javascript:void(0);" class="me-2"><i class="ti ti-video"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card border mb-3">
                    <div class="card-header border-bottom">
                        <h6>Personal Information</h6>
                    </div>
                    <div class="card-body pb-1">
                        <div class="mb-2">
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <p class="mb-2 d-flex align-items-center"><i class="ti ti-clock-hour-4 me-1"></i>Local Time</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="fw-medium fs-14 mb-2">10:00 AM</h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-2 d-flex align-items-center"><i class="ti ti-calendar-event me-1"></i>Date of Birth</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="fw-medium fs-14 mb-2">22 July 2024</h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-2 d-flex align-items-center"><i class="ti ti-phone me-1"></i>Phone Number</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="fw-medium fs-14 mb-2">+20-482-038-29</h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-2 d-flex align-items-center"><i class="ti ti-mail me-1"></i>Email</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="fw-medium fs-14 mb-2">aariyan@example.com</h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-2 d-flex align-items-center"><i class="ti ti-globe me-1"></i>Website Address</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="fw-medium fs-14 mb-2">www.examplewebsite.com</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card border mb-0">
                    <div class="card-header border-bottom">
                        <h6>Social Information</h6>
                    </div>
                    <div class="card-body pb-1">
                        <div class="mb-2">
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <p class="mb-2 d-flex align-items-center"><i class="ti ti-brand-facebook me-1"></i>Facebook</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="fw-medium fs-14 mb-2">www.facebook.com</h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-2 d-flex align-items-center"><i class="ti ti-brand-twitter me-1"></i>Twitter</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="fw-medium fs-14 mb-2">www.twitter.com</h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-2 d-flex align-items-center"><i class="ti ti-brand-instagram me-1"></i>Instagram</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="fw-medium fs-14 mb-2">www.instagram.com</h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-2 d-flex align-items-center"><i class="ti ti-brand-linkedin me-1"></i>Linkedin</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="fw-medium fs-14 mb-2">www.linkedin.com</h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-2 d-flex align-items-center"><i class="ti ti-brand-youtube me-1"></i>YouTube</p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="fw-medium fs-14 mb-2">www.youtube.com</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Contact Detail -->
<!-- Confirmation Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="text-align: center; padding: 24px; border-radius: 8px;">

            <!-- Icon -->
            <div style="margin-bottom: 12px;">
                <div style="background-color: #fdecea; display: inline-flex; justify-content: center; align-items: center; width: 64px; height: 64px; border-radius: 50%;">
                    <i class="ti ti-trash-x fs-36" style="color: #e63946; font-size: 36px;"></i>
                </div>
            </div>

            <!-- Title -->
            <h5 style="font-weight: 600; margin-bottom: 8px;">Confirm Delete</h5>

            <!-- Message -->
            <p style="color: #6c757d; margin-bottom: 24px;">
                You want to delete this item, this can't be undone once you delete.
            </p>

            <!-- Buttons -->
            <div style="display: flex; justify-content: center; gap: 8px;">
                <button type="button" class="btn-cancel" data-bs-dismiss="modal"
                    style="background-color: #f8f9fa; color: #000; padding: 8px 18px; border: 1px solid #dee2e6; border-radius: 4px; font-weight: 500;">
                    Cancel
                </button>
                <a id="confirmDeleteBtn" href="#"
                    style="background-color: #e63946; color: #fff; padding: 8px 18px; border: none; border-radius: 4px; font-weight: 500; text-decoration: none;">
                    Yes, Delete
                </a>
            </div>

        </div>
    </div>
</div>
<!-- delete popup end -->
<!-- Add user -->
<!-- Add User Modal -->
<!-- Add New Employee Modal -->
<div class="modal fade" id="add_user" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header border-0 pb-0">
                <div>
                    <h4 class="modal-title fw-bold">Add New User</h4>
                    <small class="text-muted">User ID : <strong>user -0024</strong></small>
                </div>
                <button type="button" class="custom-close-btn" data-bs-dismiss="modal" aria-label="Close">
                    &times;
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body pt-0">

                <!-- Tabs -->
                <ul class="nav nav-tabs mb-3 border-bottom-0">
                    <li class="nav-item">
                        <a class="nav-link active fw-semibold"
                            data-bs-toggle="tab"
                            href="#basicInfo"
                            style="border: none; color: #f65b0f; border-bottom: 2px solid #f65b0f; background-color: transparent;">
                            Basic Information
                        </a>
                    </li>

                </ul>


                <!-- Tab Content -->
                <div class="tab-content">
                    <!-- Basic Information Tab -->
                    <div class="tab-pane fade show active" id="basicInfo">
                        <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                            @csrf

                            <!-- Profile Upload -->
                            <div class="bg-light rounded py-3 px-3 mb-4 d-flex align-items-center">
                                <!-- Profile Image -->
                                <div class="position-relative d-inline-block" style="width: 80px; height: 80px;">
                                    <img src="{{ URL::asset('/build/img/profiles/avatar-01.jpg') }}"
                                        class="rounded-circle"
                                        alt="Profile Image"
                                        style="width: 80px; height: 80px; object-fit: cover;">

                                    <!-- Hidden File Input -->
                                    <input type="file" name="image" accept="image/*" id="profileImageInput" style="display: none;" onchange="previewImage(event)">

                                    <!-- Overlay + Icon -->
                                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center rounded-circle"
                                        style="background-color: rgba(0, 0, 0, 0.5); opacity: 0; transition: 0.3s; cursor: pointer;"
                                        onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0'"
                                        onclick="document.getElementById('profileImageInput').click();">
                                        <span class="text-white fs-3">+</span>
                                    </div>
                                </div>


                                <!-- Upload Text + Buttons -->
                                <div style="margin-left: 20px;">
                                    <p class="mb-1 fw-medium">Upload Profile Image</p>
                                    <small class="text-muted d-block mb-2">Image should be below 4 mb</small>
                                    <button class="btn btn-warning me-2" style="background-color: #f65b0f; border-color: #f65b0f;">Upload</button>
                                    <button class="btn btn-outline">Cancel</button>
                                </div>
                            </div>


                            <!-- Form Fields -->

                            <div class="row g-3">

                                <div class="col-md-6">
                                    <label class="form-label">First & last Name</label>

                                    <input type="text" name="name" class="form-control" required>
                                    @error('name')
                                    <div class="alert alert-danger mt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Projects</label>
                                    <select class="form-select" name="department" required>
                                        <option selected>Select</option>
                                        <option>All Department</option>
                                        <option>Finance</option>
                                        <option>Developer</option>
                                        <option>Executive</option>
                                    </select>
                                    @error('department')
                                    <div class="alert alert-danger mt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                  <div class="col-md-3">
                                    <label class="form-label">Position</label>
                                    <select class="form-select" name="position" required>
                                        <option selected>Select</option>
                                        <option>All Department</option>
                                        <option>Finance</option>
                                        <option>Developer</option>
                                        <option>Executive</option>
                                    </select>
                                    @error('position')
                                    <div class="alert alert-danger mt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>



                                <div class="col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" required autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
                                    @error('email')
                                    <div class="alert alert-danger mt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                 <div class="col-md-6">
                                        <label class="form-label"> Repeat Email</label>
                                        <input type="email" class="form-control" name="remail" required>
                                        @error('remail')
                                        <div class="alert alert-danger mt-2">
                                            {{$message}}
                            </div>
                            @enderror
                    </div> 

                    <div class="col-md-6">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="passw" required autocomplete="new-password">
                        @error('passw')
                        <div class="alert alert-danger mt-2">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Repeat Password</label>
                        <input type="password" class="form-control" name="rpassw" required autocomplete="new-password">
                        @error('rpassw')
                        <div class="alert alert-danger mt-2">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    {{-- <div class="col-md-6">
                                        <label class="form-label">Confirm Password</label>
                                        <input type="password" name="cpassw" class="form-control" required>
                                        @error('cpassw')
                                        <div class="alert alert-danger mt-2">
                                            {{$message}}
                </div>
                @enderror
            </div> --}}

           
        </div>
        <div style="max-width: 950px; margin: 30px auto; font-family: 'Segoe UI', sans-serif; font-size: 14px;">

            <!-- Enable Options Header -->
            <div style="background-color: #f5f6fa; padding: 15px 20px; border-radius: 6px; display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                <span style="font-weight: 600; color: #0b0b0b;">Enable Options</span>
                <div style="display: flex; gap: 20px; align-items: center;">
                    <!-- Enable All Module Toggle -->
                    <label style="display: flex; align-items: center; gap: 8px;">
                        <input type="checkbox" style="width: 16px; height: 16px; cursor: pointer;">
                        <span style="color: #6c757d;">Enable all Module</span>
                    </label>

                    <!-- Select All -->
                    <label style="display: flex; align-items: center; gap: 8px;">
                        <input type="checkbox" style="accent-color: #ff6600; width: 16px; height: 16px; cursor: pointer;" checked>
                        <span style="color: #ff6600; font-weight: 500;">Select All</span>
                    </label>
                </div>
            </div>

            <!-- Permissions Table -->
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; text-align: center;">

                    <tbody>
                        <!-- clients -->
                        <tr style="background: #fff;">
                            <!-- Module Enable Switch -->
                            <td style="padding: 10px; text-align: left; display: flex; align-items: center; gap: 10px;">
                                <label style="position: relative; display: inline-block; width: 36px; height: 18px;">
                                    <input type="checkbox" name="permissions[clients][enabled]" checked
                                        style="opacity: 0; width: 0; height: 0;"
                                        onchange="this.nextElementSibling.style.backgroundColor = this.checked ? '#ff6600' : '#ccc'; this.nextElementSibling.firstElementChild.style.transform = this.checked ? 'translateX(18px)' : 'translateX(0)';">
                                    <span style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #ff6600; border-radius: 20px; transition: .3s;">
                                        <span style="position: absolute; height: 14px; width: 14px; left: 2px; bottom: 2px; background-color: white; border-radius: 50%; transition: .3s; transform: translateX(18px);"></span>
                                    </span>
                                </label>
                                Clients
                            </td>

                            <!-- Read -->
                            <td style="text-align: center;">
                                <label style="display: flex; align-items: center; gap: 4px;">
                                    <input type="checkbox" name="permissions[clients][read]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                    <span style="font-size: 14px;">Read</span>
                                </label>
                            </td>

                            <!-- Write -->
                            <td style="text-align: center;">
                                <label style="display: flex; align-items: center; gap: 4px;">
                                    <input type="checkbox" name="permissions[clients][write]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                    <span style="font-size: 14px;">Write</span>
                                </label>
                            </td>

                            <!-- Delete -->
                            <td style="text-align: center;">
                                <label style="display: flex; align-items: center; gap: 4px;">
                                    <input type="checkbox" name="permissions[clients][delete]" checked style="accent-color: #ff6600; width: 16px; height: 16px;">
                                    <span style="font-size: 14px;">Delete</span>
                                </label>
                            </td>

                            <!-- Import -->
                            <td style="text-align: center;">
                                <label style="display: flex; align-items: center; gap: 4px;">
                                    <input type="checkbox" name="permissions[clients][import]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                    <span style="font-size: 14px;">Import</span>
                                </label>
                            </td>

                            <!-- Export -->
                            <td style="text-align: center;">
                                <label style="display: flex; align-items: center; gap: 4px;">
                                    <input type="checkbox" name="permissions[clients][export]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                    <span style="font-size: 14px;">Export</span>
                                </label>
                            </td>
                        </tr>


                        <tr style="background: #fff;">
                            <!-- Module Enable Switch -->
                            <td style="padding: 10px; text-align: left; display: flex; align-items: center; gap: 10px;">
                                <label style="position: relative; display: inline-block; width: 36px; height: 18px;">
                                    <input type="checkbox" name="permissions[leaves][enabled]" checked
                                        style="opacity: 0; width: 0; height: 0;"
                                        onchange="this.nextElementSibling.style.backgroundColor = this.checked ? '#ff6600' : '#ccc'; this.nextElementSibling.firstElementChild.style.transform = this.checked ? 'translateX(18px)' : 'translateX(0)';">
                                    <span style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #ff6600; border-radius: 20px; transition: .3s;">
                                        <span style="position: absolute; height: 14px; width: 14px; left: 2px; bottom: 2px; background-color: white; border-radius: 50%; transition: .3s; transform: translateX(18px);"></span>
                                    </span>
                                </label>
                                Leaves
                            </td>

                            <!-- Read -->
                            <td style="text-align: center;">
                                <label style="display: flex; align-items: center; gap: 4px;">
                                    <input type="checkbox" name="permissions[leaves][read]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                    <span style="font-size: 14px;">Read</span>
                                </label>
                            </td>

                            <!-- Write -->
                            <td style="text-align: center;">
                                <label style="display: flex; align-items: center; gap: 4px;">
                                    <input type="checkbox" name="permissions[leaves][write]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                    <span style="font-size: 14px;">Write</span>
                                </label>
                            </td>

                            <!-- Delete -->
                            <td style="text-align: center;">
                                <label style="display: flex; align-items: center; gap: 4px;">
                                    <input type="checkbox" name="permissions[leaves][delete]" checked style="accent-color: #ff6600; width: 16px; height: 16px;">
                                    <span style="font-size: 14px;">Delete</span>
                                </label>
                            </td>

                            <!-- Import -->
                            <td style="text-align: center;">
                                <label style="display: flex; align-items: center; gap: 4px;">
                                    <input type="checkbox" name="permissions[leaves][import]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                    <span style="font-size: 14px;">Import</span>
                                </label>
                            </td>

                            <!-- Export -->
                            <td style="text-align: center;">
                                <label style="display: flex; align-items: center; gap: 4px;">
                                    <input type="checkbox" name="permissions[leaves][export]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                    <span style="font-size: 14px;">Export</span>
                                </label>
                            </td>
                        </tr>


                        <tr style="background: #fff;">
                            <td style="padding: 10px; text-align: left; display: flex; align-items: center; gap: 10px;">
                                <!-- Enabled Switch -->
                                <label style="position: relative; display: inline-block; width: 36px; height: 18px;">
                                    <input type="checkbox" name="permissions[holidays][enabled]" checked
                                        style="opacity: 0; width: 0; height: 0;"
                                        onchange="this.nextElementSibling.style.backgroundColor = this.checked ? '#ff6600' : '#ccc'; this.nextElementSibling.firstElementChild.style.transform = this.checked ? 'translateX(18px)' : 'translateX(0)';">
                                    <span style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #ff6600; border-radius: 20px; transition: .3s;">
                                        <span style="position: absolute; height: 14px; width: 14px; left: 2px; bottom: 2px; background-color: white; border-radius: 50%; transition: .3s; transform: translateX(18px);"></span>
                                    </span>
                                </label>
                                Holidays
                            </td>

                            <td style="text-align: center;">
                                <label style="display: flex; align-items: center; gap: 4px;">
                                    <input type="checkbox" name="permissions[holidays][read]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                    <span style="font-size: 14px;">Read</span>
                                </label>
                            </td>

                            <td style="text-align: center;">
                                <label style="display: flex; align-items: center; gap: 4px;">
                                    <input type="checkbox" name="permissions[holidays][write]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                    <span style="font-size: 14px;">Write</span>
                                </label>
                            </td>

                            <td style="text-align: center;">
                                <label style="display: flex; align-items: center; gap: 4px;">
                                    <input type="checkbox" name="permissions[holidays][delete]" checked style="accent-color: #ff6600; width: 16px; height: 16px;">
                                    <span style="font-size: 14px;">Delete</span>
                                </label>
                            </td>

                            <td style="text-align: center;">
                                <label style="display: flex; align-items: center; gap: 4px;">
                                    <input type="checkbox" name="permissions[holidays][import]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                    <span style="font-size: 14px;">Import</span>
                                </label>
                            </td>

                            <td style="text-align: center;">
                                <label style="display: flex; align-items: center; gap: 4px;">
                                    <input type="checkbox" name="permissions[holidays][export]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                    <span style="font-size: 14px;">Export</span>
                                </label>
                            </td>
                        </tr>


                        <!-- projects -->
                        <tr style="background: #fff;">
                            <!-- Module Enable Switch -->
                            <td style="padding: 10px; text-align: left; display: flex; align-items: center; gap: 10px;">
                                <label style="position: relative; display: inline-block; width: 36px; height: 18px;">
                                    <input type="checkbox" name="permissions[projects][enabled]" checked
                                        style="opacity: 0; width: 0; height: 0;"
                                        onchange="this.nextElementSibling.style.backgroundColor = this.checked ? '#ff6600' : '#ccc'; this.nextElementSibling.firstElementChild.style.transform = this.checked ? 'translateX(18px)' : 'translateX(0)';">
                                    <span style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #ff6600; border-radius: 20px; transition: .3s;">
                                        <span style="position: absolute; height: 14px; width: 14px; left: 2px; bottom: 2px; background-color: white; border-radius: 50%; transition: .3s; transform: translateX(18px);"></span>
                                    </span>
                                </label>
                                Projects
                            </td>

                            <!-- Read -->
                            <td style="text-align: center;">
                                <label style="display: flex; align-items: center; gap: 4px;">
                                    <input type="checkbox" name="permissions[projects][read]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                    <span style="font-size: 14px;">Read</span>
                                </label>
                            </td>

                            <!-- Write -->
                            <td style="text-align: center;">
                                <label style="display: flex; align-items: center; gap: 4px;">
                                    <input type="checkbox" name="permissions[projects][write]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                    <span style="font-size: 14px;">Write</span>
                                </label>
                            </td>

                            <!-- Delete -->
                            <td style="text-align: center;">
                                <label style="display: flex; align-items: center; gap: 4px;">
                                    <input type="checkbox" name="permissions[projects][delete]" checked style="accent-color: #ff6600; width: 16px; height: 16px;">
                                    <span style="font-size: 14px;">Delete</span>
                                </label>
                            </td>

                            <!-- Import -->
                            <td style="text-align: center;">
                                <label style="display: flex; align-items: center; gap: 4px;">
                                    <input type="checkbox" name="permissions[projects][import]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                    <span style="font-size: 14px;">Import</span>
                                </label>
                            </td>

                            <!-- Export -->
                            <td style="text-align: center;">
                                <label style="display: flex; align-items: center; gap: 4px;">
                                    <input type="checkbox" name="permissions[projects][export]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                    <span style="font-size: 14px;">Export</span>
                                </label>
                            </td>
                        </tr>


                        <!-- Tasks -->
                        <tr style="background: #fff;">
                            <td style="padding: 10px; text-align: left; display: flex; align-items: center; gap: 10px;">
                                <label style="position: relative; display: inline-block; width: 36px; height: 18px;">
                                    <input type="checkbox" name="permissions[tasks][enabled]" checked
                                        style="opacity: 0; width: 0; height: 0;"
                                        onchange="this.nextElementSibling.style.backgroundColor = this.checked ? '#ff6600' : '#ccc'; this.nextElementSibling.firstElementChild.style.transform = this.checked ? 'translateX(18px)' : 'translateX(0)';">
                                    <span style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #ff6600; border-radius: 20px; transition: .3s;">
                                        <span style="position: absolute; height: 14px; width: 14px; left: 2px; bottom: 2px; background-color: white; border-radius: 50%; transition: .3s; transform: translateX(18px);"></span>
                                    </span>
                                </label>
                                Tasks
                            </td>

                            <td style="text-align: center;">
                                <label style="display: flex; align-items: center; gap: 4px;">
                                    <input type="checkbox" name="permissions[tasks][read]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                    <span style="font-size: 14px;">Read</span>
                                </label>
                            </td>

                            <td style="text-align: center;">
                                <label style="display: flex; align-items: center; gap: 4px;">
                                    <input type="checkbox" name="permissions[tasks][write]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                    <span style="font-size: 14px;">Write</span>
                                </label>
                            </td>

                            <td style="text-align: center;">
                                <label style="display: flex; align-items: center; gap: 4px;">
                                    <input type="checkbox" name="permissions[tasks][delete]" checked style="accent-color: #ff6600; width: 16px; height: 16px;">
                                    <span style="font-size: 14px;">Delete</span>
                                </label>
                            </td>

                            <td style="text-align: center;">
                                <label style="display: flex; align-items: center; gap: 4px;">
                                    <input type="checkbox" name="permissions[tasks][import]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                    <span style="font-size: 14px;">Import</span>
                                </label>
                            </td>

                            <td style="text-align: center;">
                                <label style="display: flex; align-items: center; gap: 4px;">
                                    <input type="checkbox" name="permissions[tasks][export]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                    <span style="font-size: 14px;">Export</span>
                                </label>
                            </td>
                        </tr>

                        <!-- Chats -->
                        <tr style="background: #fff;">
                            <td style="padding: 10px; text-align: left; display: flex; align-items: center; gap: 10px;">
                                <label style="position: relative; display: inline-block; width: 36px; height: 18px;">
                                    <input type="checkbox" name="permissions[chats][enabled]" checked
                                        style="opacity: 0; width: 0; height: 0;"
                                        onchange="this.nextElementSibling.style.backgroundColor = this.checked ? '#ff6600' : '#ccc'; this.nextElementSibling.firstElementChild.style.transform = this.checked ? 'translateX(18px)' : 'translateX(0)';">
                                    <span style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #ff6600; border-radius: 20px; transition: .3s;">
                                        <span style="position: absolute; height: 14px; width: 14px; left: 2px; bottom: 2px; background-color: white; border-radius: 50%; transition: .3s; transform: translateX(18px);"></span>
                                    </span>
                                </label>
                                Chats
                            </td>

                            <td style="text-align: center;">
                                <label style="display: flex; align-items: center; gap: 4px;">
                                    <input type="checkbox" name="permissions[chats][read]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                    <span style="font-size: 14px;">Read</span>
                                </label>
                            </td>

                            <td style="text-align: center;">
                                <label style="display: flex; align-items: center; gap: 4px;">
                                    <input type="checkbox" name="permissions[chats][write]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                    <span style="font-size: 14px;">Write</span>
                                </label>
                            </td>

                            <td style="text-align: center;">
                                <label style="display: flex; align-items: center; gap: 4px;">
                                    <input type="checkbox" name="permissions[chats][delete]" checked style="accent-color: #ff6600; width: 16px; height: 16px;">
                                    <span style="font-size: 14px;">Delete</span>
                                </label>
                            </td>

                            <td style="text-align: center;">
                                <label style="display: flex; align-items: center; gap: 4px;">
                                    <input type="checkbox" name="permissions[chats][import]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                    <span style="font-size: 14px;">Import</span>
                                </label>
                            </td>

                            <td style="text-align: center;">
                                <label style="display: flex; align-items: center; gap: 4px;">
                                    <input type="checkbox" name="permissions[chats][export]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                    <span style="font-size: 14px;">Export</span>
                                </label>
                            </td>
                        </tr>

                        <!-- Assets -->
                        <tr style="background: #fff;">
                            <td style="padding: 10px; text-align: left; display: flex; align-items: center; gap: 10px;">
                                <label style="position: relative; display: inline-block; width: 36px; height: 18px;">
                                    <input type="checkbox" name="permissions[assets][enabled]" checked
                                        style="opacity: 0; width: 0; height: 0;"
                                        onchange="this.nextElementSibling.style.backgroundColor = this.checked ? '#ff6600' : '#ccc'; this.nextElementSibling.firstElementChild.style.transform = this.checked ? 'translateX(18px)' : 'translateX(0)';">
                                    <span style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #ff6600; border-radius: 20px; transition: .3s;">
                                        <span style="position: absolute; height: 14px; width: 14px; left: 2px; bottom: 2px; background-color: white; border-radius: 50%; transition: .3s; transform: translateX(18px);"></span>
                                    </span>
                                </label>
                                Assets
                            </td>

                            <td style="text-align: center;">
                                <label style="display: flex; align-items: center; gap: 4px;">
                                    <input type="checkbox" name="permissions[assets][read]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                    <span style="font-size: 14px;">Read</span>
                                </label>
                            </td>

                            <td style="text-align: center;">
                                <label style="display: flex; align-items: center; gap: 4px;">
                                    <input type="checkbox" name="permissions[assets][write]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                    <span style="font-size: 14px;">Write</span>
                                </label>
                            </td>

                            <td style="text-align: center;">
                                <label style="display: flex; align-items: center; gap: 4px;">
                                    <input type="checkbox" name="permissions[assets][delete]" checked style="accent-color: #ff6600; width: 16px; height: 16px;">
                                    <span style="font-size: 14px;">Delete</span>
                                </label>
                            </td>

                            <td style="text-align: center;">
                                <label style="display: flex; align-items: center; gap: 4px;">
                                    <input type="checkbox" name="permissions[assets][import]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                    <span style="font-size: 14px;">Import</span>
                                </label>
                            </td>

                            <td style="text-align: center;">
                                <label style="display: flex; align-items: center; gap: 4px;">
                                    <input type="checkbox" name="permissions[assets][export]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                    <span style="font-size: 14px;">Export</span>
                                </label>
                            </td>
                        </tr>

                        <!-- Timming sheets -->
                        <tr style="background: #fff;">
                            <td style="padding: 10px; text-align: left; display: flex; align-items: center; gap: 10px;">
                                <label style="position: relative; display: inline-block; width: 36px; height: 18px;">
                                    <input type="checkbox" name="permissions[timming_sheets][enabled]" checked
                                        style="opacity: 0; width: 0; height: 0;"
                                        onchange="this.nextElementSibling.style.backgroundColor = this.checked ? '#ff6600' : '#ccc'; this.nextElementSibling.firstElementChild.style.transform = this.checked ? 'translateX(18px)' : 'translateX(0)';">
                                    <span style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #ff6600; border-radius: 20px; transition: .3s;">
                                        <span style="position: absolute; height: 14px; width: 14px; left: 2px; bottom: 2px; background-color: white; border-radius: 50%; transition: .3s; transform: translateX(18px);"></span>
                                    </span>
                                </label>
                                Timming Sheets
                            </td>

                            <td style="text-align: center;">
                                <label style="display: flex; align-items: center; gap: 4px;">
                                    <input type="checkbox" name="permissions[timming_sheets][read]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                    <span style="font-size: 14px;">Read</span>
                                </label>
                            </td>

                            <td style="text-align: center;">
                                <label style="display: flex; align-items: center; gap: 4px;">
                                    <input type="checkbox" name="permissions[timming_sheets][write]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                    <span style="font-size: 14px;">Write</span>
                                </label>
                            </td>

                            <td style="text-align: center;">
                                <label style="display: flex; align-items: center; gap: 4px;">
                                    <input type="checkbox" name="permissions[timming_sheets][delete]" checked style="accent-color: #ff6600; width: 16px; height: 16px;">
                                    <span style="font-size: 14px;">Delete</span>
                                </label>
                            </td>

                            <td style="text-align: center;">
                                <label style="display: flex; align-items: center; gap: 4px;">
                                    <input type="checkbox" name="permissions[timming_sheets][import]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                    <span style="font-size: 14px;">Import</span>
                                </label>
                            </td>

                            <td style="text-align: center;">
                                <label style="display: flex; align-items: center; gap: 4px;">
                                    <input type="checkbox" name="permissions[timming_sheets][export]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                    <span style="font-size: 14px;">Export</span>
                                </label>
                            </td>
                        </tr>







                    </tbody>
                </table>

            </div>

        </div>
        <!-- Modal Footer -->
        <div class="modal-footer border-top-0 pt-0">
            <div class="d-flex ms-auto gap-2">
                <button type="button" class="btn btn-outline" style="min-width: 100px;" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn text-white" style="background-color: #f65b0f; border-color: #f65b0f; min-width: 100px;">Save</button>
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
</div>

<!-- JS for Image Preview -->


<!-- /Add user -->

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <!-- Header -->
    <div class="offcanvas-header" style="padding: 0;">
        <!-- Header with gradient -->
        <div style="background: linear-gradient(90deg, #fd8f39, #f65b0f); width: 100%; padding: 30px 20px 60px; position: relative; text-align: center;">

            <!-- Close Button -->
            <button type="button"
                data-bs-dismiss="offcanvas"
                aria-label="Close"
                style="
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: white;
            color: black;
            border: none;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            font-size: 24px;
            font-weight: bold;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 6px rgba(0, 0, 0, 0.2);
        ">
                &times;
            </button>

            <!-- Profile Image -->
            <img id="popupImage" src=""
                class="rounded-circle"
                alt="Profile"
                style="width: 80px; height: 80px; border: 3px solid #fff; position: absolute; left: 50%; transform: translateX(-50%) translateY(19%); background: #fff; object-fit: cover;">
        </div>

    </div>

    <!-- Body -->
    <div class="offcanvas-body pt-5">
        <!-- Name and Badges -->
        <div class="text-center mt-1 " style="margin-left: 30px;">

            <h5 class="mb-0 fw-semibold" id="popupName">
                <i class="ti ti-check" style="color: #1d9f2f;"></i>
            </h5>
            <div class="d-flex justify-content-center gap-2 mt-2 flex-wrap">
                <span class="badge bg-secondary-subtle text-dark border" id="popupDept"></span>


                <span class="badge bg-light text-dark border">10+ years of Experience</span>
            </div>
        </div>

        <!-- Info -->
        <div class="mt-4 px-3 ">
            <div class="row g-3 border-bottom pb-2">
                <!-- Client ID -->
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <i class="ti ti-id me-2 text-muted"></i>
                        <small class="text-muted">Client ID</small>

                    </div>
                    <div class="fw-medium">CLT-0024</div>
                </div>

                <!-- Team -->
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <i class="ti ti-users me-2 text-muted"></i>
                        <small class="text-muted">Team</small>
                    </div>
                    <div class="fw-medium" id="popupDept">UI/UX Design</div>

                </div>

                <!-- Date of Join -->
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <i class="ti ti-calendar me-2 text-muted"></i>
                        <small class="text-muted">Date Of Join</small>
                    </div>
                    <div class="fw-medium">1st Jan 2023</div>
                </div>

                <div class="d-flex justify-content-center gap-3 mt-4 px-3 ">
                    <a href="#" class="btn btn-dark d-flex align-items-center gap-2 px-4 flex-grow-1" style="min-width: 150px;">
                        <i class="ti ti-pencil"></i> Edit Info
                    </a>
                    <a href="#" class="btn btn-warning text-white d-flex align-items-center gap-2 px-4 flex-grow-1"
                        style="background-color: #f65b0f; border-color: #f65b0f; min-width: 150px;">
                        <i class="ti ti-message"></i> Message
                    </a>
                </div>

            </div>
        </div>
        <!-- Basic Info -->
        <div class="mt-4 px-3 border-bottom">
            <h6 class="fw-bold mb-3">Basic Information</h6>

            <div class="d-flex justify-content-between mb-2">
                <small class="text-muted">
                    <i class="ti ti-phone text-muted"></i> Phone
                </small>

                <div class="fw-medium text-dark " id="popupPhone"></div>
            </div>

            <div class="d-flex justify-content-between mb-2">
                <small class="text-muted">
                    <i class="ti ti-mail text-muted"></i> Email
                </small>
                <div class="fw-medium text-dark" id="popupEmail"></div>
            </div>



            <div class="d-flex justify-content-between mb-2">
                <small class="text-muted">
                    <i class="ti ti-gender-male  text-muted"></i> Genfer
                </small>
                <div class="fw-medium text-dark">Male</div>
            </div>
        </div>

        <!-- Persnal Info -->
        <div class="mt-4 px-3 mb-4 border-bottom">
            <h6 class="fw-bold mb-3">Personal Information</h6>

            <div class="d-flex justify-content-between mb-2">
                <small class="text-muted">
                    <i class="ti ti-e-passport  text-muted"></i> Passport No
                </small>
                <div class="fw-medium text-dark">QRET4566FGRT</div>
            </div>

            <div class="d-flex justify-content-between mb-2">
                <small class="text-muted">
                    <i class="ti ti-calendar-x  text-muted"></i> Passport Exp Date
                </small>

                <div class="fw-medium text-dark">15 May 2029</div>
            </div>

            <div class="d-flex justify-content-between mb-2">
                <small class="text-muted">
                    <i class="ti ti-gender-male  text-muted"></i> Nationality
                </small>

                <div class="fw-medium text-dark">Indian</div>
            </div>
        </div>

        <div class="mt-4 px-3 mb-4">
            <h6 class="fw-bold mb-3">Projects</h6>
            <div class="row g-3">
                <!-- Project Card 1 -->
                <div class="col-12">
                    <div class="border rounded p-3">
                        <!-- Top: Icon, Title, Task Info -->
                        <div class="d-flex align-items-start mb-2">
                            <!-- Project Icon -->
                            <div class="d-flex align-items-center justify-content-end gap-2">
                                <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle" alt="Leona" style="width: 24px; height: 24px; object-fit: cover;" />

                            </div>


                            <!-- Project Info -->
                            <div>
                                <h6 class="mb-0 fw-bold" style="padding-left: 6px;">World Health</h6>
                                <small class="text-muted">
                                    8 tasks <span class="mx-1" style="color: #f65b0f;">•</span> 15 Completed
                                </small>
                            </div>
                        </div>

                        <!-- Horizontal Divider -->
                        <div style="background-color: white; padding: 10px;">
                            <hr style="
    border: none;
    border-top: 1px solid #444;  /* thicker and darker */
    margin: 1rem 0;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.4); /* subtle shadow */
  " />
                        </div>


                        <!-- Deadline & Project Lead: Two Columns, Same Row -->
                        <div class="d-flex justify-content-between align-items-start">
                            <!-- Deadline Column -->
                            <div>
                                <small class="text-muted d-block mb-1">Deadline</small>
                                <div class="fw-medium">31 July 2025</div>
                            </div>

                            <!-- Project Lead Column -->
                            <div class="text-end">
                                <small class="text-muted d-block mb-1">Project Lead</small>
                                <div class="d-flex align-items-center justify-content-end gap-2">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle" alt="Leona" style="width: 24px; height: 24px; object-fit: cover;" />
                                    <div class="fw-medium">Leona</div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <!-- Project Card 2 -->
                <div class="col-12">
                    <div class="border rounded p-3">
                        <!-- Top: Icon, Title, Task Info -->
                        <div class="d-flex align-items-start mb-2">
                            <!-- Project Icon -->
                            <div class="d-flex align-items-center justify-content-end gap-2">
                                <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle" alt="Leona" style="width: 24px; height: 24px; object-fit: cover; margin-left:8px" />
                            </div>



                            <!-- Project Info -->
                            <div>
                                <h6 class="mb-0 fw-bold" style="padding-left: 6px;"> Hospital Administration</h6>
                                <small class="text-muted">
                                    8 tasks <span class="mx-1" style="color: #f65b0f;">•</span> 15 Completed
                                </small>
                            </div>
                        </div>

                        <!-- Horizontal Divider -->
                        <div style="background-color: white; padding: 10px;">
                            <hr style="
    border: none;
    border-top: 1px solid #444;  /* thicker and darker */
    margin: 1rem 0;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.4); /* subtle shadow */
  " />
                        </div>

                        <!-- Deadline & Project Lead: Two Columns, Same Row -->
                        <div class="d-flex justify-content-between align-items-start">
                            <!-- Deadline Column -->
                            <div>
                                <small class="text-muted d-block mb-1">Deadline</small>
                                <div class="fw-medium">31 July 2025</div>
                            </div>

                            <!-- Project Lead Column -->

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>


</div>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->

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
    function preview(event) {
        const input = event.target;
        const reader = new FileReader();
        reader.onload = function() {
            document.getElementById('previewImg').src = reader.result;
        };
        if (input.files[0]) {
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('.nav-link');

        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                tabs.forEach(t => {
                    t.classList.remove('active');
                    t.style.color = '#333';
                    t.style.borderBottom = 'none';
                });

                this.classList.add('active');
                this.style.color = '#f65b0f';
                this.style.borderBottom = '2px solid #f65b0f';
            });
        });
    });
</script>

<script>
    function previewImage(event) {
        const input = event.target;
        const reader = new FileReader();

        reader.onload = function(e) {
            const img = input.previousElementSibling; // The <img> element before the input
            img.src = e.target.result;
        }

        if (input.files[0]) {
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<script>
    function showUserPopup(id, name, email, phone, department, image) {
        document.getElementById('popupImage').src = image;
        document.getElementById('popupName').innerText = name;
        document.getElementById('popupEmail').innerText = email;
        document.getElementById('popupPhone').innerText = phone;
        document.getElementById('popupDept').innerText = department;
    }
</script>
<!-- Script to set delete URL -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteLinks = document.querySelectorAll('[data-bs-target="#deleteConfirmModal"]');
        const confirmBtn = document.getElementById('confirmDeleteBtn');

        deleteLinks.forEach(link => {
            link.addEventListener('click', function() {
                const deleteUrl = this.getAttribute('data-delete-url');
                confirmBtn.setAttribute('href', deleteUrl);
            });
        });
    });
</script>

@component('components.model-popup')
@endcomponent
@endsection