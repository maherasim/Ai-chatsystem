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

    .btn-plus{
    background-color: #22c55e;
  border: 1px solid #22c55e;
  color: #FFF;
}
.btn-plus span{
    border: solid 1px;
  border-radius: 50%;
  width: 22px;
  height: 22px;
  display: block;
}
.btn-minus{
    background-color: #FD3A55;
  border: 1px solid #FD3A55;
  color: #FFF;

}
.btn-minus span{
    border: solid 1px;
  border-radius: 50%;
  width: 22px;
  height: 22px;
  display: block;
}

.overlap-container {
        display: flex;
    }

    .overlap-container img {
        width: 30px;          /* Adjust size */
        height: 30px;
        border-radius: 50%;   /* Make circular */
        border: 2px solid #fff;
        object-fit: cover;
        margin-left: -14px;   /* Creates the overlap */
        box-shadow: 0 0 2px rgba(0,0,0,0.3);
    }

    .overlap-container img:first-child {
        margin-left: 0;
    }

.priority-txt{
        color: #4caf50; 
        font-weight: 500; 
        background:#f2f2f2; 
        padding:2px 5px; 
        border-radius:5px;
    }
    .priority-txt.middle{
        color: #fbbc05;
    }
    .priority-txt.high{
        color: #e64241;
    }
    .priority-txt.schduled{
        color: #1b75bc;
    }
    .priority-icon{
        width: 8px; 
        height: 8px; 
        background-color: #4caf50; 
        border-radius: 50%; 
        display:inline-block;
    }
    

    .priority-txt.middle .priority-icon{
        background-color: #fbbc05;
    }
    .priority-txt.high .priority-icon{
        background-color: #e64241;
    }

    .priority{
        border: medium;
        background-color: white;
        color: rgb(100, 116, 139);
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 12px;
    }
    .priority.active{
        background-color: rgb(34, 197, 94);
        color: white;
    }

.reminder-btn, .time-btn {
    border: none;
    background-color: white;
    color: #64748b;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 12px;
    width: 80px;;
}
.reminder-btn.active {
    background-color: #22c55e;
    color: white;
}

.time-btn.active {
    background-color: #22c55e;
    color: white;
}

