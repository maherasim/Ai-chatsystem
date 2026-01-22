<?php $page = 'index'; ?>
@extends('layout.mainlayout')
@section('content')
<style>
    /* Ensure base styles don't interfere */
    
    /* Force Genos font across this page */
    .content.main_content, .content.main_content * {
       /* font-family: 'Genos', sans-serif !important;*/
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
   
    .content.main_content label,
    .content.main_content .form-control,
    .content.main_content .form-select,
    .content.main_content .modal-title,
    .content.main_content .nav-link,
    .content.main_content .badge,
    .content.main_content .btn {
        font-size: 16px !important;
        outline: none !important;
        box-shadow: none !important;
        border-color: transparent !important;
    }
    .content.main_content .btn:focus,
    .content.main_content .btn:active,
    .content.main_content .btn:focus-visible {
        outline: none !important;
        box-shadow: none !important;
        border-color: transparent !important;
    }

    /* Remove borders/outlines for active priority and reminder buttons */
    .content.main_content .priority-btn,
    .content.main_content .priority-btn.active,
    .content.main_content .priority-btn:focus,
    .content.main_content .priority-btn:active,
    .content.main_content .priority-btn:focus-visible,
    .content.main_content .priority-btn-edit,
    .content.main_content .priority-btn-edit.active,
    .content.main_content .priority-btn-edit:focus,
    .content.main_content .priority-btn-edit:active,
    .content.main_content .priority-btn-edit:focus-visible,
    .content.main_content .reminder-btn,
    .content.main_content .reminder-btn.active,
    .content.main_content .reminder-btn:focus,
    .content.main_content .reminder-btn:active,
    .content.main_content .reminder-btn:focus-visible,
    .content.main_content .reminder-btn-edit,
    .content.main_content .reminder-btn-edit.active,
    .content.main_content .reminder-btn-edit:focus,
    .content.main_content .reminder-btn-edit:active,
    .content.main_content .reminder-btn-edit:focus-visible {
        border: 0 !important;
        border-color: transparent !important;
        outline: none !important;
        box-shadow: none !important;
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
        color: #F2F2F280;
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
        background-color: #F2F2F280;
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
    @include('Chats.notification', ['groups' => $groups ?? collect([])])
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
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-3 py-2">
                            <!-- Card 1: Total Projects -->
                            <div class="col mb-3">
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
                            <div class="col mb-3">
                                <div class="px-3 py-2"
                                    style="border-radius: 10px; height: 100px; background: #fff; position: relative; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);">

                                    <!-- Top Row -->
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div style="font-size: 0.9rem; color: #1e2b4d;">New Project </div>
                                        <div style="background-color: #eae8fd; padding: 5px;">
                                            <img src="{{ URL::asset('/build/img/blueflag.svg') }}" alt="icon"
                                                style="width: 20px; height: 20px;" />
                                        </div>
                                    </div>

                                    <!-- Project Number -->
                                    <div class="fw-bold mt-1" style="font-size: 1.5rem; color: #1e2b4d;">
                                        {{ $newProjectCount ?? 0 }}
                                    </div>

                                    <!-- Percentage Change (Bottom Right) -->
                                    <div
                                        style="position: absolute; bottom: 8px; right: 16px; font-size: 0.9rem; color: #28c76f;">
                                        <i class="bi bi-arrow-up-right"></i> 8.5%
                                    </div>

                                </div>
                            </div>

                            <!-- card-2 -->
                            <div class="col mb-3">
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

                            <div class="col mb-3">
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

                            <div class="col mb-3">
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
                                <div class="card shadow-sm  p-2" data-project-card="{{ (string) ($project->_id ?? $project->id) }}"
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
                                        <div style="width: 70px; height: 70px; display: flex; align-items: center; justify-content: center;">
                                            <img src="{{ $project->logo_path ? asset('storage/' . $project->logo_path) . '?v=' . (optional($project->updated_at)->timestamp ?? time()) : URL::asset('/build/img/yekbon.svg') }}"
                                                class="rounded-circle"
                                                width="70" height="70"
                                                style="width: 100%; height: 100%; object-fit: cover;"
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
                                                style="font-weight: 600; font-size: 12px;margin-left:13px;">
                                                @php
                                                    $daysDiff = null;
                                                    if (!empty($project->end_date)) {
                                                        try {
                                                            $endDate = $project->end_date instanceof \Carbon\Carbon ? $project->end_date : \Carbon\Carbon::parse($project->end_date);
                                                            $today = \Carbon\Carbon::today();
                                                            // Positive => days left, 0 => due today, Negative => overdue
                                                            $daysDiff = $today->diffInDays($endDate, false);
                                                        } catch (\Throwable $e) {
                                                            $daysDiff = null;
                                                        }
                                                    }
                                                @endphp
                                                @if($daysDiff !== null)
                                                    @if($daysDiff < 0)
                                                        <span style="color:#dc3545;">
                                                            {{ abs($daysDiff) }} {{ \Illuminate\Support\Str::plural('day', abs($daysDiff)) }} overdue
                                                        </span>
                                                    @elseif($daysDiff === 0)
                                                        <span style="color:#f59e0b;">Due today</span>
                                                    @else
                                                        <span style="color:#198754;">
                                                            {{ $daysDiff }} {{ \Illuminate\Support\Str::plural('day', $daysDiff) }} left
                                                        </span>
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
                                            @php
                                                // Get project ID
                                                $projectId = (string) ($project->_id ?? $project->id);
                                                $projectIdRaw = $project->_id ?? $project->id;
                                                
                                                // Build array of possible project_id values to match
                                                $projectIds = [$projectId];
                                                if ($projectIdRaw && (string)$projectIdRaw !== $projectId) {
                                                    $projectIds[] = $projectIdRaw;
                                                }
                                                try {
                                                    $oid = new \MongoDB\BSON\ObjectId($projectId);
                                                    $projectIds[] = $oid;
                                                } catch (\Throwable $e) {}
                                                $projectIds = array_unique($projectIds, SORT_REGULAR);
                                                
                                                // Find teams for this project
                                                $teams = \App\Models\Team::whereIn('project_id', $projectIds)->get();
                                                
                                                // Extract all user IDs from task_developers
                                                $developerIds = collect();
                                                foreach ($teams as $team) {
                                                    $taskDevelopers = $team->task_developers ?? [];
                                                    
                                                    // Handle string format (JSON)
                                                    if (is_string($taskDevelopers)) {
                                                        $taskDevelopers = json_decode($taskDevelopers, true) ?? [];
                                                    }
                                                    
                                                    // Extract keys (user IDs) from the object
                                                    if (is_array($taskDevelopers)) {
                                                        foreach ($taskDevelopers as $userId => $names) {
                                                            if (!empty($userId)) {
                                                                $developerIds->push((string)$userId);
                                                            }
                                                        }
                                                    }
                                                }
                                                
                                                // Get unique developer IDs
                                                $developerIds = $developerIds->unique()->filter()->values();
                                                
                                                // Fetch users
                                                $developers = collect();
                                                if ($developerIds->isNotEmpty()) {
                                                    // Build array with both string and ObjectId formats
                                                    $userIds = [];
                                                    foreach ($developerIds as $devId) {
                                                        $userIds[] = $devId;
                                                        try {
                                                            $oid = new \MongoDB\BSON\ObjectId($devId);
                                                            $userIds[] = $oid;
                                                        } catch (\Throwable $e) {
                                                            // If ObjectId creation fails, just use string
                                                        }
                                                    }
                                                    
                                                    // Query users - try both _id and id fields
                                                    $developers = \App\Models\User::whereIn('_id', $userIds)->get();
                                                    
                                                    // If no results, try with string IDs only
                                                    if ($developers->isEmpty()) {
                                                        $developers = \App\Models\User::whereIn('_id', $developerIds->toArray())->get();
                                                    }
                                                }
                                                
                                                // Helper function to get image URL
                                                $getImageUrl = function($user) {
                                                    if (isset($user->image) && !empty(trim($user->image))) {
                                                        $image = ltrim($user->image, '/');
                                                        if (strpos($image, 'upload/') === 0) {
                                                            return asset($image);
                                                        }
                                                        return asset('storage/' . $image);
                                                    }
                                                    return asset('build/img/profiles/avatar-16.jpg'); // Default avatar
                                                };
                                            @endphp
                                            <div class="d-flex justify-content-center align-items-center mt-2"
                                                style="margin-left: 10px; flex-wrap: wrap;">
                                                @if($developers->isEmpty())
                                                    <span style="font-size: 12px; color: #6c757d;">No developers assigned</span>
                                                @else
                                                    @foreach($developers as $index => $developer)
                                                        <img src="{{ $getImageUrl($developer) }}" 
                                                             alt="{{ $developer->name ?? 'Developer' }}" 
                                                             style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover; border: 2px solid #1e60a1; margin-left: {{ $index > 0 ? '-8px' : '0' }}; z-index: {{ count($developers) - $index }}; position: relative;"
                                                             title="{{ $developer->name ?? 'Developer' }}" />
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-2 mb-2" style="background-color:#f9f9f9;border-radius:10px;">
                                        @php
                                            $projectId = (string) ($project->_id ?? $project->id);
                                            $projectIdRaw = $project->_id ?? $project->id;
                                            
                                            // Helper function to count with ObjectId fallback
                                            $countByProjectId = function($model, $projectId, $projectIdRaw) {
                                                // Build array of possible project_id values to match
                                                $projectIds = [$projectId];
                                                
                                                // Add the raw _id if it's different from the string
                                                if ($projectIdRaw && (string)$projectIdRaw !== $projectId) {
                                                    $projectIds[] = $projectIdRaw;
                                                }
                                                
                                                try {
                                                    // Add ObjectId version
                                                    $oid = new \MongoDB\BSON\ObjectId($projectId);
                                                    $projectIds[] = $oid;
                                                } catch (\Throwable $e) {
                                                    // If ObjectId creation fails, just use string
                                                }
                                                
                                                // Remove duplicates and query with whereIn to match all formats
                                                $projectIds = array_unique($projectIds, SORT_REGULAR);
                                                return $model::whereIn('project_id', $projectIds)->count();
                                            };
                                            
                                            // Count tickets for this project
                                            $ticketsCount = $countByProjectId(\App\Models\Ticket::class, $projectId, $projectIdRaw);
                                            
                                            // Count tasks from all three models
                                            $taskCount = $countByProjectId(\App\Models\Task::class, $projectId, $projectIdRaw);
                                            $webTaskCount = $countByProjectId(\App\Models\WebTask::class, $projectId, $projectIdRaw);
                                            $employeeTaskCount = $countByProjectId(\App\Models\EmployeeTask::class, $projectId, $projectIdRaw);
                                            $totalTasksCount = $taskCount + $webTaskCount + $employeeTaskCount;
                                        @endphp
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
                                                    {{ $ticketsCount }} {{ \Illuminate\Support\Str::plural('ticket', $ticketsCount) }}</div>
                                            </div>
                                            <div class="col">
                                                <strong
                                                    style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;color:black ;font-size: 15px;"><img
                                                        src="{{ URL::asset('/build/img/bluesigma.svg') }}"
                                                        class="rounded-circle" style="height: 15px;"
                                                        alt="Project Logo"> Tasks</strong>
                                                <div class="mt-2"
                                                    style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;background-color:#f1f1f1;color:red;border-radius:10px;margin-left: 13px; width: fit-content; padding: 3px;">
                                                    {{ $totalTasksCount }} {{ \Illuminate\Support\Str::plural('task', $totalTasksCount) }}
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
                                        <!-- Section Tags + Titles/Bars (paged via step bar) -->
                                        @php
                                            $pid = (string) ($project->_id ?? $project->id);
                                            $sectionAll = (array) ($project->sections ?? []);
                                            $sectionSlice = array_slice($sectionAll, 0, 3);
                                        @endphp
                                       
                                        <!-- Section Titles -->
                                        @if (!empty($sectionSlice))
                                        <div id="sec-titles-{{$pid}}" class="d-flex px-1"
                                            style="font-size: 13px; color: #2e3a59; font-weight: 600; font-family: 'Segoe UI', sans-serif; gap: 8px; white-space: nowrap;">
                                            @foreach ($sectionSlice as $section)
                                            <span style="flex: 1 1 0; min-width: 0; overflow: hidden; text-overflow: ellipsis; text-align: center; white-space: nowrap;">{{ $section['name'] ?? 'Section' }} {{ (int) ($project->progress_percent ?? 0) }}%</span>
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
                                        <div id="sec-bars-{{$pid}}"
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
                                        <div class="d-flex justify-content-center gap-2 mt-3" id="stepBar-{{$pid}}">
                                            <div id="step1-{{$pid}}"
                                                onclick="changeSectionPage('{{$pid}}', 0)"
                                                style="width: 60px; height: 5px; background-color: #1cc375; border-radius: 10px; cursor: pointer;">
                                            </div>
                                            <div id="step2-{{$pid}}"
                                                onclick="changeSectionPage('{{$pid}}', 1)"
                                                style="width: 60px; height: 5px; background-color: #ffffff; border-radius: 10px; cursor: pointer;">
                                            </div>

                                            <div id="step3-{{$pid}}"
                                                onclick="changeSectionPage('{{$pid}}', 2)"
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
            <input type="hidden" id="offcanvasProjectRealId" value="">

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
                <div id="offcanvasStatusTag" style="background: #eae8fd; color: #1e2b4d; border-radius: 999px; display: inline-flex; align-items: center; padding: 4px 18px; font-weight: 600; font-size: 13px">
                    <img id="offcanvasStatusIcon" src="{{ URL::asset('/build/img/blueflag.svg') }}" style="height: 14px; width: 14px; margin-right: 8px;" alt="status" />
                    <span id="offcanvasStatusText">Project is New</span>
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
                <div id="offcanvasTeam" class="d-flex flex-wrap gap-2">
                    <div class="w-100 d-flex justify-content-center align-items-center" style="min-height: 80px;">
                        <img src="{{ asset('assets/spin-loader.gif') }}" alt="Loading" style="width: 20px; height: 20px;" />
                        <span style="font-size: 12px; color: #6c757d; margin-left: 6px;">Loading...</span>
                    </div>
                </div>
            </div>

            <!-- project tickets -->
            <div style="font-family: 'Segoe UI', sans-serif;  background-color: #f8f9fa; border-radius: 12px; padding: 20px; padding-bottom:1px;  box-shadow: 0 2px 8px rgba(0,0,0,0.05); color: #2e3a59;" class="mt-2">
                <h6 style="font-weight: 600; font-size: 16px; margin-bottom: 12px;">· Project Tickets ·</h6>
                @php
                    // Get project ID
                    $projectId = (string) ($project->_id ?? $project->id);
                    $projectIdRaw = $project->_id ?? $project->id;
                    
                    // Build array of possible project_id values to match
                    $projectIds = [$projectId];
                    if ($projectIdRaw && (string)$projectIdRaw !== $projectId) {
                        $projectIds[] = $projectIdRaw;
                    }
                    try {
                        $oid = new \MongoDB\BSON\ObjectId($projectId);
                        $projectIds[] = $oid;
                    } catch (\Throwable $e) {}
                    $projectIds = array_unique($projectIds, SORT_REGULAR);
                    
                    // Fetch tickets for this project
                    $tickets = \App\Models\Ticket::whereIn('project_id', $projectIds)
                        ->orderByDesc('created_at')
                        ->limit(20)
                        ->get();
                    
                    // Helper function to get status color
                    $getStatusColor = function($status) {
                        $colors = [
                            'in_progress' => '#7ED957',
                            'in_hold' => '#F5A623',
                            'delayed' => '#EF4444',
                            'completed' => '#1E60A1',
                            'done' => '#1E60A1',
                        ];
                        return $colors[$status] ?? '#6c757d';
                    };
                    
                    // Helper function to get status badge
                    $getStatusBadge = function($status) {
                        $badges = [
                            'in_progress' => 'In Progress',
                            'in_hold' => 'In Hold',
                            'delayed' => 'Delayed',
                            'completed' => 'Completed',
                            'done' => 'Done',
                        ];
                        return $badges[$status] ?? ucfirst($status);
                    };
                    
                    // Helper function to get priority color
                    $getPriorityColor = function($priority) {
                        $colors = [
                            'low' => '#22c55e',
                            'medium' => '#f59e0b',
                            'high' => '#ef4444',
                        ];
                        return $colors[strtolower($priority ?? '')] ?? '#6c757d';
                    };
                @endphp
                <div id="offcanvasProjectTickets" class="d-flex flex-column gap-2">
                    @if($tickets->isEmpty())
                        <div class="d-flex justify-content-center align-items-center mb-2 p-4" style="background: #fff; border-radius: 10px; min-height: 100px;">
                            <div class="text-center">
                                <img src="{{ URL::asset('/build/img/yekbon.svg') }}" alt="No tickets" style="width: 40px; height: 40px; opacity: 0.5; margin-bottom: 8px;" />
                                <p style="font-size: 14px; color: #6c757d; margin: 0;">No tickets found for this project</p>
                            </div>
                        </div>
                    @else
                        @foreach($tickets as $ticket)
                            @php
                                $ticketId = (string) ($ticket->_id ?? $ticket->id);
                                $statusColor = $getStatusColor($ticket->status ?? '');
                                $priorityColor = $getPriorityColor($ticket->priority ?? '');
                            @endphp
                            <div class="card shadow-sm mb-2" style="border-radius: 12px; border-left: 4px solid {{ $statusColor }}; transition: all 0.3s ease; cursor: pointer;" 
                                 onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.1)';" 
                                 onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.05)';">
                                <div class="card-body p-3">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div class="flex-grow-1">
                                            <div class="d-flex align-items-center gap-2 mb-1">
                                                <span style="font-weight: 600; font-size: 14px; color: #1E60A1;">{{ $ticket->code ?? 'N/A' }}</span>
                                                @if($ticket->priority)
                                                    <span style="font-size: 10px; padding: 2px 8px; border-radius: 12px; background-color: {{ $priorityColor }}; color: #fff; font-weight: 500;">
                                                        {{ ucfirst($ticket->priority) }}
                                                    </span>
                                                @endif
                                            </div>
                                            <h6 style="font-weight: 600; font-size: 15px; color: #2e3a59; margin: 0; margin-bottom: 4px;">
                                                {{ $ticket->title ?? 'Untitled Ticket' }}
                                            </h6>
                                            @if($ticket->section_name)
                                                <span style="font-size: 12px; color: #6c757d;">
                                                    <i class="fas fa-folder"></i> {{ $ticket->section_name }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="text-end">
                                            <span style="font-size: 11px; padding: 4px 10px; border-radius: 8px; background-color: {{ $statusColor }}20; color: {{ $statusColor }}; font-weight: 500;">
                                                {{ $getStatusBadge($ticket->status ?? '') }}
                                            </span>
                                        </div>
                                    </div>
                                    
                                    @if($ticket->description)
                                        <p style="font-size: 13px; color: #6c757d; margin: 8px 0; line-height: 1.4;">
                                            {{ \Illuminate\Support\Str::limit($ticket->description, 100) }}
                                        </p>
                                    @endif
                                    
                                    <div class="d-flex justify-content-between align-items-center mt-2 pt-2" style="border-top: 1px solid #e9ecef;">
                                        <div class="d-flex gap-3" style="font-size: 11px; color: #6c757d;">
                                            @if($ticket->start_date)
                                                <span>
                                                    <i class="fas fa-calendar-alt"></i> 
                                                    Start: {{ optional($ticket->start_date)->format('M d, Y') }}
                                                </span>
                                            @endif
                                            @if($ticket->end_date)
                                                <span>
                                                    <i class="fas fa-calendar-check"></i> 
                                                    End: {{ optional($ticket->end_date)->format('M d, Y') }}
                                                </span>
                                            @endif
                                        </div>
                                        @if($ticket->assignees && is_array($ticket->assignees) && count($ticket->assignees) > 0)
                                            <div style="font-size: 11px; color: #6c757d;">
                                                <i class="fas fa-users"></i> {{ count($ticket->assignees) }} assignee(s)
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        
                        @if($tickets->count() >= 20)
                            <div class="text-center mt-2">
                                <small style="color: #6c757d; font-size: 12px;">
                                    Showing first 20 tickets. <a href="{{ route('tickets.index') }}?project_id={{ $projectId }}" style="color: #1E60A1; text-decoration: none;">View all tickets →</a>
                                </small>
                            </div>
                        @endif
                    @endif
                </div>
            </div>

            <div style="font-family: 'Segoe UI', sans-serif;  background-color: #f8f9fa; border-radius: 12px; padding: 20px; padding-bottom:1px;  box-shadow: 0 2px 8px rgba(0,0,0,0.05); color: #2e3a59;"
                class="mt-2">
                <!-- Section Title -->
                <h6 style="font-weight: 600; font-size: 16px; margin-bottom: 12px;">· Project Phases ·</h6>

                <!-- Phases Grid -->
                <div id="offcanvasProjectPhases" class="row g-2">
                    <div class="w-100 d-flex justify-content-center align-items-center" style="min-height: 100px;">
                        <img src="{{ asset('assets/spin-loader.gif') }}" alt="Loading" style="width: 20px; height: 20px;" />
                        <span style="font-size: 12px; color: #6c757d; margin-left: 6px;">Loading...</span>
                    </div>
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

                @php
                    // Get project ID
                    $projectId = (string) ($project->_id ?? $project->id);
                    $projectIdRaw = $project->_id ?? $project->id;
                    
                    // Build array of possible project_id values to match
                    $projectIds = [$projectId];
                    if ($projectIdRaw && (string)$projectIdRaw !== $projectId) {
                        $projectIds[] = $projectIdRaw;
                    }
                    try {
                        $oid = new \MongoDB\BSON\ObjectId($projectId);
                        $projectIds[] = $oid;
                    } catch (\Throwable $e) {}
                    $projectIds = array_unique($projectIds, SORT_REGULAR);
                    
                    // Helper function to count with ObjectId fallback
                    $fetchTasksByProjectId = function($model, $projectIds) {
                        return $model::whereIn('project_id', $projectIds)
                            ->orderByDesc('created_at')
                            ->limit(20)
                            ->get();
                    };
                    
                    // Fetch tasks from all three models
                    $tasks = $fetchTasksByProjectId(\App\Models\Task::class, $projectIds);
                    $webTasks = $fetchTasksByProjectId(\App\Models\WebTask::class, $projectIds);
                    $employeeTasks = $fetchTasksByProjectId(\App\Models\EmployeeTask::class, $projectIds);
                    
                    // Combine all tasks and add type identifier
                    $allTasks = collect();
                    
                    foreach ($tasks as $task) {
                        $task->task_type = 'task';
                        $allTasks->push($task);
                    }
                    
                    foreach ($webTasks as $task) {
                        $task->task_type = 'webtask';
                        $allTasks->push($task);
                    }
                    
                    foreach ($employeeTasks as $task) {
                        $task->task_type = 'employeetask';
                        $allTasks->push($task);
                    }
                    
                    // Sort by created_at descending
                    $allTasks = $allTasks->sortByDesc(function($task) {
                        return $task->created_at ?? now();
                    })->values()->take(20);
                    
                    // Helper function to get status color
                    $getStatusColor = function($status) {
                        $colors = [
                            'new_task' => '#6c757d',
                            'new' => '#6c757d',
                            'in_progress' => '#7ED957',
                            'in_hold' => '#F5A623',
                            'in_hold_task' => '#F5A623',
                            'delayed' => '#EF4444',
                            'in_delayed' => '#EF4444',
                            'completed' => '#1E60A1',
                            'done' => '#1E60A1',
                            'in_check' => '#a855f7',
                            'rejected' => '#ef4444',
                        ];
                        return $colors[strtolower($status ?? '')] ?? '#6c757d';
                    };
                    
                    // Helper function to get status badge
                    $getStatusBadge = function($status) {
                        $badges = [
                            'new_task' => 'New',
                            'new' => 'New',
                            'in_progress' => 'In Progress',
                            'in_hold' => 'In Hold',
                            'in_hold_task' => 'In Hold',
                            'delayed' => 'Delayed',
                            'in_delayed' => 'Delayed',
                            'completed' => 'Completed',
                            'done' => 'Done',
                            'in_check' => 'In Check',
                            'rejected' => 'Rejected',
                        ];
                        return $badges[strtolower($status ?? '')] ?? ucfirst(str_replace('_', ' ', $status ?? 'Unknown'));
                    };
                    
                    // Helper function to get priority color
                    $getPriorityColor = function($priority) {
                        $colors = [
                            'low' => '#22c55e',
                            'medium' => '#f59e0b',
                            'high' => '#ef4444',
                        ];
                        return $colors[strtolower($priority ?? '')] ?? '#6c757d';
                    };
                    
                    // Helper function to get task type badge
                    $getTaskTypeBadge = function($type) {
                        $badges = [
                            'task' => ['label' => 'Task', 'color' => '#1E60A1'],
                            'webtask' => ['label' => 'Web Task', 'color' => '#7ED957'],
                            'employeetask' => ['label' => 'Employee Task', 'color' => '#F5A623'],
                        ];
                        return $badges[$type] ?? ['label' => 'Task', 'color' => '#6c757d'];
                    };
                @endphp

                <div id="offcanvasProjectTasks" class="d-flex flex-column gap-2">
                    @if($allTasks->isEmpty())
                        <div class="d-flex justify-content-center align-items-center mb-2 p-4" style="background: #fff; border-radius: 10px; min-height: 100px;">
                            <div class="text-center">
                                <img src="{{ URL::asset('/build/img/yekbon.svg') }}" alt="No tasks" style="width: 40px; height: 40px; opacity: 0.5; margin-bottom: 8px;" />
                                <p style="font-size: 14px; color: #6c757d; margin: 0;">No tasks found for this project</p>
                            </div>
                        </div>
                    @else
                        @foreach($allTasks as $task)
                            @php
                                $taskId = (string) ($task->_id ?? $task->id);
                                $statusColor = $getStatusColor($task->status ?? '');
                                $taskType = $getTaskTypeBadge($task->task_type ?? 'task');
                                $priority = $task->priority ?? null;
                                $priorityColor = $priority ? $getPriorityColor($priority) : null;
                            @endphp
                            <div class="card shadow-sm mb-2" style="border-radius: 12px; border-left: 4px solid {{ $statusColor }}; transition: all 0.3s ease; cursor: pointer;" 
                                 onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.1)';" 
                                 onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.05)';">
                                <div class="card-body p-3">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div class="flex-grow-1">
                                            <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
                                                <span style="font-size: 10px; padding: 2px 8px; border-radius: 12px; background-color: {{ $taskType['color'] }}20; color: {{ $taskType['color'] }}; font-weight: 500;">
                                                    {{ $taskType['label'] }}
                                                </span>
                                                @if($priority && $priorityColor)
                                                    <span style="font-size: 10px; padding: 2px 8px; border-radius: 12px; background-color: {{ $priorityColor }}; color: #fff; font-weight: 500;">
                                                        {{ ucfirst($priority) }}
                                                    </span>
                                                @endif
                                                @if($task->number)
                                                    <span style="font-size: 11px; color: #6c757d; font-weight: 500;">
                                                        #{{ $task->number }}
                                                    </span>
                                                @endif
                                            </div>
                                            <h6 style="font-weight: 600; font-size: 15px; color: #2e3a59; margin: 0; margin-bottom: 4px;">
                                                {{ $task->title ?? 'Untitled Task' }}
                                            </h6>
                                            @if($task->ticket_id)
                                                @php
                                                    $ticketId = (string) $task->ticket_id;
                                                    try {
                                                        $ticket = \App\Models\Ticket::find($ticketId);
                                                        if (!$ticket) {
                                                            $ticket = \App\Models\Ticket::where('_id', new \MongoDB\BSON\ObjectId($ticketId))->first();
                                                        }
                                                    } catch (\Throwable $e) {
                                                        $ticket = null;
                                                    }
                                                @endphp
                                                @if($ticket)
                                                    <span style="font-size: 12px; color: #1E60A1;">
                                                        <i class="fas fa-ticket-alt"></i> {{ $ticket->code ?? 'Ticket' }}
                                                    </span>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="text-end">
                                            <span style="font-size: 11px; padding: 4px 10px; border-radius: 8px; background-color: {{ $statusColor }}20; color: {{ $statusColor }}; font-weight: 500;">
                                                {{ $getStatusBadge($task->status ?? '') }}
                                            </span>
                                        </div>
                                    </div>
                                    
                                    @if($task->description)
                                        <p style="font-size: 13px; color: #6c757d; margin: 8px 0; line-height: 1.4;">
                                            {{ \Illuminate\Support\Str::limit($task->description, 100) }}
                                        </p>
                                    @endif
                                    
                                    <div class="d-flex justify-content-between align-items-center mt-2 pt-2" style="border-top: 1px solid #e9ecef;">
                                        <div class="d-flex gap-3" style="font-size: 11px; color: #6c757d;">
                                            @if($task->start_date)
                                                <span>
                                                    <i class="fas fa-calendar-alt"></i> 
                                                    Start: {{ optional($task->start_date)->format('M d, Y') }}
                                                </span>
                                            @endif
                                            @if($task->end_date)
                                                <span>
                                                    <i class="fas fa-calendar-check"></i> 
                                                    End: {{ optional($task->end_date)->format('M d, Y') }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="d-flex gap-2 align-items-center">
                                            @if(isset($task->checkpoints) && is_array($task->checkpoints) && count($task->checkpoints) > 0)
                                                <span style="font-size: 11px; color: #6c757d;">
                                                    <i class="fas fa-list-check"></i> {{ count($task->checkpoints) }} checkpoint(s)
                                                </span>
                                            @endif
                                            @if($task->assigned_to ?? null)
                                                <span style="font-size: 11px; color: #6c757d;">
                                                    <i class="fas fa-user"></i> Assigned
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        
                        @if($allTasks->count() >= 20)
                            <div class="text-center mt-2">
                                <small style="color: #6c757d; font-size: 12px;">
                                    Showing first 20 tasks. <a href="{{ route('chat-task') }}?project_id={{ $projectId }}" style="color: #1E60A1; text-decoration: none;">View all tasks →</a>
                                </small>
                            </div>
                        @endif
                    @endif
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
                <div class="js-open-edit" onclick="openEditModal()" style="text-align: center; flex: 1;cursor:pointer;">
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

                            <input type="hidden" name="priority" id="priorityInput" value="medium" />
                            <button type="button" class="btn priority-btn" data-priority="low"
                                style="background-color: transparent; color: #6c757d; border-radius: 8px; padding: 6px 18px; font-size: 14px;">Low</button>

                            <button type="button" class="btn priority-btn active" data-priority="medium"
                                style="background-color: #f59e0b; color: white; border-radius: 8px; padding: 6px 18px; font-size: 14px;">Middle</button>

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
                        <div class="d-flex flex-wrap gap-2 mt-2 px-1 py-1" style="">
                            <input type="hidden" name="reminder_days" id="reminderDaysInput" value="7" />
                            <button type="button" class="btn reminder-btn" data-days="2" style="background-color: transparent; color: #6c757d; border-radius: 8px; padding: 6px 14px; font-size: 13px;">2 Days</button>
                            <button type="button" class="btn reminder-btn" data-days="3" style="background-color: transparent; color: #6c757d; border-radius: 8px; padding: 6px 14px; font-size: 13px;">3 Days</button>
                            <button type="button" class="btn reminder-btn" data-days="5" style="background-color: transparent; color: #6c757d; border-radius: 8px; padding: 6px 14px; font-size: 13px;">5 Days</button>
                            <button type="button" class="btn reminder-btn active" data-days="7" style="background-color: #34d399; color: white; border-radius: 8px; padding: 6px 14px; font-size: 13px; outline:none; box-shadow:none;">7 Days</button>
                            <button type="button" class="btn reminder-btn" data-days="10" style="background-color: transparent; color: #6c757d; border-radius: 8px; padding: 6px 14px; font-size: 13px;">10 Days</button>
                            <button type="button" class="btn reminder-btn" data-days="15" style="background-color: transparent; color: #6c757d; border-radius: 8px; padding: 6px 14px; font-size: 13px;">15 Days</button>
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
                <!-- EDIT: Project Phases -->
                
                <!-- Project Phases -->
                <div class="row mt-2 p-3" style="background-color:#f7f9fc; border-radius: 12px;">
                    <div class="mb-2">
                        <label class="fw-semibold" style="font-size: 14px;">Project Phase</label>
                        <div style="font-size: 12px; color: #7d7f85;">How many phases this project has</div>
                    </div>
                    <div id="phases-wrapper" class="w-100">
                        <div class="phase-row row g-2 align-items-center mb-2" data-index="0" style="background:#eef2f7; border-radius:10px; padding:10px;">
                            <div class="col-12 col-md-3">
                                <input type="text" name="phases[0][title]" class="form-control" placeholder="Phase Title" style="background:#fff;"/>
                            </div>
                            <div class="col-12 col-md-5">
                                <input type="text" name="phases[0][description]" class="form-control" placeholder="Phase Description" style="background:#fff;"/>
                            </div>
                            <div class="col-12">
                                <div class="d-flex align-items-center gap-2 flex-nowrap">
                                    <div style="position: relative; min-width: 220px; cursor:pointer;" onclick="document.getElementById('phaseStartInput-0').click();">
                                        <div style="background-color:#fff; border-radius:12px; padding:2px 16px; width:220px; position:relative; border:1px solid #e0e0e0; height:45px; display:flex; flex-direction:column; justify-content:center;">
                                          <div style="font-weight:600; font-size:14px; color:#7d7f85;">Start Date</div>
                                          <div id="phaseStartDisplay-0" style="font-size:13px; color:#a0a4ab;">DD:MM:YYYY</div>
                                          <div style="position:absolute; top:50%; right:16px; transform:translateY(-50%);">
                                            <img src="{{ URL::asset('/build/img/timeicon.svg') }}" style="width:20px; height:20px;" />
                                            <input type="date" id="phaseStartInput-0" name="phases[0][start_date]" 
                                                   style="position:absolute; top:0; left:0; width:100%; height:100%; opacity:0;" 
                                                   onchange="updatePhaseDateDisplay(0, 'start', this.value)" />
                                          </div>
                                        </div>
                                      </div>
                                      
                                      <div style="position: relative; min-width: 220px; margin-left:8px; cursor:pointer;" onclick="document.getElementById('phaseEndInput-0').click();">
                                        <div style="background-color:#fff; border-radius:12px; padding:2px 16px; width:220px; position:relative; border:1px solid #e0e0e0; height:45px; display:flex; flex-direction:column; justify-content:center;">
                                          <div style="font-weight:600; font-size:14px; color:#7d7f85;">Deliver Date</div>
                                          <div id="phaseEndDisplay-0" style="font-size:13px; color:#a0a4ab;">DD:MM:YYYY</div>
                                          <div style="position:absolute; top:50%; right:16px; transform:translateY(-50%);">
                                            <img src="{{ URL::asset('/build/img/timeicon.svg') }}" style="width:20px; height:20px;" />
                                            <input type="date" id="phaseEndInput-0" name="phases[0][end_date]" 
                                                   style="position:absolute; top:0; left:0; width:100%; height:100%; opacity:0;" 
                                                   onchange="updatePhaseDateDisplay(0, 'end', this.value)" />
                                          </div>
                                        </div>
                                      </div>
                                      
                                      
                                    <select name="phases[0][reminder_days]" class="form-select" style="background:#fff; min-width:160px; height:45px; border-radius:12px; border:1px solid #e0e0e0;">
                                        <option value="">Select Reminder</option>
                                        <option value="2">2 days</option>
                                        <option value="3">3 days</option>
                                        <option value="5">5 days</option>
                                        <option value="7">7 days</option>
                                        <option value="10">10 days</option>
                                        <option value="15">15 days</option>
                                    </select>
                                    <div class="d-flex align-items-center gap-2" style="min-width:68px;">
                                        <img src="{{ asset('build/img/plus.svg') }}" alt="Add" style="width:28px; height:28px; cursor:pointer;" onclick="addPhaseRow(this)">
                                        <img src="{{ asset('build/img/trash.svg') }}" alt="Remove" style="width:28px; height:28px; cursor:pointer;" onclick="removePhaseRow(this)">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- add project section (grouped by phase) -->
                <div class="row mt-2 p-3" style="background-color:#f7f9fc; border-radius: 12px;">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div>
                            <label class="fw-semibold" style="font-size: 14px;">Add Project Section</label>
                            <div style="font-size: 12px; color: #7d7f85;">Type the Content and Press Enter</div>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <!-- <select id="globalPhaseSelect" class="form-select for m-select-sm" style="min-width:200px;">
                                <option value="">Select Phase</option>
                            </select> -->
                            <button type="button" class="btn btn-sm" onclick="addSectionGroup()"
                                    style="background:#22c55e; color:#fff; border:none; border-radius:8px; padding:6px 10px; font-weight:600;">
                                    <img src="{{ asset('build/img/plus.svg') }}" alt="Add" style="width:28px; height:28px; cursor:pointer;" >

                            </button>
                        </div>
                    </div>
                    <div id="section-groups-wrapper" class="w-100">
                        <!-- group template injected by JS on load -->
                    </div>
                </div>

                <script>
                    function addPhaseRow(el) {
                        const wrapper = document.getElementById('phases-wrapper');
                        const rows = wrapper.querySelectorAll('.phase-row');
                        // When wrapper is empty, start from 0. Otherwise, increment the last data-index.
                        let next;
                        if (rows.length === 0) {
                            next = 0;
                        } else {
                            const lastIndex = parseInt(rows[rows.length - 1].getAttribute('data-index'), 10);
                            next = isNaN(lastIndex) ? rows.length : (lastIndex + 1);
                        }
                        const template = document.createElement('div');
                        template.className = 'phase-row row g-2 align-items-center mb-2';
                        template.setAttribute('data-index', String(next));
                        template.setAttribute('style', 'background:#eef2f7; border-radius:10px; padding:10px;');
                        template.innerHTML = `
                            <div class="col-12 col-md-3">
                                <input type="text" name="phases[${next}][title]" class="form-control" placeholder="Phase Title" style="background:#fff;"/>
                            </div>
                            <div class="col-12 col-md-5">
                                <input type="text" name="phases[${next}][description]" class="form-control" placeholder="Phase Description" style="background:#fff;"/>
                            </div>
                            <div class="col-12">
                                <div class="d-flex align-items-center gap-2 flex-nowrap">
                                    <div style="position: relative; min-width: 220px;">
                                        <div style="background-color:#fff; border-radius:12px; padding:2px 16px; width:220px; position:relative; border:1px solid #e0e0e0; height:45px; display:flex; flex-direction:column; justify-content:center;">
                                            <div style="font-weight:600; font-size:14px; color:#7d7f85;">Start Date</div>
                                            <div id="phaseStartDisplay-${next}" style="font-size:13px; color:#a0a4ab;">DD:MM:YYYY</div>
                                            <div style="position:absolute; top:50%; right:16px; transform:translateY(-50%);">
                                                <img src="{{ URL::asset('/build/img/timeicon.svg') }}" onclick="document.getElementById('phaseStartInput-${next}').showPicker()" style="width:20px; height:20px; cursor:pointer;" />
                                                <input type="date" id="phaseStartInput-${next}" name="phases[${next}][start_date]" onchange="updatePhaseDateDisplay(${next}, 'start', this.value)" style="opacity:0; position:absolute; top:0; left:0; width:100%; height:100%; pointer-events:none;" />
                                            </div>
                                        </div>
                                    </div>
                                    <div style="position: relative; min-width: 220px;">
                                        <div style="background-color:#fff; border-radius:12px; padding:2px 16px; width:220px; position:relative; border:1px solid #e0e0e0; height:45px; display:flex; flex-direction:column; justify-content:center;">
                                            <div style="font-weight:600; font-size:14px; color:#7d7f85;">Deliver Date</div>
                                            <div id="phaseEndDisplay-${next}" style="font-size:13px; color:#a0a4ab;">DD:MM:YYYY</div>
                                            <div style="position:absolute; top:50%; right:16px; transform:translateY(-50%);">
                                                <img src="{{ URL::asset('/build/img/timeicon.svg') }}" onclick="document.getElementById('phaseEndInput-${next}').showPicker()" style="width:20px; height:20px; cursor:pointer;" />
                                                <input type="date" id="phaseEndInput-${next}" name="phases[${next}][end_date]" onchange="updatePhaseDateDisplay(${next}, 'end', this.value)" style="opacity:0; position:absolute; top:0; left:0; width:100%; height:100%; pointer-events:none;" />
                                            </div>
                                        </div>
                                    </div>
                                    <select name="phases[${next}][reminder_days]" class="form-select" style="background:#fff; min-width:160px; height:45px; border-radius:12px; border:1px solid #e0e0e0;">
                                        <option value="">Select Reminder</option>
                                        <option value="2">2 days</option>
                                        <option value="3">3 days</option>
                                        <option value="5">5 days</option>
                                        <option value="7">7 days</option>
                                        <option value="10">10 days</option>
                                        <option value="15">15 days</option>
                                    </select>
                                    <div class="d-flex align-items-center gap-2" style="min-width:68px;">
                                        <img src="{{ asset('build/img/plus.svg') }}" alt="Add" style="width:28px; height:28px; cursor:pointer;" onclick="addPhaseRow(this)">
                                        <img src="{{ asset('build/img/trash.svg') }}" alt="Remove" style="width:28px; height:28px; cursor:pointer;" onclick="removePhaseRow(this)">
                                    </div>
                                </div>
                            </div>
                        `;
                        wrapper.appendChild(template);
                        refreshPhaseOptions();
                    }
                    function removePhaseRow(el) {
                        const row = el.closest('.phase-row');
                        const wrapper = document.getElementById('phases-wrapper');
                        if (wrapper && row) {
                            if (wrapper.querySelectorAll('.phase-row').length === 1) {
                                // keep at least one row; just clear
                                row.querySelectorAll('input').forEach(i => i.value = '');
                                row.querySelectorAll('select').forEach(s => s.selectedIndex = 0);
                                return;
                            }
                            row.remove();
                        }
                    }
                    // Build phase options from entered phase titles
                    function getPhaseTitles() {
                        const titles = [];
                        document.querySelectorAll('#phases-wrapper input[name^="phases"][name$="[title]"]').forEach(function(inp){
                            const t = (inp.value || '').trim();
                            if (t !== '') titles.push(t);
                        });
                        return titles;
                    }
                    function getPhaseOptionsHtml() {
                        const titles = getPhaseTitles();
                        return '<option value="">Select Phase</option>' + titles.map(t => `<option value="${t}">${t}</option>`).join('');
                    }
                    function syncGroupPhase(selectEl) {
                        const val = selectEl.value;
                        const group = selectEl.closest('.section-group');
                        if (group) {
                            group.querySelectorAll('.section-phase-title').forEach(h => h.value = val);
                        }
                    }
                    function refreshPhaseOptions() {
                        const html = getPhaseOptionsHtml();
                        const titles = getPhaseTitles();

                        // Global
                        const sel = document.getElementById('globalPhaseSelect');
                        if (sel) {
                            const current = sel.value;
                            sel.innerHTML = html;
                            if (current && titles.includes(current)) sel.value = current;
                        }
                        
                        // Group Selects
                        document.querySelectorAll('.group-phase-select').forEach(gSel => {
                            const cur = gSel.value;
                            gSel.innerHTML = html;
                            if (cur && titles.includes(cur)) {
                                gSel.value = cur;
                            }
                            syncGroupPhase(gSel);
                        });
                    }
                    document.addEventListener('input', function(e){
                        if (e.target && e.target.matches('#phases-wrapper input[name^="phases"][name$="[title]"]')) {
                            refreshPhaseOptions();
                        }
                    });
                    function addSectionGroup() {
                        const wrapper = document.getElementById('section-groups-wrapper');
                        const index = wrapper.querySelectorAll('.section-group').length;
                        const div = document.createElement('div');
                        div.className = 'section-group';
                        div.setAttribute('style','background:#ffffff; border:1px solid #e0e0e0; border-radius:12px; padding:12px; margin-bottom:10px; position:relative;');
                        
                        // Default phase from global
                        const globalVal = document.getElementById('globalPhaseSelect')?.value || '';

                        div.innerHTML = `
                            <div class="d-flex align-items-center justify-content-end gap-2" style="position:absolute; top:8px; right:8px;">
                                <img src="{{ asset('build/img/trash.svg') }}" alt="Remove" class="group-delete" style="width:24px; height:24px; cursor:pointer; ${index === 0 ? 'display:none;' : ''}" onclick="removeSectionGroup(this)">
                            </div>
                            <div class="mb-3" style="max-width: 250px;">
                                <select class="form-select group-phase-select" onchange="syncGroupPhase(this)">
                                    ${getPhaseOptionsHtml()}
                                </select>
                            </div>
                            <div class="mt-4" data-rows>
                                ${sectionRowTemplate(index, 0)}
                            </div>
                        `;
                        wrapper.appendChild(div);
                        
                        // Set start value from global and sync
                        const newSel = div.querySelector('.group-phase-select');
                        if (newSel && globalVal) {
                            newSel.value = globalVal;
                            syncGroupPhase(newSel);
                        }

                        refreshGroupDeleteIcons();
                        // ensure first row shows plus only
                        refreshRowIcons(div);
                    }
                    function removeSectionGroup(btn) {
                        const g = btn.closest('.section-group');
                        if (g) g.remove();
                        refreshGroupDeleteIcons();
                    }
                    function addSectionRow(btn) {
                        const group = btn.closest('.section-group');
                        const rowsWrap = group.querySelector('[data-rows]');
                        const gIdx = Array.prototype.indexOf.call(document.getElementById('section-groups-wrapper').children, group);
                        const rIdx = rowsWrap.querySelectorAll('.section-row').length;
                        rowsWrap.insertAdjacentHTML('beforeend', sectionRowTemplate(gIdx, rIdx));
                        // set hidden phase title from LOCAL group select
                        const selVal = group.querySelector('.group-phase-select')?.value || '';
                        rowsWrap.lastElementChild.querySelector('input.section-phase-title').value = selVal;
                        refreshRowIcons(group);
                    }
                    function removeSectionRow(btn) {
                        const row = btn.closest('.section-row');
                        const rowsWrap = row.parentElement;
                        if (rowsWrap.querySelectorAll('.section-row').length === 1) {
                            // clear instead of remove
                            row.querySelectorAll('input[type="text"]').forEach(i => i.value='');
                            return;
                        }
                        row.remove();
                        const group = rowsWrap.closest('.section-group');
                        if (group) refreshRowIcons(group);
                    }
                    function sectionRowTemplate(gIdx, rIdx) {
                        return `
                        <div class="row section-row g-2 align-items-center mb-2" style="background:#eef2f7; border-radius:10px; padding:10px;">
                            <div class="col-12 col-md-4">
                                <input type="text" name="sections[${gIdx}_${rIdx}][name]" class="form-control" placeholder="Section Name" style="background:#fff; font-size:13px; color:#7d7f85;"/>
                                <input type="hidden" class="section-phase-title" name="sections[${gIdx}_${rIdx}][phase_title]" value=""/>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="text" name="sections[${gIdx}_${rIdx}][description]" class="form-control" placeholder="Section Description" style="background:#fff; font-size:13px; color:#7d7f85;"/>
                            </div>
                            <div class="col-12 col-md-2 d-flex align-items-center gap-2 justify-content-end">
                                <img src="{{ asset('build/img/plus.svg') }}" class="row-plus" alt="Add" style="width:24px; height:24px; cursor:pointer; display:${rIdx === 0 ? 'inline' : 'none'};" onclick="addSectionRow(this)">
                                <img src="{{ asset('build/img/trash.svg') }}" class="row-trash" alt="Remove" style="width:24px; height:24px; cursor:pointer; display:${rIdx === 0 ? 'none' : 'inline'};" onclick="removeSectionRow(this)">
                            </div>
                        </div>`;
                    }
                    // init one group on load
                    document.addEventListener('DOMContentLoaded', function(){
                        addSectionGroup();
                        refreshPhaseOptions();
                        refreshGroupDeleteIcons();
                    });

                    // helper: update display text for phase dates
                    function updatePhaseDateDisplay(idx, which, value) {
                        if (!value) return;
                        try {
                            var d = new Date(value);
                            var text = ('0' + d.getDate()).slice(-2) + ':' + ('0' + (d.getMonth() + 1)).slice(-2) + ':' + d.getFullYear();
                            if (which === 'start') {
                                var el = document.getElementById('phaseStartDisplay-' + idx);
                                if (el) el.innerText = text;
                            } else {
                                var el2 = document.getElementById('phaseEndDisplay-' + idx);
                                if (el2) el2.innerText = text;
                            }
                        } catch (_) {}
                    }

                    // Show group delete only when more than one group exists
                    function refreshGroupDeleteIcons() {
                        const groups = document.querySelectorAll('#section-groups-wrapper .section-group');
                        groups.forEach(function(g, idx){
                            const del = g.querySelector('.group-delete');
                            if (!del) return;
                            if (groups.length <= 1 && idx === 0) {
                                del.style.display = 'none';
                            } else {
                                del.style.display = 'inline';
                            }
                        });
                    }

                    // Toggle icons so first row shows only plus; subsequent rows show trash
                    function refreshRowIcons(group) {
                        if (!group) return;
                        const rows = group.querySelectorAll('.section-row');
                        rows.forEach(function(row, idx){
                            const plus = row.querySelector('.row-plus');
                            const trash = row.querySelector('.row-trash');
                            if (!plus || !trash) return;
                            if (idx === 0) {
                                plus.style.display = 'inline';
                                trash.style.display = 'none';
                            } else {
                                plus.style.display = 'none';
                                trash.style.display = 'inline';
                            }
                        });
                    }
                </script>


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
<!-- cleaned: removed offcanvas and non Add-Project utilities -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->

<!-- cleaned: removed header chevron toggle JS -->


<!-- pause model pop-up -->
<!-- cleaned: removed pause modal opener (not part of Add Project) -->
<!-- cleaned: removed edit/offcanvas related scripts (projectMap, prefill/edit helpers, etc.) -->
<!-- edit model pop-up -->
<!-- cleaned: removed edit modal opener -->
<!-- cleaned: removed edit modal loaders -->
<!-- cleaned: removed edit modal helpers -->
</script>
<!-- remove project pop-up and delete logic -->
<!-- cleaned: removed delete project JS -->
<!-- dark and light mode -->
<!-- cleaned: removed dark/light mode toggles -->

<script>
    // Load Summernote (only for Add Project -> #policyEditor)
    window.addEventListener('load', function() {
        var css = document.createElement('link');
        css.rel = 'stylesheet';
        css.href = 'https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css';
        document.head.appendChild(css);

        var js = document.createElement('script');
        js.src = 'https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js';
        js.onload = function() {
            if (typeof $ !== 'undefined' && $('#policyEditor').length) {
                $('#policyEditor').summernote({
                    placeholder: 'Describe the Project...',
                    tabsize: 2,
                    height: 220,
                    toolbar: [
                        ['style', ['fontsize']],
                        ['font', ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['view', ['codeview']]
                    ],
                    fontSizes: ['12', '14', '16', '18', '20', '24', '28']
                });
            }
        };
        document.body.appendChild(js);
    });
    </script>
<!-- add filed -->
<!-- cleaned: removed legacy addSection/sections-wrapper functions -->
<script>
    (function() {
        // Priority buttons (Add Project)
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
            hidden.value = pri;
        }
        document.querySelectorAll('.priority-btn').forEach(function(btn) {
            btn.addEventListener('click', function() { updatePriorityUI(this); });
        });

        // Reminder buttons (Add Project)
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
            activeBtn.style.backgroundColor = '#34d399';
            activeBtn.style.color = 'white';
            hidden.value = activeBtn.getAttribute('data-days');
        }
        document.querySelectorAll('.reminder-btn').forEach(function(btn) {
            btn.addEventListener('click', function() { updateReminderUI(this); });
        });

        // --- PDF attachments (Add Project) ---
        window.createAddPdfFile = function() {
            var input = document.createElement('input');
            input.type = 'file';
            input.accept = 'application/pdf';
            input.name = 'attachments[]';
            input.style.display = 'none';
            input.addEventListener('change', function() { handlePdfSelected(this); });
            document.getElementById('createPdfInputs').appendChild(input);
            input.click();
        };

        window.handlePdfSelected = function(fileInput) {
            if (!fileInput.files || !fileInput.files[0]) return;
            var file = fileInput.files[0];
            var list = document.getElementById('createPdfList');
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
            if (addTile) list.insertBefore(tile, addTile); else list.appendChild(tile);
            tile._fileInput = fileInput;
        };

        window.removePdfTile = function(btn) {
            var tile = btn.closest('div');
            if (!tile) return;
            if (tile._fileInput) { tile._fileInput.remove(); }
            tile.remove();
        };
    })();
