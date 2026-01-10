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
                <div class="chat-body chat-page-group">
                    <div class="chat-body chat-page-group">

                        <!-- TOday reminde  -->
                        <div class="project-succes pt-1 pb-2 d-flex justify-content-between align-items-center flex-wrap" style="gap:10px;">

                            <div>
                                <h3 style="margin: 0;">TOday's Reminder's</h3>
                                <strong>Reminders: 10</strong>
                            </div>

                            <div class="d-flex flex-wrap justify-content-end align-items-center"
                                style="background: #f8fafc; border-radius: 8px; padding: 6px 10px; gap: 7px; max-width: 100%;">

                                <!-- Buttons -->
                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#meetingModal"
                                    style="border-radius: 6px; font-weight: 500; font-size: 14px; padding: 6px 18px; white-space: nowrap;">
                                    Add Meeting
                                </button>

                                <button type="button" class="btn"
                                    onclick="let btns = this.parentElement.querySelectorAll('button'); btns.forEach(b => { if (!b.classList.contains('btn-danger')) { b.style.background = '#f8fafc'; b.style.color = '#566a7f'; b.style.border = '1px solid transparent'; } }); this.style.background = '#32b768'; this.style.color = 'white'; this.style.border = '1px solid #32b768';"
                                    style="background: #32b768; border: 1px solid #32b768; color: white; border-radius: 6px; font-weight: 500; font-size: 14px; padding: 6px 18px; white-space: nowrap;">
                                    All
                                </button>

                                <button type="button" class="btn"
                                    onclick="let btns = this.parentElement.querySelectorAll('button'); btns.forEach(b => { if (!b.classList.contains('btn-danger')) { b.style.background = '#f8fafc'; b.style.color = '#566a7f'; b.style.border = '1px solid transparent'; } }); this.style.background = '#32b768'; this.style.color = 'white'; this.style.border = '1px solid #32b768';"
                                    style="background: #f8fafc; color: #566a7f; border: 1px solid transparent; border-radius: 6px; font-weight: 500; font-size: 14px; padding: 6px 18px; white-space: nowrap;">
                                    Today Meeting
                                </button>

                                <button type="button" class="btn"
                                    onclick="let btns = this.parentElement.querySelectorAll('button'); btns.forEach(b => { if (!b.classList.contains('btn-danger')) { b.style.background = '#f8fafc'; b.style.color = '#566a7f'; b.style.border = '1px solid transparent'; } }); this.style.background = '#32b768'; this.style.color = 'white'; this.style.border = '1px solid #32b768';"
                                    style="background: #f8fafc; color: #566a7f; border: 1px solid transparent; border-radius: 6px; font-weight: 500; font-size: 14px; padding: 6px 18px; white-space: nowrap;">
                                    New Meeting
                                </button>

                                <button type="button" class="btn"
                                    onclick="let btns = this.parentElement.querySelectorAll('button'); btns.forEach(b => { if (!b.classList.contains('btn-danger')) { b.style.background = '#f8fafc'; b.style.color = '#566a7f'; b.style.border = '1px solid transparent'; } }); this.style.background = '#32b768'; this.style.color = 'white'; this.style.border = '1px solid #32b768';"
                                    style="background: #f8fafc; color: #566a7f; border: 1px solid transparent; border-radius: 6px; font-weight: 500; font-size: 14px; padding: 6px 18px; white-space: nowrap;">
                                    Missed Meeting
                                </button>

                                <div style="position: relative; width: 150px; white-space: nowrap; min-width: 150px;">
                                    <select style="appearance: none; width: 100%; padding: 10px 35px 10px 12px; border: none; border-radius: 12px; background-color: #f8f9fa; color: #94a3b8; font-size: 13px; font-family: 'Poppins', sans-serif; font-weight: 500; box-shadow: inset 0 0 0 1px #e2e8f0; cursor: pointer;">
                                        <option disabled selected>Select Priority</option>
                                        <option value="low">Low</option>
                                        <option value="middle">Middle</option>
                                        <option value="high">High</option>
                                    </select>
                                    <i class="bi bi-chevron-down" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); font-size: 12px; color: #94a3b8; pointer-events: none;"></i>
                                </div>

                            </div>

                        </div>

                        <!-- CARD CONTAINER -->
                        <div class=" row g-3">
                            <div class="col-12 col-sm-6 col-lg-3">
                                <!-- Start of Card 1 -->
                                <div class="card" style=" height:fit-content; border: 1px solid #ef4444; border-radius: 12px; font-family: 'Segoe UI', sans-serif; box-shadow: 0 2px 6px rgba(0,0,0,0.05); overflow: hidden;">

                                    <!-- Header -->
                                    <div class="d-flex justify-content-between align-items-start p-2 pt-3">
                                        <div class="d-flex align-items-center">
                                            <img src="https://via.placeholder.com/40" class="rounded-circle me-2" style="width: 40px; height: 40px;">
                                            <div>
                                                <h6 class="m-0 fw-bold" style="font-size: 13px; color: #1e293b;">Title of Meeting</h6>
                                                <small style="color: #6b7280; font-size: 11px;">Project Title</small>
                                            </div>
                                        </div>
                                        <i class="bi bi-pin-fill" style="color: red; font-size: 18px; transform: rotate(45deg); display: inline-block;"></i>

                                    </div>

                                    <!-- Description -->
                                    <div class="px-3 pt-1 pb-0" style="font-size: 12px; color: #6b7280; line-height: 1.4;">
                                        Here we will add the description of the ToDo Only you is Superadmin ToDo
                                    </div>

                                    <!-- Avatars + user count -->
                                    <div class="text-center mt-2">
                                        <div style="position: relative; display: inline-block; height: 40px; width: 108px;">
                                            <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}" class="rounded-circle" alt="icon" style="position: absolute; left: 0; z-index: 3; width: 36px; height: 36px; border: 2px solid #22c55e;">
                                            <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}" class="rounded-circle" style="position: absolute; left: 20px; z-index: 2; width: 36px; height: 36px; border: 2px solid #3b82f6;">
                                            <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}" class="rounded-circle" style="position: absolute; left: 40px; z-index: 1; width: 36px; height: 36px; border: 2px solid #facc15;">
                                            <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}" class="rounded-circle" style="position: absolute; left: 60px; z-index: 0; width: 36px; height: 36px; border: 2px solid #ef4444;">
                                        </div>
                                        <div style="font-size: 12px; color: #1e293b; font-weight: 500;">1 user online</div>
                                    </div>

                                    <!-- Status Row -->
                                    <div class="d-flex align-items-center justify-content-between px-3 py-2 mt-2" style="font-size: 12px; border-radius: 10px; background: #f8f8f8;">
                                        <!-- Green dot -->
                                        <div class="d-flex align-items-center gap-2">
                                            <span style="width: 12px; height: 12px; background-color: #22c55e; border-radius: 50%; display: inline-block;"></span>
                                        </div>

                                        <!-- Divider -->
                                        <div style="width: 1px; height: 16px; background-color: #e0e0e0;"></div>

                                        <!-- Bell Icon -->
                                        <img src="{{ asset('/build/img/blackbell.svg') }}" alt="Image" style="width: 30px; height: 30px; object-fit: contain;" class="rounded-circle">

                                        <!-- Divider -->
                                        <div style="width: 1px; height: 16px; background-color: #e0e0e0;"></div>

                                        <!-- "Now" Text -->
                                        <span style="color: red; font-weight: 500;">
                                            <img src="{{URL::asset('/build/img/timeicon.svg')}}" alt="Image" style="width: 20px;height:20px;"> Now</span>

                                        <!-- Divider -->
                                        <div style="width: 1px; height: 16px; background-color: #e0e0e0;"></div>

                                        <!-- Clock Icon + Time -->
                                        <div class="d-flex align-items-center gap-1">

                                            <img src="{{URL::asset('/build/img/Clock.svg')}}" alt="Image" style="width: 20px;height:20px;">
                                            <span style="color: #ef4444;">17:30 - 18:00</span>
                                        </div>
                                    </div>

                                    <!-- Join Now Button -->
                                    <div class="text-center py-2">
                                        <button style=" background-color: #22c55e; color: white; padding: 6px 18px; border: none; border-radius: 8px; font-size: 13px; font-weight: 500; cursor: pointer; display: inline-flex; align-items: center; gap: 6px;">
                                            Join now
                                            <img src="{{ URL::asset('/build/img/Logout1.svg') }}" alt="arrow" style="width: 16px; height: 16px;" />
                                        </button>
                                    </div>


                                </div>
                            </div>
                            <!-- End of Card 1 -->
                            <!-- Start of Card 2-->
                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="card" style=" height:fit-content; border: 1px solid #eee;; border-radius: 12px; font-family: 'Segoe UI', sans-serif; box-shadow: 0 2px 6px rgba(0,0,0,0.05); overflow: hidden;">

                                    <!-- Header -->
                                    <div class="d-flex justify-content-between align-items-start p-2 pt-3">
                                        <div class="d-flex align-items-center">
                                            <img src="https://via.placeholder.com/40" class="rounded-circle me-2" style="width: 40px; height: 40px;">
                                            <div>
                                                <h6 class="m-0 fw-bold" style="font-size: 13px; color: #1e293b;">Title of Meeting</h6>
                                                <small style="color: #6b7280; font-size: 11px;">Project Title</small>
                                            </div>
                                        </div>

                                    </div>

                                    <!-- Description -->
                                    <div class="px-3 pt-1 pb-0" style="font-size: 12px; color: #6b7280; line-height: 1.4;">
                                        Here we will add the description of the ToDo Only you is Superadmin ToDo
                                    </div>

                                    <!-- Avatars + user count -->
                                    <div class="text-center mt-2">
                                        <div style="position: relative; display: inline-block; height: 40px; width: 108px;">
                                            <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}" class="rounded-circle" alt="icon" style="position: absolute; left: 0; z-index: 3; width: 36px; height: 36px; border: 2px solid #22c55e;">
                                            <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}" class="rounded-circle" style="position: absolute; left: 20px; z-index: 2; width: 36px; height: 36px; border: 2px solid #3b82f6;">
                                            <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}" class="rounded-circle" style="position: absolute; left: 40px; z-index: 1; width: 36px; height: 36px; border: 2px solid #facc15;">
                                            <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}" class="rounded-circle" style="position: absolute; left: 60px; z-index: 0; width: 36px; height: 36px; border: 2px solid #ef4444;">
                                        </div>
                                        <div style="font-size: 12px; color: #1e293b; font-weight: 500;">1 user online</div>
                                    </div>

                                    <!-- Status Row -->
                                    <div class="d-flex align-items-center justify-content-between px-3 py-2 mt-2" style="font-size: 12px; border-radius: 10px; background: #f8f8f8;">
                                        <!-- Green dot -->
                                        <div class="d-flex align-items-center gap-2">
                                            <span style="width: 12px; height: 12px; background-color: #22c55e; border-radius: 50%; display: inline-block;"></span>
                                        </div>

                                        <!-- Divider -->
                                        <div style="width: 1px; height: 16px; background-color: #e0e0e0;"></div>

                                        <!-- Bell Icon -->
                                        <img src="{{URL::asset('/build/img/timeicon.svg')}}" alt="Image" style="width: 16px;height:16px;">
                                        <span style="color: red;">Today</span>

                                        <!-- Divider -->
                                        <div style="width: 1px; height: 16px; background-color: #e0e0e0;"></div>

                                        <!-- "Now" Text -->


                                        <!-- Clock Icon + Time -->
                                        <div class="d-flex align-items-center gap-1">
                                            <img src="{{URL::asset('/build/img/Clock.svg')}}" alt="Image" style="width: 20px;height:20px;">
                                            <span style="color: #ef4444;">17:30 - 18:00</span>
                                        </div>
                                    </div>

                                    <!-- Join Now Button -->
                                    <div class="text-center py-2">
                                        <button style="background-color: #fbbc05; color: white; padding: 6px 18px; border: none; border-radius: 8px; font-size: 13px; font-weight: 500; cursor: pointer;">
                                            Need Counte
                                        </button>
                                    </div>


                                </div>
                            </div>
                            <!-- End of Card 2 -->
                            <!-- card 3 -->
                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="card" style=" height:fit-content; border: 1px solid #eee;; border-radius: 12px; font-family: 'Segoe UI', sans-serif; box-shadow: 0 2px 6px rgba(0,0,0,0.05); overflow: hidden;">

                                    <!-- Header -->
                                    <div class="d-flex justify-content-between align-items-start p-2 pt-3">
                                        <div class="d-flex align-items-center">
                                            <img src="https://via.placeholder.com/40" class="rounded-circle me-2" style="width: 40px; height: 40px;">
                                            <div>
                                                <h6 class="m-0 fw-bold" style="font-size: 13px; color: #1e293b;">Title of Meeting</h6>
                                                <small style="color: #6b7280; font-size: 11px;">Project Title</small>
                                            </div>
                                        </div>

                                    </div>

                                    <!-- Description -->
                                    <div class="px-3 pt-1 pb-0" style="font-size: 12px; color: #6b7280; line-height: 1.4;">
                                        Here we will add the description of the ToDo Only you is Superadmin ToDo
                                    </div>

                                    <!-- Avatars + user count -->
                                    <div class="text-center mt-2">
                                        <div style="position: relative; display: inline-block; height: 40px; width: 108px;">
                                            <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}" class="rounded-circle" alt="icon" style="position: absolute; left: 0; z-index: 3; width: 36px; height: 36px; border: 2px solid #22c55e;">
                                            <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}" class="rounded-circle" style="position: absolute; left: 20px; z-index: 2; width: 36px; height: 36px; border: 2px solid #3b82f6;">
                                            <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}" class="rounded-circle" style="position: absolute; left: 40px; z-index: 1; width: 36px; height: 36px; border: 2px solid #facc15;">
                                            <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}" class="rounded-circle" style="position: absolute; left: 60px; z-index: 0; width: 36px; height: 36px; border: 2px solid #ef4444;">
                                        </div>
                                        <div style="font-size: 12px; color: #1e293b; font-weight: 500;">1 user online</div>
                                    </div>

                                    <!-- Status Row -->
                                    <div class="d-flex align-items-center justify-content-between px-3 py-2 mt-2" style="font-size: 12px; border-radius: 10px; background: #f8f8f8;">
                                        <!-- Green dot -->
                                        <div class="d-flex align-items-center gap-2">
                                            <span style="width: 12px; height: 12px; background-color: #22c55e; border-radius: 50%; display: inline-block;"></span>
                                        </div>

                                        <!-- Divider -->

                                        <div style="width: 1px; height: 16px; background-color: #e0e0e0;"></div>
                                        <span> <img src="{{URL::asset('/build/img/call.svg')}}" alt="Image" style="width: 20px;height:20px;"></span>
                                        <div style="width: 2px; height: 16px; background-color: #e0e0e0;"></div>
                                        <!-- Bell Icon -->
                                        <img src="{{URL::asset('/build/img/timeicon.svg')}}" alt="Image" style="width: 16px;height:16px;">
                                        <span style="color: red;"> Today</span>

                                        <!-- Divider -->
                                        <div style="width: 1px; height: 16px; background-color: #e0e0e0;"></div>



                                        <!-- Divider -->

                                        <!-- Clock Icon + Time -->
                                        <div class="d-flex align-items-center gap-1">
                                            <img src="{{URL::asset('/build/img/Clock.svg')}}" alt="Image" style="width: 20px;height:20px;">
                                            <span style="color: #ef4444;">17:30 - 18:00</span>
                                        </div>
                                    </div>

                                    <!-- Join Now Button -->
                                    <div style="text-align: center; padding: 6px 0;">
                                        <button style="background-color: #ef233c;color: white;padding: 6px 18px;border: none;border-radius: 25px;font-size: 13px;font-weight: 500;cursor: pointer;display: inline-flex;align-items: center;gap: 8px;">
                                            Missed Meeting
                                            <i class="bi bi-telephone-x" style="font-size: 16px;"></i>
                                        </button>
                                    </div>




                                </div>
                            </div>
                            <!-- 4 -->
                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="card" style=" border-radius: 12px; font-family: 'Segoe UI', sans-serif; box-shadow: 0 2px 6px rgba(0,0,0,0.05); overflow: hidden;">

                                    <!-- Header -->
                                    <div class="d-flex justify-content-between align-items-start p-2 pt-3">
                                        <div class="d-flex align-items-center">
                                            <img src="https://via.placeholder.com/40" class="rounded-circle me-2" style="width: 40px; height: 40px;">
                                            <div>
                                                <h6 class="m-0 fw-bold" style="font-size: 13px; color: #1e293b;">Title of Meeting</h6>
                                                <small style="color: #6b7280; font-size: 11px;">Project Title</small>
                                            </div>
                                        </div>

                                    </div>

                                    <!-- Description -->
                                    <div class="px-3 pt-1 pb-0" style="font-size: 12px; color: #6b7280; line-height: 1.4;">
                                        Here we will add the description of the ToDo Only you is Superadmin ToDo
                                    </div>

                                    <!-- Avatars + user count -->
                                    <div class="text-center mt-2">
                                        <div style="position: relative; display: inline-block; height: 40px; width: 108px;">
                                            <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}" class="rounded-circle" alt="icon" style="position: absolute; left: 0; z-index: 3; width: 36px; height: 36px; border: 2px solid #22c55e;">
                                            <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}" class="rounded-circle" style="position: absolute; left: 20px; z-index: 2; width: 36px; height: 36px; border: 2px solid #3b82f6;">
                                            <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}" class="rounded-circle" style="position: absolute; left: 40px; z-index: 1; width: 36px; height: 36px; border: 2px solid #facc15;">
                                            <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}" class="rounded-circle" style="position: absolute; left: 60px; z-index: 0; width: 36px; height: 36px; border: 2px solid #ef4444;">
                                        </div>
                                        <div style="font-size: 12px; color: #1e293b; font-weight: 500;">1 user online</div>
                                    </div>

                                    <!-- Status Row -->
                                    <div class="d-flex align-items-center justify-content-between px-3 py-2 mt-2" style="font-size: 12px; border-radius: 10px; background: #f8f8f8;">
                                        <!-- Green dot -->
                                        <div class="d-flex align-items-center gap-2">
                                            <span style="width: 12px; height: 12px; background-color: #22c55e; border-radius: 50%; display: inline-block;"></span>
                                        </div>

                                        <!-- Divider -->
                                        <div style="width: 1px; height: 16px; background-color: #e0e0e0;"></div>

                                        <!-- Bell Icon -->
                                        <i class="bi bi-bell-fill text-danger" style="font-size: 14px;"></i>

                                        <!-- Divider -->
                                        <div style="width: 1px; height: 16px; background-color: #e0e0e0;"></div>

                                        <!-- "Now" Text -->
                                        <span style="color: red; font-weight: 500;">Now</span>

                                        <!-- Divider -->
                                        <div style="width: 1px; height: 16px; background-color: #e0e0e0;"></div>

                                        <!-- Clock Icon + Time -->
                                        <div class="d-flex align-items-center gap-1">
                                            <i class="bi bi-clock" style="font-size: 14px; color: #6b7280;"></i>
                                            <span style="color: #ef4444;">17:30 - 18:00</span>
                                        </div>
                                    </div>

                                    <!-- Join Now Button -->
                                    <div class="text-center py-2">
                                        <button style="background-color: #22c55e; color: white; padding: 6px 18px; border: none; border-radius: 8px; font-size: 13px; font-weight: 500; cursor: pointer;">
                                            Join now
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- meeting todo -->
                        <div class="project-succes pt-2 pb-2 d-flex justify-content-between align-items-center">
                            <div>
                                <h3 style="margin: 0;">Meetings Events</h3>
                                <strong>Events: 10</strong>
                            </div>

                            <div class="d-flex" style="gap: 8px; background: #f8fafc; padding: 6px 10px; border-radius: 8px; margin-right: 20px;">
                                <button type="button" class="btn"
                                    onclick="setActive(this)"
                                    style="background: #32b768; border: 1px solid #32b768; color: white; border-radius: 6px; font-weight: 500; font-size: 14px; padding: 6px 18px;">
                                    All
                                </button>
                                <button type="button" class="btn"
                                    onclick="setActive(this)"
                                    style="background: #f8fafc; color: #566a7f; border: 1px solid transparent; border-radius: 6px; font-weight: 500; font-size: 14px; padding: 6px 18px;">
                                    Low
                                </button>
                                <button type="button" class="btn"
                                    onclick="setActive(this)"
                                    style="background: #f8fafc; color: #566a7f; border: 1px solid transparent; border-radius: 6px; font-weight: 500; font-size: 14px; padding: 6px 18px;">
                                    Middle
                                </button>
                            </div>

                            <script>
                                function setActive(button) {
                                    const buttons = button.parentElement.querySelectorAll('button');
                                    buttons.forEach(btn => {
                                        btn.style.background = '#f8fafc';
                                        btn.style.color = '#566a7f';
                                        btn.style.border = '1px solid transparent';
                                    });

                                    button.style.background = '#32b768';
                                    button.style.color = 'white';
                                    button.style.border = '1px solid #32b768';
                                }
                            </script>


                        </div>
                        <!-- CARD CONTAINER -->
                        <div class="row g-3">
                            <!-- Start of Card 1 -->
                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="card" style="border-radius: 12px; font-family: 'Segoe UI', sans-serif; box-shadow: 0 2px 6px rgba(0,0,0,0.05); overflow: hidden; border: 1px solid #eee;">

                                    <!-- Header -->
                                    <div class="d-flex justify-content-between align-items-start p-2 pt-3">
                                        <div class="d-flex align-items-center">
                                            <img src="https://via.placeholder.com/40" class="rounded-circle me-2" style="width: 40px; height: 40px;">
                                            <div>
                                                <h6 class="m-0 fw-bold" style="font-size: 13px; color: #1e293b;">Title of Meeting</h6>
                                                <small style="color: #6b7280; font-size: 11px;">Project Title</small>
                                            </div>
                                        </div>
                                        <i class="bi bi-pin-fill" style="color: red; font-size: 18px; transform: rotate(45deg); display: inline-block;"></i>

                                    </div>

                                    <!-- Description -->
                                    <div class="px-3 pt-1 pb-2" style="font-size: 12px; color: #6b7280; line-height: 1.4; text-align: center;">
                                        Here we will add the description of the ToDo Only you is Superadmin ToDo
                                    </div>

                                    <!-- Accepted / Rejected Avatars -->
                                    <div class="d-flex justify-content-around px-3 pb-2">
                                        <!-- Accepted -->
                                        <div class="text-center">
                                            <div style="font-size: 11px; font-weight: 600; color: #1e293b;">Accepted</div>
                                            <div style="position: relative; width: 45px; height: 30px;">
                                                <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}" class="rounded-circle"
                                                    style="position: absolute; left: 0; z-index: 2; border: 2px solid white; width: 28px; height: 28px;" />
                                                <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}" class="rounded-circle"
                                                    style="position: absolute; left: 15px; z-index: 1; border: 2px solid white; width: 28px; height: 28px;" />
                                            </div>
                                        </div>

                                        <!-- Rejected -->
                                        <div class="text-center">
                                            <div style="font-size: 11px; font-weight: 600; color: #1e293b;">Rejected</div>
                                            <div style="position: relative; width: 45px; height: 30px;">
                                                <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}" class="rounded-circle"
                                                    style="position: absolute; left: 0; z-index: 2; border: 2px solid white; width: 28px; height: 28px;" />
                                                <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}" class="rounded-circle"
                                                    style="position: absolute; left: 15px; z-index: 1; border: 2px solid white; width: 28px; height: 28px;" />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Status Row -->
                                    <div class="d-flex align-items-center gap-2 px-2 py-2 mx-1 mb-2" style="font-size: 11px; border-radius: 10px; background: #fff; border: 1px solid #f3f3f3;">

                                        <!-- Green Dot -->
                                        <span style="width: 12px; height: 12px; background-color: #22c55e; border-radius: 50%; display: inline-block;"></span>

                                        <!-- Divider -->
                                        <div style="width: 1px; height: 16px; background-color: #e0e0e0;"></div>

                                        <!-- Video Icon -->
                                        <img src="{{URL::asset('/build/img/watch.svg')}}" alt="Image" style="width: 20px;height:20px;">

                                        <!-- Divider -->
                                        <div style="width: 1px; height: 16px; background-color: #e0e0e0;"></div>

                                        <!-- Date -->
                                        <span style="color: #e53935; font-weight: 500;">Mon. 22.12.2025</span>

                                        <!-- Divider -->
                                        <div style="width: 2px; height: 16px; background-color: #e0e0e0;"></div>

                                        <!-- Clock + Time -->
                                        <div class="d-flex align-items-center gap-1">
                                            <img src="{{URL::asset('/build/img/Clock.svg')}}" alt="Image" style="width: 16px;height:16px;">
                                            <span style="color: #e53935; font-weight: 500;">17:30 - 18:00</span>
                                        </div>

                                    </div>

                                    <!-- Scheduled Tag -->
                                    <div class="text-center mb-2">
                                        <span style="background-color: #f5f5f5; color: #f44336; font-size: 12px; font-weight: 500; padding: 2px 12px; border-radius: 12px;">
                                            Scheduled
                                        </span>
                                    </div>

                                    <!-- Footer Buttons -->
                                    <div class="d-flex">
                                        <button class="flex-fill text-center py-2" style="background-color: #f1f5f9; border: none; color: #1e293b; font-weight: 500; font-size: 13px;">
                                            Edit
                                        </button>
                                        <button class="flex-fill text-center py-2" style="background-color: #fca5a5; border: none; color: white; font-weight: 500; font-size: 13px;">
                                            Remove
                                        </button>
                                    </div>

                                </div>
                            </div>
                            <!-- End of Card 1 -->
                            <!-- Start of Card 2 (Middle Priority) -->
                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="card" style=" border-radius: 12px; font-family: 'Segoe UI', sans-serif; box-shadow: 0 2px 6px rgba(0,0,0,0.05); overflow: hidden; border: 1px solid #eee;">

                                    <!-- Header -->
                                    <div class="d-flex justify-content-between align-items-start p-2 pt-3">
                                        <div class="d-flex align-items-center">
                                            <img src="https://via.placeholder.com/40" class="rounded-circle me-2" style="width: 40px; height: 40px;">
                                            <div>
                                                <h6 class="m-0 fw-bold" style="font-size: 13px; color: #1e293b;">Title of Meeting</h6>
                                                <small style="color: #6b7280; font-size: 11px;">Project Title</small>
                                            </div>
                                        </div>

                                    </div>

                                    <!-- Description -->
                                    <div class="px-3 pt-1 pb-2" style="font-size: 12px; color: #6b7280; line-height: 1.4; text-align: center;">
                                        Here we will add the description of the ToDo Only you is Superadmin ToDo
                                    </div>

                                    <!-- Accepted / Rejected Avatars -->
                                    <div class="d-flex justify-content-around px-3 pb-2">
                                        <!-- Accepted -->
                                        <div class="text-center">
                                            <div style="font-size: 11px; font-weight: 600; color: #1e293b;">Accepted</div>
                                            <div style="position: relative; width: 45px; height: 30px;">
                                                <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}" class="rounded-circle"
                                                    style="position: absolute; left: 0; z-index: 2; border: 2px solid white; width: 28px; height: 28px;" />
                                                <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}" class="rounded-circle"
                                                    style="position: absolute; left: 15px; z-index: 1; border: 2px solid white; width: 28px; height: 28px;" />
                                            </div>
                                        </div>

                                        <!-- Rejected -->
                                        <div class="text-center">
                                            <div style="font-size: 11px; font-weight: 600; color: #1e293b;">Rejected</div>
                                            <div style="position: relative; width: 45px; height: 30px;">
                                                <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}" class="rounded-circle"
                                                    style="position: absolute; left: 0; z-index: 2; border: 2px solid white; width: 28px; height: 28px;" />
                                                <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}" class="rounded-circle"
                                                    style="position: absolute; left: 15px; z-index: 1; border: 2px solid white; width: 28px; height: 28px;" />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Status Row -->
                                    <div class="d-flex align-items-center gap-2 px-2 py-2 mx-1 mb-2" style="font-size: 11px; border-radius: 10px; background: #fff; border: 1px solid #f3f3f3;">

                                        <!-- Green Dot -->
                                        <span style="width: 12px; height: 12px; background-color: #22c55e; border-radius: 50%; display: inline-block;"></span>

                                        <!-- Divider -->
                                        <div style="width: 1px; height: 16px; background-color: #e0e0e0;"></div>

                                        <!-- Video Icon -->
                                        <img src="{{URL::asset('/build/img/watch.svg')}}" alt="Image" style="width: 20px;height:20px;">

                                        <!-- Divider -->
                                        <div style="width: 1px; height: 16px; background-color: #e0e0e0;"></div>

                                        <!-- Date -->
                                        <span style="color: #e53935; font-weight: 500;">Mon. 22.12.2025</span>

                                        <!-- Divider -->
                                        <div style="width: 2px; height: 16px; background-color: #e0e0e0;"></div>

                                        <!-- Clock + Time -->
                                        <div class="d-flex align-items-center gap-1">
                                            <img src="{{URL::asset('/build/img/Clock.svg')}}" alt="Image" style="width: 16px;height:16px;">
                                            <span style="color: #e53935; font-weight: 500;">17:30 - 18:00</span>
                                        </div>

                                    </div>

                                    <!-- Scheduled Tag -->
                                    <div class="text-center mb-2">
                                        <span style="background-color: #f5f5f5; color: #f44336; font-size: 12px; font-weight: 500; padding: 2px 12px; border-radius: 12px;">
                                            posponed
                                        </span>
                                    </div>

                                    <!-- Footer Buttons -->
                                    <div class="d-flex">
                                        <!-- Accept Button -->
                                        <button class="flex-fill text-center py-2"
                                            style="background-color: #66d19e; border: none; color: white; font-weight: 500; font-size: 13px; border-bottom-left-radius: 8px;">
                                            Accept
                                        </button>

                                        <!-- Denied Button -->
                                        <button class="flex-fill text-center py-2"
                                            style="background-color: #f36c6c; border: none; color: white; font-weight: 500; font-size: 13px; border-bottom-right-radius: 8px;">
                                            Denied
                                        </button>
                                    </div>


                                </div>
                            </div>
                            <!-- End of Card 2 -->
                            <!-- card 3 -->
                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="card" style="border-radius: 12px; font-family: 'Segoe UI', sans-serif; box-shadow: 0 2px 6px rgba(0,0,0,0.05); overflow: hidden; border: 1px solid #eee;">

                                    <!-- Header -->
                                    <div class="d-flex justify-content-between align-items-start p-2 pt-3">
                                        <div class="d-flex align-items-center">
                                            <img src="https://via.placeholder.com/40" class="rounded-circle me-2" style="width: 40px; height: 40px;">
                                            <div>
                                                <h6 class="m-0 fw-bold" style="font-size: 13px; color: #1e293b;">Title of Meeting</h6>
                                                <small style="color: #6b7280; font-size: 11px;">Project Title</small>
                                            </div>
                                        </div>

                                    </div>

                                    <!-- Description -->
                                    <div class="px-3 pt-1 pb-2" style="font-size: 12px; color: #6b7280; line-height: 1.4; text-align: center;">
                                        Here we will add the description of the ToDo Only you is Superadmin ToDo
                                    </div>

                                    <!-- Accepted / Rejected Avatars -->
                                    <div class="d-flex justify-content-around px-3 pb-2">
                                        <!-- Accepted -->
                                        <div class="text-center">
                                            <div style="font-size: 11px; font-weight: 600; color: #1e293b;">Accepted</div>
                                            <div style="position: relative; width: 45px; height: 30px;">
                                                <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}" class="rounded-circle"
                                                    style="position: absolute; left: 0; z-index: 2; border: 2px solid white; width: 28px; height: 28px;" />
                                                <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}" class="rounded-circle"
                                                    style="position: absolute; left: 15px; z-index: 1; border: 2px solid white; width: 28px; height: 28px;" />
                                            </div>
                                        </div>

                                        <!-- Rejected -->
                                        <div class="text-center">
                                            <div style="font-size: 11px; font-weight: 600; color: #1e293b;">Rejected</div>
                                            <div style="position: relative; width: 45px; height: 30px;">
                                                <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}" class="rounded-circle"
                                                    style="position: absolute; left: 0; z-index: 2; border: 2px solid white; width: 28px; height: 28px;" />
                                                <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}" class="rounded-circle"
                                                    style="position: absolute; left: 15px; z-index: 1; border: 2px solid white; width: 28px; height: 28px;" />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Status Row -->
                                    <div class="d-flex align-items-center gap-2 px-2 py-2 mx-1 mb-2" style="font-size: 11px; border-radius: 10px; background: #fff; border: 1px solid #f3f3f3;">

                                        <!-- Green Dot -->
                                        <span style="width: 12px; height: 12px; background-color: #22c55e; border-radius: 50%; display: inline-block;"></span>

                                        <!-- Divider -->
                                        <div style="width: 1px; height: 16px; background-color: #e0e0e0;"></div>

                                        <!-- Video Icon -->
                                        <img src="{{URL::asset('/build/img/de.svg')}}" alt="Image" style="width: 20px;height:20px;">

                                        <!-- Divider -->
                                        <div style="width: 1px; height: 16px; background-color: #e0e0e0;"></div>

                                        <!-- Date -->
                                        <span style="color: #e53935; font-weight: 500;">Mon. 22.12.2025</span>

                                        <!-- Divider -->
                                        <div style="width: 2px; height: 16px; background-color: #e0e0e0;"></div>

                                        <!-- Clock + Time -->
                                        <div class="d-flex align-items-center gap-1">
                                            <img src="{{URL::asset('/build/img/Clock.svg')}}" alt="Image" style="width: 16px;height:16px;">
                                            <span style="color: #e53935; font-weight: 500;">17:30 - 18:00</span>
                                        </div>

                                    </div>

                                    <!-- Scheduled Tag -->
                                    <div class="text-center mb-2">
                                        <span style="background-color: #f5f5f5; color: #f44336; font-size: 12px; font-weight: 500; padding: 2px 12px; border-radius: 12px;">
                                            cancelled
                                        </span>
                                    </div>

                                    <!-- Footer Buttons -->
                                    <div>
                                        <button class="w-100 text-center py-2" data-bs-toggle="modal" data-bs-target="#deniedModal"
                                            style="background-color: #f36c6c; border: none; color: white; font-weight: 500; font-size: 13px; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px;">
                                            Meeting Cancelled
                                        </button>
                                    </div>



                                </div>
                            </div>
                            <!-- 4 -->
                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="card" style="border-radius: 12px; font-family: 'Segoe UI', sans-serif; box-shadow: 0 2px 6px rgba(0,0,0,0.05); overflow: hidden; border: 1px solid #eee;">

                                    <!-- Header -->
                                    <div class="d-flex justify-content-between align-items-start p-2 pt-3">
                                        <div class="d-flex align-items-center">
                                            <img src="https://via.placeholder.com/40" class="rounded-circle me-2" style="width: 40px; height: 40px;">
                                            <div>
                                                <h6 class="m-0 fw-bold" style="font-size: 13px; color: #1e293b;">Title of Meeting</h6>
                                                <small style="color: #6b7280; font-size: 11px;">Project Title</small>
                                            </div>
                                        </div>

                                    </div>

                                    <!-- Description -->
                                    <div class="px-3 pt-1 pb-2" style="font-size: 12px; color: #6b7280; line-height: 1.4; text-align: center;">
                                        Here we will add the description of the ToDo Only you is Superadmin ToDo
                                    </div>

                                    <!-- Accepted / Rejected Avatars -->
                                    <div class="d-flex justify-content-around px-3 pb-2">
                                        <!-- Accepted -->
                                        <div class="text-center">
                                            <div style="font-size: 11px; font-weight: 600; color: #1e293b;">Accepted</div>
                                            <div style="position: relative; width: 45px; height: 30px;">
                                                <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}" class="rounded-circle"
                                                    style="position: absolute; left: 0; z-index: 2; border: 2px solid white; width: 28px; height: 28px;" />
                                                <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}" class="rounded-circle"
                                                    style="position: absolute; left: 15px; z-index: 1; border: 2px solid white; width: 28px; height: 28px;" />
                                            </div>
                                        </div>

                                        <!-- Rejected -->
                                        <div class="text-center">
                                            <div style="font-size: 11px; font-weight: 600; color: #1e293b;">Rejected</div>
                                            <div style="position: relative; width: 45px; height: 30px;">
                                                <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}" class="rounded-circle"
                                                    style="position: absolute; left: 0; z-index: 2; border: 2px solid white; width: 28px; height: 28px;" />
                                                <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}" class="rounded-circle"
                                                    style="position: absolute; left: 15px; z-index: 1; border: 2px solid white; width: 28px; height: 28px;" />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Status Row -->
                                    <div class="d-flex align-items-center gap-2 px-2 py-2 mx-1 mb-2" style="font-size: 11px; border-radius: 10px; background: #fff; border: 1px solid #f3f3f3;">

                                        <!-- Green Dot -->
                                        <span style="width: 12px; height: 12px; background-color: #22c55e; border-radius: 50%; display: inline-block;"></span>

                                        <!-- Divider -->
                                        <div style="width: 1px; height: 16px; background-color: #e0e0e0;"></div>

                                        <!-- Video Icon -->
                                        <img src="{{URL::asset('/build/img/headphone.svg')}}" alt="Image" style="width: 20px;height:20px;">

                                        <!-- Divider -->
                                        <div style="width: 1px; height: 16px; background-color: #e0e0e0;"></div>

                                        <!-- Date -->
                                        <span style="color: #e53935; font-weight: 500;">Mon. 22.12.2025</span>

                                        <!-- Divider -->
                                        <div style="width: 2px; height: 16px; background-color: #e0e0e0;"></div>

                                        <!-- Clock + Time -->
                                        <div class="d-flex align-items-center gap-1">
                                            <img src="{{URL::asset('/build/img/Clock.svg')}}" alt="Image" style="width: 16px;height:16px;">
                                            <span style="color: #e53935; font-weight: 500;">17:30 - 18:00</span>
                                        </div>

                                    </div>

                                    <!-- Scheduled Tag -->
                                    <div class="text-center mb-2">
                                        <span style="background-color: #f5f5f5; color: #f44336; font-size: 12px; font-weight: 500; padding: 2px 12px; border-radius: 12px;">
                                            Scheduled
                                        </span>
                                    </div>

                                    <!-- Footer Buttons -->
                                    <div class="d-flex">
                                        <button class="flex-fill text-center py-2" style="background-color: #f1f5f9; border: none; color: #1e293b; font-weight: 500; font-size: 13px;">
                                            Edit
                                        </button>
                                        <button class="flex-fill text-center py-2" style="background-color: #fca5a5; border: none; color: white; font-weight: 500; font-size: 13px;">
                                            Remove
                                        </button>
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

