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
    @include('Chats.notification')
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
                                            style="width: 25px; height: 25px; border: 2px solid #c2c7d0; border-radius: 50%; display: flex; align-items: center; justify-content: center; background-color: white; cursor: pointer;"
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
                                                <img src="{{URL::asset('/build/img/Edit1.svg')}}" alt="Edit" style="width: 22px; cursor: pointer;" data-bs-toggle="modal"
                                                    data-bs-target="#edit_team">
                                                <img src="{{URL::asset('/build/img/flow.svg')}}" alt="Flow" style="width: 22px; cursor: pointer;" data-bs-toggle="modal"
                                                    data-bs-target="#scheduleModal">
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
                                    <!-- 3-Dot Button + Popup -->
                                    <div class="position-absolute d-flex flex-column align-items-end gap-2" style="top: 110px; right: 10px; z-index: 2;">

                                        <!-- Trigger Button -->
                                        <div
                                            style="width: 25px; height: 25px; border: 2px solid #c2c7d0; border-radius: 50%; display: flex; align-items: center; justify-content: center; background-color: white; cursor: pointer;"
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
                                                <img src="{{URL::asset('/build/img/Edit1.svg')}}" alt="Edit" style="width: 22px; cursor: pointer;" data-bs-toggle="modal"
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
                        <!-- card 3 -->
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
                                            style="width: 25px; height: 25px; border: 2px solid #c2c7d0; border-radius: 50%; display: flex; align-items: center; justify-content: center; background-color: white; cursor: pointer;"
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
                                                <img src="{{URL::asset('/build/img/Edit1.svg')}}" alt="Edit" style="width: 22px; cursor: pointer;" data-bs-toggle="modal"
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
                        <!-- card 4 -->
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
                                            style="width: 25px; height: 25px; border: 2px solid #c2c7d0; border-radius: 50%; display: flex; align-items: center; justify-content: center; background-color: white; cursor: pointer;"
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
                                                <img src="{{URL::asset('/build/img/Edit1.svg')}}" alt="Edit" style="width: 22px; cursor: pointer;" data-bs-toggle="modal"
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

                    </div>

                </div>
            </div>

        </div>

    </div>

</div>

