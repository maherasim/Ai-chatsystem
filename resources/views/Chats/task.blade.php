<?php $page = 'index'; ?>
@extends('layout.mainlayout')
@section('content')

<style>
    /* Global Overrides */
    body {
        background-color: #f4f6f8;
        font-family: 'Outfit', sans-serif; /* Assuming a modern font or user default */
    }
    
    .main_content {
        padding-bottom: 30px;
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
        max-width: 800px;
        margin: 0 auto;
    }
    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }
    .section-title {
        color: #22c55e; /* Green title */
        font-weight: 600;
        font-size: 16px;
    }
    .section-subtitle {
        color: #64748b;
        font-size: 13px;
        font-weight: normal;
        margin-left: 8px;
    }
    
    .project-select-btn {
        background: #f1f5f9;
        border: none;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 13px;
        color: #64748b;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    /* Task Card Design */
    .task-card {
        background: #fff;
        border-radius: 16px;
        padding: 15px;
        margin-bottom: 15px;
        display: flex;
        gap: 15px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.02);
        border: 1px solid #f1f5f9;
        position: relative;
    }
    .task-number-badge {
        position: absolute;
        top: -6px;
        left: -6px;
        background: #ef4444;
        color: white;
        font-size: 10px;
        font-weight: bold;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        z-index: 2;
    }
    
    .task-img-placeholder {
        width: 60px;
        height: 60px;
        background: #cbd5e1;
        border-radius: 12px;
        flex-shrink: 0;
    }
    
    .task-content {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    
    .task-header-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 8px;
    }
    
    .task-title-group {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }
    
    .task-title {
        font-weight: 700;
        color: #334155;
        font-size: 15px;
    }
    
    .id-badge {
        font-size: 10px;
        background: #e0f2fe;
        color: #0ea5e9;
        padding: 2px 8px;
        border-radius: 12px;
        font-weight: 600;
        text-transform: uppercase;
    }
    
    .task-desc {
        font-size: 13px;
        color: #94a3b8;
        margin-bottom: 12px;
    }
    
    .task-meta-row {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 12px;
        color: #22c55e; /* Green text for dates */
        font-weight: 600;
        background: #f0fdf4;
        padding: 4px 10px;
        border-radius: 6px;
        width: fit-content;
    }

    .status-indicator {
        width: 12px;
    /* New Task Card Design */
    .new-task-card {
        background: #fff;
        border-radius: 20px;
        padding: 5px; /* Minimal padding container */
        margin-bottom: 20px;
        display: flex;
        gap: 0;
        box-shadow: 0 4px 15px rgba(0,0,0,0.04);
        border: 1px solid #f0f0f0;
        position: relative;
        overflow: hidden;
    }
    
    .task-image-col {
        width: 140px;
        position: relative;
        /* Grey placeholder background pattern */
        background-color: #e5e5e5;
        background-image: radial-gradient(#cdcdcd 1px, transparent 1px);
        background-size: 8px 8px;
        border-radius: 15px;
        margin: 5px;
        min-height: 100px;
    }

    .red-index-badge {
        position: absolute;
        top: -5px;
        left: -5px;
        width: 28px;
        height: 28px;
        background-color: #ef4444; /* Red */
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 12px;
        z-index: 10;
        border: 2px solid white;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }

    .task-info-col {
        flex: 1;
        padding: 10px 15px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .task-header-new {
        display: flex;
        justify-content: space-between; 
        align-items: center;
        margin-bottom: 5px;
    }

    .task-title-new {
        font-weight: 700;
        color: #334155;
        font-size: 15px;
        text-align: center;
        flex: 1;
    }

    .task-ids-row {
        display: flex;
        gap: 10px;
        margin-bottom: 12px;
        justify-content: center;
    }

    .id-pill {
        background-color: #e0f2fe; /* Light Blue */
        color: #3b82f6;
        padding: 4px 14px;
        border-radius: 20px;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .task-desc-new {
        font-size: 12px;
        color: #94a3b8;
        text-align: center;
        margin-bottom: 15px;
    }

    .date-row-pill {
        background-color: #ecfdf5; /* Light Green */
        color: #10b981; /* Green Text */
        border-radius: 8px;
        padding: 8px 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 15px;
        font-size: 11px;
        font-weight: 700;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .status-dot-large {
        width: 18px;
        height: 18px;
        background-color: #bef264; /* Lime */
        border: 3px solid #f7fee7;
        border-radius: 50%;
        box-shadow: 0 0 0 1px #d9f99d;
    }
</style>

<div class="content main_content">
    <div style="visibility:visible;">
        @include('Chats.chatsidebar')
    </div>
    @include('Chats.notification')
    
    <div class="chat chat-messages show" id="middle">
        <div style="display: flex; flex-direction: column; height: 100vh; overflow: hidden;">
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
                                <span class="section-title">Ticket in Progress</span>
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
                                
                                // normalize helper re-definition for view scope if needed (though accessible from controller pass-in usually better, 
                                // but let's be safe for blade loop)
                                $normView = fn($s) => strtolower(str_replace([' ', '-'], '_', $s ?? ''));
                            @endphp

                            @forelse($mergedTasks as $index => $task)
                                @php
                                    $taskStatus = $normView($task->status);
                                    // Mapping strict status to filter categories if needed, 
                                    // or just use the normalized status key directly.
                                    // Categories: general (all), in_progress, delayed, on_hold (hold), ckecked, rejected, done
                                    
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
                                     data-project-id="{{ $task->project_id ?? '' }}">
                                     
                                    <!-- Left Col: Image + Index -->
                                    <div class="task-image-col">
                                        <div class="red-index-badge">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</div>
                                        <!-- Dynamic Image or Fallback -->
                                         <img src="{{ asset('build/img/bgractangle.svg') }}" 
                                              alt="Task Image" 
                                              style="width: 100%; height: 100%; object-fit: cover; border-radius: 15px; opacity: 0.6;">
                                    </div>

                                    <!-- Right Col: Info -->
                                    <div class="task-info-col">
                                        <!-- Header: Title + Dot -->
                                        <div class="task-header-new">
                                             <div style="width: 20px;"></div> <!-- Spacer for centering if needed -->
                                             <div class="task-title-new">{{ $task->title ?? 'Untitled Task' }}</div>
                                             <div class="status-dot-large" title="{{ $taskStatus }}"></div>
                                        </div>

                                        <!-- IDs Row -->
                                        <div class="task-ids-row">
                                            <!-- Using ID suffix for display -->
                                            <span class="id-pill">Task ID {{ substr((string)($task->_id ?? $task->id), -4) }}</span>
                                            <span class="id-pill">Ticket ID {{ substr((string)($task->ticket_id ?? '---'), -4) }}</span>
                                        </div>

                                        <!-- Description -->
                                        <div class="task-desc-new">
                                            {{ Str::limit($task->description ?? 'Task description will be here', 80) }}
                                        </div>

                                        <!-- Footer: Dates -->
                                        <div class="date-row-pill">
                                            <span>
                                                <i class="bi bi-calendar-check me-1"></i> 
                                                {{ isset($task->start_date) ? \Carbon\Carbon::parse($task->start_date)->format('d.m.Y') : '12.10.2025' }}
                                            </span>
                                            <span class="mx-1" style="color: #10b981;">
                                                <i class="bi bi-arrow-right"></i>
                                            </span>
                                            <span>
                                                {{ isset($task->end_date) ? \Carbon\Carbon::parse($task->end_date)->format('d.m.Y') : '15.10.2025' }}
                                            </span>
                                            <span class="mx-2" style="opacity: 0.3;">|</span>
                                            <span>
                                                <i class="bi bi-clock me-1"></i> 
                                                15:30
                                            </span>
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

<!-- Add Task Modals (Keeping simplified placeholders or including existing ones if verified) -->
@include('Chats.partials.modals') 

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tasksContainer = document.getElementById('tasksListContainer');
        const tasks = document.querySelectorAll('.task-card');
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
</script>

