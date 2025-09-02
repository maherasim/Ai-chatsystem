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
    @include('Chats.notification')
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
                    <div class="row py-2" style="gap: 47px;">
                        <!-- Card 1 -->
                        <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                            <div class="px-3 py-2 h-100" style="border-radius: 10px; background: #fff; position: relative; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div style="font-size: 0.9rem; color: #1e2b4d;">Received Tasks</div>
                                    <div style="background-color: #eae8fd; border-radius: 50%; padding: 5px;">
                                        <img src="{{URL::asset('/build/img/sigma.svg')}}" alt="icon" style="width: 32px; height: 28px;" />
                                    </div>
                                </div>
                                <div class="fw-bold mt-1" style="font-size: 1.5rem; color: #1e2b4d;">10</div>
                                <div style="position: absolute; bottom: 8px; right: 16px; font-size: 0.9rem; color: #28c76f;">
                                    <i class="bi bi-arrow-up-right"></i> 8.5%
                                </div>
                            </div>
                        </div>

                        <!-- Card 2 -->
                        <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                            <div class="px-3 py-2 h-100" style="border-radius: 10px; background: #fff; position: relative; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div style="font-size: 0.9rem; color: #1e2b4d;">On time Deliver</div>
                                    <div style="background-color: #e9f8dd; border-radius: 50%; padding: 5px;">
                                        <img src="{{URL::asset('/build/img/like.svg')}}" alt="icon" style="width: 20px; height: 20px;" />
                                    </div>
                                </div>
                                <div class="fw-bold mt-1" style="font-size: 1.5rem; color: #1e2b4d;">10</div>
                                <div style="position: absolute; bottom: 8px; right: 16px; font-size: 0.9rem; color: #28c76f;">
                                    <i class="bi bi-arrow-up-right"></i> 8.5%
                                </div>
                            </div>
                        </div>

                        <!-- Card 3 -->
                        <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                            <div class="px-3 py-2 h-100" style="border-radius: 10px; background: #fff; position: relative; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div style="font-size: 0.9rem; color: #1e2b4d;">Delayed Deliver</div>
                                    <div style="background-color: #fde6e6; border-radius: 50%; padding: 5px;">
                                        <img src="{{URL::asset('/build/img/delayed.svg')}}" alt="icon" style="width: 20px; height: 20px;" />
                                    </div>
                                </div>
                                <div class="fw-bold mt-1" style="font-size: 1.5rem; color: #1e2b4d;">10</div>
                                <div style="position: absolute; bottom: 8px; right: 16px; font-size: 0.9rem; color: #ff2e2e;">
                                    <i class="bi bi-arrow-down-right"></i> 8.5%
                                </div>
                            </div>
                        </div>

                        <!-- Card 4 -->
                        <div class="col-12 col-sm-6 col-md-6 col-lg-2">
                            <div class="px-3 py-2 h-100" style="border-radius: 10px; background: #fff; position: relative; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div style="font-size: 0.9rem; color: #1e2b4d;">Rejected Task</div>
                                    <div style="background-color: #fddede; border-radius: 50%; padding: 5px;">
                                        <img src="{{URL::asset('/build/img/Rejected.svg')}}" alt="icon" style="width: 20px; height: 20px;" />
                                    </div>
                                </div>
                                <div class="fw-bold mt-1" style="font-size: 1.5rem; color: #1e2b4d;">10</div>
                                <div style="position: absolute; bottom: 8px; right: 16px; font-size: 0.9rem; color: #ff2e2e;">
                                    <i class="bi bi-arrow-down-right"></i> 8.5%
                                </div>
                            </div>
                        </div>

                        <!-- Card 5 -->
                        <div class="col-12 col-sm-6 col-md-6 col-lg-2">
                            <div class="px-3 py-2 h-100" style="border-radius: 10px; background: #fff; position: relative; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div style="font-size: 0.9rem; color: #1e2b4d;">Total Done</div>
                                    <div style="background-color: #d9f5e8; border-radius: 50%; padding: 5px;">
                                        <img src="{{URL::asset('/build/img/done.svg')}}" alt="icon" style="width: 20px; height: 20px;" />
                                    </div>
                                </div>
                                <div class="fw-bold mt-1" style="font-size: 1.5rem; color: #1e2b4d;">10</div>
                                <div style="position: absolute; bottom: 8px; right: 16px; font-size: 0.9rem; color: #28c76f;">
                                    <i class="bi bi-arrow-up-right"></i> 8.5%
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- project overview -->
                    <div class="project-succes pt-4 pb-2 d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                        <div>
                            <h3 style="margin: 0;">Current Tasks</h3>
                            <strong>Task Overview</strong>
                        </div>

                        <div class="d-flex justify-content-start" style="gap: 8px; background: #f8fafc; padding: 6px 10px; border-radius: 8px;">
                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#createTaskModal"
                                style="background: #32b768; border: 1px solid #32b768; color: white; border-radius: 6px; font-weight: 500; font-size: 14px; padding: 6px 18px;">
                                + Mobile Task
                            </button>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#webtask"
                                style="background-color:blue ; color: white; border: none; padding: 8px 14px; border-radius: 6px; font-weight: 500; cursor:pointer;">
                                + Web Task
                            </button>

                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#emptask"
                                style="background-color: red; color: white; border: none; padding: 8px 14px; border-radius: 6px; font-weight: 500; cursor:pointer;">
                                + Employee Task
                            </button>


                        </div>
                    </div>
                    <div style="background-color: #f7f7f7; padding: 16px; border-radius: 12px; font-family: 'Segoe UI', sans-serif;">
                        <div class="d-flex flex-wrap justify-content-between align-items-start mb-3">

                            <!-- Left Icon -->
                            <img src="{{ asset('build/img/lato.svg') }}" alt="Icon" style="width: 50px; height: auto; margin-bottom:3px;">

                            <!-- Project Summary -->
                            <div style="background-color: white;border-radius:6px;padding:5px;">
                                <div style="font-size: 15px; font-weight: 600; color: #2e3a59;">Project Title</div>
                                <div class="d-flex gap-1 mt-1 flex-nowrap">
                                    <!-- Project Tag 1 -->
                                    <div class="d-flex align-items-center gap-2" style="background: #f7f7f7; padding: 6px 10px; border-radius: 8px; font-size: 13px;">
                                        <!-- Logo -->
                                        <img src="{{ URL::asset('/build/img/yekbon.svg') }}" alt="Logo" style="width: 24px; height: 24px;">

                                        <!-- Project Title and Badges -->
                                        <div class="d-flex flex-column" style="line-height: 1.2;">
                                            <strong style="color: #1a2343; font-size: 13px;">Project Title</strong>
                                            <div class="d-flex gap-2 mt-1">
                                                <span style="color: #1a2343;">Tickets
                                                    <span style="background: #ff4d4f; color: #fff; border-radius: 50%; padding: 2px 6px; font-size: 10px;">4</span>
                                                </span>
                                                <span style="color: #1a2343;">Tasks
                                                    <span style="background: #ff4d4f; color: #fff; border-radius: 50%; padding: 2px 6px; font-size: 10px;">4</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Project Tag 2 -->
                                    <div class="d-flex align-items-center gap-2" style="background: #f7f7f7; padding: 6px 10px; border-radius: 8px; font-size: 13px;">
                                        <!-- Logo -->
                                        <img src="{{ URL::asset('/build/img/yekbon.svg') }}" alt="Logo" style="width: 24px; height: 24px;">

                                        <!-- Project Title and Badges -->
                                        <div class="d-flex flex-column" style="line-height: 1.2;">
                                            <strong style="color: #1a2343; font-size: 13px;">Project Title</strong>
                                            <div class="d-flex gap-2 mt-1">
                                                <span style="color: #1a2343;">Tickets
                                                    <span style="background: #ff4d4f; color: #fff; border-radius: 50%; padding: 2px 6px; font-size: 10px;">4</span>
                                                </span>
                                                <span style="color: #1a2343;">Tasks
                                                    <span style="background: #ff4d4f; color: #fff; border-radius: 50%; padding: 2px 6px; font-size: 10px;">4</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Task Status Cards -->
                        <div class="d-flex flex-wrap justify-content-start" style="background:#fff; border-radius: 10px; padding: 5px; padding-left: 1px;">
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
                    <!-- cards -->
                    <div class=" row g-2 mt-2">
                        <!-- in progress -->
                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="card p-1 mb-3 shadow-sm" style="background: #ffffff; border-radius: 12px; font-family: 'Segoe UI', sans-serif;">

                                <!-- Header Row -->
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <div style="color: #7ED957; font-weight: 600; font-size: 16px;">In Progress</div>
                                        <div style="font-size: 13px; color: #7ED957;">Total Tasks: 10</div>
                                    </div>
                                    <div>
                                        <select class="form-select form-select-sm" style="width: 140px; font-size: 13px;">
                                            <option selected>Select Projects</option>
                                            <option selected>Yekbon</option>
                                            <option selected>CMS</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Task Card -->
                                <div class="d-flex p-2 rounded mt-2" style="background-color: #ebebeb;cursor:pointer" data-bs-toggle="modal" data-bs-target="#progressmodel">
                                    <!-- Task Image -->
                                    <div class="me-2">
                                        <img src="{{ asset('build/img/dooted img.svg') }}" alt="Task Image"
                                            style="width: 50px; height: 100%; border-radius: 6px; object-fit: cover;">
                                    </div>

                                    <!-- Task Content -->
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div style="font-weight: 600; font-size: 14px; display: flex; align-items: center;">
                                                <img src="{{ asset('build/img/yekbon.svg') }}" alt="" style="width: 30px; height: 30px; margin-right: 6px;">
                                                Task Title
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <!-- Status Dot -->
                                                <span style="width: 12px; height: 12px; background-color: #7ED957; border-radius: 50%; display: inline-block;"></span>
                                                <!-- Avatar -->
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile" style="width: 24px; height: 24px; border-radius: 50%;">
                                            </div>
                                        </div>

                                        <!-- Sub Text -->
                                        <div style="font-size: 12px; color: #6c757d;">Ticket #1 - Ticket Title</div>

                                        <!-- Description -->
                                        <div style="font-size: 13px; margin-top: 2px;">Task description will be here</div>

                                        <!-- Dates & Badge Row -->
                                        <div class="d-flex justify-content-between mt-2 flex-nowrap" style="background-color: #fff; border-radius: 10px; padding: 4px;gap:3px;">
                                            <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                <small>Start: 22.10.2024</small>
                                            </div>

                                            <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                <small>Deliver: 22.10.2024</small>
                                            </div>

                                            <!-- Deadline/Warning -->
                                            <div class="d-flex align-items-center" style="font-size: 11px; background-color: #ff4d4f; color: white; padding: 2px 6px; border-radius: 6px;">
                                                <img src="https://img.icons8.com/ios-filled/16/ffffff/flash-on.png" alt="Urgent" style="margin-right: 4px;">
                                                01
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- 2 -->
                                <div class="d-flex p-2 rounded mt-2" style="background-color: #ebebeb;cursor:pointer" data-bs-toggle="modal" data-bs-target="#progressmodel">

                                    <!-- Task Image -->
                                    <div class="me-2">
                                        <img src="{{ asset('build/img/dooted img.svg') }}" alt="Task Image"
                                            style="width: 50px; height: 100%; border-radius: 6px; object-fit: cover;">
                                    </div>

                                    <!-- Task Content -->
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div style="font-weight: 600; font-size: 14px; display: flex; align-items: center;">
                                                <img src="{{ asset('build/img/yekbon.svg') }}" alt="" style="width: 30px; height: 30px; margin-right: 6px;">
                                                Task Title
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <!-- Status Dot -->
                                                <span style="width: 12px; height: 12px; background-color: blue; border-radius: 50%; display: inline-block;"></span>
                                                <!-- Avatar -->
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile" style="width: 24px; height: 24px; border-radius: 50%;">
                                            </div>
                                        </div>

                                        <!-- Sub Text -->
                                        <div style="font-size: 12px; color: #6c757d;">Ticket #1 - Ticket Title</div>

                                        <!-- Description -->
                                        <div style="font-size: 13px; margin-top: 2px;">Task description will be here</div>

                                        <!-- Dates & Badge Row -->
                                        <div class="d-flex justify-content-between mt-2 flex-nowrap" style="background-color: #fff; border-radius: 10px; padding: 4px;gap:3px;">
                                            <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                <small>Start: 22.10.2024</small>
                                            </div>

                                            <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                <small>Deliver: 22.10.2024</small>
                                            </div>

                                            <!-- Deadline/Warning -->
                                            <div class="d-flex align-items-center" style="font-size: 11px; background-color: #ff4d4f; color: white; padding: 2px 6px; border-radius: 6px;">
                                                <img src="https://img.icons8.com/ios-filled/16/ffffff/flash-on.png" alt="Urgent" style="margin-right: 4px;">
                                                01
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- 3 -->
                                <div class="d-flex p-2 rounded mt-2" style="background-color: #ebebeb;cursor:pointer" data-bs-toggle="modal" data-bs-target="#progressmodel">

                                    <!-- Task Image -->
                                    <div class="me-2">
                                        <img src="{{ asset('build/img/dooted img.svg') }}" alt="Task Image"
                                            style="width: 50px; height: 100%; border-radius: 6px; object-fit: cover;">
                                    </div>

                                    <!-- Task Content -->
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div style="font-weight: 600; font-size: 14px; display: flex; align-items: center;">
                                                <img src="{{ asset('build/img/yekbon.svg') }}" alt="" style="width: 30px; height: 30px; margin-right: 6px;">
                                                Task Title
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <!-- Status Dot -->
                                                <span style="width: 12px; height: 12px; background-color: blue; border-radius: 50%; display: inline-block;"></span>
                                                <!-- Avatar -->
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile" style="width: 24px; height: 24px; border-radius: 50%;">
                                            </div>
                                        </div>

                                        <!-- Sub Text -->
                                        <div style="font-size: 12px; color: #6c757d;">Ticket #1 - Ticket Title</div>

                                        <!-- Description -->
                                        <div style="font-size: 13px; margin-top: 2px;">Task description will be here</div>

                                        <!-- Dates & Badge Row -->
                                        <div class="d-flex justify-content-between mt-2 flex-nowrap" style="background-color: #fff; border-radius: 10px; padding: 4px;gap:3px;">
                                            <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                <small>Start: 22.10.2024</small>
                                            </div>

                                            <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                <small>Deliver: 22.10.2024</small>
                                            </div>

                                            <!-- Deadline/Warning -->
                                            <div class="d-flex align-items-center" style="font-size: 11px; background-color: #ff4d4f; color: white; padding: 2px 6px; border-radius: 6px;">
                                                <img src="https://img.icons8.com/ios-filled/16/ffffff/flash-on.png" alt="Urgent" style="margin-right: 4px;">
                                                01
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- In checking -->
                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="card p-1 mb-3 shadow-sm" style="background: #ffffff; border-radius: 12px; font-family: 'Segoe UI', sans-serif;">

                                <!-- Header Row -->
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <div style="color:purple; font-weight: 600; font-size: 16px;">In Checking</div>
                                        <div style="font-size: 13px; color: purple;">Total Tasks: 10</div>
                                    </div>
                                    <div>
                                        <select class="form-select form-select-sm" style="width: 140px; font-size: 13px;">
                                            <option selected>Select Projects</option>
                                            <option selected>Yekbon</option>
                                            <option selected>CMS</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Task Card -->
                                <div class="d-flex p-2 rounded mt-2" style="background-color: #ebebeb;cursor:pointer" data-bs-toggle="modal" data-bs-target="#incheck">

                                    <!-- Task Image -->
                                    <div class="me-2">
                                        <img src="{{ asset('build/img/dooted img.svg') }}" alt="Task Image"
                                            style="width: 50px; height: 100%; border-radius: 6px; object-fit: cover;">
                                    </div>

                                    <!-- Task Content -->
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div style="font-weight: 600; font-size: 14px; display: flex; align-items: center;">
                                                <img src="{{ asset('build/img/yekbon.svg') }}" alt="" style="width: 30px; height: 30px; margin-right: 6px;">
                                                Task Title
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <!-- Status Dot -->
                                                <span style="width: 12px; height: 12px; background-color: #7ED957; border-radius: 50%; display: inline-block;"></span>
                                                <!-- Avatar -->
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile" style="width: 24px; height: 24px; border-radius: 50%;">
                                            </div>
                                        </div>

                                        <!-- Sub Text -->
                                        <div style="font-size: 12px; color: #6c757d;">Ticket #1 - Ticket Title</div>

                                        <!-- Description -->
                                        <div style="font-size: 13px; margin-top: 2px;">Task description will be here</div>

                                        <!-- Dates & Badge Row -->
                                        <div class="d-flex justify-content-between mt-2 flex-nowrap" style="background-color: #fff; border-radius: 10px; padding: 4px;gap: 3px;">
                                            <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                <small>Start: 22.10.2024</small>
                                            </div>

                                            <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                <small>Deliver: 22.10.2024</small>
                                            </div>

                                            <!-- Deadline/Warning -->
                                            <div class="d-flex align-items-center" style="font-size: 11px; background-color: #ff4d4f; color: white; padding: 2px 6px; border-radius: 6px;">
                                                <img src="https://img.icons8.com/ios-filled/16/ffffff/flash-on.png" alt="Urgent" style="margin-right: 4px;">
                                                01
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- 2 -->
                                <div class="d-flex p-2 rounded mt-2" style="background-color: #ebebeb;cursor:pointer" data-bs-toggle="modal" data-bs-target="#incheck">

                                    <!-- Task Image -->
                                    <div class="me-2">
                                        <img src="{{ asset('build/img/dooted img.svg') }}" alt="Task Image"
                                            style="width: 50px; height: 100%; border-radius: 6px; object-fit: cover;">
                                    </div>

                                    <!-- Task Content -->
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div style="font-weight: 600; font-size: 14px; display: flex; align-items: center;">
                                                <img src="{{ asset('build/img/yekbon.svg') }}" alt="" style="width: 30px; height: 30px; margin-right: 6px;">
                                                Task Title
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <!-- Status Dot -->
                                                <span style="width: 12px; height: 12px; background-color:blue; border-radius: 50%; display: inline-block;"></span>
                                                <!-- Avatar -->
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile" style="width: 24px; height: 24px; border-radius: 50%;">
                                            </div>
                                        </div>

                                        <!-- Sub Text -->
                                        <div style="font-size: 12px; color: #6c757d;">Ticket #1 - Ticket Title</div>

                                        <!-- Description -->
                                        <div style="font-size: 13px; margin-top: 2px;">Task description will be here</div>

                                        <!-- Dates & Badge Row -->
                                        <div class="d-flex justify-content-between mt-2 flex-nowrap" style="background-color: #fff; border-radius: 10px; padding: 4px;gap:3px;">
                                            <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                <small>Start: 22.10.2024</small>
                                            </div>

                                            <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                <small>Deliver: 22.10.2024</small>
                                            </div>

                                            <!-- Deadline/Warning -->
                                            <div class="d-flex align-items-center" style="font-size: 11px; background-color: #ff4d4f; color: white; padding: 2px 6px; border-radius: 6px;">
                                                <img src="https://img.icons8.com/ios-filled/16/ffffff/flash-on.png" alt="Urgent" style="margin-right: 4px;">
                                                01
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- 3 -->
                                <div class="d-flex p-2 rounded mt-2" style="background-color: #ebebeb;cursor:pointer" data-bs-toggle="modal" data-bs-target="#incheck">

                                    <!-- Task Image -->
                                    <div class="me-2">
                                        <img src="{{ asset('build/img/dooted img.svg') }}" alt="Task Image"
                                            style="width: 50px; height: 100%; border-radius: 6px; object-fit: cover;">
                                    </div>

                                    <!-- Task Content -->
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div style="font-weight: 600; font-size: 14px; display: flex; align-items: center;">
                                                <img src="{{ asset('build/img/yekbon.svg') }}" alt="" style="width: 30px; height: 30px; margin-right: 6px;">
                                                Task Title
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <!-- Status Dot -->
                                                <span style="width: 12px; height: 12px; background-color: blue; border-radius: 50%; display: inline-block;"></span>
                                                <!-- Avatar -->
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile" style="width: 24px; height: 24px; border-radius: 50%;">
                                            </div>
                                        </div>

                                        <!-- Sub Text -->
                                        <div style="font-size: 12px; color: #6c757d;">Ticket #1 - Ticket Title</div>

                                        <!-- Description -->
                                        <div style="font-size: 13px; margin-top: 2px;">Task description will be here</div>

                                        <!-- Dates & Badge Row -->
                                        <div class="d-flex justify-content-between mt-2 flex-nowrap" style="background-color: #fff; border-radius: 10px; padding: 4px;gap:3px;">
                                            <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                <small>Start: 22.10.2024</small>
                                            </div>

                                            <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                <small>Deliver: 22.10.2024</small>
                                            </div>

                                            <!-- Deadline/Warning -->
                                            <div class="d-flex align-items-center" style="font-size: 11px; background-color: #ff4d4f; color: white; padding: 2px 6px; border-radius: 6px;">
                                                <img src="https://img.icons8.com/ios-filled/16/ffffff/flash-on.png" alt="Urgent" style="margin-right: 4px;">
                                                01
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- In Rejected -->
                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="card p-1 mb-3 shadow-sm" style="background: #ffffff; border-radius: 12px; font-family: 'Segoe UI', sans-serif;">

                                <!-- Header Row -->
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <div style="color:red; font-weight: 600; font-size: 16px;">In Rejected</div>
                                        <div style="font-size: 13px; color: red;">Total Tasks: 10</div>
                                    </div>
                                    <div>
                                        <select class="form-select form-select-sm" style="width: 140px; font-size: 13px;">
                                            <option selected>Select Projects</option>
                                            <option selected>Yekbon</option>
                                            <option selected>CMS</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Task Card -->
                                <div class="d-flex p-2 rounded mt-2" style="background-color: #ebebeb;cursor:pointer" data-bs-toggle="modal" data-bs-target="#inreject">

                                    <!-- Task Image -->
                                    <div class="me-2">
                                        <img src="{{ asset('build/img/dooted img.svg') }}" alt="Task Image"
                                            style="width: 50px; height: 100%; border-radius: 6px; object-fit: cover;">
                                    </div>

                                    <!-- Task Content -->
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div style="font-weight: 600; font-size: 14px; display: flex; align-items: center;">
                                                <img src="{{ asset('build/img/yekbon.svg') }}" alt="" style="width: 30px; height: 30px; margin-right: 6px;">
                                                Task Title
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <!-- Status Dot -->
                                                <span style="width: 12px; height: 12px; background-color: #7ED957; border-radius: 50%; display: inline-block;"></span>
                                                <!-- Avatar -->
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile" style="width: 24px; height: 24px; border-radius: 50%;">
                                            </div>
                                        </div>

                                        <!-- Sub Text -->
                                        <div style="font-size: 12px; color: #6c757d;">Ticket #1 - Ticket Title</div>

                                        <!-- Description -->
                                        <div style="font-size: 13px; margin-top: 2px;">Task description will be here</div>

                                        <!-- Dates & Badge Row -->
                                        <div class="d-flex justify-content-between mt-2 flex-nowrap" style="background-color: #fff; border-radius: 10px; padding: 4px;gap:3px;">
                                            <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                <small>Start: 22.10.2024</small>
                                            </div>

                                            <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                <small>Deliver: 22.10.2024</small>
                                            </div>

                                            <!-- Deadline/Warning -->
                                            <div class="d-flex align-items-center" style="font-size: 11px; background-color: #ff4d4f; color: white; padding: 2px 6px; border-radius: 6px;">
                                                <img src="https://img.icons8.com/ios-filled/16/ffffff/flash-on.png" alt="Urgent" style="margin-right: 4px;">
                                                01
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- 2 -->
                                <div class="d-flex p-2 rounded mt-2" style="background-color: #ebebeb;cursor:pointer" data-bs-toggle="modal" data-bs-target="#inreject">

                                    <!-- Task Image -->
                                    <div class="me-2">
                                        <img src="{{ asset('build/img/dooted img.svg') }}" alt="Task Image"
                                            style="width: 50px; height: 100%; border-radius: 6px; object-fit: cover;">
                                    </div>

                                    <!-- Task Content -->
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div style="font-weight: 600; font-size: 14px; display: flex; align-items: center;">
                                                <img src="{{ asset('build/img/yekbon.svg') }}" alt="" style="width: 30px; height: 30px; margin-right: 6px;">
                                                Task Title
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <!-- Status Dot -->
                                                <span style="width: 12px; height: 12px; background-color: blue; border-radius: 50%; display: inline-block;"></span>
                                                <!-- Avatar -->
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile" style="width: 24px; height: 24px; border-radius: 50%;">
                                            </div>
                                        </div>

                                        <!-- Sub Text -->
                                        <div style="font-size: 12px; color: #6c757d;">Ticket #1 - Ticket Title</div>

                                        <!-- Description -->
                                        <div style="font-size: 13px; margin-top: 2px;">Task description will be here</div>

                                        <!-- Dates & Badge Row -->
                                        <div class="d-flex justify-content-between mt-2 flex-nowrap" style="background-color: #fff; border-radius: 10px; padding: 4px;gap:3px;">
                                            <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                <small>Start: 22.10.2024</small>
                                            </div>

                                            <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                <small>Deliver: 22.10.2024</small>
                                            </div>

                                            <!-- Deadline/Warning -->
                                            <div class="d-flex align-items-center" style="font-size: 11px; background-color: #ff4d4f; color: white; padding: 2px 6px; border-radius: 6px;">
                                                <img src="https://img.icons8.com/ios-filled/16/ffffff/flash-on.png" alt="Urgent" style="margin-right: 4px;">
                                                01
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- 3 -->
                                <div class="d-flex p-2 rounded mt-2" style="background-color: #ebebeb;cursor:pointer" data-bs-toggle="modal" data-bs-target="#inreject">

                                    <!-- Task Image -->
                                    <div class="me-2">
                                        <img src="{{ asset('build/img/dooted img.svg') }}" alt="Task Image"
                                            style="width: 50px; height: 100%; border-radius: 6px; object-fit: cover;">
                                    </div>

                                    <!-- Task Content -->
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div style="font-weight: 600; font-size: 14px; display: flex; align-items: center;">
                                                <img src="{{ asset('build/img/yekbon.svg') }}" alt="" style="width: 30px; height: 30px; margin-right: 6px;">
                                                Task Title
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <!-- Status Dot -->
                                                <span style="width: 12px; height: 12px; background-color: blue; border-radius: 50%; display: inline-block;"></span>
                                                <!-- Avatar -->
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile" style="width: 24px; height: 24px; border-radius: 50%;">
                                            </div>
                                        </div>

                                        <!-- Sub Text -->
                                        <div style="font-size: 12px; color: #6c757d;">Ticket #1 - Ticket Title</div>

                                        <!-- Description -->
                                        <div style="font-size: 13px; margin-top: 2px;">Task description will be here</div>

                                        <!-- Dates & Badge Row -->
                                        <div class="d-flex justify-content-between mt-2 flex-nowrap" style="background-color: #fff; border-radius: 10px; padding: 4px;gap:3px;">
                                            <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                <small>Start: 22.10.2024</small>
                                            </div>

                                            <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                <small>Deliver: 22.10.2024</small>
                                            </div>

                                            <!-- Deadline/Warning -->
                                            <div class="d-flex align-items-center" style="font-size: 11px; background-color: #ff4d4f; color: white; padding: 2px 6px; border-radius: 6px;">
                                                <img src="https://img.icons8.com/ios-filled/16/ffffff/flash-on.png" alt="Urgent" style="margin-right: 4px;">
                                                01
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- In Hold -->
                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="card p-1 mb-3 shadow-sm" style="background: #ffffff; border-radius: 12px; font-family: 'Segoe UI', sans-serif;">

                                <!-- Header Row -->
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <div style="color:yellow; font-weight: 600; font-size: 16px;">In Hold</div>
                                        <div style="font-size: 13px; color: yellow;">Total Tasks: 10</div>
                                    </div>
                                    <div>
                                        <select class="form-select form-select-sm" style="width: 140px; font-size: 13px;">
                                            <option selected>Select Projects</option>
                                            <option selected>Yekbon</option>
                                            <option selected>CMS</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Task Card -->
                                <div class="d-flex p-2 rounded mt-2" style="background-color: #ebebeb;cursor:pointer" data-bs-toggle="modal" data-bs-target="#inhold">

                                    <!-- Task Image -->
                                    <div class="me-2">
                                        <img src="{{ asset('build/img/dooted img.svg') }}" alt="Task Image"
                                            style="width: 50px; height: 100%; border-radius: 6px; object-fit: cover;">
                                    </div>

                                    <!-- Task Content -->
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div style="font-weight: 600; font-size: 14px; display: flex; align-items: center;">
                                                <img src="{{ asset('build/img/yekbon.svg') }}" alt="" style="width: 30px; height: 30px; margin-right: 6px;">
                                                Task Title
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <!-- Status Dot -->
                                                <span style="width: 12px; height: 12px; background-color: #7ED957; border-radius: 50%; display: inline-block;"></span>
                                                <!-- Avatar -->
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile" style="width: 24px; height: 24px; border-radius: 50%;">
                                            </div>
                                        </div>

                                        <!-- Sub Text -->
                                        <div style="font-size: 12px; color: #6c757d;">Ticket #1 - Ticket Title</div>

                                        <!-- Description -->
                                        <div style="font-size: 13px; margin-top: 2px;">Task description will be here</div>

                                        <!-- Dates & Badge Row -->
                                        <div class="d-flex justify-content-between mt-2 flex-nowrap" style="background-color: #fff; border-radius: 10px; padding: 4px;gap:3px;">
                                            <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                <small>Start: 22.10.2024</small>
                                            </div>

                                            <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                <small>Deliver: 22.10.2024</small>
                                            </div>

                                            <!-- Deadline/Warning -->
                                            <div class="d-flex align-items-center" style="font-size: 11px; background-color: #ff4d4f; color: white; padding: 2px 6px; border-radius: 6px;">
                                                <img src="https://img.icons8.com/ios-filled/16/ffffff/flash-on.png" alt="Urgent" style="margin-right: 4px;">
                                                01
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- 2 -->
                                <div class="d-flex p-2 rounded mt-2" style="background-color: #ebebeb;cursor:pointer" data-bs-toggle="modal" data-bs-target="#inhold">

                                    <!-- Task Image -->
                                    <div class="me-2">
                                        <img src="{{ asset('build/img/dooted img.svg') }}" alt="Task Image"
                                            style="width: 50px; height: 100%; border-radius: 6px; object-fit: cover;">
                                    </div>

                                    <!-- Task Content -->
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div style="font-weight: 600; font-size: 14px; display: flex; align-items: center;">
                                                <img src="{{ asset('build/img/yekbon.svg') }}" alt="" style="width: 30px; height: 30px; margin-right: 6px;">
                                                Task Title
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <!-- Status Dot -->
                                                <span style="width: 12px; height: 12px; background-color: blue; border-radius: 50%; display: inline-block;"></span>
                                                <!-- Avatar -->
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile" style="width: 24px; height: 24px; border-radius: 50%;">
                                            </div>
                                        </div>

                                        <!-- Sub Text -->
                                        <div style="font-size: 12px; color: #6c757d;">Ticket #1 - Ticket Title</div>

                                        <!-- Description -->
                                        <div style="font-size: 13px; margin-top: 2px;">Task description will be here</div>

                                        <!-- Dates & Badge Row -->
                                        <div class="d-flex justify-content-between mt-2 flex-nowrap" style="background-color: #fff; border-radius: 10px; padding: 4px;gap:3px;">
                                            <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                <small>Start: 22.10.2024</small>
                                            </div>

                                            <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                <small>Deliver: 22.10.2024</small>
                                            </div>

                                            <!-- Deadline/Warning -->
                                            <div class="d-flex align-items-center" style="font-size: 11px; background-color: #ff4d4f; color: white; padding: 2px 6px; border-radius: 6px;">
                                                <img src="https://img.icons8.com/ios-filled/16/ffffff/flash-on.png" alt="Urgent" style="margin-right: 4px;">
                                                01
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- 3 -->
                                <div class="d-flex p-2 rounded mt-2" style="background-color: #ebebeb;cursor:pointer" data-bs-toggle="modal" data-bs-target="#inhold">

                                    <!-- Task Image -->
                                    <div class="me-2">
                                        <img src="{{ asset('build/img/dooted img.svg') }}" alt="Task Image"
                                            style="width: 50px; height: 100%; border-radius: 6px; object-fit: cover;">
                                    </div>

                                    <!-- Task Content -->
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div style="font-weight: 600; font-size: 14px; display: flex; align-items: center;">
                                                <img src="{{ asset('build/img/yekbon.svg') }}" alt="" style="width: 30px; height: 30px; margin-right: 6px;">
                                                Task Title
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <!-- Status Dot -->
                                                <span style="width: 12px; height: 12px; background-color: blue; border-radius: 50%; display: inline-block;"></span>
                                                <!-- Avatar -->
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile" style="width: 24px; height: 24px; border-radius: 50%;">
                                            </div>
                                        </div>

                                        <!-- Sub Text -->
                                        <div style="font-size: 12px; color: #6c757d;">Ticket #1 - Ticket Title</div>

                                        <!-- Description -->
                                        <div style="font-size: 13px; margin-top: 2px;">Task description will be here</div>

                                        <!-- Dates & Badge Row -->
                                        <div class="d-flex justify-content-between mt-2 flex-nowrap" style="background-color: #fff; border-radius: 10px; padding: 4px;gap:3px;">
                                            <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                <small>Start: 22.10.2024</small>
                                            </div>

                                            <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                <small>Deliver: 22.10.2024</small>
                                            </div>

                                            <!-- Deadline/Warning -->
                                            <div class="d-flex align-items-center" style="font-size: 11px; background-color: #ff4d4f; color: white; padding: 2px 6px; border-radius: 6px;">
                                                <img src="https://img.icons8.com/ios-filled/16/ffffff/flash-on.png" alt="Urgent" style="margin-right: 4px;">
                                                01
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- In delayed -->
                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="card p-1 mb-3 shadow-sm" style="background: #ffffff; border-radius: 12px; font-family: 'Segoe UI', sans-serif;">

                                <!-- Header Row -->
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <div style="color:#f28b82; font-weight: 600; font-size: 16px;">In Delayed</div>
                                        <div style="font-size: 13px; color:#f28b82;">Total Tasks: 10</div>
                                    </div>
                                    <div>
                                        <select class="form-select form-select-sm" style="width: 140px; font-size: 13px;">
                                            <option selected>Select Projects</option>
                                            <option selected>Yekbon</option>
                                            <option selected>CMS</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Task Card -->
                                <div class="d-flex p-2 rounded mt-2" style="background-color: #ebebeb;cursor:pointer" data-bs-toggle="modal" data-bs-target="#indelayed">

                                    <!-- Task Image -->
                                    <div class="me-2">
                                        <img src="{{ asset('build/img/dooted img.svg') }}" alt="Task Image"
                                            style="width: 50px; height: 100%; border-radius: 6px; object-fit: cover;">
                                    </div>

                                    <!-- Task Content -->
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div style="font-weight: 600; font-size: 14px; display: flex; align-items: center;">
                                                <img src="{{ asset('build/img/yekbon.svg') }}" alt="" style="width: 30px; height: 30px; margin-right: 6px;">
                                                Task Title
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <!-- Status Dot -->
                                                <span style="width: 12px; height: 12px; background-color: #7ED957; border-radius: 50%; display: inline-block;"></span>
                                                <!-- Avatar -->
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile" style="width: 24px; height: 24px; border-radius: 50%;">
                                            </div>
                                        </div>

                                        <!-- Sub Text -->
                                        <div style="font-size: 12px; color: #6c757d;">Ticket #1 - Ticket Title</div>

                                        <!-- Description -->
                                        <div style="font-size: 13px; margin-top: 2px;">Task description will be here</div>

                                        <!-- Dates & Badge Row -->
                                        <div class="d-flex justify-content-between mt-2 flex-nowrap" style="background-color: #fff; border-radius: 10px; padding: 4px;gap:3px;">
                                            <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                <small>Start: 22.10.2024</small>
                                            </div>

                                            <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                <small>Deliver: 22.10.2024</small>
                                            </div>

                                            <!-- Deadline/Warning -->
                                            <div class="d-flex align-items-center" style="font-size: 11px; background-color: #ff4d4f; color: white; padding: 2px 6px; border-radius: 6px;">
                                                <img src="https://img.icons8.com/ios-filled/16/ffffff/flash-on.png" alt="Urgent" style="margin-right: 4px;">
                                                01
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- 2 -->
                                <div class="d-flex p-2 rounded mt-2" style="background-color: #ebebeb;cursor:pointer" data-bs-toggle="modal" data-bs-target="#indelayed">

                                    <!-- Task Image -->
                                    <div class="me-2">
                                        <img src="{{ asset('build/img/dooted img.svg') }}" alt="Task Image"
                                            style="width: 50px; height: 100%; border-radius: 6px; object-fit: cover;">
                                    </div>

                                    <!-- Task Content -->
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div style="font-weight: 600; font-size: 14px; display: flex; align-items: center;">
                                                <img src="{{ asset('build/img/yekbon.svg') }}" alt="" style="width: 30px; height: 30px; margin-right: 6px;">
                                                Task Title
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <!-- Status Dot -->
                                                <span style="width: 12px; height: 12px; background-color: #7ED957; border-radius: 50%; display: inline-block;"></span>
                                                <!-- Avatar -->
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile" style="width: 24px; height: 24px; border-radius: 50%;">
                                            </div>
                                        </div>

                                        <!-- Sub Text -->
                                        <div style="font-size: 12px; color: #6c757d;">Ticket #1 - Ticket Title</div>

                                        <!-- Description -->
                                        <div style="font-size: 13px; margin-top: 2px;">Task description will be here</div>

                                        <!-- Dates & Badge Row -->
                                        <div class="d-flex justify-content-between mt-2 flex-nowrap" style="background-color: #fff; border-radius: 10px; padding: 4px;gap:3px;">
                                            <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                <small>Start: 22.10.2024</small>
                                            </div>

                                            <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                <small>Deliver: 22.10.2024</small>
                                            </div>

                                            <!-- Deadline/Warning -->
                                            <div class="d-flex align-items-center" style="font-size: 11px; background-color: #ff4d4f; color: white; padding: 2px 6px; border-radius: 6px;">
                                                <img src="https://img.icons8.com/ios-filled/16/ffffff/flash-on.png" alt="Urgent" style="margin-right: 4px;">
                                                01
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- 3 -->
                                <div class="d-flex p-2 rounded mt-2" style="background-color: #ebebeb;cursor:pointer" data-bs-toggle="modal" data-bs-target="#indelayed">

                                    <!-- Task Image -->
                                    <div class="me-2">
                                        <img src="{{ asset('build/img/dooted img.svg') }}" alt="Task Image"
                                            style="width: 50px; height: 100%; border-radius: 6px; object-fit: cover;">
                                    </div>

                                    <!-- Task Content -->
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div style="font-weight: 600; font-size: 14px; display: flex; align-items: center;">
                                                <img src="{{ asset('build/img/yekbon.svg') }}" alt="" style="width: 30px; height: 30px; margin-right: 6px;">
                                                Task Title
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <!-- Status Dot -->
                                                <span style="width: 12px; height: 12px; background-color: #7ED957; border-radius: 50%; display: inline-block;"></span>
                                                <!-- Avatar -->
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile" style="width: 24px; height: 24px; border-radius: 50%;">
                                            </div>
                                        </div>

                                        <!-- Sub Text -->
                                        <div style="font-size: 12px; color: #6c757d;">Ticket #1 - Ticket Title</div>

                                        <!-- Description -->
                                        <div style="font-size: 13px; margin-top: 2px;">Task description will be here</div>

                                        <!-- Dates & Badge Row -->
                                        <div class="d-flex justify-content-between mt-2 flex-nowrap" style="background-color: #fff; border-radius: 10px; padding: 4px;gap:3px;">
                                            <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                <small>Start: 22.10.2024</small>
                                            </div>

                                            <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                <small>Deliver: 22.10.2024</small>
                                            </div>

                                            <!-- Deadline/Warning -->
                                            <div class="d-flex align-items-center" style="font-size: 11px; background-color: #ff4d4f; color: white; padding: 2px 6px; border-radius: 6px;">
                                                <img src="https://img.icons8.com/ios-filled/16/ffffff/flash-on.png" alt="Urgent" style="margin-right: 4px;">
                                                01
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- In Done -->
                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="card p-1 mb-3 shadow-sm" style="background: #ffffff; border-radius: 12px; font-family: 'Segoe UI', sans-serif;">

                                <!-- Header Row -->
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <div style="color:#1ec963; font-weight: 600; font-size: 16px;">In Done</div>
                                        <div style="font-size: 13px; color:#1ec963;">Total Tasks: 10</div>
                                    </div>
                                    <div>
                                        <select class="form-select form-select-sm" style="width: 140px; font-size: 13px;">
                                            <option selected>Select Projects</option>
                                            <option selected>Yekbon</option>
                                            <option selected>CMS</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Task Card -->
                                <div class="d-flex p-2 rounded mt-2" style="background-color: #ebebeb;cursor:pointer" data-bs-toggle="modal" data-bs-target="#indone">

                                    <!-- Task Image -->
                                    <div class="me-2">
                                        <img src="{{ asset('build/img/dooted img.svg') }}" alt="Task Image"
                                            style="width: 50px; height: 100%; border-radius: 6px; object-fit: cover;">
                                    </div>

                                    <!-- Task Content -->
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div style="font-weight: 600; font-size: 14px; display: flex; align-items: center;">
                                                <img src="{{ asset('build/img/yekbon.svg') }}" alt="" style="width: 30px; height: 30px; margin-right: 6px;">
                                                Task Title
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <!-- Status Dot -->
                                                <span style="width: 12px; height: 12px; background-color: #7ED957; border-radius: 50%; display: inline-block;"></span>
                                                <!-- Avatar -->
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile" style="width: 24px; height: 24px; border-radius: 50%;">
                                            </div>
                                        </div>

                                        <!-- Sub Text -->
                                        <div style="font-size: 12px; color: #6c757d;">Ticket #1 - Ticket Title</div>

                                        <!-- Description -->
                                        <div style="font-size: 13px; margin-top: 2px;">Task description will be here</div>

                                        <!-- Dates & Badge Row -->
                                        <div class="d-flex justify-content-between mt-2 flex-nowrap" style="background-color: #fff; border-radius: 10px; padding: 4px;gap:3px;">
                                            <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                <small>Start: 22.10.2024</small>
                                            </div>

                                            <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                <small>Deliver: 22.10.2024</small>
                                            </div>

                                            <!-- Deadline/Warning -->
                                            <div class="d-flex align-items-center" style="font-size: 11px; background-color: #ff4d4f; color: white; padding: 2px 6px; border-radius: 6px;">
                                                <img src="https://img.icons8.com/ios-filled/16/ffffff/flash-on.png" alt="Urgent" style="margin-right: 4px;">
                                                01
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- 2 -->
                                <div class="d-flex p-2 rounded mt-2" style="background-color: #ebebeb;cursor:pointer" data-bs-toggle="modal" data-bs-target="#indone">

                                    <!-- Task Image -->
                                    <div class="me-2">
                                        <img src="{{ asset('build/img/dooted img.svg') }}" alt="Task Image"
                                            style="width: 50px; height: 100%; border-radius: 6px; object-fit: cover;">
                                    </div>

                                    <!-- Task Content -->
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div style="font-weight: 600; font-size: 14px; display: flex; align-items: center;">
                                                <img src="{{ asset('build/img/yekbon.svg') }}" alt="" style="width: 30px; height: 30px; margin-right: 6px;">
                                                Task Title
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <!-- Status Dot -->
                                                <span style="width: 12px; height: 12px; background-color: #7ED957; border-radius: 50%; display: inline-block;"></span>
                                                <!-- Avatar -->
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile" style="width: 24px; height: 24px; border-radius: 50%;">
                                            </div>
                                        </div>

                                        <!-- Sub Text -->
                                        <div style="font-size: 12px; color: #6c757d;">Ticket #1 - Ticket Title</div>

                                        <!-- Description -->
                                        <div style="font-size: 13px; margin-top: 2px;">Task description will be here</div>

                                        <!-- Dates & Badge Row -->
                                        <div class="d-flex justify-content-between mt-2 flex-nowrap" style="background-color: #fff; border-radius: 10px; padding: 4px;gap:3px;">
                                            <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                <small>Start: 22.10.2024</small>
                                            </div>

                                            <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                <small>Deliver: 22.10.2024</small>
                                            </div>

                                            <!-- Deadline/Warning -->
                                            <div class="d-flex align-items-center" style="font-size: 11px; background-color: #ff4d4f; color: white; padding: 2px 6px; border-radius: 6px;">
                                                <img src="https://img.icons8.com/ios-filled/16/ffffff/flash-on.png" alt="Urgent" style="margin-right: 4px;">
                                                01
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- 3 -->
                                <div class="d-flex p-2 rounded mt-2" style="background-color: #ebebeb;cursor:pointer" data-bs-toggle="modal" data-bs-target="#indone">

                                    <!-- Task Image -->
                                    <div class="me-2">
                                        <img src="{{ asset('build/img/dooted img.svg') }}" alt="Task Image"
                                            style="width: 50px; height: 100%; border-radius: 6px; object-fit: cover;">
                                    </div>

                                    <!-- Task Content -->
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div style="font-weight: 600; font-size: 14px; display: flex; align-items: center;">
                                                <img src="{{ asset('build/img/yekbon.svg') }}" alt="" style="width: 30px; height: 30px; margin-right: 6px;">
                                                Task Title
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <!-- Status Dot -->
                                                <span style="width: 12px; height: 12px; background-color: #7ED957; border-radius: 50%; display: inline-block;"></span>
                                                <!-- Avatar -->
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile" style="width: 24px; height: 24px; border-radius: 50%;">
                                            </div>
                                        </div>

                                        <!-- Sub Text -->
                                        <div style="font-size: 12px; color: #6c757d;">Ticket #1 - Ticket Title</div>

                                        <!-- Description -->
                                        <div style="font-size: 13px; margin-top: 2px;">Task description will be here</div>

                                        <!-- Dates & Badge Row -->
                                        <div class="d-flex justify-content-between mt-2 flex-nowrap" style="background-color: #fff; border-radius: 10px; padding: 4px;gap:3px;">
                                            <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                <small>Start: 22.10.2024</small>
                                            </div>

                                            <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                <small>Deliver: 22.10.2024</small>
                                            </div>

                                            <!-- Deadline/Warning -->
                                            <div class="d-flex align-items-center" style="font-size: 11px; background-color: #ff4d4f; color: white; padding: 2px 6px; border-radius: 6px;">
                                                <img src="https://img.icons8.com/ios-filled/16/ffffff/flash-on.png" alt="Urgent" style="margin-right: 4px;">
                                                01
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Total Tasks -->
                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="card p-1 mb-3 shadow-sm" style="background: #ffffff; border-radius: 12px; font-family: 'Segoe UI', sans-serif;">

                                <!-- Header Row -->
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <div style="color:#869da2; font-weight: 600; font-size: 16px;">New Task</div>
                                        <div style="font-size: 13px; color: #869da2;">Total Tasks: 10</div>
                                    </div>
                                    <div>
                                        <select class="form-select form-select-sm" style="width: 140px; font-size: 13px;">
                                            <option selected>Select Projects</option>
                                            <option selected>Yekbon</option>
                                            <option selected>CMS</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Task Card -->
                                <div class="d-flex p-2 rounded mt-2" style="background-color: #ebebeb;cursor:pointer" data-bs-toggle="modal" data-bs-target="#totaltask">

                                    <!-- Task Image -->
                                    <div class="me-2">
                                        <img src="{{ asset('build/img/dooted img.svg') }}" alt="Task Image"
                                            style="width: 50px; height: 100%; border-radius: 6px; object-fit: cover;">
                                    </div>

                                    <!-- Task Content -->
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div style="font-weight: 600; font-size: 14px; display: flex; align-items: center;">
                                                <img src="{{ asset('build/img/yekbon.svg') }}" alt="" style="width: 30px; height: 30px; margin-right: 6px;">
                                                Task Title
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <!-- Status Dot -->
                                                <span style="width: 12px; height: 12px; background-color: #7ED957; border-radius: 50%; display: inline-block;"></span>
                                                <!-- Avatar -->
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile" style="width: 24px; height: 24px; border-radius: 50%;">
                                            </div>
                                        </div>

                                        <!-- Sub Text -->
                                        <div style="font-size: 12px; color: #6c757d;">Ticket #1 - Ticket Title</div>

                                        <!-- Description -->
                                        <div style="font-size: 13px; margin-top: 2px;">Task description will be here</div>

                                        <!-- Dates & Badge Row -->
                                        <div class="d-flex justify-content-between mt-2 flex-nowrap" style="background-color: #fff; border-radius: 10px; padding: 4px;gap:3px;">
                                            <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                <small>Start: 22.10.2024</small>
                                            </div>

                                            <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                <small>Deliver: 22.10.2024</small>
                                            </div>

                                            <!-- Deadline/Warning -->
                                            <div class="d-flex align-items-center" style="font-size: 11px; background-color: #ff4d4f; color: white; padding: 2px 6px; border-radius: 6px;">
                                                <img src="https://img.icons8.com/ios-filled/16/ffffff/flash-on.png" alt="Urgent" style="margin-right: 4px;">
                                                01
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- 2 -->
                                <div class="d-flex p-2 rounded mt-2" style="background-color: #ebebeb;cursor:pointer" data-bs-toggle="modal" data-bs-target="#totaltask">

                                    <!-- Task Image -->
                                    <div class="me-2">
                                        <img src="{{ asset('build/img/dooted img.svg') }}" alt="Task Image"
                                            style="width: 50px; height: 100%; border-radius: 6px; object-fit: cover;">
                                    </div>

                                    <!-- Task Content -->
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div style="font-weight: 600; font-size: 14px; display: flex; align-items: center;">
                                                <img src="{{ asset('build/img/yekbon.svg') }}" alt="" style="width: 30px; height: 30px; margin-right: 6px;">
                                                Task Title
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <!-- Status Dot -->
                                                <span style="width: 12px; height: 12px; background-color: #7ED957; border-radius: 50%; display: inline-block;"></span>
                                                <!-- Avatar -->
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile" style="width: 24px; height: 24px; border-radius: 50%;">
                                            </div>
                                        </div>

                                        <!-- Sub Text -->
                                        <div style="font-size: 12px; color: #6c757d;">Ticket #1 - Ticket Title</div>

                                        <!-- Description -->
                                        <div style="font-size: 13px; margin-top: 2px;">Task description will be here</div>

                                        <!-- Dates & Badge Row -->
                                        <div class="d-flex justify-content-between mt-2 flex-nowrap" style="background-color: #fff; border-radius: 10px; padding: 4px;gap:3px;">
                                            <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                <small>Start: 22.10.2024</small>
                                            </div>

                                            <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                <small>Deliver: 22.10.2024</small>
                                            </div>

                                            <!-- Deadline/Warning -->
                                            <div class="d-flex align-items-center" style="font-size: 11px; background-color: #ff4d4f; color: white; padding: 2px 6px; border-radius: 6px;">
                                                <img src="https://img.icons8.com/ios-filled/16/ffffff/flash-on.png" alt="Urgent" style="margin-right: 4px;">
                                                01
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- 3 -->
                                <div class="d-flex p-2 rounded mt-2" style="background-color: #ebebeb;cursor:pointer" data-bs-toggle="modal" data-bs-target="#totaltask">

                                    <!-- Task Image -->
                                    <div class="me-2">
                                        <img src="{{ asset('build/img/dooted img.svg') }}" alt="Task Image"
                                            style="width: 50px; height: 100%; border-radius: 6px; object-fit: cover;">
                                    </div>

                                    <!-- Task Content -->
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div style="font-weight: 600; font-size: 14px; display: flex; align-items: center;">
                                                <img src="{{ asset('build/img/yekbon.svg') }}" alt="" style="width: 30px; height: 30px; margin-right: 6px;">
                                                Task Title
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <!-- Status Dot -->
                                                <span style="width: 12px; height: 12px; background-color: #7ED957; border-radius: 50%; display: inline-block;"></span>
                                                <!-- Avatar -->
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile" style="width: 24px; height: 24px; border-radius: 50%;">
                                            </div>
                                        </div>

                                        <!-- Sub Text -->
                                        <div style="font-size: 12px; color: #6c757d;">Ticket #1 - Ticket Title</div>

                                        <!-- Description -->
                                        <div style="font-size: 13px; margin-top: 2px;">Task description will be here</div>

                                        <!-- Dates & Badge Row -->
                                        <div class="d-flex justify-content-between mt-2 flex-nowrap" style="background-color: #fff; border-radius: 10px; padding: 4px;gap:3px;">
                                            <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                <small>Start: 22.10.2024</small>
                                            </div>

                                            <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                <small>Deliver: 22.10.2024</small>
                                            </div>

                                            <!-- Deadline/Warning -->
                                            <div class="d-flex align-items-center" style="font-size: 11px; background-color: #ff4d4f; color: white; padding: 2px 6px; border-radius: 6px;">
                                                <img src="https://img.icons8.com/ios-filled/16/ffffff/flash-on.png" alt="Urgent" style="margin-right: 4px;">
                                                01
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!--  current task -->
                    <div class="project-succes pt-4 pb-4 d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">

                        <!-- Left Title -->
                        <div>
                            <h3 style="margin: 0;">Current Tasks</h3>
                            <strong>Task Overview</strong>
                        </div>

                        <!-- Filter + Dropdown -->
                        <div style="background: #f8fafc; padding: 6px 10px; border-radius: 8px; display: flex; flex-wrap: wrap; gap: 10px; align-items: center;">

                            <!-- Filter Buttons -->
                            <div style="display: flex; gap: 10px; flex-wrap: wrap; flex: 1 1 auto;">
                                <button onclick="setActive(this)" style="background: transparent; color: #6c757d; border: none; padding: 6px 16px; border-radius: 6px; font-weight: 500; font-size: 14px; cursor: pointer;">All</button>
                                <button onclick="setActive(this)" style="background: #28c76f; color: white; border: none; padding: 6px 16px; border-radius: 6px; font-weight: 500; font-size: 14px; cursor: pointer;">Low</button>
                                <button onclick="setActive(this)" style="background: transparent; color: #6c757d; border: none; padding: 6px 16px; border-radius: 6px; font-weight: 500; font-size: 14px; cursor: pointer;">Middle</button>
                                <button onclick="setActive(this)" style="background: transparent; color: #6c757d; border: none; padding: 6px 16px; border-radius: 6px; font-weight: 500; font-size: 14px; cursor: pointer;">High</button>
                            </div>

                            <!-- Dropdown -->
                            <div style="flex-shrink: 0;">
                                <select style="font-size: 14px; padding: 6px 12px; border-radius: 6px; border: 1px solid #ddd; color: #6c757d; background-color: #f8f9fa; min-width: 140px;">
                                    <option selected>Select Projects</option>
                                    <option>Project 1</option>
                                    <option>Project 2</option>
                                </select>
                            </div>
                        </div>

                        <!-- Inline JS -->
                        <script>
                            function setActive(el) {
                                const buttons = el.parentElement.querySelectorAll('button');
                                buttons.forEach(btn => {
                                    btn.style.background = 'transparent';
                                    btn.style.color = '#6c757d';
                                });
                                el.style.background = '#28c76f';
                                el.style.color = 'white';
                            }
                        </script>

                    </div>
                    <!-- cards -->
                    <div class="mb-2">
                        <div class="row g-1">
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                <div class="card shadow-sm p-1" style="border-radius: 20px; font-family: 'Segoe UI', sans-serif;">
                                    <!-- Top Section -->
                                    <div class="d-flex justify-content-between align-items-start mb-3">

                                        <!-- Progress Circle (Left) -->
                                        <div style="width: 50px; height: 50px; position: relative;">
                                            <svg width="50" height="50">
                                                <defs>
                                                    <linearGradient id="grad" x1="0%" y1="0%" x2="100%" y2="0%">
                                                        <stop offset="0%" stop-color="#ff7f00" />
                                                        <stop offset="100%" stop-color="#fcd34d" />
                                                    </linearGradient>
                                                </defs>
                                                <circle cx="25" cy="25" r="21" stroke="#d1d1d1" stroke-width="6" fill="none" />
                                                <circle
                                                    cx="25"
                                                    cy="25"
                                                    r="21"
                                                    stroke="url(#grad)"
                                                    stroke-width="6"
                                                    fill="none"
                                                    stroke-dasharray="131.88"
                                                    stroke-dashoffset="39.56" <!-- 70% -->
                                                    stroke-linecap="round"
                                                    transform="rotate(-90 25 25)" />
                                            </svg>
                                            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 10px; font-weight: bold; color: #333;">
                                                70%
                                            </div>
                                        </div>

                                        <!-- Logo in center -->
                                        <div class="text-center" style="flex-grow: 1;">
                                            <img src="{{URL::asset('/build/img/yekbon.svg')}}" class="rounded-circle mb-1" style="height: 55px; width: 55px; object-fit: cover;" alt="Project Logo">
                                        </div>

                                        <!-- Dropdown (Right) -->
                                        <div style="flex-shrink: 0;">
                                            <select style="font-size: 12px; padding: 4px 10px; border-radius: 6px; border: 1px solid #ddd; color: #6c757d; background-color: #f8f9fa; width: 110px;">
                                                <option selected>Select Ticket</option>
                                                <option>Ticket 1</option>
                                                <option>Ticket 2</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Project Title and Up Icon -->
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div></div>
                                        <div>
                                            <h5 class="text-center" style="margin: 0 auto; font-weight: bold; color: #2e2e5d;">Project Title</h5>
                                        </div>
                                        <div>
                                            <img src="{{ URL::asset('/build/img/top_arrow.svg') }}" alt="top" width="20" height="20" style="margin-left: auto;">
                                        </div>
                                    </div>

                                    <!-- Description and Status -->
                                    <div class="d-flex justify-content-between align-items-center px-2 py-1 mb-1" style="background-color: #f1f5f9; border-radius: 10px;">
                                        <div class="d-flex align-items-center gap-2" style="background: #ecfbdc;">
                                            <img src="{{URL::asset('/build/img/flag.svg')}}" width="16" height="16" alt="flag">

                                        </div>
                                        <div>
                                            <small style="color: #64748b; font-size: 13px;">Description will be here</small>
                                        </div>
                                        <div class="d-flex align-items-center gap-1">
                                            <span style="width: 8px; height: 8px; background-color: #22c55e; border-radius: 50%; display: inline-block;"></span>
                                            <small style="font-size: 12px; color: #22c55e;">Low</small>
                                        </div>
                                    </div>

                                    <!-- Bottom Stats Row -->
                                    <div class="d-flex justify-content-between align-items-center px-2 mt-1"
                                        style="font-size: 11px; background-color: #f1f5f9; border-radius: 10px; padding: 8px 10px;flex-wrap:wrap">

                                        <!-- Tickets -->
                                        <div style="color: #1e293b; white-space: nowrap;">
                                            <strong>Tickets:</strong> 5
                                        </div>

                                        <!-- Divider -->
                                        <div style="height: 16px; width: 1px; background-color: #cbd5e1;"></div>

                                        <!-- Tasks -->
                                        <div style="color: #1e293b; white-space: nowrap;">
                                            <strong>Tasks:</strong> 15
                                        </div>

                                        <!-- Divider -->
                                        <div style="height: 16px; width: 1px; background-color: #cbd5e1;"></div>

                                        <!-- Start -->
                                        <div style="color: #10b981; white-space: nowrap;">
                                            <strong>Start:</strong> 22.10.2024
                                        </div>

                                        <!-- Divider -->
                                        <div style="height: 16px; width: 1px; background-color: #cbd5e1;"></div>

                                        <!-- End -->
                                        <div style="color: #ef4444; white-space: nowrap;">
                                            <strong>End:</strong> 22.10.2024
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <!-- 2 -->
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                <div class="card shadow-sm p-1" style="border-radius: 20px; font-family: 'Segoe UI', sans-serif;">
                                    <!-- Top Section -->
                                    <div class="d-flex justify-content-between align-items-start mb-3">

                                        <!-- Progress Circle (Left) -->
                                        <div style="width: 50px; height: 50px; position: relative;">
                                            <svg width="50" height="50">
                                                <defs>
                                                    <linearGradient id="grad" x1="0%" y1="0%" x2="100%" y2="0%">
                                                        <stop offset="0%" stop-color="#ff7f00" />
                                                        <stop offset="100%" stop-color="#fcd34d" />
                                                    </linearGradient>
                                                </defs>
                                                <circle cx="25" cy="25" r="21" stroke="#d1d1d1" stroke-width="6" fill="none" />
                                                <circle
                                                    cx="25"
                                                    cy="25"
                                                    r="21"
                                                    stroke="url(#grad)"
                                                    stroke-width="6"
                                                    fill="none"
                                                    stroke-dasharray="131.88"
                                                    stroke-dashoffset="39.56" <!-- 70% -->
                                                    stroke-linecap="round"
                                                    transform="rotate(-90 25 25)" />
                                            </svg>
                                            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 10px; font-weight: bold; color: #333;">
                                                70%
                                            </div>
                                        </div>

                                        <!-- Logo in center -->
                                        <div class="text-center" style="flex-grow: 1;">
                                            <img src="{{URL::asset('/build/img/yekbon.svg')}}" class="rounded-circle mb-1" style="height: 55px; width: 55px; object-fit: cover;" alt="Project Logo">
                                        </div>

                                        <!-- Dropdown (Right) -->
                                        <div style="flex-shrink: 0;">
                                            <select style="font-size: 12px; padding: 4px 10px; border-radius: 6px; border: 1px solid #ddd; color: #6c757d; background-color: #f8f9fa; width: 110px;">
                                                <option selected>Select Ticket</option>
                                                <option>Ticket 1</option>
                                                <option>Ticket 2</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Project Title and Up Icon -->
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div></div>
                                        <div>
                                            <h5 class="text-center" style="margin: 0 auto; font-weight: bold; color: #2e2e5d;">Project Title</h5>
                                        </div>
                                        <div>
                                            <img src="{{ URL::asset('/build/img/top_arrow.svg') }}" alt="top" width="20" height="20" style="margin-left: auto;">
                                        </div>
                                    </div>

                                    <!-- Description and Status -->
                                    <div class="d-flex justify-content-between align-items-center px-2 py-1 mb-1" style="background-color: #f1f5f9; border-radius: 10px;">
                                        <div class="d-flex align-items-center gap-2" style="background: #ecfbdc;">
                                            <img src="{{URL::asset('/build/img/flag.svg')}}" width="16" height="16" alt="flag">

                                        </div>
                                        <div>
                                            <small style="color: #64748b; font-size: 13px;">Description will be here</small>
                                        </div>
                                        <div class="d-flex align-items-center gap-1">
                                            <span style="width: 8px; height: 8px; background-color: #22c55e; border-radius: 50%; display: inline-block;"></span>
                                            <small style="font-size: 12px; color: #22c55e;">Low</small>
                                        </div>
                                    </div>

                                    <!-- Bottom Stats Row -->
                                    <div class="d-flex justify-content-between align-items-center px-2 mt-1"
                                        style="font-size: 11px; background-color: #f1f5f9; border-radius: 10px; padding: 8px 10px;flex-wrap:wrap">

                                        <!-- Tickets -->
                                        <div style="color: #1e293b; white-space: nowrap;">
                                            <strong>Tickets:</strong> 5
                                        </div>

                                        <!-- Divider -->
                                        <div style="height: 16px; width: 1px; background-color: #cbd5e1;"></div>

                                        <!-- Tasks -->
                                        <div style="color: #1e293b; white-space: nowrap;">
                                            <strong>Tasks:</strong> 15
                                        </div>

                                        <!-- Divider -->
                                        <div style="height: 16px; width: 1px; background-color: #cbd5e1;"></div>

                                        <!-- Start -->
                                        <div style="color: #10b981; white-space: nowrap;">
                                            <strong>Start:</strong> 22.10.2024
                                        </div>

                                        <!-- Divider -->
                                        <div style="height: 16px; width: 1px; background-color: #cbd5e1;"></div>

                                        <!-- End -->
                                        <div style="color: #ef4444; white-space: nowrap;">
                                            <strong>End:</strong> 22.10.2024
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <!-- 3 -->
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                <div class="card shadow-sm p-1" style="border-radius: 20px; font-family: 'Segoe UI', sans-serif;">
                                    <!-- Top Section -->
                                    <div class="d-flex justify-content-between align-items-start mb-3">

                                        <!-- Progress Circle (Left) -->
                                        <div style="width: 50px; height: 50px; position: relative;">
                                            <svg width="50" height="50">
                                                <defs>
                                                    <linearGradient id="grad" x1="0%" y1="0%" x2="100%" y2="0%">
                                                        <stop offset="0%" stop-color="#ff7f00" />
                                                        <stop offset="100%" stop-color="#fcd34d" />
                                                    </linearGradient>
                                                </defs>
                                                <circle cx="25" cy="25" r="21" stroke="#d1d1d1" stroke-width="6" fill="none" />
                                                <circle
                                                    cx="25"
                                                    cy="25"
                                                    r="21"
                                                    stroke="url(#grad)"
                                                    stroke-width="6"
                                                    fill="none"
                                                    stroke-dasharray="131.88"
                                                    stroke-dashoffset="39.56" <!-- 70% -->
                                                    stroke-linecap="round"
                                                    transform="rotate(-90 25 25)" />
                                            </svg>
                                            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 10px; font-weight: bold; color: #333;">
                                                70%
                                            </div>
                                        </div>

                                        <!-- Logo in center -->
                                        <div class="text-center" style="flex-grow: 1;">
                                            <img src="{{URL::asset('/build/img/yekbon.svg')}}" class="rounded-circle mb-1" style="height: 55px; width: 55px; object-fit: cover;" alt="Project Logo">
                                        </div>

                                        <!-- Dropdown (Right) -->
                                        <div style="flex-shrink: 0;">
                                            <select style="font-size: 12px; padding: 4px 10px; border-radius: 6px; border: 1px solid #ddd; color: #6c757d; background-color: #f8f9fa; width: 110px;">
                                                <option selected>Select Ticket</option>
                                                <option>Ticket 1</option>
                                                <option>Ticket 2</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Project Title and Up Icon -->
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div></div>
                                        <div>
                                            <h5 class="text-center" style="margin: 0 auto; font-weight: bold; color: #2e2e5d;">Project Title</h5>
                                        </div>
                                        <div>
                                            <img src="{{ URL::asset('/build/img/top_arrow.svg') }}" alt="top" width="20" height="20" style="margin-left: auto;">
                                        </div>
                                    </div>

                                    <!-- Description and Status -->
                                    <div class="d-flex justify-content-between align-items-center px-2 py-1 mb-1" style="background-color: #f1f5f9; border-radius: 10px;">
                                        <div class="d-flex align-items-center gap-2" style="background: #ecfbdc;">
                                            <img src="{{URL::asset('/build/img/flag.svg')}}" width="16" height="16" alt="flag">

                                        </div>
                                        <div>
                                            <small style="color: #64748b; font-size: 13px;">Description will be here</small>
                                        </div>
                                        <div class="d-flex align-items-center gap-1">
                                            <span style="width: 8px; height: 8px; background-color: #22c55e; border-radius: 50%; display: inline-block;"></span>
                                            <small style="font-size: 12px; color: #22c55e;">Low</small>
                                        </div>
                                    </div>

                                    <!-- Bottom Stats Row -->
                                    <div class="d-flex justify-content-between align-items-center px-2 mt-1"
                                        style="font-size: 11px; background-color: #f1f5f9; border-radius: 10px;  padding: 8px 10px;flex-wrap:wrap">

                                        <!-- Tickets -->
                                        <div style="color: #1e293b; white-space: nowrap;">
                                            <strong>Tickets:</strong> 5
                                        </div>

                                        <!-- Divider -->
                                        <div style="height: 16px; width: 1px; background-color: #cbd5e1;"></div>

                                        <!-- Tasks -->
                                        <div style="color: #1e293b; white-space: nowrap;">
                                            <strong>Tasks:</strong> 15
                                        </div>

                                        <!-- Divider -->
                                        <div style="height: 16px; width: 1px; background-color: #cbd5e1;"></div>

                                        <!-- Start -->
                                        <div style="color: #10b981; white-space: nowrap;">
                                            <strong>Start:</strong> 22.10.2024
                                        </div>

                                        <!-- Divider -->
                                        <div style="height: 16px; width: 1px; background-color: #cbd5e1;"></div>

                                        <!-- End -->
                                        <div style="color: #ef4444; white-space: nowrap;">
                                            <strong>End:</strong> 22.10.2024
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <!-- 4 -->
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                <div class="card shadow-sm p-1" style="border-radius: 20px; font-family: 'Segoe UI', sans-serif;">
                                    <!-- Top Section -->
                                    <div class="d-flex justify-content-between align-items-start mb-3">

                                        <!-- Progress Circle (Left) -->
                                        <div style="width: 50px; height: 50px; position: relative;">
                                            <svg width="50" height="50">
                                                <defs>
                                                    <linearGradient id="grad" x1="0%" y1="0%" x2="100%" y2="0%">
                                                        <stop offset="0%" stop-color="#ff7f00" />
                                                        <stop offset="100%" stop-color="#fcd34d" />
                                                    </linearGradient>
                                                </defs>
                                                <circle cx="25" cy="25" r="21" stroke="#d1d1d1" stroke-width="6" fill="none" />
                                                <circle
                                                    cx="25"
                                                    cy="25"
                                                    r="21"
                                                    stroke="url(#grad)"
                                                    stroke-width="6"
                                                    fill="none"
                                                    stroke-dasharray="131.88"
                                                    stroke-dashoffset="39.56" <!-- 70% -->
                                                    stroke-linecap="round"
                                                    transform="rotate(-90 25 25)" />
                                            </svg>
                                            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 10px; font-weight: bold; color: #333;">
                                                70%
                                            </div>
                                        </div>

                                        <!-- Logo in center -->
                                        <div class="text-center" style="flex-grow: 1;">
                                            <img src="{{URL::asset('/build/img/yekbon.svg')}}" class="rounded-circle mb-1" style="height: 55px; width: 55px; object-fit: cover;" alt="Project Logo">
                                        </div>

                                        <!-- Dropdown (Right) -->
                                        <div style="flex-shrink: 0;">
                                            <select style="font-size: 12px; padding: 4px 10px; border-radius: 6px; border: 1px solid #ddd; color: #6c757d; background-color: #f8f9fa; width: 110px;">
                                                <option selected>Select Ticket</option>
                                                <option>Ticket 1</option>
                                                <option>Ticket 2</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Project Title and Up Icon -->
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div></div>
                                        <div>
                                            <h5 class="text-center" style="margin: 0 auto; font-weight: bold; color: #2e2e5d;">Project Title</h5>
                                        </div>
                                        <div>
                                            <img src="{{ URL::asset('/build/img/top_arrow.svg') }}" alt="top" width="20" height="20" style="margin-left: auto;">
                                        </div>
                                    </div>

                                    <!-- Description and Status -->
                                    <div class="d-flex justify-content-between align-items-center px-2 py-1 mb-1" style="background-color: #f1f5f9; border-radius: 10px;">
                                        <div class="d-flex align-items-center gap-2" style="background: #ecfbdc;">
                                            <img src="{{URL::asset('/build/img/flag.svg')}}" width="16" height="16" alt="flag">

                                        </div>
                                        <div>
                                            <small style="color: #64748b; font-size: 13px;">Description will be here</small>
                                        </div>
                                        <div class="d-flex align-items-center gap-1">
                                            <span style="width: 8px; height: 8px; background-color: #22c55e; border-radius: 50%; display: inline-block;"></span>
                                            <small style="font-size: 12px; color: #22c55e;">Low</small>
                                        </div>
                                    </div>

                                    <!-- Bottom Stats Row -->
                                    <div class="d-flex justify-content-between flex-wrap align-items-center px-2 mt-1"
                                        style="font-size: 11px; background-color: #f1f5f9; border-radius: 10px; padding: 8px 10px;flex-wrap:wrap">

                                        <!-- Tickets -->
                                        <div style="color: #1e293b; white-space: wrap;">
                                            <strong>Tickets:</strong> 5
                                        </div>

                                        <!-- Divider -->
                                        <div style="height: 16px; width: 1px; background-color: #cbd5e1;"></div>

                                        <!-- Tasks -->
                                        <div style="color: #1e293b; white-space: nowrap;">
                                            <strong>Tasks:</strong> 15
                                        </div>

                                        <!-- Divider -->
                                        <div style="height: 16px; width: 1px; background-color: #cbd5e1;"></div>

                                        <!-- Start -->
                                        <div style="color: #10b981; white-space: wrap;">
                                            <strong>Start:</strong> 22.10.2024
                                        </div>

                                        <!-- Divider -->
                                        <div style="height: 16px; width: 1px; background-color: #cbd5e1;"></div>

                                        <!-- End -->
                                        <div style="color: #ef4444; white-space: wrap;">
                                            <strong>End:</strong> 22.10.2024
                                        </div>
                                    </div>
                                    <div class=" mt-2" style=" background-color: #f1f5f9; border-radius: 10px;padding:10px;font-size: 12px;">

                                        <!-- Header -->
                                        <div class="d-flex justify-content-between">
                                            <div style="color: #1a73e8;"><strong>Tickets</strong><br>#1 - ID</div>
                                            <div style="color: #1a73e8;"><strong>Section</strong><br>User Profile</div>
                                            <div style="color: #1a73e8;"><strong>Ticket Title</strong><br>User Profile Bugs</div>
                                        </div>

                                        <!-- Task Line -->
                                        <div class="mt-3 d-flex justify-content-between flex-nowrap" style="background-color:#fff;border-radius:10px;">
                                            <span class="me-3"><strong>5 Tasks</strong></span>
                                            <span class="me-3 text-success">Start: 22.10.2024</span>
                                            <span class="text-success">Deliver: 22.10.2024</span>
                                            <!-- Overlapping Profile Avatars -->
                                            <div class="ms-auto d-flex">
                                                <img src="{{URL::asset('/build/img/profile.svg')}}" class="rounded-circle" style="width:30px; margin-left: -10px; border: 2px solid #e8ecef;" alt="User">
                                                <img src="{{URL::asset('/build/img/profile.svg')}}" class="rounded-circle" style="width:30px; margin-left: -10px; border: 2px solid #e8ecef;" alt="User">

                                            </div>

                                        </div>

                                        <!-- Progress Bar -->
                                        <div class="d-flex justify-content-between align-items-center mt-3" style="flex-wrap: nowrap;">

                                            <!-- Progress Bar + Percentage -->
                                            <div class="d-flex align-items-center" style="flex: 1;">
                                                <div class="progress" style="height: 8px; width: 100px; background-color: #e0e0e0; border-radius: 5px; overflow: hidden;">
                                                    <div class="progress-bar" role="progressbar" style="width: 75%; background-color: #4fc3f7;"></div>
                                                </div>
                                                <div style="font-size: 12px; color: #4fc3f7; margin-left: 1px;">75%</div>
                                            </div>

                                            <!-- Status Dots -->
                                            <div class="d-flex align-items-center ms-3" style="font-size: 11px; gap: 2px;margin-right:4px;">
                                                <span style="color: #8BC34A;">● 1</span>
                                                <span style="color: #FF9800;">● 3</span>
                                                <span style="color: #F44336;">● 0</span>
                                                <span style="color: #9C27B0;">● 0</span>
                                                <span style="color: #4CAF50;">● 0</span>

                                            </div>
                                            <div>
                                                <img src="{{URL::asset('/build/img/flag.svg')}}" style="width: 20px; background-color: #c8f7dc; border-radius: 5px; padding: 2px; " alt="flag">
                                            </div>

                                        </div>
                                        <!-- tasks -->



                                    </div>
                                    <!-- task  -->
                                    <div class="d-flex p-2 rounded mt-2" style="background-color: #ebebeb;">

                                        <!-- Task Image -->
                                        <div class="me-2">
                                            <img src="{{ asset('build/img/dooted img.svg') }}" alt="Task Image"
                                                style="width: 50px; height: 100%; border-radius: 6px; object-fit: cover;">
                                        </div>

                                        <!-- Task Content -->
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div style="font-weight: 600; font-size: 14px; display: flex; align-items: center;">
                                                    <img src="{{ asset('build/img/yekbon.svg') }}" alt="" style="width: 30px; height: 30px; margin-right: 6px;">
                                                    Task Title
                                                </div>
                                                <div class="d-flex align-items-center gap-2">
                                                    <!-- Status Dot -->
                                                    <span style="width: 12px; height: 12px; background-color: #7ED957; border-radius: 50%; display: inline-block;"></span>
                                                    <!-- Avatar -->
                                                    <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile" style="width: 24px; height: 24px; border-radius: 50%;">
                                                </div>
                                            </div>

                                            <!-- Sub Text -->
                                            <div style="font-size: 12px; color: #6c757d;">Ticket #1 - Ticket Title</div>

                                            <!-- Description -->
                                            <div style="font-size: 13px; margin-top: 2px;">Task description will be here</div>

                                            <!-- Dates & Badge Row -->
                                            <div class="d-flex justify-content-between mt-2 flex-nowrap" style="background-color: #fff; border-radius: 10px; padding: 4px;gap:3px;">
                                                <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                    <small>Start: 22.10.2024</small>
                                                </div>

                                                <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                    <small>Deliver: 22.10.2024</small>
                                                </div>

                                                <!-- Deadline/Warning -->
                                                <div class="d-flex align-items-center" style="font-size: 11px; background-color: #ff4d4f; color: white; padding: 2px 6px; border-radius: 6px;">
                                                    <img src="https://img.icons8.com/ios-filled/16/ffffff/flash-on.png" alt="Urgent" style="margin-right: 4px;">
                                                    01
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- task2 -->
                                    <div class="d-flex p-2 rounded mt-2" style="background-color: #ebebeb;">

                                        <!-- Task Image -->
                                        <div class="me-2">
                                            <img src="{{ asset('build/img/dooted img.svg') }}" alt="Task Image"
                                                style="width: 50px; height: 100%; border-radius: 6px; object-fit: cover;">
                                        </div>

                                        <!-- Task Content -->
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div style="font-weight: 600; font-size: 14px; display: flex; align-items: center;">
                                                    <img src="{{ asset('build/img/yekbon.svg') }}" alt="" style="width: 30px; height: 30px; margin-right: 6px;">
                                                    Task Title
                                                </div>
                                                <div class="d-flex align-items-center gap-2">
                                                    <!-- Status Dot -->
                                                    <span style="width: 12px; height: 12px; background-color: #7ED957; border-radius: 50%; display: inline-block;"></span>
                                                    <!-- Avatar -->
                                                    <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile" style="width: 24px; height: 24px; border-radius: 50%;">
                                                </div>
                                            </div>

                                            <!-- Sub Text -->
                                            <div style="font-size: 12px; color: #6c757d;">Ticket #1 - Ticket Title</div>

                                            <!-- Description -->
                                            <div style="font-size: 13px; margin-top: 2px;">Task description will be here</div>

                                            <!-- Dates & Badge Row -->
                                            <div class="d-flex justify-content-between mt-2 flex-nowrap" style="background-color: #fff; border-radius: 10px; padding: 4px;gap:3px;">
                                                <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                    <small>Start: 22.10.2024</small>
                                                </div>

                                                <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                    <small>Deliver: 22.10.2024</small>
                                                </div>

                                                <!-- Deadline/Warning -->
                                                <div class="d-flex align-items-center" style="font-size: 11px; background-color: #ff4d4f; color: white; padding: 2px 6px; border-radius: 6px;">
                                                    <img src="https://img.icons8.com/ios-filled/16/ffffff/flash-on.png" alt="Urgent" style="margin-right: 4px;">
                                                    01
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- task3 -->
                                    <div class="d-flex p-2 rounded mt-2" style="background-color: #ebebeb;">

                                        <!-- Task Image -->
                                        <div class="me-2">
                                            <img src="{{ asset('build/img/dooted img.svg') }}" alt="Task Image"
                                                style="width: 50px; height: 100%; border-radius: 6px; object-fit: cover;">
                                        </div>

                                        <!-- Task Content -->
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div style="font-weight: 600; font-size: 14px; display: flex; align-items: center;">
                                                    <img src="{{ asset('build/img/yekbon.svg') }}" alt="" style="width: 30px; height: 30px; margin-right: 6px;">
                                                    Task Title
                                                </div>
                                                <div class="d-flex align-items-center gap-2">
                                                    <!-- Status Dot -->
                                                    <span style="width: 12px; height: 12px; background-color: #7ED957; border-radius: 50%; display: inline-block;"></span>
                                                    <!-- Avatar -->
                                                    <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile" style="width: 24px; height: 24px; border-radius: 50%;">
                                                </div>
                                            </div>

                                            <!-- Sub Text -->
                                            <div style="font-size: 12px; color: #6c757d;">Ticket #1 - Ticket Title</div>

                                            <!-- Description -->
                                            <div style="font-size: 13px; margin-top: 2px;">Task description will be here</div>

                                            <!-- Dates & Badge Row -->
                                            <div class="d-flex justify-content-between mt-2 flex-nowrap" style="background-color: #fff; border-radius: 10px; padding: 4px;gap:3px;">
                                                <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                    <small>Start: 22.10.2024</small>
                                                </div>

                                                <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                    <small>Deliver: 22.10.2024</small>
                                                </div>

                                                <!-- Deadline/Warning -->
                                                <div class="d-flex align-items-center" style="font-size: 11px; background-color: #ff4d4f; color: white; padding: 2px 6px; border-radius: 6px;">
                                                    <img src="https://img.icons8.com/ios-filled/16/ffffff/flash-on.png" alt="Urgent" style="margin-right: 4px;">
                                                    01
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
    </div>
