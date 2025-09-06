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
                                data-bs-target="#add_team"
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
                                    <div class="position-absolute d-flex flex-column align-items-end gap-2" style="top: 7px; right: 10px; z-index: 2;">

                                        <!-- Trigger Button (Styled) -->
                                        <div
                                            style="width: 35px; height: 35px; background-color: #dddddd; border-radius: 10px; display: flex; align-items: center; justify-content: center; cursor: pointer;"
                                            onclick="this.nextElementSibling.style.display = this.nextElementSibling.style.display === 'block' ? 'none' : 'block'; event.stopPropagation();">
                                            <div style="width: 24px; height: 24px; border: 1.8px solid #7a7a9d; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                <!-- Your span (not replaced) -->
                                                <span style="color: #2e3a59; font-size: 18px; font-weight: bold; margin-bottom: 8px;">...</span>
                                            </div>
                                        </div>

                                        <!-- Popup Menu -->
                                        <div
                                            class="menu-box"
                                            style="display: none; background: #fff; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); padding: 10px; width: 176px; text-align: center;"
                                            onclick="event.stopPropagation();">
                                            <div style="font-size: 13px; color: #7a7a9d; font-weight: 600; margin-bottom: 8px;">Options</div>
                                            <div class="d-flex justify-content-center align-items-center px-2" style="gap: 18px;">

                                                <img src="{{URL::asset('/build/img/delete1.svg')}}" alt="Delete" style="width: 22px; cursor: pointer;">

                                                <!-- Vertical Divider -->
                                                <div style="width: 1px; height: 18px; background-color: #ccc;"></div>

                                                <img src="{{URL::asset('/build/img/Edit1.svg')}}" alt="Edit" style="width: 22px; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#edit_team">

                                                <!-- Vertical Divider -->
                                                <div style="width: 1px; height: 18px; background-color: #ccc;"></div>

                                                <img src="{{URL::asset('/build/img/flow.svg')}}" alt="Flow" style="width: 22px; cursor: pointer;" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight">

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
                                    <div style="font-weight: bold; font-size: 16px; cursor: pointer;">Team Name </div>

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
                                            <img src="{{ asset('build/img/member1.svg') }}" alt="Green Flag" width="14" height="14">
                                            <span>10.09.2025</span>
                                        </div>
                                    </div>

                                    <!-- Bottom Row: Logo + PM + Team -->
                                    <div class="d-flex justify-content-between align-items-center text-center">

                                        <!-- Left: Logo + Flag -->
                                        <div class="d-flex flex-column align-items-center gap-2">
                                            <img src="{{URL::asset('/build/img/yekbon.svg')}}" alt="Logo" style="height: 32px; width: 32px;" />
                                            <div style="background: #c8ede0; padding: 3px 6px;display: flex; justify-content: center; align-items: center;">
                                                <img src="{{ asset('build/img/greenflag.svg') }}" alt="Green Flag" width="14" height="14">
                                            </div>
                                        </div>

                                        <!-- Center: PM -->
                                        <div class="text-center">
                                            <img src="{{URL::asset('/build/img/profileuser.svg')}}" alt="PM" class="rounded-circle" style="height: 36px; width: 36px; object-fit: cover;" />
                                            <div style="font-size: 12px; font-weight: 500; color: red;margin-top:3px;background:white;border-radius:5px;cursor:pointer">PM</div>

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
                                    <div class="position-absolute d-flex flex-column align-items-end gap-2" style="top: 7px; right: 10px; z-index: 2;">

                                        <!-- Trigger Button (Styled) -->
                                        <div
                                            style="width: 35px; height: 35px; background-color: #dddddd; border-radius: 10px; display: flex; align-items: center; justify-content: center; cursor: pointer;"
                                            onclick="this.nextElementSibling.style.display = this.nextElementSibling.style.display === 'block' ? 'none' : 'block'; event.stopPropagation();">
                                            <div style="width: 24px; height: 24px; border: 1.8px solid #7a7a9d; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                <!-- Your span (not replaced) -->
                                                <span style="color: #2e3a59; font-size: 18px; font-weight: bold; margin-bottom: 8px;">...</span>
                                            </div>
                                        </div>

                                        <!-- Popup Menu -->
                                        <div
                                            class="menu-box"
                                            style="display: none; background: #fff; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); padding: 10px; width: 177px; text-align: center;"
                                            onclick="event.stopPropagation();">
                                            <div style="font-size: 13px; color: #7a7a9d; font-weight: 600; margin-bottom: 8px;">Options</div>
                                            <div class="d-flex justify-content-center align-items-center px-2" style="gap: 18px;">

                                                <img src="{{URL::asset('/build/img/delete1.svg')}}" alt="Delete" style="width: 22px; cursor: pointer;">

                                                <!-- Vertical Divider -->
                                                <div style="width: 1px; height: 18px; background-color: #ccc;"></div>

                                                <img src="{{URL::asset('/build/img/Edit1.svg')}}" alt="Edit" style="width: 22px; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#edit_team">

                                                <!-- Vertical Divider -->
                                                <div style="width: 1px; height: 18px; background-color: #ccc;"></div>

                                                <img src="{{URL::asset('/build/img/flow.svg')}}" alt="Flow" style="width: 22px; cursor: pointer;" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight">

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
                                    <div style="font-weight: bold; font-size: 16px; cursor: pointer;">Team Name </div>

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
                                            <img src="{{ asset('build/img/member1.svg') }}" alt="Green Flag" width="14" height="14">
                                            <span>10.09.2025</span>
                                        </div>
                                    </div>

                                    <!-- Bottom Row: Logo + PM + Team -->
                                    <div class="d-flex justify-content-between align-items-center text-center">

                                        <!-- Left: Logo + Flag -->
                                        <div class="d-flex flex-column align-items-center gap-2">
                                            <img src="{{URL::asset('/build/img/yekbon.svg')}}" alt="Logo" style="height: 32px; width: 32px;" />
                                            <div style="background: #c8ede0; padding: 3px 6px;  display: flex; justify-content: center; align-items: center;">
                                                <img src="{{ asset('build/img/greenflag.svg') }}" alt="Green Flag" width="14" height="14">
                                            </div>
                                        </div>

                                        <!-- Center: PM -->
                                        <div class="text-center">
                                            <img src="{{URL::asset('/build/img/profileuser.svg')}}" alt="PM" class="rounded-circle" style="height: 36px; width: 36px; object-fit: cover;" />
                                            <div style="font-size: 12px; font-weight: 500; color: red;margin-top:3px;background:white;border-radius:5px;cursor:pointer">PM</div>

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
                                    <div class="position-absolute d-flex flex-column align-items-end gap-2" style="top: 7px; right: 10px; z-index: 2;">

                                        <!-- Trigger Button (Styled) -->
                                        <div
                                            style="width: 35px; height: 35px; background-color: #dddddd; border-radius: 10px; display: flex; align-items: center; justify-content: center; cursor: pointer;"
                                            onclick="this.nextElementSibling.style.display = this.nextElementSibling.style.display === 'block' ? 'none' : 'block'; event.stopPropagation();">
                                            <div style="width: 24px; height: 24px; border: 1.8px solid #7a7a9d; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                <!-- Your span (not replaced) -->
                                                <span style="color: #2e3a59; font-size: 18px; font-weight: bold; margin-bottom: 8px;">...</span>
                                            </div>
                                        </div>

                                        <!-- Popup Menu -->
                                        <div
                                            class="menu-box"
                                            style="display: none; background: #fff; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); padding: 10px; width: 176px; text-align: center;"
                                            onclick="event.stopPropagation();">
                                            <div style="font-size: 13px; color: #7a7a9d; font-weight: 600; margin-bottom: 8px;">Options</div>
                                            <div class="d-flex justify-content-center align-items-center px-2" style="gap: 18px;">

                                                <img src="{{URL::asset('/build/img/delete1.svg')}}" alt="Delete" style="width: 22px; cursor: pointer;">

                                                <!-- Vertical Divider -->
                                                <div style="width: 1px; height: 18px; background-color: #ccc;"></div>

                                                <img src="{{URL::asset('/build/img/Edit1.svg')}}" alt="Edit" style="width: 22px; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#edit_team">

                                                <!-- Vertical Divider -->
                                                <div style="width: 1px; height: 18px; background-color: #ccc;"></div>

                                                <img src="{{URL::asset('/build/img/flow.svg')}}" alt="Flow" style="width: 22px; cursor: pointer;" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight">

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
                                    <div style="font-weight: bold; font-size: 16px; cursor: pointer;">Team Name </div>

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
                                            <img src="{{ asset('build/img/member1.svg') }}" alt="Green Flag" width="14" height="14">
                                            <span>10.09.2025</span>
                                        </div>
                                    </div>

                                    <!-- Bottom Row: Logo + PM + Team -->
                                    <div class="d-flex justify-content-between align-items-center text-center">

                                        <!-- Left: Logo + Flag -->
                                        <div class="d-flex flex-column align-items-center gap-2">
                                            <img src="{{URL::asset('/build/img/yekbon.svg')}}" alt="Logo" style="height: 32px; width: 32px;" />
                                            <div style="background: #c8ede0; padding: 3px 6px; display: flex; justify-content: center; align-items: center;">
                                                <img src="{{ asset('build/img/greenflag.svg') }}" alt="Green Flag" width="14" height="14">
                                            </div>
                                        </div>

                                        <!-- Center: PM -->
                                        <div class="text-center">
                                            <img src="{{URL::asset('/build/img/profileuser.svg')}}" alt="PM" class="rounded-circle" style="height: 36px; width: 36px; object-fit: cover;" />
                                            <div style="font-size: 12px; font-weight: 500; color: red;margin-top:3px;background:white;border-radius:5px;cursor:pointer">PM</div>

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
                                    <div class="position-absolute d-flex flex-column align-items-end gap-2" style="top: 7px; right: 10px; z-index: 2;">

                                        <!-- Trigger Button (Styled) -->
                                        <div
                                            style="width: 35px; height: 35px; background-color: #dddddd; border-radius: 10px; display: flex; align-items: center; justify-content: center; cursor: pointer;"
                                            onclick="this.nextElementSibling.style.display = this.nextElementSibling.style.display === 'block' ? 'none' : 'block'; event.stopPropagation();">
                                            <div style="width: 24px; height: 24px; border: 1.8px solid #7a7a9d; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                <!-- Your span (not replaced) -->
                                                <span style="color: #2e3a59; font-size: 18px; font-weight: bold; margin-bottom: 8px;">...</span>
                                            </div>
                                        </div>

                                        <!-- Popup Menu -->
                                        <div
                                            class="menu-box"
                                            style="display: none; background: #fff; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); padding: 10px; width: 176px; text-align: center;"
                                            onclick="event.stopPropagation();">
                                            <div style="font-size: 13px; color: #7a7a9d; font-weight: 600; margin-bottom: 8px;">Options</div>
                                            <div class="d-flex justify-content-center align-items-center px-2" style="gap: 18px;">

                                                <img src="{{URL::asset('/build/img/delete1.svg')}}" alt="Delete" style="width: 22px; cursor: pointer;">

                                                <!-- Vertical Divider -->
                                                <div style="width: 1px; height: 18px; background-color: #ccc;"></div>

                                                <img src="{{URL::asset('/build/img/Edit1.svg')}}" alt="Edit" style="width: 22px; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#edit_team">

                                                <!-- Vertical Divider -->
                                                <div style="width: 1px; height: 18px; background-color: #ccc;"></div>

                                                <img src="{{URL::asset('/build/img/flow.svg')}}" alt="Flow" style="width: 22px; cursor: pointer;" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight">

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
                                    <div style="font-weight: bold; font-size: 16px; cursor: pointer;">Team Name </div>

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
                                            <img src="{{ asset('build/img/member1.svg') }}" alt="Green Flag" width="14" height="14">
                                            <span>10.09.2025</span>
                                        </div>
                                    </div>

                                    <!-- Bottom Row: Logo + PM + Team -->
                                    <div class="d-flex justify-content-between align-items-center text-center">

                                        <!-- Left: Logo + Flag -->
                                        <div class="d-flex flex-column align-items-center gap-2">
                                            <img src="{{URL::asset('/build/img/yekbon.svg')}}" alt="Logo" style="height: 32px; width: 32px;" />
                                            <div style="background: #c8ede0; padding: 3px 6px; display: flex; justify-content: center; align-items: center;">
                                                <img src="{{ asset('build/img/greenflag.svg') }}" alt="Green Flag" width="14" height="14">
                                            </div>
                                        </div>

                                        <!-- Center: PM -->
                                        <div class="text-center">
                                            <img src="{{URL::asset('/build/img/profileuser.svg')}}" alt="PM" class="rounded-circle" style="height: 36px; width: 36px; object-fit: cover;" />
                                            <div style="font-size: 12px; font-weight: 500; color: red;margin-top:3px;background:white;border-radius:5px;cursor:pointer">PM</div>

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
<!-- projects -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel"
    style="width:75vw; max-width:100%; overflow-x:hidden;">

    <!-- Close -->
    <!-- <button type="button" data-bs-dismiss="offcanvas" aria-label="Close"
        style="position:absolute; top:10px; right:10px; background-color:#ffffff; color:#000; border:none; border-radius:50%; width:36px; height:36px; font-size:24px; font-weight:bold; z-index:9999; display:flex; align-items:center; justify-content:center; box-shadow:0 0 6px rgba(0,0,0,.2)">&times;</button> -->
    <!-- MAIN CONTENT -->

    <!-- HEADER (same bg as body) -->
    <div class="offcanvas-header p-0" style="background:#f6f6f8; border-bottom:1px solid #e5e7eb;">
        <div id="mainHeader">
            <div class="w-100 d-flex align-items-center flex-nowrap px-2" style="gap:8px; height:56px;overflow-x:auto;">

                <!-- Calendar Top Bar -->
                <div class="d-flex align-items-center position-relative"
                    style="gap:8px; flex:0 0 auto; background:#fff; border-radius:10px; padding:1px 6px; border:1px solid #e0e0e0; z-index:1;">

                    <!-- Calendar Icon -->
                    <div onclick="toggleCalendar()" style="cursor:pointer;">
                        <img src="{{ URL::asset('/build/img/calender1.svg') }}" style="width:20px; height:20px;" />
                    </div>

                    <script>
                        function toggleCalendar() {
                            let popup = document.getElementById('calendarPopup');
                            if (popup.style.display === 'block') {
                                popup.style.display = 'none';
                            } else {
                                popup.style.display = 'block';
                                renderCalendar();
                            }
                        }
                    </script>


                    <!-- Left Arrow -->
                    <div onclick="changeMonth(-1)" class="d-inline-flex align-items-center justify-content-center"
                        style="width:28px; height:28px; border-radius:50%; font-size:14px; color:#2e3a59; cursor:pointer;">
                        «
                    </div>

                    <!-- Month Year Display -->
                    <div id="monthYearDisplay" class="fw-semibold" style="font-size:14px; color:#2e3a59;">
                        April 2022
                    </div>

                    <!-- Right Arrow -->
                    <div onclick="changeMonth(1)" class="d-inline-flex align-items-center justify-content-center"
                        style="width:28px; height:28px; border-radius:50%; font-size:14px; color:#2e3a59; cursor:pointer;">
                        »
                    </div>

                  


                </div>

                <!-- Inline JS (not hidden) -->
                <script>
                    let currentDate = new Date(2022, 3); // April 2022

                    function changeMonth(offset) {
                        currentDate.setMonth(currentDate.getMonth() + offset);
                        renderCalendar();
                    }

                    function renderCalendar() {
                        const monthYearText = currentDate.toLocaleDateString('en-US', {
                            month: 'long',
                            year: 'numeric'
                        });
                        document.getElementById('monthYearDisplay').innerText = monthYearText;

                        const calendarGrid = document.getElementById('calendarGrid');
                        calendarGrid.innerHTML = '';

                        // Day headers
                        ['S', 'M', 'T', 'W', 'T', 'F', 'S'].forEach(d => {
                            const day = document.createElement('div');
                            day.innerText = d;
                            day.style.fontWeight = 'bold';
                            calendarGrid.appendChild(day);
                        });

                        const year = currentDate.getFullYear();
                        const month = currentDate.getMonth();
                        const firstDay = new Date(year, month, 1).getDay();
                        const daysInMonth = new Date(year, month + 1, 0).getDate();

                        for (let i = 0; i < firstDay; i++) {
                            const empty = document.createElement('div');
                            calendarGrid.appendChild(empty);
                        }

                        for (let day = 1; day <= daysInMonth; day++) {
                            const cell = document.createElement('div');
                            cell.innerText = day;
                            cell.style.cursor = 'pointer';
                            cell.style.padding = '6px';
                            cell.style.borderRadius = '4px';

                            cell.onclick = function() {
                                currentDate.setDate(day);
                                document.getElementById('calendarPopup').style.display = 'none'; // close after select
                                renderCalendar();
                            };

                            cell.onmouseover = function() {
                                cell.style.background = '#f0f0f0';
                            };
                            cell.onmouseout = function() {
                                cell.style.background = '';
                            };

                            calendarGrid.appendChild(cell);
                        }
                    }

                    // run once so calendar is ready
                    renderCalendar();
                </script>





                <!-- Pills / chips -->
                <div class="d-flex align-items-center flex-nowrap" style="gap:8px; flex:0 0 auto; margin-left:8px;">
                    <div class="d-inline-flex align-items-center px-3 py-1" onclick="showProjectView()"
                        style="background:#ffffff; border:1px solid #e2e8f0; border-radius:10px; font-size:12px; color:#2e3a59; gap:8px;cursor:pointer">
                        <img src="{{ URL::asset('/build/img/yekbon.svg') }}" alt="Icon" style="width:20px; height:20px;" />
                        <div>Project Title</div>
                    </div>

                    <div class="d-inline-flex align-items-center px-3 py-1" onclick="showProjectView()"
                        style="background:#ffffff; border:1px solid #e2e8f0; border-radius:10px; font-size:12px; color:#2e3a59; gap:8px;cursor:pointer">
                        <img src="{{ URL::asset('/build/img/yekbon.svg') }}" alt="Icon" style="width:20px; height:20px;" />
                        <div>Other Projects</div>
                    </div>
                    <div class="d-inline-flex align-items-center px-3 py-1" onclick="showProjectView()"
                        style="background:#ffffff; border:1px solid #e2e8f0; border-radius:10px; font-size:12px; color:#2e3a59; gap:8px;cursor:pointer">
                        <img src="{{ URL::asset('/build/img/yekbon.svg') }}" alt="Icon" style="width:20px; height:20px;" />
                        <div>Other Projects</div>
                    </div>


                    <div class="d-inline-flex" style="background:#ffffff; border-radius:9px;">

                        <div id="viewTickets" class="px-3 py-1"
                            onclick="
                                  showProjectView();
                                this.style.backgroundColor='#22c55e';
                                  this.style.color='#ffffff';
                            document.getElementById('viewTasks').style.backgroundColor='';
                               document.getElementById('viewTasks').style.color='#9ca3af';
                                  "
                            style="border-radius:999px; font-size:12px; color:#9ca3af; cursor:pointer; user-select:none;">
                            View Tickets
                        </div>

                        <div id="viewTasks" class="px-3 py-1"
                            onclick="
                              showTaskView();
                              this.style.backgroundColor='#22c55e';
                              this.style.color='#ffffff';
                            document.getElementById('viewTickets').style.backgroundColor='';
                             document.getElementById('viewTickets').style.color='#9ca3af';
                                 "
                            style="border-radius:999px; font-size:12px; color:#9ca3af; cursor:pointer; user-select:none;">
                            View all Tasks
                        </div>

                    </div>


                    <div class="d-inline-flex" style="gap:8px;background:white">
                        <div class="px-3 py-1" style="background:#a6f09c; color:#ffffff; border-radius:999px; font-size:12px;">
                            Start: 01.04.2025 - 22:15
                        </div>
                        <div class="px-3 py-1" style="background:#22c55e; color:#ffffff; border-radius:999px; font-size:12px;">
                            Deliver: 07.04.2025 - 22:15
                        </div>
                    </div>


                    <!-- Avatars -->
                    <div class="d-flex align-items-center" style="gap:6px; margin-left:6px;">
                        <img src="https://i.pravatar.cc/28?img=3" alt="" style="width:28px; height:28px; border-radius:50%; border:2px solid #ffffff;">
                        <img src="https://i.pravatar.cc/28?img=5" alt="" style="width:28px; height:28px; border-radius:50%; border:2px solid #ffffff;">
                        <img src="https://i.pravatar.cc/28?img=8" alt="" style="width:28px; height:28px; border-radius:50%; border:2px solid #ffffff;">
                    </div>
                </div>

                <!-- Spacer -->
                <div class="ms-auto"></div>

                <!-- Right date -->
                <div class="d-flex align-items-center justify-content-center"
                    style="gap:8px; background:#ffffff; border-radius:8px; padding:4px 8px;margin-left: 76px;">

                    <!-- Left Arrow -->
                    <div onclick="
            currentDate.setDate(currentDate.getDate() - 1);
             document.getElementById('dateDisplay').innerText = currentDate.getDate() + ' ' + monthNames[currentDate.getMonth()]; "
                        class="d-inline-flex align-items-center justify-content-center"
                        style="width:24px; height:24px;border-radius:50%; font-size:12px; color:#2e3a59; cursor:pointer;">
                        «
                    </div>

                    <!-- Date Text -->
                    <div id="dateDisplay" class="fw-semibold"
                        style="font-size:13px; color:#2e3a59;">
                        26 April
                    </div>

                    <!-- Right Arrow -->
                    <div onclick="
                        currentDate.setDate(currentDate.getDate() + 1);
                document.getElementById('dateDisplay').innerText = currentDate.getDate() + ' ' + monthNames [currentDate.getMonth()];
           "
                        class="d-inline-flex align-items-center justify-content-center"
                        style="width:24px; height:24px; border: border-radius:50%; font-size:12px; color:#2e3a59; cursor:pointer;">
                        »
                    </div>
                </div>

                <!-- Inline JavaScript Date Setup (no <script> tag used) -->
                <span style="display:none;">
                    <script>
                        var currentDate1 = new Date(2025, 3, 26); // April is month 3 (0-indexed)
                        var monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July',
                            'August', 'September', 'October', 'November', 'December'
                        ];
                    </script>
                </span>

            </div>
        </div>


    </div>

    <!-- BODY (timeline) -->
    <div class="offcanvas-body p-0" style="background:#f6f6f8;overflow:visible;position:relative; z-index:1;">
          <!-- Calendar Popup -->
                    <div id="calendarPopup"
                        style="display:none; position:absolute; top:5px; left:14px; 
                        background:#fff; border:1px solid #ccc; border-radius:6px; 
                          padding:10px; box-shadow:0 4px 8px rgba(0,0,0,0.15); 
                            z-index:10000;"> <!-- 👈 z-index bada kar diya -->
                        <div id="calendarGrid" class="d-grid"
                            style="grid-template-columns: repeat(7, 32px); gap:4px; 
                        text-align:center; font-size:12px; padding: 4px 6px;">
                        </div>
                    </div>
        <!-- Toggleable Bodies -->

        <div id="mainContent">
            <div class="d-grid" style="grid-template-columns:72px auto; height:calc(100vh - 56px);">

                <!-- Left time column (white) -->
                <div style="background:#ffffff; border-right:1px solid #e5e7eb; font-size:12px;">
                    <!-- 00:00 .. 23:00 -->
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">00:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">01:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">02:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">03:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">04:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">05:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">06:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">07:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">08:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">09:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">10:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">11:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">12:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">13:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">14:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">15:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">16:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">17:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">18:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">19:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">20:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">21:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">22:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; color:#4b5563;">23:00</div>
                </div>

                <!-- Right main area -->
                <div style="position:relative; background:#f6f6f8;">
                    <!-- Vertical grid lines (touch labels) -->
                    <div class="d-grid" style="grid-template-columns: repeat(30, 1fr); position: absolute; inset: 0; pointer-events: none; margin-left: 9px;">

                        <!-- First 29 vertical lines -->
                        <!-- You can loop or copy as needed -->
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <!-- 30th line with black dot -->
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>

                        <!-- 30th line with black dot -->
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #d0d2d6; height: 100%;margin-left: 9px;"></div>
                        </div>

                    </div>


                    <!-- Day labels (sticky, exactly above lines) -->
                    <div class="d-grid" style="grid-template-columns:repeat(30,1fr); position:sticky; top:0; z-index:2; background:#f6f6f8;">
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Tue 1</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Wed 2</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Thu 3</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Fri 4</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Sat 5</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Sun 6</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Mon 7</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Tue 8</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Wed 9</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Thu 10</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Fri 11</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Sat 12</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Sun 13</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Mon 14</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Tue 15</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Wed 16</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Thu 17</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Fri 18</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Sat 19</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Sun 20</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Mon 21</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Tue 22</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Wed 23</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Thu 24</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Fri 25</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Sat 26</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Sun 27</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Mon 28</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Tue 29</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Wed 30</div>
                    </div>

                    <!-- EVENTS: sample positions mimic screenshot (absolute coords) -->
                    <div style="position:relative;">
                        <!-- Pink task around 21:00 spanning 3 cols -->

                        <div onclick="showProjectView()"
                            style="position:absolute; top:80px; left:calc((2 - 1) * (100%/25) + 8px); width:calc((4 * (100%/13)) - 16px); 
                            display:flex; border-radius:10px; overflow:hidden; box-shadow:0 2px 6px rgba(0,0,0,.08); font-size:12px;cursor:pointer;">

                            <!-- Pink Section -->
                            <div class="d-flex align-items-center justify-content-between"
                                style="background:#ec4899; color:#ffffff; padding:6px 10px; flex: 1; border-radius:7px;">

                                <!-- Icon -->
                                <img src="{{ URL::asset('/build/img/yekbon.svg') }}" alt="icon"
                                    style="width:22px; height:22px; margin-right:8px;" />

                                <!-- Text Content -->
                                <div class="d-flex flex-column" style="line-height:1;">
                                    <div class="fw-semibold" style="font-size:13px;">Project Title</div>
                                    <div style="font-size:10px; opacity:0.9;">Ticket #3</div>
                                </div>

                                <!-- Percent -->
                                <div class="fw-semibold ms-auto" style="font-size:14px; padding-left:15px;">45%</div>
                            </div>

                            <!-- White Section with Avatars -->
                            <div class="d-flex align-items-center justify-content-end"
                                style="background:#ffffff; padding:0 12px; min-width:140px; border-top-right-radius:10px; border-bottom-right-radius:10px;">

                                <!-- Avatars (Close together) -->
                                <div style="display:flex; align-items:center;">
                                    <img src="https://i.pravatar.cc/24?img=1"
                                        style="width:24px; height:24px; border-radius:50%; border:2px solid #fff; position:relative; z-index:3;" />
                                    <img src="https://i.pravatar.cc/24?img=2"
                                        style="width:24px; height:24px; border-radius:50%; border:2px solid #fff; margin-left:-8px; position:relative; z-index:2;" />
                                    <img src="https://i.pravatar.cc/24?img=3"
                                        style="width:24px; height:24px; border-radius:50%; border:2px solid #fff; margin-left:-8px; position:relative; z-index:1;" />
                                </div>
                            </div>
                        </div>


                        <!-- Yellow task around 18:00 spanning 4 cols -->
                        <div onclick="showProjectView()"
                            style="position:absolute; top:208px; left:calc((2 - 1) * (100%/25) + 8px); width:calc((4 * (100%/13)) - 16px); 
                            display:flex; border-radius:10px; overflow:hidden; box-shadow:0 2px 6px rgba(0,0,0,.08); font-size:12px;cursor:pointer;">

                            <!-- Pink Section -->
                            <div class="d-flex align-items-center justify-content-between"
                                style="background:#f59e0b; color:#ffffff; padding:6px 10px; flex: 1; border-radius:7px;">

                                <!-- Icon -->
                                <img src="{{ URL::asset('/build/img/yekbon.svg') }}" alt="icon"
                                    style="width:22px; height:22px; margin-right:8px;" />

                                <!-- Text Content -->
                                <div class="d-flex flex-column" style="line-height:1;">
                                    <div class="fw-semibold" style="font-size:13px;">Project Title</div>
                                    <div style="font-size:10px; opacity:0.9;">Ticket #3</div>
                                </div>

                                <!-- Percent -->
                                <div class="fw-semibold ms-auto" style="font-size:14px; padding-left:15px;">45%</div>
                            </div>

                            <!-- White Section with Avatars -->
                            <div class="d-flex align-items-center justify-content-end"
                                style="background:#ffffff; padding:0 12px; min-width:140px; border-top-right-radius:10px; border-bottom-right-radius:10px;">

                                <!-- Avatars (Close together) -->
                                <div style="display:flex; align-items:center;">
                                    <img src="https://i.pravatar.cc/24?img=1"
                                        style="width:24px; height:24px; border-radius:50%; border:2px solid #fff; position:relative; z-index:3;" />
                                    <img src="https://i.pravatar.cc/24?img=2"
                                        style="width:24px; height:24px; border-radius:50%; border:2px solid #fff; margin-left:-8px; position:relative; z-index:2;" />
                                    <img src="https://i.pravatar.cc/24?img=3"
                                        style="width:24px; height:24px; border-radius:50%; border:2px solid #fff; margin-left:-8px; position:relative; z-index:1;" />
                                </div>
                            </div>
                        </div>
                        <!-- yellow -->
                        <div onclick="showProjectView()"
                            style="position:absolute; top:80px; left:calc((2 - 1) * (100%/25) + 8px); width:calc((4 * (100%/13)) - 16px); 
                            display:flex; border-radius:10px; overflow:hidden; box-shadow:0 2px 6px rgba(0,0,0,.08); font-size:12px;cursor:pointer;">

                            <!-- Pink Section -->
                            <div class="d-flex align-items-center justify-content-between"
                                style="background:#ec4899; color:#ffffff; padding:6px 10px; flex: 1; border-radius:7px;">

                                <!-- Icon -->
                                <img src="{{ URL::asset('/build/img/yekbon.svg') }}" alt="icon"
                                    style="width:22px; height:22px; margin-right:8px;" />

                                <!-- Text Content -->
                                <div class="d-flex flex-column" style="line-height:1;">
                                    <div class="fw-semibold" style="font-size:13px;">Project Title</div>
                                    <div style="font-size:10px; opacity:0.9;">Ticket #3</div>
                                </div>

                                <!-- Percent -->
                                <div class="fw-semibold ms-auto" style="font-size:14px; padding-left:15px;">45%</div>
                            </div>

                            <!-- White Section with Avatars -->
                            <div class="d-flex align-items-center justify-content-end"
                                style="background:#ffffff; padding:0 12px; min-width:140px; border-top-right-radius:10px; border-bottom-right-radius:10px;">

                                <!-- Avatars (Close together) -->
                                <div style="display:flex; align-items:center;">
                                    <img src="https://i.pravatar.cc/24?img=1"
                                        style="width:24px; height:24px; border-radius:50%; border:2px solid #fff; position:relative; z-index:3;" />
                                    <img src="https://i.pravatar.cc/24?img=2"
                                        style="width:24px; height:24px; border-radius:50%; border:2px solid #fff; margin-left:-8px; position:relative; z-index:2;" />
                                    <img src="https://i.pravatar.cc/24?img=3"
                                        style="width:24px; height:24px; border-radius:50%; border:2px solid #fff; margin-left:-8px; position:relative; z-index:1;" />
                                </div>
                            </div>
                        </div>
                        <!-- Blue task around 13:00 spanning 4 cols -->
                        <div onclick="showProjectView()"
                            style="position:absolute; top:550px; left:calc((2 - 1) * (100%/6) + 8px); width:calc((4 * (100%/13)) - 16px); 
                            display:flex; border-radius:10px; overflow:hidden; box-shadow:0 2px 6px rgba(0,0,0,.08); font-size:12px;cursor:pointer;">

                            <!-- Pink Section -->
                            <div class="d-flex align-items-center justify-content-between"
                                style="background:#3578a8; color:#ffffff; padding:6px 10px; flex: 1; border-radius:7px;">

                                <!-- Icon -->
                                <img src="{{ URL::asset('/build/img/yekbon.svg') }}" alt="icon"
                                    style="width:22px; height:22px; margin-right:8px;" />

                                <!-- Text Content -->
                                <div class="d-flex flex-column" style="line-height:1;">
                                    <div class="fw-semibold" style="font-size:13px;">Project Title</div>
                                    <div style="font-size:10px; opacity:0.9;">Ticket #3</div>
                                </div>

                                <!-- Percent -->
                                <div class="fw-semibold ms-auto" style="font-size:14px; padding-left:15px;">45%</div>
                            </div>

                            <!-- White Section with Avatars -->
                            <div class="d-flex align-items-center justify-content-end"
                                style="background:#ffffff; padding:0 12px; min-width:140px; border-top-right-radius:10px; border-bottom-right-radius:10px;">

                                <!-- Avatars (Close together) -->
                                <div style="display:flex; align-items:center;">
                                    <img src="https://i.pravatar.cc/24?img=1"
                                        style="width:24px; height:24px; border-radius:50%; border:2px solid #fff; position:relative; z-index:3;" />
                                    <img src="https://i.pravatar.cc/24?img=2"
                                        style="width:24px; height:24px; border-radius:50%; border:2px solid #fff; margin-left:-8px; position:relative; z-index:2;" />
                                    <img src="https://i.pravatar.cc/24?img=3"
                                        style="width:24px; height:24px; border-radius:50%; border:2px solid #fff; margin-left:-8px; position:relative; z-index:1;" />
                                </div>
                            </div>
                        </div>

                        <!-- White task around 17:00 spanning 5 cols -->
                        <div onclick="showProjectView()" style="position:absolute; top:816px; left:calc((16 - 1) * (100%/30) + 8px); width:calc((5 * (100%/18)) - 16px); background:#ffffff; color:#374151; padding:6px 8px; border-radius:10px; font-size:12px; box-shadow:0 2px 6px rgba(0,0,0,.08); border:1px solid #e5e7eb; display:flex; overflow:hidden;cursor:pointer">

                            <!-- Left blue border -->
                            <div style="width:4px; background:#3b82f6; border-radius:4px; margin-right:8px;"></div>

                            <!-- Main content (title + % + avatars) -->
                            <div class="d-flex flex-grow-1 justify-content-between align-items-center" style="width:100%; gap:6px;">

                                <!-- Title + Icon -->
                                <!-- Left Pink Section -->
                                <div class="d-flex align-items-center">

                                    <!-- Icon on Left -->
                                    <img src="{{ URL::asset('/build/img/yekbon.svg') }}"
                                        style="width:24px; height:24px; flex-shrink:0;" />

                                    <!-- Text content stacked vertically -->
                                    <div class="d-flex flex-column ms-3" style="line-height:1;">
                                        <div class="fw-semibold" style="font-size:13px;">Project Title</div>
                                        <div style="font-size:11px; opacity:0.8;">Ticket #1 - #4</div>
                                    </div>


                                </div>


                                <!-- % Progress -->
                                <div class="fw-semibold" style="white-space:nowrap;">0%</div>

                                <!-- Avatars -->
                                <div class="d-flex align-items-center" style="margin-left:8px;">
                                    <div style="position:relative;">
                                        <img src="https://i.pravatar.cc/24?img=1" style="width:24px; height:24px; border-radius:50%; border:2px solid #fff; position:relative; z-index:3;" />
                                        <img src="https://i.pravatar.cc/24?img=2" style="width:24px; height:24px; border-radius:50%; border:2px solid #fff; margin-left:-8px; position:relative; z-index:2;" />
                                        <img src="https://i.pravatar.cc/24?img=3" style="width:24px; height:24px; border-radius:50%; border:2px solid #fff; margin-left:-8px; position:relative; z-index:1;" />
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <div id="projectDetails" style="display:none;">
            <div class="d-grid" style="grid-template-columns:72px auto; height:calc(100vh - 56px);">

                <!-- Left time column (white) -->
                <div style="background:#ffffff; border-right:1px solid #e5e7eb; font-size:12px;">
                    <!-- 00:00 .. 23:00 -->
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">00:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">01:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">02:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">03:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">04:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">05:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">06:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">07:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">08:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">09:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">10:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">11:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">12:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">13:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">14:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">15:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">16:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">17:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">18:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">19:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">20:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">21:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">22:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; color:#4b5563;">23:00</div>
                </div>

                <!-- Right main area -->
                <div style="position:relative; background:#f6f6f8;">
                    <!-- Vertical grid lines (touch labels) -->
                    <div class="d-grid" style="grid-template-columns: repeat(30, 1fr); position: absolute; inset: 0; pointer-events: none; margin-left: 9px;">

                        <!-- First 29 vertical lines -->
                        <!-- You can loop or copy as needed -->
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <!-- 30th line with black dot -->
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>

                        <!-- 30th line with black dot -->
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #d0d2d6; height: 100%;margin-left: 9px;"></div>
                        </div>

                    </div>


                    <!-- Day labels (sticky, exactly above lines) -->
                    <div class="d-grid" style="grid-template-columns:repeat(30,1fr); position:sticky; top:0; z-index:2; background:#f6f6f8;">
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Tue 1</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Wed 2</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Thu 3</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Fri 4</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Sat 5</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Sun 6</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Mon 7</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Tue 8</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Wed 9</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Thu 10</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Fri 11</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Sat 12</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Sun 13</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Mon 14</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Tue 15</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Wed 16</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Thu 17</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Fri 18</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Sat 19</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Sun 20</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Mon 21</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Tue 22</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Wed 23</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Thu 24</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Fri 25</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Sat 26</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Sun 27</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Mon 28</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Tue 29</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Wed 30</div>
                    </div>

                    <!-- EVENTS: sample positions mimic screenshot (absolute coords) -->
                    <div style="position:relative;">
                        <!-- Pink task around 21:00 spanning 3 cols -->
                        <div onclick="showTaskView()"
                            style="position:absolute; top:90px; left:calc((2 - 1) * (100%/25) + 8px); width:calc((4 * (100%/13)) - 16px); 
                            display:flex; border-radius:10px; overflow:hidden; box-shadow:0 2px 6px rgba(0,0,0,.08); font-size:12px;cursor:pointer;">

                            <!-- Pink Section -->
                            <div class="d-flex align-items-center justify-content-between"
                                style="background:#ec4899; color:#ffffff; padding:6px 10px; flex: 1; border-radius:7px;">

                                <!-- Icon -->
                                <img src="{{ URL::asset('/build/img/yekbon.svg') }}" alt="icon"
                                    style="width:22px; height:22px; margin-right:8px;" />

                                <!-- Text Content -->
                                <div class="d-flex flex-column" style="line-height:1;">
                                    <div class="fw-semibold" style="font-size:13px;">Project Title</div>
                                    <div style="font-size:10px; opacity:0.9;">Ticket #3</div>
                                </div>

                                <!-- Percent -->
                                <div class="fw-semibold ms-auto" style="font-size:14px; padding-left:15px;">45%</div>
                            </div>


                            <!-- White Section with Avatars -->
                            <div class="d-flex align-items-center justify-content-end"
                                style="background:#ffffff; padding:0 12px; min-width:140px; border-top-right-radius:10px; border-bottom-right-radius:10px;">

                                <!-- Avatars (Close together) -->
                                <div style="display:flex; align-items:center;">
                                    <img src="https://i.pravatar.cc/24?img=1"
                                        style="width:24px; height:24px; border-radius:50%; border:2px solid #fff; position:relative; z-index:3;" />
                                    <img src="https://i.pravatar.cc/24?img=2"
                                        style="width:24px; height:24px; border-radius:50%; border:2px solid #fff; margin-left:-8px; position:relative; z-index:2;" />
                                    <img src="https://i.pravatar.cc/24?img=3"
                                        style="width:24px; height:24px; border-radius:50%; border:2px solid #fff; margin-left:-8px; position:relative; z-index:1;" />
                                </div>
                            </div>
                        </div>


                        <!-- pink task around 18:00 spanning 4 cols -->
                        <div onclick="showTaskView()"
                            style="position:absolute; top:170px; left:calc((2 - 1) * (100%/25) + 8px); width:calc((4 * (100%/13)) - 16px); 
                            display:flex; border-radius:10px; overflow:hidden; box-shadow:0 2px 6px rgba(0,0,0,.08); font-size:12px;cursor:pointer;">

                            <!-- Pink Section -->
                            <div class="d-flex align-items-center justify-content-between"
                                style="background:#ec4899; color:#ffffff; padding:6px 10px; flex: 1; border-radius:7px;">

                                <!-- Icon -->
                                <img src="{{ URL::asset('/build/img/yekbon.svg') }}" alt="icon"
                                    style="width:22px; height:22px; margin-right:8px;" />

                                <!-- Text Content -->
                                <div class="d-flex flex-column" style="line-height:1;">
                                    <div class="fw-semibold" style="font-size:13px;">Project Title</div>
                                    <div style="font-size:10px; opacity:0.9;">Ticket #3</div>
                                </div>

                                <!-- Percent -->
                                <div class="fw-semibold ms-auto" style="font-size:14px; padding-left:15px;">45%</div>
                            </div>

                            <!-- White Section with Avatars -->
                            <div class="d-flex align-items-center justify-content-end"
                                style="background:#ffffff; padding:0 12px; min-width:140px; border-top-right-radius:10px; border-bottom-right-radius:10px;">

                                <!-- Avatars (Close together) -->
                                <div style="display:flex; align-items:center;">
                                    <img src="https://i.pravatar.cc/24?img=1"
                                        style="width:24px; height:24px; border-radius:50%; border:2px solid #fff; position:relative; z-index:3;" />
                                    <img src="https://i.pravatar.cc/24?img=2"
                                        style="width:24px; height:24px; border-radius:50%; border:2px solid #fff; margin-left:-8px; position:relative; z-index:2;" />
                                    <img src="https://i.pravatar.cc/24?img=3"
                                        style="width:24px; height:24px; border-radius:50%; border:2px solid #fff; margin-left:-8px; position:relative; z-index:1;" />
                                </div>
                            </div>
                        </div>
                        <!--yyello  -->
                        <div onclick="showTaskView()"
                            style="position:absolute; top:250px; left:calc((2 - 1) * (100%/25) + 8px); width:calc((4 * (100%/13)) - 16px); 
                            display:flex; border-radius:10px; overflow:hidden; box-shadow:0 2px 6px rgba(0,0,0,.08); font-size:12px;cursor:pointer;">

                            <!-- Pink Section -->
                            <div class="d-flex align-items-center justify-content-between"
                                style="background:#ec4899; color:#ffffff; padding:6px 10px; flex: 1; border-radius:7px;">

                                <!-- Icon -->
                                <img src="{{ URL::asset('/build/img/yekbon.svg') }}" alt="icon"
                                    style="width:22px; height:22px; margin-right:8px;" />

                                <!-- Text Content -->
                                <div class="d-flex flex-column" style="line-height:1;">
                                    <div class="fw-semibold" style="font-size:13px;">Project Title</div>
                                    <div style="font-size:10px; opacity:0.9;">Ticket #3</div>
                                </div>

                                <!-- Percent -->
                                <div class="fw-semibold ms-auto" style="font-size:14px; padding-left:15px;">45%</div>
                            </div>

                            <!-- White Section with Avatars -->
                            <div class="d-flex align-items-center justify-content-end"
                                style="background:#ffffff; padding:0 12px; min-width:140px; border-top-right-radius:10px; border-bottom-right-radius:10px;">

                                <!-- Avatars (Close together) -->
                                <div style="display:flex; align-items:center;">
                                    <img src="https://i.pravatar.cc/24?img=1"
                                        style="width:24px; height:24px; border-radius:50%; border:2px solid #fff; position:relative; z-index:3;" />
                                    <img src="https://i.pravatar.cc/24?img=2"
                                        style="width:24px; height:24px; border-radius:50%; border:2px solid #fff; margin-left:-8px; position:relative; z-index:2;" />
                                    <img src="https://i.pravatar.cc/24?img=3"
                                        style="width:24px; height:24px; border-radius:50%; border:2px solid #fff; margin-left:-8px; position:relative; z-index:1;" />
                                </div>
                            </div>
                        </div>





                    </div>

                </div>
            </div>
        </div>
        <div id="taskDetails" style="display:none;">
            <div class="d-grid" style="grid-template-columns:72px auto; height:calc(100vh - 56px);">

                <!-- Left time column (white) -->
                <div style="background:#ffffff; border-right:1px solid #e5e7eb; font-size:12px;">
                    <!-- 00:00 .. 23:00 -->
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">00:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">01:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">02:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">03:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">04:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">05:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">06:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">07:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">08:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">09:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">10:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">11:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">12:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">13:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">14:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">15:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">16:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">17:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">18:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">19:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">20:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">21:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; border-bottom:1px solid #f1f5f9; color:#4b5563;">22:00</div>
                    <div class="d-flex justify-content-center align-items-center" style="height:48px; color:#4b5563;">23:00</div>
                </div>

                <!-- Right main area -->
                <div style="position:relative; background:#f6f6f8;">
                    <!-- Vertical grid lines (touch labels) -->
                    <div class="d-grid" style="grid-template-columns: repeat(30, 1fr); position: absolute; inset: 0; pointer-events: none; margin-left: 9px;">

                        <!-- First 29 vertical lines -->
                        <!-- You can loop or copy as needed -->
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>
                        <!-- 30th line with black dot -->
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #e5e7eb; height: 100%;margin-left: 9px;"></div>
                        </div>

                        <!-- 30th line with black dot -->
                        <div style="position: relative;">
                            <!-- Dot -->
                            <div style="width: 8px; height: 8px; background-color: #d0d2d6; border-radius: 50%; position: absolute; left: 5px; top: 33px;"></div>

                            <!-- Line -->
                            <div style="border-left: 1px solid #d0d2d6; height: 100%;margin-left: 9px;"></div>
                        </div>

                    </div>


                    <!-- Day labels (sticky, exactly above lines) -->
                    <div class="d-grid" style="grid-template-columns:repeat(30,1fr); position:sticky; top:0; z-index:2; background:#f6f6f8;">
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Tue 1</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Wed 2</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Thu 3</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Fri 4</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Sat 5</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Sun 6</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Mon 7</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Tue 8</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Wed 9</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Thu 10</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Fri 11</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Sat 12</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Sun 13</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Mon 14</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Tue 15</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Wed 16</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Thu 17</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Fri 18</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Sat 19</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Sun 20</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Mon 21</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Tue 22</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Wed 23</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Thu 24</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Fri 25</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Sat 26</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Sun 27</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Mon 28</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Tue 29</div>
                        <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">Wed 30</div>
                    </div>

                    <!-- EVENTS: sample positions mimic screenshot (absolute coords) -->
                    <div style="position:relative;">
                        <!-- Pink task around 21:00 spanning 3 cols -->
                        <div style="position:absolute; top:90px; left:calc((2 - 1) * (100%/96) + 8px); 
            display:flex; border-radius:12px; overflow:hidden; 
            box-shadow:0 2px 6px rgba(0,0,0,0.08); font-size:13px; font-family: Arial, sans-serif; width: 500px;">

                            <!-- Left (Pink) Section -->
                            <div style="background:#f43f7f; padding: 8px 10px; display:flex; align-items:center; gap:10px; width:160px;border-radius:10px;">

                                <!-- Avatar -->
                                <img src="https://i.pravatar.cc/40?img=12"
                                    style="width:36px; height:36px; border-radius:6px; object-fit:cover;" />

                                <!-- Text -->
                                <div class="d-flex flex-column" style="color:#ffffff;">
                                    <div style="font-weight:600; font-size:13px;">Task Title</div>
                                    <div style="font-size:11px; opacity:0.8;">Task ID - Ticket #1</div>
                                </div>
                            </div>

                            <!-- Right (White) Section -->
                            <div class="d-flex align-items-center justify-content-end px-3"
                                style="background:#ffffff; flex:1;">
                                <div style="font-weight:600; font-size:13px; color:#1e293b;">25%</div>
                            </div>
                        </div>


                        <!-- pink task around 18:00 spanning 4 cols -->
                        <div style="position:absolute; top:217px; left:calc((2 - 1) * (100%/96) + 8px); width:calc((4 * (100%/19)) - 16px); display:flex; border-radius:10px; overflow:hidden; box-shadow:0 2px 6px rgba(0,0,0,.08); font-size:12px;">
                            <div style="display: flex; align-items: center; background: #fff; border-radius: 10px; padding: 8px 12px; position: relative; box-shadow: 0 1px 2px rgba(0,0,0,0.05); width: 260px; border-left: 6px solid #f43f5e;">

                                <!-- Avatar -->
                                <div style="margin-right: 10px;">
                                    <img src="https://i.pravatar.cc/32?img=3" alt="Avatar"
                                        style="width: 32px; height: 32px; border-radius: 50%; border: 2px solid #fff;" />
                                </div>

                                <!-- Text Content -->
                                <div style="flex-grow: 1;">
                                    <div style="font-weight: 600; font-size: 14px; color: #1e293b;">Task Title</div>
                                    <div style="font-size: 12px; color: #64748b;">Task ID - Ticket #1</div>
                                </div>

                                <!-- Percentage -->
                                <div style="font-weight: 600; font-size: 13px; color: #1e293b;">0%</div>
                            </div>


                        </div>
                        <!--yyello  -->
                        <div style="position:absolute; top:350px; left:calc((2 - 1) * (100%/96) + 8px); width:calc((4 * (100%/19)) - 16px); display:flex; border-radius:10px; overflow:hidden; box-shadow:0 2px 6px rgba(0,0,0,.08); font-size:12px;">
                            <div class="d-flex align-items-center"
                                style="width:280px; border-radius:10px; overflow:hidden; box-shadow:0 2px 6px rgba(0,0,0,.08); font-size:12px;">

                                <!-- Left Pink Section -->
                                <div class="d-flex justify-content-center align-items-center"
                                    style="background:#ec4899; padding:6px; width:55px; height:55px;">
                                    <img src="https://i.pravatar.cc/48?img=5"
                                        style="width:42px; height:42px; border-radius:8px; object-fit:cover;" />
                                </div>

                                <!-- Right White Section -->
                                <div class="d-flex flex-column justify-content-center flex-grow-1"
                                    style="background:#ffffff; padding:6px 10px; position:relative;">

                                    <!-- Top row (title + percentage) -->
                                    <div class="d-flex align-items-center">
                                        <div style="font-weight:600; color:#2e3a59; font-size:13px;">Task Title</div>
                                        <div class="ms-auto" style="font-weight:600; font-size:13px; color:#2e3a59;">15%</div>
                                    </div>

                                    <!-- Bottom row (subtitle) -->
                                    <div style="font-size:11px; color:#6b7280;">Task ID - Ticket #1</div>
                                </div>
                            </div>

                        </div>





                    </div>

                </div>
            </div>
        </div>
    </div>


