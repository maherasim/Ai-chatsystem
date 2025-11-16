<?php $page = 'chat'; ?>
@php
use Carbon\Carbon;
@endphp
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
    .invit-box{
        position:relative;
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
#schdule_time .col-md-4{
    padding-left:5px !important;
    padding-right:5px !important;
}

.overlap-container {
        display: flex;
        justify-content: center;
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
    flex: 0 0 auto;                     /* each card fixed width */
    border: 1px solid #ddd;
    background: #fff;
    padding: 10px;
    cursor: pointer;
    max-height:180px;
    flex: 0 0 auto;
  width: 110px;
  border-radius: 16px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.05);
  text-align: center;
  height: 155px;
}

.user_div img{
    max-height:110px;
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


    .todohead.shared{
    background: linear-gradient(to right, #3eaee7, #94d2f1);; 
    
}

.time-value {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -60%);
  font-size: 14px;  /* smaller font */
  font-weight: bold;
  color: #1c2233;
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


#countdown{
    padding-bottom:10px;
}
.circle-timer {
  position: relative;
  width: 60px;   /* reduced */
  height: 60px;  /* reduced */
  margin: auto;
}

.circle-timer svg {
  width: 60px;   /* reduced */
  height: 60px;  /* reduced */
  transform: rotate(-90deg);
}

.circle-timer circle {
  fill: none;
  stroke-width: 6;   /* thinner */
  cx: 50%;
  cy: 50%;
  r: 25;             /* reduced radius */
  stroke: #e6e6e6;
}

.circle-timer circle:nth-child(2) {
  stroke: #22c55e;
  stroke-dasharray: 157; /* 2 * PI * 25 */
  stroke-dashoffset: 157;
  transition: stroke-dashoffset 1s linear;
}

.todohead{
    background: linear-gradient(to right, #e53935, #f48fb1); 
    color: white; 
    padding: 25px 20px; 
    position: relative;
}
.todohead.shared{
    background: linear-gradient(to right, #3eaee7, #94d2f1);; 
    
}

.time-value {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -60%);
  font-size: 14px;  /* smaller font */
  font-weight: bold;
  color: #1c2233;
}

.timer-text {
  position: absolute;
  bottom: -12px;
  left: 50%;
  transform: translateX(-50%);
  font-size: 12px; /* smaller label */
  color: #666;
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
                <div class="chat-body chat-page-group">
                    <div class="chat-body chat-page-group">

                        <!-- TOday reminde  -->
                        <div class="project-succes pt-1 pb-2 d-flex justify-content-between align-items-center flex-wrap" style="gap:10px;">

                            <div>
                                <h3 style="margin: 0; font-size:18px;">TOday's Reminder's</h3>
                                <strong>Reminders: {{count($todayMeetings)}}</strong>
                            </div>

                            <div class="d-flex flex-wrap justify-content-end align-items-center"
                                style="background: #f8fafc; border-radius: 8px; padding: 6px 10px; gap: 7px; max-width: 100%;">

                                <!-- Buttons -->
                                <button onclick="resetMeetingForm();" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#meetingModal"
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

                                $owner = 0;
                                if($meeting->user_id == $user->_id){
                                    $owner = 1;
                                }

                                $isLocal = request()->getHost() === '127.0.0.1' || request()->getHost() === 'localhost';

                                if ($isLocal) {
                                    $imageUrl = $meeting->user->image
                                        ? asset($meeting->user->image)
                                        : asset('build/img/profile.svg');
                                } else {
                                    $imageUrl = $meeting->user->image
                                        ? asset($meeting->user->image)
                                        : asset('build/img/profile.svg');
                                }

                                $endDateTime = \Carbon\Carbon::parse($meeting->end_date . ' ' . $meeting->start_time, 'Europe/Berlin');
//$remaining = $endDateTime->diffInSeconds(\Carbon\Carbon::createFromTimestamp($ctime, 'Europe/Berlin'), false);
$remaining = max(0, \Carbon\Carbon::createFromTimestamp($ctime, 'Europe/Berlin')
                ->diffInSeconds($endDateTime, false));

                                if ($remaining < 0) $remaining = 0;

                                $reminderMinutes = $meeting->reminder ?? 60;
                                $reminderSeconds = $reminderMinutes * 60;
                                $part = $reminderSeconds / 3;

                                @endphp
                            <!-- Start of Card 1 -->
                             <div class="col-12 col-sm-6 col-lg-3">
                                <div class="card  viewMeeting"  data-id="{{ $meeting->id }}"
    data-title="{{ $meeting->title }}"
    data-description=""
    data-start_date="{{ $meeting->start_date }}"
    data-start_time="{{ $meeting->start_time }}"
    data-end_date="{{ $meeting->end_date }}"
    data-end_time="{{ $meeting->start_time }}"
    data-is_private="{{ $meeting->is_private }}"
    data-priority="{{ $meeting->priority }}"
    data-reason="{{$meeting->reason}}"
    data-reminder="{{ $meeting->reminder }}"
    data-total="{{ $meeting->total_time }}"
    data-owner="{{$owner}}"
    data-url="{{$meeting->meet_link}}"
    data-complete="{{$meeting->completed}}"
    data-image="{{ $imageUrl }}"
    data-sections="{{$meeting->description}}"
    data-members='@json($meeting->members_data)'
    data-own="today"
    data-bs-toggle="modal"
    data-bs-target="#inreject" style=" height:fit-content; cursor:pointer; border: 1px solid #c0c0c0; border-radius: 12px; font-family: 'Segoe UI', sans-serif; box-shadow: 0 2px 6px rgba(0,0,0,0.05); overflow: hidden;">

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
                                    <div class="d-flex align-items-center gap-2 px-2 py-2 mx-1 mb-2" style="justify-content: space-evenly; font-size: 11px; border-radius: 10px; background: #fff; border: 1px solid #f3f3f3;">
                                        <!-- Green dot -->
                                        


                                        <!-- Bell Icon -->
                                        <img src="{{URL::asset('/build/img/bell.svg')}}" alt="Image" style="width: 20px;height:20px;" class="rounded-circle">

                                        <!-- Divider -->
                                        <div style="width: 1px; height: 16px; background-color: #e0e0e0;"></div>

                                        <!-- "Now" Text -->
                                        <span style="color: red; font-weight: 500;">
                                            <img src="{{URL::asset('/build/img/timeicon.svg')}}" alt="Image" style="width: 20px;height:20px;"> </span>
                                        <span style="color: red; font-weight: 500;" class="joinbtn-{{$meeting->_id}}"> Today</span>

                                        <!-- Divider -->
                                        <div style="width: 1px; height: 16px; background-color: #e0e0e0;"></div>

                                        <!-- Clock Icon + Time -->
                                        <div class="d-flex align-items-center gap-1">

                                            <img src="{{URL::asset('/build/img/Clock.svg')}}" alt="Image" style="width: 20px;height:20px;">
                                            <span style="color: #ef4444;">{{$meeting->start_time}} - {{$meeting->end_time}}</span>
                                        </div>
                                    </div>
                                    
                                        <!-- Join Now Button -->
                                        <div data-time="{{$endDateTime}}"  data-url="{{$meeting->meet_link}}" class="text-center py-2 joinbtns" id="joinbtn-{{ $meeting->_id }}" data-start_date="{{ $meeting->start_date }}"
    data-start_time="{{ $meeting->start_time }}"
    data-end_date="{{ $meeting->end_date }}"
    data-end_time="{{ $meeting->start_time }}" style="display:none;" >
                                            <button class="join-now-btn" onclick="event.stopPropagation();" style=" background-color: #22c55e; color: white; padding: 6px 18px; border: none; border-radius: 8px; font-size: 13px; font-weight: 500; cursor: pointer; display: inline-flex; align-items: center; gap: 6px;">
                                                Join now
                                                <img src="{{ URL::asset('/build/img/Logout1.svg') }}" alt="arrow" style="width: 16px; height: 16px;" />
                                            </button>
                                        </div>

                                        
                                    

                                    <!-- Footer Button -->
                                    <div class="d-flex justify-content-center py-2" style="margin-top: -10px;">
                                        
                                        @php
                                            // Combine date and time
                                            $endDateTime = \Carbon\Carbon::parse($meeting->end_date . ' ' . $meeting->start_time);
                                        @endphp

                                        
    </div>
                            <div style="display:none;">
                                        <div class="counter-div" id="timer-{{ $index }}" data-reminder-active="0" data-todo-id="{{ $meeting->id }}">
                                            <span id="asimclic-{{ $index }}"></span>
                                        </div>
                            </div>
                                    
                                    @if($remaining > 0)
    <script>
        (function() {
            let duration = {{ $remaining }};
            let display = document.getElementById('asimclic-{{ $index }}');
            let container = document.getElementById('timer-{{ $index }}');
            let part = {{ $part }};
            let reminderSeconds = {{ $reminderSeconds }};
            let joinBtn = document.getElementById('joinbtn-{{ $meeting->_id }}');

            // hide timer initially if not in reminder period yet
            if (duration > reminderSeconds) {
                container.style.display = "none";
            }

            function updateClock() {
                let hours = Math.floor(duration / 3600);
                let minutes = Math.floor((duration % 3600) / 60);
                let seconds = duration % 60;

                if (duration <= 180) {
                 //   joinBtn.style.display = "block";
                } else {
                  //  joinBtn.style.display = "none";
                }

                let formatted =
                    String(hours).padStart(2, '0') + ":" +
                    String(minutes).padStart(2, '0') + ":" +
                    String(seconds).padStart(2, '0');

                //display.innerText = formatted;

                // When countdown enters reminder phase, show container
                if (duration <= reminderSeconds) {
                    container.style.display = "flex"; // or "block" if needed
                    container.dataset.reminderActive = "1"; 

                    // color changes during reminder phase
                    if (duration <= 0) {
                        container.style.backgroundColor = "#e74c3c"; // Final stage
                        clearInterval(timer);

                        let todoCard = document.querySelector('.viewTodo[data-id="{{ $meeting->id }}"]');
                        if (todoCard) {
                           // display.innerText = "Task Expired";
                            todoCard.click();
                        }

                    } else if (duration <= part) {
                        container.style.backgroundColor = "#e74c3c"; //  last 1/3
                    } else if (duration <= part * 2) {
                        container.style.backgroundColor = "#ff9800"; //  middle 1/3
                    } else {
                        container.style.backgroundColor = "#4CAF50"; //  first 1/3
                    }
                }

                duration--;
            }

            updateClock();
            let timer = setInterval(updateClock, 1000);
        })();
    </script>
@else
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let container = document.getElementById('timer-{{ $index }}');
           // let display = document.getElementById('asimclic-{{ $index }}');
            //display.innerText = "Task Expired";
           // container.dataset.reminderActive = "1";
            //container.style.backgroundColor = "#e74c3c";
        });
    </script>
@endif
                                                
                                    </div>


                            </div>
                            
                            <!-- End of Card 1 -->
                             @empty
                                <div class="alert alert-warning">No Meeting for today.</div>
                             @endforelse

                            </div>
                        
                        <!-- meeting todo -->
                        <div class="project-succes pt-2 pb-2 d-flex justify-content-between align-items-center">
                            <div>
                                <h3 style="margin: 0; font-size:18px;">Meetings Events</h3>
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

                                $owner = 0;
                                if($meeting->user_id == $user->_id){
                                    $owner = 1;
                                }

                                $isLocal = request()->getHost() === '127.0.0.1' || request()->getHost() === 'localhost';

                                if ($isLocal) {
                                    $imageUrl = $meeting->user->image
                                        ? asset($meeting->user->image)
                                        : asset('build/img/profile.svg');
                                } else {
                                    $imageUrl = $meeting->user->image
                                        ? asset($meeting->user->image)
                                        : asset('build/img/profile.svg');
                                }

                                $endDateTime = \Carbon\Carbon::parse($meeting->end_date . ' ' . $meeting->end_time, 'Europe/Berlin');
//$remaining = $endDateTime->diffInSeconds(\Carbon\Carbon::createFromTimestamp($ctime, 'Europe/Berlin'), false);
$remaining = max(0, \Carbon\Carbon::createFromTimestamp($ctime, 'Europe/Berlin')
                ->diffInSeconds($endDateTime, false));

                                if ($remaining < 0) $remaining = 0;

                                $reminderMinutes = $meeting->reminder ?? 60;
                                $reminderSeconds = $reminderMinutes * 60;
                                $part = $reminderSeconds / 3;

                                @endphp
                                 <!-- Start of Card 1 -->
                             <div class="col-12 col-sm-6 col-lg-3">
                                <div class="card  viewMeeting" data-id="{{ $meeting->id }}"
    data-title="{{ $meeting->title }}"
    data-description=""
    data-start_date="{{ $meeting->start_date }}"
    data-start_time="{{ $meeting->start_time }}"
    data-end_date="{{ $meeting->end_date }}"
    data-end_time="{{ $meeting->end_time }}"
    data-is_private="{{ $meeting->is_private }}"
    data-priority="{{ $meeting->priority }}"
    data-reason="{{$meeting->reason}}"
    data-reminder="{{ $meeting->reminder }}"
    data-total="{{ $meeting->total_time }}"
    data-owner="{{$owner}}"
    data-url="{{$meeting->meet_link}}"
    data-complete="{{$meeting->completed}}"
    data-image="{{ $imageUrl }}"
    data-sections="{{$meeting->description}}"
    data-members='@json($meeting->members_data)'
    data-own="today"
    data-bs-toggle="modal"
    data-bs-target="#inreject" style=" height:fit-content; cursor:pointer; border: 1px solid #c0c0c0; border-radius: 12px; font-family: 'Segoe UI', sans-serif; box-shadow: 0 2px 6px rgba(0,0,0,0.05); overflow: hidden;">

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
                                                
                                                @foreach ($meeting->members as $member)
                                                    @if ($member->decision == 1)
                                                    
                                                @php
                                                    
                                                    if ($isLocal) {
                                                        $memberimg = $member->user->image
                                                            ? asset($member->user->image)
                                                            : asset('build/img/profile.svg');
                                                    } else {
                                                        $memberimg = $member->user->image
                                                            ? asset($member->user->image)
                                                            : asset('build/img/profile.svg');
                                                    }
                                                @endphp

                                                    <img src="{{ $memberimg }}"
                                                        class="rounded-circle"
                                                        style="position: absolute;
                                                                left: {{ $loop->index * 15 }}px;
                                                                z-index: {{ count($meeting->members) - $loop->index }};
                                                                border: 2px solid white;
                                                                width: 28px;
                                                                height: 28px;" />
                                                    @endif
                                                @endforeach
                                              
                                            </div>
                                        </div>

                                        <!-- Rejected -->
                                        <div class="text-center">
                                            <div style="font-size: 11px; font-weight: 600; color: #1e293b;">Rejected</div>
                                            <div style="position: relative; width: 45px; height: 30px;">
                                                @foreach ($meeting->members as $member)
                                                    @if ($member->decision == -1)
                                                    
                                                @php
                                                    
                                                    if ($isLocal) {
                                                        $memberimg = $member->user->image
                                                            ? asset($member->user->image)
                                                            : asset('build/img/profile.svg');
                                                    } else {
                                                        $memberimg = $member->user->image
                                                            ? asset($member->user->image)
                                                            : asset('build/img/profile.svg');
                                                    }
                                                @endphp

                                                    <img src="{{ $memberimg }}"
                                                        class="rounded-circle"
                                                        style="position: absolute;
                                                                left: {{ $loop->index * 15 }}px;
                                                                z-index: {{ count($meeting->members) - $loop->index }};
                                                                border: 2px solid white;
                                                                width: 28px;
                                                                height: 28px;" />
                                                    @endif
                                                @endforeach
                                                </div>
                                        </div>
                                    </div>

                                    <!-- Status Row -->
                                    <div class="d-flex align-items-center gap-2 px-2 py-2 mx-1 mb-2" style="justify-content: space-evenly; font-size: 11px; border-radius: 10px; background: #fff; border: 1px solid #f3f3f3;">

                                       
                                        
                                        <!-- Video Icon -->
                                                @php
                                                    $showed = 0;
                                                @endphp

                                            @if ($meeting->is_removed == "-1")
                                                    @php
                                                        $showed = 1;
                                                    @endphp
                                                <img src="{{URL::asset('/build/img/cancel.png')}}" alt="Image" style="width: 20px;height:20px;">
                                            @elseif ($meeting->user_id == Auth::id())
                                                    @php
                                                        $showed = 1;
                                                    @endphp
                                                <img src="{{URL::asset('/build/img/watch.svg')}}" alt="Image" style="width: 20px;height:20px;">
                                            @else

                                                    @foreach ($meeting->members as $member)
                                                    @if($member->user_id == Auth::id())
                                                        @if ($member->decision == 0)
                                                        @php
                                                            $showed = 1;
                                                        @endphp
                                                            <img src="{{URL::asset('/build/img/wait.png')}}" alt="Image" style="width: 20px;height:20px;">
                                                        @endif
                                                        @endif
                                                    @endforeach

                                            @endif

                                            @if($showed == 0)
                                                    <img src="{{URL::asset('/build/img/watch.svg')}}" alt="Image" style="width: 20px;height:20px;">
                                            @endif

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
                                                @if ($meeting->is_removed == "-1")
                                                    Cancelled
                                                @elseif($meeting->is_removed == "-2")
                                                    Postponed
                                                @else
                                                    Scheduled
                                                @endif
                                        
                                        </span>
                                    </div>

                                    <!-- Footer Buttons -->
                                    <div class="d-flex">
    @if ($meeting->is_removed == "-1")

            <button   class="flex-fill text-center py-2"
                style="background-color: #F36166; border: none; color: white; font-weight: 500; font-size: 13px;">
            Cancelled
        </button>
                                                    
    @elseif ($meeting->user_id == Auth::id())
        {{-- ✅ Logged-in user is the creator — show Edit/Delete --}}
        <button data-id="{{ $meeting->_id }}"
    data-bs-toggle="modal" data-bs-target="#meetingModal"
    onclick="event.stopPropagation(); addmeetid(this);"  class="flex-fill text-center py-2"
                style="background-color: #f1f5f9; border: none; color: #1e293b; font-weight: 500; font-size: 13px;">
            Edit
        </button>
        <button  data-id="{{ $meeting->_id }}"
    data-bs-toggle="modal" data-bs-target="#removeModel"
    onclick="event.stopPropagation(); updteid(this);" class="flex-fill text-center py-2"
                style="background-color: #fca5a5; border: none; color: white; font-weight: 500; font-size: 13px;">
            Remove
        </button>

    @else
        
        

        @foreach ($meeting->members as $member)
            @if($member->user_id == Auth::id())
                @if ($member->decision == 0)
                    {{-- Pending — show Accept / Reject buttons --}}
                    <button data-id="{{ $meeting->_id }}"
    data-bs-toggle="modal" data-bs-target="#acceptModal"
    onclick="event.stopPropagation(); handleMeetingAction(this, 'accept');" class="flex-fill text-center py-2"
                            style="background-color: #22c55e; border: none; color: white; font-weight: 500; font-size: 13px;">
                        Accept
                    </button>
                    <button data-id="{{ $meeting->_id }}"
    data-bs-toggle="modal" data-bs-target="#rejectModal"
    onclick="event.stopPropagation(); handleMeetingAction(this, 'reject'); " class="flex-fill text-center py-2"
                            style="background-color: #f87171; border: none; color: white; font-weight: 500; font-size: 13px;">
                        Reject
                    </button>

                @elseif ($member->decision == 1)
                    {{-- Accepted --}}
                    <button  class="flex-fill text-center py-2"
                            style="background-color: #22c55e; border: none; color: white; font-weight: 500; font-size: 13px;">
                        Accepted
                    </button>

                @elseif ($member->decision == -1)
                    {{-- Rejected --}}
                    <button class="flex-fill text-center py-2"
                            style="background-color: #f87171; border: none; color: white; font-weight: 500; font-size: 13px;">
                        Rejected
                    </button>
                @endif
            @endif
        @endforeach
    @endif
</div>



                                    <!-- Footer Button -->
                                        @php
                                            // Combine date and time
                                            $endDateTime = \Carbon\Carbon::parse($meeting->end_date . ' ' . $meeting->end_time);
                                        @endphp
                                    <div style="display:none;">
                                        <div class="counter-div" id="timer-{{ $index }}" data-reminder-active="0" data-todo-id="{{ $meeting->id }}">
                                            <span id="asimclic-{{ $index }}"></span>
                                     </div>
                                       
                                    </div>
                                    
                                    @if($remaining > 0)
    <script>
        (function() {
            let duration = {{ $remaining }};
            let display = document.getElementById('asimclic-{{ $index }}');
            let container = document.getElementById('timer-{{ $index }}');
            let part = {{ $part }};
            let reminderSeconds = {{ $reminderSeconds }};

            // hide timer initially if not in reminder period yet
            if (duration > reminderSeconds) {
                container.style.display = "none";
            }

            function updateClock() {
                let hours = Math.floor(duration / 3600);
                let minutes = Math.floor((duration % 3600) / 60);
                let seconds = duration % 60;

                let formatted =
                    String(hours).padStart(2, '0') + ":" +
                    String(minutes).padStart(2, '0') + ":" +
                    String(seconds).padStart(2, '0');

                display.innerText = formatted;

                // When countdown enters reminder phase, show container
                if (duration <= reminderSeconds) {
                    container.style.display = "flex"; // or "block" if needed
                    container.dataset.reminderActive = "1"; 

                    // color changes during reminder phase
                    if (duration <= 0) {
                        container.style.backgroundColor = "#e74c3c"; // Final stage
                        clearInterval(timer);

                        let todoCard = document.querySelector('.viewTodo[data-id="{{ $meeting->id }}"]');
                        if (todoCard) {
                            display.innerText = "Task Expired";
                            todoCard.click();
                        }

                    } else if (duration <= part) {
                        container.style.backgroundColor = "#e74c3c"; //  last 1/3
                    } else if (duration <= part * 2) {
                        container.style.backgroundColor = "#ff9800"; //  middle 1/3
                    } else {
                        container.style.backgroundColor = "#4CAF50"; //  first 1/3
                    }
                }

                duration--;
            }

            updateClock();
            let timer = setInterval(updateClock, 1000);
        })();
    </script>
@else
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let container = document.getElementById('timer-{{ $index }}');
            let display = document.getElementById('asimclic-{{ $index }}');
            display.innerText = "Task Expired";
            container.dataset.reminderActive = "1";
            container.style.backgroundColor = "#e74c3c";
        });
    </script>
