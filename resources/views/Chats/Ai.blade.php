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


    @include('Chats.chatsidebar')

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
                                </div>
                            </div>
                            <!-- header Subject -->
                            <div style="background-color: white;">
                                <div class="modal-dialog modal-dialog-centered pb-2">
                                    <div class="modal-content" style="padding-left: 16px; padding-right: 16px;">

                                        <!-- Top-Right Large Toggle Icon -->
                                        <div class="d-flex justify-content-end px-3 pt-3">
                                            <a data-bs-toggle="collapse" href="#collapseSubjectForm" role="button" aria-expanded="true" aria-controls="collapseSubjectForm" id="toggleIcon">
                                                <i class="ti ti-chevron-up fs-3" id="chevronIcon"></i> <!-- fs-3 makes it larger -->
                                            </a>
                                        </div>

                                        <!-- Collapsible Form -->
                                        <div class="collapse show" id="collapseSubjectForm">
                                            <div class="modal-body">
                                                <form action="{{ url('index') }}">
                                                    <!-- Subject Type -->
                                                    <div class="row mb-3">
                                                        <div class="col-12 text-start">
                                                            <label class="form-label d-block pe-4">Subject Type</label>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="mute" id="group1">
                                                                <label class="form-check-label" for="group1">Public</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="mute" id="group2">
                                                                <label class="form-check-label" for="group2">Private</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Subject Title -->
                                                    <div class="row mb-3">
                                                        <div class="col-12">
                                                            <label class="form-label">Subject Title</label>
                                                            <input type="text" class="form-control" placeholder="Enter Subject Title">
                                                        </div>
                                                    </div>

                                                    <!-- Submit Button -->
                                                    <div class="row">
                                                        <div class="col-12 pb-1">
                                                            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#add-group">Create</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- /collapse -->

                                    </div>
                                </div>
                            </div>
                            <!-- /header subject -->
                        </div>

                        <!-- Online Contacts -->
                        <div class="top-online-contacts">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="mb-3">Ai Subjects</h5>

                            </div>
                            <div class="chat-users-wrap">
                                <div class="chat-list">
                                    <a href="#" class="chat-user-list">
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
                                    <!-- new -->
                                    <div class="chat-dropdown" style="padding-bottom:13px;">
                                        <a class="#" href="#" data-bs-toggle="dropdown">

                                            <i class="bi bi-three-dots"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end p-3">

                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    <img src="{{ asset('/build/img/Subjects.svg') }}" alt="Favourite" width="12" height="12" class="me-2">
                                                    Archive Chat
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    <img src="{{ asset('/build/img/Edit.svg') }}" alt="Favourite" width="12" height="12" class="me-2">
                                                    Edit the chat
                                                </a>
                                            </li>



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
                                    <a href="#" class="chat-user-list">
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
                                    <!-- new -->
                                    <div class="chat-dropdown" style="padding-bottom:13px;">
                                        <a class="#" href="#" data-bs-toggle="dropdown">
                                            <!-- <i class="ti ti-dots-vertical"></i> -->
                                            <i class="bi bi-three-dots"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end p-3">

                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    <img src="{{ asset('/build/img/Subjects.svg') }}" alt="Favourite" width="12" height="12" class="me-2">
                                                    Archive Chat
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    <img src="{{ asset('/build/img/Edit.svg') }}" alt="Favourite" width="12" height="12" class="me-2">
                                                    Edit the chat
                                                </a>
                                            </li>




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
                                            <a class="dropdown-item" id="trash-chats-tab" data-bs-toggle="tab" href="#trash-chats" role="tab" aria-controls="trash-chats" aria-selected="false" onclick="changeChat('Trash')">Trash</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /Left Chat Title -->
                            <div class="tab-content" id="innerTabContent">
                                <div class="tab-pane fade show active" id="all-chats" role="tabpanel" aria-labelledby="all-chats-tab">
                                    <div class="chat-users-wrap">

                                        <div class="chat-list" >
                                            <a href="#" class="chat-user-list">
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

                                                    <li>
                                                        <a class="dropdown-item" href="#">
                                                            <img src="{{ asset('/build/img/Subjects.svg') }}" alt="Favourite" width="12" height="12" class="me-2">
                                                            Archive Chat
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#">
                                                            <img src="{{ asset('/build/img/Edit.svg') }}" alt="Favourite" width="12" height="12" class="me-2">
                                                            Edit the chat
                                                        </a>
                                                    </li>

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
                                            <a href="#" class="chat-user-list">
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

                                                    <li>
                                                        <a class="dropdown-item" href="#">
                                                            <img src="{{ asset('/build/img/Subjects.svg') }}" alt="Favourite" width="12" height="12" class="me-2">
                                                            Archive Chat
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#">
                                                            <img src="{{ asset('/build/img/Edit.svg') }}" alt="Favourite" width="12" height="12" class="me-2">
                                                            Edit the chat
                                                        </a>
                                                    </li>


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
                                            <a href="#" class="chat-user-list">
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

                                                    <li>
                                                        <a class="dropdown-item" href="#">
                                                            <img src="{{ asset('/build/img/Subjects.svg') }}" alt="Favourite" width="12" height="12" class="me-2">
                                                            Archive Chat
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#">
                                                            <img src="{{ asset('/build/img/Edit.svg') }}" alt="Favourite" width="12" height="12" class="me-2">
                                                            Edit the chat
                                                        </a>
                                                    </li>


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
                                            <a href="#" class="chat-user-list">
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

                                                    <li>
                                                        <a class="dropdown-item" href="#">
                                                            <img src="{{ asset('/build/img/Subjects.svg') }}" alt="Favourite" width="12" height="12" class="me-2">
                                                            Archive Chat
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#">
                                                            <img src="{{ asset('/build/img/Edit.svg') }}" alt="Favourite" width="12" height="12" class="me-2">
                                                            Edit the chat
                                                        </a>
                                                    </li>

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
                                            <a href="#" class="chat-user-list">
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

                                                    <li>
                                                        <a class="dropdown-item" href="#">
                                                            <img src="{{ asset('/build/img/Subjects.svg') }}" alt="Favourite" width="12" height="12" class="me-2">
                                                            Archive Chat
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#">
                                                            <img src="{{ asset('/build/img/Edit.svg') }}" alt="Favourite" width="12" height="12" class="me-2">
                                                            Edit the chat
                                                        </a>
                                                    </li>

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

</div>
<!-- /Content -->
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

@endsection