</div>







<!-- createTaskModal Modal -->
<div class="modal fade" id="createTaskModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius: 12px;">
            <!-- Modal Header -->
            <div class="modal-header d-flex justify-content-between flex-wrap align-items-start" style="background: #fff;">
                <!-- Title + Subtitle -->
                <div>
                    <h5 class="modal-title mb-0" style="font-weight: 600;">Create new Task</h5>
                    <small class="text-muted">Create a Task</small>
                </div>

                <!-- Task Type Buttons -->
                <div
                    class="d-flex gap-2 p-1 rounded"
                    style="background: #f2f2f2; border-radius: 10px;">
                    <button
                        id="btn-mobile"
                        class="btn btn-sm"
                        style="background-color: #28c76f; color: white;"
                        onclick="
        document.getElementById('btn-mobile').style.backgroundColor = '#28c76f';
        document.getElementById('btn-mobile').style.color = 'white';
        document.getElementById('btn-web').style.backgroundColor = 'transparent';
        document.getElementById('btn-web').style.color = '#6c757d';
        document.getElementById('btn-employee').style.backgroundColor = 'transparent';
        document.getElementById('btn-employee').style.color = '#6c757d';
      ">Mobile Task</button>

                    <button
                        id="btn-web"
                        class="btn btn-sm"
                        style="background-color: transparent; color: #6c757d;"
                        onclick="
        document.getElementById('btn-web').style.backgroundColor = '#28c76f';
        document.getElementById('btn-web').style.color = 'white';
        document.getElementById('btn-mobile').style.backgroundColor = 'transparent';
        document.getElementById('btn-mobile').style.color = '#6c757d';
        document.getElementById('btn-employee').style.backgroundColor = 'transparent';
        document.getElementById('btn-employee').style.color = '#6c757d';
      ">Web Task</button>

                    <button
                        id="btn-employee"
                        class="btn btn-sm"
                        style="background-color: transparent; color: #6c757d;"
                        onclick="
        document.getElementById('btn-employee').style.backgroundColor = '#28c76f';
        document.getElementById('btn-employee').style.color = 'white';
        document.getElementById('btn-mobile').style.backgroundColor = 'transparent';
        document.getElementById('btn-mobile').style.color = '#6c757d';
        document.getElementById('btn-web').style.backgroundColor = 'transparent';
        document.getElementById('btn-web').style.color = '#6c757d';
      ">Employee Task</button>
                </div>

                <!-- Close Button -->

            </div>


            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Task Tabs -->


                <!-- Top Controls -->
                <div class="row mb-3" style="background: #f9f9f9; padding: 15px; border-radius: 12px;">
                    <!-- Left: Ticket Details -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold mb-0" style="color: #2b2d42;">Ticket Details</label><br>
                        <small class="text-muted">Ticket Details</small>
                        <div class="d-flex gap-2 mt-2">
                            <select class="form-select form-select-sm" style="background: #fff; border-radius: 8px;">
                                <option>Select the Project</option>
                            </select>
                            <select class="form-select form-select-sm" style="background: #fff; border-radius: 8px;">
                                <option>Select the Ticket</option>
                            </select>
                        </div>
                    </div>

                    <!-- Right: Start & Delivery Dates -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold mb-0" style="color: #2b2d42;">Ticket Start & Deliver Date</label><br>
                        <small class="text-muted">Tasks must be done in this duration</small>
                        <div class="d-flex gap-2 mt-2">
                            <div class="text-center p-2 text-white" style="background: #28c76f; border-radius: 8px; flex: 1;">
                                <small>Start Date</small><br>
                                <span class="fw-bold">21.09.2025 – 15:00</span>
                            </div>
                            <div class="text-center p-2 text-white" style="background: #ea5455; border-radius: 8px; flex: 1;">
                                <small>Deliver Date</small><br>
                                <span class="fw-bold">27.09.2025 – 15:00</span>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Task Container -->
                <div class="row">
                    <!-- Left Upload Area -->
                    <div class="col-md-5">
                        <div
                            id="uploadBox"
                            onclick="document.getElementById('fileInput').click();"
                            style="background-color: #f7f7f7;
      height: 100%;
      min-height: 250px;
      cursor: pointer;
      border: 2px dashed #ccc;
      border-radius: 10px;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      flex-direction: column;
      position: relative;
    ">
                            <p id="uploadText" class="text-muted m-0">
                                Upload Or Drag<br><small>PDF, JPG, PNG</small>
                            </p>
                            <img id="previewImage" src="" style="display:none; max-width:100%; max-height:200px; margin-top:10px;" />
                        </div>

                        <!-- Hidden file input -->
                        <input
                            type="file"
                            id="fileInput"
                            accept=".jpg,.jpeg,.png,.pdf"
                            style="display:none;"
                            onchange="
      var file = this.files[0];
      var previewImg = document.getElementById('previewImage');
      var text = document.getElementById('uploadText');

      if (!file) return;

      if (file.type.startsWith('image/')) {
        var reader = new FileReader();
        reader.onload = function(e) {
          previewImg.src = e.target.result;
          previewImg.style.display = 'block';
          text.style.display = 'none';
        };
        reader.readAsDataURL(file);
      } else {
        previewImg.style.display = 'none';
        text.innerHTML = '📄 ' + file.name;
      }
    " />
                    </div>


                    <!-- Right Task List -->
                    <div class="col-md-7" style="border: 3px solid #f7f7f7;">
                        <div>
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <!-- Left Side: Title + Subtitle -->
                                <div>
                                    <div class="fw-bold" style="color: #2b2d42;">Project Title Task</div>
                                    <small class="text-muted">Total Task: 5 – Total Checkpoint: 20</small>
                                </div>

                                <!-- Right Side: Red note -->
                                <div style="color: #ea5455; font-size: 12px;">
                                    Max. 4 Tasks each Ticket
                                </div>
                            </div>


                            <!-- Task Cards -->
                            <div class="d-flex p-2 rounded mt-2" style="background-color: #ebebeb;">

                                <!-- Task Image -->
                                <div class="me-2">
                                    <img src="{{ asset('build/img/dooted img.svg') }}" alt="Task Image"
                                        style="width: 50px; height: 100%; border-radius: 6px; object-fit: cover;">
                                </div>

                                <!-- Task Content -->
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div style="font-weight: 600; font-size: 14px; display: flex; align-items: center;">
                                            <img src="{{ asset('build/img/yekbon.svg') }}" alt="" style="width: 30px; height: 30px; margin-right: 6px;">
                                            Task Title
                                        </div>
                                        <div class="d-flex align-items-center gap-2" style="position: relative;">
                                            <button
                                                onclick="event.stopPropagation(); var menu = this.nextElementSibling; menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';"
                                                style="width: 32px; height: 32px; border-radius: 50%; border: 1px solid #a5acc5; background-color: #f9f9f9; display: flex; align-items: center; justify-content: center; padding: 0;">
                                                <span style="font-size: 18px; color: #2b2d42;">&#x2022;&#x2022;&#x2022;</span>
                                            </button>

                                            <div
                                                class="menu-box"
                                                style="display: none; background: #fff; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); padding: 8px 10px; width: 80px; text-align: center; position: absolute; top: 100%; right: 0; z-index: 1000;"
                                                onclick="event.stopPropagation();">

                                                <!-- Optional small title -->
                                                <div style="font-size: 12px; color: #7a7a9d; font-weight: 600; margin-bottom: 6px;">Options</div>

                                                <!-- Icons row -->
                                                <div style="display: flex; justify-content: center; align-items: center; gap: 10px;">
                                                    <img src="{{URL::asset('/build/img/delete1.svg')}}" alt="Delete"
                                                        style="width: 20px; height: 20px; cursor: pointer;">

                                                    <img src="{{URL::asset('/build/img/Edit1.svg')}}" alt="Edit"
                                                        style="width: 20px; height: 20px; cursor: pointer;"
                                                        data-bs-toggle="modal" data-bs-target="#edit_team">


                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Sub Text -->
                                    <div style="font-size: 12px; color: #6c757d;">Ticket #1 - Ticket Title</div>

                                    <!-- Description -->
                                    <div style="font-size: 13px; margin-top: 2px;">Task description will be here</div>

                                    <!-- Dates & Badge Row -->
                                    <div class="d-flex justify-content-between mt-2 flex-nowrap" style="background-color: #fff; border-radius: 10px; padding: 4px;">
                                        <div style="font-size: 14px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                            <small>Start: 22.10.2024</small>
                                        </div>

                                        <div style="font-size: 14px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                            <small>Deliver: 22.10.2024</small>
                                        </div>

                                        <!-- Deadline/Warning -->
                                        <div class="d-flex align-items-center" style="font-size: 11px; background-color: #ff4d4f; color: white; padding: 2px 6px; border-radius: 6px;">
                                            <img src="https://img.icons8.com/ios-filled/16/ffffff/flash-on.png" alt="Urgent" style="margin-right: 4px;">
                                            01
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- 2 -->
                            <div class="d-flex p-2 rounded mt-2" style="background-color: #ebebeb;">

                                <!-- Task Image -->
                                <div class="me-2">
                                    <img src="{{ asset('build/img/dooted img.svg') }}" alt="Task Image"
                                        style="width: 50px; height: 100%; border-radius: 6px; object-fit: cover;">
                                </div>

                                <!-- Task Content -->
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div style="font-weight: 600; font-size: 14px; display: flex; align-items: center;">
                                            <img src="{{ asset('build/img/yekbon.svg') }}" alt="" style="width: 30px; height: 30px; margin-right: 6px;">
                                            Task Title
                                        </div>
                                        <div class="d-flex align-items-center gap-2" style="position: relative;">
                                            <button
                                                onclick="event.stopPropagation(); var menu = this.nextElementSibling; menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';"
                                                style="width: 32px; height: 32px; border-radius: 50%; border: 1px solid #a5acc5; background-color: #f9f9f9; display: flex; align-items: center; justify-content: center; padding: 0;">
                                                <span style="font-size: 18px; color: #2b2d42;">&#x2022;&#x2022;&#x2022;</span>
                                            </button>

                                            <div
                                                class="menu-box"
                                                style="display: none; background: #fff; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); padding: 8px 10px; width: 80px; text-align: center; position: absolute; top: 100%; right: 0; z-index: 1000;"
                                                onclick="event.stopPropagation();">

                                                <!-- Optional small title -->
                                                <div style="font-size: 12px; color: #7a7a9d; font-weight: 600; margin-bottom: 6px;">Options</div>

                                                <!-- Icons row -->
                                                <div style="display: flex; justify-content: center; align-items: center; gap: 10px;">
                                                    <img src="{{URL::asset('/build/img/delete1.svg')}}" alt="Delete"
                                                        style="width: 20px; height: 20px; cursor: pointer;">

                                                    <img src="{{URL::asset('/build/img/Edit1.svg')}}" alt="Edit"
                                                        style="width: 20px; height: 20px; cursor: pointer;"
                                                        data-bs-toggle="modal" data-bs-target="#edit_team">


                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Sub Text -->
                                    <div style="font-size: 12px; color: #6c757d;">Ticket #1 - Ticket Title</div>

                                    <!-- Description -->
                                    <div style="font-size: 13px; margin-top: 2px;">Task description will be here</div>

                                    <!-- Dates & Badge Row -->
                                    <div class="d-flex justify-content-between mt-2 flex-nowrap" style="background-color: #fff; border-radius: 10px; padding: 4px;">
                                        <div style="font-size: 14px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                            <small>Start: 22.10.2024</small>
                                        </div>

                                        <div style="font-size: 14px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                            <small>Deliver: 22.10.2024</small>
                                        </div>

                                        <!-- Deadline/Warning -->
                                        <div class="d-flex align-items-center" style="font-size: 11px; background-color: #ff4d4f; color: white; padding: 2px 6px; border-radius: 6px;">
                                            <img src="https://img.icons8.com/ios-filled/16/ffffff/flash-on.png" alt="Urgent" style="margin-right: 4px;">
                                            01
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- 3 -->
                            <div class="d-flex p-2 rounded mt-2" style="background-color: #ebebeb;">

                                <!-- Task Image -->
                                <div class="me-2">
                                    <img src="{{ asset('build/img/dooted img.svg') }}" alt="Task Image"
                                        style="width: 50px; height: 100%; border-radius: 6px; object-fit: cover;">
                                </div>

                                <!-- Task Content -->
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div style="font-weight: 600; font-size: 14px; display: flex; align-items: center;">
                                            <img src="{{ asset('build/img/yekbon.svg') }}" alt="" style="width: 30px; height: 30px; margin-right: 6px;">
                                            Task Title
                                        </div>
                                        <div class="d-flex align-items-center gap-2" style="position: relative;">
                                            <button
                                                onclick="event.stopPropagation(); var menu = this.nextElementSibling; menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';"
                                                style="width: 32px; height: 32px; border-radius: 50%; border: 1px solid #a5acc5; background-color: #f9f9f9; display: flex; align-items: center; justify-content: center; padding: 0;">
                                                <span style="font-size: 18px; color: #2b2d42;">&#x2022;&#x2022;&#x2022;</span>
                                            </button>

                                            <div
                                                class="menu-box"
                                                style="display: none; background: #fff; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); padding: 8px 10px; width: 80px; text-align: center; position: absolute; top: 100%; right: 0; z-index: 1000;"
                                                onclick="event.stopPropagation();">

                                                <!-- Optional small title -->
                                                <div style="font-size: 12px; color: #7a7a9d; font-weight: 600; margin-bottom: 6px;">Options</div>

                                                <!-- Icons row -->
                                                <div style="display: flex; justify-content: center; align-items: center; gap: 10px;">
                                                    <img src="{{URL::asset('/build/img/delete1.svg')}}" alt="Delete"
                                                        style="width: 20px; height: 20px; cursor: pointer;">

                                                    <img src="{{URL::asset('/build/img/Edit1.svg')}}" alt="Edit"
                                                        style="width: 20px; height: 20px; cursor: pointer;"
                                                        data-bs-toggle="modal" data-bs-target="#edit_team">


                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Sub Text -->
                                    <div style="font-size: 12px; color: #6c757d;">Ticket #1 - Ticket Title</div>

                                    <!-- Description -->
                                    <div style="font-size: 13px; margin-top: 2px;">Task description will be here</div>

                                    <!-- Dates & Badge Row -->
                                    <div class="d-flex justify-content-between mt-2 flex-nowrap" style="background-color: #fff; border-radius: 10px; padding: 4px;">
                                        <div style="font-size: 14px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                            <small>Start: 22.10.2024</small>
                                        </div>

                                        <div style="font-size: 14px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                            <small>Deliver: 22.10.2024</small>
                                        </div>

                                        <!-- Deadline/Warning -->
                                        <div class="d-flex align-items-center" style="font-size: 11px; background-color: #ff4d4f; color: white; padding: 2px 6px; border-radius: 6px;">
                                            <img src="https://img.icons8.com/ios-filled/16/ffffff/flash-on.png" alt="Urgent" style="margin-right: 4px;">
                                            01
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Add Task -->
                            <!-- Hidden File Input -->
                            <input type="file" id="fileInput" style="display: none;" onchange="document.getElementById('addTaskBox').innerText = '+ ' + this.files[0].name">

                            <!-- Clickable Box -->
                            <div id="addTaskBox"
                                class="border border-dashed p-2 text-center rounded"
                                style="cursor: pointer;"
                                onclick="document.getElementById('fileInput').click();">
                                + Add new Task
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer d-flex justify-content-between">
                <!-- Save and Close (Green) -->
                <button
                    type="button"
                    class="btn text-white"
                    style="background-color: #28c76f; border-radius: 6px;"
                    data-bs-dismiss="modal">
                    Save and Close
                </button>

                <!-- Save & add Task (Orange) -->
                <button
                    type="button"
                    class="btn text-white"
                    style="background-color: #f98f3e; border-radius: 6px;"
                    data-bs-dismiss="modal">
                    Save & add Task
                </button>
            </div>

        </div>
    </div>
