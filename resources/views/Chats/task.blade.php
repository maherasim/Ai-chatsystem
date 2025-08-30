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
                    <div class="row d-flex flex-wrap justify-content-between py-2">

                        <!-- Card 1 -->
                        <div class="col-12 col-md-6 col-lg-2 mb-3" style="flex: 0 0 19%;">
                            <div class="px-3 py-2" style="border-radius: 10px; height: 100px; background: #fff; position: relative; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);">
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

                        <!-- Repeat the same structure for the other 4 cards -->

                        <!-- Card 2 -->
                        <div class="col-12 col-md-6 col-lg-2 mb-3" style="flex: 0 0 19%;">
                            <div class="px-3 py-2" style="border-radius: 10px; height: 100px; background: #fff; position: relative; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);">
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
                        <div class="col-12 col-md-6 col-lg-2 mb-3" style="flex: 0 0 19%;">
                            <div class="px-3 py-2" style="border-radius: 10px; height: 100px; background: #fff; position: relative; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);">
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
                        <div class="col-12 col-md-6 col-lg-2 mb-3" style="flex: 0 0 19%;">
                            <div class="px-3 py-2" style="border-radius: 10px; height: 100px; background: #fff; position: relative; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);">
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
                        <div class="col-12 col-md-6 col-lg-2 mb-3" style="flex: 0 0 19%;">
                            <div class="px-3 py-2" style="border-radius: 10px; height: 100px; background: #fff; position: relative; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);">
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
                            <button type="button" class="btn"
                                style="background: #32b768; border: 1px solid #32b768; color: white; border-radius: 6px; font-weight: 500; font-size: 14px; padding: 6px 18px;">
                                + Mobile Task
                            </button>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#add_user"
                                style="background-color:blue ; color: white; border: none; padding: 8px 14px; border-radius: 6px; font-weight: 500; cursor:pointer;">
                                + Web Task
                            </button>

                            <button type="button" class="btn"
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
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="card p-3 mb-3 shadow-sm" style="background: #ffffff; border-radius: 12px; font-family: 'Segoe UI', sans-serif;">

                                <!-- Header Row -->
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <div style="color: #7ED957; font-weight: 600; font-size: 16px;">In Progress</div>
                                        <div style="font-size: 13px; color: #7ED957;">Total Tasks: 10</div>
                                    </div>
                                    <div>
                                        <select class="form-select form-select-sm" style="width: 140px; font-size: 13px;">
                                            <option selected>Select Projects</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Task Card -->
                                <div class="d-flex p-2 rounded" style="background-color: #ebebeb;">

                                    <!-- Task Image (Full height) -->
                                    <div class="me-2">
                                        <img src="{{ asset('build/img/dooted img.svg') }}" alt="Task Image"
                                            style="height: 100%;  width: 50px; border-radius: 6px; object-fit: cover;">
                                    </div>

                                    <!-- Task Content -->
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div style="font-weight: 600; font-size: 14px;">
                                                <img src="{{ asset('build/img/yekbon.svg') }}" alt="" style="width: 30px; height: 30px; margin-right: 4px;">
                                                Task Title
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <!-- Status Dot -->
                                                <span style="width: 12px; height: 12px; background-color: #7ED957; border-radius: 50%; display: inline-block;"></span>
                                                <!-- Avatar -->
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="" style="width: 24px; height: 24px; border-radius: 50%;">
                                            </div>
                                        </div>

                                        <!-- Sub Text -->
                                        <div style="font-size: 12px; color: #6c757d;">Ticket #1 - Ticket Title</div>

                                        <!-- Description -->
                                        <div style="font-size: 13px; margin-top: 2px;">Task description will be here</div>

                                        <!-- Dates & Badge Row -->
                                        <div class="d-flex align-items-center gap-2 mt-2 flex-nowrap" style="background-color:#fff;border-radius:10px;padding:2px;">
                                            <div style="font-size: 12px; background-color: #e6fff2;padding: 4px 8px; border-radius: 6px; color: #00aa55;width:fit-content">

                                                <small>Start: 22.10.2024</small>
                                            </div>

                                            <div style="font-size: 12px; background-color: #e6fff2; padding: 4px 8px; border-radius: 6px; color: #00aa55;">

                                                <small>Deliver: 22.10.2024</small>
                                            </div>

                                            <!-- Deadline/Warning -->
                                            <div class="d-flex align-items-center" style="font-size: 11px; background-color: #ff4d4f; color: white; padding: 2px 6px; border-radius: 6px;">
                                                <img src="https://img.icons8.com/ios-filled/16/ffffff/flash-on.png" style="margin-right: 4px;" />
                                                01
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                    <!-- box project section -->
                    <div class=" mb-1">
                        <div class="row g-1">

                            <!-- 2nd -->

                            <!-- 3rd -->

                            <!-- 4 -->

                        </div>
                    </div>







                </div>
            </div>

        </div>
    </div>


    <!-- new -->

