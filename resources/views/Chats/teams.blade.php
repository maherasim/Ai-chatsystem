<?php $page = 'chat'; ?>
@extends('layout.mainlayout')
@section('content')

<style>
    body {
        overflow-x: hidden;
    }

    .dropdown-menu {
        max-height: 300px;
        /* or adjust */
        overflow-y: auto;
        overflow-x: hidden;
    }

    /* Prevent parent containers from overflowing */
    .main_content,
    .chat-body,
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
</style>


<!-- content -->
<div class="content main_content">

    <!-- Left Sidebar Menu -->

    <div style="visibility: visible;">
        @include('Chats.chatsidebar')
    </div>
    <!-- /Left Sidebar Menu -->

    <!-- sidebar group -->
    <div class="sidebar-group" style="visibility: visible;">
        <div class="tab-content">
            <div class="tab-pane fade active show " id="chat-menu">

                <!-- Chats sidebar -->
                <div class="slimscroll">
                    @include('Chats.notification')
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

                        <!-- pinned Groups -->

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
                <!-- / Chats sidebar -->

            </div>
        </div>
    </div>
    <!-- /Sidebar group -->

    <!-- Chat -->
    <div class="chat chat-messages show" id="middle" style="overflow-y: hidden;">
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
            <!-- Wrapper -->
            <div style="visibility:visible;height: 92vh; overflow-y: auto; scrollbar-width: thin;">
                <div class="chat-body chat-page-group ">

                    <!-- members overwiew -->
                    <div class="project-succes pt-2 pb-2 d-flex justify-content-between align-items-center" style="flex-wrap: wrap; gap: 10px;">

                        <!-- Left Side -->
                        <div>
                            <h3 style="margin: 0;">Our team</h3>
                            <strong>Our Team:10</strong>
                        </div>

                        <!-- Right Side -->
                        <div class="d-flex align-items-center flex-wrap" style="gap: 8px;">
                            <button
                                type="button"
                                data-bs-toggle="modal"
                                data-bs-target="#add_user"
                                style="background-color: green; color: white; border: none; padding: 7px 14px; border-radius: 6px; font-weight: 500; display: flex; align-items: center; gap: 6px; cursor: pointer;">
                                + Create Team
                            </button>




                        </div>
                    </div>
                    <!-- users cards -->
                    <div class="row g-2">
                        <!-- Card 1 -->
                        <div class="col-md-3 col-sm-6 mb-4">
                            <div class="card" style=" border-radius: 15px; overflow: hidden; font-family: sans-serif; position: relative;">
                                <!-- Top Background with Overlay Elements -->
                                <div style="position: relative;">
                                    <!-- Background Image -->
                                    <img src="{{ URL::asset('/build/img/bgblack.svg') }}" class="img-fluid" style="width: 100%; height: auto;" alt="BG Image">

                                    <!-- Top-right overlay group -->
                                    <!-- 3-Dot Button + Popup -->
                                    <div class="position-absolute d-flex flex-column align-items-end gap-2" style="top: 110px; right: 10px; z-index: 2;">

                                        <!-- Trigger Button -->
                                        <div
                                            style="width: 32px; height: 32px; border: 2px solid #c2c7d0; border-radius: 50%; display: flex; align-items: center; justify-content: center; background-color: white; cursor: pointer;"
                                            onclick="this.nextElementSibling.style.display = this.nextElementSibling.style.display === 'block' ? 'none' : 'block'; event.stopPropagation();">
                                            <span style="color: #2e3a59; font-size: 18px; font-weight: bold; margin-bottom: 8px;">...</span>
                                        </div>

                                        <!-- Popup Menu -->
                                        <div
                                            class="menu-box"
                                            style="display: none; background: #fff; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); padding: 10px; width: 140px; text-align: center;"
                                            onclick="event.stopPropagation();">
                                            <div style="font-size: 13px; color: #7a7a9d; font-weight: 600; margin-bottom: 8px;">Options</div>
                                            <div class="d-flex justify-content-between px-2">
                                                <img src="{{URL::asset('/build/img/delete1.svg')}}" alt="Delete" style="width: 22px; cursor: pointer;">
                                                <img src="{{URL::asset('/build/img/Edit1.svg')}}" alt="Edit" style="width: 22px; cursor: pointer;"data-bs-toggle="modal"
                                data-bs-target="#edit_team">
                                                <img src="{{URL::asset('/build/img/flow.svg')}}" alt="Flow" style="width: 22px; cursor: pointer;">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Hide all popups on outside click (Inline JS inside body tag only) -->

                                    <body onclick="document.querySelectorAll('.menu-box').forEach(el => el.style.display = 'none');">


                                        <!-- Profile Image (overlapping bottom center) -->
                                        <div style="position: absolute; bottom: -40px; left: 50%; transform: translateX(-50%); border: 3px solid #fff; border-radius: 50%; background: white;">
                                            <img src="{{ URL::asset('/build/img/profileuser.svg') }}" class="rounded-circle" style="width: 80px; height: 80px;" alt="Profile">
                                        </div>
                                </div>

                                <!-- Content Below Image -->
                                <div style="padding-top: 40px;" class="text-center">
                                    <div style="font-weight: bold; font-size: 16px; cursor: pointer;" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Team Name </div>

                                    <!-- Developer Badge -->
                                    <div style="margin-top: 5px;">
                                        <span style=" background-color: #f1f1f1;  /* slightly darker than #f8f9fb */ color: #e53935;             /* deeper red tone */ font-size: 13px; padding: 4px 12px; border-radius: 12px; font-weight: 600; display: inline-block; ">
                                            yekbon project
                                        </span>
                                    </div>


                                </div>

                                <div class="p-3 mb-2" style="background-color: #f8f9fb; border-radius: 10px; padding: 10px; margin: 6px; font-size: 14px;">

                                    <!-- Top Row: Title and Date -->
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div style="font-weight: 600; color: #2e3a59; font-size: 14px;">Project & Team</div>
                                        <div class="d-flex align-items-center gap-1" style="font-size: 13px; color: #2e3a59;">
                                            <img src="{{ asset('build/img/member.svg') }}" alt="Green Flag" width="14" height="14">
                                            <span>10.09.2025</span>
                                        </div>
                                    </div>

                                    <!-- Bottom Row: Logo + PM + Team -->
                                    <div class="d-flex justify-content-between align-items-center text-center">

                                        <!-- Left: Logo + Flag -->
                                        <div class="d-flex flex-column align-items-center gap-2">
                                            <img src="{{URL::asset('/build/img/yekbon.svg')}}" alt="Logo" style="height: 32px; width: 32px;" />
                                            <div style="background: #c8ede0; padding: 4px 10px; border-radius: 10px; display: flex; justify-content: center; align-items: center;">
                                                <img src="{{ asset('build/img/greenflag.svg') }}" alt="Green Flag" width="14" height="14">
                                            </div>
                                        </div>

                                        <!-- Center: PM -->
                                        <div class="text-center">
                                            <img src="{{URL::asset('/build/img/profileuser.svg')}}" alt="PM" class="rounded-circle" style="height: 36px; width: 36px; object-fit: cover;" />
                                            <div style="font-size: 12px; font-weight: 500; color: #4b5c74;">PM</div>
                                        </div>

                                        <!-- Right: Overlapping team members -->
                                        <div class="d-flex align-items-center justify-content-center" style="margin-left: 6px;margin-bottom: 18px;">
                                            <img src="{{URL::asset('/build/img/profileuser.svg')}}" class="rounded-circle" style="height: 28px; width: 28px; object-fit: cover; border: 2px solid #fff; z-index: 2;" />
                                            <img src="{{URL::asset('/build/img/profileuser.svg')}}" class="rounded-circle" style="height: 28px; width: 28px; object-fit: cover; border: 2px solid #fff; margin-left: -10px; z-index: 1;" />
                                        </div>

                                    </div>
                                </div>

                                <!-- Stats -->
                                <div class="d-flex justify-content-around mt-1" style="background-color: #f8f9fb;border-radius:10px;padding:10px;margin:6px;font-size: 14px;">
                                    <div class="text-center">
                                        <div style="font-weight: bold;">Tickets</div>
                                        <div>1</div>
                                    </div>
                                    <div class="text-center">
                                        <div style="font-weight: bold;">Total Tickets</div>
                                        <div>10</div>
                                    </div>
                                    <div class="text-center">
                                        <div style="font-weight: bold;">Total Tasks</div>
                                        <div>10</div>
                                    </div>
                                </div>
                                <div style="background-color: #f8f9fb;border-radius:10px;padding:10px;margin:6px;font-size: 14px;">
                                    <div class="d-flex justify-content-between px-1"
                                        style="font-size: 11px; color: #2e3a59; font-weight: 600; font-family: 'Segoe UI', sans-serif;">
                                        <span>Section #175%</span>
                                        <span>Section #175%</span>
                                        <span>Section #175%</span>
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
                                <!-- Productivity -->
                                <div class="text-center mt-1 mb-1" style="background-color: #f8f9fb; border-radius: 10px; padding: 10px; margin: 6px; font-size: 14px; font-family: sans-serif;">
                                    <div style="font-weight: 600; color: #4a90e2;">Productivity 75%</div>
                                    <div style="height: 8px; width: 90%; margin: 6px auto; background-color: #e6e6e6; border-radius: 5px;">
                                        <div style="width: 75%; height: 100%; background-color: #4acbff; border-radius: 5px;"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- card 2 -->
                        <div class="col-md-3 col-sm-6 mb-4">
                            <div class="card" style=" border-radius: 15px; overflow: hidden; font-family: sans-serif; position: relative;">
                                <!-- Top Background with Overlay Elements -->
                                <div style="position: relative;">
                                    <!-- Background Image -->
                                    <img src="{{ URL::asset('/build/img/bgblack.svg') }}" class="img-fluid" style="width: 100%; height: auto;" alt="BG Image">

                                    <!-- Top-right overlay group -->
                                    <div style="position: absolute; top: 110px; right: 10px; display: flex; flex-direction: column; align-items: flex-end; gap: 4px;">

                                        <!-- 3 Dots Circle Button -->
                                        <div style=" width: 32px; height: 32px; border: 2px solid #c2c7d0; border-radius: 50%; display: flex; align-items: center; justify-content: center; background-color: white; cursor: pointer;">
                                            <span style="color: #2e3a59; font-size: 18px; font-weight: bold;margin-bottom: 8px;">...</span>
                                        </div>

                                        <!-- Date with icon -->

                                    </div>

                                    <!-- Profile Image (overlapping bottom center) -->
                                    <div style="position: absolute; bottom: -40px; left: 50%; transform: translateX(-50%); border: 3px solid #fff; border-radius: 50%; background: white;">
                                        <img src="{{ URL::asset('/build/img/profileuser.svg') }}" class="rounded-circle" style="width: 80px; height: 80px;" alt="Profile">
                                    </div>
                                </div>

                                <!-- Content Below Image -->
                                <div style="padding-top: 40px;" class="text-center">
                                    <div style="font-weight: bold; font-size: 16px; cursor: pointer;" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Team Name </div>

                                    <!-- Developer Badge -->
                                    <div style="margin-top: 5px;">
                                        <span style=" background-color: #f1f1f1;  /* slightly darker than #f8f9fb */ color: #e53935;             /* deeper red tone */ font-size: 13px; padding: 4px 12px; border-radius: 12px; font-weight: 600; display: inline-block; ">
                                            yekbon project
                                        </span>
                                    </div>


                                </div>

                                <div class="p-3 mb-2" style="background-color: #f8f9fb; border-radius: 10px; padding: 10px; margin: 6px; font-size: 14px;">

                                    <!-- Top Row: Title and Date -->
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div style="font-weight: 600; color: #2e3a59; font-size: 14px;">Project & Team</div>
                                        <div class="d-flex align-items-center gap-1" style="font-size: 13px; color: #2e3a59;">
                                            <img src="{{ asset('build/img/member.svg') }}" alt="Green Flag" width="14" height="14">
                                            <span>10.09.2025</span>
                                        </div>
                                    </div>

                                    <!-- Bottom Row: Logo + PM + Team -->
                                    <div class="d-flex justify-content-between align-items-center text-center">

                                        <!-- Left: Logo + Flag -->
                                        <div class="d-flex flex-column align-items-center gap-2">
                                            <img src="{{URL::asset('/build/img/yekbon.svg')}}" alt="Logo" style="height: 32px; width: 32px;" />
                                            <div style="background: #c8ede0; padding: 4px 10px; border-radius: 10px; display: flex; justify-content: center; align-items: center;">
                                                <img src="{{ asset('build/img/greenflag.svg') }}" alt="Green Flag" width="14" height="14">
                                            </div>
                                        </div>

                                        <!-- Center: PM -->
                                        <div class="text-center">
                                            <img src="{{URL::asset('/build/img/profileuser.svg')}}" alt="PM" class="rounded-circle" style="height: 36px; width: 36px; object-fit: cover;" />
                                            <div style="font-size: 12px; font-weight: 500; color: #4b5c74;">PM</div>
                                        </div>

                                        <!-- Right: Overlapping team members -->
                                        <div class="d-flex align-items-center justify-content-center" style="margin-left: 6px;margin-bottom: 18px;">
                                            <img src="{{URL::asset('/build/img/profileuser.svg')}}" class="rounded-circle" style="height: 28px; width: 28px; object-fit: cover; border: 2px solid #fff; z-index: 2;" />
                                            <img src="{{URL::asset('/build/img/profileuser.svg')}}" class="rounded-circle" style="height: 28px; width: 28px; object-fit: cover; border: 2px solid #fff; margin-left: -10px; z-index: 1;" />
                                        </div>

                                    </div>
                                </div>

                                <!-- Stats -->
                                <div class="d-flex justify-content-around mt-1" style="background-color: #f8f9fb;border-radius:10px;padding:10px;margin:6px;font-size: 14px;">
                                    <div class="text-center">
                                        <div style="font-weight: bold;">Tickets</div>
                                        <div>1</div>
                                    </div>
                                    <div class="text-center">
                                        <div style="font-weight: bold;">Total Tickets</div>
                                        <div>10</div>
                                    </div>
                                    <div class="text-center">
                                        <div style="font-weight: bold;">Total Tasks</div>
                                        <div>10</div>
                                    </div>
                                </div>
                                <div style="background-color: #f8f9fb;border-radius:10px;padding:10px;margin:6px;font-size: 14px;">
                                    <div class="d-flex justify-content-between px-1"
                                        style="font-size: 11px; color: #2e3a59; font-weight: 600; font-family: 'Segoe UI', sans-serif;">
                                        <span>Section #175%</span>
                                        <span>Section #175%</span>
                                        <span>Section #175%</span>
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
                                <!-- Productivity -->
                                <div class="text-center mt-1 mb-1" style="background-color: #f8f9fb; border-radius: 10px; padding: 10px; margin: 6px; font-size: 14px; font-family: sans-serif;">
                                    <div style="font-weight: 600; color: #4a90e2;">Productivity 75%</div>
                                    <div style="height: 8px; width: 90%; margin: 6px auto; background-color: #e6e6e6; border-radius: 5px;">
                                        <div style="width: 75%; height: 100%; background-color: #4acbff; border-radius: 5px;"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- card 3 -->
                        <div class="col-md-3 col-sm-6 mb-4">
                            <div class="card" style=" border-radius: 15px; overflow: hidden; font-family: sans-serif; position: relative;">
                                <!-- Top Background with Overlay Elements -->
                                <div style="position: relative;">
                                    <!-- Background Image -->
                                    <img src="{{ URL::asset('/build/img/bgblack.svg') }}" class="img-fluid" style="width: 100%; height: auto;" alt="BG Image">

                                    <!-- Top-right overlay group -->
                                    <div style="position: absolute; top: 110px; right: 10px; display: flex; flex-direction: column; align-items: flex-end; gap: 4px;">

                                        <!-- 3 Dots Circle Button -->
                                        <div style=" width: 32px; height: 32px; border: 2px solid #c2c7d0; border-radius: 50%; display: flex; align-items: center; justify-content: center; background-color: white; cursor: pointer;">
                                            <span style="color: #2e3a59; font-size: 18px; font-weight: bold;margin-bottom: 8px;">...</span>
                                        </div>

                                        <!-- Date with icon -->

                                    </div>

                                    <!-- Profile Image (overlapping bottom center) -->
                                    <div style="position: absolute; bottom: -40px; left: 50%; transform: translateX(-50%); border: 3px solid #fff; border-radius: 50%; background: white;">
                                        <img src="{{ URL::asset('/build/img/profileuser.svg') }}" class="rounded-circle" style="width: 80px; height: 80px;" alt="Profile">
                                    </div>
                                </div>

                                <!-- Content Below Image -->
                                <div style="padding-top: 40px;" class="text-center">
                                    <div style="font-weight: bold; font-size: 16px; cursor: pointer;" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Team Name </div>

                                    <!-- Developer Badge -->
                                    <div style="margin-top: 5px;">
                                        <span style=" background-color: #f1f1f1;  /* slightly darker than #f8f9fb */ color: #e53935;             /* deeper red tone */ font-size: 13px; padding: 4px 12px; border-radius: 12px; font-weight: 600; display: inline-block; ">
                                            yekbon project
                                        </span>
                                    </div>


                                </div>

                                <div class="p-3 mb-2" style="background-color: #f8f9fb; border-radius: 10px; padding: 10px; margin: 6px; font-size: 14px;">

                                    <!-- Top Row: Title and Date -->
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div style="font-weight: 600; color: #2e3a59; font-size: 14px;">Project & Team</div>
                                        <div class="d-flex align-items-center gap-1" style="font-size: 13px; color: #2e3a59;">
                                            <img src="{{ asset('build/img/member.svg') }}" alt="Green Flag" width="14" height="14">
                                            <span>10.09.2025</span>
                                        </div>
                                    </div>

                                    <!-- Bottom Row: Logo + PM + Team -->
                                    <div class="d-flex justify-content-between align-items-center text-center">

                                        <!-- Left: Logo + Flag -->
                                        <div class="d-flex flex-column align-items-center gap-2">
                                            <img src="{{URL::asset('/build/img/yekbon.svg')}}" alt="Logo" style="height: 32px; width: 32px;" />
                                            <div style="background: #c8ede0; padding: 4px 10px; border-radius: 10px; display: flex; justify-content: center; align-items: center;">
                                                <img src="{{ asset('build/img/greenflag.svg') }}" alt="Green Flag" width="14" height="14">
                                            </div>
                                        </div>

                                        <!-- Center: PM -->
                                        <div class="text-center">
                                            <img src="{{URL::asset('/build/img/profileuser.svg')}}" alt="PM" class="rounded-circle" style="height: 36px; width: 36px; object-fit: cover;" />
                                            <div style="font-size: 12px; font-weight: 500; color: #4b5c74;">PM</div>
                                        </div>

                                        <!-- Right: Overlapping team members -->
                                        <div class="d-flex align-items-center justify-content-center" style="margin-left: 6px;margin-bottom: 18px;">
                                            <img src="{{URL::asset('/build/img/profileuser.svg')}}" class="rounded-circle" style="height: 28px; width: 28px; object-fit: cover; border: 2px solid #fff; z-index: 2;" />
                                            <img src="{{URL::asset('/build/img/profileuser.svg')}}" class="rounded-circle" style="height: 28px; width: 28px; object-fit: cover; border: 2px solid #fff; margin-left: -10px; z-index: 1;" />
                                        </div>

                                    </div>
                                </div>

                                <!-- Stats -->
                                <div class="d-flex justify-content-around mt-1" style="background-color: #f8f9fb;border-radius:10px;padding:10px;margin:6px;font-size: 14px;">
                                    <div class="text-center">
                                        <div style="font-weight: bold;">Tickets</div>
                                        <div>1</div>
                                    </div>
                                    <div class="text-center">
                                        <div style="font-weight: bold;">Total Tickets</div>
                                        <div>10</div>
                                    </div>
                                    <div class="text-center">
                                        <div style="font-weight: bold;">Total Tasks</div>
                                        <div>10</div>
                                    </div>
                                </div>
                                <div style="background-color: #f8f9fb;border-radius:10px;padding:10px;margin:6px;font-size: 14px;">
                                    <div class="d-flex justify-content-between px-1"
                                        style="font-size: 11px; color: #2e3a59; font-weight: 600; font-family: 'Segoe UI', sans-serif;">
                                        <span>Section #175%</span>
                                        <span>Section #175%</span>
                                        <span>Section #175%</span>
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
                                <!-- Productivity -->
                                <div class="text-center mt-1 mb-1" style="background-color: #f8f9fb; border-radius: 10px; padding: 10px; margin: 6px; font-size: 14px; font-family: sans-serif;">
                                    <div style="font-weight: 600; color: #4a90e2;">Productivity 75%</div>
                                    <div style="height: 8px; width: 90%; margin: 6px auto; background-color: #e6e6e6; border-radius: 5px;">
                                        <div style="width: 75%; height: 100%; background-color: #4acbff; border-radius: 5px;"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- card 4 -->
                        <div class="col-md-3 col-sm-6 mb-4">
                            <div class="card" style=" border-radius: 15px; overflow: hidden; font-family: sans-serif; position: relative;">
                                <!-- Top Background with Overlay Elements -->
                                <div style="position: relative;">
                                    <!-- Background Image -->
                                    <img src="{{ URL::asset('/build/img/bgblack.svg') }}" class="img-fluid" style="width: 100%; height: auto;" alt="BG Image">

                                    <!-- Top-right overlay group -->
                                    <div style="position: absolute; top: 110px; right: 10px; display: flex; flex-direction: column; align-items: flex-end; gap: 4px;">

                                        <!-- 3 Dots Circle Button -->
                                        <div style=" width: 32px; height: 32px; border: 2px solid #c2c7d0; border-radius: 50%; display: flex; align-items: center; justify-content: center; background-color: white; cursor: pointer;">
                                            <span style="color: #2e3a59; font-size: 18px; font-weight: bold;margin-bottom: 8px;">...</span>
                                        </div>

                                        <!-- Date with icon -->

                                    </div>

                                    <!-- Profile Image (overlapping bottom center) -->
                                    <div style="position: absolute; bottom: -40px; left: 50%; transform: translateX(-50%); border: 3px solid #fff; border-radius: 50%; background: white;">
                                        <img src="{{ URL::asset('/build/img/profileuser.svg') }}" class="rounded-circle" style="width: 80px; height: 80px;" alt="Profile">
                                    </div>
                                </div>

                                <!-- Content Below Image -->
                                <div style="padding-top: 40px;" class="text-center">
                                    <div style="font-weight: bold; font-size: 16px; cursor: pointer;" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Team Name </div>

                                    <!-- Developer Badge -->
                                    <div style="margin-top: 5px;">
                                        <span style=" background-color: #f1f1f1;  /* slightly darker than #f8f9fb */ color: #e53935;             /* deeper red tone */ font-size: 13px; padding: 4px 12px; border-radius: 12px; font-weight: 600; display: inline-block; ">
                                            yekbon project
                                        </span>
                                    </div>


                                </div>

                                <div class="p-3 mb-2" style="background-color: #f8f9fb; border-radius: 10px; padding: 10px; margin: 6px; font-size: 14px;">

                                    <!-- Top Row: Title and Date -->
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div style="font-weight: 600; color: #2e3a59; font-size: 14px;">Project & Team</div>
                                        <div class="d-flex align-items-center gap-1" style="font-size: 13px; color: #2e3a59;">
                                            <img src="{{ asset('build/img/member.svg') }}" alt="Green Flag" width="14" height="14">
                                            <span>10.09.2025</span>
                                        </div>
                                    </div>

                                    <!-- Bottom Row: Logo + PM + Team -->
                                    <div class="d-flex justify-content-between align-items-center text-center">

                                        <!-- Left: Logo + Flag -->
                                        <div class="d-flex flex-column align-items-center gap-2">
                                            <img src="{{URL::asset('/build/img/yekbon.svg')}}" alt="Logo" style="height: 32px; width: 32px;" />
                                            <div style="background: #c8ede0; padding: 4px 10px; border-radius: 10px; display: flex; justify-content: center; align-items: center;">
                                                <img src="{{ asset('build/img/greenflag.svg') }}" alt="Green Flag" width="14" height="14">
                                            </div>
                                        </div>

                                        <!-- Center: PM -->
                                        <div class="text-center">
                                            <img src="{{URL::asset('/build/img/profileuser.svg')}}" alt="PM" class="rounded-circle" style="height: 36px; width: 36px; object-fit: cover;" />
                                            <div style="font-size: 12px; font-weight: 500; color: #4b5c74;">PM</div>
                                        </div>

                                        <!-- Right: Overlapping team members -->
                                        <div class="d-flex align-items-center justify-content-center" style="margin-left: 6px;margin-bottom: 18px;">
                                            <img src="{{URL::asset('/build/img/profileuser.svg')}}" class="rounded-circle" style="height: 28px; width: 28px; object-fit: cover; border: 2px solid #fff; z-index: 2;" />
                                            <img src="{{URL::asset('/build/img/profileuser.svg')}}" class="rounded-circle" style="height: 28px; width: 28px; object-fit: cover; border: 2px solid #fff; margin-left: -10px; z-index: 1;" />
                                        </div>

                                    </div>
                                </div>

                                <!-- Stats -->
                                <div class="d-flex justify-content-around mt-1" style="background-color: #f8f9fb;border-radius:10px;padding:10px;margin:6px;font-size: 14px;">
                                    <div class="text-center">
                                        <div style="font-weight: bold;">Tickets</div>
                                        <div>1</div>
                                    </div>
                                    <div class="text-center">
                                        <div style="font-weight: bold;">Total Tickets</div>
                                        <div>10</div>
                                    </div>
                                    <div class="text-center">
                                        <div style="font-weight: bold;">Total Tasks</div>
                                        <div>10</div>
                                    </div>
                                </div>
                                <div style="background-color: #f8f9fb;border-radius:10px;padding:10px;margin:6px;font-size: 14px;">
                                    <div class="d-flex justify-content-between px-1"
                                        style="font-size: 11px; color: #2e3a59; font-weight: 600; font-family: 'Segoe UI', sans-serif;">
                                        <span>Section #175%</span>
                                        <span>Section #175%</span>
                                        <span>Section #175%</span>
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
                                <!-- Productivity -->
                                <div class="text-center mt-1 mb-1" style="background-color: #f8f9fb; border-radius: 10px; padding: 10px; margin: 6px; font-size: 14px; font-family: sans-serif;">
                                    <div style="font-weight: 600; color: #4a90e2;">Productivity 75%</div>
                                    <div style="height: 8px; width: 90%; margin: 6px auto; background-color: #e6e6e6; border-radius: 5px;">
                                        <div style="width: 75%; height: 100%; background-color: #4acbff; border-radius: 5px;"></div>
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