</div>
<!--create web modale -->
<div class="modal fade" id="webtask" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius: 12px;">
            <!-- Modal Header -->
            <div class="modal-header d-flex justify-content-between flex-wrap align-items-start" style="background: #fff;">
                <!-- Title + Subtitle -->
                <div>
                    <h5 class="modal-title mb-0" style="font-weight: 600;">Create new Task</h5>
                    <small class="text-muted">Create a Task</small>
                </div>

                <!-- Task Type Buttons -->
                <div
                    class="d-flex gap-2 p-1 rounded"
                    style="background: #f2f2f2; border-radius: 10px;">

                    <button
                        id="task2-btn-mobile"
                        class="btn btn-sm"
                        style="background-color: #28c76f; color: white;"
                        onclick="
            document.getElementById('task2-btn-mobile').style.backgroundColor = '#28c76f';
            document.getElementById('task2-btn-mobile').style.color = 'white';
            document.getElementById('task2-btn-web').style.backgroundColor = 'transparent';
            document.getElementById('task2-btn-web').style.color = '#6c757d';
            document.getElementById('task2-btn-employee').style.backgroundColor = 'transparent';
            document.getElementById('task2-btn-employee').style.color = '#6c757d';
        ">
                        Mobile Task
                    </button>

                    <button
                        id="task2-btn-web"
                        class="btn btn-sm"
                        style="background-color: transparent; color: #6c757d;"
                        onclick="
            document.getElementById('task2-btn-web').style.backgroundColor = '#28c76f';
            document.getElementById('task2-btn-web').style.color = 'white';
            document.getElementById('task2-btn-mobile').style.backgroundColor = 'transparent';
            document.getElementById('task2-btn-mobile').style.color = '#6c757d';
            document.getElementById('task2-btn-employee').style.backgroundColor = 'transparent';
            document.getElementById('task2-btn-employee').style.color = '#6c757d';
        ">
                        Web Task
                    </button>

                    <button
                        id="task2-btn-employee"
                        class="btn btn-sm"
                        style="background-color: transparent; color: #6c757d;"
                        onclick="
            document.getElementById('task2-btn-employee').style.backgroundColor = '#28c76f';
            document.getElementById('task2-btn-employee').style.color = 'white';
            document.getElementById('task2-btn-mobile').style.backgroundColor = 'transparent';
            document.getElementById('task2-btn-mobile').style.color = '#6c757d';
            document.getElementById('task2-btn-web').style.backgroundColor = 'transparent';
            document.getElementById('task2-btn-web').style.color = '#6c757d';
        ">
                        Employee Task
                    </button>
                </div>


                <!-- Close Button -->

            </div>


            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Task Tabs -->


                <!-- Top Controls -->
                <div class="row mb-3" style="background: #f9f9f9; padding: 15px; border-radius: 12px;">
                    <!-- Left: Ticket Details -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold mb-0" style="color: #2b2d42;">Ticket Details</label><br>
                        <small class="text-muted">Ticket Details</small>
                        <div class="d-flex gap-2 mt-2">
                            <select class="form-select form-select-sm" style="background: #fff; border-radius: 8px;">
                                <option>Select the Project</option>
                            </select>
                            <select class="form-select form-select-sm" style="background: #fff; border-radius: 8px;">
                                <option>Select the Ticket</option>
                            </select>
                        </div>
                    </div>

                    <!-- Right: Start & Delivery Dates -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold mb-0" style="color: #2b2d42;">Ticket Start & Deliver Date</label><br>
                        <small class="text-muted">Tasks must be done in this duration</small>
                        <div class="d-flex gap-2 mt-2">
                            <div class="text-center p-2 text-white" style="background: #28c76f; border-radius: 8px; flex: 1;">
                                <small>Start Date</small><br>
                                <span class="fw-bold">21.09.2025 – 15:00</span>
                            </div>
                            <div class="text-center p-2 text-white" style="background: #ea5455; border-radius: 8px; flex: 1;">
                                <small>Deliver Date</small><br>
                                <span class="fw-bold">27.09.2025 – 15:00</span>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Task Container -->
                <div class="row">
                    <!-- Left Upload Area -->
                    <div class="col-md-5">
                        <div
                            id="uploadBox"
                            onclick="document.getElementById('fileInput').click();"
                            style="background-color: #f7f7f7;
      height: 100%;
      min-height: 250px;
      cursor: pointer;
      border: 2px dashed #ccc;
      border-radius: 10px;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      flex-direction: column;
      position: relative;
    ">
                            <p id="uploadText" class="text-muted m-0">
                                Upload Or Drag<br><small>PDF, JPG, PNG</small>
                            </p>
                            <img id="previewImage" src="" style="display:none; max-width:100%; max-height:200px; margin-top:10px;" />
                        </div>

                        <!-- Hidden file input -->
                        <input
                            type="file"
                            id="fileInput"
                            accept=".jpg,.jpeg,.png,.pdf"
                            style="display:none;"
                            onchange="
      var file = this.files[0];
      var previewImg = document.getElementById('previewImage');
      var text = document.getElementById('uploadText');

      if (!file) return;

      if (file.type.startsWith('image/')) {
        var reader = new FileReader();
        reader.onload = function(e) {
          previewImg.src = e.target.result;
          previewImg.style.display = 'block';
          text.style.display = 'none';
        };
        reader.readAsDataURL(file);
      } else {
        previewImg.style.display = 'none';
        text.innerHTML = '📄 ' + file.name;
      }
    " />
                    </div>


                    <!-- Right Task List -->
                    <div class="col-md-7" style="border: 3px solid #f7f7f7;">
                        <div>
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <!-- Left Side: Title + Subtitle -->
                                <div>
                                    <div class="fw-bold" style="color: #2b2d42;">Project Title Task</div>
                                    <small class="text-muted">Total Task: 5 – Total Checkpoint: 20</small>
                                </div>

                                <!-- Right Side: Red note -->
                                <div style="color: #ea5455; font-size: 12px;">
                                    Max. 4 Tasks each Ticket
                                </div>
                            </div>


                            <!-- Task Cards -->
                            <div class="d-flex p-2 rounded mt-2" style="background-color: #ebebeb;">

                                <!-- Task Image -->
                                <div class="me-2">
                                    <img src="{{ asset('build/img/dooted img.svg') }}" alt="Task Image"
                                        style="width: 50px; height: 100%; border-radius: 6px; object-fit: cover;">
                                </div>

                                <!-- Task Content -->
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div style="font-weight: 600; font-size: 14px; display: flex; align-items: center;">
                                            <img src="{{ asset('build/img/yekbon.svg') }}" alt="" style="width: 30px; height: 30px; margin-right: 6px;">
                                            Task Title
                                        </div>
                                        <div class="d-flex align-items-center gap-2" style="position: relative;">
                                            <button
                                                onclick="event.stopPropagation(); var menu = this.nextElementSibling; menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';"
                                                style="width: 32px; height: 32px; border-radius: 50%; border: 1px solid #a5acc5; background-color: #f9f9f9; display: flex; align-items: center; justify-content: center; padding: 0;">
                                                <span style="font-size: 18px; color: #2b2d42;">&#x2022;&#x2022;&#x2022;</span>
                                            </button>

                                            <div
                                                class="menu-box"
                                                style="display: none; background: #fff; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); padding: 8px 10px; width: 80px; text-align: center; position: absolute; top: 100%; right: 0; z-index: 1000;"
                                                onclick="event.stopPropagation();">

                                                <!-- Optional small title -->
                                                <div style="font-size: 12px; color: #7a7a9d; font-weight: 600; margin-bottom: 6px;">Options</div>

                                                <!-- Icons row -->
                                                <div style="display: flex; justify-content: center; align-items: center; gap: 10px;">
                                                    <img src="{{URL::asset('/build/img/delete1.svg')}}" alt="Delete"
                                                        style="width: 20px; height: 20px; cursor: pointer;">

                                                    <img src="{{URL::asset('/build/img/Edit1.svg')}}" alt="Edit"
                                                        style="width: 20px; height: 20px; cursor: pointer;"
                                                        data-bs-toggle="modal" data-bs-target="#edit_team">


                                                </div>
                                            </div>
                                        </div>


                                    </div>

                                    <!-- Sub Text -->
                                    <div style="font-size: 12px; color: #6c757d;">Ticket #1 - Ticket Title</div>

                                    <!-- Description -->
                                    <div style="font-size: 13px; margin-top: 2px;">Task description will be here</div>

                                    <!-- Dates & Badge Row -->
                                    <div class="d-flex justify-content-between mt-2 flex-nowrap" style="background-color: #fff; border-radius: 10px; padding: 4px;">
                                        <div style="font-size: 14px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                            <small>Start: 22.10.2024</small>
                                        </div>

                                        <div style="font-size: 14px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                            <small>Deliver: 22.10.2024</small>
                                        </div>

                                        <!-- Deadline/Warning -->
                                        <div class="d-flex align-items-center" style="font-size: 11px; background-color: #ff4d4f; color: white; padding: 2px 6px; border-radius: 6px;">
                                            <img src="https://img.icons8.com/ios-filled/16/ffffff/flash-on.png" alt="Urgent" style="margin-right: 4px;">
                                            01
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- 2 -->
                            <div class="d-flex p-2 rounded mt-2" style="background-color: #ebebeb;">

                                <!-- Task Image -->
                                <div class="me-2">
                                    <img src="{{ asset('build/img/dooted img.svg') }}" alt="Task Image"
                                        style="width: 50px; height: 100%; border-radius: 6px; object-fit: cover;">
                                </div>

                                <!-- Task Content -->
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div style="font-weight: 600; font-size: 14px; display: flex; align-items: center;">
                                            <img src="{{ asset('build/img/yekbon.svg') }}" alt="" style="width: 30px; height: 30px; margin-right: 6px;">
                                            Task Title
                                        </div>
                                        <div class="d-flex align-items-center gap-2" style="position: relative;">
                                            <button
                                                onclick="event.stopPropagation(); var menu = this.nextElementSibling; menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';"
                                                style="width: 32px; height: 32px; border-radius: 50%; border: 1px solid #a5acc5; background-color: #f9f9f9; display: flex; align-items: center; justify-content: center; padding: 0;">
                                                <span style="font-size: 18px; color: #2b2d42;">&#x2022;&#x2022;&#x2022;</span>
                                            </button>
                                            <div
                                                class="menu-box"
                                                style="display: none; background: #fff; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); padding: 8px 10px; width: 80px; text-align: center; position: absolute; top: 100%; right: 0; z-index: 1000;"
                                                onclick="event.stopPropagation();">

                                                <!-- Optional small title -->
                                                <div style="font-size: 12px; color: #7a7a9d; font-weight: 600; margin-bottom: 6px;">Options</div>

                                                <!-- Icons row -->
                                                <div style="display: flex; justify-content: center; align-items: center; gap: 10px;">
                                                    <img src="{{URL::asset('/build/img/delete1.svg')}}" alt="Delete"
                                                        style="width: 20px; height: 20px; cursor: pointer;">

                                                    <img src="{{URL::asset('/build/img/Edit1.svg')}}" alt="Edit"
                                                        style="width: 20px; height: 20px; cursor: pointer;"
                                                        data-bs-toggle="modal" data-bs-target="#edit_team">


                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Sub Text -->
                                    <div style="font-size: 12px; color: #6c757d;">Ticket #1 - Ticket Title</div>

                                    <!-- Description -->
                                    <div style="font-size: 13px; margin-top: 2px;">Task description will be here</div>

                                    <!-- Dates & Badge Row -->
                                    <div class="d-flex justify-content-between mt-2 flex-nowrap" style="background-color: #fff; border-radius: 10px; padding: 4px;">
                                        <div style="font-size: 14px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                            <small>Start: 22.10.2024</small>
                                        </div>

                                        <div style="font-size: 14px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                            <small>Deliver: 22.10.2024</small>
                                        </div>

                                        <!-- Deadline/Warning -->
                                        <div class="d-flex align-items-center" style="font-size: 11px; background-color: #ff4d4f; color: white; padding: 2px 6px; border-radius: 6px;">
                                            <img src="https://img.icons8.com/ios-filled/16/ffffff/flash-on.png" alt="Urgent" style="margin-right: 4px;">
                                            01
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- 3 -->
                            <div class="d-flex p-2 rounded mt-2" style="background-color: #ebebeb;">

                                <!-- Task Image -->
                                <div class="me-2">
                                    <img src="{{ asset('build/img/dooted img.svg') }}" alt="Task Image"
                                        style="width: 50px; height: 100%; border-radius: 6px; object-fit: cover;">
                                </div>

                                <!-- Task Content -->
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div style="font-weight: 600; font-size: 14px; display: flex; align-items: center;">
                                            <img src="{{ asset('build/img/yekbon.svg') }}" alt="" style="width: 30px; height: 30px; margin-right: 6px;">
                                            Task Title
                                        </div>
                                        <div class="d-flex align-items-center gap-2" style="position: relative;">
                                            <button
                                                onclick="event.stopPropagation(); var menu = this.nextElementSibling; menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';"
                                                style="width: 32px; height: 32px; border-radius: 50%; border: 1px solid #a5acc5; background-color: #f9f9f9; display: flex; align-items: center; justify-content: center; padding: 0;">
                                                <span style="font-size: 18px; color: #2b2d42;">&#x2022;&#x2022;&#x2022;</span>
                                            </button>

                                            <div
                                                class="menu-box"
                                                style="display: none; background: #fff; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); padding: 8px 10px; width: 80px; text-align: center; position: absolute; top: 100%; right: 0; z-index: 1000;"
                                                onclick="event.stopPropagation();">

                                                <!-- Optional small title -->
                                                <div style="font-size: 12px; color: #7a7a9d; font-weight: 600; margin-bottom: 6px;">Options</div>

                                                <!-- Icons row -->
                                                <div style="display: flex; justify-content: center; align-items: center; gap: 10px;">
                                                    <img src="{{URL::asset('/build/img/delete1.svg')}}" alt="Delete"
                                                        style="width: 20px; height: 20px; cursor: pointer;">

                                                    <img src="{{URL::asset('/build/img/Edit1.svg')}}" alt="Edit"
                                                        style="width: 20px; height: 20px; cursor: pointer;"
                                                        data-bs-toggle="modal" data-bs-target="#edit_team">


                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- Sub Text -->
                                    <div style="font-size: 12px; color: #6c757d;">Ticket #1 - Ticket Title</div>

                                    <!-- Description -->
                                    <div style="font-size: 13px; margin-top: 2px;">Task description will be here</div>

                                    <!-- Dates & Badge Row -->
                                    <div class="d-flex justify-content-between mt-2 flex-nowrap" style="background-color: #fff; border-radius: 10px; padding: 4px;">
                                        <div style="font-size: 14px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                            <small>Start: 22.10.2024</small>
                                        </div>

                                        <div style="font-size: 14px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                            <small>Deliver: 22.10.2024</small>
                                        </div>

                                        <!-- Deadline/Warning -->
                                        <div class="d-flex align-items-center" style="font-size: 11px; background-color: #ff4d4f; color: white; padding: 2px 6px; border-radius: 6px;">
                                            <img src="https://img.icons8.com/ios-filled/16/ffffff/flash-on.png" alt="Urgent" style="margin-right: 4px;">
                                            01
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Add Task -->
                            <!-- Hidden File Input -->
                            <input type="file" id="fileInput" style="display: none;" onchange="document.getElementById('addTaskBox').innerText = '+ ' + this.files[0].name">

                            <!-- Clickable Box -->
                            <div id="addTaskBox"
                                class="border border-dashed p-2 text-center rounded"
                                style="cursor: pointer;"
                                onclick="document.getElementById('fileInput').click();">
                                + Add new Task
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer d-flex justify-content-between">
                <!-- Save and Close (Green) -->
                <button
                    type="button"
                    class="btn text-white"
                    style="background-color: #28c76f; border-radius: 6px;"
                    data-bs-dismiss="modal">
                    Save and Close
                </button>

                <!-- Save & add Task (Orange) -->
                <button
                    type="button"
                    class="btn text-white"
                    style="background-color: #f98f3e; border-radius: 6px;"
                    data-bs-dismiss="modal">
                    Save & add Task
                </button>
            </div>

        </div>
    </div>