</div>

<!-- add team -->

<div class="modal fade" id="add_team" tabindex="-1" aria-hidden="true">
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
                        Add Team
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
                            style="flex: 1 1 130px;  background-color: #47ca7a; color: white; border-radius: 20px; padding: 6px 12px; font-weight: 600; font-size: 11px;">
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
                            style="flex: 1 1 130px;  background-color: transparent; color: #7a7a9d; border-radius: 10px; padding: 6px 12px; font-weight: 600; font-size: 11px;">
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
                            style="flex: 1 1 130px;  background-color: transparent; color: #7a7a9d; border-radius: 20px; padding: 6px 12px; font-weight: 600; font-size: 11px;">
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
                            style="flex: 1 1 130px;  background-color: transparent; color: #7a7a9d; border-radius: 20px; padding: 6px 12px; font-weight: 600; font-size: 11px;">
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
                    <div style="background-color: #feefef; color: #7a7a9d; border-radius: 10px; padding: 8px 14px; display: flex; align-items: center; font-size: 12px;">
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
                            style="flex: 1 1 130px;  background-color: #47ca7a; color: white; border-radius: 20px; padding: 6px 12px; font-weight: 600; font-size: 11px;">
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
                            style="flex: 1 1 130px;  background-color: transparent; color: #7a7a9d; border-radius: 10px; padding: 6px 12px; font-weight: 600; font-size: 11px;">
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
                            style="flex: 1 1 130px;  background-color: transparent; color: #7a7a9d; border-radius: 20px; padding: 6px 12px; font-weight: 600; font-size: 11px;">
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
                            style="flex: 1 1 130px; background-color: transparent; color: #7a7a9d; border-radius: 20px; padding: 6px 12px; font-weight: 600; font-size: 11px;">
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
                    <div style="background-color: #feefef; color: #7a7a9d; border-radius: 10px; padding: 8px 14px; display: flex; align-items: center; font-size: 12px;">
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



            </div>

        </div>
    </div>
