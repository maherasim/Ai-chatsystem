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
    <div style="visibility:visible;">
        @include('Chats.chatsidebar')
    </div>



    <!-- /Left Sidebar Menu -->

    <!-- sidebar group -->
    <div class="sidebar-group" style="visibility: visible;">
        <div class="tab-content">
            <div class="tab-pane fade active show " id="chat-menu">
                <!-- <div id="chats" class="sidebar-content active slimscroll"> -->
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
                        <!-- Pinned Chats-->
                         <!-- todo list -->
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <h5 class="chat-title">Today ToDO List</h5>
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
                    </div>

                </div>

                <!-- </div> -->
                <!-- / Chats sidebar -->

            </div>





            <!-- Profile -->
            <div class="tab-pane fade" id="profile-menu">
                <!-- Profile sidebar -->
                <div class="sidebar-content active slimscroll">
                    <div class="slimscroll">
                        <div class="chat-search-header">
                            <div class="header-title d-flex align-items-center justify-content-between">
                                <h4 class="mb-3">Profile</h4>
                            </div>
                        </div>

                        <!-- Profile -->
                        <div class="profile mx-3">
                            <div class="border-bottom text-center pb-3 mx-1">
                                <div class="d-flex justify-content-center ">
                                    <span class="avatar avatar-xxxl online mb-4">
                                        <img src="{{URL::asset('/build/img/profiles/avatar-16.jpg')}}" class="rounded-circle" alt="user">
                                    </span>
                                </div>
                                <div>
                                    <h6 class="fs-16">Salom Katherine</h6>
                                    <div class="d-flex justify-content-center">
                                        <span class="fs-14 text-center">Web Designer</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Profile -->

                        <div class="sidebar-body chat-body">

                            <!-- Profile Info -->
                            <h5 class="mb-2">Profile Info</h5>
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex profile-list justify-content-between align-items-center border-bottom mb-3 pb-3">
                                        <div>
                                            <h6 class="fs-14">Name</h6>
                                            <p class="fs-16 ">Salom Katherine</p>
                                        </div>
                                        <span><i class="ti ti-user-circle fs-16"></i></span>
                                    </div>
                                    <div class="d-flex profile-list justify-content-between align-items-center border-bottom mb-3 pb-3">
                                        <div>
                                            <h6 class="fs-14">Phone</h6>
                                            <p class="fs-16">514-245-98315</p>
                                        </div>
                                        <span><i class="ti ti-phone-check fs-16"></i></span>
                                    </div>
                                    <div class="d-flex profile-list  profile-list justify-content-between align-items-center border-bottom mb-3 pb-3">
                                        <div>
                                            <h6 class="fs-14">Gender</h6>
                                            <p class="fs-16">Female</p>
                                        </div>
                                        <span><i class="ti ti-user-star fs-16"></i></span>
                                    </div>
                                    <div class="d-flex profile-list justify-content-between align-items-center border-bottom mb-3 pb-3">
                                        <div>
                                            <h6 class="fs-14">Email Address</h6>
                                            <p class="fs-16">info@example.com</p>
                                        </div>
                                        <span><i class="ti ti-mail-heart fs-16"></i></span>
                                    </div>
                                    <div class="d-flex profile-list profile-list justify-content-between align-items-center border-bottom mb-3 pb-3">
                                        <div>
                                            <h6 class="fs-14">Bio</h6>
                                            <p class="fs-16">Web Designer</p>
                                        </div>
                                        <span><i class="ti ti-user-check fs-16"></i></span>
                                    </div>
                                    <div class="d-flex profile-list justify-content-between align-items-center border-bottom mb-3 pb-3">
                                        <div>
                                            <h6 class="fs-14">Location</h6>
                                            <p class="fs-16">Portland, USA</p>
                                        </div>
                                        <span><i class="ti ti-map-2 fs-16"></i></span>
                                    </div>
                                    <div class="d-flex profile-list justify-content-between align-items-center">
                                        <div>
                                            <h6 class="fs-14">Join Date</h6>
                                            <p class="fs-16">01 July 2024</p>
                                        </div>
                                        <span><i class="ti ti-calendar-event fs-16"></i></span>
                                    </div>
                                </div>
                            </div>
                            <!-- /Profile Info -->

                            <!-- Status -->
                            <h5 class="mb-2">Status</h5>
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex profile-list justify-content-between align-items-center border-bottom mb-3 pb-3">
                                        <div>
                                            <h6 class="fs-14">Active Status</h6>
                                            <p class="fs-16 ">Show when you’re active</p>
                                        </div>
                                        <div class="form-check form-switch d-flex justify-content-end align-items-center">
                                            <input class="form-check-input" type="checkbox" role="switch" checked>
                                        </div>
                                    </div>
                                    <div class="d-flex profile-list justify-content-between align-items-center">
                                        <div>
                                            <h6 class="fs-14">Friends Status</h6>
                                            <p class="fs-16 ">Show friends status in chat</p>
                                        </div>
                                        <div class="form-check form-switch d-flex justify-content-end align-items-center">
                                            <input class="form-check-input" type="checkbox" role="switch" checked>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Status -->

                            <!-- Social Media -->
                            <h5 class="mb-2">Social Media</h5>
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex profile-list justify-content-between align-items-center border-bottom mb-3 pb-3">
                                        <div>
                                            <h6 class="fs-14">Facebook</h6>
                                            <p class="fs-16 ">@SalomKatherine</p>
                                        </div>
                                        <span><i class="ti ti-brand-facebook fs-16"></i></span>
                                    </div>
                                    <div class="d-flex profile-list justify-content-between align-items-center border-bottom mb-3 pb-3">
                                        <div>
                                            <h6 class="fs-14">Instagram Linkedin</h6>
                                            <p class="fs-16 ">@SalomKatherine</p>
                                        </div>
                                        <span><i class="ti ti-brand-instagram fs-16"></i></span>
                                    </div>
                                    <div class="d-flex profile-list justify-content-between align-items-center">
                                        <div>
                                            <h6 class="fs-14">Linkedin</h6>
                                            <p class="fs-16 ">@SalomKatherine</p>
                                        </div>
                                        <span><i class="ti ti-brand-linkedin fs-16"></i></span>
                                    </div>
                                </div>
                            </div>
                            <!-- /Social Media -->

                            <!-- Deactivate -->
                            <h5 class="mb-2">Deactivate </h5>
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex profile-list justify-content-between align-items-center">
                                        <div>
                                            <h6 class="fs-14">Deactivate Account</h6>
                                            <p class="fs-16 ">Deactivate your Account</p>
                                        </div>
                                        <div class="form-check form-switch d-flex justify-content-end align-items-center">
                                            <input class="form-check-input" type="checkbox" role="switch">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Deactivate -->

                            <!-- Logout -->
                            <h5 class="mb-2">Logout</h5>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="d-flex profile-list justify-content-between align-items-center">
                                        <div>
                                            <h6 class="fs-14">Logout</h6>
                                            <p class="fs-16 ">Sign out from this Device</p>
                                        </div>
                                        <a href="{{url('signin')}}" class="link-icon"><i class="ti ti-logout fs-16"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!-- /Logout -->

                        </div>

                    </div>

                </div>
                <!-- / Profile sidebar -->
            </div>
            <!-- /Profile -->

            <!-- Calls -->
            <div class="tab-pane fade" id="call-menu">
                <div class="sidebar-content active slimscroll">

                    <div class="slimscroll">

                        <div class="chat-search-header">
                            <div class="header-title d-flex align-items-center justify-content-between">
                                <h4 class="mb-3">Calls</h4>
                                <div class="d-flex align-items-center mb-3">
                                    <a href="#" class="call-icon d-flex justify-content-center align-items-center text-white bg-primary rounded-circle me-2" data-bs-toggle="modal" data-bs-target="#new-call">
                                        <i class="ti ti-phone-plus fs-16"></i>
                                    </a>
                                    <div class="dropdown">
                                        <a href="javascript:void(0);" data-bs-toggle="dropdown" class="fs-16 text-default">
                                            <i class="ti ti-dots-vertical"></i>
                                        </a>
                                        <ul class="dropdown-menu p-3">
                                            <li>
                                                <a href="javascript:;" class="dropdown-item d-flex align-items-center">
                                                    <span><i class="ti ti-phone-x me-2"></i></span>
                                                    Clear Call Log
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Chat Search -->
                            <div class="search-wrap">
                                <form action="#">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search">
                                        <span class="input-group-text"><i class="ti ti-search"></i></span>
                                    </div>
                                </form>
                            </div>
                            <!-- /Chat Search -->
                        </div>

                        <div class="sidebar-body chat-body" id="chatsidebar1">

                            <!-- Left Chat Title -->
                            <div class="d-flex  align-items-center mb-3">
                                <h5 class="chat-title2 me-2">All Calls</h5>
                                <div class="dropdown">
                                    <a href="#" class="text-default fs-16" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-chevron-down"></i></a>
                                    <ul class=" dropdown-menu dropdown-menu-end p-3" id="innerTab1" role="tablist">
                                        <li role="presentation">
                                            <a class="dropdown-item active" id="all-calls-tab" data-bs-toggle="tab" href="#all-calls" role="tab" aria-controls="all-calls" aria-selected="true" onclick="changeChat2('All Calls')">All Calls</a>
                                        </li>
                                        <li role="presentation">
                                            <a class="dropdown-item" id="audio-calls-tab" data-bs-toggle="tab" href="#audio-calls" role="tab" aria-controls="audio-calls" aria-selected="false" onclick="changeChat2('Audio Calls')">Audio Calls</a>
                                        </li>
                                        <li role="presentation">
                                            <a class="dropdown-item" id="video-calls-tab" data-bs-toggle="tab" href="#video-calls" role="tab" aria-controls="video-calls" aria-selected="false" onclick="changeChat2('Video Calls')">Video Calls</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /Left Chat Title -->
                            <div class="tab-content" id="callTabContent">
                                <div class="tab-pane fade show active" id="all-calls" role="tabpanel" aria-labelledby="all-calls-tab">
                                    <div class="chat-users-wrap">
                                        <div class="chat-list">
                                            <a href="{{url('all-calls')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Edward Lietz</h6>
                                                        <p><i class="ti ti-phone-outgoing text-purple me-2"></i>20 Min Ago</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">08m 12s</span>
                                                        <div>
                                                            <i class="ti ti-phone-call text-pink"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('all-calls')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6 class="">Mark Villiams</h6>
                                                        <p class="fs-14">
                                                            <i class="ti ti-phone-incoming me-2 fs-14 text-success"></i>
                                                            20 Min Ago
                                                        </p>
                                                    </div>
                                                    <div class="chat-user ">
                                                        <span class="mb-2">08m 12s</span>
                                                        <div class="d-flex justify-content-end">
                                                            <i class="ti ti-phone-call text-pink"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('all-calls')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-05.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Federico Wells</h6>
                                                        <p><i class="ti ti-video-off text-danger me-2"></i>20 Min Ago</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">08m 12s</span>
                                                        <div>
                                                            <i class="ti ti-video text-pink"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('all-calls')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-03.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Clyde Smith</h6>
                                                        <p><i class="ti ti-phone-outgoing text-purple me-2"></i>20 Min Ago</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">08m 12s</span>
                                                        <div>
                                                            <i class="ti ti-phone-call text-pink"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('all-calls')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-04.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Carla Jenkins</h6>
                                                        <p><i class="ti ti-video text-success me-2"></i>20 Min Ago</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">08m 12s</span>
                                                        <div>
                                                            <i class="ti ti-video text-pink"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('all-calls')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-02.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Sarika Jain</h6>
                                                        <p><i class="ti ti-phone-off text-danger me-2"></i>20 Min Ago</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">08m 12s</span>
                                                        <div>
                                                            <i class="ti ti-phone-call text-pink"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('all-calls')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg bg-purple offline avatar-rounded me-2">
                                                    <span class="avatar-title fs-14 fw-medium">AG</span>
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Amfr_boys_Group</h6>
                                                        <p><i class="ti ti-video-minus text-purple me-2"></i>20 Min Ago</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">08m 12s</span>
                                                        <div>
                                                            <i class="ti ti-video text-pink"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('all-calls')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-10.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Wilbur Martinez</h6>
                                                        <p><i class="ti ti-phone-off text-danger me-2"></i>20 Min Ago</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">08m 12s</span>
                                                        <div>
                                                            <i class="ti ti-phone-call text-pink"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="audio-calls" role="tabpanel" aria-labelledby="audio-calls-tab">
                                    <div class="chat-users-wrap">
                                        <div class="chat-list">
                                            <a href="{{url('all-calls')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Edward Lietz</h6>
                                                        <p><i class="ti ti-phone-outgoing text-purple me-2"></i>20 Min Ago</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">08m 12s</span>
                                                        <div>
                                                            <i class="ti ti-phone-call text-pink"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('all-calls')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6 class="">Mark Villiams</h6>
                                                        <p class="fs-14">
                                                            <i class="ti ti-phone-incoming me-2 fs-14 text-success"></i>
                                                            20 Min Ago
                                                        </p>
                                                    </div>
                                                    <div class="chat-user ">
                                                        <span class="mb-2">08m 12s</span>
                                                        <div class="d-flex justify-content-end">
                                                            <i class="ti ti-phone-call text-pink"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('all-calls')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-05.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Federico Wells</h6>
                                                        <p class="fs-14">
                                                            <i class="ti ti-phone-incoming me-2 fs-14 text-success"></i>
                                                            20 Min Ago
                                                        </p>
                                                    </div>
                                                    <div class="chat-user ">
                                                        <span class="mb-2">08m 12s</span>
                                                        <div class="d-flex justify-content-end">
                                                            <i class="ti ti-phone-call text-pink"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('all-calls')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-03.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Clyde Smith</h6>
                                                        <p><i class="ti ti-phone-outgoing text-purple me-2"></i>20 Min Ago</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">08m 12s</span>
                                                        <div>
                                                            <i class="ti ti-phone-call text-pink"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('all-calls')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-04.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Carla Jenkins</h6>
                                                        <p><i class="ti ti-phone-off text-danger me-2"></i>20 Min Ago</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">08m 12s</span>
                                                        <div>
                                                            <i class="ti ti-phone-call text-pink"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('all-calls')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-02.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Sarika Jain</h6>
                                                        <p><i class="ti ti-phone-off text-danger me-2"></i>20 Min Ago</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">08m 12s</span>
                                                        <div>
                                                            <i class="ti ti-phone-call text-pink"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('all-calls')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg bg-purple avatar-rounded me-2">
                                                    <span class="avatar-title fs-14 fw-medium">AG</span>
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Amfr_boys_Group</h6>
                                                        <p class="fs-14">
                                                            <i class="ti ti-phone-incoming me-2 fs-14 text-success"></i>
                                                            20 Min Ago
                                                        </p>
                                                    </div>
                                                    <div class="chat-user ">
                                                        <span class="mb-2">08m 12s</span>
                                                        <div class="d-flex justify-content-end">
                                                            <i class="ti ti-phone-call text-pink"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('all-calls')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-10.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Wilbur Martinez</h6>
                                                        <p><i class="ti ti-phone-off text-danger me-2"></i>20 Min Ago</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">08m 12s</span>
                                                        <div>
                                                            <i class="ti ti-phone-call text-pink"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="video-calls" role="tabpanel" aria-labelledby="video-calls-tab">
                                    <div class="chat-users-wrap">
                                        <div class="chat-list">
                                            <a href="{{url('all-calls')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Edward Lietz</h6>
                                                        <p><i class="ti ti-video text-success me-2"></i>20 Min Ago</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">08m 12s</span>
                                                        <div>
                                                            <i class="ti ti-video text-pink"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('all-calls')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6 class="">Mark Villiams</h6>
                                                        <p><i class="ti ti-video-off text-danger me-2"></i>20 Min Ago</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">08m 12s</span>
                                                        <div>
                                                            <i class="ti ti-video text-pink"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('all-calls')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-05.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Federico Wells</h6>
                                                        <p><i class="ti ti-video-off text-danger me-2"></i>20 Min Ago</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">08m 12s</span>
                                                        <div>
                                                            <i class="ti ti-video text-pink"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('all-calls')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-03.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Clyde Smith</h6>
                                                        <p><i class="ti ti-video-minus text-purple me-2"></i>20 Min Ago</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">08m 12s</span>
                                                        <div>
                                                            <i class="ti ti-video text-pink"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('all-calls')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-04.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Carla Jenkins</h6>
                                                        <p><i class="ti ti-video text-success me-2"></i>20 Min Ago</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">08m 12s</span>
                                                        <div>
                                                            <i class="ti ti-video text-pink"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('all-calls')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-02.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Sarika Jain</h6>
                                                        <p><i class="ti ti-video-minus text-purple me-2"></i>20 Min Ago</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">08m 12s</span>
                                                        <div>
                                                            <i class="ti ti-video text-pink"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('all-calls')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg bg-purple avatar-rounded me-2">
                                                    <span class="avatar-title fs-14 fw-medium">AG</span>
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Amfr_boys_Group</h6>
                                                        <p><i class="ti ti-video-off text-danger me-2"></i>20 Min Ago</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">08m 12s</span>
                                                        <div>
                                                            <i class="ti ti-video text-pink"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('all-calls')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-10.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Wilbur Martinez</h6>
                                                        <p><i class="ti ti-video-minus text-purple me-2"></i>20 Min Ago</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">08m 12s</span>
                                                        <div>
                                                            <i class="ti ti-video text-pink"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <!-- /Calls -->



        </div>
    </div>
    <!-- /Sidebar group -->

    <!-- Chat -->





    <div class="chat chat-messages show" id="middle">
        <div>
            <div class="chat-header">
                <div class="user-details">
                    <div class="d-xl-none">
                        <a class="text-muted chat-close me-2" href="#">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                    <div class="avatar avatar-lg online flex-shrink-0">
                        <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}" class="rounded-circle" alt="image">
                    </div>
                    <div class="ms-2 overflow-hidden">
                        <h6>Username</h6>
                        <p class="last-seen text-truncate"> Online</p>
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
            <!-- body -->
            <div style="overflow-y: auto;flex:1;height: 100vh;">
                <div class="chat-body chat-page-group">
                    <!-- Container for the full width -->
                    <div class="container-fluid px-4">
                        <div class="row g-3 py-2">
                            <!-- Card 1: Total Projects -->
                            <div class="col-md-2">
                                <div class="d-flex align-items-center px-3 py-2 h-100"
                                    style="border: 1px solid #28c76f; border-radius: 10px;">
                                    <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}" class="rounded-circle me-2" alt="image"
                                        style="width: 30px; height: 30px;">
                                    <div>
                                        <div style="font-size: 0.9rem; color: #1e2b4d;">Total Projects</div>
                                        <div class="fw-bold" style="font-size: 1.2rem; color: #1e2b4d;">52</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Repeat for other cards -->

                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2" style="margin-left: 46px;">
                                <div class="d-flex align-items-center px-3 py-2 h-100"
                                    style="border: 1px solid #28c76f; border-radius: 10px;">
                                    <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}" class="rounded-circle me-2" alt="image"
                                        style="width: 30px; height: 30px;">
                                    <div>
                                        <div style="font-size: 0.9rem; color: #1e2b4d;">New Projects</div>
                                        <div class="fw-bold" style="font-size: 1.2rem; color: #1e2b4d;">2</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2" style="margin-left: 46px;">
                                <div class="d-flex align-items-center px-3 py-2 h-100"
                                    style="border: 1px solid #28c76f; border-radius: 10px;">
                                    <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}" class="rounded-circle me-2" alt="image"
                                        style="width: 30px; height: 30px;">
                                    <div>
                                        <div style="font-size: 0.9rem; color: #1e2b4d;">In Progress</div>
                                        <div class="fw-bold" style="font-size: 1.2rem; color: #1e2b4d;">45</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2" style="margin-left: 46px;">
                                <div class="d-flex align-items-center px-3 py-2 h-100"
                                    style="border: 1px solid #28c76f; border-radius: 10px;">
                                    <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}" class="rounded-circle me-2" alt="image"
                                        style="width: 30px; height: 30px;">
                                    <div>
                                        <div style="font-size: 0.9rem; color: #1e2b4d;">In Hold</div>
                                        <div class="fw-bold" style="font-size: 1.2rem; color: #1e2b4d;">45</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2" style="margin-left: 46px;">
                                <div class="d-flex align-items-center px-3 py-2 h-100"
                                    style="border: 1px solid #28c76f; border-radius: 10px;">
                                    <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}" class="rounded-circle me-2" alt="image"
                                        style="width: 30px; height: 30px;">
                                    <div>
                                        <div style="font-size: 0.9rem; color: #1e2b4d;">In Delayed</div>
                                        <div class="fw-bold" style="font-size: 1.2rem; color: #1e2b4d;">45</div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- project overview -->
                    <div class="project-succes pt-4 pb-2 d-flex justify-content-between align-items-center">
                        <div>
                            <h3 style="margin: 0;">Project overview</h3>
                            <strong>Total projects: 10</strong>
                        </div>

                        <div class="d-flex" style="gap: 8px; background: #f8fafc; padding: 6px 10px; border-radius: 8px;">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#add_user"
                                style="background-color: #ff7700; color: white; border: none; padding: 8px 14px; border-radius: 6px; font-weight: 500; cursor:pointer; position: relative; z-index: 10;">
                                + Add Project
                            </button>
                            <button type="button" class="btn"
                                style="background: #32b768; border: 1px solid #32b768; color: white; border-radius: 6px; font-weight: 500; font-size: 14px; padding: 6px 18px;">
                                All
                            </button>
                            <button type="button" class="btn"
                                style="background: #f8fafc; color: #566a7f; border-radius: 6px; font-weight: 500; font-size: 14px; padding: 6px 18px;">
                                In Progress
                            </button>
                            <button type="button" class="btn"
                                style="background: #f8fafc;  color: #566a7f; border-radius: 6px; font-weight: 500; font-size: 14px; padding: 6px 18px;">
                                In Delayed
                            </button>
                            <button type="button" class="btn"
                                style="background: #f8fafc; color: #566a7f; border-radius: 6px; font-weight: 500; font-size: 14px; padding: 6px 18px;">
                                In Hold
                            </button>
                        </div>
                    </div>
                    <!-- box project section -->
                    <div class="container mb-1">
                        <div class="row g-3">
                            <div class="col-md-6 col-lg-4 col-xl-4">
                                <div class="card shadow-sm  p-3" style="border-radius: 20px; font-family:    'Segoe UI', sans-serif;">
                                    <!-- Top Row: Circle, Center Image, 3 Dots -->
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div style="width: 60px; height: 60px; position: relative;">
                                            <svg width="60" height="60">
                                                <circle cx="30" cy="30" r="26" stroke="#d1d1d1" stroke-width="6" fill="none" />
                                                <circle
                                                    cx="30"
                                                    cy="30"
                                                    r="26"
                                                    stroke="url(#grad)"
                                                    stroke-width="6"
                                                    fill="none"
                                                    stroke-dasharray="163.36"
                                                    stroke-dashoffset="122.52"
                                                    stroke-linecap="round"
                                                    transform="rotate(-90 30 30)" />
                                                <defs>
                                                    <linearGradient id="grad" x1="0%" y1="0%" x2="100%" y2="0%">
                                                        <stop offset="0%" stop-color="#ff7f00" />
                                                        <stop offset="100%" stop-color="#fcd34d" />
                                                    </linearGradient>
                                                </defs>
                                            </svg>
                                            <!-- Center Text -->
                                            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 12px; font-weight: bold; color: #333;">
                                                25%
                                            </div>
                                        </div>

                                        <!-- <img src="" class="rounded-circle" alt="image"> -->
                                        <img src="{{URL::asset('/build/img/yekbon.svg')}}" class="rounded-circle" style="height: 65px;" alt="Project Logo">
                                        <div>

                                        </div>
                                    </div>

                                    <!-- Project Title -->
                                    <!-- Project Title & Project ID -->
                                    <div class="text-center" style="cursor: pointer; margin-left:50px;">
                                        <h6 style="cursor: pointer;"
                                            data-bs-toggle="offcanvas"
                                            data-bs-target="#offcanvasRight"
                                            aria-controls="offcanvasRight">
                                            Project Title
                                        </h6>

                                        <!-- Project ID styled exactly like screenshot -->
                                        <div class="d-inline-block px-3 py-1 mb-2 mt-2"
                                            style="background: #f4f4f4; border-radius: 999px; font-size: 12px; color: #e53935; font-weight: 500;">
                                            Project ID
                                        </div>
                                    </div>

                                    <!-- Section Tags styled exactly like screenshot -->
                                    <div class="d-flex justify-content-center gap-2 mb-3 flex-nowrap">
                                        <div class="px-3 py-1"
                                            style="background: #f4f4f4; border-radius: 999px; font-size: 12px; color: #e53935; font-weight: 500; white-space: nowrap;">
                                            Section #1
                                        </div>
                                        <div class="px-3 py-1"
                                            style="background: #f4f4f4; border-radius: 999px; font-size: 12px; color: #e53935; font-weight: 500; white-space: nowrap;">
                                            Section #1
                                        </div>
                                        <div class="px-3 py-1"
                                            style="background: #f4f4f4; border-radius: 999px; font-size: 12px; color: #e53935; font-weight: 500; white-space: nowrap;">
                                            Section #1
                                        </div>
                                        <div class="px-3 py-1"
                                            style="background: #f4f4f4; border-radius: 999px; font-size: 12px; color: #e53935; font-weight: 500; white-space: nowrap;">
                                            Section #1
                                        </div>
                                    </div>


                                    <!-- Stats Row -->
                                    <div class="row text-center mb-2">
                                        <div class="col">
                                            <strong style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;color:black ;font-size: 15px;">Total Tickets</strong>
                                            <div class="text-dark" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">5</div>
                                        </div>
                                        <div class="col">
                                            <strong style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;color:black ;font-size: 15px;">Total Tasks</strong>
                                            <div class="text-dark" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">10</div>
                                        </div>
                                        <div class="col">
                                            <strong style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;color:black ;font-size: 15px;">Progress</strong>
                                            <div class="text-dark" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">25%</div>
                                        </div>
                                    </div>

                                    <!-- Progress Status -->
                                    <div class="text-center mb-2">
                                        <div style="background: #c9e9d7; color: #1e2b4d; border-radius: 6px; display: inline-flex; align-items: center; padding: 2px 24px; font-weight: 500; font-size: 14px;">
                                            <img src="{{URL::asset('/build/img/flag.svg')}}"
                                                style="height: 16px; width: 16px;" alt="flag" />


                                        </div>
                                    </div>


                                    <!-- Ticket Colors -->
                                    <!-- Wrapper to center the inner block -->
                                    <div class="d-flex justify-content-center">
                                        <!-- Content box with light background and auto width -->
                                        <div class="d-flex align-items-center gap-2 mb-3 px-3" style="background: #f8f8f8; border-radius: 10px; width: fit-content;">
                                            <!-- "Ticket" label -->
                                            <span style="background: #f1f1f1; padding: 4px 8px; border-radius: 6px; font-size: 12px; color: #6c757d;margin-left:-15px;">Ticket</span>

                                            <!-- Blue dot + number -->
                                            <span style="width: 10px; height: 10px; background: #3b82f6; border-radius: 50%; display: inline-block;"></span>
                                            <span style="font-size: 13px; color: #6c757d;">1</span>

                                            <!-- Orange dot + number -->
                                            <span style="width: 10px; height: 10px; background: #f59e0b; border-radius: 50%; display: inline-block;"></span>
                                            <span style="font-size: 13px; color: #6c757d;">3</span>

                                            <!-- Red dot + number -->
                                            <span style="width: 10px; height: 10px; background: #ef4444; border-radius: 50%; display: inline-block;"></span>
                                            <span style="font-size: 13px; color: #6c757d;">0</span>

                                            <!-- Purple dot + number -->
                                            <span style="width: 10px; height: 10px; background: #a855f7; border-radius: 50%; display: inline-block;"></span>
                                            <span style="font-size: 13px; color: #6c757d;">0</span>

                                            <!-- Green dot + number -->
                                            <span style="width: 10px; height: 10px; background: #22c55e; border-radius: 50%; display: inline-block;"></span>
                                            <span style="font-size: 13px; color: #6c757d;">0</span>
                                        </div>
                                    </div>



                                    <!-- Project Manager / Developers -->
                                    <div class="d-flex justify-content-between m-0 w-100"
                                        style="background-color: #f9f9f9; border-radius: 12px; padding: 10px;">

                                        <!-- Project Manager -->
                                        <div class="text-center">
                                            <strong style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #1e60a1; font-size: 15px;">
                                                Project Manager
                                            </strong>
                                            <div class="d-flex justify-content-center mt-1">
                                                <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}"
                                                    style="height: 30px; width: 30px; border: 2px solid #00e0ff; border-radius: 50%;" />
                                            </div>
                                        </div>

                                        <!-- Developers -->
                                        <div class="text-center">
                                            <strong style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #1e60a1; font-size: 15px;">
                                                Developers
                                            </strong>
                                            <div class="d-flex justify-content-center mt-1" style="margin-left: 10px;">
                                                <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}"
                                                    style="height: 30px; width: 30px; border: 2px solid #00e0ff; margin-left: -10px; border-radius: 50%;" />
                                                <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}"
                                                    style="height: 30px; width: 30px; border: 2px solid #00e0ff; margin-left: -10px; border-radius: 50%;" />
                                                <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}"
                                                    style="height: 30px; width: 30px; border: 2px solid #00e0ff; margin-left: -10px; border-radius: 50%;" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-2 mt-2 m-0 w-100" style="background-color: #f9f9f9; border-radius: 12px; padding: 15px 10px;">
                                        <!-- Start Date -->
                                        <div class="col-4">
                                            <strong style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #1e60a1; font-size: 15px;">
                                                Start Date
                                            </strong>
                                            <div style="color: #1e60a1; font-weight: 600; font-size: 13px;">DD:MM:YY</div>
                                        </div>

                                        <!-- Work Days -->
                                        <div class="col-4">
                                            <strong style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #1e60a1; font-size: 15px;">
                                                Work Days
                                            </strong>
                                            <div style="color: #1e60a1; font-weight: 600; font-size: 13px;">5 Days</div>
                                        </div>

                                        <!-- Days Left -->
                                        <div class="col-4">
                                            <strong style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #1e60a1; font-size: 15px;">
                                                Days Left
                                            </strong>
                                            <div style="color: #1e60a1; font-weight: 600; font-size: 13px;">5 Days</div>
                                        </div>

                                        <!-- Blue Progress Bar (Full Width Below) -->
                                        <div class="col-12 mt-3">
                                            <div class="progress" style="height: 6px; background-color: #f1f1f1; border-radius: 10px; overflow: hidden;">
                                                <div class="progress-bar"
                                                    role="progressbar"
                                                    style="width: 60%; background-color: #4dc3ff; border-radius: 10px;"
                                                    aria-valuenow="60"
                                                    aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>







                                    <!-- Section Progress Block -->
                                    <div style="background-color: #f9f9f9; border-radius: 12px; padding: 15px 10px;">

                                        <!-- Section Titles -->
                                        <div class="d-flex justify-content-between px-1"
                                            style="font-size: 13px; color: #2e3a59; font-weight: 600; font-family: 'Segoe UI', sans-serif;">
                                            <span>Section #1 75%</span>
                                            <span>Section #1 75%</span>
                                            <span>Section #1 75%</span>
                                        </div>

                                        <!-- Progress Bars -->
                                        <div class="d-flex justify-content-between align-items-center mt-2 gap-2 px-1">
                                            <!-- Green Progress -->
                                            <div class="progress"
                                                style="width: 32%; height: 8px; background-color: #d3f4dc; border-radius: 10px;">
                                                <div class="progress-bar"
                                                    style="width: 75%; background-color: #28c76f; border-radius: 10px;"></div>
                                            </div>

                                            <!-- Yellow Progress -->
                                            <div class="progress"
                                                style="width: 32%; height: 8px; background-color: #fef3d3; border-radius: 10px;">
                                                <div class="progress-bar"
                                                    style="width: 75%; background-color: #ffc107; border-radius: 10px;"></div>
                                            </div>

                                            <!-- Red Progress -->
                                            <div class="progress"
                                                style="width: 32%; height: 8px; background-color: #fdd7d7; border-radius: 10px;">
                                                <div class="progress-bar"
                                                    style="width: 75%; background-color: #ea5455; border-radius: 10px;"></div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <!-- 2nd -->
                            <div class="col-md-6 col-lg-4 col-xl-4">
                                <div class="card shadow-sm  p-3" style="border-radius: 20px; font-family:    'Segoe UI', sans-serif;">
                                    <!-- Top Row: Circle, Center Image, 3 Dots -->
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div style="width: 60px; height: 60px; position: relative;">
                                            <svg width="60" height="60">
                                                <circle cx="30" cy="30" r="26" stroke="#d1d1d1" stroke-width="6" fill="none" />
                                                <circle
                                                    cx="30"
                                                    cy="30"
                                                    r="26"
                                                    stroke="url(#grad)"
                                                    stroke-width="6"
                                                    fill="none"
                                                    stroke-dasharray="163.36"
                                                    stroke-dashoffset="122.52"
                                                    stroke-linecap="round"
                                                    transform="rotate(-90 30 30)" />
                                                <defs>
                                                    <linearGradient id="grad" x1="0%" y1="0%" x2="100%" y2="0%">
                                                        <stop offset="0%" stop-color="#ff7f00" />
                                                        <stop offset="100%" stop-color="#fcd34d" />
                                                    </linearGradient>
                                                </defs>
                                            </svg>
                                            <!-- Center Text -->
                                            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 12px; font-weight: bold; color: #333;">
                                                25%
                                            </div>
                                        </div>

                                        <!-- <img src="" class="rounded-circle" alt="image"> -->
                                        <img src="{{URL::asset('/build/img/yekbon.svg')}}" class="rounded-circle" style="height: 65px;" alt="Project Logo">
                                        <div>

                                        </div>
                                    </div>

                                    <!-- Project Title -->
                                    <!-- Project Title & Project ID -->
                                    <div class="text-center" style="cursor: pointer; margin-left:50px;">
                                        <h6 style="cursor: pointer;" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                                            Project Title
                                        </h6>

                                        <!-- Project ID styled exactly like screenshot -->
                                        <div class="d-inline-block px-3 py-1 mb-2 mt-2"
                                            style="background: #f4f4f4; border-radius: 999px; font-size: 12px; color: #e53935; font-weight: 500;">
                                            Project ID
                                        </div>
                                    </div>

                                    <!-- Section Tags styled exactly like screenshot -->
                                    <div class="d-flex justify-content-center gap-2 mb-3 flex-nowrap">
                                        <div class="px-3 py-1"
                                            style="background: #f4f4f4; border-radius: 999px; font-size: 12px; color: #e53935; font-weight: 500; white-space: nowrap;">
                                            Section #1
                                        </div>
                                        <div class="px-3 py-1"
                                            style="background: #f4f4f4; border-radius: 999px; font-size: 12px; color: #e53935; font-weight: 500; white-space: nowrap;">
                                            Section #1
                                        </div>
                                        <div class="px-3 py-1"
                                            style="background: #f4f4f4; border-radius: 999px; font-size: 12px; color: #e53935; font-weight: 500; white-space: nowrap;">
                                            Section #1
                                        </div>
                                        <div class="px-3 py-1"
                                            style="background: #f4f4f4; border-radius: 999px; font-size: 12px; color: #e53935; font-weight: 500; white-space: nowrap;">
                                            Section #1
                                        </div>
                                    </div>


                                    <!-- Stats Row -->
                                    <div class="row text-center mb-2">
                                        <div class="col">
                                            <strong style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;color:black ;font-size: 15px;">Total Tickets</strong>
                                            <div class="text-dark" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">5</div>
                                        </div>
                                        <div class="col">
                                            <strong style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;color:black ;font-size: 15px;">Total Tasks</strong>
                                            <div class="text-dark" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">10</div>
                                        </div>
                                        <div class="col">
                                            <strong style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;color:black ;font-size: 15px;">Progress</strong>
                                            <div class="text-dark" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">25%</div>
                                        </div>
                                    </div>

                                    <!-- Progress Status -->
                                    <div class="text-center mb-2">
                                        <div style="background: #c9e9d7; color: #1e2b4d; border-radius: 6px; display: inline-flex; align-items: center; padding: 2px 24px; font-weight: 500; font-size: 14px;">
                                            <img src="{{URL::asset('/build/img/flag.svg')}}"
                                                style="height: 16px; width: 16px;" alt="flag" />


                                        </div>
                                    </div>


                                    <!-- Ticket Colors -->
                                    <div class="d-flex justify-content-center">
                                        <!-- Content box with light background and auto width -->
                                        <div class="d-flex align-items-center gap-2 mb-3 px-3" style="background: #f8f8f8; border-radius: 10px; width: fit-content;">
                                            <!-- "Ticket" label -->
                                            <span style="background: #f1f1f1; padding: 4px 8px; border-radius: 6px; font-size: 12px; color: #6c757d;margin-left:-15px;">Ticket</span>

                                            <!-- Blue dot + number -->
                                            <span style="width: 10px; height: 10px; background: #3b82f6; border-radius: 50%; display: inline-block;"></span>
                                            <span style="font-size: 13px; color: #6c757d;">1</span>

                                            <!-- Orange dot + number -->
                                            <span style="width: 10px; height: 10px; background: #f59e0b; border-radius: 50%; display: inline-block;"></span>
                                            <span style="font-size: 13px; color: #6c757d;">3</span>

                                            <!-- Red dot + number -->
                                            <span style="width: 10px; height: 10px; background: #ef4444; border-radius: 50%; display: inline-block;"></span>
                                            <span style="font-size: 13px; color: #6c757d;">0</span>

                                            <!-- Purple dot + number -->
                                            <span style="width: 10px; height: 10px; background: #a855f7; border-radius: 50%; display: inline-block;"></span>
                                            <span style="font-size: 13px; color: #6c757d;">0</span>

                                            <!-- Green dot + number -->
                                            <span style="width: 10px; height: 10px; background: #22c55e; border-radius: 50%; display: inline-block;"></span>
                                            <span style="font-size: 13px; color: #6c757d;">0</span>
                                        </div>
                                    </div>


                                    <!-- Project Manager / Developers -->
                                    <div class="d-flex justify-content-between m-0 w-100"
                                        style="background-color: #f9f9f9; border-radius: 12px; padding: 10px;">

                                        <!-- Project Manager -->
                                        <div class="text-center">
                                            <strong style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #1e60a1; font-size: 15px;">
                                                Project Manager
                                            </strong>
                                            <div class="d-flex justify-content-center mt-1">
                                                <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}"
                                                    style="height: 30px; width: 30px; border: 2px solid #00e0ff; border-radius: 50%;" />
                                            </div>
                                        </div>

                                        <!-- Developers -->
                                        <div class="text-center">
                                            <strong style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #1e60a1; font-size: 15px;">
                                                Developers
                                            </strong>
                                            <div class="d-flex justify-content-center mt-1" style="margin-left: 10px;">
                                                <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}"
                                                    style="height: 30px; width: 30px; border: 2px solid #00e0ff; margin-left: -10px; border-radius: 50%;" />
                                                <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}"
                                                    style="height: 30px; width: 30px; border: 2px solid #00e0ff; margin-left: -10px; border-radius: 50%;" />
                                                <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}"
                                                    style="height: 30px; width: 30px; border: 2px solid #00e0ff; margin-left: -10px; border-radius: 50%;" />
                                            </div>
                                        </div>
                                    </div>



                                    <!-- Date + Work Days + Days Left -->
                                    <!-- Date + Work Days + Days Left + Progress Bar -->
                                    <div class="row mb-2 mt-2 m-0 w-100" style="background-color: #f9f9f9; border-radius: 12px; padding: 15px 10px;">
                                        <!-- Start Date -->
                                        <div class="col-4">
                                            <strong style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #1e60a1; font-size: 15px;">
                                                Start Date
                                            </strong>
                                            <div style="color: #1e60a1; font-weight: 600; font-size: 13px;">DD:MM:YY</div>
                                        </div>

                                        <!-- Work Days -->
                                        <div class="col-4">
                                            <strong style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #1e60a1; font-size: 15px;">
                                                Work Days
                                            </strong>
                                            <div style="color: #1e60a1; font-weight: 600; font-size: 13px;">5 Days</div>
                                        </div>

                                        <!-- Days Left -->
                                        <div class="col-4">
                                            <strong style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #1e60a1; font-size: 15px;">
                                                Days Left
                                            </strong>
                                            <div style="color: #1e60a1; font-weight: 600; font-size: 13px;">5 Days</div>
                                        </div>

                                        <!-- Blue Progress Bar (Full Width Below) -->
                                        <div class="col-12 mt-3">
                                            <div class="progress" style="height: 6px; background-color: #f1f1f1; border-radius: 10px; overflow: hidden;">
                                                <div class="progress-bar"
                                                    role="progressbar"
                                                    style="width: 60%; background-color: #4dc3ff; border-radius: 10px;"
                                                    aria-valuenow="60"
                                                    aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>







                                    <!-- Section Progress Block -->
                                    <div style="background-color: #f9f9f9; border-radius: 12px; padding: 15px 10px;">

                                        <!-- Section Titles -->
                                        <div class="d-flex justify-content-between px-1"
                                            style="font-size: 13px; color: #2e3a59; font-weight: 600; font-family: 'Segoe UI', sans-serif;">
                                            <span>Section #1 75%</span>
                                            <span>Section #1 75%</span>
                                            <span>Section #1 75%</span>
                                        </div>

                                        <!-- Progress Bars -->
                                        <div class="d-flex justify-content-between align-items-center mt-2 gap-2 px-1">
                                            <!-- Green Progress -->
                                            <div class="progress"
                                                style="width: 32%; height: 8px; background-color: #d3f4dc; border-radius: 10px;">
                                                <div class="progress-bar"
                                                    style="width: 75%; background-color: #28c76f; border-radius: 10px;"></div>
                                            </div>

                                            <!-- Yellow Progress -->
                                            <div class="progress"
                                                style="width: 32%; height: 8px; background-color: #fef3d3; border-radius: 10px;">
                                                <div class="progress-bar"
                                                    style="width: 75%; background-color: #ffc107; border-radius: 10px;"></div>
                                            </div>

                                            <!-- Red Progress -->
                                            <div class="progress"
                                                style="width: 32%; height: 8px; background-color: #fdd7d7; border-radius: 10px;">
                                                <div class="progress-bar"
                                                    style="width: 75%; background-color: #ea5455; border-radius: 10px;"></div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <!-- 3rd -->
                            <div class="col-md-6 col-lg-4 col-xl-4">
                                <div class="card shadow-sm  p-3" style="border-radius: 20px; font-family:    'Segoe UI', sans-serif;">
                                    <!-- Top Row: Circle, Center Image, 3 Dots -->
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div style="width: 60px; height: 60px; position: relative;">
                                            <svg width="60" height="60">
                                                <circle cx="30" cy="30" r="26" stroke="#d1d1d1" stroke-width="6" fill="none" />
                                                <circle
                                                    cx="30"
                                                    cy="30"
                                                    r="26"
                                                    stroke="url(#grad)"
                                                    stroke-width="6"
                                                    fill="none"
                                                    stroke-dasharray="163.36"
                                                    stroke-dashoffset="122.52"
                                                    stroke-linecap="round"
                                                    transform="rotate(-90 30 30)" />
                                                <defs>
                                                    <linearGradient id="grad" x1="0%" y1="0%" x2="100%" y2="0%">
                                                        <stop offset="0%" stop-color="#ff7f00" />
                                                        <stop offset="100%" stop-color="#fcd34d" />
                                                    </linearGradient>
                                                </defs>
                                            </svg>
                                            <!-- Center Text -->
                                            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 12px; font-weight: bold; color: #333;">
                                                25%
                                            </div>
                                        </div>

                                        <!-- <img src="" class="rounded-circle" alt="image"> -->
                                        <img src="{{URL::asset('/build/img/yekbon.svg')}}" class="rounded-circle" style="height: 65px;" alt="Project Logo">
                                        <div>

                                        </div>
                                    </div>

                                    <!-- Project Title -->
                                    <!-- Project Title & Project ID -->
                                    <div class="text-center" style="cursor: pointer; margin-left:50px;">
                                        <h6 style="cursor: pointer;" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                                            Project Title
                                        </h6>

                                        <!-- Project ID styled exactly like screenshot -->
                                        <div class="d-inline-block px-3 py-1 mb-2 mt-2"
                                            style="background: #f4f4f4; border-radius: 999px; font-size: 12px; color: #e53935; font-weight: 500;">
                                            Project ID
                                        </div>
                                    </div>

                                    <!-- Section Tags styled exactly like screenshot -->
                                    <div class="d-flex justify-content-center gap-2 mb-3 flex-nowrap">
                                        <div class="px-3 py-1"
                                            style="background: #f4f4f4; border-radius: 999px; font-size: 12px; color: #e53935; font-weight: 500; white-space: nowrap;">
                                            Section #1
                                        </div>
                                        <div class="px-3 py-1"
                                            style="background: #f4f4f4; border-radius: 999px; font-size: 12px; color: #e53935; font-weight: 500; white-space: nowrap;">
                                            Section #1
                                        </div>
                                        <div class="px-3 py-1"
                                            style="background: #f4f4f4; border-radius: 999px; font-size: 12px; color: #e53935; font-weight: 500; white-space: nowrap;">
                                            Section #1
                                        </div>
                                        <div class="px-3 py-1"
                                            style="background: #f4f4f4; border-radius: 999px; font-size: 12px; color: #e53935; font-weight: 500; white-space: nowrap;">
                                            Section #1
                                        </div>
                                    </div>


                                    <!-- Stats Row -->
                                    <div class="row text-center mb-2">
                                        <div class="col">
                                            <strong style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;color:black ;font-size: 15px;">Total Tickets</strong>
                                            <div class="text-dark" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">5</div>
                                        </div>
                                        <div class="col">
                                            <strong style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;color:black ;font-size: 15px;">Total Tasks</strong>
                                            <div class="text-dark" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">10</div>
                                        </div>
                                        <div class="col">
                                            <strong style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;color:black ;font-size: 15px;">Progress</strong>
                                            <div class="text-dark" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">25%</div>
                                        </div>
                                    </div>

                                    <!-- Progress Status -->
                                    <div class="text-center mb-2">
                                        <div style="background: #c9e9d7; color: #1e2b4d; border-radius: 6px; display: inline-flex; align-items: center; padding: 2px 24px; font-weight: 500; font-size: 14px;">
                                            <img src="{{URL::asset('/build/img/flag.svg')}}"
                                                style="height: 16px; width: 16px;" alt="flag" />


                                        </div>
                                    </div>


                                    <!-- Ticket Colors -->
                                    <div class="d-flex justify-content-center">
                                        <!-- Content box with light background and auto width -->
                                        <div class="d-flex align-items-center gap-2 mb-3 px-3" style="background: #f8f8f8; border-radius: 10px; width: fit-content;">
                                            <!-- "Ticket" label -->
                                            <span style="background: #f1f1f1; padding: 4px 8px; border-radius: 6px; font-size: 12px; color: #6c757d;margin-left:-15px;">Ticket</span>

                                            <!-- Blue dot + number -->
                                            <span style="width: 10px; height: 10px; background: #3b82f6; border-radius: 50%; display: inline-block;"></span>
                                            <span style="font-size: 13px; color: #6c757d;">1</span>

                                            <!-- Orange dot + number -->
                                            <span style="width: 10px; height: 10px; background: #f59e0b; border-radius: 50%; display: inline-block;"></span>
                                            <span style="font-size: 13px; color: #6c757d;">3</span>

                                            <!-- Red dot + number -->
                                            <span style="width: 10px; height: 10px; background: #ef4444; border-radius: 50%; display: inline-block;"></span>
                                            <span style="font-size: 13px; color: #6c757d;">0</span>

                                            <!-- Purple dot + number -->
                                            <span style="width: 10px; height: 10px; background: #a855f7; border-radius: 50%; display: inline-block;"></span>
                                            <span style="font-size: 13px; color: #6c757d;">0</span>

                                            <!-- Green dot + number -->
                                            <span style="width: 10px; height: 10px; background: #22c55e; border-radius: 50%; display: inline-block;"></span>
                                            <span style="font-size: 13px; color: #6c757d;">0</span>
                                        </div>
                                    </div>


                                    <!-- Project Manager / Developers -->
                                    <div class="d-flex justify-content-between m-0 w-100"
                                        style="background-color: #f9f9f9; border-radius: 12px; padding: 10px;">

                                        <!-- Project Manager -->
                                        <div class="text-center">
                                            <strong style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #1e60a1; font-size: 15px;">
                                                Project Manager
                                            </strong>
                                            <div class="d-flex justify-content-center mt-1">
                                                <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}"
                                                    style="height: 30px; width: 30px; border: 2px solid #00e0ff; border-radius: 50%;" />
                                            </div>
                                        </div>

                                        <!-- Developers -->
                                        <div class="text-center">
                                            <strong style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #1e60a1; font-size: 15px;">
                                                Developers
                                            </strong>
                                            <div class="d-flex justify-content-center mt-1" style="margin-left: 10px;">
                                                <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}"
                                                    style="height: 30px; width: 30px; border: 2px solid #00e0ff; margin-left: -10px; border-radius: 50%;" />
                                                <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}"
                                                    style="height: 30px; width: 30px; border: 2px solid #00e0ff; margin-left: -10px; border-radius: 50%;" />
                                                <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}"
                                                    style="height: 30px; width: 30px; border: 2px solid #00e0ff; margin-left: -10px; border-radius: 50%;" />
                                            </div>
                                        </div>
                                    </div>



                                    <!-- Date + Work Days + Days Left -->
                                    <!-- Date + Work Days + Days Left + Progress Bar -->
                                    <div class="row mb-2 mt-2 m-0 w-100" style="background-color: #f9f9f9; border-radius: 12px; padding: 15px 10px;">
                                        <!-- Start Date -->
                                        <div class="col-4">
                                            <strong style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #1e60a1; font-size: 15px;">
                                                Start Date
                                            </strong>
                                            <div style="color: #1e60a1; font-weight: 600; font-size: 13px;">DD:MM:YY</div>
                                        </div>

                                        <!-- Work Days -->
                                        <div class="col-4">
                                            <strong style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #1e60a1; font-size: 15px;">
                                                Work Days
                                            </strong>
                                            <div style="color: #1e60a1; font-weight: 600; font-size: 13px;">5 Days</div>
                                        </div>

                                        <!-- Days Left -->
                                        <div class="col-4">
                                            <strong style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #1e60a1; font-size: 15px;">
                                                Days Left
                                            </strong>
                                            <div style="color: #1e60a1; font-weight: 600; font-size: 13px;">5 Days</div>
                                        </div>

                                        <!-- Blue Progress Bar (Full Width Below) -->
                                        <div class="col-12 mt-3">
                                            <div class="progress" style="height: 6px; background-color: #f1f1f1; border-radius: 10px; overflow: hidden;">
                                                <div class="progress-bar"
                                                    role="progressbar"
                                                    style="width: 60%; background-color: #4dc3ff; border-radius: 10px;"
                                                    aria-valuenow="60"
                                                    aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>







                                    <!-- Section Progress Block -->
                                    <div style="background-color: #f9f9f9; border-radius: 12px; padding: 15px 10px;">

                                        <!-- Section Titles -->
                                        <div class="d-flex justify-content-between px-1"
                                            style="font-size: 13px; color: #2e3a59; font-weight: 600; font-family: 'Segoe UI', sans-serif;">
                                            <span>Section #1 75%</span>
                                            <span>Section #1 75%</span>
                                            <span>Section #1 75%</span>
                                        </div>

                                        <!-- Progress Bars -->
                                        <div class="d-flex justify-content-between align-items-center mt-2 gap-2 px-1">
                                            <!-- Green Progress -->
                                            <div class="progress"
                                                style="width: 32%; height: 8px; background-color: #d3f4dc; border-radius: 10px;">
                                                <div class="progress-bar"
                                                    style="width: 75%; background-color: #28c76f; border-radius: 10px;"></div>
                                            </div>

                                            <!-- Yellow Progress -->
                                            <div class="progress"
                                                style="width: 32%; height: 8px; background-color: #fef3d3; border-radius: 10px;">
                                                <div class="progress-bar"
                                                    style="width: 75%; background-color: #ffc107; border-radius: 10px;"></div>
                                            </div>

                                            <!-- Red Progress -->
                                            <div class="progress"
                                                style="width: 32%; height: 8px; background-color: #fdd7d7; border-radius: 10px;">
                                                <div class="progress-bar"
                                                    style="width: 75%; background-color: #ea5455; border-radius: 10px;"></div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <!-- 4 -->
                            <div class="col-md-6 col-lg-4 col-xl-4">
                                <div class="card shadow-sm  p-3" style="border-radius: 20px; font-family:    'Segoe UI', sans-serif;">
                                    <!-- Top Row: Circle, Center Image, 3 Dots -->
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div style="width: 60px; height: 60px; position: relative;">
                                            <svg width="60" height="60">
                                                <circle cx="30" cy="30" r="26" stroke="#d1d1d1" stroke-width="6" fill="none" />
                                                <circle
                                                    cx="30"
                                                    cy="30"
                                                    r="26"
                                                    stroke="url(#grad)"
                                                    stroke-width="6"
                                                    fill="none"
                                                    stroke-dasharray="163.36"
                                                    stroke-dashoffset="122.52"
                                                    stroke-linecap="round"
                                                    transform="rotate(-90 30 30)" />
                                                <defs>
                                                    <linearGradient id="grad" x1="0%" y1="0%" x2="100%" y2="0%">
                                                        <stop offset="0%" stop-color="#ff7f00" />
                                                        <stop offset="100%" stop-color="#fcd34d" />
                                                    </linearGradient>
                                                </defs>
                                            </svg>
                                            <!-- Center Text -->
                                            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 12px; font-weight: bold; color: #333;">
                                                25%
                                            </div>
                                        </div>

                                        <!-- <img src="" class="rounded-circle" alt="image"> -->
                                        <img src="{{URL::asset('/build/img/yekbon.svg')}}" class="rounded-circle" style="height: 65px;" alt="Project Logo">
                                        <div>

                                        </div>
                                    </div>

                                    <!-- Project Title -->
                                    <!-- Project Title & Project ID -->
                                    <div class="text-center" style="cursor: pointer; margin-left:50px;">
                                        <h6 style="cursor: pointer;" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                                            Project Title
                                        </h6>

                                        <!-- Project ID styled exactly like screenshot -->
                                        <div class="d-inline-block px-3 py-1 mb-2 mt-2"
                                            style="background: #f4f4f4; border-radius: 999px; font-size: 12px; color: #e53935; font-weight: 500;">
                                            Project ID
                                        </div>
                                    </div>

                                    <!-- Section Tags styled exactly like screenshot -->
                                    <div class="d-flex justify-content-center gap-2 mb-3 flex-nowrap">
                                        <div class="px-3 py-1"
                                            style="background: #f4f4f4; border-radius: 999px; font-size: 12px; color: #e53935; font-weight: 500; white-space: nowrap;">
                                            Section #1
                                        </div>
                                        <div class="px-3 py-1"
                                            style="background: #f4f4f4; border-radius: 999px; font-size: 12px; color: #e53935; font-weight: 500; white-space: nowrap;">
                                            Section #1
                                        </div>
                                        <div class="px-3 py-1"
                                            style="background: #f4f4f4; border-radius: 999px; font-size: 12px; color: #e53935; font-weight: 500; white-space: nowrap;">
                                            Section #1
                                        </div>
                                        <div class="px-3 py-1"
                                            style="background: #f4f4f4; border-radius: 999px; font-size: 12px; color: #e53935; font-weight: 500; white-space: nowrap;">
                                            Section #1
                                        </div>
                                    </div>


                                    <!-- Stats Row -->
                                    <div class="row text-center mb-2">
                                        <div class="col">
                                            <strong style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;color:black ;font-size: 15px;">Total Tickets</strong>
                                            <div class="text-dark" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">5</div>
                                        </div>
                                        <div class="col">
                                            <strong style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;color:black ;font-size: 15px;">Total Tasks</strong>
                                            <div class="text-dark" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">10</div>
                                        </div>
                                        <div class="col">
                                            <strong style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;color:black ;font-size: 15px;">Progress</strong>
                                            <div class="text-dark" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">25%</div>
                                        </div>
                                    </div>

                                    <!-- Progress Status -->
                                    <div class="text-center mb-2">
                                        <div style="background: #c9e9d7; color: #1e2b4d; border-radius: 6px; display: inline-flex; align-items: center; padding: 2px 24px; font-weight: 500; font-size: 14px;">
                                            <img src="{{URL::asset('/build/img/flag.svg')}}"
                                                style="height: 16px; width: 16px;" alt="flag" />


                                        </div>
                                    </div>


                                    <!-- Ticket Colors -->
                                    <div class="d-flex justify-content-center">
                                        <!-- Content box with light background and auto width -->
                                        <div class="d-flex align-items-center gap-2 mb-3 px-3" style="background: #f8f8f8; border-radius: 10px; width: fit-content;">
                                            <!-- "Ticket" label -->
                                            <span style="background: #f1f1f1; padding: 4px 8px; border-radius: 6px; font-size: 12px; color: #6c757d;margin-left:-15px;">Ticket</span>

                                            <!-- Blue dot + number -->
                                            <span style="width: 10px; height: 10px; background: #3b82f6; border-radius: 50%; display: inline-block;"></span>
                                            <span style="font-size: 13px; color: #6c757d;">1</span>

                                            <!-- Orange dot + number -->
                                            <span style="width: 10px; height: 10px; background: #f59e0b; border-radius: 50%; display: inline-block;"></span>
                                            <span style="font-size: 13px; color: #6c757d;">3</span>

                                            <!-- Red dot + number -->
                                            <span style="width: 10px; height: 10px; background: #ef4444; border-radius: 50%; display: inline-block;"></span>
                                            <span style="font-size: 13px; color: #6c757d;">0</span>

                                            <!-- Purple dot + number -->
                                            <span style="width: 10px; height: 10px; background: #a855f7; border-radius: 50%; display: inline-block;"></span>
                                            <span style="font-size: 13px; color: #6c757d;">0</span>

                                            <!-- Green dot + number -->
                                            <span style="width: 10px; height: 10px; background: #22c55e; border-radius: 50%; display: inline-block;"></span>
                                            <span style="font-size: 13px; color: #6c757d;">0</span>
                                        </div>
                                    </div>


                                    <!-- Project Manager / Developers -->
                                    <div class="d-flex justify-content-between m-0 w-100"
                                        style="background-color: #f9f9f9; border-radius: 12px; padding: 10px;">

                                        <!-- Project Manager -->
                                        <div class="text-center">
                                            <strong style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #1e60a1; font-size: 15px;">
                                                Project Manager
                                            </strong>
                                            <div class="d-flex justify-content-center mt-1">
                                                <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}"
                                                    style="height: 30px; width: 30px; border: 2px solid #00e0ff; border-radius: 50%;" />
                                            </div>
                                        </div>

                                        <!-- Developers -->
                                        <div class="text-center">
                                            <strong style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #1e60a1; font-size: 15px;">
                                                Developers
                                            </strong>
                                            <div class="d-flex justify-content-center mt-1" style="margin-left: 10px;">
                                                <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}"
                                                    style="height: 30px; width: 30px; border: 2px solid #00e0ff; margin-left: -10px; border-radius: 50%;" />
                                                <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}"
                                                    style="height: 30px; width: 30px; border: 2px solid #00e0ff; margin-left: -10px; border-radius: 50%;" />
                                                <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}"
                                                    style="height: 30px; width: 30px; border: 2px solid #00e0ff; margin-left: -10px; border-radius: 50%;" />
                                            </div>
                                        </div>
                                    </div>




                                    <!-- Date + Work Days + Days Left + Progress Bar -->
                                    <div class="row mb-2 mt-2 m-0 w-100" style="background-color: #f9f9f9; border-radius: 12px; padding: 15px 10px;">
                                        <!-- Start Date -->
                                        <div class="col-4">
                                            <strong style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #1e60a1; font-size: 15px;">
                                                Start Date
                                            </strong>
                                            <div style="color: #1e60a1; font-weight: 600; font-size: 13px;">DD:MM:YY</div>
                                        </div>

                                        <!-- Work Days -->
                                        <div class="col-4">
                                            <strong style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #1e60a1; font-size: 15px;">
                                                Work Days
                                            </strong>
                                            <div style="color: #1e60a1; font-weight: 600; font-size: 13px;">5 Days</div>
                                        </div>

                                        <!-- Days Left -->
                                        <div class="col-4">
                                            <strong style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #1e60a1; font-size: 15px;">
                                                Days Left
                                            </strong>
                                            <div style="color: #1e60a1; font-weight: 600; font-size: 13px;">5 Days</div>
                                        </div>

                                        <!-- Blue Progress Bar (Full Width Below) -->
                                        <div class="col-12 mt-3">
                                            <div class="progress" style="height: 6px; background-color: #f1f1f1; border-radius: 10px; overflow: hidden;">
                                                <div class="progress-bar"
                                                    role="progressbar"
                                                    style="width: 60%; background-color: #4dc3ff; border-radius: 10px;"
                                                    aria-valuenow="60"
                                                    aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>







                                    <!-- Section Progress Block -->
                                    <div style="background-color: #f9f9f9; border-radius: 12px; padding: 15px 10px;">

                                        <!-- Section Titles -->
                                        <div class="d-flex justify-content-between px-1"
                                            style="font-size: 13px; color: #2e3a59; font-weight: 600; font-family: 'Segoe UI', sans-serif;">
                                            <span>Section #1 75%</span>
                                            <span>Section #1 75%</span>
                                            <span>Section #1 75%</span>
                                        </div>

                                        <!-- Progress Bars -->
                                        <div class="d-flex justify-content-between align-items-center mt-2 gap-2 px-1">
                                            <!-- Green Progress -->
                                            <div class="progress"
                                                style="width: 32%; height: 8px; background-color: #d3f4dc; border-radius: 10px;">
                                                <div class="progress-bar"
                                                    style="width: 75%; background-color: #28c76f; border-radius: 10px;"></div>
                                            </div>

                                            <!-- Yellow Progress -->
                                            <div class="progress"
                                                style="width: 32%; height: 8px; background-color: #fef3d3; border-radius: 10px;">
                                                <div class="progress-bar"
                                                    style="width: 75%; background-color: #ffc107; border-radius: 10px;"></div>
                                            </div>

                                            <!-- Red Progress -->
                                            <div class="progress"
                                                style="width: 32%; height: 8px; background-color: #fdd7d7; border-radius: 10px;">
                                                <div class="progress-bar"
                                                    style="width: 75%; background-color: #ea5455; border-radius: 10px;"></div>
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
    <!-- right sidebar popup -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" data-bs-backdrop="true" aria-labelledby="offcanvasRightLabel" style="overflow-y: auto; width: 770px;">

        <!-- Header -->
        <div class="offcanvas-header" style="padding: 0;">
            <!-- Gradient Header Background -->
            <div style="background: linear-gradient(90deg, #fd8f39, #f65b0f); width: 100%; padding: 30px 20px 60px; position: relative; text-align: center;">

                <!-- Close Button -->
                <button type="button"
                    data-bs-dismiss="offcanvas"
                    aria-label="Close"
                    style="position: absolute;top: 10px;right: 10px;background-color: white;color: black; border: none;border-radius: 50%;width: 36px;height: 36px;font-size: 24px;font-weight: bold;z-index: 9999;display: flex;align-items: center;justify-content: center;box-shadow: 0 0 6px rgba(0, 0, 0, 0.2)">
                    &times;
                </button>

                <!-- Profile Logo -->
                <img src="{{URL::asset('/build/img/yekbon.svg')}}"
                    class="rounded-circle"
                    alt="Profile"
                    style="width: 80px; height: 80px; border: 3px solid #fff; position: absolute; left: 50%; transform: translateX(-50%) translateY(19%); background: #fff; object-fit: cover; z-index: 10;">
            </div>
        </div>

        <!-- Body -->
        <div class="offcanvas-body pt-5" style="font-family: 'Segoe UI', sans-serif; background-color: #fff;">

            <!-- Project Title & ID -->
            <div class="d-flex  align-items-center">
                <div style="width: 35px; height: 35px; position: relative;">
                    <!-- Background Circle -->
                    <svg width="35" height="35">
                        <circle cx="17.5" cy="17.5" r="15" stroke="#d1d1d1" stroke-width="4" fill="none" />
                        <circle
                            cx="17.5"
                            cy="17.5"
                            r="15"
                            stroke="url(#grad)"
                            stroke-width="4"
                            fill="none"
                            stroke-dasharray="94.2"
                            stroke-dashoffset="70.65"
                            stroke-linecap="round"
                            transform="rotate(-90 17.5 17.5)" />
                        <defs>
                            <linearGradient id="grad" x1="0%" y1="0%" x2="100%" y2="0%">
                                <stop offset="0%" stop-color="#ff7f00" />
                                <stop offset="100%" stop-color="#fcd34d" />
                            </linearGradient>
                        </defs>
                    </svg>

                    <!-- Center Text -->
                    <div style=" position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 10px;font-weight: bold;color: #333;">
                        25%
                    </div>
                </div>


            </div>
            <div class="text-center mb-3" style="margin-top:-34px;margin-left:14px;">
                <h5 style="font-weight: 600; color: #2e3a59;">Project Title</h5>

                <div style="display: inline-block;background:#f5f5f5;color: #e53935; font-size: 12px;
                font-weight: 600;padding: 4px 14px;border-radius: 999px;margin-top: 5px">
                    Project ID
                </div>
            </div>

            <!-- Wrapper to center the content -->
            <div class="d-flex justify-content-center mb-3">
                <!-- Compact Date & Priority Display -->
                <div class="d-flex align-items-center flex-wrap"
                    style="background: #f5f5f5; padding: 6px 12px; border-radius: 999px; font-family: 'Poppins', sans-serif; font-size: 12px; font-weight: 500; color: #2e3a59;">

                    <!-- Start and Deliver Dates -->
                    <div class="d-flex align-items-center gap-3">
                        <div style="color: #34d399;">
                            Start: <span style="color: #2e3a59;">22.10.2024</span>
                        </div>
                        <div style="color: #34d399;">
                            Deliver: <span style="color: #2e3a59;">22.10.2024</span>
                        </div>
                    </div>

                    <!-- Divider -->
                    <div style="width: 1px; height: 18px; background-color: #d1d5db; margin: 0 10px;"></div>

                    <!-- Priority -->
                    <div style="background: #ffffff; border-radius: 999px; padding: 2px 10px; display: flex; align-items: center; gap: 6px;">
                        <span style="width: 8px; height: 8px; background-color: #34d399; border-radius: 50%; display: inline-block;"></span>
                        <span style="color: #6b7280;">Low</span>
                    </div>
                </div>
            </div>

            <!-- Status Tag -->
            <div class="text-center mb-3">
                <div style="background: #fff7da; /* soft yellow */color: #2e3a59;       /* dark slate for text */border-radius: 999px;display: inline-flex;align-items: center;padding: 4px 18px;font-weight: 600;font-size: 13px">
                    <img src="{{URL::asset('/build/img/yelowflag.svg')}}" style="height: 14px; width: 14px; margin-right: 8px;" alt="flag" />
                    Project is in Hold
                </div>
            </div>


            <!-- Project Progress Card -->
            <div class="card p-3 shadow-sm mb-3" style="border-radius: 12px; background-color: #f9f9f9; font-family: 'Segoe UI', sans-serif;">
                <!-- Title -->
                <h6 class="mb-3" style="font-weight: 600; color: #2e3a59;">Project Progress :</h6>

                <!-- Flex Row -->
                <div class="d-flex flex-wrap justify-content-between gap-3">
                    <!-- Left Half -->
                    <div class="flex-grow-1  mt-1" style="min-width: 300px; max-width: 48%;border-radius:10px;background-color:white">
                        <!-- Stats -->
                        <div class="d-flex justify-content-between text-center mb-2">
                            <div style="flex: 1;">
                                <div style="font-weight: 600; font-size: 13px; color: #2e3a59;">Tickets</div>
                                <div style="font-size: 12px; color: #6c757d;">#1 of #05</div>
                            </div>
                            <div style="flex: 1;">
                                <div style="font-weight: 600; font-size: 13px; color: #2e3a59;">Total Tasks</div>
                                <div style="font-size: 12px; color: #6c757d;">#05</div>
                            </div>
                            <div style="flex: 1;">
                                <div style="font-weight: 600; font-size: 13px; color: #2e3a59;">Days Left</div>
                                <div style="font-size: 12px; color: #6c757d;">#05</div>
                            </div>
                            <div style="flex: 1;">
                                <div style="font-weight: 600; font-size: 13px; color: #2e3a59;">Status</div>
                                <div style="font-size: 12px; color: #6c757d;">75%</div>
                            </div>
                        </div>

                        <!-- Blue Progress Bar -->
                        <div class="progress" style="height: 8px; background-color: #e9ecef; border-radius: 10px;margin-left:10px;margin-right:10px;">
                            <div class="progress-bar" style="width: 75%; background-color: #4dc3ff; border-radius: 10px;"></div>
                        </div>
                    </div>

                    <!-- Right Half -->
                    <div class="flex-grow-1 mb-1 " style="min-width: 300px; max-width: 48%;background-color:white;border-radius:10px;">
                        <!-- Section Labels -->
                        <div class="d-flex justify-content-between mb-2" style="font-size: 13px; font-weight: 600; color: #2e3a59;" style="margin-left:10px;margin-right:10px;">
                            <span style="margin-left:10px;margin-right:10px;">Section#1 75%</span>
                            <span style="margin-left:10px;margin-right:10px;">Section#1 75%</span>
                            <span style="margin-left:10px;margin-right:10px;">Section#1 75%</span>
                            <span style="margin-left:10px;margin-right:10px;">Section#1 75%</span>
                        </div>

                        <!-- Section Progress Bars -->
                        <div class="d-flex justify-content-between align-items-center gap-2" style="margin-left:10px;margin-right:10px;margin-bottom:10px;">
                            <div class="progress" style="width: 24%; height: 10px; background-color: #d3f4dc; border-radius: 10px;">
                                <div class="progress-bar" style="width: 75%; background-color: #28c76f; border-radius: 10px;"></div>
                            </div>
                            <div class="progress" style="width: 24%; height: 10px; background-color: #fef3d3; border-radius: 10px;">
                                <div class="progress-bar" style="width: 75%; background-color: #ffc107; border-radius: 10px;"></div>
                            </div>
                            <div class="progress" style="width: 24%; height: 10px; background-color: #fdd7d7; border-radius: 10px;">
                                <div class="progress-bar" style="width: 75%; background-color: #ea5455; border-radius: 10px;"></div>
                            </div>
                            <div class="progress" style="width: 24%; height: 10px; background-color: #fdd7d7; border-radius: 10px;">
                                <div class="progress-bar" style="width: 75%; background-color: #ea5455; border-radius: 10px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Project Description Card -->
            <!-- Project Description Section -->
            <div class="card p-3 mb-4" style="border-radius: 12px; background-color: #f9f9f9; font-family: 'Segoe UI', sans-serif;">
                <h6 class="mb-2" style="font-weight: 600; color: #2e3a59;">Project Description :</h6>
                <p style="font-size: 13px; color: #4b5563; line-height: 1.7; margin-bottom: 0;">
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore
                    et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
                    Stet clita kasd gubergren, no sea takimata sanctus est lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet,
                    consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,
                    sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren,
                    no sea takimata sanctus est lorem ipsum dolor sit amet.
                </p>
            </div>


            <!-- Project Sections Card -->
            <div class="card p-3 mb-4" style="border-radius: 12px; background-color: #f8f9fa;">

                <!-- Title -->
                <h6 class="mb-3" style="font-weight: 600; color: #2e3a59;">· Project Sections ·</h6>

                <!-- Section Cards -->
                <div class="d-flex  gap-2">

                    <!-- Single Section Card -->
                    <div style="background: white; padding: 16px; border-radius: 12px; width: 160px; text-align: center; position: relative; box-shadow: 0 2px 5px rgba(0,0,0,0.03);">

                        <!-- Options Icon -->
                        <div class="rounded-circle" style="position: absolute; top: 10px; right: 10px; cursor: pointer;border:1px ;border-radius:10px; background:#f8f9fa;">
                            <svg width="16" height="16" fill="#ccc" viewBox="0 0 24 24">
                                <circle cx="5" cy="12" r="2" />
                                <circle cx="12" cy="12" r="2" />
                                <circle cx="19" cy="12" r="2" />
                            </svg>
                        </div>

                        <!-- Image -->
                        <img src="{{URL::asset('/build/img/project.svg')}}" style="height: 40px; margin-bottom: 10px;" alt="icon">

                        <!-- Title -->
                        <div style="font-size: 14px; font-weight: 600; color: #2e3a59; margin-bottom: 10px;">Admin Dashboard</div>

                        <!-- Tech Tags -->
                        <div class="d-flex flex-wrap justify-content-center gap-1">
                            <span style="background: #f8f9fa; color: #d63333; font-size: 11px; padding: 2px 8px; border-radius: 6px;">Laravel</span>
                            <span style="background: #f8f9fa; color: #d63333; font-size: 11px; padding: 2px 8px; border-radius: 6px;">Bootstrap</span>
                            <span style="background: #f8f9fa; color: #d63333; font-size: 11px; padding: 2px 8px; border-radius: 6px;">MongoDB</span>
                            <span style="background: #f8f9fa; color: #d63333; font-size: 11px; padding: 2px 8px; border-radius: 6px;">RestFul API</span>
                        </div>
                    </div>
                    <!-- 2nd -->
                    <div style="background: white; padding: 16px; border-radius: 12px; width: 160px; text-align: center; position: relative; box-shadow: 0 2px 5px rgba(0,0,0,0.03);">

                        <!-- Options Icon -->
                        <div style="position: absolute; top: 10px; right: 10px; cursor: pointer;">
                            <svg width="16" height="16" fill="#ccc" viewBox="0 0 24 24">
                                <circle cx="5" cy="12" r="2" />
                                <circle cx="12" cy="12" r="2" />
                                <circle cx="19" cy="12" r="2" />
                            </svg>
                        </div>

                        <!-- Image -->
                        <img src="{{URL::asset('/build/img/project.svg')}}" style="height: 40px; margin-bottom: 10px;" alt="icon">

                        <!-- Title -->
                        <div style="font-size: 14px; font-weight: 600; color: #2e3a59; margin-bottom: 10px;">Admin Dashboard</div>

                        <!-- Tech Tags -->
                        <div class="d-flex flex-wrap justify-content-center gap-1">
                            <span style="background: #f8f9fa; color: #d63333; font-size: 11px; padding: 2px 8px; border-radius: 6px;">Laravel</span>
                            <span style="background: #f8f9fa; color: #d63333; font-size: 11px; padding: 2px 8px; border-radius: 6px;">Bootstrap</span>
                            <span style="background: #f8f9fa; color: #d63333; font-size: 11px; padding: 2px 8px; border-radius: 6px;">MongoDB</span>
                            <span style="background: #f8f9fa; color: #d63333; font-size: 11px; padding: 2px 8px; border-radius: 6px;">RestFul API</span>
                        </div>
                    </div>
                    <!-- 3rd -->
                    <div style="background: white; padding: 16px; border-radius: 12px; width: 160px; text-align: center; position: relative; box-shadow: 0 2px 5px rgba(0,0,0,0.03);">

                        <!-- Options Icon -->
                        <div style="position: absolute; top: 10px; right: 10px; cursor: pointer;">
                            <svg width="16" height="16" fill="#ccc" viewBox="0 0 24 24">
                                <circle cx="5" cy="12" r="2" />
                                <circle cx="12" cy="12" r="2" />
                                <circle cx="19" cy="12" r="2" />
                            </svg>
                        </div>

                        <!-- Image -->
                        <img src="{{URL::asset('/build/img/project.svg')}}" style="height: 40px; margin-bottom: 10px;" alt="icon">

                        <!-- Title -->
                        <div style="font-size: 14px; font-weight: 600; color: #2e3a59; margin-bottom: 10px;">Admin Dashboard</div>

                        <!-- Tech Tags -->
                        <div class="d-flex flex-wrap justify-content-center gap-1">
                            <span style="background: #f8f9fa; color: #d63333; font-size: 11px; padding: 2px 8px; border-radius: 6px;">Laravel</span>
                            <span style="background: #f8f9fa; color: #d63333; font-size: 11px; padding: 2px 8px; border-radius: 6px;">Bootstrap</span>
                            <span style="background: #f8f9fa; color: #d63333; font-size: 11px; padding: 2px 8px; border-radius: 6px;">MongoDB</span>
                            <span style="background: #f8f9fa; color: #d63333; font-size: 11px; padding: 2px 8px; border-radius: 6px;">RestFul API</span>
                        </div>
                    </div>


                    <div style="background: white; padding: 16px; border-radius: 12px; width: 160px; text-align: center; position: relative; box-shadow: 0 2px 5px rgba(0,0,0,0.03);">
                        <div style="position: absolute; top: 10px; right: 10px; cursor: pointer;">
                            <svg width="16" height="16" fill="#ccc" viewBox="0 0 24 24">
                                <circle cx="5" cy="12" r="2" />
                                <circle cx="12" cy="12" r="2" />
                                <circle cx="19" cy="12" r="2" />
                            </svg>
                        </div>
                        <img src="{{URL::asset('/build/img/project.svg')}}" style="height: 40px; margin-bottom: 10px;" alt="icon">
                        <div style="font-size: 14px; font-weight: 600; color: #2e3a59; margin-bottom: 10px;">Admin Dashboard</div>
                        <div class="d-flex flex-wrap justify-content-center gap-1">
                            <span style="background: #f8f9fa; color: #d63333; font-size: 11px; padding: 2px 8px; border-radius: 6px;">Laravel</span>
                            <span style="background: #f8f9fa; color: #d63333; font-size: 11px; padding: 2px 8px; border-radius: 6px;">Bootstrap</span>
                            <span style="background: #f8f9fa; color: #d63333; font-size: 11px; padding: 2px 8px; border-radius: 6px;">MongoDB</span>
                            <span style="background: #f8f9fa; color: #d63333; font-size: 11px; padding: 2px 8px; border-radius: 6px;">RestFul API</span>
                        </div>
                    </div>

                    <!-- Add more blocks as needed... -->

                </div>
            </div>


            <!-- Our team Card -->
            <div style="font-family: 'Segoe UI', sans-serif; background-color: #f8f9fa; padding-left: 20px;padding-right: 20px; border-radius: 12px;">

                <!-- Section Title -->
                <h6 class="mb-3" style="font-weight: 600; color: #2e3a59; font-size: 16px;padding-top: 16px;">· Our Team ·</h6>

                <!-- Card Row -->
                <div class="d-flex gap-3 flex-nowrap overflow-auto">

                    <!-- CARD 1 -->
                    <div class="card text-center" style="width: 180px; border-radius: 18px; border: none; overflow: hidden; background: #ffffff; box-shadow: 0 2px 6px rgba(0,0,0,0.05);">
                        <div style="position: relative; background-image: url('{{ URL::asset('/build/img/bgractangle.svg') }}'); background-size: cover; background-position: center; height: 80px;">
                            <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile" class="rounded-circle border border-white border-3"
                                style="width: 60px; height: 60px; object-fit: cover; position: absolute; bottom: -30px; left: 50%; transform: translateX(-50%);">
                        </div>
                        <div class="card-body" style="margin-top: 35px; padding: 16px 10px;">
                            <h6 class="card-title mb-1" style="font-weight: 600; font-size: 15px; color: #000;">Name Lastname</h6>
                            <p class="mb-0" style="color: #7f8ea3; font-size: 13px;">Project Manager</p>
                        </div>
                    </div>

                    <!-- CARD 2 -->
                    <div class="card text-center" style="width: 180px; border-radius: 18px; border: none; overflow: hidden; background: #ffffff; box-shadow: 0 2px 6px rgba(0,0,0,0.05);">
                        <div style="position: relative; background-image: url('{{ URL::asset('/build/img/bgractangle.svg') }}'); background-size: cover; background-position: center; height: 80px;">
                            <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile" class="rounded-circle border border-white border-3"
                                style="width: 60px; height: 60px; object-fit: cover; position: absolute; bottom: -30px; left: 50%; transform: translateX(-50%);">
                        </div>
                        <div class="card-body" style="margin-top: 35px; padding: 16px 10px;">
                            <h6 class="card-title mb-1" style="font-weight: 600; font-size: 15px; color: #000;">Name Lastname</h6>
                            <p class="mb-0" style="color: #7f8ea3; font-size: 13px;">Project Manager</p>
                        </div>
                    </div>

                    <!-- CARD 3 -->
                    <div class="card text-center" style="width: 180px; border-radius: 18px; border: none; overflow: hidden; background: #ffffff; box-shadow: 0 2px 6px rgba(0,0,0,0.05);">
                        <div style="position: relative; background-image: url('{{ URL::asset('/build/img/bgractangle.svg') }}'); background-size: cover; background-position: center; height: 80px;">
                            <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile" class="rounded-circle border border-white border-3"
                                style="width: 60px; height: 60px; object-fit: cover; position: absolute; bottom: -30px; left: 50%; transform: translateX(-50%);">
                        </div>
                        <div class="card-body" style="margin-top: 35px; padding: 16px 10px;">
                            <h6 class="card-title mb-1" style="font-weight: 600; font-size: 15px; color: #000;">Name Lastname</h6>
                            <p class="mb-0" style="color: #7f8ea3; font-size: 13px;">Project Manager</p>
                        </div>
                    </div>

                    <!-- CARD 4 -->
                    <div class="card text-center" style="width: 180px; border-radius: 18px; border: none; overflow: hidden; background: #ffffff; box-shadow: 0 2px 6px rgba(0,0,0,0.05);">
                        <div style="position: relative; background-image: url('{{ URL::asset('/build/img/bgractangle.svg') }}'); background-size: cover; background-position: center; height: 80px;">
                            <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile" class="rounded-circle border border-white border-3"
                                style="width: 60px; height: 60px; object-fit: cover; position: absolute; bottom: -30px; left: 50%; transform: translateX(-50%);">
                        </div>
                        <div class="card-body" style="margin-top: 35px; padding: 16px 10px;">
                            <h6 class="card-title mb-1" style="font-weight: 600; font-size: 15px; color: #000;">Name Lastname</h6>
                            <p class="mb-0" style="color: #7f8ea3; font-size: 13px;">Project Manager</p>
                        </div>
                    </div>

                </div>
            </div>
            <!-- project tcikets -->
            <div style="font-family: 'Segoe UI', sans-serif;  background-color: #f8f9fa; border-radius: 12px; padding: 20px;  box-shadow: 0 2px 8px rgba(0,0,0,0.05); color: #2e3a59;" class="mt-4">
                <!-- Section Title -->
                <h6 style="font-weight: 600; font-size: 16px; margin-bottom: 12px;">· Project Tickets ·</h6>

                <!-- Ticket Title + Status and Metrics -->
                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2 pt-3" style="margin-bottom: 16px;background:#fff;padding: 10px;border-radius: 10px;">
                    <!-- Ticket Title & Status -->
                    <div style="background:#fff">
                        <!-- Ticket Title -->
                        <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                            <!-- Ticket Title on the left -->
                            <div style="font-weight: 600; font-size: 16px; color: #2e3a59;">
                                Ticket Title
                            </div>

                            <!-- Status badges on the right -->
                            <div class="d-flex align-items-center gap-2">
                                <!-- In Progress badge -->
                                <span style="display: inline-flex; align-items: center; gap: 6px; background: #d2f4e8; color: #28c76f; font-weight: 600; font-size: 12px; padding: 4px 10px; border-radius: 10px;margin-left: 52px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="#28c76f" viewBox="0 0 16 16">
                                        <path d="M14 1.5a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v13h1v-5h9a1 1 0 0 0 1-1v-6z" />
                                    </svg>
                                    in Progress
                                </span>

                                <!-- Low badge -->
                                <span style="display: inline-flex; align-items: center; gap: 6px; background: #f3f4f6; color: #8F98A0; font-weight: 600; font-size: 12px; padding: 4px 10px; border-radius: 20px;">
                                    <span style="width: 10px; height: 10px; border-radius: 50%; background: #28c76f; display: inline-block;"></span>
                                    LOW
                                </span>
                            </div>
                        </div>

                    </div>

                    <!-- Ticket Metrics Box -->
                    <div style="max-width: 450px;">

                        <div class="d-flex align-items-center gap-3 mt-md-0 flex-wrap">
                            <!-- Metrics Box -->
                            <div style="background: #f8f9fa; border-radius: 10px; padding: 10px 15px; flex-grow: 1; max-width: 100%;">
                                <div style="display: flex; gap: 25px; align-items: center;">
                                    <div class="text-center">
                                        <div style="color: #1d6fa5; font-weight: 600; font-size: 14px;">Tickets</div>
                                        <div style="color: #649bc3; font-size: 12px;">#1 of #05</div>
                                    </div>
                                    <div class="text-center">
                                        <div style="color: #1d6fa5; font-weight: 600; font-size: 14px;">Total Tasks</div>
                                        <div style="color: #649bc3; font-size: 12px;">#05</div>
                                    </div>
                                    <div class="text-center">
                                        <div style="color: #1d6fa5; font-weight: 600; font-size: 14px;">Days Left</div>
                                        <div style="color: #649bc3; font-size: 12px;">#05</div>
                                    </div>
                                </div>

                                <!-- Blue Progress Bar Underneath OUTSIDE the flex row -->
                                <div style="height: 8px; background: #e0e0e0; border-radius: 5px; margin-top: 10px;">
                                    <div style="width: 70%; height: 100%; background: #34c6f3; border-radius: 5px;"></div>
                                </div>
                            </div>


                            <!-- Circular Progress -->
                            <div style="position: relative; width: 45px; height: 45px;">
                                <svg viewBox="0 0 36 36" width="45" height="45">
                                    <path
                                        style="fill: none; stroke:#b7b7b7; stroke-width: 3.8;"
                                        d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                    <path
                                        style="fill: none; stroke: #f9a825; stroke-width: 3.8; stroke-linecap: round;"
                                        stroke-dasharray="70, 100"
                                        d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                </svg>
                                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 12px; font-weight: bold; color: #f9a825;">70%</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Ticket meta info -->
                <div style="font-size: 12px; color: #6c757d; display: flex; gap: 8px; flex-wrap: wrap;margin-top:-50px;margin-left:10px;background:#f8f9fa;width:323px;border-radius:7px;">
                    <div><strong>Ticket ID</strong> | <strong>Section |</strong></div>
                    <div><span style="color: #28c76f;">Start:</span> 22.10.2024 |</div>
                    <div><span style="color: #28c76f;">Deliver:</span> 22.10.2024</div>
                </div>
                <!-- 2nd -->
                <hr>
                <div class="d-flex justify-content-between align-items-start flex-wrap" style="margin-bottom: 16px;background:#fff;padding: 10px;border-radius: 10px; ">
                    <!-- Ticket Title & Status -->
                    <div style="background:#fff">
                        <!-- Ticket Title -->
                        <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                            <!-- Ticket Title on the left -->
                            <div style="font-weight: 600; font-size: 16px; color: #2e3a59;">
                                Ticket Title
                            </div>

                            <!-- Status badges on the right -->
                            <div class="d-flex align-items-center gap-2">
                                <!-- In Progress badge -->
                                <span style="display: inline-flex; align-items: center; gap: 6px; background: #d2f4e8; color: #28c76f; font-weight: 600; font-size: 12px; padding: 4px 10px; border-radius: 10px;margin-left: 52px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="#28c76f" viewBox="0 0 16 16">
                                        <path d="M14 1.5a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v13h1v-5h9a1 1 0 0 0 1-1v-6z" />
                                    </svg>
                                    in Progress
                                </span>

                                <!-- Low badge -->
                                <span style="display: inline-flex; align-items: center; gap: 6px; background: #f3f4f6; color: #8F98A0; font-weight: 600; font-size: 12px; padding: 4px 10px; border-radius: 20px;">
                                    <span style="width: 10px; height: 10px; border-radius: 50%; background: #28c76f; display: inline-block;"></span>
                                    LOW
                                </span>
                            </div>
                        </div>

                    </div>

                    <!-- Ticket Metrics Box -->
                    <div style="max-width: 450px;">

                        <div class="d-flex align-items-center gap-3 mt-md-0 flex-wrap">
                            <!-- Metrics Box -->
                            <div style="background: #f8f9fa; border-radius: 10px; padding: 10px 15px; flex-grow: 1; max-width: 100%;">
                                <div style="display: flex; gap: 25px; align-items: center;">
                                    <div class="text-center">
                                        <div style="color: #1d6fa5; font-weight: 600; font-size: 14px;">Tickets</div>
                                        <div style="color: #649bc3; font-size: 12px;">#1 of #05</div>
                                    </div>
                                    <div class="text-center">
                                        <div style="color: #1d6fa5; font-weight: 600; font-size: 14px;">Total Tasks</div>
                                        <div style="color: #649bc3; font-size: 12px;">#05</div>
                                    </div>
                                    <div class="text-center">
                                        <div style="color: #1d6fa5; font-weight: 600; font-size: 14px;">Days Left</div>
                                        <div style="color: #649bc3; font-size: 12px;">#05</div>
                                    </div>
                                </div>

                                <!-- Blue Progress Bar Underneath OUTSIDE the flex row -->
                                <div style="height: 8px; background: #e0e0e0; border-radius: 5px; margin-top: 10px;">
                                    <div style="width: 70%; height: 100%; background: #34c6f3; border-radius: 5px;"></div>
                                </div>
                            </div>


                            <!-- Circular Progress -->
                            <div style="position: relative; width: 45px; height: 45px;">
                                <svg viewBox="0 0 36 36" width="45" height="45">
                                    <path
                                        style="fill: none; stroke: #b7b7b7; stroke-width: 3.8;"
                                        d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                    <path
                                        style="fill: none; stroke: #f9a825; stroke-width: 3.8; stroke-linecap: round;"
                                        stroke-dasharray="70, 100"
                                        d="M18 2.0845
                 a 15.9155 15.9155 0 0 1 0 31.831
                 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                </svg>
                                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 12px; font-weight: bold; color: #f9a825;">70%</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Ticket meta info -->
                <div style="font-size: 12px; color: #6c757d; display: flex; gap: 8px; flex-wrap: wrap;margin-top:-50px;margin-left:10px;background:#f8f9fa;width:323px;border-radius:7px;">
                    <div><strong>Ticket ID</strong> | <strong>Section |</strong></div>
                    <div><span style="color: #28c76f;">Start:</span> 22.10.2024 |</div>
                    <div><span style="color: #28c76f;">Deliver:</span> 22.10.2024</div>
                </div>
                <!-- 3rd -->
                <hr>
                <div class="d-flex justify-content-between align-items-start flex-wrap" style="margin-bottom: 16px;background:#fff;padding: 10px;border-radius: 10px; ">
                    <!-- Ticket Title & Status -->
                    <div style="background:#fff">
                        <!-- Ticket Title -->
                        <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                            <!-- Ticket Title on the left -->
                            <div style="font-weight: 600; font-size: 16px; color: #2e3a59;">
                                Ticket Title
                            </div>

                            <!-- Status badges on the right -->
                            <div class="d-flex align-items-center gap-2">
                                <!-- In Progress badge -->
                                <span style="display: inline-flex; align-items: center; gap: 6px; background: #d2f4e8; color: #28c76f; font-weight: 600; font-size: 12px; padding: 4px 10px; border-radius: 10px;margin-left: 52px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="#28c76f" viewBox="0 0 16 16">
                                        <path d="M14 1.5a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v13h1v-5h9a1 1 0 0 0 1-1v-6z" />
                                    </svg>
                                    in Progress
                                </span>

                                <!-- Low badge -->
                                <span style="display: inline-flex; align-items: center; gap: 6px; background: #f3f4f6; color: #8F98A0; font-weight: 600; font-size: 12px; padding: 4px 10px; border-radius: 20px;">
                                    <span style="width: 10px; height: 10px; border-radius: 50%; background: #28c76f; display: inline-block;"></span>
                                    LOW
                                </span>
                            </div>
                        </div>

                    </div>

                    <!-- Ticket Metrics Box -->
                    <div style="max-width: 450px;">

                        <div class="d-flex align-items-center gap-3 mt-md-0 flex-wrap">
                            <!-- Metrics Box -->
                            <div style="background: #f8f9fa; border-radius: 10px; padding: 10px 15px; flex-grow: 1; max-width: 100%;">
                                <div style="display: flex; gap: 25px; align-items: center;">
                                    <div class="text-center">
                                        <div style="color: #1d6fa5; font-weight: 600; font-size: 14px;">Tickets</div>
                                        <div style="color: #649bc3; font-size: 12px;">#1 of #05</div>
                                    </div>
                                    <div class="text-center">
                                        <div style="color: #1d6fa5; font-weight: 600; font-size: 14px;">Total Tasks</div>
                                        <div style="color: #649bc3; font-size: 12px;">#05</div>
                                    </div>
                                    <div class="text-center">
                                        <div style="color: #1d6fa5; font-weight: 600; font-size: 14px;">Days Left</div>
                                        <div style="color: #649bc3; font-size: 12px;">#05</div>
                                    </div>
                                </div>

                                <!-- Blue Progress Bar Underneath OUTSIDE the flex row -->
                                <div style="height: 8px; background: #e0e0e0; border-radius: 5px; margin-top: 10px;">
                                    <div style="width: 70%; height: 100%; background: #34c6f3; border-radius: 5px;"></div>
                                </div>
                            </div>


                            <!-- Circular Progress -->
                            <div style="position: relative; width: 45px; height: 45px;">
                                <svg viewBox="0 0 36 36" width="45" height="45">
                                    <path
                                        style="fill: none; stroke: #b7b7b7; stroke-width: 3.8;"
                                        d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                    <path
                                        style="fill: none; stroke: #f9a825; stroke-width: 3.8; stroke-linecap: round;"
                                        stroke-dasharray="70, 100"
                                        d="M18 2.0845
                 a 15.9155 15.9155 0 0 1 0 31.831
                 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                </svg>
                                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 12px; font-weight: bold; color: #f9a825;">70%</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Ticket meta info -->
                <div style="font-size: 12px; color: #6c757d; display: flex; gap: 8px; flex-wrap: wrap;margin-top:-50px;margin-left:10px;background:#f8f9fa;width:323px;border-radius:7px;">
                    <div><strong>Ticket ID</strong> | <strong>Section |</strong></div>
                    <div><span style="color: #28c76f;">Start:</span> 22.10.2024 |</div>
                    <div><span style="color: #28c76f;">Deliver:</span> 22.10.2024</div>
                </div>
                <!-- 4rth -->
                <hr>
                <div class="d-flex justify-content-between align-items-start flex-wrap" style="margin-bottom: 16px;background:#fff;padding: 10px;border-radius: 10px; ">
                    <!-- Ticket Title & Status -->
                    <div style="background:#fff">
                        <!-- Ticket Title -->
                        <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                            <!-- Ticket Title on the left -->
                            <div style="font-weight: 600; font-size: 16px; color: #2e3a59;">
                                Ticket Title
                            </div>

                            <!-- Status badges on the right -->
                            <div class="d-flex align-items-center gap-2">
                                <!-- In Progress badge -->
                                <span style="display: inline-flex; align-items: center; gap: 6px; background: #d2f4e8; color: #28c76f; font-weight: 600; font-size: 12px; padding: 4px 10px; border-radius: 10px;margin-left: 52px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="#28c76f" viewBox="0 0 16 16">
                                        <path d="M14 1.5a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v13h1v-5h9a1 1 0 0 0 1-1v-6z" />
                                    </svg>
                                    in Progress
                                </span>

                                <!-- Low badge -->
                                <span style="display: inline-flex; align-items: center; gap: 6px; background: #f3f4f6; color: #8F98A0; font-weight: 600; font-size: 12px; padding: 4px 10px; border-radius: 20px;">
                                    <span style="width: 10px; height: 10px; border-radius: 50%; background: #28c76f; display: inline-block;"></span>
                                    LOW
                                </span>
                            </div>
                        </div>

                    </div>

                    <!-- Ticket Metrics Box -->
                    <div style="max-width: 450px;">

                        <div class="d-flex align-items-center gap-3 mt-md-0 flex-wrap">
                            <!-- Metrics Box -->
                            <div style="background: #f8f9fa; border-radius: 10px; padding: 10px 15px; flex-grow: 1; max-width: 100%;">
                                <div style="display: flex; gap: 25px; align-items: center;">
                                    <div class="text-center">
                                        <div style="color: #1d6fa5; font-weight: 600; font-size: 14px;">Tickets</div>
                                        <div style="color: #649bc3; font-size: 12px;">#1 of #05</div>
                                    </div>
                                    <div class="text-center">
                                        <div style="color: #1d6fa5; font-weight: 600; font-size: 14px;">Total Tasks</div>
                                        <div style="color: #649bc3; font-size: 12px;">#05</div>
                                    </div>
                                    <div class="text-center">
                                        <div style="color: #1d6fa5; font-weight: 600; font-size: 14px;">Days Left</div>
                                        <div style="color: #649bc3; font-size: 12px;">#05</div>
                                    </div>
                                </div>

                                <!-- Blue Progress Bar Underneath OUTSIDE the flex row -->
                                <div style="height: 8px; background: #e0e0e0; border-radius: 5px; margin-top: 10px;">
                                    <div style="width: 70%; height: 100%; background: #34c6f3; border-radius: 5px;"></div>
                                </div>
                            </div>


                            <!-- Circular Progress -->
                            <div style="position: relative; width: 45px; height: 45px;">
                                <svg viewBox="0 0 36 36" width="45" height="45">
                                    <path
                                        style="fill: none; stroke:#b7b7b7; stroke-width: 3.8;"
                                        d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                    <path
                                        style="fill: none; stroke: #f9a825; stroke-width: 3.8; stroke-linecap: round;"
                                        stroke-dasharray="70, 100"
                                        d="M18 2.0845
                 a 15.9155 15.9155 0 0 1 0 31.831
                 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                </svg>
                                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 12px; font-weight: bold; color: #f9a825;">70%</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Ticket meta info -->
                <div style="font-size: 12px; color: #6c757d; display: flex; gap: 8px; flex-wrap: wrap;margin-top:-50px;margin-left:10px;background:#f8f9fa;width:323px;border-radius:7px;">
                    <div><strong>Ticket ID</strong> | <strong>Section |</strong></div>
                    <div><span style="color: #28c76f;">Start:</span> 22.10.2024 |</div>
                    <div><span style="color: #28c76f;">Deliver:</span> 22.10.2024</div>
                </div>
            </div>
            <!-- /project tickts -->
            <!-- project Task -->
            <div style="font-family: 'Segoe UI', sans-serif;  background-color: #f8f9fa; border-radius: 12px; padding: 20px;  box-shadow: 0 2px 8px rgba(0,0,0,0.05); color: #2e3a59;" class="mt-4">
                <!-- Section Title -->
                <h6 style="font-weight: 600; font-size: 16px; margin-bottom: 12px;">· Project Tasks ·</h6>

                <!-- Ticket Title + Status and Metrics -->
                <div class="d-flex justify-content-between align-items-start flex-wrap " style="margin-bottom: 16px;background:#fff;padding: 10px;border-radius: 10px;">
                    <!-- Ticket Title & Status -->
                    <div style="background:#fff">
                        <!-- Ticket Title -->
                        <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                            <!-- Ticket Title on the left -->
                            <div style="font-weight: 600; font-size: 16px; color: #2e3a59;">
                                Task Title
                            </div>

                            <!-- Status badges on the right -->
                            <div class="d-flex align-items-center gap-2" style="margin-left: 52px;">
                                <!-- Red Badge with Lightning Icon -->
                                <span style="display: inline-flex; align-items: center; border-radius: 8px; overflow: hidden; font-weight: 600; font-size: 12px;">

                                    <!-- Left icon area -->
                                    <span style="background: #f4f4f4; padding: 6px 8px; display: flex; align-items: center;">
                                        <img src="{{ asset('build/img/tera.svg') }}" alt="Icon" width="14" height="14" />
                                    </span>

                                    <!-- Red badge area -->
                                    <span style="background: #f44336; color: #fff; padding: 6px 10px; display: flex; align-items: center; gap: 4px;">
                                        <span style="font-weight: bold;">·</span>
                                        01
                                        <span style="font-weight: bold;">·</span>
                                    </span>

                                </span>


                                <!-- Low Badge with Green Dot -->
                                <span style="display: inline-flex; align-items: center; gap: 6px; background: #f3f4f6; color: #8F98A0; font-weight: 600; font-size: 12px; padding: 4px 10px; border-radius: 20px;">
                                    <span style="width: 10px; height: 10px; border-radius: 50%; background: #28c76f; display: inline-block;"></span>
                                    LOW
                                </span>

                                <!-- Yellow Badge with Flag -->
                                <span style="display: inline-flex; align-items: center; background: #fff3cd; padding: 4px 8px; border-radius: 10px;">

                                    <span>
                                        <img src="{{ asset('build/img/yelowflag.svg') }}" alt="Icon" width="14" height="14" />
                                    </span>
                                </span>
                            </div>

                        </div>

                    </div>

                    <!-- Ticket Metrics Box -->
                    <div style="max-width: 450px;">

                        <div class="d-flex align-items-center gap-3 mt-md-0 flex-wrap">
                            <!-- Metrics Box -->
                            <div style="background: #f8f9fa; border-radius: 10px; padding: 10px 15px; flex-grow: 1; max-width: 100%;">
                                <div style="display: flex; gap: 25px; align-items: center;">
                                    <div class="text-center">
                                        <div style="color: #1d6fa5; font-weight: 600; font-size: 14px;">Tickets</div>
                                        <div style="color: #649bc3; font-size: 12px;">#1 of #05</div>
                                    </div>
                                    <div class="text-center">
                                        <div style="color: #1d6fa5; font-weight: 600; font-size: 14px;">Total Tasks</div>
                                        <div style="color: #649bc3; font-size: 12px;">#05</div>
                                    </div>
                                    <div class="text-center">
                                        <div style="color: #1d6fa5; font-weight: 600; font-size: 14px;">Days Left</div>
                                        <div style="color: #649bc3; font-size: 12px;">#05</div>
                                    </div>
                                </div>

                                <!-- Blue Progress Bar Underneath OUTSIDE the flex row -->
                                <div style="height: 8px; background: #e0e0e0; border-radius: 5px; margin-top: 10px;">
                                    <div style="width: 70%; height: 100%; background: #34c6f3; border-radius: 5px;"></div>
                                </div>
                            </div>


                            <!-- Circular Progress -->

                        </div>
                    </div>
                </div>
                <!-- Ticket meta info -->
                <div style="font-size: 12px; color: #6c757d; display: flex; gap: 8px; flex-wrap: wrap;margin-top:-50px;margin-left:10px;background:#f8f9fa;width:323px;border-radius:7px;">
                    <div><strong>Ticket ID</strong> | <strong>Section |</strong></div>
                    <div><span style="color: #28c76f;">Start:</span> 22.10.2024 |</div>
                    <div><span style="color: #28c76f;">Deliver:</span> 22.10.2024</div>
                </div>
                <!-- 2nd -->
                <hr>
                <div class="d-flex justify-content-between align-items-start flex-wrap" style="margin-bottom: 16px;background:#fff;padding: 10px;border-radius: 10px; ">
                    <!-- Ticket Title & Status -->
                    <div style="background:#fff">
                        <!-- Ticket Title -->
                        <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                            <!-- Ticket Title on the left -->
                            <div style="font-weight: 600; font-size: 16px; color: #2e3a59;">
                                Task Title
                            </div>

                            <!-- Status badges on the right -->
                            <!-- Status badges on the right -->
                            <div class="d-flex align-items-center gap-2" style="margin-left: 52px;">
                                <!-- Red Badge with Lightning Icon -->
                                <span style="display: inline-flex; align-items: center; border-radius: 8px; overflow: hidden; font-weight: 600; font-size: 12px;">

                                    <!-- Left icon area -->
                                    <span style="background: #f4f4f4; padding: 6px 8px; display: flex; align-items: center;">
                                        <img src="{{ asset('build/img/tera.svg') }}" alt="Icon" width="14" height="14" />
                                    </span>

                                    <!-- Red badge area -->
                                    <span style="background: #f44336; color: #fff; padding: 6px 10px; display: flex; align-items: center; gap: 4px;">
                                        <span style="font-weight: bold;">·</span>
                                        02
                                        <span style="font-weight: bold;">·</span>
                                    </span>

                                </span>


                                <!-- Low Badge with Green Dot -->
                                <span style="display: inline-flex; align-items: center; gap: 6px; background: #f3f4f6; color: #8F98A0; font-weight: 600; font-size: 12px; padding: 4px 10px; border-radius: 20px;">
                                    <span style="width: 10px; height: 10px; border-radius: 50%; background: #28c76f; display: inline-block;"></span>
                                    LOW
                                </span>

                                <!-- Yellow Badge with Flag -->
                                <span style="display: inline-flex; align-items: center; background: #fff3cd; padding: 4px 8px; border-radius: 10px;">

                                    <span>
                                        <img src="{{ asset('build/img/redflag.svg') }}" alt="Icon" width="14" height="14" />
                                    </span>
                                </span>
                            </div>
                        </div>

                    </div>

                    <!-- Ticket Metrics Box -->
                    <div style="max-width: 450px;">

                        <div class="d-flex align-items-center gap-3 mt-md-0 flex-wrap">
                            <!-- Metrics Box -->
                            <div style="background: #f8f9fa; border-radius: 10px; padding: 10px 15px; flex-grow: 1; max-width: 100%;">
                                <div style="display: flex; gap: 25px; align-items: center;">
                                    <div class="text-center">
                                        <div style="color: #1d6fa5; font-weight: 600; font-size: 14px;">Tickets</div>
                                        <div style="color: #649bc3; font-size: 12px;">#1 of #05</div>
                                    </div>
                                    <div class="text-center">
                                        <div style="color: #1d6fa5; font-weight: 600; font-size: 14px;">Total Tasks</div>
                                        <div style="color: #649bc3; font-size: 12px;">#05</div>
                                    </div>
                                    <div class="text-center">
                                        <div style="color: #1d6fa5; font-weight: 600; font-size: 14px;">Days Left</div>
                                        <div style="color: #649bc3; font-size: 12px;">#05</div>
                                    </div>
                                </div>

                                <!-- Blue Progress Bar Underneath OUTSIDE the flex row -->
                                <div style="height: 8px; background: #e0e0e0; border-radius: 5px; margin-top: 10px;">
                                    <div style="width: 70%; height: 100%; background: #34c6f3; border-radius: 5px;"></div>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
                <!-- Ticket meta info -->
                <div style="font-size: 12px; color: #6c757d; display: flex; gap: 8px; flex-wrap: wrap;margin-top:-50px;margin-left:10px;background:#f8f9fa;width:323px;border-radius:7px;">
                    <div><strong>Ticket ID</strong> | <strong>Section |</strong></div>
                    <div><span style="color: #28c76f;">Start:</span> 22.10.2024 |</div>
                    <div><span style="color: #28c76f;">Deliver:</span> 22.10.2024</div>
                </div>
                <!-- 3rd -->
                <hr>
                <div class="d-flex justify-content-between align-items-start flex-wrap" style="margin-bottom: 16px;background:#fff;padding: 10px;border-radius: 10px; ">
                    <!-- Ticket Title & Status -->
                    <div style="background:#fff">
                        <!-- Ticket Title -->
                        <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                            <!-- Ticket Title on the left -->
                            <div style="font-weight: 600; font-size: 16px; color: #2e3a59;">
                                Task Title
                            </div>

                            <!-- Status badges on the right -->
                            <div class="d-flex align-items-center gap-2" style="margin-left: 52px;">
                                <!-- Red Badge with Lightning Icon -->
                                <span style="display: inline-flex; align-items: center; border-radius: 8px; overflow: hidden; font-weight: 600; font-size: 12px;">

                                    <!-- Left icon area -->
                                    <span style="background: #f4f4f4; padding: 6px 8px; display: flex; align-items: center;">
                                        <img src="{{ asset('build/img/tera.svg') }}" alt="Icon" width="14" height="14" />
                                    </span>

                                    <!-- Red badge area -->
                                    <span style="background: #f44336; color: #fff; padding: 6px 10px; display: flex; align-items: center; gap: 4px;">
                                        <span style="font-weight: bold;">·</span>
                                        01
                                        <span style="font-weight: bold;">·</span>
                                    </span>

                                </span>


                                <!-- Low Badge with Green Dot -->
                                <span style="display: inline-flex; align-items: center; gap: 6px; background: #f3f4f6; color: #8F98A0; font-weight: 600; font-size: 12px; padding: 4px 10px; border-radius: 20px;">
                                    <span style="width: 10px; height: 10px; border-radius: 50%; background: #28c76f; display: inline-block;"></span>
                                    LOW
                                </span>

                                <!-- Yellow Badge with Flag -->
                                <span style="display: inline-flex; align-items: center; background: #fff3cd; padding: 4px 8px; border-radius: 10px;">

                                    <span>
                                        <img src="{{ asset('build/img/yelowflag.svg') }}" alt="Icon" width="14" height="14" />
                                    </span>
                                </span>
                            </div>
                        </div>

                    </div>

                    <!-- Ticket Metrics Box -->
                    <div style="max-width: 450px;">

                        <div class="d-flex align-items-center gap-3 mt-md-0 flex-wrap">
                            <!-- Metrics Box -->
                            <div style="background: #f8f9fa; border-radius: 10px; padding: 10px 15px; flex-grow: 1; max-width: 100%;">
                                <div style="display: flex; gap: 25px; align-items: center;">
                                    <div class="text-center">
                                        <div style="color: #1d6fa5; font-weight: 600; font-size: 14px;">Tickets</div>
                                        <div style="color: #649bc3; font-size: 12px;">#1 of #05</div>
                                    </div>
                                    <div class="text-center">
                                        <div style="color: #1d6fa5; font-weight: 600; font-size: 14px;">Total Tasks</div>
                                        <div style="color: #649bc3; font-size: 12px;">#05</div>
                                    </div>
                                    <div class="text-center">
                                        <div style="color: #1d6fa5; font-weight: 600; font-size: 14px;">Days Left</div>
                                        <div style="color: #649bc3; font-size: 12px;">#05</div>
                                    </div>
                                </div>

                                <!-- Blue Progress Bar Underneath OUTSIDE the flex row -->
                                <div style="height: 8px; background: #e0e0e0; border-radius: 5px; margin-top: 10px;">
                                    <div style="width: 70%; height: 100%; background: #34c6f3; border-radius: 5px;"></div>
                                </div>
                            </div>


                            <!-- Circular Progress -->

                        </div>
                    </div>
                </div>
                <!-- Ticket meta info -->
                <div style="font-size: 12px; color: #6c757d; display: flex; gap: 8px; flex-wrap: wrap;margin-top:-50px;margin-left:10px;background:#f8f9fa;width:323px;border-radius:7px;">
                    <div><strong>Ticket ID</strong> | <strong>Section |</strong></div>
                    <div><span style="color: #28c76f;">Start:</span> 22.10.2024 |</div>
                    <div><span style="color: #28c76f;">Deliver:</span> 22.10.2024</div>
                </div>
                <!-- 4rth -->
                <hr>
                <div class="d-flex justify-content-between align-items-start flex-wrap" style="margin-bottom: 16px;background:#fff;padding: 10px;border-radius: 10px; ">
                    <!-- Ticket Title & Status -->
                    <div style="background:#fff">
                        <!-- Ticket Title -->
                        <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                            <!-- Ticket Title on the left -->
                            <div style="font-weight: 600; font-size: 16px; color: #2e3a59;">
                                Task Title
                            </div>

                            <!-- Status badges on the right -->
                            <div class="d-flex align-items-center gap-2" style="margin-left: 52px;">
                                <!-- Red Badge with Lightning Icon -->
                                <span style="display: inline-flex; align-items: center; border-radius: 8px; overflow: hidden; font-weight: 600; font-size: 12px;">

                                    <!-- Left icon area -->
                                    <span style="background: #f4f4f4; padding: 6px 8px; display: flex; align-items: center;">
                                        <img src="{{ asset('build/img/tera.svg') }}" alt="Icon" width="14" height="14" />
                                    </span>

                                    <!-- Red badge area -->
                                    <span style="background: #f44336; color: #fff; padding: 6px 10px; display: flex; align-items: center; gap: 4px;">
                                        <span style="font-weight: bold;">·</span>
                                        01
                                        <span style="font-weight: bold;">·</span>
                                    </span>

                                </span>


                                <!-- Low Badge with Green Dot -->
                                <span style="display: inline-flex; align-items: center; gap: 6px; background: #f3f4f6; color: #8F98A0; font-weight: 600; font-size: 12px; padding: 4px 10px; border-radius: 20px;">
                                    <span style="width: 10px; height: 10px; border-radius: 50%; background: #28c76f; display: inline-block;"></span>
                                    LOW
                                </span>

                                <!-- Yellow Badge with Flag -->
                                <span style="display: inline-flex; align-items: center; background: #fff3cd; padding: 4px 8px; border-radius: 10px;">

                                    <span>
                                        <img src="{{ asset('build/img/greenflag.svg') }}" alt="Icon" width="14" height="14" />
                                    </span>
                                </span>
                            </div>
                        </div>

                    </div>

                    <!-- Ticket Metrics Box -->
                    <div style="max-width: 450px;">

                        <div class="d-flex align-items-center gap-3 mt-md-0 flex-wrap">
                            <!-- Metrics Box -->
                            <div style="background: #f8f9fa; border-radius: 10px; padding: 10px 15px; flex-grow: 1; max-width: 100%;">
                                <div style="display: flex; gap: 25px; align-items: center;">
                                    <div class="text-center">
                                        <div style="color: #1d6fa5; font-weight: 600; font-size: 14px;">Tickets</div>
                                        <div style="color: #649bc3; font-size: 12px;">#1 of #05</div>
                                    </div>
                                    <div class="text-center">
                                        <div style="color: #1d6fa5; font-weight: 600; font-size: 14px;">Total Tasks</div>
                                        <div style="color: #649bc3; font-size: 12px;">#05</div>
                                    </div>
                                    <div class="text-center">
                                        <div style="color: #1d6fa5; font-weight: 600; font-size: 14px;">Days Left</div>
                                        <div style="color: #649bc3; font-size: 12px;">#05</div>
                                    </div>
                                </div>

                                <!-- Blue Progress Bar Underneath OUTSIDE the flex row -->
                                <div style="height: 8px; background: #e0e0e0; border-radius: 5px; margin-top: 10px;">
                                    <div style="width: 70%; height: 100%; background: #34c6f3; border-radius: 5px;"></div>
                                </div>
                            </div>


                            <!-- Circular Progress -->

                        </div>
                    </div>
                </div>
                <!-- Ticket meta info -->
                <div style="font-size: 12px; color: #6c757d; display: flex; gap: 8px; flex-wrap: wrap;margin-top:-50px;margin-left:10px;background:#f8f9fa;width:323px;border-radius:7px;">
                    <div><strong>Ticket ID</strong> | <strong>Section |</strong></div>
                    <div><span style="color: #28c76f;">Start:</span> 22.10.2024 |</div>
                    <div><span style="color: #28c76f;">Deliver:</span> 22.10.2024</div>
                </div>
            </div>
            <!-- /project tickets -->

            <!-- footer section -->
            <div style="display: flex; justify-content: space-around; background: #f8f9fa; padding: 20px; border-radius: 10px;" class="mt-3">

                <!-- Edit the Project -->
                <div style="text-align: center; flex: 1;cursor:pointer;">
                    <div style="background: #316b9e; padding: 10px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;">
                        <img src="{{ asset('build/img/editp.svg') }}" alt="Edit" width="30" height="30">
                    </div>
                    <div style="margin-top: 6px; color: #1c2b48; font-size: 12px; font-weight: 600;">Edit The Project</div>
                </div>

                <!-- Pause the Project -->
                <div style="text-align: center; flex: 1; cursor: pointer;" onclick="openPauseModal()">
                    <div style="background: #f4ba19; padding: 10px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;">
                        <img src="{{ asset('build/img/pause.svg') }}" alt="Pause" width="30" height="30">
                    </div>
                    <div style="margin-top: 6px; color: #1c2b48; font-size: 12px; font-weight: 600;">Pause The Project</div>
                </div>

                <!-- Remove the Project -->
                <div style="text-align: center; flex: 1;cursor: pointer;" onclick="opendeleteModel()">
                    <div style="background: #f44336; padding: 10px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;">
                        <img src="{{ asset('build/img/deletep.svg') }}" alt="Delete" width="30" height="30">
                    </div>
                    <div style="margin-top: 6px; color: #1c2b48; font-size: 12px; font-weight: 600;">Remove The Project</div>
                </div>

            </div>





        </div>
    </div>

    <!-- new -->

