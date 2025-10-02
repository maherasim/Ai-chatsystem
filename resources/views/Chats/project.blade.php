<?php $page = 'index'; ?>
@extends('layout.mainlayout')
@section('content')
<style>
    /* Ensure base styles don't interfere */
    @import url('https://fonts.googleapis.com/css2?family=Genos:wght@100;200;300;400;500;600;700&display=swap');

    /* Force Genos font across this page */
    .content.main_content, .content.main_content * {
        font-family: 'Genos', sans-serif !important;
    }

    /* Slightly larger, more readable base sizes */
    .content.main_content {
        font-size: 15.5px;
        line-height: 1.45;
    }
    .content.main_content h1 { font-size: 32px !important; }
    .content.main_content h2 { font-size: 28px !important; }
    .content.main_content h3 { font-size: 24px !important; }
    .content.main_content h4 { font-size: 21px !important; }
    .content.main_content h5 { font-size: 19px !important; }
    .content.main_content h6 { font-size: 17px !important; }
    .content.main_content label,
    .content.main_content .form-control,
    .content.main_content .form-select,
    .content.main_content .modal-title,
    .content.main_content .nav-link,
    .content.main_content .badge,
    .content.main_content .btn {
        font-size: 16px !important;
    }
    .content.main_content small { font-size: 14px !important; }

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
            @include('Chats.header')
            <!-- flash messages -->
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin: 10px;">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="ti ti-x"></i></button>
            </div>
            @endif
            @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin: 10px;">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="ti ti-x"></i></button>
            </div>
            @endif
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
                            @php
                                $projectList = isset($projects) ? $projects : collect();
                            @endphp
                            @forelse ($projectList as $project)
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                <div class="card shadow-sm  p-2"
                                    style="border-radius: 20px; font-family:    'Segoe UI', sans-serif;">
                                    <!-- Top Row: Circle, Center Image, 3 Dots -->
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <!-- Progress Circle -->
                                        <div class="d-flex align-items-center" style="margin-top: 0px;">
                                            <div style="width: 60px; height: 60px; position: relative;">
                                                <svg width="60" height="60">
                                                    <circle cx="30" cy="30" r="26" stroke="#d1d1d1" stroke-width="6"
                                                        fill="none" />
                                                    <circle cx="30" cy="30" r="26" stroke="url(#grad)" stroke-width="6"
                                                        fill="none" stroke-dasharray="163.36" stroke-dashoffset="163.36"
                                                        stroke-linecap="round" transform="rotate(-90 30 30)" />
                                                    <defs>
                                                        <linearGradient id="grad" x1="0%" y1="0%" x2="100%" y2="0%">
                                                            <stop offset="0%" stop-color="#ff7f00" />
                                                            <stop offset="100%" stop-color="#fcd34d" />
                                                        </linearGradient>
                                                    </defs>
                                                </svg>
                                                <div
                                                    style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 12px; font-weight: bold; color: #333;">
                                                    0%
                                                </div>
                                            </div>
                                        </div>
                                        

                                        <!-- Logo Image -->
                                        <div>
                                            <img src="{{ $project->logo_path ? asset('storage/' . $project->logo_path) . '?v=' . (optional($project->updated_at)->timestamp ?? time()) : URL::asset('/build/img/yekbon.svg') }}"
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
                                            aria-controls="offcanvasRight"
                                            data-project-id="{{ (string) ($project->_id ?? $project->id) }}"
                                            onclick="openProjectOffcanvasFromId(this.getAttribute('data-project-id'))">
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
                                                @php
                                                    $workDays = null;
                                                    if (!empty($project->start_date) && !empty($project->end_date)) {
                                                        try {
                                                            $start = $project->start_date instanceof \Carbon\Carbon ? $project->start_date : \Carbon\Carbon::parse($project->start_date);
                                                            $end = $project->end_date instanceof \Carbon\Carbon ? $project->end_date : \Carbon\Carbon::parse($project->end_date);
                                                            if ($end->greaterThanOrEqualTo($start)) {
                                                                $workDays = $start->diffInDays($end) + 1; // inclusive
                                                            }
                                                        } catch (\Throwable $e) {
                                                            $workDays = null;
                                                        }
                                                    }
                                                @endphp
                                                {{ $workDays ? ($workDays . ' Days') : '-' }}</div>
                                        </div>

                                        <!-- Days Left -->
                                        <div class="col-4">
                                            <strong
                                                style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #1e60a1; font-size: 12px;margin-left:13px;">
                                                Days Left
                                            </strong>
                                            <div
                                                style="color: #1e60a1; font-weight: 600; font-size: 12px;margin-left:13px;">
                                                @php
                                                    $daysLeft = null;
                                                    $isOverdue = false;
                                                    
                                                    if (!empty($project->end_date)) {
                                                        try {
                                                            $endDate = $project->end_date instanceof \Carbon\Carbon ? $project->end_date : \Carbon\Carbon::parse($project->end_date);
                                                            $today = \Carbon\Carbon::today();
                                                            
                                                            // Calculate days left (positive) or days overdue (negative)
                                                            $daysLeft = $today->diffInDays($endDate, false);
                                                            
                                                            // Check if project is overdue
                                                            if ($endDate->isPast()) {
                                                                $isOverdue = true;
                                                            }
                                                        } catch (\Throwable $e) {
                                                            $daysLeft = null;
                                                        }
                                                    }
                                                @endphp
                                                @if($daysLeft !== null)
                                                    @if($isOverdue)
                                                        <span style="color: #dc3545;">{{ abs($daysLeft) }} Days Overdue</span>
                                                    @else
                                                        {{ $daysLeft }} Days Left
                                                    @endif
                                                @else
                                                    -
                                                @endif
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
                                                <img src="{{ asset('assets/spin-loader.gif') }}" alt="Loading" style="width: 16px; height: 16px; margin-left: 8px;" />

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
                                                <img src="{{ asset('assets/spin-loader.gif') }}" alt="Loading" style="width: 16px; height: 16px; margin-left: 8px;" />

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
                                                    0 tickets</div>
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
                                                <span style="font-size: 13px; color: #6c757d;">0</span>

                                                <!-- Orange dot + number -->
                                                <span
                                                    style="width: 10px; height: 10px; background: #f59e0b; border-radius: 50%; display: inline-block;"></span>
                                                <span style="font-size: 13px; color: #6c757d;">0</span>

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
                                        <!-- Section Tags -->
                                        @php
                                            $sectionTags = array_slice(($project->sections ?? []), 0, 4);
                                        @endphp
                                        @if (!empty($sectionTags))
                                        <div class="d-flex justify-content-center gap-1 mb-3 flex-nowrap">
                                            @foreach ($sectionTags as $sectionTag)
                                            <div class="px-1 py-1"
                                                style="background: #f4f4f4; border-radius: 999px; font-size: 11px; color: #e53935; font-weight: 500; white-space: nowrap;">
                                                {{ $sectionTag['name'] ?? 'Section' }}
                                            </div>
                                            @endforeach
                                        </div>
                                        @endif
                                        <!-- Section Titles -->
                                        @php
                                            $sectionSlice = array_slice(($project->sections ?? []), 0, 3);
                                        @endphp
                                        @if (!empty($sectionSlice))
                                        <div class="d-flex justify-content-between px-1"
                                            style="font-size: 13px; color: #2e3a59; font-weight: 600; font-family: 'Segoe UI', sans-serif;">
                                            @foreach ($sectionSlice as $section)
                                            <span>{{ $section['name'] ?? 'Section' }} {{ (int) ($project->progress_percent ?? 0) }}%</span>
                                            @endforeach
                                        </div>

                                        <!-- Progress Bars -->
                                        @php
                                            $barColors = [
                                                ['track' => '#d3f4dc', 'bar' => '#28c76f'],
                                                ['track' => '#fef3d3', 'bar' => '#ffc107'],
                                                ['track' => '#fdd7d7', 'bar' => '#ea5455'],
                                            ];
                                        @endphp
                                        <div
                                            class="d-flex justify-content-between align-items-center mt-2 gap-2 px-1">
                                            @foreach ($sectionSlice as $index => $section)
                                            <div class="progress"
                                                style="width: 32%; height: 8px; background-color: {{ $barColors[$index]['track'] }}; border-radius: 10px;">
                                                <div class="progress-bar"
                                                    style="width: {{ (int) ($project->progress_percent ?? 0) }}%; background-color: {{ $barColors[$index]['bar'] }}; border-radius: 10px;">
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        @endif
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
                            @empty
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                 
                            </div>
                            @endforelse

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
                <img id="offcanvasProjectLogo" src="{{ URL::asset('/build/img/yekbon.svg') }}" class="rounded-circle" alt="Profile"
                    style="width: 80px; height: 80px; border: 3px solid #fff; position: absolute; left: 50%; transform: translateX(-50%) translateY(19%); background: #fff; object-fit: cover; z-index: 10;">
            </div>
        </div>

        <!-- Body -->
        <div class="offcanvas-body pt-5" style="font-family: 'Segoe UI', sans-serif; background-color: #fff;">

            <!-- Project Title & ID -->
            <div class="d-flex align-items-center" style="margin-top: 0px;">
                <div style="width: 60px; height: 60px; position: relative;">
                    <svg width="60" height="60">
                        <circle cx="30" cy="30" r="26" stroke="#d1d1d1" stroke-width="6"
                            fill="none" />
                        <circle cx="30" cy="30" r="26" stroke="url(#grad)" stroke-width="6"
                            fill="none" stroke-dasharray="163.36" stroke-dashoffset="163.36"
                            stroke-linecap="round" transform="rotate(-90 30 30)" />
                        <defs>
                            <linearGradient id="grad" x1="0%" y1="0%" x2="100%" y2="0%">
                                <stop offset="0%" stop-color="#ff7f00" />
                                <stop offset="100%" stop-color="#fcd34d" />
                            </linearGradient>
                        </defs>
                    </svg>
                    <div id="offcanvasProgressPercent"
                        style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 12px; font-weight: bold; color: #333;">
                        0%
                    </div>
                </div>
            </div>
            
            <div class="text-center mb-3" style="margin-top:-34px;margin-left:14px;">
                <h5 id="offcanvasProjectTitle" style="font-weight: 600; color: #2e3a59;">Ticket Priority</h5>

                <div id="offcanvasProjectId"
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
                            Start: <span id="offcanvasStartDate" style="color: #2e3a59;">22.10.2024</span>
                        </div>
                        <!-- Divider -->
                        <div style="width: 1px; height: 18px; background-color: #d1d5db; margin: 0 10px;"></div>
                        <div style="color: #34d399;">
                            Deliver: <span id="offcanvasEndDate" style="color: #2e3a59;">22.10.2024</span>
                        </div>
                    </div>

                    <!-- Divider -->
                    <div style="width: 1px; height: 18px; background-color: #d1d5db; margin: 0 10px;"></div>

                    <!-- Priority -->
                    <div
                        style="background: #ffffff; border-radius: 999px; padding: 2px 10px; display: flex; align-items: center; gap: 6px;">
                        <span id="offcanvasPriorityDot"
                            style="width: 8px; height: 8px; background-color: #34d399; border-radius: 50%; display: inline-block;"></span>
                        <span id="offcanvasPriorityText" style="color: #6b7280;">Low</span>
                    </div>
                </div>
            </div>

            <!-- Status Tag -->
            <div class="text-center mb-3">
                <div
                    style="background: #fff7da; /* soft yellow */color: #2e3a59;       /* dark slate for text */border-radius: 999px;display: inline-flex;align-items: center;padding: 4px 18px;font-weight: 600;font-size: 13px">
                  
                    <img src="{{ asset('assets/spin-loader.gif') }}" alt="Loading" style="width: 16px; height: 16px; margin-left: 8px;" />
                </div>
            </div>

            {{-- <div
            style="background: #fff7da; /* soft yellow */color: #2e3a59;       /* dark slate for text */border-radius: 999px;display: inline-flex;align-items: center;padding: 4px 18px;font-weight: 600;font-size: 13px">
            <img src="{{ URL::asset('/build/img/yelow.svg') }}"
                style="height: 14px; width: 14px; margin-right: 8px;" alt="flag" />
            Project is in Hold
        </div> --}}
            <!-- Project Description -->
          

            <!-- Project Progress Card -->
            <div class="card p-3 shadow-sm mb-3"
                style="border-radius: 12px; background-color: #f9f9f9; font-family: 'Segoe UI', sans-serif;">
                <!-- Title -->
                <h6 class="mb-3" style="font-weight: 600; color: #2e3a59;">Project Progress :</h6>

                <!-- Responsive Row -->
                <div class="d-flex justify-content-center align-items-center" style="min-height: 120px; background: #fff; border-radius: 10px;">
                    <img src="{{ asset('assets/spin-loader.gif') }}" alt="Loading" style="width: 20px; height: 20px;" />
                    <span style="font-size: 12px; color: #6c757d; margin-left: 6px;">Loading...</span>
                </div>

            </div>

            <!-- Project Description Section -->
            <div class="card p-3 shadow-sm mb-3"
            style="border-radius: 12px; background-color: #f9f9f9; font-family: 'Segoe UI', sans-serif;">
            <h6 class="mb-2" style="font-weight: 600; color: #2e3a59;">Project Description :</h6>
            <div id="offcanvasProjectDescription" style="font-size: 16px; color: #6c757d; white-space: pre-wrap;">-</div>
        </div>


            <!-- Project Sections Card -->
            <div class="p-3 mb-3" style="border-radius: 12px; background-color: #f8f9fa;">
                <!-- Title -->
                <h6 class="mb-2" style="font-weight: 600; color: #2e3a59;">· Project Sections ·</h6>
                <!-- Dynamic Grid -->
                <div id="offcanvasProjectSections" class="row g-3"></div>
            </div>



            <!-- Our team Card -->
            <div
                style="font-family: 'Segoe UI', sans-serif; background-color: #f8f9fa; padding: 20px; border-radius: 12px;">
                <!-- Section Title -->
                <h6 class="mb-2" style="font-weight: 600; color: #2e3a59; font-size: 16px;">· Our Team ·</h6>

                <!-- Grid Row -->
                <div class="row g-3">
                    <div class="w-100 d-flex justify-content-center align-items-center" style="min-height: 80px;">
                        <img src="{{ asset('assets/spin-loader.gif') }}" alt="Loading" style="width: 20px; height: 20px;" />
                        <span style="font-size: 12px; color: #6c757d; margin-left: 6px;">Loading...</span>
                            </div>
                </div>
            </div>

            <!-- project tcikets -->
            <div style="font-family: 'Segoe UI', sans-serif;  background-color: #f8f9fa; border-radius: 12px; padding: 20px; padding-bottom:1px;  box-shadow: 0 2px 8px rgba(0,0,0,0.05); color: #2e3a59;"
                class="mt-2">
                <!-- Section Title -->
                <h6 style="font-weight: 600; font-size: 16px; margin-bottom: 12px;">· Project Tickets ·</h6>

                <!-- Ticket Title + Status and Metrics -->
                <div class="d-flex justify-content-center align-items-center mb-2 p-3"
                    style="background: #fff; border-radius: 10px; min-height: 100px;">
                    <img src="{{ asset('assets/spin-loader.gif') }}" alt="Loading" style="width: 20px; height: 20px;" />
                    <span style="font-size: 12px; color: #6c757d; margin-left: 6px;">Loading...</span>
                            </div>

                

            </div>
            <!-- /project tickts -->
            <!-- documents -->
            <div class="mt-3" style="background-color: #f8f9fa; padding: 20px;border-radius:10px;">
                <h6 class="mb-2" style="font-weight: 600; font-size: 16px; margin-bottom: 12px;">· Project Files ·
                </h6>
                <div id="offcanvasProjectFiles" class="row">
                    <div class="w-100 d-flex justify-content-center align-items-center" style="min-height: 60px;">
                        <img src="{{ asset('assets/spin-loader.gif') }}" alt="Loading" style="width: 20px; height: 20px;" />
                        <span style="font-size: 12px; color: #6c757d; margin-left: 6px;">Loading...</span>
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
                <div class="d-flex justify-content-center align-items-center mb-2 p-3" style="background: #fff; border-radius: 10px; min-height: 100px;">
                    <img src="{{ asset('assets/spin-loader.gif') }}" alt="Loading" style="width: 20px; height: 20px;" />
                    <span style="font-size: 12px; color: #6c757d; margin-left: 6px;">Loading...</span>
                                </div>

                

                    </div>


            {{-- kam ayega --}}



              {{-- <!-- Left Side: Title + Badges -->
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
                    </div> --}}



                    {{-- waqww --}}
            
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
                    <div class="col-12 col-md-3 mb-2 mb-md-0">
                        <label for="createUploadLogo"
                            class="d-flex flex-column justify-content-center align-items-center text-center"
                            style="width: 100%; height: 138px; border: 2px dashed #cfd3d9; border-radius: 10px; cursor: pointer; background:#f7f9fc; position: relative; overflow: hidden;">
                            <img id="createLogoPreview" src=""
                                style="display: none; width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0;" />
                            <div id="createUploadIconText">
                                <div style="font-size: 28px; color: #a0a4ab;">+</div>
                                <small style="font-size: 12px; color: #a0a4ab;">Upload Logo</small>
                            </div>
                            <input type="file" id="createUploadLogo" name="logo" accept="image/*" hidden
                                onchange="var file = this.files[0]; if(file){ var reader = new FileReader(); reader.onload = function(e){ document.getElementById('createLogoPreview').src = e.target.result; document.getElementById('createLogoPreview').style.display = 'block'; var t=document.getElementById('createUploadIconText'); if(t) t.style.display = 'none'; }; reader.readAsDataURL(file); }" />
                        </label>
                    </div>
                    <!-- PDF attachments -->
                    <div class="col-12 col-md-9">
                        <div id="createPdfList" class="d-flex gap-2 flex-wrap">
                            <!-- Tiles will be appended here -->
                            <div class="pdf-add-tile d-flex align-items-center justify-content-center text-center"
                                style="width: 160px; height: 60px; border: 1px dashed #cfd3d9; border-radius: 10px; cursor: pointer; background:#fff;"
                                onclick="createAddPdfFile()">
                                <div style="font-size: 22px; color: #a0a4ab; line-height: 1;">+</div>
                            </div>
                        </div>
                        <div id="createPdfInputs" style="display:none;"></div>
                    </div>
                </div>


                <!-- Priority Section -->
                <div class="row mt-2" style="background-color:#f7f9fc; border-radius: 12px; padding: 15px;">
                    <!-- Ticket Priority -->
                    <div class="col-12 col-md-6">
                        <label class="fw-semibold" style="font-size: 14px;">Ticket Priority</label>
                        <div style="font-size: 12px; color: #7d7f85;">Set the Priority of the Ticket</div>
                        <input type="text" name="title" placeholder="Project Title"
                            class="form-control mt-2" style="border-radius: 8px;" required />
                    </div>

                    <!-- Task Priority -->
                    <div class="col-12 col-md-6">
                        <label class="fw-semibold" style="font-size: 14px;">Ticket Priority</label>
                        <div style="font-size: 12px; color: #7d7f85;">Set the Priority of the Project</div>

                        <!-- Priority Button Group -->
                        <div class="d-flex justify-content-between mt-2 px-2 py-1" style="">

                            <input type="hidden" name="priority" id="priorityInput" value="low" />
                            <button type="button" class="btn priority-btn active" data-priority="low"
                                style="background-color: #34d399; color: white; border-radius: 8px; padding: 6px 18px; font-size: 14px;">Low</button>

                            <button type="button" class="btn priority-btn" data-priority="medium"
                                style="background-color: #f59e0b; color: white; border-radius: 8px; padding: 6px 18px; font-size: 14px;">Middle</button>

                            <button type="button" class="btn priority-btn" data-priority="high"
                                style="background-color: #ef4444; color: white; border-radius: 8px; padding: 6px 18px; font-size: 14px;">High</button>
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
                        <div class="d-flex gap-2 mt-2" id="projectDurationSectionCreate">
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
                                        <input type="date" id="dateInput" name="start_date" min="{{ date('Y-m-d') }}"
                                            onchange="var d=new Date(this.value); if(this.value)document.getElementById('displayDate').innerText=('0'+d.getDate()).slice(-2)+':' + ('0'+(d.getMonth()+1)).slice(-2)+':'+d.getFullYear(); calculateTotalDays('#projectDurationSectionCreate');"
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
                                    <input type="date" id="deliverDateInput" name="end_date" min="{{ date('Y-m-d') }}"
                                        onchange="var d=new Date(this.value); if(this.value)document.getElementById('deliverDateDisplay').innerText=('0'+d.getDate()).slice(-2)+':' + ('0'+(d.getMonth()+1)).slice(-2)+':'+d.getFullYear(); calculateTotalDays('#projectDurationSectionCreate');"
                                        style="opacity: 0; position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none;" />
                                </div>
                            </div>

                        </div>
                        {{-- <div style="font-size: 12px; color: #1e60a1; font-weight: 600; margin-top: 6px;">
                            Total Days: <span id="totalDaysDisplayCreate">-</span>
                        </div> --}}
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
                <form id="projectEditForm" method="POST" action="/project/__ID__" enctype="multipart/form-data">

                
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                <h5>Edit Project</h5>
                <small>Project ID</small>

                <!-- Upload and File Row -->
                <div class="row mt-2" style="background-color:#f7f9fc; border-radius: 12px; padding: 15px;">
                    <!-- Upload Logo -->
                    <div class="col-12 col-md-3 mb-2 mb-md-0">
                        <label for="editUploadLogo"
                            class="d-flex flex-column justify-content-center align-items-center text-center"
                            style="width: 100%; height: 138px; border: 2px dashed #cfd3d9; border-radius: 10px; cursor: pointer; background:#f7f9fc; position: relative; overflow: hidden;">
                            <img id="editLogoPreview" src=""
                                style="display: none; width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0;" />
                            <div id="editUploadIconText">
                                <div style="font-size: 28px; color: #a0a4ab;">+</div>
                                <small style="font-size: 12px; color: #a0a4ab;">Upload Logo</small>
                            </div>
                            <input type="file" id="editUploadLogo" name="logo" accept="image/*" hidden
                                onchange="var file = this.files[0]; if(file){ var reader = new FileReader(); reader.onload = function(e){ var img=document.getElementById('editLogoPreview'); if(img){ img.src = e.target.result; img.style.display = 'block'; img.setAttribute('data-dirty', '1'); } var t=document.getElementById('editUploadIconText'); if(t) t.style.display = 'none'; }; reader.readAsDataURL(file); }" />
                        </label>
                    </div>
                    <!-- PDF attachments -->
                    <div class="col-12 col-md-9">
                        <div id="editPdfList" class="d-flex gap-2 flex-wrap"></div>
                        <div class="d-flex mt-2">
                            <div class="pdf-add-tile d-flex align-items-center justify-content-center text-center"
                                style="width: 160px; height: 60px; border: 1px dashed #cfd3d9; border-radius: 10px; cursor: pointer; background:#fff;"
                                onclick="editAddPdfFile()">
                                <div style="font-size: 22px; color: #a0a4ab; line-height: 1;">+</div>
                            </div>
                        </div>
                        <div id="editPdfInputs" style="display:none;"></div>
                    </div>
                </div>


                <!-- Priority Section -->
                <div class="row mt-2" style="background-color:#f7f9fc; border-radius: 12px; padding: 15px;">
                    <!-- Ticket Priority -->
                    <div class="col-12 col-md-6">
                        <label class="fw-semibold" style="font-size: 14px;">Ticket Priority </label>
                        <div style="font-size: 12px; color: #7d7f85;">Set the Priority of the Ticket</div>
                        <input type="text" name="title" id="editTitle" placeholder="Project Title" class="form-control mt-2"
                            style="border-radius: 8px;" required />
                    </div>

                    <!-- Task Priority -->
                    <div class="col-12 col-md-6">
                        <label class="fw-semibold" style="font-size: 14px;">Priority</label>
                        <div style="font-size: 12px; color: #7d7f85;">Set the Priority of the Project</div>

                        <!-- Priority Button Group -->
                        <div class="d-flex justify-content-between mt-2 px-2 py-1" style="">

                            <input type="hidden" name="priority" id="priorityInputEdit" value="low" />
                            <button type="button" class="btn priority-btn-edit" data-priority="low"
                                style="background-color: #34d399; color: white; border-radius: 8px; padding: 6px 18px; font-size: 14px;"
                                onclick="
            var btns = this.parentElement.querySelectorAll('button');
            for (var i = 0; i < btns.length; i++) {
                btns[i].style.backgroundColor = 'transparent';
                btns[i].style.color = '#6c757d';
            }
            this.style.backgroundColor = '#34d399';
            this.style.color = 'white';
            document.getElementById('priorityInputEdit').value='low';
        ">Low</button>

                            <button type="button" class="btn priority-btn-edit" data-priority="medium"
                                style="background-color: #f59e0b; color: white; border-radius: 8px; padding: 6px 18px; font-size: 14px;"
                                onclick="
            var btns = this.parentElement.querySelectorAll('button');
            for (var i = 0; i < btns.length; i++) {
                btns[i].style.backgroundColor = 'transparent';
                btns[i].style.color = '#6c757d';
            }
            this.style.backgroundColor = '#f59e0b';
            this.style.color = 'white';
            document.getElementById('priorityInputEdit').value='medium';
        ">Middle</button>

                            <button type="button" class="btn priority-btn-edit" data-priority="high"
                                style="background-color: #ef4444; color: white; border-radius: 8px; padding: 6px 18px; font-size: 14px;"
                                                onclick="
                            var btns = this.parentElement.querySelectorAll('button');
                            for (var i = 0; i < btns.length; i++) {
                                btns[i].style.backgroundColor = 'transparent';
                                btns[i].style.color = '#6c757d';
                            }
                            this.style.backgroundColor = '#ef4444';
                            this.style.color = 'white';
                            document.getElementById('priorityInputEdit').value='high';
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
                        <div class="d-flex gap-2 mt-2" id="projectDurationSectionEdit">
                            <div style="position: relative; width: 100%;">
                                <div
                                    style="background-color: #fff; border-radius: 12px; padding: 2px 16px; width: 100%; position: relative; border: 1px solid #e0e0e0; height: 45px; display: flex; flex-direction: column; justify-content: center;">

                                    <!-- Label -->
                                    <div style="font-weight: 600; font-size: 14px; color: #7d7f85;">Start Date</div>

                                    <!-- Selected Date -->
                                    <div id="editStartDateDisplay" style="font-size: 13px; color: #a0a4ab;">DD:MM:YYYY</div>

                                    <!-- Calendar Icon & Input -->
                                    <div
                                        style="position: absolute; top: 50%; right: 16px; transform: translateY(-50%);">
                                        <!-- Icon -->
                                        <img src="{{ URL::asset('/build/img/timeicon.svg') }}"
                                            onclick="document.getElementById('editStartDateInput').showPicker()"
                                            style="width: 20px; height: 20px; cursor: pointer;" />

                                        <!-- Hidden Input (works with showPicker) -->
                                        <input type="date" id="editStartDateInput" name="start_date" min="{{ date('Y-m-d') }}"
                                            onchange="var d=new Date(this.value); if(this.value)document.getElementById('editStartDateDisplay').innerText=('0'+d.getDate()).slice(-2)+':' + ('0'+(d.getMonth()+1)).slice(-2)+':'+d.getFullYear(); calculateTotalDays('#projectDurationSectionEdit');"
                                            style="opacity:0; position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none;" />
                                    </div>
                                </div>
                            </div>

                            <!-- Deliver Date -->
                            <div
                                style="background-color: #fff; border-radius: 12px; padding: 2px 16px; width: 100%; position: relative; border: 1px solid #e0e0e0;height: 45px; display: flex; flex-direction: column; justify-content: center;">

                                <div style="font-weight: 600; font-size: 14px; color: #7d7f85;">Deliver Date</div>

                                <!-- Display selected date -->
                                <div id="editEndDateDisplay" style="font-size: 13px; color: #a0a4ab;">DD:MM:YYYY
                                </div>

                                <!-- Calendar Icon + Hidden Input container -->
                                <div style="position: absolute; top: 50%; right: 16px; transform: translateY(-50%);">
                                    <!-- Calendar Icon -->
                                    <img src="{{ URL::asset('/build/img/timeicon.svg') }}"
                                        onclick="document.getElementById('editEndDateInput').showPicker()"
                                        style="width: 20px; height: 20px; cursor: pointer;" />

                                    <!-- Hidden Date Input -->
                                    <input type="date" id="editEndDateInput" name="end_date" min="{{ date('Y-m-d') }}"
                                        onchange="var d=new Date(this.value); if(this.value)document.getElementById('editEndDateDisplay').innerText=('0'+d.getDate()).slice(-2)+':' + ('0'+(d.getMonth()+1)).slice(-2)+':'+d.getFullYear(); calculateTotalDays('#projectDurationSectionEdit');"
                                        style="opacity: 0; position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none;" />
                                </div>
                            </div>

                        </div>
                      
                    </div>

                    <!-- Expired Reminder -->
                    <div class="col-12 col-md-6">
                        <label class="fw-semibold" style="font-size: 14px;">Expired Reminder  </label>
                        <div style="font-size: 12px; color: #7d7f85;">Set a reminder before expired</div>

                        <!-- Reminder Buttons -->
                        <div class="d-flex justify-content-between mt-2 px-1 py-1"
                            style="background-color: #fff; border-radius: 12px;">
                            <input type="hidden" name="reminder_days" id="reminderDaysInputEdit" value="7" />
                            <button type="button" class="btn"
                                style="background-color: #1cc375; color: white; border-radius: 8px; padding: 6px 18px; font-size: 14px;"
                                onclick="
            var btns = this.parentElement.querySelectorAll('button');
            for (var i = 0; i < btns.length; i++) {
                btns[i].style.backgroundColor = 'transparent';
                btns[i].style.color = '#6c757d';
            }
            this.style.backgroundColor = '#1cc375';
            this.style.color = 'white';
            document.getElementById('reminderDaysInputEdit').value = '7';
        ">7
                                Days</button>

                            <button type="button" class="btn"
                                style="background-color: transparent; color: #6c757d; border-radius: 8px; padding: 6px 18px; font-size: 14px;"
                                onclick="
            var btns = this.parentElement.querySelectorAll('button');
            for (var i = 0; i < btns.length; i++) {
                btns[i].style.backgroundColor = 'transparent';
                btns[i].style.color = '#6c757d';
            }
            this.style.backgroundColor = '#1cc375';
            this.style.color = 'white';
            document.getElementById('reminderDaysInputEdit').value = '15';
        ">15
                                Days</button>

                            <button type="button" class="btn"
                                style="background-color: transparent; color: #6c757d; border-radius: 8px; padding: 6px 18px; font-size: 14px;"
                                onclick="
            var btns = this.parentElement.querySelectorAll('button');
            for (var i = 0; i < btns.length; i++) {
                btns[i].style.backgroundColor = 'transparent';
                btns[i].style.color = '#6c757d';
            }
            this.style.backgroundColor = '#1cc375';
            this.style.color = 'white';
            document.getElementById('reminderDaysInputEdit').value = '30';
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
                                <textarea id="editDescription" name="description"></textarea>
                                <div class="d-flex justify-content-between align-items-center mt-3">

                                   
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
                                <input type="text" name="sections[0][name]" class="form-control" placeholder="Section Name"
                                    style="background-color: #fff; font-size: 13px; color: #7d7f85;" />
                            </div>
                            <div class="col-7">
                                <input type="text" name="sections[0][description]" class="form-control" placeholder="Section Description"
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

                        <button class="btn" type="submit"
                            style="background:transparent; color:#7d7f85; border:none; font-weight:500;"
                            >
                            Save & Close
                        </button>
                    </div>
                </div>
                </form>
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
                <button type="button" class="btn" onclick="confirmDeleteProject(this)"
                    style="background-color: #f44336; color: #ffffff; border: none; width: 150px;">Delete Project</button>
            </div>

        </div>
    </div>
