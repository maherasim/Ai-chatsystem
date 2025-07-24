<?php $page = 'group-chat'; ?>
@extends('layout.mainlayout')
@section('content')

<!-- content -->
<div class="content main_content">
    <!-- Left Sidebar Menu -->
    <div class="sidebar-menu">
        <div class="logo">
            <a href="{{url('index')}}" class="logo-normal"><img src="{{URL::asset('/build/img/AI-Logo.svg')}}" alt="Logo" style="max-width: 70%important"></a>
        </div>
        <div class="menu-wrap">
            <div class="main-menu">
                <ul class="nav">
                    <li data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Chats" data-bs-custom-class="tooltip-primary">
                        <a href="{{url('index')}}" data-bs-toggle="tab" data-bs-target="#chat-menu">
                            <i class="ti ti-message-2-heart"></i>
                        </a>
                    </li>
                    <li data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Contacts" data-bs-custom-class="tooltip-primary">
                        <a href="#" data-bs-toggle="tab" data-bs-target="#contact-menu">
                            <i class="ti ti-user-shield"></i>
                        </a>
                    </li>
                    <li data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Groups" data-bs-custom-class="tooltip-primary">
                        <a href="#" class="active" data-bs-toggle="tab" data-bs-target="#group-menu">
                            <i class="ti ti-users-group"></i>
                        </a>
                    </li>
                    <li data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Status" data-bs-custom-class="tooltip-primary">
                        <a href="{{url('status')}}" class="">
                            <i class="ti ti-circle-dot"></i>
                        </a>
                    </li>
                    <li data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Calls" data-bs-custom-class="tooltip-primary">
                        <a href="#" data-bs-toggle="tab" data-bs-target="#call-menu">
                            <i class="ti ti-phone-call"></i>
                        </a>
                    </li>
                    <li data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Profile" data-bs-custom-class="tooltip-primary">
                        <a href="#" data-bs-toggle="tab" data-bs-target="#profile-menu">
                            <i class="ti ti-user-circle"></i>
                        </a>
                    </li>
                    <li data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Settings" data-bs-custom-class="tooltip-primary">
                        <a href="#" data-bs-toggle="tab" data-bs-target="#setting-menu">
                            <i class="ti ti-settings"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="profile-menu">
                <ul>
                    <li>
                        <a href="#" id="dark-mode-toggle" class="dark-mode-toggle active">
                            <i class="ti ti-moon"></i>
                        </a>
                        <a href="#" id="light-mode-toggle" class="dark-mode-toggle">
                            <i class="ti ti-sun"></i>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown">
                            <a href="#" class="avatar avatar-md" data-bs-toggle="dropdown">
                                <img src="{{URL::asset('/build/img/profiles/avatar-16.jpg')}}" alt="img" class="rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end p-3">
                                <a href="{{url('signin')}}" class="dropdown-item"><i class="ti ti-logout-2 me-2"></i>Logout </a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Left Sidebar Menu -->
    <!-- sidebar group -->
    <div class="sidebar-group">

        <div class="tab-content">
            <!-- Chat -->
            <div class="tab-pane fade " id="chat-menu">

                <!-- Chats sidebar -->
                <div id="chats" class="sidebar-content active slimscroll">

                    <div class="slimscroll">

                        <div class="chat-search-header">
                            <div class="header-title d-flex align-items-center justify-content-between">
                                <h4 class="mb-3">Chats</h4>
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
            <!-- /chat -->
            <!-- Contact -->
            <div class="tab-pane fade" id="contact-menu">
                <!-- Chats sidebar -->
                <div class="sidebar-content active slimscroll">

                    <div class="slimscroll">

                        <div class="chat-search-header">
                            <div class="header-title d-flex align-items-center justify-content-between">
                                <h4 class="mb-3">Contacts</h4>
                                <div class="d-flex align-items-center mb-3">
                                    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#add-contact" class="add-icon btn btn-primary p-0 d-flex align-items-center justify-content-center fs-16 me-2"><i class="ti ti-plus"></i></a>
                                </div>
                            </div>

                            <!-- Chat Search -->
                            <div class="search-wrap">
                                <form action="{{url('group-chat')}}">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search Contacts">
                                        <span class="input-group-text"><i class="ti ti-search"></i></span>
                                    </div>
                                </form>
                            </div>
                            <!-- /Chat Search -->
                        </div>

                        <div class="sidebar-body chat-body">

                            <!-- Left Chat Title -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5>All Contacts</h5>
                            </div>
                            <!-- /Left Chat Title -->

                            <div class="chat-users-wrap">
                                <div class="mb-4">
                                    <h6 class="mb-2">A</h6>
                                    <div class="chat-list">
                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#contact-details" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Aaryian Jose</h6>
                                                    <p>last seen 5 days ago</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <h6 class="mb-2">C</h6>
                                    <div class="chat-list">
                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#contact-details" class="chat-user-list">
                                            <div class="avatar avatar-lg offline me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-03.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Clyde Smith</h6>
                                                    <p>is busy now!</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="chat-list">
                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#contact-details" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-04.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Carla Jenkins</h6>
                                                    <p>is online now</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <h6 class="mb-2">D</h6>
                                    <div class="chat-list">
                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#contact-details" class="chat-user-list">
                                            <div class="avatar avatar-lg away me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-14.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Danielle Baker</h6>
                                                    <p>last seen a week ago</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <h6 class="mb-2">E</h6>
                                    <div class="chat-list">
                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#contact-details" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Edward Lietz</h6>
                                                    <p>Do you know which App or ...</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <h6 class="mb-2">F</h6>
                                    <div class="chat-list">
                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#contact-details" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Federico Wells</h6>
                                                    <p>last seen 10 min ago</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- / Chats sidebar -->
            </div>
            <!-- /Contact -->

            <!-- Group -->
            <div class="tab-pane active show fade" id="group-menu">

                <!-- Chats sidebar -->
                <div class="sidebar-content active slimscroll">

                    <div class="slimscroll">

                        <div class="chat-search-header">
                            <div class="header-title d-flex align-items-center justify-content-between">
                                <h4 class="mb-3">Group</h4>
                                <div class="d-flex align-items-center mb-3">
                                    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#new-group" class="add-icon btn btn-primary p-0 d-flex align-items-center justify-content-center fs-16 me-2"><i class="ti ti-plus"></i></a>
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
                                <form action="#">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search For Contacts or Messages">
                                        <span class="input-group-text"><i class="ti ti-search"></i></span>
                                    </div>
                                </form>
                            </div>
                            <!-- /Chat Search -->
                        </div>

                        <div class="sidebar-body chat-body">

                            <!-- Left Chat Title -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5>All Groups</h5>
                            </div>
                            <!-- /Left Chat Title -->

                            <div class="chat-users-wrap">
                                <div class="chat-list">
                                    <a href="{{url('group-chat')}}" class="chat-user-list">
                                        <div class="avatar avatar-lg online me-2">
                                            <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}" class="rounded-circle" alt="image">
                                        </div>
                                        <div class="chat-user-info">
                                            <div class="chat-user-msg">
                                                <h6>The Dream Team</h6>
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
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Group</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-volume-off me-2"></i>Mute Notification</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-logout-2 me-2"></i>Exit Group</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Group</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-square-check me-2"></i>Mark as Unread</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="chat-list">
                                    <a href="{{url('group-chat')}}" class="chat-user-list">
                                        <div class="avatar avatar-lg online me-2">
                                            <img src="{{URL::asset('/build/img/groups/group-02.jpg')}}" class="rounded-circle" alt="image">
                                        </div>
                                        <div class="chat-user-info">
                                            <div class="chat-user-msg">
                                                <h6>The Meme Team</h6>
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
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Group</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-volume-off me-2"></i>Mute Notification</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-logout-2 me-2"></i>Exit Group</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Group</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-square-check me-2"></i>Mark as Unread</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="chat-list">
                                    <a href="{{url('group-chat')}}" class="chat-user-list">
                                        <div class="avatar avatar-lg online me-2">
                                            <img src="{{URL::asset('/build/img/groups/group-03.jpg')}}" class="rounded-circle" alt="image">
                                        </div>
                                        <div class="chat-user-info">
                                            <div class="chat-user-msg">
                                                <h6>Tech Talk Tribe</h6>
                                                <p>Haha oh man</p>
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
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Group</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-volume-off me-2"></i>Mute Notification</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-logout-2 me-2"></i>Exit Group</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Group</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-square-check me-2"></i>Mark as Unread</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="chat-list">
                                    <a href="{{url('group-chat')}}" class="chat-user-list">
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
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Group</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-volume-off me-2"></i>Mute Notification</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-logout-2 me-2"></i>Exit Group</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Group</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-square-check me-2"></i>Mark as Unread</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="chat-list">
                                    <a href="{{url('group-chat')}}" class="chat-user-list">
                                        <div class="avatar avatar-lg online me-2">
                                            <img src="{{URL::asset('/build/img/groups/group-04.jpg')}}" class="rounded-circle" alt="image">
                                        </div>
                                        <div class="chat-user-info">
                                            <div class="chat-user-msg">
                                                <h6>The Academic Alliance</h6>
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
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Group</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-volume-off me-2"></i>Mute Notification</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-logout-2 me-2"></i>Exit Group</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Group</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-square-check me-2"></i>Mark as Unread</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="chat-list">
                                    <a href="{{url('group-chat')}}" class="chat-user-list">
                                        <div class="avatar avatar-lg online me-2">
                                            <img src="{{URL::asset('/build/img/groups/group-05.jpg')}}" class="rounded-circle" alt="image">
                                        </div>
                                        <div class="chat-user-info">
                                            <div class="chat-user-msg">
                                                <h6>The Chill Zone</h6>
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
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Group</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-volume-off me-2"></i>Mute Notification</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-logout-2 me-2"></i>Exit Group</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Group</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-square-check me-2"></i>Mark as Unread</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="chat-list">
                                    <a href="{{url('group-chat')}}" class="chat-user-list">
                                        <div class="avatar avatar-lg online me-2">
                                            <img src="{{URL::asset('/build/img/groups/group-06.jpg')}}" class="rounded-circle" alt="image">
                                        </div>
                                        <div class="chat-user-info">
                                            <div class="chat-user-msg">
                                                <h6>Squad Goals</h6>
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
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Group</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-volume-off me-2"></i>Mute Notification</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-logout-2 me-2"></i>Exit Group</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Group</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-square-check me-2"></i>Mark as Unread</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="chat-list">
                                    <a href="{{url('group-chat')}}" class="chat-user-list">
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
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Group</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-volume-off me-2"></i>Mute Notification</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-logout-2 me-2"></i>Exit Group</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Group</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-square-check me-2"></i>Mark as Unread</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="chat-list">
                                    <a href="{{url('group-chat')}}" class="chat-user-list">
                                        <div class="avatar avatar-lg online me-2">
                                            <img src="{{URL::asset('/build/img/groups/group-07.jpg')}}" class="rounded-circle" alt="image">
                                        </div>
                                        <div class="chat-user-info">
                                            <div class="chat-user-msg">
                                                <h6>Scholars Society</h6>
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
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Group</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-volume-off me-2"></i>Mute Notification</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-logout-2 me-2"></i>Exit Group</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Group</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-square-check me-2"></i>Mark as Unread</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="chat-list">
                                    <a href="{{url('group-chat')}}" class="chat-user-list">
                                        <div class="avatar avatar-lg online me-2">
                                            <img src="{{URL::asset('/build/img/groups/group-08.jpg')}}" class="rounded-circle" alt="image">
                                        </div>
                                        <div class="chat-user-info">
                                            <div class="chat-user-msg">
                                                <h6>Travel Tribe</h6>
                                                <p>Hi How are you</p>
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
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Group</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-volume-off me-2"></i>Mute Notification</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-logout-2 me-2"></i>Exit Group</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Group</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-square-check me-2"></i>Mark as Unread</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="chat-list">
                                    <a href="{{url('group-chat')}}" class="chat-user-list">
                                        <div class="avatar avatar-lg online me-2">
                                            <img src="{{URL::asset('/build/img/groups/group-09.jpg')}}" class="rounded-circle" alt="image">
                                        </div>
                                        <div class="chat-user-info">
                                            <div class="chat-user-msg">
                                                <h6>Fitness Fanatics</h6>
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
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Group</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-volume-off me-2"></i>Mute Notification</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-logout-2 me-2"></i>Exit Group</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Group</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-square-check me-2"></i>Mark as Unread</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="chat-list">
                                    <a href="{{url('group-chat')}}" class="chat-user-list">
                                        <div class="avatar avatar-lg online me-2">
                                            <img src="{{URL::asset('/build/img/groups/group-10.jpg')}}" class="rounded-circle" alt="image">
                                        </div>
                                        <div class="chat-user-info">
                                            <div class="chat-user-msg">
                                                <h6>The Quest Crew</h6>
                                                <p>Haha oh man</p>
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
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Group</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-volume-off me-2"></i>Mute Notification</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-logout-2 me-2"></i>Exit Group</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Group</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-square-check me-2"></i>Mark as Unread</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="chat-list">
                                    <a href="{{url('group-chat')}}" class="chat-user-list">
                                        <div class="avatar avatar-lg online me-2">
                                            <img src="{{URL::asset('/build/img/groups/group-11.jpg')}}" class="rounded-circle" alt="image">
                                        </div>
                                        <div class="chat-user-info">
                                            <div class="chat-user-msg">
                                                <h6>Game Changers</h6>
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
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Group</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-volume-off me-2"></i>Mute Notification</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-logout-2 me-2"></i>Exit Group</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Group</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-square-check me-2"></i>Mark as Unread</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="chat-list">
                                    <a href="{{url('group-chat')}}" class="chat-user-list">
                                        <div class="avatar avatar-lg online me-2">
                                            <img src="{{URL::asset('/build/img/groups/group-12.jpg')}}" class="rounded-circle" alt="image">
                                        </div>
                                        <div class="chat-user-info">
                                            <div class="chat-user-msg">
                                                <h6>Movie Buffs</h6>
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
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Group</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-volume-off me-2"></i>Mute Notification</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-logout-2 me-2"></i>Exit Group</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Group</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ti ti-square-check me-2"></i>Mark as Unread</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- / Chats sidebar -->

            </div>
            <!-- /Group -->

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
            <div class="tab-pane fade active show" id="call-menu">
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

            <!-- Settings -->
            <div class="tab-pane fade" id="setting-menu">
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
                                                                    <a href="" class="btn btn-primary flex-fill"><i class="ti ti-device-floppy me-2"></i>Save Changes</a>
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
                                                                    <a href="" class="btn btn-primary flex-fill"><i class="ti ti-device-floppy me-2"></i>Save Changes</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h6 class="fs-14"><a href=""><i class="ti ti-lock-square text-gray me-2"></i>Screen Lock</a></h6>
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
                                                <h6 class="fs-14"><a href=""><i class="ti ti-shield text-gray me-2"></i>Two Factor Authentication</a></h6>
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
                                                    <h2 class="accordion-header others border-bottom">
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
                                                                        <a href="" class="btn btn-primary flex-fill"><i class="ti ti-device-floppy me-2"></i>Save Changes</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h6 class="fs-14"><a href=""><i class="ti ti-checks text-gray me-2"></i>Read Receipients</a></h6>
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
                                                                            <a class="gallery-img" data-fancybox="gallery-img" href="{{URL::asset('/build/img/gallery/gallery-01.jpg')}}" title="Demo 01"></a>
                                                                            <span class="check-icon avatar avatar-md d-flex justify-content-center align-items-center">
                                                                                <i class="ti ti-check  d-flex justify-content-center align-items-center"></i>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="img-wrap">
                                                                        <img src="{{URL::asset('/build/img/gallery/gallery-02.jpg')}}" alt="img">
                                                                        <div class="img-overlay-1">
                                                                            <a class="gallery-img" data-fancybox="gallery-img" href="{{URL::asset('/build/img/gallery/gallery-02.jpg')}}" title="Demo 02"></a>
                                                                            <span class="check-icon avatar avatar-md d-flex justify-content-center align-items-center">
                                                                                <i class="ti ti-check  d-flex justify-content-center align-items-center"></i>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="img-wrap">
                                                                        <img src="{{URL::asset('/build/img/gallery/gallery-03.jpg')}}" alt="img">
                                                                        <div class="img-overlay-1">
                                                                            <a class="gallery-img" data-fancybox="gallery-img" href="{{URL::asset('/build/img/gallery/gallery-03.jpg')}}" title="Demo 03"></a>
                                                                            <span class="check-icon avatar avatar-md d-flex justify-content-center align-items-center">
                                                                                <i class="ti ti-check  d-flex justify-content-center align-items-center"></i>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="img-wrap">
                                                                        <img src="{{URL::asset('/build/img/gallery/gallery-04.jpg')}}" alt="img">
                                                                        <div class="img-overlay-1">
                                                                            <a class="gallery-img" data-fancybox="gallery-img" href="{{URL::asset('/build/img/gallery/gallery-04.jpg')}}" title="Demo 04"></a>
                                                                            <span class="check-icon avatar avatar-md d-flex justify-content-center align-items-center">
                                                                                <i class="ti ti-check  d-flex justify-content-center align-items-center"></i>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="img-wrap">
                                                                        <img src="{{URL::asset('/build/img/gallery/gallery-05.jpg')}}" alt="img">
                                                                        <div class="img-overlay-1">
                                                                            <a class="gallery-img" data-fancybox="gallery-img" href="{{URL::asset('/build/img/gallery/gallery-05.jpg')}}" title="Demo 04"></a>
                                                                            <span class="check-icon avatar avatar-md d-flex justify-content-center align-items-center">
                                                                                <i class="ti ti-check  d-flex justify-content-center align-items-center"></i>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="img-wrap">
                                                                        <img src="{{URL::asset('/build/img/gallery/gallery-06.jpg')}}" alt="img">
                                                                        <div class="img-overlay-1">
                                                                            <a class="gallery-img" data-fancybox="gallery-img" href="{{URL::asset('/build/img/gallery/gallery-06.jpg')}}" title="Demo 04"></a>
                                                                            <span class="check-icon avatar avatar-md d-flex justify-content-center align-items-center">
                                                                                <i class="ti ti-check  d-flex justify-content-center align-items-center"></i>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="img-wrap">
                                                                        <img src="{{URL::asset('/build/img/gallery/gallery-07.jpg')}}" alt="img">
                                                                        <div class="img-overlay-1">
                                                                            <a class="gallery-img" data-fancybox="gallery-img" href="{{URL::asset('/build/img/gallery/gallery-07.jpg')}}" title="Demo 04"></a>
                                                                            <span class="check-icon avatar avatar-md d-flex justify-content-center align-items-center">
                                                                                <i class="ti ti-check  d-flex justify-content-center align-items-center"></i>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="img-wrap">
                                                                        <img src="{{URL::asset('/build/img/gallery/gallery-08.jpg')}}" alt="img">
                                                                        <div class="img-overlay-1">
                                                                            <a class="gallery-img" data-fancybox="gallery-img" href="{{URL::asset('/build/img/gallery/gallery-08.jpg')}}" title="Demo 04"></a>
                                                                            <span class="check-icon avatar avatar-md d-flex justify-content-center align-items-center">
                                                                                <i class="ti ti-check  d-flex justify-content-center align-items-center"></i>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 d-flex">
                                                                    <a href="" class="btn btn-primary flex-fill mb-3"><i class="ti ti-device-floppy me-2"></i>Save Changes</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between profile-list align-items-center border-bottom pb-3 mb-3">
                                                <h6 class="fs-14"><a href=""><i class="ti ti-clear-all text-gray me-2 "></i>Clear All Chat</a></h6>
                                                <div class="form-check form-switch d-flex justify-content-end align-items-center">
                                                    <input class="form-check-input" type="checkbox" role="switch">
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center profile-list border-bottom pb-3 mb-3">
                                                <h6 class="fs-14"><a href=""><i class="ti ti-trash text-gray me-2 "></i>Delete All Chat</a></h6>
                                                <div class="form-check form-switch d-flex justify-content-end align-items-center">
                                                    <input class="form-check-input" type="checkbox" role="switch">
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h6 class="fs-14"><a href=""><i class="ti ti-restore text-gray me-2 "></i>Chat Backup</a></h6>
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
                                                    <h6 class="fs-14"><a href=""><i class="ti ti-message text-gray me-2 "></i>Message Notifications</a></h6>
                                                    <div class="form-check form-switch d-flex justify-content-end align-items-center">
                                                        <input class="form-check-input" type="checkbox" role="switch">
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center profile-list border-bottom pb-3 mb-3">
                                                    <h6 class="fs-14"><a href=""><i class="ti ti-trash text-gray me-2 "></i>Show Previews</a></h6>
                                                    <div class="form-check form-switch d-flex justify-content-end align-items-center">
                                                        <input class="form-check-input" type="checkbox" role="switch">
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center profile-list border-bottom pb-3 mb-3">
                                                    <h6 class="fs-14"><a href=""><i class="ti ti-mood-smile text-gray me-2 "></i>Show Reaction Notifications</a></h6>
                                                    <div class="form-check form-switch d-flex justify-content-end align-items-center">
                                                        <input class="form-check-input" type="checkbox" role="switch">
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center ">
                                                    <h6 class="fs-14"><a href=""><i class="ti ti-bell-ringing text-gray me-2 "></i>Notification Sound</a></h6>
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
                            <div class="content-wrapper">
                                <h5 class="sub-title">Language</h5>
                                <div class="chat-file">
                                    <div class="file-item ">
                                        <div class="accordion accordion-flush chat-accordion" id="language-setting">
                                            <div>
                                                <div class="accordion-item border-0">
                                                    <h2 class="accordion-header">
                                                        <a href="#" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#chatuser-collapse5" aria-expanded="false" aria-controls="chatuser-collapse5">
                                                            <i class="ti ti-language me-2"></i>Language
                                                        </a>
                                                    </h2>
                                                    <div id="chatuser-collapse5" class="accordion-collapse collapse " data-bs-parent="#Language-setting">
                                                        <div class="accordion-body">
                                                            <div>
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <select class="form-select">
                                                                            <option>English</option>
                                                                            <option>French</option>
                                                                        </select>
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
                            <!-- /Language setting -->

                            <!-- Manage Device -->
                            <div class="content-wrapper">
                                <h5 class="sub-title">Manage Device</h5>
                                <div class="chat-file">
                                    <div class="file-item ">
                                        <div class="accordion accordion-flush chat-accordion" id="device-setting">
                                            <div>
                                                <div class="accordion-item border-0">
                                                    <h2 class="accordion-header">
                                                        <a href="#" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#chatuser-collapse6" aria-expanded="false" aria-controls="chatuser-collapse6">
                                                            <i class="ti ti-eye me-2"></i>Device History
                                                        </a>
                                                    </h2>
                                                    <div id="chatuser-collapse6" class="accordion-collapse collapse " data-bs-parent="#device-setting">
                                                        <div class="accordion-body">
                                                            <div class="device-option">
                                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="device-icon d-flex justify-content-center align-items-center bg-transparent-dark rounded-circle me-2">
                                                                            <i class="ti ti-device-laptop"></i>
                                                                        </span>
                                                                        <div>
                                                                            <h6 class="fs-16">Mac OS Safari 15.1</h6>
                                                                            <span class="fs-16">13 Jul 2024 at 03:15 PM</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex justify-content-end align-items-center">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" name="mute" checked>
                                                                        </div>
                                                                        <a href="#"><i class="ti ti-trash fs-16"></i></a>
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="device-icon d-flex justify-content-center align-items-center bg-transparent-dark rounded-circle me-2">
                                                                            <i class="ti ti-device-laptop"></i>
                                                                        </span>
                                                                        <div>
                                                                            <h6 class="fs-16">Windows 11 Mozilla Firefox</h6>
                                                                            <span class="fs-16">06 Jul 2024 at 09:30 AM</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex justify-content-end align-items-center">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" name="mute">
                                                                        </div>
                                                                        <a href="#"><i class="ti ti-trash fs-16"></i></a>
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="device-icon d-flex justify-content-center align-items-center bg-transparent-dark rounded-circle me-2">
                                                                            <i class="ti ti-device-mobile"></i>
                                                                        </span>
                                                                        <div>
                                                                            <h6 class="fs-16">IOS Safari 15.1</h6>
                                                                            <span class="fs-16">28 Jun 2024 at 04:00 PM</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex justify-content-end align-items-center">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" name="mute">
                                                                        </div>
                                                                        <a href="#"><i class="ti ti-trash fs-16"></i></a>
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex">
                                                                    <a href="" class="btn btn-primary flex-fill"><i class="ti ti-logout-2 me-2"></i>Logout From All Devices</a>
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
                            <!-- /Manage Device -->

                            <!-- Others -->
                            <div class="content-wrapper mb-0">
                                <h5 class="sub-title">Others</h5>
                                <div class="card mb-0">
                                    <div class="card-body list-group profile-item">
                                        <div class="accordion accordion-flush chat-accordion list-group-item" id="other-term">
                                            <div class="accordion-item w-100">
                                                <h2 class="accordion-header">
                                                    <a href="#" class="accordion-button py-0 collapsed" data-bs-toggle="collapse" data-bs-target="#terms" aria-expanded="false" aria-controls="terms">
                                                        <i class="ti ti-file-text me-2"></i>Terms & Conditions
                                                    </a>
                                                </h2>
                                                <div id="terms" class="accordion-collapse collapse" data-bs-parent="#other-term">
                                                    <div class="accordion-body p-0 pt-3">
                                                        <textarea class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion accordion-flush chat-accordion list-group-item" id="other-policy">
                                            <div class="accordion-item w-100">
                                                <h2 class="accordion-header">
                                                    <a href="#" class="accordion-button py-0 collapsed" data-bs-toggle="collapse" data-bs-target="#privacy" aria-expanded="false" aria-controls="privacy">
                                                        <i class="ti ti-file-text me-2"></i>Privacy Policy
                                                    </a>
                                                </h2>
                                                <div id="privacy" class="accordion-collapse collapse" data-bs-parent="#other-policy">
                                                    <div class="accordion-body p-0 pt-3">
                                                        <textarea class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="javascript:void(0);" class="list-group-item" data-bs-toggle="modal" data-bs-target="#block-user">
                                            <div class="profile-info">
                                                <h6><i class="ti ti-ban text-gray me-2"></i>Blocked User</h6>
                                            </div>
                                            <div>
                                                <span class="link-icon"><i class="ti ti-chevron-right"></i></span>
                                            </div>
                                        </a>
                                        <a href="javascript:void(0);" class="list-group-item" data-bs-toggle="modal" data-bs-target="#mute-user">
                                            <div class="profile-info">
                                                <h6><i class="ti ti-volume-off text-gray me-2"></i>Mute User</h6>
                                            </div>
                                            <div>
                                                <span class="link-icon"><i class="ti ti-chevron-right"></i></span>
                                            </div>
                                        </a>
                                        <a href="javascript:void(0);" class="list-group-item" data-bs-toggle="modal" data-bs-target="#delete-account">
                                            <div class="profile-info">
                                                <h6><i class="ti ti-trash-x text-gray me-2"></i>Delete Account</h6>
                                            </div>
                                            <div>
                                                <span class="link-icon"><i class="ti ti-chevron-right"></i></span>
                                            </div>
                                        </a>
                                        <a href="javascript:void(0);" class="list-group-item" data-bs-toggle="modal" data-bs-target="#acc-logout">
                                            <div class="profile-info">
                                                <h6><i class="ti ti-logout text-gray me-2"></i>Logout</h6>
                                            </div>
                                            <div>
                                                <span class="link-icon"><i class="ti ti-chevron-right"></i></span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- Others -->

                        </div>

                    </div>

                </div>
                <!-- / Chats sidebar -->
            </div>
            <!-- /Settings -->

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
                        <h6>The Dream Team</h6>
                        <p class="last-seen text-truncate">40 Member, <span class="text-success">24 Online</span></p>
                    </div>
                </div>
                <div class="chat-options">
                    <ul>
                        <li>
                            <div class="avatar-list-stacked avatar-group-md d-flex">
                                <span class="avatar avatar-rounded">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" alt="img">
                                </span>
                                <span class="avatar avatar-rounded">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" alt="img">
                                </span>
                                <span class="avatar avatar-rounded">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-02.jpg')}}" alt="img">
                                </span>
                                <span class="avatar avatar-rounded">
                                    <img src="{{URL::asset('/build/img/profiles/avatar-04.jpg')}}" alt="img">
                                </span>
                                <a class="avatar bg-primary avatar-rounded text-fixed-white" href="javascript:void(0);">
                                    35+
                                </a>
                            </div>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="btn chat-search-btn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Search">
                                <i class="ti ti-search"></i>
                            </a>
                        </li>
                        <li title="Group Info" data-bs-toggle="tooltip" data-bs-placement="bottom">
                            <a href="javascript:void(0)" class="btn" data-bs-toggle="offcanvas" data-bs-target="#contact-profile">
                                <i class="ti ti-info-circle"></i>
                            </a>
                        </li>
                        <li>
                            <a class="btn no-bg" href="#" data-bs-toggle="dropdown">
                                <i class="ti ti-dots-vertical"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                <li><a href="{{url('index')}}" class="dropdown-item"><i class="ti ti-x me-2"></i>Close Group</a></li>
                                <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#mute-notification"><i class="ti ti-volume-off me-2"></i>Mute Notification</a></li>
                                <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#disappearing-messages"><i class="ti ti-clock-hour-4 me-2"></i>Disappearing Message</a></li>
                                <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#clear-chat"><i class="ti ti-clear-all me-2"></i>Clear Message</a></li>
                                <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete Group</a></li>
                                <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#report-user"><i class="ti ti-thumb-down me-2"></i>Report</a></li>
                                <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#block-user"><i class="ti ti-ban me-2"></i>Block</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- Chat Search -->
                <div class="chat-search search-wrap contact-search">
                    <form>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search Contacts">
                            <span class="input-group-text"><i class="ti ti-search"></i></span>
                        </div>
                    </form>
                </div>
                <!-- /Chat Search -->
            </div>
            <div class="chat-body chat-page-group slimscroll">
                <div class="messages">
                    <div class="chats">
                        <div class="chat-avatar">
                            <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="image">
                        </div>
                        <div class="chat-content">
                            <div class="chat-profile-name">
                                <h6>Edward Lietz<i class="ti ti-circle-filled fs-7 mx-2"></i><span class="chat-time">02:39 PM</span><span class="msg-read success"><i class="ti ti-checks"></i></span></h6>
                            </div>
                            <div class="chat-info">
                                <div class="message-content">
                                    Hey Design Dynamos! How's everyone doing today?
                                    <div class="emoj-group">
                                        <ul>
                                            <li class="emoj-action"><a href="javascript:void(0);"><i class="ti ti-mood-smile"></i></a>
                                                <div class="emoj-group-list">
                                                    <ul>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-02.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-05.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-06.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-07.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-08.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-03.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-10.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-09.svg')}}" alt="Icon"></a></li>
                                                        <li class="add-emoj"><a href="javascript:void(0);"><i class="ti ti-plus"></i></a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#forward-message"><i class="ti ti-arrow-forward-up"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="chat-actions">
                                    <a class="#" href="#" data-bs-toggle="dropdown">
                                        <i class="ti ti-dots-vertical"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end p-3">
                                        <li><a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="offcanvas" data-bs-target="#contact-message"><i class="ti ti-info-circle me-2"></i>Message Info</a></li>
                                        <li><a class="dropdown-item reply-button" href="#"><i class="ti ti-arrow-back-up me-2"></i>Reply</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="ti ti-arrow-forward-up-double me-2"></i>Forward</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="ti ti-file-export me-2"></i>Copy</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="ti ti-edit me-2"></i>Edit</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="ti ti-trash me-2"></i>Delete Group</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="chats chats-right">
                        <div class="chat-content">
                            <div class="chat-profile-name text-end">
                                <h6>You<i class="ti ti-circle-filled fs-7 mx-2"></i><span class="chat-time">02:39 PM</span><span class="msg-read success"><i class="ti ti-checks"></i></span></h6>
                            </div>
                            <div class="chat-info">
                                <div class="chat-actions">
                                    <a class="#" href="#" data-bs-toggle="dropdown">
                                        <i class="ti ti-dots-vertical"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end p-3">
                                        <li><a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="offcanvas" data-bs-target="#contact-message"><i class="ti ti-info-circle me-2"></i>Message Info</a></li>
                                        <li><a class="dropdown-item reply-button" href="#"><i class="ti ti-arrow-back-up me-2"></i>Reply</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="ti ti-arrow-forward-up-double me-2"></i>Forward</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="ti ti-edit me-2"></i>Edit</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="ti ti-trash me-2"></i>Delete Group</a></li>
                                    </ul>
                                </div>
                                <div class="message-content">
                                    Hey Edward! Doing well. Just finished up a client meeting. How's everyone else?
                                    <div class="emoj-group">
                                        <ul>
                                            <li class="emoj-action"><a href="javascript:void(0);"><i class="ti ti-mood-smile"></i></a>
                                                <div class="emoj-group-list">
                                                    <ul>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-02.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-05.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-06.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-07.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-08.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-03.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-10.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-09.svg')}}" alt="Icon"></a></li>
                                                        <li class="add-emoj"><a href="javascript:void(0);"><i class="ti ti-plus"></i></a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#forward-message"><i class="ti ti-arrow-forward-up"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="emonji-wrap">
                                <a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-02.svg')}}" class="me-2" alt="icon">24</a>
                                <a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-03.svg')}}" class="me-2" alt="icon">15</a>
                                <a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-04.svg')}}" class="me-2" alt="icon">15</a>
                            </div>
                        </div>
                        <div class="chat-avatar">
                            <img src="{{URL::asset('/build/img/profiles/avatar-17.jpg')}}" class="rounded-circle dreams_chat" alt="image">
                        </div>
                    </div>
                    <div class="chats">
                        <div class="chat-avatar">
                            <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle" alt="image">
                        </div>
                        <div class="chat-content">
                            <div class="chat-profile-name">
                                <h6>Aaryian Jose<i class="ti ti-circle-filled fs-7 mx-2"></i><span class="chat-time">02:40 PM</span><span class="msg-read success"><i class="ti ti-checks"></i></span></h6>
                            </div>
                            <div class="message-content">
                                Hi all! I'm great, just wrapping up the wireframe for the new project. Excited to share it with you guys!
                            </div>
                            <div class="emonji-wrap">
                                <a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-02.svg')}}" class="me-2" alt="icon">24</a>
                                <a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-03.svg')}}" class="me-2" alt="icon">15</a>
                                <a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-04.svg')}}" class="me-2" alt="icon">15</a>
                            </div>
                        </div>
                    </div>
                    <div class="chats">
                        <div class="chat-avatar">
                            <img src="{{URL::asset('/build/img/profiles/avatar-02.jpg')}}" class="rounded-circle" alt="image">
                        </div>
                        <div class="chat-content">
                            <div class="chat-profile-name">
                                <h6>Aaryian Jose<i class="ti ti-circle-filled fs-7 mx-2"></i><span class="chat-time">02:40 PM</span><span class="msg-read success"><i class="ti ti-checks"></i></span></h6>
                            </div>
                            <div class="message-content">
                                <span class="text-primary">@Aaryian Jose,</span> can you share the wireframe here? Would love to give feedback before our meeting later.
                            </div>
                        </div>
                    </div>
                    <div class="chats">
                        <div class="chat-avatar">
                            <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle" alt="image">
                        </div>
                        <div class="chat-content">
                            <div class="chat-profile-name">
                                <h6>Aaryian Jose<i class="ti ti-circle-filled fs-7 mx-2"></i><span class="chat-time">02:39 PM</span><span class="msg-read success"><i class="ti ti-checks"></i></span></h6>
                            </div>
                            <div class="chat-info">
                                <div class="message-content">
                                    <div class="file-attach">
                                        <span class="file-icon">
                                            <i class="ti ti-files"></i>
                                        </span>
                                        <div class="ms-2 overflow-hidden">
                                            <h6 class="mb-1">Ecommerce.zip</h6>
                                            <p>14.23 KB</p>
                                        </div>
                                        <a href="javascript:void(0);" class="download-icon">
                                            <i class="ti ti-download"></i>
                                        </a>
                                    </div>
                                    <div class="emoj-group">
                                        <ul>
                                            <li class="emoj-action"><a href="javascript:void(0);"><i class="ti ti-mood-smile"></i></a>
                                                <div class="emoj-group-list">
                                                    <ul>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-02.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-05.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-06.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-07.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-08.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-03.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-10.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-09.svg')}}" alt="Icon"></a></li>
                                                        <li class="add-emoj"><a href="javascript:void(0);"><i class="ti ti-plus"></i></a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#forward-message"><i class="ti ti-arrow-forward-up"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="chat-actions">
                                    <a class="#" href="#" data-bs-toggle="dropdown">
                                        <i class="ti ti-dots-vertical"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end p-3">
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="offcanvas" data-bs-target="#contact-message"><i class="ti ti-info-circle me-2"></i>Message Info</a></li>
                                        <li><a class="dropdown-item reply-button" href="#"><i class="ti ti-arrow-back-up me-2"></i>Reply</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="ti ti-arrow-forward-up-double me-2"></i>Forward</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="ti ti-edit me-2"></i>Edit</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="ti ti-trash me-2"></i>Delete Group</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="chats chats-right">
                        <div class="chat-content">
                            <div class="chat-profile-name justify-content-end">
                                <h6>You<i class="ti ti-circle-filled fs-7 mx-2"></i><span class="chat-time">02:39 PM</span><span class="msg-read success"><i class="ti ti-checks"></i></span></h6>
                            </div>
                            <div class="message-content">
                                Send me background images if any for our new project??
                                <div class="emoj-group wrap-emoji-group ">
                                    <ul>
                                        <li class="emoj-action"><a href="javascript:void(0);"><i class="ti ti-mood-smile"></i></a>
                                            <div class="emoj-group-list">
                                                <ul>
                                                    <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-02.svg')}}" alt="Icon"></a></li>
                                                    <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-05.svg')}}" alt="Icon"></a></li>
                                                    <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-06.svg')}}" alt="Icon"></a></li>
                                                    <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-07.svg')}}" alt="Icon"></a></li>
                                                    <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-08.svg')}}" alt="Icon"></a></li>
                                                    <li class="add-emoj"><a href="javascript:void(0);"><i class="ti ti-plus"></i></a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#forward-message"><i class="ti ti-arrow-forward-up"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="chat-avatar">
                            <img src="{{URL::asset('/build/img/profiles/avatar-17.jpg')}}" class="rounded-circle dreams_chat" alt="image">
                        </div>
                    </div>
                    <div class="chats">
                        <div class="chat-avatar">
                            <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="image">
                        </div>
                        <div class="chat-content">
                            <div class="chat-profile-name">
                                <h6>Edward Lietz<i class="ti ti-circle-filled fs-7 mx-2"></i><span class="chat-time">02:39 PM</span><span class="msg-read success"><i class="ti ti-checks"></i></span></h6>
                            </div>
                            <div class="chat-info">
                                <div class="message-content">
                                    <div class="chat-img">
                                        <div class="img-wrap">
                                            <img src="{{URL::asset('/build/img/gallery/gallery-01.jpg')}}" alt="img">
                                            <div class="img-overlay">
                                                <a class="gallery-img" data-fancybox="gallery-img" href="{{URL::asset('/build/img/gallery/gallery-01.jpg')}}" title="Demo 01"><i class="ti ti-eye"></i></a>
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
                                    <a class="gallery-img view-all d-flex align-items-center justify-content-center mt-3" href="{{URL::asset('/build/img/gallery/gallery-05.jpg')}}" data-fancybox="gallery-img">
                                        View All Images<i class="ti ti-arrow-right ms-2"></i>
                                    </a>
                                    <div class="emoj-group">
                                        <ul>
                                            <li class="emoj-action"><a href="javascript:void(0);"><i class="ti ti-mood-smile"></i></a>
                                                <div class="emoj-group-list">
                                                    <ul>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-02.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-05.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-06.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-07.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-08.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-03.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-10.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-09.svg')}}" alt="Icon"></a></li>
                                                        <li class="add-emoj"><a href="javascript:void(0);"><i class="ti ti-plus"></i></a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#forward-message"><i class="ti ti-arrow-forward-up"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="chat-actions">
                                    <a class="#" href="#" data-bs-toggle="dropdown">
                                        <i class="ti ti-dots-vertical"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end p-3">
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="offcanvas" data-bs-target="#contact-message"><i class="ti ti-info-circle me-2"></i>Message Info</a></li>
                                        <li><a class="dropdown-item reply-button" href="#"><i class="ti ti-arrow-back-up me-2"></i>Reply</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="ti ti-arrow-forward-up-double me-2"></i>Forward</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="ti ti-edit me-2"></i>Edit</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="ti ti-trash me-2"></i>Delete Group</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="chat-line">
                        <span class="chat-date">Yesterday</span>
                    </div>
                    <div class="chats">
                        <div class="chat-avatar">
                            <img src="{{URL::asset('/build/img/profiles/avatar-04.jpg')}}" class="rounded-circle" alt="image">
                        </div>
                        <div class="chat-content">
                            <div class="chat-profile-name">
                                <h6>Sarika Jain<i class="ti ti-circle-filled fs-7 mx-2"></i><span class="chat-time">02:39 PM</span><span class="msg-read success"><i class="ti ti-checks"></i></span></h6>
                            </div>
                            <div class="chat-info">
                                <div class="message-content">
                                    <a href="javascript:void(0);" class="link-info">@all</a> if anyone can you share final output video of current project?
                                    <div class="emoj-group">
                                        <ul>
                                            <li class="emoj-action"><a href="javascript:void(0);"><i class="ti ti-mood-smile"></i></a>
                                                <div class="emoj-group-list">
                                                    <ul>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-02.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-05.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-06.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-07.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-08.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-03.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-10.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-09.svg')}}" alt="Icon"></a></li>
                                                        <li class="add-emoj"><a href="javascript:void(0);"><i class="ti ti-plus"></i></a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#forward-message"><i class="ti ti-arrow-forward-up"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="chat-actions">
                                    <a class="#" href="#" data-bs-toggle="dropdown">
                                        <i class="ti ti-dots-vertical"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end p-3">
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="offcanvas" data-bs-target="#contact-message"><i class="ti ti-info-circle me-2"></i>Message Info</a></li>
                                        <li><a class="dropdown-item reply-button" href="#"><i class="ti ti-arrow-back-up me-2"></i>Reply</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="ti ti-arrow-forward-up-double me-2"></i>Forward</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="ti ti-edit me-2"></i>Edit</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="ti ti-trash me-2"></i>Delete Group</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="chats">
                        <div class="chat-avatar">
                            <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="image">
                        </div>
                        <div class="chat-content">
                            <div class="chat-profile-name">
                                <h6>Edward Lietz<i class="ti ti-circle-filled fs-7 mx-2"></i><span class="chat-time">02:39 PM</span><span class="msg-read success"><i class="ti ti-checks"></i></span></h6>
                            </div>
                            <div class="chat-info">
                                <div class="message-content">
                                    <div class="message-video">
                                        <video width="400" controls>
                                            <source src="build/img/video/video.mp4" type="video/mp4">
                                            Your browser does not support HTML5 video.
                                        </video>
                                    </div>
                                    <div class="emoj-group">
                                        <ul>
                                            <li class="emoj-action"><a href="javascript:void(0);"><i class="ti ti-mood-smile"></i></a>
                                                <div class="emoj-group-list">
                                                    <ul>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-02.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-05.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-06.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-07.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-08.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-03.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-10.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-09.svg')}}" alt="Icon"></a></li>
                                                        <li class="add-emoj"><a href="javascript:void(0);"><i class="ti ti-plus"></i></a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#forward-message"><i class="ti ti-arrow-forward-up"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="chat-actions">
                                    <a class="#" href="#" data-bs-toggle="dropdown">
                                        <i class="ti ti-dots-vertical"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end p-3">
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="offcanvas" data-bs-target="#contact-message"><i class="ti ti-info-circle me-2"></i>Message Info</a></li>
                                        <li><a class="dropdown-item reply-button" href="#"><i class="ti ti-arrow-back-up me-2"></i>Reply</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="ti ti-arrow-forward-up-double me-2"></i>Forward</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="ti ti-edit me-2"></i>Edit</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="ti ti-trash me-2"></i>Delete Group</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="chats chats-right">
                        <div class="chat-content">
                            <div class="chat-profile-name text-end">
                                <h6>You<i class="ti ti-circle-filled fs-7 mx-2"></i><span class="chat-time">02:39 PM</span><span class="msg-read success"><i class="ti ti-checks"></i></span></h6>
                            </div>
                            <div class="chat-info">
                                <div class="chat-actions">
                                    <a class="#" href="#" data-bs-toggle="dropdown">
                                        <i class="ti ti-dots-vertical"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end p-3">
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="offcanvas" data-bs-target="#contact-message"><i class="ti ti-info-circle me-2"></i>Message Info</a></li>
                                        <li><a class="dropdown-item reply-button" href="#"><i class="ti ti-arrow-back-up me-2"></i>Reply</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="ti ti-arrow-forward-up-double me-2"></i>Forward</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="ti ti-edit me-2"></i>Edit</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="ti ti-trash me-2"></i>Delete Group</a></li>
                                    </ul>
                                </div>
                                <div class="message-content">
                                    Thanks for Sharing!!! Can we have a call
                                    <div class="emoj-group">
                                        <ul>
                                            <li class="emoj-action"><a href="javascript:void(0);"><i class="ti ti-mood-smile"></i></a>
                                                <div class="emoj-group-list">
                                                    <ul>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-02.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-05.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-06.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-07.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-08.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-03.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-10.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-09.svg')}}" alt="Icon"></a></li>
                                                        <li class="add-emoj"><a href="javascript:void(0);"><i class="ti ti-plus"></i></a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#forward-message"><i class="ti ti-arrow-forward-up"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="chat-avatar">
                            <img src="{{URL::asset('/build/img/profiles/avatar-17.jpg')}}" class="rounded-circle dreams_chat" alt="image">
                        </div>
                    </div>
                    <div class="chats">
                        <div class="chat-avatar">
                            <img src="{{URL::asset('/build/img/profiles/avatar-05.jpg')}}" class="rounded-circle" alt="image">
                        </div>
                        <div class="chat-content">
                            <div class="chat-profile-name">
                                <h6>Federico Wells<i class="ti ti-circle-filled fs-7 mx-2"></i><span class="chat-time">02:39 PM</span><span class="msg-read success"><i class="ti ti-checks"></i></span></h6>
                            </div>
                            <div class="chat-info">
                                <div class="message-content">
                                    <div class="chat-profile-name">
                                        <h6>You</h6>
                                    </div>
                                    <div class="message-reply">
                                        Thanks for Sharing!!! Can we have a call??
                                    </div>
                                    Yes Please
                                    <div class="emoj-group">
                                        <ul>
                                            <li class="emoj-action"><a href="javascript:void(0);"><i class="ti ti-mood-smile"></i></a>
                                                <div class="emoj-group-list">
                                                    <ul>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-02.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-05.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-06.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-07.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-08.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-03.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-10.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-09.svg')}}" alt="Icon"></a></li>
                                                        <li class="add-emoj"><a href="javascript:void(0);"><i class="ti ti-plus"></i></a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#forward-message"><i class="ti ti-arrow-forward-up"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="chat-actions">
                                    <a class="#" href="#" data-bs-toggle="dropdown">
                                        <i class="ti ti-dots-vertical"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end p-3">
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="offcanvas" data-bs-target="#contact-message"><i class="ti ti-info-circle me-2"></i>Message Info</a></li>
                                        <li><a class="dropdown-item reply-button" href="#"><i class="ti ti-arrow-back-up me-2"></i>Reply</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="ti ti-arrow-forward-up-double me-2"></i>Forward</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="ti ti-edit me-2"></i>Edit</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="ti ti-trash me-2"></i>Delete Group</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="chats">
                        <div class="chat-avatar">
                            <img src="{{URL::asset('/build/img/profiles/avatar-05.jpg')}}" class="rounded-circle" alt="image">
                        </div>
                        <div class="chat-content">
                            <div class="chat-profile-name">
                                <h6>Federico Wells<i class="ti ti-circle-filled fs-7 mx-2"></i><span class="chat-time">02:39 PM</span><span class="msg-read success"><i class="ti ti-checks"></i></span></h6>
                            </div>
                            <div class="chat-info">
                                <div class="message-content">
                                    <div class="file-attach">
                                        <div class="d-flex align-items-center">
                                            <span class="file-icon bg-danger text-white">
                                                <i class="ti ti-phone-call"></i>
                                            </span>
                                            <div class="ms-2 overflow-hidden">
                                                <h6 class="mb-1 text-truncate">Missed Audio Call</h6>
                                                <p>10 Min 23 Sec</p>
                                            </div>
                                        </div>
                                        <a href="javascript:void(0);" class="download-icon">
                                            <i class="ti ti-download"></i>
                                        </a>
                                    </div>
                                    <div class="emoj-group">
                                        <ul>
                                            <li class="emoj-action"><a href="javascript:void(0);"><i class="ti ti-mood-smile"></i></a>
                                                <div class="emoj-group-list">
                                                    <ul>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-02.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-05.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-06.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-07.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-08.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-03.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-10.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-09.svg')}}" alt="Icon"></a></li>
                                                        <li class="add-emoj"><a href="javascript:void(0);"><i class="ti ti-plus"></i></a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#forward-message"><i class="ti ti-arrow-forward-up"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="chat-actions">
                                    <a class="#" href="#" data-bs-toggle="dropdown">
                                        <i class="ti ti-dots-vertical"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end p-3">
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="offcanvas" data-bs-target="#contact-message"><i class="ti ti-info-circle me-2"></i>Message Info</a></li>
                                        <li><a class="dropdown-item reply-button" href="#"><i class="ti ti-arrow-back-up me-2"></i>Reply</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="ti ti-arrow-forward-up-double me-2"></i>Forward</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="ti ti-edit me-2"></i>Edit</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="ti ti-trash me-2"></i>Delete Group</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="chats chats-right">
                        <div class="chat-content">
                            <div class="chat-profile-name text-end">
                                <h6>You<i class="ti ti-circle-filled fs-7 mx-2"></i><span class="chat-time">02:39 PM</span><span class="msg-read success"><i class="ti ti-checks"></i></span></h6>
                            </div>
                            <div class="chat-info">
                                <div class="chat-actions">
                                    <a class="#" href="#" data-bs-toggle="dropdown">
                                        <i class="ti ti-dots-vertical"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end p-3">
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="offcanvas" data-bs-target="#contact-message"><i class="ti ti-info-circle me-2"></i>Message Info</a></li>
                                        <li><a class="dropdown-item reply-button" href="#"><i class="ti ti-arrow-back-up me-2"></i>Reply</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="ti ti-arrow-forward-up-double me-2"></i>Forward</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="ti ti-edit me-2"></i>Edit</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="ti ti-trash me-2"></i>Delete Group</a></li>
                                    </ul>
                                </div>
                                <div class="message-content">
                                    <div class="file-attach">
                                        <span class="file-icon bg-success text-white">
                                            <i class="ti ti-phone-incoming"></i>
                                        </span>
                                        <div class="ms-2 overflow-hidden">
                                            <h6 class="mb-1">Audio Call Ended</h6>
                                            <p>07 Min 34 Sec</p>
                                        </div>
                                        <a href="javascript:void(0);" class="download-icon">
                                            <i class="ti ti-download"></i>
                                        </a>
                                    </div>
                                    <div class="emoj-group">
                                        <ul>
                                            <li class="emoj-action"><a href="javascript:void(0);"><i class="ti ti-mood-smile"></i></a>
                                                <div class="emoj-group-list">
                                                    <ul>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-02.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-05.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-06.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-07.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-08.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-03.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-10.svg')}}" alt="Icon"></a></li>
                                                        <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-09.svg')}}" alt="Icon"></a></li>
                                                        <li class="add-emoj"><a href="javascript:void(0);"><i class="ti ti-plus"></i></a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#forward-message"><i class="ti ti-arrow-forward-up"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="chat-avatar">
                            <img src="{{URL::asset('/build/img/profiles/avatar-17.jpg')}}" class="rounded-circle dreams_chat" alt="image">
                        </div>
                    </div>
                    <div class="chats">
                        <div class="chat-avatar">
                            <img src="{{URL::asset('/build/img/profiles/avatar-05.jpg')}}" class="rounded-circle" alt="image">
                        </div>
                        <div class="chat-content">
                            <div class="chat-profile-name">
                                <h6>Federico Wells<i class="ti ti-circle-filled fs-7 mx-2"></i><span class="chat-time">02:39 PM</span><span class="msg-read success"><i class="ti ti-checks"></i></span></h6>
                            </div>
                            <div class="message-content">
                                <span class="animate-typing">is typing
                                    <span class="dot"></span>
                                    <span class="dot"></span>
                                    <span class="dot"></span>
                                </span>
                                <div class="emoj-group">
                                    <ul>
                                        <li class="emoj-action"><a href="javascript:void(0);"><i class="ti ti-mood-smile"></i></a>
                                            <div class="emoj-group-list">
                                                <ul>
                                                    <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-02.svg')}}" alt="Icon"></a></li>
                                                    <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-05.svg')}}" alt="Icon"></a></li>
                                                    <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-06.svg')}}" alt="Icon"></a></li>
                                                    <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-07.svg')}}" alt="Icon"></a></li>
                                                    <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-08.svg')}}" alt="Icon"></a></li>
                                                    <li class="add-emoj"><a href="javascript:void(0);"><i class="ti ti-plus"></i></a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#forward-message"><i class="ti ti-arrow-forward-up"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="chat-footer">
            <form class="footer-form">
                <div class="chat-footer-wrap">
                    <div class="form-item">
                        <a href="#" class="action-circle"><i class="ti ti-microphone"></i></a>
                    </div>
                    <div class="form-wrap">
                        <div class="chats reply-chat">
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="close-replay">
                                <i class="ti ti-x"></i>
                            </a>
                        </div>
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
                            <a href="#" class="dropdown-item"><i class="ti ti-file-text me-2"></i>Document</a>
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

    <!-- Group Info -->
    <div class="chat-offcanvas offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="contact-profile">
        <div class="offcanvas-header">
            <h4 class="offcanvas-title">Group Info</h4>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i class="ti ti-x"></i></button>
        </div>
        <div class="offcanvas-body">
            <div class="chat-contact-info">
                <div class="profile-content">
                    <div class="contact-profile-info">
                        <div class="avatar avatar-xxl online mb-2">
                            <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="img">
                        </div>
                        <h6>The Dream Team</h6>
                        <p>Group - 40 Participants</p>
                    </div>
                    <div class="row gx-3">
                        <div class="col">
                            <a class="action-wrap" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#group_voice">
                                <i class="ti ti-phone"></i>
                                <p>Audio</p>
                            </a>
                        </div>
                        <div class="col">
                            <a class="action-wrap" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#group_video">
                                <i class="ti ti-video"></i>
                                <p>Video</p>
                            </a>
                        </div>
                        <div class="col">
                            <a class="action-wrap" href="javascript:void(0);">
                                <i class="ti ti-brand-hipchat"></i>
                                <p>Chat</p>
                            </a>
                        </div>
                        <div class="col">
                            <a class="action-wrap" href="javascript:void(0);">
                                <i class="ti ti-search"></i>
                                <p>Search</p>
                            </a>
                        </div>
                    </div>
                    <div class="content-wrapper">
                        <h5 class="sub-title">Profile Info</h5>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex profile-info-content justify-content-between align-items-center border-bottom pb-3 mb-3">
                                    <div>
                                        <h6 class="fs-14">Group Description</h6>
                                        <p class="fs-16">Innovate. Create. Inspire.</p>
                                    </div>
                                    <a href="javascript:void(0);" class="link-icon"><i class="ti ti-edit-circle"></i></a>
                                </div>
                                <p class="fs-12">Group created by Edward Lietz, on 18 Feb 2022 at 1:32 pm</p>
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
                        <div class="file-item">
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
                                                    <a class="gallery-img view-all link-primary d-inline-flex align-items-center justify-content-center mt-3" data-fancybox="gallery-img" href="{{URL::asset('/build/img/gallery/gallery-05.jpg')}}">
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
                    <div class="content-wrapper other-info mb-0">
                        <h5 class="sub-title">Others</h5>
                        <div class="card">
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
                                <a href="javascript:void(0);" class="list-group-item" data-bs-toggle="modal" data-bs-target="#mute-notification">
                                    <div class="profile-info">
                                        <h6><i class="ti ti-volume-off me-2 text-warning"></i>Mute Notifications</h6>
                                    </div>
                                    <div>
                                        <span class="link-icon"><i class="ti ti-chevron-right"></i></span>
                                    </div>
                                </a>
                                <a href="javascript:void(0);" class="list-group-item" data-bs-toggle="modal" data-bs-target="#msg-disapper">
                                    <div class="profile-info">
                                        <h6><i class="ti ti-user-off me-2 text-info"></i>Disappearing Messages</h6>
                                    </div>
                                    <div>
                                        <span class="link-icon"><i class="ti ti-chevron-right"></i></span>
                                    </div>
                                </a>
                                <div class="accordion accordion-flush">
                                    <div class="accordion-item border-bottom">
                                        <h2 class="accordion-header">
                                            <a href="#" class="accordion-button px-0 collapsed" data-bs-toggle="collapse" data-bs-target="#chatuser-encryption" aria-expanded="false" aria-controls="chatuser-collapse1">
                                                <i class="ti ti-shield me-2 text-purple"></i>Encryption
                                            </a>
                                        </h2>
                                        <div id="chatuser-encryption" class="accordion-collapse collapse">
                                            <div class="accordion-body p-0 pb-3">
                                                <p class="mb-2">Messages are end-to-end encrypted</p>
                                                <div class="text-center">
                                                    <a class="view-all link-primary d-inline-flex align-items-center justify-content-center" href="javascript:void(0);">
                                                        Click to learn more<i class="ti ti-arrow-right ms-2"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="javascript:void(0);" class="list-group-item" data-bs-toggle="offcanvas" data-bs-target="#group-settings">
                                    <div class="profile-info">
                                        <h6><i class="ti ti-settings me-2 text-primary"></i>Group Settings</h6>
                                    </div>
                                    <div>
                                        <span class="link-icon"><i class="ti ti-chevron-right"></i></span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="content-wrapper other-info">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="sub-title">40 Participants</h5>
                            <a href="javascript:void(0);" class="link-icon"><i class="ti ti-search"></i></a>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center overflow-hidden">
                                                <span class="avatar avatar-lg online flex-shrink-0">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-02.jpg')}}" alt="img" class="rounded-circle">
                                                </span>
                                                <div class="ms-2 overflow-hidden">
                                                    <h6 class="text-truncate mb-1">Sarika Jain</h6>
                                                    <p>Busy</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="badge badge-primary-transparent me-2">Admin</span>
                                                <div class="dropdown">
                                                    <a href="#" data-bs-toggle="dropdown">
                                                        <i class="ti ti-dots-vertical"></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-end p-3">
                                                        <li><a class="dropdown-item" href="#"><i class="ti ti-logout-2 me-2"></i>Exit Group</a></li>
                                                        <li><a class="dropdown-item" href="#"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                        <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Unpin Chat</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center overflow-hidden">
                                                <span class="avatar avatar-lg online flex-shrink-0">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-17.jpg')}}" alt="img" class="rounded-circle">
                                                </span>
                                                <div class="ms-2 overflow-hidden">
                                                    <h6 class="text-truncate mb-1">Edward Lietz</h6>
                                                    <p>Available</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="badge badge-primary-transparent me-2">Admin</span>
                                                <div class="dropdown">
                                                    <a href="#" data-bs-toggle="dropdown">
                                                        <i class="ti ti-dots-vertical"></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-end p-3">
                                                        <li><a class="dropdown-item" href="#"><i class="ti ti-logout-2 me-2"></i>Exit Group</a></li>
                                                        <li><a class="dropdown-item" href="#"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                        <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Unpin Chat</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center overflow-hidden">
                                                <span class="avatar avatar-lg online flex-shrink-0">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-03.jpg')}}" alt="img" class="rounded-circle">
                                                </span>
                                                <div class="ms-2 overflow-hidden">
                                                    <h6 class="text-truncate mb-1">Clyde Smith</h6>
                                                    <p>Available</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class="dropdown">
                                                    <a href="#" data-bs-toggle="dropdown">
                                                        <i class="ti ti-dots-vertical"></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-end p-3">
                                                        <li><a class="dropdown-item" href="#"><i class="ti ti-logout-2 me-2"></i>Exit Group</a></li>
                                                        <li><a class="dropdown-item" href="#"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                        <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Unpin Chat</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center overflow-hidden">
                                                <span class="avatar avatar-lg online flex-shrink-0">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-05.jpg')}}" alt="img" class="rounded-circle">
                                                </span>
                                                <div class="ms-2 overflow-hidden">
                                                    <h6 class="text-truncate mb-1">Federico Wells</h6>
                                                    <p>Available</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class="dropdown">
                                                    <a href="#" data-bs-toggle="dropdown">
                                                        <i class="ti ti-dots-vertical"></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-end p-3">
                                                        <li><a class="dropdown-item" href="#"><i class="ti ti-logout-2 me-2"></i>Exit Group</a></li>
                                                        <li><a class="dropdown-item" href="#"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                                        <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Unpin Chat</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <a class="view-all link-primary d-inline-flex align-items-center justify-content-center" href="javascript:void(0);">
                                        View All(35 more)<i class="ti ti-arrow-right ms-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-wrapper other-info mb-0">
                        <div class="card mb-0">
                            <div class="card-body list-group profile-item">
                                <a href="javascript:void(0);" class="list-group-item" data-bs-toggle="modal" data-bs-target="#group-logout">
                                    <div class="profile-info">
                                        <h6><i class="ti ti-logout-2 me-2 text-danger"></i>Exit Group</h6>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="link-icon"><i class="ti ti-chevron-right"></i></span>
                                    </div>
                                </a>
                                <a href="javascript:void(0);" class="list-group-item" data-bs-toggle="modal" data-bs-target="#report-group">
                                    <div class="profile-info">
                                        <h6><i class="ti ti-thumb-down me-2 text-danger"></i>Report User</h6>
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
    <!-- /Group Info -->

    <!-- Favourites Info -->
    <div class="chat-offcanvas fav-canvas offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="contact-favourite">
        <div class="offcanvas-header">
            <h4 class="offcanvas-title"><a href="javascript:void(0);" data-bs-toggle="offcanvas" data-bs-target="#contact-profile" data-bs-dismiss="offcanvas"><i class="ti ti-arrow-left me-2"></i></a>Favourites</h4>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i class="ti ti-x"></i></button>
        </div>
        <div class="offcanvas-body">
            <div class="favourite-chats">
                <div class="text-end mb-4">
                    <a href="javascript:void(0);" class="btn btn-light"><i class="ti ti-heart-minus me-2"></i>Mark all Unfavourite</a>
                </div>
                <div class="chats">
                    <div class="chat-avatar">
                        <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="image">
                    </div>
                    <div class="chat-content">
                        <div class="chat-profile-name">
                            <h6>Edward Lietz<i class="ti ti-circle-filled fs-7 mx-2"></i><span class="chat-time">02:39 PM</span><span class="msg-read success"><i class="ti ti-checks"></i></span></h6>
                        </div>
                        <div class="chat-info">
                            <div class="message-content">
                                Thanks!!!, I ll Update you Once i check the Examples
                            </div>
                            <div class="chat-actions">
                                <a class="#" href="#" data-bs-toggle="dropdown">
                                    <i class="ti ti-dots-vertical"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Unfavourite</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                </ul>
                            </div>
                        </div>
                        <p>Saved on 23 Septemer 2024</p>
                    </div>
                </div>
                <div class="chats">
                    <div class="chat-avatar">
                        <img src="{{URL::asset('/build/img/profiles/avatar-04.jpg')}}" class="rounded-circle" alt="image">
                    </div>
                    <div class="chat-content">
                        <div class="chat-profile-name">
                            <h6>Carla Jenkins<i class="ti ti-circle-filled fs-7 mx-2"></i><span class="chat-time">02:45 PM</span><span class="msg-read success"><i class="ti ti-checks"></i></span></h6>
                        </div>
                        <div class="chat-info">
                            <div class="message-content bg-transparent p-0">
                                <div class="message-audio">
                                    <audio controls>
                                        <source src="build/img/audio/audio.mp3" type="audio/mpeg">
                                        Your browser does not support the audio element.
                                    </audio>
                                </div>
                            </div>
                            <div class="chat-actions">
                                <a class="#" href="#" data-bs-toggle="dropdown">
                                    <i class="ti ti-dots-vertical"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                    <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Unfavourite</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                </ul>
                            </div>
                        </div>
                        <p>Saved on 26 Septemer 2024</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Favourites Info -->

    <!-- Message Info -->
    <div class="chat-offcanvas fav-canvas offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="contact-message">
        <div class="offcanvas-header">
            <h4 class="offcanvas-title"><a href="javascript:void(0);" data-bs-toggle="offcanvas" data-bs-dismiss="offcanvas"><i class="ti ti-arrow-left me-2"></i></a>Message Info</h4>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i class="ti ti-x"></i></button>
        </div>
        <div class="offcanvas-body">
            <div class="info-chats">
                <div class="text-end mb-4">
                    <a href="javascript:void(0);" class="btn btn-light"><i class="ti ti-heart-minus me-2"></i>Mark all Unfavourite</a>
                </div>
                <div class="chats chats-right">
                    <div class="chat-content">
                        <div class="chat-info">
                            <div class="message-content">
                                Hey Edward! Doing well. Just finished up a client meeting. How's everyone else?
                            </div>
                        </div>
                    </div>
                    <div class="chat-avatar">
                        <img src="{{URL::asset('/build/img/profiles/avatar-17.jpg')}}" class="rounded-circle dreams_chat" alt="image">
                    </div>
                </div>
                <h6 class="mb-4"><i class="ti ti-checks text-success me-2"></i>Read By</h6>
                <div class="d-flex align-items-center mb-4">
                    <span class="avatar avatar-lg online">
                        <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" alt="img" class="rounded-circle">
                    </span>
                    <div class="ms-2 overflow-hidden">
                        <h6 class="text-truncate fw-normal mb-1">Edward Lietz</h6>
                        <p>02:40 PM </p>
                    </div>
                </div>
                <div class="d-flex align-items-center mb-4">
                    <span class="avatar avatar-lg online">
                        <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" alt="img" class="rounded-circle">
                    </span>
                    <div class="ms-2 overflow-hidden">
                        <h6 class="text-truncate fw-normal mb-1">Aaryian Jose</h6>
                        <p>02:40 PM </p>
                    </div>
                </div>
                <div class="d-flex align-items-center mb-4">
                    <span class="avatar avatar-lg online">
                        <img src="{{URL::asset('/build/img/profiles/avatar-02.jpg')}}" alt="img" class="rounded-circle">
                    </span>
                    <div class="ms-2 overflow-hidden">
                        <h6 class="text-truncate fw-normal mb-1">Sarika Jain</h6>
                        <p>02:40 PM </p>
                    </div>
                </div>
                <div class="d-flex align-items-center mb-0">
                    <span class="avatar avatar-lg online">
                        <img src="{{URL::asset('/build/img/profiles/avatar-03.jpg')}}" alt="img" class="rounded-circle">
                    </span>
                    <div class="ms-2 overflow-hidden">
                        <h6 class="text-truncate fw-normal mb-1">Clyde Smith</h6>
                        <p>02:40 PM </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Message Info -->

    @component('components.model-popup')
    @endcomponent

</div>
<!-- /Content -->

@endsection