<!-- user pop-up -->

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel"
    style="width: 65vw; max-width: 100%; overflow-x: hidden;">

    <!-- Offcanvas Header -->
    <div class="offcanvas-header p-0 position-relative" style="height: 180px;">
        <!-- Background image -->
        <img src="{{URL::asset('/build/img/bgblack.svg')}}" alt="Header Image"
            style="width: 100%; height: 100%; object-fit: cover;">

        <!-- Profile Image (top-right, overlapping) -->
        <img src="{{URL::asset('/build/img/profileuser.svg')}}" alt="Profile"
            style="position: absolute; top: 20px; right: 50px; width: 80px; height: 80px; border-radius: 50%; border: 3px solid #fff; box-shadow: 0 0 10px rgba(0,0,0,0.3); z-index: 10;">

        <!-- Close Button -->
        <button type="button" data-bs-dismiss="offcanvas" aria-label="Close"
            style="position: absolute; top: 10px; right: 10px; background-color: white; color: black; border: none; border-radius: 50%; width: 36px; height: 36px; font-size: 24px; font-weight: bold; z-index: 9999; display: flex; align-items: center; justify-content: center; box-shadow: 0 0 6px rgba(0, 0, 0, 0.2)">
            &times;
        </button>
    </div>

    <!-- Buttons Under Header -->
    <!-- <div class="px-4 py-2">
    <button class="btn btn-success me-2" id="btnOverview" onclick="showTab('overview')">Overview</button>
    <button class="btn btn-light border" id="btnStatistics" onclick="showTab('statistics')">Statistics</button>
  </div> -->
    <div class="px-4 py-2">
        <button class="btn btn-success me-2" id="btnOverview" onclick="showContent('overview')">Overview</button>
        <button class="btn btn-light border" id="btnStatistics" onclick="showContent('statistics')">Statistics</button>
    </div>


    <!-- Main Content Grid -->
    <div id="overviewContent" class="toggle-content" style="display: block;">
        <div class="row m-0  py-2">
            <!-- Left Panel: col-3 -->
            <div class="col-lg-4 col-md-8 col-sm-12">
                <!-- Add left side profile card/info -->
                <div class="card mb-3">
                    <div style=" font-family: 'Segoe UI', sans-serif;">
                        <!-- Header with Blue Background -->
                        <div style="background: linear-gradient(to right, #1565c0, #4fc3f7); height: 140px; position: relative; border-top-left-radius: 10px; border-top-right-radius: 10px;"></div>

                        <!-- Info Section Background -->
                        <div style="background-color: #fafcfc; padding: 20px; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                            <!-- Profile Image (Overlapping) -->
                            <div style="position: relative; margin-top: -60px; text-align: center;">
                                <img src="{{URL::asset('/build/img/profileuser.svg')}}" alt="Profile" style="width: 100px; height: 100px; border-radius: 50%; border: 4px solid white; object-fit: cover; box-shadow: 0 0 8px rgba(0,0,0,0.2);">
                                <h5 class="mt-2 mb-1">Name Lastname</h5>
                                <span class="badge bg-light text-danger" style="font-size: 12px;">Developer</span>
                            </div>
                            <!-- Info Rows -->
                            <div class="card mb-2 p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><i class="bi bi-gender-ambiguous me-2"></i> Gender</div>
                                    <div class="fw-bold">Female</div>
                                </div>
                            </div>

                            <div class="card mb-2 p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><i class="bi bi-person-badge me-2"></i> User ID</div>
                                    <div class="fw-bold">Ticket ID</div>
                                </div>
                            </div>

                            <div class="card mb-2 p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><i class="bi bi-geo-alt me-2"></i> Country</div>
                                    <div class="fw-bold">Pakistan</div>
                                </div>
                            </div>

                            <div class="card mb-2 p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><i class="bi bi-people me-2"></i> Team</div>
                                    <div class="fw-bold">Ticket ID</div>
                                </div>
                            </div>

                            <div class="card mb-2 p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><i class="bi bi-calendar-check me-2"></i> Join Date</div>
                                    <div class="fw-bold">Ticket ID</div>
                                </div>
                            </div>

                            <div class="card mb-2 p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><i class="bi bi-telephone me-2"></i> Phone</div>
                                    <div class="fw-bold">Ticket ID</div>
                                </div>
                            </div>

                            <div class="card mb-2 p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><i class="bi bi-envelope me-2"></i> E-Mail</div>
                                    <div class="fw-bold">Ticket ID</div>
                                </div>
                            </div>

                            <div class="card mb-2 p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><i class="bi bi-chat-dots me-2"></i> Message</div>
                                    <div class="fw-bold text-primary">@LogiTeam</div>
                                </div>
                            </div>





                        </div>

                        <!-- pdf -->

                        <div class="mt-2" style="background-color: #fafcfc; padding: 20px;">
                            <h6 class="mb-3" style="color: #6c7a89;">Documents</h6>
                            <div class="row">
                                <!-- Document Card -->
                                <div class="col-12 mb-3">
                                    <div class="d-flex justify-content-between align-items-center p-2 rounded"
                                        style="background-color: white; box-shadow: 0 0 6px rgba(0,0,0,0.05);">
                                        <div class="d-flex align-items-center">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/8/87/PDF_file_icon.svg"
                                                alt="PDF Icon"
                                                style="width: 35px; height: 40px; object-fit: contain; margin-right: 10px;">
                                            <div>
                                                <div style="font-weight: 500; font-size: 14px; color: #2e3a59;">ID Card Font ...</div>
                                                <div style="font-size: 12px; color: #8c94a3;">94 KB - Date</div>
                                            </div>
                                        </div>
                                        <div style="width: 28px; height: 28px; border: 1px solid #a6aec1; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                            <i class="bi bi-three-dots" style="font-size: 16px; color: #2e3a59;"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mb-3">
                                    <div class="d-flex justify-content-between align-items-center p-2 rounded"
                                        style="background-color: white; box-shadow: 0 0 6px rgba(0,0,0,0.05);">
                                        <div class="d-flex align-items-center">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/8/87/PDF_file_icon.svg"
                                                alt="PDF Icon"
                                                style="width: 35px; height: 40px; object-fit: contain; margin-right: 10px;">
                                            <div>
                                                <div style="font-weight: 500; font-size: 14px; color: #2e3a59;">ID Card Font ...</div>
                                                <div style="font-size: 12px; color: #8c94a3;">94 KB - Date</div>
                                            </div>
                                        </div>
                                        <div style="width: 28px; height: 28px; border: 1px solid #a6aec1; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                            <i class="bi bi-three-dots" style="font-size: 16px; color: #2e3a59;"></i>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- 5 starts -->
                        <div class="mt-2" style="font-family: 'Segoe UI', sans-serif;background-color: #fafcfc; padding: 20px;">
                            <div>
                                <!-- Top Rating -->
                                <div class="d-flex  mb-3">
                                    <h2 class="me-2" style="font-size: 36px; color: #2e3a59;">5</h2>
                                    <!-- Star Rating -->
                                    <div>
                                        <i class="bi bi-star-fill" style="color: #ffc107;"></i>
                                        <i class="bi bi-star-fill" style="color: #ffc107;"></i>
                                        <i class="bi bi-star-fill" style="color: #ffc107;"></i>
                                        <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                        <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                    </div>
                                </div>

                                <!-- Individual Ratings -->
                                <div class="d-grid gap-2">
                                    <!-- One row -->
                                    <div class="d-flex justify-content-between align-items-center p-2"
                                        style="background-color: white;">
                                        <div style="color: #6c7a89;">Reliability</div>
                                        <div>
                                            <i class="bi bi-star-fill" style="color: #ffc107;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                        </div>
                                    </div>

                                    <!-- Repeat for other traits -->
                                    <div class="d-flex justify-content-between align-items-center p-2 rounded"
                                        style="background-color: white;">
                                        <div style="color: #6c7a89;">Accuracy</div>
                                        <div>
                                            <i class="bi bi-star-fill" style="color: #ffc107;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center p-2 rounded"
                                        style="background-color: white;">
                                        <div style="color: #6c7a89;">Punctuality</div>
                                        <div>
                                            <i class="bi bi-star-fill" style="color: #ffc107;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center p-2 rounded"
                                        style="background-color: white;">
                                        <div style="color: #6c7a89;">Quality</div>
                                        <div>
                                            <i class="bi bi-star-fill" style="color: #ffc107;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center p-2 rounded"
                                        style="background-color: white;">
                                        <div style="color: #6c7a89;">Work independent</div>
                                        <div>
                                            <i class="bi bi-star-fill" style="color: #ffc107;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Right Panel: col-9 -->
            <div class="col-md-8 col-sm-12">

                <!-- Our projects -->
                <div style="background-color: #f4f6f8;  border-radius: 12px;padding-left:3px;padding-right:3px;padding-bottom: 0px;" class="mb-2">
                    <div class="row g-1">
                        <div>
                            <h3 class="pb-1 ps-2" style="font-weight: 600;">Our Projects</h3>
                        </div>
                        <div class="col-md-6">
                            <div class="card shadow-sm  p-2" style="border-radius: 20px; font-family:    'Segoe UI', sans-serif;">

                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <!-- Left: Circular Progress -->
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
                                        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 12px; font-weight: bold; color: #f9a825;">
                                            70%
                                        </div>
                                    </div>

                                    <!-- Center: Yekbon Logo -->
                                    <div class="mx-auto">
                                        <img src="{{URL::asset('/build/img/yekbon.svg')}}" class="rounded-circle" style="height: 55px;" alt="Project Logo">
                                    </div>

                                    <!-- Right: Empty space for balance (optional) -->
                                    <div style="width: 45px;"></div>
                                </div>



                                <div class="text-center" style="cursor: pointer;">
                                    <h6 style="cursor: pointer;"
                                        data-bs-toggle="offcanvas"
                                        data-bs-target="#offcanvasRight"
                                        aria-controls="offcanvasRight">
                                        Project Title
                                    </h6>
                                    <!-- Project ID styled exactly like screenshot -->
                                </div>


                                <!-- Progress Status -->
                                <div class="text-center mb-2 d-flex justify-content-center gap-2">
                                    <!-- Status with green dot and soft gray/green background -->
                                    <div style="background: #f1f3f4; border-radius: 12px; display: inline-flex; align-items: center; gap: 6px; padding: 4px 12px;">
                                        <span style="width: 10px; height: 10px; border-radius: 50%; background: #28c76f; display: inline-block;"></span>
                                        <span style="color: #4b5c74; font-weight: 500; font-size: 13px;">Low</span>
                                    </div>
                                    <!-- Red Flag with soft red background -->
                                    <div style="background: #fff3cd; border-radius: 12px; display: inline-flex; align-items: center; justify-content: center; padding: 4px 10px;">
                                        <img src="{{ asset('build/img/yelowflag.svg') }}" style="height: 16px; width: 16px;" alt="flag" />
                                    </div>
                                </div>

                                <div style="font-size: 12px;color: #6c757d;display: flex;justify-content: center;align-items: center;gap: 4px;flex-wrap: wrap;background: #f8f9fa;width: 100%;border-radius: 7px;padding: 6px 12px;text-align: center;">
                                    <div><strong>Ticket ID</strong> | <strong>Section</strong></div>
                                    <div><span style="color: #28c76f;">Start:</span> 22.10.2024</div>
                                    <div><span style="color: #28c76f;">Deliver:</span> 22.10.2024</div>
                                </div>

                                <!-- Section Progress Block -->
                                <div class="flex-grow-1  mt-1" style="min-width: 300px;  background:#f8f9fa;border-radius:10px;">
                                    <!-- Stats -->
                                    <div class="d-flex justify-content-between text-center mb-2">
                                        <div style="flex: 1;">
                                            <div style="font-weight: 600; font-size: 15px; color: #1d6fa5;">Tickets</div>
                                            <div style="font-size: 12px; color: #649bc3;">#1 of #05</div>
                                        </div>
                                        <div style="flex: 1;">
                                            <div style="font-weight: 600; font-size: 15px; color: #1d6fa5;">Total Tasks</div>
                                            <div style="font-size: 13px; color: #649bc3;">#05</div>
                                        </div>
                                        <div style="flex: 1;">
                                            <div style="font-weight: 600; font-size: 15px; color: #1d6fa5;">Days Left</div>
                                            <div style="font-size: 13px; color: #649bc3;">#05</div>
                                        </div>
                                        <div style="flex: 1;">
                                            <div style="font-weight: 600; font-size: 15px; color: #1d6fa5;">Status</div>
                                            <div style="font-size: 13px; color: #649bc3;">75%</div>
                                        </div>
                                    </div>

                                    <!-- Blue Progress Bar -->
                                    <div class="progress w-100" style="height: 8px; background-color: #e9ecef; border-radius: 10px;">
                                        <div class="progress-bar" style="width: 75%; background-color: #4dc3ff; border-radius: 10px;"></div>
                                    </div>
                                </div>


                                <!-- Team & Tickets Info -->
                                <div class="mt-1 py-1" style="background: #f8f9fa; border-radius: 15px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
                                    <!-- Project Manager -->
                                    <div class="text-center" style="flex: 1; min-width: 100px;">
                                        <div style="color: #2b3e5f; font-weight: 600; font-size: 13px;">Project Manager</div>
                                        <img src="{{ asset('build/img/profileuser.svg') }}" alt="PM" class="rounded-circle border border-white shadow-sm"
                                            style="width: 32px; height: 32px; margin-top: 4px;">
                                    </div>

                                    <!-- Developers -->
                                    <div class="text-center" style="flex: 1; min-width: 100px;">
                                        <div style="color: #2b3e5f; font-weight: 600; font-size: 13px;">Developers</div>
                                        <div class="position-relative d-inline-block mt-1" style="height: 32px; width: 80px;">
                                            <img src="{{ asset('build/img/profileuser.svg') }}" class="rounded-circle border border-white shadow-sm"
                                                style="width: 32px; height: 32px; position: absolute; left: 0; z-index: 3;">
                                            <img src="{{ asset('build/img/profileuser.svg') }}" class="rounded-circle border border-white shadow-sm"
                                                style="width: 32px; height: 32px; position: absolute; left: 18px; z-index: 2;">
                                            <img src="{{ asset('build/img/profileuser.svg') }}" class="rounded-circle border border-white shadow-sm"
                                                style="width: 32px; height: 32px; position: absolute; left: 36px; z-index: 1;">
                                        </div>
                                    </div>

                                    <!-- Tickets & Tasks -->
                                    <div class="text-center" style="flex: 1; min-width: 100px;margin-top: -10px;">
                                        <div style="color: #2b3e5f; font-weight: 600; font-size: 13px;">Ticket & Tasks</div>
                                        <div style="font-size: 11px; color: #6c757d; margin-top: 10px;">5 Tickets - 10 Tasks</div>
                                    </div>
                                </div>

                                <!-- sections -->
                                <div class="flex-grow-1 mt-1 " style="background:#f8f9fa;border-radius:10px;">
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

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- card 2 -->
                        <div class="col-md-6">
                            <div class="card shadow-sm  p-2" style="border-radius: 20px; font-family:    'Segoe UI', sans-serif;">

                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <!-- Left: Circular Progress -->
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
                                        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 12px; font-weight: bold; color: #f9a825;">
                                            70%
                                        </div>
                                    </div>

                                    <!-- Center: Yekbon Logo -->
                                    <div class="mx-auto">
                                        <img src="{{URL::asset('/build/img/yekbon.svg')}}" class="rounded-circle" style="height: 55px;" alt="Project Logo">
                                    </div>

                                    <!-- Right: Empty space for balance (optional) -->
                                    <div style="width: 45px;"></div>
                                </div>



                                <div class="text-center" style="cursor: pointer;">
                                    <h6 style="cursor: pointer;"
                                        data-bs-toggle="offcanvas"
                                        data-bs-target="#offcanvasRight"
                                        aria-controls="offcanvasRight">
                                        Project Title
                                    </h6>
                                    <!-- Project ID styled exactly like screenshot -->
                                </div>


                                <!-- Progress Status -->
                                <div class="text-center mb-2 d-flex justify-content-center gap-2">
                                    <!-- Status with green dot and soft gray/green background -->
                                    <div style="background: #f1f3f4; border-radius: 12px; display: inline-flex; align-items: center; gap: 6px; padding: 4px 12px;">
                                        <span style="width: 10px; height: 10px; border-radius: 50%; background: #28c76f; display: inline-block;"></span>
                                        <span style="color: #4b5c74; font-weight: 500; font-size: 13px;">Low</span>
                                    </div>
                                    <!-- Red Flag with soft red background -->
                                    <div style="background: #fff3cd; border-radius: 12px; display: inline-flex; align-items: center; justify-content: center; padding: 4px 10px;">
                                        <img src="{{ asset('build/img/yelowflag.svg') }}" style="height: 16px; width: 16px;" alt="flag" />
                                    </div>
                                </div>

                                <div style="font-size: 12px;color: #6c757d;display: flex;justify-content: center;align-items: center;gap: 4px;flex-wrap: wrap;background: #f8f9fa;width: 100%;border-radius: 7px;padding: 6px 12px;text-align: center;">
                                    <div><strong>Ticket ID</strong> | <strong>Section</strong></div>
                                    <div><span style="color: #28c76f;">Start:</span> 22.10.2024</div>
                                    <div><span style="color: #28c76f;">Deliver:</span> 22.10.2024</div>
                                </div>

                                <!-- Section Progress Block -->
                                <div class="flex-grow-1  mt-1" style="min-width: 300px;  background:#f8f9fa;border-radius:10px;">
                                    <!-- Stats -->
                                    <div class="d-flex justify-content-between text-center mb-2">
                                        <div style="flex: 1;">
                                            <div style="font-weight: 600; font-size: 15px; color: #1d6fa5;">Tickets</div>
                                            <div style="font-size: 12px; color: #649bc3;">#1 of #05</div>
                                        </div>
                                        <div style="flex: 1;">
                                            <div style="font-weight: 600; font-size: 15px; color: #1d6fa5;">Total Tasks</div>
                                            <div style="font-size: 13px; color: #649bc3;">#05</div>
                                        </div>
                                        <div style="flex: 1;">
                                            <div style="font-weight: 600; font-size: 15px; color: #1d6fa5;">Days Left</div>
                                            <div style="font-size: 13px; color: #649bc3;">#05</div>
                                        </div>
                                        <div style="flex: 1;">
                                            <div style="font-weight: 600; font-size: 15px; color: #1d6fa5;">Status</div>
                                            <div style="font-size: 13px; color: #649bc3;">75%</div>
                                        </div>
                                    </div>

                                    <!-- Blue Progress Bar -->
                                    <div class="progress w-100" style="height: 8px; background-color: #e9ecef; border-radius: 10px;">
                                        <div class="progress-bar" style="width: 75%; background-color: #4dc3ff; border-radius: 10px;"></div>
                                    </div>
                                </div>


                                <!-- Team & Tickets Info -->
                                <div class="mt-1 py-1" style="background: #f8f9fa; border-radius: 15px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
                                    <!-- Project Manager -->
                                    <div class="text-center" style="flex: 1; min-width: 100px;">
                                        <div style="color: #2b3e5f; font-weight: 600; font-size: 13px;">Project Manager</div>
                                        <img src="{{ asset('build/img/profileuser.svg') }}" alt="PM" class="rounded-circle border border-white shadow-sm"
                                            style="width: 32px; height: 32px; margin-top: 4px;">
                                    </div>

                                    <!-- Developers -->
                                    <div class="text-center" style="flex: 1; min-width: 100px;">
                                        <div style="color: #2b3e5f; font-weight: 600; font-size: 13px;">Developers</div>
                                        <div class="position-relative d-inline-block mt-1" style="height: 32px; width: 80px;">
                                            <img src="{{ asset('build/img/profileuser.svg') }}" class="rounded-circle border border-white shadow-sm"
                                                style="width: 32px; height: 32px; position: absolute; left: 0; z-index: 3;">
                                            <img src="{{ asset('build/img/profileuser.svg') }}" class="rounded-circle border border-white shadow-sm"
                                                style="width: 32px; height: 32px; position: absolute; left: 18px; z-index: 2;">
                                            <img src="{{ asset('build/img/profileuser.svg') }}" class="rounded-circle border border-white shadow-sm"
                                                style="width: 32px; height: 32px; position: absolute; left: 36px; z-index: 1;">
                                        </div>
                                    </div>

                                    <!-- Tickets & Tasks -->
                                    <div class="text-center" style="flex: 1; min-width: 100px;margin-top: -10px;">
                                        <div style="color: #2b3e5f; font-weight: 600; font-size: 13px;">Ticket & Tasks</div>
                                        <div style="font-size: 11px; color: #6c757d; margin-top: 10px;">5 Tickets - 10 Tasks</div>
                                    </div>
                                </div>

                                <!-- sections -->
                                <div class="flex-grow-1 mt-1 " style="background:#f8f9fa;border-radius:10px;">
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

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- Total projects -->
                <div style="background-color: #f7f7f7; padding: 16px; border-radius: 12px; font-family: 'Segoe UI', sans-serif;">
                    <div class="d-flex justify-content-between align-items-start mb-3">

                        <!-- Left Icon -->
                        <img src="{{ asset('build/img/lato.svg') }}" alt="Icon" style="width: 50px; height: auto;">

                        <!-- Project Summary -->
                        <div style="background-color: white;border-radius:6px;padding:5px;">
                            <div style="font-size: 15px; font-weight: 600; color: #2e3a59;">Total projects</div>
                            <div class="d-flex gap-2 mt-1 flex-wrap">

                                <!-- Project Tag 1 -->
                                <div class="d-flex align-items-center gap-1" style="background: #f7f7f7; padding: 4px 8px; border-radius: 8px; font-size: 13px;">
                                    <img src="{{URL::asset('/build/img/yekbon.svg')}}" style="width: 16px;" alt="">
                                    <span>Project Title</span>
                                    <span style="background:#ff4d4f; color: #fff; border-radius: 10px; padding: 0 6px; font-size: 10px;">1</span>
                                    <span style="background:#ffff; border-radius: 10px; padding: 0 6px; font-size: 13px;">Ticket</span>
                                </div>

                                <!-- Project Tag 2 -->
                                <div class="d-flex align-items-center gap-1" style="background: #f7f7f7; padding: 4px 8px; border-radius: 8px; font-size: 13px;">
                                    <img src="{{URL::asset('/build/img/yekbon.svg')}}" style="width: 16px;" alt="">
                                    <span>Project Title</span>
                                    <span style="background:#ff4d4f; color: #fff; border-radius: 10px; padding: 0 6px; font-size: 13px;">1</span>
                                    <span style="background:#ffff; border-radius: 10px; padding: 0 6px; font-size: 10px;">Ticket</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Task Status Cards -->
                    <div class="d-flex justify-content-start" style="background:#fff; border-radius: 10px; padding: 5px; padding-left: 1px;">
                        <!-- Card Template -->
                        <div style="flex: 1; min-width: 80px; border-right: 3px solid #e2e8f0; padding: 0 8px;">
                            <img src="{{ asset('build/img/newtask.svg') }}" style="width: 26px;" alt="">
                            <div style="font-size: 12px; color: #4b5c74; margin-top: 4px;">New Task</div>
                            <div style="font-weight: 600; font-size: 13px;">2</div>
                        </div>

                        <div style="flex: 1; min-width: 80px;  border-right: 3px solid #e2e8f0; padding: 0 8px;">
                            <img src="{{ asset('build/img/totaltask.svg') }}" style="width: 26px;" alt="">
                            <div style="font-size: 12px; color: #4b5c74; margin-top: 4px;">Total Tasks</div>
                            <div style="font-weight: 600; font-size: 13px;">2</div>
                        </div>

                        <div style="flex: 1; min-width: 80px; border-right: 3px solid #e2e8f0; padding: 0 8px;">
                            <img src="{{ asset('build/img/progress.svg') }}" style="width: 26px;" alt="">
                            <div style="font-size: 12px; color: #4b5c74; margin-top: 4px;">Progress</div>
                            <div style="font-weight: 600; font-size: 13px;">2</div>
                        </div>

                        <div style="flex: 1; min-width: 80px; border-right: 3px solid #e2e8f0; padding: 0 8px;">
                            <img src="{{ asset('build/img/inhold.svg') }}" style="width: 26px;" alt="">
                            <div style="font-size: 12px; color: #4b5c74; margin-top: 4px;">In Hold</div>
                            <div style="font-weight: 600; font-size: 13px;">2</div>
                        </div>

                        <div style="flex: 1; min-width: 80px; border-right: 3px solid #e2e8f0; padding: 0 8px;">
                            <img src="{{ asset('build/img/incheck.svg') }}" style="width: 26px;" alt="">
                            <div style="font-size: 12px; color: #4b5c74; margin-top: 4px;">In Check</div>
                            <div style="font-weight: 600; font-size: 13px;">2</div>
                        </div>

                        <div style="flex: 1; min-width: 80px; border-right: 3px solid #e2e8f0; padding: 0 8px;">
                            <img src="{{ asset('build/img/delayed.svg') }}" style="width: 26px;" alt="">
                            <div style="font-size: 12px; color: #4b5c74; margin-top: 4px;">Delayed</div>
                            <div style="font-weight: 600; font-size: 13px;">2</div>
                        </div>

                        <!-- Last item: No border-right -->
                        <div style="flex: 1; min-width: 80px; padding: 0 8px;">
                            <img src="{{ asset('build/img/rejected.svg') }}" style="width: 26px;" alt="">
                            <div style="font-size: 12px; color: #4b5c74; margin-top: 4px;">Rejected</div>
                            <div style="font-weight: 600; font-size: 13px;">2</div>
                        </div>
                    </div>

                </div>
                <!-- reminder -->
                <div class="mt-2 pt-2" style="background-color: #f7f7f7; padding: 16px; border-radius: 12px; font-family: 'Segoe UI', sans-serif;padding-bottom: 35px;">
                    <div class="d-flex align-items-center" style="gap: 8px; font-family: 'Segoe UI', sans-serif;">
                        <img src="{{ asset('build/img/bell.svg') }}" style="width: 30px;" alt="Reminder Icon">
                        <div>
                            <div style="font-weight: 600; font-size: 18px; color: #0f1b3d;">Reminder</div>
                            <div style="font-size: 13px; color: #4b5563;">15 Member</div>
                        </div>
                    </div>
                    <!-- Ticket Title + Status and Metrics -->
                    <div class="d-flex justify-content-between align-items-start flex-wrap " style="margin-bottom: 16px;background:#fff;padding: 10px;border-radius: 10px;">
                        <!-- Ticket Title & Status -->
                        <div style="background:#fff">
                            <!-- Ticket Title -->
                            <div class="d-flex justify-content-between  mb-3">
                                <!-- Ticket Title on the left -->
                                <div style="font-weight: 600; font-size: 16px; color: #2e3a59;">
                                    Task Title
                                </div>

                                <!-- Status badges on the right -->
                                <div class="d-flex align-items-center gap-2" style="margin-left: 14px;">
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
                                <div style="background: #f8f9fa; border-radius: 10px; padding: 10px 7px; flex-grow: 1; max-width: 100%;">
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
                    <div style="font-size: 10px; color: #6c757d; display: flex; gap: 8px; flex-wrap: wrap;margin-top:-58px;margin-left:5px;background:#f8f9fa;width:323px;border-radius:7px;width:fit-content;padding-bottom:3px;padding-left:3px;padding-right:3px;padding-top:2px;">
                        <div><strong>Ticket ID</strong> | <strong>Section |</strong></div>
                        <div><span style="color: #28c76f;">Start:</span> 22.10.2024 |</div>
                        <div><span style="color: #28c76f;">Deliver:</span> 22.10.2024</div>
                    </div>

                </div>

                <!-- Assigned Tickets -->
                <div class="mt-2 pt-2" style="background-color: #f7f7f7; padding: 16px; border-radius: 12px; font-family: 'Segoe UI', sans-serif;padding-bottom: 35px;">
                    <div class="d-flex align-items-center" style="gap: 8px; font-family: 'Segoe UI', sans-serif;">
                        <img src="{{ asset('build/img/inhold.svg') }}" style="width: 30px;" alt="Reminder Icon">
                        <div>
                            <div style="font-weight: 600; font-size: 18px; color: #0f1b3d;">Assigned Tickets</div>
                            <div style="font-size: 13px; color: #4b5563;">3 Tickets</div>
                        </div>
                    </div>
                    <!-- Ticket Title + Status and Metrics -->
                    <div class="d-flex justify-content-between align-items-start flex-wrap " style="margin-bottom: 16px;background:#fff;border-radius: 10px;">
                        <!-- Ticket Title & Status -->
                        <div style="background:#fff">
                            <!-- Ticket Title -->
                            <div class="d-flex justify-content-between  mb-3">
                                <!-- Ticket Title on the left -->
                                <div style="font-weight: 600; font-size: 16px; color: #2e3a59;">
                                    Ticket Title
                                </div>

                                <!-- Status badges on the right -->
                                <div class="d-flex align-items-center">
                                    <!-- Red Badge with Lightning Icon -->
                                    <span style="display: inline-flex; align-items: center; border-radius: 8px; overflow: hidden; font-weight: 600; font-size: 12px;">

                                        <!-- Left icon area -->
                                        <span style=" padding: 6px 8px; display: flex; align-items: center;">
                                            <img src="{{ asset('build/img/yekbon.svg') }}" alt="Icon" width="20" height="20" />
                                        </span>

                                        <!-- Red badge area -->
                                        <div style="background: #fddede; border-radius: 12px; display: inline-flex; align-items: center; justify-content: center; padding: 4px 10px;">
                                            <img src="{{URL::asset('/build/img/redflag.svg')}}" style="height: 16px; width: 16px;" alt="flag" />
                                        </div>

                                    </span>


                                    <!-- Low Badge with Green Dot -->
                                    <span style="display: inline-flex; align-items: center; gap: 6px; background: #f3f4f6; color: #8F98A0; font-weight: 600; font-size: 12px; padding: 4px 10px; border-radius: 20px;">
                                        <span style="width: 10px; height: 10px; border-radius: 50%; background: #28c76f; display: inline-block;"></span>
                                        LOW
                                    </span>

                                    <!-- Yellow Badge with Flag -->


                                    <!--  -->
                                    <span class="position-relative d-inline-block mt-1" style="height: 32px; width: 80px;">
                                        <img src="{{ asset('build/img/profileuser.svg') }}" class="rounded-circle border border-white shadow-sm"
                                            style="width: 32px; height: 32px; position: absolute; left: 0; z-index: 3;">
                                        <img src="{{ asset('build/img/profileuser.svg') }}" class="rounded-circle border border-white shadow-sm"
                                            style="width: 32px; height: 32px; position: absolute; left: 18px; z-index: 2;">

                                    </span>
                                </div>

                            </div>

                        </div>

                        <!-- Ticket Metrics Box -->
                        <div style="max-width: 450px;">
                            <div class="d-flex align-items-center gap-3 mt-md-0 flex-wrap">
                                <!-- Metrics Box -->
                                <div style="background: #f8f9fa; border-radius: 10px; padding: 10px 3px; flex-grow: 1; max-width: 100%;margin-bottom: 9px; margin-top: 4px; margin-right: 4px;">
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
                    <div style="font-size: 10px; color: #6c757d; display: flex; gap: 8px; flex-wrap: wrap;margin-top:-58px;margin-left:5px;background:#f8f9fa;width:323px;border-radius:7px;width:fit-content;padding-bottom:3px;padding-left:3px;padding-right:3px;padding-top:2px;">
                        <div><strong>Ticket ID</strong> | <strong>Section |</strong></div>
                        <div><span style="color: #28c76f;">Start:</span> 22.10.2024 |</div>
                        <div><span style="color: #28c76f;">Deliver:</span> 22.10.2024</div>

                    </div>
                    <div class="d-flex justify-content-center mt-3 mb-3" style="background-color: #fff;padding:3px;border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                        <div class="d-flex align-items-center gap-2 px-3 py-2 rounded" style="background-color: #fdf6ec; font-size: 12px; border-radius: 10px;margin-bottom:6px;">

                            <!-- Avatar and Username -->
                            <div class="d-flex align-items-center gap-2">
                                <img src="https://i.pravatar.cc/28" class="rounded-circle" width="28" height="28" alt="Avatar">
                                <span style="color: #000; font-weight: 500;">Username</span>
                            </div>

                            <!-- Start Date -->
                            <div style="color: #22c55e;">
                                <strong>Start:</strong> 22.10.2024
                            </div>

                            <!-- Deliver Date -->
                            <div style="color: #ef4444;">
                                <strong>Deliver:</strong> 22.10.2024
                            </div>

                            <!-- Reason -->
                            <div style="color: #ef4444;">
                                <strong>! We will get the reason here</strong>
                            </div>

                        </div>
                    </div>
                    <!-- 2 -->
                    <!-- Ticket Title + Status and Metrics -->
                    <div class="d-flex justify-content-between align-items-start flex-wrap " style="margin-bottom: 16px;background:#fff;border-radius: 10px;">
                        <!-- Ticket Title & Status -->
                        <div style="background:#fff">
                            <!-- Ticket Title -->
                            <div class="d-flex justify-content-between  mb-3">
                                <!-- Ticket Title on the left -->
                                <div style="font-weight: 600; font-size: 16px; color: #2e3a59;">
                                    Ticket Title
                                </div>

                                <!-- Status badges on the right -->
                                <div class="d-flex align-items-center">
                                    <!-- Red Badge with Lightning Icon -->
                                    <span style="display: inline-flex; align-items: center; border-radius: 8px; overflow: hidden; font-weight: 600; font-size: 12px;">

                                        <!-- Left icon area -->
                                        <span style=" padding: 6px 8px; display: flex; align-items: center;">
                                            <img src="{{ asset('build/img/yekbon.svg') }}" alt="Icon" width="20" height="20" />
                                        </span>

                                        <!-- Red badge area -->
                                        <div style="background: #fddede; border-radius: 12px; display: inline-flex; align-items: center; justify-content: center; padding: 4px 10px;">
                                            <img src="{{URL::asset('/build/img/redflag.svg')}}" style="height: 16px; width: 16px;" alt="flag" />
                                        </div>

                                    </span>


                                    <!-- Low Badge with Green Dot -->
                                    <span style="display: inline-flex; align-items: center; gap: 6px; background: #f3f4f6; color: #8F98A0; font-weight: 600; font-size: 12px; padding: 4px 10px; border-radius: 20px;">
                                        <span style="width: 10px; height: 10px; border-radius: 50%; background: #28c76f; display: inline-block;"></span>
                                        LOW
                                    </span>

                                    <!-- Yellow Badge with Flag -->


                                    <!--  -->
                                    <span class="position-relative d-inline-block mt-1" style="height: 32px; width: 80px;">
                                        <img src="{{ asset('build/img/profileuser.svg') }}" class="rounded-circle border border-white shadow-sm"
                                            style="width: 32px; height: 32px; position: absolute; left: 0; z-index: 3;">
                                        <img src="{{ asset('build/img/profileuser.svg') }}" class="rounded-circle border border-white shadow-sm"
                                            style="width: 32px; height: 32px; position: absolute; left: 18px; z-index: 2;">

                                    </span>
                                </div>

                            </div>

                        </div>

                        <!-- Ticket Metrics Box -->
                        <div style="max-width: 450px;">
                            <div class="d-flex align-items-center gap-3 mt-md-0 flex-wrap">
                                <!-- Metrics Box -->
                                <div style="background: #f8f9fa; border-radius: 10px; padding: 10px 3px; flex-grow: 1; max-width: 100%;margin-bottom: 9px; margin-top: 4px; margin-right: 4px;">
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
                    <div style="font-size: 10px; color: #6c757d; display: flex; gap: 8px; flex-wrap: wrap;margin-top:-58px;margin-left:5px;background:#f8f9fa;width:323px;border-radius:7px;width:fit-content;padding-bottom:3px;padding-left:3px;padding-right:3px;padding-top:2px;">
                        <div><strong>Ticket ID</strong> | <strong>Section |</strong></div>
                        <div><span style="color: #28c76f;">Start:</span> 22.10.2024 |</div>
                        <div><span style="color: #28c76f;">Deliver:</span> 22.10.2024</div>

                    </div>
                    <div class="d-flex justify-content-center mt-3 mb-3" style="background-color: #fff;padding:3px;border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                        <div class="d-flex align-items-center gap-2 px-3 py-2 rounded" style="background-color: #fdf6ec; font-size: 12px; border-radius: 10px;margin-bottom:6px;">

                            <!-- Avatar and Username -->
                            <div class="d-flex align-items-center gap-2">
                                <img src="https://i.pravatar.cc/28" class="rounded-circle" width="28" height="28" alt="Avatar">
                                <span style="color: #000; font-weight: 500;">Username</span>
                            </div>

                            <!-- Start Date -->
                            <div style="color: #22c55e;">
                                <strong>Start:</strong> 22.10.2024
                            </div>

                            <!-- Deliver Date -->
                            <div style="color: #ef4444;">
                                <strong>Deliver:</strong> 22.10.2024
                            </div>

                            <!-- Reason -->
                            <div style="color: #ef4444;">
                                <strong>! We will get the reason here</strong>
                            </div>

                        </div>
                    </div>
                </div>
                <!--new tasks -->
                <div class="mt-2 pt-2" style="background-color: #f7f7f7; padding: 16px; border-radius: 12px; font-family: 'Segoe UI', sans-serif;padding-bottom: 35px;">
                    <div class="d-flex align-items-center" style="gap: 8px; font-family: 'Segoe UI', sans-serif;">
                        <img src="{{ asset('build/img/newtask.svg') }}" style="width: 30px;" alt="Reminder Icon">
                        <div>
                            <div style="font-weight: 600; font-size: 18px; color: #0f1b3d;">New Tasks</div>
                            <div style="font-size: 13px; color: #4b5563;">15 Member</div>
                        </div>
                    </div>
                    <!-- Ticket Title + Status and Metrics -->
                    <div class="d-flex justify-content-between align-items-start flex-wrap " style="margin-bottom: 16px;background:#fff;padding: 10px;border-radius: 10px;">
                        <!-- Ticket Title & Status -->
                        <div style="background:#fff">
                            <!-- Ticket Title -->
                            <div class="d-flex justify-content-between  mb-3">
                                <!-- Ticket Title on the left -->
                                <div style="font-weight: 600; font-size: 16px; color: #2e3a59;">
                                    Task Title
                                </div>

                                <!-- Status badges on the right -->
                                <div class="d-flex align-items-center gap-2" style="margin-left: 14px;">
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
                                    <span style="display: inline-flex; align-items: center; background: #e1effe; padding: 4px 8px; border-radius: 10px;">

                                        <span>
                                            <img src="{{ asset('build/img/blueflag.svg') }}" alt="Icon" width="14" height="14" />
                                        </span>
                                    </span>
                                </div>

                            </div>

                        </div>

                        <!-- Ticket Metrics Box -->
                        <div style="max-width: 450px;">

                            <div class="d-flex align-items-center gap-3 mt-md-0 flex-wrap">
                                <!-- Metrics Box -->
                                <div style="background: #f8f9fa; border-radius: 10px; padding: 10px 7px; flex-grow: 1; max-width: 100%;">
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
                    <div style="font-size: 10px; color: #6c757d; display: flex; gap: 8px; flex-wrap: wrap;margin-top:-58px;margin-left:5px;background:#f8f9fa;width:323px;border-radius:7px;width:fit-content;padding-bottom:3px;padding-left:3px;padding-right:3px;padding-top:2px;">
                        <div><strong>Ticket ID</strong> | <strong>Section |</strong></div>
                        <div><span style="color: #28c76f;">Start:</span> 22.10.2024 |</div>
                        <div><span style="color: #28c76f;">Deliver:</span> 22.10.2024</div>
                    </div>

                </div>
                <!-- task in progress -->
                <div class="mt-2 pt-2" style="background-color: #f7f7f7; padding: 16px; border-radius: 12px; font-family: 'Segoe UI', sans-serif;padding-bottom: 35px;">
                    <div class="d-flex align-items-center" style="gap: 8px; font-family: 'Segoe UI', sans-serif;">
                        <img src="{{ asset('build/img/progress.svg') }}" style="width: 30px;" alt="Reminder Icon">
                        <div>
                            <div style="font-weight: 600; font-size: 18px; color: #0f1b3d;">Tasks in Progress</div>
                            <div style="font-size: 13px; color: #4b5563;">3 Tasks</div>
                        </div>
                    </div>
                    <!-- Ticket Title + Status and Metrics -->
                    <div class="d-flex justify-content-between align-items-start flex-wrap " style="margin-bottom: 16px;background:#fff;padding: 10px;border-radius: 10px;">
                        <!-- Ticket Title & Status -->
                        <div style="background:#fff">
                            <!-- Ticket Title -->
                            <div class="d-flex justify-content-between  mb-3">
                                <!-- Ticket Title on the left -->
                                <div style="font-weight: 600; font-size: 16px; color: #2e3a59;">
                                    Task Title
                                </div>

                                <!-- Status badges on the right -->
                                <div class="d-flex align-items-center gap-2" style="margin-left: 14px;">
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
                                    <span style="display: inline-flex; align-items: center; background: #ecfbdc; padding: 4px 8px; border-radius: 10px;">

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
                                <div style="background: #f8f9fa; border-radius: 10px; padding: 10px 7px; flex-grow: 1; max-width: 100%;">
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
                    <div style="font-size: 10px; color: #6c757d; display: flex; gap: 8px; flex-wrap: wrap;margin-top:-58px;margin-left:5px;background:#f8f9fa;width:323px;border-radius:7px;width:fit-content;padding-bottom:3px;padding-left:3px;padding-right:3px;padding-top:2px;">
                        <div><strong>Ticket ID</strong> | <strong>Section |</strong></div>
                        <div><span style="color: #28c76f;">Start:</span> 22.10.2024 |</div>
                        <div><span style="color: #28c76f;">Deliver:</span> 22.10.2024</div>
                    </div>

                </div>
                <!-- task in hold -->
                <div class="mt-2 pt-2" style="background-color: #f7f7f7; padding: 16px; border-radius: 12px; font-family: 'Segoe UI', sans-serif;padding-bottom: 35px;">
                    <div class="d-flex align-items-center" style="gap: 8px; font-family: 'Segoe UI', sans-serif;">
                        <img src="{{ asset('build/img/inhold.svg') }}" style="width: 30px;" alt="Reminder Icon">
                        <div>
                            <div style="font-weight: 600; font-size: 18px; color: #0f1b3d;">Task in Hold</div>
                            <div style="font-size: 13px; color: #4b5563;">15 Member</div>
                        </div>
                    </div>
                    <!-- Ticket Title + Status and Metrics -->
                    <div class="d-flex justify-content-between align-items-start flex-wrap " style="margin-bottom: 16px;background:#fff;padding: 10px;border-radius: 10px;">
                        <!-- Ticket Title & Status -->
                        <div style="background:#fff">
                            <!-- Ticket Title -->
                            <div class="d-flex justify-content-between  mb-3">
                                <!-- Ticket Title on the left -->
                                <div style="font-weight: 600; font-size: 16px; color: #2e3a59;">
                                    Task Title
                                </div>

                                <!-- Status badges on the right -->
                                <div class="d-flex align-items-center gap-2" style="margin-left: 14px;">
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
                                    <span style="display: inline-flex; align-items: center; background: #e1effe; padding: 4px 8px; border-radius: 10px;">

                                        <span>
                                            <img src="{{ asset('build/img/blueflag.svg') }}" alt="Icon" width="14" height="14" />
                                        </span>
                                    </span>
                                </div>

                            </div>

                        </div>

                        <!-- Ticket Metrics Box -->
                        <div style="max-width: 450px;">
                            <div class="d-flex align-items-center gap-3 mt-md-0 flex-wrap">
                                <!-- Metrics Box -->
                                <div style="background: #f8f9fa; border-radius: 10px; padding: 10px 7px; flex-grow: 1; max-width: 100%;">
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
                    <div style="font-size: 10px; color: #6c757d; display: flex; gap: 8px; flex-wrap: wrap;margin-top:-58px;margin-left:5px;background:#f8f9fa;width:323px;border-radius:7px;width:fit-content;padding-bottom:3px;padding-left:3px;padding-right:3px;padding-top:2px;">
                        <div><strong>Ticket ID</strong> | <strong>Section |</strong></div>
                        <div><span style="color: #28c76f;">Start:</span> 22.10.2024 |</div>
                        <div><span style="color: #28c76f;">Deliver:</span> 22.10.2024</div>

                    </div>


                    <div class="d-flex justify-content-center mt-3" style="background-color: #fff;padding:3px;border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                        <div class="d-flex align-items-center gap-2 px-3 py-2 rounded" style="background-color: #fdf6ec; font-size: 12px; border-radius: 10px;margin-bottom:6px;">

                            <!-- Avatar and Username -->
                            <div class="d-flex align-items-center gap-2">
                                <img src="https://i.pravatar.cc/28" class="rounded-circle" width="28" height="28" alt="Avatar">
                                <span style="color: #000; font-weight: 500;">Username</span>
                            </div>

                            <!-- Start Date -->
                            <div style="color: #22c55e;">
                                <strong>Start:</strong> 22.10.2024
                            </div>

                            <!-- Deliver Date -->
                            <div style="color: #ef4444;">
                                <strong>Deliver:</strong> 22.10.2024
                            </div>

                            <!-- Reason -->
                            <div style="color: #ef4444;">
                                <strong>! We will get the reason here</strong>
                            </div>

                        </div>
                    </div>

                </div>
                <!-- task in check -->
                <div class="mt-2 pt-2" style="background-color: #f7f7f7; padding: 16px; border-radius: 12px; font-family: 'Segoe UI', sans-serif;padding-bottom: 35px;">
                    <div class="d-flex align-items-center" style="gap: 8px; font-family: 'Segoe UI', sans-serif;">
                        <img src="{{ asset('build/img/incheck.svg') }}" style="width: 30px;" alt="Reminder Icon">
                        <div>
                            <div style="font-weight: 600; font-size: 18px; color: #0f1b3d;">Tasks in Check</div>
                            <div style="font-size: 13px; color: #4b5563;">3 Tasks</div>
                        </div>
                    </div>
                    <!-- Ticket Title + Status and Metrics -->
                    <div class="d-flex justify-content-between align-items-start flex-wrap " style="margin-bottom: 16px;background:#fff;padding: 10px;border-radius: 10px;">
                        <!-- Ticket Title & Status -->
                        <div style="background:#fff">
                            <!-- Ticket Title -->
                            <div class="d-flex justify-content-between  mb-3">
                                <!-- Ticket Title on the left -->
                                <div style="font-weight: 600; font-size: 16px; color: #2e3a59;">
                                    Task Title
                                </div>

                                <!-- Status badges on the right -->
                                <div class="d-flex align-items-center gap-2" style="margin-left: 14px;">
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
                                    <span style="display: inline-flex; align-items: center; background: #ecfbdc; padding: 4px 8px; border-radius: 10px;">

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
                                <div style="background: #f8f9fa; border-radius: 10px; padding: 10px 7px; flex-grow: 1; max-width: 100%;">
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
                    <div style="font-size: 10px; color: #6c757d; display: flex; gap: 8px; flex-wrap: wrap;margin-top:-58px;margin-left:5px;background:#f8f9fa;width:323px;border-radius:7px;width:fit-content;padding-bottom:3px;padding-left:3px;padding-right:3px;padding-top:2px;">
                        <div><strong>Ticket ID</strong> | <strong>Section |</strong></div>
                        <div><span style="color: #28c76f;">Start:</span> 22.10.2024 |</div>
                        <div><span style="color: #28c76f;">Deliver:</span> 22.10.2024</div>
                    </div>

                </div>
                <!-- Rejected -->
                <div class="mt-2 pt-2" style="background-color: #f7f7f7; padding: 16px; border-radius: 12px; font-family: 'Segoe UI', sans-serif;padding-bottom: 35px;">
                    <div class="d-flex align-items-center" style="gap: 8px; font-family: 'Segoe UI', sans-serif;">
                        <img src="{{ asset('build/img/inhold.svg') }}" style="width: 30px;" alt="Reminder Icon">
                        <div>
                            <div style="font-weight: 600; font-size: 18px; color: #0f1b3d;">Rejected Task</div>
                            <div style="font-size: 13px; color: #4b5563;">3 Task</div>
                        </div>
                    </div>
                    <!-- Ticket Title + Status and Metrics -->
                    <div class="d-flex justify-content-between align-items-start flex-wrap " style="margin-bottom: 16px;background:#fff;padding: 10px;border-radius: 10px;">
                        <!-- Ticket Title & Status -->
                        <div style="background:#fff">
                            <!-- Ticket Title -->
                            <div class="d-flex justify-content-between  mb-3">
                                <!-- Ticket Title on the left -->
                                <div style="font-weight: 600; font-size: 16px; color: #2e3a59;">
                                    Task Title
                                </div>

                                <!-- Status badges on the right -->
                                <div class="d-flex align-items-center gap-2" style="margin-left: 14px;">
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
                                    <span style="display: inline-flex; align-items: center; background: #e1effe; padding: 4px 8px; border-radius: 10px;">

                                        <span>
                                            <img src="{{ asset('build/img/blueflag.svg') }}" alt="Icon" width="14" height="14" />
                                        </span>
                                    </span>
                                </div>

                            </div>

                        </div>

                        <!-- Ticket Metrics Box -->
                        <div style="max-width: 450px;">
                            <div class="d-flex align-items-center gap-3 mt-md-0 flex-wrap">
                                <!-- Metrics Box -->
                                <div style="background: #f8f9fa; border-radius: 10px; padding: 10px 7px; flex-grow: 1; max-width: 100%;">
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
                    <div style="font-size: 10px; color: #6c757d; display: flex; gap: 8px; flex-wrap: wrap;margin-top:-58px;margin-left:5px;background:#f8f9fa;width:323px;border-radius:7px;width:fit-content;padding-bottom:3px;padding-left:3px;padding-right:3px;padding-top:2px;">
                        <div><strong>Ticket ID</strong> | <strong>Section |</strong></div>
                        <div><span style="color: #28c76f;">Start:</span> 22.10.2024 |</div>
                        <div><span style="color: #28c76f;">Deliver:</span> 22.10.2024</div>

                    </div>


                    <div class="d-flex justify-content-center mt-3" style="background-color: #fff;padding:3px;border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                        <div class="d-flex align-items-center gap-2 px-3 py-2 rounded" style="background-color: #fdf6ec; font-size: 12px; border-radius: 10px;margin-bottom:6px;">

                            <!-- Avatar and Username -->
                            <div class="d-flex align-items-center gap-2">
                                <img src="https://i.pravatar.cc/28" class="rounded-circle" width="28" height="28" alt="Avatar">
                                <span style="color: #000; font-weight: 500;">Username</span>
                            </div>

                            <!-- Start Date -->
                            <div style="color: #22c55e;">
                                <strong>Start:</strong> 22.10.2024
                            </div>

                            <!-- Deliver Date -->
                            <div style="color: #ef4444;">
                                <strong>Deliver:</strong> 22.10.2024
                            </div>

                            <!-- Reason -->
                            <div style="color: #ef4444;">
                                <strong>! We will get the reason here</strong>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Statistics Content -->

    </div>
    <div id="statisticsContent" class="toggle-content" style="display: none;">
        <div class="row m-0  py-2">
            <!-- Left Panel: col-3 -->
            <div class="col-lg-4 col-md-8 col-sm-12">
                <!-- Add left side profile card/info -->
                <div class="card mb-3">
                    <div style=" font-family: 'Segoe UI', sans-serif;">
                        <!-- Header with Blue Background -->
                        <div style="background: linear-gradient(to right, #1565c0, #4fc3f7); height: 140px; position: relative; border-top-left-radius: 10px; border-top-right-radius: 10px;"></div>

                        <!-- Info Section Background -->
                        <div style="background-color: #fafcfc; padding: 20px; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                            <!-- Profile Image (Overlapping) -->
                            <div style="position: relative; margin-top: -60px; text-align: center;">
                                <img src="{{URL::asset('/build/img/profileuser.svg')}}" alt="Profile" style="width: 100px; height: 100px; border-radius: 50%; border: 4px solid white; object-fit: cover; box-shadow: 0 0 8px rgba(0,0,0,0.2);">
                                <h5 class="mt-2 mb-1">Name Lastname</h5>
                                <span class="badge bg-light text-danger" style="font-size: 12px;">Developer</span>
                            </div>
                            <!-- Info Rows -->
                            <div class="card mb-2 p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><i class="bi bi-gender-ambiguous me-2"></i> Gender</div>
                                    <div class="fw-bold">Female</div>
                                </div>
                            </div>

                            <div class="card mb-2 p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><i class="bi bi-person-badge me-2"></i> User ID</div>
                                    <div class="fw-bold">Ticket ID</div>
                                </div>
                            </div>

                            <div class="card mb-2 p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><i class="bi bi-geo-alt me-2"></i> Country</div>
                                    <div class="fw-bold">Pakistan</div>
                                </div>
                            </div>

                            <div class="card mb-2 p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><i class="bi bi-people me-2"></i> Team</div>
                                    <div class="fw-bold">Ticket ID</div>
                                </div>
                            </div>

                            <div class="card mb-2 p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><i class="bi bi-calendar-check me-2"></i> Join Date</div>
                                    <div class="fw-bold">Ticket ID</div>
                                </div>
                            </div>

                            <div class="card mb-2 p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><i class="bi bi-telephone me-2"></i> Phone</div>
                                    <div class="fw-bold">Ticket ID</div>
                                </div>
                            </div>

                            <div class="card mb-2 p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><i class="bi bi-envelope me-2"></i> E-Mail</div>
                                    <div class="fw-bold">Ticket ID</div>
                                </div>
                            </div>

                            <div class="card mb-2 p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><i class="bi bi-chat-dots me-2"></i> Message</div>
                                    <div class="fw-bold text-primary">@LogiTeam</div>
                                </div>
                            </div>





                        </div>

                        <!-- pdf -->

                        <div class="mt-2" style="background-color: #fafcfc; padding: 20px;">
                            <h6 class="mb-3" style="color: #6c7a89;">Documents</h6>
                            <div class="row">
                                <!-- Document Card -->
                                <div class="col-12 mb-3">
                                    <div class="d-flex justify-content-between align-items-center p-2 rounded"
                                        style="background-color: white; box-shadow: 0 0 6px rgba(0,0,0,0.05);">
                                        <div class="d-flex align-items-center">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/8/87/PDF_file_icon.svg"
                                                alt="PDF Icon"
                                                style="width: 35px; height: 40px; object-fit: contain; margin-right: 10px;">
                                            <div>
                                                <div style="font-weight: 500; font-size: 14px; color: #2e3a59;">ID Card Font ...</div>
                                                <div style="font-size: 12px; color: #8c94a3;">94 KB - Date</div>
                                            </div>
                                        </div>
                                        <div style="width: 28px; height: 28px; border: 1px solid #a6aec1; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                            <i class="bi bi-three-dots" style="font-size: 16px; color: #2e3a59;"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mb-3">
                                    <div class="d-flex justify-content-between align-items-center p-2 rounded"
                                        style="background-color: white; box-shadow: 0 0 6px rgba(0,0,0,0.05);">
                                        <div class="d-flex align-items-center">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/8/87/PDF_file_icon.svg"
                                                alt="PDF Icon"
                                                style="width: 35px; height: 40px; object-fit: contain; margin-right: 10px;">
                                            <div>
                                                <div style="font-weight: 500; font-size: 14px; color: #2e3a59;">ID Card Font ...</div>
                                                <div style="font-size: 12px; color: #8c94a3;">94 KB - Date</div>
                                            </div>
                                        </div>
                                        <div style="width: 28px; height: 28px; border: 1px solid #a6aec1; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                            <i class="bi bi-three-dots" style="font-size: 16px; color: #2e3a59;"></i>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- 5 starts -->
                        <div class="mt-2" style="font-family: 'Segoe UI', sans-serif;background-color: #fafcfc; padding: 20px;">
                            <div>
                                <!-- Top Rating -->
                                <div class="d-flex  mb-3">
                                    <h2 class="me-2" style="font-size: 36px; color: #2e3a59;">5</h2>
                                    <!-- Star Rating -->
                                    <div>
                                        <i class="bi bi-star-fill" style="color: #ffc107;"></i>
                                        <i class="bi bi-star-fill" style="color: #ffc107;"></i>
                                        <i class="bi bi-star-fill" style="color: #ffc107;"></i>
                                        <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                        <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                    </div>
                                </div>

                                <!-- Individual Ratings -->
                                <div class="d-grid gap-2">
                                    <!-- One row -->
                                    <div class="d-flex justify-content-between align-items-center p-2"
                                        style="background-color: white;">
                                        <div style="color: #6c7a89;">Reliability</div>
                                        <div>
                                            <i class="bi bi-star-fill" style="color: #ffc107;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                        </div>
                                    </div>

                                    <!-- Repeat for other traits -->
                                    <div class="d-flex justify-content-between align-items-center p-2 rounded"
                                        style="background-color: white;">
                                        <div style="color: #6c7a89;">Accuracy</div>
                                        <div>
                                            <i class="bi bi-star-fill" style="color: #ffc107;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center p-2 rounded"
                                        style="background-color: white;">
                                        <div style="color: #6c7a89;">Punctuality</div>
                                        <div>
                                            <i class="bi bi-star-fill" style="color: #ffc107;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center p-2 rounded"
                                        style="background-color: white;">
                                        <div style="color: #6c7a89;">Quality</div>
                                        <div>
                                            <i class="bi bi-star-fill" style="color: #ffc107;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center p-2 rounded"
                                        style="background-color: white;">
                                        <div style="color: #6c7a89;">Work independent</div>
                                        <div>
                                            <i class="bi bi-star-fill" style="color: #ffc107;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Right Panel: col-9 -->
            <div class="col-md-8 col-sm-12">

                <div style="background: #eef0f4; padding: 20px; border-radius: 12px;  font-family: 'Segoe UI', sans-serif;">
                    <!-- Title Outside Card -->
                    <div style="color: #2b3e5f; font-weight: 600; font-size: 15px;">Task Activities</div>
                    <div style="color: #6c757d; font-size: 12px; margin-bottom: 10px;">Total Asigned 250</div>

                    <!-- Card -->
                    <div style="background: white; border-radius: 12px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); padding: 15px 10px 10px 10px; position: relative;">
                        <div style="display: flex; align-items: flex-end; height: 350px; position: relative;">
                            <!-- Y-Axis Labels -->
                            <!-- Y-Axis Labels -->
                            <div style="position: absolute; bottom: 0; left: 0; height: 310px; width: 30px; display: flex; flex-direction: column; justify-content: space-between; z-index: 2; font-size: 10px; color: #666;">
                                <div>250</div>
                                <div>200</div>
                                <div>150</div>
                                <div>100</div>
                                <div>50</div>
                                <div>0</div>
                                <div></div>
                                <div></div>
                            </div>


                            <!-- Graph Area -->
                            <div style="margin-left: 30px; width: 100%; position: relative;">
                                <!-- Dotted Lines -->
                                <div style="position: absolute; top: 0; width: 100%; height: 100%; z-index: 0;">
                                    <div style="border-top: 2px dotted #ccc; height: 20%;"></div>
                                    <div style="border-top: 2px dotted #ccc; height: 20%;"></div>
                                    <div style="border-top: 2px dotted #ccc; height: 20%;"></div>
                                    <div style="border-top: 2px dotted #ccc; height: 20%;"></div>
                                    <div style="border-top: 12px  #ccc; height: 2%;"></div>
                                </div>

                                <!-- Bars -->
                                <!-- Bars -->
                                <div style="display: flex; justify-content: space-between; align-items: flex-end; height: 100%; z-index: 1;">

                                    <!-- Progress -->
                                    <div style="text-align: center;">
                                        <div style="height: calc(15 / 123 * 310px); width: 26px; background: #a7e92f; border-radius: 4px; margin-bottom: 5px; font-size: 10px; color: white; line-height: 20px;">15</div>
                                        <img src="{{ asset('build/img/progress.svg') }}" style="width: 24px;">
                                        <div style="font-size: 10px; color: #444;">Progress</div>
                                        <div style="font-size: 10px; color: #444;">15</div>
                                    </div>

                                    <!-- In Hold -->
                                    <div style="text-align: center;">
                                        <div style="height: calc(55 / 250 * 310px); width: 26px; background: #f5a623; border-radius: 4px; margin-bottom: 5px; font-size: 10px; color: white; line-height: 20px;">55</div>
                                        <img src="{{ asset('build/img/inhold.svg') }}" style="width: 24px;">
                                        <div style="font-size: 10px; color: #444;">In Hold</div>
                                        <div style="font-size: 10px; color: #444;">15</div>
                                    </div>

                                    <!-- Delayed -->
                                    <div style="text-align: center;">
                                        <div style="height: calc(155 / 294 * 310px); width: 26px; background: #f44336; border-radius: 4px; margin-bottom: 5px; font-size: 10px; color: white; line-height: 20px;">155</div>
                                        <img src="{{ asset('build/img/delayed.svg') }}" style="width: 24px;">
                                        <div style="font-size: 10px; color: #444;">Delayed</div>
                                        <div style="font-size: 10px; color: #444;">15</div>
                                    </div>

                                    <!-- Rejected -->
                                    <div style="text-align: center;">
                                        <div style="height: calc(45 / 250 * 310px); width: 26px; background: #f54ea2; border-radius: 4px; margin-bottom: 5px; font-size: 10px; color: white; line-height: 20px;">45</div>
                                        <img src="{{ asset('build/img/rejected.svg') }}" style="width: 24px;">
                                        <div style="font-size: 10px; color: #444;">Rejected</div>
                                        <div style="font-size: 10px; color: #444;">15</div>
                                    </div>

                                    <!-- Done -->
                                    <div style="text-align: center;">
                                        <div style="height: calc(245 / 317 * 310px); width: 26px; background: #00d36d; border-radius: 4px; margin-bottom: 5px; font-size: 10px; color: white; line-height: 20px;">245</div>
                                        <img src="{{ asset('build/img/Done.svg') }}" style="width: 24px;">
                                        <div style="font-size: 10px; color: #444;">Done</div>
                                        <div style="font-size: 10px; color: #444;">15</div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- timeboxes -->
                <div style="background-color: #f0f2f5; padding: 20px; border-radius: 12px; font-family: 'Segoe UI', sans-serif;" class="mt-2">

                    <!-- Box 1 -->
                    <div style="background-color: #ffffff; border-radius: 12px; padding: 16px; margin-bottom: 16px;">
                        <!-- Date -->
                        <div style="display: flex; align-items: baseline; gap: 6px; margin-bottom: 10px;">
                            <span style="font-size: 22px; font-weight: bold; color: #2196f3;">27</span>
                            <span style="font-size: 13px; color: #00bcd4;">September 2019</span>
                        </div>

                        <!-- Time + Bar -->
                        <div style="position: relative; height: 60px;">
                            <!-- Time Labels -->
                            <div style="display: flex; justify-content: space-between; font-size: 12px; color: #4b5c74; margin-bottom: 8px;">
                                <span>8:00</span>
                                <span>12:00</span>
                                <span>16:00</span>
                                <span>20:00</span>
                            </div>

                            <!-- Dotted line -->


                            <!-- Blue Bars -->
                            <div style="position: absolute; top: 33px; left: 0%; width: 18%; height: 6px; background: linear-gradient(to right, #00c6ff, #0072ff); border-radius: 4px;"></div>
                            <div style="position: absolute; top: 33px; left: 24%; width: 20%; height: 6px; background: linear-gradient(to right, #00c6ff, #0072ff); border-radius: 4px;"></div>
                            <div style="position: absolute; top: 33px; left: 52%; width: 44%; height: 6px; background: linear-gradient(to right, #00c6ff, #0072ff); border-radius: 4px;"></div>
                        </div>
                    </div>

                    <!-- Duplicate this Box for second row -->
                    <div style="background-color: #ffffff; border-radius: 12px; padding: 16px;">
                        <div style="display: flex; align-items: baseline; gap: 6px; margin-bottom: 10px;">
                            <span style="font-size: 22px; font-weight: bold; color: #2196f3;">27</span>
                            <span style="font-size: 13px; color: #00bcd4;">September 2019</span>
                        </div>

                        <div style="position: relative; height: 60px;">
                            <div style="display: flex; justify-content: space-between; font-size: 12px; color: #4b5c74; margin-bottom: 8px;">
                                <span>8:00</span>
                                <span>12:00</span>
                                <span>16:00</span>
                                <span>20:00</span>
                            </div>


                            <div style="position: absolute; top: 33px; left: 0%; width: 18%; height: 6px; background: linear-gradient(to right, #00c6ff, #0072ff); border-radius: 4px;"></div>
                            <div style="position: absolute; top: 33px; left: 24%; width: 20%; height: 6px; background: linear-gradient(to right, #00c6ff, #0072ff); border-radius: 4px;"></div>
                            <div style="position: absolute; top: 33px; left: 52%; width: 44%; height: 6px; background: linear-gradient(to right, #00c6ff, #0072ff); border-radius: 4px;"></div>
                        </div>
                    </div>
                </div>
                <!-- system log -->
                <div class="mt-2" style="background-color: #f0f2f5; padding: 20px;padding-bottom:10px; border-radius: 14px;">
                    <!-- Header -->
                    <h5 style="font-weight: 600; color: #1a1a3c; margin-bottom: 16px;">System Logs</h5>

                    <!-- Log Entry Card #1 -->
                    <div class="p-3 mb-3" style="background: #ffffff; border-radius: 12px; font-family: 'Segoe UI', sans-serif;">
                        <div class="d-flex align-items-center justify-content-center gap-3" style="font-size: 17px; font-weight: 500; color: #4b5c74;">
                            <img src="{{ asset('build/img/groups/group-01.jpg') }}" alt="User" style="width: 40px; height: 40px; border-radius: 50%;">
                            <div style="flex: 1;margin-right:45px;">
                                <div style="color: #1d6fa5;">Login Date</div>
                                <div style="font-size: 15px;">DD.MM.YYYY</div>
                            </div>
                            <div style="flex: 1;margin-right:45px;">
                                <div style="color: #1d6fa5;">Login Time</div>
                                <div style="font-size: 15px;">HH:MM</div>
                            </div>
                            <div style="flex: 1;margin-right:45px;">
                                <div style="color: #1d6fa5;">Logout</div>
                                <div style="font-size: 15px;">HH:MM</div>
                            </div>
                            <div style="flex: 1;">
                                <div style="color: #1d6fa5;">Total</div>
                                <div style="font-size: 15px;">HH:MM</div>
                            </div>
                        </div>
                    </div>

                    <!-- Log Entry Card #2 -->

                    <div class="p-3 mb-3" style="background: #ffffff; border-radius: 12px; font-family: 'Segoe UI', sans-serif;">
                        <div class="d-flex align-items-center justify-content-center gap-3" style="font-size: 17px; font-weight: 500; color: #4b5c74;">
                            <img src="{{ asset('build/img/groups/group-01.jpg') }}" alt="User" style="width: 40px; height: 40px; border-radius: 50%;">
                            <div style="flex: 1;margin-right:45px;">
                                <div style="color: #1d6fa5;">Login Date</div>
                                <div style="font-size: 15px;">DD.MM.YYYY</div>
                            </div>
                            <div style="flex: 1;margin-right:45px;">
                                <div style="color: #1d6fa5;">Login Time</div>
                                <div style="font-size: 15px;">HH:MM</div>
                            </div>
                            <div style="flex: 1;margin-right:45px;">
                                <div style="color: #1d6fa5;">Logout</div>
                                <div style="font-size: 15px;">HH:MM</div>
                            </div>
                            <div style="flex: 1;">
                                <div style="color: #1d6fa5;">Total</div>
                                <div style="font-size: 15px;">HH:MM</div>
                            </div>
                        </div>
                    </div>
                    <!-- Log Entry Card #3 -->
                    <div class="p-3 mb-3" style="background: #ffffff; border-radius: 12px; font-family: 'Segoe UI', sans-serif;">
                        <div class="d-flex align-items-center justify-content-center gap-3" style="font-size: 17px; font-weight: 500; color: #4b5c74;">
                            <img src="{{ asset('build/img/groups/group-01.jpg') }}" alt="User" style="width: 40px; height: 40px; border-radius: 50%;">
                            <div style="flex: 1;margin-right:45px;">
                                <div style="color: #1d6fa5;">Login Date</div>
                                <div style="font-size: 15px;">DD.MM.YYYY</div>
                            </div>
                            <div style="flex: 1;margin-right:45px;">
                                <div style="color: #1d6fa5;">Login Time</div>
                                <div style="font-size: 15px;">HH:MM</div>
                            </div>
                            <div style="flex: 1;margin-right:45px;">
                                <div style="color: #1d6fa5;">Logout</div>
                                <div style="font-size: 15px;">HH:MM</div>
                            </div>
                            <div style="flex: 1;">
                                <div style="color: #1d6fa5;">Total</div>
                                <div style="font-size: 15px;">HH:MM</div>
                            </div>
                        </div>
                    </div>
                    <!-- Log Entry Card #4 -->
                    <div class="p-3 mb-3" style="background: #ffffff; border-radius: 12px; font-family: 'Segoe UI', sans-serif;">
                        <div class="d-flex align-items-center justify-content-center gap-3" style="font-size: 17px; font-weight: 500; color: #4b5c74;">
                            <img src="{{ asset('build/img/groups/group-01.jpg') }}" alt="User" style="width: 40px; height: 40px; border-radius: 50%;">
                            <div style="flex: 1;margin-right:45px;">
                                <div style="color: #1d6fa5;">Login Date</div>
                                <div style="font-size: 15px;">DD.MM.YYYY</div>
                            </div>
                            <div style="flex: 1;margin-right:45px;">
                                <div style="color: #1d6fa5;">Login Time</div>
                                <div style="font-size: 15px;">HH:MM</div>
                            </div>
                            <div style="flex: 1;margin-right:45px;">
                                <div style="color: #1d6fa5;">Logout</div>
                                <div style="font-size: 15px;">HH:MM</div>
                            </div>
                            <div style="flex: 1;">
                                <div style="color: #1d6fa5;">Total</div>
                                <div style="font-size: 15px;">HH:MM</div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </div>
    <!-- Statistics Content -->