</div>


</div>
<script>
    function setTextById(id, text) {
        var el = document.getElementById(id);
        if (el) el.textContent = (text == null || String(text).trim() === '') ? '-' : text;
    }
    function setImgById(id, src, fallback) {
        var el = document.getElementById(id);
        if (el) el.src = (src && String(src).trim().length) ? src : fallback;
    }
    function fmtDateYmdToDmy(dateStr) {
        if (!dateStr) return 'DD.MM.YYYY';
        var dt = new Date(dateStr);
        if (isNaN(dt.getTime())) return 'DD.MM.YYYY';
        var d = ('0' + dt.getDate()).slice(-2);
        var m = ('0' + (dt.getMonth() + 1)).slice(-2);
        var y = dt.getFullYear();
        return d + '.' + m + '.' + y;
    }

    function populateProjectOffcanvas(project) {
        if (!project) return;
        setImgById('offcanvasProjectLogo', project.logo_url, "{{ URL::asset('/build/img/yekbon.svg') }}");
        setTextById('offcanvasProjectTitle', project.title || 'Project Title');
        setTextById('offcanvasProjectId', (project.code && String(project.code).trim()) ? project.code : (project.id ? String(project.id) : 'Project ID'));
        setTextById('offcanvasStartDate', fmtDateYmdToDmy(project.start_date));
        setTextById('offcanvasEndDate', fmtDateYmdToDmy(project.end_date));
        setTextById('offcanvasProgressPercent', ((project.progress_percent || 0) + '%'));
        // Priority pill
        try {
            var priority = (project.priority || '').toString().toLowerCase();
            var color = '#6b7280';
            var label = 'Unknown';
            if (priority === 'low') { color = '#34d399'; label = 'Low'; }
            else if (priority === 'medium' || priority === 'middle') { color = '#f59e0b'; label = 'Medium'; }
            else if (priority === 'high') { color = '#ef4444'; label = 'High'; }
            var dot = document.getElementById('offcanvasPriorityDot');
            var txt = document.getElementById('offcanvasPriorityText');
            if (dot) dot.style.backgroundColor = color;
            if (txt) txt.textContent = label;
        } catch (e) {}
        // If you add a description container later, set it here as well
        var descEl = document.getElementById('offcanvasProjectDescription');
        if (descEl) {
            var desc = project.description || '';
            var hasHtml = /<\s*\w+[^>]*>/i.test(desc);
            if (hasHtml) {
                descEl.style.whiteSpace = 'normal';
                descEl.innerHTML = desc.trim();
            } else {
                descEl.style.whiteSpace = 'pre-wrap';
                descEl.textContent = desc.trim().length ? desc.replace(/\s{2,}/g, ' ') : '-';
            }
        }

        // Render dynamic project sections
        try {
            var container = document.getElementById('offcanvasProjectSections');
            if (container) {
                container.innerHTML = '';
                var sections = Array.isArray(project.sections) ? project.sections : [];
                if (sections.length === 0) {
                    var empty = document.createElement('div');
                    empty.className = 'col-12';
                    empty.innerHTML = '<div style="background:#fff;border-radius:12px;padding:14px;text-align:center;color:#6c757d;">No sections added</div>';
                    container.appendChild(empty);
                } else {
                    sections.forEach(function(sec) {
                        var col = document.createElement('div');
                        col.className = 'col-6 col-md-4 col-lg-3';
                        col.innerHTML = '\
                            <div style="background:#fff;padding:16px;border-radius:12px;text-align:center;position:relative;box-shadow:0 2px 5px rgba(0,0,0,0.03);">\
                                <img src="{{ URL::asset('/build/img/project.svg') }}" style="height:40px;margin-bottom:10px;" alt="icon">\
                                <div style="font-size:14px;font-weight:600;color:#2e3a59;margin-bottom:10px;">' + (sec && sec.name ? sec.name : 'Section') + '</div>\
                                <div style="font-size:12px;color:#6c757d;">' + (sec && sec.description ? sec.description : '') + '</div>\
                            </div>';
                        container.appendChild(col);
                    });
                }
            }
        } catch (e) {}

        // Render attachments
        try {
            var filesWrap = document.getElementById('offcanvasProjectFiles');
            if (filesWrap) {
                filesWrap.innerHTML = '';
                var atts = Array.isArray(project.attachments) ? project.attachments : [];
                if (atts.length === 0) {
                    var empty = document.createElement('div');
                    empty.className = 'w-100 d-flex justify-content-center align-items-center';
                    empty.style.minHeight = '60px';
                    empty.innerHTML = '<div style="font-size:12px;color:#6c757d;">No files uploaded</div>';
                    filesWrap.appendChild(empty);
                } else {
                    atts.forEach(function(att){
                        var col = document.createElement('div');
                        col.className = 'col-12 col-md-6 mb-2';
                        var name = (att && att.name) ? att.name : 'File.pdf';
                        var size = (att && att.size_kb != null) ? (att.size_kb + ' KB') : '';
                        var url = (att && att.url) ? att.url : '#';
                        col.innerHTML = '\
                            <div class="d-flex justify-content-between align-items-center p-2 rounded" style="background-color: white; box-shadow: 0 0 6px rgba(0,0,0,0.05);">\
                                <a href="' + url + '" target="_blank" rel="noopener" class="d-flex align-items-center" style="text-decoration:none;">\
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/8/87/PDF_file_icon.svg" alt="PDF Icon" style="width: 35px; height: 40px; object-fit: contain; margin-right: 10px;">\
                                    <div>\
                                        <div style="font-weight: 500; font-size: 14px; color: #2e3a59;">' + name + '</div>\
                                        <div style="font-size: 12px; color: #8c94a3;">' + size + '</div>\
                                    </div>\
                                </a>\
                                <a href="' + url + '" download style="display:inline-flex;align-items:center;gap:6px;">\
                                    <img src="{{ URL::asset('/build/img/download.svg') }}" alt="Download" style="width: 20px; height: 20px;">\
                                </a>\
                            </div>';
                        filesWrap.appendChild(col);
                    });
                }
            }
        } catch (e) {}
    }

    function openProjectOffcanvasFromId(id) {
        try {
            setCurrentProjectId(id);
            var p = (window.projectMap && window.projectMap[id]) ? window.projectMap[id] : null;
            if (p) populateProjectOffcanvas(p);
        } catch (e) { console.error(e); }
    }
