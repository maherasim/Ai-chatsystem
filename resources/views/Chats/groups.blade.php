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

    /* Card-like enhancements */
    .card-like {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        border: 1px solid #eef2f7;
        margin-bottom: 15px;
        padding: 15px;
    }
    
    .card-like:hover {
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
        transform: translateY(-2px);
    }
    
    .create-group-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 6px 16px rgba(0, 112, 201, 0.15);
        border: 2px dashed #0070C9;
        transition: all 0.3s ease;
        padding: 20px;
        text-align: center;
        cursor: pointer;
        margin-bottom: 20px;
    }
    
    .create-group-card:hover {
        box-shadow: 0 8px 20px rgba(0, 112, 201, 0.25);
        transform: translateY(-3px);
        border-style: solid;
    }
    
    .online-contacts-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        padding: 20px;
        margin-bottom: 20px;
    }
    
    .chat-user-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        padding: 12px;
        margin-bottom: 12px;
        transition: all 0.2s ease;
    }
    
    .chat-user-card:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        transform: translateY(-1px);
    }
    
    .section-header {
        font-weight: 600;
        color: #333;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
    }
    
    .modal-card {
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        border: none;
    }
    
    .modal-header {
        background: linear-gradient(120deg, #0070C9, #0056b3);
        color: white;
        border-top-left-radius: 16px;
        border-top-right-radius: 16px;
        padding: 20px;
    }
    
    .contact-user.card-like {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 15px;
    }
    
    .contact-user .avatar {
        flex-shrink: 0;
    }
    
    .contact-user .ms-2 {
        flex-grow: 1;
        margin-left: 15px !important;
    }
    
    .contact-user .form-check {
        flex-shrink: 0;
        margin-bottom: 0;
    }
    
    .chat-title.card-like {
        background: #f8f9fa;
        border-left: 4px solid #0070C9;
        font-weight: 600;
        padding: 12px 15px;
        margin-bottom: 15px;
    }
</style>
<style>
    .meeting-header-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        flex-wrap: wrap;
        gap: 15px;
    }
    
    @media (max-width: 768px) {
        .meeting-header-container {
            flex-direction: column;
            align-items: flex-start;
        }
    }

    .meeting-info h1 {
        margin: 0;
        font-size: 24px;
        font-weight: 500;
        color: #333333;
    }
    
    @media (max-width: 768px) {
        .meeting-info h1 {
            font-size: 20px;
        }
    }

    .meeting-info p {
        margin: 5px 0 0;
        font-size: 14px;
        color: #666666;
    }

    .add-meeting-button {
        display: flex;
        align-items: center;
        padding: 8px 12px;
        border: 1px solid #e0e0e0;
        border-radius: 5px;
        background-color: #f9f9f9;
        cursor: pointer;
        white-space: nowrap;
    }
    
    @media (max-width: 768px) {
        .add-meeting-button {
            width: 100%;
            justify-content: center;
        }
    }

    .add-meeting-button:hover {
        background-color: #f1f1f1;
    }

    .icon-container {
        position: relative;
        width: 32px;
        height: 32px;
        margin-right: 10px;
    }

    .monitor-icon,
    .camera-icon {
        position: absolute;
        background-color: #4CAF50;
        border-radius: 3px;
    }

    .monitor-icon {
        width: 25px;
        height: 20px;
        border: 2px solid #4CAF50;
        background-color: #E8F5E9;
        left: 0;
        top: 5px;
    }

    .monitor-icon::before {
        content: '';
        position: absolute;
        width: 5px;
        height: 5px;
        background-color: #4CAF50;
        bottom: -7px;
        left: 10px;
    }

    .camera-icon {
        width: 15px;
        height: 10px;
        background-color: #E53935;
        border-radius: 2px;
        right: 0;
        top: 0;
        transform: rotate(15deg);
    }

    .text-container {
        display: flex;
        flex-direction: column;
        text-align: left;
    }

    .text-container strong {
        font-size: 14px;
        font-weight: 600;
        color: #333333;
    }

    .text-container span {
        font-size: 12px;
        color: #999999;
        margin-top: 2px;
    }



    .meeting-filter-bar {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 20px;
        flex-wrap: wrap;
    }
    
    @media (max-width: 768px) {
        .meeting-filter-bar {
            justify-content: center;
        }
    }

    .meeting-filter-item {
        display: flex;
        align-items: center;
        background-color: #ffffff;
        border: 1px solid #e0e0e0;
        border-radius: 5px;
        padding: 8px 12px;
        font-size: 14px;
        color: #555555;
        cursor: pointer;
        white-space: nowrap;
    }

    .meeting-filter-item.active {
        background-color: #e0f7fa;
        border-color: #b2ebf2;
    }

    .icon {
        position: relative;
        width: 28px;
        height: 28px;
        margin-right: 8px;
        border-radius: 5px;
        display: flex;
        justify-content: center;
        align-items: center;
    }


    .icon.green {
        background-color: #4CAF50;
    }

    .icon.green::before {
        content: '';
        position: absolute;
        width: 12px;
        height: 12px;
        background-color: white;
        border-radius: 50%;
    }

    .icon.green::after {
        content: '✓';
        position: absolute;
        color: #4CAF50;
        font-size: 10px;
        font-weight: bold;
    }


    .icon.gray {
        background-color: #78909C;
    }

    .icon.gray::before {
        content: '';
        position: absolute;
        width: 14px;
        height: 18px;
        background-color: white;
        border-radius: 2px;
        transform: rotate(-10deg);
    }

    .icon.gray::after {
        content: '';
        position: absolute;
        width: 8px;
        height: 8px;
        background-color: #78909C;
        border-radius: 50%;
        top: 5px;
        right: 5px;
        transform: rotate(-10deg);
    }


    .icon.blue {
        background-color: #2196F3;
    }

    .icon.blue::before {
        content: '';
        position: absolute;
        width: 14px;
        height: 14px;
        background-color: white;
        border-radius: 50%;
    }

    .icon.blue::after {
        content: '';
        position: absolute;
        width: 2px;
        height: 5px;
        background-color: #2196F3;
        top: 8px;
        left: 13px;
        transform-origin: bottom center;
        animation: tick-move 2s infinite linear;
    }

    .icon.blue .hour-hand {
        position: absolute;
        width: 2px;
        height: 3px;
        background-color: #2196F3;
        top: 10px;
        left: 13px;
        transform-origin: bottom center;
        transform: rotate(-30deg);
    }

    .icon.blue .dot {
        position: absolute;
        width: 2px;
        height: 2px;
        background-color: #2196F3;
        border-radius: 50%;
    }

    @keyframes tick-move {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }



    .icon.red {
        background-color: #F44336;
    }

    .icon.red::before {
        content: '';
        position: absolute;
        width: 14px;
        height: 14px;
        background-color: white;
        border-radius: 50%;
    }

    .icon.red::after {
        content: 'x';
        position: absolute;
        color: #F44336;
        font-size: 16px;
        font-weight: bold;
    }


    .icon.yellow {
        background-color: #FFC107;
    }

    .icon.yellow::before {
        content: '';
        position: absolute;
        width: 14px;
        height: 14px;
        background-color: white;
        border-radius: 2px;
    }

    .icon.yellow::after {
        content: '📂';
        position: absolute;
        font-size: 12px;
    }

    .filter-text {
        display: flex;
        flex-direction: column;
        line-height: 1.2;
    }

    .filter-text strong {
        font-weight: bold;
        color: #333;
    }

    .filter-text span {
        font-size: 12px;
        color: #777;
    }
    
    .meeting-card {
        width: calc(17.5% - 5px);
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 20px;
        display: flex;
        flex-direction: column;
    }
    
    @media (max-width: 1200px) {
        .meeting-card {
            width: calc(25% - 5px);
        }
    }
    
    @media (max-width: 992px) {
        .meeting-card {
            width: calc(33.33% - 5px);
        }
    }
    
    @media (max-width: 768px) {
        .meeting-card {
            width: calc(50% - 5px);
        }
    }
    
    @media (max-width: 576px) {
        .meeting-card {
            width: calc(100% - 5px);
        }
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
                        <div class="chat-search-header">
                            <!-- <div class="header-title d-flex align-items-center justify-content-between">
                                <h4 class="mb-3">AI's</h4>
                                <div class="d-flex align-items-center mb-3">
                                    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#new-Ai" class="add-icon btn btn-primary p-0 d-flex align-items-center justify-content-center fs-16 me-2"><i class="ti ti-plus"></i></a>
                                </div>
                            </div> -->
                            <div
                                style="display: flex; justify-content: center; align-items: center; height: 76px; background-color: white; border-radius: 10px; border: 1px solid #dcdcdc; font-family: 'Segoe UI', sans-serif; cursor: pointer; width: 100%;"
                                data-bs-toggle="modal"
                                data-bs-target="#new-group">
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <img src="{{ asset('/build/img/Group.svg') }}" alt="Group Icon" width="44" height="44" />
                                    <span style="font-weight: 600; font-size: 26px; color: #0070C9;">Create a group</span>
                                </div>
                            </div>

                            <!-- header Subject -->


                            <!-- /header subject -->
                        </div>
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
            <div class="meeting-header-container">
        <div class="meeting-info">
            <h1>Meeting Overview</h1>
            <p>Meeting List</p>
        </div>
        <button class="add-meeting-button">
            <div class="icon-container">
                <span class="monitor-icon"></span>
                <span class="camera-icon"></span>
            </div>
            <div class="text-container">
                <strong>Add Meeting</strong>
                <span>Plan a Meeting</span>
            </div>
        </button>
    </div>


    <div class="meeting-filter-bar">
        <div class="meeting-filter-item active">
            <span class="icon green"></span>
            <div class="filter-text">
                <strong>Today Meetings</strong>
                <span class="total">Total: 10</span>
            </div>
        </div>
        <div class="meeting-filter-item">
            <span class="icon gray"></span>
            <div class="filter-text">
                <strong>New Meetings</strong>
                <span class="request">Meeting request</span>
            </div>
        </div>
        <div class="meeting-filter-item">
            <span class="icon blue"></span>
            <div class="filter-text">
                <strong>Meetings Soon</strong>
                <span class="request">Meeting request</span>
            </div>
        </div>
        <div class="meeting-filter-item">
            <span class="icon red"></span>
            <div class="filter-text">
                <strong>Rejected Meetings</strong>
                <span class="total">Total: 5</span>
            </div>
        </div>
        <div class="meeting-filter-item">
            <span class="icon yellow"></span>
            <div class="filter-text">
                <strong>Meetings Archive</strong>
                <span class="total">Total List</span>
            </div>
        </div>
    </div>



    <div class="shortly-meeting-header" style="padding: 0 20px; background-color: #ffffff; margin-top: 0;">
        <h2 style="margin: 0; font-size: 20px; font-weight: 600; color: #333333;">Shortly Meeting</h2>
        <p style="margin: 0; font-size: 14px; color: #666666;">meeting in short Time</p>
    </div>



    <div style="display: flex; flex-wrap: wrap; gap: 5px; padding: 20px 0; ">
        <div class="meeting-card">
            
        @media (max-width: 1200px) {
            .meeting-card {
                width: calc(25% - 5px);
            }
        }
        
        @media (max-width: 992px) {
            .meeting-card {
                width: calc(33.33% - 5px);
            }
        }
        
        @media (max-width: 768px) {
            .meeting-card {
                width: calc(50% - 5px);
            }
        }
        
        @media (max-width: 576px) {
            .meeting-card {
                width: calc(100% - 5px);
            }
        }
            <div class="card-header"
                style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                <div class="admin-info" style="display: flex; align-items: center;">
                    <img src="https://via.placeholder.com/40" alt="Admin" class="admin-avatar"
                        style="width: 40px; height: 40px; border-radius: 50%; margin-right: 10px; object-fit: cover;">
                    <div class="admin-text" style="display: flex; flex-direction: column;">
                        <div class="admin-name" style="font-weight: 600; font-size: 14px; color: #333333;">Admin name
                        </div>
                        <div class="admin-date" style="font-size: 12px; color: #888888;">Created Time & Date</div>
                    </div>
                </div>
                <div class="priority-tag high"
                    style="font-size: 12px; padding: 4px 8px; border-radius: 4px; font-weight: 600; display: flex; align-items: center; gap: 5px; color: #F44336; border: 1px solid #e0e0e0;">
                    <span class="dot"
                        style="width: 8px; height: 8px; background-color: #F44336; border-radius: 50%;"></span> High
                </div>
            </div>

            <div class="card-body" style="margin-bottom: 20px;">
                <div class="meeting-info-row"
                    style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px;">
                    <div class="meeting-title-group" style="display: flex; flex-direction: column;">
                        <span class="title-text" style="font-size: 18px; font-weight: 600; color: #333333;">Title of
                            Meeting</span>
                        <span class="project-title" style="font-size: 12px; color: #888888; margin-top: 5px;">Project
                            Title</span>
                    </div>
                    <div class="avatars-group" style="display: flex;">
                        <img src="https://via.placeholder.com/20" alt="Avatar" class="member-avatar"
                            style="width: 25px; height: 25px; border-radius: 50%; border: 2px solid #ffffff; margin-left: -8px; box-shadow: 0 0 2px rgba(0, 0, 0, 0.2); object-fit: cover;">
                        <img src="https://via.placeholder.com/20" alt="Avatar" class="member-avatar"
                            style="width: 25px; height: 25px; border-radius: 50%; border: 2px solid #ffffff; margin-left: -8px; box-shadow: 0 0 2px rgba(0, 0, 0, 0.2); object-fit: cover;">
                        <img src="https://via.placeholder.com/20" alt="Avatar" class="member-avatar"
                            style="width: 25px; height: 25px; border-radius: 50%; border: 2px solid #ffffff; margin-left: -8px; box-shadow: 0 0 2px rgba(0, 0, 0, 0.2); object-fit: cover;">
                    </div>
                </div>
                <p class="description" style="font-size: 14px; color: #666666; line-height: 1.4; margin: 0;">Here we
                    will add the description of the TODO Only you is Superadmin TODO</p>
            </div>

            <div class="card-footer"
                style="display: flex; flex-direction: column; align-items: center; padding-top: 15px; border-top: 1px solid #eeeeee; margin-top: 15px; gap: 10px;">
                <div class="time-schedule"
                    style="display: flex; gap: 10px; background-color: #f9f9f9; padding: 5px 10px; border-radius: 5px; font-size: 14px;">
                    <div class="schedule-item" style="display: flex; align-items: center; color: #555555; gap: 5px;">
                        <span class="schedule-icon"><i class="fas fa-calendar-alt"></i></span>
                        <span class="schedule-text">Now</span>
                    </div>
                    <div class="schedule-item time"
                        style="display: flex; align-items: center; color: #F44336; gap: 5px;">
                        <span class="schedule-icon"><i class="fas fa-clock"></i></span>
                        <span class="schedule-text">10:00 - 10:30</span>
                    </div>
                </div>
                <button class="action-button red"
                    style="border: none; border-radius: 20px; padding: 8px 16px; color: #ffffff; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 5px; background-color: #F44336;">
                    <span>join now</span>
                    <span class="arrow-icon" style="font-size: 16px; transform: rotate(45deg);">→</span>
                </button>
            </div>
        </div>
        <div class="meeting-card">
            <div class="card-header"
                style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                <div class="admin-info" style="display: flex; align-items: center;">
                    <img src="https://via.placeholder.com/40" alt="Admin" class="admin-avatar"
                        style="width: 40px; height: 40px; border-radius: 50%; margin-right: 10px; object-fit: cover;">
                    <div class="admin-text" style="display: flex; flex-direction: column;">
                        <div class="admin-name" style="font-weight: 600; font-size: 14px; color: #333333;">Admin name
                        </div>
                        <div class="admin-date" style="font-size: 12px; color: #888888;">Created Time & Date</div>
                    </div>
                </div>
                <div class="priority-tag high"
                    style="font-size: 12px; padding: 4px 8px; border-radius: 4px; font-weight: 600; display: flex; align-items: center; gap: 5px; color: black; border: 1px solid #e0e0e0;">
                    <span class="dot"
                        style="width: 8px; height: 8px; background-color: rgb(76, 178, 76); border-radius: 50%;"></span>
                    High
                </div>
            </div>

            <div class="card-body" style="margin-bottom: 20px;">
                <div class="meeting-info-row"
                    style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px;">
                    <div class="meeting-title-group" style="display: flex; flex-direction: column;">
                        <span class="title-text" style="font-size: 18px; font-weight: 600; color: #333333;">Title of
                            Meeting</span>
                        <span class="project-title" style="font-size: 12px; color: #888888; margin-top: 5px;">Project
                            Title</span>
                    </div>
                    <div class="avatars-group" style="display: flex;">
                        <img src="https://via.placeholder.com/20" alt="Avatar" class="member-avatar"
                            style="width: 25px; height: 25px; border-radius: 50%; border: 2px solid #ffffff; margin-left: -8px; box-shadow: 0 0 2px rgba(0, 0, 0, 0.2); object-fit: cover;">
                        <img src="https://via.placeholder.com/20" alt="Avatar" class="member-avatar"
                            style="width: 25px; height: 25px; border-radius: 50%; border: 2px solid #ffffff; margin-left: -8px; box-shadow: 0 0 2px rgba(0, 0, 0, 0.2); object-fit: cover;">
                        <img src="https://via.placeholder.com/20" alt="Avatar" class="member-avatar"
                            style="width: 25px; height: 25px; border-radius: 50%; border: 2px solid #ffffff; margin-left: -8px; box-shadow: 0 0 2px rgba(0, 0, 0, 0.2); object-fit: cover;">
                    </div>
                </div>
                <p class="description" style="font-size: 14px; color: #666666; line-height: 1.4; margin: 0;">Here we
                    will add the description of the TODO Only you is Superadmin TODO</p>
            </div>

            <div class="card-footer"
                style="display: flex; flex-direction: column; align-items: center; padding-top: 15px; border-top: 1px solid #eeeeee; margin-top: 15px; gap: 10px;">
                <div class="time-schedule"
                    style="display: flex; gap: 10px; background-color: #f9f9f9; padding: 5px 10px; border-radius: 5px; font-size: 14px;">
                    <div class="schedule-item" style="display: flex; align-items: center; color: #555555; gap: 5px;">
                        <span class="schedule-icon"><i class="fas fa-calendar-alt"></i></span>
                        <span class="schedule-text">Now</span>
                    </div>
                    <div class="schedule-item time"
                        style="display: flex; align-items: center; color: #F44336; gap: 5px;">
                        <span class="schedule-icon"><i class="fas fa-clock"></i></span>
                        <span class="schedule-text">10:00 - 10:30</span>
                    </div>
                </div>
                <button class="action-button red"
                    style="border: none; border-radius: 20px; padding: 8px 16px; color: #ffffff; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 5px; background-color: rgb(233, 233, 96);">
                    <span>join now</span>
                    <span class="arrow-icon" style="font-size: 16px; transform: rotate(45deg);">→</span>
                </button>
            </div>
        </div>
        <div class="meeting-card">
            <div class="card-header"
                style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                <div class="admin-info" style="display: flex; align-items: center;">
                    <img src="https://via.placeholder.com/40" alt="Admin" class="admin-avatar"
                        style="width: 40px; height: 40px; border-radius: 50%; margin-right: 10px; object-fit: cover;">
                    <div class="admin-text" style="display: flex; flex-direction: column;">
                        <div class="admin-name" style="font-weight: 600; font-size: 14px; color: #333333;">Admin name
                        </div>
                        <div class="admin-date" style="font-size: 12px; color: #888888;">Created Time & Date</div>
                    </div>
                </div>
                <div class="priority-tag high"
                    style="font-size: 12px; padding: 4px 8px; border-radius: 4px; font-weight: 600; display: flex; align-items: center; gap: 5px; color: black; border: 1px solid #e0e0e0;">
                    <span class="dot"
                        style="width: 8px; height: 8px; background-color: rgb(76, 178, 76); border-radius: 50%;"></span>
                    High
                </div>
            </div>

            <div class="card-body" style="margin-bottom: 20px;">
                <div class="meeting-info-row"
                    style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px;">
                    <div class="meeting-title-group" style="display: flex; flex-direction: column;">
                        <span class="title-text" style="font-size: 18px; font-weight: 600; color: #333333;">Title of
                            Meeting</span>
                        <span class="project-title" style="font-size: 12px; color: #888888; margin-top: 5px;">Project
                            Title</span>
                    </div>
                    <div class="avatars-group" style="display: flex;">
                        <img src="https://via.placeholder.com/20" alt="Avatar" class="member-avatar"
                            style="width: 25px; height: 25px; border-radius: 50%; border: 2px solid #ffffff; margin-left: -8px; box-shadow: 0 0 2px rgba(0, 0, 0, 0.2); object-fit: cover;">
                        <img src="https://via.placeholder.com/20" alt="Avatar" class="member-avatar"
                            style="width: 25px; height: 25px; border-radius: 50%; border: 2px solid #ffffff; margin-left: -8px; box-shadow: 0 0 2px rgba(0, 0, 0, 0.2); object-fit: cover;">
                        <img src="https://via.placeholder.com/20" alt="Avatar" class="member-avatar"
                            style="width: 25px; height: 25px; border-radius: 50%; border: 2px solid #ffffff; margin-left: -8px; box-shadow: 0 0 2px rgba(0, 0, 0, 0.2); object-fit: cover;">
                    </div>
                </div>
                <p class="description" style="font-size: 14px; color: #666666; line-height: 1.4; margin: 0;">Here we
                    will add the description of the TODO Only you is Superadmin TODO</p>
            </div>

            <div class="card-footer"
                style="display: flex; flex-direction: column; align-items: center; padding-top: 15px; border-top: 1px solid #eeeeee; margin-top: 15px; gap: 10px;">
                <div class="time-schedule"
                    style="display: flex; gap: 10px; background-color: #f9f9f9; padding: 5px 10px; border-radius: 5px; font-size: 14px;">
                    <div class="schedule-item" style="display: flex; align-items: center; color: #555555; gap: 5px;">
                        <span class="schedule-icon"><i class="fas fa-calendar-alt"></i></span>
                        <span class="schedule-text">Now</span>
                    </div>
                    <div class="schedule-item time"
                        style="display: flex; align-items: center; color: #F44336; gap: 5px;">
                        <span class="schedule-icon"><i class="fas fa-clock"></i></span>
                        <span class="schedule-text">10:00 - 10:30</span>
                    </div>
                </div>
                <button class="action-button red"
                    style="border: none; border-radius: 20px; padding: 8px 16px; color: #ffffff; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 5px; background-color: rgb(233, 233, 96);">
                    <span>join now</span>
                    <span class="arrow-icon" style="font-size: 16px; transform: rotate(45deg);">→</span>
                </button>
            </div>
        </div>
        <div class="meeting-card">
            <div class="card-header"
                style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                <div class="admin-info" style="display: flex; align-items: center;">
                    <img src="https://via.placeholder.com/40" alt="Admin" class="admin-avatar"
                        style="width: 40px; height: 40px; border-radius: 50%; margin-right: 10px; object-fit: cover;">
                    <div class="admin-text" style="display: flex; flex-direction: column;">
                        <div class="admin-name" style="font-weight: 600; font-size: 14px; color: #333333;">Admin name
                        </div>
                        <div class="admin-date" style="font-size: 12px; color: #888888;">Created Time & Date</div>
                    </div>
                </div>
                <div class="priority-tag high"
                    style="font-size: 12px; padding: 4px 8px; border-radius: 4px; font-weight: 600; display: flex; align-items: center; gap: 5px; color: black; border: 1px solid #e0e0e0;">
                    <span class="dot"
                        style="width: 8px; height: 8px; background-color: rgb(76, 178, 76); border-radius: 50%;"></span>
                    High
                </div>
            </div>

            <div class="card-body" style="margin-bottom: 20px;">
                <div class="meeting-info-row"
                    style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px;">
                    <div class="meeting-title-group" style="display: flex; flex-direction: column;">
                        <span class="title-text" style="font-size: 18px; font-weight: 600; color: #333333;">Title of
                            Meeting</span>
                        <span class="project-title" style="font-size: 12px; color: #888888; margin-top: 5px;">Project
                            Title</span>
                    </div>
                    <div class="avatars-group" style="display: flex;">
                        <img src="https://via.placeholder.com/20" alt="Avatar" class="member-avatar"
                            style="width: 25px; height: 25px; border-radius: 50%; border: 2px solid #ffffff; margin-left: -8px; box-shadow: 0 0 2px rgba(0, 0, 0, 0.2); object-fit: cover;">
                        <img src="https://via.placeholder.com/20" alt="Avatar" class="member-avatar"
                            style="width: 25px; height: 25px; border-radius: 50%; border: 2px solid #ffffff; margin-left: -8px; box-shadow: 0 0 2px rgba(0, 0, 0, 0.2); object-fit: cover;">
                        <img src="https://via.placeholder.com/20" alt="Avatar" class="member-avatar"
                            style="width: 25px; height: 25px; border-radius: 50%; border: 2px solid #ffffff; margin-left: -8px; box-shadow: 0 0 2px rgba(0, 0, 0, 0.2); object-fit: cover;">
                    </div>
                </div>
                <p class="description" style="font-size: 14px; color: #666666; line-height: 1.4; margin: 0;">Here we
                    will add the description of the TODO Only you is Superadmin TODO</p>
            </div>

            <div class="card-footer"
                style="display: flex; flex-direction: column; align-items: center; padding-top: 15px; border-top: 1px solid #eeeeee; margin-top: 15px; gap: 10px;">
                <div class="time-schedule"
                    style="display: flex; gap: 10px; background-color: #f9f9f9; padding: 5px 10px; border-radius: 5px; font-size: 14px;">
                    <div class="schedule-item" style="display: flex; align-items: center; color: #555555; gap: 5px;">
                        <span class="schedule-icon"><i class="fas fa-calendar-alt"></i></span>
                        <span class="schedule-text">Now</span>
                    </div>
                    <div class="schedule-item time"
                        style="display: flex; align-items: center; color: #F44336; gap: 5px;">
                        <span class="schedule-icon"><i class="fas fa-clock"></i></span>
                        <span class="schedule-text">10:00 - 10:30</span>
                    </div>
                </div>
                <button class="action-button red"
                    style="border: none; border-radius: 20px; padding: 8px 16px; color: #ffffff; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 5px; background-color: rgb(233, 233, 96);">
                    <span>join now</span>
                    <span class="arrow-icon" style="font-size: 16px; transform: rotate(45deg);">→</span>
                </button>
            </div>
        </div>
        <div class="meeting-card"
            style="width: calc(17.5% - 5px); background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); padding: 20px; display: flex; flex-direction: column;">
            <div class="card-header"
                style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                <div class="admin-info" style="display: flex; align-items: center;">
                    <img src="https://via.placeholder.com/40" alt="Admin" class="admin-avatar"
                        style="width: 40px; height: 40px; border-radius: 50%; margin-right: 10px; object-fit: cover;">
                    <div class="admin-text" style="display: flex; flex-direction: column;">
                        <div class="admin-name" style="font-weight: 600; font-size: 14px; color: #333333;">Admin name
                        </div>
                        <div class="admin-date" style="font-size: 12px; color: #888888;">Created Time & Date</div>
                    </div>
                </div>
                <div class="priority-tag high"
                    style="font-size: 12px; padding: 4px 8px; border-radius: 4px; font-weight: 600; display: flex; align-items: center; gap: 5px; color: black; border: 1px solid #e0e0e0;">
                    <span class="dot"
                        style="width: 8px; height: 8px; background-color: rgb(76, 178, 76); border-radius: 50%;"></span>
                    High
                </div>
            </div>

            <div class="card-body" style="margin-bottom: 20px;">
                <div class="meeting-info-row"
                    style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px;">
                    <div class="meeting-title-group" style="display: flex; flex-direction: column;">
                        <span class="title-text" style="font-size: 18px; font-weight: 600; color: #333333;">Title of
                            Meeting</span>
                        <span class="project-title" style="font-size: 12px; color: #888888; margin-top: 5px;">Project
                            Title</span>
                    </div>
                    <div class="avatars-group" style="display: flex;">
                        <img src="https://via.placeholder.com/20" alt="Avatar" class="member-avatar"
                            style="width: 25px; height: 25px; border-radius: 50%; border: 2px solid #ffffff; margin-left: -8px; box-shadow: 0 0 2px rgba(0, 0, 0, 0.2); object-fit: cover;">
                        <img src="https://via.placeholder.com/20" alt="Avatar" class="member-avatar"
                            style="width: 25px; height: 25px; border-radius: 50%; border: 2px solid #ffffff; margin-left: -8px; box-shadow: 0 0 2px rgba(0, 0, 0, 0.2); object-fit: cover;">
                        <img src="https://via.placeholder.com/20" alt="Avatar" class="member-avatar"
                            style="width: 25px; height: 25px; border-radius: 50%; border: 2px solid #ffffff; margin-left: -8px; box-shadow: 0 0 2px rgba(0, 0, 0, 0.2); object-fit: cover;">
                    </div>
                </div>
                <p class="description" style="font-size: 14px; color: #666666; line-height: 1.4; margin: 0;">Here we
                    will add the description of the TODO Only you is Superadmin TODO</p>
            </div>

            <div class="card-footer"
                style="display: flex; flex-direction: column; align-items: center; padding-top: 15px; border-top: 1px solid #eeeeee; margin-top: 15px; gap: 10px;">
                <div class="time-schedule"
                    style="display: flex; gap: 10px; background-color: #f9f9f9; padding: 5px 10px; border-radius: 5px; font-size: 14px;">
                    <div class="schedule-item" style="display: flex; align-items: center; color: #555555; gap: 5px;">
                        <span class="schedule-icon"><i class="fas fa-calendar-alt"></i></span>
                        <span class="schedule-text">Now</span>
                    </div>
                    <div class="schedule-item time"
                        style="display: flex; align-items: center; color: #F44336; gap: 5px;">
                        <span class="schedule-icon"><i class="fas fa-clock"></i></span>
                        <span class="schedule-text">10:00 - 10:30</span>
                    </div>
                </div>
                <button class="action-button red"
                    style="border: none; border-radius: 20px; padding: 8px 16px; color: #ffffff; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 5px; background-color: rgb(233, 233, 96);">
                    <span>join now</span>
                    <span class="arrow-icon" style="font-size: 16px; transform: rotate(45deg);">→</span>
                </button>
            </div>
        </div>
    </div>


    <div style="padding: 0 20px; background-color: #ffffff;  margin-top: 0;">
        <h2 style="margin: 0; font-size: 20px; font-weight: 600; color: #333333;">Postponed meetings</h2>
        <p style="margin: 0; font-size: 14px; color: #666666;">Meeting will started Later</p>
    </div>



    <div style="display: flex; flex-wrap: wrap; gap: 5px; padding: 20px 0; ">
        <div class="meeting-card"
            style="width: calc(17.5% - 5px); background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); padding: 20px; display: flex; flex-direction: column;">
            <div class="card-header"
                style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                <div class="admin-info" style="display: flex; align-items: center;">
                    <img src="https://via.placeholder.com/40" alt="Admin" class="admin-avatar"
                        style="width: 40px; height: 40px; border-radius: 50%; margin-right: 10px; object-fit: cover;">
                    <div class="admin-text" style="display: flex; flex-direction: column;">
                        <div class="admin-name" style="font-weight: 600; font-size: 14px; color: #333333;">Admin name
                        </div>
                        <div class="admin-date" style="font-size: 12px; color: #888888;">Created Time & Date</div>
                    </div>
                </div>
                <div class="priority-tag high"
                    style="font-size: 12px; padding: 4px 8px; border-radius: 4px; font-weight: 600; display: flex; align-items: center; gap: 5px; color: #F44336; border: 1px solid #e0e0e0;">
                    <span class="dot"
                        style="width: 8px; height: 8px; background-color: #F44336; border-radius: 50%;"></span> High
                </div>
            </div>

            <div class="card-body" style="margin-bottom: 20px;">
                <div class="meeting-info-row"
                    style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px;">
                    <div class="meeting-title-group" style="display: flex; flex-direction: column;">
                        <span class="title-text" style="font-size: 18px; font-weight: 600; color: #333333;">Title of
                            Meeting</span>
                        <span class="project-title" style="font-size: 12px; color: #888888; margin-top: 5px;">Project
                            Title</span>
                    </div>
                    <div class="avatars-group" style="display: flex;">
                        <img src="https://via.placeholder.com/20" alt="Avatar" class="member-avatar"
                            style="width: 25px; height: 25px; border-radius: 50%; border: 2px solid #ffffff; margin-left: -8px; box-shadow: 0 0 2px rgba(0, 0, 0, 0.2); object-fit: cover;">
                        <img src="https://via.placeholder.com/20" alt="Avatar" class="member-avatar"
                            style="width: 25px; height: 25px; border-radius: 50%; border: 2px solid #ffffff; margin-left: -8px; box-shadow: 0 0 2px rgba(0, 0, 0, 0.2); object-fit: cover;">
                        <img src="https://via.placeholder.com/20" alt="Avatar" class="member-avatar"
                            style="width: 25px; height: 25px; border-radius: 50%; border: 2px solid #ffffff; margin-left: -8px; box-shadow: 0 0 2px rgba(0, 0, 0, 0.2); object-fit: cover;">
                    </div>
                </div>
                <p class="description" style="font-size: 14px; color: #666666; line-height: 1.4; margin: 0;">Here we
                    will add the description of the TODO Only you is Superadmin TODO</p>
            </div>

            <div class="card-footer"
                style="display: flex; flex-direction: column; align-items: center; padding-top: 15px; border-top: 1px solid #eeeeee; margin-top: 15px; gap: 10px;">
                <div class="time-schedule"
                    style="display: flex; gap: 10px; background-color: #f9f9f9; padding: 5px 10px; border-radius: 5px; font-size: 14px;">
                    <div class="schedule-item" style="display: flex; align-items: center; color: #555555; gap: 5px;">
                        <span class="schedule-icon"><i class="fas fa-calendar-alt"></i></span>
                        <span class="schedule-text">Now</span>
                    </div>
                    <div class="schedule-item time"
                        style="display: flex; align-items: center; color: #F44336; gap: 5px;">
                        <span class="schedule-icon"><i class="fas fa-clock"></i></span>
                        <span class="schedule-text">10:00 - 10:30</span>
                    </div>
                </div>
                <button class="action-button red"
                    style="border: none; border-radius: 20px; padding: 8px 16px; color: #ffffff; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 5px; background-color: #F44336;">
                    <span>join now</span>
                    <span class="arrow-icon" style="font-size: 16px; transform: rotate(45deg);">→</span>
                </button>
            </div>
        </div>
        <div class="meeting-card"
            style="width: calc(17.5% - 5px); background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); padding: 20px; display: flex; flex-direction: column;">
            <div class="card-header"
                style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                <div class="admin-info" style="display: flex; align-items: center;">
                    <img src="https://via.placeholder.com/40" alt="Admin" class="admin-avatar"
                        style="width: 40px; height: 40px; border-radius: 50%; margin-right: 10px; object-fit: cover;">
                    <div class="admin-text" style="display: flex; flex-direction: column;">
                        <div class="admin-name" style="font-weight: 600; font-size: 14px; color: #333333;">Admin name
                        </div>
                        <div class="admin-date" style="font-size: 12px; color: #888888;">Created Time & Date</div>
                    </div>
                </div>
                <div class="priority-tag high"
                    style="font-size: 12px; padding: 4px 8px; border-radius: 4px; font-weight: 600; display: flex; align-items: center; gap: 5px; color: black; border: 1px solid #e0e0e0;">
                    <span class="dot"
                        style="width: 8px; height: 8px; background-color: rgb(76, 178, 76); border-radius: 50%;"></span>
                    High
                </div>
            </div>

            <div class="card-body" style="margin-bottom: 20px;">
                <div class="meeting-info-row"
                    style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px;">
                    <div class="meeting-title-group" style="display: flex; flex-direction: column;">
                        <span class="title-text" style="font-size: 18px; font-weight: 600; color: #333333;">Title of
                            Meeting</span>
                        <span class="project-title" style="font-size: 12px; color: #888888; margin-top: 5px;">Project
                            Title</span>
                    </div>
                    <div class="avatars-group" style="display: flex;">
                        <img src="https://via.placeholder.com/20" alt="Avatar" class="member-avatar"
                            style="width: 25px; height: 25px; border-radius: 50%; border: 2px solid #ffffff; margin-left: -8px; box-shadow: 0 0 2px rgba(0, 0, 0, 0.2); object-fit: cover;">
                        <img src="https://via.placeholder.com/20" alt="Avatar" class="member-avatar"
                            style="width: 25px; height: 25px; border-radius: 50%; border: 2px solid #ffffff; margin-left: -8px; box-shadow: 0 0 2px rgba(0, 0, 0, 0.2); object-fit: cover;">
                        <img src="https://via.placeholder.com/20" alt="Avatar" class="member-avatar"
                            style="width: 25px; height: 25px; border-radius: 50%; border: 2px solid #ffffff; margin-left: -8px; box-shadow: 0 0 2px rgba(0, 0, 0, 0.2); object-fit: cover;">
                    </div>
                </div>
                <p class="description" style="font-size: 14px; color: #666666; line-height: 1.4; margin: 0;">Here we
                    will add the description of the TODO Only you is Superadmin TODO</p>
            </div>

            <div class="card-footer"
                style="display: flex; flex-direction: column; align-items: center; padding-top: 15px; border-top: 1px solid #eeeeee; margin-top: 15px; gap: 10px;">
                <div class="time-schedule"
                    style="display: flex; gap: 10px; background-color: #f9f9f9; padding: 5px 10px; border-radius: 5px; font-size: 14px;">
                    <div class="schedule-item" style="display: flex; align-items: center; color: #555555; gap: 5px;">
                        <span class="schedule-icon"><i class="fas fa-calendar-alt"></i></span>
                        <span class="schedule-text">Now</span>
                    </div>
                    <div class="schedule-item time"
                        style="display: flex; align-items: center; color: #F44336; gap: 5px;">
                        <span class="schedule-icon"><i class="fas fa-clock"></i></span>
                        <span class="schedule-text">10:00 - 10:30</span>
                    </div>
                </div>
                <button class="action-button red"
                    style="border: none; border-radius: 20px; padding: 8px 16px; color: #ffffff; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 5px; background-color: rgb(233, 233, 96);">
                    <span>join now</span>
                    <span class="arrow-icon" style="font-size: 16px; transform: rotate(45deg);">→</span>
                </button>
            </div>
        </div>
        <div class="meeting-card"
            style="width: calc(17.5% - 5px); background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); padding: 20px; display: flex; flex-direction: column;">
            <div class="card-header"
                style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                <div class="admin-info" style="display: flex; align-items: center;">
                    <img src="https://via.placeholder.com/40" alt="Admin" class="admin-avatar"
                        style="width: 40px; height: 40px; border-radius: 50%; margin-right: 10px; object-fit: cover;">
                    <div class="admin-text" style="display: flex; flex-direction: column;">
                        <div class="admin-name" style="font-weight: 600; font-size: 14px; color: #333333;">Admin name
                        </div>
                        <div class="admin-date" style="font-size: 12px; color: #888888;">Created Time & Date</div>
                    </div>
                </div>
                <div class="priority-tag high"
                    style="font-size: 12px; padding: 4px 8px; border-radius: 4px; font-weight: 600; display: flex; align-items: center; gap: 5px; color: black; border: 1px solid #e0e0e0;">
                    <span class="dot"
                        style="width: 8px; height: 8px; background-color: rgb(76, 178, 76); border-radius: 50%;"></span>
                    High
                </div>
            </div>

            <div class="card-body" style="margin-bottom: 20px;">
                <div class="meeting-info-row"
                    style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px;">
                    <div class="meeting-title-group" style="display: flex; flex-direction: column;">
                        <span class="title-text" style="font-size: 18px; font-weight: 600; color: #333333;">Title of
                            Meeting</span>
                        <span class="project-title" style="font-size: 12px; color: #888888; margin-top: 5px;">Project
                            Title</span>
                    </div>
                    <div class="avatars-group" style="display: flex;">
                        <img src="https://via.placeholder.com/20" alt="Avatar" class="member-avatar"
                            style="width: 25px; height: 25px; border-radius: 50%; border: 2px solid #ffffff; margin-left: -8px; box-shadow: 0 0 2px rgba(0, 0, 0, 0.2); object-fit: cover;">
                        <img src="https://via.placeholder.com/20" alt="Avatar" class="member-avatar"
                            style="width: 25px; height: 25px; border-radius: 50%; border: 2px solid #ffffff; margin-left: -8px; box-shadow: 0 0 2px rgba(0, 0, 0, 0.2); object-fit: cover;">
                        <img src="https://via.placeholder.com/20" alt="Avatar" class="member-avatar"
                            style="width: 25px; height: 25px; border-radius: 50%; border: 2px solid #ffffff; margin-left: -8px; box-shadow: 0 0 2px rgba(0, 0, 0, 0.2); object-fit: cover;">
                    </div>
                </div>
                <p class="description" style="font-size: 14px; color: #666666; line-height: 1.4; margin: 0;">Here we
                    will add the description of the TODO Only you is Superadmin TODO</p>
            </div>

            <div class="card-footer"
                style="display: flex; flex-direction: column; align-items: center; padding-top: 15px; border-top: 1px solid #eeeeee; margin-top: 15px; gap: 10px;">
                <div class="time-schedule"
                    style="display: flex; gap: 10px; background-color: #f9f9f9; padding: 5px 10px; border-radius: 5px; font-size: 14px;">
                    <div class="schedule-item" style="display: flex; align-items: center; color: #555555; gap: 5px;">
                        <span class="schedule-icon"><i class="fas fa-calendar-alt"></i></span>
                        <span class="schedule-text">Now</span>
                    </div>
                    <div class="schedule-item time"
                        style="display: flex; align-items: center; color: #F44336; gap: 5px;">
                        <span class="schedule-icon"><i class="fas fa-clock"></i></span>
                        <span class="schedule-text">10:00 - 10:30</span>
                    </div>
                </div>
                <button class="action-button red"
                    style="border: none; border-radius: 20px; padding: 8px 16px; color: #ffffff; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 5px; background-color: rgb(233, 233, 96);">
                    <span>join now</span>
                    <span class="arrow-icon" style="font-size: 16px; transform: rotate(45deg);">→</span>
                </button>
            </div>
        </div>
        <div class="meeting-card"
            style="width: calc(17.5% - 5px); background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); padding: 20px; display: flex; flex-direction: column;">
            <div class="card-header"
                style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                <div class="admin-info" style="display: flex; align-items: center;">
                    <img src="https://via.placeholder.com/40" alt="Admin" class="admin-avatar"
                        style="width: 40px; height: 40px; border-radius: 50%; margin-right: 10px; object-fit: cover;">
                    <div class="admin-text" style="display: flex; flex-direction: column;">
                        <div class="admin-name" style="font-weight: 600; font-size: 14px; color: #333333;">Admin name
                        </div>
                        <div class="admin-date" style="font-size: 12px; color: #888888;">Created Time & Date</div>
                    </div>
                </div>
                <div class="priority-tag high"
                    style="font-size: 12px; padding: 4px 8px; border-radius: 4px; font-weight: 600; display: flex; align-items: center; gap: 5px; color: black; border: 1px solid #e0e0e0;">
                    <span class="dot"
                        style="width: 8px; height: 8px; background-color: rgb(76, 178, 76); border-radius: 50%;"></span>
                    High
                </div>
            </div>

            <div class="card-body" style="margin-bottom: 20px;">
                <div class="meeting-info-row"
                    style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px;">
                    <div class="meeting-title-group" style="display: flex; flex-direction: column;">
                        <span class="title-text" style="font-size: 18px; font-weight: 600; color: #333333;">Title of
                            Meeting</span>
                        <span class="project-title" style="font-size: 12px; color: #888888; margin-top: 5px;">Project
                            Title</span>
                    </div>
                    <div class="avatars-group" style="display: flex;">
                        <img src="https://via.placeholder.com/20" alt="Avatar" class="member-avatar"
                            style="width: 25px; height: 25px; border-radius: 50%; border: 2px solid #ffffff; margin-left: -8px; box-shadow: 0 0 2px rgba(0, 0, 0, 0.2); object-fit: cover;">
                        <img src="https://via.placeholder.com/20" alt="Avatar" class="member-avatar"
                            style="width: 25px; height: 25px; border-radius: 50%; border: 2px solid #ffffff; margin-left: -8px; box-shadow: 0 0 2px rgba(0, 0, 0, 0.2); object-fit: cover;">
                        <img src="https://via.placeholder.com/20" alt="Avatar" class="member-avatar"
                            style="width: 25px; height: 25px; border-radius: 50%; border: 2px solid #ffffff; margin-left: -8px; box-shadow: 0 0 2px rgba(0, 0, 0, 0.2); object-fit: cover;">
                    </div>
                </div>
                <p class="description" style="font-size: 14px; color: #666666; line-height: 1.4; margin: 0;">Here we
                    will add the description of the TODO Only you is Superadmin TODO</p>
            </div>

            <div class="card-footer"
                style="display: flex; flex-direction: column; align-items: center; padding-top: 15px; border-top: 1px solid #eeeeee; margin-top: 15px; gap: 10px;">
                <div class="time-schedule"
                    style="display: flex; gap: 10px; background-color: #f9f9f9; padding: 5px 10px; border-radius: 5px; font-size: 14px;">
                    <div class="schedule-item" style="display: flex; align-items: center; color: #555555; gap: 5px;">
                        <span class="schedule-icon"><i class="fas fa-calendar-alt"></i></span>
                        <span class="schedule-text">Now</span>
                    </div>
                    <div class="schedule-item time"
                        style="display: flex; align-items: center; color: #F44336; gap: 5px;">
                        <span class="schedule-icon"><i class="fas fa-clock"></i></span>
                        <span class="schedule-text">10:00 - 10:30</span>
                    </div>
                </div>
                <button class="action-button red"
                    style="border: none; border-radius: 20px; padding: 8px 16px; color: #ffffff; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 5px; background-color: rgb(233, 233, 96);">
                    <span>join now</span>
                    <span class="arrow-icon" style="font-size: 16px; transform: rotate(45deg);">→</span>
                </button>
            </div>
        </div>
        <div class="meeting-card"
            style="width: calc(17.5% - 5px); background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); padding: 20px; display: flex; flex-direction: column;">
            <div class="card-header"
                style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                <div class="admin-info" style="display: flex; align-items: center;">
                    <img src="https://via.placeholder.com/40" alt="Admin" class="admin-avatar"
                        style="width: 40px; height: 40px; border-radius: 50%; margin-right: 10px; object-fit: cover;">
                    <div class="admin-text" style="display: flex; flex-direction: column;">
                        <div class="admin-name" style="font-weight: 600; font-size: 14px; color: #333333;">Admin name
                        </div>
                        <div class="admin-date" style="font-size: 12px; color: #888888;">Created Time & Date</div>
                    </div>
                </div>
                <div class="priority-tag high"
                    style="font-size: 12px; padding: 4px 8px; border-radius: 4px; font-weight: 600; display: flex; align-items: center; gap: 5px; color: black; border: 1px solid #e0e0e0;">
                    <span class="dot"
                        style="width: 8px; height: 8px; background-color: rgb(76, 178, 76); border-radius: 50%;"></span>
                    High
                </div>
            </div>

            <div class="card-body" style="margin-bottom: 20px;">
                <div class="meeting-info-row"
                    style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px;">
                    <div class="meeting-title-group" style="display: flex; flex-direction: column;">
                        <span class="title-text" style="font-size: 18px; font-weight: 600; color: #333333;">Title of
                            Meeting</span>
                        <span class="project-title" style="font-size: 12px; color: #888888; margin-top: 5px;">Project
                            Title</span>
                    </div>
                    <div class="avatars-group" style="display: flex;">
                        <img src="https://via.placeholder.com/20" alt="Avatar" class="member-avatar"
                            style="width: 25px; height: 25px; border-radius: 50%; border: 2px solid #ffffff; margin-left: -8px; box-shadow: 0 0 2px rgba(0, 0, 0, 0.2); object-fit: cover;">
                        <img src="https://via.placeholder.com/20" alt="Avatar" class="member-avatar"
                            style="width: 25px; height: 25px; border-radius: 50%; border: 2px solid #ffffff; margin-left: -8px; box-shadow: 0 0 2px rgba(0, 0, 0, 0.2); object-fit: cover;">
                        <img src="https://via.placeholder.com/20" alt="Avatar" class="member-avatar"
                            style="width: 25px; height: 25px; border-radius: 50%; border: 2px solid #ffffff; margin-left: -8px; box-shadow: 0 0 2px rgba(0, 0, 0, 0.2); object-fit: cover;">
                    </div>
                </div>
                <p class="description" style="font-size: 14px; color: #666666; line-height: 1.4; margin: 0;">Here we
                    will add the description of the TODO Only you is Superadmin TODO</p>
            </div>

            <div class="card-footer"
                style="display: flex; flex-direction: column; align-items: center; padding-top: 15px; border-top: 1px solid #eeeeee; margin-top: 15px; gap: 10px;">
                <div class="time-schedule"
                    style="display: flex; gap: 10px; background-color: #f9f9f9; padding: 5px 10px; border-radius: 5px; font-size: 14px;">
                    <div class="schedule-item" style="display: flex; align-items: center; color: #555555; gap: 5px;">
                        <span class="schedule-icon"><i class="fas fa-calendar-alt"></i></span>
                        <span class="schedule-text">Now</span>
                    </div>
                    <div class="schedule-item time"
                        style="display: flex; align-items: center; color: #F44336; gap: 5px;">
                        <span class="schedule-icon"><i class="fas fa-clock"></i></span>
                        <span class="schedule-text">10:00 - 10:30</span>
                    </div>
                </div>
                <button class="action-button red"
                    style="border: none; border-radius: 20px; padding: 8px 16px; color: #ffffff; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 5px; background-color: rgb(233, 233, 96);">
                    <span>join now</span>
                    <span class="arrow-icon" style="font-size: 16px; transform: rotate(45deg);">→</span>
                </button>
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

    <!-- Add Group -->
<div class="modal fade" id="add-group">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Members</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('index')}}">
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
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#new-group">Previous</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Start Group</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add group -->
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
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->
<!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tooltip logic (same as before)
        const tooltipElements = document.querySelectorAll('.main-menu [data-bs-toggle="tooltip"]');
        tooltipElements.forEach(el => {
            const tooltip = new bootstrap.Tooltip(el);

            el.addEventListener('mouseenter', function() {
                const link = el.querySelector('a');
                if (link && link.classList.contains('active')) {
                    tooltip.disable();
                    tooltip.hide();
                } else {
                    tooltip.enable();
                }
            });

            const link = el.querySelector('a');
            if (link) {
                link.addEventListener('click', () => {
                    tooltip.hide();
                    tooltip.disable();
                });
            }
        });

        // 👉 Tab activation logic on page load
        const activeLink = document.querySelector('.main-menu .task-icon-link.active');
        if (activeLink) {
            const targetSelector = activeLink.getAttribute('data-bs-target');
            const tabTrigger = new bootstrap.Tab(activeLink);
            tabTrigger.show(); // manually activate tab

            // Optional: Also make sure the tab-pane is visible
            const targetPane = document.querySelector(targetSelector);
            if (targetPane) {
                document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('active', 'show'));
                targetPane.classList.add('active', 'show');
            }
        }
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var activeTab = document.querySelector('.task-icon-link.active');
        if (activeTab) {
            var tabTrigger = new bootstrap.Tab(activeTab);
            tabTrigger.show();
        }
    });
</script>


<script>
    document.getElementById('open-settings-tab').addEventListener('click', function(e) {
        e.preventDefault();
        const tab = new bootstrap.Tab(document.querySelector('[data-bs-target="#setting-menu"]'));
        tab.show();
    });
</script> -->




<!-- Bootstrap JS Bundle (includes Popper) -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->


@component('components.model-popup')
@endcomponent
@endsection