</div>




<div class="modal fade" id="add_user" tabindex="-1" aria-labelledby="projectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content" style="background-color: #fff; border-radius: 12px; font-family: 'Poppins', sans-serif;">
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
            <div class="modal-body px-4 py-4">
                <h5>Add new Projects</h5>
                <small>Project ID</small>

                <!-- Upload and File Row -->
                <div class="row mt-2" style="background-color:#f7f9fc; border-radius: 12px; padding: 15px;">
                    <!-- Upload Logo -->
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3 mb-sm-0">
                        <label for="uploadLogo"
                            class="d-flex flex-column justify-content-center align-items-center text-center"
                            style="width: 100%; height: 138px; border: 2px dashed #cfd3d9; border-radius: 10px; cursor: pointer; background:#f7f9fc; position: relative; overflow: hidden;">
                            <img id="logoPreview" src="" style="display: none; max-height: 100%; max-width: 100%; object-fit: contain;" />
                            <div id="uploadIconText">
                                <div style="font-size: 28px; color: #a0a4ab;">+</div>
                                <small style="font-size: 12px; color: #a0a4ab;">Upload Logo</small>
                            </div>
                            <input type="file" id="uploadLogo" accept="image/*" hidden
                                onchange="var file = this.files[0]; if(file){ var reader = new FileReader(); reader.onload = function(e){ document.getElementById('logoPreview').src = e.target.result; document.getElementById('logoPreview').style.display = 'block'; document.getElementById('uploadIconText').style.display = 'none'; }; reader.readAsDataURL(file); }" />
                        </label>
                    </div>

                    <!-- File Upload Section -->
                    <div class="col-12 col-sm-6 col-md-8 col-lg-9">
                        <div style="border: 2px dashed #cfd3d9; border-radius: 10px; padding: 15px; background:#f7f9fc">
                            <div class="row g-2">
                                <!-- File Box 1 -->
                                <div class="col-12 col-md-6">
                                    <div class="bg-white p-2 rounded d-flex align-items-start justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/8/87/PDF_file_icon.svg" alt="pdf" style="width: 25px; height: 25px;" class="me-2" />
                                            <div>
                                                <div id="pdfName1" style="font-size: 0.85rem;">File Title.pdf</div>
                                                <small id="pdfSize1" style="color: #a0a4ab;">94 KB of 94 KB</small>
                                            </div>
                                        </div>
                                    </div>
                                    <label for="fileUpload1" class="d-flex justify-content-center align-items-center mt-2"
                                        style="height: 40px; background-color: #f0f0f0; border-radius: 6px; cursor: pointer;">
                                        <span style="font-size: 20px; color: #a0a4ab;">+</span>
                                        <input type="file" id="fileUpload1" hidden
                                            onchange=" if (this.files.length > 0) { var file = this.files[0];  var name = file.name;  var sizeKB = (file.size / 1024).toFixed(1); document.getElementById('pdfName1').innerText = name; document.getElementById('pdfSize1').innerText = sizeKB + ' KB of ' + sizeKB + ' KB'; } " />
                                    </label>
                                </div>

                                <!-- File Box 2 -->
                                <div class="col-12 col-md-6">
                                    <div class="bg-white p-2 rounded d-flex align-items-start justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/8/87/PDF_file_icon.svg" alt="pdf" style="width: 25px; height: 25px;" class="me-2" />
                                            <div>
                                                <div id="pdfName2" style="font-size: 0.85rem;">File Title.pdf</div>
                                                <small id="pdfSize2" style="color: #a0a4ab;">94 KB of 94 KB</small>
                                            </div>
                                        </div>
                                    </div>
                                    <label for="fileUpload2" class="d-flex justify-content-center align-items-center mt-2"
                                        style="height: 40px; background-color: #f0f0f0; border-radius: 6px; cursor: pointer;">
                                        <span style="font-size: 20px; color: #a0a4ab;">+</span>
                                        <input type="file" id="fileUpload2" hidden
                                            onchange=" if (this.files.length > 0) { var file = this.files[0]; var name = file.name; var sizeKB = (file.size / 1024).toFixed(1); document.getElementById('pdfName2').innerText = name; document.getElementById('pdfSize2').innerText = sizeKB + ' KB of ' + sizeKB + ' KB'; } " />
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Priority Section -->
                <div class="row mt-2" style="background-color:#f7f9fc; border-radius: 12px; padding: 15px;">
                    <!-- Ticket Priority -->
                    <div class="col-12 col-md-6">
                        <label class="fw-semibold" style="font-size: 14px;">Ticket Priority</label>
                        <div style="font-size: 12px; color: #7d7f85;">Set the Priority of the Ticket</div>
                        <input type="text" placeholder="Project Title" class="form-control mt-2" style="border-radius: 8px;" />
                    </div>

                    <!-- Task Priority -->
                    <div class="col-12 col-md-6">
                        <label class="fw-semibold" style="font-size: 14px;">Ticket Priority</label>
                        <div style="font-size: 12px; color: #7d7f85;">Set the Priority of the Project</div>

                        <!-- Priority Button Group -->
                        <div class="d-flex justify-content-between mt-2 px-2 py-1"
                            style="background-color: #fff; border-radius: 12px;">

                            <button class="btn"
                                style="background-color: #1cc375; color: white; border-radius: 8px; padding: 6px 18px; font-size: 14px;"
                                onclick="
            var btns = this.parentElement.querySelectorAll('button');
            for (var i = 0; i < btns.length; i++) {
                btns[i].style.backgroundColor = 'transparent';
                btns[i].style.color = '#6c757d';
            }
            this.style.backgroundColor = '#1cc375';
            this.style.color = 'white';
        ">Low</button>

                            <button class="btn"
                                style="background-color: transparent; color: #6c757d; border-radius: 8px; padding: 6px 18px; font-size: 14px;"
                                onclick="
            var btns = this.parentElement.querySelectorAll('button');
            for (var i = 0; i < btns.length; i++) {
                btns[i].style.backgroundColor = 'transparent';
                btns[i].style.color = '#6c757d';
            }
            this.style.backgroundColor = '#1cc375';
            this.style.color = 'white';
        ">Middle</button>

                            <button class="btn"
                                style="background-color: transparent; color: #6c757d; border-radius: 8px; padding: 6px 18px; font-size: 14px;"
                                onclick="
            var btns = this.parentElement.querySelectorAll('button');
            for (var i = 0; i < btns.length; i++) {
                btns[i].style.backgroundColor = 'transparent';
                btns[i].style.color = '#6c757d';
            }
            this.style.backgroundColor = '#1cc375';
            this.style.color = 'white';
        ">High</button>
                        </div>

                    </div>

                </div>
                <!-- duration -->

                <div class="row mt-2" style="background-color:#f7f9fc; border-radius: 12px; padding: 20px;">
                    <!-- Project Duration -->
                    <div class="col-12 col-md-6">
                        <label class="fw-semibold" style="font-size: 14px;">Project duration</label>
                        <div style="font-size: 12px; color: #7d7f85;">Set the duration of the Project</div>

                        <!-- Start Date -->
                        <div class="d-flex gap-2 mt-2">
                            <div style="position: relative; width: 100%;">
                                <div style="background-color: #fff; border-radius: 12px; padding: 2px 16px; width: 100%; position: relative; border: 1px solid #e0e0e0; height: 45px; display: flex; flex-direction: column; justify-content: center;">

                                    <!-- Label -->
                                    <div style="font-weight: 600; font-size: 14px; color: #7d7f85;">Start Date</div>

                                    <!-- Selected Date -->
                                    <div id="displayDate" style="font-size: 13px; color: #a0a4ab;">DD:MM:YYYY</div>

                                    <!-- Calendar Icon & Input -->
                                    <div style="position: absolute; top: 50%; right: 16px; transform: translateY(-50%);">
                                        <!-- Icon -->
                                        <img
                                            src="{{ URL::asset('/build/img/timeicon.svg') }}"
                                            onclick="document.getElementById('dateInput').showPicker()"
                                            style="width: 20px; height: 20px; cursor: pointer;" />

                                        <!-- Hidden Input (works with showPicker) -->
                                        <input
                                            type="date"
                                            id="dateInput"
                                            onchange="var d=new Date(this.value); if(this.value)document.getElementById('displayDate').innerText=('0'+d.getDate()).slice(-2)+':' + ('0'+(d.getMonth()+1)).slice(-2)+':'+d.getFullYear();"
                                            style="opacity:0; position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none;" />
                                    </div>
                                </div>
                            </div>

                            <!-- Deliver Date -->
                            <div style="background-color: #fff; border-radius: 12px; padding: 2px 16px; width: 100%; position: relative; border: 1px solid #e0e0e0;height: 45px; display: flex; flex-direction: column; justify-content: center;">

                                <div style="font-weight: 600; font-size: 14px; color: #7d7f85;">Deliver Date</div>

                                <!-- Display selected date -->
                                <div id="deliverDateDisplay" style="font-size: 13px; color: #a0a4ab;">DD:MM:YYYY</div>

                                <!-- Calendar Icon + Hidden Input container -->
                                <div style="position: absolute; top: 50%; right: 16px; transform: translateY(-50%);">
                                    <!-- Calendar Icon -->
                                    <img
                                        src="{{ URL::asset('/build/img/timeicon.svg') }}"
                                        onclick="document.getElementById('deliverDateInput').showPicker()"
                                        style="width: 20px; height: 20px; cursor: pointer;" />

                                    <!-- Hidden Date Input -->
                                    <input
                                        type="date"
                                        id="deliverDateInput"
                                        onchange="var d=new Date(this.value); if(this.value)document.getElementById('deliverDateDisplay').innerText=('0'+d.getDate()).slice(-2)+':' + ('0'+(d.getMonth()+1)).slice(-2)+':'+d.getFullYear();"
                                        style="opacity: 0; position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none;" />
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Expired Reminder -->
                    <div class="col-12 col-md-6">
                        <label class="fw-semibold" style="font-size: 14px;">Expired Reminder</label>
                        <div style="font-size: 12px; color: #7d7f85;">Set a reminder before expired</div>

                        <!-- Reminder Buttons -->
                        <div class="d-flex justify-content-between mt-2 px-1 py-1" style="background-color: #fff; border-radius: 12px;">

                            <button class="btn"
                                style="background-color: #1cc375; color: white; border-radius: 8px; padding: 6px 18px; font-size: 14px;"
                                onclick="
            var btns = this.parentElement.querySelectorAll('button');
            for (var i = 0; i < btns.length; i++) {
                btns[i].style.backgroundColor = 'transparent';
                btns[i].style.color = '#6c757d';
            }
            this.style.backgroundColor = '#1cc375';
            this.style.color = 'white';
        ">7 Days</button>

                            <button class="btn"
                                style="background-color: transparent; color: #6c757d; border-radius: 8px; padding: 6px 18px; font-size: 14px;"
                                onclick="
            var btns = this.parentElement.querySelectorAll('button');
            for (var i = 0; i < btns.length; i++) {
                btns[i].style.backgroundColor = 'transparent';
                btns[i].style.color = '#6c757d';
            }
            this.style.backgroundColor = '#1cc375';
            this.style.color = 'white';
        ">15 Days</button>

                            <button class="btn"
                                style="background-color: transparent; color: #6c757d; border-radius: 8px; padding: 6px 18px; font-size: 14px;"
                                onclick="
            var btns = this.parentElement.querySelectorAll('button');
            for (var i = 0; i < btns.length; i++) {
                btns[i].style.backgroundColor = 'transparent';
                btns[i].style.color = '#6c757d';
            }
            this.style.backgroundColor = '#1cc375';
            this.style.color = 'white';
        ">30 Days</button>
                        </div>

                    </div>
                </div>

                <!-- description -->
                <div class="row mt-2" style="background-color:#f7f9fc; border-radius: 12px; padding: 15px;">
                    <!-- Ticket Priority -->
                    <div class="col-12">
                        <label class="fw-semibold" style="font-size: 14px;">Project Description</label>
                        <div style="font-size: 12px; color: #7d7f85;">Describe the Project well</div>
                        <input type="text" placeholder="Use the currect Editor in the old design" class="form-control mt-2" style="border-radius: 8px;" />
                    </div>

                    <!-- Task Priority -->
                </div>
                <!-- add project section -->
                <div class=" row mt-2 p-3" style="background-color: #f7f9fc; border-radius: 12px;padding: 15px;">
                    <!-- Heading -->
                    <div class="mb-3">
                        <label class="fw-semibold" style="font-size: 14px;">Add Project Section</label>
                        <div style="font-size: 12px; color: #7d7f85;">Type the Content and Press Enter</div>
                    </div>

                    <!-- Section Row 1 -->
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <input type="text" class="form-control" placeholder="Section Name"
                            style="background-color: #fff; font-size: 13px; color: #7d7f85;" />
                        <input type="text" class="form-control" placeholder="Section Description"
                            style="background-color: #fff; font-size: 13px; color: #7d7f85;" />

                    </div>

                    <!-- Section Row 2 -->
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <input type="text" class="form-control" placeholder="Section Name"
                            style="background-color: #fff; font-size: 13px; color: #7d7f85;" />
                        <input type="text" class="form-control" placeholder="Section Description"
                            style="background-color: #fff; font-size: 13px; color: #7d7f85;" />

                    </div>

                    <!-- Footer Buttons -->
                    <div class="d-flex justify-content-center gap-2 mt-3">
                        <button class="btn"
                            style="background-color: #f1f1f1; color: #7d7f85; border-radius: 8px; padding: 6px 20px; font-weight: 500;" data-bs-dismiss="modal">

                            Close
                        </button>
                        <button class="btn"
                            style="background-color: #f1f1f1; color: #7d7f85; border-radius: 8px; padding: 6px 20px; font-weight: 500;"
                            data-bs-dismiss="modal">
                            Save & Close
                        </button>

                    </div>

                </div>



            </div>
        </div>
    </div>