</script>
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
<script>
    // Build a lightweight map of projects rendered on this page for quick prefill
    window.projectMap = window.projectMap || {};
    @foreach (($projects ?? []) as $p)
        window.projectMap["{{ (string) ($p->_id ?? $p->id) }}"] = {
            id: "{{ (string) ($p->_id ?? $p->id) }}",
            code: @json($p->code),
            title: @json($p->title),
            priority: @json($p->priority),
            start_date: "{{ $p->start_date ? ( ($p->start_date instanceof \Carbon\Carbon ? $p->start_date : \Carbon\Carbon::parse($p->start_date))->format('Y-m-d') ) : '' }}",
            end_date: "{{ $p->end_date ? ( ($p->end_date instanceof \Carbon\Carbon ? $p->end_date : \Carbon\Carbon::parse($p->end_date))->format('Y-m-d') ) : '' }}",
            description: @json($p->description),
            reminder_days: {!! $p->reminder_days === null ? 'null' : (int) $p->reminder_days !!},
            progress_percent: {!! (int) ($p->progress_percent ?? 0) !!},
            status: @json($p->status),
            logo_url: "{{ $p->logo_path ? asset('storage/' . $p->logo_path) . '?v=' . (optional($p->updated_at)->timestamp ?? time()) : '' }}",
            sections: @json($p->sections ?? []),
            attachments: @json($p->attachments ?? [])
        };
    @endforeach

    function prefillEditForm(project) {
        try {
            if (!project) return;

            var titleEl = document.getElementById('editTitle');
            if (titleEl) titleEl.value = project.title || '';

            // Priority
            var hiddenPriority = document.getElementById('priorityInputEdit');
            var priorityValue = project.priority || 'low';
            if (hiddenPriority) hiddenPriority.value = priorityValue;
            var pBtns = document.querySelectorAll('.priority-btn-edit');
            pBtns.forEach(function(btn){
                var isActive = btn.getAttribute('data-priority') === priorityValue;
                var colorMap = { low: '#34d399', medium: '#f59e0b', high: '#ef4444' };
                var pri = btn.getAttribute('data-priority');
                btn.style.backgroundColor = isActive ? (colorMap[pri] || '#34d399') : 'transparent';
                btn.style.color = isActive ? 'white' : '#6c757d';
            });

            // Dates
            var s = document.getElementById('editStartDateInput');
            var e = document.getElementById('editEndDateInput');
            if (s) s.value = project.start_date || '';
            if (e) e.value = project.end_date || '';
            function fmt(d){
                if(!d) return 'DD:MM:YYYY';
                var dt = new Date(d);
                if (isNaN(dt.getTime())) return 'DD:MM:YYYY';
                return ('0'+dt.getDate()).slice(-2)+':' + ('0'+(dt.getMonth()+1)).slice(-2)+':'+dt.getFullYear();
            }
            var sd = document.getElementById('editStartDateDisplay');
            var ed = document.getElementById('editEndDateDisplay');
            if (sd) sd.innerText = fmt(project.start_date);
            if (ed) ed.innerText = fmt(project.end_date);

            // Reminder days
            var remHidden = document.getElementById('reminderDaysInputEdit');
            var remVal = (project.reminder_days === null || project.reminder_days === undefined) ? '7' : String(project.reminder_days);
            if (remHidden) remHidden.value = remVal;
            if (remHidden && remHidden.parentElement) {
                var remBtns = remHidden.parentElement.querySelectorAll('button');
                remBtns.forEach(function(b){
                    b.style.backgroundColor = 'transparent';
                    b.style.color = '#6c757d';
                    var label = (b.textContent || '').trim();
                    if (label.startsWith(remVal)) {
                        b.style.backgroundColor = '#1cc375';
                        b.style.color = 'white';
                    }
                });
            }

            // Description
            var desc = document.getElementById('editDescription');
            if (desc) {
                if (typeof $ !== 'undefined' && $.fn && $.fn.summernote) {
                    if (!$(desc).data('summernote')) {
                        $(desc).summernote({
                            placeholder: 'Describe the project...',
                            tabsize: 2,
                            height: 220
                        });
                    }
                    $(desc).summernote('code', project.description || '');
                } else {
                    desc.value = project.description || '';
                }
            }

            // Logo preview (edit modal)
            var logoImg = document.getElementById('editLogoPreview');
            var uploadIconText = document.getElementById('editUploadIconText');
            var fileInput = document.getElementById('editUploadLogo');
            if (logoImg) {
                if (logoImg.getAttribute('data-dirty') === '1') {
                    // keep user-chosen preview if already set during this session
                    logoImg.style.display = 'block';
                    if (uploadIconText) uploadIconText.style.display = 'none';
                } else if (project.logo_url) {
                    // bust cache so latest uploaded image shows
                    var bust = 'v=' + Date.now();
                    var base = project.logo_url.split('?')[0];
                    logoImg.src = base + '?' + bust;
                    logoImg.style.display = 'block';
                    if (uploadIconText) uploadIconText.style.display = 'none';
                } else {
                    logoImg.style.display = 'none';
                    if (uploadIconText) uploadIconText.style.display = 'block';
                }
                // reset file input so selecting same file re-triggers change
                if (fileInput) fileInput.value = '';
            }

            // Attachments render (edit modal)
            try {
                var attachments = Array.isArray(project.attachments) ? project.attachments : [];
                renderEditAttachments(attachments);
            } catch (e) { }

            // Sections
            try {
                var wrapper = document.getElementById('sections-wrapper1');
                if (wrapper) {
                    wrapper.innerHTML = '';
                    var sections = Array.isArray(project.sections) ? project.sections : [];
                    if (sections.length === 0) {
                        var row = document.createElement('div');
                        row.className = 'row mb-2 section-row1';
                        row.innerHTML = '<div class="col-4"><input type="text" name="sections[0][name]" class="form-control" placeholder="Section Name" style="background-color: #fff; font-size: 13px; color: #7d7f85;" /></div><div class="col-7"><input type="text" name="sections[0][description]" class="form-control" placeholder="Section Description" style="background-color: #fff; font-size: 13px; color: #7d7f85;" /></div><div class="col-1 d-flex align-items-center"><img src="{{ asset('build/img/addfiled.svg') }}" alt="Add" style="cursor:pointer; width:35px;" onclick="editSection(this)"></div>';
                        wrapper.appendChild(row);
                    } else {
                        sections.forEach(function(sec, idx){
                            var row = document.createElement('div');
                            row.className = 'row mb-2 section-row1';
                            row.innerHTML = '<div class="col-4"><input type="text" name="sections['+idx+'][name]" class="form-control" placeholder="Section Name" style="background-color: #fff; font-size: 13px; color: #7d7f85;" /></div><div class="col-7"><input type="text" name="sections['+idx+'][description]" class="form-control" placeholder="Section Description" style="background-color: #fff; font-size: 13px; color: #7d7f85;" /></div><div class="col-1 d-flex align-items-center"><img src="{{ asset('build/img/addfiled.svg') }}" alt="Add" style="cursor:pointer; width:35px;" onclick="editSection(this)"></div>';
                            wrapper.appendChild(row);
                            var inputs = row.querySelectorAll('input');
                            if (inputs[0]) inputs[0].value = (sec && sec.name) ? sec.name : '';
                            if (inputs[1]) inputs[1].value = (sec && sec.description) ? sec.description : '';
                        });
                    }
                }
            } catch (ignored) {}

            // Recompute total days for edit section
            calculateTotalDays('#projectDurationSectionEdit');
        } catch (e) {
            // no-op
        }
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
            // Prefill form from last selected project id
            try {
                if (!currentProjectId) {
                    console.warn('No currentProjectId set');
                }
                document.getElementById('projectEditForm').setAttribute('action', '/project/' + encodeURIComponent(currentProjectId));
                // Prefill by fetching current project JSON (fallback when projectMap missing or stale)
                fetch('/api/tickets/projects', { credentials: 'same-origin' })
                    .then(r => r.json())
                    .then(list => {
                        var found = Array.isArray(list) ? list.find(p => String(p.id) === String(currentProjectId)) : null;
                        // list from tickets.projects only has id/title; so we still need a detailed endpoint.
                    })
                    .catch(() => {});
                if (window.projectMap && window.projectMap[currentProjectId]) {
                    prefillEditForm(window.projectMap[currentProjectId]);
                }
            } catch (e) { console.error(e); }
            pauseModal.show();
        }, 400);
    }