</div>
<!-- create  employee task -->
<div class="modal fade" id="emptask" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius: 12px;">
            <!-- Modal Header -->
            <div class="modal-header d-flex justify-content-between flex-wrap align-items-start" style="background: #fff;">
                <!-- Title + Subtitle -->
                <div>
                    <h5 class="modal-title mb-0" style="font-weight: 600;">Create new Task</h5>
                    <small class="text-muted">Create a Task</small>
                </div>

                <!-- Task Type Buttons -->
                <div
                    class="d-flex gap-2 p-1 rounded"
                    style="background: #f2f2f2; border-radius: 10px;">

                    <button
                        id="task-btn-mobile"
                        class="btn btn-sm"
                        style="background-color: #28c76f; color: white;"
                        onclick="
            document.getElementById('task-btn-mobile').style.backgroundColor = '#28c76f';
            document.getElementById('task-btn-mobile').style.color = 'white';
            document.getElementById('task-btn-web').style.backgroundColor = 'transparent';
            document.getElementById('task-btn-web').style.color = '#6c757d';
            document.getElementById('task-btn-employee').style.backgroundColor = 'transparent';
            document.getElementById('task-btn-employee').style.color = '#6c757d';
        ">
                        Mobile Task
                    </button>

                    <button
                        id="task-btn-web"
                        class="btn btn-sm"
                        style="background-color: transparent; color: #6c757d;"
                        onclick="
            document.getElementById('task-btn-web').style.backgroundColor = '#28c76f';
            document.getElementById('task-btn-web').style.color = 'white';
            document.getElementById('task-btn-mobile').style.backgroundColor = 'transparent';
            document.getElementById('task-btn-mobile').style.color = '#6c757d';
            document.getElementById('task-btn-employee').style.backgroundColor = 'transparent';
            document.getElementById('task-btn-employee').style.color = '#6c757d';
        ">
                        Web Task
                    </button>

                    <button
                        id="task-btn-employee"
                        class="btn btn-sm"
                        style="background-color: transparent; color: #6c757d;"
                        onclick="
            document.getElementById('task-btn-employee').style.backgroundColor = '#28c76f';
            document.getElementById('task-btn-employee').style.color = 'white';
            document.getElementById('task-btn-mobile').style.backgroundColor = 'transparent';
            document.getElementById('task-btn-mobile').style.color = '#6c757d';
            document.getElementById('task-btn-web').style.backgroundColor = 'transparent';
            document.getElementById('task-btn-web').style.color = '#6c757d';
        ">
                        Employee Task
                    </button>
                </div>




            </div>


            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Task Tabs -->


                <!-- Top Controls -->
                <div class="row mb-3" style="background: #f9f9f9; padding: 15px; border-radius: 12px;">
                    <!-- Left: Ticket Details -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold mb-0" style="color: #2b2d42;">Ticket Details</label><br>
                        <small class="text-muted">Ticket Details</small>
                        <div class="d-flex gap-2 mt-2">
                            <select class="form-select form-select-sm" style="background: #fff; border-radius: 8px;">
                                <option>Select the Project</option>
                            </select>
                            <select class="form-select form-select-sm" style="background: #fff; border-radius: 8px;">
                                <option>Select the Ticket</option>
                            </select>
                        </div>
                    </div>

                    <!-- Right: Start & Delivery Dates -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold mb-0" style="color: #2b2d42;">Ticket Start & Deliver Date</label><br>
                        <small class="text-muted">Tasks must be done in this duration</small>
                        <div class="d-flex gap-2 mt-2">
                            <div class="text-center p-2 text-white" style="background: #28c76f; border-radius: 8px; flex: 1;">
                                <small>Start Date</small><br>
                                <span class="fw-bold">21.09.2025 – 15:00</span>
                            </div>
                            <div class="text-center p-2 text-white" style="background: #ea5455; border-radius: 8px; flex: 1;">
                                <small>Deliver Date</small><br>
                                <span class="fw-bold">27.09.2025 – 15:00</span>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Task Container -->
                <div class="row">
                    <!-- Left Upload Area -->
                    <div class="col-md-5">

                        <div class="p-3" style="max-width: 300px; margin: auto; background: #fff; border-radius: 12px; font-family: 'Segoe UI', sans-serif; font-size: 14px; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">

                            <!-- Title -->
                            <p class="fw-semibold mb-2" style="color: #2a2a2a;">Employee Tasks</p>

                            <!-- Task Image Section -->
                            <div class="mb-2">
                                <label class="form-label fw-semibold text-dark">Task Image</label>
                                <div class="d-flex justify-content-between flex-wrap gap-1 flex-wrap mb-2">
                                    <img src="{{ asset('build/img/dooted img.svg') }}" alt="Task Image"
                                        style="width: 50px; height: 100%; border-radius: 6px; object-fit: cover;">

                                    <img src="{{ asset('build/img/dooted img.svg') }}" alt="Task Image"
                                        style="width: 50px; height: 100%; border-radius: 6px; object-fit: cover;">
                                    <img src="{{ asset('build/img/dooted img.svg') }}" alt="Task Image"
                                        style="width: 50px; height: 100%; border-radius: 6px; object-fit: cover;">
                                    <img src="{{ asset('build/img/dooted img.svg') }}" alt="Task Image"
                                        style="width: 50px; height: 100%; border-radius: 6px; object-fit: cover;">

                                </div>
                            </div>

                            <!-- About the Task -->
                            <div class="mb-2 p-2" style="background: #f7f7f7; border-radius: 10px;">
                                <p class="m-0 fw-semibold">About the Task</p>
                                <small class="text-muted">Employee Task details</small>
                                <div class="d-flex gap-2 my-2">
                                    <input type="text" class="form-control form-control-sm" placeholder="Task Title">
                                    <select class="form-select form-select-sm">
                                        <option>Select Priority</option>
                                    </select>
                                </div>
                                <textarea class="form-control form-control-sm" placeholder="Describe the Task"></textarea>
                            </div>

                            <!-- Task Execution -->
                            <div class="mb-2 p-2" style="background: #f7f7f7; border-radius: 10px;">
                                <p class="m-0 fw-semibold">Task execution</p>
                                <small class="text-muted">Select day of the week</small>
                                <div class="d-flex gap-2 mt-2">
                                    <select class="form-select form-select-sm">
                                        <option>Set the Day</option>
                                        <option>Monday</option>
                                        <option>Tuesday</option>
                                        <option>Wednesday</option>
                                        <option>Thursday</option>
                                        <option>Friday</option>
                                        <option>Saturday</option>
                                        <option>Sunday</option>
                                    </select>
                                    <select class="form-select form-select-sm">
                                        <option disabled>Select Duration</option>
                                        <option>One Time Task</option>
                                        <option>Repeatily Task</option>
                                        <option>Every 2 Weeks</option>

                                    </select>
                                </div>
                            </div>

                            <!-- Expired Reminder -->
                            <div class="mb-2 p-2" style="background: #f7f7f7; border-radius: 10px;">
                                <p class="m-0 fw-semibold">Expired Reminder</p>
                                <small class="text-muted">Set a reminder before expired</small>
                                <div class="d-flex gap-2 mt-2">
                                    <button type="button" class="btn btn-sm" style="background: #28c76f; color: white; flex: 1;">6 Hour</button>
                                    <button type="button" class="btn btn-sm" style="background: #e5e5e5; color: #444; flex: 1;">8 Hour</button>
                                    <button type="button" class="btn btn-sm" style="background: #e5e5e5; color: #444; flex: 1;">12 Hour</button>
                                </div>
                            </div>

                            <!-- Save Button -->
                            <button class="btn w-100 mb-0" style="background: #28c76f; color: white; font-weight: 500;">Save the Task</button>
                        </div>

                    </div>


                    <!-- Right Task List -->
                    <div class="col-md-7" style="border: 3px solid #f7f7f7;">
                        <div>
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <!-- Left Side: Title + Subtitle -->
                                <div>
                                    <div class="fw-bold" style="color: #2b2d42;">Project Title Task</div>
                                    <small class="text-muted">Total Task: 5 – Total Checkpoint: 20</small>
                                </div>

                                <!-- Right Side: Red note -->
                                <div style="color: #ea5455; font-size: 12px;">
                                    Max. 4 Tasks each Ticket
                                </div>
                            </div>


                            <!-- Task Cards -->
                            <div class="d-flex p-2 rounded mt-2" style="background-color: #ebebeb;">

                                <!-- Task Image -->
                                <div class="me-2">
                                    <img src="{{ asset('build/img/dooted img.svg') }}" alt="Task Image"
                                        style="width: 50px; height: 100%; border-radius: 6px; object-fit: cover;">
                                </div>

                                <!-- Task Content -->
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div style="font-weight: 600; font-size: 14px; display: flex; align-items: center;">
                                            <img src="{{ asset('build/img/yekbon.svg') }}" alt="" style="width: 30px; height: 30px; margin-right: 6px;">
                                            Task Title
                                        </div>
                                        <div class="d-flex align-items-center gap-2" style="position: relative;">
                                            <button
                                                onclick="event.stopPropagation(); var menu = this.nextElementSibling; menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';"
                                                style="width: 32px; height: 32px; border-radius: 50%; border: 1px solid #a5acc5; background-color: #f9f9f9; display: flex; align-items: center; justify-content: center; padding: 0;">
                                                <span style="font-size: 18px; color: #2b2d42;">&#x2022;&#x2022;&#x2022;</span>
                                            </button>

                                            <div
                                                class="menu-box"
                                                style="display: none; background: #fff; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); padding: 8px 10px; width: 80px; text-align: center; position: absolute; top: 100%; right: 0; z-index: 1000;"
                                                onclick="event.stopPropagation();">

                                                <!-- Optional small title -->
                                                <div style="font-size: 12px; color: #7a7a9d; font-weight: 600; margin-bottom: 6px;">Options</div>

                                                <!-- Icons row -->
                                                <div style="display: flex; justify-content: center; align-items: center; gap: 10px;">
                                                    <img src="{{URL::asset('/build/img/delete1.svg')}}" alt="Delete"
                                                        style="width: 20px; height: 20px; cursor: pointer;">

                                                    <img src="{{URL::asset('/build/img/Edit1.svg')}}" alt="Edit"
                                                        style="width: 20px; height: 20px; cursor: pointer;"
                                                        data-bs-toggle="modal" data-bs-target="#edit_team">


                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Sub Text -->
                                    <div style="font-size: 12px; color: #6c757d;">Ticket #1 - Ticket Title</div>

                                    <!-- Description -->
                                    <div style="font-size: 13px; margin-top: 2px;">Task description will be here</div>

                                    <!-- Dates & Badge Row -->
                                    <div class="d-flex justify-content-between mt-2 flex-nowrap" style="background-color: #fff; border-radius: 10px; padding: 4px;">
                                        <div style="font-size: 14px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                            <small>Start: 22.10.2024</small>
                                        </div>

                                        <div style="font-size: 14px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                            <small>Deliver: 22.10.2024</small>
                                        </div>

                                        <!-- Deadline/Warning -->
                                        <div class="d-flex align-items-center" style="font-size: 11px; background-color: #ff4d4f; color: white; padding: 2px 6px; border-radius: 6px;">
                                            <img src="https://img.icons8.com/ios-filled/16/ffffff/flash-on.png" alt="Urgent" style="margin-right: 4px;">
                                            01
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- 2 -->
                            <div class="d-flex p-2 rounded mt-2" style="background-color: #ebebeb;">

                                <!-- Task Image -->
                                <div class="me-2">
                                    <img src="{{ asset('build/img/dooted img.svg') }}" alt="Task Image"
                                        style="width: 50px; height: 100%; border-radius: 6px; object-fit: cover;">
                                </div>

                                <!-- Task Content -->
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div style="font-weight: 600; font-size: 14px; display: flex; align-items: center;">
                                            <img src="{{ asset('build/img/yekbon.svg') }}" alt="" style="width: 30px; height: 30px; margin-right: 6px;">
                                            Task Title
                                        </div>
                                        <div class="d-flex align-items-center gap-2" style="position: relative;">
                                            <button
                                                onclick="event.stopPropagation(); var menu = this.nextElementSibling; menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';"
                                                style="width: 32px; height: 32px; border-radius: 50%; border: 1px solid #a5acc5; background-color: #f9f9f9; display: flex; align-items: center; justify-content: center; padding: 0;">
                                                <span style="font-size: 18px; color: #2b2d42;">&#x2022;&#x2022;&#x2022;</span>
                                            </button>

                                            <div
                                                class="menu-box"
                                                style="display: none; background: #fff; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); padding: 8px 10px; width: 80px; text-align: center; position: absolute; top: 100%; right: 0; z-index: 1000;"
                                                onclick="event.stopPropagation();">

                                                <!-- Optional small title -->
                                                <div style="font-size: 12px; color: #7a7a9d; font-weight: 600; margin-bottom: 6px;">Options</div>

                                                <!-- Icons row -->
                                                <div style="display: flex; justify-content: center; align-items: center; gap: 10px;">
                                                    <img src="{{URL::asset('/build/img/delete1.svg')}}" alt="Delete"
                                                        style="width: 20px; height: 20px; cursor: pointer;">

                                                    <img src="{{URL::asset('/build/img/Edit1.svg')}}" alt="Edit"
                                                        style="width: 20px; height: 20px; cursor: pointer;"
                                                        data-bs-toggle="modal" data-bs-target="#edit_team">


                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Sub Text -->
                                    <div style="font-size: 12px; color: #6c757d;">Ticket #1 - Ticket Title</div>

                                    <!-- Description -->
                                    <div style="font-size: 13px; margin-top: 2px;">Task description will be here</div>

                                    <!-- Dates & Badge Row -->
                                    <div class="d-flex justify-content-between mt-2 flex-nowrap" style="background-color: #fff; border-radius: 10px; padding: 4px;">
                                        <div style="font-size: 14px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                            <small>Start: 22.10.2024</small>
                                        </div>

                                        <div style="font-size: 14px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                            <small>Deliver: 22.10.2024</small>
                                        </div>

                                        <!-- Deadline/Warning -->
                                        <div class="d-flex align-items-center" style="font-size: 11px; background-color: #ff4d4f; color: white; padding: 2px 6px; border-radius: 6px;">
                                            <img src="https://img.icons8.com/ios-filled/16/ffffff/flash-on.png" alt="Urgent" style="margin-right: 4px;">
                                            01
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- 3 -->
                            <div class="d-flex p-2 rounded mt-2" style="background-color: #ebebeb;">

                                <!-- Task Image -->
                                <div class="me-2">
                                    <img src="{{ asset('build/img/dooted img.svg') }}" alt="Task Image"
                                        style="width: 50px; height: 100%; border-radius: 6px; object-fit: cover;">
                                </div>

                                <!-- Task Content -->
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div style="font-weight: 600; font-size: 14px; display: flex; align-items: center;">
                                            <img src="{{ asset('build/img/yekbon.svg') }}" alt="" style="width: 30px; height: 30px; margin-right: 6px;">
                                            Task Title
                                        </div>
                                        <div class="d-flex align-items-center gap-2" style="position: relative;">
                                            <button
                                                onclick="event.stopPropagation(); var menu = this.nextElementSibling; menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';"
                                                style="width: 32px; height: 32px; border-radius: 50%; border: 1px solid #a5acc5; background-color: #f9f9f9; display: flex; align-items: center; justify-content: center; padding: 0;">
                                                <span style="font-size: 18px; color: #2b2d42;">&#x2022;&#x2022;&#x2022;</span>
                                            </button>

                                            <div
                                                class="menu-box"
                                                style="display: none; background: #fff; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); padding: 8px 10px; width: 80px; text-align: center; position: absolute; top: 100%; right: 0; z-index: 1000;"
                                                onclick="event.stopPropagation();">

                                                <!-- Optional small title -->
                                                <div style="font-size: 12px; color: #7a7a9d; font-weight: 600; margin-bottom: 6px;">Options</div>

                                                <!-- Icons row -->
                                                <div style="display: flex; justify-content: center; align-items: center; gap: 10px;">
                                                    <img src="{{URL::asset('/build/img/delete1.svg')}}" alt="Delete"
                                                        style="width: 20px; height: 20px; cursor: pointer;">

                                                    <img src="{{URL::asset('/build/img/Edit1.svg')}}" alt="Edit"
                                                        style="width: 20px; height: 20px; cursor: pointer;"
                                                        data-bs-toggle="modal" data-bs-target="#edit_team">


                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Sub Text -->
                                    <div style="font-size: 12px; color: #6c757d;">Ticket #1 - Ticket Title</div>

                                    <!-- Description -->
                                    <div style="font-size: 13px; margin-top: 2px;">Task description will be here</div>

                                    <!-- Dates & Badge Row -->
                                    <div class="d-flex justify-content-between mt-2 flex-nowrap" style="background-color: #fff; border-radius: 10px; padding: 4px;">
                                        <div style="font-size: 14px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                            <small>Start: 22.10.2024</small>
                                        </div>

                                        <div style="font-size: 14px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                            <small>Deliver: 22.10.2024</small>
                                        </div>

                                        <!-- Deadline/Warning -->
                                        <div class="d-flex align-items-center" style="font-size: 11px; background-color: #ff4d4f; color: white; padding: 2px 6px; border-radius: 6px;">
                                            <img src="https://img.icons8.com/ios-filled/16/ffffff/flash-on.png" alt="Urgent" style="margin-right: 4px;">
                                            01
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Add Task -->
                            <!-- Hidden File Input -->
                            <input type="file" id="fileInput" style="display: none;"
                                onchange="document.getElementById('addTaskBox').innerText = '+ ' + this.files[0].name">

                            <!-- Clickable Box -->
                            <div id="addTaskBox"
                                class="border border-dashed rounded text-center"
                                style="cursor: pointer; height: 80px; display: flex; justify-content: center; align-items: center;"
                                onclick="document.getElementById('fileInput').click();">
                                + Add new Task
                            </div>


                            <div class="mt-3" style="display: flex; justify-content: flex-end;">
                                <button
                                    type="button"
                                    class="btn text-white"
                                    style="background-color: #28c76f; border-radius: 6px;"
                                    data-bs-dismiss="modal">
                                    Save and Close
                                </button>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- progress Model -->