@endif
                                                
                                    </div>
                            </div>
                            <!-- End of Card 1 -->

                            @empty
                                <div class="alert alert-warning">No scheduled Meetings.</div>
                             @endforelse

       
                        </div>
                    </div>
                </div>


            </div>

        </div>

    </div>

</div>


 
<!-- postpone Model -->
 <div class="modal fade" id="postponeModel" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 12px; padding: 15px;">

            <!-- Modal Header -->
            <div style="font-size: 18px; font-weight: 600; margin-bottom: 5px;color:black">
                Postpone Meeting
            </div>
            <div style="font-size: 13px; color:black">
                Are you sure to postpone Meeting!
            </div>
            
            <form action="{{ route('meetings.postpone') }}" method="POST">
                @csrf
                <input type="hidden" name="postponeid" id="postponeid" />
            <!-- Denied Section -->
            <div style="border: 1px solid #eee; border-radius: 12px; padding: 20px; background-color: #f9f9f9;">

            <!-- Save Button -->
            <div class="text-center" style="margin-top: 15px; display:flex; justify-content: space-around;">
                <button data-bs-dismiss="modal" type="button" class="btn" 
                    style="background-color: #f7f7f7; border: 1px solid #ddd; border-radius: 8px; padding: 6px 20px; font-size: 14px; font-weight: 500;">
                     Close
                </button>
                <button type="submit" class="btn" 
                    style="background-color: #f7f7f7; border: 1px solid #ddd; border-radius: 8px; padding: 6px 20px; font-size: 14px; font-weight: 500;">
                    Postpone & Close
                </button>
    </div>
            </div>
            </form>

        </div>
    </div>