</script>
<!-- remove project pop-up and delete logic -->
<script>
    var currentProjectId = null;
    function setCurrentProjectId(id) {
        currentProjectId = id;
    }

    function opendeleteModel() {
        var offcanvasElement = document.getElementById('offcanvasRight');
        if (offcanvasElement) {
            var offcanvasInstance = bootstrap.Offcanvas.getInstance(offcanvasElement);
            if (offcanvasInstance) {
                offcanvasInstance.hide();
            }
        }

        setTimeout(function() {
            var modalEl = document.getElementById('removeproject');
            var modal = new bootstrap.Modal(modalEl);
            modal.show();
        }, 400);
    }

    async function confirmDeleteProject(buttonEl) {
        if (!currentProjectId) {
            alert('No project selected. Open a project first.');
            return;
        }

        try {
            const resp = await fetch('/project/' + encodeURIComponent(currentProjectId), {
                method: 'DELETE',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                credentials: 'same-origin'
            });

            if (resp.redirected) {
                window.location.href = resp.url;
                return;
            }

            // Regardless of status, navigate to project page to display any flash messages
            window.location.href = '/project';
        } catch (e) {
            console.error('Delete failed', e);
            alert('Failed to delete project');
        }
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
            var $editors = $('#policyEditor, #agreementEditor, #editDescription');
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
            // ensure editDescription is empty by default until prefill runs
            if ($('#editDescription').length) {
                $('#editDescription').summernote('code', '');
            }
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
            var pri = activeBtn.getAttribute('data-priority');
            var colorMap = { low: '#34d399', medium: '#f59e0b', high: '#ef4444' };
            activeBtn.style.backgroundColor = colorMap[pri] || '#34d399';
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

        // --- PDF attachments (create) ---
        window.createAddPdfFile = function() {
            var input = document.createElement('input');
            input.type = 'file';
            input.accept = 'application/pdf';
            input.name = 'attachments[]';
            input.style.display = 'none';
            input.addEventListener('change', function() { handlePdfSelected(this, 'create'); });
            document.getElementById('createPdfInputs').appendChild(input);
            input.click();
        };

        window.handlePdfSelected = function(fileInput, mode) {
            if (!fileInput.files || !fileInput.files[0]) return;
            var file = fileInput.files[0];
            var list = mode === 'edit' ? document.getElementById('editPdfList') : document.getElementById('createPdfList');
            var addTile = list.querySelector('.pdf-add-tile');
            var tile = document.createElement('div');
            tile.className = 'd-flex align-items-center gap-2 px-2';
            tile.style.cssText = 'border:1px solid #e5e7eb;border-radius:10px;height:60px;background:#fff;';
            tile.innerHTML = '<img src="{{ URL::asset('/build/img/pdf-icon.svg') }}" alt="PDF" style="width:20px;height:20px;">'
                + '<div class="d-flex flex-column" style="min-width:100px;">'
                +   '<small style="font-weight:600;">' + (file.name || 'PDF') + '</small>'
                +   '<small style="color:#6b7280;">' + Math.round(file.size/1024) + ' KB</small>'
                + '</div>'
                + '<button type="button" class="btn" style="color:#ef4444;" onclick="removePdfTile(this)"><i class="ti ti-trash"></i></button>';
            if (addTile) {
                list.insertBefore(tile, addTile);
            } else {
                list.appendChild(tile);
            }
            tile._fileInput = fileInput;
        };

        window.removePdfTile = function(btn) {
            var tile = btn.closest('div');
            if (!tile) return;
            if (tile._fileInput) { tile._fileInput.remove(); }
            tile.remove();
        };

        // --- PDF attachments (edit) ---
        window.editAddPdfFile = function() {
            var input = document.createElement('input');
            input.type = 'file';
            input.accept = 'application/pdf';
            input.name = 'attachments[]';
            input.style.display = 'none';
            input.addEventListener('change', function() { handlePdfSelected(this, 'edit'); });
            var holder = document.getElementById('editPdfInputs');
            if (holder) holder.appendChild(input);
            input.click();
        };

        window.renderEditAttachments = function(existing) {
            try {
                var list = document.getElementById('editPdfList');
                if (!list) return;
                list.innerHTML = '';
                (existing || []).forEach(function(att, idx) {
                    var tile = document.createElement('div');
                    tile.className = 'd-flex align-items-center gap-2 px-2';
                    tile.style.cssText = 'border:1px solid #e5e7eb;border-radius:10px;height:60px;background:#fff;';
                    var url = (att && att.url) ? att.url : '#';
                    var name = (att && att.name) ? att.name : ('File ' + (idx+1));
                    var size = (att && att.size_kb) ? (att.size_kb + ' KB') : '';
                    tile.innerHTML = '<img src="{{ URL::asset('/build/img/pdf-icon.svg') }}" alt="PDF" style="width:20px;height:20px;">'
                        + '<div class="d-flex flex-column" style="min-width:100px;">'
                        +   '<a href="' + url + '" target="_blank" style="font-size:12px;font-weight:600;text-decoration:none;color:#1e293b;">' + name + '</a>'
                        +   '<small style="color:#6b7280;">' + size + '</small>'
                        + '</div>'
                        + '<button type="button" class="btn" style="color:#ef4444;" onclick="removeExistingAttachment(this,' + idx + ')"><i class="ti ti-trash"></i></button>';
                    list.appendChild(tile);
                });
            } catch (_) {}
        };

        window.removeExistingAttachment = function(btn, idx) {
            var del = document.createElement('input');
            del.type = 'hidden';
            del.name = 'delete_attachments[]';
            del.value = String(idx);
            var form = document.getElementById('projectEditForm');
            if (form) form.appendChild(del);
            var tile = btn.closest('div');
            if (tile) tile.remove();
        };
    })();
