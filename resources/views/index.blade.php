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

    <div style="visibility: visible;">
        @include('Chats.chatsidebar')
    </div>

    <div class="chat chat-messages show" id="middle" style="overflow-y: hidden;">
        <div>
            <div class="chat-header">
                <div class="user-details">
                    <div class="d-xl-none">
                        <a class="text-muted chat-close me-2" href="#">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                    <div class="avatar avatar-lg online" style="visibility: visible;">
                        <img src="{{ asset('build/img/groups/group-01.jpg') }}" class="rounded-circle" alt="image">

                    </div>
                    <div class="d-flex align-items-center">
                        <!-- Image -->
                        <img src="{{ asset('build/img/groups/group-01.jpg') }}" style="width: 50px; height: 50px;margin-left:30px;" class="rounded-circle me-3" alt="User Image">

                        <!-- Username and Status -->
                        <div class="overflow-hidden">
                            <h6 class="mb-0">Username</h6>
                            <p class="last-seen text-truncate mb-0">Online</p>
                        </div>
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
            <div style="overflow-y: auto;flex:1;height: 90vh;">
                <div class="chat-body chat-page-group">
                    <!-- Header -->
                    <!-- Main Layout -->
                    <div class="container-fluid mt-3" style="padding-left: 85px;">

                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-lg-9">
                                <div class="container-fluid" style="background:#f8f9fb;border-radius: 12px; padding: 12px 20px;">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="col-md-8 d-flex align-items-center">
                                            <img src="{{ asset('build/img/groups/group-01.jpg') }}" style="width: 50px; height: 50px;" class="rounded-circle me-3" alt="User Image">
                                            <div>
                                                <h6 style="margin:0;">Welcome Back, <b>Admin Name</b></h6>
                                                <small>
                                                    Dear <b>"Admin name"</b> u have for today
                                                    <span style="color:red; font-weight:600;">12 Messages</span>,
                                                    and <span style="color:#e75480; font-weight:600;">5 Meetings</span>,
                                                    and <span style="color:#e75480; font-weight:600;">3 ToDo’s</span>,
                                                    and <span style="color:#d9534f; font-weight:600;">3 Private Tasks</span>.
                                                </small>
                                            </div>
                                        </div>

                                        <!-- Right Side Buttons -->
                                        <div class="col-md-4 d-flex justify-content-end" style="margin-top:-26px">
                                            <button class="btn btn-primary btn-sm me-2">+ Add Project</button>
                                            <button class="btn btn-danger btn-sm me-2">+ Add ToDo’s</button>
                                            <button class="btn btn-success btn-sm">+ Add Meeting</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Our Projects -->
                                <div style="background-color: #f4f6f8; padding: 24px; border-radius: 12px;margin-top:9px;padding-left: 26px;padding-right: 26px;padding-bottom: 0px;">
                                    <div class="row g-4">
                                        <div>
                                            <h3 class="pb-1 ps-2" style="font-weight: 600;">Our Projects</h3>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card shadow-sm  p-3" style="border-radius: 20px; font-family:    'Segoe UI', sans-serif;">

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


                                                <!-- Project Title -->
                                                <!-- Project Title & Project ID -->
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
                                                    <!-- Red Flag with soft red background -->
                                                    <div style="background: #fddede; border-radius: 12px; display: inline-flex; align-items: center; justify-content: center; padding: 4px 10px;">
                                                        <img src="{{URL::asset('/build/img/redflag.svg')}}" style="height: 16px; width: 16px;" alt="flag" />
                                                    </div>

                                                    <!-- Status with green dot and soft gray/green background -->
                                                    <div style="background: #f1f3f4; border-radius: 12px; display: inline-flex; align-items: center; gap: 6px; padding: 4px 12px;">
                                                        <span style="width: 10px; height: 10px; border-radius: 50%; background: #28c76f; display: inline-block;"></span>
                                                        <span style="color: #4b5c74; font-weight: 500; font-size: 13px;">Low</span>
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


                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card shadow-sm  p-3" style="border-radius: 20px; font-family:    'Segoe UI', sans-serif;">

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


                                                <!-- Project Title -->
                                                <!-- Project Title & Project ID -->
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
                                                    <!-- Red Flag with soft red background -->
                                                    <div style="background: #fddede; border-radius: 12px; display: inline-flex; align-items: center; justify-content: center; padding: 4px 10px;">
                                                        <img src="{{URL::asset('/build/img/redflag.svg')}}" style="height: 16px; width: 16px;" alt="flag" />
                                                    </div>

                                                    <!-- Status with green dot and soft gray/green background -->
                                                    <div style="background: #f1f3f4; border-radius: 12px; display: inline-flex; align-items: center; gap: 6px; padding: 4px 12px;">
                                                        <span style="width: 10px; height: 10px; border-radius: 50%; background: #28c76f; display: inline-block;"></span>
                                                        <span style="color: #4b5c74; font-weight: 500; font-size: 13px;">Low</span>
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


                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card shadow-sm  p-3" style="border-radius: 20px; font-family:    'Segoe UI', sans-serif;">

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


                                                <!-- Project Title -->
                                                <!-- Project Title & Project ID -->
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
                                                    <!-- Red Flag with soft red background -->
                                                    <div style="background: #fddede; border-radius: 12px; display: inline-flex; align-items: center; justify-content: center; padding: 4px 10px;">
                                                        <img src="{{URL::asset('/build/img/redflag.svg')}}" style="height: 16px; width: 16px;" alt="flag" />
                                                    </div>

                                                    <!-- Status with green dot and soft gray/green background -->
                                                    <div style="background: #f1f3f4; border-radius: 12px; display: inline-flex; align-items: center; gap: 6px; padding: 4px 12px;">
                                                        <span style="width: 10px; height: 10px; border-radius: 50%; background: #28c76f; display: inline-block;"></span>
                                                        <span style="color: #4b5c74; font-weight: 500; font-size: 13px;">Low</span>
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


                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- Calendar + Clock -->
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="card p-4" style="border-radius:16px; background:#f4f4f4;">

                                            <!-- Top Date and Time -->
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                    <h1 style="font-size:64px; font-weight:700; margin:0; color:#0f1b3d;">10</h1>
                                                    <p style="font-size:24px; font-weight:600; margin:-10px 0 0; color:#0f1b3d;">Sep 2025</p>
                                                </div>
                                                <div style="font-size:24px; font-weight:500; color:#0f1b3d;" id="clock">
                                                    <script>
                                                        document.write(new Date().toLocaleTimeString('en-GB'));
                                                        setInterval(function() {
                                                            document.getElementById('clock').innerText = new Date().toLocaleTimeString('en-GB');
                                                        }, 1000);
                                                    </script>
                                                </div>
                                            </div>

                                            <!-- Calendar Days -->
                                            <div class="d-flex align-items-center mt-4 px-1" style="overflow-x:auto; gap:12px;">

                                                <!-- Active Day -->
                                                <div style="text-align:center; background:#ff3d3d; color:white; border-radius:16px; width:60px; padding:10px;">
                                                    <div style="font-weight:600;">Mon</div>
                                                    <div style="font-size:18px;">10</div>
                                                </div>

                                                <!-- Other Days -->
                                                <div style="text-align:center; background:#ffffff; color:#000; border-radius:16px; width:60px; padding:10px;">
                                                    <div style="font-weight:600;">Tue</div>
                                                    <div style="font-size:18px;">11</div>
                                                </div>
                                                <div style="text-align:center; background:#ffffff; color:#000; border-radius:16px; width:60px; padding:10px;">
                                                    <div style="font-weight:600;">Wed</div>
                                                    <div style="font-size:18px;">12</div>
                                                </div>
                                                <div style="text-align:center; background:#ffffff; color:#000; border-radius:16px; width:60px; padding:10px;">
                                                    <div style="font-weight:600;">Thu</div>
                                                    <div style="font-size:18px;">13</div>
                                                </div>
                                                <div style="text-align:center; background:#ffffff; color:#000; border-radius:16px; width:60px; padding:10px;">
                                                    <div style="font-weight:600;">Fri</div>
                                                    <div style="font-size:18px;">14</div>
                                                </div>
                                                <div style="text-align:center; background:#ffffff; color:#000; border-radius:16px; width:60px; padding:10px;">
                                                    <div style="font-weight:600;">Sat</div>
                                                    <div style="font-size:18px;">15</div>
                                                </div>
                                                <div style="text-align:center; background:#ffffff; color:#000; border-radius:16px; width:60px; padding:10px;">
                                                    <div style="font-weight:600;">Sun</div>
                                                    <div style="font-size:18px;">17</div>
                                                </div>
                                                <div style="text-align:center; background:#ffffff; color:#000; border-radius:16px; width:60px; padding:10px;">
                                                    <div style="font-weight:600;">Mon</div>
                                                    <div style="font-size:18px;">18</div>
                                                </div>
                                                <div style="text-align:center; background:#ffffff; color:#000; border-radius:16px; width:60px; padding:10px;">
                                                    <div style="font-weight:600;">Tue</div>
                                                    <div style="font-size:18px;">19</div>
                                                </div>
                                            </div>

                                            <!-- Buttons -->
                                            <div class="d-flex justify-content-end mt-4 gap-2">
                                                <button style="background:#00c389; border:none; border-radius:8px; padding:5px 15px; color:white;">All</button>
                                                <button style="background:#ffffff; border:none; border-radius:8px; padding:5px 15px;">Meeting</button>
                                                <button style="background:#ffffff; border:none; border-radius:8px; padding:5px 15px;">ToDo’s</button>
                                            </div>
                                            <div class="card p-3" style="border-radius:16px; background:#f6f9fc;">

                                                <!-- Top Row -->
                                                <div class="d-flex justify-content-between align-items-start flex-wrap">

                                                    <!-- Left: Title and Info -->
                                                    <div class="d-flex flex-column flex-grow-1" style="min-width:250px;">
                                                        <!-- Title Row -->
                                                        <div class="d-flex align-items-center mb-2">
                                                            <img src="https://via.placeholder.com/35" style="border-radius:50%; width:35px; height:35px; object-fit:cover; margin-right:10px;">
                                                            <div>
                                                                <div style="font-weight:600; color:#0f1b3d;">Title of Meeting</div>
                                                                <div style="font-size:13px; color:#888;">Username</div>
                                                            </div>
                                                        </div>

                                                        <!-- Project Row -->
                                                        <div class="d-flex align-items-center mb-2">
                                                            <img src="https://via.placeholder.com/24x24.png?text=📁" style="width:24px; height:24px; margin-right:8px;">
                                                            <div>
                                                                <div style="font-weight:600; font-size:14px;">Project Title</div>
                                                                <div style="font-size:12px; color:#999;">1 Oct 25</div>
                                                            </div>
                                                        </div>

                                                        <!-- Description -->
                                                        <div style="font-size:14px; color:#333; margin-bottom:10px;">
                                                            Here we will add the description of the ToDo. Only <br>
                                                            you is Super admin ToDo.
                                                        </div>

                                                        <!-- Tags Row -->
                                                        <div class="d-flex align-items-center gap-2 flex-wrap">
                                                            <button style="background:#ffd5d5; color:red; border:none; font-size:13px; border-radius:6px; padding:2px 10px;">🔴</button>
                                                            <button style="background:#ffd5d5; color:red; border:none; font-size:13px; border-radius:6px; padding:2px 10px;">Now</button>
                                                            <button style="background:#ffe9e9; color:#cc0000; border:none; font-size:13px; border-radius:6px; padding:2px 10px;">17:00 - 18:00</button>
                                                        </div>
                                                    </div>

                                                    <!-- Right: Actions and Avatars -->
                                                    <div class="d-flex flex-column align-items-end justify-content-between" style="gap:10px;">
                                                        <!-- Zoom Meeting Button -->
                                                        <button style="background:#007bff; color:#fff; border:none; border-radius:6px; padding:5px 10px; font-size:13px;">Zoom Meeting</button>

                                                        <!-- Avatars -->
                                                        <div class="d-flex align-items-center justify-content-end mt-2" style="gap:-10px;">
                                                            <img src="https://via.placeholder.com/30" style="border-radius:50%; border:2px solid #fff; width:30px; height:30px; object-fit:cover;">
                                                            <img src="https://via.placeholder.com/30" style="border-radius:50%; border:2px solid #fff; width:30px; height:30px; object-fit:cover;">
                                                            <img src="https://via.placeholder.com/30" style="border-radius:50%; border:2px solid #fff; width:30px; height:30px; object-fit:cover;">
                                                            <img src="https://via.placeholder.com/30" style="border-radius:50%; border:2px solid #fff; width:30px; height:30px; object-fit:cover;">
                                                        </div>

                                                        <!-- Join Button -->
                                                        <button style="background:#00c389; color:white; border:none; font-size:13px; border-radius:6px; padding:5px 15px;">Join now ✅</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- 2 -->
                                    <div class="col-md-6">
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
                                    <!-- 3 -->

                                </div>

                            </div>

                            <!-- Right Column -->
                            <div class="col-lg-3">
                                <div style="background-color: #f4f6f8; padding: 20px; border-radius: 14px;">
                                    <!-- White card -->
                                    <h5 style="font-weight: 600; color: #1a1a3c; margin-bottom: 16px;">System Logs</h5>
                                    <div class="p-3 mb-2" style="background: #ffffff; border-radius: 12px; font-family: 'Segoe UI', sans-serif;">

                                        <div class="d-flex justify-content-start gap-2 w-100 text-center" style="font-size: 11px; font-weight: 500; color: #4b5c74;">
                                            <img src="{{ asset('build/img/groups/group-01.jpg') }}" alt="User" style="width: 40px; height: 40px; border-radius: 50%;">
                                            <div>
                                                <div style="color: #1d6fa5;">Login Date</div>
                                                <div style="font-size: 13px;">DD.MM.YYYY</div>
                                            </div>
                                            <div>
                                                <div style="color: #1d6fa5;">Login Time</div>
                                                <div style="font-size: 13px;">HH:MM</div>
                                            </div>
                                            <div>
                                                <div style="color: #1d6fa5;">Logout</div>
                                                <div style="font-size: 13px;">HH:MM</div>
                                            </div>
                                            <div>
                                                <div style="color: #1d6fa5;">Total</div>
                                                <div style="font-size: 13px;">HH:MM</div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="p-3 mb-2" style="background: #ffffff; border-radius: 12px; font-family: 'Segoe UI', sans-serif;">

                                        <div class="d-flex justify-content-start gap-2 w-100 text-center" style="font-size: 11px; font-weight: 500; color: #4b5c74;">
                                            <img src="{{ asset('build/img/groups/group-01.jpg') }}" alt="User" style="width: 40px; height: 40px; border-radius: 50%;">
                                            <div>
                                                <div style="color: #1d6fa5;">Login Date</div>
                                                <div style="font-size: 13px;">DD.MM.YYYY</div>
                                            </div>
                                            <div>
                                                <div style="color: #1d6fa5;">Login Time</div>
                                                <div style="font-size: 13px;">HH:MM</div>
                                            </div>
                                            <div>
                                                <div style="color: #1d6fa5;">Logout</div>
                                                <div style="font-size: 13px;">HH:MM</div>
                                            </div>
                                            <div>
                                                <div style="color: #1d6fa5;">Total</div>
                                                <div style="font-size: 13px;">HH:MM</div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="p-3 mb-2" style="background: #ffffff; border-radius: 12px; font-family: 'Segoe UI', sans-serif;">

                                        <div class="d-flex justify-content-start gap-2 w-100 text-center" style="font-size: 11px; font-weight: 500; color: #4b5c74;">
                                            <img src="{{ asset('build/img/groups/group-01.jpg') }}" alt="User" style="width: 40px; height: 40px; border-radius: 50%;">
                                            <div>
                                                <div style="color: #1d6fa5;">Login Date</div>
                                                <div style="font-size: 13px;">DD.MM.YYYY</div>
                                            </div>
                                            <div>
                                                <div style="color: #1d6fa5;">Login Time</div>
                                                <div style="font-size: 13px;">HH:MM</div>
                                            </div>
                                            <div>
                                                <div style="color: #1d6fa5;">Logout</div>
                                                <div style="font-size: 13px;">HH:MM</div>
                                            </div>
                                            <div>
                                                <div style="color: #1d6fa5;">Total</div>
                                                <div style="font-size: 13px;">HH:MM</div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="p-3 mb-2" style="background: #ffffff; border-radius: 12px; font-family: 'Segoe UI', sans-serif;">

                                        <div class="d-flex justify-content-start gap-2 w-100 text-center" style="font-size: 11px; font-weight: 500; color: #4b5c74;">
                                            <img src="{{ asset('build/img/groups/group-01.jpg') }}" alt="User" style="width: 40px; height: 40px; border-radius: 50%;">
                                            <div>
                                                <div style="color: #1d6fa5;">Login Date</div>
                                                <div style="font-size: 13px;">DD.MM.YYYY</div>
                                            </div>
                                            <div>
                                                <div style="color: #1d6fa5;">Login Time</div>
                                                <div style="font-size: 13px;">HH:MM</div>
                                            </div>
                                            <div>
                                                <div style="color: #1d6fa5;">Logout</div>
                                                <div style="font-size: 13px;">HH:MM</div>
                                            </div>
                                            <div>
                                                <div style="color: #1d6fa5;">Total</div>
                                                <div style="font-size: 13px;">HH:MM</div>
                                            </div>
                                        </div>

                                    </div>

                                </div>


                                <!-- Team -->
                                <div style="font-family: 'Segoe UI', sans-serif; background-color: #f8f9fa; padding: 20px; border-radius: 12px; margin-top:10px;padding-bottom:0px">
                                    <h6 class="mb-3" style="font-weight: 600; color: #2e3a59; font-size: 16px;">· Our Team ·</h6>

                                    <div class="row d-flex no-wrap pb-3">
                                        <!-- CARD 1 - Green Border -->
                                        <!-- CARD 1 -->
                                        <div class="col-4 mb-2">
                                            <div class="card text-center" style="border-radius: 16px; border: none; overflow: hidden; background: #ffffff; box-shadow: 0 2px 6px rgba(0,0,0,0.05); width: 110px; margin: auto;">
                                                <div style="position: relative; height: 50px; overflow: hidden; border-top-left-radius: 16px; border-top-right-radius: 16px;">
                                                    <img src="{{ URL::asset('/build/img/bgractangle.svg') }}" alt="Background" style="width: 100%; height: 100%; object-fit: cover;">
                                                </div>
                                                <div style="position: relative; margin-top: -20px;">
                                                    <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile"
                                                        class="rounded-circle border border-white border-2"
                                                        style="width: 40px; height: 40px; object-fit: cover; border: 2px solid limegreen;">
                                                </div>
                                                <div class="card-body p-2">
                                                    <h6 class="card-title mb-1" style="font-weight: 600; font-size: 11px; color: #000;">Name Lastname</h6>
                                                    <p class="mb-0" style="color: #7f8ea3; font-size: 10px;">Admin</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4  mb-2">
                                            <div class="card text-center" style="border-radius: 16px; border: none; overflow: hidden; background: #ffffff; box-shadow: 0 2px 6px rgba(0,0,0,0.05); width: 110px; margin: auto;">
                                                <div style="position: relative; height: 50px; overflow: hidden; border-top-left-radius: 16px; border-top-right-radius: 16px;">
                                                    <img src="{{ URL::asset('/build/img/bgractangle.svg') }}" alt="Background" style="width: 100%; height: 100%; object-fit: cover;">
                                                </div>
                                                <div style="position: relative; margin-top: -20px;">
                                                    <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile"
                                                        class="rounded-circle border border-white border-2"
                                                        style="width: 40px; height: 40px; object-fit: cover; border: 2px solid limegreen;">
                                                </div>
                                                <div class="card-body p-2">
                                                    <h6 class="card-title mb-1" style="font-weight: 600; font-size: 11px; color: #000;">Name Lastname</h6>
                                                    <p class="mb-0" style="color: #7f8ea3; font-size: 10px;">Admin</p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- CARD 2 -->
                                        <div class="col-4  mb-2">
                                            <div class="card text-center" style="border-radius: 16px; border: none; overflow: hidden; background: #ffffff; box-shadow: 0 2px 6px rgba(0,0,0,0.05); width: 110px; margin: auto;">
                                                <div style="position: relative; height: 50px; overflow: hidden; border-top-left-radius: 16px; border-top-right-radius: 16px;">
                                                    <img src="{{ URL::asset('/build/img/bgractangle.svg') }}" alt="Background" style="width: 100%; height: 100%; object-fit: cover;">
                                                </div>
                                                <div style="position: relative; margin-top: -20px;">
                                                    <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile"
                                                        class="rounded-circle border border-white border-2"
                                                        style="width: 40px; height: 40px; object-fit: cover; border: 2px solid gold;">
                                                </div>
                                                <div class="card-body p-2">
                                                    <h6 class="card-title mb-1" style="font-weight: 600; font-size: 11px; color: #000;">Name Lastname</h6>
                                                    <p class="mb-0" style="color: #7f8ea3; font-size: 10px;">Subadmin</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- seprater -->
                                    <div style="display: flex; justify-content: center; margin-bottom:20px">
                                        <div style="width: 100px;height: 4px;background: #ccc;border-radius: 10px;"></div>
                                    </div>
                                    <!-- row 2 -->
                                    <div class="row d-flex no-wrap pb-3">
                                        <!-- CARD 1 - Green Border -->
                                        <!-- CARD 1 -->
                                        <div class="col-4 mb-2">
                                            <div class="card text-center" style="border-radius: 16px; border: none; overflow: hidden; background: #ffffff; box-shadow: 0 2px 6px rgba(0,0,0,0.05); width: 110px; margin: auto;">
                                                <div style="position: relative; height: 50px; overflow: hidden; border-top-left-radius: 16px; border-top-right-radius: 16px;">
                                                    <img src="{{ URL::asset('/build/img/bgractangle.svg') }}" alt="Background" style="width: 100%; height: 100%; object-fit: cover;">
                                                </div>
                                                <div style="position: relative; margin-top: -20px;">
                                                    <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile"
                                                        class="rounded-circle border border-white border-2"
                                                        style="width: 40px; height: 40px; object-fit: cover; border: 2px solid limegreen;">
                                                </div>
                                                <div class="card-body p-2">
                                                    <h6 class="card-title mb-1" style="font-weight: 600; font-size: 11px; color: #000;">Name Lastname</h6>
                                                    <p class="mb-0" style="color: #7f8ea3; font-size: 10px;">Admin</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4  mb-2">
                                            <div class="card text-center" style="border-radius: 16px; border: none; overflow: hidden; background: #ffffff; box-shadow: 0 2px 6px rgba(0,0,0,0.05); width: 110px; margin: auto;">
                                                <div style="position: relative; height: 50px; overflow: hidden; border-top-left-radius: 16px; border-top-right-radius: 16px;">
                                                    <img src="{{ URL::asset('/build/img/bgractangle.svg') }}" alt="Background" style="width: 100%; height: 100%; object-fit: cover;">
                                                </div>
                                                <div style="position: relative; margin-top: -20px;">
                                                    <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile"
                                                        class="rounded-circle border border-white border-2"
                                                        style="width: 40px; height: 40px; object-fit: cover; border: 2px solid limegreen;">
                                                </div>
                                                <div class="card-body p-2">
                                                    <h6 class="card-title mb-1" style="font-weight: 600; font-size: 11px; color: #000;">Name Lastname</h6>
                                                    <p class="mb-0" style="color: #7f8ea3; font-size: 10px;">Admin</p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- CARD 2 -->
                                        <div class="col-4  mb-2">
                                            <div class="card text-center" style="border-radius: 16px; border: none; overflow: hidden; background: #ffffff; box-shadow: 0 2px 6px rgba(0,0,0,0.05); width: 110px; margin: auto;">
                                                <div style="position: relative; height: 50px; overflow: hidden; border-top-left-radius: 16px; border-top-right-radius: 16px;">
                                                    <img src="{{ URL::asset('/build/img/bgractangle.svg') }}" alt="Background" style="width: 100%; height: 100%; object-fit: cover;">
                                                </div>
                                                <div style="position: relative; margin-top: -20px;">
                                                    <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile"
                                                        class="rounded-circle border border-white border-2"
                                                        style="width: 40px; height: 40px; object-fit: cover; border: 2px solid gold;">
                                                </div>
                                                <div class="card-body p-2">
                                                    <h6 class="card-title mb-1" style="font-weight: 600; font-size: 11px; color: #000;">Name Lastname</h6>
                                                    <p class="mb-0" style="color: #7f8ea3; font-size: 10px;">Subadmin</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- seprater -->
                                    <div style="display: flex; justify-content: center; margin-bottom:20px">
                                        <div style="width: 100px;height: 4px;background: #ccc;border-radius: 10px;"></div>
                                    </div>
                                    <!-- row 3 -->
                                    <div class="row d-flex no-wrap pb-3">
                                        <!-- CARD 1 - Green Border -->
                                        <!-- CARD 1 -->
                                        <div class="col-4 mb-2">
                                            <div class="card text-center" style="border-radius: 16px; border: none; overflow: hidden; background: #ffffff; box-shadow: 0 2px 6px rgba(0,0,0,0.05); width: 110px; margin: auto;">
                                                <div style="position: relative; height: 50px; overflow: hidden; border-top-left-radius: 16px; border-top-right-radius: 16px;">
                                                    <img src="{{ URL::asset('/build/img/bgractangle.svg') }}" alt="Background" style="width: 100%; height: 100%; object-fit: cover;">
                                                </div>
                                                <div style="position: relative; margin-top: -20px;">
                                                    <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile"
                                                        class="rounded-circle border border-white border-2"
                                                        style="width: 40px; height: 40px; object-fit: cover; border: 2px solid limegreen;">
                                                </div>
                                                <div class="card-body p-2">
                                                    <h6 class="card-title mb-1" style="font-weight: 600; font-size: 11px; color: #000;">Name Lastname</h6>
                                                    <p class="mb-0" style="color: #7f8ea3; font-size: 10px;">Admin</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4  mb-2">
                                            <div class="card text-center" style="border-radius: 16px; border: none; overflow: hidden; background: #ffffff; box-shadow: 0 2px 6px rgba(0,0,0,0.05); width: 110px; margin: auto;">
                                                <div style="position: relative; height: 50px; overflow: hidden; border-top-left-radius: 16px; border-top-right-radius: 16px;">
                                                    <img src="{{ URL::asset('/build/img/bgractangle.svg') }}" alt="Background" style="width: 100%; height: 100%; object-fit: cover;">
                                                </div>
                                                <div style="position: relative; margin-top: -20px;">
                                                    <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile"
                                                        class="rounded-circle border border-white border-2"
                                                        style="width: 40px; height: 40px; object-fit: cover; border: 2px solid limegreen;">
                                                </div>
                                                <div class="card-body p-2">
                                                    <h6 class="card-title mb-1" style="font-weight: 600; font-size: 11px; color: #000;">Name Lastname</h6>
                                                    <p class="mb-0" style="color: #7f8ea3; font-size: 10px;">Admin</p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- CARD 2 -->
                                        <div class="col-4  mb-2">
                                            <div class="card text-center" style="border-radius: 16px; border: none; overflow: hidden; background: #ffffff; box-shadow: 0 2px 6px rgba(0,0,0,0.05); width: 110px; margin: auto;">
                                                <div style="position: relative; height: 50px; overflow: hidden; border-top-left-radius: 16px; border-top-right-radius: 16px;">
                                                    <img src="{{ URL::asset('/build/img/bgractangle.svg') }}" alt="Background" style="width: 100%; height: 100%; object-fit: cover;">
                                                </div>
                                                <div style="position: relative; margin-top: -20px;">
                                                    <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile"
                                                        class="rounded-circle border border-white border-2"
                                                        style="width: 40px; height: 40px; object-fit: cover; border: 2px solid gold;">
                                                </div>
                                                <div class="card-body p-2">
                                                    <h6 class="card-title mb-1" style="font-weight: 600; font-size: 11px; color: #000;">Name Lastname</h6>
                                                    <p class="mb-0" style="color: #7f8ea3; font-size: 10px;">Subadmin</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- seprater -->



                                </div>


                            </div>

                        </div>
                    </div>

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
@endsection