</div>


<!--pause project model Modal -->
<div class="modal fade" id="pauseProjectModal" tabindex="-1" aria-labelledby="pauseModalLabel" aria-hidden="true" style="visibility: visible;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 12px; background-color: #ffffff; padding: 0; font-family: 'Segoe UI', sans-serif;">

            <!-- Header -->
            <div class="modal-header" style="background-color: #f1f1f1; border-bottom: none; padding: 15px 20px;">
                <h5 class="modal-title" id="pauseModalLabel" style="margin: 0; font-weight: 600; color: #1c2b48;">Pause the Project</h5>
            </div>

            <!-- Body -->
            <div class="modal-body" style="text-align: center; padding: 30px 20px 20px;">
                <!-- Icon -->
                <div style="background-color: #f4ba19; width: 60px; height: 60px; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
                    <img src="{{ asset('build/img/pause.svg') }}" alt="Pause Icon" width="28" height="28">
                </div>

                <!-- Text -->
                <p style="font-size: 16px; font-weight: 500; color: #1c2b48;">Please select the reason to Pause the Project</p>

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
                <button type="button" class="btn " data-bs-dismiss="modal" style="background-color:#f1f1f1; color: #1c2b48; border: none; width: 100px;">Close</button>
                <button type="button" class="btn" data-bs-dismiss="modal" style="background-color:#f1f1f1; color: #1c2b48; border: none; width: 130px;">Save & Close</button>
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
                <h5 class="modal-title" id="pauseModalLabel" style="margin: 0; font-weight: 600; color: #1c2b48;">Remove the Project</h5>
            </div>

            <!-- Body -->
            <div class="modal-body" style="text-align: center; padding: 30px 20px 20px;">
                <!-- Warning Message -->
                <div style="background-color: #fff;border: 1px solid #f1f1f1;color: #f44336;font-size: 14px;font-weight: 500;text-align: center;display: flex;align-items: center;justify-content: center;gap: 30px;width: fit-content;padding: 6px 12px;border-radius: 6px;margin: 0 auto 15px;margin-bottom: 15px;">
                    <img src="{{ asset('build/img/tera.svg') }}" alt="Pause Icon" width="15" height="15">
                    Project can't be Removed if there Open Tickets
                </div>

                <!-- Icon -->
                <div style="background-color: #f44336; width: 60px; height: 60px; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
                    <img src="{{ asset('build/img/deletep.svg') }}" alt="Pause Icon" width="28" height="28">
                </div>

                <!-- Text -->
                <p style="font-size: 16px; font-weight: 500; color: #1c2b48;">Please select the reason to remove the Project</p>

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
    function format(command) {
        document.execCommand(command, false, null);
    }

    function setFontSize(value) {
        document.execCommand("fontSize", false, value);
    }

    function removeFormatting() {
        document.execCommand('removeFormat', false, null);
    }

    function addSection() {
        const container = document.getElementById('section-container');

        const wrapper = document.createElement('div');
        wrapper.style.position = 'relative';
        wrapper.style.width = '100%';
        wrapper.style.marginBottom = '10px';

        const input = document.createElement('input');
        input.type = 'text';
        input.placeholder = 'Enter title';
        input.style.width = '100%';
        input.style.paddingRight = '80px';
        input.style.paddingLeft = '12px';
        input.style.height = '38px';
        input.style.border = '1px solid #ced4da';
        input.style.borderRadius = '4px';
        input.style.fontSize = '14px';
        input.style.boxSizing = 'border-box';

        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.textContent = 'Remove';
        removeBtn.onclick = () => wrapper.remove();
        removeBtn.style.position = 'absolute';
        removeBtn.style.right = '0';
        removeBtn.style.top = '0';
        removeBtn.style.height = '100%';
        removeBtn.style.backgroundColor = '#dc3545';
        removeBtn.style.color = 'white';
        removeBtn.style.border = 'none';
        removeBtn.style.borderTopRightRadius = '4px';
        removeBtn.style.borderBottomRightRadius = '4px';
        removeBtn.style.padding = '0 12px';
        removeBtn.style.fontSize = '14px';
        removeBtn.style.cursor = 'pointer';

        wrapper.appendChild(input);
        wrapper.appendChild(removeBtn);
        container.appendChild(wrapper);
    }

    // Add initial section on page load
    window.onload = () => addSection();
