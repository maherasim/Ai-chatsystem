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
                                <div class="container-fluid" style="background:#f8f9fb; border-radius: 12px; padding: 12px 20px;">
                                    <div class="row align-items-center">
                                        <!-- Welcome Section -->
                                        <div class="col-12 col-md-8 d-flex align-items-start mb-3 mb-md-0">
                                            <img src="{{ asset('build/img/groups/group-01.jpg') }}" style="width: 50px; height: 50px;" class="rounded-circle me-3" alt="User Image">
                                            <div>
                                                <h6 class="mb-1">Welcome Back, <b>Admin Name</b></h6>
                                                <small>
                                                    Dear <b>"Admin name"</b> you have for today
                                                    <span style="color:red; font-weight:600;">12 Messages</span>,
                                                    <span style="color:#e75480; font-weight:600;">5 Meetings</span>,
                                                    <span style="color:#e75480; font-weight:600;">3 ToDo’s</span>,
                                                    <span style="color:#d9534f; font-weight:600;">3 Private Tasks</span>.
                                                </small>
                                            </div>
                                        </div>

                                        <!-- Buttons -->
                                        <div class="col-12 col-md-4">
                                            <div class="d-flex flex-nowrap justify-content-md-end gap-2">
                                                <button class="btn btn-primary btn-sm">+ Add Project</button>
                                                <button class="btn btn-danger btn-sm">+ Add ToDo’s</button>
                                                <button class="btn btn-success btn-sm">+ Add Meeting</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Our Projects -->
                                <div style="background-color: #f4f6f8; padding: 24px; border-radius: 12px;margin-top:9px;padding-left: 26px;padding-right: 26px;padding-bottom: 0px;">
                                    <div class="row g-4">
                                        <div>
                                            <h3 class="pb-1 ps-2" style="font-weight: 600;">Our Projects</h3>
                                        </div>
                                        <div class="col-12 col-sm-6 col-lg-4">
                                            <div class="card shadow-sm  p-3" style="border-radius: 20px; font-family:'Segoe UI', sans-serif;">

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
                                                <div class="flex-grow-1  mt-1" style="background:#f8f9fa;border-radius:10px;">
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
                                        <div class="col-12 col-sm-6 col-lg-4">
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
                                                <div class="flex-grow-1  mt-1" style=" background:#f8f9fa;border-radius:10px;">
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
                                        <div class="col-12 col-sm-6 col-lg-4">
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
                                                <div class="flex-grow-1  mt-1" style="background:#f8f9fa;border-radius:10px;">
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
                                    <div class="col-12 col-sm-12 col-md-6">
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

                                            <!-- zoom meeting -->
                                            <div class="card p-3 mt-2 mb-2" style="border-radius:16px; background:#fff;">

                                                <!-- Top Row -->
                                                <div class="d-flex justify-content-between align-items-start flex-wrap mb-3">

                                                    <!-- Meeting Info -->
                                                    <div class="d-flex align-items-center me-3 mb-2">
                                                        <img src="{{ asset('build/img/groups/group-01.jpg') }}" style="border-radius:50%; width:35px; height:35px; object-fit:cover; margin-right:10px;">
                                                        <div>
                                                            <div style="font-weight:600; color:#0f1b3d;">Title of Meeting</div>
                                                            <div style="font-size:13px; color:#888;">Username</div>
                                                        </div>
                                                    </div>

                                                    <!-- Project Info -->
                                                    <div class="d-flex align-items-center me-3 mb-2">
                                                        <img src="{{URL::asset('/build/img/yekbon.svg')}}" style="width:34px; height:30px; margin-right:8px;">
                                                        <div>
                                                            <div style="font-weight:600; font-size:14px;">Project Title</div>
                                                            <div style="font-size:12px; color:#999;">Ticket ID</div>
                                                        </div>
                                                    </div>

                                                    <!-- Zoom Button -->
                                                    <div class="mb-2">
                                                        <button style="background:#007bff; color:#fff; border:none; border-radius:6px; padding:6px 12px; font-size:13px;">Zoom Meeting</button>
                                                    </div>
                                                </div>

                                                <!-- Row 2: Description + Avatars -->
                                                <div class="d-flex justify-content-between flex-wrap align-items-center mb-3">
                                                    <div style="font-size:14px; color:#333;">
                                                        Here we will add the description of the ToDo Only<br>
                                                        you is Superadmin ToDo
                                                    </div>
                                                    <div class="d-flex justify-content-center mt-1" style="margin-left: 10px;">
                                                        <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}"
                                                            style="height: 30px; width: 30px; border: 2px solid #00e0ff; margin-left: -10px; border-radius: 50%;" />
                                                        <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}"
                                                            style="height: 30px; width: 30px; border: 2px solid #00e0ff; margin-left: -10px; border-radius: 50%;" />
                                                        <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}"
                                                            style="height: 30px; width: 30px; border: 2px solid #00e0ff; margin-left: -10px; border-radius: 50%;" />
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center p-2" style="border-radius: 20px; background-color: #fff; max-width: 700px;">

                                                    <!-- Left Side: Icons + Text -->
                                                    <div class="d-flex align-items-center gap-3 px-2 py-1" style="border: 1px solid #e0e0e0; border-radius: 15px; display: inline-flex;">

                                                        <!-- Green Dot -->
                                                        <div class="d-flex align-items-center">
                                                            <i class="bi bi-circle-fill" style="color: #28a745;"></i>
                                                        </div>

                                                        <!-- Separator -->
                                                        <div style="width: 2px; height: 20px; background-color: #e0e0e0;"></div>

                                                        <!-- Bell Icon -->
                                                        <div class="d-flex align-items-center">
                                                            <i class="bi bi-bell-fill" style="color: #f44336;"></i>
                                                        </div>

                                                        <!-- Separator -->
                                                        <div style="width: 2px; height: 20px; background-color: #e0e0e0;"></div>

                                                        <!-- Calendar + Now -->
                                                        <div class="d-flex align-items-center">
                                                            <i class="bi bi-calendar" style="color: #3b3f5c;"></i>
                                                            <span class="ms-1" style="color: #dc3545; font-weight: 500;">Now</span>
                                                        </div>

                                                        <!-- Separator -->
                                                        <div style="width: 2px; height: 20px; background-color: #e0e0e0;"></div>

                                                        <!-- Time Box -->
                                                        <div class="d-flex align-items-center" style="color: #dc3545;">
                                                            <i class="bi bi-clock"></i>
                                                            <span class="ms-1">17:30 - 18:00</span>
                                                        </div>

                                                    </div>


                                                    <!-- Right Side: Join Button -->
                                                    <div>
                                                        <button class="btn" style="background-color: #28a745; color: white; border-radius: 8px;">
                                                            Join now <i class="bi bi-telephone-forward-fill ms-1"></i>
                                                        </button>
                                                    </div>

                                                </div>
                                            </div>
                                            <!-- 2nd card -->
                                            <div class="card p-3 mt-2 mb-2" style="border-radius:16px; background:#fff;">

                                                <!-- Top Row -->
                                                <div class="d-flex justify-content-between align-items-start flex-wrap mb-3">

                                                    <!-- Meeting Info -->
                                                    <div class="d-flex align-items-center me-3 mb-2">
                                                        <img src="{{ asset('build/img/groups/group-01.jpg') }}" style="border-radius:50%; width:35px; height:35px; object-fit:cover; margin-right:10px;">
                                                        <div>
                                                            <div style="font-weight:600; color:#0f1b3d;">Admin Name</div>
                                                            <div style="font-size:13px; color:#888;">Time&Date</div>
                                                        </div>
                                                    </div>

                                                    <!-- Project Info -->
                                                    <div class="d-flex align-items-center me-3 mb-2">
                                                        <img src="{{URL::asset('/build/img/yekbon.svg')}}" style="width:34px; height:30px; margin-right:8px;">
                                                        <div>
                                                            <div style="font-weight:600; font-size:14px;">Title Of ToDo</div>
                                                            <div style="font-size:12px; color:#999;">shared</div>
                                                        </div>
                                                    </div>

                                                    <!-- Zoom Button -->
                                                    <div class="mb-2">
                                                        <button style="background:#007bff; color:#fff; border:none; border-radius:6px; padding:6px 12px; font-size:13px;">ToDo Task</button>
                                                    </div>
                                                </div>

                                                <!-- Row 2: Description + Avatars -->
                                                <div class="d-flex justify-content-between flex-wrap align-items-center mb-3">
                                                    <div style="font-size:14px; color:#333;">
                                                        Here we will add the description of the ToDo Only<br>
                                                        you is Superadmin ToDo
                                                    </div>
                                                    <div class="d-flex justify-content-center mt-1" style="margin-left: 10px;">
                                                        <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}"
                                                            style="height: 30px; width: 30px; border: 2px solid #00e0ff; margin-left: -10px; border-radius: 50%;" />
                                                        <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}"
                                                            style="height: 30px; width: 30px; border: 2px solid #00e0ff; margin-left: -10px; border-radius: 50%;" />
                                                        <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}"
                                                            style="height: 30px; width: 30px; border: 2px solid #00e0ff; margin-left: -10px; border-radius: 50%;" />
                                                    </div>
                                                </div>
                                                <div class="d-flex  align-items-center p-2" style="border-radius: 20px; background-color: #fff; max-width: 700px;">
                                                    <div style="width: 30px;"></div>
                                                    <!-- Left Side: Icons + Text -->
                                                    <div class="d-flex align-items-start justify-content-between px-1 " style=" background-color: #f4f4f4;border-radius:10px; display: inline-flex;">

                                                        <!-- Left Side: Start and Deliver Info -->
                                                        <div class="d-flex align-items-center gap-1">

                                                            <!-- Start Date -->
                                                            <div class="d-flex align-items-center">
                                                                <span style="color: #28a745; font-weight: 500;">Start:</span>
                                                                <span class="ms-1" style="color: #3b3f5c;">22.10.2024</span>
                                                            </div>

                                                            <!-- Separator -->
                                                            <div style="width: 2px; height: 20px; background-color: #e0e0e0;"></div>

                                                            <!-- Delivery Info -->
                                                            <div class="d-flex align-items-center">
                                                                <span style="color: #3b3f5c; font-weight: 500;">Deliver:</span>
                                                                <span class="ms-1" style="color: #dc3545;">Today</span>
                                                            </div>
                                                            <!-- Right Side: Status Pill -->
                                                            <div class="d-flex align-items-center gap-1 px-1 py-1" style="background-color: #f0faf4; border-radius: 20px;">
                                                                <i class="bi bi-circle-fill" style="color: #28a745; font-size: 10px;"></i>
                                                                <span style="color: #3b3f5c; font-size: 14px;">Low</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Right Side: Join Button -->
                                                    <div class="text-center py-2">
                                                        <button style="background-color: #fbbc05; color: white; padding: 6px 18px; border: none; border-radius: 8px; font-size: 13px; font-weight: 500; cursor: pointer;margin-left: 30px;">
                                                            Need Counte
                                                        </button>
                                                    </div>

                                                </div>
                                            </div>
                                            <!-- 3rd card -->
                                            <div class="card p-3 mt-2 mb-2" style="border-radius:16px; background:#fff;">

                                                <!-- Top Row -->
                                                <div class="d-flex justify-content-between align-items-start flex-wrap mb-3">

                                                    <!-- Meeting Info -->
                                                    <div class="d-flex align-items-center me-3 mb-2">
                                                        <img src="{{ asset('build/img/groups/group-01.jpg') }}" style="border-radius:50%; width:35px; height:35px; object-fit:cover; margin-right:10px;">
                                                        <div>
                                                            <div style="font-weight:600; color:#0f1b3d;">Admin Name</div>
                                                            <div style="font-size:13px; color:#888;">Time&Date</div>
                                                        </div>
                                                    </div>

                                                    <!-- Project Info -->
                                                    <div class="d-flex align-items-center me-3 mb-2">
                                                        <img src="{{URL::asset('/build/img/yekbon.svg')}}" style="width:34px; height:30px; margin-right:8px;">
                                                        <div>
                                                            <div style="font-weight:600; font-size:14px;">Title Of ToDo</div>
                                                            <div style="font-size:12px; color:#999;">shared</div>
                                                        </div>
                                                    </div>

                                                    <!-- Zoom Button -->
                                                    <div class="mb-2">
                                                        <button style="background:#007bff; color:#fff; border:none; border-radius:6px; padding:6px 12px; font-size:13px;">ToDo Task</button>
                                                    </div>
                                                </div>

                                                <!-- Row 2: Description + Avatars -->
                                                <div class="d-flex justify-content-between flex-wrap align-items-center mb-3">
                                                    <div style="font-size:14px; color:#333;">
                                                        Here we will add the description of the ToDo Only<br>
                                                        you is Superadmin ToDo
                                                    </div>
                                                    <div class="d-flex justify-content-center mt-1" style="margin-left: 10px;">
                                                        <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}"
                                                            style="height: 30px; width: 30px; border: 2px solid #00e0ff; margin-left: -10px; border-radius: 50%;" />
                                                        <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}"
                                                            style="height: 30px; width: 30px; border: 2px solid #00e0ff; margin-left: -10px; border-radius: 50%;" />
                                                        <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}"
                                                            style="height: 30px; width: 30px; border: 2px solid #00e0ff; margin-left: -10px; border-radius: 50%;" />
                                                    </div>
                                                </div>
                                                <div class="d-flex  align-items-center p-2" style="border-radius: 20px; background-color: #fff; max-width: 700px;">
                                                    <div style="width: 30px;"></div>
                                                    <!-- Left Side: Icons + Text -->
                                                    <div class="d-flex align-items-start justify-content-between px-1" style=" background-color: #f4f4f4;border-radius:10px; display: inline-flex;">

                                                        <!-- Left Side: Start and Deliver Info -->
                                                        <div class="d-flex align-items-center gap-1">

                                                            <!-- Start Date -->
                                                            <div class="d-flex align-items-center">
                                                                <span style="color: #28a745; font-weight: 500;">Start:</span>
                                                                <span class="ms-1" style="color: #3b3f5c;">22.10.2024</span>
                                                            </div>

                                                            <!-- Separator -->
                                                            <div style="width: 2px; height: 20px; background-color: #e0e0e0;"></div>

                                                            <!-- Delivery Info -->
                                                            <div class="d-flex align-items-center">
                                                                <span style="color: #3b3f5c; font-weight: 500;">Deliver:</span>
                                                                <span class="ms-1" style="color: #dc3545;">Today</span>
                                                            </div>
                                                            <!-- Right Side: Status Pill -->
                                                            <div class="d-flex align-items-center gap-1 px-1 py-1" style="background-color: #f0faf4; border-radius: 20px;">
                                                                <i class="bi bi-circle-fill" style="color: #28a745; font-size: 10px;"></i>
                                                                <span style="color: #3b3f5c; font-size: 14px;">Low</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Right Side: Join Button -->
                                                    <div class="text-center py-2">
                                                        <button style="background-color: #fbbc05; color: white; padding: 6px 18px; border: none; border-radius: 8px; font-size: 13px; font-weight: 500; cursor: pointer;margin-left: 30px;">
                                                            Need Counte
                                                        </button>
                                                    </div>

                                                </div>
                                            </div>

                                            <!-- footer buttons -->
                                            <div class="d-flex justify-content-center gap-3 mt-2">

                                                <!-- View ToDo's -->
                                                <div class="d-flex align-items-center px-3 py-1" style="background-color: #fff; color: #6c757d; border-radius: 20px; font-size: 14px;">
                                                    View ToDo's
                                                    <i class="bi bi-arrow-right-short ms-2" style="font-size: 16px;"></i>
                                                </div>

                                                <!-- View Meetings -->
                                                <div class="d-flex align-items-center px-3 py-1" style="background-color: #fff; color: #6c757d; border-radius: 20px; font-size: 14px;">
                                                    View Meetings
                                                    <i class="bi bi-arrow-right-short ms-2" style="font-size: 16px;"></i>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                    <!-- 1 card -->
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
                                    <!-- 2 -->


                                </div>

                            </div>

                            <!-- Right Column -->
                            <div class="col-lg-3">
                                <!-- 1 -->
                                <div class="row g-3 mb-3">
                                    <!-- Card 1 -->
                                    <div class="col-md-4 col-sm-6 col-12">
                                        <div class="p-3 position-relative w-100"
                                            style="height: 150px; background: #f8f9fa; border-radius: 16px; box-shadow: 0 1px 2px rgba(0,0,0,0.05); font-family: 'Segoe UI', sans-serif;">

                                            <!-- Top-right arrow icon -->
                                            <img src="{{ asset('build/img/arrow.svg') }}" alt="arrow"
                                                style="position: absolute; top: 16px; right: 12px; width: 18px;">

                                            <!-- Icon -->
                                            <img src="{{ asset('build/img/tickets.svg') }}" alt="tickets icon"
                                                style="width: 42px; margin-bottom: 20px;">

                                            <!-- Title -->
                                            <div style="color: #126bb3; font-weight: 700; font-size: 14px;">Tickets</div>

                                            <!-- Value -->
                                            <div style="color: #126bb3; font-weight: 700; font-size: 18px;">45</div>

                                            <!-- Change Indicator -->
                                            <div style="position: absolute; bottom: 12px; right: 12px; font-size: 12px; color: #dc3545; font-weight: 600; display: flex; align-items: center;">
                                                <img src="{{ asset('build/img/down.svg') }}" alt="down" style="width: 12px; margin-right: 3px;">
                                                -5%
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Card 2 -->
                                    <div class="col-md-4 col-sm-6 col-12">
                                        <div class="p-3 position-relative w-100"
                                            style="height: 150px; background: #f8f9fa; border-radius: 16px; box-shadow: 0 1px 2px rgba(0,0,0,0.05); font-family: 'Segoe UI', sans-serif;">

                                            <img src="{{ asset('build/img/arrow.svg') }}" alt="arrow"
                                                style="position: absolute; top: 16px; right: 12px; width: 18px;">

                                            <img src="{{ asset('build/img/task.svg') }}" alt="task icon"
                                                style="width: 42px; margin-bottom: 20px;">

                                            <div style="color: #f37021; font-weight: 700; font-size: 14px;">Tasks</div>

                                            <div style="color: #f37021; font-weight: 700; font-size: 18px;">45</div>

                                            <div style="position: absolute; bottom: 12px; right: 12px; font-size: 12px; color: #28c76f; font-weight: 600; display: flex; align-items: center;">
                                                <img src="{{ asset('build/img/up.svg') }}" alt="up" style="width: 12px; margin-right: 3px;">
                                                +4%
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Card 3 -->
                                    <div class="col-md-4 col-sm-6 col-12">
                                        <div class="p-3 position-relative w-100"
                                            style="height: 150px; background: #f8f9fa; border-radius: 16px; box-shadow: 0 1px 2px rgba(0,0,0,0.05); font-family: 'Segoe UI', sans-serif;">

                                            <img src="{{ asset('build/img/arrow.svg') }}" alt="arrow"
                                                style="position: absolute; top: 16px; right: 12px; width: 18px;">

                                            <img src="{{ asset('build/img/member11.svg') }}" alt="member icon"
                                                style="width: 42px; margin-bottom: 20px;">

                                            <div style="color: #6a768e; font-weight: 700; font-size: 14px;">Members</div>

                                            <div style="color: #6a768e; font-weight: 700; font-size: 18px;">45</div>

                                            <div style="position: absolute; bottom: 12px; right: 12px; font-size: 12px; color: #28c76f; font-weight: 600; display: flex; align-items: center;">
                                                <img src="{{ asset('build/img/up.svg') }}" alt="up" style="width: 12px; margin-right: 3px;">
                                                +4%
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- 2 -->
                                <div class="row g-3 mb-3">
                                    <!-- Card 1 -->
                                    <div class="col-md-4 col-sm-6 col-12">
                                        <div class="p-3 position-relative w-100"
                                            style="height: 150px; background: #f8f9fa; border-radius: 16px; box-shadow: 0 1px 2px rgba(0,0,0,0.05); font-family: 'Segoe UI', sans-serif;">

                                            <!-- Top-right arrow icon -->
                                            <img src="{{ asset('build/img/arrow.svg') }}" alt="arrow"
                                                style="position: absolute; top: 16px; right: 12px; width: 18px;">

                                            <!-- Icon -->
                                            <img src="{{ asset('build/img/meeting11.svg') }}" alt="tickets icon"
                                                style="width: 42px; margin-bottom: 20px;">

                                            <!-- Title -->
                                            <div style="color: #6a768e; font-weight: 700; font-size: 14px;">Meetings</div>

                                            <!-- Value -->
                                            <div style="color: #6a768e; font-weight: 700; font-size: 18px;">45</div>

                                            <!-- Change Indicator -->
                                            <div style="position: absolute; bottom: 12px; right: 12px; font-size: 12px; color: #dc3545; font-weight: 600; display: flex; align-items: center;">
                                                <img src="{{ asset('build/img/down.svg') }}" alt="down" style="width: 12px; margin-right: 3px;">
                                                -5%
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Card 2 -->
                                    <div class="col-md-4 col-sm-6 col-12">
                                        <div class="p-3 position-relative w-100"
                                            style="height: 150px; background: #f8f9fa; border-radius: 16px; box-shadow: 0 1px 2px rgba(0,0,0,0.05); font-family: 'Segoe UI', sans-serif;">

                                            <img src="{{ asset('build/img/arrow.svg') }}" alt="arrow"
                                                style="position: absolute; top: 16px; right: 12px; width: 18px;">

                                            <img src="{{ asset('build/img/Todo1.svg') }}" alt="task icon"
                                                style="width: 42px; margin-bottom: 20px;">

                                            <div style="color: #025f2d; font-weight: 700; font-size: 14px;">ToDo's</div>

                                            <div style="color: #025f2d; font-weight: 700; font-size: 18px;">45</div>

                                            <div style="position: absolute; bottom: 12px; right: 12px; font-size: 12px; color: #28c76f; font-weight: 600; display: flex; align-items: center;">
                                                <img src="{{ asset('build/img/up.svg') }}" alt="up" style="width: 12px; margin-right: 3px;">
                                                +4%
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Card 3 -->
                                    <div class="col-md-4 col-sm-6 col-12">
                                        <div class="p-3 position-relative w-100"
                                            style="height: 150px; background: #f8f9fa; border-radius: 16px; box-shadow: 0 1px 2px rgba(0,0,0,0.05); font-family: 'Segoe UI', sans-serif;">

                                            <img src="{{ asset('build/img/arrow.svg') }}" alt="arrow"
                                                style="position: absolute; top: 16px; right: 12px; width: 18px;">

                                            <img src="{{ asset('build/img/words.svg') }}" alt="member icon"
                                                style="width: 42px; margin-bottom: 20px;">

                                            <div style="color: #5c1905; font-weight: 700; font-size: 14px;">Words</div>

                                            <div style="color: #5c1905; font-weight: 700; font-size: 18px;">19.526</div>

                                            <div style="position: absolute; bottom: 12px; right: 12px; font-size: 12px; color: #28c76f; font-weight: 600; display: flex; align-items: center;">
                                                <img src="{{ asset('build/img/up.svg') }}" alt="up" style="width: 12px; margin-right: 3px;">
                                                +4%
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- system log -->


                                <div class="mt-2" style="background-color: #f8f9fa; padding: 20px; border-radius: 14px;">
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

                                <!-- Task Activities -->

                                <div class="card p-4 mt-2" style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.05);background-color: #f8f9fa;">

                                    <!-- Header Section -->
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h5 style="font-weight: bold;">Task Activities</h5>
                                        <select class="form-select" style="width: 150px;">
                                            <option selected>Please Select</option>
                                            <!-- Add options here -->
                                        </select>
                                    </div>

                                    <!-- Task Activity Item -->
                                    <div class="d-flex mb-4">
                                        <div>
                                            <img src="{{ asset('build/img/groups/group-01.jpg') }}" class="rounded-circle me-3" style="width: 50px; height: 50px;" />
                                        </div>
                                        <div style="background:#fff; border-radius:10px;padding:10px;">
                                            <p style="margin: 0; font-weight: bold;">Admin name</p>
                                            <p style="margin: 0;">Has started the Task ID on Time Deliver Date</p>
                                            <div class="d-flex justify-content-end align-items-center px-1 py-1"
                                                style="background-color: #f4f4f4; border-radius: 10px; width: fit-content; float: right;">

                                                <!-- Date -->
                                                <span class="me-3" style="font-size: 14px;">
                                                    <span style="color: #00c264; font-weight: 500;">Date:</span>
                                                    <span style="color: #2c2c2c;">22.10.2024</span>
                                                </span>

                                                <!-- Separator -->
                                                <div style="height: 16px; width: 2px; background-color: #ccc;" class="me-3"></div>

                                                <!-- Time -->
                                                <span style="font-size: 14px;">
                                                    <span style="color: #00c264; font-weight: 500;">Time:</span>
                                                    <span style="color: #ff0000;">HH:MM</span>
                                                </span>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- Repeat Task Activity Items -->
                                    <div class="d-flex mb-4">
                                        <div>
                                            <img src="{{ asset('build/img/groups/group-01.jpg') }}" class="rounded-circle me-3" style="width: 50px; height: 50px;" />
                                        </div>
                                        <div style="background:#fff; border-radius:10px;padding:10px;">
                                            <p style="margin: 0; font-weight: bold;">Admin name</p>
                                            <p style="margin: 0;">Has started the Task ID on Time Deliver Date</p>
                                            <div class="d-flex justify-content-end align-items-center px-1 py-1"
                                                style="background-color: #f4f4f4; border-radius: 10px; width: fit-content; float: right;">

                                                <!-- Date -->
                                                <span class="me-3" style="font-size: 14px;">
                                                    <span style="color: #00c264; font-weight: 500;">Date:</span>
                                                    <span style="color: #2c2c2c;">22.10.2024</span>
                                                </span>

                                                <!-- Separator -->
                                                <div style="height: 16px; width: 2px; background-color: #ccc;" class="me-3"></div>

                                                <!-- Time -->
                                                <span style="font-size: 14px;">
                                                    <span style="color: #00c264; font-weight: 500;">Time:</span>
                                                    <span style="color: #ff0000;">HH:MM</span>
                                                </span>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex">
                                        <div>
                                            <img src="{{ asset('build/img/groups/group-01.jpg') }}" class="rounded-circle me-3" style="width: 50px; height: 50px;" />
                                        </div>
                                        <div style="background:#fff; border-radius:10px;padding:10px;">
                                            <p style="margin: 0; font-weight: bold;">Admin name</p>
                                            <p style="margin: 0;">Has started the Task ID on Time Deliver Date</p>
                                            <div class="d-flex justify-content-end align-items-center px-1 py-1"
                                                style="background-color: #f4f4f4; border-radius: 10px; width: fit-content; float: right;">

                                                <!-- Date -->
                                                <span class="me-3" style="font-size: 14px;">
                                                    <span style="color: #00c264; font-weight: 500;">Date:</span>
                                                    <span style="color: #2c2c2c;">22.10.2024</span>
                                                </span>

                                                <!-- Separator -->
                                                <div style="height: 16px; width: 2px; background-color: #ccc;" class="me-3"></div>

                                                <!-- Time -->
                                                <span style="font-size: 14px;">
                                                    <span style="color: #00c264; font-weight: 500;">Time:</span>
                                                    <span style="color: #ff0000;">HH:MM</span>
                                                </span>

                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <!--  -->



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
                                <!-- graph -->
                                <div class="mt-2" style="background: #eef0f4; padding: 20px; border-radius: 12px;  font-family: 'Segoe UI', sans-serif;">
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
                                                    <div style="border-top: 3px dashed #ccc; height: 20%;"></div>
                                                    <div style="border-top: 3px dashed #ccc; height: 20%;"></div>
                                                    <div style="border-top: 3px dashed #ccc; height: 20%;"></div>
                                                    <div style="border-top: 3px dashed #ccc; height: 20%;"></div>
                                                    <div style="border-top: 1px solid #ccc; height: 1%;"></div>
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




                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

</div>







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