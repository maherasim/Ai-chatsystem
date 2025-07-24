<?php $page = 'chat'; ?>
@extends('layout.mainlayout')
@section('content')
<style>
    body {
    overflow-x: hidden;
}.dropdown-menu {
    max-height: 250px; /* or adjust */
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

        <div class="tab-content">
            <div class="tab-pane fade active show" id="chat-menu">

                <!-- Chats sidebar -->
                <div id="chats" class="sidebar-content active slimscroll">

                    <div class="slimscroll">

                        <div class="chat-search-header">
                            <div class="header-title d-flex align-items-center justify-content-between">
                                <h4 class="mb-3">AI's</h4>
                                <div class="d-flex align-items-center mb-3">
                                    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#new-Ai" class="add-icon btn btn-primary p-0 d-flex align-items-center justify-content-center fs-16 me-2"><i class="ti ti-plus"></i></a>
                                    <div class="dropdown"
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
                                <h5 class="mb-3">Ai Subjects</h5>
                                <div class="dropdown mb-3">
                                    <a href="#" class="text-default" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-dots-vertical"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end p-3">
                                        <li><a class="dropdown-item mb-1" href="#"><i class="ti ti-eye-off me-2"></i>Hide Recent</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="feather-users me-2"></i>Active Contacts</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="chat-users-wrap">
                                <div class="chat-list">
                                    <a href="{{url('chat')}}" class="chat-user-list">
                                        <div class="avatar avatar-lg  me-2">
                                            <img src="{{URL::asset('/build/img/Topics.svg')}}" class="rounded-circle border border-warning border-2" alt="image">
                                        </div>
                                        <div class="chat-user-info">
                                            <div class="chat-user-msg">
                                                <h6> Subject Title</h6>
                                                <p>
                                                    23/07/2025

                                                </p>
                                            </div>

                                        </div>
                                    </a>
                                    <div class="chat-dropdown">
                                        <a class="#" href="#" data-bs-toggle="dropdown">
                                            <i class="ti ti-dots-vertical"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end p-3">

                                            <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>


                                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat">
                                                    <i class="ti ti-trash me-2"></i>Delete</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="chat-list">
                                    <a href="{{url('chat')}}" class="chat-user-list">
                                        <div class="avatar avatar-lg  me-2">
                                            <img src="{{URL::asset('/build/img/Topics.svg')}}" class="rounded-circle border border-warning border-2" alt="image">
                                        </div>
                                        <div class="chat-user-info">
                                            <div class="chat-user-msg">
                                                <h6> Subject Title</h6>
                                                <p>
                                                    23/07/2025

                                                </p>
                                            </div>

                                        </div>
                                    </a>
                                    <div class="chat-dropdown">
                                        <a class="#" href="#" data-bs-toggle="dropdown">
                                            <i class="ti ti-dots-vertical"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end p-3">

                                            <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>


                                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                        </ul>
                                    </div>
                                </div>



                            </div>
                        </div>
                        <!-- /Online Contacts -->

                        <div class="sidebar-body chat-body" id="chatsidebar">

                            <!-- Left Chat Title -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="chat-title">Al Chats</h5>
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
                                                <div class="chat-user-info">
                                                    <p style="font-size: 16px; color:black">Clyde Smith PW Website</p>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <!-- <i class="ti ti-dots-vertical"></i> -->
                                                    <i class="bi bi-three-dots"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li>
                                                        <a class="dropdown-item" href="#">
                                                            <img src="{{ asset('/build/img/Subjects.svg') }}" alt="Favourite" width="12" height="12" class="me-2">
                                                            Mark as Favourite
                                                        </a>
                                                    </li>

                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat">
                                                            <img src="{{ asset('/build/img/Remove.svg') }}" alt="Delete" width="16" height="16" class="me-2">
                                                            Delete
                                                        </a>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('chat')}}" class="chat-user-list">
                                                <div class="chat-user-info">
                                                    <p style="font-size: 16px; color:black">Clyde Smith PW Website</p>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <!-- <i class="ti ti-dots-vertical"></i> -->
                                                    <i class="bi bi-three-dots"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li>
                                                        <a class="dropdown-item" href="#">
                                                            <img src="{{ asset('/build/img/Subjects.svg') }}" alt="Favourite" width="12" height="12" class="me-2">
                                                            Mark as Favourite
                                                        </a>
                                                    </li>

                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat">
                                                            <img src="{{ asset('/build/img/Remove.svg') }}" alt="Delete" width="16" height="16" class="me-2">
                                                            Delete
                                                        </a>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('chat')}}" class="chat-user-list">
                                                <div class="chat-user-info">
                                                    <p style="font-size: 16px; color:black">Clyde Smith PW Website</p>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <!-- <i class="ti ti-dots-vertical"></i> -->
                                                    <i class="bi bi-three-dots"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li>
                                                        <a class="dropdown-item" href="#">
                                                            <img src="{{ asset('/build/img/Subjects.svg') }}" alt="Favourite" width="12" height="12" class="me-2">
                                                            Mark as Favourite
                                                        </a>
                                                    </li>

                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat">
                                                            <img src="{{ asset('/build/img/Remove.svg') }}" alt="Delete" width="16" height="16" class="me-2">
                                                            Delete
                                                        </a>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('chat')}}" class="chat-user-list">
                                                <div class="chat-user-info">
                                                    <p style="font-size: 16px; color:black">Clyde Smith PW Website</p>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <!-- <i class="ti ti-dots-vertical"></i> -->
                                                    <i class="bi bi-three-dots"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li>
                                                        <a class="dropdown-item" href="#">
                                                            <img src="{{ asset('/build/img/Subjects.svg') }}" alt="Favourite" width="12" height="12" class="me-2">
                                                            Mark as Favourite
                                                        </a>
                                                    </li>

                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat">
                                                            <img src="{{ asset('/build/img/Remove.svg') }}" alt="Delete" width="16" height="16" class="me-2">
                                                            Delete
                                                        </a>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('chat')}}" class="chat-user-list">
                                                <div class="chat-user-info">
                                                    <p style="font-size: 16px; color:black">Clyde Smith PW Website</p>
                                                </div>
                                            </a>
                                            <div class="chat-dropdown">
                                                <a class="#" href="#" data-bs-toggle="dropdown">
                                                    <!-- <i class="ti ti-dots-vertical"></i> -->
                                                    <i class="bi bi-three-dots"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                    <li>
                                                        <a class="dropdown-item" href="#">
                                                            <img src="{{ asset('/build/img/Subjects.svg') }}" alt="Favourite" width="12" height="12" class="me-2">
                                                            Mark as Favourite
                                                        </a>
                                                    </li>

                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                    <li>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat">
                                                            <img src="{{ asset('/build/img/Remove.svg') }}" alt="Delete" width="16" height="16" class="me-2">
                                                            Delete
                                                        </a>
                                                    </li>

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
                                <form action="#">
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
                                                <img src="{{URL::asset('/build/img/profiles/avatar-07.jpg')}}" class="rounded-circle" alt="image">
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
            <div class="tab-pane fade" id="group-menu">

                <!-- Chats sidebar -->
                <div class="sidebar-content active slimscroll">

                    <div class="slimscroll">

                        <div class="chat-search-header">
                            <div class="header-title d-flex align-items-center justify-content-between">
                                <h4 class="mb-3">Group</h4>
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
                                                <a href="#" class="dropdown-item d-flex align-items-center">
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

                        <div class="sidebar-body chat-body" id="chatsidebar">

                            <!-- Left Chat Title -->
                            <div class="d-flex  align-items-center mb-3">
                                <h5 class="chat-title2 me-2">All Calls</h5>
                                <div class="dropdown">
                                    <a href="#" class="text-default fs-16" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-chevron-down"></i></a>
                                    <ul class=" dropdown-menu dropdown-menu-end p-3" id="innerTab" role="tablist">
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
                            <div class="tab-content" id="innerTabContent">
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

    </div>
    <!-- /Chat -->

    <!-- Contact Info -->

    <!-- /Contact Info -->

    <!-- Favourites Info -->
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
    <!-- /Favourites Info -->
<div class="modal fade" id="new-Ai">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New Subject</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{url('index')}}">
                        <div class="row">
                            <label class="form-label">Subject Type</label>
                            <div class="d-flex" style="float: right;">

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
                        <div class="row">

                            <div class="col-lg-12">
                                <label class="form-label">Subject Title</label>
                                <div class="input-icon mb-3 position-relative">
                                    <input type="text" value="" class="form-control" placeholder="Last Name">

                                </div>
                            </div>

                        </div>
                        <div class="row g-3">

                            <div class="col-12">
                                <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#add-group">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @component('components.model-popup')
    @endcomponent
</div>
<!-- /Content -->

@endsection