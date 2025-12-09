<?php $page = 'index'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Loader -->
    <div id="page-loader" style="position:fixed;top:0;left:0;width:100%;height:100%;background:#fff;display:flex;align-items:center;justify-content:center;z-index:9999;">
        <div class="spinner" style="border:4px solid #f3f3f3;border-top:4px solid #22c55e;border-radius:50%;width:40px;height:40px;animation:spin 1s linear infinite;"></div>
    </div>

<style>
    /* Global Overrides */
    body {
        background-color: #f4f6f8;
        font-family: 'Outfit', sans-serif; /* Assuming a modern font or user default */
    }
    
    .main_content {
        padding-bottom: 0px;
    }

    /* Scrollbar */
    ::-webkit-scrollbar {
        width: 6px;
        height: 6px;
    }
    ::-webkit-scrollbar-track {
        background: transparent;
    }
    ::-webkit-scrollbar-thumb {
        background: #ccc;
        border-radius: 3px;
    }

    /* Header Section */
    .page-header-custom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding: 0 10px;
    }
    .header-title-group {
        display: flex;
        align-items: center;
        gap: 15px;
    }
    .header-title {
        font-size: 24px;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
    }
    .task-count-badge {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        padding: 4px 12px;
        font-size: 13px;
        color: #64748b;
        font-weight: 500;
    }
    
    /* Segmented Control / Filters */
    .filter-tabs {
        display: flex;
        background: #fff;
        padding: 4px;
        border-radius: 8px;
        border: 1px solid #eee;
    }
    /* Loader spinner animation */
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    .filter-tab {
        padding: 6px 16px;
        font-size: 14px;
        color: #64748b;
        font-weight: 500;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
    }
    .filter-tab:hover {
        color: #1e293b;
        background: #f8fafc;
    }
    .filter-tab.active {
        background: #f1f5f9; /* Light grey/slate active state */
        color: #1e293b;
        font-weight: 600;
    }
    
    .add-project-btn {
        background-color: #22c55e; /* Green */
        color: white;
        border: none;
        padding: 8px 20px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: background-color 0.2s;
    }
    .add-project-btn:hover {
        background-color: #16a34a;
        color: white;
    }

    /* Stats Cards Row */
    .stats-row {
        display: flex;
        gap: 15px;
         /* overflow-x: auto; */
        padding-bottom: 10px;
        margin-bottom: 20px;
        flex-wrap: wrap; 
    }
    .stats-card {
        flex: 1;
        min-width: 130px;
        background: #fff;
        border-radius: 16px;
        padding: 15px 10px;
        text-align: center;
        box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        border: 1px solid rgba(0,0,0,0.02);
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .stats-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(0,0,0,0.05);
    }
    .stats-icon-wrapper {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 4px;
    }
    .stats-title {
        font-size: 13px;
        color: #64748b;
        font-weight: 600;
        white-space: nowrap;
    }
    .stats-count {
        font-size: 20px;
        font-weight: 800;
        color: #1e293b;
    }
    
    /* Stats Colors based on screenshot approximation */
    .stat-total .stats-icon-wrapper { background-color: #ffe4e6; color: #f43f5e; } /* Pinkish */
    .stat-new .stats-icon-wrapper { background-color: #dbeafe; color: #3b82f6; } /* Blue */
    .stat-progress .stats-icon-wrapper { background-color: #dcfce7; color: #22c55e; } /* Green */
    .stat-hold .stats-icon-wrapper { background-color: #ffedd5; color: #f97316; } /* Orange */
    .stat-checked .stats-icon-wrapper { background-color: #f3e8ff; color: #a855f7; } /* Purple */
    .stat-delayed .stats-icon-wrapper { background-color: #fee2e2; color: #ef4444; } /* Red */
    .stat-rejected .stats-icon-wrapper { background-color: #fce7f3; color: #ec4899; } /* Pink/Magenta */
    .stat-done .stats-icon-wrapper { background-color: #ecfccb; color: #84cc16; } /* Lime */



    /* Ticket In Progress Section */
    .section-container {
        max-width: 550px;
        margin: 0 auto;
    }
    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        background: #fff;
        padding: 15px 20px;
        border-radius: 20px;
        border: 1px solid #f1f5f9;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    }
    .section-title {
        color: #22c55e; /* Green title */
        font-weight: 700;
        font-size: 18px;
        font-family: 'Outfit', sans-serif;
    }
    .section-subtitle {
        color: #64748b;
        font-size: 14px;
        font-weight: 500;
        display: block;
        margin-top: 2px;
    }
    
    .project-select-btn {
        background: #f1f5f9;
        border: none;
        padding: 8px 16px;
        border-radius: 12px;
        font-size: 14px;
        color: #64748b;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
    }
    .project-select-btn:hover {
        background: #e2e8f0;
        color: #334155;
    }

    /* New Task Card Design */
    .new-task-card {
        background: #fff;
        border-radius: 24px;
        padding: 10px;
        margin-bottom: 20px;
        display: flex;
        gap: 15px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.03);
        border: 1px solid #f0f0f0;
        position: relative;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        align-items: center;
    }
    .new-task-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.06);
    }
    
    .task-image-col {
        width: 100px;
        height: 100px;
        position: relative;
        /* Custom placeholder pattern similar to screenshot */
        background-color: #e5e5e5;
        background-image: 
            linear-gradient(45deg, #d4d4d4 25%, transparent 25%), 
            linear-gradient(-45deg, #d4d4d4 25%, transparent 25%), 
            linear-gradient(45deg, transparent 75%, #d4d4d4 75%), 
            linear-gradient(-45deg, transparent 75%, #d4d4d4 75%);
        background-size: 10px 10px;
        background-position: 0 0, 0 5px, 5px -5px, -5px 0px;
        border-radius: 18px;
        flex-shrink: 0;
    }

    .red-index-badge {
        position: absolute;
        top: -8px;
        left: -8px;
        width: 32px;
        height: 32px;
        background-color: #ef4444; /* Red */
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 14px;
        z-index: 10;
        border: 3px solid white;
        box-shadow: 0 4px 10px rgba(239, 68, 68, 0.3);
    }

    .task-info-col {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 10px;
        padding-right: 10px;
    }

    .task-header-new {
        display: flex;
        justify-content: center; 
        align-items: center;
        position: relative;
    }

    .task-title-new {
        font-weight: 700;
        color: #334155;
        font-size: 18px;
        text-align: center;
        letter-spacing: -0.5px;
    }
    
    .status-dot-large {
        width: 20px;
        height: 20px;
        background-color: #bef264; /* Lime base */
        border: 4px solid #ecfccb; /* Lighter ring */
        border-radius: 50%;
        position: absolute;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        box-shadow: 0 0 0 1px #d9f99d;
    }

    .task-ids-row {
        display: flex;
        gap: 12px;
        justify-content: center;
        margin-top: -5px;
    }

    .id-pill {
        background-color: #e0f2fe; /* Light Blue */
        color: #3b82f6;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .task-desc-new {
        font-size: 13px;
        color: #64748b;
        text-align: center;
        font-weight: 500;
    }

    .date-row-pill {
        background-color: #ecfdf5; /* Light Green */
        color: #10b981; /* Green Text */
        border-radius: 12px;
        padding: 8px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 13px;
        font-weight: 700;
        font-family: 'Outfit', sans-serif;
        max-width: 400px;
        margin: 0 auto;
        width: 100%;
    }
    
    .date-item {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    /* ... existing styles ... */
    
    /* NEW: Task Detail Modal Specific Styles */
    .task-modal-content {
        border-radius: 20px;
        overflow: hidden;
        border: none;
        font-family: 'Outfit', sans-serif;
    }
    .task-modal-header {
        background: linear-gradient(180deg, #60a5fa 0%, #3b82f6 100%); /* Blue gradient */
        padding: 20px;
        position: relative;
        color: white;
        height: 120px; /* Space for content + overlap */
    }
    .task-modal-close {
        position: absolute;
        top: 15px;
        right: 15px;
        color: white;
        background: rgba(255,255,255,0.2);
        border: none;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 20;
    }
    .task-project-name {
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 2px;
    }
    .task-ticket-name {
        font-size: 12px;
        opacity: 0.9;
        margin-bottom: 0;
    }
    
    .logo-circle {
        position: absolute;
        bottom: -30px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 60px;
        background: white;
        border-radius: 50%;
        padding: 8px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        z-index: 10;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .task-modal-body {
        padding: 40px 20px 20px; /* Top padding for logo overlap */
        background: #f8fafc;
    }
    
    .modal-task-title {
        text-align: center;
        font-size: 20px;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 10px;
    }
    
    .modal-tags {
        display: flex;
        justify-content: center;
        gap: 8px;
        margin-bottom: 15px;
        flex-wrap: wrap;
    }
    .badge-custom {
        padding: 4px 12px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        display: flex;
        align-items: center;
        gap: 4px;
    }
    .badge-new { background: #e0f2fe; color: #0ea5e9; }
    .badge-id { background: #fee2e2; color: #ef4444; }
    .badge-low { background: #dcfce7; color: #22c55e; } /* Assuming Low priority from screenshot */

    .meta-row {
        background: #fff;
        border-radius: 12px;
        padding: 10px;
        display: flex;
        justify-content: space-around;
        font-size: 12px;
        color: #64748b;
        margin-bottom: 20px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.02);
        border: 1px solid #f1f5f9;
    }
    .meta-item span {
        font-weight: 700;
        color: #334155;
    }
    
    .desc-box {
        background: #fff;
        padding: 15px;
        border-radius: 12px;
        margin-bottom: 15px;
        font-size: 13px;
        color: #475569;
        border: 1px solid #f1f5f9;
    }
    .desc-label {
        font-size: 11px;
        font-weight: 700;
        color: #64748b;
        margin-bottom: 5px;
        display: block;
        text-transform: uppercase;
    }
    
    .image-preview-area {
        width: 100%;
        height: 200px;
        background: #e2e8f0;
        border-radius: 16px;
        margin-bottom: 20px;
        overflow: hidden;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #94a3b8;
    }
    
    /* Notes List */
    .notes-section {
        margin-bottom: 20px;
    }
    .notes-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .note-item {
        background: #fff;
        border-radius: 12px;
        padding: 12px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border: 1px solid #f1f5f9;
    }
    .note-content {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 12px;
        color: #94a3b8;
        font-weight: 500;
    }
    .note-icon {
        color: #fca5a5; /* Light Red */
        font-size: 16px;
    }
    
    /* Form Switch Override */
    .form-switch .form-check-input {
        width: 3em;
        height: 1.5em;
        cursor: pointer;
    }
    
    .footer-alert {
        background: #fef2f2;
        border: 1px solid #fecaca;
        color: #ef4444;
        padding: 10px;
        border-radius: 8px;
        text-align: center;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }
    
    .start-btn-container {
        text-align: center;
        position: relative;
        padding-top: 10px;
    }
    /* Thread line */
    .timeline-line {
        position: absolute;
        top: 25px;
        left: 0;
        right: 50%;
        height: 2px;
        background: #fecaca;
        z-index: 0;
    }
    .start-task-btn {
        position: relative;
        z-index: 1;
        background: #fff;
        border: none;
        display: inline-flex;
        flex-direction: column;
        align-items: center;
        gap: 5px;
        color: #1e293b;
        font-size: 12px;
        font-weight: 700;
    }
    .start-btn-icon {
        width: 40px;
        height: 40px;
        background: #22c55e;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 20px;
        box-shadow: 0 4px 12px rgba(34, 197, 94, 0.4);
    }

</style>

<div class="content main_content">
    <div style="visibility:visible;">
        @include('Chats.chatsidebar')
    </div>
    @include('Chats.notification')
    
    <div class="chat chat-messages show" id="middle">
        <div style="display: flex; flex-direction: column; height: calc(100vh - 80px); overflow: hidden;">
            <div style="flex: 1; overflow-y: auto; background-color: #f4f6f8; display: flex; flex-direction: column;">
                <div class="chat-body chat-page-group p-4" style="max-width: 1400px; margin: 0 auto; width: 100%;">
                    <div class="page-header-custom">
                        <div class="header-title-group">
                            <h1 class="header-title">Tasks</h1>
                            <span class="task-count-badge">{{ $stats['total'] ?? 0 }} Tasks</span>
                            <small class="text-muted ms-2">Tasks amount and overview</small>
                        </div>
                        
                        <div class="d-flex align-items-center gap-3">
                            <div class="filter-tabs d-none d-md-flex">
                                <a href="#" class="filter-tab active">General</a>
                                <a href="#" class="filter-tab">In Progress</a>
                                <a href="#" class="filter-tab">In Delayed</a>
                                <a href="#" class="filter-tab">In Hold</a>
                            </div>
                            
                            <button class="add-project-btn" data-bs-toggle="modal" data-bs-target="#createTaskModal">
                                <i class="ti ti-plus"></i> Add Project
                            </button>
                        </div>
                    </div>
                    
                    <!-- Stats Cards Row -->
                    <div class="stats-row">
                        <!-- Total Tasks -->
                        <div class="stats-card stat-total">
                            <div class="stats-icon-wrapper">
                                <img src="{{ URL::asset('/build/img/totaltask.svg') }}" alt="Total" style="width: 24px; height: 24px;">
                            </div>
                            <div class="stats-title">Total Tasks</div>
                            <div class="stats-count">{{ $stats['total'] ?? 0 }}</div>
                        </div>
                        
                        <!-- New Task -->
                        <div class="stats-card stat-new">
                            <div class="stats-icon-wrapper">
                                <img src="{{ URL::asset('/build/img/newtask.svg') }}" alt="New" style="width: 24px; height: 24px;">
                            </div>
                            <div class="stats-title">New Task</div>
                            <div class="stats-count">{{ $stats['new'] ?? 0 }}</div>
                        </div>
                        
                        <!-- In Progress -->
                        <div class="stats-card stat-progress">
                            <div class="stats-icon-wrapper">
                                <img src="{{ URL::asset('/build/img/progress.svg') }}" alt="Progress" style="width: 24px; height: 24px;">
                            </div>
                            <div class="stats-title">In Progress</div>
                            <div class="stats-count">{{ $stats['in_progress'] ?? 0 }}</div>
                        </div>
                        
                        <!-- In Hold -->
                        <div class="stats-card stat-hold">
                            <div class="stats-icon-wrapper">
                                <img src="{{ URL::asset('/build/img/inhold.svg') }}" alt="Hold" style="width: 24px; height: 24px;">
                            </div>
                            <div class="stats-title">In Hold</div>
                            <div class="stats-count">{{ $stats['on_hold'] ?? 0 }}</div>
                        </div>
                        
                        <!-- In Checked -->
                        <div class="stats-card stat-checked">
                            <div class="stats-icon-wrapper">
                                <img src="{{ URL::asset('/build/img/incheck.svg') }}" alt="Checked" style="width: 24px; height: 24px;">
                            </div>
                            <div class="stats-title">In Checked</div>
                            <div class="stats-count">{{ $stats['checked'] ?? 0 }}</div>
                        </div>
                        
                        <!-- In Delayed -->
                        <div class="stats-card stat-delayed">
                            <div class="stats-icon-wrapper">
                                <img src="{{ URL::asset('/build/img/delayed.svg') }}" alt="Delayed" style="width: 24px; height: 24px;">
                            </div>
                            <div class="stats-title">In delayed</div>
                            <div class="stats-count">{{ $stats['delayed'] ?? 0 }}</div>
                        </div>
                        
                        <!-- In Rejected -->
                        <div class="stats-card stat-rejected">
                            <div class="stats-icon-wrapper">
                                <img src="{{ URL::asset('/build/img/rejected.svg') }}" alt="Rejected" style="width: 24px; height: 24px;">
                            </div>
                            <div class="stats-title">In Rejected</div>
                            <div class="stats-count">{{ $stats['rejected'] ?? 0 }}</div>
                        </div>
                        
                        <!-- In Done -->
                        <div class="stats-card stat-done">
                            <div class="stats-icon-wrapper">
                                <img src="{{ URL::asset('/build/img/indone.svg') }}" alt="Done" style="width: 24px; height: 24px;">
                            </div>
                            <div class="stats-title">In Done</div>
                            <div class="stats-count">{{ $stats['done'] ?? 0 }}</div>
                        </div>
                    </div>
                    

                    <!-- Central Content: Ticket In Progress -->
                    <div class="section-container">
                        <div class="section-header">
                            <div>
                                <h2 class="section-title">Ticket in Progress</h2>
                                <span class="section-subtitle">Total Tickets: {{ $stats['in_progress'] + $stats['new'] }}</span>
                            </div>
                            
                            <div class="dropdown">
                                <button class="project-select-btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    Select Projects
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item project-option" href="#" data-project-id="all">All Projects</a></li>
                                    @foreach($projects as $p)
                                        <li><a class="dropdown-item project-option" href="#" data-project-id="{{ $p->_id ?? $p->id }}">{{ $p->title }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        
                        <!-- Task List -->
                        <div class="tasks-wrapper" id="tasksListContainer">
                            @php
                                // Combine and sort tasks to show relevant ones first
                                $mergedTasks = collect($tasks)->merge($webtasks)->merge($employeeTasks)->sortByDesc('created_at');
                                
                                $normView = fn($s) => strtolower(str_replace([' ', '-'], '_', $s ?? ''));
                            @endphp

                            @forelse($mergedTasks as $index => $task)
                                @php
                                    $taskStatus = $normView($task->status);
                                    
                                    // Map specific status to generic filter classes
                                    $filterClass = 'status-general';
                                    if (in_array($taskStatus, ['new', 'new_task'])) $filterClass .= ' status-new';
                                    if (in_array($taskStatus, ['in_progress', 'progress'])) $filterClass .= ' status-in_progress';
                                    if (in_array($taskStatus, ['on_hold', 'hold', 'in_hold'])) $filterClass .= ' status-on_hold';
                                    if (in_array($taskStatus, ['checked', 'in_checked'])) $filterClass .= ' status-checked';
                                    if (in_array($taskStatus, ['delayed', 'in_delayed'])) $filterClass .= ' status-delayed';
                                    if (in_array($taskStatus, ['rejected', 'in_rejected'])) $filterClass .= ' status-rejected';
                                    if (in_array($taskStatus, ['done', 'completed', 'in_done'])) $filterClass .= ' status-done';
                                @endphp
                                
                                <div class="new-task-card {{ $filterClass }}" 
                                     data-status="{{ $taskStatus }}" 
                                     data-project-id="{{ $task->project_id ?? '' }}"
                                     data-task-id="{{ substr((string)($task->_id ?? $task->id), -4) }}"
                                     data-ticket-id="{{ substr((string)($task->ticket_id ?? '---'), -4) }}"
                                     data-title="{{ $task->title ?? 'Untitled Task' }}"
                                     data-description="{{ $task->description ?? 'No description available.' }}"
                                     data-start-date="{{ isset($task->start_date) ? \Carbon\Carbon::parse($task->start_date)->format('d.m.Y') : '12.10.2025' }}"
                                     data-end-date="{{ isset($task->end_date) ? \Carbon\Carbon::parse($task->end_date)->format('d.m.Y') : '15.10.2025' }}"
                                     data-image="{{ !empty($task->mark_image_path) ? asset('storage/' . $task->mark_image_path) : '' }}"
                                     data-index="{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}"
                                     data-project-name="{{ $task->project->title ?? 'Project Name' }}"
                                     style="cursor: pointer;"
                                     onclick="openTaskModal(this)">
                                     
                                    <!-- Left Col: Image + Index -->
                                    <div class="task-image-col">
                                        <div class="red-index-badge">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</div>
                                        @if(!empty($task->mark_image_path))
                                            <img src="{{ asset('storage/' . $task->mark_image_path) }}" 
                                                 alt="Task" 
                                                 style="width: 100%; height: 100%; object-fit: cover; border-radius: 18px;">
                                        @else
                                            <!-- Transparent/Placeholder controlled by CSS pattern -->
                                        @endif
                                    </div>

                                    <!-- Right Col: Info -->
                                    <div class="task-info-col">
                                        <!-- Header: Title + Dot -->
                                        <div class="task-header-new">
                                             <div class="task-title-new">{{ $task->title ?? 'Untitled Task' }}</div>
                                             <div class="status-dot-large" title="{{ $taskStatus }}"></div>
                                        </div>

                                        <!-- IDs Row -->
                                        <div class="task-ids-row">
                                            <span class="id-pill">Task ID {{ substr((string)($task->_id ?? $task->id), -4) }}</span>
                                            <span class="id-pill">Ticket ID {{ substr((string)($task->ticket_id ?? '---'), -4) }}</span>
                                        </div>

                                        <!-- Description -->
                                        <div class="task-desc-new">
                                            {{ Str::limit($task->description ?? 'Task description will be here', 80) }}
                                        </div>

                                        <!-- Footer: Dates -->
                                        <div class="date-row-pill">
                                            <div class="date-item">
                                                <i class="ti ti-calendar me-1"></i> 
                                                {{ isset($task->start_date) ? \Carbon\Carbon::parse($task->start_date)->format('d.m.Y') : '12.10.2025' }}
                                            </div>
                                            <div class="date-item">
                                                <i class="ti ti-arrow-right"></i>
                                            </div>
                                            <div class="date-item">
                                                {{ isset($task->end_date) ? \Carbon\Carbon::parse($task->end_date)->format('d.m.Y') : '15.10.2025' }}
                                            </div>
                                            <div style="opacity: 0.3;">|</div>
                                            <div class="date-item">
                                                15:30
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-5 text-muted">
                                    <i class="ti ti-clipboard-off fs-1 mb-3 d-block"></i>
                                    No tasks found. Create a new project or task to get started.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>


<!-- Task Detail Modal (High Fidelity) -->
<div class="modal fade" id="taskDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;"> <!-- Mobile like width -->
        <div class="modal-content task-modal-content">
            
            <!-- Custom Header -->
            <div class="task-modal-header">
                <button type="button" class="task-modal-close" data-bs-dismiss="modal">
                    <i class="ti ti-x"></i>
                </button>
                <div class="task-project-name" id="modalProjectName">Project Name</div>
                <div class="task-ticket-name">Ticket #<span id="modalTicketNum">1</span> - Ticket Title</div>
                
                <!-- Logo Circle -->
                <div class="logo-circle">
                    <!-- Standard Logo or B icon -->
                    <img src="{{ URL::asset('/build/img/AI-Logo.svg') }}" onerror="this.src='https://via.placeholder.com/30'" alt="Logo" style="width: 32px;">
                </div>
            </div>

            <!-- Body -->
            <div class="task-modal-body">
                
                <h3 class="modal-task-title" id="modalTaskTitleDisplay">Task Title</h3>
                
                <!-- Badges -->
                <div class="modal-tags">
                    <div class="badge-custom badge-new">
                        <i class="ti ti-flag"></i> New Task
                    </div>
                    <div class="badge-custom badge-id">
                        <i class="ti ti-bolt"></i> <span id="modalIndexDisplay">-01-</span>
                    </div>
                    <div class="badge-custom badge-low">
                        <i class="ti ti-circle"></i> Low
                    </div>
                </div>

                <!-- Meta Row -->
                <div class="meta-row">
                    <div class="meta-item">Task ID <span id="modalTaskIdDisplay">E5B4</span></div>
                    <div class="meta-item">|</div>
                    <div class="meta-item">Section <span id="modalSectionDisplay">Dev</span></div>
                    <div class="meta-item">|</div>
                    <div class="meta-item">Start <span id="modalStartDateDisplay">22.10</span></div>
                    <div class="meta-item">|</div>
                    <div class="meta-item">Deliver <span id="modalEndDateDisplay">23.10</span></div>
                </div>

                <!-- Issue Description -->
                <div class="desc-box">
                    <span class="desc-label">Issue Description</span>
                    <p id="modalTaskDescriptionDisplay" style="margin:0; line-height:1.4;">
                        Move the close button more down due is to near on the popup.
                    </p>
                </div>

                <!-- Image Area -->
                <div class="image-preview-area" id="modalImageArea">
                    <img id="modalTaskImageFull" src="" style="width:100%; height:100%; object-fit:contain; display:none;" alt="Proof">
                    <div id="modalImagePlaceholder" style="text-align:center;">
                        <i class="ti ti-photo-off fs-1"></i>
                        <br>No Image
                    </div>
                </div>

                <!-- Notes / Toggles -->
                <div class="notes-section">
                    <span class="desc-label">Notes</span>
                    <div class="notes-list">
                        <!-- Static Checklist for demo/default, could be dynamic later -->
                        <div class="note-item">
                            <div class="note-content">
                                <i class="ti ti-bolt note-icon"></i> Take Backup before start Development
                            </div>
                            <div class="form-check form-switch m-0">
                                <input class="form-check-input" type="checkbox" checked>
                            </div>
                        </div>
                         <div class="note-item">
                            <div class="note-content">
                                <i class="ti ti-bolt note-icon"></i> Work on your Local Server
                            </div>
                            <div class="form-check form-switch m-0">
                                <input class="form-check-input" type="checkbox">
                            </div>
                        </div>
                        <div class="note-item">
                            <div class="note-content">
                                <i class="ti ti-bolt note-icon"></i> Check your work before u deliver the work
                            </div>
                            <div class="form-check form-switch m-0">
                                <input class="form-check-input" type="checkbox">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Alert -->
                <div class="footer-alert">
                    <i class="ti ti-bolt"></i>
                    You can Start this Project on <span id="modalStartFull">23.12.2025</span>
                </div>

                <!-- Start Button (Mock functionality) -->
                <div class="start-btn-container">
                    <div class="timeline-line"></div>
                    <button class="start-task-btn">
                        <div class="start-btn-icon">
                            <i class="ti ti-rocket"></i>
                        </div>
                        Start the Task
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>


<!-- Add Task Modals (Keeping simplified placeholders or including existing ones if verified) -->
@include('Chats.partials.modals') 

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tasksContainer = document.getElementById('tasksListContainer');
        const tasks = document.querySelectorAll('.new-task-card');
        const filterTabs = document.querySelectorAll('.filter-tab');
        const statsCards = document.querySelectorAll('.stats-card');
        const countSubtitle = document.querySelector('.section-subtitle');
        const dropdownItems = document.querySelectorAll('.project-option'); // We need to add this class to dropdown items
        
        let currentFilter = 'all'; // all, new, in_progress, etc.
        let currentProject = 'all';

        function filterTasks() {
            let visibleCount = 0;
            
            tasks.forEach(task => {
                const statusClasses = task.className; // contains status-new, status-in_progress etc.
                const projectId = task.getAttribute('data-project-id');
                
                let matchesStatus = (currentFilter === 'all') || statusClasses.includes('status-' + currentFilter);
                let matchesProject = (currentProject === 'all') || (projectId === currentProject);
                
                if (matchesStatus && matchesProject) {
                    task.style.display = 'flex';
                    visibleCount++;
                } else {
                    task.style.display = 'none';
                }
            });
            
            // Update subtitle count
            if(countSubtitle) {
                const filterName = currentFilter === 'all' ? 'Total' : currentFilter.replace('_', ' ').replace(/\b\w/g, l => l.toUpperCase());
                countSubtitle.textContent = filterName + ' Tickets: ' + visibleCount;
            }
        }


        // 1. Tab Filters
        filterTabs.forEach(tab => {
            tab.addEventListener('click', function(e) {
                e.preventDefault();
                // Remove active class
                filterTabs.forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                
                const text = this.textContent.trim().toLowerCase();
                // Map text to filter key
                if(text === 'general') currentFilter = 'all';
                else if(text === 'in progress') currentFilter = 'in_progress';
                else if(text === 'in delayed') currentFilter = 'delayed';
                else if(text === 'in hold') currentFilter = 'on_hold';
                
                filterTasks();
            });
        });

        // 2. Stats Card Filters
        statsCards.forEach(card => {
            card.style.cursor = 'pointer'; // Make clickable
            card.addEventListener('click', function() {
                // Determine filter from unique class or title
                if(this.classList.contains('stat-total')) currentFilter = 'all';
                else if(this.classList.contains('stat-new')) currentFilter = 'new';
                else if(this.classList.contains('stat-progress')) currentFilter = 'in_progress';
                else if(this.classList.contains('stat-hold')) currentFilter = 'on_hold';
                else if(this.classList.contains('stat-checked')) currentFilter = 'checked';
                else if(this.classList.contains('stat-delayed')) currentFilter = 'delayed';
                else if(this.classList.contains('stat-rejected')) currentFilter = 'rejected';
                else if(this.classList.contains('stat-done')) currentFilter = 'done';
                
                // Update tabs URL state (optional, just visual sync)
                filterTabs.forEach(t => t.classList.remove('active'));
                // Try to find matching tab
                // ... (simplified sync)
                
                filterTasks();
                
                // Visual feedback on card
                statsCards.forEach(c => c.style.transform = 'none');
                this.style.transform = 'translateY(-5px)';
            });
        });
        
        // 3. Project Dropdown
        dropdownItems.forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                const projectId = this.getAttribute('data-project-id');
                currentProject = projectId;
                
                // Update dropdown button text (optional UX improvement)
                const dropdownBtn = document.querySelector('.project-select-btn');
                if(dropdownBtn) dropdownBtn.textContent = this.textContent;
                
                filterTasks();
            });
        });
    });

    window.addEventListener('load', function() {
        var loader = document.getElementById('page-loader');
        if(loader) {
            loader.style.display = 'none';
        }
    });

    // Function to Open Task Modal
    function openTaskModal(element) {
        // Retrieve data
        const title = element.getAttribute('data-title');
        const desc = element.getAttribute('data-description');
        const taskId = element.getAttribute('data-task-id');
        const ticketId = element.getAttribute('data-ticket-id');
        const startDate = element.getAttribute('data-start-date');
        const endDate = element.getAttribute('data-end-date');
        const imageSrc = element.getAttribute('data-image');
        const index = element.getAttribute('data-index');
        const projectName = element.getAttribute('data-project-name');

        // Populate Fields
        document.getElementById('modalTaskTitleDisplay').textContent = title;
        document.getElementById('modalTaskDescriptionDisplay').textContent = desc ? desc : "No description provided.";
        document.getElementById('modalTaskIdDisplay').textContent = taskId;
        // document.getElementById('modalTicketId').textContent = ticketId; // Optional usage
        document.getElementById('modalStartDateDisplay').textContent = startDate.slice(0, 5); // Just dd.mm
        document.getElementById('modalEndDateDisplay').textContent = endDate.slice(0, 5);
        document.getElementById('modalIndexDisplay').textContent = "-" + index + "-";
        
        document.getElementById('modalProjectName').textContent = projectName;
        document.getElementById('modalTicketNum').textContent = ticketId;
        
        document.getElementById('modalStartFull').textContent = startDate;

        // Image
        const imgEl = document.getElementById('modalTaskImageFull');
        const placeholderEl = document.getElementById('modalImagePlaceholder');
        
        if (imageSrc) {
            imgEl.src = imageSrc;
            imgEl.style.display = 'block';
            placeholderEl.style.display = 'none';
        } else {
            imgEl.style.display = 'none';
            placeholderEl.style.display = 'block';
        }

        const myModal = new bootstrap.Modal(document.getElementById('taskDetailModal'));
        myModal.show();
    }
</script>