</div>
</div>
<!-- add user -->

<div class="modal fade" id="add_user" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content" style="border-radius: 10px;">
            <!-- Modal Header -->
            <style>
                @media (max-width: 576px) {
                    .modal-header {
                        flex-wrap: wrap !important;
                        padding-right: 15px !important;
                    }

                    .modal-header>div.title-subtitle {
                        flex: 1 1 100% !important;
                        margin-bottom: 8px;
                    }

                    .modal-header>div.warning-box {
                        max-width: 100% !important;
                    }
                }
            </style>

            <div class="modal-header d-flex"
                style="border-bottom: none; position: relative; padding-right: 40px; flex-wrap: nowrap; align-items: flex-start;">

                <!-- Title and subtitle -->
                <div class="title-subtitle" style="flex: 1;">
                    <h5 class="modal-title" style="font-weight: 700; font-size: 16px; color: #1b1b3a; margin: 0;">
                        Create New Team
                    </h5>
                    <p style="margin: 0; font-size: 12px; color: #666;">Manage your Projects</p>
                </div>

                <!-- Warning box -->
                <div class="warning-box" style="background-color: #ffe6e6; color: red; font-size: 12px; border-radius: 8px; padding: 8px 10px; display: flex; align-items: center; max-width: 260px;">

                    <img src="{{ URL::asset('/build/img/tera.svg') }}" alt="⚡" style="width: 25px; height: 25px;">
                    <span>Please Note! Projects, Ticket and Task must be created before add a Team</span>
                </div>

                <!-- Close button -->
                <button type="button" data-bs-dismiss="modal" aria-label="Close"
                    style="position: absolute; top: 10px; right: 10px; font-size: 24px; background: none; border: none; line-height: 1;">
                    &times;
                </button>
            </div>



            <!-- Modal Body -->
            <div class="modal-body d-flex flex-column align-items-center justify-content-center" style="padding: 20px;">
                <!-- Upload Banner -->
                <input type="file" accept="image/*" id="bannerInput" style="display: none;" onchange="this.previousElementSibling.querySelector('img').src = window.URL.createObjectURL(this.files[0]); this.previousElementSibling.querySelector('img').style.display='block'; this.previousElementSibling.querySelector('.text-box').style.display='none';">
                <div onclick="this.nextElementSibling.click();" style="width: 100%; height: 120px; border: 2px dashed #ccc; border-radius: 10px; display: flex; justify-content: center; align-items: center; margin-bottom: 20px; cursor: pointer; position: relative; overflow: hidden; flex-direction: column;background:#FAFAFA">
                    <img style="max-height: 100%; max-width: 100%; display: none; position: absolute;" />
                    <div class="text-box" style="text-align: center;">
                        <div style="font-size: 24px; color: #888;">+</div>
                        <div style="font-size: 14px; color: #555; margin-top: 5px;">Upload banner</div>
                        <div style="font-size: 12px; color: #999;">JPG or PNG</div>
                    </div>
                </div>
                <input type="file" accept="image/*" id="thumbInput" style="display: none;" onchange="this.previousElementSibling.querySelector('img').src = window.URL.createObjectURL(this.files[0]); this.previousElementSibling.querySelector('img').style.display='block'; this.previousElementSibling.querySelector('.text-box').style.display='none';">

                <!-- Sub Image Upload -->
                <div onclick="this.nextElementSibling.click();"
                    style="width: 80px; height: 80px; border: 2px dashed #ccc; border-radius: 10px; display: flex; justify-content: center; align-items: center; cursor: pointer; position: relative; overflow: hidden; flex-direction: column;background:#FAFAFA">
                    <img style="max-height: 100%; max-width: 100%; display: none; position: absolute;" />
                    <div class="text-box" style="text-align: center;">
                        <div style="font-size: 20px; color: #888;">+</div>
                        <div style="font-size: 12px; color: #999;">JPG or PNG</div>
                    </div>
                </div>

                <!-- Hidden File Input -->
                <input type="file" accept="image/*" style="display: none;"
                    onchange="this.previousElementSibling.querySelector('img').src = window.URL.createObjectURL(this.files[0]); 
             this.previousElementSibling.querySelector('img').style.display='block'; 
             this.previousElementSibling.querySelector('.text-box').style.display='none';">

                <!-- Team Details Section -->
                <div class="container-fluid mt-2" style="background-color: #FAFAFA; border-radius: 10px; padding: 20px;">

                    <!-- Title & Subtitle -->
                    <div class="mb-3">
                        <h6 style="margin: 0; font-weight: 700; font-size: 14px; color: #1b1b3a;">Team Details</h6>
                        <p style="margin: 0; font-size: 12px; color: #888;">Manage your team</p>
                    </div>

                    <!-- Inputs Row -->
                    <div class="row g-2">

                        <!-- Team Title -->
                        <div class="col-12 col-md-6 col-lg-3">
                            <input type="text" class="form-control" placeholder="Team Title"
                                style="background-color: #fff; border: none; border-radius: 8px; font-size: 13px; color: #666;">
                        </div>

                        <!-- Select Project -->
                        <div class="col-12 col-md-6 col-lg-3">
                            <select class="form-select"
                                style="background-color: #fff; border: none; border-radius: 8px; font-size: 13px; color: #666;  background-size: 12px; appearance: none; -webkit-appearance: none; -moz-appearance: none; background-position: right 10px center;">
                                <option selected>Select Project</option>
                                <option>Project A</option>
                                <option>Project B</option>
                            </select>
                        </div>

                        <!-- Select PM -->
                        <div class="col-12 col-md-6 col-lg-3">
                            <select class="form-select"
                                style="background-color: #fff; border: none; border-radius: 8px; font-size: 13px; color: #666;  background-size: 12px; appearance: none; -webkit-appearance: none; -moz-appearance: none; background-position: right 10px center;">
                                <option selected>Select PM</option>
                                <option>PM A</option>
                                <option>PM B</option>
                            </select>
                        </div>

                        <!-- Timeline Color -->
                        <div class="col-12 col-md-6 col-lg-3">
                            <select class="form-select"
                                style="background-color: #fff; border: none; border-radius: 8px; font-size: 13px; color: #666;  background-size: 12px; appearance: none; -webkit-appearance: none;-moz-appearance: none; background-position: right 10px center;">
                                <option selected>Timeline Color</option>
                                <option>Red</option>
                                <option>Blue</option>
                            </select>
                        </div>

                    </div>
                    <!-- select tickets -->


                </div>

                <!-- tasks -->
                <div class="container-fluid mt-2" style="background-color: #FAFAFA; border-radius: 10px; padding: 10px;">

                    <!-- Title -->
                    <div class="mb-3">
                        <h6 style="margin: 0; font-weight: 700; font-size: 14px; color: #1b1b3a;">
                            Select Ticket & Task
                        </h6>
                    </div>

                    <!-- Ticket Buttons Row -->
                    <div class="d-flex justify-content-start gap-2 p-2" style="background: #fff; border-radius: 10px;" id="ticketContainer">

                        <button class="btn"
                            onclick="
      Array.from(this.parentNode.children).forEach(btn => {
        btn.style.backgroundColor = 'transparent';
        btn.style.color = '#7a7a9d';
      });
      this.style.backgroundColor = '#47ca7a';
      this.style.color = 'white';
    "
                            style="flex: 1 1 130px; max-width: 160px; background-color: #47ca7a; color: white; border-radius: 20px; padding: 6px 12px; font-weight: 600; font-size: 12px;">
                            #1 Ticket Title
                        </button>

                        <button class="btn"
                            onclick="
      Array.from(this.parentNode.children).forEach(btn => {
        btn.style.backgroundColor = 'transparent';
        btn.style.color = '#7a7a9d';
      });
      this.style.backgroundColor = '#47ca7a';
      this.style.color = 'white';
    "
                            style="flex: 1 1 130px; max-width: 160px; background-color: transparent; color: #7a7a9d; border-radius: 10px; padding: 6px 12px; font-weight: 600; font-size: 11px;">
                            #2 Ticket Title
                        </button>

                        <button class="btn"
                            onclick="
      Array.from(this.parentNode.children).forEach(btn => {
        btn.style.backgroundColor = 'transparent';
        btn.style.color = '#7a7a9d';
      });
      this.style.backgroundColor = '#47ca7a';
      this.style.color = 'white';
    "
                            style="flex: 1 1 130px; max-width: 160px; background-color: transparent; color: #7a7a9d; border-radius: 20px; padding: 6px 12px; font-weight: 600; font-size: 11px;">
                            #3 Ticket Title
                        </button>

                        <button class="btn"
                            onclick="
      Array.from(this.parentNode.children).forEach(btn => {
        btn.style.backgroundColor = 'transparent';
        btn.style.color = '#7a7a9d';
      });
      this.style.backgroundColor = '#47ca7a';
      this.style.color = 'white';
    "
                            style="flex: 1 1 130px; max-width: 160px; background-color: transparent; color: #7a7a9d; border-radius: 20px; padding: 6px 12px; font-weight: 600; font-size: 11px;">
                            #4 Ticket Title
                        </button>

                    </div>

                </div>


                <!-- task1 -->
                <div class="container-fluid mt-2" style="background-color: #f4f4f4; border-radius: 10px; padding: 10px; display: flex; gap: 10px; flex-wrap: wrap; align-items: flex-start;">

                    <!-- Image / Icon -->
                    <div style="width: 60px; height: 123px; border-radius: 8px; overflow: hidden; background-color: #ccc; flex-shrink: 0;">
                        <!-- Replace with actual image tag -->
                        <img src="{{URL::asset('/build/img/dooted img.svg')}}" alt="icon" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>

                    <!-- Content Area -->
                    <div style="flex: 1; display: flex; flex-direction: column; gap: 6px;">

                        <!-- Top Row: Title + Dropdowns -->
                        <div style="display: flex; justify-content: space-between; flex-wrap: wrap; align-items: flex-start;">

                            <!-- Titles -->
                            <div style="display: flex; align-items: center; gap: 8px;">

                                <!-- Logo Left -->
                                <img src="{{ URL::asset('/build/img/yekbon.svg') }}" alt="Logo"
                                    style="height: 32px; width: 32px; flex-shrink: 0;" />

                                <!-- Title and Subtitle -->
                                <div>
                                    <div style="font-weight: 700; font-size: 14px; color: #1b1b3a;">Task Title</div>
                                    <div style="font-size: 12px; color: #999;">Ticket #1 - Ticket Title</div>
                                </div>

                            </div>


                            <!-- Dropdowns -->
                            <div style="display: flex; gap: 5px; margin-top: 5px;">
                                <select style="background-color: #fff; border: none; border-radius: 8px; padding: 4px 8px; font-size: 12px; color: #555;">
                                    <option>Priority</option>
                                </select>
                                <select style="background-color: #fff; border: none; border-radius: 8px; padding: 4px 8px; font-size: 12px; color: #555;">
                                    <option>Developer</option>
                                </select>
                            </div>
                        </div>

                        <!-- Description -->
                        <div style="font-size: 12px; color: #7a7a9d;">
                            Task description will be here
                        </div>

                        <!-- Dates & Status Row -->
                        <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 10px; background: #fff; border-radius: 10px; padding: 10px;">

                            <!-- Dates Section -->
                            <div style="display: flex; flex-wrap: wrap; gap: 15px; align-items: center; flex: 1 1 200px;">

                                <!-- Start Date -->
                                <div style="font-size: 13px; color: #1ca672; display: flex; align-items: center; gap: 5px;">
                                    <strong>Start:</strong>
                                    <span style="color: #1b1b3a;">22.10.2024</span>
                                    <img src="{{ URL::asset('/build/img/timeicon.svg') }}" style="width: 16px; height: 16px;" />
                                </div>

                                <!-- Deliver Date -->
                                <div style="font-size: 13px; color: #00cc88; display: flex; align-items: center; gap: 5px;">
                                    <strong>Deliver:</strong>
                                    <span style="color: #1b1b3a;">22.10.2024</span>
                                    <img src="{{ URL::asset('/build/img/timeicon.svg') }}" style="width: 16px; height: 16px;" />
                                </div>

                            </div>

                            <!-- Status Badge Section -->
                            <div style="display: flex; align-items: center; gap: 6px; flex: 0 0 auto;">
                                <img src="{{ URL::asset('/build/img/tera.svg') }}" alt="⚡" style="width: 16px; height: 16px;">
                                <div style="background-color: red; color: white; font-size: 12px; padding: 2px 8px; border-radius: 10px;">
                                    01
                                </div>
                            </div>

                        </div>


                    </div>
                </div>
                <!-- task2 -->
                <div class="container-fluid mt-2" style="background-color: #f4f4f4; border-radius: 10px; padding: 10px; display: flex; gap: 10px; flex-wrap: wrap; align-items: flex-start;">

                    <!-- Image / Icon -->
                    <div style="width: 60px; height: 123px; border-radius: 8px; overflow: hidden; background-color: #ccc; flex-shrink: 0;">
                        <!-- Replace with actual image tag -->
                        <img src="{{URL::asset('/build/img/dooted img.svg')}}" alt="icon" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>

                    <!-- Content Area -->
                    <div style="flex: 1; display: flex; flex-direction: column; gap: 6px;">

                        <!-- Top Row: Title + Dropdowns -->
                        <div style="display: flex; justify-content: space-between; flex-wrap: wrap; align-items: flex-start;">

                            <!-- Titles -->
                            <div style="display: flex; align-items: center; gap: 8px;">

                                <!-- Logo Left -->
                                <img src="{{ URL::asset('/build/img/yekbon.svg') }}" alt="Logo"
                                    style="height: 32px; width: 32px; flex-shrink: 0;" />

                                <!-- Title and Subtitle -->
                                <div>
                                    <div style="font-weight: 700; font-size: 14px; color: #1b1b3a;">Task Title</div>
                                    <div style="font-size: 12px; color: #999;">Ticket #1 - Ticket Title</div>
                                </div>

                            </div>


                            <!-- Dropdowns -->
                            <div style="display: flex; gap: 5px; margin-top: 5px;">
                                <select style="background-color: #fff; border: none; border-radius: 8px; padding: 4px 8px; font-size: 12px; color: #555;">
                                    <option>Priority</option>
                                </select>
                                <select style="background-color: #fff; border: none; border-radius: 8px; padding: 4px 8px; font-size: 12px; color: #555;">
                                    <option>Developer</option>
                                </select>
                            </div>
                        </div>

                        <!-- Description -->
                        <div style="font-size: 12px; color: #7a7a9d;">
                            Task description will be here
                        </div>

                        <!-- Dates & Status Row -->
                        <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 10px;background:#fff;border-radius:10px;padding:5px;">

                            <!-- Dates -->
                            <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">

                                <!-- Start Date -->
                                <div style="font-size: 13px; color: #1ca672; display: flex; align-items: center; gap: 5px;">
                                    <strong>Start:</strong>
                                    <span style="color: #1b1b3a;">22.10.2024</span>
                                    <img src="{{ URL::asset('/build/img/timeicon.svg') }}" style="width: 16px; height: 16px;" />
                                </div>
                                <!-- Deliver Date -->
                                <div style="font-size: 12px; color: #00cc88; display: flex; align-items: center; gap: 5px;">
                                    <strong>Deliver:</strong>
                                    <span style="color: #1b1b3a;">22.10.2024</span>
                                    <img src="{{ URL::asset('/build/img/timeicon.svg') }}" style="width: 16px; height: 16px;" />
                                </div>
                            </div>

                            <!-- Status Badge -->
                            <div style="display: flex; align-items: center; gap: 6px;">
                                <img src="{{ URL::asset('/build/img/tera.svg') }}" alt="⚡" style="width: 16px; height: 16px;">

                                <div style="background-color: red; color: white; font-size: 12px; padding: 2px 8px; border-radius: 10px;">
                                    01
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- task3 -->
                <div class="container-fluid mt-2" style="background-color: #f4f4f4; border-radius: 10px; padding: 10px; display: flex; gap: 10px; flex-wrap: wrap; align-items: flex-start;">

                    <!-- Image / Icon -->
                    <div style="width: 60px; height: 123px; border-radius: 8px; overflow: hidden; background-color: #ccc; flex-shrink: 0;">
                        <!-- Replace with actual image tag -->
                        <img src="{{URL::asset('/build/img/dooted img.svg')}}" alt="icon" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>

                    <!-- Content Area -->
                    <div style="flex: 1; display: flex; flex-direction: column; gap: 6px;">

                        <!-- Top Row: Title + Dropdowns -->
                        <div style="display: flex; justify-content: space-between; flex-wrap: wrap; align-items: flex-start;">

                            <!-- Titles -->
                            <div style="display: flex; align-items: center; gap: 8px;">

                                <!-- Logo Left -->
                                <img src="{{ URL::asset('/build/img/yekbon.svg') }}" alt="Logo"
                                    style="height: 32px; width: 32px; flex-shrink: 0;" />

                                <!-- Title and Subtitle -->
                                <div>
                                    <div style="font-weight: 700; font-size: 14px; color: #1b1b3a;">Task Title</div>
                                    <div style="font-size: 12px; color: #999;">Ticket #1 - Ticket Title</div>
                                </div>

                            </div>


                            <!-- Dropdowns -->
                            <div style="display: flex; gap: 5px; margin-top: 5px;">
                                <select style="background-color: #fff; border: none; border-radius: 8px; padding: 4px 8px; font-size: 12px; color: #555;">
                                    <option>Priority</option>
                                </select>
                                <select style="background-color: #fff; border: none; border-radius: 8px; padding: 4px 8px; font-size: 12px; color: #555;">
                                    <option>Developer</option>
                                </select>
                            </div>
                        </div>

                        <!-- Description -->
                        <div style="font-size: 12px; color: #7a7a9d;">
                            Task description will be here
                        </div>

                        <!-- Dates & Status Row -->
                        <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 10px;background:#fff;border-radius:10px;padding:5px;">

                            <!-- Dates -->
                            <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">

                                <!-- Start Date -->
                                <div style="font-size: 13px; color: #1ca672; display: flex; align-items: center; gap: 5px;">
                                    <strong>Start:</strong>
                                    <span style="color: #1b1b3a;">22.10.2024</span>
                                    <img src="{{ URL::asset('/build/img/timeicon.svg') }}" style="width: 16px; height: 16px;" />
                                </div>
                                <!-- Deliver Date -->
                                <div style="font-size: 12px; color: #00cc88; display: flex; align-items: center; gap: 5px;">
                                    <strong>Deliver:</strong>
                                    <span style="color: #1b1b3a;">22.10.2024</span>
                                    <img src="{{ URL::asset('/build/img/timeicon.svg') }}" style="width: 16px; height: 16px;" />
                                </div>
                            </div>

                            <!-- Status Badge -->
                            <div style="display: flex; align-items: center; gap: 6px;">
                                <img src="{{ URL::asset('/build/img/tera.svg') }}" alt="⚡" style="width: 16px; height: 16px;">

                                <div style="background-color: red; color: white; font-size: 12px; padding: 2px 8px; border-radius: 10px;">
                                    01
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- footer -->

                <div style="display: flex;  justify-content: space-between; align-items: center; gap: 7px; margin-top: 16px;">

                    <!-- Left Warning Box -->
                    <div style="background-color: #feefef; color: #7a7a9d; border-radius: 10px; padding: 8px 14px; display: flex; align-items: center; font-size: 13px;">
                        <img src="{{ URL::asset('/build/img/tera.svg') }}" alt="⚡" style="width: 16px; height: 16px; margin-right: 8px;">
                        There some section not asigned yet
                    </div>

                    <!-- Right Save Button -->
                    <button type="button"
                        style="background-color: #26c26c; color: white; font-weight: 600; font-size: 13px; padding: 10px 16px; border: none; border-radius: 8px; white-space: nowrap;">
                        + Save and create work flow
                    </button>

                </div>
                <!-- Modal Body -->
                <div class="modal-body">

                    <!-- Tabs -->
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link"
                                data-bs-toggle="tab"
                                href="#basicInfo">

                            </a>
                        </li>

                    </ul>
                </div>


            </div>

        </div>
    </div>