<!-- Denied Modal -->
<div class="modal fade" id="deniedModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 12px; padding: 15px;">

            <!-- Modal Header -->
            <div style="font-size: 18px; font-weight: 600; margin-bottom: 5px;color:black">
                Deneid Reason
            </div>
            <div style="font-size: 13px; color:black">
                Tell us why ?!
            </div>
            <hr style="background-color: #777; height: 1px; border: none; margin: 10px 0;">

            <!-- Denied Section -->
            <div style="border: 1px solid #eee; border-radius: 12px; padding: 20px; background-color: #f9f9f9;">

                <!-- Icon + Text left aligned -->
                <div style="display: flex; align-items: flex-start; gap: 10px; margin-bottom: 15px;">
                    <img src="{{ asset('build/img/deletep.svg') }}" alt="Pause Icon" width="38px" height="38px">
                    <div>
                        <div style="font-size: 18px; font-weight: 600;color:black">Denied</div>
                        <div style="color: #777; font-size: 13px;">Select reason or Type the reason</div>
                    </div>
                </div>

                <!-- Input Fields -->
                <input type="text" placeholder="Task Priority Select"
                    style="width: 100%; padding: 12px 14px; margin-bottom: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px; background-color: #fff;">

                <textarea placeholder="Type reason here"
                    style="width: 100%;  padding: 12px 14px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px; background-color: #fff; resize: none;"></textarea>

            </div>

            <!-- Save Button -->
            <div class="text-center" style="margin-top: 15px;">
                <button class="btn" data-bs-dismiss="modal"
                    style="background-color: #f7f7f7; border: 1px solid #ddd; border-radius: 8px; padding: 6px 20px; font-size: 14px; font-weight: 500;">
                    Save & Close
                </button>
            </div>

        </div>
    </div>