<div class="modal fade" id="progressmodel" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content" style="border-radius: 15px; overflow: hidden;">

            <!-- Modal Body -->
            <div class="modal-body p-0">
                <!-- Header -->
                <div style="background: linear-gradient(to right, #74b749, #c5e1a5); color: white; padding: 25px 20px; position: relative;">

                    <!-- Text Left-Aligned -->
                    <div style="text-align: left;">
                        <h5 style="margin: 0;">Project Name</h5>
                        <small>Ticket #1 - Ticket Title</small>
                    </div>

                    <!-- Logo Centered, Half Outside -->
                    <div style="position: absolute; bottom: -30px; left: 50%; transform: translateX(-50%); background: white; border-radius: 50%; padding: 5px;">
                        <img src="{{ URL::asset('/build/img/yekbon.svg') }}" alt="Logo" style="width: 60px; height: 60px; border-radius: 50%;">
                    </div>

                </div>
                <!-- Task Card -->
                <div class="p-2">
                    <div style="background-color: #f8f9fa; border-radius: 15px; box-shadow: 0px 0px 5px rgba(0,0,0,0.05);margin-top:25px;">

                        <!-- Title -->
                        <h5 class="text-center fw-bold mb-3" style="color: #1c2233;">Task Title</h5>

                        <!-- Badges Row -->
                        <div class="text-center mb-3">
                            <!-- New Task -->
                            <span class="badge rounded-pill" style="background-color: #e4f1d8; color: #0d6efd; font-size: 13px; padding: 8px 12px;">
                                <img src="{{ URL::asset('/build/img/greenflag.svg') }}" alt="Logo" style="width: 16px; height: 16px;"> in progress
                            </span>

                            <!-- High Priority -->
                            <span class="badge rounded-pill" style="background-color: #ff4d4d; color: white; font-size: 13px; padding: 8px 12px;">
                                <i class="bi bi-lightning-fill me-1"></i> 01
                            </span>

                            <!-- Low Status -->
                            <span class="badge rounded-pill" style="background-color: #f1fdf5; color: #22c55e; font-size: 13px; padding: 8px 12px;">
                                <i class="bi bi-circle-fill me-1" style="font-size: 8px;"></i> Low
                            </span>
                        </div>

                        <!-- Info Row -->
                        <div class="d-flex flex-wrap justify-content-around text-center" style="font-size: 14px;">
                            <div>
                                <div class="text-muted">Task ID</div>
                            </div>
                            <div>
                                <div class="text-muted">Section</div>
                            </div>
                            <div>
                                <div><span class="text-success">Start:</span> 22.10.2024</div>
                            </div>
                            <div>
                                <div><span class="text-success">Deliver:</span> 22.10.2024</div>
                            </div>
                        </div>

                    </div>
                    <!-- Issue Description -->
                    <div class="mt-2 mb-3" style="background-color: #f8f9fa;padding:10px;border-radius:10px;">
                        <strong>Issue Description :</strong>
                        <p style="font-size: 14px; margin-top: 5px;">
                            move the close button more down due to its near on the popup
                        </p>
                    </div>
                    <!-- Sign-in Box -->
                    <div class="mx-auto my-4" style="border: 1px solid #ddd; border-radius: 12px; padding: 20px; background-color: #fefefe; text-align: center;">
                        <img src="https://img.icons8.com/ios-filled/100/40C057/right--v1.png" style="width: 40px; margin-bottom: 10px;" alt="Sign In">
                        <h6 style="font-weight: bold;">Sign in</h6>
                        <p style="font-size: 14px; color: #555;">Please use your Login Details for Access</p>

                        <!-- Close Button (positioned lower) -->
                        <div style="margin-top: 25px;">
                            <button class="btn btn-success px-4" data-bs-dismiss="modal">Close</button>
                        </div>

                    </div>
                    <!-- Notes -->
                    <!-- Notes Section (Exact Match) -->
                    <div class="p-3" style="background-color: #f5f5f5; border-radius: 10px;">
                        <div style="font-weight: 600; color: #333; font-size: 14px; margin-bottom: 10px;">• Notes •</div>

                        <!-- Note Items -->
                        <div style="background-color: #fff; border-radius: 6px; padding: 8px 12px; margin-bottom: 8px; display: flex; align-items: center;">
                            <img src="{{ URL::asset('/build/img/tera.svg') }}" alt="icon" style="width: 18px; height: 18px; margin-right: 10px;">

                            <span style="color: #667085; font-size: 13.5px;">Take Backup before start Development</span>
                        </div>

                        <div style="background-color: #fff; border-radius: 6px; padding: 8px 12px; margin-bottom: 8px; display: flex; align-items: center;">
                            <img src="{{ URL::asset('/build/img/tera.svg') }}" alt="icon" style="width: 18px; height: 18px; margin-right: 10px;">
                            <span style="color: #667085; font-size: 13.5px;">Work on your Local Server</span>
                        </div>

                        <div style="background-color: #fff; border-radius: 6px; padding: 8px 12px; display: flex; align-items: center;">
                            <img src="{{ URL::asset('/build/img/tera.svg') }}" alt="icon" style="width: 18px; height: 18px; margin-right: 10px;">
                            <span style="color: #667085; font-size: 13.5px;">Check your work before u deliver the work</span>
                        </div>
                    </div>

                    <div style="display: flex; justify-content: space-around; background: #f8f9fa; padding: 20px; border-radius: 10px;" class="mt-3">

                        <!-- Edit the Project -->
                        <div style="text-align: center; flex: 1;cursor:pointer;">
                            <div style="background: #316b9e; padding: 10px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;">
                                <img src="{{ asset('build/img/editp.svg') }}" alt="Edit" width="30" height="30">
                            </div>
                            <div style="margin-top: 6px; color: #1c2b48; font-size: 12px; font-weight: 600;">Edit The Project</div>
                        </div>


                        <!-- Remove the Project -->
                        <div style="text-align: center; flex: 1; cursor: pointer;"
                            data-bs-toggle="modal" data-bs-target="#removeproject">

                            <div style="background: #f44336; padding: 10px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;">
                                <img src="{{ asset('build/img/deletep.svg') }}" alt="Delete" width="30" height="30">
                            </div>

                            <div style="margin-top: 6px; color: #1c2b48; font-size: 12px; font-weight: 600;">
                                Remove The Project
                            </div>
                        </div>

                    </div>

                </div>








            </div> <!-- End .p-3 -->

        </div> <!-- End .modal-body -->

    </div>