</div>

<!-- edit team -->
 <div class="modal fade" id="edit_team" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content" style="border-radius: 10px;">
            <!-- Modal Header -->
            <style>
                @media (max-width: 576px) {
                    .modal-header {
                        flex-wrap: wrap !important;
                        padding-right: 15px !important;
                    }

                    .modal-header>div.title-subtitle {
                        flex: 1 1 100% !important;
                        margin-bottom: 8px;
                    }

                    .modal-header>div.warning-box {
                        max-width: 100% !important;
                    }
                }
            </style>

            <div class="modal-header d-flex"
                style="border-bottom: none; position: relative; padding-right: 40px; flex-wrap: nowrap; align-items: flex-start;">

                <!-- Title and subtitle -->
                <div class="title-subtitle" style="flex: 1;">
                    <h5 class="modal-title" style="font-weight: 700; font-size: 16px; color: #1b1b3a; margin: 0;">
                        Edit Team
                    </h5>
                    <p style="margin: 0; font-size: 12px; color: #666;">Manage your Projects</p>
                </div>

                <!-- Warning box -->
                <div class="warning-box" style="background-color: #ffe6e6; color: red; font-size: 12px; border-radius: 8px; padding: 8px 10px; display: flex; align-items: center; max-width: 260px;">

                    <img src="{{ URL::asset('/build/img/tera.svg') }}" alt="⚡" style="width: 25px; height: 25px;">
                    <span>Please Note! Projects, Ticket and Task must be created before add a Team</span>
                </div>

                <!-- Close button -->
                <button type="button" data-bs-dismiss="modal" aria-label="Close"
                    style="position: absolute; top: 10px; right: 10px; font-size: 24px; background: none; border: none; line-height: 1;">
                    &times;
                </button>
            </div>



            <!-- Modal Body -->
            <div class="modal-body d-flex flex-column align-items-center justify-content-center" style="padding: 20px;">
                <!-- Upload Banner -->
                <input type="file" accept="image/*" id="bannerInput" style="display: none;" onchange="this.previousElementSibling.querySelector('img').src = window.URL.createObjectURL(this.files[0]); this.previousElementSibling.querySelector('img').style.display='block'; this.previousElementSibling.querySelector('.text-box').style.display='none';">
                <div onclick="this.nextElementSibling.click();" style="width: 100%; height: 120px; border: 2px dashed #ccc; border-radius: 10px; display: flex; justify-content: center; align-items: center; margin-bottom: 20px; cursor: pointer; position: relative; overflow: hidden; flex-direction: column;background:#FAFAFA">
                    <img style="max-height: 100%; max-width: 100%; display: none; position: absolute;" />
                    <div class="text-box" style="text-align: center;">
                        <div style="font-size: 24px; color: #888;">+</div>
                        <div style="font-size: 14px; color: #555; margin-top: 5px;">Upload banner</div>
                        <div style="font-size: 12px; color: #999;">JPG or PNG</div>
                    </div>
                </div>
                <input type="file" accept="image/*" id="thumbInput" style="display: none;" onchange="this.previousElementSibling.querySelector('img').src = window.URL.createObjectURL(this.files[0]); this.previousElementSibling.querySelector('img').style.display='block'; this.previousElementSibling.querySelector('.text-box').style.display='none';">

                <!-- Sub Image Upload -->
                <div onclick="this.nextElementSibling.click();"
                    style="width: 80px; height: 80px; border: 2px dashed #ccc; border-radius: 10px; display: flex; justify-content: center; align-items: center; cursor: pointer; position: relative; overflow: hidden; flex-direction: column;background:#FAFAFA">
                    <img style="max-height: 100%; max-width: 100%; display: none; position: absolute;" />
                    <div class="text-box" style="text-align: center;">
                        <div style="font-size: 20px; color: #888;">+</div>
                        <div style="font-size: 12px; color: #999;">JPG or PNG</div>
                    </div>
                </div>

                <!-- Hidden File Input -->
                <input type="file" accept="image/*" style="display: none;"
                    onchange="this.previousElementSibling.querySelector('img').src = window.URL.createObjectURL(this.files[0]); 
             this.previousElementSibling.querySelector('img').style.display='block'; 
             this.previousElementSibling.querySelector('.text-box').style.display='none';">

                <!-- Team Details Section -->
                <div class="container-fluid mt-2" style="background-color: #FAFAFA; border-radius: 10px; padding: 20px;">

                    <!-- Title & Subtitle -->
                    <div class="mb-3">
                        <h6 style="margin: 0; font-weight: 700; font-size: 14px; color: #1b1b3a;">Team Details</h6>
                        <p style="margin: 0; font-size: 12px; color: #888;">Manage your team</p>
                    </div>

                    <!-- Inputs Row -->
                    <div class="row g-2">

                        <!-- Team Title -->
                        <div class="col-12 col-md-6 col-lg-3">
                            <input type="text" class="form-control" placeholder="Team Title"
                                style="background-color: #fff; border: none; border-radius: 8px; font-size: 13px; color: #666;">
                        </div>

                        <!-- Select Project -->
                        <div class="col-12 col-md-6 col-lg-3">
                            <select class="form-select"
                                style="background-color: #fff; border: none; border-radius: 8px; font-size: 13px; color: #666;  background-size: 12px; appearance: none; -webkit-appearance: none; -moz-appearance: none; background-position: right 10px center;">
                                <option selected>Select Project</option>
                                <option>Project A</option>
                                <option>Project B</option>
                            </select>
                        </div>

                        <!-- Select PM -->
                        <div class="col-12 col-md-6 col-lg-3">
                            <select class="form-select"
                                style="background-color: #fff; border: none; border-radius: 8px; font-size: 13px; color: #666;  background-size: 12px; appearance: none; -webkit-appearance: none; -moz-appearance: none; background-position: right 10px center;">
                                <option selected>Select PM</option>
                                <option>PM A</option>
                                <option>PM B</option>
                            </select>
                        </div>

                        <!-- Timeline Color -->
                        <div class="col-12 col-md-6 col-lg-3">
                            <select class="form-select"
                                style="background-color: #fff; border: none; border-radius: 8px; font-size: 13px; color: #666;  background-size: 12px; appearance: none; -webkit-appearance: none;-moz-appearance: none; background-position: right 10px center;">
                                <option selected>Timeline Color</option>
                                <option>Red</option>
                                <option>Blue</option>
                            </select>
                        </div>

                    </div>
                    <!-- select tickets -->


                </div>

                <!-- tasks -->
                <div class="container-fluid mt-2" style="background-color: #FAFAFA; border-radius: 10px; padding: 10px;">

                    <!-- Title -->
                    <div class="mb-3">
                        <h6 style="margin: 0; font-weight: 700; font-size: 14px; color: #1b1b3a;">
                            Select Ticket & Task
                        </h6>
                    </div>

                    <!-- Ticket Buttons Row -->
                    <div class="d-flex justify-content-start gap-2 p-2" style="background: #fff; border-radius: 10px;" id="ticketContainer">

                        <button class="btn"
                            onclick="
      Array.from(this.parentNode.children).forEach(btn => {
        btn.style.backgroundColor = 'transparent';
        btn.style.color = '#7a7a9d';
      });
      this.style.backgroundColor = '#47ca7a';
      this.style.color = 'white';
    "
                            style="flex: 1 1 130px; max-width: 160px; background-color: #47ca7a; color: white; border-radius: 20px; padding: 6px 12px; font-weight: 600; font-size: 12px;">
                            #1 Ticket Title
                        </button>

                        <button class="btn"
                            onclick="
      Array.from(this.parentNode.children).forEach(btn => {
        btn.style.backgroundColor = 'transparent';
        btn.style.color = '#7a7a9d';
      });
      this.style.backgroundColor = '#47ca7a';
      this.style.color = 'white';
    "
                            style="flex: 1 1 130px; max-width: 160px; background-color: transparent; color: #7a7a9d; border-radius: 10px; padding: 6px 12px; font-weight: 600; font-size: 11px;">
                            #2 Ticket Title
                        </button>

                        <button class="btn"
                            onclick="
      Array.from(this.parentNode.children).forEach(btn => {
        btn.style.backgroundColor = 'transparent';
        btn.style.color = '#7a7a9d';
      });
      this.style.backgroundColor = '#47ca7a';
      this.style.color = 'white';
    "
                            style="flex: 1 1 130px; max-width: 160px; background-color: transparent; color: #7a7a9d; border-radius: 20px; padding: 6px 12px; font-weight: 600; font-size: 11px;">
                            #3 Ticket Title
                        </button>

                        <button class="btn"
                            onclick="
      Array.from(this.parentNode.children).forEach(btn => {
        btn.style.backgroundColor = 'transparent';
        btn.style.color = '#7a7a9d';
      });
      this.style.backgroundColor = '#47ca7a';
      this.style.color = 'white';
    "
                            style="flex: 1 1 130px; max-width: 160px; background-color: transparent; color: #7a7a9d; border-radius: 20px; padding: 6px 12px; font-weight: 600; font-size: 11px;">
                            #4 Ticket Title
                        </button>

                    </div>

                </div>


                <!-- task1 -->
                <div class="container-fluid mt-2" style="background-color: #f4f4f4; border-radius: 10px; padding: 10px; display: flex; gap: 10px; flex-wrap: wrap; align-items: flex-start;">

                    <!-- Image / Icon -->
                    <div style="width: 60px; height: 123px; border-radius: 8px; overflow: hidden; background-color: #ccc; flex-shrink: 0;">
                        <!-- Replace with actual image tag -->
                        <img src="{{URL::asset('/build/img/dooted img.svg')}}" alt="icon" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>

                    <!-- Content Area -->
                    <div style="flex: 1; display: flex; flex-direction: column; gap: 6px;">

                        <!-- Top Row: Title + Dropdowns -->
                        <div style="display: flex; justify-content: space-between; flex-wrap: wrap; align-items: flex-start;">

                            <!-- Titles -->
                            <div style="display: flex; align-items: center; gap: 8px;">

                                <!-- Logo Left -->
                                <img src="{{ URL::asset('/build/img/yekbon.svg') }}" alt="Logo"
                                    style="height: 32px; width: 32px; flex-shrink: 0;" />

                                <!-- Title and Subtitle -->
                                <div>
                                    <div style="font-weight: 700; font-size: 14px; color: #1b1b3a;">Task Title</div>
                                    <div style="font-size: 12px; color: #999;">Ticket #1 - Ticket Title</div>
                                </div>

                            </div>


                            <!-- Dropdowns -->
                            <div style="display: flex; gap: 5px; margin-top: 5px;">
                                <select style="background-color: #fff; border: none; border-radius: 8px; padding: 4px 8px; font-size: 12px; color: #555;">
                                    <option>Priority</option>
                                </select>
                                <select style="background-color: #fff; border: none; border-radius: 8px; padding: 4px 8px; font-size: 12px; color: #555;">
                                    <option>Developer</option>
                                </select>
                            </div>
                        </div>

                        <!-- Description -->
                        <div style="font-size: 12px; color: #7a7a9d;">
                            Task description will be here
                        </div>

                        <!-- Dates & Status Row -->
                        <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 10px; background: #fff; border-radius: 10px; padding: 10px;">

                            <!-- Dates Section -->
                            <div style="display: flex; flex-wrap: wrap; gap: 15px; align-items: center; flex: 1 1 200px;">

                                <!-- Start Date -->
                                <div style="font-size: 13px; color: #1ca672; display: flex; align-items: center; gap: 5px;">
                                    <strong>Start:</strong>
                                    <span style="color: #1b1b3a;">22.10.2024</span>
                                    <img src="{{ URL::asset('/build/img/timeicon.svg') }}" style="width: 16px; height: 16px;" />
                                </div>

                                <!-- Deliver Date -->
                                <div style="font-size: 13px; color: #00cc88; display: flex; align-items: center; gap: 5px;">
                                    <strong>Deliver:</strong>
                                    <span style="color: #1b1b3a;">22.10.2024</span>
                                    <img src="{{ URL::asset('/build/img/timeicon.svg') }}" style="width: 16px; height: 16px;" />
                                </div>

                            </div>

                            <!-- Status Badge Section -->
                            <div style="display: flex; align-items: center; gap: 6px; flex: 0 0 auto;">
                                <img src="{{ URL::asset('/build/img/tera.svg') }}" alt="⚡" style="width: 16px; height: 16px;">
                                <div style="background-color: red; color: white; font-size: 12px; padding: 2px 8px; border-radius: 10px;">
                                    01
                                </div>
                            </div>

                        </div>


                    </div>
                </div>
                <!-- task2 -->
                <div class="container-fluid mt-2" style="background-color: #f4f4f4; border-radius: 10px; padding: 10px; display: flex; gap: 10px; flex-wrap: wrap; align-items: flex-start;">

                    <!-- Image / Icon -->
                    <div style="width: 60px; height: 123px; border-radius: 8px; overflow: hidden; background-color: #ccc; flex-shrink: 0;">
                        <!-- Replace with actual image tag -->
                        <img src="{{URL::asset('/build/img/dooted img.svg')}}" alt="icon" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>

                    <!-- Content Area -->
                    <div style="flex: 1; display: flex; flex-direction: column; gap: 6px;">

                        <!-- Top Row: Title + Dropdowns -->
                        <div style="display: flex; justify-content: space-between; flex-wrap: wrap; align-items: flex-start;">

                            <!-- Titles -->
                            <div style="display: flex; align-items: center; gap: 8px;">

                                <!-- Logo Left -->
                                <img src="{{ URL::asset('/build/img/yekbon.svg') }}" alt="Logo"
                                    style="height: 32px; width: 32px; flex-shrink: 0;" />

                                <!-- Title and Subtitle -->
                                <div>
                                    <div style="font-weight: 700; font-size: 14px; color: #1b1b3a;">Task Title</div>
                                    <div style="font-size: 12px; color: #999;">Ticket #1 - Ticket Title</div>
                                </div>

                            </div>


                            <!-- Dropdowns -->
                            <div style="display: flex; gap: 5px; margin-top: 5px;">
                                <select style="background-color: #fff; border: none; border-radius: 8px; padding: 4px 8px; font-size: 12px; color: #555;">
                                    <option>Priority</option>
                                </select>
                                <select style="background-color: #fff; border: none; border-radius: 8px; padding: 4px 8px; font-size: 12px; color: #555;">
                                    <option>Developer</option>
                                </select>
                            </div>
                        </div>

                        <!-- Description -->
                        <div style="font-size: 12px; color: #7a7a9d;">
                            Task description will be here
                        </div>

                        <!-- Dates & Status Row -->
                        <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 10px;background:#fff;border-radius:10px;padding:5px;">

                            <!-- Dates -->
                            <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">

                                <!-- Start Date -->
                                <div style="font-size: 13px; color: #1ca672; display: flex; align-items: center; gap: 5px;">
                                    <strong>Start:</strong>
                                    <span style="color: #1b1b3a;">22.10.2024</span>
                                    <img src="{{ URL::asset('/build/img/timeicon.svg') }}" style="width: 16px; height: 16px;" />
                                </div>
                                <!-- Deliver Date -->
                                <div style="font-size: 12px; color: #00cc88; display: flex; align-items: center; gap: 5px;">
                                    <strong>Deliver:</strong>
                                    <span style="color: #1b1b3a;">22.10.2024</span>
                                    <img src="{{ URL::asset('/build/img/timeicon.svg') }}" style="width: 16px; height: 16px;" />
                                </div>
                            </div>

                            <!-- Status Badge -->
                            <div style="display: flex; align-items: center; gap: 6px;">
                                <img src="{{ URL::asset('/build/img/tera.svg') }}" alt="⚡" style="width: 16px; height: 16px;">

                                <div style="background-color: red; color: white; font-size: 12px; padding: 2px 8px; border-radius: 10px;">
                                    01
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- task3 -->
                <div class="container-fluid mt-2" style="background-color: #f4f4f4; border-radius: 10px; padding: 10px; display: flex; gap: 10px; flex-wrap: wrap; align-items: flex-start;">

                    <!-- Image / Icon -->
                    <div style="width: 60px; height: 123px; border-radius: 8px; overflow: hidden; background-color: #ccc; flex-shrink: 0;">
                        <!-- Replace with actual image tag -->
                        <img src="{{URL::asset('/build/img/dooted img.svg')}}" alt="icon" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>

                    <!-- Content Area -->
                    <div style="flex: 1; display: flex; flex-direction: column; gap: 6px;">

                        <!-- Top Row: Title + Dropdowns -->
                        <div style="display: flex; justify-content: space-between; flex-wrap: wrap; align-items: flex-start;">

                            <!-- Titles -->
                            <div style="display: flex; align-items: center; gap: 8px;">

                                <!-- Logo Left -->
                                <img src="{{ URL::asset('/build/img/yekbon.svg') }}" alt="Logo"
                                    style="height: 32px; width: 32px; flex-shrink: 0;" />

                                <!-- Title and Subtitle -->
                                <div>
                                    <div style="font-weight: 700; font-size: 14px; color: #1b1b3a;">Task Title</div>
                                    <div style="font-size: 12px; color: #999;">Ticket #1 - Ticket Title</div>
                                </div>

                            </div>


                            <!-- Dropdowns -->
                            <div style="display: flex; gap: 5px; margin-top: 5px;">
                                <select style="background-color: #fff; border: none; border-radius: 8px; padding: 4px 8px; font-size: 12px; color: #555;">
                                    <option>Priority</option>
                                </select>
                                <select style="background-color: #fff; border: none; border-radius: 8px; padding: 4px 8px; font-size: 12px; color: #555;">
                                    <option>Developer</option>
                                </select>
                            </div>
                        </div>

                        <!-- Description -->
                        <div style="font-size: 12px; color: #7a7a9d;">
                            Task description will be here
                        </div>

                        <!-- Dates & Status Row -->
                        <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 10px;background:#fff;border-radius:10px;padding:5px;">

                            <!-- Dates -->
                            <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">

                                <!-- Start Date -->
                                <div style="font-size: 13px; color: #1ca672; display: flex; align-items: center; gap: 5px;">
                                    <strong>Start:</strong>
                                    <span style="color: #1b1b3a;">22.10.2024</span>
                                    <img src="{{ URL::asset('/build/img/timeicon.svg') }}" style="width: 16px; height: 16px;" />
                                </div>
                                <!-- Deliver Date -->
                                <div style="font-size: 12px; color: #00cc88; display: flex; align-items: center; gap: 5px;">
                                    <strong>Deliver:</strong>
                                    <span style="color: #1b1b3a;">22.10.2024</span>
                                    <img src="{{ URL::asset('/build/img/timeicon.svg') }}" style="width: 16px; height: 16px;" />
                                </div>
                            </div>

                            <!-- Status Badge -->
                            <div style="display: flex; align-items: center; gap: 6px;">
                                <img src="{{ URL::asset('/build/img/tera.svg') }}" alt="⚡" style="width: 16px; height: 16px;">

                                <div style="background-color: red; color: white; font-size: 12px; padding: 2px 8px; border-radius: 10px;">
                                    01
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- footer -->

                <div style="display: flex;  justify-content: space-between; align-items: center; gap: 7px; margin-top: 16px;">

                    <!-- Left Warning Box -->
                    <div style="background-color: #feefef; color: #7a7a9d; border-radius: 10px; padding: 8px 14px; display: flex; align-items: center; font-size: 13px;">
                        <img src="{{ URL::asset('/build/img/tera.svg') }}" alt="⚡" style="width: 16px; height: 16px; margin-right: 8px;">
                        There some section not asigned yet
                    </div>

                    <!-- Right Save Button -->
                    <button type="button"
                        style="background-color: #26c26c; color: white; font-weight: 600; font-size: 13px; padding: 10px 16px; border: none; border-radius: 8px; white-space: nowrap;">
                        + Save and create work flow
                    </button>

                </div>
                <!-- Modal Body -->
                <div class="modal-body">

                    <!-- Tabs -->
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link"
                                data-bs-toggle="tab"
                                href="#basicInfo">

                            </a>
                        </li>

                    </ul>
                </div>


            </div>

        </div>
    </div>
</div>






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
<!-- JavaScript Function -->
<script>
    function showContent(tab) {
        // Show/hide content
        document.getElementById("overviewContent").style.display = tab === 'overview' ? 'block' : 'none';
        document.getElementById("statisticsContent").style.display = tab === 'statistics' ? 'block' : 'none';

        // Toggle button styles
        document.getElementById("btnOverview").className = tab === 'overview' ?
            'btn btn-success me-2' :
            'btn btn-light border me-2';

        document.getElementById("btnStatistics").className = tab === 'statistics' ?
            'btn btn-success' :
            'btn btn-light border';
    }
</script>
@endsection