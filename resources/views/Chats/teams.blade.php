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
    @include('Chats.notification', ['groups' => $groups ?? collect([])])
    <!-- /Sidebar group -->

    <!-- Chat -->
    <div class="chat chat-messages show" id="middle" style="overflow-y: hidden;">
        <div>
              @include('Chats.header')
            <!-- Wrapper -->
            <div style="visibility:visible;height: 92vh; overflow-y: auto; scrollbar-width: thin;">
                <div class="chat-body chat-page-group ">

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

                    <!-- members overwiew -->
                    <div class="project-succes pt-2 pb-2 d-flex justify-content-between align-items-center" style="flex-wrap: wrap; gap: 10px;">

                        <!-- Left Side -->
                        <div>
                            <h3 style="margin: 0;">Our team</h3>
                            <strong>Our Team:{{ $teamtotalcount }}</strong>
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
                        <!-- Team Cards -->
                        @foreach(($teams ?? []) as $team)
                        <div class="col-md-3 col-sm-6 mb-4">
                            <div class="card" style=" border-radius: 15px; overflow: hidden; font-family: sans-serif; position: relative;">
                                <!-- Top Background with Overlay Elements -->
                                <div style="position: relative;">
                                    <!-- Background Image -->
                                    <img src="{{ $team->banner_path ? asset('storage/'.$team->banner_path) : URL::asset('/build/img/bgblack.svg') }}" class="img-fluid" style="width: 100%; height: 120px; object-fit: cover;" alt="BG Image">

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

                                                <img src="{{URL::asset('/build/img/delete1.svg')}}" alt="Delete" style="width: 22px; cursor: pointer;" class="team-delete" data-team-id="{{ (string) ($team->_id ?? $team->id) }}">

                                                <!-- Vertical Divider -->
                                                <div style="width: 1px; height: 18px; background-color: #ccc;"></div>

                                                <img src="{{URL::asset('/build/img/Edit1.svg')}}" alt="Edit" style="width: 22px; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#add_team" class="team-edit" data-team-id="{{ (string) ($team->_id ?? $team->id) }}" data-update-url="{{ route('teams.update', ['id' => (string) ($team->_id ?? $team->id)]) }}">

                                                <!-- Vertical Divider -->
                                                <div style="width: 1px; height: 18px; background-color: #ccc;"></div>

                                                <img src="{{URL::asset('/build/img/flow.svg')}}" alt="Flow" style="width: 22px; cursor: pointer;" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight">

                                            </div>

                                        </div>
                                    </div>

                                    <!-- Hide all popups on outside click (Inline JS inside body tag only) -->

                                    <body onclick="document.querySelectorAll('.menu-box').forEach(el => el.style.display = 'none');">


                                        <!-- Hidden Delete Form -->
                                        <form id="delete-team-{{ (string) ($team->_id ?? $team->id) }}" action="{{ route('teams.destroy', ['id' => (string) ($team->_id ?? $team->id)]) }}" method="POST" style="display:none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                        <!-- Profile Image (overlapping bottom center) -->
                                        <div style="position: absolute; bottom: -40px; left: 50%; transform: translateX(-50%); border: 3px solid #fff; border-radius: 50%; background: white;">
                                            <img src="{{ $team->thumb_path ? asset('storage/'.$team->thumb_path) : URL::asset('/build/img/profileuser.svg') }}" class="rounded-circle" style="width: 80px; height: 80px; object-fit: cover;" alt="Profile">
                                        </div>
                                </div>

                                <!-- Content Below Image -->
                                <div style="padding-top: 40px;" class="text-center">
                                    <div style="font-weight: bold; font-size: 16px; cursor: pointer;">{{ $team->title ?? 'Team Name' }}</div>

                                    <!-- Developer Badge -->
                                    <div style="margin-top: 5px;">
                                        <span style=" background-color: #f1f1f1;  /* slightly darker than #f8f9fb */ color: #e53935;             /* deeper red tone */ font-size: 13px; padding: 4px 12px; border-radius: 12px; font-weight: 600; display: inline-block; ">
                                            {{ $team->project_title ?? 'Project' }}
                                        </span>
                                    </div>


                                </div>

                                <div class="p-3 mb-2" style="background-color: #f8f9fb; border-radius: 10px; padding: 10px; margin: 6px; font-size: 14px;">

                                    <!-- Top Row: Title and Date -->
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div style="font-weight: 600; color: #2e3a59; font-size: 14px;">Project & Team</div>
                                        <div class="d-flex align-items-center gap-1" style="font-size: 13px; color: #2e3a59;">
                                            <img src="{{ asset('build/img/member1.svg') }}" alt="Green Flag" width="14" height="14">
                                            <span>{{ $team->created_at->format('d.m.Y') }}</span>
                                        </div>
                                    </div>

                                    <!-- Bottom Row: Logo + PM + Team -->
                                    <div class="d-flex justify-content-between align-items-center text-center">

                                        <!-- Left: Logo + Flag -->
                                        <div class="d-flex flex-column align-items-center gap-2">
                                            <img src="{{ !empty($team->project_logo_path) ? $team->project_logo_path : URL::asset('/build/img/yekbon.svg') }}" alt="Logo" style="height: 32px; width: 32px; object-fit: cover;" />
                                            <div style="background: #c8ede0; padding: 3px 6px;display: flex; justify-content: center; align-items: center;">
                                                <img src="{{ asset('build/img/greenflag.svg') }}" alt="Green Flag" width="14" height="14">
                                            </div>
                                        </div>

                                        <!-- Center: PM -->
                                        <div class="text-center">
                                            <img src="{{ $team->pm_image ?? asset('build/img/profile.svg') }}" alt="PM" class="rounded-circle" style="height: 36px; width: 36px; object-fit: cover;" />
                                            <div style="font-size: 12px; font-weight: 500; color: red;margin-top:3px;background:white;border-radius:5px;cursor:pointer">PM</div>

                                        </div>

                                        <!-- Right: Overlapping team members -->
                                        @php
                                            $devAvatars = $team->developer_avatar_paths ?? [];
                                            $firstTwo = array_slice($devAvatars, 0, 2);
                                        @endphp
                                        <div class="d-flex align-items-center justify-content-center" style="margin-left: 6px;margin-bottom: 18px;">
                                            @forelse($firstTwo as $i => $path)
                                                <img src="{{ asset('/'.$path) }}" class="rounded-circle" style="height: 28px; width: 28px; object-fit: cover; border: 2px solid #fff; {{ $i>0 ? 'margin-left:-10px;' : '' }} z-index: {{ 2 - $i }};" />
                                            @empty
                                            <img src="{{URL::asset('/build/img/profileuser.svg')}}" class="rounded-circle" style="height: 28px; width: 28px; object-fit: cover; border: 2px solid #fff; z-index: 2;" />
                                            <img src="{{URL::asset('/build/img/profileuser.svg')}}" class="rounded-circle" style="height: 28px; width: 28px; object-fit: cover; border: 2px solid #fff; margin-left: -10px; z-index: 1;" />
                                            @endforelse
                                        </div>

                                    </div>
                                </div>

                                <!-- Stats -->
                                @php
                                    $ticketsArr = is_array($team->tickets) ? $team->tickets : (is_string($team->tickets) ? (json_decode($team->tickets, true) ?? []) : []);
                                    $tasksArr = is_array($team->tasks) ? $team->tasks : (is_string($team->tasks) ? (json_decode($team->tasks, true) ?? []) : []);
                                    $ticketsCount = is_array($ticketsArr) ? count($ticketsArr) : 0;
                                    $tasksCount = is_array($tasksArr) ? count($tasksArr) : 0;
                                @endphp
                                <div class="d-flex justify-content-around mt-1" style="background-color: #f8f9fb;border-radius:10px;padding:10px;margin:6px;font-size: 14px;">
                                    <div class="text-center">
                                        <div style="font-weight: bold;">Total Tickets</div>
                                        <div>{{ $ticketsCount }}</div>
                                    </div>
                                    <div class="text-center">
                                        <div style="font-weight: bold;">Total Tasks</div>
                                        <div>{{ $tasksCount }}</div>
                                    </div>
                                </div>
                                <div style="background-color: #f8f9fb;border-radius:10px;padding:10px;margin:6px;font-size: 14px;">
                                    <div class="sections-slider-container" style="position: relative; width: 100%;">
                                        <div class="sections-scroll d-flex align-items-center gap-2" 
                                            style="overflow-x: auto; 
                                                   overflow-y: hidden; 
                                                   white-space: nowrap; 
                                                   width: 100%; 
                                                   scroll-behavior: smooth;
                                                   -ms-overflow-style: none; 
                                                   scrollbar-width: none;
                                                   padding: 4px 0;">
                                            @php
                                                $sections = $team->project_sections ?? [];
                                            @endphp
                                            @if(count($sections) > 0)
                                                @foreach($sections as $sec)
                                                    <span style="background:#eef2f7; color:#2e3a59; padding:4px 12px; border-radius:10px; display:inline-block; white-space:nowrap; flex: 0 0 auto; font-size: 11px; font-weight: 600; font-family: 'Segoe UI', sans-serif;">{{ $sec }}</span>
                                                @endforeach
                                            @else
                                                <span style="background:#eef2f7; color:#2e3a59; padding:4px 12px; border-radius:10px; display:inline-block; white-space:nowrap; flex: 0 0 auto; font-size: 11px; font-weight: 600; font-family: 'Segoe UI', sans-serif;">No Sections</span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Progress Bar -->
                                    <div class="mt-2 px-1">
                                        <div class="progress" style="width: 100%; height: 8px; background-color: #e9ecef; border-radius: 10px;">
                                            <div class="progress-bar" style="width: 0%; background-color: #28c76f; border-radius: 10px; transition: width 0.3s ease;"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Productivity -->
                                <div class="text-center mt-1 mb-1" style="background-color: #f8f9fb; border-radius: 10px; padding: 10px; margin: 6px; font-size: 14px; font-family: sans-serif;">
                                    <div style="font-weight: 600; color: #4a90e2;">Productivity 0%</div>
                                    <div style="height: 8px; width: 90%; margin: 6px auto; background-color: #e6e6e6; border-radius: 5px;">
                                        <div style="width: 75%; height: 100%; background-color: #4acbff; border-radius: 5px;"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        @endforeach
                        

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
                    @php
                        $currentProjectTitle = isset($project) && $project ? ($project->title ?? 'Project') : 'All Projects';
                        $currentProjectId = isset($selectedProjectId) ? (string) $selectedProjectId : null;
                        $defaultProjectId = $currentProjectId ?: (isset($projects) && count($projects) ? (string) (($projects[0]->_id ?? $projects[0]->id) ?? '') : '');
                    @endphp
                    @php
                        $allProjectsData = collect($projects ?? [])->map(function($p){
                            return [
                                'id' => (string) ($p->_id ?? $p->id),
                                'title' => $p->title ?? 'Project',
                                'logo' => (isset($p->logo_path) && $p->logo_path) ? asset('storage/'.ltrim($p->logo_path,'/')) : null,
                            ];
                        })->values()->all();
                    @endphp
                    <script>
                        window.currentWorkflowProjectId = '{{ $defaultProjectId }}';
                        window.allProjects = @json($allProjectsData);
                    </script>
                    <div class="d-inline-flex align-items-center px-3 py-1" onclick="{{ $currentProjectId ? "openProjectTickets('{$currentProjectId}')" : 'openAllProjects()' }}"
                        style="background:#ffffff; border:1px solid #e2e8f0; border-radius:10px; font-size:12px; color:#2e3a59; gap:8px;cursor:pointer">
                        <img src="{{ URL::asset('/build/img/yekbon.svg') }}" alt="Icon" style="width:20px; height:20px;" />
                        <div>{{ $currentProjectTitle }}</div>
                    </div>

                    @if(isset($projects) && $projects)
                        @php
                            $otherProjects = collect($projects)->filter(function($p) use ($currentProjectId) {
                                $pid = (string) ($p->_id ?? $p->id ?? '');
                                return $currentProjectId ? $pid !== $currentProjectId : true;
                            })->take(2);
                        @endphp
                        @foreach($otherProjects as $op)
                            <div class="d-inline-flex align-items-center px-3 py-1" onclick="openProjectTickets('{{ (string) ($op->_id ?? $op->id) }}')"
                                style="background:#ffffff; border:1px solid #e2e8f0; border-radius:10px; font-size:12px; color:#2e3a59; gap:8px;cursor:pointer">
                                <img src="{{ URL::asset('/build/img/yekbon.svg') }}" alt="Icon" style="width:20px; height:20px;" />
                                <div>{{ $op->title ?? 'Project' }}</div>
                            </div>
                        @endforeach
                    @endif


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


                    @php
                        $ticketStarts = collect($tickets ?? [])->pluck('start_date')->filter();
                        $ticketEnds = collect($tickets ?? [])->pluck('end_date')->filter();
                        $minStart = $ticketStarts->isNotEmpty() ? \Carbon\Carbon::parse($ticketStarts->min())->format('d.m.Y') : null;
                        $maxEnd = $ticketEnds->isNotEmpty() ? \Carbon\Carbon::parse($ticketEnds->max())->format('d.m.Y') : null;
                    @endphp
                    @if($minStart || $maxEnd)
                        <div class="d-inline-flex" style="gap:8px;background:white">
                            @if($minStart)
                                <div class="px-3 py-1" style="background:#a6f09c; color:#ffffff; border-radius:999px; font-size:12px;">
                                    Start: {{ $minStart }}
                                </div>
                            @endif
                            @if($maxEnd)
                                <div class="px-3 py-1" style="background:#22c55e; color:#ffffff; border-radius:999px; font-size:12px;">
                                    Deliver: {{ $maxEnd }}
                                </div>
                            @endif
                        </div>
                    @endif


                    <!-- Avatars -->
                    <div class="d-flex align-items-center" style="gap:6px; margin-left:6px;">
                        @php
                            $avatarPaths = collect($teams ?? [])->pluck('developer_avatar_paths')->flatten()->filter()->unique()->take(3);
                        @endphp
                        @forelse($avatarPaths as $ap)
                            <img src="{{ $ap }}" alt="avatar" style="width:28px; height:28px; border-radius:50%; border:2px solid #ffffff;">
                        @empty
                            <div class="d-inline-flex align-items-center justify-content-center"
                                 style="width:28px; height:28px; border-radius:50%; border:2px solid #ffffff; background:#e5e7eb; color:#111827; font-size:12px; font-weight:600;">
                                {{ strtoupper(substr($currentProjectTitle, 0, 1)) }}
                            </div>
                        @endforelse
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
                        @php
                            $baseDate = \Carbon\Carbon::now()->startOfMonth();
                        @endphp
                        @for ($i = 0; $i < 30; $i++)
                            @php $d = $baseDate->copy()->addDays($i); @endphp
                            <div class="text-center" style="padding:8px 0; font-size:11px; color:#6b7280;">
                                {{ $d->format('D j') }}
                            </div>
                        @endfor
                    </div>

                    <!-- EVENTS: sample positions mimic screenshot (absolute coords) -->
                    <div style="position:relative;">
                        @php
                            $rowIndex = 0;
                            $ticketItems = collect($tickets ?? []);
                            $sourceItems = $ticketItems->count() ? $ticketItems : collect($projects ?? [])->take(3);
                        @endphp
                        @foreach($sourceItems as $tk)
                            @php
                                $sd = isset($tk->start_date) && $tk->start_date ? \Carbon\Carbon::parse($tk->start_date) : null;
                                $ed = isset($tk->end_date) && $tk->end_date ? \Carbon\Carbon::parse($tk->end_date) : $sd;
                                $dayStart = $sd ? max(1, min(30, (int) $sd->day)) : max(1, min(30, ($loop->index % 5) + 1));
                                $dayEnd = $ed ? max($dayStart, min(30, (int) $ed->day)) : $dayStart + 2;
                                $span = max(1, min(30, $dayEnd) - $dayStart + 1);
                                $topPx = 80 + ($rowIndex * 128);
                                $rowIndex++;
                                $status = strtolower((string)($tk->status ?? ''));
                                $barColor = '#ec4899';
                                if (in_array($status, ['in_progress','progress','ongoing'])) { $barColor = '#f59e0b'; }
                                if (in_array($status, ['done','completed','complete'])) { $barColor = '#3578a8'; }
                                $titleText = $tk->title ?? ($tk->project_title ?? ($project->title ?? 'Ticket'));
                                $codeText = $tk->code ?? ('Ticket #' . ($loop->iteration));
                                $tid = (string) ($tk->_id ?? $tk->id ?? '');
                            @endphp
                            @php
                                // For the main timeline (overview), clicking any bar should open the Tickets view for the project
                                $pid = (string) ($tk->project_id ?? ($project?->_id ?? $project->id ?? $selectedProjectId ?? ''));
                            @endphp
                            <div onclick="openProjectTickets('{{ $pid }}')"
                                 style="position:absolute; top:{{ $topPx }}px; left:calc(({{ $dayStart }} - 1) * (100%/30) + 8px); width:calc(({{ $span }} * (100%/30)) - 16px);
                                        display:flex; border-radius:10px; overflow:hidden; box-shadow:0 2px 6px rgba(0,0,0,.08); font-size:12px; cursor:pointer;">
                                <div class="d-flex align-items-center justify-content-between"
                                     style="background:{{ $barColor }}; color:#ffffff; padding:6px 10px; flex: 1; border-radius:7px;">
                                    <img src="{{ URL::asset('/build/img/yekbon.svg') }}" alt="icon" style="width:22px; height:22px; margin-right:8px;" />
                                    <div class="d-flex flex-column" style="line-height:1;">
                                        <div class="fw-semibold" style="font-size:13px;">{{ $titleText }}</div>
                                        <div style="font-size:10px; opacity:0.9;">{{ $codeText }}</div>
                                    </div>
                                    <div class="fw-semibold ms-auto" style="font-size:14px; padding-left:15px;">
                                        {{ $tk->progress ?? ' ' }}
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-end"
                                     style="background:#ffffff; padding:0 12px; min-width:120px; border-top-right-radius:10px; border-bottom-right-radius:10px;">
                                    @php $evAvatars = $avatarPaths ?? collect(); @endphp
                                    <div style="display:flex; align-items:center;">
                                        @foreach($evAvatars->take(3) as $ap)
                                            <img src="{{ $ap }}" style="width:24px; height:24px; border-radius:50%; border:2px solid #fff; {{ !$loop->first ? 'margin-left:-8px;' : '' }} position:relative; z-index:{{ 3 - $loop->index }};" />
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
                    <div id="projectTicketsEvents" style="position:relative;"></div>

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

                    <!-- EVENTS: dynamic tasks injected below -->
                    <div id="taskCardsContainer" style="position:relative;"></div>

                </div>
            </div>
        </div>
    </div>