<!-- user pop-up -->



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
                    <div style="width: 70px; height: 100px; border-radius: 8px; overflow: hidden; background-color: #ccc; flex-shrink: 0;">
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
                            <div style="display: flex; gap: 5px; margin-top: 5px;margin-top: 5px;background: white;border-radius:5px;padding:5px;">
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
                                <!-- divider -->
                                <div style="width: 1px; height: 20px; background-color: #ccc;"></div>
                                <!-- Deliver Date -->
                                <div style="font-size: 12px; color: #00cc88; display: flex; align-items: center; gap: 5px;">
                                    <strong>Deliver:</strong>
                                    <span style="color: #1b1b3a;">22.10.2024</span>
                                    <img src="{{ URL::asset('/build/img/timeicon.svg') }}" style="width: 16px; height: 16px;" />
                                </div>
                            </div>

                            <!-- Status Badge -->
                            <div style="display: flex; align-items: center; gap: 6px;background: #f4f4f4;">
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
                    <div style="width: 70px; height: 100px; border-radius: 8px; overflow: hidden; background-color: #ccc; flex-shrink: 0;">
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
                            <div style="display: flex; gap: 5px; margin-top: 5px;margin-top: 5px;background: white;border-radius:5px;padding:5px;">
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
                                <!-- divider -->
                                <div style="width: 1px; height: 20px; background-color: #ccc;"></div>
                                <!-- Deliver Date -->
                                <div style="font-size: 12px; color: #00cc88; display: flex; align-items: center; gap: 5px;">
                                    <strong>Deliver:</strong>
                                    <span style="color: #1b1b3a;">22.10.2024</span>
                                    <img src="{{ URL::asset('/build/img/timeicon.svg') }}" style="width: 16px; height: 16px;" />
                                </div>
                            </div>

                            <!-- Status Badge -->
                            <div style="display: flex; align-items: center; gap: 6px;background: #f4f4f4;">
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
                    <div style="width: 70px; height: 100px; border-radius: 8px; overflow: hidden; background-color: #ccc; flex-shrink: 0;">
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
                            <div style="display: flex; gap: 5px; margin-top: 5px;margin-top: 5px;background: white;border-radius:5px;padding:5px;">
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
                                <!-- divider -->
                                <div style="width: 1px; height: 20px; background-color: #ccc;"></div>
                                <!-- Deliver Date -->
                                <div style="font-size: 12px; color: #00cc88; display: flex; align-items: center; gap: 5px;">
                                    <strong>Deliver:</strong>
                                    <span style="color: #1b1b3a;">22.10.2024</span>
                                    <img src="{{ URL::asset('/build/img/timeicon.svg') }}" style="width: 16px; height: 16px;" />
                                </div>
                            </div>

                            <!-- Status Badge -->
                            <div style="display: flex; align-items: center; gap: 6px;background: #f4f4f4;">
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
                    <div style="width: 70px; height: 100px; border-radius: 8px; overflow: hidden; background-color: #ccc; flex-shrink: 0;">
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
                            <div style="display: flex; gap: 5px; margin-top: 5px;margin-top: 5px;background: white;border-radius:5px;padding:7px;">
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
                                 <!-- divider -->
                                 <div style="width: 1px; height: 20px; background-color: #ccc;"></div>
                                <!-- Deliver Date -->
                                <div style="font-size: 12px; color: #00cc88; display: flex; align-items: center; gap: 5px;">
                                    <strong>Deliver:</strong>
                                    <span style="color: #1b1b3a;">22.10.2024</span>
                                    <img src="{{ URL::asset('/build/img/timeicon.svg') }}" style="width: 16px; height: 16px;" />
                                </div>
                            </div>

                            <!-- Status Badge -->
                            <div style="display: flex; align-items: center; gap: 6px;background: #f4f4f4;">
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
                    <div style="width: 70px; height: 100px; border-radius: 8px; overflow: hidden; background-color: #ccc; flex-shrink: 0;">
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
                            <div style="display: flex; gap: 5px; margin-top: 5px;margin-top: 5px;background: white;border-radius:5px;padding:7px;">
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
                                 <!-- divider -->
                                 <div style="width: 1px; height: 20px; background-color: #ccc;"></div>
                                <!-- Deliver Date -->
                                <div style="font-size: 12px; color: #00cc88; display: flex; align-items: center; gap: 5px;">
                                    <strong>Deliver:</strong>
                                    <span style="color: #1b1b3a;">22.10.2024</span>
                                    <img src="{{ URL::asset('/build/img/timeicon.svg') }}" style="width: 16px; height: 16px;" />
                                </div>
                            </div>

                            <!-- Status Badge -->
                            <div style="display: flex; align-items: center; gap: 6px;background: #f4f4f4;">
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
                    <div style="width: 70px; height: 100px; border-radius: 8px; overflow: hidden; background-color: #ccc; flex-shrink: 0;">
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
                            <div style="display: flex; gap: 5px; margin-top: 5px;margin-top: 5px;background: white;border-radius:5px;padding:7px;">
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
                                 <!-- divider -->
                                 <div style="width: 1px; height: 20px; background-color: #ccc;"></div>
                                <!-- Deliver Date -->
                                <div style="font-size: 12px; color: #00cc88; display: flex; align-items: center; gap: 5px;">
                                    <strong>Deliver:</strong>
                                    <span style="color: #1b1b3a;">22.10.2024</span>
                                    <img src="{{ URL::asset('/build/img/timeicon.svg') }}" style="width: 16px; height: 16px;" />
                                </div>
                            </div>

                            <!-- Status Badge -->
                            <div style="display: flex; align-items: center; gap: 6px;background: #f4f4f4;">
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