</div>



<!-- Add New Project Modal -->
<div class="modal fade" id="add_user" tabindex="-1" style="visibility: visible;">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header border-0 pb-0">
                <div>
                    <h4 class="modal-title fw-bold">Add New Project</h4>
                    <small class="text-muted">User ID : <strong>user -0024</strong></small>
                </div>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                <button type="button" class="custom-close-btn" data-bs-dismiss="modal" aria-label="Close">
                    &times;
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body pt-0">

                <!-- Tabs -->


                <!-- Tab Content -->
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="basicInfo">

                        <!-- Profile Upload -->
                        <div class="bg-light rounded py-3 px-3 mb-4 d-flex align-items-center">
                            <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle me-4"
                                alt="Profile Image" style="width: 80px; height: 80px; object-fit: cover;">
                            <div>
                                <p class="mb-1 fw-medium">Upload Project Logo</p>
                                <small class="text-muted d-block mb-2">Image should be below 4 MB</small>
                                <button class="btn btn-warning me-2"
                                    style="background-color: #f65b0f; border-color: #f65b0f;">Upload</button>
                                <button class="btn btn-outline">Cancel</button>
                            </div>
                        </div>

                        <!-- Form -->
                        <form>
                            <div class="row g-3 mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">Project Title</label>
                                    <input type="text" class="form-control" />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Project Priority</label>
                                    <input type="text" class="form-control" />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Start Date & End Date</label>
                                    <input type="date" class="form-control" />
                                </div>
                            </div>
                            <!-- Description Editor -->
                            <div class="mb-3">

                                <label class="form-label">Description</label>
                                <div class="border p-2 bg-white rounded">
                                    <div class="d-flex mb-2 gap-2">
                                        <select id="fontSizeSelect" class="form-select form-select-sm w-auto"
                                            onchange="setFontSize(this.value)">
                                            <option value="3">14</option>
                                            <option value="2">12</option>
                                            <option value="4">16</option>
                                            <option value="5">18</option>
                                        </select>

                                        <button type="button" class="btn btn-light btn-sm" onclick="format('bold')">
                                            <i class="fa-solid fa-bold"></i>
                                        </button>
                                        <button type="button" class="btn btn-light btn-sm" onclick="format('italic')">
                                            <i class="fa-solid fa-italic"></i>
                                        </button>
                                        <button type="button" class="btn btn-light btn-sm" onclick="format('underline')">
                                            <i class="fa-solid fa-underline"></i>
                                        </button>
                                        <button type="button" class="btn btn-light btn-sm" onclick="format('strikethrough')">
                                            <i class="fa-solid fa-strikethrough"></i>
                                        </button>
                                        <button type="button" class="btn btn-light btn-sm" onclick="removeFormatting()">
                                            <i class="fa-solid fa-eraser"></i>
                                        </button>
                                        <button type="button" class="btn btn-light btn-sm">
                                            <i class="fa-regular fa-image"></i>
                                        </button>
                                    </div>
                                    <div id="editor" contenteditable="true"
                                        style="min-height: 120px; border: 1px solid #ddd; padding: 8px; border-radius: 4px; color: #000;"></div>
                                </div>
                            </div>

                            <!-- Add Section Field -->
                            <div class="mb-3">
                                <label class="form-label">Add Section</label>
                                <div id="section-container"></div>
                                <button type="button" onclick="addSection()"
                                    style="background-color: #17a2b8; color: white; border: 1px solid #17a2b8; border-radius: 6px; padding: 6px 16px; font-size: 14px; cursor: pointer; margin-top: 6px;">
                                    Add Section
                                </button>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Select Project Manager</label>
                                    <div id="selectorContainer1"
                                        style="border: 1px solid #ccc; border-radius: 4px; background-color: #fff; padding: 8px; min-height: 80px;">

                                        <!-- Selected Tags -->
                                        <div id="tagContainer1"
                                            style="display: flex; flex-wrap: nowrap; gap: 6px; overflow-x: auto; margin-bottom: 8px; min-height: 42px;">
                                        </div>

                                        <!-- Options -->
                                        <div style="display: block;">
                                            <div onclick="selectItem(this, 'tagContainer1')" data-value="artywiz" data-label="Artywiz" data-img="https://via.placeholder.com/24x24?text=A"
                                                style="cursor: pointer; display: flex; align-items: center; gap: 6px; padding: 4px 8px; border-radius: 4px; background: #f9f9f9; margin-bottom: 6px;">
                                                <img src="https://via.placeholder.com/24x24?text=A" style="width: 24px; height: 24px;" />
                                                <span style="font-size: 14px;">Artywiz</span>
                                            </div>

                                            <div onclick="selectItem(this, 'tagContainer1')" data-value="groupama" data-label="Groupama" data-img="https://via.placeholder.com/24x24?text=G"
                                                style="cursor: pointer; display: flex; align-items: center; gap: 6px; padding: 4px 8px; border-radius: 4px; background: #f9f9f9; margin-bottom: 6px;">
                                                <img src="https://via.placeholder.com/24x24?text=G" style="width: 24px; height: 24px;" />
                                                <span style="font-size: 14px;">Groupama</span>
                                            </div>

                                            <div onclick="selectItem(this, 'tagContainer1')" data-value="zenith" data-label="Zenith" data-img="https://via.placeholder.com/24x24?text=Z"
                                                style="cursor: pointer; display: flex; align-items: center; gap: 6px; padding: 4px 8px; border-radius: 4px; background: #f9f9f9; margin-bottom: 6px;">
                                                <img src="https://via.placeholder.com/24x24?text=Z" style="width: 24px; height: 24px;" />
                                                <span style="font-size: 14px;">Zenith</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Select Developer</label>
                                    <div id="selectorContainer2"
                                        style="border: 1px solid #ccc; border-radius: 4px; background-color: #fff; padding: 8px; min-height: 80px;">

                                        <!-- Selected Tags -->
                                        <div id="tagContainer2"
                                            style="display: flex; flex-wrap: nowrap; gap: 6px; overflow-x: auto; margin-bottom: 8px; min-height: 42px;">
                                        </div>

                                        <!-- Options -->
                                        <div style="display: block;">
                                            <div onclick="selectItem(this, 'tagContainer2')" data-value="artywiz" data-label="Artywiz" data-img="https://via.placeholder.com/24x24?text=A"
                                                style="cursor: pointer; display: flex; align-items: center; gap: 6px; padding: 4px 8px; border-radius: 4px; background: #f9f9f9; margin-bottom: 6px;">
                                                <img src="https://via.placeholder.com/24x24?text=A" style="width: 24px; height: 24px;" />
                                                <span style="font-size: 14px;">Artywiz</span>
                                            </div>

                                            <div onclick="selectItem(this, 'tagContainer2')" data-value="groupama" data-label="Groupama" data-img="https://via.placeholder.com/24x24?text=G"
                                                style="cursor: pointer; display: flex; align-items: center; gap: 6px; padding: 4px 8px; border-radius: 4px; background: #f9f9f9; margin-bottom: 6px;">
                                                <img src="https://via.placeholder.com/24x24?text=G" style="width: 24px; height: 24px;" />
                                                <span style="font-size: 14px;">Groupama</span>
                                            </div>

                                            <div onclick="selectItem(this, 'tagContainer2')" data-value="zenith" data-label="Zenith" data-img="https://via.placeholder.com/24x24?text=Z"
                                                style="cursor: pointer; display: flex; align-items: center; gap: 6px; padding: 4px 8px; border-radius: 4px; background: #f9f9f9; margin-bottom: 6px;">
                                                <img src="https://via.placeholder.com/24x24?text=Z" style="width: 24px; height: 24px;" />
                                                <span style="font-size: 14px;">Zenith</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="mb-3">
                                <label class="form-label">Upload Files</label>
                                <input type="file" class="form-control" />
                            </div>

                            <!-- Upload Files -->


                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer border-top-0 pt-0">
                <div class="ms-auto d-flex gap-2">
                    <button type="button" class="btn btn-outline" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn text-white"
                        style="background-color: #f65b0f; border-color: #f65b0f;">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!--pause project model Modal -->
