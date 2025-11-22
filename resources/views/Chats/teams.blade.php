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
                                            Project
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
                                            <img src="{{ !empty($team->project_logo_path) ? asset('storage/' . $team->project_logo_path) : URL::asset('/build/img/yekbon.svg') }}" alt="Logo" style="height: 32px; width: 32px; object-fit: cover;" />
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
                                        <div style="font-weight: bold;">Tickets</div>
                                        <div>{{ $ticketsCount }}</div>
                                    </div>
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
                                    <div class="d-flex justify-content-between px-1"
                                        style="font-size: 11px; color: #2e3a59; font-weight: 600; font-family: 'Segoe UI', sans-serif;">
                                        <div class="sections-scroll d-flex align-items-center gap-2" style="overflow-x: auto; white-space: nowrap; width: 100%; -ms-overflow-style: none; scrollbar-width: none;">
                                            @php
                                                $sections = $team->project_sections ?? [];
                                            @endphp
                                            @forelse($sections as $sec)
                                                <span style="background:#eef2f7; color:#2e3a59; padding:4px 8px; border-radius:10px; display:inline-block; white-space:nowrap;">{{ $sec }}</span>
                                            @empty
                                                <span style="background:#eef2f7; color:#2e3a59; padding:4px 8px; border-radius:10px; display:inline-block; white-space:nowrap;">Section</span>
                                            @endforelse
                                    </div>
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
    <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width: 630px; width: 98%;">
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
                    <h5 id="teamModalTitle" class="modal-title" style="font-weight: 700; font-size: 16px; color: #1b1b3a; margin: 0;">
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
            <form id="teamForm" action="{{ route('teams.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" id="teamFormMethod" value="">
            <div class="modal-body d-flex flex-column align-items-center justify-content-center" style="padding: 20px;">
                <!-- Upload Banner -->
                <div onclick="document.getElementById('bannerInput').click();" style="width: 100%; height: 120px; border: 2px dashed #ccc; border-radius: 10px; display: flex; justify-content: center; align-items: center; margin-bottom: 20px; cursor: pointer; position: relative; overflow: hidden; flex-direction: column;background:#FAFAFA">
                    <img style="max-height: 100%; max-width: 100%; display: none; position: absolute;" />
                    <div class="text-box" style="text-align: center;">
                        <div style="font-size: 24px; color: #888;">+</div>
                        <div style="font-size: 14px; color: #555; margin-top: 5px;">Upload banner</div>
                        <div style="font-size: 12px; color: #999;">JPG or PNG</div>
                    </div>
                </div>
                <input type="file" accept="image/*" id="bannerInput" name="banner" style="display: none;" onchange="this.previousElementSibling.querySelector('img').src = window.URL.createObjectURL(this.files[0]); this.previousElementSibling.querySelector('img').style.display='block'; this.previousElementSibling.querySelector('.text-box').style.display='none';">
                <!-- Sub Image Upload -->
                <div onclick="document.getElementById('thumbInput').click();"
                    style="width: 80px; height: 80px; border: 2px dashed #ccc; border-radius: 10px; display: flex; justify-content: center; align-items: center; cursor: pointer; position: relative; overflow: hidden; flex-direction: column;background:#FAFAFA">
                    <img style="max-height: 100%; max-width: 100%; display: none; position: absolute;" />
                    <div class="text-box" style="text-align: center;">
                        <div style="font-size: 20px; color: #888;">+</div>
                        <div style="font-size: 12px; color: #999;">JPG or PNG  </div>
                    </div>
                </div>
                <input type="file" accept="image/*" id="thumbInput" name="thumb" style="display: none;" onchange="this.previousElementSibling.querySelector('img').src = window.URL.createObjectURL(this.files[0]); this.previousElementSibling.querySelector('img').style.display='block'; this.previousElementSibling.querySelector('.text-box').style.display='none';">

                <!-- removed extra hidden file input -->

                <!-- Team Details Section -->
                <div class="container-fluid mt-2" style="background-color: #FAFAFA; border-radius: 10px; padding: 20px;">

                    <!-- Title & Subtitle -->
                    <div class="mb-3">
                        <h6 style="margin: 0; font-weight: 700; font-size: 14px; color: #1b1b3a;">Team Details</h6>
                        <p style="margin: 0; font-size: 12px; color: #888;">Manage your team</p>
                    </div>

                    <!-- Inputs Row (2 fields per row) -->
                    <div class="row g-2">
                        <!-- Row 1 -->
                        <div class="col-12 col-md-6">
                            <input type="text" class="form-control" name="title" placeholder="Team Title"
                                style="background-color: #fff; border: none; border-radius: 8px; font-size: 13px; color: #666;">
                        </div>
                        <div class="col-12 col-md-6">
                            <select class="form-select" id="addProjectSelect" name="project_id"
                                style="background-color: #fff; border: none; border-radius: 8px; font-size: 13px; color: #666;  background-size: 12px; appearance: none; -webkit-appearance: none; -moz-appearance: none; background-position: right 10px center;">
                                <option value="" selected>Select Project</option>
                                @isset($projects)
                                    @foreach($projects as $project)
                                        <option value="{{ (string) ($project->_id ?? $project->id) }}" @selected(request('project_id') == (string) ($project->_id ?? $project->id))>{{ $project->title }}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                        <!-- Row 2 -->
                        <div class="col-12 col-md-6">
                            <select class="form-select" name="pm_id"
                                style="background-color: #fff; border: none; border-radius: 8px; font-size: 13px; color: #666;  background-size: 12px; appearance: none; -webkit-appearance: none; -moz-appearance: none; background-position: right 10px center;">
                                <option selected>Select PM</option>
                                <option>PM A</option>
                                <option>PM B</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6">
                            <select class="form-select" name="timeline_color"
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
                    <div class="d-flex justify-content-start gap-2 p-2" style="background: #fff; border-radius: 10px;" id="addTicketContainer"></div>

                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const projectSelect = document.getElementById('addProjectSelect');
                        const container = document.getElementById('addTicketContainer');
                        const tasksContainer = document.getElementById('taskListContainer');
                        const selectedTicketInput = document.getElementById('selectedTicketId');
                        const tasksHiddenContainer = document.getElementById('tasksHiddenContainer');
                        let developersList = [];

                        // preload developers for multi-select
                        fetch('{{ url('/team/developers') }}', { credentials: 'same-origin' })
                            .then(r => r.ok ? r.json() : [])
                            .then(json => { developersList = Array.isArray(json) ? json : []; })
                            .catch(() => { developersList = []; });

                        function showMessage(msg) {
                            container.innerHTML = '';
                            const div = document.createElement('div');
                            div.style.color = '#7a7a9d';
                            div.style.fontSize = '12px';
                            div.textContent = msg;
                            container.appendChild(div);
                        }

                        function showTasksMessage(msg) {
                            if (!tasksContainer) return;
                            tasksContainer.innerHTML = '';
                            const div = document.createElement('div');
                            div.style.color = '#7a7a9d';
                            div.style.fontSize = '12px';
                            div.textContent = msg;
                            tasksContainer.appendChild(div);
                        }

                        function renderTickets(tickets) {
                            container.innerHTML = '';
                            if (!tickets || tickets.length === 0) {
                                showMessage('No tickets for this project');
                                return;
                            }
                            tickets.forEach(function (t, idx) {
                                const btn = document.createElement('button');
                                btn.type = 'button'; // avoid form submit on click
                                btn.className = 'btn';
                                btn.textContent = (t.title || '').trim() || '# Ticket';
                                btn.style.flex = '1 1 130px';
                                btn.style.borderRadius = '20px';
                                btn.style.padding = '6px 12px';
                                btn.style.fontWeight = '600';
                                btn.style.fontSize = '11px';
                                btn.dataset.ticketId = t.id || t._id || '';
                                // default style; we'll set active below based on selectedTicketInput
                                btn.style.backgroundColor = 'transparent';
                                btn.style.color = '#7a7a9d';
                                btn.addEventListener('click', function (e) {
                                    e.preventDefault();
                                    Array.from(container.children).forEach(function (child) {
                                        if (child.tagName === 'BUTTON') {
                                            child.style.backgroundColor = 'transparent';
                                            child.style.color = '#7a7a9d';
                                        }
                                    });
                                    btn.style.backgroundColor = '#47ca7a';
                                    btn.style.color = 'white';
                                    if (btn.dataset.ticketId) {
                                        if (selectedTicketInput) selectedTicketInput.value = btn.dataset.ticketId;
                                        fetchTasks(btn.dataset.ticketId);
                                    } else {
                                        showTasksMessage('No ticket id found for this item');
                                    }
                                });
                                container.appendChild(btn);
                            });
                            // Prefer a preselected ticket id (edit mode), else default to first
                            const preselectedId = selectedTicketInput && selectedTicketInput.value ? selectedTicketInput.value : '';
                            let targetBtn = preselectedId ? container.querySelector('button[data-ticket-id="' + preselectedId + '"]') : null;
                            if (!targetBtn) {
                                targetBtn = container.querySelector('button[data-ticket-id]');
                            }
                            if (targetBtn && targetBtn.dataset.ticketId) {
                                // set active styles
                                targetBtn.style.backgroundColor = '#47ca7a';
                                targetBtn.style.color = 'white';
                                if (selectedTicketInput) selectedTicketInput.value = targetBtn.dataset.ticketId;
                                fetchTasks(targetBtn.dataset.ticketId);
                            } else {
                                showTasksMessage('Select a ticket to view tasks');
                            }
                        }

                        function setHiddenTaskIds(tasks) {
                            if (!tasksHiddenContainer) return;
                            tasksHiddenContainer.innerHTML = '';
                            (tasks || []).forEach(function (t) {
                                const taskId = (t && (t.id || t._id)) ? (t.id || t._id) : null;
                                if (!taskId) return;
                                const input = document.createElement('input');
                                input.type = 'hidden';
                                input.name = 'tasks[]';
                                input.value = String(taskId);
                                tasksHiddenContainer.appendChild(input);
                            });
                        }

                        function renderTasks(tasks) {
                            if (!tasksContainer) return;
                            tasksContainer.innerHTML = '';
                            if (!tasks || tasks.length === 0) {
                                showTasksMessage('No tasks for this ticket');
                                setHiddenTaskIds([]);
                                return;
                            }
                            // store hidden ids for submit
                            setHiddenTaskIds(tasks);
                            tasks.forEach(function (task) {
                                const title = (task.title || 'Task Title');
                                const description = (task.description || 'Task description will be here');
                                const start = (task.start_date || '').toString().slice(0, 10);
                                const end = (task.end_date || '').toString().slice(0, 10);
                                const ticketTitle = (task.ticket && task.ticket.title) ? task.ticket.title : (task.ticket_title || 'Ticket Title');
                                const ticketCode = (task.ticket && task.ticket.code) ? task.ticket.code : (task.ticket_code || '#1');
                                const status = (task.status || '').toLowerCase();
                                const statusBg = status === 'in_delayed' || status === 'delayed' ? 'red'
                                                  : status === 'in_hold' || status === 'hold' ? '#F5A623'
                                                  : status === 'in_done' || status === 'done' ? '#00C853'
                                                  : status === 'in_progress' || status === 'progress' ? '#10B981'
                                                  : 'red';
                                const badgeText = (task.status || '01');

                                const card = `
                <!-- task1 -->
                <div class="container-fluid mt-2" style="background-color: #f4f4f4; border-radius: 10px; padding: 10px; display: flex; gap: 10px; flex-wrap: wrap; align-items: flex-start;">

                    <!-- Image / Icon -->
                    <div style="width: 70px; height: 100px; border-radius: 8px; overflow: hidden; background-color: #ccc; flex-shrink: 0;">
                        ${task.mark_image_path 
                            ? `<img src="/storage/${task.mark_image_path}" alt="icon" style="width: 100%; height: 100%; object-fit: cover;">`
                            : `<img src="{{URL::asset('/build/img/dooted img.svg')}}" alt="icon" style="width: 100%; height: 100%; object-fit: cover;">`
                        }
                    </div>

                    <!-- Content Area -->
                    <div style="flex: 1; display: flex; flex-direction: column; gap: 6px;">

                        <!-- Top Row: Title + Dropdowns -->
                        <div style="display: flex; justify-content: space-between; flex-wrap: nowrap; align-items: center;">

                            <!-- Titles -->
                            <div style="display: flex; align-items: center; gap: 8px;">

                                <!-- Logo Left (Project logo if available, else fallback) -->
                                ${task.project_logo_path 
                                    ? `<img src="/storage/${task.project_logo_path}" alt="Logo" style="height: 32px; width: 32px; flex-shrink: 0;" />`
                                    : `<img src="{{ URL::asset('/build/img/yekbon.svg') }}" alt="Logo" style="height: 32px; width: 32px; flex-shrink: 0;" />`
                                }

                                <!-- Title and Subtitle -->
                                <div>
                                    <div style="font-weight: 700; font-size: 14px; color: #1b1b3a;">${title}</div>
                                    <div style="font-size: 12px; color: #999;">${ticketCode} - ${ticketTitle}</div>
                                </div>

                            </div>


                            <!-- Dropdowns -->
                            <div style="display: flex; align-items: center; gap: 8px; margin-left: auto; background: white;border-radius:5px;padding:7px;">
                                <!-- Priority (low, medium, high) -->
                                <select class="priority-select" name="task_priorities[${task.id || task._id}]">
                                    <option value="" ${!task.priority ? 'selected' : ''}>Priority</option>
                                    <option value="low" ${(task.priority==='low') ? 'selected' : ''}>Low</option>
                                    <option value="medium" ${(task.priority==='medium') ? 'selected' : ''}>Medium</option>
                                    <option value="high" ${(task.priority==='high') ? 'selected' : ''}>High</option>
                                </select>
                                <!-- Developers multi-select (Choices.js tag style). Value is developer NAME -->
                                <select class="developer-select" multiple name="task_developers[${task.id || task._id}][]">
                                    ${developersList.map(d => `<option value="${d.name}">${d.name}</option>`).join('')}
                                </select>
                            </div>
                        </div>

                        <!-- Description -->
                        <div style="font-size: 12px; color: #7a7a9d;">
                            ${description}
                        </div>

                        <!-- Dates & Status Row -->
                        <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 10px;background:#fff;border-radius:10px;padding:5px;">

                            <!-- Dates -->
                            <div style="display: flex; gap: 10px; align-items: center; flex-wrap: nowrap;">

                                <!-- Start Date -->
                                <div style="font-size: 12px; color: #1ca672; display: flex; align-items: center; gap: 5px;">
                                    <strong>Start:</strong>
                                    <span style="color: #1b1b3a;">${start || '-'}</span>
                                    <img src="{{ URL::asset('/build/img/timeicon.svg') }}" style="width: 16px; height: 16px;" />
                                </div>
                                <!-- divider -->
                                <div style="width: 1px; height: 20px; background-color: #ccc;"></div>
                                <!-- Deliver Date -->
                                <div style="font-size: 12px; color: #00cc88; display: flex; align-items: center; gap: 5px;">
                                    <strong>Deliver:</strong>
                                    <span style="color: #1b1b3a;">${end || '-'}</span>
                                    <img src="{{ URL::asset('/build/img/timeicon.svg') }}" style="width: 16px; height: 16px;" />
                            </div>

                                <!-- Icon + Count (same row) -->
                                <div style="display: flex; align-items: center; gap: 6px; margin-left: 10px;">
                                <img src="{{ URL::asset('/build/img/tera.svg') }}" alt="⚡" style="width: 16px; height: 16px;">
                                    <div style="background-color: #ff4d4f; color: white; font-size: 12px; padding: 2px 8px; border-radius: 10px;">
                                        ${typeof task.issues_count === 'number' ? String(task.issues_count).padStart(2,'0') : '01'}
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                </div>
                `;
                                // append card
                                const wrapper = document.createElement('div');
                                wrapper.innerHTML = card;
                                const node = wrapper.firstElementChild;
                                tasksContainer.appendChild(node);

                                // Preselect values if editing
                                var currentTeamId = window.currentEditingTeamId || null;
                                var teamData = currentTeamId && window.teamsData ? window.teamsData[currentTeamId] : null;
                                var taskId = (task.id || task._id) || null;
                                var prePriority = teamData && teamData.task_priorities && taskId ? teamData.task_priorities[taskId] : null;
                                var preDevelopers = teamData && teamData.task_developers && taskId ? (teamData.task_developers[taskId] || []) : [];

                                if (prePriority) {
                                    const pSel = node.querySelector('select.priority-select');
                                    if (pSel) pSel.value = prePriority;
                                }
                                if (preDevelopers && preDevelopers.length) {
                                    const dSel = node.querySelector('select.developer-select');
                                    if (dSel) {
                                        Array.from(dSel.options).forEach(function(opt) {
                                            if (preDevelopers.includes(opt.value)) {
                                                opt.selected = true;
                                            }
                                        });
                                    }
                                }

                                // Enhance selects with Choices.js
                                try {
                                    const priorityEl = node.querySelector('select.priority-select');
                                    if (priorityEl && !priorityEl.dataset.enhanced) {
                                        new Choices(priorityEl, {
                                            removeItemButton: false,
                                            searchEnabled: false,
                                            placeholder: true,
                                            shouldSort: false,
                                            classNames: { containerOuter: 'choices choices--priority' }
                                        });
                                        priorityEl.dataset.enhanced = '1';
                                    }
                                    const devEl = node.querySelector('select.developer-select');
                                    if (devEl && !devEl.dataset.enhanced) {
                                        let devChoices = null;
                                        try {
                                            devChoices = new Choices(devEl, {
                                            removeItemButton: true,
                                            placeholder: true,
                                            placeholderValue: 'Developers',
                                            searchPlaceholderValue: 'Search developer',
                                            shouldSort: false,
                                            classNames: { containerOuter: 'choices choices--developers' }
                                            });
                                            devEl.dataset.enhanced = '1';
                                        } catch (errInit) {
                                            // Choices not available; fallback to native select
                                        }

                                        // Add 'Select all' and 'Clear' inline action buttons (works for both modes)
                                        const container = devEl.parentElement;
                                        if (container && !container.querySelector('.dev-actions')) {
                                            const actions = document.createElement('div');
                                            actions.className = 'dev-actions';
                                            const btnAll = document.createElement('span');
                                            btnAll.className = 'dev-action-btn';
                                            btnAll.textContent = 'Select all';
                                            const btnClear = document.createElement('span');
                                            btnClear.className = 'dev-action-btn';
                                            btnClear.textContent = 'Clear';
                                            actions.appendChild(btnAll);
                                            actions.appendChild(btnClear);
                                            container.appendChild(actions);

                                            btnAll.addEventListener('click', function (e) {
                                                e.preventDefault();
                                                const allValues = Array.from(devEl.options).map(function (o) { return o.value; });
                                                if (devChoices) {
                                                    try { devChoices.setChoiceByValue(allValues); } catch (err) {}
                                                } else {
                                                    // native fallback
                                                    Array.from(devEl.options).forEach(function (o) { o.selected = true; });
                                                    devEl.dispatchEvent(new Event('change', { bubbles: true }));
                                                }
                                            });
                                            btnClear.addEventListener('click', function (e) {
                                                e.preventDefault();
                                                if (devChoices) {
                                                    try { devChoices.removeActiveItems(); } catch (err) {}
                                                } else {
                                                    Array.from(devEl.options).forEach(function (o) { o.selected = false; });
                                                    devEl.dispatchEvent(new Event('change', { bubbles: true }));
                                                }
                                            });
                                        }
                                    }
                                } catch (e) {}
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

                        async function fetchTasks(ticketId) {
                            try {
                                if (!ticketId) { showTasksMessage('Select a ticket to view tasks'); return; }
                                const res = await fetch('{{ url('/team/tasks') }}?ticket_id=' + encodeURIComponent(ticketId), { credentials: 'same-origin' });
                                if (!res.ok) { renderTasks([]); return; }
                                const data = await res.json();
                                const tasks = Array.isArray(data) ? data : (data.tasks || []);
                                renderTasks(tasks);
                            } catch (e) {
                                renderTasks([]);
                            }
                        }

                        if (projectSelect) {
                            projectSelect.addEventListener('change', function () {
                                const pid = projectSelect.value;
                                if (pid) {
                                    fetchTickets(pid);
                                    showTasksMessage('Select a ticket to view tasks');
                                } else {
                                    showMessage('Select a project to view tickets');
                                    showTasksMessage('Select a project to view tasks');
                                }
                            });
                        }
                    });
                </script>

                <!-- Dynamic tasks will render here -->
                <div id="taskListContainer" class="w-100" style="min-height: 40px;"></div>
                <!-- Selected ticket hidden field for submit -->
                <input type="hidden" name="tickets[]" id="selectedTicketId" value="">
                <!-- Selected tasks (all listed for chosen ticket) -->
                <div id="tasksHiddenContainer"></div>
                

                <div style="display: flex;  justify-content: space-between; align-items: center; gap: 7px; margin-top: 16px;">

                    <!-- Left Warning Box -->
                    <div style="background-color: #feefef; color: #7a7a9d; border-radius: 10px; padding: 8px 14px; display: flex; align-items: center; font-size: 12px;">
                        <img src="{{ URL::asset('/build/img/tera.svg') }}" alt="⚡" style="width: 16px; height: 16px; margin-right: 8px;">
                        There some section not asigned yet
                    </div>

                    <!-- Right Save Button -->
                    <button type="submit"
                        style="background-color: #26c26c; color: white; font-weight: 600; font-size: 13px; padding: 10px 16px; border: none; border-radius: 8px; white-space: nowrap;">
                        + Save and create work flow
                    </button>

                </div>
                <!-- Modal Body -->



            </div>
            </form>

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
                                <option selected>Select PM</option>
                                <option>PM A</option>
                                <option>PM B</option>
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
                    <button type="submit"
                        style="background-color: #26c26c; color: white; font-weight: 600; font-size: 13px; padding: 10px 16px; border: none; border-radius: 8px; white-space: nowrap;">
                        Save changes
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

    /* Hide scrollbar but keep horizontal scrolling for sections list */
    .sections-scroll {
        -ms-overflow-style: none; /* IE/Edge */
        scrollbar-width: none;    /* Firefox */
    }
    .sections-scroll::-webkit-scrollbar {
        display: none;            /* Chrome/Safari */
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
            if (pmSelect) pmSelect.value = 'Select PM';
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
            if (pmSelect) pmSelect.value = data && data.pm_id ? data.pm_id : 'Select PM';
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