</script>
<script>
    // Helpers
    function setTextIf(elId, text, fallback) {
        var el = document.getElementById(elId);
        if (!el) return;
        var val = (text === null || text === undefined || String(text).trim() === '') ? (fallback || '-') : String(text);
        el.textContent = val;
    }
    function setHTMLIf(elId, html, fallback) {
        var el = document.getElementById(elId);
        if (!el) return;
        var val = (html === null || html === undefined || String(html).trim() === '') ? (fallback || '-') : String(html);
        el.innerHTML = val;
    }
    function setImgIf(elId, url, fallback) {
        var el = document.getElementById(elId);
        if (!el) return;
        el.src = (url && String(url).trim()) ? url : (fallback || el.src);
    }
    function fmtDmy(dateStr) {
        if (!dateStr) return 'DD.MM.YYYY';
        var dt = new Date(dateStr);
        if (isNaN(dt.getTime())) return 'DD.MM.YYYY';
        var d = ('0' + dt.getDate()).slice(-2);
        var m = ('0' + (dt.getMonth() + 1)).slice(-2);
        var y = dt.getFullYear();
        return d + '.' + m + '.' + y;
    }
    function setStatusTag(statusRaw) {
        var status = (statusRaw || 'new').toString().toLowerCase();
        var cfg = { bg:'#eae8fd', text:'#1e2b4d', icon:'{{ URL::asset('/build/img/blueflag.svg') }}', label:'Project is New' };
        if (['in progress','in_progress','progress'].includes(status)) {
            cfg = { bg:'#e9f8dd', text:'#1e2b4d', icon:'{{ URL::asset('/build/img/greenflag.svg') }}', label:'Project is In Progress' };
        } else if (['in hold','on hold','hold'].includes(status)) {
            cfg = { bg:'#fff3cd', text:'#2e3a59', icon:'{{ URL::asset('/build/img/yelowflag.svg') }}', label:'Project is in Hold' };
        } else if (['delayed','delay'].includes(status)) {
            cfg = { bg:'#fddede', text:'#2e3a59', icon:'{{ URL::asset('/build/img/redflag.svg') }}', label:'Project is in Delayed' };
        } else if (['done','completed','complete'].includes(status)) {
            cfg = { bg:'#e3f2fd', text:'#1e2b4d', icon:'{{ URL::asset('/build/img/greenflag.svg') }}', label:'Project is Done' };
        }
        var tag = document.getElementById('offcanvasStatusTag');
        var icon = document.getElementById('offcanvasStatusIcon');
        var txt = document.getElementById('offcanvasStatusText');
        if (tag) { tag.style.background = cfg.bg; tag.style.color = cfg.text; }
        if (icon) icon.src = cfg.icon;
        if (txt) txt.textContent = cfg.label;
    }
    function setPriorityPill(priorityRaw) {
        var pri = (priorityRaw || '').toString().toLowerCase();
        var dot = document.getElementById('offcanvasPriorityDot');
        var txt = document.getElementById('offcanvasPriorityText');
        var color = '#6b7280', label='Unknown';
        if (pri === 'low') { color = '#34d399'; label='Low'; }
        else if (pri === 'medium' || pri === 'middle') { color = '#f59e0b'; label='Medium'; }
        else if (pri === 'high') { color = '#ef4444'; label='High'; }
        if (dot) dot.style.backgroundColor = color;
        if (txt) txt.textContent = label;
    }
    function renderPhases(phases) {
        var wrap = document.getElementById('offcanvasProjectPhases');
        if (!wrap) return;
        wrap.innerHTML = '';
        var list = Array.isArray(phases) ? phases : [];
        if (!list.length) {
            var empty = document.createElement('div');
            empty.className = 'w-100 d-flex justify-content-center align-items-center';
            empty.style.minHeight = '80px';
            empty.innerHTML = '<div style="font-size:12px;color:#6c757d;">No phases added</div>';
            wrap.appendChild(empty);
            return;
        }
        list.forEach(function(ph, idx) {
            var col = document.createElement('div');
            col.className = 'col-12';
            col.innerHTML =
                '<div class="p-3" style="background:#fff; border-radius:10px; box-shadow:0 0 6px rgba(0,0,0,0.05);">' +
                '  <div class="d-flex flex-wrap justify-content-between align-items-start gap-2">' +
                '    <div style="font-weight:600; color:#1c2b48; font-size:14px;">' + (ph.title || ('Phase ' + (idx+1))) + '</div>' +
                '    <div class="d-flex align-items-center gap-2" style="font-size:12px; color:#6c757d;">' +
                '      <span style="background:#f1f5f9; padding:2px 8px; border-radius:999px;"><span style="color:#22c55e;">Start:</span> ' + (ph.start_date || '-') + '</span>' +
                '      <span style="background:#f1f5f9; padding:2px 8px; border-radius:999px;"><span style="color:#22c55e;">Deliver:</span> ' + (ph.end_date || '-') + '</span>' +
                '    </div>' +
                '  </div>' +
                '  <div style="font-size:13px; color:#6c757d; margin-top:6px;">' + (ph.description || '') + '</div>' +
                '</div>';
            wrap.appendChild(col);
        });
    }
    function renderSections(sections) {
        var wrap = document.getElementById('offcanvasProjectSections');
        if (!wrap) return;
        wrap.innerHTML = '';
        var list = Array.isArray(sections) ? sections : [];
        if (!list.length) {
            var empty = document.createElement('div');
            empty.className = 'col-12';
            empty.innerHTML = '<div style="background:#fff;border-radius:12px;padding:14px;text-align:center;color:#6c757d;">No sections added</div>';
            wrap.appendChild(empty); return;
        }
        list.forEach(function(sec){
            var col = document.createElement('div');
            col.className = 'col-6 col-md-4 col-lg-3';
            col.innerHTML =
                '<div style="background:#fff;padding:16px;border-radius:12px;text-align:center;position:relative;box-shadow:0 2px 5px rgba(0,0,0,0.03);">' +
                '  <img src="{{ URL::asset('/build/img/project.svg') }}" style="height:40px;margin-bottom:10px;" alt="icon">' +
                '  <div style="font-size:14px;font-weight:600;color:#2e3a59;margin-bottom:10px;">' + (sec && sec.name ? sec.name : 'Section') + '</div>' +
                '  <div style="font-size:12px;color:#6c757d;">' + (sec && sec.description ? sec.description : '') + '</div>' +
                '</div>';
            wrap.appendChild(col);
        });
    }
    function renderFiles(attachments) {
        var wrap = document.getElementById('offcanvasProjectFiles');
        if (!wrap) return;
        wrap.innerHTML = '';
        var list = Array.isArray(attachments) ? attachments : [];
        if (!list.length) {
            var empty = document.createElement('div');
            empty.className = 'w-100 d-flex justify-content-center align-items-center';
            empty.style.minHeight = '60px';
            empty.innerHTML = '<div style="font-size:12px;color:#6c757d;">No files uploaded</div>';
            wrap.appendChild(empty); return;
        }
        list.forEach(function(att){
            var col = document.createElement('div');
            col.className = 'col-12 col-md-6 mb-2';
            var url = (att && att.url) ? att.url : '#';
            var name = (att && att.name) ? att.name : 'File.pdf';
            var size = (att && att.size_kb != null) ? (att.size_kb + ' KB') : '';
            col.innerHTML =
                '<div class="d-flex justify-content-between align-items-center p-2 rounded" style="background-color: white; box-shadow: 0 0 6px rgba(0,0,0,0.05);">' +
                '  <a href="' + url + '" target="_blank" rel="noopener" class="d-flex align-items-center" style="text-decoration:none;">' +
                '    <img src="https://upload.wikimedia.org/wikipedia/commons/8/87/PDF_file_icon.svg" alt="PDF Icon" style="width: 35px; height: 40px; object-fit: contain; margin-right: 10px;">' +
                '    <div>' +
                '      <div style="font-weight: 500; font-size: 14px; color: #2e3a59;">' + name + '</div>' +
                '      <div style="font-size: 12px; color: #8c94a3;">' + size + '</div>' +
                '    </div>' +
                '  </a>' +
                '  <a href="' + url + '" download style="display:inline-flex;align-items:center;gap:6px;">' +
                '    <img src="{{ URL::asset('/build/img/download.svg') }}" alt="Download" style="width: 20px; height: 20px;">' +
                '  </a>' +
                '</div>';
            wrap.appendChild(col);
        });
    }
    function renderTeams(teams) {
        var wrap = document.getElementById('offcanvasTeam');
        if (!wrap) return;
        wrap.innerHTML = '';
        var list = Array.isArray(teams) ? teams : [];
        if (!list.length) {
            var empty = document.createElement('div');
            empty.className = 'w-100 d-flex justify-content-center align-items-center';
            empty.style.minHeight = '80px';
            empty.innerHTML = '<div style="font-size:12px;color:#6c757d;">No team assigned</div>';
            wrap.appendChild(empty); return;
        }
        list.forEach(function(team){
            var count = (Array.isArray(team.developers) ? team.developers.length : 0);
            var avatar = (count && team.developers[0] && team.developers[0].avatar_url) ? team.developers[0].avatar_url : '{{ URL::asset('/build/img/profile.svg') }}';
            var banner = team.banner_url || '{{ URL::asset('/build/img/bgractangle.svg') }}';
            var card = document.createElement('div');
            card.setAttribute('style','flex: 0 0 auto; width: 110px; border-radius: 16px; background: #ffffff; box-shadow: 0 2px 6px rgba(0,0,0,0.05); text-align: center; height: 115px;');
            card.innerHTML =
                '<div style="position: relative; height: 50px; overflow: hidden; border-top-left-radius: 16px; border-top-right-radius: 16px;">' +
                '  <img src="'+banner+'" alt="Background" style="width: 100%; height: 100%; object-fit: cover;">' +
                '</div>' +
                '<div style="position: relative; margin-top: -20px;">' +
                '  <img src="'+avatar+'" alt="Profile" style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%; border: 2px solid limegreen; background: white;">' +
                '</div>' +
                '<div style="padding: 8px;">' +
                '  <h6 style="font-weight: 600; font-size: 11px; color: #000; margin: 0;">'+ (team.title || 'Team') +'</h6>' +
                '  <p style="margin: 0; color: #7f8ea3; font-size: 10px;">'+ count +' Users</p>' +
                '</div>';
            wrap.appendChild(card);
        });
    }

    // Fetch and populate offcanvas
    function openProjectOffcanvasFromId(id) {
        var hid = document.getElementById('offcanvasProjectRealId');
        if (hid) hid.value = id;
        // show spinners placeholder
        var phWrap = document.getElementById('offcanvasProjectPhases');
        if (phWrap) phWrap.innerHTML = '<div class="w-100 d-flex justify-content-center align-items-center" style="min-height: 80px;"><img src="{{ asset('assets/spin-loader.gif') }}" style="width:20px;height:20px;"><span style="font-size:12px;color:#6c757d;margin-left:6px;">Loading...</span></div>';
        var secWrap = document.getElementById('offcanvasProjectSections');
        if (secWrap) secWrap.innerHTML = '<div class="col-12"><div style="background:#fff;border-radius:12px;padding:14px;text-align:center;color:#6c757d;">Loading...</div></div>';
        var filesWrap = document.getElementById('offcanvasProjectFiles');
        if (filesWrap) filesWrap.innerHTML = '<div class="w-100 d-flex justify-content-center align-items-center" style="min-height: 60px;"><img src="{{ asset('assets/spin-loader.gif') }}" style="width:20px;height:20px;"><span style="font-size:12px;color:#6c757d;margin-left:6px;">Loading...</span></div>';

        fetch('/project/' + encodeURIComponent(id) + '/json', {
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            credentials: 'same-origin'
        })
        .then(function(r){ if (!r.ok) throw new Error('Failed'); return r.json(); })
        .then(function(p){
            setImgIf('offcanvasProjectLogo', p.logo_url, "{{ URL::asset('/build/img/yekbon.svg') }}");
            setTextIf('offcanvasProjectTitle', p.title || 'Project');
            setTextIf('offcanvasProjectId', (p.code || p.id || 'Project ID'));
            setTextIf('offcanvasStartDate', fmtDmy(p.start_date));
            setTextIf('offcanvasEndDate', fmtDmy(p.end_date));
            setTextIf('offcanvasProgressPercent', String(p.progress_percent || 0) + '%');
            setStatusTag(p.status);
            setPriorityPill(p.priority);

            // Description (support HTML)
            if (p.description && /<\s*\w+[^>]*>/i.test(p.description)) {
                setHTMLIf('offcanvasProjectDescription', p.description);
            } else {
                setTextIf('offcanvasProjectDescription', (p.description || '').replace(/\s{2,}/g, ' '));
            }

            renderPhases(p.phases);
            renderSections(p.sections);
            renderFiles(p.attachments);
            renderTeams(p.teams);
        })
        .catch(function(){
            if (phWrap) phWrap.innerHTML = '<div class="w-100 d-flex justify-content-center align-items-center" style="min-height: 80px;"><div style="font-size:12px;color:#ef4444;">Failed to load phases</div></div>';
        });
    }