</div>

<!-- remove model -->
 <div class="modal fade" id="removeModel" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 12px; padding: 15px;">

            <!-- Modal Header -->
            <div style="font-size: 18px; font-weight: 600; margin-bottom: 5px;color:black">
                Delete Meeting
            </div>
            <div style="font-size: 13px; color:black">
                Tell us why ?!
            </div>
            <hr style="background-color: #777; height: 1px; border: none; margin: 10px 0;">


            <form action="{{ route('meetings.remove') }}" method="POST">
                @csrf
                <input type="hidden" name="remid" id="remid" />
                <input type="hidden" name="isremove" id="isremove" value="0" />
                <input type="hidden" name="iscomplete" id="iscomplete" value="0" />
            <!-- Denied Section -->
            <div style="border: 1px solid #eee; border-radius: 12px; padding: 20px; background-color: #f9f9f9;">

                <!-- Icon + Text left aligned -->
                <div style="display: flex; align-items: flex-start; gap: 10px; margin-bottom: 15px;">
                    <img src="{{ asset('build/img/deletep.svg') }}" alt="Pause Icon" width="38px" height="38px">
                    <div>
                        <div style="font-size: 18px; font-weight: 600;color:black">Delete</div>
                        <div style="color: #777; font-size: 13px;">Select reason why to remove</div>
                    </div>
                </div>

                <!-- Input Fields -->
                <select  name="reason" required
                    style="width: 100%; padding: 12px 14px; margin-bottom: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px; background-color: #fff;">
                    <option class="removal" value="By Mistake">By Mistake</option>
                    <option class="removal" value="Not neet it">Not neet it</option>
                    <option class="removal" value="No important">No important</option>
                    <option class="removal" value="No time for it">No time for it</option>
                    <option class="failed" value="Time to short">Time to short</option>
                    <option class="failed" value="Details not clear">Details not clear</option>
                    <option class="failed" value="Team not response">Team not response</option>
                </select>
            </div>

            <!-- Save Button -->
            <div class="text-center" style="margin-top: 15px; display:flex; justify-content: space-around;">
                <button data-bs-dismiss="modal" type="button" class="btn" 
                    style="background-color: #f7f7f7; border: 1px solid #ddd; border-radius: 8px; padding: 6px 20px; font-size: 14px; font-weight: 500;">
                     Close
                </button>
                <button type="submit" class="btn" 
                    style="background-color: #f7f7f7; border: 1px solid #ddd; border-radius: 8px; padding: 6px 20px; font-size: 14px; font-weight: 500;">
                    Delete & Close
                </button>
               
            </div>
            </form>

        </div>
    </div>
</div>