</script>
<script>
    function selectItem(elem, containerId) {
        const value = elem.getAttribute("data-value");
        const label = elem.getAttribute("data-label");
        const img = elem.getAttribute("data-img");

        const tagContainer = document.getElementById(containerId);

        // Check if already selected
        if (tagContainer.querySelector(`[data-tag="${value}"]`)) return;

        const tag = document.createElement("div");
        tag.setAttribute("data-tag", value);
        tag.setAttribute("style", `
      display: flex;
      align-items: center;
      padding: 4px 8px;
      background: #f0f0f0;
      border-radius: 4px;
      font-size: 14px;
      white-space: nowrap;
    `);

        const image = document.createElement("img");
        image.src = img;
        image.setAttribute("style", "width: 20px; height: 20px; border-radius: 50%; margin-right: 6px;");

        const span = document.createTextNode(label);

        const close = document.createElement("span");
        close.innerHTML = "&times;";
        close.setAttribute("style", "margin-left: 8px; cursor: pointer; font-weight: bold; color: #333;");
        close.onclick = () => tag.remove();

        tag.appendChild(image);
        tag.appendChild(span);
        tag.appendChild(close);

        tagContainer.appendChild(tag);
    }
</script>
<!-- pause model pop-up -->
<script>
    function openPauseModal() {
        var offcanvasElement = document.getElementById('offcanvasRight');
        if (offcanvasElement) {
            var offcanvasInstance = bootstrap.Offcanvas.getInstance(offcanvasElement);
            if (offcanvasInstance) {
                offcanvasInstance.hide();
            }
        }

        setTimeout(function() {
            var pauseModal = new bootstrap.Modal(document.getElementById('pauseProjectModal'));
            pauseModal.show();
        }, 400);
    }
</script>

<!-- remove project pop-up -->
<script>
    function opendeleteModel() {
        var offcanvasElement = document.getElementById('offcanvasRight');
        if (offcanvasElement) {
            var offcanvasInstance = bootstrap.Offcanvas.getInstance(offcanvasElement);
            if (offcanvasInstance) {
                offcanvasInstance.hide();
            }
        }

        setTimeout(function() {
            var pauseModal = new bootstrap.Modal(document.getElementById('removeproject'));
            pauseModal.show();
        }, 400);
    }
</script>
<!-- dark and light mode -->
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

<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->
@component('components.model-popup')
@endcomponent
@endsection