</div>

<!-- add team -->

<div class="modal fade" id="add_team" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 800px; width: 98%;">
        <div class="modal-content" style="border-radius: 24px; border: none; box-shadow: 0 10px 40px rgba(0,0,0,0.1); background-color: #fff;">
            
            <style>
                .modal-content { font-family: 'Inter', sans-serif; color: #1e293b; }
                
                /* Custom Form Controls */
                .custom-input {
                    background-color: #fff;
                    border: 1px solid #e2e8f0;
                    border-radius: 12px;
                    padding: 12px 16px;
                    font-size: 14px;
                    color: #1e293b;
                    width: 100%;
                    outline: none;
                }
                .custom-input:focus { border-color: #22c55e; }
                
                /* Custom Select Arrow */
                .custom-select-wrap { position: relative; }
                .custom-select-wrap::after {
                    content: '';
                    position: absolute;
                    right: 16px;
                    top: 50%;
                    transform: translateY(-50%);
                    width: 10px; 
                    height: 6px;
                    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%2394a3b8' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
                    background-repeat: no-repeat;
                    background-size: contain;
                    pointer-events: none;
                }
                .custom-input-select { appearance: none; cursor: pointer; }

                /* Upload Box */
                .upload-box {
                    background: #f8fafc;
                    border: 2px dashed #cbd5e1;
                    border-radius: 20px;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                    cursor: pointer;
                    transition: all 0.2s;
                    position: relative;
                    overflow: hidden;
                }
                .upload-box-banner {
                    background: rgba(236, 236, 236, 0.5);
                    border: none;
                    border-radius: 10px 10px 0 0;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                    cursor: pointer;
                    transition: all 0.2s;
                    position: relative;
                    overflow: hidden;
                }
                .upload-box-thumb {
                    background: rgba(236, 236, 236, 0.5);
                    border: 2px dashed #cbd5e1;
                    border-radius: 10px;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                    cursor: pointer;
                    transition: all 0.2s;
                    position: relative;
                    overflow: hidden;
                }
                .upload-box:hover, .upload-box-banner:hover, .upload-box-thumb:hover { 
                    background: rgba(236, 236, 236, 0.7); 
                    border-color: #94a3b8; 
                }

                /* Ticket Tabs */
                .ticket-tabs-scroll {
                    overflow-x: auto;
                    white-space: nowrap;
                    padding-bottom: 5px;
                    scrollbar-width: none;
                }
                .ticket-tabs-scroll::-webkit-scrollbar { display: none; }
                
                .ticket-btn {
                    background: transparent;
                    border: none;
                    color: #94a3b8;
                    font-weight: 600;
                    padding: 8px 16px;
                    border-radius: 8px;
                    font-size: 14px;
                    transition: all 0.2s;
                }
                .ticket-btn.active {
                    background-color: #22c55e;
                    color: #fff;
                    box-shadow: 0 4px 6px rgba(34, 197, 94, 0.2);
                }

                /* Task Card Styles (Figma Match) */
                .task-wrapper {
                    background: #F2F2F2;
                    border-radius: 16px;
                    padding: 16px;
                    margin-bottom: 16px;
                }
                .task-row {
                    display: flex;
                    align-items: stretch;
                    gap: 16px;
                    position: relative;
                }
                
                /* 1. Left Image Section */
                .task-image-box {
                    width: 100px;
                    flex-shrink: 0;
                    position: relative;
                }
                .task-badge {
                    position: absolute;
                    top: -6px;
                    left: -6px;
                    background-color: #ff0000; /* Red */
                    color: white;
                    width: 32px;
                    height: 32px;
                    border-radius: 50%; /* Perfect circle */
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-weight: 700;
                    font-size: 14px;
                    z-index: 10;
                    box-shadow: 2px 2px 6px rgba(0,0,0,0.15);
                }
                .task-img-placeholder {
                    width: 100%;
                    height: 100%;
                    border-radius: 12px;
                    background-color: #e2e8f0;
                    /* Checkerboard Pattern */
                    background-image: linear-gradient(45deg, #cbd5e1 25%, transparent 25%, transparent 75%, #cbd5e1 75%, #cbd5e1),
                    linear-gradient(45deg, #cbd5e1 25%, transparent 25%, transparent 75%, #cbd5e1 75%, #cbd5e1);
                    background-size: 12px 12px;
                    background-position: 0 0, 6px 6px;
                    overflow: hidden;
                }

                /* 2. Middle Card Section */
                .task-content-card {
                    flex-grow: 1;
                    background: #fff;
                    border-radius: 16px;
                    padding: 16px;
                    box-shadow: 0 2px 10px rgba(0,0,0,0.03);
                    border: 1px solid #f1f5f9;
                    position: relative;
                    min-height: 100px;
                }
                .status-indicator-outer {
                    position: absolute;
                    top: 16px;
                    right: 16px;
                    width: 24px;
                    height: 24px;
                    background: #ecfccb; /* Light lime */
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }
                .status-indicator-inner {
                    width: 12px;
                    height: 12px;
                    background: #84cc16; /* Lime Green */
                    border-radius: 50%;
                }
                .tag-badge {
                    background: #e0f2fe;
                    color: #0ea5e9;
                    font-size: 10px;
                    font-weight: 700;
                    padding: 4px 10px;
                    border-radius: 20px;
                    display: inline-block;
                }
                .date-footer {
                    background: #ecfdf5;
                    border-radius: 8px;
                    padding: 8px 12px;
                    color: #10b981;
                    font-weight: 600;
                    font-size: 12px;
                    display: inline-flex;
                    align-items: center;
                    gap: 8px;
                    margin-top: 8px;
                    width: 100%;
                }

                /* 3. Right Controls Section */
                .task-controls {
                    width: 140px;
                    flex-shrink: 0;
                    display: flex;
                    flex-direction: column;
                    gap: 12px;
                    padding-top: 35px; /* Push down to align with content */
                }
                .control-dropdown {
                    background: #fff;
                    border: 1px solid #f1f5f9;
                    border-radius: 10px;
                    padding: 6px 10px;
                    display: flex;
                    align-items: center;
                    position: relative;
                    height: 40px;
                }
                .control-select-overlay {
                    position: absolute;
                    top: 0; left: 0; width: 100%; height: 100%;
                    opacity: 0;
                    cursor: pointer;
                }
            </style>

            <div class="modal-header border-0 pb-0 pt-4 px-4 align-items-start position-relative">
                <div class="flex-grow-1">
                    <h5 class="modal-title fw-bold text-dark mb-1" style="font-size: 20px;">Edit the Team</h5>
                    <p class="text-muted m-0 small">Manage your Projects</p>
                </div>

                <div class="d-none d-sm-flex align-items-center bg-danger bg-opacity-10 rounded-3 px-3 py-2 me-5" style="max-width: 320px;">
                    <img src="{{ URL::asset('/build/img/tera.svg') }}" style="width: 18px; filter: invert(27%) sepia(51%) saturate(2878%) hue-rotate(346deg) brightness(104%) contrast(97%); margin-right: 10px; flex-shrink: 0;">
                    <span style="font-size: 11px; color: rgba(28, 39, 76, 0.7); line-height: 1.3;">Please Note! Projects, Ticket and Task must be created before add a Team</span>
                </div>

                <button type="button" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; top: 20px; right: 20px; background: none; border: none; font-size: 24px; color: #64748b; cursor: pointer; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;">
                    <i class="ti ti-x" style="font-size: 24px;"></i>
                </button>
            </div>

            <form id="teamForm" action="{{ route('teams.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" id="teamFormMethod" value="">
                
                <div class="modal-body px-4 pb-4 pt-2">
                    
                    <div class="d-flex flex-column gap-3 mb-4 mt-2">
                        <!-- Banner Upload -->
                        <div class="upload-box-banner" style="width: 100%; height: 160px;" onclick="document.getElementById('bannerInput').click();">
                            <img id="bannerPreview" style="width: 100%; height: 100%; object-fit: cover; display: none; position: absolute; border-radius: 10px 10px 0 0;" />
                            <div class="text-center text-box">
                                <div style="font-size: 48px; font-weight: 300; color: #94a3b8; line-height: 1;">+</div>
                                <div style="font-size: 16px; font-weight: 600; color: #475569; margin-top: 8px;">Upload banner</div>
                                <div style="font-size: 12px; color: #94a3b8; margin-top: 4px;">JPG or PNG</div>
                    </div>
                </div>
                        <input type="file" id="bannerInput" name="banner" class="d-none" onchange="previewImage(this, 'bannerPreview')">
                
                <!-- Thumbnail Upload -->
                        <div class="upload-box-thumb" style="width: 120px; height: 120px; margin: 0 auto;" onclick="document.getElementById('thumbInput').click();">
                            <img id="thumbPreview" style="width: 100%; height: 100%; object-fit: cover; display: none; position: absolute; border-radius: 10px;" />
                            <div class="text-center text-box">
                                <div style="font-size: 32px; font-weight: 300; color: #94a3b8; line-height: 1;">+</div>
                                <div style="font-size: 12px; color: #94a3b8; margin-top: 4px;">JPG or PNG</div>
                    </div>
                </div>
                        <input type="file" id="thumbInput" name="thumb" class="d-none" onchange="previewImage(this, 'thumbPreview')">
                    </div>

                    <div class="p-4 mb-4" style="background: rgba(242, 242, 242, 0.5); border: none; border-radius: 10px;">
                        <div class="mb-3">
                            <h6 class="fw-bold m-0" style="color: #1e293b; font-size: 16px;">Team Details</h6>
                            <small style="color: #64748b; font-size: 13px;">Manage your time</small>
                        </div>
                    <div class="row g-3">
                            <div class="col-md-6">
                                <input type="text" class="custom-input" name="title" placeholder="Team Title">
                        </div>
                            <div class="col-md-6 custom-select-wrap">
                                <select class="custom-input custom-input-select" id="addProjectSelect" name="project_id" style="color:#64748b;">
                                <option value="" selected>Select Project</option>
                                @isset($projects)
                                    @foreach($projects as $project)
                                        <option value="{{ (string) ($project->_id ?? $project->id) }}" @selected(request('project_id') == (string) ($project->_id ?? $project->id))>{{ $project->title }}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                            <div class="col-md-6 custom-select-wrap">
                                <select class="custom-input custom-input-select" name="pm_id" style="color:#64748b;">
                                <option value="" selected>Select PM</option>
                                @foreach($developers ?? [] as $developer)
                                    <option value="{{ $developer->_id }}">{{ $developer->name }} - {{ ucfirst($developer->type ?? 'user') }}</option>
                                @endforeach
                            </select>
                        </div>
                            <div class="col-md-6 custom-select-wrap">
                                <select class="custom-input custom-input-select" name="timeline_color" style="color:#64748b;">
                                <option selected>Timeline Color</option>
                                <option>Red</option>
                                <option>Blue</option>
                            </select>
                            </div>
                        </div>
                    </div>

                    <div class="p-4" style="background: rgba(242, 242, 242, 0.5); border: none; border-radius: 10px; min-height: 250px;">
                        
                        <h6 class="fw-bold text-dark mb-3">Select Ticket & Task</h6>

                        <div class="ticket-tabs-scroll d-flex gap-2 mb-4" id="addTicketContainer" style="background: white; padding: 12px; border-radius: 8px;">
                            <div class="text-muted small p-1">Please select a project above first...</div>
                </div>

                        <div id="taskListContainer" class="w-100">
                            </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4 pt-2 border-top">
                        <div class="d-flex align-items-center bg-danger bg-opacity-10 rounded-3 px-3 py-2 mt-3 me-3" style="width: auto;">
                            <img src="{{ URL::asset('/build/img/tera.svg') }}" style="width: 16px; filter: invert(27%) sepia(51%) saturate(2878%) hue-rotate(346deg) brightness(104%) contrast(97%); margin-right: 8px; flex-shrink: 0;">
                            <span style="font-size: 11px; color: rgba(28, 39, 76, 0.7); white-space: nowrap;">There some section not asigend yet</span>
                        </div>
                        <button type="submit" class="btn btn-success text-white fw-bold px-4 py-3 rounded-3 mt-3" style="background-color: #22c55e; border:none; font-size: 13px; box-shadow: 0 4px 12px rgba(34, 197, 94, 0.4);">
                            + Save and create work flow
                        </button>
                    </div>

                    <input type="hidden" name="tickets[]" id="selectedTicketId" value="">
                    <div id="tasksHiddenContainer"></div>

                </div>
            </form>
        </div>
                </div>

                <script>
        // Image Preview Helper
        function previewImage(input, previewId) {
            const preview = document.getElementById(previewId);
            const textBox = input.previousElementSibling.querySelector('.text-box');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    if(textBox) textBox.style.display = 'none';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Main Logic
                    document.addEventListener('DOMContentLoaded', function () {
                        const projectSelect = document.getElementById('addProjectSelect');
            const ticketContainer = document.getElementById('addTicketContainer');
                        const tasksContainer = document.getElementById('taskListContainer');
                        const selectedTicketInput = document.getElementById('selectedTicketId');
                        const tasksHiddenContainer = document.getElementById('tasksHiddenContainer');

            // Dummy Data for immediate visual verification if fetch fails
            let developersList = []; // Will fetch real ones
            
            // Fetch Developers on load
                        fetch('{{ url('/team/developers') }}', { credentials: 'same-origin' })
                            .then(r => r.ok ? r.json() : [])
                            .then(json => { developersList = Array.isArray(json) ? json : []; })
                .catch(e => console.log('Dev fetch error', e));

            // 1. Fetch Tickets
            window.fetchTickets = async function(projectId) {
                if(!projectId) return;
                
                // Show loading state
                ticketContainer.innerHTML = '<div class="spinner-border spinner-border-sm text-success" role="status"></div>';
                            tasksContainer.innerHTML = '';

                try {
                    const res = await fetch('{{ url('/team/tickets') }}?project_id=' + projectId);
                    if(!res.ok) throw new Error('Failed');
                    const data = await res.json();
                    const tickets = data.tickets || data || [];
                    renderTickets(tickets);
                } catch (e) {
                    console.error(e);
                    ticketContainer.innerHTML = '<div class="text-danger small">Error loading tickets</div>';
                }
            };

            // 2. Fetch Tasks
            window.fetchTasks = async function(ticketId) {
                tasksContainer.innerHTML = '<div class="text-center py-4"><div class="spinner-border text-success" role="status"></div></div>';
                
                try {
                    const res = await fetch('{{ url('/team/tasks') }}?ticket_id=' + ticketId);
                    if(!res.ok) throw new Error('Failed');
                    const data = await res.json();
                    const tasks = data.tasks || data || [];
                    renderTasks(tasks);
                } catch (e) {
                    console.error(e);
                    tasksContainer.innerHTML = '<div class="text-center text-muted small py-4">No tasks found</div>';
                }
            };

            // 3. Render Tickets (Tabs)
            function renderTickets(tickets) {
                ticketContainer.innerHTML = '';
                if(tickets.length === 0) {
                    ticketContainer.innerHTML = '<div class="text-muted small">No tickets found for this project</div>';
                    return;
                }

                tickets.forEach((t, idx) => {
                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.className = 'ticket-btn';
                    btn.textContent = `#${idx+1} ${t.title || 'Ticket'}`;
                    btn.onclick = () => {
                        // Toggle Active Class
                        document.querySelectorAll('.ticket-btn').forEach(b => b.classList.remove('active'));
                        btn.classList.add('active');
                        // Set ID and Fetch Tasks
                        selectedTicketInput.value = t.id || t._id;
                        fetchTasks(t.id || t._id);
                    };
                    ticketContainer.appendChild(btn);

                    // Auto select first
                    if(idx === 0) btn.click();
                });
            }

            // 4. Render Tasks (Cards) - PIXEL PERFECT FIGMA MATCH
                        function renderTasks(tasks) {
                            tasksContainer.innerHTML = '';
                tasksHiddenContainer.innerHTML = '';
                
                if(tasks.length === 0) {
                    tasksContainer.innerHTML = '<div class="text-center text-muted small py-4">No tasks found</div>';
                                return;
                            }

                tasks.forEach((task, idx) => {
                    // Hidden input for form submission
                    const hidden = document.createElement('input');
                    hidden.type = 'hidden';
                    hidden.name = 'tasks[]';
                    hidden.value = task.id || task._id;
                    tasksHiddenContainer.appendChild(hidden);

                    const fallbackMarkImg = '{{ URL::asset('/build/img/dooted img.svg') }}';
                    const markImgSrc = (function () {
                        const raw = (task && task.mark_image_path) ? String(task.mark_image_path) : '';
                        if (!raw) return fallbackMarkImg;
                        // If the backend returned an absolute URL, keep it (but fix double storage).
                        if (raw.startsWith('http://') || raw.startsWith('https://')) {
                            return raw.replace('/storage/storage/', '/storage/');
                        }
                        // If it's already a root-relative path
                        if (raw.startsWith('/storage/')) return raw.replace('/storage/storage/', '/storage/');
                        if (raw.startsWith('/build/')) return raw;
                        // If DB stored "storage/.." or "build/.."
                        if (raw.startsWith('storage/')) return ('/' + raw).replace('/storage/storage/', '/storage/');
                        if (raw.startsWith('build/')) return ('/' + raw);
                        // Otherwise assume it's a storage-relative path like "tasks/xyz.png"
                        return ('{{ asset('storage') }}/' + raw.replace(/^\/+/, '')).replace('/storage/storage/', '/storage/');
                    })();

                    // Data Prep
                    const title = task.title || 'Task Title';
                    const desc = task.description || 'Task description will be here';
                    const startDate = task.start_date ? new Date(task.start_date).toLocaleDateString('de-DE') : '12.10.2025';
                    const endDate = task.end_date ? new Date(task.end_date).toLocaleDateString('de-DE') : '15.10.2025';
                    
                    // Developer Options
                    const devOptions = developersList.map(d => 
                        `<option value="${d.id}" data-img="${d.image || '{{ URL::asset("/build/img/profile.svg") }}'}">${d.name}</option>`
                    ).join('');

                    // --- HTML TEMPLATE ---
                    const cardHtml = `
                    <div class="task-wrapper">
                    <div class="task-row">
                        <div class="task-image-box">
                            <div class="task-badge">${String(idx + 1).padStart(2, '0')}</div>
                            <div class="task-img-placeholder">
                                <img src="${markImgSrc}" style="width:100%; height:100%; object-fit:cover;" onerror="this.onerror=null; this.src='{{ URL::asset('/build/img/dooted img.svg') }}';">
                               </div>
                           </div>
                           
                        <div class="task-content-card">
                            <div class="status-indicator-outer">
                                <div class="status-indicator-inner"></div>
                        </div>

                            <div class="d-flex align-items-center mb-2">
                                <img src="${task.project_logo_path || '{{ URL::asset("/build/img/yekbon.svg") }}'}" style="width: 24px; height: 24px; border-radius: 50%; border:1px solid #eee; margin-right: 8px;">
                                <h6 class="mb-0 fw-bold" style="font-size: 15px; color:#1e293b;">${title}</h6>
                        </div>

                            <div class="d-flex gap-2 mb-2 pb-2" style="border-bottom: 1px solid #e2e8f0;">
                                <span class="tag-badge">Task ID</span>
                                <span class="tag-badge">${task.ticket?.code || 'Ticket ID'}</span>
                        </div>

                            <p class="text-muted mb-2 mt-2" style="font-size: 13px; line-height: 1.4;">${desc}</p>

                            <div class="date-footer">
                                <img src="{{ URL::asset('/build/img/calender1.svg') }}" style="width: 14px;">
                                <span>${startDate}</span>
                                <span>↔</span>
                                <span>${endDate}</span>
                                <span>↔</span>
                                <span>15:30</span>
                            </div>
                    </div>

                        <div class="task-controls">
                            <div class="control-dropdown">
                                <span class="dot" style="width:8px; height:8px; border-radius:50%; background:#22c55e; margin-right:8px;"></span>
                                <span class="text flex-grow-1" style="font-size:12px; color:#475569;">Low</span>
                                <i class="ti ti-chevron-down" style="font-size:10px; color:#94a3b8;"></i>
                                <select class="control-select-overlay" name="task_priorities[${task.id || task._id}]" onchange="updateUI(this, 'priority')">
                                    <option value="low" data-color="#22c55e">Low</option>
                                    <option value="medium" data-color="#f59e0b">Medium</option>
                                    <option value="high" data-color="#ef4444">High</option>
                             </select>
                        </div>
                        
                            <div class="control-dropdown">
                                <img class="avatar" src="{{ URL::asset('/build/img/profile.svg') }}" style="width:20px; height:20px; border-radius:50%; margin-right:8px;">
                                <span class="text flex-grow-1" style="font-size:12px; color:#475569;">Name</span>
                                <i class="ti ti-chevron-down" style="font-size:10px; color:#94a3b8;"></i>
                                <select class="control-select-overlay" name="task_developers[${task.id || task._id}]" onchange="updateUI(this, 'dev')">
                                    <option value="">Select User</option>
                                    ${devOptions}
                             </select>
                        </div>
                    </div>
                </div>
                    </div>`;
                    
                    const div = document.createElement('div');
                    div.innerHTML = cardHtml;
                    tasksContainer.appendChild(div);
                });
            }

            // Listen for Project Change
            projectSelect.addEventListener('change', function() {
                fetchTickets(this.value);
            });
        });

        // UI Update Helpers
        function updateUI(select, type) {
            const container = select.parentElement;
            const option = select.options[select.selectedIndex];
            
            if(type === 'priority') {
                const color = option.getAttribute('data-color');
                container.querySelector('.dot').style.backgroundColor = color;
                container.querySelector('.text').textContent = option.text;
                                } else {
                const img = option.getAttribute('data-img');
                if(img) container.querySelector('.avatar').src = img;
                container.querySelector('.text').textContent = option.text;
                                }
                        }
                </script>
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
            <form id="editTeamForm" action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
            <div class="modal-body d-flex flex-column align-items-center justify-content-center" style="padding: 20px;">
                <!-- Upload Banner -->
                <input type="file" accept="image/*" id="editBannerInput" name="banner" style="display: none;" onchange="this.previousElementSibling.querySelector('img').src = window.URL.createObjectURL(this.files[0]); this.previousElementSibling.querySelector('img').style.display='block'; this.previousElementSibling.querySelector('.text-box').style.display='none';">
                <div onclick="this.nextElementSibling.click();" style="width: 100%; height: 120px; border: 2px dashed #ccc; border-radius: 10px; display: flex; justify-content: center; align-items: center; margin-bottom: 20px; cursor: pointer; position: relative; overflow: hidden; flex-direction: column;background:#FAFAFA">
                    <img id="editBannerPreview" style="max-height: 100%; max-width: 100%; display: none; position: absolute;" />
                    <div class="text-box" style="text-align: center;">
                        <div style="font-size: 24px; color: #888;">+</div>
                        <div style="font-size: 14px; color: #555; margin-top: 5px;">Upload banner</div>
                        <div style="font-size: 12px; color: #999;">JPG or PNG</div>
                    </div>
                </div>
                <input type="file" accept="image/*" id="editThumbInput" name="thumb" style="display: none;" onchange="this.previousElementSibling.querySelector('img').src = window.URL.createObjectURL(this.files[0]); this.previousElementSibling.querySelector('img').style.display='block'; this.previousElementSibling.querySelector('.text-box').style.display='none';">

                <!-- Sub Image Upload -->
                <div onclick="this.nextElementSibling.click();"
                    style="width: 80px; height: 80px; border: 2px dashed #ccc; border-radius: 10px; display: flex; justify-content: center; align-items: center; cursor: pointer; position: relative; overflow: hidden; flex-direction: column;background:#FAFAFA">
                    <img id="editThumbPreview" style="max-height: 100%; max-width: 100%; display: none; position: absolute;" />
                    <div class="text-box" style="text-align: center;">
                        <div style="font-size: 20px; color: #888;">+</div>
                        <div style="font-size: 12px; color: #999;">JPG or PNG   </div>
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
                            <input type="text" class="form-control" name="title" id="editTitle" placeholder="Team Title"
                                style="background-color: #fff; border: none; border-radius: 8px; font-size: 13px; color: #666;">
                        </div>

                        <!-- Select Project -->
                        <div class="col-12 col-md-6 col-lg-3">
                            <form action="{{ route('chat-team') }}" method="GET">
                                <select class="form-select" name="project_id" id="editProjectSelect"
                                    style="background-color: #fff; border: none; border-radius: 8px; font-size: 13px; color: #666;  background-size: 12px; appearance: none; -webkit-appearance: none; -moz-appearance: none; background-position: right 10px center;">
                                    <option value="" {{ empty($selectedProjectId) ? 'selected' : '' }}>Select Project</option>
                                    @foreach($projects as $project)
                                    <option value="{{ (string) ($project->_id ?? $project->id) }}" @selected(($selectedProjectId ?? '') == (string) ($project->_id ?? $project->id))>{{ $project->title }}</option>
                                    @endforeach
                                </select>
                                <div class="mt-2">
                                    <button type="submit" class="btn"
                                        style="background-color: #26c26c; color: white; font-weight: 600; font-size: 12px; padding: 6px 12px; border: none; border-radius: 8px;">
                                        Load Tickets
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Select PM -->
                        <div class="col-12 col-md-6 col-lg-3">
                            <select class="form-select" name="pm_id" id="editPm"
                                style="background-color: #fff; border: none; border-radius: 8px; font-size: 13px; color: #666;  background-size: 12px; appearance: none; -webkit-appearance: none; -moz-appearance: none; background-position: right 10px center;">
                                <option value="" selected>Select PM</option>
                                @foreach($developers ?? [] as $developer)
                                    <option value="{{ $developer->_id }}">{{ $developer->name }} - {{ ucfirst($developer->type ?? 'user') }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Timeline Color -->
                        <div class="col-12 col-md-6 col-lg-3">
                            <select class="form-select" name="timeline_color" id="editTimelineColor"
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
                    <div class="d-flex justify-content-start gap-2 p-2" style="background: #fff; border-radius: 10px;" id="editTicketContainer"></div>

                    <script>
                        (function () {
                            const projectSelect = document.getElementById('editProjectSelect');
                            const container = document.getElementById('editTicketContainer');

                            function showMessage(msg) {
                                container.innerHTML = '';
                                const div = document.createElement('div');
                                div.style.color = '#7a7a9d';
                                div.style.fontSize = '12px';
                                div.textContent = msg;
                                container.appendChild(div);
                            }

                            function renderTickets(tickets) {
                                container.innerHTML = '';
                                if (!tickets || tickets.length === 0) {
                                    showMessage('No tickets for this project');
                                    return;
                                }
                                tickets.forEach(function (t, idx) {
                                    const btn = document.createElement('button');
                                    btn.className = 'btn';
                                btn.textContent = (t.title || '').trim() || '# Ticket';
                                    btn.style.flex = '1 1 130px';
                                    btn.style.borderRadius = '20px';
                                    btn.style.padding = '6px 12px';
                                    btn.style.fontWeight = '600';
                                    btn.style.fontSize = '11px';
                                    btn.style.backgroundColor = idx === 0 ? '#47ca7a' : 'transparent';
                                    btn.style.color = idx === 0 ? 'white' : '#7a7a9d';
                                    btn.addEventListener('click', function () {
                                        Array.from(container.children).forEach(function (child) {
                                            if (child.tagName === 'BUTTON') {
                                                child.style.backgroundColor = 'transparent';
                                                child.style.color = '#7a7a9d';
                                            }
                                        });
                                        btn.style.backgroundColor = '#47ca7a';
                                        btn.style.color = 'white';
                                    });
                                    container.appendChild(btn);
                                });
                            }

                        async function fetchTickets(projectId) {
                                try {
                                const res = await fetch('{{ url('/team/tickets') }}?project_id=' + encodeURIComponent(projectId), { credentials: 'same-origin' });
                                    if (!res.ok) { renderTickets([]); return; }
                                    const data = await res.json();
                                    const tickets = Array.isArray(data) ? data : (data.tickets || []);
                                    renderTickets(tickets);
                                } catch (e) {
                                    renderTickets([]);
                                }
                            }

                            // Initial state
                            if (projectSelect && projectSelect.value) {
                                fetchTickets(projectSelect.value);
                            } else {
                                showMessage('Select a project to view tickets');
                            }

                            if (projectSelect) {
                                projectSelect.addEventListener('change', function () {
                                    const pid = projectSelect.value;
                                    if (pid) fetchTickets(pid); else showMessage('Select a project to view tickets');
                                });
                            }
                        })();
                    </script>

                </div>


                <!-- task1 -->
                <div class="container-fluid mt-2" style="background-color: #f4f4f4; border-radius: 10px; padding: 10px; display: flex; gap: 10px; flex-wrap: wrap; align-items: flex-start;">

                    <!-- Image -->
                    <div style="width: 70px; height: 100px; border-radius: 8px; overflow: hidden; background-color: #ccc; flex-shrink: 0;">
                        ${task.mark_image_path 
                            ? `<img src="${task.mark_image_path}" style="width: 100%; height: 100%; object-fit: cover;">` 
                            : `<img src="{{URL::asset('/build/img/dooted img.svg')}}" style="width: 100%; height: 100%; object-fit: cover;">`
                        }
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

                <!-- footer -->

                <div style="display: flex;  justify-content: space-between; align-items: center; gap: 15px; margin-top: 30px; width: 100%;">

                    <!-- Left Warning Box -->
                    <div style="background-color: #ffe4e6; color: #be123c; border-radius: 12px; padding: 12px 16px; display: flex; align-items: center; font-size: 12px; flex: 1;">
                        <img src="{{ URL::asset('/build/img/tera.svg') }}" alt="⚡" style="width: 20px; height: 20px; margin-right: 10px;">
                        There some section not asigend yet
                    </div>

                    <!-- Right Save Button -->
                    <button type="submit"
                        style="background-color: #22c55e; color: white; font-weight: 600; font-size: 14px; padding: 12px 24px; border: none; border-radius: 12px; white-space: nowrap; display: flex; align-items: center; gap: 8px;">
                        + Save and create work flow
                    </button>

                </div>
                <!-- Modal Body -->



            </div>
            </form>

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
    function showProjectView(autofetch = true) {
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

        // If triggered from the toggle, try auto-fetch tickets for current project
        if (autofetch && window.currentWorkflowProjectId) {
            fetchProjectTickets(window.currentWorkflowProjectId);
        }
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

<script>
    // Provide a small pool of developer avatars for task cards (from teams collection)
    window.teamDeveloperAvatars = @json(collect($teams ?? [])->pluck('developer_avatar_paths')->flatten()->filter()->unique()->values()->take(5));

    function taskStatusToPercent(status) {
        if (!status) return '0%';
        const s = ('' + status).toLowerCase();
        if (['done', 'completed', 'complete','new_task'].includes(s)) return '100%';
        if (['in_progress', 'progress', 'ongoing','new_task'].includes(s)) return '45%';
        return '0%';
    }

    function priorityToColor(priority) {
        const p = ('' + (priority || '')).toLowerCase();
        if (p === 'high') return '#f43f5e';
        if (p === 'medium') return '#f59e0b';
        if (p === 'low') return '#22c55e';
        return '#f43f7f'; // default pink
    }

    async function openTicketTasks(ticketId) {
        // toggle to Task view
        showTaskView();
        const container = document.getElementById('taskCardsContainer');
        if (!container) return;
        container.innerHTML = '<div style="position:absolute; top:60px; left:16px; font-size:12px; color:#6b7280;">Loading tasks...</div>';
        try {
            const res = await fetch('{{ url('/team/tasks') }}?ticket_id=' + encodeURIComponent(ticketId), { credentials: 'same-origin' });
            const tasks = res.ok ? await res.json() : [];
            renderTaskCards(tasks);
        } catch (e) {
            container.innerHTML = '<div style="position:absolute; top:60px; left:16px; font-size:12px; color:#ef4444;">Failed to load tasks</div>';
        }
    }

    function renderTaskCards(tasks) {
        const container = document.getElementById('taskCardsContainer');
        if (!container) return;
        container.innerHTML = '';
        if (!Array.isArray(tasks) || tasks.length === 0) {
            container.innerHTML = '<div style="position:absolute; top:60px; left:16px; font-size:12px; color:#6b7280;">No tasks found for this ticket</div>';
            return;
        }
        const avatars = (window.teamDeveloperAvatars || []).slice(0, 3);
        tasks.forEach(function(t, idx) {
            const topPx = 90 + (idx * 120);
            const barColor = priorityToColor(t.priority);
            const percent = taskStatusToPercent(t.status);
            const projectLogo = t.project_logo_path || null;
            const code = (t.ticket && t.ticket.code) ? t.ticket.code : '';

            // Card wrapper
            const card = document.createElement('div');
            card.setAttribute('style',
                'position:absolute; top:' + topPx + 'px; left:calc((2 - 1) * (100%/96) + 8px);' +
                'display:flex; border-radius:12px; overflow:hidden; box-shadow:0 2px 6px rgba(0,0,0,0.08);' +
                'font-size:13px; width:520px; background:#ffffff;');

            // Left colored block with logo/avatar and text
            const left = document.createElement('div');
            left.setAttribute('style', 'background:' + barColor + '; padding:8px 10px; display:flex; align-items:center; gap:10px; width:180px; border-radius:10px;');

            const logo = document.createElement('img');
            logo.setAttribute('src', projectLogo ? projectLogo : '{{ URL::asset('/build/img/yekbon.svg') }}');
            logo.setAttribute('style', 'width:36px; height:36px; border-radius:6px; object-fit:cover; background:#fff;');

            const textWrap = document.createElement('div');
            textWrap.setAttribute('class', 'd-flex flex-column');
            textWrap.setAttribute('style', 'color:#ffffff;');
            const titleEl = document.createElement('div');
            titleEl.setAttribute('style', 'font-weight:600; font-size:13px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; max-width:120px;');
            titleEl.textContent = t.title || 'Task';
            const subEl = document.createElement('div');
            subEl.setAttribute('style', 'font-size:11px; opacity:0.85;');
            subEl.textContent = (t.id ? ('#' + String(t.id).slice(-6)) : '') + (code ? ' - ' + code : '');
            textWrap.appendChild(titleEl);
            textWrap.appendChild(subEl);

            left.appendChild(logo);
            left.appendChild(textWrap);

            // Right white area with percent and avatars
            const right = document.createElement('div');
            right.setAttribute('class', 'd-flex align-items-center justify-content-end');
            right.setAttribute('style', 'background:#ffffff; flex:1; padding:0 12px; gap:12px; border-top-right-radius:12px; border-bottom-right-radius:12px;');

            const pct = document.createElement('div');
            pct.setAttribute('style', 'font-weight:600; font-size:13px; color:#1e293b;');
            pct.textContent = percent;

            const avatarWrap = document.createElement('div');
            avatarWrap.setAttribute('style', 'display:flex; align-items:center;');
            avatars.forEach(function(src, aIdx) {
                const av = document.createElement('img');
                av.setAttribute('src', src);
                av.setAttribute('style', 'width:24px; height:24px; border-radius:50%; border:2px solid #fff; ' + (aIdx > 0 ? 'margin-left:-8px;' : '') + ' position:relative; z-index:' + (3 - aIdx) + ';');
                avatarWrap.appendChild(av);
            });

            right.appendChild(pct);
            right.appendChild(avatarWrap);

            card.appendChild(left);
            card.appendChild(right);

            container.appendChild(card);
        });
    }

    async function openProjectTickets(projectId) {
        if (!projectId) { showProjectView(); return; }
        // remember selection for future toggles
        window.currentWorkflowProjectId = projectId;
        // show project view without triggering autofetch here (we will fetch explicitly)
        showProjectView(false);
        await fetchProjectTickets(projectId);
    }

    async function fetchProjectTickets(projectId) {
        const container = document.getElementById('projectTicketsEvents');
        if (!container) return;
        container.innerHTML = '<div style="position:absolute; top:60px; left:16px; font-size:12px; color:#6b7280;">Loading tickets...</div>';
        try {
            const res = await fetch('{{ url('/workflow/project-tickets') }}?project_id=' + encodeURIComponent(projectId), { credentials: 'same-origin' });
            const ticks = res.ok ? await res.json() : [];
            renderProjectTickets(ticks);
        } catch (e) {
            container.innerHTML = '<div style="position:absolute; top:60px; left:16px; font-size:12px; color:#ef4444;">Failed to load tickets</div>';
        }
    }

    function renderProjectTickets(tickets) {
        const container = document.getElementById('projectTicketsEvents');
        if (!container) return;
        container.innerHTML = '';
        if (!Array.isArray(tickets) || tickets.length === 0) {
            container.innerHTML = '<div style="position:absolute; top:60px; left:16px; font-size:12px; color:#6b7280;">No tickets for this project</div>';
            return;
        }
        let rowIndex = 0;
        tickets.forEach(function(tk, idx) {
            const sd = tk.start_date ? new Date(tk.start_date) : null;
            const ed = tk.end_date ? new Date(tk.end_date) : sd;
            const dayStart = sd ? Math.max(1, Math.min(30, sd.getDate())) : Math.max(1, Math.min(30, (idx % 5) + 1));
            const endDay = ed ? Math.max(dayStart, Math.min(30, ed.getDate())) : Math.min(30, dayStart + 2);
            const span = Math.max(1, endDay - dayStart + 1);
            const topPx = 90 + (rowIndex * 128);
            rowIndex++;

            const s = ('' + (tk.status || '')).toLowerCase();
            let barColor = '#ec4899';
            if (['in_progress','progress','ongoing'].includes(s)) barColor = '#f59e0b';
            if (['done','completed','complete'].includes(s)) barColor = '#3578a8';

            const outer = document.createElement('div');
            outer.setAttribute('onclick', "openTicketTasks('" + (tk.id || '') + "')");
            outer.setAttribute('style',
                'position:absolute; top:' + topPx + 'px; left:calc((' + dayStart + ' - 1) * (100%/30) + 8px); width:calc((' + span + ' * (100%/30)) - 16px);' +
                'display:flex; border-radius:10px; overflow:hidden; box-shadow:0 2px 6px rgba(0,0,0,.08); font-size:12px; cursor:pointer;');

            const left = document.createElement('div');
            left.setAttribute('class','d-flex align-items-center justify-content-between');
            left.setAttribute('style','background:' + barColor + '; color:#ffffff; padding:6px 10px; flex:1; border-radius:7px;');

            const icon = document.createElement('img');
            icon.setAttribute('src', (tk.project_logo || '{{ URL::asset('/build/img/yekbon.svg') }}'));
            icon.setAttribute('style','width:22px; height:22px; margin-right:8px;');

            const text = document.createElement('div');
            text.setAttribute('class','d-flex flex-column');
            text.setAttribute('style','line-height:1;');
            const title = document.createElement('div');
            title.setAttribute('class','fw-semibold');
            title.setAttribute('style','font-size:13px;');
            title.textContent = tk.title || tk.code || 'Ticket';
            const code = document.createElement('div');
            code.setAttribute('style','font-size:10px; opacity:0.9;');
            code.textContent = tk.code || ('Ticket #' + (idx + 1));
            text.appendChild(title);
            text.appendChild(code);

            const pct = document.createElement('div');
            pct.setAttribute('class','fw-semibold ms-auto');
            pct.setAttribute('style','font-size:14px; padding-left:15px;');
            pct.textContent = tk.progress ? String(tk.progress) : ' ';

            left.appendChild(icon);
            left.appendChild(text);
            left.appendChild(pct);

            const right = document.createElement('div');
            right.setAttribute('class','d-flex align-items-center justify-content-end');
            right.setAttribute('style','background:#ffffff; padding:0 12px; min-width:140px; border-top-right-radius:10px; border-bottom-right-radius:10px;');

            const avatarWrap = document.createElement('div');
            avatarWrap.setAttribute('style','display:flex; align-items:center;');
            (window.teamDeveloperAvatars || []).slice(0,3).forEach(function(src, aIdx) {
                const av = document.createElement('img');
                av.setAttribute('src', src);
                av.setAttribute('style','width:24px; height:24px; border-radius:50%; border:2px solid #fff; ' + (aIdx > 0 ? 'margin-left:-8px;' : '') + ' position:relative; z-index:' + (3 - aIdx) + ';');
                avatarWrap.appendChild(av);
            });
            right.appendChild(avatarWrap);

            outer.appendChild(left);
            outer.appendChild(right);
            container.appendChild(outer);
        });
    }

    function openAllProjects() {
        // Show project view and render list of all projects
        showProjectView(false);
        renderProjectList(Array.isArray(window.allProjects) ? window.allProjects : []);
    }

    function renderProjectList(projects) {
        const container = document.getElementById('projectTicketsEvents');
        if (!container) return;
        container.innerHTML = '';
        if (!Array.isArray(projects) || projects.length === 0) {
            container.innerHTML = '<div style="position:absolute; top:60px; left:16px; font-size:12px; color:#6b7280;">No projects found</div>';
            return;
        }

        // Render stacked project bars similar to timeline ticket cards
        const colors = ['#ec4899', '#f59e0b', '#3578a8', '#22c55e', '#8b5cf6'];
        let rowIndex = 0;

        projects.forEach(function(p, idx){
            const topPx = 90 + (rowIndex * 128);
            rowIndex++;
            const barColor = colors[idx % colors.length];

            const outer = document.createElement('div');
            outer.setAttribute('style',
                'position:absolute; top:' + topPx + 'px; left:8px; width:520px;' +
                'display:flex; border-radius:10px; overflow:hidden; box-shadow:0 2px 6px rgba(0,0,0,.08); font-size:12px; cursor:pointer;');
            outer.onclick = function(){ openProjectTickets(p.id); };

            const left = document.createElement('div');
            left.setAttribute('class','d-flex align-items-center justify-content-between');
            left.setAttribute('style','background:' + barColor + '; color:#ffffff; padding:6px 10px; flex: 1; border-radius:7px;');

            const icon = document.createElement('img');
            icon.setAttribute('src', p.logo || '{{ URL::asset('/build/img/yekbon.svg') }}');
            icon.setAttribute('style','width:22px; height:22px; margin-right:8px; border-radius:6px; background:#fff;');

            const text = document.createElement('div');
            text.setAttribute('class','d-flex flex-column');
            text.setAttribute('style','line-height:1;');
            const title = document.createElement('div');
            title.setAttribute('class','fw-semibold');
            title.setAttribute('style','font-size:13px;');
            title.textContent = p.title || 'Project Title';
            const code = document.createElement('div');
            code.setAttribute('style','font-size:10px; opacity:0.9;');
            code.textContent = 'Tickets';
            text.appendChild(title);
            text.appendChild(code);

            const pct = document.createElement('div');
            pct.setAttribute('class','fw-semibold ms-auto');
            pct.setAttribute('style','font-size:14px; padding-left:15px;');
            pct.textContent = '45%';

            left.appendChild(icon);
            left.appendChild(text);
            left.appendChild(pct);

            const right = document.createElement('div');
            right.setAttribute('class','d-flex align-items-center justify-content-end');
            right.setAttribute('style','background:#ffffff; padding:0 12px; min-width:140px; border-top-right-radius:10px; border-bottom-right-radius:10px;');

            const avatarWrap = document.createElement('div');
            avatarWrap.setAttribute('style','display:flex; align-items:center;');
            (window.teamDeveloperAvatars || []).slice(0,3).forEach(function(src, aIdx) {
                const av = document.createElement('img');
                av.setAttribute('src', src);
                av.setAttribute('style','width:24px; height:24px; border-radius:50%; border:2px solid #fff; ' + (aIdx > 0 ? 'margin-left:-8px;' : '') + ' position:relative; z-index:' + (3 - aIdx) + ';');
                avatarWrap.appendChild(av);
            });
            right.appendChild(avatarWrap);

            outer.appendChild(left);
            outer.appendChild(right);
            container.appendChild(outer);
        });
    }

    // Show All Projects by default the first time the workflow offcanvas opens
    document.addEventListener('DOMContentLoaded', function () {
        try {
            var oc = document.getElementById('offcanvasRight');
            if (!oc) return;
            oc.addEventListener('shown.bs.offcanvas', function () {
                if (!window.workflowInitDone) {
                    window.workflowInitDone = true;
                    openAllProjects();
                }
            });
        } catch (_) {}
    });
</script>

<!-- SweetAlert2 for delete confirmation -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Choices.js for beautiful selects -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css"/>
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

<style>
    /* Priority select compact look */
    .choices.choices--priority .choices__inner {
        background: transparent;
        border: none;
        min-height: 32px;
        padding: 2px 6px;
        font-size: 12px;
        color: #1b1b3a;
        box-shadow: none;
    }
    .choices.choices--priority[data-type*=select-one]::after {
        border-color: #9aa3b2 transparent transparent;
        right: 10px;
        margin-top: -5px;
    }
    .choices.choices--priority .choices__list--single .choices__item {
        color: #1b1b3a;
        font-weight: 600;
    }

    /* Developers multi-select pill chips */
    .choices.choices--developers .choices__inner {
        background: transparent;
        border: none;
        min-height: 32px;
        padding: 4px 6px;
        font-size: 12px;
        color: #1b1b3a;
        box-shadow: none;
    }
    .choices__list--multiple .choices__item {
        background-color: #eef7ff;
        border: 1px solid #cfe6ff;
        color: #1b1b3a;
        border-radius: 12px;
        margin: 2px 4px 2px 0;
        padding: 2px 8px;
        font-size: 12px;
        font-weight: 600;
    }
    .choices__list--dropdown,
    .choices__list[aria-expanded] {
        border-radius: 8px;
        box-shadow: 0 6px 18px rgba(0,0,0,0.08);
    }
    .choices__list--dropdown .choices__item--selectable.is-highlighted {
        background-color: #f3f4f6;
        color: #1b1b3a;
    }

    /* Dynamic horizontal slider for sections */
    .sections-scroll {
        -ms-overflow-style: none; /* IE/Edge */
        scrollbar-width: none;    /* Firefox */
        scroll-behavior: smooth;
        scroll-snap-type: x proximity;
        will-change: scroll-position;
    }
    .sections-scroll::-webkit-scrollbar {
        display: none;            /* Chrome/Safari */
    }
    .sections-scroll > span {
        scroll-snap-align: start;
        user-select: none;
    }

    /* Developer multi-select action buttons */
    .dev-actions {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-left: 4px;
    }
    .dev-action-btn {
        background: #f3f4f6;
        border: 1px solid #e5e7eb;
        color: #374151;
        border-radius: 8px;
        padding: 4px 8px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        user-select: none;
        white-space: nowrap;
    }
    .dev-action-btn:hover {
        background: #eaf3ff;
        border-color: #bfdbfe;
        color: #1f2937;
    }

    /* Native select fallback styling (when Choices.js not loaded) */
    select.priority-select,
    select.developer-select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 6px 28px 6px 10px;
        font-size: 12px;
        color: #1b1b3a;
    }
    select.developer-select {
        min-width: 180px;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Build teams data map for edit prefill
        window.teamsData = window.teamsData || {};
        @foreach(($teams ?? []) as $t)
            window.teamsData['{{ (string) ($t->_id ?? $t->id) }}'] = {
                id: '{{ (string) ($t->_id ?? $t->id) }}',
                title: {!! json_encode($t->title) !!},
                project_id: {!! json_encode((string)($t->project_id ?? '')) !!},
                pm_id: {!! json_encode($t->pm_id) !!},
                timeline_color: {!! json_encode($t->timeline_color) !!},
                banner_path: {!! json_encode($t->banner_path ? asset('storage/'.$t->banner_path) : null) !!},
                thumb_path: {!! json_encode($t->thumb_path ? asset('storage/'.$t->thumb_path) : null) !!},
                tickets: {!! json_encode((array) ($t->tickets ?? [])) !!},
                tasks: {!! json_encode((array) ($t->tasks ?? [])) !!},
                task_priorities: {!! json_encode($t->task_priorities ?? []) !!},
                task_developers: {!! json_encode($t->task_developers ?? []) !!}
            };
        @endforeach

        // Configure create vs edit on the same modal (#add_team)
        function configureCreateModal() {
            var form = document.getElementById('teamForm');
            if (!form) return;
            form.setAttribute('action', '{{ route('teams.store') }}');
            var methodInput = document.getElementById('teamFormMethod');
            if (methodInput) methodInput.value = '';
            window.currentEditingTeamId = null;
            var titleEl = document.getElementById('teamModalTitle');
            if (titleEl) titleEl.textContent = 'Add Team';

            var titleInput = form.querySelector('input[name="title"]');
            if (titleInput) titleInput.value = '';
            var projSelect = document.getElementById('addProjectSelect');
            if (projSelect) projSelect.value = '';
            var pmSelect = form.querySelector('select[name="pm_id"]');
            if (pmSelect) pmSelect.value = '';
            var tlSelect = form.querySelector('select[name="timeline_color"]');
            if (tlSelect) tlSelect.value = 'Timeline Color';

            // Clear previews
            var bannerPicker = document.getElementById('bannerInput') ? document.getElementById('bannerInput').previousElementSibling : null;
            if (bannerPicker) {
                var img = bannerPicker.querySelector('img');
                var tb = bannerPicker.querySelector('.text-box');
                if (img) img.style.display = 'none';
                if (tb) tb.style.display = 'block';
            }
            var thumbPicker = document.getElementById('thumbInput') ? document.getElementById('thumbInput').previousElementSibling : null;
            if (thumbPicker) {
                var img2 = thumbPicker.querySelector('img');
                var tb2 = thumbPicker.querySelector('.text-box');
                if (img2) img2.style.display = 'none';
                if (tb2) tb2.style.display = 'block';
            }

            var selectedTicketInput = document.getElementById('selectedTicketId');
            if (selectedTicketInput) selectedTicketInput.value = '';
            var tasksHidden = document.getElementById('tasksHiddenContainer');
            if (tasksHidden) tasksHidden.innerHTML = '';
        }

        // Smooth horizontal wheel scrolling for hidden-scrollbar sections
        document.querySelectorAll('.sections-scroll').forEach(function (el) {
            el.addEventListener('wheel', function (e) {
                if (e.deltaY === 0) return;
                e.preventDefault();
                el.scrollLeft += e.deltaY;
            }, { passive: false });
        });

        function configureEditModal(teamId, updateUrl) {
            var data = window.teamsData && window.teamsData[teamId] ? window.teamsData[teamId] : null;
            window.currentEditingTeamId = teamId;
            var form = document.getElementById('teamForm');
            if (!form) return;
            form.setAttribute('action', updateUrl || '');
            var methodInput = document.getElementById('teamFormMethod');
            if (methodInput) methodInput.value = 'PUT';
            var titleEl = document.getElementById('teamModalTitle');
            if (titleEl) titleEl.textContent = 'Edit Team';

            var titleInput = form.querySelector('input[name="title"]');
            if (titleInput) titleInput.value = data && data.title ? data.title : '';
            var projSelect = document.getElementById('addProjectSelect');
            if (projSelect) projSelect.value = data && data.project_id ? data.project_id : '';
            var pmSelect = form.querySelector('select[name="pm_id"]');
            if (pmSelect) pmSelect.value = data && data.pm_id ? data.pm_id : '';
            var tlSelect = form.querySelector('select[name="timeline_color"]');
            if (tlSelect) tlSelect.value = data && data.timeline_color ? data.timeline_color : 'Timeline Color';

            // Previews for banner/thumb
            var bannerPicker = document.getElementById('bannerInput') ? document.getElementById('bannerInput').previousElementSibling : null;
            if (bannerPicker) {
                var img = bannerPicker.querySelector('img');
                var tb = bannerPicker.querySelector('.text-box');
                if (img && data && data.banner_path) {
                    img.src = data.banner_path;
                    img.style.display = 'block';
                    if (tb) tb.style.display = 'none';
                } else {
                    if (img) img.style.display = 'none';
                    if (tb) tb.style.display = 'block';
                }
            }
            var thumbPicker = document.getElementById('thumbInput') ? document.getElementById('thumbInput').previousElementSibling : null;
            if (thumbPicker) {
                var img2 = thumbPicker.querySelector('img');
                var tb2 = thumbPicker.querySelector('.text-box');
                if (img2 && data && data.thumb_path) {
                    img2.src = data.thumb_path;
                    img2.style.display = 'block';
                    if (tb2) tb2.style.display = 'none';
                } else {
                    if (img2) img2.style.display = 'none';
                    if (tb2) tb2.style.display = 'block';
                }
            }

            var selectedTicketInput = document.getElementById('selectedTicketId');
            if (selectedTicketInput) {
                selectedTicketInput.value = (data && Array.isArray(data.tickets) && data.tickets.length) ? String(data.tickets[0]) : '';
            }
            var tasksHidden = document.getElementById('tasksHiddenContainer');
            if (tasksHidden) {
                tasksHidden.innerHTML = '';
                if (data && Array.isArray(data.tasks)) {
                    data.tasks.forEach(function (tid) {
                        var inp = document.createElement('input');
                        inp.type = 'hidden';
                        inp.name = 'tasks[]';
                        inp.value = String(tid);
                        tasksHidden.appendChild(inp);
                    });
                }
            }

            // Trigger ticket list refresh to reflect selected project and preferred ticket
            if (projSelect) {
                projSelect.dispatchEvent(new Event('change'));
            }
        }

        // When clicking any non-edit trigger for the Add Team modal, configure as create
        document.querySelectorAll('[data-bs-target="#add_team"]:not(.team-edit)').forEach(function (btn) {
            btn.addEventListener('click', function () {
                configureCreateModal();
            });
        });

        // Edit click handler uses the same modal
        document.querySelectorAll('.team-edit').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var teamId = this.getAttribute('data-team-id');
                var updateUrl = this.getAttribute('data-update-url');
                configureEditModal(teamId, updateUrl);
            });
        });

        document.querySelectorAll('.team-delete').forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                var teamId = this.getAttribute('data-team-id');
                if (!teamId) return;
                Swal.fire({
                    title: 'Delete this team?',
                    text: 'This action cannot be undone.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete'
                }).then(function (result) {
                    if (result.isConfirmed) {
                        var form = document.getElementById('delete-team-' + teamId);
                        if (form) form.submit();
                    }
                });
            });
        });
    });

</script>

@endsection