<div class="modal fade" id="pauseProjectModal" tabindex="-1" aria-labelledby="pauseModalLabel" aria-hidden="true" style="visibility: visible;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 12px; background-color: #ffffff; padding: 0; font-family: 'Segoe UI', sans-serif;">

            <!-- Header -->
            <div class="modal-header" style="background-color: #f1f1f1; border-bottom: none; padding: 15px 20px;">
                <h5 class="modal-title" id="pauseModalLabel" style="margin: 0; font-weight: 600; color: #1c2b48;">Pause the Project</h5>
            </div>

            <!-- Body -->
            <div class="modal-body" style="text-align: center; padding: 30px 20px 20px;">
                <!-- Icon -->
                <div style="background-color: #f4ba19; width: 60px; height: 60px; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
                    <img src="{{ asset('build/img/pause.svg') }}" alt="Pause Icon" width="28" height="28">
                </div>

                <!-- Text -->
                <p style="font-size: 16px; font-weight: 500; color: #1c2b48;">Please select the reason to Pause the Project</p>

                <!-- Dropdown -->
                <select style="background-color: #f1f1f1; border: none; padding: 10px; width: 70%; margin-top: 20px; border-radius: 6px; color: #1c2b48;">
                    <option>Select the reason</option>
                    <option>Client Request</option>
                    <option>Budget Issue</option>
                    <option>Resource Unavailable</option>
                </select>
            </div>

            <!-- Footer -->
            <div class="modal-footer" style="justify-content: center; gap: 20px; border-top: none; padding-bottom: 30px;">
                <button type="button" class="btn " data-bs-dismiss="modal" style="background-color:#f1f1f1; color: #1c2b48; border: none; width: 100px;">Close</button>
                <button type="button" class="btn" data-bs-dismiss="modal" style="background-color:#f1f1f1; color: #1c2b48; border: none; width: 130px;">Save & Close</button>
            </div>

        </div>
    </div>