.user_div {
    flex: 0 0 auto;                    /* don't shrink */
    width: 160px;                      /* each card fixed width */
    border: 1px solid #ddd;
    border-radius: 10px;
    background: #fff;
    padding: 10px;
    cursor: pointer;
}
.user_div{
        cursor:pointer;
    }

    .user_active{
        border:solid 1px #62c728ff;
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

     .timeselect{
        border: none;
        font-size: 13px;
        color: #333;
        background: transparent;
        width: 100%;
        outline: none;
        padding-right: 25px; /* space for icon */
        appearance: none; /* hide default arrow */
        -webkit-appearance: none;
        -moz-appearance: none;
        background-image: url('https://cdn-icons-png.flaticon.com/512/2088/2088617.png'); /* clock icon */
        background-repeat: no-repeat;
        background-position: right 8px center;
        background-size: 15px;
        cursor: pointer;
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
                                <strong>Reminders: {{count($todayMeetings)}}</strong>
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
                            
                                @forelse($todayMeetings as $index => $meeting)

                                @php

                                $isLocal = request()->getHost() === '127.0.0.1' || request()->getHost() === 'localhost';

                                if ($isLocal) {
                                    $imageUrl = asset('storage/' . $meeting->user->profile_image);
                                } else {
                                    $domain = ($meeting->user->is_admin == 1 || in_array($meeting->user->type, ['admin', 'subadmin']))
                                        ? 'https://admin.onlinesystems.info'
                                        : 'https://team.onlinesystems.info';

                                    $imageUrl = $domain . '/storage/' . $meeting->user->profile_image;
                                }

                                @endphp
                            <!-- Start of Card 1 -->
                             <div class="col-12 col-sm-6 col-lg-3">
                                <div class="card" style=" height:fit-content; border: 1px solid #c0c0c0; border-radius: 12px; font-family: 'Segoe UI', sans-serif; box-shadow: 0 2px 6px rgba(0,0,0,0.05); overflow: hidden;">

                                    <!-- Header -->
                                    <div class="d-flex justify-content-between align-items-start p-2">
                                        <div class="d-flex align-items-center">
                                            <img src="{{$imageUrl}}" class="rounded-circle me-2" style="width: 40px; height: 40px;">
                                            <div>
                                                <h6 class="m-0 fw-bold" style="font-size: 13px; color: #1e293b;">{{ $meeting->title }}</h6>
                                                <small style="color: #6b7280; font-size: 11px;">Project Title</small>
                                            </div>
                                        </div>
                                        <span class="priority-txt {{$meeting->priority}}">
                                            <span class="priority-icon" ></span>
                                            {{$meeting->priority}}
                                        </span>
                                    </div>

                                    <!-- Description -->
                                    <div class="px-3 pt-1 pb-0" style="font-size: 12px; color: #6b7280; line-height: 1.4;">
                                        {{$meeting->description}}
                                    </div>

                                    <!-- Avatars + user count -->
                                    <div class="text-center mt-2">
                                        <div style="position: relative; display: inline-block; height: 40px; width: 108px;">
                                            <div class="overlap-container">
                                                            @foreach($meeting->members_data as $mem)
                                                                <img src="{{ $mem['image']}}">
                                                            @endforeach
                                            </div>
                                       
                                        </div>
                                        <div style="font-size: 12px; color: #1e293b; font-weight: 500;">1 user online</div>
                                    </div>

                                    <!-- Status Row -->
                                    <div class="d-flex align-items-center justify-content-between px-3 py-2 mt-2" style="font-size: 12px; border-radius: 10px; background: #f8f8f8;">
                                        <!-- Green dot -->
                                        

                                        <!-- Divider -->
                                        <div style="width: 1px; height: 16px; background-color: #e0e0e0;"></div>

                                        <!-- Bell Icon -->
                                        <img src="{{URL::asset('/build/img/bell.svg')}}" alt="Image" style="width: 20px;height:20px;" class="rounded-circle">

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
                                            <span style="color: #ef4444;">{{$meeting->start_time}} - {{$meeting->end_time}}</span>
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
                             @empty
                             
                             @endforelse

                            </div>
                        
                        <!-- meeting todo -->
                        <div class="project-succes pt-2 pb-2 d-flex justify-content-between align-items-center">
                            <div>
                                <h3 style="margin: 0;">Meetings Events</h3>
                                <strong>Events: {{count($upcomingMeetings)}}</strong>
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

                            @forelse($upcomingMeetings as $index => $meeting)

                                @php

                                $isLocal = request()->getHost() === '127.0.0.1' || request()->getHost() === 'localhost';

                                if ($isLocal) {
                                    $imageUrl = asset('storage/' . $meeting->user->profile_image);
                                } else {
                                    $domain = ($meeting->user->is_admin == 1 || in_array($meeting->user->type, ['admin', 'subadmin']))
                                        ? 'https://admin.onlinesystems.info'
                                        : 'https://team.onlinesystems.info';

                                    $imageUrl = $domain . '/storage/' . $meeting->user->profile_image;
                                }

                                @endphp
                                 <!-- Start of Card 1 -->
                             <div class="col-12 col-sm-6 col-lg-3">
                                <div class="card" style=" height:fit-content; border: 1px solid #c0c0c0; border-radius: 12px; font-family: 'Segoe UI', sans-serif; box-shadow: 0 2px 6px rgba(0,0,0,0.05); overflow: hidden;">

                                    <!-- Header -->
                                    <div class="d-flex justify-content-between align-items-start p-2">
                                        <div class="d-flex align-items-center">
                                            <img src="{{$imageUrl}}" class="rounded-circle me-2" style="width: 40px; height: 40px;">
                                            <div>
                                                <h6 class="m-0 fw-bold" style="font-size: 13px; color: #1e293b;">{{ $meeting->title }}</h6>
                                                <small style="color: #6b7280; font-size: 11px;">Project Title</small>
                                            </div>
                                        </div>
                                        <span class="priority-txt {{$meeting->priority}}">
                                            <span class="priority-icon" ></span>
                                            {{$meeting->priority}}
                                        </span>
                                    </div>

                                    <!-- Description -->
                                    <div class="px-3 pt-1 pb-0" style="font-size: 12px; color: #6b7280; line-height: 1.4;">
                                        {{$meeting->description}}
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
                                        <span style="color: #e53935; font-weight: 500;">{{ \Carbon\Carbon::parse($meeting->start_date)->format('D. d.m.Y') }}</span>

                                        <!-- Divider -->
                                        <div style="width: 2px; height: 16px; background-color: #e0e0e0;"></div>

                                        <!-- Clock + Time -->
                                        <div class="d-flex align-items-center gap-1">
                                            <img src="{{URL::asset('/build/img/Clock.svg')}}" alt="Image" style="width: 16px;height:16px;">
                                            <span style="color: #e53935; font-weight: 500;">{{$meeting->start_time}} - {{$meeting->end_time}}</span>
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

                            @empty
                             
                             @endforelse

       
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
            

            <form  id="meetingForm" action="{{ route('meetings.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

            <input type="hidden" name="todo_id" id="todo_id">
                <input type="hidden" name="start_date" id="startDateHidden">
                <input type="hidden" name="start_time" id="startTimeHidden">
                <input type="hidden" name="end_time" id="endTimeHidden">
                <input type="hidden" name="end_date" id="endDateHidden">
                <input type="hidden" name="is_private" id="isPrivateHidden" value="0">
                <input type="hidden" name="todo_visibility" id="todo_visibility">
                <input type="hidden" name="selected_user" id="selected_user">
                <input type="hidden" name="priority" id="priorityHidden" >
                <input type="hidden" name="reminder" id="reminderHidden" >
                <input type="hidden" name="todaytime" id="timeHidden" >
                 <input type="hidden" name="todo_type" id="todo_type">

                 <select id="members" name="members[]" multiple style="display:none;"></select>

            <div class="modal-body p-4" style="background-color: white;">
                <!-- Header -->
                <h5 style="font-weight: 600; color: #1e293b;">Scheduled a Meeting</h5>
                <p style="color: #64748b; font-size: 14px;">Connect your Team</p>

                
                <!-- Schedule Type Toggle -->
                <div style="background-color: #f9f9fb; border-radius:10px; padding:0px 5px;">
                    <!-- Toggle Buttons -->
                    <div style="display: flex;  padding:10px; margin-bottom: 6px; margin-top: 4px;">
                        <div style="border-radius: 10px; padding: 4px; display: flex; gap: 8px; background:#fff;">
                            <button type="button" id="btnToday"
                                onclick="
                    this.style.backgroundColor='#22c55e';
                    this.style.color='white';
                    document.getElementById('btnScheduled').style.backgroundColor='transparent';
                    document.getElementById('btnScheduled').style.color='#64748b';
                    document.getElementById('schdule_time').style.display='none';
                    document.getElementById('timeToday').style.display='block';
                    document.getElementById('todo_type').value='today';
                    document.getElementById('timeRow').classList.add('justify-content-center');"
                                style="border: none; background-color: #22c55e; color: white; padding: 6px 12px; border-radius: 6px; font-size: 13px; font-weight: 500;">
                                Meeting Today
                            </button>

                            <button type="button" id="btnScheduled"
                                onclick="
                    this.style.backgroundColor='#22c55e';
                    this.style.color='white';
                    document.getElementById('btnToday').style.backgroundColor='transparent';
                    document.getElementById('btnToday').style.color='#64748b';
                    document.getElementById('schdule_time').style.display='flex';
                    document.getElementById('timeToday').style.display='none';
                    document.getElementById('todo_type').value='scheduled';
                    document.getElementById('timeRow').classList.remove('justify-content-center');"
                                style="border: none; background-color: transparent; color: #64748b; padding: 6px 12px; border-radius: 6px; font-size: 13px; font-weight: 500;">
                                Scheduled Meeting
                            </button>
                        </div>
                    </div>

                    <!-- Date & Time Fields -->
                    <div class="row g-2 align-items-center mb-3 justify-content-center" id="timeRow" style="padding-bottom: 4px; display: flex;">

                        <!-- Start Date (hidden by default) -->

                        <!-- selection of tody section -->
                    <div class="d-flex1 gap-2 mb-3 bg-white" id="timeToday" style="padding: 8px;";>
                        <button type="button" class="time-btn time-btn-2 " data-value="2">2 Hour</button>
                        <button type="button" class="time-btn time-btn-3" data-value="3">3 Hour</button>
                        <button type="button" class="time-btn time-btn-6" data-value="6">6 Hour</button>
                        <button type="button" class="time-btn time-btn-9" data-value="9">9 Hour</button>
                        <button type="button" class="time-btn time-btn-12" data-value="12">12 Hour</button>
                    </div>
                    
                    <div id="schdule_time" style="display:none;">

                        <div class="col-md-4" id="startDateField" style="position: relative;">
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
                            <div style="background-color: #fff; border-radius: 12px; padding: 2px 10px; width: 100%; border: 1px solid #e0e0e0; height: 45px; display: flex; flex-direction: column; justify-content: center;">
                                
                            <select name="start_time" id="startTimeSelect" class="timeselect" >
                                    <option value="">Start Time</option>
                                    @for ($h = 0; $h < 24; $h++)
                                        @php $time = sprintf("%02d:00", $h); @endphp
                                        <option value="{{ $time }}">{{ $time }}</option>
                                        @php $time = sprintf("%02d:30", $h); @endphp
                                        <option value="{{ $time }}">{{ $time }}</option>
                                    @endfor
                                </select>
                                <!--
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
                            -->


                            </div>
                        </div>
                        <!-- End Time -->
                        <div class="col-md-4" style="position: relative;">
                            <div style="background-color: #fff; border-radius: 12px; padding: 2px 16px; width: 100%; border: 1px solid #e0e0e0; height: 45px; display: flex; flex-direction: column; justify-content: center;">
                                
                            
                                <select name="end_time" id="endTimeSelect" class="timeselect" >
                                    <option value="">End Time</option>
                                    @for ($h = 0; $h < 24; $h++)
                                        @php $time = sprintf("%02d:00", $h); @endphp
                                        <option value="{{ $time }}">{{ $time }}</option>
                                        @php $time = sprintf("%02d:30", $h); @endphp
                                        <option value="{{ $time }}">{{ $time }}</option>
                                    @endfor
                                </select>

                            </div>
                        </div>

                    </div>


                        
                    </div>
                </div>

                <div style="background-color: #f9f9fb; border-radius: 12px; padding: 16px; margin-bottom: 16px;">
                    <!-- Heading and Subtext -->
                    <div class="row">
                        <div style="margin-bottom: 12px;" class="col-md-6">
                            <p style="font-weight: 600; font-size: 14px; color: #1e293b; margin: 0;">Meeting Details</p>
                            <p style="font-size: 12px; color: #64748b; margin: 0;">About the meeting</p>
                        </div>
                        <div class="col-md-6">
                            <p style="font-size: 12px; font-weight: 600; color: #334155;margin-bottom: 2px;">Meeting Priority</p>
                                <p style="font-size: 11px; color: #6b7280;margin-bottom: 8px;">Set the priority of the Meeting</p>
                                

                        </div>
                    </div>

                    <!-- Inputs -->
                    <div class="row g-2">
                        <div class="col-md-6">
                            <input id="meeting_name" name="title" required type="text" class="form-control" placeholder="Meeting Title"
                                style="font-size: 13px; background-color: white; border-radius: 8px;">
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex1 gap-2 bg-white">
                                <button class="priority active1" type="button" id="priorityLow" >Low</button>
                                <button class="priority" type="button" id="priorityMiddle" >Middle</button>
                                <button class="priority" type="button" id="priorityHigh" >High</button>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="row g-2 mt-2" id="sectionsWrapper">
                        <div class="col-md-12 d-flex align-items-center section-item">
                            <input name="sections" type="text" class="form-control" placeholder="Describe the Meeting"
                                style="font-size: 13px; background-color: white; border-radius: 8px;">
                            
                        </div>
                    </div>


                </div>

                <!-- shared section starts -->
                <div class="mb-3" id="selectUsersBox" style="background-color: #f9f9fb; border-radius:10px; padding:16px;">
                    
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <select id="select_project" class="form-control selection">
                                <option value="">Select Project</option>
                                <option value="1">Project1</option>
                                <option value="2">Project2</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select id="select_team" class="form-control selection">
                                <option value="">Select Team</option>
                                <option value="1">Team 1</option>
                                <option value="2">Team 2</option>
                            </select>
                        </div>
                        
                    </div>
                    <h5>Select Users</h5>
                    <p>Project - Team</p>

                    <div id="userScroller" class="user-slider-wrapper" style="display: flex; gap: 16px; overflow-x: auto; scroll-behavior: smooth; padding-bottom: 16px; -ms-overflow-style: none; scrollbar-width: none;" onscroll=" var scroller=this; var containerWidth=scroller.offsetWidth; var index=Math.round(scroller.scrollLeft/containerWidth); for(var i=0;i&lt;3;i++){ var dot=document.getElementById('dot'+i); dot.style.background=(i===index)?'#00c469':'#d4d4d4'; dot.style.width=(i===index)?'40px':'20px'; } ">

                            <style>
                                #userScroller::-webkit-scrollbar {
                                    display: none;
                                }
                            </style>

                            @foreach($users as $cuser)
                                <div class="user_div" 
                                    id="user_{{$cuser->_id}}" 
                                    data-user-id="{{$cuser->_id}}">
                                    <div class="invit-img">
                                        <img src="{{ asset('storage/' . $cuser->profile_image) }}" />
                                    </div>
                                    <div class="invit-txt">{{$cuser->name}}</div>
                                </div>
                            @endforeach

                        </div>
                        <div style="display: flex; justify-content: center; gap: 10px; margin-top: 10px;">
                            <div id="dot_user0" style="width: 40px; height: 5px; border-radius: 8px; background: #00c469; cursor: pointer;" onclick=" var scroller=document.getElementById('userScroller'); var containerWidth=scroller.offsetWidth; scroller.scrollTo({left:0*containerWidth,behavior:'smooth'}); for(var i=0;i&lt;3;i++){ var dot=document.getElementById('dot_user'+i);  dot.style.background=(i===0)?'#00c469':'#d4d4d4';  dot.style.width=(i===0)?'40px':'20px'; } ">
                            </div>
                            <div id="dot_user1" style="width: 20px; height: 5px; border-radius: 8px; background: #d4d4d4; cursor: pointer;" onclick=" var scroller=document.getElementById('userScroller'); var containerWidth=scroller.offsetWidth; scroller.scrollTo({left:1*containerWidth,behavior:'smooth'}); for(var i=0;i&lt;3;i++){ var dot=document.getElementById('dot_user'+i); dot.style.background=(i===1)?'#00c469':'#d4d4d4'; dot.style.width=(i===1)?'40px':'20px'; } ">
                            </div>
                            <div id="dot_user2" style="width: 20px; height: 5px; border-radius: 8px; background: #d4d4d4; cursor: pointer;" onclick=" var scroller=document.getElementById('userScroller'); var containerWidth=scroller.offsetWidth; scroller.scrollTo({left:2*containerWidth,behavior:'smooth'}); for(var i=0;i&lt;3;i++){ var dot=document.getElementById('dot_user'+i); dot.style.background=(i===2)?'#00c469':'#d4d4d4'; dot.style.width=(i===2)?'40px':'20px'; } ">
                            </div>
                        </div>

                    <!-- user starts -->

    </div>


                <!-- Meeting Links -->
                <!-- Link Toggle Section -->
                <div style="background-color: #f9f9fb; border-radius: 10px; padding: 12px; display: flex; flex-direction: column; align-items: center; width: 100%; max-width: 400px; margin: auto;margin-bottom: 12px;">

                    <div style="display: flex; gap: 10px; justify-content: center; margin-bottom: 12px;">
                        <button type="button" id="btnMeet"
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

                        <button type="button" id="btnZoom"
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


                    <input  type="text"
                        placeholder="Past link"
                        style="width: 100%; background-color: white; color: #64748b; border: none;
           border-radius: 8px; padding: 10px 12px; font-size: 13px; font-weight: 400; text-align: center;">
                </div>


                <!-- ✅ Priority & Reminder Section Styled Box -->
                <div class="p-3 mb-3 rounded" style="background-color: #f5f7fa; box-shadow: inset 0 0 2px rgba(0,0,0,0.05);">
                    <div class="row g-3">
                        <!-- Meeting Priority -->
                        

                        <!-- Expired Reminder -->
                        <div class="col-md-12">
                            <p style="font-size: 12px; font-weight: 600; color: #334155;margin-bottom: 2px;">Expired Reminder</p>
                            <p style="font-size: 11px; color: #6b7280;margin-bottom: 8px;">Set a reminder before expired</p>
                            

                            <div class="d-flex " style="background:#fff; border-radius: 5px; gap: 3px; padding: 5px;">
                                    <button type="button" class="reminder-btn rem-30 " data-value="30">30 Min</button>
                                    <button type="button" class="reminder-btn rem-60" data-value="60">60 Min</button>
                                    <button type="button" class="reminder-btn rem-120" data-value="120">2 Hour</button>
                                    <button type="button" class="reminder-btn rem-180" data-value="180">3 Hour</button>
                                    <button type="button" class="reminder-btn rem-240" data-value="240">4 Hour</button>
                                </div>
                        </div>
                    </div>
                </div>


                <!-- Submit Button -->
                <div class="text-center">
                    <button id="saveBtn" class="btn" style="background-color: #5b21b6; color: white; padding: 8px 40px; border-radius: 8px; font-size: 14px;">
                        Create
                    </button>
                </div>

            </div>

                            </form>
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
         //   const toggleIcon = document.getElementById("toggleIcon");
          //  const chevron = document.getElementById("chevronIcon");

         //   toggleIcon.addEventListener("click", () => {
          //      setTimeout(() => {
          //          chevron.classList.toggle("ti-chevron-down");
          //          chevron.classList.toggle("ti-chevron-up");
           //     }, 150);
           // });
        </script>
        <script>

document.addEventListener('DOMContentLoaded', function () {
    const userDivs = document.querySelectorAll('.user_div');
    const selectMembers = document.getElementById('members');

    userDivs.forEach(div => {
        div.addEventListener('click', function () {
            const userId = this.dataset.userId;

            // Toggle user_active class
            this.classList.toggle('user_active');

            // Update select options
            let selected = Array.from(selectMembers.options).map(o => o.value);

            if (this.classList.contains('user_active')) {
                // Add to select if not present
                if (!selected.includes(userId)) {
                    let option = new Option(userId, userId, true, true);
                    selectMembers.add(option);
                }
            } else {
                // Remove from select
                Array.from(selectMembers.options).forEach(opt => {
                    if (opt.value === userId) opt.remove();
                });
            }

            // Trigger change event (if needed for plugins like Select2)
            selectMembers.dispatchEvent(new Event('change'));
        });
    });
});

document.querySelectorAll('.user_div').forEach(div => {
    div.addEventListener('click', () => {
        
        document.getElementById('selected_user').value = div.dataset.userId;
    });
});

// Priority
document.getElementById('priorityLow').addEventListener('click', function (e) {
    e.preventDefault();
    document.getElementById('priorityHidden').value = 'low';
    document.querySelector('#priorityMiddle').classList.remove('active');
    document.querySelector('#priorityMiddle').classList.remove('active');
    document.querySelector('#priorityLow').classList.add('active');
});
document.getElementById('priorityMiddle').addEventListener('click', function (e) {
    e.preventDefault();
    document.getElementById('priorityHidden').value = 'middle';
    document.querySelector('#priorityHigh').classList.remove('active');
    document.querySelector('#priorityLow').classList.remove('active');
    document.querySelector('#priorityMiddle').classList.add('active');
});
document.getElementById('priorityHigh').addEventListener('click', function (e) {
    e.preventDefault();
    
    document.getElementById('priorityHidden').value = 'high';
    document.querySelector('#priorityMiddle').classList.remove('active');
    document.querySelector('#priorityLow').classList.remove('active');
    document.querySelector('#priorityHigh').classList.add('active');
});
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



                const startSelect = document.getElementById('startTimeSelect');
    const endSelect = document.getElementById('endTimeSelect');


    document.getElementById('dateInput').addEventListener('change', function () {
    document.getElementById('startDateHidden').value = this.value;
});


    function validateTimes() {
        const start = startSelect.value;
        const end = endSelect.value;

        if (start && end) {
            const startTime = toMinutes(start);
            const endTime = toMinutes(end);

            if (endTime <= startTime) {
                alert('End time must be later than start time.');
                endSelect.value = ''; // Reset invalid selection
            }
        }
    }

    function toMinutes(time) {
        const [hours, minutes] = time.split(':').map(Number);
        return hours * 60 + minutes;
    }

    startSelect.addEventListener('change', validateTimes);
    endSelect.addEventListener('change', validateTimes);



            });


        document.querySelectorAll('.reminder-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        // reset all
        document.querySelectorAll('.reminder-btn').forEach(b => b.classList.remove('active'));
        // activate clicked
        this.classList.add('active');
        // update hidden input
        document.getElementById('reminderHidden').value = this.dataset.value;
    });
});