</div>


<!-- timelines -->
<!-- Modal -->








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
    function showProjectView() {
        // Show project header & details
        document.getElementById("mainHeader").style.display = "block";
      
        document.getElementById("mainContent").style.display = "none";
        document.getElementById("projectDetails").style.display = "block";
        document.getElementById("taskDetails").style.display = "none";
         
        // Active button styles
        document.getElementById("viewTickets").style.background = "#22c55e";
        document.getElementById("viewTickets").style.color = "#fff";

        // Inactive button styles
        document.getElementById("viewTasks").style.background = "";
        document.getElementById("viewTasks").style.color = "#9ca3af";
    }

    function goBack() {
        // Show main view
        document.getElementById("mainHeader").style.display = "block";
        document.getElementById("projectHeader").style.display = "none";
        document.getElementById("taskHeader").style.display = "none";

        document.getElementById("mainContent").style.display = "block";
        document.getElementById("projectDetails").style.display = "none";
        document.getElementById("taskDetails").style.display = "none";
    }

    function showTaskView() {
        document.getElementById("mainHeader").style.display = "block";
        document.getElementById("mainContent").style.display = "none";
        document.getElementById("projectDetails").style.display = "none";
        document.getElementById("taskDetails").style.display = "block";

        // Active button styles
        document.getElementById("viewTasks").style.background = "#22c55e";
        document.getElementById("viewTasks").style.color = "#fff";

        // Inactive button styles
        document.getElementById("viewTickets").style.background = "";
        document.getElementById("viewTickets").style.color = "#9ca3af";
    }
</script>


<script>
    function setActiveButton(el) {
        [...el.parentNode.children].forEach(child => {
            child.style.backgroundColor = '';
            child.style.color = '#9ca3af';
        });
        el.style.backgroundColor = '#22c55e';
        el.style.color = '#ffffff';
    }
</script>

@endsection