</div>
<!-- Reject Model -->
<div class="modal fade" id="inreject" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content" style="border-radius: 15px; overflow: hidden;">

            <!-- Modal Body -->
            <div class="modal-body p-0">
                <!-- Header -->
                <div style="background: linear-gradient(to right, #e53935, #f48fb1); color: white; padding: 25px 20px; position: relative;">

                    <!-- Text Left-Aligned -->
                    <div style="text-align: left;">
                        <h5 style="margin: 0;">Project Name</h5>
                        <small>Ticket #1 - Ticket Title</small>
                    </div>

                    <!-- Logo Centered, Half Outside -->
                    <div style="position: absolute; bottom: -30px; left: 50%; transform: translateX(-50%); background: white; border-radius: 50%; padding: 5px;">
                        <img src="{{ URL::asset('/build/img/yekbon.svg') }}" alt="Logo" style="width: 60px; height: 60px; border-radius: 50%;">
                    </div>

                </div>
                <!-- Task Card -->
                <div class="p-2">
                    <div style="background-color: #f8f9fa; border-radius: 15px; box-shadow: 0px 0px 5px rgba(0,0,0,0.05);margin-top:25px;">

                        <!-- Title -->
                        <h5 class="text-center fw-bold mb-3" style="color: #1c2233;">Task Title</h5>

                        <!-- Badges Row -->
                        <div class="text-center mb-3">
                            <!-- New Task -->
                            <span class="badge rounded-pill" style="background-color: #fbd2d2; color: #2f2e4c; font-size: 13px; padding: 8px 12px;">
                                <img src="{{ URL::asset('/build/img/redflag.svg') }}" alt="Logo" style="width: 16px; height: 16px;"> in Reject
                            </span>

                            <!-- High Priority -->
                            <span class="badge rounded-pill" style="background-color: #ff4d4d; color: white; font-size: 13px; padding: 8px 12px;">
                                <i class="bi bi-lightning-fill me-1"></i> 01
                            </span>

                            <!-- Low Status -->
                            <span class="badge rounded-pill" style="background-color: #f1fdf5; color: #22c55e; font-size: 13px; padding: 8px 12px;">
                                <i class="bi bi-circle-fill me-1" style="font-size: 8px;"></i> Low
                            </span>
                        </div>

                        <!-- Info Row -->
                        <div class="d-flex flex-wrap justify-content-around text-center" style="font-size: 14px;">
                            <div>
                                <div class="text-muted">Task ID</div>
                            </div>
                            <div>
                                <div class="text-muted">Section</div>
                            </div>
                            <div>
                                <div><span class="text-success">Start:</span> 22.10.2024</div>
                            </div>
                            <div>
                                <div><span class="text-success">Deliver:</span> 22.10.2024</div>
                            </div>
                        </div>

                    </div>
                    <!-- Issue Description -->
                    <div class="mt-2 mb-3" style="background-color: #f8f9fa;padding:10px;border-radius:10px;">
                        <strong>Issue Description :</strong>
                        <p style="font-size: 14px; margin-top: 5px;">
                            move the close button more down due to its near on the popup
                        </p>
                    </div>
                    <!-- Sign-in Box -->
                    <div class="mx-auto my-4" style="border: 1px solid #ddd; border-radius: 12px; padding: 20px; background-color: #fefefe; text-align: center;">
                        <img src="https://img.icons8.com/ios-filled/100/40C057/right--v1.png" style="width: 40px; margin-bottom: 10px;" alt="Sign In">
                        <h6 style="font-weight: bold;">Sign in</h6>
                        <p style="font-size: 14px; color: #555;">Please use your Login Details for Access</p>

                        <!-- Close Button (positioned lower) -->
                        <div style="margin-top: 25px;">
                            <button class="btn btn-success px-4" data-bs-dismiss="modal">Close</button>
                        </div>

                    </div>
                    <!-- Notes -->
                    <!-- Notes Section (Exact Match) -->
                    <div class="p-3" style="background-color: #f5f5f5; border-radius: 10px;">
                        <div style="font-weight: 600; color: #333; font-size: 14px; margin-bottom: 10px;">• Notes •</div>

                        <!-- Note Items -->
                        <div style="background-color: #fff; border-radius: 6px; padding: 8px 12px; margin-bottom: 8px; display: flex; align-items: center;">
                            <img src="{{ URL::asset('/build/img/tera.svg') }}" alt="icon" style="width: 18px; height: 18px; margin-right: 10px;">

                            <span style="color: #667085; font-size: 13.5px;">Take Backup before start Development</span>
                        </div>

                        <div style="background-color: #fff; border-radius: 6px; padding: 8px 12px; margin-bottom: 8px; display: flex; align-items: center;">
                            <img src="{{ URL::asset('/build/img/tera.svg') }}" alt="icon" style="width: 18px; height: 18px; margin-right: 10px;">
                            <span style="color: #667085; font-size: 13.5px;">Work on your Local Server</span>
                        </div>

                        <div style="background-color: #fff; border-radius: 6px; padding: 8px 12px; display: flex; align-items: center;">
                            <img src="{{ URL::asset('/build/img/tera.svg') }}" alt="icon" style="width: 18px; height: 18px; margin-right: 10px;">
                            <span style="color: #667085; font-size: 13.5px;">Check your work before u deliver the work</span>
                        </div>
                    </div>
                    <!-- rejct reason -->
                    <div class="mt-2" style="background-color: #fdebec; border-radius: 10px; padding: 10px; text-align: center; font-family: Arial, sans-serif;  margin: auto;">

                        <!-- Icon -->
                        <div style="background: #f44336; padding: 10px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;">
                            <img src="{{ asset('build/img/deletep.svg') }}" alt="Delete" width="30" height="30">
                        </div>

                        <!-- Text -->
                        <div style="color: #1c2b48; font-size: 14px; font-weight: 600;">
                            The Hold Reason will be here
                        </div>

                    </div>


                    <div style="display: flex; justify-content: space-around; background: #f8f9fa; padding: 20px; border-radius: 10px;" class="mt-3">

                        <!-- Edit the Project -->
                        <div style="text-align: center; flex: 1;cursor:pointer;">
                            <div style="background: #316b9e; padding: 10px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;">
                                <img src="{{ asset('build/img/editp.svg') }}" alt="Edit" width="30" height="30">
                            </div>
                            <div style="margin-top: 6px; color: #1c2b48; font-size: 12px; font-weight: 600;">Edit The Project</div>
                        </div>


                        <!-- Remove the Project -->
                        <div style="text-align: center; flex: 1; cursor: pointer;"
                            data-bs-toggle="modal" data-bs-target="#removeproject">

                            <div style="background: #f44336; padding: 10px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;">
                                <img src="{{ asset('build/img/deletep.svg') }}" alt="Delete" width="30" height="30">
                            </div>

                            <div style="margin-top: 6px; color: #1c2b48; font-size: 12px; font-weight: 600;">
                                Remove The Project
                            </div>
                        </div>

                    </div>

                </div>








            </div> <!-- End .p-3 -->

        </div> <!-- End .modal-body -->

    </div>
</div>

<!-- Inhold Model -->
<div class="modal fade" id="inhold" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content" style="border-radius: 15px; overflow: hidden;">

            <!-- Modal Body -->
            <div class="modal-body p-0">
                <!-- Header -->
                <div style="background: linear-gradient(to right, #f9b412, #fde08d);
 color: white; padding: 25px 20px; position: relative;">

                    <!-- Text Left-Aligned -->
                    <div style="text-align: left;">
                        <h5 style="margin: 0;">Project Name</h5>
                        <small>Ticket #1 - Ticket Title</small>
                    </div>

                    <!-- Logo Centered, Half Outside -->
                    <div style="position: absolute; bottom: -30px; left: 50%; transform: translateX(-50%); background: white; border-radius: 50%; padding: 5px;">
                        <img src="{{ URL::asset('/build/img/yekbon.svg') }}" alt="Logo" style="width: 60px; height: 60px; border-radius: 50%;">
                    </div>

                </div>
                <!-- Task Card -->
                <div class="p-2">
                    <div style="background-color: #f8f9fa; border-radius: 15px; box-shadow: 0px 0px 5px rgba(0,0,0,0.05);margin-top:25px;">

                        <!-- Title -->
                        <h5 class="text-center fw-bold mb-3" style="color: #1c2233;">Task Title</h5>

                        <!-- Badges Row -->
                        <div class="text-center mb-3">
                            <!-- New Task -->
                            <span class="badge rounded-pill" style="background-color: #fff2cc; color: #2f2e4c; font-size: 13px; padding: 8px 12px;">
                                <img src="{{ URL::asset('/build/img/yelowflag.svg') }}" alt="Logo" style="width: 16px; height: 16px;"> in Hold
                            </span>

                            <!-- High Priority -->
                            <span class="badge rounded-pill" style="background-color: #ff4d4d; color: white; font-size: 13px; padding: 8px 12px;">
                                <i class="bi bi-lightning-fill me-1"></i> 01
                            </span>

                            <!-- Low Status -->
                            <span class="badge rounded-pill" style="background-color: #f1fdf5; color: #22c55e; font-size: 13px; padding: 8px 12px;">
                                <i class="bi bi-circle-fill me-1" style="font-size: 8px;"></i> Low
                            </span>
                        </div>

                        <!-- Info Row -->
                        <div class="d-flex flex-wrap justify-content-around text-center" style="font-size: 14px;">
                            <div>
                                <div class="text-muted">Task ID</div>
                            </div>
                            <div>
                                <div class="text-muted">Section</div>
                            </div>
                            <div>
                                <div><span class="text-success">Start:</span> 22.10.2024</div>
                            </div>
                            <div>
                                <div><span class="text-success">Deliver:</span> 22.10.2024</div>
                            </div>
                        </div>

                    </div>
                    <!-- Issue Description -->
                    <div class="mt-2 mb-3" style="background-color: #f8f9fa;padding:10px;border-radius:10px;">
                        <strong>Issue Description :</strong>
                        <p style="font-size: 14px; margin-top: 5px;">
                            move the close button more down due to its near on the popup
                        </p>
                    </div>
                    <!-- Sign-in Box -->
                    <div class="mx-auto my-4" style="border: 1px solid #ddd; border-radius: 12px; padding: 20px; background-color: #fefefe; text-align: center;">
                        <img src="https://img.icons8.com/ios-filled/100/40C057/right--v1.png" style="width: 40px; margin-bottom: 10px;" alt="Sign In">
                        <h6 style="font-weight: bold;">Sign in</h6>
                        <p style="font-size: 14px; color: #555;">Please use your Login Details for Access</p>

                        <!-- Close Button (positioned lower) -->
                        <div style="margin-top: 25px;">
                            <button class="btn btn-success px-4" data-bs-dismiss="modal">Close</button>
                        </div>

                    </div>
                    <!-- Notes -->
                    <!-- Notes Section (Exact Match) -->
                    <div class="p-3" style="background-color: #f5f5f5; border-radius: 10px;">
                        <div style="font-weight: 600; color: #333; font-size: 14px; margin-bottom: 10px;">• Notes •</div>

                        <!-- Note Items -->
                        <div style="background-color: #fff; border-radius: 6px; padding: 8px 12px; margin-bottom: 8px; display: flex; align-items: center;">
                            <img src="{{ URL::asset('/build/img/tera.svg') }}" alt="icon" style="width: 18px; height: 18px; margin-right: 10px;">

                            <span style="color: #667085; font-size: 13.5px;">Take Backup before start Development</span>
                        </div>

                        <div style="background-color: #fff; border-radius: 6px; padding: 8px 12px; margin-bottom: 8px; display: flex; align-items: center;">
                            <img src="{{ URL::asset('/build/img/tera.svg') }}" alt="icon" style="width: 18px; height: 18px; margin-right: 10px;">
                            <span style="color: #667085; font-size: 13.5px;">Work on your Local Server</span>
                        </div>

                        <div style="background-color: #fff; border-radius: 6px; padding: 8px 12px; display: flex; align-items: center;">
                            <img src="{{ URL::asset('/build/img/tera.svg') }}" alt="icon" style="width: 18px; height: 18px; margin-right: 10px;">
                            <span style="color: #667085; font-size: 13.5px;">Check your work before u deliver the work</span>
                        </div>
                    </div>
                    <!-- rejct reason -->
                    <div class="mt-2" style="background-color: #fdebec; border-radius: 10px; padding: 10px; text-align: center; font-family: Arial, sans-serif;  margin: auto;">

                        <!-- Icon -->
                        <div style="background: #f44336; padding: 10px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;">
                            <img src="{{ asset('build/img/deletep.svg') }}" alt="Delete" width="30" height="30">
                        </div>

                        <!-- Text -->
                        <div style="color: #1c2b48; font-size: 14px; font-weight: 600;">
                            The Hold Reason will be here
                        </div>

                    </div>


                    <div style="display: flex; justify-content: space-around; background: #f8f9fa; padding: 20px; border-radius: 10px;" class="mt-3">

                        <!-- Edit the Project -->
                        <div style="text-align: center; flex: 1;cursor:pointer;">
                            <div style="background: #316b9e; padding: 10px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;">
                                <img src="{{ asset('build/img/editp.svg') }}" alt="Edit" width="30" height="30">
                            </div>
                            <div style="margin-top: 6px; color: #1c2b48; font-size: 12px; font-weight: 600;">Edit The Project</div>
                        </div>


                        <!-- Remove the Project -->
                        <div style="text-align: center; flex: 1; cursor: pointer;"
                            data-bs-toggle="modal" data-bs-target="#removeproject">

                            <div style="background: #f44336; padding: 10px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;">
                                <img src="{{ asset('build/img/deletep.svg') }}" alt="Delete" width="30" height="30">
                            </div>

                            <div style="margin-top: 6px; color: #1c2b48; font-size: 12px; font-weight: 600;">
                                Remove The Project
                            </div>
                        </div>

                    </div>

                </div>








            </div> <!-- End .p-3 -->

        </div> <!-- End .modal-body -->

    </div>