</div>

<!-- meeting Modal -->
<div class="modal fade" id="meetingModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content" style="border-radius: 15px; border: none; box-shadow: 0 0 20px rgba(0,0,0,0.05);">
            <!-- Close Button -->
            <button type="button"
                data-bs-dismiss="modal"
                aria-label="Close"
                onclick="this.closest('.modal').classList.remove('show'); this.closest('.modal').style.display='none';"
                onmouseover="this.style.backgroundColor='red'; this.style.color='white';"
                onmouseout="this.style.backgroundColor='transparent'; this.style.color='#1e293b';"
                style="color: #1e293b; font-weight: bold; z-index: 999; width: 32px; height: 32px; line-height: 28px; text-align: center; font-size: 20px; position: absolute; top: 8px; right: 12px; border: none; background-color: transparent; border-radius: 50%; transition: all 0.3s ease;">
                ×
            </button>



            <div class="modal-body p-4" style="background-color: white;">
                <!-- Header -->
                <h5 style="font-weight: 600; color: #1e293b;">Scheduled a Meeting</h5>
                <p style="color: #64748b; font-size: 14px;">Connect your Team</p>

                <!-- Meeting Details -->
                <div class="border rounded p-3 mb-3" style="background-color: #f9f9fb;">
                    <p style="color: #64748b; font-size: 13px; margin-bottom: 8px;">Meeting Details</p>

                    <div class="row g-2 mb-2">
                        <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Select Project" style="font-size: 13px;">
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Meeting Title" style="font-size: 13px;">
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Describe the meeting" style="font-size: 13px;">
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Select Members" style="font-size: 13px;">
                        </div>
                    </div>
                </div>
                <!-- Schedule Type Toggle -->
                <div style="background-color: #f9f9fb;">
                    <!-- Toggle Buttons -->
                    <div style="display: flex; justify-content: center; margin-bottom: 6px; margin-top: 4px;">
                        <div style="border-radius: 10px; padding: 4px; display: flex; gap: 8px;">
                            <button id="btnToday"
                                onclick="
                    this.style.backgroundColor='#22c55e';
                    this.style.color='white';
                    document.getElementById('btnScheduled').style.backgroundColor='transparent';
                    document.getElementById('btnScheduled').style.color='#64748b';
                    document.getElementById('startDateField').style.display='none';
                    document.getElementById('timeRow').classList.add('justify-content-center');"
                                style="border: none; background-color: #22c55e; color: white; padding: 6px 12px; border-radius: 6px; font-size: 13px; font-weight: 500;">
                                Meeting Today
                            </button>

                            <button id="btnScheduled"
                                onclick="
                    this.style.backgroundColor='#22c55e';
                    this.style.color='white';
                    document.getElementById('btnToday').style.backgroundColor='transparent';
                    document.getElementById('btnToday').style.color='#64748b';
                    document.getElementById('startDateField').style.display='block';
                    document.getElementById('timeRow').classList.remove('justify-content-center');"
                                style="border: none; background-color: transparent; color: #64748b; padding: 6px 12px; border-radius: 6px; font-size: 13px; font-weight: 500;">
                                Scheduled Meeting
                            </button>
                        </div>
                    </div>

                    <!-- Date & Time Fields -->
                    <div class="row g-2 align-items-center mb-3 justify-content-center" id="timeRow" style="padding-bottom: 4px; display: flex;">

                        <!-- Start Date (hidden by default) -->
                        <div class="col-md-4" id="startDateField" style="position: relative; display: none;">
                            <div style="background-color: #fff; border-radius: 12px; padding: 2px 16px; width: 100%; border: 1px solid #e0e0e0; height: 45px; display: flex; flex-direction: column; justify-content: center;">
                                <div style="font-weight: 600; font-size: 14px; color: #7d7f85;">Start Date</div>
                                <div id="dateDisplay" style="font-size: 13px; color: #a0a4ab;">DD:MM:YYYY</div>
                                <div style="position: absolute; top: 50%; right: 16px; transform: translateY(-50%);">
                                    <img src="{{ URL::asset('/build/img/timeicon.svg') }}"
                                        onclick="document.getElementById('dateInput').showPicker()"
                                        style="width: 20px; height: 20px; cursor: pointer;" />
                                    <input type="date" id="dateInput"
                                        onchange="let d=new Date(this.value); if(this.value)document.getElementById('dateDisplay').innerText=('0'+d.getDate()).slice(-2)+':' + ('0'+(d.getMonth()+1)).slice(-2)+':'+d.getFullYear();"
                                        style="opacity:0; position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none;" />
                                </div>
                            </div>
                        </div>

                        <!-- Start Time -->
                        <div class="col-md-4" style="position: relative;">
                            <div style="background-color: #fff; border-radius: 12px; padding: 2px 16px; width: 100%; border: 1px solid #e0e0e0; height: 45px; display: flex; flex-direction: column; justify-content: center;">
                                <div style="font-weight: 600; font-size: 14px; color: #7d7f85;">Start Time</div>
                                <div id="startTimeDisplay" style="font-size: 13px; color: #a0a4ab;">HH:MM</div>
                                <div style="position: absolute; top: 50%; right: 16px; transform: translateY(-50%);">
                                    <img src="{{ URL::asset('/build/img/timeicon.svg') }}"
                                        onclick="document.getElementById('startTimeInput').showPicker()"
                                        style="width: 20px; height: 20px; cursor: pointer;" />
                                    <input type="time" id="startTimeInput"
                                        onchange="if(this.value)document.getElementById('startTimeDisplay').innerText=this.value;"
                                        style="opacity:0; position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none;" />
                                </div>
                            </div>
                        </div>

                        <!-- End Time -->
                        <div class="col-md-4" style="position: relative;">
                            <div style="background-color: #fff; border-radius: 12px; padding: 2px 16px; width: 100%; border: 1px solid #e0e0e0; height: 45px; display: flex; flex-direction: column; justify-content: center;">
                                <div style="font-weight: 600; font-size: 14px; color: #7d7f85;">End Time</div>
                                <div id="endTimeDisplay" style="font-size: 13px; color: #a0a4ab;">HH:MM</div>
                                <div style="position: absolute; top: 50%; right: 16px; transform: translateY(-50%);">
                                    <img src="{{ URL::asset('/build/img/timeicon.svg') }}"
                                        onclick="document.getElementById('endTimeInput').showPicker()"
                                        style="width: 20px; height: 20px; cursor: pointer;" />
                                    <input type="time" id="endTimeInput"
                                        onchange="if(this.value)document.getElementById('endTimeDisplay').innerText=this.value;"
                                        style="opacity:0; position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none;" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Meeting Links -->
                <!-- Link Toggle Section -->
                <div style="background-color: #f9f9fb; border-radius: 10px; padding: 12px; display: flex; flex-direction: column; align-items: center; width: 100%; max-width: 400px; margin: auto;margin-bottom: 12px;">

                    <div style="display: flex; gap: 10px; justify-content: center; margin-bottom: 12px;">
                        <button id="btnMeet"
                            onclick="
      this.style.backgroundColor='#22c55e';
      this.style.color='white';
      document.getElementById('btnZoom').style.backgroundColor='white';
      document.getElementById('btnZoom').style.color='#64748b';
    "
                            style="border: none; background-color: #22c55e; color: white; padding: 6px 16px;
           border-radius: 6px; font-size: 13px; font-weight: 500;">
                            Meet Link
                        </button>

                        <button id="btnZoom"
                            onclick="
      this.style.backgroundColor='#22c55e';
      this.style.color='white';
      document.getElementById('btnMeet').style.backgroundColor='white';
      document.getElementById('btnMeet').style.color='#64748b';
    "
                            style="border: none; background-color: white; color: #64748b; padding: 6px 16px;
           border-radius: 6px; font-size: 13px; font-weight: 500;">
                            Zoom Link
                        </button>
                    </div>


                    <input type="text"
                        placeholder="Past link"
                        style="width: 100%; background-color: white; color: #64748b; border: none;
           border-radius: 8px; padding: 10px 12px; font-size: 13px; font-weight: 400; text-align: center;">
                </div>


                <!-- ✅ Priority & Reminder Section Styled Box -->
                <div class="p-3 mb-3 rounded" style="background-color: #f5f7fa; box-shadow: inset 0 0 2px rgba(0,0,0,0.05);">
                    <div class="row g-3">
                        <!-- Meeting Priority -->
                        <div class="col-md-6">
                            <p style="font-size: 12px; font-weight: 600; color: #334155;margin-bottom: 2px;">Meeting Priority</p>
                            <p style="font-size: 11px; color: #6b7280;margin-bottom: 8px;">Set the Priority of the Meeting</p>
                            <div class="d-flex gap-2">
                                <button id="priorityLow" onclick=" this.style.backgroundColor='#22c55e'; this.style.color='white'; document.getElementById('priorityMiddle').style.backgroundColor='white'; document.getElementById('priorityMiddle').style.color='#64748b'; document.getElementById('priorityHigh').style.backgroundColor='white'; document.getElementById('priorityHigh').style.color='#64748b' " style="border: none; background-color: #22c55e; color: white; padding: 6px 12px; border-radius: 6px; font-size: 12px;">
                                    Low
                                </button>

                                <button id="priorityMiddle" onclick=" this.style.backgroundColor='#22c55e'; this.style.color='white'; document.getElementById('priorityLow').style.backgroundColor='white'; document.getElementById('priorityLow').style.color='#64748b'; document.getElementById('priorityHigh').style.backgroundColor='white'; document.getElementById('priorityHigh').style.color='#64748b' " style="border: none; background-color: white; color: #64748b; padding: 6px 12px; border-radius: 6px ;font-size: 12px;">
                                    Middle
                                </button>

                                <button id="priorityHigh" onclick=" this.style.backgroundColor='#22c55e'; this.style.color='white'; document.getElementById('priorityLow').style.backgroundColor='white'; document.getElementById('priorityLow').style.color='#64748b'; document.getElementById('priorityMiddle').style.backgroundColor='white'; document.getElementById('priorityMiddle').style.color='#64748b' " style="border: none; background-color: white; color: #64748b; padding: 6px 12px; border-radius: 6px; font-size: 12px;">
                                    High
                                </button>
                            </div>
                        </div>

                        <!-- Expired Reminder -->
                        <div class="col-md-6">
                            <p style="font-size: 12px; font-weight: 600; color: #334155;margin-bottom: 2px;">Expired Reminder</p>
                            <p style="font-size: 11px; color: #6b7280;margin-bottom: 8px;">Set a reminder before expired</p>
                            <div class="d-flex gap-2">
                                <button id="reminder6" onclick="this.style.backgroundColor='#22c55e';this.style.color='white';document.getElementById('reminder12').style.backgroundColor='white';document.getElementById('reminder12').style.color='#64748b';document.getElementById('reminder24').style.backgroundColor='white';document.getElementById('reminder24').style.color='#64748b';" style="border: none; background-color: #22c55e; color: white; padding: 6px 12px; border-radius: 6px;font-size: 12px;">
                                    6 Hr
                                </button>

                                <button id="reminder12" onclick=" this.style.backgroundColor='#22c55e'; this.style.color='white'; document.getElementById('reminder6').style.backgroundColor='white'; document.getElementById('reminder6').style.color='#64748b'; document.getElementById('reminder24').style.backgroundColor='white'; document.getElementById('reminder24').style.color='#64748b' " style="border: none; background-color: white; color: #64748b; padding: 6px 12px; border-radius: 6px; font-size: 12px;">
                                    12 Hr
                                </button>

                                <button id="reminder24" onclick=" this.style.backgroundColor='#22c55e'; this.style.color='white'; document.getElementById('reminder6').style.backgroundColor='white'; document.getElementById('reminder6').style.color='#64748b'; document.getElementById('reminder12').style.backgroundColor='white'; document.getElementById('reminder12').style.color='#64748b' " style="border: none; background-color: white; color: #64748b; padding: 6px 12px; border-radius: 6px; font-size: 12px;">
                                    24 Hr
                                </button>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Submit Button -->
                <div class="text-center">
                    <button class="btn" style="background-color: #5b21b6; color: white; padding: 8px 40px; border-radius: 8px; font-size: 14px;">
                        Create
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>



