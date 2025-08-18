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

    <div style="visibility: visible;">
        @include('Chats.chatsidebar')
    </div>

    <div class="chat chat-messages show" id="middle" style="overflow-y: hidden;">
        <div>
            <div class="chat-header">
                <div class="user-details">
                    <div class="d-xl-none">
                        <a class="text-muted chat-close me-2" href="#">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                    <div class="avatar avatar-lg online" style="visibility: visible;">
                        <img src="{{ asset('build/img/groups/group-01.jpg') }}" class="rounded-circle" alt="image">

                    </div>
                    <div class="d-flex align-items-center">
                        <!-- Image -->
                        <img src="{{ asset('build/img/groups/group-01.jpg') }}" style="width: 50px; height: 50px;margin-left:30px;" class="rounded-circle me-3" alt="User Image">

                        <!-- Username and Status -->
                        <div class="overflow-hidden">
                            <h6 class="mb-0">Username</h6>
                            <p class="last-seen text-truncate mb-0">Online</p>
                        </div>
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
            <div style="overflow-y: auto;flex:1;height: 90vh;">
                <div class="chat-body chat-page-group">
                    <!-- Header -->
                    <!-- Main Layout -->
                    <div class="container-fluid mt-3" style="padding-left: 85px;">
                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-lg-9">
                                <div class="container-fluid" style="background:#fff;">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="col-md-8 d-flex align-items-center">
                                            <img src="{{ asset('build/img/groups/group-01.jpg') }}" style="width: 50px; height: 50px;" class="rounded-circle me-3" alt="User Image">
                                            <div>
                                                <h6 style="margin:0;">Welcome Back, <b>Admin Name</b></h6>
                                                <small>
                                                    Dear <b>"Admin name"</b> u have for today
                                                    <span style="color:red; font-weight:600;">12 Messages</span>,
                                                    and <span style="color:#e75480; font-weight:600;">5 Meetings</span>,
                                                    and <span style="color:#e75480; font-weight:600;">3 ToDo’s</span>,
                                                    and <span style="color:#d9534f; font-weight:600;">3 Private Tasks</span>.
                                                </small>
                                            </div>
                                        </div>

                                        <!-- Right Side Buttons -->
                                        <div class="col-md-4 d-flex justify-content-end">
                                            <button class="btn btn-primary btn-sm me-2">+ Add Project</button>
                                            <button class="btn btn-danger btn-sm me-2">+ Add ToDo’s</button>
                                            <button class="btn btn-success btn-sm">+ Add Meeting</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Our Projects -->
                                <div class="row g-3 pt-3">
                                    <div class="col-md-4">
                                        <div class="card p-3 text-center" style="border-radius:12px; background:#fff;">
                                            <h6>Project Title</h6>
                                            <p class="text-muted">Some description...</p>
                                            <div class="d-flex justify-content-between">
                                                <span>Total Tasks: 12</span>
                                                <span>Completed: 5</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card p-3 text-center" style="border-radius:12px; background:#fff;">
                                            <h6>Project Title</h6>
                                            <p class="text-muted">Some description...</p>
                                            <div class="d-flex justify-content-between">
                                                <span>Total Tasks: 20</span>
                                                <span>Completed: 10</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card p-3 text-center" style="border-radius:12px; background:#fff;">
                                            <h6>Project Title</h6>
                                            <p class="text-muted">Some description...</p>
                                            <div class="d-flex justify-content-between">
                                                <span>Total Tasks: 15</span>
                                                <span>Completed: 8</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Calendar + Clock -->
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="card p-4" style="border-radius:16px; background:#f4f4f4;">

                                            <!-- Top Date and Time -->
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                    <h1 style="font-size:64px; font-weight:700; margin:0; color:#0f1b3d;">10</h1>
                                                    <p style="font-size:24px; font-weight:600; margin:-10px 0 0; color:#0f1b3d;">Sep 2025</p>
                                                </div>
                                                <div style="font-size:24px; font-weight:500; color:#0f1b3d;" id="clock">
                                                    <script>
                                                        document.write(new Date().toLocaleTimeString('en-GB'));
                                                        setInterval(function() {
                                                            document.getElementById('clock').innerText = new Date().toLocaleTimeString('en-GB');
                                                        }, 1000);
                                                    </script>
                                                </div>
                                            </div>

                                            <!-- Calendar Days -->
                                            <div class="d-flex align-items-center mt-4 px-1" style="overflow-x:auto; gap:12px;">

                                                <!-- Active Day -->
                                                <div style="text-align:center; background:#ff3d3d; color:white; border-radius:16px; width:60px; padding:10px;">
                                                    <div style="font-weight:600;">Mon</div>
                                                    <div style="font-size:18px;">10</div>
                                                </div>

                                                <!-- Other Days -->
                                                <div style="text-align:center; background:#ffffff; color:#000; border-radius:16px; width:60px; padding:10px;">
                                                    <div style="font-weight:600;">Tue</div>
                                                    <div style="font-size:18px;">11</div>
                                                </div>
                                                <div style="text-align:center; background:#ffffff; color:#000; border-radius:16px; width:60px; padding:10px;">
                                                    <div style="font-weight:600;">Wed</div>
                                                    <div style="font-size:18px;">12</div>
                                                </div>
                                                <div style="text-align:center; background:#ffffff; color:#000; border-radius:16px; width:60px; padding:10px;">
                                                    <div style="font-weight:600;">Thu</div>
                                                    <div style="font-size:18px;">13</div>
                                                </div>
                                                <div style="text-align:center; background:#ffffff; color:#000; border-radius:16px; width:60px; padding:10px;">
                                                    <div style="font-weight:600;">Fri</div>
                                                    <div style="font-size:18px;">14</div>
                                                </div>
                                                <div style="text-align:center; background:#ffffff; color:#000; border-radius:16px; width:60px; padding:10px;">
                                                    <div style="font-weight:600;">Sat</div>
                                                    <div style="font-size:18px;">15</div>
                                                </div>
                                                <div style="text-align:center; background:#ffffff; color:#000; border-radius:16px; width:60px; padding:10px;">
                                                    <div style="font-weight:600;">Sun</div>
                                                    <div style="font-size:18px;">17</div>
                                                </div>
                                                <div style="text-align:center; background:#ffffff; color:#000; border-radius:16px; width:60px; padding:10px;">
                                                    <div style="font-weight:600;">Mon</div>
                                                    <div style="font-size:18px;">18</div>
                                                </div>
                                                <div style="text-align:center; background:#ffffff; color:#000; border-radius:16px; width:60px; padding:10px;">
                                                    <div style="font-weight:600;">Tue</div>
                                                    <div style="font-size:18px;">19</div>
                                                </div>
                                            </div>

                                            <!-- Buttons -->
                                            <div class="d-flex justify-content-end mt-4 gap-2">
                                                <button style="background:#00c389; border:none; border-radius:8px; padding:5px 15px; color:white;">All</button>
                                                <button style="background:#ffffff; border:none; border-radius:8px; padding:5px 15px;">Meeting</button>
                                                <button style="background:#ffffff; border:none; border-radius:8px; padding:5px 15px;">ToDo’s</button>
                                            </div>
                                            <div class="card p-3" style="border-radius:16px; background:#f6f9fc;">

                                                <!-- Top Row -->
                                                <div class="d-flex justify-content-between align-items-start flex-wrap">

                                                    <!-- Left: Title and Info -->
                                                    <div class="d-flex flex-column flex-grow-1" style="min-width:250px;">
                                                        <!-- Title Row -->
                                                        <div class="d-flex align-items-center mb-2">
                                                            <img src="https://via.placeholder.com/35" style="border-radius:50%; width:35px; height:35px; object-fit:cover; margin-right:10px;">
                                                            <div>
                                                                <div style="font-weight:600; color:#0f1b3d;">Title of Meeting</div>
                                                                <div style="font-size:13px; color:#888;">Username</div>
                                                            </div>
                                                        </div>

                                                        <!-- Project Row -->
                                                        <div class="d-flex align-items-center mb-2">
                                                            <img src="https://via.placeholder.com/24x24.png?text=📁" style="width:24px; height:24px; margin-right:8px;">
                                                            <div>
                                                                <div style="font-weight:600; font-size:14px;">Project Title</div>
                                                                <div style="font-size:12px; color:#999;">1 Oct 25</div>
                                                            </div>
                                                        </div>

                                                        <!-- Description -->
                                                        <div style="font-size:14px; color:#333; margin-bottom:10px;">
                                                            Here we will add the description of the ToDo. Only <br>
                                                            you is Super admin ToDo.
                                                        </div>

                                                        <!-- Tags Row -->
                                                        <div class="d-flex align-items-center gap-2 flex-wrap">
                                                            <button style="background:#ffd5d5; color:red; border:none; font-size:13px; border-radius:6px; padding:2px 10px;">🔴</button>
                                                            <button style="background:#ffd5d5; color:red; border:none; font-size:13px; border-radius:6px; padding:2px 10px;">Now</button>
                                                            <button style="background:#ffe9e9; color:#cc0000; border:none; font-size:13px; border-radius:6px; padding:2px 10px;">17:00 - 18:00</button>
                                                        </div>
                                                    </div>

                                                    <!-- Right: Actions and Avatars -->
                                                    <div class="d-flex flex-column align-items-end justify-content-between" style="gap:10px;">
                                                        <!-- Zoom Meeting Button -->
                                                        <button style="background:#007bff; color:#fff; border:none; border-radius:6px; padding:5px 10px; font-size:13px;">Zoom Meeting</button>

                                                        <!-- Avatars -->
                                                        <div class="d-flex align-items-center justify-content-end mt-2" style="gap:-10px;">
                                                            <img src="https://via.placeholder.com/30" style="border-radius:50%; border:2px solid #fff; width:30px; height:30px; object-fit:cover;">
                                                            <img src="https://via.placeholder.com/30" style="border-radius:50%; border:2px solid #fff; width:30px; height:30px; object-fit:cover;">
                                                            <img src="https://via.placeholder.com/30" style="border-radius:50%; border:2px solid #fff; width:30px; height:30px; object-fit:cover;">
                                                            <img src="https://via.placeholder.com/30" style="border-radius:50%; border:2px solid #fff; width:30px; height:30px; object-fit:cover;">
                                                        </div>

                                                        <!-- Join Button -->
                                                        <button style="background:#00c389; color:white; border:none; font-size:13px; border-radius:6px; padding:5px 15px;">Join now ✅</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card p-3" style="border-radius:12px; background:#fff;">
                                            <h6>Reminders</h6>
                                            <ul>
                                                <li>Meeting with Team</li>
                                                <li>Submit Report</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- Right Column -->
                            <div class="col-lg-3">
                                <!-- System Logs -->
                                <div class="card p-3 mb-3" style="border-radius:12px; background:#fff;">
                                    <h6>System Logs</h6>
                                    <ul class="small">
                                        <li>Login Time: 12:30</li>
                                        <li>Logout Time: 18:00</li>
                                    </ul>
                                </div>

                                <!-- Team -->
                                <div class="card p-3" style="border-radius:12px; background:#fff;">
                                    <h6>Our Team</h6>
                                    <div class="d-flex flex-wrap">
                                        <div class="text-center m-2">
                                            <img src="https://via.placeholder.com/40" class="rounded-circle">
                                            <p style="margin:0; font-size:12px;">Name</p>
                                        </div>
                                        <div class="text-center m-2">
                                            <img src="https://via.placeholder.com/40" class="rounded-circle">
                                            <p style="margin:0; font-size:12px;">Name</p>
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

</div>






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