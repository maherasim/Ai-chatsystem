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
    <div class="sidebar-group" style="width: 96%;">

        <div class="tab-content" >
            <!-- Ai -->
     

                <div id="chats" class="sidebar-content active slimscroll">

                    <div class="slimscroll">

                        <div class="chat-search-header">
                            <div class="header-title d-flex align-items-center justify-content-between">
                                <h4 class="mb-3">AI</h4>
                                <div class="d-flex align-items-center mb-3">
                                    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#new-chat" class="add-icon btn btn-primary p-0 d-flex align-items-center justify-content-center fs-16 me-2"><i class="ti ti-plus"></i></a>
                                    <div class="dropdown">
                                        <a href="javascript:void(0);" data-bs-toggle="dropdown" class="fs-16 text-default">
                                            <i class="ti ti-dots-vertical"></i>
                                        </a>
                                        <ul class="dropdown-menu p-3">
                                            <li><a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#invite"><i class="ti ti-send me-2"></i>Invite Others</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Chat Search -->
                            <div class="search-wrap">
                                <form action="{{url('chat')}}">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search For Contacts or Messages">
                                        <span class="input-group-text"><i class="ti ti-search"></i></span>
                                    </div>
                                </form>
                            </div>
                            <!-- /Chat Search -->
                        </div>

                        <!-- Online Contacts -->
                        <div class="top-online-contacts">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="mb-3">Recent Chats</h5>
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
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="chat-title">All Chats</h5>
                                <div class="dropdown">
                                    <a href="#" class="text-default fs-16" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-filter"></i></a>
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
                            <!-- /Left Chat Title -->
                            <div class="tab-content" id="innerTabContent">
                                <div class="tab-pane fade show active" id="all-chats" role="tabpanel" aria-labelledby="all-chats-tab">
                                    <div class="chat-users-wrap">
                                        <div class="chat-list">
                                            <a href="{{url('chat')}}" class="chat-user-list">
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
                                        <div class="chat-list">
                                            <a href="{{url('chat')}}" class="chat-user-list">
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
                                <div class="tab-pane fade" id="favourites-chat" role="tabpanel" aria-labelledby="favourites-chat-tab">
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
                                            <a href="{{url('chat')}}" class="chat-user-list">
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
                                            <a href="{{url('chat')}}" class="chat-user-list">
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
                                            <a href="{{url('chat')}}" class="chat-user-list">
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
                                            <a href="{{url('chat')}}" class="chat-user-list">
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
                                            <a href="{{url('chat')}}" class="chat-user-list">
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


                        </div>

                    </div>

                </div>
                <!-- / Chats sidebar -->

   
          
           

            
          


        </div>
    </div>
    <!-- /Sidebar group -->

    <!-- Chat -->


    



</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>






<!-- Bootstrap JS Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@component('components.model-popup')
@endcomponent
@endsection