</script>
<script>
    // Open Add Project modal in "edit mode" using fetched project data
    function openEditModal() {
        try {
            var hid = document.getElementById('offcanvasProjectRealId');
            var id = hid ? hid.value : null;
            if (!id) return;

            // Hide the offcanvas first for a smoother UX
            var offcanvasElement = document.getElementById('offcanvasRight');
            if (offcanvasElement) {
                var offcanvasInstance = bootstrap.Offcanvas.getInstance(offcanvasElement);
                if (offcanvasInstance) offcanvasInstance.hide();
            }

            fetch('/project/' + encodeURIComponent(id) + '/json', {
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
                credentials: 'same-origin'
            })
            .then(function(r){ if (!r.ok) throw new Error('Failed'); return r.json(); })
            .then(function(p){
                // Swap the create form into "edit" mode
                var form = document.getElementById('projectCreateForm');
                if (!form) return;
                form.setAttribute('action', '/project/' + encodeURIComponent(p.id));
                // ensure _method=PUT exists
                var method = form.querySelector('input[name="_method"]');
                if (!method) {
                    method = document.createElement('input');
                    method.type = 'hidden';
                    method.name = '_method';
                    method.value = 'PUT';
                    form.appendChild(method);
                } else {
                    method.value = 'PUT';
                }

                // Title
                var titleEl = form.querySelector('input[name="title"]');
                if (titleEl) titleEl.value = p.title || '';

                // Priority
                var hiddenPriority = document.getElementById('priorityInput');
                if (hiddenPriority) hiddenPriority.value = (p.priority || 'low');
                var priBtns = form.querySelectorAll('.priority-btn');
                priBtns.forEach(function(btn){
                    btn.classList.remove('active');
                    btn.style.backgroundColor = 'transparent';
                    btn.style.color = '#6c757d';
                    var pri = btn.getAttribute('data-priority');
                    if (pri && pri.toLowerCase() === (p.priority || 'low').toLowerCase()) {
                        btn.classList.add('active');
                        var colorMap = { low: '#34d399', medium: '#f59e0b', high: '#ef4444' };
                        btn.style.backgroundColor = colorMap[pri] || '#34d399';
                        btn.style.color = 'white';
                    }
                });

                // Dates + display
                var sIn = document.getElementById('dateInput');
                var eIn = document.getElementById('deliverDateInput');
                if (sIn) sIn.value = p.start_date || '';
                if (eIn) eIn.value = p.end_date || '';
                // update small display texts
                (function updateDisplays(){
                    var d1 = document.getElementById('displayDate');
                    var d2 = document.getElementById('deliverDateDisplay');
                    function fmt(ymd){
                        if (!ymd) return 'DD:MM:YYYY';
                        var dt = new Date(ymd);
                        if (isNaN(dt.getTime())) return 'DD:MM:YYYY';
                        return ('0'+dt.getDate()).slice(-2)+':' + ('0'+(dt.getMonth()+1)).slice(-2)+':'+dt.getFullYear();
                    }
                    if (d1) d1.innerText = fmt(p.start_date);
                    if (d2) d2.innerText = fmt(p.end_date);
                    calculateTotalDays('#projectDurationSectionCreate');
                })();

                // Reminder days
                var remHidden = document.getElementById('reminderDaysInput');
                if (remHidden) remHidden.value = (p.reminder_days == null ? '7' : String(p.reminder_days));
                var remBtns = form.querySelectorAll('.reminder-btn');
                remBtns.forEach(function(b){
                    b.classList.remove('active');
                    b.style.backgroundColor = 'transparent';
                    b.style.color = '#6c757d';
                    if (b.getAttribute('data-days') === String(remHidden.value)) {
                        b.classList.add('active');
                        b.style.backgroundColor = '#34d399';
                        b.style.color = 'white';
                    }
                });

                // Description (summernote)
                try {
                    if (typeof $ !== 'undefined' && $('#policyEditor').length && $('#policyEditor').summernote) {
                        $('#policyEditor').summernote('code', p.description || '');
                    } else {
                        var desc = document.getElementById('policyEditor');
                        if (desc) desc.value = p.description || '';
                    }
                } catch (_) {}

                // Logo preview
                try {
                    var img = document.getElementById('createLogoPreview');
                    var iconText = document.getElementById('createUploadIconText');
                    if (img) {
                        if (p.logo_url) {
                            img.src = p.logo_url;
                            img.style.display = 'block';
                            if (iconText) iconText.style.display = 'none';
                        } else {
                            img.style.display = 'none';
                            if (iconText) iconText.style.display = 'block';
                        }
                        var fileInput = document.getElementById('createUploadLogo');
                        if (fileInput) fileInput.value = '';
                    }
                } catch (_) {}

                // Phases
                try {
                    var pw = document.getElementById('phases-wrapper');
                    if (pw) pw.innerHTML = '';
                    var phases = Array.isArray(p.phases) ? p.phases : (function(){ try { return JSON.parse(p.phases)||[]; } catch(_){ return []; } })();
                    if (!phases.length) {
                        addPhaseRow(document.createElement('div')); // add one empty
                    } else {
                        phases.forEach(function(ph, idx){
                            addPhaseRow(document.createElement('div'));
                            var ti = document.querySelector('#phases-wrapper input[name="phases['+idx+'][title]"]');
                            var di = document.querySelector('#phases-wrapper input[name="phases['+idx+'][description]"]');
                            var sI = document.getElementById('phaseStartInput-' + idx);
                            var eI = document.getElementById('phaseEndInput-' + idx);
                            if (ti) ti.value = ph.title || '';
                            if (di) di.value = ph.description || '';
                            if (sI && ph.start_date) { sI.value = ph.start_date; updatePhaseDateDisplay(idx,'start',ph.start_date); }
                            if (eI && ph.end_date) { eI.value = ph.end_date; updatePhaseDateDisplay(idx,'end',ph.end_date); }
                            var remSel = document.querySelector('#phases-wrapper select[name="phases['+idx+'][reminder_days]"]');
                            if (remSel && ph.reminder_days != null) remSel.value = String(ph.reminder_days);
                        });
                        // After filling phases, preselect the global phase dropdown with the first phase title
                        try {
                            if (typeof getPhaseTitles === 'function') {
                                var titles = getPhaseTitles();
                                var first = titles && titles.length ? titles[0] : '';
                                var globalSel = document.getElementById('globalPhaseSelect');
                                if (globalSel) {
                                    globalSel.value = first || '';
                                }
                                // If there are currently empty section rows (no saved sections), align their hidden phase field
                                document.querySelectorAll('#section-groups-wrapper .section-phase-title').forEach(function(h){
                                    if (!h.value) h.value = first || '';
                                });
                            }
                        } catch (_) {}
                    }
                } catch (_) {}

                // Sections
                try {
                    var sw = document.getElementById('section-groups-wrapper');
                    if (sw) sw.innerHTML = '';
                    
                    var sections = Array.isArray(p.sections) ? p.sections : (function(){ try { return JSON.parse(p.sections)||[]; } catch(_){ return []; } })();
                    
                    if (!sections.length) {
                        addSectionGroup();
                    } else {
                        // Group sections by adjacent phase_title to preserve order but group logically
                        var groupsData = [];
                        sections.forEach(function(sec){
                             var pTitle = sec.phase_title || '';
                             if (groupsData.length === 0 || groupsData[groupsData.length-1].phase !== pTitle) {
                                 groupsData.push({ phase: pTitle, sections: [sec] });
                             } else {
                                 groupsData[groupsData.length-1].sections.push(sec);
                             }
                        });
                        
                        groupsData.forEach(function(gData){
                            addSectionGroup();
                            var group = sw.lastElementChild;
                            
                            // Set Group Phase Dropdown
                            var sel = group.querySelector('.group-phase-select');
                            if (sel) {
                                sel.value = gData.phase;
                                syncGroupPhase(sel); // Ensures hidden inputs get the value
                            }
                            
                            // Clear the default empty row added by addSectionGroup
                            var rowsWrap = group.querySelector('[data-rows]');
                            if (rowsWrap) rowsWrap.innerHTML = '';
                            
                            // Get correct group index for input naming
                            var gIdx = Array.prototype.indexOf.call(sw.children, group);
                            
                            // Add rows for this group
                            gData.sections.forEach(function(sec, rIdx){
                                rowsWrap.insertAdjacentHTML('beforeend', sectionRowTemplate(gIdx, rIdx));
                                var row = rowsWrap.lastElementChild;
                                var nameInput = row.querySelector('input[name^="sections"][name$="[name]"]');
                                var descInput = row.querySelector('input[name^="sections"][name$="[description]"]');
                                var phaseHidden = row.querySelector('input.section-phase-title');
                                var finalPhase = (sel ? sel.value : '') || gData.phase; 

                                if (nameInput) nameInput.value = sec.name || '';
                                if (descInput) descInput.value = sec.description || '';
                                if (phaseHidden) phaseHidden.value = finalPhase;
                            });
                             // Update add/remove icons for rows
                             refreshRowIcons(group);
                        });
                    }
                } catch (e) {
                    console.error('Error populating sections', e);
                    // Fallback
                    if (document.getElementById('section-groups-wrapper').children.length === 0) addSectionGroup();
                }

                // Finally show the create modal as "edit"
                setTimeout(function(){
                    var modal = new bootstrap.Modal(document.getElementById('add_project'));
                    modal.show();
                }, 350);
            })
            .catch(function(e){
                console.error('Edit fetch failed', e);
            });
        } catch (e) { console.error(e); }
    }

    // Reset the Add Project modal back to CREATE mode when it closes
    document.addEventListener('DOMContentLoaded', function(){
        var el = document.getElementById('add_project');
        if (!el) return;
        el.addEventListener('hidden.bs.modal', function(){
            resetCreateProjectForm();
        });
    });

    function resetCreateProjectForm() {
        var form = document.getElementById('projectCreateForm');
        if (!form) return;
        // Back to create route and remove PUT method
        form.setAttribute('action', "{{ route('project.store') }}");
        var method = form.querySelector('input[name="_method"]');
        if (method) method.remove();

        // Title
        var titleEl = form.querySelector('input[name="title"]');
        if (titleEl) titleEl.value = '';

        // Priority -> default medium
        var hiddenPriority = document.getElementById('priorityInput');
        if (hiddenPriority) hiddenPriority.value = 'medium';
        var priBtns = form.querySelectorAll('.priority-btn');
        priBtns.forEach(function(btn){
            btn.classList.remove('active');
            btn.style.backgroundColor = 'transparent';
            btn.style.color = '#6c757d';
        });
        priBtns.forEach(function(btn){
            if (btn.getAttribute('data-priority') === 'medium') {
                btn.classList.add('active');
                btn.style.backgroundColor = '#f59e0b';
                btn.style.color = 'white';
            }
        });

        // Dates + displays
        var sIn = document.getElementById('dateInput');
        var eIn = document.getElementById('deliverDateInput');
        if (sIn) sIn.value = '';
        if (eIn) eIn.value = '';
        var d1 = document.getElementById('displayDate');
        var d2 = document.getElementById('deliverDateDisplay');
        if (d1) d1.innerText = 'DD:MM:YYYY';
        if (d2) d2.innerText = 'DD:MM:YYYY';
        if (typeof calculateTotalDays === 'function') calculateTotalDays('#projectDurationSectionCreate');

        // Reminder -> default 7
        var remHidden = document.getElementById('reminderDaysInput');
        if (remHidden) remHidden.value = '7';
        var remBtns = form.querySelectorAll('.reminder-btn');
        remBtns.forEach(function(b){
            b.classList.remove('active');
            b.style.backgroundColor = 'transparent';
            b.style.color = '#6c757d';
            if (b.getAttribute('data-days') === '7') {
                b.classList.add('active');
                b.style.backgroundColor = '#34d399';
                b.style.color = 'white';
            }
        });

        // Description
        try {
            if (typeof $ !== 'undefined' && $('#policyEditor').length && $('#policyEditor').summernote) {
                $('#policyEditor').summernote('code', '');
            } else {
                var desc = document.getElementById('policyEditor');
                if (desc) desc.value = '';
            }
        } catch (_) {}

        // Logo
        try {
            var img = document.getElementById('createLogoPreview');
            var iconText = document.getElementById('createUploadIconText');
            if (img) { img.style.display = 'none'; img.src = ''; }
            if (iconText) iconText.style.display = 'block';
            var fileInput = document.getElementById('createUploadLogo');
            if (fileInput) fileInput.value = '';
        } catch (_) {}

        // PDF attachments (create): keep only the add tile; clear hidden inputs
        try {
            var list = document.getElementById('createPdfList');
            if (list) {
                Array.from(list.children).forEach(function(child){
                    if (!child.classList.contains('pdf-add-tile')) child.remove();
                });
            }
            var holder = document.getElementById('createPdfInputs');
            if (holder) holder.innerHTML = '';
        } catch (_) {}

        // Phases: one empty row
        try {
            var pw = document.getElementById('phases-wrapper');
            if (pw) {
                pw.innerHTML = '';
                addPhaseRow(document.createElement('div'));
                var globalSel = document.getElementById('globalPhaseSelect');
                if (globalSel) globalSel.value = '';
            }
        } catch (_) {}

        // Sections: one empty group with two empty rows
        try {
            var sw = document.getElementById('section-groups-wrapper');
            if (sw) {
                sw.innerHTML = '';
                addSectionGroup();
                document.querySelectorAll('#section-groups-wrapper .section-phase-title').forEach(function(h){ h.value = ''; });
            }
        } catch (_) {}
    }
</script>
<script>
    function calculateTotalDays(sectionSelector) {
        try {
            var section = document.querySelector(sectionSelector);
            if (!section) return;
            var startInput = document.getElementById('dateInput');
            var endInput = document.getElementById('deliverDateInput');
            var display = document.getElementById('totalDaysDisplayCreate');
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
    });
</script>
<!-- cleaned: removed edit reindex helpers -->
<!-- filed durng edit -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->
@component('components.model-popup')
@endcomponent
@endsection