</div>
<!-- delayed Model -->
<div class="modal fade" id="indelayed" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content" style="border-radius: 15px; overflow: hidden;">

            <!-- Modal Body -->
            <div class="modal-body p-0">
                <!-- Header -->
                <div style="background: linear-gradient(to right, #ff4081, #ffb6d5); color: white; padding: 25px 20px; position: relative;">

                    <!-- Text Left-Aligned -->
                    <div style="text-align: left;">
                        <h5 style="margin: 0;">Project Name</h5>
                        <small>Ticket #1 - Ticket Title</small>
                    </div>

                    <!-- Logo Centered, Half Outside -->
                    <div style="position: absolute; bottom: -30px; left: 50%; transform: translateX(-50%); background: white; border-radius: 50%; padding: 5px;">
                        <img src="{{ URL::asset('/build/img/yekbon.svg') }}" alt="Logo" style="width: 60px; height: 60px; border-radius: 50%;">
                    </div>

                </div>
                <!-- Task Card -->
                <div class="p-2">
                    <div style="background-color: #f8f9fa; border-radius: 15px; box-shadow: 0px 0px 5px rgba(0,0,0,0.05);margin-top:25px;">

                        <!-- Title -->
                        <h5 class="text-center fw-bold mb-3" style="color: #1c2233;">Task Title</h5>

                        <!-- Badges Row -->
                        <div class="text-center mb-3">
                            <!-- New Task -->
                            <span class="badge rounded-pill" style="background-color: #f8d0d1; color: #2c2e4a; font-size: 13px; padding: 8px 12px;">
                                <img src="{{ URL::asset('/build/img/redflag.svg') }}" alt="Logo" style="width: 16px; height: 16px;"> in delayed
                            </span>

                            <!-- High Priority -->
                            <span class="badge rounded-pill" style="background-color: #ff4d4d; color: white; font-size: 13px; padding: 8px 12px;">
                                <i class="bi bi-lightning-fill me-1"></i> 01
                            </span>

                            <!-- Low Status -->
                            <span class="badge rounded-pill" style="background-color: #f1fdf5; color: #22c55e; font-size: 13px; padding: 8px 12px;">
                                <i class="bi bi-circle-fill me-1" style="font-size: 8px;"></i> Low
                            </span>
                        </div>

                        <!-- Info Row -->
                        <div class="d-flex flex-wrap justify-content-around text-center" style="font-size: 14px;">
                            <div>
                                <div class="text-muted">Task ID</div>
                            </div>
                            <div>
                                <div class="text-muted">Section</div>
                            </div>
                            <div>
                                <div><span class="text-success">Start:</span> 22.10.2024</div>
                            </div>
                            <div>
                                <div><span class="text-success">Deliver:</span> 22.10.2024</div>
                            </div>
                        </div>

                    </div>
                    <!-- Issue Description -->
                    <div class="mt-2 mb-3" style="background-color: #f8f9fa;padding:10px;border-radius:10px;">
                        <strong>Issue Description :</strong>
                        <p style="font-size: 14px; margin-top: 5px;">
                            move the close button more down due to its near on the popup
                        </p>
                    </div>
                    <!-- Sign-in Box -->
                    <div class="mx-auto my-4" style="border: 1px solid #ddd; border-radius: 12px; padding: 20px; background-color: #fefefe; text-align: center;">
                        <img src="https://img.icons8.com/ios-filled/100/40C057/right--v1.png" style="width: 40px; margin-bottom: 10px;" alt="Sign In">
                        <h6 style="font-weight: bold;">Sign in</h6>
                        <p style="font-size: 14px; color: #555;">Please use your Login Details for Access</p>

                        <!-- Close Button (positioned lower) -->
                        <div style="margin-top: 25px;">
                            <button class="btn btn-success px-4" data-bs-dismiss="modal">Close</button>
                        </div>

                    </div>
                    <!-- Notes -->
                    <!-- Notes Section (Exact Match) -->
                    <div class="p-3" style="background-color: #f5f5f5; border-radius: 10px;">
                        <div style="font-weight: 600; color: #333; font-size: 14px; margin-bottom: 10px;">• Notes •</div>

                        <!-- Note Items -->
                        <div style="background-color: #fff; border-radius: 6px; padding: 8px 12px; margin-bottom: 8px; display: flex; align-items: center;">
                            <img src="{{ URL::asset('/build/img/tera.svg') }}" alt="icon" style="width: 18px; height: 18px; margin-right: 10px;">

                            <span style="color: #667085; font-size: 13.5px;">Take Backup before start Development</span>
                        </div>

                        <div style="background-color: #fff; border-radius: 6px; padding: 8px 12px; margin-bottom: 8px; display: flex; align-items: center;">
                            <img src="{{ URL::asset('/build/img/tera.svg') }}" alt="icon" style="width: 18px; height: 18px; margin-right: 10px;">
                            <span style="color: #667085; font-size: 13.5px;">Work on your Local Server</span>
                        </div>

                        <div style="background-color: #fff; border-radius: 6px; padding: 8px 12px; display: flex; align-items: center;">
                            <img src="{{ URL::asset('/build/img/tera.svg') }}" alt="icon" style="width: 18px; height: 18px; margin-right: 10px;">
                            <span style="color: #667085; font-size: 13.5px;">Check your work before u deliver the work</span>
                        </div>
                    </div>
                    <!-- rejct reason -->
                    <div class="mt-2" style="background-color: #fdebec; border-radius: 10px; padding: 10px; text-align: center; font-family: Arial, sans-serif;  margin: auto;">

                        <!-- Icon -->
                        <div style="background: #f44336; padding: 10px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;">
                            <img src="{{ asset('build/img/deletep.svg') }}" alt="Delete" width="30" height="30">
                        </div>

                        <!-- Text -->
                        <div style="color: #1c2b48; font-size: 14px; font-weight: 600;">
                            The Hold Reason will be here
                        </div>

                    </div>


                    <div style="display: flex; justify-content: space-around; background: #f8f9fa; padding: 20px; border-radius: 10px;" class="mt-3">

                        <!-- Edit the Project -->
                        <div style="text-align: center; flex: 1;cursor:pointer;">
                            <div style="background: #316b9e; padding: 10px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;">
                                <img src="{{ asset('build/img/editp.svg') }}" alt="Edit" width="30" height="30">
                            </div>
                            <div style="margin-top: 6px; color: #1c2b48; font-size: 12px; font-weight: 600;">Edit The Project</div>
                        </div>


                        <!-- Remove the Project -->
                        <div style="text-align: center; flex: 1; cursor: pointer;"
                            data-bs-toggle="modal" data-bs-target="#removeproject">

                            <div style="background: #f44336; padding: 10px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;">
                                <img src="{{ asset('build/img/deletep.svg') }}" alt="Delete" width="30" height="30">
                            </div>

                            <div style="margin-top: 6px; color: #1c2b48; font-size: 12px; font-weight: 600;">
                                Remove The Project
                            </div>
                        </div>

                    </div>

                </div>

            </div> <!-- End .p-3 -->

        </div> <!-- End .modal-body -->

    </div>
</div>

<!-- total task -->
<div class="modal fade" id="indone" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content" style="border-radius: 15px; overflow: hidden;">

            <!-- Modal Body -->
            <div class="modal-body p-0">
                <!-- Header -->
                <div style="background: linear-gradient(to right, #21c064, #a0eac8);
 color: white; padding: 25px 20px; position: relative;">

                    <!-- Text Left-Aligned -->
                    <div style="text-align: left;">
                        <h5 style="margin: 0;">Project Name</h5>
                        <small>Ticket #1 - Ticket Title</small>
                    </div>

                    <!-- Logo Centered, Half Outside -->
                    <div style="position: absolute; bottom: -30px; left: 50%; transform: translateX(-50%); background: white; border-radius: 50%; padding: 5px;">
                        <img src="{{ URL::asset('/build/img/yekbon.svg') }}" alt="Logo" style="width: 60px; height: 60px; border-radius: 50%;">
                    </div>

                </div>
                <!-- Task Card -->
                <div class="p-2">
                    <div style="background-color: #f8f9fa; border-radius: 15px; box-shadow: 0px 0px 5px rgba(0,0,0,0.05);margin-top:25px;">

                        <!-- Title -->
                        <h5 class="text-center fw-bold mb-3" style="color: #1c2233;">Task Title</h5>

                        <!-- Badges Row -->
                        <div class="text-center mb-3">
                            <!-- New Task -->
                            <span class="badge rounded-pill" style="background-color: #d6f5e3; color: #2c3e50; font-size: 13px; padding: 8px 12px;">
                                <img src="{{ URL::asset('/build/img/greenflag.svg') }}" alt="Logo" style="width: 16px; height: 16px;">in Done
                            </span>

                            <!-- High Priority -->
                            <span class="badge rounded-pill" style="background-color: #ff4d4d; color: white; font-size: 13px; padding: 8px 12px;">
                                <i class="bi bi-lightning-fill me-1"></i> 01
                            </span>

                            <!-- Low Status -->
                            <span class="badge rounded-pill" style="background-color: #f1fdf5; color: #22c55e; font-size: 13px; padding: 8px 12px;">
                                <i class="bi bi-circle-fill me-1" style="font-size: 8px;"></i> Low
                            </span>
                        </div>

                        <!-- Info Row -->
                        <div class="d-flex flex-wrap justify-content-around text-center" style="font-size: 14px;">
                            <div>
                                <div class="text-muted">Task ID</div>
                            </div>
                            <div>
                                <div class="text-muted">Section</div>
                            </div>
                            <div>
                                <div><span class="text-success">Start:</span> 22.10.2024</div>
                            </div>
                            <div>
                                <div><span class="text-success">Deliver:</span> 22.10.2024</div>
                            </div>
                        </div>

                    </div>
                    <!-- Issue Description -->
                    <div class="mt-2 mb-3" style="background-color: #f8f9fa;padding:10px;border-radius:10px;">
                        <strong>Issue Description :</strong>
                        <p style="font-size: 14px; margin-top: 5px;">
                            move the close button more down due to its near on the popup
                        </p>
                    </div>
                    <!-- card -->
                    <div class="card text-center p-3" style="border-radius: 16px; border: none; background: #f9f9f9; box-shadow: 0 4px 10px rgba(0,0,0,0.05);  margin: auto;">

                        <!-- TOP SECTION (Background + Profile + Name + Role) -->
                        <div style="width: 160px; margin: auto; background: #fdfdfd; border-radius: 20px; padding-bottom: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.05);">

                            <!-- Background Image -->
                            <div style="position: relative; height: 60px; overflow: hidden; border-radius: 20px 20px 0 0;">
                                <img src="{{ URL::asset('/build/img/bgractangle.svg') }}" alt="Background"
                                    style="width: 100%; height: 100%; object-fit: cover;">
                            </div>

                            <!-- Profile Image -->
                            <div style="position: relative; margin-top: -25px;">
                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile"
                                    class="rounded-circle"
                                    style="width: 50px; height: 50px; object-fit: cover; border: 3px solid white;">
                            </div>

                            <!-- Name & Role -->
                            <div class="mt-1">
                                <h6 style="margin: 0; font-weight: 600; font-size: 13px;">Name Lastname</h6>
                                <div style="font-size: 11px; color: #e74c3c; font-weight: 500;">Developer</div>
                            </div>
                        </div>

                        <!-- Status Tag -->
                        <div class="my-2">
                            <span style="background-color: #d4f4e1; color: #27ae60; font-size: 12px; padding: 4px 12px; border-radius: 20px; font-weight: 600;">On Time</span>
                        </div>

                        <!-- Start / Deliver / Duration -->
                        <div class="d-flex justify-content-between text-center mb-3 px-2" style="font-size: 12px; font-weight: 500;">
                            <div>
                                <div style="color: #7f8ea3;">Start:</div>
                                <div style="color: #27ae60;">22.10.2025 - 12:30</div>
                            </div>
                            <div>
                                <div style="color: #7f8ea3;">Deliver:</div>
                                <div style="color: #27ae60;">22.10.2025 - 19:30</div>
                            </div>
                            <div>
                                <div style="color: #7f8ea3;">Time Left:</div>
                                <div style="color: #2ecc71;">0 day 7 Hr - 30 min</div>
                            </div>
                        </div>

                        <!-- Footer Info: Meetings, Trys, In Hold, In Delayed -->
                        <div class="d-flex justify-content-around text-center pt-2 border-top" style="font-size: 12px;">
                            <div>
                                <div style="color: #2c3e50;">Meetings:</div>
                                <div><span style="color: #2c3e50;">3</span> / <span style="color: red;">2 - 1</span></div>
                            </div>
                            <div>
                                <div style="color: #2c3e50;">Trys:</div>
                                <div style="color: #2c3e50;">3</div>
                            </div>
                            <div>
                                <div style="color: #2c3e50;">In Hold:</div>
                                <div style="color: orange;">1</div>
                            </div>
                            <div>
                                <div style="color: #2c3e50;">In delayed:</div>
                                <div style="color: red;">0</div>
                            </div>
                        </div>
                    </div>



                    <!-- Sign-in Box -->
                    <div class="mx-auto my-4" style="border: 1px solid #ddd; border-radius: 12px; padding: 20px; background-color: #fefefe; text-align: center;">
                        <img src="https://img.icons8.com/ios-filled/100/40C057/right--v1.png" style="width: 40px; margin-bottom: 10px;" alt="Sign In">
                        <h6 style="font-weight: bold;">Sign in</h6>
                        <p style="font-size: 14px; color: #555;">Please use your Login Details for Access</p>

                        <!-- Close Button (positioned lower) -->
                        <div style="margin-top: 25px;">
                            <button class="btn btn-success px-4" data-bs-dismiss="modal">Close</button>
                        </div>

                    </div>
                    <!-- Notes -->
                    <!-- Notes Section (Exact Match) -->
                    <div class="p-3" style="background-color: #f5f5f5; border-radius: 10px;">
                        <div style="font-weight: 600; color: #333; font-size: 14px; margin-bottom: 10px;">• Notes •</div>

                        <!-- Note Items -->
                        <div style="background-color: #fff; border-radius: 6px; padding: 8px 12px; margin-bottom: 8px; display: flex; align-items: center;">
                            <img src="{{ URL::asset('/build/img/tera.svg') }}" alt="icon" style="width: 18px; height: 18px; margin-right: 10px;">

                            <span style="color: #667085; font-size: 13.5px;">Take Backup before start Development</span>
                        </div>

                        <div style="background-color: #fff; border-radius: 6px; padding: 8px 12px; margin-bottom: 8px; display: flex; align-items: center;">
                            <img src="{{ URL::asset('/build/img/tera.svg') }}" alt="icon" style="width: 18px; height: 18px; margin-right: 10px;">
                            <span style="color: #667085; font-size: 13.5px;">Work on your Local Server</span>
                        </div>

                        <div style="background-color: #fff; border-radius: 6px; padding: 8px 12px; display: flex; align-items: center;">
                            <img src="{{ URL::asset('/build/img/tera.svg') }}" alt="icon" style="width: 18px; height: 18px; margin-right: 10px;">
                            <span style="color: #667085; font-size: 13.5px;">Check your work before u deliver the work</span>
                        </div>
                    </div>

                    <div style="display: flex; justify-content: space-around; background: #f8f9fa; padding: 20px; border-radius: 10px;" class="mt-3">

                        <!-- Edit the Project -->
                        <div style="text-align: center; flex: 1;cursor:pointer;">
                            <div style="background: #316b9e; padding: 10px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;">
                                <img src="{{ asset('build/img/editp.svg') }}" alt="Edit" width="30" height="30">
                            </div>
                            <div style="margin-top: 6px; color: #1c2b48; font-size: 12px; font-weight: 600;">Edit The Project</div>
                        </div>


                        <!-- Remove the Project -->
                        <div style="text-align: center; flex: 1; cursor: pointer;"
                            data-bs-toggle="modal" data-bs-target="#removeproject">

                            <div style="background: #f44336; padding: 10px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;">
                                <img src="{{ asset('build/img/deletep.svg') }}" alt="Delete" width="30" height="30">
                            </div>

                            <div style="margin-top: 6px; color: #1c2b48; font-size: 12px; font-weight: 600;">
                                Remove The Project
                            </div>
                        </div>

                    </div>

                </div>








            </div> <!-- End .p-3 -->

        </div> <!-- End .modal-body -->

    </div>
</div>
<!-- incheck -->

<div class="modal fade" id="incheck" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content" style="border-radius: 15px; overflow: hidden;">

            <!-- Modal Body -->
            <div class="modal-body p-0">
                <!-- Header -->
                <div style="background: linear-gradient(to right, #c2185b, #e1bee7); color: white; padding: 25px 20px; position: relative;">

                    <!-- Text Left-Aligned -->
                    <div style="text-align: left;">
                        <h5 style="margin: 0;">Project Name</h5>
                        <small>Ticket #1 - Ticket Title</small>
                    </div>

                    <!-- Logo Centered, Half Outside -->
                    <div style="position: absolute; bottom: -30px; left: 50%; transform: translateX(-50%); background: white; border-radius: 50%; padding: 5px;">
                        <img src="{{ URL::asset('/build/img/yekbon.svg') }}" alt="Logo" style="width: 60px; height: 60px; border-radius: 50%;">
                    </div>

                </div>
                <!-- Task Card -->
                <div class="p-2">
                    <div style="background-color: #f8f9fa; border-radius: 15px; box-shadow: 0px 0px 5px rgba(0,0,0,0.05);margin-top:25px;">

                        <!-- Title -->
                        <h5 class="text-center fw-bold mb-3" style="color: #1c2233;">Task Title</h5>

                        <!-- Badges Row -->
                        <div class="text-center mb-3">
                            <!-- New Task -->
                            <span class="badge rounded-pill" style="background-color: #f3c9e7; color: black; font-size: 13px; padding: 8px 12px;">
                                <img src="{{ URL::asset('/build/img/jamni.svg') }}" alt="Logo" style="width: 16px; height: 16px;">Project is in checking
                            </span>

                            <!-- High Priority -->
                            <span class="badge rounded-pill" style="background-color: #ff4d4d; color: white; font-size: 13px; padding: 8px 12px;">
                                <i class="bi bi-lightning-fill me-1"></i> 01
                            </span>

                            <!-- Low Status -->
                            <span class="badge rounded-pill" style="background-color: #f1fdf5; color: #22c55e; font-size: 13px; padding: 8px 12px;">
                                <i class="bi bi-circle-fill me-1" style="font-size: 8px;"></i> Low
                            </span>
                        </div>

                        <!-- Info Row -->
                        <div class="d-flex flex-wrap justify-content-around text-center" style="font-size: 14px;">
                            <div>
                                <div class="text-muted">Task ID</div>
                            </div>
                            <div>
                                <div class="text-muted">Section</div>
                            </div>
                            <div>
                                <div><span class="text-success">Start:</span> 22.10.2024</div>
                            </div>
                            <div>
                                <div><span class="text-success">Deliver:</span> 22.10.2024</div>
                            </div>
                        </div>

                    </div>
                    <!-- Issue Description -->
                    <div class="mt-2 mb-3" style="background-color: #f8f9fa;padding:10px;border-radius:10px;">
                        <strong>Issue Description :</strong>
                        <p style="font-size: 14px; margin-top: 5px;">
                            move the close button more down due to its near on the popup
                        </p>
                    </div>
                    <!-- Sign-in Box -->
                    <div class="mx-auto my-4" style="border: 1px solid #ddd; border-radius: 12px; padding: 20px; background-color: #fefefe; text-align: center;">
                        <img src="https://img.icons8.com/ios-filled/100/40C057/right--v1.png" style="width: 40px; margin-bottom: 10px;" alt="Sign In">
                        <h6 style="font-weight: bold;">Sign in</h6>
                        <p style="font-size: 14px; color: #555;">Please use your Login Details for Access</p>

                        <!-- Close Button (positioned lower) -->
                        <div style="margin-top: 25px;">
                            <button class="btn btn-success px-4" data-bs-dismiss="modal">Close</button>
                        </div>

                    </div>
                    <!-- Notes -->
                    <!-- Notes Section-->
                    <div class="p-3" style="background-color: #f5f5f5; border-radius: 10px;">
                        <div style="font-weight: 600; color: #333; font-size: 14px; margin-bottom: 10px;">• Admin Notes •</div>

                        <!-- Note Items -->
                        <div style="background-color: #fff; border-radius: 6px; padding: 8px 12px; margin-bottom: 8px; display: flex; align-items: center;">
                            <img src="{{ URL::asset('/build/img/tera.svg') }}" alt="icon" style="width: 18px; height: 18px; margin-right: 10px;">

                            <span style="color: #667085; font-size: 13.5px;">Please check the task atachement before take action</span>
                        </div>
                    </div>
                    <!-- Video Attachments Section -->
                    <div style="background-color: #f5f5f5; border-radius: 10px; padding: 12px 16px; font-family: Arial, sans-serif;margin-top:5px;">

                        <!-- Title -->
                        <div style="color: #1c2b48; font-weight: 600; font-size: 14px; margin-bottom: 10px;">
                            • Video Attachments •
                        </div>

                        <!-- Attachment Input Box -->
                        <div style="background-color: #ffffff; border-radius: 10px; padding: 10px 15px; display: flex; align-items: center;">

                            <!-- Icon -->
                            <div style="background-color: #cfd3dc; border-radius: 6px; padding: 6px; display: flex; align-items: center; justify-content: center; margin-right: 10px;">
                                <img src="{{ URL::asset('/build/img/Videocamera.svg') }}" alt="Video Icon" style="width: 16px; height: 16px;">
                            </div>

                            <!-- Input -->
                            <input type="text"
                                placeholder="Video Link will be here to check the work"
                                style="border: none; outline: none; width: 100%; font-size: 14px; color: #1c2b48; background-color: transparent;" />
                        </div>

                    </div>
                    <!-- File Attachments Section -->
                    <div class="p-3" style="background-color: #f5f5f5; border-radius: 10px; margin-top:5px;">
                        <div style="font-weight: 600; color: #333; font-size: 14px; margin-bottom: 15px;">• File Attachments •</div>

                        <div class="d-flex flex-wrap gap-3">

                            <!-- File Box -->
                            <div style="background-color: #ffffff; border-radius: 10px; padding: 10px 12px; display: flex; align-items: center; gap: 10px; min-width: 200px;">
                                <img src="pdf-icon.svg" alt="PDF" style="width: 32px; height: 32px;">
                                <div style="flex: 1;">
                                    <div style="font-size: 13px; font-weight: 500; color: #374151;">File Title.pdf</div>
                                    <div style="font-size: 11px; color: #9ca3af;">94 KB of 94 KB</div>
                                </div>
                                <img src="download-icon.svg" alt="D" style="width: 16px; height: 16px;">
                            </div>

                            <!-- File Box Copy 2 -->
                            <div style="background-color: #ffffff; border-radius: 10px; padding: 10px 12px; display: flex; align-items: center; gap: 10px; min-width: 200px;">
                                <img src="pdf-icon.svg" alt="PDF" style="width: 32px; height: 32px;">
                                <div style="flex: 1;">
                                    <div style="font-size: 13px; font-weight: 500; color: #374151;">File Title.pdf</div>
                                    <div style="font-size: 11px; color: #9ca3af;">94 KB of 94 KB</div>
                                </div>
                                <img src="download-icon.svg" alt="d" style="width: 16px; height: 16px;">
                            </div>

                            <!-- File Box Copy 3 -->
                            <!-- <div style="background-color: #ffffff; border-radius: 10px; padding: 10px 12px; display: flex; align-items: center; gap: 10px; min-width: 200px;">
                                <img src="pdf-icon.svg" alt="PDF" style="width: 32px; height: 32px;">
                                <div style="flex: 1;">
                                    <div style="font-size: 13px; font-weight: 500; color: #374151;">File Title.pdf</div>
                                    <div style="font-size: 11px; color: #9ca3af;">94 KB of 94 KB</div>
                                </div>
                                <img src="download-icon.svg" alt="Download" style="width: 16px; height: 16px;">
                            </div> -->

                        </div>
                    </div>



                    <div style="display: flex; justify-content: space-around; background: #f8f9fa; padding: 20px; border-radius: 10px;" class="mt-3">

                        <!-- Edit the Project -->
                        <div style="text-align: center; flex: 1;cursor:pointer;">
                            <div style="background: #316b9e; padding: 10px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;">
                                <img src="{{ asset('build/img/editp.svg') }}" alt="Edit" width="30" height="30">
                            </div>
                            <div style="margin-top: 6px; color: #1c2b48; font-size: 12px; font-weight: 600;">Edit The Task</div>
                        </div>
                        <!-- reject the task -->
                        <div style="text-align: center; flex: 1;cursor:pointer;" data-bs-toggle="modal" data-bs-target="#moveToRejectModal">
                            <div style="background: #d86a89; padding: 10px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;">
                                <img src="{{ asset('build/img/rejecttask.svg') }}" alt="Edit" width="30" height="30">
                            </div>
                            <div style="margin-top: 6px; color: #1c2b48; font-size: 12px; font-weight: 600;">Reject The Task</div>
                        </div>


                        <!-- mark  the DOne -->
                        <div style="text-align: center; flex: 1; cursor: pointer;"
                            data-bs-toggle="modal" data-bs-target="#moveToDoneModal">

                            <div style="background: #1ec963;padding: 10px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;">
                                <img src="{{ asset('build/img/markdone.svg') }}" alt="Delete" width="30" height="30">
                            </div>

                            <div style="margin-top: 6px; color: #1c2b48; font-size: 12px; font-weight: 600;">
                                Mark as Done
                            </div>
                        </div>

                    </div>

                </div>








            </div> <!-- End .p-3 -->

        </div> <!-- End .modal-body -->

    </div>