<!-- View Model -->
<div class="modal fade" id="inreject" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content" style="border-radius: 15px; overflow: hidden;">

            <!-- Modal Body -->
            <div class="modal-body p-0">
                <!-- Header -->
                <div class="todohead " >

                    <!-- Text Left-Aligned -->
                    <div style="text-align: left;">
                        <h5 style="margin: 0;">&nbsp;</h5>
                        <small>&nbsp;</small>
                    </div>

                    <!-- Logo Centered, Half Outside -->
                    <div style="position: absolute; bottom: -15px; left: 50%; transform: translateX(-50%); background: white; border-radius: 50%; padding: 5px;">
                        <img class="user-todo-img" src="{{ URL::asset('/build/img/yekbon.svg') }}" alt="Logo" style="width: 60px; height: 60px; border-radius: 50%;">
                    </div>

                </div>

                <!-- Task Card -->
                <div class="p-2">

                    <div class="mt-2 mb-3" style="background-color: #f8f9fa; padding:10px; border-radius:10px;">
    <h5 class="text-center fw-bold mb-3" style="color: #1c2233; margin-bottom:10px !important;">Timer</h5>
    <div class="row text-center justify-content-center" id="countdown">
    <!-- Days -->
    <div class="col-md-4">
        <div class="circle-timer">
            <svg>
                <circle cx="50%" cy="50%" r="25"></circle>
                <circle id="days-circle" cx="50%" cy="50%" r="25"></circle>
            </svg>
            <div class="time-value" id="days">0</div>
            <div class="timer-text">Days</div>
        </div>
    </div>

    <!-- Hours -->
    <div class="col-md-4">
        <div class="circle-timer">
            <svg>
                <circle cx="50%" cy="50%" r="25"></circle>
                <circle id="hours-circle" cx="50%" cy="50%" r="25"></circle>
            </svg>
            <div class="time-value" id="hours">0</div>
            <div class="timer-text">Hours</div>
        </div>
    </div>

    <!-- Minutes -->
    <div class="col-md-4">
        <div class="circle-timer">
            <svg>
                <circle cx="50%" cy="50%" r="25"></circle>
                <circle id="minutes-circle" cx="50%" cy="50%" r="25"></circle>
            </svg>
            <div class="time-value" id="minutes">0</div>
            <div class="timer-text">Minutes</div>
        </div>
    </div>
</div>



</div>


                    <div class="mt-2 mb-3" style="background-color: #f8f9fa;padding:10px;border-radius:10px;">
                        <h5 class="text-center fw-bold mb-3 modal-title todo-title" style="color: #1c2233;">Task Title</h5>
                        <p class="text-center">
                            <span class="todo-type  badge bg-secondary" style="background: #fff !important; font-size: 13px; padding: 8px 12px; border-color: #fff !important; color: #1c274c;">Priviatess Todo's</span>
                            <span class="todo-type badge rounded-pill1 todo-priority" style="color: #22c55e; font-size: 13px; padding: 8px 12px;">
                                <i class="bi bi-circle-fill me-1" style="font-size: 8px;"></i> Low
                            </span>
                        </p>

                        
                    </div>

                    <div class="mt-2 mb-3 " style="background-color: #f8f9fa; padding:10px; border-radius: 15px; box-shadow: 0px 0px 5px rgba(0,0,0,0.05);">

                        <!-- Title -->
                        <h5 class="text-center fw-bold mb-3" style="color: #1c2233;">Meeting Start & End Time</h5>

                        <!-- Info Row -->
                        <div id="times_sch" class="d-flex1 flex-wrap justify-content-around text-center" style="font-size: 13px;">
                            
                            <div class="right-border">
                                <div class="text-muted"><b>Scheduled</b></div>
                            </div>&nbsp;|&nbsp;
                            <div class="right-border">
                                <div><span class="text-success">Start Date:</span> <span class="todo-start-date">--</span></div>
                            </div>&nbsp;|&nbsp;
                            <div class="right-border">
                                <div><span class="text-success">Start Time:</span> <span class="todo-deliver-date">--</span></div>
                            </div>&nbsp;|&nbsp;
                            <div class="right-border">
                                <div><span class="text-success">End Time:</span> <span class="todo-deliver-time">--</span></div>
                            </div>
                        </div>
                        <!-- Info Row -->
                        <div id="times_today" class=" flex-wrap justify-content-around text-center" style="font-size: 13px;">
                            
                            <div class="right-border">
                                <div class="text-muted"><b>Todays</b></div>
                            </div>&nbsp;|&nbsp;
                            
                            <div class="right-border">
                                <div><span class="text-success">Start Time:</span> <span class="todo-deliver-date">{{ now()->toDateString() }}</span></div>
                            </div>&nbsp;|&nbsp;
                            <div class="right-border">
                                <div><span class="text-success">Total Time:</span> <span class="todo-total_time">2 hour</span></div>
                            </div>
                        </div>

                    

                    <div class="mt-2 mb-3 invited-users-block" style="background-color: #f8f9fa; padding:10px; border-radius: 15px; box-shadow: 0px 0px 5px rgba(0,0,0,0.05);">

                        
                        <div style="font-weight: 600; color: #333; font-size: 14px; margin-bottom: 10px;">• Description •</div>
                            <div style="background:#fff;border-radius:6px;padding:8px 12px;margin-bottom:8px;display:flex;align-items:center;">
                                <img src="/build/img/tera.svg" width="18" height="18" style="margin-right:10px;">
                                <span style="color:#667085;font-size:13.5px;" id="descripion" class="descripn"></span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-2 mb-3 invited-users-block" style="background-color: #f8f9fa; padding:10px; border-radius: 15px; box-shadow: 0px 0px 5px rgba(0,0,0,0.05);">


                        <div style="font-weight: 600; color: #333; font-size: 14px; margin-bottom: 10px;">• Meeting Link •</div>
                        <div style="background:#fff;justify-content: space-between; border-radius:6px;padding:8px 12px;margin-bottom:8px;display:flex;align-items:center;">
                                <img src="/build/img/vidlink.png" width="18" height="18" style="margin-right:10px;">
                                <span style="color:#667085;font-size:13.5px;" id="vidlink" >Meeting on Zoom</span>
                                <span class="jonlinkcls" data-link="" style="color:#fff; background: #1BC469; border-radius:5px; padding:5px; cursor:pointer;">
                                    Join <span id="jointimestr"></span>
                                    <img src="/build/img/joinlink.png" width="18" height="18" style="margin-right:10px;">
                                
                                </span>
                            </div>
                        </div>
                    </div>