</div>
<!--delet project model Modal -->
<div class="modal fade" id="removeproject" tabindex="-1" aria-labelledby="pauseModalLabel" aria-hidden="true" style="visibility: visible;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 12px; background-color: #ffffff; padding: 0; font-family: 'Segoe UI', sans-serif;">

            <!-- Header -->
            <div class="modal-header" style="background-color: #f1f1f1; border-bottom: none; padding: 15px 20px">
                <h5 class="modal-title" id="pauseModalLabel" style="margin: 0; font-weight: 600; color: #1c2b48;">Remove the Project</h5>
            </div>

            <!-- Body -->
            <div class="modal-body" style="text-align: center; padding: 30px 20px 20px;">
                <!-- Warning Message -->
                <div style="background-color: #fff;border: 1px solid #f1f1f1;color: #f44336;font-size: 14px;font-weight: 500;text-align: center;display: flex;align-items: center;justify-content: center;gap: 30px;width: fit-content;padding: 6px 12px;border-radius: 6px;margin: 0 auto 15px;margin-bottom: 15px;">
                    <img src="{{ asset('build/img/tera.svg') }}" alt="Pause Icon" width="15" height="15">
                    Project can't be Removed if there Open Tickets
                </div>

                <!-- Icon -->
                <div style="background-color: #f44336; width: 60px; height: 60px; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
                    <img src="{{ asset('build/img/deletep.svg') }}" alt="Pause Icon" width="28" height="28">
                </div>

                <!-- Text -->
                <p style="font-size: 16px; font-weight: 500; color: #1c2b48;">Please select the reason to remove the Project</p>

                <!-- Dropdown -->
                <select style="background-color: #f1f1f1; border: none; padding: 10px; width: 70%; margin-top: 20px; border-radius: 6px; color: #1c2b48;">
                    <option>Select the reason</option>
                    <option>Client Request</option>
                    <option>Budget Issue</option>
                    <option>Resource Unavailable</option>
                </select>
            </div>

            <!-- Footer -->
            <div class="modal-footer" style="justify-content: center; gap: 20px; border-top: none; padding-bottom: 30px;">
                <button type="button" class="btn" data-bs-dismiss="modal" style="background-color: #f1f1f1; color: #1c2b48; border: none; width: 100px;">Close</button>
                <button type="button" class="btn" data-bs-dismiss="modal" style="background-color: #f1f1f1; color: #1c2b48; border: none; width: 150px;">Save & Close</button>
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
    function format(command) {
        document.execCommand(command, false, null);
    }

    function setFontSize(value) {
        document.execCommand("fontSize", false, value);
    }

    function removeFormatting() {
        document.execCommand('removeFormat', false, null);
    }

    function addSection() {
        const container = document.getElementById('section-container');

        const wrapper = document.createElement('div');
        wrapper.style.position = 'relative';
        wrapper.style.width = '100%';
        wrapper.style.marginBottom = '10px';

        const input = document.createElement('input');
        input.type = 'text';
        input.placeholder = 'Enter title';
        input.style.width = '100%';
        input.style.paddingRight = '80px';
        input.style.paddingLeft = '12px';
        input.style.height = '38px';
        input.style.border = '1px solid #ced4da';
        input.style.borderRadius = '4px';
        input.style.fontSize = '14px';
        input.style.boxSizing = 'border-box';

        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.textContent = 'Remove';
        removeBtn.onclick = () => wrapper.remove();
        removeBtn.style.position = 'absolute';
        removeBtn.style.right = '0';
        removeBtn.style.top = '0';
        removeBtn.style.height = '100%';
        removeBtn.style.backgroundColor = '#dc3545';
        removeBtn.style.color = 'white';
        removeBtn.style.border = 'none';
        removeBtn.style.borderTopRightRadius = '4px';
        removeBtn.style.borderBottomRightRadius = '4px';
        removeBtn.style.padding = '0 12px';
        removeBtn.style.fontSize = '14px';
        removeBtn.style.cursor = 'pointer';

        wrapper.appendChild(input);
        wrapper.appendChild(removeBtn);
        container.appendChild(wrapper);
    }

    // Add initial section on page load
    window.onload = () => addSection();
