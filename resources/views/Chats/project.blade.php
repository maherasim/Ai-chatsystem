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
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin: 10px;">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="ti ti-x"></i></button>
        </div>
        @endif
        <div>
            @include('Chats.header')
            <!-- body -->
            <div style="overflow-y: auto;flex:1;height: 100vh;">
                <div class="chat-body chat-page-group">
                    <!-- Container for the full width -->
                    <div class="container-fluid px-4">
                        <div class="row g-3 py-2">
                            <!-- Card 1: Total Projects -->
                            <div class="col-md-3 mb-3">
                                <div class="px-3 py-2"
                                    style="border-radius: 10px; height: 100px; background: #fff; position: relative; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);">

                                    <!-- Top Row -->
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div style="font-size: 0.9rem; color: #1e2b4d;">Total Projects</div>
                                        <div style="background-color: #eae8fd; padding: 5px;">
                                            <img src="{{ URL::asset('/build/img/sigma.svg') }}" alt="icon"
                                                style="width: 20px; height: 20px;" />
                                        </div>
                                    </div>

                                    <!-- Project Number -->
                                    <div class="fw-bold mt-1" style="font-size: 1.5rem; color: #1e2b4d;">
                                        {{ $totalProjects ?? 0 }}
                                    </div>

                                    <!-- Percentage Change (Bottom Right) -->
                                    <div
                                        style="position: absolute; bottom: 8px; right: 16px; font-size: 0.9rem; color: #28c76f;">
                                        <i class="bi bi-arrow-up-right"></i> 8.5%
                                    </div>

                                </div>
                            </div>

                            <!-- card-2 -->
                            <div class="col-md-3 mb-3">
                                <div class="px-3 py-2"
                                    style="border-radius: 10px; height: 100px; background: #fff; position: relative; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);">

                                    <!-- Top Row -->
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div style="font-size: 0.9rem; color: #1e2b4d;">In Progress</div>
                                        <div style="background-color: #e9f8dd;  padding: 5px;">
                                            <img src="{{ URL::asset('/build/img/greenflag.svg') }}" alt="icon"
                                                style="width: 20px; height: 20px;" />
                                        </div>
                                    </div>

                                    <!-- Project Number -->
                                    <div class="fw-bold mt-1" style="font-size: 1.5rem; color: #1e2b4d;">
                                        {{ $inProgressCount ?? 0 }}
                                    </div>

                                    <!-- Percentage Change (Bottom Right) -->
                                    <div
                                        style="position: absolute; bottom: 8px; right: 16px; font-size: 0.9rem; color: #28c76f;">
                                        <i class="bi bi-arrow-up-right"></i> 8.5%
                                    </div>

                                </div>
                            </div>
                            <!-- card 3 -->

                            <div class="col-md-3 mb-3">
                                <div class="px-3 py-2"
                                    style="border-radius: 10px; height: 100px; background: #fff; position: relative; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);">

                                    <!-- Top Row -->
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div style="font-size: 0.9rem; color: #1e2b4d;">In Hold</div>
                                        <div style="background-color: #fff3cd;  padding: 5px;">
                                            <img src="{{ URL::asset('/build/img/yelowflag.svg') }}" alt="icon"
                                                style="width: 20px; height: 20px;" />
                                        </div>
                                    </div>

                                    <!-- Project Number -->
                                    <div class="fw-bold mt-1" style="font-size: 1.5rem; color: #1e2b4d;">
                                        {{ $inHoldCount ?? 0 }}
                                    </div>

                                    <!-- Percentage Change (Bottom Right) -->
                                    <div
                                        style="position: absolute; bottom: 8px; right: 16px; font-size: 0.9rem; color: #ff2e2e">
                                        <i class="bi bi-arrow-down-right"></i> 8.5%
                                    </div>

                                </div>
                            </div>


                            <!-- card 4 -->

                            <div class="col-md-3 mb-3">
                                <div class="px-3 py-2"
                                    style="border-radius: 10px; height: 100px; background: #fff; position: relative; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);">

                                    <!-- Top Row -->
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div style="font-size: 0.9rem; color: #1e2b4d;">In Delayed</div>
                                        <div style="background-color: #fddede;  padding: 5px;">
                                            <img src="{{ URL::asset('/build/img/redflag.svg') }}" alt="icon"
                                                style="width: 20px; height: 20px;" />
                                        </div>
                                    </div>

                                    <!-- Project Number -->
                                    <div class="fw-bold mt-1" style="font-size: 1.5rem; color: #1e2b4d;">
                                        {{ $delayedCount ?? 0 }}
                                    </div>

                                    <!-- Percentage Change (Bottom Right) -->
                                    <div
                                        style="position: absolute; bottom: 8px; right: 16px; font-size: 0.9rem; color: #ff2e2e;">
                                        <i class="bi bi-arrow-down-right"></i> 8.5%
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- project overview -->
                    <div
                        class="project-succes pt-4 pb-2 d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                        <div>
                            <h3 style="margin: 0;">Project overview</h3>
                            <strong>Total projects: {{ $totalProjects ?? 0 }}</strong>
                        </div>

                        <div class="d-flex flex-wrap justify-content-start"
                            style="gap: 8px; background: #f8fafc; padding: 6px 10px; border-radius: 8px;">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#add_project"
                                style="background-color: #ff7700; color: white; border: none; padding: 8px 14px; border-radius: 6px; font-weight: 500; cursor:pointer;">
                                + Add Project
                            </button>
                            <button type="button" class="btn"
                                style="background: #32b768; border: 1px solid #32b768; color: white; border-radius: 6px; font-weight: 500; font-size: 14px; padding: 6px 18px;">
                                All
                            </button>
                            <button type="button" class="btn"
                                style="background: #f8fafc; color: #566a7f; border-radius: 6px; font-weight: 500; font-size: 14px; padding: 6px 18px;">
                                In Progress
                            </button>
                            <button type="button" class="btn"
                                style="background: #f8fafc; color: #566a7f; border-radius: 6px; font-weight: 500; font-size: 14px; padding: 6px 18px;">
                                In Delayed
                            </button>
                            <button type="button" class="btn"
                                style="background: #f8fafc; color: #566a7f; border-radius: 6px; font-weight: 500; font-size: 14px; padding: 6px 18px;">
                                In Hold
                            </button>
                        </div>
                    </div>

                    <!-- box project section -->
                    <div class=" mb-1">
                        <div class="row g-1">
                            @php($projectList = isset($projects) ? $projects : collect())
                            @foreach ($projectList as $project)
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                <div class="card shadow-sm  p-2"
                                    style="border-radius: 20px; font-family:    'Segoe UI', sans-serif;">
                                    <!-- Top Row: Circle, Center Image, 3 Dots -->
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <!-- Progress Circle -->
                                        <div style="width: 60px; height: 60px; position: relative;">
                                            <svg width="60" height="60">
                                                <circle cx="30" cy="30" r="26" stroke="#d1d1d1"
                                                    stroke-width="6" fill="none" />
                                                <circle cx="30" cy="30" r="26" stroke="url(#grad)"
                                                    stroke-width="6" fill="none" stroke-dasharray="163.36"
                                                    stroke-dashoffset="122.52" stroke-linecap="round"
                                                    transform="rotate(-90 30 30)" />
                                                <defs>
                                                    <linearGradient id="grad" x1="0%" y1="0%"
                                                        x2="100%" y2="0%">
                                                        <stop offset="0%" stop-color="#ff7f00" />
                                                        <stop offset="100%" stop-color="#fcd34d" />
                                                    </linearGradient>
                                                </defs>
                                            </svg>
                                            <div
                                                style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 12px; font-weight: bold; color: #333;">
                                                25%
                                            </div>
                                        </div>

                                        <!-- Logo Image -->
                                        <div>
                                            <img src="{{ $project->logo_path ? asset('storage/' . $project->logo_path) : URL::asset('/build/img/yekbon.svg') }}"
                                                class="rounded-circle"
                                                style="height: 65px; width: 65px; object-fit: cover;"
                                                alt="Project Logo">
                                        </div>

                                        <!-- Progress Status Badge -->
                                        <div>
                                            <div style="background: #e1effe;padding: 5px;">
                                                <img src="{{ URL::asset('/build/img/blueflag.svg') }}"
                                                    style="height: 20px; width: 20px; " alt="flag" />

                                            </div>
                                        </div>
                                    </div>


                                    <!-- Project Title -->
                                    <div class="text-center" style="font-weight: bold; font-size: 16px; cursor: pointer;">
                                        <h6 style="cursor: pointer;"
                                            data-bs-toggle="offcanvas"
                                            data-bs-target="#offcanvasRight"
                                            aria-controls="offcanvasRight">
                                            {{ $project->title }}
                                        </h6>
                                    </div>


                                    <div class="row mb-2 mt-2 m-0 w-100"
                                        style="background-color: #f9f9f9; border-radius: 12px; padding: 5px 2px;">
                                        <!-- Start Date -->
                                        <div class="col-4">
                                            <strong
                                                style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #1e60a1; font-size: 12px;margin-right:13px;">
                                                Start Date
                                            </strong>
                                            <div style="color: #1e60a1; font-weight: 600; font-size: 12px;">

                                                {{ optional($project->start_date)->format('d:m:Y') }}
                                            </div>
                                        </div>

                                        <!-- Work Days -->
                                        <div class="col-4">
                                            <strong
                                                style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #1e60a1; font-size: 11px;margin-left: 8px;">
                                                Work Days
                                            </strong>
                                            <div
                                                style="color: #1e60a1; font-weight: 600; font-size: 12px;margin-left: 8px;">
                                                2 Days</div>
                                        </div>

                                        <!-- Days Left -->
                                        <div class="col-4">
                                            <strong
                                                style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #1e60a1; font-size: 12px;margin-left:13px;">
                                                Days Left
                                            </strong>
                                            <div
                                                style="color: #1e60a1; font-weight: 600; font-size: 12px;margin-left:13px;">
                                                {{ $project->reminder_days}} Days
                                            </div>
                                        </div>

                                        <!-- Blue Progress Bar (Full Width Below) -->
                                        <div class="col-12 mt-3">
                                            <div class="progress"
                                                style="height: 6px; background-color: #f1f1f1; border-radius: 10px; overflow: hidden;">
                                                <div class="progress-bar" role="progressbar"
                                                    style="width: {{ (int) ($project->progress_percent ?? 0) }}%; background-color: #4dc3ff; border-radius: 10px;"
                                                    aria-valuenow="{{ (int) ($project->progress_percent ?? 0) }}"
                                                    aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Project Manager / Developers -->
                                    <div class="d-flex justify-content-between m-0 w-100"
                                        style="background-color: #f9f9f9; border-radius: 12px; padding: 10px;">

                                        <!-- Project Manager -->
                                        <div class="text-center">
                                            <strong
                                                style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #1e60a1; font-size: 15px;">
                                                Project Manager
                                            </strong>
                                            <div class="d-flex justify-content-center mt-1">
                                                <img src="{{ URL::asset('/build/img/groups/group-01.jpg') }}"
                                                    style="height: 30px; width: 30px; border: 2px solid #00e0ff; border-radius: 50%;" />
                                            </div>
                                        </div>

                                        <!-- Developers -->
                                        <div class="text-center">
                                            <strong
                                                style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #1e60a1; font-size: 15px;">
                                                Developers
                                            </strong>
                                            <div class="d-flex justify-content-center mt-1"
                                                style="margin-left: 10px;">
                                                <img src="{{ URL::asset('/build/img/groups/group-01.jpg') }}"
                                                    style="height: 30px; width: 30px; border: 2px solid #00e0ff; margin-left: -10px; border-radius: 50%;" />
                                                <img src="{{ URL::asset('/build/img/groups/group-01.jpg') }}"
                                                    style="height: 30px; width: 30px; border: 2px solid #00e0ff; margin-left: -10px; border-radius: 50%;" />
                                                <img src="{{ URL::asset('/build/img/groups/group-01.jpg') }}"
                                                    style="height: 30px; width: 30px; border: 2px solid #00e0ff; margin-left: -10px; border-radius: 50%;" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-2 mb-2" style="background-color:#f9f9f9;border-radius:10px;">
                                        <!-- Stats Row -->
                                        <div class="row text-center mb-2">
                                            <div class="col">
                                                <strong
                                                    style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;color:black ;font-size: 15px;">
                                                    <img src="{{ URL::asset('/build/img/redsigma.svg') }}"
                                                        class="rounded-circle" style="height: 15px;"
                                                        alt="Project Logo"> Tickets</strong>
                                                <div class="mt-2"
                                                    style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;background-color:#f1f1f1;color:red;border-radius:10px;margin-left: 13px; width: fit-content; padding: 3px;">
                                                    5 tickets</div>
                                            </div>
                                            <div class="col">
                                                <strong
                                                    style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;color:black ;font-size: 15px;"><img
                                                        src="{{ URL::asset('/build/img/bluesigma.svg') }}"
                                                        class="rounded-circle" style="height: 15px;"
                                                        alt="Project Logo"> Tasks</strong>
                                                <div class="mt-2"
                                                    style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;background-color:#f1f1f1;color:red;border-radius:10px;margin-left: 13px; width: fit-content; padding: 3px;">
                                                    {{ (int) ($project->tasks_count ?? 0) }} tasks
                                                </div>
                                            </div>
                                            <div class="col">
                                                <strong
                                                    style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;color:black ;font-size: 15px;">Progress</strong>
                                                <div class="mt-2"
                                                    style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;background-color:#f1f1f1;color:red;border-radius:10px;margin-left: 30px; width: fit-content; padding: 3px;">
                                                    {{ (int) ($project->progress_percent ?? 0) }}%
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Ticket Colors -->
                                        <div class="d-flex justify-content-center">
                                            <!-- Content box with light background and auto width -->
                                            <div class="d-flex align-items-center gap-2 mb-3 px-3"
                                                style="background: #f1f1f1; border-radius: 10px; width: fit-content;">
                                                <!-- "Ticket" label -->
                                                <span
                                                    style="background: #f1f1f1; padding: 4px 8px; border-radius: 6px; font-size: 12px; color: #6c757d;margin-left:-15px;">Task</span>

                                                <!-- Blue dot + number -->
                                                <span
                                                    style="width: 10px; height: 10px; background: #3b82f6; border-radius: 50%; display: inline-block;"></span>
                                                <span style="font-size: 13px; color: #6c757d;">1</span>

                                                <!-- Orange dot + number -->
                                                <span
                                                    style="width: 10px; height: 10px; background: #f59e0b; border-radius: 50%; display: inline-block;"></span>
                                                <span style="font-size: 13px; color: #6c757d;">3</span>

                                                <!-- Red dot + number -->
                                                <span
                                                    style="width: 10px; height: 10px; background: #ef4444; border-radius: 50%; display: inline-block;"></span>
                                                <span style="font-size: 13px; color: #6c757d;">0</span>

                                                <!-- Purple dot + number -->
                                                <span
                                                    style="width: 10px; height: 10px; background: #a855f7; border-radius: 50%; display: inline-block;"></span>
                                                <span style="font-size: 13px; color: #6c757d;">0</span>

                                                <!-- Green dot + number -->
                                                <span
                                                    style="width: 10px; height: 10px; background: #22c55e; border-radius: 50%; display: inline-block;"></span>
                                                <span style="font-size: 13px; color: #6c757d;">0</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Section Progress Block -->
                                    <div
                                        style="background-color: #f9f9f9; border-radius: 12px; padding: 15px 10px;">
                                        <!-- Section Tags styled exactly like screenshot -->
                                        <div class="d-flex justify-content-center gap-1 mb-3 flex-nowrap">
                                            <div class="px-1 py-1"
                                                style="background: #f4f4f4; border-radius: 999px; font-size: 11px; color: #e53935; font-weight: 500; white-space: nowrap;">
                                                Section #1
                                            </div>

                                            <div class="px-1 py-1"
                                                style="background: #f4f4f4; border-radius: 999px; font-size: 12px; color: #e53935; font-weight: 500; white-space: nowrap;">
                                                Section #1
                                            </div>
                                            <div class="px-1 py-1"
                                                style="background: #f4f4f4; border-radius: 999px; font-size: 11px; color: #e53935; font-weight: 500; white-space: nowrap;">
                                                Section #1
                                            </div>
                                            <div class="px-1 py-1"
                                                style="background: #f4f4f4; border-radius: 999px; font-size: 11px; color: #e53935; font-weight: 500; white-space: nowrap;">
                                                Section #1
                                            </div>
                                        </div>
                                        <!-- Section Titles -->
                                        <div class="d-flex justify-content-between px-1"
                                            style="font-size: 13px; color: #2e3a59; font-weight: 600; font-family: 'Segoe UI', sans-serif;">
                                            <span>Section #1 75%</span>
                                            <span>Section #1 75%</span>
                                            <span>Section #1 75%</span>
                                        </div>

                                        <!-- Progress Bars -->
                                        <div
                                            class="d-flex justify-content-between align-items-center mt-2 gap-2 px-1">
                                            <!-- Green Progress -->
                                            <div class="progress"
                                                style="width: 32%; height: 8px; background-color: #d3f4dc; border-radius: 10px;">
                                                <div class="progress-bar"
                                                    style="width: 75%; background-color: #28c76f; border-radius: 10px;">
                                                </div>
                                            </div>

                                            <!-- Yellow Progress -->
                                            <div class="progress"
                                                style="width: 32%; height: 8px; background-color: #fef3d3; border-radius: 10px;">
                                                <div class="progress-bar"
                                                    style="width: 75%; background-color: #ffc107; border-radius: 10px;">
                                                </div>
                                            </div>

                                            <!-- Red Progress -->
                                            <div class="progress"
                                                style="width: 32%; height: 8px; background-color: #fdd7d7; border-radius: 10px;">
                                                <div class="progress-bar"
                                                    style="width: 75%; background-color: #ea5455; border-radius: 10px;">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Step Progress Bar -->
                                        <div class="d-flex justify-content-center gap-2 mt-3" id="stepBar">
                                            <div id="step1"
                                                onclick=" document.getElementById('step1').style.backgroundColor = '#1cc375'; document.getElementById('step2').style.backgroundColor = '#ffffff'; document.getElementById('step3').style.backgroundColor = '#ffffff';"
                                                style="width: 60px; height: 5px; background-color: #1cc375; border-radius: 10px; cursor: pointer;">
                                            </div>
                                            <div id="step2"
                                                onclick=" document.getElementById('step1').style.backgroundColor = '#ffffff'; document.getElementById('step2').style.backgroundColor = '#1cc375'; document.getElementById('step3').style.backgroundColor = '#ffffff'; "
                                                style="width: 60px; height: 5px; background-color: #ffffff; border-radius: 10px; cursor: pointer;">
                                            </div>

                                            <div id="step3"
                                                onclick=" document.getElementById('step1').style.backgroundColor = '#ffffff'; document.getElementById('step2').style.backgroundColor = '#ffffff'; document.getElementById('step3').style.backgroundColor = '#1cc375'; "
                                                style="width: 60px; height: 5px; background-color: #ffffff; border-radius: 10px; cursor: pointer;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @if ($projectList->isEmpty())
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                <div class="card shadow-sm  p-2"
                                    style="border-radius: 20px; font-family:    'Segoe UI', sans-serif;">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div style="width: 60px; height: 60px; position: relative;">
                                            <svg width="60" height="60">
                                                <circle cx="30" cy="30" r="26" stroke="#d1d1d1"
                                                    stroke-width="6" fill="none" />
                                            </svg>
                                            <div
                                                style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 12px; font-weight: bold; color: #333;">
                                                0%
                                            </div>
                                        </div>
                                        <div>
                                            <img src="{{ URL::asset('/build/img/yekbon.svg') }}"
                                                class="rounded-circle"
                                                style="height: 65px; width: 65px; object-fit: cover;"
                                                alt="Project Logo">
                                        </div>
                                        <div>
                                            <div style="background: #e1effe;padding: 5px;">
                                                <img src="{{ URL::asset('/build/img/blueflag.svg') }}"
                                                    style="height: 20px; width: 20px; " alt="flag" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center" style="cursor: pointer;">
                                        <h6 style="cursor: pointer;">No projects yet</h6>
                                        <div class="d-inline-block px-3 py-1 mb-2 mt-2"
                                            style="background: #f4f4f4; border-radius: 999px; font-size: 12px; color: #e53935; font-weight: 500;">
                                            PRJ-000
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                        </div>
                    </div>







                </div>
            </div>

        </div>
    </div>
    <!-- right sidebar popup -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" data-bs-backdrop="true"
        aria-labelledby="offcanvasRightLabel" style="overflow-y: auto; width: 770px;">

        <!-- Header -->
        <div class="offcanvas-header" style="padding: 0;">
            <!-- Gradient Header Background -->
            <div
                style="background: linear-gradient(90deg, #ED9D23, #FABB05); width: 100%; padding: 30px 20px 60px; position: relative; text-align: center;">

                <!-- Close Button -->
                <button type="button" data-bs-dismiss="offcanvas" aria-label="Close"
                    onmouseover="this.style.backgroundColor='red'; this.style.color='white';"
                    onmouseout="this.style.backgroundColor='transparent'; this.style.color='#1e293b';"
                    style="color: #1e293b; font-weight: bold; z-index: 999; width: 32px; height: 32px; line-height: 28px; text-align: center; font-size: 20px; position: absolute; top: 8px; right: 12px; border: none; background-color: transparent; border-radius: 50%; transition: all 0.3s ease;">
                    ×
                </button>

                <!-- Profile Logo -->
                <img src="{{ URL::asset('/build/img/yekbon.svg') }}" class="rounded-circle" alt="Profile"
                    style="width: 80px; height: 80px; border: 3px solid #fff; position: absolute; left: 50%; transform: translateX(-50%) translateY(19%); background: #fff; object-fit: cover; z-index: 10;">
            </div>
        </div>

        <!-- Body -->
        <div class="offcanvas-body pt-5" style="font-family: 'Segoe UI', sans-serif; background-color: #fff;">

            <!-- Project Title & ID -->
            <div class="d-flex  align-items-center" style="margin-top: -25px;">
                <div style="width: 60px; height: 60px; position: relative;">
                    <svg width="60" height="60">
                        <circle cx="30" cy="30" r="26" stroke="#d1d1d1" stroke-width="6"
                            fill="none" />
                        <circle cx="30" cy="30" r="26" stroke="url(#grad)" stroke-width="6"
                            fill="none" stroke-dasharray="163.36" stroke-dashoffset="122.52"
                            stroke-linecap="round" transform="rotate(-90 30 30)" />
                        <defs>
                            <linearGradient id="grad" x1="0%" y1="0%" x2="100%"
                                y2="0%">
                                <stop offset="0%" stop-color="#ff7f00" />
                                <stop offset="100%" stop-color="#fcd34d" />
                            </linearGradient>
                        </defs>
                    </svg>
                    <div
                        style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 12px; font-weight: bold; color: #333;">
                        25%
                    </div>
                </div>


            </div>
            <div class="text-center mb-3" style="margin-top:-34px;margin-left:14px;">
                <h5 style="font-weight: 600; color: #2e3a59;">Project Title</h5>

                <div
                    style="display: inline-block;background:#f5f5f5;color: #e53935; font-size: 12px;
                font-weight: 600;padding: 4px 14px;border-radius: 999px;margin-top: 5px">
                    Project ID
                </div>
            </div>

            <!-- Wrapper to center the content -->
            <div class="d-flex justify-content-center mb-3">
                <!-- Compact Date & Priority Display -->
                <div class="d-flex align-items-center flex-wrap"
                    style="background: #f5f5f5; padding: 6px 12px; border-radius: 999px; font-family: 'Poppins', sans-serif; font-size: 12px; font-weight: 500; color: #2e3a59;">

                    <!-- Start and Deliver Dates -->
                    <div class="d-flex align-items-center">
                        <div style="color: #34d399;">
                            Start: <span style="color: #2e3a59;">22.10.2024</span>
                        </div>
                        <!-- Divider -->
                        <div style="width: 1px; height: 18px; background-color: #d1d5db; margin: 0 10px;"></div>
                        <div style="color: #34d399;">
                            Deliver: <span style="color: #2e3a59;">22.10.2024</span>
                        </div>
                    </div>

                    <!-- Divider -->
                    <div style="width: 1px; height: 18px; background-color: #d1d5db; margin: 0 10px;"></div>

                    <!-- Priority -->
                    <div
                        style="background: #ffffff; border-radius: 999px; padding: 2px 10px; display: flex; align-items: center; gap: 6px;">
                        <span
                            style="width: 8px; height: 8px; background-color: #34d399; border-radius: 50%; display: inline-block;"></span>
                        <span style="color: #6b7280;">Low</span>
                    </div>
                </div>
            </div>

            <!-- Status Tag -->
            <div class="text-center mb-3">
                <div
                    style="background: #fff7da; /* soft yellow */color: #2e3a59;       /* dark slate for text */border-radius: 999px;display: inline-flex;align-items: center;padding: 4px 18px;font-weight: 600;font-size: 13px">
                    <img src="{{ URL::asset('/build/img/yelow.svg') }}"
                        style="height: 14px; width: 14px; margin-right: 8px;" alt="flag" />
                    Project is in Hold
                </div>
            </div>


            <!-- Project Progress Card -->
            <div class="card p-3 shadow-sm mb-3"
                style="border-radius: 12px; background-color: #f9f9f9; font-family: 'Segoe UI', sans-serif;">
                <!-- Title -->
                <h6 class="mb-3" style="font-weight: 600; color: #2e3a59;">Project Progress :</h6>

                <!-- Responsive Row -->
                <div class="row g-3">
                    <!-- Left Half -->
                    <div class="col-12 col-md-6">
                        <div style="border-radius:10px;background-color:white;" class="p-2">
                            <!-- Stats -->
                            <div class="d-flex justify-content-between text-center mb-2 flex-wrap">
                                <div style="flex: 1;">
                                    <div style="font-weight: 600; font-size: 13px; color: #2e3a59;">Tickets</div>
                                    <div style="font-size: 12px; color: #6c757d;">#1 of #05</div>
                                </div>
                                <div style="flex: 1;">
                                    <div style="font-weight: 600; font-size: 13px; color: #2e3a59;">Total Tasks</div>
                                    <div style="font-size: 12px; color: #6c757d;">#05</div>
                                </div>
                                <div style="flex: 1;">
                                    <div style="font-weight: 600; font-size: 13px; color: #2e3a59;">Days Left</div>
                                    <div style="font-size: 12px; color: #6c757d;">#05</div>
                                </div>
                                <div style="flex: 1;">
                                    <div style="font-weight: 600; font-size: 13px; color: #2e3a59;">Status</div>
                                    <div style="font-size: 12px; color: #6c757d;">75%</div>
                                </div>
                            </div>

                            <!-- Progress Bar -->
                            <div class="progress mx-2"
                                style="height: 8px; background-color: #e9ecef; border-radius: 10px;">
                                <div class="progress-bar"
                                    style="width: 75%; background-color: #4dc3ff; border-radius: 10px;"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Half -->
                    <div class="col-12 col-md-6">
                        <div style="border-radius:10px;background-color:white;" class="p-2">
                            <!-- Section Labels -->
                            <div class="d-flex justify-content-between flex-wrap mb-2 px-2"
                                style="font-size: 13px; font-weight: 600; color: #2e3a59;">
                                <span>Section#1 75%</span>
                                <span>Section#2 75%</span>
                                <span>Section#3 75%</span>

                            </div>

                            <!-- Section Progress Bars -->
                            <div class="d-flex justify-content-between align-items-center gap-2 px-2 mb-2 flex-wrap">
                                <div class="progress"
                                    style="flex: 1; min-width: 70px; height: 10px; background-color: #d3f4dc; border-radius: 10px;">
                                    <div class="progress-bar"
                                        style="width: 75%; background-color: #28c76f; border-radius: 10px;"></div>
                                </div>
                                <div class="progress"
                                    style="flex: 1; min-width: 70px; height: 10px; background-color: #fef3d3; border-radius: 10px;">
                                    <div class="progress-bar"
                                        style="width: 75%; background-color: #ffc107; border-radius: 10px;"></div>
                                </div>
                                <div class="progress"
                                    style="flex: 1; min-width: 70px; height: 10px; background-color: #fdd7d7; border-radius: 10px;">
                                    <div class="progress-bar"
                                        style="width: 75%; background-color: #ea5455; border-radius: 10px;"></div>
                                </div>
                                <div class="progress"
                                    style="flex: 1; min-width: 70px; height: 10px; background-color: #fdd7d7; border-radius: 10px;">
                                    <div class="progress-bar"
                                        style="width: 75%; background-color: #ea5455; border-radius: 10px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Project Description Section -->
            <div class="card p-3 mb-3"
                style="border-radius: 12px; background-color: #f9f9f9; font-family: 'Segoe UI', sans-serif;">
                <h6 class="mb-2" style="font-weight: 600; color: #2e3a59;">Project Description :</h6>
                <p style="font-size: 13px; color: #4b5563; line-height: 1.7; margin-bottom: 0;">
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut
                    labore
                    et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea
                    rebum.
                    Stet clita kasd gubergren, no sea takimata sanctus est lorem ipsum dolor sit amet. Lorem ipsum dolor
                    sit amet,
                    consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna
                    aliquyam erat,
                    sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd
                    gubergren,
                    no sea takimata sanctus est lorem ipsum dolor sit amet.
                </p>
            </div>


            <!-- Project Sections Card -->
            <div class="p-3 mb-3" style="border-radius: 12px; background-color: #f8f9fa;">
                <!-- Title -->
                <h6 class="mb-2" style="font-weight: 600; color: #2e3a59;">· Project Sections ·</h6>

                <!-- Responsive Grid Layout -->
                <div class="row g-3">
                    <!-- Card Start -->
                    <div class="col-6 col-md-4 col-lg-3">
                        <div
                            style="background: white; padding: 16px; border-radius: 12px; text-align: center; position: relative; box-shadow: 0 2px 5px rgba(0,0,0,0.03);">
                            <!-- Options Icon -->
                            <div class="rounded-circle"
                                style="position: absolute; top: 10px; right: 10px; cursor: pointer; background:#f8f9fa;">
                                <svg width="16" height="16" fill="#ccc" viewBox="0 0 24 24">
                                    <circle cx="5" cy="12" r="2" />
                                    <circle cx="12" cy="12" r="2" />
                                    <circle cx="19" cy="12" r="2" />
                                </svg>
                            </div>
                            <!-- Image -->
                            <img src="{{ URL::asset('/build/img/project.svg') }}"
                                style="height: 40px; margin-bottom: 10px;" alt="icon">
                            <!-- Title -->
                            <div style="font-size: 14px; font-weight: 600; color: #2e3a59; margin-bottom: 10px;">Admin
                                Dashboard</div>
                            <!-- Tags -->
                            <div class="d-flex flex-wrap justify-content-center gap-1">
                                <span class="badge-tag">Laravel</span>
                                <span class="badge-tag">Bootstrap</span>
                                <span class="badge-tag">MongoDB</span>
                                <span class="badge-tag">RestFul API</span>
                            </div>
                        </div>
                    </div>
                    <!-- Card End -->
                    <!-- Card Start -->
                    <div class="col-6 col-md-4 col-lg-3">
                        <div
                            style="background: white; padding: 16px; border-radius: 12px; text-align: center; position: relative; box-shadow: 0 2px 5px rgba(0,0,0,0.03);">
                            <!-- Options Icon -->
                            <div class="rounded-circle"
                                style="position: absolute; top: 10px; right: 10px; cursor: pointer; background:#f8f9fa;">
                                <svg width="16" height="16" fill="#ccc" viewBox="0 0 24 24">
                                    <circle cx="5" cy="12" r="2" />
                                    <circle cx="12" cy="12" r="2" />
                                    <circle cx="19" cy="12" r="2" />
                                </svg>
                            </div>
                            <!-- Image -->
                            <img src="{{ URL::asset('/build/img/project.svg') }}"
                                style="height: 40px; margin-bottom: 10px;" alt="icon">
                            <!-- Title -->
                            <div style="font-size: 14px; font-weight: 600; color: #2e3a59; margin-bottom: 10px;">Admin
                                Dashboard</div>
                            <!-- Tags -->
                            <div class="d-flex flex-wrap justify-content-center gap-1">
                                <span class="badge-tag">Laravel</span>
                                <span class="badge-tag">Bootstrap</span>
                                <span class="badge-tag">MongoDB</span>
                                <span class="badge-tag">RestFul API</span>
                            </div>
                        </div>
                    </div>
                    <!-- Card End -->
                    <!-- Card Start -->
                    <div class="col-6 col-md-4 col-lg-3">
                        <div
                            style="background: white; padding: 16px; border-radius: 12px; text-align: center; position: relative; box-shadow: 0 2px 5px rgba(0,0,0,0.03);">
                            <!-- Options Icon -->
                            <div class="rounded-circle"
                                style="position: absolute; top: 10px; right: 10px; cursor: pointer; background:#f8f9fa;">
                                <svg width="16" height="16" fill="#ccc" viewBox="0 0 24 24">
                                    <circle cx="5" cy="12" r="2" />
                                    <circle cx="12" cy="12" r="2" />
                                    <circle cx="19" cy="12" r="2" />
                                </svg>
                            </div>
                            <!-- Image -->
                            <img src="{{ URL::asset('/build/img/project.svg') }}"
                                style="height: 40px; margin-bottom: 10px;" alt="icon">
                            <!-- Title -->
                            <div style="font-size: 14px; font-weight: 600; color: #2e3a59; margin-bottom: 10px;">Admin
                                Dashboard</div>
                            <!-- Tags -->
                            <div class="d-flex flex-wrap justify-content-center gap-1">
                                <span class="badge-tag">Laravel</span>
                                <span class="badge-tag">Bootstrap</span>
                                <span class="badge-tag">MongoDB</span>
                                <span class="badge-tag">RestFul API</span>
                            </div>
                        </div>
                    </div>
                    <!-- Card End -->
                    <!-- Card Start -->

                    <!-- Card End -->
                    <!-- Card Start -->
                    <div class="col-6 col-md-4 col-lg-3">
                        <div
                            style="background: white; padding: 16px; border-radius: 12px; text-align: center; position: relative; box-shadow: 0 2px 5px rgba(0,0,0,0.03);">
                            <!-- Options Icon -->
                            <div class="rounded-circle"
                                style="position: absolute; top: 10px; right: 10px; cursor: pointer; background:#f8f9fa;">
                                <svg width="16" height="16" fill="#ccc" viewBox="0 0 24 24">
                                    <circle cx="5" cy="12" r="2" />
                                    <circle cx="12" cy="12" r="2" />
                                    <circle cx="19" cy="12" r="2" />
                                </svg>
                            </div>
                            <!-- Image -->
                            <img src="{{ URL::asset('/build/img/project.svg') }}"
                                style="height: 40px; margin-bottom: 10px;" alt="icon">
                            <!-- Title -->
                            <div style="font-size: 14px; font-weight: 600; color: #2e3a59; margin-bottom: 10px;">Admin
                                Dashboard</div>
                            <!-- Tags -->
                            <div class="d-flex flex-wrap justify-content-center gap-1">
                                <span class="badge-tag">Laravel</span>
                                <span class="badge-tag">Bootstrap</span>
                                <span class="badge-tag">MongoDB</span>
                                <span class="badge-tag">RestFul API</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>



            <!-- Our team Card -->
            <div
                style="font-family: 'Segoe UI', sans-serif; background-color: #f8f9fa; padding: 20px; border-radius: 12px;">
                <!-- Section Title -->
                <h6 class="mb-2" style="font-weight: 600; color: #2e3a59; font-size: 16px;">· Our Team ·</h6>

                <!-- Grid Row -->
                <div class="row g-3">
                    <!-- TEAM CARD (Repeat as needed) -->
                    <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                        <div class="card text-center"
                            style="border-radius: 18px; border: none; overflow: hidden; background: #ffffff; box-shadow: 0 2px 6px rgba(0,0,0,0.05);">

                            <!-- Background Image using IMG tag -->
                            <div style="position: relative; height: 80px;">
                                <img src="{{ URL::asset('/build/img/bgractangle.svg') }}" alt="Background"
                                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">

                                <!-- Profile Image -->
                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile"
                                    class="rounded-circle border border-white border-3"
                                    style="width: 60px; height: 60px; object-fit: cover; position: absolute; bottom: -30px; left: 50%; transform: translateX(-50%);">
                            </div>

                            <!-- Card Body -->
                            <div class="card-body" style="margin-top: 35px; padding: 16px 10px;">
                                <h6 class="card-title mb-1" style="font-weight: 600; font-size: 15px; color: #000;">
                                    Name Lastname</h6>
                                <p class="mb-0" style="color: #7f8ea3; font-size: 13px;">Project Manager</p>
                            </div>
                        </div>
                    </div>
                    <!-- 2 -->
                    <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                        <div class="card text-center"
                            style="border-radius: 18px; border: none; overflow: hidden; background: #ffffff; box-shadow: 0 2px 6px rgba(0,0,0,0.05);">

                            <!-- Background Image using IMG tag -->
                            <div style="position: relative; height: 80px;">
                                <img src="{{ URL::asset('/build/img/bgractangle.svg') }}" alt="Background"
                                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">

                                <!-- Profile Image -->
                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile"
                                    class="rounded-circle border border-white border-3"
                                    style="width: 60px; height: 60px; object-fit: cover; position: absolute; bottom: -30px; left: 50%; transform: translateX(-50%);">
                            </div>

                            <!-- Card Body -->
                            <div class="card-body" style="margin-top: 35px; padding: 16px 10px;">
                                <h6 class="card-title mb-1" style="font-weight: 600; font-size: 15px; color: #000;">
                                    Name Lastname</h6>
                                <p class="mb-0" style="color: #7f8ea3; font-size: 13px;">Project Manager</p>
                            </div>
                        </div>
                    </div>
                    <!-- 3 -->
                    <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                        <div class="card text-center"
                            style="border-radius: 18px; border: none; overflow: hidden; background: #ffffff; box-shadow: 0 2px 6px rgba(0,0,0,0.05);">

                            <!-- Background Image using IMG tag -->
                            <div style="position: relative; height: 80px;">
                                <img src="{{ URL::asset('/build/img/bgractangle.svg') }}" alt="Background"
                                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">

                                <!-- Profile Image -->
                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile"
                                    class="rounded-circle border border-white border-3"
                                    style="width: 60px; height: 60px; object-fit: cover; position: absolute; bottom: -30px; left: 50%; transform: translateX(-50%);">
                            </div>

                            <!-- Card Body -->
                            <div class="card-body" style="margin-top: 35px; padding: 16px 10px;">
                                <h6 class="card-title mb-1" style="font-weight: 600; font-size: 15px; color: #000;">
                                    Name Lastname</h6>
                                <p class="mb-0" style="color: #7f8ea3; font-size: 13px;">Project Manager</p>
                            </div>
                        </div>
                    </div>
                    <!-- 4 -->
                    <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                        <div class="card text-center"
                            style="border-radius: 18px; border: none; overflow: hidden; background: #ffffff; box-shadow: 0 2px 6px rgba(0,0,0,0.05);">

                            <!-- Background Image using IMG tag -->
                            <div style="position: relative; height: 80px;">
                                <img src="{{ URL::asset('/build/img/bgractangle.svg') }}" alt="Background"
                                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">

                                <!-- Profile Image -->
                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile"
                                    class="rounded-circle border border-white border-3"
                                    style="width: 60px; height: 60px; object-fit: cover; position: absolute; bottom: -30px; left: 50%; transform: translateX(-50%);">
                            </div>

                            <!-- Card Body -->
                            <div class="card-body" style="margin-top: 35px; padding: 16px 10px;">
                                <h6 class="card-title mb-1" style="font-weight: 600; font-size: 15px; color: #000;">
                                    Name Lastname</h6>
                                <p class="mb-0" style="color: #7f8ea3; font-size: 13px;">Project Manager</p>
                            </div>
                        </div>
                    </div>
                    <!-- Duplicate above <div class="col-6 ..."> block for more team members -->
                </div>
            </div>

            <!-- project tcikets -->
            <div style="font-family: 'Segoe UI', sans-serif;  background-color: #f8f9fa; border-radius: 12px; padding: 20px; padding-bottom:1px;  box-shadow: 0 2px 8px rgba(0,0,0,0.05); color: #2e3a59;"
                class="mt-2">
                <!-- Section Title -->
                <h6 style="font-weight: 600; font-size: 16px; margin-bottom: 12px;">· Project Tickets ·</h6>

                <!-- Ticket Title + Status and Metrics -->

                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-2 mb-2 p-3"
                    style="background: #fff; border-radius: 10px;">

                    <!-- Left Side: Title + Badges + Meta Info -->
                    <div class="flex-grow-1">
                        <!-- Title & Badges -->
                        <div class="d-flex flex-wrap align-items-center justify-content-between mb-2">
                            <div style="font-weight: 600; font-size: 16px; color: #2e3a59;">
                                Ticket Title
                            </div>

                            <div class="d-flex align-items-center gap-2">
                                <!-- In Progress -->
                                <span
                                    style="display: inline-flex; align-items: center; gap: 6px; background: #d2f4e8; color: #28c76f; font-weight: 600; font-size: 12px; padding: 4px 10px; border-radius: 10px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                        fill="#28c76f" viewBox="0 0 16 16">
                                        <path d="M14 1.5a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v13h1v-5h9a1 1 0 0 0 1-1v-6z" />
                                    </svg>
                                    in Progress
                                </span>

                                <!-- LOW Priority -->
                                <span
                                    style="display: inline-flex; align-items: center; gap: 6px; background: #f3f4f6; color: #8F98A0; font-weight: 600; font-size: 12px; padding: 4px 10px; border-radius: 20px;">
                                    <span
                                        style="width: 10px; height: 10px; border-radius: 50%; background: #28c76f; display: inline-block;"></span>
                                    LOW
                                </span>
                            </div>
                        </div>

                        <!-- Meta Info -->
                        <div
                            style="font-size: 12px; color: #6c757d; background: #f8f9fa; border-radius: 7px; padding: 4px 8px; display: flex; flex-wrap: wrap; gap: 8px;margin-top: 20px;">
                            <div><strong>Ticket ID</strong> | <strong>Section</strong> |</div>
                            <div><span style="color: #28c76f;">Start:</span> 22.10.2024 |</div>
                            <div><span style="color: #28c76f;">Deliver:</span> 22.10.2024</div>
                        </div>
                    </div>

                    <!-- Right Side: Stats -->
                    <div class="d-flex align-items-center gap-3 mt-3 mt-md-0">
                        <!-- Metrics Box -->
                        <div style="background: #f8f9fa; border-radius: 10px; padding: 10px 15px;">
                            <div class="d-flex gap-3 justify-content-between mb-2">
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

                            <!-- Progress Bar -->
                            <div style="height: 6px; background: #e0e0e0; border-radius: 5px;">
                                <div style="width: 70%; height: 100%; background: #34c6f3; border-radius: 5px;"></div>
                            </div>
                        </div>

                        <!-- Circular Progress -->
                        <div style="position: relative; width: 45px; height: 45px;">
                            <svg viewBox="0 0 36 36" width="45" height="45">
                                <path style="fill: none; stroke:#e0e0e0; stroke-width: 3.8;" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831
                       a 15.9155 15.9155 0 0 1 0 -31.831" />
                                <path style="fill: none; stroke: #f9a825; stroke-width: 3.8; stroke-linecap: round;"
                                    stroke-dasharray="70, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831
                       a 15.9155 15.9155 0 0 1 0 -31.831" />
                            </svg>
                            <div
                                style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 12px; font-weight: bold; color: #f9a825;">
                                70%</div>
                        </div>
                    </div>
                </div>

                <!-- 2 -->
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-2 mb-2 p-3"
                    style="background: #fff; border-radius: 10px;">

                    <!-- Left Side: Title + Badges + Meta Info -->
                    <div class="flex-grow-1">
                        <!-- Title & Badges -->
                        <div class="d-flex flex-wrap align-items-center justify-content-between mb-2">
                            <div style="font-weight: 600; font-size: 16px; color: #2e3a59;">
                                Ticket Title
                            </div>

                            <div class="d-flex align-items-center gap-2">
                                <!-- In Progress -->
                                <span
                                    style="display: inline-flex; align-items: center; gap: 6px; background: #d2f4e8; color: #28c76f; font-weight: 600; font-size: 12px; padding: 4px 10px; border-radius: 10px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                        fill="#28c76f" viewBox="0 0 16 16">
                                        <path d="M14 1.5a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v13h1v-5h9a1 1 0 0 0 1-1v-6z" />
                                    </svg>
                                    in Progress
                                </span>

                                <!-- LOW Priority -->
                                <span
                                    style="display: inline-flex; align-items: center; gap: 6px; background: #f3f4f6; color: #8F98A0; font-weight: 600; font-size: 12px; padding: 4px 10px; border-radius: 20px;">
                                    <span
                                        style="width: 10px; height: 10px; border-radius: 50%; background: #28c76f; display: inline-block;"></span>
                                    LOW
                                </span>
                            </div>
                        </div>

                        <!-- Meta Info -->
                        <div
                            style="font-size: 12px; color: #6c757d; background: #f8f9fa; border-radius: 7px; padding: 4px 8px; display: flex; flex-wrap: wrap; gap: 8px;margin-top: 20px;">
                            <div><strong>Ticket ID</strong> | <strong>Section</strong> |</div>
                            <div><span style="color: #28c76f;">Start:</span> 22.10.2024 |</div>
                            <div><span style="color: #28c76f;">Deliver:</span> 22.10.2024</div>
                        </div>
                    </div>

                    <!-- Right Side: Stats -->
                    <div class="d-flex align-items-center gap-3 mt-3 mt-md-0">
                        <!-- Metrics Box -->
                        <div style="background: #f8f9fa; border-radius: 10px; padding: 10px 15px;">
                            <div class="d-flex gap-3 justify-content-between mb-2">
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

                            <!-- Progress Bar -->
                            <div style="height: 6px; background: #e0e0e0; border-radius: 5px;">
                                <div style="width: 70%; height: 100%; background: #34c6f3; border-radius: 5px;"></div>
                            </div>
                        </div>

                        <!-- Circular Progress -->
                        <div style="position: relative; width: 45px; height: 45px;">
                            <svg viewBox="0 0 36 36" width="45" height="45">
                                <path style="fill: none; stroke:#e0e0e0; stroke-width: 3.8;" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831
                       a 15.9155 15.9155 0 0 1 0 -31.831" />
                                <path style="fill: none; stroke: #f9a825; stroke-width: 3.8; stroke-linecap: round;"
                                    stroke-dasharray="70, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831
                       a 15.9155 15.9155 0 0 1 0 -31.831" />
                            </svg>
                            <div
                                style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 12px; font-weight: bold; color: #f9a825;">
                                70%</div>
                        </div>
                    </div>
                </div>
                <!-- 3rd -->

                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start mb-2 gap-2 p-3"
                    style="background: #fff; border-radius: 10px;">

                    <!-- Left Side: Title + Badges + Meta Info -->
                    <div class="flex-grow-1">
                        <!-- Title & Badges -->
                        <div class="d-flex flex-wrap align-items-center justify-content-between mb-2">
                            <div style="font-weight: 600; font-size: 16px; color: #2e3a59;">
                                Ticket Title
                            </div>

                            <div class="d-flex align-items-center gap-2">
                                <!-- In Progress -->
                                <span
                                    style="display: inline-flex; align-items: center; gap: 6px; background: #d2f4e8; color: #28c76f; font-weight: 600; font-size: 12px; padding: 4px 10px; border-radius: 10px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                        fill="#28c76f" viewBox="0 0 16 16">
                                        <path d="M14 1.5a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v13h1v-5h9a1 1 0 0 0 1-1v-6z" />
                                    </svg>
                                    in Progress
                                </span>

                                <!-- LOW Priority -->
                                <span
                                    style="display: inline-flex; align-items: center; gap: 6px; background: #f3f4f6; color: #8F98A0; font-weight: 600; font-size: 12px; padding: 4px 10px; border-radius: 20px;">
                                    <span
                                        style="width: 10px; height: 10px; border-radius: 50%; background: #28c76f; display: inline-block;"></span>
                                    LOW
                                </span>
                            </div>
                        </div>

                        <!-- Meta Info -->
                        <div
                            style="font-size: 12px; color: #6c757d; background: #f8f9fa; border-radius: 7px; padding: 4px 8px; display: flex; flex-wrap: wrap; gap: 8px;margin-top: 20px;">
                            <div><strong>Ticket ID</strong> | <strong>Section</strong> |</div>
                            <div><span style="color: #28c76f;">Start:</span> 22.10.2024 |</div>
                            <div><span style="color: #28c76f;">Deliver:</span> 22.10.2024</div>
                        </div>
                    </div>

                    <!-- Right Side: Stats -->
                    <div class="d-flex align-items-center gap-3 mt-3 mt-md-0">
                        <!-- Metrics Box -->
                        <div style="background: #f8f9fa; border-radius: 10px; padding: 10px 15px;">
                            <div class="d-flex gap-3 justify-content-between mb-2">
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

                            <!-- Progress Bar -->
                            <div style="height: 6px; background: #e0e0e0; border-radius: 5px;">
                                <div style="width: 70%; height: 100%; background: #34c6f3; border-radius: 5px;"></div>
                            </div>
                        </div>

                        <!-- Circular Progress -->
                        <div style="position: relative; width: 45px; height: 45px;">
                            <svg viewBox="0 0 36 36" width="45" height="45">
                                <path style="fill: none; stroke:#e0e0e0; stroke-width: 3.8;" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831
                       a 15.9155 15.9155 0 0 1 0 -31.831" />
                                <path style="fill: none; stroke: #f9a825; stroke-width: 3.8; stroke-linecap: round;"
                                    stroke-dasharray="70, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831
                       a 15.9155 15.9155 0 0 1 0 -31.831" />
                            </svg>
                            <div
                                style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 12px; font-weight: bold; color: #f9a825;">
                                70%</div>
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-2 mb-2 p-3"
                    style="background: #fff; border-radius: 10px;">

                    <!-- Left Side: Title + Badges + Meta Info -->
                    <div class="flex-grow-1">
                        <!-- Title & Badges -->
                        <div class="d-flex flex-wrap align-items-center justify-content-between mb-2">
                            <div style="font-weight: 600; font-size: 16px; color: #2e3a59;">
                                Ticket Title
                            </div>

                            <div class="d-flex align-items-center gap-2">
                                <!-- In Progress -->
                                <span
                                    style="display: inline-flex; align-items: center; gap: 6px; background: #d2f4e8; color: #28c76f; font-weight: 600; font-size: 12px; padding: 4px 10px; border-radius: 10px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                        fill="#28c76f" viewBox="0 0 16 16">
                                        <path d="M14 1.5a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v13h1v-5h9a1 1 0 0 0 1-1v-6z" />
                                    </svg>
                                    in Progress
                                </span>

                                <!-- LOW Priority -->
                                <span
                                    style="display: inline-flex; align-items: center; gap: 6px; background: #f3f4f6; color: #8F98A0; font-weight: 600; font-size: 12px; padding: 4px 10px; border-radius: 20px;">
                                    <span
                                        style="width: 10px; height: 10px; border-radius: 50%; background: #28c76f; display: inline-block;"></span>
                                    LOW
                                </span>
                            </div>
                        </div>

                        <!-- Meta Info -->
                        <div
                            style="font-size: 12px; color: #6c757d; background: #f8f9fa; border-radius: 7px; padding: 4px 8px; display: flex; flex-wrap: wrap; gap: 8px;margin-top: 20px;">
                            <div><strong>Ticket ID</strong> | <strong>Section</strong> |</div>
                            <div><span style="color: #28c76f;">Start:</span> 22.10.2024 |</div>
                            <div><span style="color: #28c76f;">Deliver:</span> 22.10.2024</div>
                        </div>
                    </div>

                    <!-- Right Side: Stats -->
                    <div class="d-flex align-items-center gap-3 mt-3 mt-md-0">
                        <!-- Metrics Box -->
                        <div style="background: #f8f9fa; border-radius: 10px; padding: 10px 15px;">
                            <div class="d-flex gap-3 justify-content-between mb-2">
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

                            <!-- Progress Bar -->
                            <div style="height: 6px; background: #e0e0e0; border-radius: 5px;">
                                <div style="width: 70%; height: 100%; background: #34c6f3; border-radius: 5px;"></div>
                            </div>
                        </div>

                        <!-- Circular Progress -->
                        <div style="position: relative; width: 45px; height: 45px;">
                            <svg viewBox="0 0 36 36" width="45" height="45">
                                <path style="fill: none; stroke:#e0e0e0; stroke-width: 3.8;" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831
                       a 15.9155 15.9155 0 0 1 0 -31.831" />
                                <path style="fill: none; stroke: #f9a825; stroke-width: 3.8; stroke-linecap: round;"
                                    stroke-dasharray="70, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831
                       a 15.9155 15.9155 0 0 1 0 -31.831" />
                            </svg>
                            <div
                                style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 12px; font-weight: bold; color: #f9a825;">
                                70%</div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /project tickts -->
            <!-- documents -->
            <div class="mt-3" style="background-color: #f8f9fa; padding: 20px;border-radius:10px;">
                <h6 class="mb-2" style="font-weight: 600; font-size: 16px; margin-bottom: 12px;">· Project Files ·
                </h6>
                <div class="row">
                    <!-- Document Card -->
                    <div class="col-12 col-md-6 mb-2">
                        <div class="d-flex justify-content-between align-items-center p-2 rounded"
                            style="background-color: white; box-shadow: 0 0 6px rgba(0,0,0,0.05);">
                            <div class="d-flex align-items-center">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/8/87/PDF_file_icon.svg"
                                    alt="PDF Icon"
                                    style="width: 35px; height: 40px; object-fit: contain; margin-right: 10px;">
                                <div>
                                    <div style="font-weight: 500; font-size: 14px; color: #2e3a59;">ID Card Font ...
                                    </div>
                                    <div style="font-size: 12px; color: #8c94a3;">94 KB - Date</div>
                                </div>
                            </div>
                            <!-- Trigger Button -->
                            <div style="position: relative; display: inline-block;">
                                <div style="width: 28px; height: 28px; border: 1px solid #a6aec1; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; background:#fff;"
                                    onclick="let menu=this.nextElementSibling; menu.style.display = (menu.style.display==='block')?'none':'block'; event.stopPropagation();">
                                    <i class="bi bi-three-dots" style="font-size: 16px; color: #2e3a59;"></i>
                                </div>

                                <!-- Popup Menu -->
                                <div class="menu-box"
                                    style="display: none; position: absolute; top: 35px; right: 0; background: #fff; width:100px; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); padding: 10px; text-align: center; z-index:1000;"
                                    onclick="event.stopPropagation();">

                                    <!-- Title -->
                                    <div
                                        style="font-size: 13px; color: #7a7a9d; font-weight: 600; margin-bottom: 8px;">
                                        Options</div>

                                    <!-- Icons -->
                                    <div style="display:flex; justify-content: space-between; align-items:center;">
                                        <img src="{{ URL::asset('/build/img/delete1.svg') }}" alt="Delete"
                                            style="width: 22px; cursor: pointer;">
                                        <img src="{{ URL::asset('/build/img/download.svg') }}" alt="Edit"
                                            style="width: 22px; cursor: pointer;">

                                    </div>
                                </div>
                            </div>

                            <!-- Close on outside click -->
                            <script>
                                document.addEventListener("click", function() {
                                    document.querySelectorAll(".menu-box").forEach(el => el.style.display = "none");
                                });
                            </script>

                        </div>
                    </div>

                    <div class="col-12 col-md-6 mb-2">
                        <div class="d-flex justify-content-between align-items-center p-2 rounded"
                            style="background-color: white; box-shadow: 0 0 6px rgba(0,0,0,0.05);">
                            <div class="d-flex align-items-center">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/8/87/PDF_file_icon.svg"
                                    alt="PDF Icon"
                                    style="width: 35px; height: 40px; object-fit: contain; margin-right: 10px;">
                                <div>
                                    <div style="font-weight: 500; font-size: 14px; color: #2e3a59;">ID Card Font ...
                                    </div>
                                    <div style="font-size: 12px; color: #8c94a3;">94 KB - Date</div>
                                </div>
                            </div>
                            <!-- Trigger Button -->
                            <div style="position: relative; display: inline-block;">
                                <div style="width: 28px; height: 28px; border: 1px solid #a6aec1; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; background:#fff;"
                                    onclick="let menu=this.nextElementSibling; menu.style.display = (menu.style.display==='block')?'none':'block'; event.stopPropagation();">
                                    <i class="bi bi-three-dots" style="font-size: 16px; color: #2e3a59;"></i>
                                </div>

                                <!-- Popup Menu -->
                                <div class="menu-box"
                                    style="display: none; position: absolute; top: 35px; right: 0; background: #fff; width:100px; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); padding: 10px; text-align: center; z-index:1000;"
                                    onclick="event.stopPropagation();">

                                    <!-- Title -->
                                    <div
                                        style="font-size: 13px; color: #7a7a9d; font-weight: 600; margin-bottom: 8px;">
                                        Options</div>

                                    <!-- Icons -->
                                    <div style="display:flex; justify-content: space-between; align-items:center;">
                                        <img src="{{ URL::asset('/build/img/delete1.svg') }}" alt="Delete"
                                            style="width: 22px; cursor: pointer;">
                                        <img src="{{ URL::asset('/build/img/download.svg') }}" alt="Edit"
                                            style="width: 22px; cursor: pointer;">

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-12 col-md-6 mb-0">
                        <div class="d-flex justify-content-between align-items-center p-2 rounded"
                            style="background-color: white; box-shadow: 0 0 6px rgba(0,0,0,0.05);">
                            <div class="d-flex align-items-center">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/8/87/PDF_file_icon.svg"
                                    alt="PDF Icon"
                                    style="width: 35px; height: 40px; object-fit: contain; margin-right: 10px;">
                                <div>
                                    <div style="font-weight: 500; font-size: 14px; color: #2e3a59;">ID Card Font ...
                                    </div>
                                    <div style="font-size: 12px; color: #8c94a3;">94 KB - Date</div>
                                </div>
                            </div>
                            <!-- Trigger Button -->
                            <div style="position: relative; display: inline-block;">
                                <div style="width: 28px; height: 28px; border: 1px solid #a6aec1; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; background:#fff;"
                                    onclick="let menu=this.nextElementSibling; menu.style.display = (menu.style.display==='block')?'none':'block'; event.stopPropagation();">
                                    <i class="bi bi-three-dots" style="font-size: 16px; color: #2e3a59;"></i>
                                </div>

                                <!-- Popup Menu -->
                                <div class="menu-box"
                                    style="display: none; position: absolute; top: 35px; right: 0; background: #fff; width:100px; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); padding: 10px; text-align: center; z-index:1000;"
                                    onclick="event.stopPropagation();">

                                    <!-- Title -->
                                    <div
                                        style="font-size: 13px; color: #7a7a9d; font-weight: 600; margin-bottom: 8px;">
                                        Options</div>

                                    <!-- Icons -->
                                    <div style="display:flex; justify-content: space-between; align-items:center;">
                                        <img src="{{ URL::asset('/build/img/delete1.svg') }}" alt="Delete"
                                            style="width: 22px; cursor: pointer;">
                                        <img src="{{ URL::asset('/build/img/download.svg') }}" alt="Edit"
                                            style="width: 22px; cursor: pointer;">

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-0">
                        <div class="d-flex justify-content-between align-items-center p-2 rounded"
                            style="background-color: white; box-shadow: 0 0 6px rgba(0,0,0,0.05);">
                            <div class="d-flex align-items-center">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/8/87/PDF_file_icon.svg"
                                    alt="PDF Icon"
                                    style="width: 35px; height: 40px; object-fit: contain; margin-right: 10px;">
                                <div>
                                    <div style="font-weight: 500; font-size: 14px; color: #2e3a59;">ID Card Font ...
                                    </div>
                                    <div style="font-size: 12px; color: #8c94a3;">94 KB - Date</div>
                                </div>
                            </div>
                            <!-- Trigger Button -->
                            <div style="position: relative; display: inline-block;">
                                <div style="width: 28px; height: 28px; border: 1px solid #a6aec1; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; background:#fff;"
                                    onclick="let menu=this.nextElementSibling; menu.style.display = (menu.style.display==='block')?'none':'block'; event.stopPropagation();">
                                    <i class="bi bi-three-dots" style="font-size: 16px; color: #2e3a59;"></i>
                                </div>

                                <!-- Popup Menu -->
                                <div class="menu-box"
                                    style="display: none; position: absolute; top: 35px; right: 0; background: #fff; width:100px; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); padding: 10px; text-align: center; z-index:1000;"
                                    onclick="event.stopPropagation();">

                                    <!-- Title -->
                                    <div
                                        style="font-size: 13px; color: #7a7a9d; font-weight: 600; margin-bottom: 8px;">
                                        Options</div>

                                    <!-- Icons -->
                                    <div style="display:flex; justify-content: space-between; align-items:center;">
                                        <img src="{{ URL::asset('/build/img/delete1.svg') }}" alt="Delete"
                                            style="width: 22px; cursor: pointer;">
                                        <img src="{{ URL::asset('/build/img/download.svg') }}" alt="Edit"
                                            style="width: 22px; cursor: pointer;">

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <!-- documents -->
            <!-- project Task -->
            <div style="font-family: 'Segoe UI', sans-serif;  background-color: #f8f9fa; border-radius: 12px; padding: 20px; padding-bottom:1px;  box-shadow: 0 2px 8px rgba(0,0,0,0.05); color: #2e3a59;"
                class="mt-2">
                <!-- Section Title -->
                <h6 style="font-weight: 600; font-size: 16px; margin-bottom: 12px;">· Project Tasks ·</h6>

                <!-- Ticket Title + Status and Metrics -->

                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-3 flex-wrap mb-2"
                    style="background:#fff; padding: 12px; border-radius: 10px;">

                    <!-- Left Side: Title + Badges -->
                    <div style="flex-grow: 1;">
                        <!-- Task Title -->
                        <div class="d-flex justify-content-between align-items-center flex-wrap mb-2">
                            <div style="font-weight: 600; font-size: 14px; color: #2e3a59;">Task Title</div>

                            <!-- Badges -->
                            <div class="d-flex align-items-center gap-2 mt-2 mt-md-0">

                                <!-- Red Lightning + Count -->
                                <div class="d-flex align-items-center">
                                    <span
                                        style="background: #f4f4f4; padding: 3px 8px; border-top-left-radius: 8px; border-bottom-left-radius: 8px;">
                                        <img src="{{ asset('build/img/tera.svg') }}" width="14"
                                            height="14" />
                                    </span>
                                    <span
                                        style="background: #f44336; color: white; font-size: 12px; font-weight: 600; padding: 6px 10px; border-top-right-radius: 8px; border-bottom-right-radius: 8px;">
                                        · 02 ·
                                    </span>
                                </div>

                                <!-- Low Badge -->
                                <span
                                    style="display: inline-flex; align-items: center; gap: 6px; background: #f3f4f6; color: #8F98A0; font-weight: 600; font-size: 12px; padding: 4px 10px; border-radius: 20px;">
                                    <span
                                        style="width: 10px; height: 10px; border-radius: 50%; background: #28c76f;"></span>
                                    LOW
                                </span>

                                <!-- Yellow Flag Badge -->
                                <span
                                    style="display: inline-flex; align-items: center; background: #fff3cd; padding: 6px; border-radius: 8px;">
                                    <img src="{{ asset('build/img/yelowflag.svg') }}" width="14"
                                        height="14" />
                                </span>
                            </div>
                        </div>

                        <!-- Meta Info -->
                        <div style="font-size: 12px; color: #6c757d; display: flex; gap: 8px; flex-wrap: wrap;">
                            <div><strong>Ticket ID</strong> | <strong>Section</strong> |</div>
                            <div><span style="color: #28c76f;">Start:</span> 22.10.2024 |</div>
                            <div><span style="color: #28c76f;">Deliver:</span> 22.10.2024</div>
                        </div>
                    </div>

                    <!-- Right Side: Stats -->
                    <div class="mt-3 mt-md-0"
                        style="background: #f8f9fa; border-radius: 10px; padding: 10px 15px; min-width: 240px; flex-grow: 1;">
                        <div class="d-flex justify-content-between flex-wrap gap-3">
                            <div class="text-center" style="min-width: 65px;">
                                <div style="color: #1d6fa5; font-weight: 600; font-size: 13px;">Tickets</div>
                                <div style="color: #649bc3; font-size: 11px;">#1 of #05</div>
                            </div>
                            <div class="text-center" style="min-width: 65px;">
                                <div style="color: #1d6fa5; font-weight: 600; font-size: 13px;">Total Tasks</div>
                                <div style="color: #649bc3; font-size: 11px;">#05</div>
                            </div>
                            <div class="text-center" style="min-width: 65px;">
                                <div style="color: #1d6fa5; font-weight: 600; font-size: 13px;">Days Left</div>
                                <div style="color: #649bc3; font-size: 11px;">#05</div>
                            </div>
                        </div>

                        <!-- Progress Bar -->
                        <div style="height: 6px; background: #e0e0e0; border-radius: 5px; margin-top: 10px;">
                            <div style="width: 70%; height: 100%; background: #34c6f3; border-radius: 5px;"></div>
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-3 flex-wrap mb-2"
                    style="background:#fff; padding: 12px; border-radius: 10px; margin-bottom: 16px;">

                    <!-- Left Side: Title + Badges -->
                    <div style="flex-grow: 1;">
                        <!-- Task Title -->
                        <div class="d-flex justify-content-between align-items-center flex-wrap mb-2">
                            <div style="font-weight: 600; font-size: 14px; color: #2e3a59;">Task Title</div>

                            <!-- Badges -->
                            <div class="d-flex align-items-center gap-2 mt-2 mt-md-0">

                                <!-- Red Lightning + Count -->
                                <div class="d-flex align-items-center">
                                    <span
                                        style="background: #f4f4f4; padding: 3px 8px; border-top-left-radius: 8px; border-bottom-left-radius: 8px;">
                                        <img src="{{ asset('build/img/tera.svg') }}" width="14"
                                            height="14" />
                                    </span>
                                    <span
                                        style="background: #f44336; color: white; font-size: 12px; font-weight: 600; padding: 6px 10px; border-top-right-radius: 8px; border-bottom-right-radius: 8px;">
                                        · 02 ·
                                    </span>
                                </div>

                                <!-- Low Badge -->
                                <span
                                    style="display: inline-flex; align-items: center; gap: 6px; background: #f3f4f6; color: #8F98A0; font-weight: 600; font-size: 12px; padding: 4px 10px; border-radius: 20px;">
                                    <span
                                        style="width: 10px; height: 10px; border-radius: 50%; background: #28c76f;"></span>
                                    LOW
                                </span>

                                <!-- Yellow Flag Badge -->
                                <span
                                    style="display: inline-flex; align-items: center; background: #fff3cd; padding: 6px; border-radius: 8px;">
                                    <img src="{{ asset('build/img/yelowflag.svg') }}" width="14"
                                        height="14" />
                                </span>
                            </div>
                        </div>

                        <!-- Meta Info -->
                        <div style="font-size: 12px; color: #6c757d; display: flex; gap: 8px; flex-wrap: wrap;">
                            <div><strong>Ticket ID</strong> | <strong>Section</strong> |</div>
                            <div><span style="color: #28c76f;">Start:</span> 22.10.2024 |</div>
                            <div><span style="color: #28c76f;">Deliver:</span> 22.10.2024</div>
                        </div>
                    </div>

                    <!-- Right Side: Stats -->
                    <div class="mt-3 mt-md-0"
                        style="background: #f8f9fa; border-radius: 10px; padding: 10px 15px; min-width: 240px; flex-grow: 1;">
                        <div class="d-flex justify-content-between flex-wrap gap-3">
                            <div class="text-center" style="min-width: 65px;">
                                <div style="color: #1d6fa5; font-weight: 600; font-size: 13px;">Tickets</div>
                                <div style="color: #649bc3; font-size: 11px;">#1 of #05</div>
                            </div>
                            <div class="text-center" style="min-width: 65px;">
                                <div style="color: #1d6fa5; font-weight: 600; font-size: 13px;">Total Tasks</div>
                                <div style="color: #649bc3; font-size: 11px;">#05</div>
                            </div>
                            <div class="text-center" style="min-width: 65px;">
                                <div style="color: #1d6fa5; font-weight: 600; font-size: 13px;">Days Left</div>
                                <div style="color: #649bc3; font-size: 11px;">#05</div>
                            </div>
                        </div>

                        <!-- Progress Bar -->
                        <div style="height: 6px; background: #e0e0e0; border-radius: 5px; margin-top: 10px;">
                            <div style="width: 70%; height: 100%; background: #34c6f3; border-radius: 5px;"></div>
                        </div>
                    </div>
                </div>


                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-3 flex-wrap mb-2"
                    style="background:#fff; padding: 12px; border-radius: 10px; margin-bottom: 16px;">

                    <!-- Left Side: Title + Badges -->
                    <div style="flex-grow: 1;">
                        <!-- Task Title -->
                        <div class="d-flex justify-content-between align-items-center flex-wrap mb-2">
                            <div style="font-weight: 600; font-size: 14px; color: #2e3a59;">Task Title</div>

                            <!-- Badges -->
                            <div class="d-flex align-items-center gap-2 mt-2 mt-md-0">

                                <!-- Red Lightning + Count -->
                                <div class="d-flex align-items-center">
                                    <span
                                        style="background: #f4f4f4; padding: 3px 8px; border-top-left-radius: 8px; border-bottom-left-radius: 8px;">
                                        <img src="{{ asset('build/img/tera.svg') }}" width="14"
                                            height="14" />
                                    </span>
                                    <span
                                        style="background: #f44336; color: white; font-size: 12px; font-weight: 600; padding: 6px 10px; border-top-right-radius: 8px; border-bottom-right-radius: 8px;">
                                        · 02 ·
                                    </span>
                                </div>

                                <!-- Low Badge -->
                                <span
                                    style="display: inline-flex; align-items: center; gap: 6px; background: #f3f4f6; color: #8F98A0; font-weight: 600; font-size: 12px; padding: 4px 10px; border-radius: 20px;">
                                    <span
                                        style="width: 10px; height: 10px; border-radius: 50%; background: #28c76f;"></span>
                                    LOW
                                </span>

                                <!-- Yellow Flag Badge -->
                                <span
                                    style="display: inline-flex; align-items: center; background: #fff3cd; padding: 6px; border-radius: 8px;">
                                    <img src="{{ asset('build/img/yelowflag.svg') }}" width="14"
                                        height="14" />
                                </span>
                            </div>
                        </div>

                        <!-- Meta Info -->
                        <div style="font-size: 12px; color: #6c757d; display: flex; gap: 8px; flex-wrap: wrap;">
                            <div><strong>Ticket ID</strong> | <strong>Section</strong> |</div>
                            <div><span style="color: #28c76f;">Start:</span> 22.10.2024 |</div>
                            <div><span style="color: #28c76f;">Deliver:</span> 22.10.2024</div>
                        </div>
                    </div>

                    <!-- Right Side: Stats -->
                    <div class="mt-3 mt-md-0"
                        style="background: #f8f9fa; border-radius: 10px; padding: 10px 15px; min-width: 240px; flex-grow: 1;">
                        <div class="d-flex justify-content-between flex-wrap gap-3">
                            <div class="text-center" style="min-width: 65px;">
                                <div style="color: #1d6fa5; font-weight: 600; font-size: 13px;">Tickets</div>
                                <div style="color: #649bc3; font-size: 11px;">#1 of #05</div>
                            </div>
                            <div class="text-center" style="min-width: 65px;">
                                <div style="color: #1d6fa5; font-weight: 600; font-size: 13px;">Total Tasks</div>
                                <div style="color: #649bc3; font-size: 11px;">#05</div>
                            </div>
                            <div class="text-center" style="min-width: 65px;">
                                <div style="color: #1d6fa5; font-weight: 600; font-size: 13px;">Days Left</div>
                                <div style="color: #649bc3; font-size: 11px;">#05</div>
                            </div>
                        </div>

                        <!-- Progress Bar -->
                        <div style="height: 6px; background: #e0e0e0; border-radius: 5px; margin-top: 10px;">
                            <div style="width: 70%; height: 100%; background: #34c6f3; border-radius: 5px;"></div>
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-3 flex-wrap"
                    style="background:#fff; padding: 12px; border-radius: 10px; margin-bottom: 16px;">

                    <!-- Left Side: Title + Badges -->
                    <div style="flex-grow: 1;">
                        <!-- Task Title -->
                        <div class="d-flex justify-content-between align-items-center flex-wrap mb-2">
                            <div style="font-weight: 600; font-size: 14px; color: #2e3a59;">Task Title</div>

                            <!-- Badges -->
                            <div class="d-flex align-items-center gap-2 mt-2 mt-md-0">

                                <!-- Red Lightning + Count -->
                                <div class="d-flex align-items-center">
                                    <span
                                        style="background: #f4f4f4; padding: 3px 8px; border-top-left-radius: 8px; border-bottom-left-radius: 8px;">
                                        <img src="{{ asset('build/img/tera.svg') }}" width="14"
                                            height="14" />
                                    </span>
                                    <span
                                        style="background: #f44336; color: white; font-size: 12px; font-weight: 600; padding: 6px 10px; border-top-right-radius: 8px; border-bottom-right-radius: 8px;">
                                        · 02 ·
                                    </span>
                                </div>

                                <!-- Low Badge -->
                                <span
                                    style="display: inline-flex; align-items: center; gap: 6px; background: #f3f4f6; color: #8F98A0; font-weight: 600; font-size: 12px; padding: 4px 10px; border-radius: 20px;">
                                    <span
                                        style="width: 10px; height: 10px; border-radius: 50%; background: #28c76f;"></span>
                                    LOW
                                </span>

                                <!-- Yellow Flag Badge -->
                                <span
                                    style="display: inline-flex; align-items: center; background: #fff3cd; padding: 6px; border-radius: 8px;">
                                    <img src="{{ asset('build/img/yelowflag.svg') }}" width="14"
                                        height="14" />
                                </span>
                            </div>
                        </div>

                        <!-- Meta Info -->
                        <div style="font-size: 12px; color: #6c757d; display: flex; gap: 8px; flex-wrap: wrap;">
                            <div><strong>Ticket ID</strong> | <strong>Section</strong> |</div>
                            <div><span style="color: #28c76f;">Start:</span> 22.10.2024 |</div>
                            <div><span style="color: #28c76f;">Deliver:</span> 22.10.2024</div>
                        </div>
                    </div>

                    <!-- Right Side: Stats -->
                    <div class="mt-3 mt-md-0"
                        style="background: #f8f9fa; border-radius: 10px; padding: 10px 15px; min-width: 240px; flex-grow: 1;">
                        <div class="d-flex justify-content-between flex-wrap gap-3">
                            <div class="text-center" style="min-width: 65px;">
                                <div style="color: #1d6fa5; font-weight: 600; font-size: 13px;">Tickets</div>
                                <div style="color: #649bc3; font-size: 11px;">#1 of #05</div>
                            </div>
                            <div class="text-center" style="min-width: 65px;">
                                <div style="color: #1d6fa5; font-weight: 600; font-size: 13px;">Total Tasks</div>
                                <div style="color: #649bc3; font-size: 11px;">#05</div>
                            </div>
                            <div class="text-center" style="min-width: 65px;">
                                <div style="color: #1d6fa5; font-weight: 600; font-size: 13px;">Days Left</div>
                                <div style="color: #649bc3; font-size: 11px;">#05</div>
                            </div>
                        </div>

                        <!-- Progress Bar -->
                        <div style="height: 6px; background: #e0e0e0; border-radius: 5px; margin-top: 10px;">
                            <div style="width: 70%; height: 100%; background: #34c6f3; border-radius: 5px;"></div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /project tickets -->

            <!-- footer section -->
            <div style="display: flex; justify-content: space-around; background: #f8f9fa; padding: 8px; border-radius: 10px;"
                class="mt-3">

                <!-- Edit the Project -->
                <div style="text-align: center; flex: 1;cursor:pointer;" onclick="openEditModal()">
                    <div
                        style="background: #316b9e; padding: 10px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;">
                        <img src="{{ asset('build/img/editp.svg') }}" alt="Edit" width="30"
                            height="30">
                    </div>
                    <div style="margin-top: 6px; color: #1c2b48; font-size: 12px; font-weight: 600;">Edit The Project
                    </div>
                </div>

                <!-- Pause the Project -->
                <div style="text-align: center; flex: 1; cursor: pointer;" onclick="openPauseModal()">
                    <div
                        style="background: #f4ba19; padding: 10px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;">
                        <img src="{{ asset('build/img/pause.svg') }}" alt="Pause" width="30"
                            height="30">
                    </div>
                    <div style="margin-top: 6px; color: #1c2b48; font-size: 12px; font-weight: 600;">Pause The Project
                    </div>
                </div>

                <!-- Remove the Project -->
                <div style="text-align: center; flex: 1;cursor: pointer;" onclick="opendeleteModel()">
                    <div
                        style="background: #f44336; padding: 10px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;">
                        <img src="{{ asset('build/img/deletep.svg') }}" alt="Delete" width="30"
                            height="30">
                    </div>
                    <div style="margin-top: 6px; color: #1c2b48; font-size: 12px; font-weight: 600;">Remove The
                        Project</div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- add project -->