<!-- add user -->
<div class="modal fade" id="add_user" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header border-0 pb-0">
                <div>
                    <h4 class="modal-title fw-bold">Add New User</h4>
                    <small class="text-muted">User ID : <strong>user -0024</strong></small>
                </div>
                <button type="button" class="custom-close-btn" data-bs-dismiss="modal" aria-label="Close">
                    &times;
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body pt-0">

                <!-- Tabs -->
                <ul class="nav nav-tabs mb-3 border-bottom-0">
                    <li class="nav-item">
                        <a class="nav-link active fw-semibold"
                            data-bs-toggle="tab"
                            href="#basicInfo"
                            style="border: none; color: #f65b0f; border-bottom: 2px solid #f65b0f; background-color: transparent;">
                            Basic Information
                        </a>
                    </li>

                </ul>


                <!-- Tab Content -->
                <div class="tab-content">
                    <!-- Basic Information Tab -->
                    <div class="tab-pane fade show active" id="basicInfo">
                        <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                            @csrf

                            <!-- Profile Upload -->
                            <div class="bg-light rounded py-3 px-3 mb-4 d-flex align-items-center">
                                <!-- Profile Image -->
                                <div class="position-relative d-inline-block" style="width: 80px; height: 80px;">
                                    <img src="{{ URL::asset('/build/img/profiles/avatar-01.jpg') }}"
                                        class="rounded-circle"
                                        alt="Profile Image"
                                        style="width: 80px; height: 80px; object-fit: cover;">

                                    <!-- Hidden File Input -->
                                    <input type="file" name="image" accept="image/*" id="profileImageInput" style="display: none;" onchange="previewImage(event)">

                                    <!-- Overlay + Icon -->
                                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center rounded-circle"
                                        style="background-color: rgba(0, 0, 0, 0.5); opacity: 0; transition: 0.3s; cursor: pointer;"
                                        onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0'"
                                        onclick="document.getElementById('profileImageInput').click();">
                                        <span class="text-white fs-3">+</span>
                                    </div>
                                </div>


                                <!-- Upload Text + Buttons -->
                                <div style="margin-left: 20px;">
                                    <p class="mb-1 fw-medium">Upload Profile Image</p>
                                    <small class="text-muted d-block mb-2">Image should be below 4 mb</small>
                                    <button class="btn btn-warning me-2" style="background-color: #f65b0f; border-color: #f65b0f;">Upload</button>
                                    <button class="btn btn-outline">Cancel</button>
                                </div>
                            </div>


                            <!-- Form Fields -->

                            <div class="row g-3">

                                <div class="col-md-6">
                                    <label class="form-label">First & last Name</label>

                                    <input type="text" name="name" class="form-control" required>
                                    @error('name')
                                    <div class="alert alert-danger mt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Projects</label>
                                    <select class="form-select" name="department" required>
                                        <option selected>Select</option>
                                        <option>All Department</option>
                                        <option>Finance</option>
                                        <option>Developer</option>
                                        <option>Executive</option>
                                    </select>
                                    @error('department')
                                    <div class="alert alert-danger mt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Position</label>
                                    <select class="form-select" name="position" required>
                                        <option selected>Select</option>
                                        <option>All Department</option>
                                        <option>Finance</option>
                                        <option>Developer</option>
                                        <option>Executive</option>
                                    </select>
                                    @error('position')
                                    <div class="alert alert-danger mt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>



                                <div class="col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" required autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
                                    @error('email')
                                    <div class="alert alert-danger mt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label"> Repeat Email</label>
                                    <input type="email" class="form-control" name="remail" required>
                                    @error('remail')
                                    <div class="alert alert-danger mt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" name="passw" required autocomplete="new-password">
                                    @error('passw')
                                    <div class="alert alert-danger mt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Repeat Password</label>
                                    <input type="password" class="form-control" name="rpassw" required autocomplete="new-password">
                                    @error('rpassw')
                                    <div class="alert alert-danger mt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                {{-- <div class="col-md-6">
                                        <label class="form-label">Confirm Password</label>
                                        <input type="password" name="cpassw" class="form-control" required>
                                        @error('cpassw')
                                        <div class="alert alert-danger mt-2">
                                            {{$message}}
                            </div>
                            @enderror
                    </div> --}}


                </div>
                <div style="max-width: 950px; margin: 30px auto; font-family: 'Segoe UI', sans-serif; font-size: 14px;">

                    <!-- Enable Options Header -->
                    <div style="background-color: #f5f6fa; padding: 15px 20px; border-radius: 6px; display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                        <span style="font-weight: 600; color: #0b0b0b;">Enable Options</span>
                        <div style="display: flex; gap: 20px; align-items: center;">
                            <!-- Enable All Module Toggle -->
                            <label style="display: flex; align-items: center; gap: 8px;">
                                <input type="checkbox" style="width: 16px; height: 16px; cursor: pointer;">
                                <span style="color: #6c757d;">Enable all Module</span>
                            </label>

                            <!-- Select All -->
                            <label style="display: flex; align-items: center; gap: 8px;">
                                <input type="checkbox" style="accent-color: #ff6600; width: 16px; height: 16px; cursor: pointer;" checked>
                                <span style="color: #ff6600; font-weight: 500;">Select All</span>
                            </label>
                        </div>
                    </div>

                    <!-- Permissions Table -->
                    <div style="overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse; text-align: center;">

                            <tbody>
                                <!-- clients -->
                                <tr style="background: #fff;">
                                    <!-- Module Enable Switch -->
                                    <td style="padding: 10px; text-align: left; display: flex; align-items: center; gap: 10px;">
                                        <label style="position: relative; display: inline-block; width: 36px; height: 18px;">
                                            <input type="checkbox" name="permissions[clients][enabled]" checked
                                                style="opacity: 0; width: 0; height: 0;"
                                                onchange="this.nextElementSibling.style.backgroundColor = this.checked ? '#ff6600' : '#ccc'; this.nextElementSibling.firstElementChild.style.transform = this.checked ? 'translateX(18px)' : 'translateX(0)';">
                                            <span style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #ff6600; border-radius: 20px; transition: .3s;">
                                                <span style="position: absolute; height: 14px; width: 14px; left: 2px; bottom: 2px; background-color: white; border-radius: 50%; transition: .3s; transform: translateX(18px);"></span>
                                            </span>
                                        </label>
                                        Clients
                                    </td>

                                    <!-- Read -->
                                    <td style="text-align: center;">
                                        <label style="display: flex; align-items: center; gap: 4px;">
                                            <input type="checkbox" name="permissions[clients][read]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                            <span style="font-size: 14px;">Read</span>
                                        </label>
                                    </td>

                                    <!-- Write -->
                                    <td style="text-align: center;">
                                        <label style="display: flex; align-items: center; gap: 4px;">
                                            <input type="checkbox" name="permissions[clients][write]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                            <span style="font-size: 14px;">Write</span>
                                        </label>
                                    </td>

                                    <!-- Delete -->
                                    <td style="text-align: center;">
                                        <label style="display: flex; align-items: center; gap: 4px;">
                                            <input type="checkbox" name="permissions[clients][delete]" checked style="accent-color: #ff6600; width: 16px; height: 16px;">
                                            <span style="font-size: 14px;">Delete</span>
                                        </label>
                                    </td>

                                    <!-- Import -->
                                    <td style="text-align: center;">
                                        <label style="display: flex; align-items: center; gap: 4px;">
                                            <input type="checkbox" name="permissions[clients][import]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                            <span style="font-size: 14px;">Import</span>
                                        </label>
                                    </td>

                                    <!-- Export -->
                                    <td style="text-align: center;">
                                        <label style="display: flex; align-items: center; gap: 4px;">
                                            <input type="checkbox" name="permissions[clients][export]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                            <span style="font-size: 14px;">Export</span>
                                        </label>
                                    </td>
                                </tr>


                                <tr style="background: #fff;">
                                    <!-- Module Enable Switch -->
                                    <td style="padding: 10px; text-align: left; display: flex; align-items: center; gap: 10px;">
                                        <label style="position: relative; display: inline-block; width: 36px; height: 18px;">
                                            <input type="checkbox" name="permissions[leaves][enabled]" checked
                                                style="opacity: 0; width: 0; height: 0;"
                                                onchange="this.nextElementSibling.style.backgroundColor = this.checked ? '#ff6600' : '#ccc'; this.nextElementSibling.firstElementChild.style.transform = this.checked ? 'translateX(18px)' : 'translateX(0)';">
                                            <span style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #ff6600; border-radius: 20px; transition: .3s;">
                                                <span style="position: absolute; height: 14px; width: 14px; left: 2px; bottom: 2px; background-color: white; border-radius: 50%; transition: .3s; transform: translateX(18px);"></span>
                                            </span>
                                        </label>
                                        Leaves
                                    </td>

                                    <!-- Read -->
                                    <td style="text-align: center;">
                                        <label style="display: flex; align-items: center; gap: 4px;">
                                            <input type="checkbox" name="permissions[leaves][read]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                            <span style="font-size: 14px;">Read</span>
                                        </label>
                                    </td>

                                    <!-- Write -->
                                    <td style="text-align: center;">
                                        <label style="display: flex; align-items: center; gap: 4px;">
                                            <input type="checkbox" name="permissions[leaves][write]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                            <span style="font-size: 14px;">Write</span>
                                        </label>
                                    </td>

                                    <!-- Delete -->
                                    <td style="text-align: center;">
                                        <label style="display: flex; align-items: center; gap: 4px;">
                                            <input type="checkbox" name="permissions[leaves][delete]" checked style="accent-color: #ff6600; width: 16px; height: 16px;">
                                            <span style="font-size: 14px;">Delete</span>
                                        </label>
                                    </td>

                                    <!-- Import -->
                                    <td style="text-align: center;">
                                        <label style="display: flex; align-items: center; gap: 4px;">
                                            <input type="checkbox" name="permissions[leaves][import]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                            <span style="font-size: 14px;">Import</span>
                                        </label>
                                    </td>

                                    <!-- Export -->
                                    <td style="text-align: center;">
                                        <label style="display: flex; align-items: center; gap: 4px;">
                                            <input type="checkbox" name="permissions[leaves][export]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                            <span style="font-size: 14px;">Export</span>
                                        </label>
                                    </td>
                                </tr>


                                <tr style="background: #fff;">
                                    <td style="padding: 10px; text-align: left; display: flex; align-items: center; gap: 10px;">
                                        <!-- Enabled Switch -->
                                        <label style="position: relative; display: inline-block; width: 36px; height: 18px;">
                                            <input type="checkbox" name="permissions[holidays][enabled]" checked
                                                style="opacity: 0; width: 0; height: 0;"
                                                onchange="this.nextElementSibling.style.backgroundColor = this.checked ? '#ff6600' : '#ccc'; this.nextElementSibling.firstElementChild.style.transform = this.checked ? 'translateX(18px)' : 'translateX(0)';">
                                            <span style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #ff6600; border-radius: 20px; transition: .3s;">
                                                <span style="position: absolute; height: 14px; width: 14px; left: 2px; bottom: 2px; background-color: white; border-radius: 50%; transition: .3s; transform: translateX(18px);"></span>
                                            </span>
                                        </label>
                                        Holidays
                                    </td>

                                    <td style="text-align: center;">
                                        <label style="display: flex; align-items: center; gap: 4px;">
                                            <input type="checkbox" name="permissions[holidays][read]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                            <span style="font-size: 14px;">Read</span>
                                        </label>
                                    </td>

                                    <td style="text-align: center;">
                                        <label style="display: flex; align-items: center; gap: 4px;">
                                            <input type="checkbox" name="permissions[holidays][write]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                            <span style="font-size: 14px;">Write</span>
                                        </label>
                                    </td>

                                    <td style="text-align: center;">
                                        <label style="display: flex; align-items: center; gap: 4px;">
                                            <input type="checkbox" name="permissions[holidays][delete]" checked style="accent-color: #ff6600; width: 16px; height: 16px;">
                                            <span style="font-size: 14px;">Delete</span>
                                        </label>
                                    </td>

                                    <td style="text-align: center;">
                                        <label style="display: flex; align-items: center; gap: 4px;">
                                            <input type="checkbox" name="permissions[holidays][import]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                            <span style="font-size: 14px;">Import</span>
                                        </label>
                                    </td>

                                    <td style="text-align: center;">
                                        <label style="display: flex; align-items: center; gap: 4px;">
                                            <input type="checkbox" name="permissions[holidays][export]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                            <span style="font-size: 14px;">Export</span>
                                        </label>
                                    </td>
                                </tr>


                                <!-- projects -->
                                <tr style="background: #fff;">
                                    <!-- Module Enable Switch -->
                                    <td style="padding: 10px; text-align: left; display: flex; align-items: center; gap: 10px;">
                                        <label style="position: relative; display: inline-block; width: 36px; height: 18px;">
                                            <input type="checkbox" name="permissions[projects][enabled]" checked
                                                style="opacity: 0; width: 0; height: 0;"
                                                onchange="this.nextElementSibling.style.backgroundColor = this.checked ? '#ff6600' : '#ccc'; this.nextElementSibling.firstElementChild.style.transform = this.checked ? 'translateX(18px)' : 'translateX(0)';">
                                            <span style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #ff6600; border-radius: 20px; transition: .3s;">
                                                <span style="position: absolute; height: 14px; width: 14px; left: 2px; bottom: 2px; background-color: white; border-radius: 50%; transition: .3s; transform: translateX(18px);"></span>
                                            </span>
                                        </label>
                                        Projects
                                    </td>

                                    <!-- Read -->
                                    <td style="text-align: center;">
                                        <label style="display: flex; align-items: center; gap: 4px;">
                                            <input type="checkbox" name="permissions[projects][read]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                            <span style="font-size: 14px;">Read</span>
                                        </label>
                                    </td>

                                    <!-- Write -->
                                    <td style="text-align: center;">
                                        <label style="display: flex; align-items: center; gap: 4px;">
                                            <input type="checkbox" name="permissions[projects][write]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                            <span style="font-size: 14px;">Write</span>
                                        </label>
                                    </td>

                                    <!-- Delete -->
                                    <td style="text-align: center;">
                                        <label style="display: flex; align-items: center; gap: 4px;">
                                            <input type="checkbox" name="permissions[projects][delete]" checked style="accent-color: #ff6600; width: 16px; height: 16px;">
                                            <span style="font-size: 14px;">Delete</span>
                                        </label>
                                    </td>

                                    <!-- Import -->
                                    <td style="text-align: center;">
                                        <label style="display: flex; align-items: center; gap: 4px;">
                                            <input type="checkbox" name="permissions[projects][import]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                            <span style="font-size: 14px;">Import</span>
                                        </label>
                                    </td>

                                    <!-- Export -->
                                    <td style="text-align: center;">
                                        <label style="display: flex; align-items: center; gap: 4px;">
                                            <input type="checkbox" name="permissions[projects][export]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                            <span style="font-size: 14px;">Export</span>
                                        </label>
                                    </td>
                                </tr>


                                <!-- Tasks -->
                                <tr style="background: #fff;">
                                    <td style="padding: 10px; text-align: left; display: flex; align-items: center; gap: 10px;">
                                        <label style="position: relative; display: inline-block; width: 36px; height: 18px;">
                                            <input type="checkbox" name="permissions[tasks][enabled]" checked
                                                style="opacity: 0; width: 0; height: 0;"
                                                onchange="this.nextElementSibling.style.backgroundColor = this.checked ? '#ff6600' : '#ccc'; this.nextElementSibling.firstElementChild.style.transform = this.checked ? 'translateX(18px)' : 'translateX(0)';">
                                            <span style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #ff6600; border-radius: 20px; transition: .3s;">
                                                <span style="position: absolute; height: 14px; width: 14px; left: 2px; bottom: 2px; background-color: white; border-radius: 50%; transition: .3s; transform: translateX(18px);"></span>
                                            </span>
                                        </label>
                                        Tasks
                                    </td>

                                    <td style="text-align: center;">
                                        <label style="display: flex; align-items: center; gap: 4px;">
                                            <input type="checkbox" name="permissions[tasks][read]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                            <span style="font-size: 14px;">Read</span>
                                        </label>
                                    </td>

                                    <td style="text-align: center;">
                                        <label style="display: flex; align-items: center; gap: 4px;">
                                            <input type="checkbox" name="permissions[tasks][write]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                            <span style="font-size: 14px;">Write</span>
                                        </label>
                                    </td>

                                    <td style="text-align: center;">
                                        <label style="display: flex; align-items: center; gap: 4px;">
                                            <input type="checkbox" name="permissions[tasks][delete]" checked style="accent-color: #ff6600; width: 16px; height: 16px;">
                                            <span style="font-size: 14px;">Delete</span>
                                        </label>
                                    </td>

                                    <td style="text-align: center;">
                                        <label style="display: flex; align-items: center; gap: 4px;">
                                            <input type="checkbox" name="permissions[tasks][import]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                            <span style="font-size: 14px;">Import</span>
                                        </label>
                                    </td>

                                    <td style="text-align: center;">
                                        <label style="display: flex; align-items: center; gap: 4px;">
                                            <input type="checkbox" name="permissions[tasks][export]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                            <span style="font-size: 14px;">Export</span>
                                        </label>
                                    </td>
                                </tr>

                                <!-- Chats -->
                                <tr style="background: #fff;">
                                    <td style="padding: 10px; text-align: left; display: flex; align-items: center; gap: 10px;">
                                        <label style="position: relative; display: inline-block; width: 36px; height: 18px;">
                                            <input type="checkbox" name="permissions[chats][enabled]" checked
                                                style="opacity: 0; width: 0; height: 0;"
                                                onchange="this.nextElementSibling.style.backgroundColor = this.checked ? '#ff6600' : '#ccc'; this.nextElementSibling.firstElementChild.style.transform = this.checked ? 'translateX(18px)' : 'translateX(0)';">
                                            <span style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #ff6600; border-radius: 20px; transition: .3s;">
                                                <span style="position: absolute; height: 14px; width: 14px; left: 2px; bottom: 2px; background-color: white; border-radius: 50%; transition: .3s; transform: translateX(18px);"></span>
                                            </span>
                                        </label>
                                        Chats
                                    </td>

                                    <td style="text-align: center;">
                                        <label style="display: flex; align-items: center; gap: 4px;">
                                            <input type="checkbox" name="permissions[chats][read]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                            <span style="font-size: 14px;">Read</span>
                                        </label>
                                    </td>

                                    <td style="text-align: center;">
                                        <label style="display: flex; align-items: center; gap: 4px;">
                                            <input type="checkbox" name="permissions[chats][write]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                            <span style="font-size: 14px;">Write</span>
                                        </label>
                                    </td>

                                    <td style="text-align: center;">
                                        <label style="display: flex; align-items: center; gap: 4px;">
                                            <input type="checkbox" name="permissions[chats][delete]" checked style="accent-color: #ff6600; width: 16px; height: 16px;">
                                            <span style="font-size: 14px;">Delete</span>
                                        </label>
                                    </td>

                                    <td style="text-align: center;">
                                        <label style="display: flex; align-items: center; gap: 4px;">
                                            <input type="checkbox" name="permissions[chats][import]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                            <span style="font-size: 14px;">Import</span>
                                        </label>
                                    </td>

                                    <td style="text-align: center;">
                                        <label style="display: flex; align-items: center; gap: 4px;">
                                            <input type="checkbox" name="permissions[chats][export]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                            <span style="font-size: 14px;">Export</span>
                                        </label>
                                    </td>
                                </tr>

                                <!-- Assets -->
                                <tr style="background: #fff;">
                                    <td style="padding: 10px; text-align: left; display: flex; align-items: center; gap: 10px;">
                                        <label style="position: relative; display: inline-block; width: 36px; height: 18px;">
                                            <input type="checkbox" name="permissions[assets][enabled]" checked
                                                style="opacity: 0; width: 0; height: 0;"
                                                onchange="this.nextElementSibling.style.backgroundColor = this.checked ? '#ff6600' : '#ccc'; this.nextElementSibling.firstElementChild.style.transform = this.checked ? 'translateX(18px)' : 'translateX(0)';">
                                            <span style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #ff6600; border-radius: 20px; transition: .3s;">
                                                <span style="position: absolute; height: 14px; width: 14px; left: 2px; bottom: 2px; background-color: white; border-radius: 50%; transition: .3s; transform: translateX(18px);"></span>
                                            </span>
                                        </label>
                                        Assets
                                    </td>

                                    <td style="text-align: center;">
                                        <label style="display: flex; align-items: center; gap: 4px;">
                                            <input type="checkbox" name="permissions[assets][read]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                            <span style="font-size: 14px;">Read</span>
                                        </label>
                                    </td>

                                    <td style="text-align: center;">
                                        <label style="display: flex; align-items: center; gap: 4px;">
                                            <input type="checkbox" name="permissions[assets][write]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                            <span style="font-size: 14px;">Write</span>
                                        </label>
                                    </td>

                                    <td style="text-align: center;">
                                        <label style="display: flex; align-items: center; gap: 4px;">
                                            <input type="checkbox" name="permissions[assets][delete]" checked style="accent-color: #ff6600; width: 16px; height: 16px;">
                                            <span style="font-size: 14px;">Delete</span>
                                        </label>
                                    </td>

                                    <td style="text-align: center;">
                                        <label style="display: flex; align-items: center; gap: 4px;">
                                            <input type="checkbox" name="permissions[assets][import]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                            <span style="font-size: 14px;">Import</span>
                                        </label>
                                    </td>

                                    <td style="text-align: center;">
                                        <label style="display: flex; align-items: center; gap: 4px;">
                                            <input type="checkbox" name="permissions[assets][export]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                            <span style="font-size: 14px;">Export</span>
                                        </label>
                                    </td>
                                </tr>

                                <!-- Timming sheets -->
                                <tr style="background: #fff;">
                                    <td style="padding: 10px; text-align: left; display: flex; align-items: center; gap: 10px;">
                                        <label style="position: relative; display: inline-block; width: 36px; height: 18px;">
                                            <input type="checkbox" name="permissions[timming_sheets][enabled]" checked
                                                style="opacity: 0; width: 0; height: 0;"
                                                onchange="this.nextElementSibling.style.backgroundColor = this.checked ? '#ff6600' : '#ccc'; this.nextElementSibling.firstElementChild.style.transform = this.checked ? 'translateX(18px)' : 'translateX(0)';">
                                            <span style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #ff6600; border-radius: 20px; transition: .3s;">
                                                <span style="position: absolute; height: 14px; width: 14px; left: 2px; bottom: 2px; background-color: white; border-radius: 50%; transition: .3s; transform: translateX(18px);"></span>
                                            </span>
                                        </label>
                                        Timming Sheets
                                    </td>

                                    <td style="text-align: center;">
                                        <label style="display: flex; align-items: center; gap: 4px;">
                                            <input type="checkbox" name="permissions[timming_sheets][read]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                            <span style="font-size: 14px;">Read</span>
                                        </label>
                                    </td>

                                    <td style="text-align: center;">
                                        <label style="display: flex; align-items: center; gap: 4px;">
                                            <input type="checkbox" name="permissions[timming_sheets][write]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                            <span style="font-size: 14px;">Write</span>
                                        </label>
                                    </td>

                                    <td style="text-align: center;">
                                        <label style="display: flex; align-items: center; gap: 4px;">
                                            <input type="checkbox" name="permissions[timming_sheets][delete]" checked style="accent-color: #ff6600; width: 16px; height: 16px;">
                                            <span style="font-size: 14px;">Delete</span>
                                        </label>
                                    </td>

                                    <td style="text-align: center;">
                                        <label style="display: flex; align-items: center; gap: 4px;">
                                            <input type="checkbox" name="permissions[timming_sheets][import]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                            <span style="font-size: 14px;">Import</span>
                                        </label>
                                    </td>

                                    <td style="text-align: center;">
                                        <label style="display: flex; align-items: center; gap: 4px;">
                                            <input type="checkbox" name="permissions[timming_sheets][export]" style="accent-color: #ff6600; width: 16px; height: 16px;">
                                            <span style="font-size: 14px;">Export</span>
                                        </label>
                                    </td>
                                </tr>







                            </tbody>
                        </table>

                    </div>

                </div>
                <!-- Modal Footer -->
                <div class="modal-footer border-top-0 pt-0">
                    <div class="d-flex ms-auto gap-2">
                        <button type="button" class="btn btn-outline" style="min-width: 100px;" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn text-white" style="background-color: #f65b0f; border-color: #f65b0f; min-width: 100px;">Save</button>
                    </div>
                </div>
                </form>
            </div>
        </div>

        <!-- creaTE meting MODEL POPIP -->

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