</script>
<script>
    function selectItem(elem, containerId) {
        const value = elem.getAttribute("data-value");
        const label = elem.getAttribute("data-label");
        const img = elem.getAttribute("data-img");

        const tagContainer = document.getElementById(containerId);

        // Check if already selected
        if (tagContainer.querySelector(`[data-tag="${value}"]`)) return;

        const tag = document.createElement("div");
        tag.setAttribute("data-tag", value);
        tag.setAttribute("style", `
      display: flex;
      align-items: center;
      padding: 4px 8px;
      background: #f0f0f0;
      border-radius: 4px;
      font-size: 14px;
      white-space: nowrap;
    `);

        const image = document.createElement("img");
        image.src = img;
        image.setAttribute("style", "width: 20px; height: 20px; border-radius: 50%; margin-right: 6px;");

        const span = document.createTextNode(label);

        const close = document.createElement("span");
        close.innerHTML = "&times;";
        close.setAttribute("style", "margin-left: 8px; cursor: pointer; font-weight: bold; color: #333;");
        close.onclick = () => tag.remove();

        tag.appendChild(image);
        tag.appendChild(span);
        tag.appendChild(close);

        tagContainer.appendChild(tag);
    }
</script>
<!-- pause model pop-up -->
<script>
    function openPauseModal() {
        var offcanvasElement = document.getElementById('offcanvasRight');
        if (offcanvasElement) {
            var offcanvasInstance = bootstrap.Offcanvas.getInstance(offcanvasElement);
            if (offcanvasInstance) {
                offcanvasInstance.hide();
            }
        }

        setTimeout(function() {
            var pauseModal = new bootstrap.Modal(document.getElementById('pauseProjectModal'));
            pauseModal.show();
        }, 400);
    }
</script>

<!-- remove project pop-up -->
<script>
    function opendeleteModel() {
        var offcanvasElement = document.getElementById('offcanvasRight');
        if (offcanvasElement) {
            var offcanvasInstance = bootstrap.Offcanvas.getInstance(offcanvasElement);
            if (offcanvasInstance) {
                offcanvasInstance.hide();
            }
        }

        setTimeout(function() {
            var pauseModal = new bootstrap.Modal(document.getElementById('removeproject'));
            pauseModal.show();
        }, 400);
    }
</script>
<!-- dark and light mode -->
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
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->
@component('components.model-popup')
@endcomponent
@endsection