</div>
                    <!-- Invited User -->
                    <div class="mt-2 mb-3 invited-users-block" style="background-color: #f8f9fa; padding:10px; border-radius: 15px; box-shadow: 0px 0px 5px rgba(0,0,0,0.05);">

                        
                        <h5 class=" fw-bold" style="color: #1c2233;">Invited Users</h5>
                        <p>Shared Meeting with </p>

                        <!-- Info Row -->
                        <div class="row text-center invited-users-list todo-members" style="font-size: 14px; margin:auto;">
                            
                            <div class="col-md-3 invit-box">
                                <div class="invit-img">
                                    <img src="http://127.0.0.1:8000/storage/profiles/VOXSJ0zTCVhJBEj1bOAFYiZbRnJPaCmJ1mXWvU07.png" class=" me-2" alt="image" style="width: 30px; height: 30px; margin:5px;">
                                </div>
                                <div class="invit-txt">User name</div>
                            </div>
                        </div>

                    </div>

                    <div class="mt-2 mb-3 todo-files-block files-container"
                        style="background-color: #f8f9fa; padding:10px;  border-radius: 15px; box-shadow: 0px 0px 5px rgba(0,0,0,0.05);">
                        <h5 class="fw-bold" style="color: #1c2233; margin-bottom:8px;">Shared Files</h5>
                        <div class="todo-files-list d-flex flex-column gap-2" style="font-size: 13px;"></div>
                    </div>
                   

                    <div class="p-3 owner-state_ mt-3" style="background-color: #f5f5f5; text-align:center; border-radius: 10px; display:none;">
                        <div class="todo-removed text-center"  style="padding:10px;margin-bottom:5px; background:#FEE9EA; border-radius:10px;">
                            <div class="text-center mb-2">
                                <img src="{{ asset('build/img/delp.png') }}" alt="Delete" width="40" height="40">
                            </div>
                            User was failed to complete the task.<span class="rem_reason"></span>
                        </div>
                        <div class="todo-complete text-center" style="padding:10px;margin-bottom:5px;text-align:center;  background:#E9FAF0; border-radius:10px;">
                            <div class="text-center mb-2">
                                <img src="{{ asset('build/img/thumbp.png') }}" alt="Delete" width="40" height="40">
                            </div>
                            User has completed the task On Time
                        </div>

                        <div class="todo-waiting text-center" style="padding:10px; text-align:center; margin-bottom:5px; background:#FAE6c8; border-radius:10px;">
                            <div class="text-center mb-2">
                                <img src="{{ asset('build/img/waiting.png') }}" alt="waiting" width="40" height="40">
                            </div>
                            Waiting for user activity
                        </div>
                        
                        
                    </div>
                    
                    <div style="display: flex; justify-content: space-around; background: #f8f9fa; padding: 20px; border-radius: 10px;" class="mt-3 owned">

                        <!-- Edit the Project -->
                        <div class="openEditFromView" id="openEditFromView" data-bs-toggle="modal" data-id="" data-bs-target="#meetingModal" style="text-align: center; flex: 1;cursor:pointer;">
                            <div style="padding: 10px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;">
                                <img src="{{ asset('build/img/editp.png') }}" alt="Edit" width="40" height="40">
                            </div>
                            <div style="margin-top: 6px; color: #1c2b48; font-size: 12px; font-weight: 600;">Edit</div>
                        </div>

                        <!--<div class="postponeView" id="postponeView" data-bs-toggle="modal" data-bs-target="#postponeModel" style="text-align: center; flex: 1;cursor:pointer;">-->
                            <div class="postponeViewedit" id="postponeViewedit" data-bs-toggle="modal" data-bs-target="#meetingModal" style="text-align: center; flex: 1;cursor:pointer;">
                            <div style="padding: 10px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;">
                                <img src="{{ asset('build/img/postp.png') }}" alt="Edit" width="40" height="40">
                            </div>
                            <div style="margin-top: 6px; color: #1c2b48; font-size: 12px; font-weight: 600;">Postpone</div>
                        </div>

                        
                        
                       
                        <!-- Remove the Project -->
                        <div style="text-align: center; flex: 1; cursor: pointer;"
                            data-bs-toggle="modal" data-bs-target="#removeModel">

                            <div style=" padding: 10px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;">
                                <img src="{{ asset('build/img/delp.png') }}" alt="Delete" width="40" height="40">
                            </div>

                            <div class="markfail1" style="margin-top: 6px; color: #1c2b48; font-size: 12px; font-weight: 600;">
                                Remove
                            </div>
                        </div>

                    </div>

                </div>








            </div> <!-- End .p-3 -->

        </div> <!-- End .modal-body -->

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

            <input type="hidden" name="meeting_id" id="meeting_id">
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
                <input type="hidden" name="link_type" id="link_type" />

                 <select id="members" name="members[]" multiple style="display:none;"></select>

            <div class="modal-body p-4" style="background-color: white;">
                <!-- Header -->
                <h5 style="font-weight: 600; color: #1e293b;">Scheduled a Meeting

                <div style="border-radius: 10px; padding: 4px; display: flex; gap: 8px; background-color: #F2F2F2; float: right;">
                            <button type="button" id="btnToday" 
    onclick="showToday()"
    style="border: none; background-color: #22c55e; color: white; padding: 6px 12px; border-radius: 6px; font-size: 13px; font-weight: 500;">
    Meeting Today
  </button>

                            <button type="button" id="btnScheduled" 
    onclick="showScheduled()"
    style="border: none; background-color: transparent; color: #64748b; padding: 6px 12px; border-radius: 6px; font-size: 13px; font-weight: 500;">
    Scheduled Meeting
  </button>

                </h5>
                <p style="color: #64748b; font-size: 14px;">Connect your Team</p>

                
                

                

                <!-- shared section starts -->
                <div class="mb-3" id="selectUsersBox" style="background-color: #f9f9fb; border-radius:10px; padding:16px;">
                    
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <select id="select_project" name="project" class="form-control selection">
                                <option value="">Select Project</option>
                                <option value="1">Project1</option>
                                <option value="2">Project2</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select id="select_team" name="team" class="form-control selection">
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

                            @php
                            $isLocal = request()->getHost() === '127.0.0.1' || request()->getHost() === 'localhost';

                                if ($isLocal) {
                                    $imageUrl = $cuser->image
                                        ? asset($cuser->image)
                                        : asset('build/img/profile.svg');
                                } else {
                                    $imageUrl = $cuser->image
                                        ? asset($cuser->image)
                                        : asset('build/img/profile.svg');
                                }
                            @endphp
                            
                                <div class="user_div" 
                                    id="user_{{$cuser->_id}}" 
                                    data-user-id="{{$cuser->_id}}">
                                    <div class="invit-img">
                                        <img src="{{ $imageUrl }}" />
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

    <!-- Schedule Type Toggle -->
                <div style="background-color: #f9f9fb; border-radius:10px; padding:0px 5px;">
                    <!-- Toggle Buttons -->
                    <div style="  padding:10px; margin-bottom: 6px; margin-top: 4px;">
                        <h5 style="font-weight: 600; font-size: 14px; color: #1e293b; margin: 0;">Meeting Time</h5>
                        <p class="timeToday" style="margin-bottom:0px;">Meeting should start in:</p>
                        <p class="schdule_time" style="display:none; margin-bottom:0px;">Connect your Team:</p>
                    </div>

                    <!-- Date & Time Fields -->
                    <div class="row g-2 align-items-center mb-3 justify-content-center" id="timeRow" style="padding: 4px; display: flex;">

                        <!-- Start Date (hidden by default) -->

                        <!-- selection of tody section -->
                    <div class="d-flex1 gap-2 mb-3 bg-white timeToday" id="timeToday" style="padding: 8px; margin-top:0px;";>
                        
                        <button type="button" class="time-btn time-btn-2 " data-value="2">2 Hour</button>
                        <button type="button" class="time-btn time-btn-3" data-value="3">3 Hour</button>
                        <button type="button" class="time-btn time-btn-6" data-value="6">6 Hour</button>
                        <button type="button" class="time-btn time-btn-9" data-value="9">9 Hour</button>
                        <button type="button" class="time-btn time-btn-12" data-value="12">12 Hour</button>
                    </div>
                    
                    <div id="schdule_time" class="row schdule_time" style="display:none; padding:0px;">
                        
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
                            <div class="d-flex1 gap-2 bg-white" style="justify-content:center; display:flex; justify-content: space-between;">
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
                <!-- Meeting Links -->
                <!-- Link Toggle Section -->
                 <div id="meetingContainer">
                <div id="linkSection"  style="background-color: #f9f9fb; border-radius: 10px; padding: 12px; display: flex; flex-direction: column; align-items: center; width: 100%; margin: auto;margin-bottom: 12px;">

                    <div style="display: flex; gap: 10px; justify-content: center; margin-bottom: 12px;">
                        <button type="button" id="btnMeet"
                            onclick="
      this.style.backgroundColor='#22c55e';
      this.style.color='white';
      document.getElementById('btnZoom').style.backgroundColor='white';
      document.getElementById('link_type').value='Meet';
      document.getElementById('btnZoom').style.color='#64748b';
    "
                            style="border: none; background-color: white; color: #64748b; padding: 6px 16px;
           border-radius: 6px; font-size: 13px; font-weight: 500;">
                            Meet Link
                        </button>

                        <button type="button" id="btnZoom"
                            onclick="
      this.style.backgroundColor='#22c55e';
      this.style.color='white';
      document.getElementById('btnMeet').style.backgroundColor='white';
      document.getElementById('link_type').value='Zoom';
      document.getElementById('btnMeet').style.color='#64748b';
    "
                            style="border: none; background-color: white; color: #64748b; padding: 6px 16px;
           border-radius: 6px; font-size: 13px; font-weight: 500;">
                            Zoom Link
                        </button>
                    </div>


                    <input  type="url" name="meetinglink" id="meetinglink"
                        placeholder="Past link"
                        style="width: 100%; max-width:320px; background-color: white; color: #64748b; border: none;
           border-radius: 8px; padding: 10px 12px; font-size: 13px; font-weight: 400; text-align: center;">
                </div>


                <!-- ✅ Priority & Reminder Section Styled Box -->
                <div id="reminderSection" class="p-3 mb-3 rounded" style="background-color: #f5f7fa; box-shadow: inset 0 0 2px rgba(0,0,0,0.05);">
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

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


        <script>