document.querySelectorAll('.time-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        // reset all
        document.querySelectorAll('.time-btn').forEach(b => b.classList.remove('active'));
        // activate clicked
        this.classList.add('active');
        // update hidden input
        document.getElementById('timeHidden').value = this.dataset.value;
    });
});



const titleEl = document.getElementById('meeting_name');
const projectEl = document.getElementById('select_project');
const teamEl = document.getElementById('select_team');


document.getElementById('saveBtn').addEventListener('click', function (e) {
    
    e.preventDefault();
    const form = document.getElementById('meetingForm');

  const title = titleEl.value.trim();
  const project = projectEl.value;
  const team = teamEl.value;

    const priorityHidden = document.getElementById('priorityHidden').value;
    const reminderHidden = document.getElementById('reminderHidden').value;
    const timeHidden = document.getElementById('timeHidden').value;
    const todoType = document.getElementById('todo_type').value;
    
    const startDate = document.getElementById('dateInput')?.value;
    const startTime = document.getElementById('startTimeSelect')?.value;
    const endTime = document.getElementById('endTimeSelect')?.value;

    let checkprojteam = 0;
    


    if (!todoType) {
        alert("Please select 'Today Meeting' or 'Scheduled Meeting' before submitting.");
        return;
    }

   // if (todoVisibility === 'shared') {
        const activeUser = document.querySelector('.user_div.user_active');
        if (!activeUser) {
            alert('Please select at least one user for Meeting.');
            return;
        }
        //checkprojteam = 1;
   // }

    if (todoType === 'scheduled') {
        if (!startDate) {
            alert('Please select a Start Date.');
            return;
        }
        if (!startTime) {
            alert('Please select a Start Time.');
            return;
        }
        if (!endTime) {
            alert('Please select a End Time.');
            return;
        }

        // Optional: check that end date >= start date
        if (new Date(endTime) < new Date(startTime)) {
            alert('Meeting Date cannot be earlier than Start Date.');
            return;
        }
    }else if(!timeHidden){
        alert('Please provide End time before submitting.');
            return;
    }



  // Reset previous error highlights
  [titleEl, projectEl, teamEl].forEach(el => el.classList.remove('required'));

  // Add highlight if empty
  if (!title) titleEl.classList.add('required');
  if (!project) projectEl.classList.add('required');
  if (!team) teamEl.classList.add('required');

  // Stop submission if any field is empty
  if(checkprojteam == 1){
        if (!title || !project || !team || !priorityHidden || !reminderHidden ) {
            alert('Please fill all required fields before submitting.');
            return;
        }
  }else{
    if (!title || !priorityHidden || !reminderHidden ) {
    alert('Please fill all required fields before submitting.');
    return;
  }
  }
  

    form.submit();
});

[titleEl, projectEl, teamEl].forEach(el => {
  el.addEventListener('input', () => {
    if (el.value.trim() !== '') {
      el.classList.remove('required');
    }
  });
});

        </script>
        @endsection