<!-- timelines -->
<!-- Modal -->
<div class="modal fade" id="scheduleModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" style="border-radius:10px; background:#f6f6f8;">

            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center px-3 py-2"
                style="background:#ffffff; border-bottom:1px solid #e1e1e1;">
                <div class="d-flex align-items-center gap-2">
                    <button class="btn btn-light btn-sm"><i class="fa fa-angle-left"></i></button>
                    <span style="font-weight:bold;">April 2025</span>
                    <button class="btn btn-light btn-sm"><i class="fa fa-angle-right"></i></button>
                    <button class="btn btn-sm btn-outline-primary ms-3">Project Title</button>
                    <button class="btn btn-sm btn-outline-secondary">Other Projects</button>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <button class="btn btn-success btn-sm">Start Developers Sprint</button>
                    <button class="btn btn-success btn-sm">Developer QA Sprint</button>
                    <img src="https://i.pravatar.cc/30?img=1" class="rounded-circle" width="30">
                    <img src="https://i.pravatar.cc/30?img=2" class="rounded-circle" width="30">
                    <img src="https://i.pravatar.cc/30?img=3" class="rounded-circle" width="30">
                </div>
            </div>

            <!-- Body -->
            <div class="d-flex flex-grow-1" style="height:80vh;">

                <!-- Left Time Column -->
                <div style="width:70px; background:#fafafa; border-right:1px solid #e1e1e1; text-align:right; font-size:12px; color:#666; position:relative;">
                    <div class="text-center py-2" style="border-bottom:1px solid #ddd;">
                        <i class="fa fa-clock"></i>
                    </div>
                    <!-- Times -->
                    <div style="height:40px;">00:00</div>
                    <div style="height:40px;">01:00</div>
                    <div style="height:40px;">02:00</div>
                    <div style="height:40px;">03:00</div>
                    <div style="height:40px;">04:00</div>
                    <div style="height:40px;">05:00</div>
                    <div style="height:40px;">06:00</div>
                    <div style="height:40px;">07:00</div>
                    <div style="height:40px;">08:00</div>
                    <div style="height:40px;">09:00</div>
                    <div style="height:40px;">10:00</div>
                    <div style="height:40px;">11:00</div>
                    <div style="height:40px;">12:00</div>
                    <div style="height:40px;">13:00</div>
                    <div style="height:40px;">14:00</div>
                    <div style="height:40px;">15:00</div>
                    <div style="height:40px;">16:00</div>
                    <div style="height:40px;">17:00</div>
                    <div style="height:40px;">18:00</div>
                    <div style="height:40px;">19:00</div>
                    <div style="height:40px;">20:00</div>
                    <div style="height:40px;">21:00</div>
                    <div style="height:40px;">22:00</div>
                    <div style="height:40px;">23:00</div>
                </div>

                <!-- Timeline Grid -->
                <div class="flex-grow-1 d-flex flex-column" style="overflow-x:auto; background:#fff;">

                    <!-- Date Bar -->
                    <div class="d-flex" style="border-bottom:1px solid #ddd; background:#fafafa; font-size:12px; color:#555;">
                        <!-- Example dates (loop in real) -->
                        <div style="width:120px; text-align:center; padding:5px; border-right:1px solid #e1e1e1;">Thu 1</div>
                        <div style="width:120px; text-align:center; padding:5px; border-right:1px solid #e1e1e1;">Fri 2</div>
                        <div style="width:120px; text-align:center; padding:5px; border-right:1px solid #e1e1e1;">Sat 3</div>
                        <div style="width:120px; text-align:center; padding:5px; border-right:1px solid #e1e1e1;">Sun 4</div>
                        <div style="width:120px; text-align:center; padding:5px; border-right:1px solid #e1e1e1;">Mon 5</div>
                        <div style="width:120px; text-align:center; padding:5px; border-right:1px solid #e1e1e1;">Tue 6</div>
                        <div style="width:120px; text-align:center; padding:5px; border-right:1px solid #e1e1e1;">Wed 7</div>
                        <div style="width:120px; text-align:center; padding:5px; border-right:1px solid #e1e1e1;">Wed 7</div>
                        <div style="width:120px; text-align:center; padding:5px; border-right:1px solid #e1e1e1;">Wed 7</div>
                        <div style="width:120px; text-align:center; padding:5px; border-right:1px solid #e1e1e1;">Wed 7</div>
                        <div style="width:120px; text-align:center; padding:5px; border-right:1px solid #e1e1e1;">Wed 7</div>
                        <div style="width:120px; text-align:center; padding:5px; border-right:1px solid #e1e1e1;">Wed 7</div>
                        <div style="width:120px; text-align:center; padding:5px; border-right:1px solid #e1e1e1;">Wed 7</div>
                        <div style="width:120px; text-align:center; padding:5px; border-right:1px solid #e1e1e1;">Wed 7</div>
                        <div style="width:120px; text-align:center; padding:5px; border-right:1px solid #e1e1e1;">Wed 7</div>
                        <div style="width:120px; text-align:center; padding:5px; border-right:1px solid #e1e1e1;">Wed 7</div>
                        <div style="width:120px; text-align:center; padding:5px; border-right:1px solid #e1e1e1;">Wed 76</div>
                    </div>

                    <!-- Vertical Grid + Tasks -->
                    <div class="d-flex flex-grow-1 position-relative">

                        <!-- Day Column Example -->
                        <div class="flex-shrink-0 position-relative" style="width:120px; border-right:1px solid #e1e1e1;">
                            <!-- Vertical guide line -->
                            <div style="position:absolute; top:0; bottom:0; left:50%; border-left:1px solid #f0f0f0;"></div>

                            <!-- Example Task -->
                            <div class="position-absolute text-white px-2 py-1 rounded"
                                style="top:220px; left:10px; width:90px; background:#ff5c8d; font-size:12px;">
                                Project Title <br>
                                <small>Task #14 - 45%</small>
                                <div class="mt-1">
                                    <img src="https://i.pravatar.cc/20?img=4" class="rounded-circle" width="20">
                                    <img src="https://i.pravatar.cc/20?img=5" class="rounded-circle" width="20">
                                </div>
                            </div>
                        </div>

                        <!-- More Day Columns... -->
                        <div class="flex-shrink-0 position-relative" style="width:120px; border-right:1px solid #e1e1e1;">
                            <!-- Vertical guide line -->
                            <div style="position:absolute; top:0; bottom:0; left:50%; border-left:1px solid #f0f0f0;"></div>

                            <!-- Example Task -->
                            <div class="position-absolute text-white px-2 py-1 rounded"
                                style="top:220px; left:10px; width:90px; background:#ff5c8d; font-size:12px;">
                                Project Title <br>
                                <small>Task #14 - 45%</small>
                                <div class="mt-1">
                                    <img src="https://i.pravatar.cc/20?img=4" class="rounded-circle" width="20">
                                    <img src="https://i.pravatar.cc/20?img=5" class="rounded-circle" width="20">
                                </div>
                            </div>
                        </div>
                        <div class="flex-shrink-0 position-relative" style="width:120px; border-right:1px solid #e1e1e1;">
                            <!-- Vertical guide line -->
                            <div style="position:absolute; top:0; bottom:0; left:50%; border-left:1px solid #f0f0f0;"></div>

                            <!-- Example Task -->
                            <div class="position-absolute text-white px-2 py-1 rounded"
                                style="top:220px; left:10px; width:90px; background:#ff5c8d; font-size:12px;">
                                Project Title <br>
                                <small>Task #14 - 45%</small>
                                <div class="mt-1">
                                    <img src="https://i.pravatar.cc/20?img=4" class="rounded-circle" width="20">
                                    <img src="https://i.pravatar.cc/20?img=5" class="rounded-circle" width="20">
                                </div>
                            </div>
                        </div>
                        <div class="flex-shrink-0 position-relative" style="width:120px; border-right:1px solid #e1e1e1;">
                            <!-- Vertical guide line -->
                            <div style="position:absolute; top:0; bottom:0; left:50%; border-left:1px solid #f0f0f0;"></div>

                            <!-- Example Task -->
                            <div class="position-absolute text-white px-2 py-1 rounded"
                                style="top:220px; left:10px; width:90px; background:#ff5c8d; font-size:12px;">
                                Project Title <br>
                                <small>Task #14 - 45%</small>
                                <div class="mt-1">
                                    <img src="https://i.pravatar.cc/20?img=4" class="rounded-circle" width="20">
                                    <img src="https://i.pravatar.cc/20?img=5" class="rounded-circle" width="20">
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