<div class="modal fade" id="add_project" tabindex="-1" aria-labelledby="projectModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content"
            style="background-color: #fff; border-radius: 12px; font-family: 'Poppins', sans-serif;">
            <!-- Close Button -->
            <button type="button" data-bs-dismiss="modal" aria-label="Close"
                onclick="this.closest('.modal').classList.remove('show'); this.closest('.modal').style.display='none';"
                onmouseover="this.style.backgroundColor='red'; this.style.color='white';"
                onmouseout="this.style.backgroundColor='transparent'; this.style.color='#1e293b';"
                style="color: #1e293b; font-weight: bold; z-index: 999; width: 32px; height: 32px; line-height: 28px; text-align: center; font-size: 20px; position: absolute; top: 8px; right: 12px; border: none; background-color: transparent; border-radius: 50%; transition: all 0.3s ease;">
                ×
            </button>
            <form id="projectCreateForm" class="modal-body px-4 py-4" method="POST" action="{{ route('project.store') }}"
                enctype="multipart/form-data">
                @csrf
                <h5>Add new Projects</h5>
                <small>Project ID</small>

                <!-- Upload and File Row -->
                <div class="row mt-2" style="background-color:#f7f9fc; border-radius: 12px; padding: 15px;">
                    <!-- Upload Logo -->
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3 mb-sm-0">
                        <label for="uploadLogo"
                            class="d-flex flex-column justify-content-center align-items-center text-center"
                            style="width: 100%; height: 138px; border: 2px dashed #cfd3d9; border-radius: 10px; cursor: pointer; background:#f7f9fc; position: relative; overflow: hidden;">
                            <img id="logoPreview" src=""
                                style="display: none; max-height: 100%; max-width: 100%; object-fit: contain;" />
                            <div id="uploadIconText">
                                <div style="font-size: 28px; color: #a0a4ab;">+</div>
                                <small style="font-size: 12px; color: #a0a4ab;">Upload Logo</small>
                            </div>
                            <input type="file" id="uploadLogo" name="logo" accept="image/*" hidden
                                onchange="var file = this.files[0]; if(file){ var reader = new FileReader(); reader.onload = function(e){ document.getElementById('logoPreview').src = e.target.result; document.getElementById('logoPreview').style.display = 'block'; document.getElementById('uploadIconText').style.display = 'none'; }; reader.readAsDataURL(file); }" />
                        </label>
                    </div>

                  
                </div>


                <!-- Priority Section -->
                <div class="row mt-2" style="background-color:#f7f9fc; border-radius: 12px; padding: 15px;">
                    <!-- Ticket Priority -->
                    <div class="col-12 col-md-6">
                        <label class="fw-semibold" style="font-size: 14px;">Project Title</label>
                        <div style="font-size: 12px; color: #7d7f85;">Enter the title</div>
                        <input type="text" name="title" placeholder="Project Title"
                            class="form-control mt-2" style="border-radius: 8px;" required />
                    </div>

                    <!-- Task Priority -->
                    <div class="col-12 col-md-6">
                        <label class="fw-semibold" style="font-size: 14px;">Priority</label>
                        <div style="font-size: 12px; color: #7d7f85;">Set the Priority of the Project</div>

                        <!-- Priority Button Group -->
                        <div class="d-flex justify-content-between mt-2 px-2 py-1"
                            style="background-color: #fff; border-radius: 12px;">

                            <input type="hidden" name="priority" id="priorityInput" value="low" />
                            <button type="button" class="btn priority-btn active" data-priority="low"
                                style="background-color: #1cc375; color: white; border-radius: 8px; padding: 6px 18px; font-size: 14px;">Low</button>

                            <button type="button" class="btn priority-btn" data-priority="medium"
                                style="background-color: transparent; color: #6c757d; border-radius: 8px; padding: 6px 18px; font-size: 14px;">Middle</button>

                            <button type="button" class="btn priority-btn" data-priority="high"
                                style="background-color: transparent; color: #6c757d; border-radius: 8px; padding: 6px 18px; font-size: 14px;">High</button>
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
                                <div
                                    style="background-color: #fff; border-radius: 12px; padding: 2px 16px; width: 100%; position: relative; border: 1px solid #e0e0e0; height: 45px; display: flex; flex-direction: column; justify-content: center;">

                                    <!-- Label -->
                                    <div style="font-weight: 600; font-size: 14px; color: #7d7f85;">Start Date</div>

                                    <!-- Selected Date -->
                                    <div id="displayDate" style="font-size: 13px; color: #a0a4ab;">DD:MM:YYYY</div>

                                    <!-- Calendar Icon & Input -->
                                    <div
                                        style="position: absolute; top: 50%; right: 16px; transform: translateY(-50%);">
                                        <!-- Icon -->
                                        <img src="{{ URL::asset('/build/img/timeicon.svg') }}"
                                            onclick="document.getElementById('dateInput').showPicker()"
                                            style="width: 20px; height: 20px; cursor: pointer;" />

                                        <!-- Hidden Input (works with showPicker) -->
                                        <input type="date" id="dateInput" name="start_date"
                                            onchange="var d=new Date(this.value); if(this.value)document.getElementById('displayDate').innerText=('0'+d.getDate()).slice(-2)+':' + ('0'+(d.getMonth()+1)).slice(-2)+':'+d.getFullYear();"
                                            style="opacity:0; position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none;" />
                                    </div>
                                </div>
                            </div>

                            <!-- Deliver Date -->
                            <div
                                style="background-color: #fff; border-radius: 12px; padding: 2px 16px; width: 100%; position: relative; border: 1px solid #e0e0e0;height: 45px; display: flex; flex-direction: column; justify-content: center;">

                                <div style="font-weight: 600; font-size: 14px; color: #7d7f85;">Deliver Date</div>

                                <!-- Display selected date -->
                                <div id="deliverDateDisplay" style="font-size: 13px; color: #a0a4ab;">DD:MM:YYYY
                                </div>

                                <!-- Calendar Icon + Hidden Input container -->
                                <div style="position: absolute; top: 50%; right: 16px; transform: translateY(-50%);">
                                    <!-- Calendar Icon -->
                                    <img src="{{ URL::asset('/build/img/timeicon.svg') }}"
                                        onclick="document.getElementById('deliverDateInput').showPicker()"
                                        style="width: 20px; height: 20px; cursor: pointer;" />

                                    <!-- Hidden Date Input -->
                                    <input type="date" id="deliverDateInput" name="end_date"
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
                        <div class="d-flex justify-content-between mt-2 px-1 py-1"
                            style="background-color: #fff; border-radius: 12px;">

                            <input type="hidden" name="reminder_days" id="reminderDaysInput" value="7" />
                            <button type="button" class="btn reminder-btn active" data-days="7"
                                style="background-color: #1cc375; color: white; border-radius: 8px; padding: 6px 18px; font-size: 14px;">7
                                Days</button>

                            <button type="button" class="btn reminder-btn" data-days="15"
                                style="background-color: transparent; color: #6c757d; border-radius: 8px; padding: 6px 18px; font-size: 14px;">15
                                Days</button>

                            <button type="button" class="btn reminder-btn" data-days="30"
                                style="background-color: transparent; color: #6c757d; border-radius: 8px; padding: 6px 18px; font-size: 14px;">30
                                Days</button>
                        </div>

                    </div>
                </div>

                <!-- description -->
                <div class="row mt-2"
                    style="background-color:#f7f9fc; border-radius: 12px; padding: 10px;padding-bottom:0px;">
                    <!-- Ticket Priority -->
                    <div class="col-12">
                        <label class="fw-semibold" style="font-size: 14px;">Project Description</label>
                        <div style="font-size: 12px; color: #7d7f85;margin-bottom:4px;">Describe the Project well
                        </div>
                        <div class="card">

                            <div class="card-body">
                                <textarea id="policyEditor" name="description"></textarea>
                                <!-- <div class="d-flex justify-content-between align-items-center mt-3">
                                        
                                        <div class="btn-group">
                                            <button type="button" id="policyEditBtn" class="btn btn-outline-secondary btn-sm">Edit</button>
                                            <button type="button" id="policySaveBtn" class="btn btn-primary btn-sm">Save</button>
                                        </div>
                                    </div> -->
                                <!-- <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" id="policyRequireAccept">
                                        <label class="form-check-label" for="policyRequireAccept">Require users to accept next time</label>
                                    </div> -->
                            </div>
                        </div>
                    </div>

                    <!-- Task Priority -->
                </div>
                <!-- add project section -->
                <div class="row mt-2 p-3" style="background-color: #f7f9fc; border-radius: 12px; padding: 15px;">
                    <!-- Heading -->
                    <div class="mb-3">
                        <label class="fw-semibold" style="font-size: 14px;">Add Project Section</label>
                        <div style="font-size: 12px; color: #7d7f85;">Type the Content and Press Enter</div>
                    </div>

                    <!-- Section Wrapper -->
                    <div id="sections-wrapper" class="w-100">
                        <div class="row mb-2 section-row">
                            <div class="col-4">
                                <input type="text" name="sections[0][name]" class="form-control" placeholder="Section Name"
                                    style="background-color: #fff; font-size: 13px; color: #7d7f85;" />
                            </div>
                            <div class="col-7">
                                <input type="text" name="sections[0][description]" class="form-control" placeholder="Section Description"
                                    style="background-color: #fff; font-size: 13px; color: #7d7f85;" />
                            </div>
                            <div class="col-1 d-flex align-items-center">
                                <img src="{{ asset('build/img/addfiled.svg') }}" alt="Add"
                                    style="cursor:pointer; width:35px;" onclick="addSection(this)">
                            </div>
                        </div>
                    </div>
                </div>



                <!-- Footer Buttons -->
                <div class="d-flex justify-content-center gap-2 mt-3">
                    <div
                        style="background-color:#f1f1f1; border-radius:3px; padding:6px 12px; display:flex; gap:38px;">
                        <button class="btn"
                            style="background:transparent; color:#7d7f85; border:none; font-weight:500;"
                            data-bs-dismiss="modal">
                            Close
                        </button>

                        <button class="btn" type="submit"
                            style="background:transparent; color:#7d7f85; border:none; font-weight:500;">
                            Save & Close
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- edit project -->
<div class="modal fade" id="edit_project" tabindex="-1" aria-labelledby="projectModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content"
            style="background-color: #fff; border-radius: 12px; font-family: 'Poppins', sans-serif;">
            <!-- Close Button -->
            <button type="button" data-bs-dismiss="modal" aria-label="Close"
                onclick="this.closest('.modal').classList.remove('show'); this.closest('.modal').style.display='none';"
                onmouseover="this.style.backgroundColor='red'; this.style.color='white';"
                onmouseout="this.style.backgroundColor='transparent'; this.style.color='#1e293b';"
                style="color: #1e293b; font-weight: bold; z-index: 999; width: 32px; height: 32px; line-height: 28px; text-align: center; font-size: 20px; position: absolute; top: 8px; right: 12px; border: none; background-color: transparent; border-radius: 50%; transition: all 0.3s ease;">
                ×
            </button>
            <div class="modal-body px-4 py-4">
                <h5>Edit Project</h5>
                <small>Project ID</small>

                <!-- Upload and File Row -->
                <div class="row mt-2" style="background-color:#f7f9fc; border-radius: 12px; padding: 15px;">
                    <!-- Upload Logo -->
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3 mb-sm-0">
                        <label for="uploadLogo"
                            class="d-flex flex-column justify-content-center align-items-center text-center"
                            style="width: 100%; height: 138px; border: 2px dashed #cfd3d9; border-radius: 10px; cursor: pointer; background:#f7f9fc; position: relative; overflow: hidden;">
                            <img id="logoPreview" src=""
                                style="display: none; max-height: 100%; max-width: 100%; object-fit: contain;" />
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
                        <div
                            style="border: 2px dashed #cfd3d9; border-radius: 10px; padding: 15px; background:#f7f9fc">
                            <div class="row g-2">
                                <!-- File Box 1 -->
                                <div class="col-12 col-md-6">
                                    <div
                                        class="bg-white p-2 rounded d-flex align-items-start justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/8/87/PDF_file_icon.svg"
                                                alt="pdf" style="width: 25px; height: 25px;"
                                                class="me-2" />
                                            <div>
                                                <div id="pdfName1" style="font-size: 0.85rem;">File Title.pdf</div>
                                                <small id="pdfSize1" style="color: #a0a4ab;">94 KB of 94 KB</small>
                                            </div>
                                        </div>
                                    </div>
                                    <label for="fileUpload1"
                                        class="d-flex justify-content-center align-items-center mt-2"
                                        style="height: 40px; background-color: #f0f0f0; border-radius: 6px; cursor: pointer;">
                                        <span style="font-size: 20px; color: #a0a4ab;">+</span>
                                        <input type="file" id="fileUpload1" hidden
                                            onchange=" if (this.files.length > 0) { var file = this.files[0];  var name = file.name;  var sizeKB = (file.size / 1024).toFixed(1); document.getElementById('pdfName1').innerText = name; document.getElementById('pdfSize1').innerText = sizeKB + ' KB of ' + sizeKB + ' KB'; } " />
                                    </label>
                                </div>

                                <!-- File Box 2 -->
                                <div class="col-12 col-md-6">
                                    <div
                                        class="bg-white p-2 rounded d-flex align-items-start justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/8/87/PDF_file_icon.svg"
                                                alt="pdf" style="width: 25px; height: 25px;"
                                                class="me-2" />
                                            <div>
                                                <div id="pdfName2" style="font-size: 0.85rem;">File Title.pdf</div>
                                                <small id="pdfSize2" style="color: #a0a4ab;">94 KB of 94 KB</small>
                                            </div>
                                        </div>
                                    </div>
                                    <label for="fileUpload2"
                                        class="d-flex justify-content-center align-items-center mt-2"
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
                        <input type="text" placeholder="Project Title" class="form-control mt-2"
                            style="border-radius: 8px;" />
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
                                <div
                                    style="background-color: #fff; border-radius: 12px; padding: 2px 16px; width: 100%; position: relative; border: 1px solid #e0e0e0; height: 45px; display: flex; flex-direction: column; justify-content: center;">

                                    <!-- Label -->
                                    <div style="font-weight: 600; font-size: 14px; color: #7d7f85;">Start Date</div>

                                    <!-- Selected Date -->
                                    <div id="displayDate" style="font-size: 13px; color: #a0a4ab;">DD:MM:YYYY</div>

                                    <!-- Calendar Icon & Input -->
                                    <div
                                        style="position: absolute; top: 50%; right: 16px; transform: translateY(-50%);">
                                        <!-- Icon -->
                                        <img src="{{ URL::asset('/build/img/timeicon.svg') }}"
                                            onclick="document.getElementById('dateInput').showPicker()"
                                            style="width: 20px; height: 20px; cursor: pointer;" />

                                        <!-- Hidden Input (works with showPicker) -->
                                        <input type="date" id="dateInput"
                                            onchange="var d=new Date(this.value); if(this.value)document.getElementById('displayDate').innerText=('0'+d.getDate()).slice(-2)+':' + ('0'+(d.getMonth()+1)).slice(-2)+':'+d.getFullYear();"
                                            style="opacity:0; position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none;" />
                                    </div>
                                </div>
                            </div>

                            <!-- Deliver Date -->
                            <div
                                style="background-color: #fff; border-radius: 12px; padding: 2px 16px; width: 100%; position: relative; border: 1px solid #e0e0e0;height: 45px; display: flex; flex-direction: column; justify-content: center;">

                                <div style="font-weight: 600; font-size: 14px; color: #7d7f85;">Deliver Date</div>

                                <!-- Display selected date -->
                                <div id="deliverDateDisplay" style="font-size: 13px; color: #a0a4ab;">DD:MM:YYYY
                                </div>

                                <!-- Calendar Icon + Hidden Input container -->
                                <div style="position: absolute; top: 50%; right: 16px; transform: translateY(-50%);">
                                    <!-- Calendar Icon -->
                                    <img src="{{ URL::asset('/build/img/timeicon.svg') }}"
                                        onclick="document.getElementById('deliverDateInput').showPicker()"
                                        style="width: 20px; height: 20px; cursor: pointer;" />

                                    <!-- Hidden Date Input -->
                                    <input type="date" id="deliverDateInput"
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
                        <div class="d-flex justify-content-between mt-2 px-1 py-1"
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
        ">7
                                Days</button>

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
        ">15
                                Days</button>

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
        ">30
                                Days</button>
                        </div>

                    </div>
                </div>

                <!-- description -->
                <div class="row mt-2"
                    style="background-color:#f7f9fc; border-radius: 12px; padding: 10px;padding-bottom:0px;">
                    <!-- Ticket Priority -->
                    <div class="col-12">
                        <label class="fw-semibold" style="font-size: 14px;">Project Description</label>
                        <div style="font-size: 12px; color: #7d7f85;margin-bottom:4px;">Describe the Project well
                        </div>
                        <div class="card">

                            <div class="card-body">
                                <textarea id="policyEditor"></textarea>
                                <div class="d-flex justify-content-between align-items-center mt-3">

                                    <div class="btn-group">
                                        <button type="button" id="policyEditBtn"
                                            class="btn btn-outline-secondary btn-sm">Edit</button>
                                        <button type="button" id="policySaveBtn"
                                            class="btn btn-primary btn-sm">Save</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Task Priority -->
                </div>
                <!-- add project section -->
                <div class="row mt-2 p-3" style="background-color: #f7f9fc; border-radius: 12px; padding: 15px;">
                    <!-- Heading -->
                    <div class="mb-3">
                        <label class="fw-semibold" style="font-size: 14px;">Add Project Section</label>
                        <div style="font-size: 12px; color: #7d7f85;">Type the Content and Press Enter</div>
                    </div>

                    <!-- Section Wrapper -->
                    <div id="sections-wrapper1" class="w-100">
                        <div class="row mb-2 section-row1">
                            <div class="col-4">
                                <input type="text" class="form-control" placeholder="Section Name"
                                    style="background-color: #fff; font-size: 13px; color: #7d7f85;" />
                            </div>
                            <div class="col-7">
                                <input type="text" class="form-control" placeholder="Section Description"
                                    style="background-color: #fff; font-size: 13px; color: #7d7f85;" />
                            </div>
                            <div class="col-1 d-flex align-items-center">
                                <img src="{{ asset('build/img/addfiled.svg') }}" alt="Add"
                                    style="cursor:pointer; width:35px;" onclick="editSection(this)">
                            </div>
                        </div>
                    </div>
                </div>



                <!-- Footer Buttons -->
                <div class="d-flex justify-content-center gap-2 mt-3">
                    <div
                        style="background-color:#f1f1f1; border-radius:3px; padding:6px 12px; display:flex; gap:38px;">
                        <button class="btn"
                            style="background:transparent; color:#7d7f85; border:none; font-weight:500;"
                            data-bs-dismiss="modal">
                            Close
                        </button>

                        <button class="btn"
                            style="background:transparent; color:#7d7f85; border:none; font-weight:500;"
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
<div class="modal fade" id="pauseProjectModal" tabindex="-1" aria-labelledby="pauseModalLabel"
    aria-hidden="true" style="visibility: visible;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content"
            style="border-radius: 12px; background-color: #ffffff; padding: 0; font-family: 'Segoe UI', sans-serif;">

            <!-- Header -->
            <div class="modal-header" style="background-color: #f1f1f1; border-bottom: none; padding: 15px 20px;">
                <h5 class="modal-title" id="pauseModalLabel" style="margin: 0; font-weight: 600; color: #1c2b48;">
                    Pause the Project</h5>
            </div>

            <!-- Body -->
            <div class="modal-body" style="text-align: center; padding: 30px 20px 20px;">
                <!-- Icon -->
                <div
                    style="background-color: #f4ba19; width: 60px; height: 60px; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
                    <img src="{{ asset('build/img/pause.svg') }}" alt="Pause Icon" width="28"
                        height="28">
                </div>

                <!-- Text -->
                <p style="font-size: 16px; font-weight: 500; color: #1c2b48;">Please select the reason to Pause the
                    Project</p>

                <!-- Dropdown -->
                <select
                    style="background-color: #f1f1f1; border: none; padding: 10px; width: 70%; margin-top: 20px; border-radius: 6px; color: #1c2b48;">
                    <option>Select the reason</option>
                    <option>Client Request</option>
                    <option>Budget Issue</option>
                    <option>Resource Unavailable</option>
                </select>
            </div>

            <!-- Footer -->
            <div class="modal-footer"
                style="justify-content: center; gap: 20px; border-top: none; padding-bottom: 30px;">
                <button type="button" class="btn " data-bs-dismiss="modal"
                    style="background-color:#f1f1f1; color: #1c2b48; border: none; width: 100px;">Close</button>
                <button type="button" class="btn" data-bs-dismiss="modal"
                    style="background-color:#f1f1f1; color: #1c2b48; border: none; width: 130px;">Save &
                    Close</button>
            </div>

        </div>
    </div>