</script>
<script>
    function calculateTotalDays(sectionSelector) {
        try {
            var section = document.querySelector(sectionSelector);
            if (!section) return;
            var isEdit = section.id === 'projectDurationSectionEdit';
            var startInput = isEdit ? document.getElementById('editStartDateInput') : document.getElementById('dateInput');
            var endInput = isEdit ? document.getElementById('editEndDateInput') : document.getElementById('deliverDateInput');
            var display = isEdit ? document.getElementById('totalDaysDisplayEdit') : document.getElementById('totalDaysDisplayCreate');
            if (!startInput || !endInput || !display) return;
            var s = startInput.value ? new Date(startInput.value) : null;
            var e = endInput.value ? new Date(endInput.value) : null;
            if (!s || !e || isNaN(s.getTime()) || isNaN(e.getTime())) {
                display.innerText = '-';
                return;
            }
            // inclusive difference in days
            var diffMs = e.setHours(0,0,0,0) - s.setHours(0,0,0,0);
            var days = Math.floor(diffMs / (1000 * 60 * 60 * 24)) + 1;
            if (days < 0) {
                display.innerText = '-';
            } else {
                display.innerText = days + ' Days';
            }
        } catch (err) {
            // no-op
        }
    }
    // Initial compute when modal opens (if values are prefilled)
    document.addEventListener('DOMContentLoaded', function() {
        calculateTotalDays('#projectDurationSectionCreate');
        calculateTotalDays('#projectDurationSectionEdit');
    });
</script>
<script>
    function reindexEditSections() {
        try {
            var rows = document.querySelectorAll('#sections-wrapper1 .section-row1');
            var index = 0;
            rows.forEach(function(row) {
                var inputs = row.querySelectorAll('input');
                if (inputs.length >= 2) {
                    inputs[0].setAttribute('name', 'sections[' + index + '][name]');
                    inputs[1].setAttribute('name', 'sections[' + index + '][description]');
                    index++;
                }
            });
        } catch (e) { /* no-op */ }
    }

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

        // Ensure unique sequential names after adding
        reindexEditSections();
    }

    function removeSection1(el) {
        el.closest(".section-row1").remove();

        // Ensure unique sequential names after removing
        reindexEditSections();
    }

    // Ensure proper indexing before submitting the edit form
    var editForm = document.getElementById('projectEditForm');
    if (editForm) {
        editForm.addEventListener('submit', function() {
            reindexEditSections();
        });
    }
</script>
<!-- filed durng edit -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->
@component('components.model-popup')
@endcomponent
@endsection