</div>
<!-- in done -->
<div class="modal fade" id="totaltask" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content" style="border-radius: 15px; overflow: hidden;">

            <!-- Modal Body -->
            <div class="modal-body p-0">
                <!-- Header -->
                <div style="background: linear-gradient(to right, #2980b9, #6dd5fa); color: white; padding: 25px 20px; position: relative;">

                    <!-- Text Left-Aligned -->
                    <div style="text-align: left;">
                        <h5 style="margin: 0;">Project Name</h5>
                        <small>Ticket #1 - Ticket Title</small>
                    </div>

                    <!-- Logo Centered, Half Outside -->
                    <div style="position: absolute; bottom: -30px; left: 50%; transform: translateX(-50%); background: white; border-radius: 50%; padding: 5px;">
                        <img src="{{ URL::asset('/build/img/yekbon.svg') }}" alt="Logo" style="width: 60px; height: 60px; border-radius: 50%;">
                    </div>

                </div>
                <!-- Task Card -->
                <div class="p-2">
                    <div style="background-color: #f8f9fa; border-radius: 15px; box-shadow: 0px 0px 5px rgba(0,0,0,0.05);margin-top:25px;">

                        <!-- Title -->
                        <h5 class="text-center fw-bold mb-3" style="color: #1c2233;">Task Title</h5>

                        <!-- Badges Row -->
                        <div class="text-center mb-3">
                            <!-- New Task -->
                            <span class="badge rounded-pill" style="background-color: #d7eefe; color: black; font-size: 13px; padding: 8px 12px;">
                                <img src="{{ URL::asset('/build/img/blueflag.svg') }}" alt="Logo" style="width: 16px; height: 16px;"> New Task
                            </span>

                            <!-- High Priority -->
                            <span class="badge rounded-pill" style="background-color: #ff4d4d; color: white; font-size: 13px; padding: 8px 12px;">
                                <i class="bi bi-lightning-fill me-1"></i> 01
                            </span>

                            <!-- Low Status -->
                            <span class="badge rounded-pill" style="background-color: #f1fdf5; color: #22c55e; font-size: 13px; padding: 8px 12px;">
                                <i class="bi bi-circle-fill me-1" style="font-size: 8px;"></i> Low
                            </span>
                        </div>

                        <!-- Info Row -->
                        <div class="d-flex flex-wrap justify-content-around text-center" style="font-size: 14px;">
                            <div>
                                <div class="text-muted">Task ID</div>
                            </div>
                            <div>
                                <div class="text-muted">Section</div>
                            </div>
                            <div>
                                <div><span class="text-success">Start:</span> 22.10.2024</div>
                            </div>
                            <div>
                                <div><span class="text-success">Deliver:</span> 22.10.2024</div>
                            </div>
                        </div>

                    </div>
                    <!-- Issue Description -->
                    <div class="mt-2 mb-3" style="background-color: #f8f9fa;padding:10px;border-radius:10px;">
                        <strong>Issue Description :</strong>
                        <p style="font-size: 14px; margin-top: 5px;">
                            move the close button more down due to its near on the popup
                        </p>
                    </div>
                    <!-- Sign-in Box -->
                    <div class="mx-auto my-4" style="border: 1px solid #ddd; border-radius: 12px; padding: 20px; background-color: #fefefe; text-align: center;">
                        <img src="https://img.icons8.com/ios-filled/100/40C057/right--v1.png" style="width: 40px; margin-bottom: 10px;" alt="Sign In">
                        <h6 style="font-weight: bold;">Sign in</h6>
                        <p style="font-size: 14px; color: #555;">Please use your Login Details for Access</p>

                        <!-- Close Button (positioned lower) -->
                        <div style="margin-top: 25px;">
                            <button class="btn btn-success px-4" data-bs-dismiss="modal">Close</button>
                        </div>

                    </div>
                    <!-- Notes -->
                    <!-- Notes Section-->
                    <div class="p-3" style="background-color: #f5f5f5; border-radius: 10px;">
                        <div style="font-weight: 600; color: #333; font-size: 14px; margin-bottom: 10px;">• Admin Notes •</div>

                        <!-- Note Items -->
                        <div style="background-color: #fff; border-radius: 6px; padding: 8px 12px; margin-bottom: 8px; display: flex; align-items: center;">
                            <img src="{{ URL::asset('/build/img/tera.svg') }}" alt="icon" style="width: 18px; height: 18px; margin-right: 10px;">

                            <span style="color: #667085; font-size: 13.5px;">Please check the task atachement before take action</span>
                        </div>
                    </div>
                    <!-- Video Attachments Section -->
                    <div style="background-color: #f5f5f5; border-radius: 10px; padding: 12px 16px; font-family: Arial, sans-serif;margin-top:5px;">

                        <!-- Title -->
                        <div style="color: #1c2b48; font-weight: 600; font-size: 14px; margin-bottom: 10px;">
                            • Video Attachments •
                        </div>

                        <!-- Attachment Input Box -->
                        <div style="background-color: #ffffff; border-radius: 10px; padding: 10px 15px; display: flex; align-items: center;">

                            <!-- Icon -->
                            <div style="background-color: #cfd3dc; border-radius: 6px; padding: 6px; display: flex; align-items: center; justify-content: center; margin-right: 10px;">
                                <img src="{{ URL::asset('/build/img/Videocamera.svg') }}" alt="Video Icon" style="width: 16px; height: 16px;">
                            </div>

                            <!-- Input -->
                            <input type="text"
                                placeholder="Video Link will be here to check the work"
                                style="border: none; outline: none; width: 100%; font-size: 14px; color: #1c2b48; background-color: transparent;" />
                        </div>

                    </div>
                    <!-- File Attachments Section -->
                    <div class="p-3" style="background-color: #f5f5f5; border-radius: 10px; margin-top:5px;">
                        <div style="font-weight: 600; color: #333; font-size: 14px; margin-bottom: 15px;">• File Attachments •</div>

                        <div class="d-flex flex-wrap gap-3">

                            <!-- File Box -->
                            <div style="background-color: #ffffff; border-radius: 10px; padding: 10px 12px; display: flex; align-items: center; gap: 10px; min-width: 200px;">
                                <img src="pdf-icon.svg" alt="PDF" style="width: 32px; height: 32px;">
                                <div style="flex: 1;">
                                    <div style="font-size: 13px; font-weight: 500; color: #374151;">File Title.pdf</div>
                                    <div style="font-size: 11px; color: #9ca3af;">94 KB of 94 KB</div>
                                </div>
                                <img src="download-icon.svg" alt="Download" style="width: 16px; height: 16px;">
                            </div>

                            <!-- File Box Copy 2 -->
                            <div style="background-color: #ffffff; border-radius: 10px; padding: 10px 12px; display: flex; align-items: center; gap: 10px; min-width: 200px;">
                                <img src="pdf-icon.svg" alt="PDF" style="width: 32px; height: 32px;">
                                <div style="flex: 1;">
                                    <div style="font-size: 13px; font-weight: 500; color: #374151;">File Title.pdf</div>
                                    <div style="font-size: 11px; color: #9ca3af;">94 KB of 94 KB</div>
                                </div>
                                <img src="download-icon.svg" alt="Download" style="width: 16px; height: 16px;">
                            </div>

                           

                        </div>
                    </div>



                  <div style="display: flex; justify-content: space-around; background: #f8f9fa; padding: 20px; border-radius: 10px;" class="mt-3">

                        <!-- Edit the Project -->
                        <div style="text-align: center; flex: 1;cursor:pointer;">
                            <div style="background: #316b9e; padding: 10px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;">
                                <img src="{{ asset('build/img/editp.svg') }}" alt="Edit" width="30" height="30">
                            </div>
                            <div style="margin-top: 6px; color: #1c2b48; font-size: 12px; font-weight: 600;">Edit The Project</div>
                        </div>


                        <!-- Remove the Project -->
                        <div style="text-align: center; flex: 1; cursor: pointer;"
                            data-bs-toggle="modal" data-bs-target="#removeproject">

                            <div style="background: #f44336; padding: 10px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;">
                                <img src="{{ asset('build/img/deletep.svg') }}" alt="Delete" width="30" height="30">
                            </div>

                            <div style="margin-top: 6px; color: #1c2b48; font-size: 12px; font-weight: 600;">
                                Remove The Project
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

<!-- moveToDoneModal Modal -->
<div class="modal fade" id="moveToDoneModal" tabindex="-1" aria-labelledby="moveToDoneLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content p-3" style="border-radius: 16px; background-color: #fdfdfd; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">

            <!-- Modal Header -->
            <h5 class=" mb-2" style="font-weight: 600;">Move the Task to Done</h5>

            <!-- Task Info Section -->
            <div style="background: #f9f9fb; padding: 16px; border-radius: 16px;">

                <!-- Task Title -->
                <div class="text-center mb-2">
                    <h5 style="font-weight: 700; color: #2c3e50;">Task Title</h5>
                </div>

                <!-- Task Badges -->
                <div class="text-center mb-3 d-flex justify-content-center flex-wrap gap-2">
                    <!-- Status -->
                    <span class="badge rounded-pill d-flex align-items-center gap-1" style="background-color: #f3c9e7; color: black; font-size: 13px; padding: 6px 10px;">
                        <img src="{{ URL::asset('/build/img/jamni.svg') }}" alt="Icon" style="width: 14px; height: 14px;">
                        Project is in Checking
                    </span>

                    <!-- Priority -->
                    <span class="badge rounded-pill d-flex align-items-center gap-1" style="background-color: #ff4d4d; color: white; font-size: 13px; padding: 6px 12px;">
                        <i class="bi bi-lightning-fill"></i> 01
                    </span>

                    <!-- Status Level -->
                    <span class="badge rounded-pill d-flex align-items-center gap-1" style="background-color: #f1fdf5; color: #22c55e; font-size: 13px; padding: 6px 12px;">
                        <i class="bi bi-circle-fill" style="font-size: 8px;"></i> Low
                    </span>
                </div>

                <!-- Task Meta Info Row -->
                <div class="d-flex justify-content-around text-center" style="font-size: 12px; font-weight: 500;">
                    <div style="color: #2c3e50;"><strong>Task ID</strong></div>
                    <div style="color: #2c3e50;"><strong>Section</strong></div>
                    <div><span style="color: #27ae60;">Start:</span> 22.10.2024</div>
                    <div><span style="color: #27ae60;">Deliver:</span> 22.10.2024</div>
                </div>

            </div>


            <!-- Developer Card -->
            <div class="card text-center p-3 mt-2 mb-3" style="border-radius: 16px; border: none; background: #f9f9f9; ">
                <div style="width: 160px; margin: auto; background: #fdfdfd; border-radius: 20px; padding-bottom: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.05);">
                    <div style="position: relative; height: 60px; overflow: hidden; border-radius: 20px 20px 0 0;">
                        <img src="{{ URL::asset('/build/img/bgractangle.svg') }}" alt="Background" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div style="position: relative; margin-top: -25px;">
                        <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover; border: 3px solid white;">
                    </div>
                    <div class="mt-1">
                        <h6 style="margin: 0; font-weight: 600; font-size: 13px;">Name Lastname</h6>
                        <div style="font-size: 11px; color: #e74c3c; font-weight: 500;">Developer</div>
                    </div>
                </div>

                <!-- Status -->
                <div class="my-2">
                    <span style="background-color: #d4f4e1; color: #27ae60; font-size: 12px; padding: 4px 12px; border-radius: 20px; font-weight: 600;">On Time</span>
                </div>

                <!-- Timeline -->
                <div class="d-flex justify-content-between text-center mb-3 px-2" style="font-size: 12px; font-weight: 500;">
                    <div>
                        <div style="color: #7f8ea3;">Start:</div>
                        <div style="color: #27ae60;">22.10.2025 - 12:30</div>
                    </div>
                    <div>
                        <div style="color: #7f8ea3;">Deliver:</div>
                        <div style="color: #27ae60;">22.10.2025 - 19:30</div>
                    </div>
                    <div>
                        <div style="color: #7f8ea3;">Time Left:</div>
                        <div style="color: #2ecc71;">0 day 7 Hr - 30 min</div>
                    </div>
                </div>

                <!-- Footer Stats -->
                <div class="d-flex justify-content-around text-center pt-2 border-top" style="font-size: 12px;">
                    <div>
                        <div style="color: #2c3e50;">Meetings:</div>
                        <div><span style="color: #2c3e50;">3</span> / <span style="color: red;">2 - 1</span></div>
                    </div>
                    <div>
                        <div style="color: #2c3e50;">Trys:</div>
                        <div style="color: #2c3e50;">3</div>
                    </div>
                    <div>
                        <div style="color: #2c3e50;">In Hold:</div>
                        <div style="color: orange;">1</div>
                    </div>
                    <div>
                        <div style="color: #2c3e50;">In delayed:</div>
                        <div style="color: red;">0</div>
                    </div>
                </div>
            </div>

            <!-- Rate the Developer -->
            <div class="mt-3 text-left" style="background: #f9f9fb; padding: 16px; border-radius: 16px;">
                <strong style="font-size: 13px;">Rate the Developer</strong>

                <!-- Rating Rows (No PHP) -->
                <div class="mt-2" style="font-size: 13px;">
                    <div class="d-flex align-items-center justify-content-between mb-2" style="background: #fff; padding: 9px;border-radius:10px;">
                        <span>Reliability</span>
                        <span>⭐⭐⭐☆☆</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2" style="background: #fff; padding: 9px;border-radius:10px;">
                        <span>Punctuality</span>
                        <span>⭐⭐⭐☆☆</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2" style="background: #fff; padding: 9px;border-radius:10px;">
                        <span>Accuracy</span>
                        <span>⭐⭐⭐☆☆</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2" style="background: #fff; padding: 9px;border-radius:10px;">
                        <span>Quality</span>
                        <span>⭐⭐⭐☆☆</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2" style="background: #fff; padding: 9px;border-radius:10px;">
                        <span>Work Independently</span>
                        <span>⭐⭐⭐☆☆</span>
                    </div>
                </div>
            </div>

            <!-- Modal Buttons -->
            <div class="d-flex justify-content-between mt-3">
                <button class="btn btn-light" data-bs-dismiss="modal" style="border-radius: 8px;">Close</button>
                <button class="btn btn-success" data-bs-dismiss="modal" style="border-radius: 8px;">Save & Close</button>
            </div>

        </div>
    </div>
</div>
<!-- moveToRejectModal Modal -->
<div class="modal fade" id="moveToRejectModal" tabindex="-1" aria-labelledby="moveToDoneLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content p-3" style="border-radius: 16px; background-color: #fdfdfd; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">

            <!-- Modal Header -->
            <h5 class=" mb-2" style="font-weight: 600;">Reject the Task</h5>

            <!-- Task Info Section -->
            <div style="background: #f9f9fb; padding: 16px; border-radius: 16px;">

                <!-- Task Title -->
                <div class="text-center mb-2">
                    <h5 style="font-weight: 700; color: #2c3e50;">Task Title</h5>
                </div>

                <!-- Task Badges -->
                <div class="text-center mb-3 d-flex justify-content-center flex-wrap gap-2">
                    <!-- Status -->
                    <span class="badge rounded-pill d-flex align-items-center gap-1" style="background-color: #f3c9e7; color: black; font-size: 13px; padding: 6px 10px;">
                        <img src="{{ URL::asset('/build/img/jamni.svg') }}" alt="Icon" style="width: 14px; height: 14px;">
                        Project is in Checking
                    </span>

                    <!-- Priority -->
                    <span class="badge rounded-pill d-flex align-items-center gap-1" style="background-color: #ff4d4d; color: white; font-size: 13px; padding: 6px 12px;">
                        <i class="bi bi-lightning-fill"></i> 01
                    </span>

                    <!-- Status Level -->
                    <span class="badge rounded-pill d-flex align-items-center gap-1" style="background-color: #f1fdf5; color: #22c55e; font-size: 13px; padding: 6px 12px;">
                        <i class="bi bi-circle-fill" style="font-size: 8px;"></i> Low
                    </span>
                </div>

                <!-- Task Meta Info Row -->
                <div class="d-flex justify-content-around text-center" style="font-size: 12px; font-weight: 500;">
                    <div style="color: #2c3e50;"><strong>Task ID</strong></div>
                    <div style="color: #2c3e50;"><strong>Section</strong></div>
                    <div><span style="color: #27ae60;">Start:</span> 22.10.2024</div>
                    <div><span style="color: #27ae60;">Deliver:</span> 22.10.2024</div>
                </div>

            </div>

            <!-- Try Section -->
            <div class="mt-3" style="background: #f9f9fb; padding: 12px 16px; border-radius: 12px; font-size: 13px;">

                <!-- Try Info -->
                <div class="d-flex justify-content-between align-items-center mb-3" style="font-weight: 500;background:#fff;padding:4px;border-radius:10px;">
                    <div>
                        <span style="color: #2c3e50;">Try #1 - </span>
                        <span style="color: #7f8ea3;">22.10.2024 - 12:30 ~ 12:55</span>
                    </div>

                    <!-- Rejected Reason -->
                    <div class="d-flex align-items-center" style="gap: 5px;">
                        <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Avatar" class="rounded-circle" style="width: 20px; height: 20px; object-fit: cover;">
                        <span style="color: #ff6699; font-weight: 500;">Rejected Reason here</span>
                    </div>
                </div>

                <!-- Timeline Statuses -->
                <div class="d-flex justify-content-between text-center" style="font-size: 12px; font-weight: 500;">

                    <!-- Started -->
                    <div style="width: 30%;">
                        <div class="d-flex align-items-center justify-content-center gap-1 mb-1">
                            <img src="{{ URL::asset('/build/img/profile.svg') }}" class="rounded-circle" style="width: 16px; height: 16px;">
                            <span style="color: #4caf50;">Started: 12:55</span>
                        </div>
                        <div style="height: 6px; background-color: #4caf50; border-radius: 10px;"></div>
                    </div>

                    <!-- In Checked -->
                    <div style="width: 30%;">
                        <div class="d-flex align-items-center justify-content-center gap-1 mb-1">
                            <img src="{{ URL::asset('/build/img/profile.svg') }}" class="rounded-circle" style="width: 16px; height: 16px;">
                            <span style="color: #9b59b6;">In Checked: 12:55</span>
                        </div>
                        <div style="height: 6px; background-color: #9b59b6; border-radius: 10px;"></div>
                    </div>

                    <!-- Rejected -->
                    <div style="width: 30%;">
                        <div class="d-flex align-items-center justify-content-center gap-1 mb-1">
                            <img src="{{ URL::asset('/build/img/profile.svg') }}" class="rounded-circle" style="width: 16px; height: 16px;">
                            <span style="color: #ec407a;">Rejected: 13:25</span>
                        </div>
                        <div style="height: 6px; background-color: #ec407a; border-radius: 10px;"></div>
                    </div>

                </div>
            </div>
            <!-- Try Section -->
            <div class="mt-3" style="background: #f9f9fb; padding: 12px 16px; border-radius: 12px; font-size: 13px;">

                <!-- Try Info -->
                <div class="d-flex justify-content-between align-items-center mb-3" style="font-weight: 500;background:#fff;padding:4px;border-radius:10px;">
                    <div>
                        <span style="color: #2c3e50;">Try #1 - </span>
                        <span style="color: #7f8ea3;">22.10.2024 - 12:30 ~ 12:55</span>
                    </div>

                    <!-- Rejected Reason -->
                    <div class="d-flex align-items-center" style="gap: 5px;">
                        <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Avatar" class="rounded-circle" style="width: 20px; height: 20px; object-fit: cover;">
                        <span style="color: #ff6699; font-weight: 500;">Rejected Reason here</span>
                    </div>
                </div>

                <!-- Timeline Statuses -->
                <div class="d-flex justify-content-between text-center" style="font-size: 12px; font-weight: 500;">

                    <!-- Started -->
                    <div style="width: 30%;">
                        <div class="d-flex align-items-center justify-content-center gap-1 mb-1">
                            <img src="{{ URL::asset('/build/img/profile.svg') }}" class="rounded-circle" style="width: 16px; height: 16px;">
                            <span style="color: #4caf50;">Started: 12:55</span>
                        </div>
                        <div style="height: 6px; background-color: #4caf50; border-radius: 10px;"></div>
                    </div>

                    <!-- In Checked -->
                    <div style="width: 30%;">
                        <div class="d-flex align-items-center justify-content-center gap-1 mb-1">
                            <img src="{{ URL::asset('/build/img/profile.svg') }}" class="rounded-circle" style="width: 16px; height: 16px;">
                            <span style="color: #9b59b6;">In Checked: 12:55</span>
                        </div>
                        <div style="height: 6px; background-color: #9b59b6; border-radius: 10px;"></div>
                    </div>

                    <!-- Rejected -->
                    <div style="width: 30%;">
                        <div class="d-flex align-items-center justify-content-center gap-1 mb-1">
                            <img src="{{ URL::asset('/build/img/profile.svg') }}" class="rounded-circle" style="width: 16px; height: 16px;">
                            <span style="color: #ec407a;">Rejected: 13:25</span>
                        </div>
                        <div style="height: 6px; background-color: #ec407a; border-radius: 10px;"></div>
                    </div>

                </div>
            </div>
            <!-- Try Section -->
            <div class="mt-3" style="background: #f9f9fb; padding: 12px 16px; border-radius: 12px; font-size: 13px;">

                <!-- Try Info -->
                <div class="d-flex justify-content-between align-items-center mb-3" style="font-weight: 500;background:#fff;padding:4px;border-radius:10px;">
                    <div>
                        <span style="color: #2c3e50;">Try #1 - </span>
                        <span style="color: #7f8ea3;">22.10.2024 - 12:30 ~ 12:55</span>
                    </div>

                    <!-- Rejected Reason -->
                    <div class="d-flex align-items-center" style="gap: 5px;">
                        <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Avatar" class="rounded-circle" style="width: 20px; height: 20px; object-fit: cover;">
                        <span style="color: #ff6699; font-weight: 500;">Rejected Reason here</span>
                    </div>
                </div>

                <!-- Timeline Statuses -->
                <div class="d-flex justify-content-between text-center" style="font-size: 12px; font-weight: 500;">

                    <!-- Started -->
                    <div style="width: 30%;">
                        <div class="d-flex align-items-center justify-content-center gap-1 mb-1">
                            <img src="{{ URL::asset('/build/img/profile.svg') }}" class="rounded-circle" style="width: 16px; height: 16px;">
                            <span style="color: #4caf50;">Started: 12:55</span>
                        </div>
                        <div style="height: 6px; background-color: #4caf50; border-radius: 10px;"></div>
                    </div>

                    <!-- In Checked -->
                    <div style="width: 30%;">
                        <div class="d-flex align-items-center justify-content-center gap-1 mb-1">
                            <img src="{{ URL::asset('/build/img/profile.svg') }}" class="rounded-circle" style="width: 16px; height: 16px;">
                            <span style="color: #9b59b6;">In Checked: 12:55</span>
                        </div>
                        <div style="height: 6px; background-color: #9b59b6; border-radius: 10px;"></div>
                    </div>

                    <!-- Rejected -->
                    <div style="width: 30%;">
                        <div class="d-flex align-items-center justify-content-center gap-1 mb-1">
                            <img src="{{ URL::asset('/build/img/profile.svg') }}" class="rounded-circle" style="width: 16px; height: 16px;">
                            <span style="color: #ec407a;">Rejected: 13:25</span>
                        </div>
                        <div style="height: 6px; background-color: #ec407a; border-radius: 10px;"></div>
                    </div>

                </div>
            </div>
            <!-- Reject Reason Section -->
            <div class="mt-4 p-3" style="background: #f9f9fb; border-radius: 12px;">

                <!-- Title -->
                <div class="text-center mb-2" style="color: #2c3e50; font-weight: 600; font-size: 15px;">
                    Please select the reason to Reject the Task
                </div>

                <!-- Dropdown -->
                <div class="text-center mb-3">
                    <select class="form-select text-center"
                        id="reasonSelect"
                        onchange="document.getElementById('otherReason').style.display = this.value === 'Other' ? 'block' : 'none';"
                        style="max-width: 300px; margin: auto; background-color: #f1f1f1; border: none; border-radius: 8px; padding: 10px 12px; color: #7f8ea3; font-weight: 500; font-size: 14px;">
                        <option selected disabled>Select the reason</option>
                        <option value="Incomplete">Incomplete Work</option>
                        <option value="Wrong">Wrong Implementation</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <!-- Conditional Input -->
                <div id="otherReason" style="display: none;">
                    <label style="font-size: 13px; color: #2c3e50;">Describe the issue</label>
                    <textarea class="form-control mb-3" placeholder="Describe the issue"
                        style="border-radius: 8px; background: white; resize: none;"></textarea>
                </div>

                <!-- Upload Boxes -->
                <div class="d-flex justify-content-between flex-wrap gap-2">
                    <!-- Upload 1 -->
                    <div style="flex: 1; min-width: 100px; text-align: center;">
                        <label style="cursor: pointer;">
                            <input type="file" accept="image/*,video/*,.pdf" style="display: none;"
                                onchange="previewFile(this, 'preview1')">
                            <div style="background: white; border-radius: 8px; padding: 16px;">
                                <div id="preview1" style="font-size: 24px; color: #888;">+</div>
                                <div style="font-size: 11px; color: #7f8ea3;">MP4 - JPG - PDF - PNG</div>
                            </div>
                        </label>
                    </div>

                    <!-- Upload 2 -->
                    <div style="flex: 1; min-width: 100px; text-align: center;">
                        <label style="cursor: pointer;">
                            <input type="file" accept="image/*,video/*,.pdf" style="display: none;"
                                onchange="previewFile(this, 'preview2')">
                            <div style="background: white; border-radius: 8px; padding: 16px;">
                                <div id="preview2" style="font-size: 24px; color: #888;">+</div>
                                <div style="font-size: 11px; color: #7f8ea3;">MP4 - JPG - PDF - PNG</div>
                            </div>
                        </label>
                    </div>

                    <!-- Upload 3 -->
                    <div style="flex: 1; min-width: 100px; text-align: center;">
                        <label style="cursor: pointer;">
                            <input type="file" accept="image/*,video/*,.pdf" style="display: none;"
                                onchange="previewFile(this, 'preview3')">
                            <div style="background: white; border-radius: 8px; padding: 16px;">
                                <div id="preview3" style="font-size: 24px; color: #888;">+</div>
                                <div style="font-size: 11px; color: #7f8ea3;">MP4 - JPG - PDF - PNG</div>
                            </div>
                        </label>
                    </div>
                </div>

            </div>
            <div class="d-flex justify-content-center gap-3" style="background-color: #f2f2f2; padding: 12px; border-radius: 12px;">
                <button type="button" class="btn"
                    style="background-color: #f2f2f2; color: #8a9aa7; border: none; font-weight: 600; padding: 8px 20px; border-radius: 8px;"
                    data-bs-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn"
                    style="background-color: #f2f2f2; color: #8a9aa7; border: none; font-weight: 600; padding: 8px 20px; border-radius: 8px;" data-bs-dismiss="modal">
                    Save & Close
                </button>
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
                <h5 class="modal-title" id="pauseModalLabel" style="margin: 0; font-weight: 600; color: #1c2b48;">Remove the Task</h5>
            </div>

            <!-- Body -->
            <div class="modal-body" style="text-align: center; padding: 30px 20px 20px;">
                <!-- Warning Message -->
                <div style="background-color: #fff;border: 1px solid #f1f1f1;color: #f44336;font-size: 14px;font-weight: 500;text-align: center;display: flex;align-items: center;justify-content: center;gap: 30px;width: fit-content;padding: 6px 12px;border-radius: 6px;margin: 0 auto 15px;margin-bottom: 15px;">
                    <img src="{{ asset('build/img/tera.svg') }}" alt="Pause Icon" width="15" height="15">
                    Task can't be Removed if there Open Tickets
                </div>

                <!-- Icon -->
                <div style="background-color: #f44336; width: 60px; height: 60px; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
                    <img src="{{ asset('build/img/deletep.svg') }}" alt="Pause Icon" width="28" height="28">
                </div>

                <!-- Text -->
                <p style="font-size: 16px; font-weight: 500; color: #1c2b48;">Please select the reason to remove the </p>

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
<script>
    function previewFile(input, previewId) {
        const file = input.files[0];
        const preview = document.getElementById(previewId);

        if (file) {
            const type = file.type;

            if (type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.innerHTML = `<img src="${e.target.result}" style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px;">`;
                };
                reader.readAsDataURL(file);
            } else if (type.startsWith('video/')) {
                preview.innerHTML = `🎥 ${file.name}`;
            } else if (type === 'application/pdf') {
                preview.innerHTML = `📄 ${file.name}`;
            } else {
                preview.innerHTML = `📎 ${file.name}`;
            }
        } else {
            preview.innerHTML = '+';
        }
    }
</script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->
@component('components.model-popup')
@endcomponent
@endsection