</div>
<!--delet project model Modal -->
<div class="modal fade" id="removeproject" tabindex="-1" aria-labelledby="pauseModalLabel" aria-hidden="true"
    style="visibility: visible;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content"
            style="border-radius: 12px; background-color: #ffffff; padding: 0; font-family: 'Segoe UI', sans-serif;">

            <!-- Header -->
            <div class="modal-header" style="background-color: #f1f1f1; border-bottom: none; padding: 15px 20px">
                <h5 class="modal-title" id="pauseModalLabel" style="margin: 0; font-weight: 600; color: #1c2b48;">
                    Remove the Project</h5>
            </div>

            <!-- Body -->
            <div class="modal-body" style="text-align: center; padding: 30px 20px 20px;">
                <!-- Warning Message -->
                <div
                    style="background-color: #fff;border: 1px solid #f1f1f1;color: #f44336;font-size: 14px;font-weight: 500;text-align: center;display: flex;align-items: center;justify-content: center;gap: 30px;width: fit-content;padding: 6px 12px;border-radius: 6px;margin: 0 auto 15px;margin-bottom: 15px;">
                    <img src="{{ asset('build/img/tera.svg') }}" alt="Pause Icon" width="15"
                        height="15">
                    Project can't be Removed if there Open Tickets
                </div>

                <!-- Icon -->
                <div
                    style="background-color: #f44336; width: 60px; height: 60px; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
                    <img src="{{ asset('build/img/deletep.svg') }}" alt="Pause Icon" width="28"
                        height="28">
                </div>

                <!-- Text -->
                <p style="font-size: 16px; font-weight: 500; color: #1c2b48;">Please select the reason to remove the
                    Project</p>

                <!-- Dropdown -->
                <select
                    style="background-color: #f1f1f1; border: none; padding: 10px; width: 70%; margin-top: 20px; border-radius: 6px; color: #1c2b48;">
                    <option>Select the reason</option>
                    <option>Client Request</option>
                    <option>Budget Issue</option>
                    <option>Resource Unavailable</option>
                </select>
            </div>

            <!-- Footer -->
            <div class="modal-footer"
                style="justify-content: center; gap: 20px; border-top: none; padding-bottom: 30px;">
                <button type="button" class="btn" data-bs-dismiss="modal"
                    style="background-color: #f1f1f1; color: #1c2b48; border: none; width: 100px;">Close</button>
                <button type="button" class="btn" data-bs-dismiss="modal"
                    style="background-color: #f1f1f1; color: #1c2b48; border: none; width: 150px;">Save &
                    Close</button>
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
<!-- edit model pop-up -->
<script>
    function openEditModal() {
        var offcanvasElement = document.getElementById('offcanvasRight');
        if (offcanvasElement) {
            var offcanvasInstance = bootstrap.Offcanvas.getInstance(offcanvasElement);
            if (offcanvasInstance) {
                offcanvasInstance.hide();
            }
        }

        setTimeout(function() {
            var pauseModal = new bootstrap.Modal(document.getElementById('edit_project'));
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

<script>
    // Load Summernote CSS/JS after jQuery is available, then initialize editors
    window.addEventListener('load', function() {
        var summernoteCss = document.createElement('link');
        summernoteCss.rel = 'stylesheet';
        summernoteCss.href = 'https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css';
        document.head.appendChild(summernoteCss);

        var summernoteJs = document.createElement('script');
        summernoteJs.src = 'https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js';
        summernoteJs.onload = function() {
            var $editors = $('#policyEditor, #agreementEditor');
            $editors.summernote({
                placeholder: 'Start typing...',
                tabsize: 2,
                height: 220,
                toolbar: [
                    ['style', ['fontsize']],
                    ['font', ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
                    // remove image and url buttons
                    // ['insert', ['picture', 'link']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['view', ['codeview']]
                ],
                fontSizes: ['12', '14', '16', '18', '20', '24', '28']
            });

            // wire up edit/save controls
            function setEditorDisabled(selector, disabled) {
                var $el = $(selector);
                if (disabled) {
                    $el.summernote('disable');
                } else {
                    $el.summernote('enable');
                }
            }

            // Load any previously saved values from localStorage as a placeholder for backend API
            var savedPolicy = localStorage.getItem('policy_html') || '';
            var savedAgreement = localStorage.getItem('agreement_html') || '';
            var policyVersion = parseInt(localStorage.getItem('policy_version') || '0', 10);
            var agreementVersion = parseInt(localStorage.getItem('agreement_version') || '0', 10);
            $('#policyEditor').summernote('code', savedPolicy);
            $('#agreementEditor').summernote('code', savedAgreement);
            $('#policyVersion').text(policyVersion);
            $('#agreementVersion').text(agreementVersion);

            // default to enabled so you can type immediately
            setEditorDisabled('#policyEditor', false);
            setEditorDisabled('#agreementEditor', false);

            $('#policyEditBtn').on('click', function() {
                setEditorDisabled('#policyEditor', false);
            });
            $('#agreementEditBtn').on('click', function() {
                setEditorDisabled('#agreementEditor', false);
            });

            function postJson(url, data) {
                return fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content')
                    },
                    body: JSON.stringify(data)
                }).then(function(r) {
                    return r.json();
                });
            }

            $('#policySaveBtn').on('click', function() {
                var html = $('#policyEditor').summernote('code');
                var increment = $('#policyRequireAccept').is(':checked');
                postJson('' + window.location.origin + '/settings/policy/save', {
                        html: html,
                        increment_version: increment
                    })
                    .then(function(resp) {
                        if (resp && resp.ok) {
                            if (resp.version !== undefined) $('#policyVersion').text(resp
                                .version);
                            setEditorDisabled('#policyEditor', true);
                        }
                    });
            });

            $('#agreementSaveBtn').on('click', function() {
                var html = $('#agreementEditor').summernote('code');
                var increment = $('#agreementRequireAccept').is(':checked');
                postJson('' + window.location.origin + '/settings/agreement/save', {
                        html: html,
                        increment_version: increment
                    })
                    .then(function(resp) {
                        if (resp && resp.ok) {
                            if (resp.version !== undefined) $('#agreementVersion').text(resp
                                .version);
                            setEditorDisabled('#agreementEditor', true);
                        }
                    });
            });
        };
        document.body.appendChild(summernoteJs);
    });
</script>
<!-- add filed -->
<script>
    function addSection(el) {
        let wrapper = document.getElementById("sections-wrapper");

        // Clone the row
        let newRow = el.closest(".section-row").cloneNode(true);

        // Clear input values
        newRow.querySelectorAll("input").forEach(inp => inp.value = "");

        // Re-index names to be sequential
        let rows = wrapper.querySelectorAll('.section-row');
        let nextIndex = rows.length;
        let nameInput = newRow.querySelector('input[placeholder="Section Name"]');
        let descInput = newRow.querySelector('input[placeholder="Section Description"]');
        if (nameInput) nameInput.setAttribute('name', 'sections[' + nextIndex + '][name]');
        if (descInput) descInput.setAttribute('name', 'sections[' + nextIndex + '][description]');

        // Change icon to remove
        let img = newRow.querySelector("img");
        img.src = "{{ asset('build/img/removefiled.svg') }}";
        img.alt = "Remove";
        img.setAttribute("onclick", "removeSection(this)");

        wrapper.appendChild(newRow);
    }

    function removeSection(el) {
        el.closest(".section-row").remove();
    }
</script>
<script>
    (function() {
        // Priority buttons
        function updatePriorityUI(activeBtn) {
            var container = activeBtn.parentElement;
            var hidden = document.getElementById('priorityInput');
            var all = container.querySelectorAll('.priority-btn');
            all.forEach(function(b) {
                b.classList.remove('active');
                b.style.backgroundColor = 'transparent';
                b.style.color = '#6c757d';
            });
            activeBtn.classList.add('active');
            activeBtn.style.backgroundColor = '#1cc375';
            activeBtn.style.color = 'white';
            hidden.value = activeBtn.getAttribute('data-priority');
        }
        document.querySelectorAll('.priority-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                updatePriorityUI(this);
            });
        });

        // Reminder buttons
        function updateReminderUI(activeBtn) {
            var container = activeBtn.parentElement;
            var hidden = document.getElementById('reminderDaysInput');
            var all = container.querySelectorAll('.reminder-btn');
            all.forEach(function(b) {
                b.classList.remove('active');
                b.style.backgroundColor = 'transparent';
                b.style.color = '#6c757d';
            });
            activeBtn.classList.add('active');
            activeBtn.style.backgroundColor = '#1cc375';
            activeBtn.style.color = 'white';
            hidden.value = activeBtn.getAttribute('data-days');
        }
        document.querySelectorAll('.reminder-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                updateReminderUI(this);
            });
        });

        // Ensure sections have names before submit
        var form = document.getElementById('projectCreateForm');
        if (form) {
            form.addEventListener('submit', function() {
                var rows = document.querySelectorAll('#sections-wrapper .section-row');
                var index = 0;
                rows.forEach(function(row) {
                    var inputs = row.querySelectorAll('input');
                    if (inputs.length >= 2) {
                        inputs[0].setAttribute('name', 'sections[' + index + '][name]');
                        inputs[1].setAttribute('name', 'sections[' + index + '][description]');
                        index++;
                    }
                });
            });
        }
    })();
</script>
<script>
    function editSection(el) {
        let wrapper = document.getElementById("sections-wrapper1");

        // Clone the row
        let newRow = el.closest(".section-row1").cloneNode(true);

        // Clear input values
        newRow.querySelectorAll("input").forEach(inp => inp.value = "");

        // Change icon to remove
        let img = newRow.querySelector("img");
        img.src = "{{ asset('build/img/removefiled.svg') }}";
        img.alt = "Remove";
        img.setAttribute("onclick", "removeSection1(this)");

        wrapper.appendChild(newRow);
    }

    function removeSection1(el) {
        el.closest(".section-row1").remove();
    }
</script>
<!-- filed durng edit -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->
@component('components.model-popup')
@endcomponent
@endsection