let timerInterval;
let customtimer = {{ $ctime }} * 1000;

    setInterval(() => {
        customtimer += 1000; // decrease by 1 second each tick


        const joinButtons = document.querySelectorAll('.joinbtns');

        // Loop through each element
        joinButtons.forEach(function(btn) {
            // Example: read data-time attribute
            const time = btn.getAttribute('data-time');
            const id = btn.id;

            //let timr = "2025-11-08 18:00:00";
            //joinbtn-

            let startDate   = btn.dataset.start_date || "";
            let endDate   = btn.dataset.end_date || "";
            let startTime   = btn.dataset.start_time || "";
            let endTime     = btn.dataset.end_time || "";


            let [year, month, day] = endDate.split('-').map(Number);
            let [hour, minute] = endTime.split(':').map(Number);
            //let endDateTime = Date.UTC(year, month - 1, day, hour, minute);
            let endDateTime = new Date(Date.UTC(year, month - 1, day, hour, minute));
            endDateTime = new Date(endDateTime.toLocaleString("en-US", { timeZone: "Europe/Berlin" }));

            const serverTimestamp = customtimer; // {{ $ctime }} * 1000; //  adjusted from controller
            
            const serverDate = new Date(serverTimestamp);
            const now = serverDate; // reference time from backend
            const distance = endDateTime - now;

            
            let jnbtnshow = document.getElementById(id);

           

            const days1 = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours1 = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes1 = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));

            if(days1 <= 0 && hours1 <= 0 && minutes1 < 4){
                jnbtnshow.style.display = "block";

                let btnElement = document.querySelector("." + id);

                if (btnElement) {
                    btnElement.textContent = "Now";  
                }

                //tdybtn-
            }
            
        });

    }, 1000);



    document.addEventListener('DOMContentLoaded', function() {
    // Select all elements with class 'joinbtns'
    
});

    const modal = document.getElementById("inreject");

    document.querySelectorAll(".viewMeeting").forEach(btn => {
        btn.addEventListener("click", function () {
            // Get attributes
            let dataid      = this.dataset.id;

            //const editBtnInModal = document.getElementById('openEditFromView');
            document.getElementById("openEditFromView").setAttribute("data-id", dataid);
            document.getElementById("postponeViewedit").setAttribute("data-id", dataid);
            

            const editBtnInModal = document.querySelector('.edit_' + dataid);
            const openModal = document.getElementById('inreject');

            const rejectBtn = document.querySelector('.rejectbtn');
            const inRejectModal = document.getElementById('inreject');
            const editButton = document.querySelector('.edit_'+ dataid +' .editTodo');

            if (rejectBtn && inRejectModal && editButton) {
        rejectBtn.addEventListener('click', function () {
            editButton.click();
            const modalInstance = bootstrap.Modal.getInstance(inRejectModal);
            /*
            if (modalInstance) {
                // Wait until modal is fully hidden
                inRejectModal.addEventListener('hidden.bs.modal', function handler() {
                    inRejectModal.removeEventListener('hidden.bs.modal', handler);
                    // ✅ Trigger the editTodo click to open #todomodel
                    editButton.click();
                });
                modalInstance.hide();
            } else {
                // Fallback for older Bootstrap/jQuery modal
                $(inRejectModal).on('hidden.bs.modal', function handler() {
                    $(inRejectModal).off('hidden.bs.modal', handler);
                    editButton.click();
                }).modal('hide');
            }
                */
        });
    }

            /*
            if (triggerBtn && editBtnInModal) {
                triggerBtn.addEventListener('click', function () {
                    editBtnInModal.click(); // ✅ Trigger the other button’s click event
                });
            }
                */


            let eidtdiv = ".edit_" + dataid;
           

            for (let attr of this.attributes) {
            if (attr.name.startsWith('data-')) {
                  //  editBtnInModal.setAttribute(attr.name, attr.value);
                }
            }

            document.getElementById("remid").value = dataid;
            document.getElementById("postponeid").value = dataid;

            document.getElementById("meeting_id").value = dataid;

            const markDoneBtn = document.getElementById('markDoneBtn');
            if (markDoneBtn) {
                markDoneBtn.dataset.id = dataid; // set the data-id dynamically
            }


let filecont = document.querySelector('.files-container');
filecont.style.display = "block";



let files = JSON.parse(this.dataset.files || "[]");
//let filesList = document.querySelector('.todo-files-list');


const list = document.getElementById('createPdfList');
   // const addTile = list.querySelector('.pdf-add-tile');

    // Remove any existing tiles (previous create/edit)
    //list.querySelectorAll('.d-flex.align-items-center.gap-2.px-2').forEach(el => el.remove());

    

// Hide container if no files



    filecont.style.display = "none";






            let title       = this.dataset.title;
            let description = this.dataset.description;
            let priority    = this.dataset.priority || "Normal";
            let isPrivate   = this.dataset.is_private;
            let userimg     = this.dataset.image;
            let dataown     = this.dataset.own;
            let owner       = this.dataset.owner;
            let reason      = this.dataset.reason;
            let iscomplete  = this.dataset.complete;
            let meetlink    = this.dataset.url;

            document.querySelectorAll('.jonlinkcls').forEach(el => {
            el.dataset.link = meetlink;
            });

            let forshared = document.querySelector('.forshared');
            
            

            let todfinish = document.querySelector('.dev_finish');
            let ownerstate = document.querySelector('.owner-state');
            let remreason = document.querySelector('.rem_reason');
            let todremove = document.querySelector('.todo-removed');
            let todcomplete = document.querySelector('.todo-complete');
            let todwaiting = document.querySelector('.todo-waiting');

            document.getElementById("isremove").value = 0;

            todremove.style.display = "none";
            todcomplete.style.display = "none";
            todwaiting.style.display = "none";
            
            

          //  if(owner == "0"){
                //todfinish.style.display = "block";
               // forshared.style.display = "none";
              //  ownerstate.style.display = "none";
               // document.getElementById("setcomplete").value = 2;
          //  }else{
                //todfinish.style.display = "none";
               // forshared.style.display = "block";
               // ownerstate.style.display = "block";
               // document.getElementById("setcomplete").value = 1;
               // document.getElementById("isremove").value = 1;

             //   if(iscomplete == "-1"){
                   // todremove.style.display = "block";
                   // remreason.innerText = reason;
             //   }else if(iscomplete == "2"){
                   // todcomplete.style.display = "block";
             //   }else{
                   // todwaiting.style.display = "block";
              //  }

              //  if(isPrivate == "1"){
                    //forshared.style.display = "none";
              //  }else{
                   // forshared.style.display = "block";
              //  }

         //   }

            


            //let edivbtn = document.querySelector('.openEditFromView');
            //edivbtn.style.display = "none";
           // let donebtn = document.querySelector('.markDoneBtn');
            //donebtn.style.display = "block";

          //  let markfial = document.querySelector('.markfail');
          //  markfial.innerText = "Mark as Failed";

            

            let removals = document.querySelectorAll('.removal');
            let faileds = document.querySelectorAll('.failed');

            document.getElementById("iscomplete").value = "-1";
            
            removals.forEach(el => {
                el.style.display = "none";
            });

            faileds.forEach(el => {
                el.style.display = "block";
                
            });

            //let ownerstate = document.querySelector('.owner-state');

            let ownedEl = document.querySelector('.owned');

            if(owner == 1){
                ownedEl.style.display = "flex";
            }else{
                ownedEl.style.display = "none";
            }
            
            let imgTag = document.querySelector('.user-todo-img');
            imgTag.src = userimg;

            
            let descripion    = this.dataset.sections;

            let startDate   = this.dataset.start_date || "";
            let endDate   = this.dataset.end_date || "";
            let startTime   = this.dataset.start_time || "";
            let endTime     = this.dataset.end_time || "";

            document.getElementById("descripion").innerText = descripion;

            let [year, month, day] = endDate.split('-').map(Number);
            let [hour, minute] = endTime.split(':').map(Number);
            //let endDateTime = Date.UTC(year, month - 1, day, hour, minute);
            let endDateTime = new Date(Date.UTC(year, month - 1, day, hour, minute));
            endDateTime = new Date(endDateTime.toLocaleString("en-US", { timeZone: "Europe/Berlin" }));

           // alert(endDate + " " + endTime);

            //let endDateTime = new Date(`${endDate} ${endTime}`).getTime();
            const CIRC = 157; 

            if (timerInterval) clearInterval(timerInterval);

            function updateTimer() {

            //    const serverTimestamp = {{ \Carbon\Carbon::now()->timestamp }} * 1000;
           //     const serverDate = new Date(serverTimestamp);
           // const now = serverDate; // new Date().getTime();
           // const distance = endDateTime - now;

            const serverTimestamp = customtimer; // {{ $ctime }} * 1000; // already adjusted from controller
            
            const serverDate = new Date(serverTimestamp);
            const now = serverDate; // your reference time from backend
            const distance = endDateTime - now;


        if (distance <= 0) {
            document.getElementById("days").innerText = 0;
            document.getElementById("hours").innerText = 0;
            document.getElementById("minutes").innerText = 0;

            document.getElementById("days-circle").style.strokeDashoffset = CIRC;
            document.getElementById("hours-circle").style.strokeDashoffset = CIRC;
            document.getElementById("minutes-circle").style.strokeDashoffset = CIRC;

            document.getElementById("jointimestr").innerText = "Now";

            clearInterval(timerInterval);
            return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        let meetid = 'joinbtn-' + dataid;
        let joinBtn = document.getElementById(meetid);

        document.getElementById("days").innerText = days;
        document.getElementById("hours").innerText = hours;
        document.getElementById("minutes").innerText = minutes;

        let jointimestr = '';
        if(days > 0 ){
            jointimestr = 'D' + days;
        }
        if(hours > 0){
            if(jointimestr != ''){
                jointimestr = jointimestr + ':H' + hours;
            }else{
                jointimestr = 'H' + hours;
            }
        }

        if(minutes > 0){
            if(jointimestr != ''){
                jointimestr = jointimestr + ':M' + minutes;
            }else{
                jointimestr = 'M' + minutes;
            }
        }

        if(jointimestr == ''){
            jointimestr = 'Now'
        }

        //alert(jointimestr);

        document.getElementById("jointimestr").innerText = jointimestr;
        //document.getElementById("hours1").innerText = hours;
        //document.getElementById("minutes1").innerText = minutes;

        if(days == 0 && hours == 0 && minutes < 4){
            joinBtn.style.display = "block";
        }

        
        // Animate circle progress
        document.getElementById("days-circle").style.strokeDashoffset = CIRC - (days % 365) / 365 * CIRC;
        document.getElementById("hours-circle").style.strokeDashoffset = CIRC - (hours / 24) * CIRC;
        document.getElementById("minutes-circle").style.strokeDashoffset = CIRC - (minutes / 60) * CIRC;


        const hoursRemaining = distance / (1000 * 60 * 60);

        const hoursCircle = document.getElementById("hours-circle");
        const minutesCircle = document.getElementById("minutes-circle");

        if (hoursRemaining < 1) {
            hoursCircle.style.stroke = "#dc2626";   // red (<1h)
            minutesCircle.style.stroke = "#dc2626";
        } else if (hoursRemaining < 3) {
            hoursCircle.style.stroke = "#f97316";   // orange (<3h)
            minutesCircle.style.stroke = "#f97316";
        } else {
            hoursCircle.style.stroke = "#22c55e";   // green (default)
            minutesCircle.style.stroke = "#22c55e";
        }

    }

    updateTimer();
    //timerInterval = setInterval(updateTimer, 60000);
    timerInterval = setInterval(updateTimer, 1000);

    //const serverTimestamp = {{ \Carbon\Carbon::now()->timestamp }} * 1000;
                //const serverDate = new Date(serverTimestamp);
            //let today = new Date().toISOString().split("T")[0];

            let today = "{{ now()->format('Y-m-d') }}";

            

            if (startDate === today) {
               
                //show times_today
                document.getElementById("times_today").style.display = "flex";
                document.getElementById("times_sch").style.display = "none";

                let tottime       = this.dataset.total;

                if(tottime == "0" || tottime == ""){
                    

                    let start = new Date(`1970-01-01T${startTime}:00`);
                    let end = new Date(`1970-01-01T${endTime}:00`);

                    // Get difference in milliseconds
                    let diffMs = end - start;

                    // Convert to hours & minutes
                    let diffHrs = Math.floor(diffMs / 1000 / 60 / 60);
                    let diffMins = Math.floor((diffMs / 1000 / 60) % 60);

                    tottime = diffMins === 0 ? `${diffHrs} hours` : `${diffHrs} hours ${diffMins} min`;

                }else{
                    tottime = tottime + " Hours";
                }
                    
                modal.querySelector(".todo-total_time").innerText = tottime;

                

            }else{
                
                document.getElementById("times_sch").style.display = "flex";
                document.getElementById("times_today").style.display = "none";
                
                // show times_sch
                modal.querySelector(".todo-start-date").innerText = formatDate(startDate);
                // Deliver → start_time
                modal.querySelector(".todo-deliver-date").innerText = startTime || "--";
                // Deliver Time → end_time
                modal.querySelector(".todo-deliver-time").innerText = endTime || "--";

            }

            // Set title & description
            modal.querySelector(".todo-title").innerText = title;
           // modal.querySelector(".todo-description").innerText = description || "No description.";

            // Priority
           // let priorityBadge = modal.querySelector(".todo-priority");
          //  priorityBadge.innerHTML = `<i class="bi bi-circle-fill me-1" style="font-size: 8px;"></i> ${priority}`;

            let priorityBadge = modal.querySelector(".todo-priority");

            let color = "green"; // default
            if (priority.toLowerCase() === "middle") {
                color = "orange";
            } else if (priority.toLowerCase() === "high") {
                color = "red";
            }

            priorityBadge.innerHTML = `
            <i class="bi bi-circle-fill me-1" style="font-size: 8px; color: ${color};"></i> 
            <span style="color: ${color}; font-weight: 600;">${priority}</span>
            `;

            // Private vs Shared
            let typeBadge = modal.querySelector(".todo-type");
            let sharedBlock = modal.querySelector(".invited-users-block");
            
            if (isPrivate == "1") {
                typeBadge.innerText = "Private Meeting";
                sharedBlock.style.display = "none";
                modal.querySelector(".todohead").classList.remove("shared");
            } else {
                typeBadge.innerText = "Shared Meeting";
                sharedBlock.style.display = "block";
                modal.querySelector(".todohead").classList.add("shared");
            }


            let members = JSON.parse(this.dataset.members || "[]");
            
            let membersContainer = modal.querySelector(".todo-members");
            membersContainer.innerHTML = ""; // clear old ones

            if (members && members.length) {
                members.forEach(m => {

                    let div = document.createElement("div");
                    div.classList.add("col-md-3", "invit-box");

                    let statusImg = '';
                    if (m.decision == 1) {
                        statusImg = "membertick.png";
                    } else if (m.decision == -1) {
                        statusImg = "membercross.png";
                    } else if (m.decision == 0) {
                        statusImg = "memberwaiting.png";
                    }

                    div.innerHTML = `
                        <img class="statusimg" style="width:15px; right:15px; position:absolute" src="build/img/${statusImg}" />
                        <div class="invit-img">
                            <img src="${m.image}" alt="${m.name}" style="width:40px; height:40px; border-radius:50%;">
                        </div>
                        <div class="invit-txt">${m.name}</div>
                    `;
                    membersContainer.appendChild(div);
                });
            } else {
                membersContainer.innerHTML = `<p class="text-muted">No invited users.</p>`;
            }


        });
    });
function formatDate(dateStr) {
    if (!dateStr) return "--";
    const d = new Date(dateStr);
    if (isNaN(d)) return dateStr; // fallback if invalid
    return `${String(d.getDate()).padStart(2,'0')}.${String(d.getMonth()+1).padStart(2,'0')}.${d.getFullYear()}`;
}

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
const linkEl = document.getElementById('meetinglink');


document.getElementById('saveBtn').addEventListener('click', function (e) {
    
    e.preventDefault();
    const form = document.getElementById('meetingForm');

  const title = titleEl.value.trim();
  const project = projectEl.value;
  const team = teamEl.value;
  const link = linkEl.value;

    const priorityHidden = document.getElementById('priorityHidden').value;
    const reminderHidden = document.getElementById('reminderHidden').value;
    const timeHidden = document.getElementById('timeHidden').value;
    const todoType = document.getElementById('todo_type').value;
    const linkType = document.getElementById('link_type').value;
    
    //const startDate = document.getElementById('dateInput')?.value;
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
        //if (!startDate) {
        //    alert('Please select a Start Date.');
        //    return;
        //}
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

    if (!linkType) {
        alert("Please select 'Meet Link' or 'Zoom Link' before submitting.");
        return;
    }


  // Reset previous error highlights
  [titleEl, projectEl, teamEl, linkEl].forEach(el => el.classList.remove('required'));

  // Add highlight if empty
  if (!title) titleEl.classList.add('required');
  if (!project) projectEl.classList.add('required');
  if (!team) teamEl.classList.add('required');
  if(!link) linkEl.classList.add('required');

  // Stop submission if any field is empty
  if(checkprojteam == 1){
        if (!title || !project || !team || !priorityHidden || !reminderHidden || !link ) {
            alert('Please fill all required fields before submitting.');
            return;
        }
  }else{
    if (!title || !priorityHidden || !reminderHidden || !link ) {
    alert('Please fill all required fields before submitting.');
    return;
  }
  }
  

    form.submit();
});

[titleEl, projectEl, teamEl, linkEl].forEach(el => {
  el.addEventListener('input', () => {
    if (el.value.trim() !== '') {
      el.classList.remove('required');
    }
  });
});

function addmeetid(button){
    let meetdelidngId = button.getAttribute('data-id');
    document.getElementById("meeting_id").value = meetdelidngId;

    editformapi(meetdelidngId);
}

document.getElementById("openEditFromView").addEventListener("click", function() {
    const id = this.getAttribute("data-id");
    editformapi(id);
});

document.getElementById("postponeViewedit").addEventListener("click", function() {
    const id = this.getAttribute("data-id");
    editformapi(id);
});


async function editformapi(id) {
    try {
        const response = await fetch(`/getmeeting/${id}`); // adjust route if needed
        const data = await response.json();

        if (!data.success) {
            alert("Failed to load meeting data.");
            return;
        }

        const meeting = data.meeting;
        const members = meeting.members || [];

        // 📝 Fill hidden fields
        document.getElementById("meeting_id").value = meeting._id || meeting.id;
        document.getElementById("startDateHidden").value = meeting.start_date || '';
        document.getElementById("endDateHidden").value = meeting.end_date || '';
        document.getElementById("startTimeHidden").value = meeting.start_time || '';
        document.getElementById("endTimeHidden").value = meeting.end_time || '';
        document.getElementById("link_type").value = meeting.link_type || '';

        document.getElementById("select_project").value = meeting.project;
        document.getElementById("select_team").value = meeting.team;

        document.querySelector('.priority').classList.remove('active');

            document.getElementById('priorityHidden').value = meeting.priority;

            if(meeting.priority == "low"){
                document.querySelector('#priorityLow').classList.add('active');
            }else if(meeting.priority == "middle"){
                document.querySelector('#priorityMiddle').classList.add('active');
            }else if(meeting.priority == "high"){
                document.querySelector('#priorityHigh').classList.add('active');
            }
        if(meeting.todo_type == "today"){
            document.getElementById("btnToday").click();
        }else{
            document.getElementById("btnScheduled").click();
        }

        // 🏷️ Title & Description
        document.getElementById("meeting_name").value = meeting.title || '';
        const descInput = document.querySelector('input[name="sections"]');
        if (descInput) descInput.value = meeting.description || '';

        // 🕓 Date Display UI
        if (meeting.start_date) {
            const d = new Date(meeting.start_date);
            document.getElementById('dateDisplay').innerText =
                ('0' + d.getDate()).slice(-2) + ':' +
                ('0' + (d.getMonth() + 1)).slice(-2) + ':' + d.getFullYear();
        }

        // ⏰ Time Dropdowns
        document.getElementById("startTimeSelect").value = meeting.start_time || '';
        document.getElementById("endTimeSelect").value = meeting.end_time || '';

        // 🔗 Meeting link
        document.getElementById("meetinglink").value = meeting.meet_link || '';

        // 💡 Priority buttons
        const priorities = ["Low", "Middle", "High"];
        priorities.forEach(p => {
            document.getElementById("priority" + p).classList.remove("active1");
        });
        if (meeting.priority) {
            const activeBtn = document.getElementById("priority" + meeting.priority.charAt(0).toUpperCase() + meeting.priority.slice(1));
            if (activeBtn) activeBtn.classList.add("active1");
            document.getElementById("priorityHidden").value = meeting.priority;
        }

        // 🔔 Reminder buttons
        document.querySelectorAll('.reminder-btn').forEach(btn => {
            btn.classList.remove('active');
            if (btn.dataset.value == meeting.reminder) btn.classList.add('active');
        });
        document.getElementById('reminderHidden').value = meeting.reminder || '';

        // 👥 Members
        const membersSelect = document.getElementById("members");
        membersSelect.innerHTML = ''; // clear old
        members.forEach(m => {
            const option = document.createElement("option");
            option.value = m.user.id;
            option.text = m.user.name;
            option.selected = true;
            membersSelect.appendChild(option);

            let usrdiv = "user_" + m.user.id; 
            const el = document.getElementById(usrdiv);
            if (el) el.click();
        });

        // 🟢 Link type buttons UI
        if (meeting.link_type === 'Zoom') {
            document.getElementById('btnZoom').style.backgroundColor = '#22c55e';
            document.getElementById('btnZoom').style.color = 'white';
            document.getElementById('btnMeet').style.backgroundColor = 'white';
            document.getElementById('btnMeet').style.color = '#64748b';
        } else {
            document.getElementById('btnMeet').style.backgroundColor = '#22c55e';
            document.getElementById('btnMeet').style.color = 'white';
            document.getElementById('btnZoom').style.backgroundColor = 'white';
            document.getElementById('btnZoom').style.color = '#64748b';
        }

        // 🧩 Update “Create” button text
//document.getElementById("saveBtn").innerText = "Update";

        // 💬 Show modal
      //  const meetingModal = new bootstrap.Modal(document.getElementById('meetingModal'));
      //  meetingModal.show();

    } catch (error) {
        console.error("Error fetching meeting:", error);
        alert("An error occurred while loading meeting data.");
    }
}

function resetMeetingForm() {
    // Clear text inputs
    document.getElementById("meeting_id").value = '';
    document.getElementById("meeting_name").value = '';
    document.querySelector('input[name="sections"]').value = '';

    // Clear selects
    document.getElementById("select_project").value = '';
    document.getElementById("select_team").value = '';
    document.getElementById("startTimeSelect").value = '';
    document.getElementById("endTimeSelect").value = '';

    // Clear hidden fields
    document.getElementById("startDateHidden").value = '';
    document.getElementById("endDateHidden").value = '';
    document.getElementById("startTimeHidden").value = '';
    document.getElementById("endTimeHidden").value = '';
    document.getElementById("priorityHidden").value = '';
    document.getElementById("reminderHidden").value = '';
    document.getElementById("link_type").value = '';

    // Clear meeting link
    document.getElementById("meetinglink").value = '';

    // Reset date display
    document.getElementById("dateDisplay").innerText = '';

    // Reset members select
    const membersSelect = document.getElementById("members");
    membersSelect.innerHTML = '';

    // Remove active classes from priority buttons
    ["Low", "Middle", "High"].forEach(p => {
        document.getElementById("priority" + p).classList.remove("active1");
    });

    // Remove active reminder buttons
    document.querySelectorAll('.reminder-btn').forEach(btn => {
        btn.classList.remove('active');
    });

    // Reset link type buttons color
    document.getElementById('btnMeet').style.backgroundColor = 'white';
    document.getElementById('btnMeet').style.color = '#64748b';
    document.getElementById('btnZoom').style.backgroundColor = 'white';
    document.getElementById('btnZoom').style.color = '#64748b';

    document.getElementById('btnToday').style.backgroundColor = 'transparent';
    document.getElementById('btnToday').style.color = '#64748b';

    document.getElementById('btnScheduled').style.backgroundColor = 'transparent';
    document.getElementById('btnScheduled').style.color = '#64748b';

    // Reset todo type buttons
    document.getElementById("btnToday").classList.remove("active");
    document.getElementById("btnScheduled").classList.remove("active");

    // Optionally reset priority UI to default
    document.querySelector('.priority').classList.remove('active');

    document.querySelectorAll(".user_div").forEach(d => d.classList.remove("user_active"));
    document.querySelectorAll(".time-btn").forEach(d => d.classList.remove("active"));

    

}



function updteid(button){
    let meetdelidngId = button.getAttribute('data-id');
    document.getElementById("remid").value = meetdelidngId;
    document.getElementById("postponeid").value = meetdelidngId;
    
}

function handleMeetingAction(button, actionType) {
    const meetingId = button.getAttribute('data-id');
    const actionText = actionType === 'accept' ? 'Accept' : 'Reject';
    const actionColor = actionType === 'accept' ? '#22c55e' : '#f87171';
    const confirmBtnColor = actionType === 'accept' ? '#22c55e' : '#e11d48';

    Swal.fire({
        title: `${actionText} Meeting`,
        text: `Are you sure you want to ${actionText.toLowerCase()} this meeting?`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: confirmBtnColor,
        cancelButtonColor: '#6b7280',
        confirmButtonText: `Yes, ${actionText}`,
        cancelButtonText: 'Cancel',
        customClass: {
            popup: 'rounded-4 shadow-lg'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            

            fetch(`/meetings/${meetingId}/${actionType}`, {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
    },
})
.then(res => res.json())
.then(data => {
    Swal.fire({
        title: 'Success!',
        text: `Meeting ${actionType}ed successfully.`,
        icon: 'success',
        timer: 1500,
        showConfirmButton: false
    }).then(() => location.reload());
})
.catch(err => {
    Swal.fire('Error', 'Something went wrong. Try again.', 'error');
});

        }
    });
}


function showScheduled() {
  // button styles
  document.getElementById('btnScheduled').style.backgroundColor = '#22c55e';
  document.getElementById('btnScheduled').style.color = 'white';
  document.getElementById('btnToday').style.backgroundColor = 'transparent';
  document.getElementById('btnToday').style.color = '#64748b';

  // move the reminder section above the link section
  const container = document.getElementById('meetingContainer');
  const reminder = document.getElementById('reminderSection');
  const link = document.getElementById('linkSection');
  container.insertBefore(reminder, link);

  // update hidden value
  document.getElementById('todo_type').value = 'scheduled';

  
  document.querySelectorAll('.schdule_time').forEach(el => {
    el.style.display = 'flex';
  });
  document.querySelectorAll('.timeToday').forEach(el => {
    el.style.display = 'none';
  });


}

function showToday() {
  // button styles
  document.getElementById('btnToday').style.backgroundColor = '#22c55e';
  document.getElementById('btnToday').style.color = 'white';
  document.getElementById('btnScheduled').style.backgroundColor = 'transparent';
  document.getElementById('btnScheduled').style.color = '#64748b';

  document.querySelectorAll('.schdule_time').forEach(el => {
    el.style.display = 'none';
  });
  document.querySelectorAll('.timeToday').forEach(el => {
    el.style.display = 'flex';
  });

  // move link section back to top
  const container = document.getElementById('meetingContainer');
  const reminder = document.getElementById('reminderSection');
  const link = document.getElementById('linkSection');
  container.insertBefore(link, reminder);

  // update hidden value
  document.getElementById('todo_type').value = 'today';
}


document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.join-now-btn').forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.stopPropagation(); 
            
            const parent = button.closest('.joinbtns');
            const url = parent?.getAttribute('data-url');
            
            if (url) {
                window.open(url, '_blank'); 
            } 
        });
    });
});

document.querySelectorAll('.jonlinkcls').forEach(el => {
  el.addEventListener('click', function() {
    const link = this.dataset.link; // get value of data-link
    if (link) {
      window.open(link, '_blank'); // open in new tab
    }
  });
});

        </script>
        @endsection