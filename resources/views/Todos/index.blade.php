@php
use Illuminate\Support\Str;
use Carbon\Carbon;
$ratingCategories = ['Reliability', 'Punctuality', 'Accuracy', 'Quality', 'Work Independently'];
@endphp


<?php $page = 'chat'; ?>
@extends('layout.mainlayout')
@section('content')

<style>

    .required{
        border-color:red;
    }

    .invit-img img{
        max-height:80px;
    }

   .user-slider {
    display: flex !important;          /* override Bootstrap row */
    flex-wrap: nowrap !important;      /* prevent new lines */
    overflow-x: auto;
    overflow-y: hidden;
    gap: 10px;
    scrollbar-width: none;
    scroll-behavior: smooth;
    padding: 10px 40px; /* space for arrows */
}

.user-slider::-webkit-scrollbar {
    display: none;
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

.scroll-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: #fff;
    border: none;
    font-size: 26px;
    font-weight: bold;
    color: #555;
    cursor: pointer;
    z-index: 2;
    width: 35px;
    height: 60px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    transition: background 0.2s;
}

.scroll-btn:hover {
    background: #f0f0f0;
}

.left-btn { left: 0; }
.right-btn { right: 0; }




.text-center{
    text-align:center;
}
.rating-group label {
        color: #ccc;
        cursor: pointer;
        font-size: 18px;
        transition: color 0.2s;
        margin-right: 3px;
    }

    .rating-group label.hovered,
    .rating-group label.active {
        color: #facc15; /* gold color for active/hovered stars */
    }

    #timeToday{
        display:flex;
    }
    body {
        overflow-x: hidden;
    }
    .font-12{
        font-size:12px;
    }

    .bg-white{
        background:#fff;
        padding: 5px;
        text-align: center;
        margin: auto;
       /* display: block !important;*/
        border-radius: 5px;
    }

    .counter-div{
        background-color: #4CAF50; height: 43px; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        font-size: 12px; 
        font-weight: bold; 
        color: white; 
        letter-spacing: 1px;
        border-radius:10px;
        width: 150px; 
        margin:auto;
    }

    #endTimeSelect{
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

    .selection-btn{
        background: #f8fafc;
        color: #566a7f;
        border-radius: 6px;
        font-weight: 500;
        font-size: 14px;
        padding: 6px 18px;
        white-space: nowrap;
    }
    .selection-btn.active{
        background: #32b768;
        border: 1px solid #32b768;
        color: white;
    }

    .priority-txt{
        color: #4caf50; 
        font-weight: 500; 
        background:#fff; 
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

    .drop-menu{
        width: 35px; 
        height: 35px; 
        /*background-color: #dddddd; */
        border-radius: 10px; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        cursor: pointer;
    }
    .dropdown-item:hover{
        background:unset !important;
    }
    .drop-icon{
        width: 24px; 
        height: 24px; 
        border: 1.8px solid #7a7a9d; 
        border-radius: 50%; 
        display: flex; 
        align-items: center; 
        justify-content: center;
    }
    .dorp-btns{
        gap: 5px;
        display: flex;
        text-align: center;
        justify-content: center;
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

    .card .card-body{
        padding:0.8rem;
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

    .timers{
        border-bottom:solid 1px;
        max-width:50px;
        margin:auto;
    }
    .todo-type{
        background:#fff;
        padding:5px;
        border-radius:5px;
    }
    .invit-box{
        background: #fff;
        padding: 5px;
        border-radius: 10px;
        margin:5px;
        width:22%;
    }
    .user_div{
        cursor:pointer;
    }
    .user_active{
        border:solid 1px #62c728ff;

    }

    .selection{
        color:#64748b;
    }
    

@media screen and (max-width: 767px) {
    .project-succes{
        display:block !important;
    }
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
        @include('Todos.todosidebar')
    </div>
    <!-- /Left Sidebar Menu -->

    <!-- sidebar group -->
   @include('Todos.notification')
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
                        <img src="{{ asset('storage/' . $user->profile_image) }}" class="rounded-circle" alt="image">
                    </div>
                    <div class="ms-2 overflow-hidden">
                        <h6>{{$user->name}}</h6>
                        <p class="last-seen text-truncate"> {{$user->type}}</p>
                    </div>
                    <div class="overflow-hidden">
                            <h6 class="mb-0" style="cursor:pointer;" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" >
                                <img src="{{ asset('build/img/arrow.svg') }}" alt="arrow"
                                                style="margin-left:10px; width: 18px;"></h6>


                                               
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

                    <div class="chat-body chat-page-group ">
                        <!-- alltodo  -->
                        <div class="project-succes pt-2 pb-2 d-flex flex-wrap justify-content-between align-items-center" style="gap: 10px;">

                            <div>
                                <h3 style="margin: 0;">Today ToDo's</h3>
                                <strong>Total ToDo's: <span id="today_count" class="today_count">{{count($todayTodos)}}</span></strong>
                            </div>

                            <div class="d-flex flex-wrap justify-content-end" style="background: #f8fafc; border-radius: 8px; padding: 6px 10px; gap: 8px; max-width: 100%;">
                                <button class="btn btn-danger addtodo" data-bs-toggle="modal" data-bs-target="#todomodel" style="white-space: nowrap;">
                                    Add TODO
                                </button>
                                
                                <button type="button" cid="all" class="btn selection-btn active typ_btn" >
                                    All
                                </button>
                                <button type="button" cid="private" class="btn selection-btn  typ_btn" >
                                    Private
                                </button>
                                <button type="button" cid="shared" class="btn selection-btn  typ_btn" >
                                    Shared
                                </button>
                                
                                <button type="button" cid="all" class="btn selection-btn active todo_btn" >
                                    All
                                </button>
                                <button type="button" cid="low" class="btn selection-btn todo_btn" >
                                    Low
                                </button>
                                <button type="button" cid="middle" class="btn selection-btn todo_btn" >
                                    Middle
                                </button>
                                <button type="button" cid="high" class="btn selection-btn todo_btn" >
                                    High
                                </button>

                            </div>

                        </div>

                        <!-- CARD CONTAINER -->
                        <div class="row g-3 todo_div">

                            @forelse($todayTodos as $index => $todo)
                            @php
                                $todotyp = "shared";
                                if($todo->is_private == "1"){
                                    $todotyp = "private";
                                    
                                }
                                $owner = 0;
                                if($todo->user_id == $user->_id){
                                    $owner = 1;
                                }

                               // echo time();
                               // $remaining = strtotime($todo->end_date . " " . $todo->end_time) - time();

                                $endDateTime = \Carbon\Carbon::parse($todo->end_date . ' ' . $todo->end_time, 'UTC');
//$remaining = $endDateTime->diffInSeconds(\Carbon\Carbon::createFromTimestamp($ctime, 'UTC'), false);
$remaining = max(0, \Carbon\Carbon::createFromTimestamp($ctime, 'UTC')
                ->diffInSeconds($endDateTime, false));

                                if ($remaining < 0) $remaining = 0;

                                $reminderMinutes = $todo->reminder ?? 60;
                                $reminderSeconds = $reminderMinutes * 60;
                                $part = $reminderSeconds / 3;

                            @endphp
                            <div class="col-12 col-sm-6 col-lg-3 {{$todo->priority}} {{$todotyp}}">
                                <div class="card viewTodo" data-id="{{ $todo->id }}"
    data-title="{{ $todo->title }}"
    data-description=""
    data-start_date="{{ $todo->start_date }}"
    data-start_time="{{ $todo->start_time }}"
    data-end_date="{{ $todo->end_date }}"
    data-end_time="{{ $todo->end_time }}"
    data-is_private="{{ $todo->is_private }}"
    data-priority="{{ $todo->priority }}"
    data-reason="{{$todo->reason}}"
    data-reminder="{{ $todo->reminder }}"
    data-total="{{ $todo->total_time }}"
    data-owner="{{$owner}}"
    data-complete="{{$todo->completed}}"
    data-image="{{ asset('storage/' . $todo->user->profile_image) }}"
    data-sections='@json($todo->description)'
    data-members='@json($todo->members_data)'
    data-files='@json($todo->attachments->map(fn($a) => [
            "name" => $a->file_name."_@_".$a->_id,
            "size" => $a->size,
            "url"  => asset("storage/{$a->file_path}")
        ]))'
    data-own="today"
    data-bs-toggle="modal"
    data-bs-target="#inreject" style=" cursor:pointer; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 6px rgba(0,0,0,0.1); height:max-content;">
                                    <!-- Card Header -->
                                    <div class="d-flex justify-content-between align-items-center" style="background-color: #ececec; padding-right:5px;">
                                        <div class="d-flex">
                                            <img src="{{ asset('storage/' . $todo->user->profile_image) }}" class=" me-2" alt="image" style="width: 42px; height: 42px; margin:5px; margin-top:0px; margin-left:0px; margin-bottom:0px;">
                                            <div>
                                                <div style="font-weight: bold;">{{$user->name;}}</div>
                                                <small style="color: gray;">{{ $todo->created_at->format('d:m:Y - H:i') }}</small>
                                            </div>
                                        </div>

                                         <span class="priority-txt {{$todo->priority}}">
                                            <span class="priority-icon" ></span>
                                            {{$todo->priority}}
                                        </span>

                                        @if ($todo->end_date == date('Y-m-d'))
                                            <span class="priority-txt high">Today</span>
                                        @elseif ($todo->end_date > date('Y-m-d'))
                                            <span class="priority-txt schduled">Scheduled</span>
                                        @endif

                                        
                                        <!--<div style="font-size: 20px; cursor: pointer; margin-right:12px">&#8942;</div>-->
                                        <!-- edit delete starts -->

                                        <div class="dropdown" style="display:none;">
    
<div id="todoMenu{{$todo->id}}" class="drop-menu" onclick="this.nextElementSibling.style.display = this.nextElementSibling.style.display === 'block' ? 'none' : 'block'; event.stopPropagation();">
                                                <div class="drop-icon">
                                                    <span style="color: #2e3a59; font-size: 18px; font-weight: bold; margin-bottom: 8px;">...</span>
                                                </div>
                                            </div>


    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="todoMenu{{$todo->id}}" style="height:80px; padding-top: 10px; overflow:hidden; text-align:center; position:absolute; right:0;">
        <div style="font-size: 13px; color: #7a7a9d; font-weight: 600; margin-bottom: 8px;">Options</div>
        <div class="dorp-btns">
            <button type="submit" class="btn btn-sm1 btn-icon1" style="padding:0px; margin-top:-5px;"   >
                <a href="javascript:void(0);" style="height:40px; width:40px; padding:0px;" 
               class="dropdown-item text-danger" 
               onclick="
        Swal.fire({
            title: 'Are you sure?',
            text: 'Are you sure you want to delete this?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            customClass: {
                confirmButton: 'btn btn-danger me-3',
                cancelButton: 'btn btn-label-secondary'
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                let form = document.getElementById('deleteForm');
                form.action = '{{ route('todos.destroy', $todo->id) }}';
                form.submit();
            }
        });
    ">
               <!--<i class="fa fa-trash"></i> -->
               <img src="https://admin.onlinesystems.info/build/img/delete1.svg" alt="Delete" style="width: 25px; cursor: pointer;">
                </a>
                
            </button>

            <div style="width: 1px; height: 18px; background-color: #ccc;"></div>

            <button type="button" class="btn btn-sm1 btn-icon1 edit_{{ $todo->id }}" style="padding:0px; margin-top:-5px;"   >
                <a href="javascript:void(0);" style="height:40px; width:40px; padding:0px;"  
               class="dropdown-item text-primary editTodo" 
               data-id="{{ $todo->id }}"
                data-title="{{ $todo->title }}"
                data-description=""
                data-start_date="{{ $todo->start_date }}"
                data-start_time="{{ $todo->start_time }}"
                data-end_date="{{ $todo->end_date }}"
                data-end_time="{{ $todo->end_time }}"
                data-is_private="{{ $todo->is_private }}"
                data-priority="{{ $todo->priority }}"
                data-reminder="{{ $todo->reminder }}"
                data-total="{{ $todo->total_time }}"
                data-sections='@json($todo->description)'
                data-members='@json($todo->members_data)'
                    data-bs-toggle="modal" data-bs-target="#todomodel">
               
               <img src="https://admin.onlinesystems.info/build/img/Edit1.svg" alt="Edit" style="width: 25px; cursor: pointer;" />
            </a>

            </button>

            <div style="width: 1px; height: 18px; background-color: #ccc;"></div>

            <button type="button" class="btn btn-sm1 btn-icon1" style="padding:0px; margin-top:-13px;"   >
                <a href="javascript:void(0);"  style="padding-top:0px; "
               class="dropdown-item text-primary viewTodo" 
               data-id="{{ $todo->id }}"
   data-title="{{ $todo->title }}"
   data-description=""
   data-start_date="{{ $todo->start_date }}"
   data-start_time="{{ $todo->start_time }}"
   data-end_date="{{ $todo->end_date }}"
   data-end_time="{{ $todo->end_time }}"
   data-is_private="{{ $todo->is_private }}"
   data-priority="{{ $todo->priority }}"
   data-reminder="{{ $todo->reminder }}"
   data-image="{{ asset('storage/' . $todo->user->profile_image) }}"
   data-total="{{ $todo->total_time }}"
   data-sections='@json($todo->description)'
   data-members='@json($todo->members_data)'
    data-bs-toggle="modal" data-bs-target="#inreject">
               
               <img src="{{asset('/assets/img/viewic.png')}}" alt="Edit" style="width: 25px; cursor: pointer;" />
            </a>

            </button>
</div>
            
</div>
</div>


                                        <!-- edit delete ends -->
                                    </div>

                                    <!-- Card Body -->
                                    <div class="card-body ">
                                        <!-- Title & Avatars -->
                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <div class="d-flex align-items-center">
                                                
                                                <div>
                                                    <h6 class="mb-0 fw-bold" style="font-size: 14px;">{{$todo->title}}</h6>
                                                    
                                                    @if($todo->is_private == 0)
                                                        <small class="text-muted">
                                                            <img src="{{URL::asset('/build/img/share.svg')}}" style="width: 20px; height: 20px;" /> Shared
                                                        </small>
                            

                                                    @else
                                                        <small class="text-muted">
                                                             Private
                                                        </small>
                                                    @endif
                                                </div>
                                            </div>
                                            <!-- Avatars -->
                                            <div class="d-flex" style="margin-left: auto;">
                                                <div style="position: relative; width: 60px; height: 30px;">
                                                    @if($todo->is_private == 0)
                                                        <div class="overlap-container">
                                                            @foreach($todo->members_data as $mem)
                                                            <img src="{{ $mem['image']}}">
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Description -->
                                        <p class="mb-3 mt-3" style="font-size: 13px; color: #333;">


                                            @foreach($todo->description as $idx => $des)
                                                @if($loop->first)
                                                    <div style="background:#f8f8f8;border-radius:6px;padding:8px 12px;margin-bottom:8px;display:flex;align-items:center;">
                                                        <img src="/build/img/tera.svg" width="18" height="18" style="margin-right:10px;">
                                                        <span style="color:#667085;font-size:13.5px;">{{ Str::limit($des, 40) }}</span>
                                                    </div>
                                                @endif
                                            @endforeach

                                        </p>
    
                                        <!-- Date & Priority Row -->
                                        <div class="d-flex1 justify-content-between align-items-center p-1 rounded" style="background-color: #f8f8f8; font-size: 11px;border-radius:10px;">
                                            
                                                @if($todo->is_schduled == 0 && $todo->end_date == date("Y-m-d"))
                                                <div class="d-flex align-items-center gap-1 text-center" style="gap: unset !important; justify-content: inherit; font-size:13px; gap: .35rem !important;" >
                                                    <span class="text-success fw-semibold">Start: <br> <span style="color: #e64241;">
                                                        Today</span></span>
                                                    <span></span>
                                                    
                                                    <span class="text-muted">|</span>
                                                    <span class="text-success fw-semibold">Deliver Time:<br>
                                                        <span style="color: #1c274c;">
                                                            {{$todo->total_time}} Hours
                                                        </span>
                                                    </span>
                                                
                                                @else
                                                <div class="d-flex align-items-center gap-1 text-center" style="justify-content: inherit; font-size:13px; gap: unset !important;" >
                                                    <span class="text-success fw-semibold">Start: <br> <span style="color: #1c274c;">{{ \Carbon\Carbon::parse($todo->start_date)->format('d-m-Y') }}</span></span>
                                                    <span></span>
                                                    <span class="text-muted">|</span>
                                                    <span class="text-success fw-semibold">Deliver:<br><span style="color: #1c274c;">{{ \Carbon\Carbon::parse($todo->end_date)->format('d-m-Y') }}</span></span>
                                                    
                                                    <span></span>
                                                    <span class="text-muted">|</span>
                                                    <span class="text-success fw-semibold">Deliver Time:<br><span style="color: #1c274c;">{{ \Carbon\Carbon::parse($todo->end_time)->format('H:i') }}</span></span>
                                                
                                                @endif
                                            </div>
                                        </div>
                                    

                                    <!-- Footer Button -->
                                    <div class="d-flex justify-content-center py-2" style="margin-top: -10px;">
                                        
                                        @php
                                            // Combine date and time
                                            $endDateTime = \Carbon\Carbon::parse($todo->end_date . ' ' . $todo->end_time);
                                        @endphp

                                        
    </div>

                                        <div class="counter-div" id="timer-{{ $index }}" data-reminder-active="0" data-todo-id="{{ $todo->id }}">
                                            <span id="asimclic-{{ $index }}"></span>
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

                        let todoCard = document.querySelector('.viewTodo[data-id="{{ $todo->id }}"]');
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
                            </div>
                            <!-- End of Card 1 -->
                            @empty
                                <div class="alert alert-warning">No todos for today.</div>
                            @endforelse
                            
                        </div>
                        <!-- private todo -->
                        <div class="project-succes pt-2 pb-2 d-flex justify-content-between align-items-center">
                            <div>
                                <h3 style="margin: 0;">Private & Shared ToDo's</h3>
                                <strong>Own Private & Shared ToDo's: <span id="private_count">{{count($privateTodos)}}</span></strong>
                            </div>

                            <div class="d-flex" style="gap: 8px; background: #f8fafc; padding: 6px 10px; border-radius: 8px;margin-right:20px;">


                               <button type="button" cid="all" class="btn selection-btn active private_btn" >
                                    All
                                </button>
                                <button type="button" cid="low" class="btn selection-btn private_btn" >
                                    Low
                                </button>
                                <button type="button" cid="middle" class="btn selection-btn private_btn" >
                                    Middle
                                </button>
                                <button type="button" cid="high" class="btn selection-btn private_btn" >
                                    High
                                </button>
                                

                            </div>

                        </div>
                        <!-- CARD CONTAINER -->
                        <div class="row g-3 private_div">
                            <!-- Start of Card 1 -->
                             @forelse($privateTodos  as $index => $todo)
                            
                             @php
                             $todotyp = "shared";
                                if($todo->is_private == "1"){
                                    $todotyp = "private";
                                    
                                }
                            
                             
                                //$remaining = strtotime($todo->end_date . " " . $todo->end_time) - time();

// echo time();
                               // $remaining = strtotime($todo->end_date . " " . $todo->end_time) - time();

                                $endDateTime = \Carbon\Carbon::parse($todo->end_date . ' ' . $todo->end_time, 'UTC');
//$remaining = $endDateTime->diffInSeconds(\Carbon\Carbon::createFromTimestamp($ctime, 'UTC'), false);
$remaining = max(0, \Carbon\Carbon::createFromTimestamp($ctime, 'UTC')
                ->diffInSeconds($endDateTime, false));


                                if ($remaining < 0) $remaining = 0;

                                $reminderMinutes = $todo->reminder ?? 60;
                                $reminderSeconds = $reminderMinutes * 60;
                                $part = $reminderSeconds / 3;
                            @endphp    
                            <div class="col-12 col-sm-6 col-lg-3 {{$todo->priority}}">
                                <div class="card viewTodo" data-id="{{ $todo->id }}"
    data-title="{{ $todo->title }}"
    data-description=""
    data-start_date="{{ $todo->start_date }}"
    data-start_time="{{ $todo->start_time }}"
    data-end_date="{{ $todo->end_date }}"
    data-end_time="{{ $todo->end_time }}"
    data-is_private="{{ $todo->is_private }}"
    data-priority="{{ $todo->priority }}"
    data-reminder="{{ $todo->reminder }}"
    data-total="{{ $todo->total_time }}"
    data-image="{{ asset('storage/' . $todo->user->profile_image) }}"
    data-sections='@json($todo->description)'
    data-own="private"
    data-files='@json($todo->attachments->map(fn($a) => [
            "name" => $a->file_name."_@_".$a->_id,
            "size" => $a->size,
            "url"  => asset("storage/{$a->file_path}")
        ]))'
    data-members='@json($todo->members_data)'
    data-bs-toggle="modal"
    data-bs-target="#inreject" style=" cursor:pointer; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 6px rgba(0,0,0,0.1); height:max-content;">
                                    <!-- Card Header -->
                                    <div class="d-flex justify-content-between align-items-center" style="background-color: #ececec; padding-right:5px;">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('storage/' . $todo->user->profile_image) }}" class=" me-2" alt="image" style="width: 42px; height: 42px; margin:5px; margin-left:0px; margin-top:0px; margin-bottom:0px;">
                                            <div>
                                                <div style="font-weight: bold;">{{$user->name;}}</div>
                                                <small style="color: gray;">{{ $todo->created_at->format('d:m:Y - H:i') }}</small>
                                            </div>
                                        </div>

                                        <span class="priority-txt  {{$todo->priority}}">
                                            <span class="priority-icon" ></span>
                                            {{$todo->priority}}
                                        </span>
                                        @if ($todo->end_date == date('Y-m-d'))
                                            <span class="priority-txt high">Today</span>
                                        @elseif ($todo->end_date > date('Y-m-d'))
                                            <span class="priority-txt schduled">Scheduled</span>
                                        @endif
                                        

<!-- edit delete starts -->

                                        <div class="dropdown"  style="display:none;">
    <div id="todoMenu{{$todo->id}}" class="drop-menu" onclick="this.nextElementSibling.style.display = this.nextElementSibling.style.display === 'block' ? 'none' : 'block'; event.stopPropagation();">
                                                <div class="drop-icon">
                                                    <span style="color: #2e3a59; font-size: 18px; font-weight: bold; margin-bottom: 8px;">...</span>
                                                </div>
                                            </div>

    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="todoMenu{{$todo->id}}" style="height:80px; padding-top: 10px; overflow:hidden; text-align:center; position:absolute; right:0;">
        <div style="font-size: 13px; color: #7a7a9d; font-weight: 600; margin-bottom: 8px;">Options</div>    
            <div class="dorp-btns">
            <button type="submit" class="btn btn-sm1 btn-icon1" style="padding:0px; margin-top:-5px;"   >
                <a href="javascript:void(0);" style="height:40px; width:40px; padding:0px;" 
               class="dropdown-item text-danger" 
               onclick="
        Swal.fire({
            title: 'Are you sure?',
            text: 'Are you sure you want to delete this?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            customClass: {
                confirmButton: 'btn btn-danger me-3',
                cancelButton: 'btn btn-label-secondary'
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                let form = document.getElementById('deleteForm');
                form.action = '{{ route('todos.destroy', $todo->id) }}';
                form.submit();
            }
        });
    ">
               <!--<i class="fa fa-trash"></i> -->
               <img src="https://admin.onlinesystems.info/build/img/delete1.svg" alt="Delete" style="width: 25px; cursor: pointer;">
                </a>
                
            </button>

            <div style="width: 1px; height: 18px; background-color: #ccc;"></div>

            <button type="button" class="btn btn-sm1 btn-icon1 edit_{{ $todo->id }}" style="padding:0px; margin-top:-5px;"   >
                <a href="javascript:void(0);" style="height:40px; width:40px; padding:0px;"  
               class="dropdown-item text-primary editTodo" 
               data-id="{{ $todo->id }}"
                data-title="{{ $todo->title }}"
                data-description=""
                data-start_date="{{ $todo->start_date }}"
                data-start_time="{{ $todo->start_time }}"
                data-end_date="{{ $todo->end_date }}"
                data-end_time="{{ $todo->end_time }}"
                data-is_private="{{ $todo->is_private }}"
                data-priority="{{ $todo->priority }}"
                data-reminder="{{ $todo->reminder }}"
                data-total="{{ $todo->total_time }}"
                data-sections='@json($todo->description)'
                data-members='@json($todo->members_data)'
                    data-bs-toggle="modal" data-bs-target="#todomodel">
               
               <img src="https://admin.onlinesystems.info/build/img/Edit1.svg" alt="Edit" style="width: 25px; cursor: pointer;" />
            </a>

            </button>

            <div style="width: 1px; height: 18px; background-color: #ccc;"></div>

            <button type="button" class="btn btn-sm1 btn-icon1" style="padding:0px; margin-top:-13px;"   >
                <a href="javascript:void(0);"  style="padding-top:0px; "
               class="dropdown-item text-primary viewTodo" 
               data-id="{{ $todo->id }}"
   data-title="{{ $todo->title }}"
   data-description=""
   data-start_date="{{ $todo->start_date }}"
   data-start_time="{{ $todo->start_time }}"
   data-end_date="{{ $todo->end_date }}"
   data-end_time="{{ $todo->end_time }}"
   data-is_private="{{ $todo->is_private }}"
   data-priority="{{ $todo->priority }}"
   data-reminder="{{ $todo->reminder }}"
   data-image="{{ asset('storage/' . $todo->user->profile_image) }}"
   data-total="{{ $todo->total_time }}"
   data-sections='@json($todo->description)'
   data-members='@json($todo->members_data)'
    data-bs-toggle="modal" data-bs-target="#inreject">
               
               <img src="{{asset('/assets/img/viewic.png')}}" alt="Edit" style="width: 25px; cursor: pointer;" />
            </a>

            </button>
</div>
             
   

</div>
</div>


                                        <!-- edit delete ends -->


                                    </div>

                                    <!-- Card Body -->
                                    <div class="card-body ">
                                        <!-- Title & Avatars -->
                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <div class="d-flex align-items-center">
                                                 <div>
                                                    <h6 class="mb-0 fw-bold" style="font-size: 14px;">{{$todo->title}}</h6>
                                                    @if($todo->is_private == 0)
                                                        <small class="text-muted">
                                                            <img src="{{URL::asset('/build/img/share.svg')}}" style="width: 20px; height: 20px;" /> Shared
                                                        </small>
                            

                                                    @else
                                                        <small class="text-muted">
                                                             Private
                                                        </small>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="d-flex" style="margin-left: auto;">
                                                <div style="position: relative; width: 60px; height: 30px;">
                                                    <div style="position: relative; width: 60px; height: 30px;">
                                                        @if($todo->is_private == 0)
                                                            <div class="overlap-container">
                                                                @foreach($todo->members_data as $mem)
                                                                <img src="{{ $mem['image']}}">
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <!-- Description -->
                                        <p class=" mt-3" style="font-size: 13px; color: #333;">
                                            @foreach($todo->description as $idx => $des)
                                                @if($loop->first)
                                                    <div style="background:#f8f8f8;border-radius:6px;padding:8px 12px;margin-bottom:8px;display:flex;align-items:center;">
                                                        <img src="/build/img/tera.svg" width="18" height="18" style="margin-right:10px;">
                                                        <span style="color:#667085;font-size:13.5px;">{{ Str::limit($des, 40) }}</span>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </p>

                                        <!-- Date & Priority Row -->
                                        
                                    

                                         <div class="d-flex1 justify-content-between align-items-center p-1 rounded" style="background-color: #f8f8f8; font-size: 11px;border-radius:10px;">
                                            
                                                
                                                @if($todo->is_schduled == 0 && $todo->end_date == date("Y-m-d"))
                                                <div class="d-flex align-items-center gap-1 text-center " style="gap: unset !important; justify-content: inherit;font-size:14px;" >
                                                    <span class="text-success fw-semibold">Start: <br> <span style="color: #e64241;">
                                                        Today</span></span>
                                                    <span></span>
                                                    
                                                    <span class="text-muted">|</span>
                                                    <span class="text-success fw-semibold">Deliver Time:<br>
                                                        <span style="color: #1c274c;">
                                                            {{$todo->total_time}} Hours
                                                        </span>
                                                    </span>
                                                
                                                @else
                                                <div class="d-flex align-items-center gap-1 text-center"  style="justify-content: inherit;font-size:14px; gap: unset !important;">
                                                    <span class="text-success fw-semibold">Start: <br> <span style="color: #1c274c;">{{ \Carbon\Carbon::parse($todo->start_date)->format('d-m-Y') }}</span></span>
                                                    <span></span>
                                                    <span class="text-muted">|</span>
                                                    <span class="text-success fw-semibold">Deliver:<br><span style="color: #1c274c;">{{ \Carbon\Carbon::parse($todo->end_date)->format('d-m-Y') }}</span></span>
                                                    
                                                    <span></span>
                                                    <span class="text-muted">|</span>
                                                    <span class="text-success fw-semibold">Deliver Time:<br><span style="color: #1c274c;">{{ \Carbon\Carbon::parse($todo->end_time)->format('H:i') }}</span></span>
                                                
                                                @endif
                                            </div>
                                        </div>

<div class="d-flex justify-content-center py-2" style="margin-top: -10px;"></div>
<div class="counter-div" id="pvttimer-{{ $index }}">
        <span id="pvtasimclic-{{ $index }}"></span>
    </div>
                                 
    
    
                                    @if($remaining > 0)
    <script>
        (function() {
            let duration = {{ $remaining }};
            let display = document.getElementById('pvtasimclic-{{ $index }}');
            let container = document.getElementById('pvttimer-{{ $index }}');
            let part = {{ $part }};
            let reminderSeconds = {{ $reminderSeconds }};

            // hide timer initially if not in reminder period yet
            if (duration > reminderSeconds) {
                container.style.display = "none";
            }

            function pvtupdateClock() {
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

                    // color changes during reminder phase
                    if (duration <= 0) {
                        container.style.backgroundColor = "#e74c3c"; // ðŸ”´ Final stage
                        clearInterval(timer);
                    } else if (duration <= part) {
                        container.style.backgroundColor = "#e74c3c"; // ðŸ”´ last 1/3
                    } else if (duration <= part * 2) {
                        container.style.backgroundColor = "#ff9800"; // ðŸŸ  middle 1/3
                    } else {
                        container.style.backgroundColor = "#4CAF50"; // ðŸŸ¢ first 1/3
                    }
                }

                duration--;
            }

            pvtupdateClock();
            let timer = setInterval(pvtupdateClock, 1000);
        })();
    </script>
@else
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let container = document.getElementById('pvttimer-{{ $index }}');
            let display = document.getElementById('pvtasimclic-{{ $index }}');
            display.innerText = "Task Expired";
            container.style.backgroundColor = "#e74c3c";
        });
    </script>
@endif

                                    


                                        </div>
                                    <!-- Footer Button -->

                                </div>
                            </div>
                            <!-- End of Card 1 -->
                             @empty
                                <div class="alert alert-warning">No private todos.</div>
                            @endforelse
                           
                        </div>
                        <!-- shared todo -->
                        <div class="project-succes pt-4 pb-2 d-flex justify-content-between align-items-center">
                            <div>
                                <h3 style="margin: 0;">Received ToDo's</h3>
                                <strong>Received Shared ToDo's: <span id="shared_count">{{count($sharedTodos)}}</span></strong>
                            </div>

                            <div class="d-flex" style="gap: 8px; background: #f8fafc; padding: 6px 10px; border-radius: 8px;margin-right:20px;">


                                <button type="button" cid="all" class="btn selection-btn active shared_btn" >
                                    All
                                </button>
                                <button type="button" cid="low" class="btn selection-btn shared_btn" >
                                    Low
                                </button>
                                <button type="button" cid="middle" class="btn selection-btn shared_btn" >
                                    Middle
                                </button>
                                <button type="button" cid="high" class="btn selection-btn shared_btn" >
                                    High
                                </button>

                            </div>

                        </div>
                        <!-- CARD CONTAINER -->
                        <div class="row g-3 shared_div">
                            @forelse($sharedTodos  as $index => $todo)

                            @php
                               // $remaining = strtotime($todo->end_date . " " . $todo->end_time) - time();

// echo time();
                               // $remaining = strtotime($todo->end_date . " " . $todo->end_time) - time();

                                $endDateTime = \Carbon\Carbon::parse($todo->end_date . ' ' . $todo->end_time, 'UTC');
//$remaining = $endDateTime->diffInSeconds(\Carbon\Carbon::createFromTimestamp($ctime, 'UTC'), false);
$remaining = max(0, \Carbon\Carbon::createFromTimestamp($ctime, 'UTC')
                ->diffInSeconds($endDateTime, false));


                                if ($remaining < 0) $remaining = 0;

                                $reminderMinutes = $todo->reminder ?? 60;
                                $reminderSeconds = $reminderMinutes * 60;
                                $part = $reminderSeconds / 3;
                            @endphp  
                            <!-- Start of Card 1 -->
                            <div class="col-12 col-sm-6 col-lg-3 {{$todo->priority}}">
                                <div class="card viewTodo" data-id="{{ $todo->id }}"
    data-title="{{ $todo->title }}"
    data-description=""
    data-start_date="{{ $todo->start_date }}"
    data-start_time="{{ $todo->start_time }}"
    data-end_date="{{ $todo->end_date }}"
    data-end_time="{{ $todo->end_time }}"
    data-is_private="{{ $todo->is_private }}"
    data-priority="{{ $todo->priority }}"
    data-reminder="{{ $todo->reminder }}"
    data-own="0"
    data-files='@json($todo->attachments->map(fn($a) => [
            "name" => $a->file_name."_@_".$a->_id,
            "size" => $a->size,
            "url"  => asset("storage/{$a->file_path}")
        ]))'
    data-image="{{ asset('storage/' . $todo->user->profile_image) }}"
    data-total="{{ $todo->total_time }}"
    data-sections='@json($todo->description)'
    data-members='@json($todo->members_data)'
    data-bs-toggle="modal"
    data-bs-target="#inreject" style=" cursor:pointer; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 6px rgba(0,0,0,0.1); height:max-content;">
                                    <!-- Card Header -->
                                    <div class="d-flex justify-content-between align-items-center" style="background-color: #ececec; padding-right:5px;">
                                        <div class="d-flex">
                                            <img src="{{ asset('storage/' . $todo->user->profile_image) }}" class=" me-2" alt="image" style="width: 42px; height: 42px; margin:5px; margin-left:0px; margin-top:0px; margin-bottom:0px;">
                                            <div>
                                                <div style="font-weight: bold;">{{$user->name;}}</div>
                                                <small style="color: gray;">{{ $todo->created_at->format('d:m:Y - H:i') }}</small>
                                            </div>
                                        </div>
                                        <!--<div style="font-size: 20px; cursor: pointer; margin-right:12px">&#8942;</div>-->
                                        <!-- edit delete starts -->

                                        <span class="priority-txt  {{$todo->priority}}">
                                            <span class="priority-icon" ></span>
                                            {{$todo->priority}}
                                        </span>
                                        @if ($todo->end_date == date('Y-m-d'))
                                            <span class="priority-txt high">Today</span>
                                        @elseif ($todo->end_date > date('Y-m-d'))
                                            <span class="priority-txt schduled">Scheduled</span>
                                        @endif

                                        <div class="dropdown" style="display:none;">
        <div id="todoMenu{{$todo->id}}" class="drop-menu" onclick="this.nextElementSibling.style.display = this.nextElementSibling.style.display === 'block' ? 'none' : 'block'; event.stopPropagation();">
                                                <div class="drop-icon">
                                                    <span style="color: #2e3a59; font-size: 18px; font-weight: bold; margin-bottom: 8px;">...</span>
                                                </div>
                                            </div>
    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="todoMenu{{$todo->id}}" style="height:80px; padding-top: 10px; overflow:hidden; text-align:center; position:absolute; right:0;">
        <div style="font-size: 13px; color: #7a7a9d; font-weight: 600; margin-bottom: 8px;">Options</div>
        <div class="dorp-btns">  

            <button type="button" class="btn btn-sm1 btn-icon1" style="padding:0px; "   >
                <a href="javascript:void(0);"  style="padding-top:0px; "
               class="dropdown-item text-primary viewTodo" 
               data-id="{{ $todo->id }}"
   data-title="{{ $todo->title }}"
   data-description=""
   data-start_date="{{ $todo->start_date }}"
   data-start_time="{{ $todo->start_time }}"
   data-end_date="{{ $todo->end_date }}"
   data-end_time="{{ $todo->end_time }}"
   data-is_private="{{ $todo->is_private }}"
   data-priority="{{ $todo->priority }}"
   data-image="{{ asset('storage/' . $todo->user->profile_image) }}"
   data-reminder="{{ $todo->reminder }}"
   data-total="{{ $todo->total_time }}"
   data-sections='@json($todo->description)'
   data-members='@json($todo->members_data)'
    data-bs-toggle="modal" data-bs-target="#inreject">
               
               <img src="{{asset('/assets/img/viewic.png')}}" alt="Edit" style="width: 25px; cursor: pointer;" />
            </a>

            </button>

            <button type="submit" class="btn btn-sm btn-icon" style="display:none;"   >
                <a href="javascript:void(0);" 
               class="dropdown-item text-primary" 
               data-id="{{ $todo->_id }}"
    data-title="{{ $todo->title }}"
    data-description=""
    data-start_date="{{ $todo->start_date }}"
    data-start_time="{{ $todo->start_time }}"
    data-end_date="{{ $todo->end_date }}"
    data-end_time="{{ $todo->end_time }}"
    data-is_private="{{ $todo->is_private }}"
    data-project="{{ $todo->project }}"
    data-priority="{{ $todo->priority }}"
    data-reminder="{{ $todo->reminder }}"
    data-members='@json($todo->members)'
    onclick="openEditModal(this)">
               <i class="fa fa-edit"></i>  
            </a>

            </button>

</div>
            

</div>
</div>


                                        <!-- edit delete ends -->
                                    </div>

                                    <!-- Card Body -->
                                    <div class="card-body ">
                                        <!-- Title & Avatars -->
                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <h6 class="mb-0 fw-bold" style="font-size: 14px;">{{$todo->title}}</h6>
                                                    <small class="text-muted">
                                                        <img src="{{URL::asset('/build/img/share.svg')}}" style="width: 20px; height: 20px;" /> Shared
                                                    </small>
                                                </div>
                                            </div>
                                            <!-- Avatars -->
                                            <div class="d-flex" style="margin-left: auto;">
                                                <div style="position: relative; width: 60px; height: 30px;">
                                                    <div style="position: relative; width: 60px; height: 30px;">
                                                        @if($todo->is_private == 0)
                                                            <div class="overlap-container">
                                                                @foreach($todo->members_data as $mem)
                                                                <img src="{{ $mem['image']}}">
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Description -->
                                        <p class=" mt-3" style="font-size: 13px; color: #333;">
                                           @foreach($todo->description as $idx => $des)
                                                @if($loop->first)
                                                    <div style="background:#f8f8f8;border-radius:6px;padding:8px 12px;margin-bottom:8px;display:flex;align-items:center;">
                                                        <img src="/build/img/tera.svg" width="18" height="18" style="margin-right:10px;">
                                                        <span style="color:#667085;font-size:13.5px;">{{ Str::limit($des, 40) }}</span>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </p>
                                        
                                        <!-- Date & Priority Row -->
                                             <div class="d-flex1 justify-content-between align-items-center p-1 rounded" style="background-color: #f8f8f8; font-size: 11px;border-radius:10px;">
                                            
                                                
                                                @if($todo->is_schduled == 0 && $todo->end_date == date("Y-m-d"))
                                                <div class="d-flex align-items-center gap-1 text-center " style="gap: unset !important; justify-content: inherit;font-size:14px;" >
                                                    <span class="text-success fw-semibold">Start: <br> <span style="color: #e64241;">
                                                        Today</span></span>
                                                    <span></span>
                                                    
                                                    <span class="text-muted">|</span>
                                                    <span class="text-success fw-semibold">Deliver Time:<br>
                                                        <span style="color: #1c274c;">
                                                            {{$todo->total_time}} Hours
                                                        </span>
                                                    </span>
                                                
                                                @else
                                                <div class="d-flex align-items-center gap-1 text-center "  style="justify-content: inherit;font-size:14px; gap: unset !important;">
                                                    <span class="text-success fw-semibold">Start: <br> <span style="color: #1c274c;">{{ \Carbon\Carbon::parse($todo->start_date)->format('d-m-Y') }}</span></span>
                                                    <span></span>
                                                    <span class="text-muted">|</span>
                                                    <span class="text-success fw-semibold">Deliver:<br><span style="color: #1c274c;">{{ \Carbon\Carbon::parse($todo->end_date)->format('d-m-Y') }}</span></span>
                                                    
                                                    <span></span>
                                                    <span class="text-muted">|</span>
                                                    <span class="text-success fw-semibold">Deliver Time:<br><span style="color: #1c274c;">{{ \Carbon\Carbon::parse($todo->end_time)->format('H:i') }}</span></span>
                                                
                                                @endif
                                            </div>
                                        </div>

<div class="d-flex justify-content-center py-2" style="margin-top: -10px;"></div>
<div class="counter-div" id="shtimer-{{ $index }}">
        <span id="shasimclic-{{ $index }}"></span>
    </div>
                                    
 @if($remaining > 0)
    <script>
        (function() {
            let duration = {{ $remaining }};
            let display = document.getElementById('shasimclic-{{ $index }}');
            let container = document.getElementById('shtimer-{{ $index }}');
            let part = {{ $part }};
            let reminderSeconds = {{ $reminderSeconds }};

            // hide timer initially if not in reminder period yet
            if (duration > reminderSeconds) {
                container.style.display = "none";
            }

            function shupdateClock() {
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

                    // color changes during reminder phase
                    if (duration <= 0) {
                        container.style.backgroundColor = "#e74c3c"; // ðŸ”´ Final stage
                        clearInterval(timer);
                    } else if (duration <= part) {
                        container.style.backgroundColor = "#e74c3c"; // ðŸ”´ last 1/3
                    } else if (duration <= part * 2) {
                        container.style.backgroundColor = "#ff9800"; // ðŸŸ  middle 1/3
                    } else {
                        container.style.backgroundColor = "#4CAF50"; // ðŸŸ¢ first 1/3
                    }
                }

                duration--;
            }

            shupdateClock();
            let timer = setInterval(shupdateClock, 1000);
        })();
    </script>
@else
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let container = document.getElementById('shtimer-{{ $index }}');
            let display = document.getElementById('shasimclic-{{ $index }}');
            display.innerText = "Task Expired";
            container.style.backgroundColor = "#e74c3c";
        });
    </script>
@endif
                                   
                                    </div>

                                    <!-- Footer Button -->

                                </div>
                            </div>
                            <!-- End of Card 1 -->
                           @empty
                                <div class="alert alert-warning">No shared todos.</div>
                        @endforelse
                            
                        </div>
                    </div>
                </div>


            </div>

        </div>

    </div>

</div>
<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content" style="border-radius: 12px;">
            <div class="modal-body text-center">
                <h6>Are you sure you want to delete this ToDo?</h6>
                <form id="deleteForm" method="POST">
                    @csrf
                    
                    <div class="mt-3 d-flex justify-content-center gap-2">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content" style="border-radius: 15px; border: none; box-shadow: 0 0 20px rgba(0,0,0,0.05); position: relative;">

            <!-- Close Button 
            <button type="button"
                data-bs-dismiss="modal"
                aria-label="Close"
                onclick="this.closest('.modal').classList.remove('show'); this.closest('.modal').style.display='none';"
                style="color: #1e293b; font-weight: bold; z-index: 999; width: 32px; height: 32px; line-height: 28px; text-align: center; font-size: 20px; position: absolute; top: 8px; right: 12px; border: none; background-color: transparent; border-radius: 50%; transition: all 0.3s ease;">
                Ã— removed close
            </button>-->

            <form id="editForm" method="POST">
                @csrf

                <!-- Hidden defaults -->
                <input type="hidden" name="start_date" id="editStartDateHidden">
                <input type="hidden" name="start_time" id="editStartTimeHidden">
                <input type="hidden" name="end_time" id="editEndTimeHidden">
                <input type="hidden" name="is_private" id="editIsPrivateHidden" value="0">
                <input type="hidden" name="priority" id="editPriorityHidden" value="low">
                <input type="hidden" name="reminder" id="editReminderHidden" value="30">

                <div class="modal-body p-4" style="background-color: white;">
                    <!-- Header -->
                    <h5 style="font-weight: 600; color: #1e293b;">Edit ToDo</h5>
                    <p style="color: #64748b; font-size: 14px;">Update your task</p>

                    <!-- ToDo Details -->
                    <div style="background-color: #f9f9fb; border-radius: 12px; padding: 16px; margin-bottom: 16px;">
                        <div class="row g-2">
                            <div class="col-md-6">
                                <input name="title" required id="editTitle" type="text" class="form-control"
                                    placeholder="ToDo Title" style="font-size: 13px; border-radius: 8px;">
                            </div>
                            
                        </div>
                        <div class="row g-2">

                            <div class="col-md-12">
                                <input name="description" id="editDescription" type="text"
                                    class="form-control" placeholder="Describe the ToDo's"
                                    style="font-size: 13px; border-radius: 8px;">
                            </div>

                        </div>
                    </div>

                    <!-- Date & Time -->
                    <div style="background-color: #f9f9fb; border-radius: 12px; padding: 16px; margin-bottom: 16px;">
                        <div class="row g-2">
                            <div class="col-md-4">
                                <input type="date" id="editDateInput" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <select id="editStartTimeSelect" class="form-control">
                                    <option value="">Select Start</option>
                                    @for ($h = 0; $h < 24; $h++)
                                        @php $time = sprintf("%02d:00", $h); @endphp
                                        <option value="{{ $time }}">{{ $time }}</option>
                                        @php $time = sprintf("%02d:30", $h); @endphp
                                        <option value="{{ $time }}">{{ $time }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select id="editEndTimeSelect" class="form-control">
                                    <option value="">Select End</option>
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

                    <!-- Project & Members -->
                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <input type="text" name="project" id="editProject" class="form-control" placeholder="Project">
                        </div>
                        <div class="col-md-6">
                            <select class="form-control" id="editMembers" multiple name="members[]">
                                @foreach($users as $cuser)
                                    <option value="{{ $cuser->_id }}">{{ $cuser->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Priority & Reminder (toggle buttons like add form) -->
                    <div class="p-3 mb-3 rounded" style="background-color: #f9f9fb;">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <p style="font-size: 12px; font-weight: 600; color: #334155;">Priority</p>
                                <div class="d-flex gap-2">
                                    <button type="button" id="editPriorityLow" class="btn btn-sm">Low</button>
                                    <button type="button" id="editPriorityMiddle" class="btn btn-sm">Middle</button>
                                    <button type="button" id="editPriorityHigh" class="btn btn-sm">High</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <p style="font-size: 12px; font-weight: 600; color: #334155;">Reminder</p>
                                <div class="d-flex gap-2">
                                    <button type="button" id="editReminder6" class="btn btn-sm">6 Hr</button>
                                    <button type="button" id="editReminder12" class="btn btn-sm">12 Hr</button>
                                    <button type="button" id="editReminder24" class="btn btn-sm">24 Hr</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="todomodel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content" style="border-radius: 15px; border: none; box-shadow: 0 0 20px rgba(0,0,0,0.05); position: relative;">

            <!-- Close Button 
            <button type="button"
                data-bs-dismiss="modal"
                aria-label="Close"
                onclick="this.closest('.modal').classList.remove('show'); this.closest('.modal').style.display='none';"
                onmouseover="this.style.backgroundColor='red'; this.style.color='white';"
                onmouseout="this.style.backgroundColor='transparent'; this.style.color='#1e293b';"
                style="color: #1e293b; font-weight: bold; z-index: 999; width: 32px; height: 32px; line-height: 28px; text-align: center; font-size: 20px; position: absolute; top: 8px; right: 12px; border: none; background-color: transparent; border-radius: 50%; transition: all 0.3s ease;">
                Ã— removed closed
            </button>-->

            <form  id="todoForm" action="{{ route('todos.store') }}" method="POST" enctype="multipart/form-data">
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

                <!-- new changes -->
            <div class="modal-body p-4" style="background-color: white;">
                <!-- Header -->
                <h5  style="font-weight: 600; color: #1e293b;"><span id="todo_heading">Create new ToDo</span>
                    <!-- Toggle Buttons -->
                        <div style="padding:8px 5px; background-color: #F2F2F2; border-radius: 10px; float:right; display: flex; gap: 8px; margin-top:10px;">
        <button type="button" id="btnShared"
            onclick="
                this.style.backgroundColor='#22c55e';
                this.style.color='white';
                document.getElementById('btnPrivate').style.backgroundColor='transparent';
                document.getElementById('btnPrivate').style.color='#64748b';
                document.getElementById('todo_visibility').value='shared';
            "
            style="border: none; background-color: transparent; color: #64748b; padding: 4px 10px; border-radius: 6px; font-size: 13px; font-weight: 500;">
            Shared ToDo's
        </button>

        <button type="button" id="btnPrivate"
            onclick="
                this.style.backgroundColor='#22c55e';
                this.style.color='white';
                document.getElementById('btnShared').style.backgroundColor='transparent';
                document.getElementById('btnShared').style.color='#64748b';
                document.getElementById('todo_visibility').value='private';
            "
            style="border: none; background-color: transparent; color: #64748b; padding: 4px 10px; border-radius: 6px; font-size: 13px; font-weight: 500;">
            Private ToDo's
        </button>
    </div>
                </h5>
                <p style="color: #64748b; font-size: 14px;">Manage your Time</p>

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
                                <div class="user_div" style="flex: 0 0 auto; width: 110px; border-radius: 16px; background: #ffffff; box-shadow: 0 2px 6px rgba(0,0,0,0.05); text-align: center; height: 135px;" 
                                    id="user_{{$cuser->_id}}" 
                                    data-user-id="{{$cuser->_id}}">
                                    <div class="invit-img">
                                        <img src="{{ str_replace('admin.onlinesystems.info', 'team.onlinesystems.info', asset('storage/' . $cuser->profile_image)) }}
" />
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

                <!-- shared section ends -->
<div class="" style="background-color:#f7f9fc; border-radius: 12px; padding: 15px; margin-bottom:5px;">
    <div class="col-md-12">
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


                <!-- Today/Scheduled Toggle + Date/Time Section -->
                 <!-- schdule section ends -->
                <div style="background-color: #f9f9fb; border-radius:10px; padding:8px; margin-bottom:10px;">
                    <!-- Toggle Today/Scheduled -->
                    <div style="  margin-bottom: 6px; margin-top: 4px;">
                        <div style="border-radius: 10px; padding: 6px; gap: 8px; background:#fff;">
        <button class="btnToday" id="btnToday" type="button"
            onclick="
                this.style.backgroundColor='#22c55e';
                this.style.color='white';
                document.getElementById('btnScheduled').style.backgroundColor='transparent';
                document.getElementById('btnScheduled').style.color='#64748b';
                document.getElementById('timeRow').classList.add('justify-content-center1');
                document.getElementById('todo_type').value='today';
            "
            style="border: none; background-color: transparent; color: #64748b; padding: 2px 12px; border-radius: 6px; font-size: 13px; font-weight: 500;">
            Today ToDo's
        </button>

        <button class="btnScheduled" id="btnScheduled" type="button"
            onclick="
                this.style.backgroundColor='#22c55e';
                this.style.color='white';
                document.getElementById('btnToday').style.backgroundColor='transparent';
                document.getElementById('btnToday').style.color='#64748b';
                document.getElementById('timeRow').classList.remove('justify-content-center');
                document.getElementById('todo_type').value='scheduled';
            "
            style="border: none; background-color: transparent; color: #64748b; padding: 2px 12px; border-radius: 6px; font-size: 13px; font-weight: 500;">
            Scheduled ToDo's
        </button>
    </div>
                    </div>
                    
                    <div class="gap-2 " style="padding:8px;">
                            <div><b>Delivery Time</b></div>
                            <p>Time to deliver the work</p>
                    </div>
                   
                    <!-- selection of tody section -->
                    <div class="d-flex1 gap-2 mb-3 bg-white" id="timeToday" style="padding: 8px;";>
                        <button type="button" class="time-btn time-btn-2 " data-value="2">2 Hour</button>
                        <button type="button" class="time-btn time-btn-3" data-value="3">3 Hour</button>
                        <button type="button" class="time-btn time-btn-6" data-value="6">6 Hour</button>
                        <button type="button" class="time-btn time-btn-9" data-value="9">9 Hour</button>
                        <button type="button" class="time-btn time-btn-12" data-value="12">12 Hour</button>
                    </div>
                     
                     <!-- selection of tody end -->
                    <!-- Date & Time Inputs -->
                    <div class="row g-2 align-items-center1 mb-3 justify-content-center1" id="timeRow" style="padding: 8px; display: none;">

                        <!-- Start Date (hidden by default) -->
                        <div class="col-md-4" id="startDateField" style="position: relative; ">
                            <div style="background-color: #fff; border-radius: 12px; padding: 2px 16px; width: 100%; border: 1px solid #e0e0e0; height: 45px; display: flex; flex-direction: column; justify-content: center;">
                                <div style="font-weight: 600; font-size: 14px; color: #7d7f85;">Start Date</div>
                                <div id="dateDisplay" style="font-size: 13px; color: #a0a4ab;">DD:MM:YYYY</div>
                                <div style="position: absolute; top: 50%; right: 16px; transform: translateY(-50%);">
                                    <img src="{{ URL::asset('/build/img/timeicon.svg') }}"
                                        onclick="document.getElementById('dateInput').showPicker()"
                                        style="width: 20px; height: 20px; cursor: pointer;" />
                                    <input type="date" id="dateInput"
                min="{{ date('Y-m-d') }}"  
                onchange="
                    let d = new Date(this.value);
                    if (this.value) {
                        document.getElementById('dateDisplay').innerText = ('0'+d.getDate()).slice(-2)+':' + ('0'+(d.getMonth()+1)).slice(-2)+':'+d.getFullYear();
                        // update end date min dynamically
                        let endInput = document.getElementById('enddateInput');
                        endInput.min = this.value;
                        // if end date < start date, clear it
                        if (endInput.value && new Date(endInput.value) < new Date(this.value)) {
                            endInput.value = '';
                            document.getElementById('enddateDisplay').innerText = 'DD:MM:YYYY';
                        }
                    }
                "
                style="opacity:0; position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none;" />
        
                                    </div>
                            </div>
                        </div>

                        <div class="col-md-4" id="endDateField" style="position: relative; ">
                            <div style="background-color: #fff; border-radius: 12px; padding: 2px 16px; width: 100%; border: 1px solid #e0e0e0; height: 45px; display: flex; flex-direction: column; justify-content: center;">
                                <div style="font-weight: 600; font-size: 14px; color: #7d7f85;">Deliver Date</div>
                                <div id="enddateDisplay" style="font-size: 13px; color: #a0a4ab;">DD:MM:YYYY</div>
                                <div style="position: absolute; top: 50%; right: 16px; transform: translateY(-50%);">
                                    <img src="{{ URL::asset('/build/img/timeicon.svg') }}"
                                        onclick="document.getElementById('enddateInput').showPicker()"
                                        style="width: 20px; height: 20px; cursor: pointer;" />
                                    <input type="date" id="enddateInput"
                min="{{ date('Y-m-d') }}" 
                onchange="
                    let d = new Date(this.value);
                    if (this.value) {
                        document.getElementById('enddateDisplay').innerText = ('0'+d.getDate()).slice(-2)+':' + ('0'+(d.getMonth()+1)).slice(-2)+':'+d.getFullYear();
                    }
                "
                style="opacity:0; position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none;" />
        </div>
                            </div>
                        </div>

                        

                        <!-- End Time -->
                        <div class="col-md-4" style="position: relative;">
                            <div style="background-color: #fff; border-radius: 12px; padding: 2px 10px; width: 100%; border: 1px solid #e0e0e0; height: 45px; display: flex; flex-direction: column; justify-content: center;">
                                
                                <select name="end_time" id="endTimeSelect" >
                                    <option value="">Deliver Time</option>
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
                <!-- schdule section ends -->

                <!-- ToDo Details -->
                <!-- ToDo Details Section -->
                <div style="background-color: #f9f9fb; border-radius: 12px; padding: 16px; margin-bottom: 16px;">
                    <!-- Heading and Subtext -->
                    <div class="row">
                        <div style="margin-bottom: 12px;" class="col-md-6">
                            <p style="font-weight: 600; font-size: 14px; color: #1e293b; margin: 0;">ToDo Details</p>
                            <p style="font-size: 12px; color: #64748b; margin: 0;">Manage your time</p>
                        </div>
                        <div class="col-md-6">
                            <p style="font-size: 12px; font-weight: 600; color: #334155;margin-bottom: 2px;">Todo Priority</p>
                                <p style="font-size: 11px; color: #6b7280;margin-bottom: 8px;">Set the priority of the Todo</p>
                                

                        </div>
                    </div>

                    <!-- Inputs -->
                    <div class="row g-2">
                        <div class="col-md-6">
                            <input id="todo_name" name="title" required type="text" class="form-control" placeholder="ToDo Title"
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
                            <input name="sections[]" type="text" class="form-control" placeholder="Section Description"
                                style="font-size: 13px; background-color: white; border-radius: 8px;">
                            <button type="button" class="btn btn-plus btn-sm ms-2 add-btn"><span>+</span></button>
                        </div>
                    </div>


                </div>


                <!-- Shared / Private ToDo Section -->
                <div style="background-color: #f9f9fb; display:none; border-radius: 12px; padding: 16px; margin-bottom: 16px;">

                    <!-- Project & Members Inputs -->
                    <div class="row g-2 mb-0 justify-content-center">
                        <div class="col-md-4">
                            <input type="text" name="project"  class="form-control"
                                placeholder="Select Project"
                                style="font-size: 13px; background-color: white; border-radius: 8px;">
                        </div>
                        <div class="col-md-4">
                            

                            <select class="form-control" id="members" multiple name="members[]">
                                <option value="">Select Members</option>
                                @foreach($users as $cuser)
                                    <option value="{{$cuser->_id}}">{{$cuser->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                    </div>

                </div>


                <!-- Priority & Reminder -->
                <div class="p-3 mb-3 rounded" style="background-color: #f9f9fb; box-shadow: inset 0 0 2px rgba(0,0,0,0.05);">
                    <div class="row g-3">
                        <!-- Priority -->
                        

                        <!-- Reminder -->
                        <div class="col-md-6">
                            <p style="font-size: 12px; font-weight: 600; color: #334155;margin-bottom: 2px;">Expired Reminder</p>
                            <p style="font-size: 11px; color: #6b7280;margin-bottom: 8px;">Set a reminder before expired</p>
                            <div class="d-flex gap-2">
                               <!-- <button type="button" id="reminder6" onclick="this.style.backgroundColor='#22c55e'; this.style.color='white'; document.getElementById('reminder12').style.backgroundColor='white'; document.getElementById('reminder12').style.color='#64748b'; document.getElementById('reminder24').style.backgroundColor='white'; document.getElementById('reminder24').style.color='#64748b';" style="border: none; background-color: #22c55e; color: white; padding: 6px 12px; border-radius: 6px; font-size: 12px;">30 Min</button>
                                <button type="button" id="reminder12" onclick="this.style.backgroundColor='#22c55e'; this.style.color='white'; document.getElementById('reminder6').style.backgroundColor='white'; document.getElementById('reminder6').style.color='#64748b'; document.getElementById('reminder24').style.backgroundColor='white'; document.getElementById('reminder24').style.color='#64748b';" style="border: none; background-color: white; color: #64748b; padding: 6px 12px; border-radius: 6px; font-size: 12px;">60 Min</button>
                                <button type="button" id="reminder24" onclick="this.style.backgroundColor='#22c55e'; this.style.color='white'; document.getElementById('reminder6').style.backgroundColor='white'; document.getElementById('reminder6').style.color='#64748b'; document.getElementById('reminder12').style.backgroundColor='white'; document.getElementById('reminder12').style.color='#64748b';" style="border: none; background-color: white; color: #64748b; padding: 6px 12px; border-radius: 6px; font-size: 12px;">2 Hour</button>
                                <button type="button" id="reminder3" onclick="this.style.backgroundColor='#22c55e'; this.style.color='white'; document.getElementById('reminder6').style.backgroundColor='white'; document.getElementById('reminder6').style.color='#64748b'; document.getElementById('reminder12').style.backgroundColor='white'; document.getElementById('reminder12').style.color='#64748b';" style="border: none; background-color: white; color: #64748b; padding: 6px 12px; border-radius: 6px; font-size: 12px;">3 Hour</button>
                                <button type="button" id="reminder4" onclick="this.style.backgroundColor='#22c55e'; this.style.color='white'; document.getElementById('reminder6').style.backgroundColor='white'; document.getElementById('reminder6').style.color='#64748b'; document.getElementById('reminder12').style.backgroundColor='white'; document.getElementById('reminder12').style.color='#64748b';" style="border: none; background-color: white; color: #64748b; padding: 6px 12px; border-radius: 6px; font-size: 12px;">4 Hour</button>-->
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

                <div class="text-center" style="margin-top: 15px;">
                    <button class="btn" type="button" data-bs-dismiss="modal"
                        style="background-color: #f7f7f7; color:#64748b; border-radius: 8px; padding: 6px 20px; font-size: 14px; font-weight: 500;">
                        Close
                    </button>
                    <button id="saveBtn" type="button" class="btn" 
                        style="background-color: #f7f7f7; color:#64748b; border:  border-radius: 8px; padding: 6px 20px; font-size: 14px; font-weight: 500;">
                        Save & Close
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
                Delete Todo
            </div>
            <div style="font-size: 13px; color:black">
                Tell us why ?!
            </div>
            <hr style="background-color: #777; height: 1px; border: none; margin: 10px 0;">


            <form action="{{ route('todos.remove') }}" method="POST">
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
                    <option class="failed" value="Todo not clear">Todo not clear</option>
                    <option class="failed" value="Details not clear">Details not clear</option>
                    <option class="failed" value="Documents not clear">Documents not clear</option>
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
                    Save & Close
                </button>
                <button type="button" class="btn rejectbtn" 
                    style="background-color: #f7f7f7; border: 1px solid #ddd; border-radius: 8px; padding: 6px 20px; font-size: 14px; font-weight: 500;">
                    Reject it
                </button>
            </div>
            </form>

        </div>
    </div>
</div>

<!-- Mark as Done Modal -->
<div class="modal fade" id="markDoneModal" tabindex="-1" aria-labelledby="markDoneModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius: 12px;">
      <div class="modal-header">
        <div class="row">
        <h5  class="modal-title fw-bold col-md-12" id="markDoneModalLabel">Mark as Done</h5>
        <p class="col-md-12">Mark as done and close it!</p>
    </div>
      </div>
      
      <form id="markDoneForm1" method="POST" action="{{route('todos.complete')}}">
        @csrf
        <div class="modal-body">
            <div class="modal-inner">
                <div class="row">

                </div>


                <div class="mt-3 text-left" style="background: #f9f9fb; padding: 16px; border-radius: 16px;">

                    <div class="row">
                        <div class="col-md-2">
                            <img src="{{ asset('build/img/thumbp.png') }}" />
                        </div>
                        <div class="col-md-10">
                            <h3>Mark as Done</h3>
                            <p>Todo is completed</p>
                        </div>
                    </div>

                <div class="dev_finish">
                    <p style="font-size: 13px; margin-top:10px;">Provide details on project</p>

                    <div class="mt-2" id="ratingContainer" style="font-size: 13px;">
                       
                            <div class="d-flex align-items-center justify-content-between mb-2 rating-group" 
                                style="background:#fff; padding:9px; border-radius:10px;">
                                <span>Did you did all tasks</span>
                                <div style="display: flex; align-items: center; gap: 6px;">
                                    <label style="position: relative; display: inline-block; width: 34px; height: 18px; background-color: rgb(204, 204, 204); border-radius: 18px;">
                                        <input type="checkbox" name="all_tasks_done" onchange="this.nextElementSibling.style.left = this.checked ? '18px' : '2px'; this.parentElement.style.backgroundColor = this.checked ? '#10b981' : '#ccc';" style="opacity: 0; width: 0; height: 0;">
                                        <span style="position: absolute; top: 2px; left: 2px; width: 14px; height: 14px; background-color: white; border-radius: 50%; transition: 0.2s;"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-2 rating-group" 
                                style="background:#fff; padding:9px; border-radius:10px;">
                                <span>Did you do check all tasks</span>
                                <div style="display: flex; align-items: center; gap: 6px;">
                                    <label style="position: relative; display: inline-block; width: 34px; height: 18px; background-color: rgb(204, 204, 204); border-radius: 18px;">
                                        <input type="checkbox" name="all_tasks_check" onchange="this.nextElementSibling.style.left = this.checked ? '18px' : '2px'; this.parentElement.style.backgroundColor = this.checked ? '#10b981' : '#ccc';" style="opacity: 0; width: 0; height: 0;">
                                        <span style="position: absolute; top: 2px; left: 2px; width: 14px; height: 14px; background-color: white; border-radius: 50%; transition: 0.2s;"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-2 rating-group" 
                                style="background:#fff; padding:9px; border-radius:10px;">
                                <span>Did you upload all files</span>
                                <div style="display: flex; align-items: center; gap: 6px;">
                                    <label style="position: relative; display: inline-block; width: 34px; height: 18px; background-color: rgb(204, 204, 204); border-radius: 18px;">
                                        <input type="checkbox" name="files_upload" onchange="this.nextElementSibling.style.left = this.checked ? '18px' : '2px'; this.parentElement.style.backgroundColor = this.checked ? '#10b981' : '#ccc';" style="opacity: 0; width: 0; height: 0;">
                                        <span style="position: absolute; top: 2px; left: 2px; width: 14px; height: 14px; background-color: white; border-radius: 50%; transition: 0.2s;"></span>
                                    </label>
                                </div>
                            </div>
                       
                    </div>
                </div>

                <div class="forshared">
                    <p style="font-size: 13px; margin-top:10px;">Rate the Developer</p>

                    <div class="mt-2" id="ratingContainer" style="font-size: 13px;">
                        @foreach($ratingCategories as $key => $label)
                            <div class="d-flex align-items-center justify-content-between mb-2 rating-group" 
                                style="background:#fff; padding:9px; border-radius:10px;">
                                <span>{{ $label }}</span>
                                <span>
                                    @for($i = 1; $i <= 5; $i++)
                                        <input type="radio" name="ratings[{{ $label }}]" id="rate-{{ $key }}-{{ $i }}" value="{{ $i }}" style="display:none;">
                                        <label for="rate-{{ $key }}-{{ $i }}" 
                                            class="fa-solid fa-star" 
                                            data-index="{{ $i }}" 
                                            data-category="{{ $label }}"></label>
                                    @endfor
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            </div>
          
          <input type="hidden" id="doneTodoId" name="todo_id">
          <input type="hidden" id="setcomplete" name="setcomplete">
        </div>
        
            <div style="padding: 0 20px;">
                <button class="btn" data-bs-dismiss="modal" type="button" style="background-color: #f7f7f7; float:left; margin-bottom:10px; color:#64748b; border:  border-radius: 8px; padding: 6px 20px; font-size: 14px; font-weight: 500;">
                    Close
                </button>
                <button class="btn" style="background-color: #f7f7f7; float:right; margin-bottom:10px; color:#64748b; border:  border-radius: 8px; padding: 6px 20px; font-size: 14px; font-weight: 500;">
                    Save &amp; Close
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
                        <h5 class="text-center fw-bold mb-3" style="color: #1c2233;">Todo Start & Deliver Time</h5>

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
                                <div><span class="text-success">Deliver Time:</span> <span class="todo-deliver-time">--</span></div>
                            </div>
                        </div>
                        <!-- Info Row -->
                        <div id="times_today" class=" flex-wrap justify-content-around text-center" style="font-size: 13px;">
                            
                            <div class="right-border">
                                <div class="text-muted"><b>Todays</b></div>
                            </div>&nbsp;|&nbsp;
                            
                            <div class="right-border">
                                <div><span class="text-success">Start & Delivery Date:</span> <span class="todo-deliver-date">{{ now()->toDateString() }}</span></div>
                            </div>&nbsp;|&nbsp;
                            <div class="right-border">
                                <div><span class="text-success">Total Time:</span> <span class="todo-total_time">2 hour</span></div>
                            </div>
                        </div>

                    </div>

                    <!-- Invited User -->
                    <div class="mt-2 mb-3 invited-users-block" style="background-color: #f8f9fa; padding:10px; border-radius: 15px; box-shadow: 0px 0px 5px rgba(0,0,0,0.05);">

                        
                        <h5 class=" fw-bold" style="color: #1c2233;">Invited Users</h5>
                        <p>Shared Todo with </p>

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
                   
                    
                    <!-- Notes -->
                    <!-- Notes Section (Exact Match) -->
                    <div class="p-3" style="background-color: #f5f5f5; border-radius: 10px;">
                        <div style="font-weight: 600; color: #333; font-size: 14px; margin-bottom: 10px;">â€¢ Description â€¢</div>
                        <div class="sections-list"></div>
                        
                    </div>

                    <div class="p-3 owner-state mt-3" style="background-color: #f5f5f5; text-align:center; border-radius: 10px;">
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
                        <div class="openEditFromView" id="openEditFromView" data-id="" data-bs-target="#todomodel" style="text-align: center; flex: 1;cursor:pointer;">
                            <div style="padding: 10px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;">
                                <img src="{{ asset('build/img/editp.png') }}" alt="Edit" width="40" height="40">
                            </div>
                            <div style="margin-top: 6px; color: #1c2b48; font-size: 12px; font-weight: 600;">Edit</div>
                        </div>
                        <!-- Complete the Project -->
                        <div id="markDoneBtn" class="markDoneBtn" style="text-align: center; flex: 1;cursor:pointer;">
                            <div style="padding: 10px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;">
                                <img src="{{ asset('build/img/thumbp.png') }}" alt="Complete" width="40" height="40">
                            </div>
                            <div style="margin-top: 6px; color: #1c2b48; font-size: 12px; font-weight: 600;">Mark as Done</div>
                        </div>


                        <!-- Remove the Project -->
                        <div style="text-align: center; flex: 1; cursor: pointer;"
                            data-bs-toggle="modal" data-bs-target="#removeModel">

                            <div style=" padding: 10px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;">
                                <img src="{{ asset('build/img/delp.png') }}" alt="Delete" width="40" height="40">
                            </div>

                            <div class="markfail" style="margin-top: 6px; color: #1c2b48; font-size: 12px; font-weight: 600;">
                                Mark as Failed
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
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius: 15px; border: none; box-shadow: 0 0 20px rgba(0,0,0,0.05);">

            <!-- Close Button -->
            <!-- Close Button -->
            <button type="button"
                data-bs-dismiss="modal"
                aria-label="Close"
                onclick="this.closest('.modal').classList.remove('show'); this.closest('.modal').style.display='none';"
                onmouseover="this.style.backgroundColor='red'; this.style.color='white';"
                onmouseout="this.style.backgroundColor='transparent'; this.style.color='#1e293b';"
                style="color: #1e293b; font-weight: bold; z-index: 999; width: 32px; height: 32px; line-height: 28px; text-align: center; font-size: 20px; position: absolute; top: 8px; right: 12px; border: none; background-color: transparent; border-radius: 50%; transition: all 0.3s ease;">
                Ã—
            </button>



            <div class="modal-body p-4" style="background-color: white;">
                <!-- Header -->
                <h5 style="font-weight: 600; color: #1e293b;">Scheduled a Meeting</h5>
                <p style="color: #64748b; font-size: 14px;">Connect your Team</p>

                <!-- Meeting Details -->
                <div class="border rounded p-3 mb-3" style="background-color: #f9f9fb;">
                    <p style="color: #64748b; font-size: 13px; margin-bottom: 8px;">Meeting Details</p>

                    <div class="row g-2 mb-2">
                        <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Select Project" style="font-size: 13px;">
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Meeting Title" style="font-size: 13px;">
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Describe the meeting" style="font-size: 13px;">
                        </div>
                        <div class="col-md-6">
                            <select class="form-control">
                                <option value="">Select Members</option>
                                @foreach($users as $cuser)
                                    <option value="{{$cuser->_id}}">{{$cuser->name}}</option>
                                @endforeach
                            </select>
                            
                        </div>
                    </div>
                </div>
                <!-- Schedule Type Toggle -->
                <div style="background-color: #f9f9fb;">
                    <div style="display: flex; justify-content: center; margin-bottom: 16px; margin-top: 10px;background-color: #f9f9fb;">
                        <div style="border-radius: 10px; padding: 4px; display: flex; gap: 8px; justify-content: center;">
                            <button id="btnToday"
                                onclick="document.getElementById('btnToday').style.backgroundColor='#22c55e';
             document.getElementById('btnToday').style.color='white';
             document.getElementById('btnScheduled').style.backgroundColor='transparent';
             document.getElementById('btnScheduled').style.color='#64748b';"
                                style="border: none; background-color: #22c55e; color: white; padding: 6px 12px;
           border-radius: 6px; font-size: 13px; font-weight: 500;">
                                Meeting Today
                            </button>

                            <button id="btnScheduled"
                                onclick="document.getElementById('btnScheduled').style.backgroundColor='#22c55e';
             document.getElementById('btnScheduled').style.color='white';
             document.getElementById('btnToday').style.backgroundColor='transparent';
             document.getElementById('btnToday').style.color='#64748b';"
                                style="border: none; background-color: transparent; color: #64748b; padding: 6px 12px;
           border-radius: 6px; font-size: 13px; font-weight: 500;">
                                Scheduled Meeting
                            </button>

                        </div>

                    </div>

                    <!-- Date & Time Fields -->
                    <div class="row g-2 align-items-center mb-3" style="background-color: #f9f9fb;padding-bottom:4px;">
                        <!-- <div class="col-md-4">
                            <div class="position-relative">
                                <input type="text" class="form-control"
                                    placeholder="Start Date DD.MM.YY"
                                    style="font-size: 13px; padding-right: 35px;">
                                <img src="{{ URL::asset('/build/img/timeicon.svg') }}"
                                    style="position: absolute; top: 8px; right: 10px; width: 18px;">
                            </div>
                        </div> -->
                        <div class="col-md-4">
                            <div class="position-relative">
                                <input type="text" class="form-control"
                                    placeholder="Start Time HH:MM"
                                    style="font-size: 13px; padding-right: 35px;">
                                <img src="{{ URL::asset('/build/img/timeicon.svg') }}"
                                    style="position: absolute; top: 8px; right: 10px; width: 18px;">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="position-relative">
                                <input type="text" class="form-control"
                                    placeholder="End Time HH:MM"
                                    style="font-size: 13px; padding-right: 35px;">
                                <img src="{{ URL::asset('/build/img/timeicon.svg') }}"
                                    style="position: absolute; top: 8px; right: 10px; width: 18px;">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Meeting Links -->
                <!-- Link Toggle Section -->
                <div style="background-color: #f9f9fb; border-radius: 10px; padding: 12px; display: flex; flex-direction: column; align-items: center; width: 100%; max-width: 400px; margin: auto;margin-bottom: 12px;">

                    <div style="display: flex; gap: 10px; justify-content: center; margin-bottom: 12px;">
                        <button id="btnMeet"
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

                        <button id="btnZoom"
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


                    <input type="text"
                        placeholder="Past link"
                        style="width: 100%; background-color: white; color: #64748b; border: none;
           border-radius: 8px; padding: 10px 12px; font-size: 13px; font-weight: 400; text-align: center;">
                </div>


                <!-- âœ… Priority & Reminder Section Styled Box -->
                <div class="p-3 mb-3 rounded" style="background-color: #f5f7fa; box-shadow: inset 0 0 2px rgba(0,0,0,0.05);">
                    <div class="row g-3">
                        <!-- Meeting Priority -->
                        <div class="col-md-6">
                            <p style="font-size: 12px; font-weight: 600; color: #334155;">Meeting Priority</p>
                            <p style="font-size: 11px; color: #6b7280;">Set the Priority of the Meeting</p>
                            <div class="d-flex gap-2">
                                <button  id="priorityLow" onclick="
          this.style.backgroundColor='#22c55e';
          this.style.color='white';
          document.getElementById('priorityMiddle').style.backgroundColor='white';
          document.getElementById('priorityMiddle').style.color='#64748b';
          document.getElementById('priorityHigh').style.backgroundColor='white';
          document.getElementById('priorityHigh').style.color='#64748b';
        " style="border: none; background-color: #22c55e; color: white; padding: 6px 12px; border-radius: 6px; font-size: 12px;">
                                    Low
                                </button>

                                <button  id="priorityMiddle"  style="border: none; background-color: white; color: #64748b; padding: 6px 12px; border-radius: 6px; font-size: 12px;">
                                    Middle
                                </button>

                                <button  id="priorityHigh" onclick="
          this.style.backgroundColor='#22c55e';
          this.style.color='white';
          document.getElementById('priorityLow').style.backgroundColor='white';
          document.getElementById('priorityLow').style.color='#64748b';
          document.getElementById('priorityMiddle').style.backgroundColor='white';
          document.getElementById('priorityMiddle').style.color='#64748b';
        " style="border: none; background-color: white; color: #64748b; padding: 6px 12px; border-radius: 6px; font-size: 12px;">
                                    High
                                </button>
                            </div>
                        </div>

                        <!-- Expired Reminder -->
                        <div class="col-md-6">
                            <p style="font-size: 12px; font-weight: 600; color: #334155;">Expired Reminder</p>
                            <p style="font-size: 11px; color: #6b7280;">Set a reminder before expired</p>
                            <div class="d-flex gap-2">
                                <button id="reminder6" onclick="
          this.style.backgroundColor='#22c55e';
          this.style.color='white';
          document.getElementById('reminder12').style.backgroundColor='white';
          document.getElementById('reminder12').style.color='#64748b';
          document.getElementById('reminder24').style.backgroundColor='white';
          document.getElementById('reminder24').style.color='#64748b';
        " style="border: none; background-color: #22c55e; color: white; padding: 6px 12px; border-radius: 6px; font-size: 12px;">
                                    6 Hour
                                </button>

                                <button id="reminder12" onclick="
          this.style.backgroundColor='#22c55e';
          this.style.color='white';
          document.getElementById('reminder6').style.backgroundColor='white';
          document.getElementById('reminder6').style.color='#64748b';
          document.getElementById('reminder24').style.backgroundColor='white';
          document.getElementById('reminder24').style.color='#64748b';
        " style="border: none; background-color: white; color: #64748b; padding: 6px 12px; border-radius: 6px; font-size: 12px;">
                                    12 Hour
                                </button>

                                <button id="reminder24" onclick="
          this.style.backgroundColor='#22c55e';
          this.style.color='white';
          document.getElementById('reminder6').style.backgroundColor='white';
          document.getElementById('reminder6').style.color='#64748b';
          document.getElementById('reminder12').style.backgroundColor='white';
          document.getElementById('reminder12').style.color='#64748b';
        " style="border: none; background-color: white; color: #64748b; padding: 6px 12px; border-radius: 6px; font-size: 12px;">
                                    24 Hour
                                </button>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Submit Button -->
                <div class="text-center">
                    <button class="btn" style="background-color: #5b21b6; color: white; padding: 8px 40px; border-radius: 8px; font-size: 14px;">
                        Create
                    </button>
                </div>

            </div>
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

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            const toggleIcon = document.getElementById("toggleIcon");
            const chevron = document.getElementById("chevronIcon");

            //toggleIcon.addEventListener("click", () => {
            //    setTimeout(() => {
             //       chevron.classList.toggle("ti-chevron-down");
            //        chevron.classList.toggle("ti-chevron-up");
            //    }, 150);
           // });
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



// Date picker
document.getElementById('dateInput').addEventListener('change', function () {
    document.getElementById('startDateHidden').value = this.value;
});

document.getElementById('enddateInput').addEventListener('change', function () {
    document.getElementById('endDateHidden').value = this.value;
});




// Private / Shared toggle
document.getElementById('btnShared').addEventListener('click', function (e) {
    e.preventDefault();
    document.getElementById('isPrivateHidden').value = 0;
});
document.getElementById('btnPrivate').addEventListener('click', function (e) {
    e.preventDefault();
    document.getElementById('isPrivateHidden').value = 1;
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



// Reminder
/*
document.getElementById('reminder6').addEventListener('click', function (e) {
    e.preventDefault();
    document.getElementById('reminderHidden').value = 6;
});
document.getElementById('reminder12').addEventListener('click', function (e) {
    e.preventDefault();
    document.getElementById('reminderHidden').value = 12;
});
document.getElementById('reminder24').addEventListener('click', function (e) {
    e.preventDefault();
    document.getElementById('reminderHidden').value = 24;
});
document.getElementById('reminder3').addEventListener('click', function (e) {
    e.preventDefault();
    document.getElementById('reminderHidden').value = 3;
});
document.getElementById('reminder4').addEventListener('click', function (e) {
    e.preventDefault();
    document.getElementById('reminderHidden').value = 4;
});
*/


// Date picker
document.getElementById('editDateInput').addEventListener('change', function () {
    document.getElementById('editStartDateHidden').value = this.value;
});

// Time selectors
document.getElementById('editStartTimeSelect').addEventListener('change', function () {
    document.getElementById('editStartTimeHidden').value = this.value;
});
document.getElementById('editEndTimeSelect').addEventListener('change', function () {
    document.getElementById('editEndTimeHidden').value = this.value;
});

// Priority
['Low','Middle','High'].forEach(p => {
    document.getElementById('editPriority' + p).addEventListener('click', function(e){
        e.preventDefault();
        document.getElementById('editPriorityHidden').value = p.toLowerCase();
    });
});

// Reminder
[6,12,24].forEach(r => {
    document.getElementById('editReminder' + r).addEventListener('click', function(e){
        e.preventDefault();
        document.getElementById('editReminderHidden').value = r;
    });
});





function openEditModal(button) {
    let id = button.getAttribute('data-id');
    document.getElementById('editForm').action = "/todosupdate/" + id;

    document.getElementById('editTitle').value = button.getAttribute('data-title');
    document.getElementById('editDescription').value = button.getAttribute('data-description');
    document.getElementById('editStartDateHidden').value = button.getAttribute('data-start_date');
    document.getElementById('editStartTimeHidden').value = button.getAttribute('data-start_time');
    document.getElementById('editEndTimeHidden').value = button.getAttribute('data-end_time');
    document.getElementById('editIsPrivateHidden').value = button.getAttribute('data-project');
    document.getElementById('editPriorityHidden').value = button.getAttribute('data-priority');
    document.getElementById('editReminderHidden').value = button.getAttribute('data-reminder');

    // Members (multi-select)
    let members = JSON.parse(button.getAttribute('data-members') || '[]');
    let membersSelect = document.getElementById('editMembers');
    for (let option of membersSelect.options) {
        option.selected = members.includes(option.value);
    }

    new bootstrap.Modal(document.getElementById('editModal')).show();
}


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




document.addEventListener("DOMContentLoaded", function () {
    const membersSelect = document.getElementById("members");

    document.querySelectorAll(".user_div").forEach(div => {
        div.addEventListener("click", function () {
            let userId = this.getAttribute("data-user-id");

            // Unselect all others first
            document.querySelectorAll(".user_div").forEach(d => d.classList.remove("user_active"));
            membersSelect.querySelectorAll("option").forEach(opt => opt.selected = false);

            // Select the clicked one
            this.classList.add("user_active");
            let option = membersSelect.querySelector(`option[value="${userId}"]`);
            if (option) option.selected = true;
        });
    });
});


document.addEventListener("DOMContentLoaded", function () {
    const btnShared = document.getElementById("btnShared");
    const btnPrivate = document.getElementById("btnPrivate");
    const selectUsersBox = document.getElementById("selectUsersBox");

    btnShared.addEventListener("click", function () {
        btnShared.classList.add("active");
        btnPrivate.classList.remove("active");
        selectUsersBox.style.display = "block"; // show
    });

    btnPrivate.addEventListener("click", function () {
        btnPrivate.classList.add("active");
        btnShared.classList.remove("active");
        selectUsersBox.style.display = "none"; // hide
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const wrapper = document.getElementById("sectionsWrapper");

    wrapper.addEventListener("click", function (e) {
        const addButton = e.target.closest(".add-btn");
        const removeButton = e.target.closest(".remove-btn");

        if (addButton) {
            // create new section row
            const div = document.createElement("div");
            div.className = "col-md-12 d-flex align-items-center section-item mt-2";
            div.innerHTML = `
                <input name="sections[]" type="text" class="form-control" placeholder="Section Description"
                       style="font-size: 13px; background-color: white; border-radius: 8px;">
                <button type="button" class="btn btn-minus btn-sm ms-2 remove-btn"><span>-</span></button>
            `;
            wrapper.appendChild(div);
        }

        if (removeButton) {
            removeButton.closest(".section-item").remove();
        }
    });
});

let timerInterval;

document.addEventListener("DOMContentLoaded", function () {
    //todomodel
    document.querySelectorAll(".editTodo").forEach(btn => {
        btn.addEventListener("click", function () {
            // Get attributes
            let dataid      = this.dataset.id;

            document.getElementById('todo_id').value = dataid;

            document.getElementById("todo_heading").innerText = "Update Todo";

            let e_title       = this.dataset.title;
            let e_description = this.dataset.description;
            let e_isPrivate   = this.dataset.is_private;
            
            let e_sections    = JSON.parse(this.dataset.sections || "[]");

            let e_startDate   = this.dataset.start_date || "";
            let e_startTime   = this.dataset.start_time || "";
            let e_endDate     = this.dataset.end_date || "";
            let e_endTime     = this.dataset.end_time || "";
            let e_reminder    = this.dataset.reminder;
            let e_priority    = this.dataset.priority 
            let e_total         =    this.dataset.total 

            //working on edit
           // time-btn-3
            document.getElementById('timeHidden').value = e_total;
            document.getElementById('endTimeSelect').value = e_endTime;
            document.getElementById('dateInput').value = e_startDate
            document.getElementById("dateInput").dispatchEvent(new Event('change'));
            document.getElementById('enddateInput').value = e_endDate
            document.getElementById("enddateInput").dispatchEvent(new Event('change'));
            
            document.querySelector('.time-btn').classList.remove('active');

            if(e_total != "0"){
                document.getElementById("btnToday").click();
            }

           if(e_total == "0"){
                document.getElementById("btnScheduled").click();
                document.querySelector('.time-btn-2').classList.add('active');
           }else if(e_total == "2"){
                document.querySelector('.time-btn-2').classList.add('active');
           }else if(e_total == "3"){
                document.querySelector('.time-btn-3').classList.add('active');
           }else if(e_total == "6"){
                document.querySelector('.time-btn-6').classList.add('active');
           }else if(e_total == "9"){
                document.querySelector('.time-btn-9').classList.add('active');
           }else if(e_total == "12"){
                document.querySelector('.time-btn-12').classList.add('active');
           }

            
            document.getElementById('todo_name').value = e_title;
            document.getElementById('reminderHidden').value = e_reminder;

            document.querySelector('.reminder-btn').classList.remove('active');

            if(e_reminder == "30"){
                document.querySelector('.rem-30').classList.add('active');
            }else if(e_reminder == "60"){
                document.querySelector('.rem-60').classList.add('active');
            }else if(e_reminder == "90"){
                document.querySelector('.rem-90').classList.add('active');
            }if(e_reminder == "120"){
                document.querySelector('.rem-120').classList.add('active');
            }

            document.querySelector('.priority').classList.remove('active');

            document.getElementById('priorityHidden').value = e_priority;

            if(e_priority == "low"){
                document.querySelector('#priorityLow').classList.add('active');
            }else if(e_priority == "middle"){
                document.querySelector('#priorityMiddle').classList.add('active');
            }else if(e_priority == "high"){
                document.querySelector('#priorityHigh').classList.add('active');
            }


            let e_members = this.dataset.members;

            // Handle both cases (string or array)
            if (typeof e_members === "string") {
                try {
                    e_members = JSON.parse(e_members);
                } catch (err) {
                    console.error("Invalid JSON:", err);
                    e_members = [];
                }
            }

// Now safely use it
// Auto-select members by ID
//let e_members = JSON.parse(this.dataset.members || "[]");

if (Array.isArray(e_members) && e_members.length) {
    console.log("Auto-selecting members:", e_members);

    setTimeout(() => {
        e_members.forEach(m => {
            const userDiv = document.querySelector(`[data-user-id="${m.id}"]`);
            if (userDiv) {
                console.log("Activating:", m.id);
                
                // Add class manually
                userDiv.classList.add("user_active");

                // Select corresponding option
                const membersSelect = document.getElementById("members");
                const option = membersSelect?.querySelector(`option[value="${m.id}"]`);
                if (option) option.selected = true;
            } else {
                console.warn("Not found:", m.id);
            }
        });
    }, 500); // wait for DOM ready
}

const wrapper = document.getElementById("sectionsWrapper");
wrapper.innerHTML = `
    <div class="col-md-12 d-flex align-items-center section-item">
        <input name="sections[]" type="text" class="form-control" placeholder="Section Description"
               style="font-size: 13px; background-color: white; border-radius: 8px;">
        <button type="button" class="btn btn-plus btn-sm ms-2 add-btn"><span>+</span></button>
    </div>
`;
if (Array.isArray(e_sections) && e_sections.length > 0) {
    // Set first input value
    const firstInput = wrapper.querySelector('input[name="sections[]"]');
    firstInput.value = e_sections[0] || "";

    // Add more for the rest
    for (let i = 1; i < e_sections.length; i++) {
        const div = document.createElement("div");
        div.className = "col-md-12 d-flex align-items-center section-item mt-2";
        div.innerHTML = `
            <input name="sections[]" type="text" class="form-control" value="${e_sections[i]}"
                   placeholder="Section Description"
                   style="font-size: 13px; background-color: white; border-radius: 8px;">
            <button type="button" class="btn btn-minus btn-sm ms-2 remove-btn"><span>-</span></button>
        `;
        wrapper.appendChild(div);
    }
}

/*

            let e_members = JSON.parse(this.dataset.members || "[]");
console.log("Raw members data:", e_members);
            if (e_members.length) {
               
                e_members.forEach(m => {
                    let e_m_id = m.id;
                    let userid = "user_" + e_m_id;
                   // alert(userid);
                    document.getElementById(userid).click();
                    
                });
            } 
   */         
            //reminder


        });
    });

    let customtimer = {{ $ctime }} * 1000;

    setInterval(() => {
        customtimer += 1000; // decrease by 1 second each tick
    }, 1000);

    const modal = document.getElementById("inreject");

    document.querySelectorAll(".viewTodo").forEach(btn => {
        btn.addEventListener("click", function () {
            // Get attributes
            let dataid      = this.dataset.id;

            //const editBtnInModal = document.getElementById('openEditFromView');
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
                    // âœ… Trigger the editTodo click to open #todomodel
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
                    editBtnInModal.click(); // âœ… Trigger the other buttonâ€™s click event
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

            const markDoneBtn = document.getElementById('markDoneBtn');
            if (markDoneBtn) {
                markDoneBtn.dataset.id = dataid; // set the data-id dynamically
            }


let filecont = document.querySelector('.files-container');
filecont.style.display = "block";



let files = JSON.parse(this.dataset.files || "[]");
let filesList = document.querySelector('.todo-files-list');


const list = document.getElementById('createPdfList');
    const addTile = list.querySelector('.pdf-add-tile');

    // Remove any existing tiles (previous create/edit)
    list.querySelectorAll('.d-flex.align-items-center.gap-2.px-2').forEach(el => el.remove());

    // If there are existing files, append them
    files.forEach(file => {
        const url = file.url || '';
        const fname = file.name || 'Unknown';
        const size = Math.round((file.size || 0) / 1024) + ' KB';
        const parts = fname.split("_@_");
        const name = parts[0] || "Unknown";
        const id = parts[1] || "";
        const ext = name.split('.').pop().toLowerCase();

        let icon = 'https://admin.onlinesystems.info/build/img/file-icon.svg';
        if (['pdf'].includes(ext)) icon = 'https://admin.onlinesystems.info/build/img/pdf-icon.svg';
        if (['jpg','jpeg','png','gif','webp'].includes(ext)) icon = url;
        if (['mp4','mov','avi','mkv'].includes(ext)) icon = 'https://cdn-icons-png.flaticon.com/512/711/711245.png';

        const tile = document.createElement('div');
        tile.className = 'd-flex align-items-center gap-2 px-2';
        tile.style.cssText = 'border:1px solid #e5e7eb;border-radius:10px;height:60px;background:#fff;';
        tile.innerHTML = `
            <img src="${icon}" alt="${name}" style="width:40px;height:40px;object-fit:cover;border-radius:6px;">
            <div class="d-flex flex-column" style="min-width:100px;">
                <small style="font-weight:600;">${name}</small>
                <small style="color:#6b7280;">${size}</small>
            </div>
            <button type="button" class="btn" style="color:#ef4444;" onclick="removePdfTile(this)">
                <i class="ti ti-trash"></i>
            </button>
        `;

        // Insert before the â€œ+ Addâ€ tile
        list.insertBefore(tile, addTile);
    });

// Hide container if no files

filesList.innerHTML = '';

if (files.length > 0) {
    let rowHtml = '';

    files.forEach((file, index) => {
        let url = file.url || '';
        let fname = file.name || 'Unknown';
        let size = formatFileSize(file.size || 0);
        

        let parts = fname.split("_@_");

        let name = parts[0] || "Unknown";
        let id = parts[1] || "";

        let ext = name.split('.').pop().toLowerCase();

        let icon = "{{ asset('build/img/file-icon.svg') }}";
        if (['pdf'].includes(ext)) icon = "https://admin.onlinesystems.info/build/img/pdf-icon.svg";
        //if (['jpg','jpeg','png','gif','webp'].includes(ext)) icon = url;
        if (['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(ext)) {
            icon = url.replace('admin.onlinesystems.info', 'team.onlinesystems.info');
        }
        if (['mp4','mov','avi','mkv'].includes(ext)) icon = "https://cdn-icons-png.flaticon.com/512/711/711245.png";

        // File item markup
        let fileHtml = `
            <div class="col-md-6 mb-2">
                <div class="d-flex align-items-center justify-content-between p-2"
                     style="background:#f9fafb; border-radius:10px; border:1px solid #e5e7eb;">
                    <div class="d-flex align-items-center">
                        <img src="${icon}" alt="${name}" 
                             style="width:40px; height:40px; border-radius:6px; object-fit:cover; margin-right:10px;">
                        <div>
                            <div style="font-weight:500; color:#1e293b; font-size:14px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; max-width:140px;">
                                ${name}
                            </div>
                            <div style="font-size:12px; color:#6b7280;">${size}</div>
                        </div>
                    </div>
                    <a href="https://team.onlinesystems.info/download/${id}" target="_blank" download 
                       style="color:#1d4ed8; text-decoration:none;">
                        <i class="fa fa-arrow-down" style="font-size:16px;"></i>
                    </a>
                </div>
            </div>
        `;

        rowHtml += fileHtml;

        // When 2 files added or last file reached â†’ close row and append
        if ((index + 1) % 2 === 0 || index === files.length - 1) {
            filesList.innerHTML += `<div class="row g-2">${rowHtml}</div>`;
            rowHtml = '';
        }
    });
} else {
    filecont.style.display = "none";
}


// Helper for file size formatting
function formatFileSize(bytes) {
  
    if (bytes === 0 || !bytes) return "";
    const units = ['B', 'KB', 'MB', 'GB'];
    let i = Math.floor(Math.log(bytes) / Math.log(1024));
    return parseFloat((bytes / Math.pow(1024, i)).toFixed(1)) + ' ' + units[i];
}



            let title       = this.dataset.title;
            let description = this.dataset.description;
            let priority    = this.dataset.priority || "Normal";
            let isPrivate   = this.dataset.is_private;
            let userimg     = this.dataset.image;
            let dataown     = this.dataset.own;
            let owner       = this.dataset.owner;
            let reason      = this.dataset.reason;
            let iscomplete  = this.dataset.complete;

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
            

            if(owner == "0"){
                todfinish.style.display = "block";
                forshared.style.display = "none";
                ownerstate.style.display = "none";
                document.getElementById("setcomplete").value = 2;
            }else{
                todfinish.style.display = "none";
                forshared.style.display = "block";
                ownerstate.style.display = "block";
                document.getElementById("setcomplete").value = 1;
                document.getElementById("isremove").value = 1;

                if(iscomplete == "-1"){
                    todremove.style.display = "block";
                    remreason.innerText = reason;
                }else if(iscomplete == "2"){
                    todcomplete.style.display = "block";
                }else{
                    todwaiting.style.display = "block";
                }

                if(isPrivate == "1"){
                    forshared.style.display = "none";
                }else{
                    forshared.style.display = "block";
                }

            }

            


            let edivbtn = document.querySelector('.openEditFromView');
            edivbtn.style.display = "none";
            let donebtn = document.querySelector('.markDoneBtn');
            donebtn.style.display = "block";

            let markfial = document.querySelector('.markfail');
            markfial.innerText = "Mark as Failed";

            

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
            if (dataown == "0") {
                ownedEl.style.display = "none";
                ownerstate.style.display = "none";
            } else if (dataown == "private"){
                ownedEl.style.display = "flex";
                edivbtn.style.display = "block";
                donebtn.style.display = "none";
                markfial.innerText = "Remove";
                document.getElementById("isremove").value = 1;
                removals.forEach(el => {
                    el.style.display = "block";
                });

                ownerstate.style.display = "none";

                faileds.forEach(el => {
                    el.style.display = "none";
                    document.getElementById("iscomplete").value = 0;
                });
                //show edit as well
            } else if (dataown == "today") {
                //check if timer starts then show otherwise hide it

                let timerDiv = document.querySelector(`.counter-div[data-todo-id="${dataid}"]`);
                let isReminderActive = timerDiv && timerDiv.dataset.reminderActive === "1";

                let ownedEl = document.querySelector('.owned');
                
                if (isReminderActive ) {
                    ownedEl.style.display = "flex";
                    if(owner == "1"){
                        ownerstate.style.display = "block";
                    }else{
                        ownerstate.style.display = "none";
                    }
                    
                } else {
                    ownedEl.style.display = "none";
                    ownerstate.style.display = "none";
                }
            }


           
            let imgTag = document.querySelector('.user-todo-img');
            imgTag.src = userimg;

            
            let sections    = JSON.parse(this.dataset.sections || "[]");

            let startDate   = this.dataset.start_date || "";
            let endDate   = this.dataset.end_date || "";
            let startTime   = this.dataset.start_time || "";
            let endTime     = this.dataset.end_time || "";

            

            let [year, month, day] = endDate.split('-').map(Number);
            let [hour, minute] = endTime.split(':').map(Number);
            let endDateTime = Date.UTC(year, month - 1, day, hour, minute);

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

            clearInterval(timerInterval);
            return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));

        document.getElementById("days").innerText = days;
        document.getElementById("hours").innerText = hours;
        document.getElementById("minutes").innerText = minutes;

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
                    
                modal.querySelector(".todo-total_time").innerText = tottime + " Hours";

                

            }else{
                
                document.getElementById("times_sch").style.display = "flex";
                document.getElementById("times_today").style.display = "none";
                
                // show times_sch
                modal.querySelector(".todo-start-date").innerText = formatDate(startDate);
                // Deliver â†’ start_time
                modal.querySelector(".todo-deliver-date").innerText = startTime || "--";
                // Deliver Time â†’ end_time
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
                typeBadge.innerText = "Private Todo";
                sharedBlock.style.display = "none";
                modal.querySelector(".todohead").classList.remove("shared");
            } else {
                typeBadge.innerText = "Shared Todo";
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
                    div.innerHTML = `
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



            // Sections
            let sectionContainer = modal.querySelector(".sections-list");
            sectionContainer.innerHTML = "";
            sections.forEach(section => {
                sectionContainer.innerHTML += `
                    <div style="background:#fff;border-radius:6px;padding:8px 12px;margin-bottom:8px;display:flex;align-items:center;">
                        <img src="/build/img/tera.svg" width="18" height="18" style="margin-right:10px;">
                        <span style="color:#667085;font-size:13.5px;">${section}</span>
                    </div>
                `;
            });
        });
    });
});

document.querySelectorAll(".addtodo").forEach(btn => {
    btn.addEventListener("click", function() {
    document.getElementById('todo_id').value = "";
    //document.getElementById("btnShared").click();
    //document.getElementById("btnToday").click();
   // document.querySelector(".time-btn-2").click();
    document.getElementById('todo_name').value = "";
   // document.querySelector(".rem-30").click();

    document.querySelectorAll('.user_div.user_active').forEach(el => {
            el.classList.remove('user_active');
        });


    

    document.getElementById("todo_heading").innerText = "Create new ToDo";
    });
});

document.querySelectorAll(".btnScheduled").forEach(btn => {
    btn.addEventListener("click", function() {
        document.getElementById("timeRow").style.display = "flex";
        document.getElementById("timeToday").style.display = "none";
    });
});

document.querySelectorAll(".btnToday").forEach(btn => {
    btn.addEventListener("click", function() {
        document.getElementById("timeRow").style.display = "none";
        document.getElementById("timeToday").style.display = "flex";
    });
});


function formatDate(dateStr) {
    if (!dateStr) return "--";
    const d = new Date(dateStr);
    if (isNaN(d)) return dateStr; // fallback if invalid
    return `${String(d.getDate()).padStart(2,'0')}.${String(d.getMonth()+1).padStart(2,'0')}.${d.getFullYear()}`;
}

document.addEventListener("click", function (event) {
    // close all open dropdowns if click is outside
    document.querySelectorAll(".dropdown-menu").forEach(menu => {
        if (!menu.previousElementSibling.contains(event.target) && !menu.contains(event.target)) {
            menu.style.display = "none";
        }
    });
});



document.querySelectorAll(".private_btn").forEach(btn => {
    btn.addEventListener("click", function () {
        // remove active class from all buttons
        document.querySelectorAll(".private_btn").forEach(b => b.classList.remove("active"));
        this.classList.add("active");

        let cid = this.getAttribute("cid");
        let items = document.querySelectorAll(".private_div .col-12");

        items.forEach(item => {
            if (cid === "all" || item.classList.contains(cid)) {
                item.style.display = "block";
            } else {
                item.style.display = "none";
            }
        });
        updateCount("private_div", "#private_count");
    });
});

document.querySelectorAll(".shared_btn").forEach(btn => {
    btn.addEventListener("click", function () {
        // remove active class from all buttons
        document.querySelectorAll(".shared_btn").forEach(b => b.classList.remove("active"));
        this.classList.add("active");

        let cid = this.getAttribute("cid");
        let items = document.querySelectorAll(".shared_div .col-12");

        items.forEach(item => {
            if (cid === "all" || item.classList.contains(cid)) {
                item.style.display = "block";
            } else {
                item.style.display = "none";
            }
        });

        
        updateCount("shared_div", "#shared_count");
    });
});


/*
function updateCount(containerClass, countSelector) {
   
    let visibleItems = document.querySelectorAll(
        `.${containerClass} .col-12:not([style*='display: none'])`
    );

    document.querySelector(countSelector).innerHTML = visibleItems.length;
   
}

function updateCountTyp(containerClass, countSelector) {
   
    let visibleItems = document.querySelectorAll(
        `.${containerClass} .col-12:not([style*='display: none'])`
    );

    document.querySelector(countSelector).innerHTML = visibleItems.length;
   
}
document.querySelectorAll(".todo_btn").forEach(btn => {
    btn.addEventListener("click", function () {
        // remove active class from all buttons
        document.querySelectorAll(".todo_btn").forEach(b => b.classList.remove("active"));
        this.classList.add("active");

        let cid = this.getAttribute("cid");
        let items = document.querySelectorAll(".todo_div .col-12");

        items.forEach(item => {
            if (cid === "all" || item.classList.contains(cid)) {
                item.style.display = "block";
            } else {
                item.style.display = "none";
            }
        });

        updateCount("todo_div", "#today_count");
    });
});

document.querySelectorAll(".typ_btn").forEach(btn => {
    btn.addEventListener("click", function () {
        let filter = this.getAttribute("cid"); // all, private, shared

        // reset active button
        document.querySelectorAll(".typ_btn").forEach(b => b.classList.remove("active"));
        this.classList.add("active");

        // filter items
        document.querySelectorAll(".todo_div .col-12").forEach(item => {
            if (filter === "all") {
                item.style.display = "";
            } else if (item.classList.contains(filter)) {
                item.style.display = "";
            } else {
                item.style.display = "none";
            }
        });

        updateCountTyp("todo_div", "#today_count");

    });
});
*/

let activePriority = "all";
let activeType = "all";

function applyFilters() {
    let items = document.querySelectorAll(".todo_div .col-12");
    let visibleCount = 0;

    items.forEach(item => {
        let matchPriority = (activePriority === "all" || item.classList.contains(activePriority));
        let matchType = (activeType === "all" || item.classList.contains(activeType));

        if (matchPriority && matchType) {
            item.style.display = "";
            visibleCount++;
        } else {
            item.style.display = "none";
        }
    });

    document.querySelector("#today_count").innerHTML = visibleCount;
}

// Priority filter buttons
document.querySelectorAll(".todo_btn").forEach(btn => {
    btn.addEventListener("click", function () {
        document.querySelectorAll(".todo_btn").forEach(b => b.classList.remove("active"));
        this.classList.add("active");

        activePriority = this.getAttribute("cid"); // low/middle/high/all
        applyFilters();
    });
});

// Type filter buttons
document.querySelectorAll(".typ_btn").forEach(btn => {
    btn.addEventListener("click", function () {
        document.querySelectorAll(".typ_btn").forEach(b => b.classList.remove("active"));
        this.classList.add("active");

        activeType = this.getAttribute("cid"); // private/shared/all
        applyFilters();
    });
});

// Run once at page load
applyFilters();


document.addEventListener('DOMContentLoaded', function () {
    // When clicking "Edit" inside the view modal (#inreject)
    const openEditBtn = document.getElementById('openEditFromView');
    if (openEditBtn) {
        openEditBtn.addEventListener('click', function () {
            const todoId = this.dataset.id;
            
            // Close the current view modal
            const viewModal = bootstrap.Modal.getInstance(document.getElementById('inreject'));
            if (viewModal) viewModal.hide();

            // Wait for modal to close animation
            setTimeout(() => {
                // Trigger the original .editTodo click handler for this todo ID
                const originalEditBtn = document.querySelector(`.editTodo[data-id="${todoId}"]`);
                if (originalEditBtn) {
                    originalEditBtn.click(); // triggers your existing JS to populate fields
                } else {
                    console.warn("No matching .editTodo button found for ID:", todoId);
                }
            }, 400);
        });
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const openEditFromView = document.getElementById('openEditFromView');

    if (openEditFromView) {
        openEditFromView.addEventListener('click', function () {
            const todoId = this.dataset.id;

            let ediv = ".edit_" + todoId;


            // Close the current modal
            const viewModal = bootstrap.Modal.getInstance(document.getElementById('inreject'));
            if (viewModal) viewModal.hide();

            // Wait a bit for animation, then trigger .editTodo click
            setTimeout(() => {
                const editBtn = document.querySelector(`.editTodo[data-id="${todoId}"]`);
                if (editBtn) {
                    editBtn.click();
                } else {
                    console.warn("No matching .editTodo found for ID:", todoId);
                }
            }, 400);
        });
    }
});



document.getElementById('markDoneBtn').addEventListener('click', function () {
    const todoId = this.dataset.id;
    if (!todoId) return;

    const modalEl = document.querySelector('#inreject'); const modal = bootstrap.Modal.getInstance(modalEl); if (modal) modal.hide();

    // set hidden field in modal
    document.getElementById('doneTodoId').value = todoId;

    // open modal
    const markModal = new bootstrap.Modal(document.getElementById('markDoneModal'));
    markModal.show();
});

// Handle "Save" button inside modal
/*
document.getElementById('markDoneForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const todoId = document.getElementById('doneTodoId').value;
    const url = `/todos/complete/${todoId}`;

    fetch(url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id: todoId })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Marked as Done!',
                text: 'Todo successfully marked as completed.'
            });

            // Close both modals
            const doneModal = bootstrap.Modal.getInstance(document.getElementById('markDoneModal'));
            if (doneModal) doneModal.hide();

            const mainModal = bootstrap.Modal.getInstance(document.querySelector('#inreject'));
            if (mainModal) mainModal.hide();

            // Fade out or refresh
            setTimeout(() => location.reload(), 1000);
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: data.message || 'Unable to mark as done.'
            });
        }
    })
    .catch(err => {
        console.error(err);
        Swal.fire({
            icon: 'error',
            title: 'Request Failed',
            text: 'Could not reach the server.'
        });
    });
});
*/

function showContent(tab) {
        // Show/hide content
        document.getElementById("overviewContent").style.display = tab === 'overview' ? 'block' : 'none';
        document.getElementById("statisticsContent").style.display = tab === 'statistics' ? 'block' : 'none';

        // Toggle button styles
        document.getElementById("btnOverview").className = tab === 'overview' ?
            'btn btn-success me-2' :
            'btn btn-light border me-2';

        document.getElementById("btnStatistics").className = tab === 'statistics' ?
            'btn btn-success' :
            'btn btn-light border';
    }


window.createAddPdfFile = function() {
    var input = document.createElement('input');
    input.type = 'file';
    input.accept = 'application/pdf, video/mp4, image/png, image/jpeg';
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

    var fileType = file.type;
    var iconSrc = '';
    var previewHTML = '';

    if (fileType.includes('pdf')) {
        iconSrc = 'https://admin.onlinesystems.info/build/img/pdf-icon.svg';
        previewHTML = `<img src="${iconSrc}" alt="PDF" style="width:20px;height:20px;">`;
    } else if (fileType.includes('image')) {
        var imageURL = URL.createObjectURL(file);
        previewHTML = `<img src="${imageURL}" alt="Image" style="width:40px;height:40px;object-fit:cover;border-radius:6px;">`;
    } else if (fileType.includes('video')) {
        iconSrc = 'https://cdn-icons-png.flaticon.com/512/711/711245.png';
        previewHTML = `<img src="${iconSrc}" alt="Video" style="width:24px;height:24px;">`;
    }

    var tile = document.createElement('div');
    tile.className = 'd-flex align-items-center gap-2 px-2';
    tile.style.cssText = 'border:1px solid #e5e7eb;border-radius:10px;height:60px;background:#fff;';
    tile.innerHTML =
        previewHTML +
        `<div class="d-flex flex-column" style="min-width:100px;">
            <small style="font-weight:600;">${file.name || 'File'}</small>
            <small style="color:#6b7280;">${Math.round(file.size / 1024)} KB</small>
        </div>
        <button type="button" class="btn" style="color:#ef4444;" onclick="removePdfTile(this)">
            <i class="ti ti-trash"></i>
        </button>`;

    if (addTile) list.insertBefore(tile, addTile);
    else list.appendChild(tile);

    tile._fileInput = fileInput;
};

window.removePdfTile = function(btn) {
    var tile = btn.closest('div');
    if (!tile) return;
    if (tile._fileInput) tile._fileInput.remove();
    tile.remove();
};


document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('.rating-group').forEach(group => {
        const stars = group.querySelectorAll('label.fa-star');

        stars.forEach((star, index) => {
            // Hover effect (highlight on hover)
            star.addEventListener('mouseenter', () => {
                stars.forEach((s, i) => {
                    s.classList.toggle('hovered', i <= index);
                });
            });

            // Remove hover when mouse leaves the group
            group.addEventListener('mouseleave', () => {
                stars.forEach(s => s.classList.remove('hovered'));
            });

            // Click to select rating
            star.addEventListener('click', () => {
                // Remove active from all in this group
                stars.forEach((s, i) => {
                    s.classList.toggle('active', i <= index);
                });

                // Set radio input value
                const inputs = group.querySelectorAll('input[type="radio"]');
                inputs.forEach((input, i) => {
                    input.checked = (i === index);
                });
            });
        });
    });
});


const titleEl = document.getElementById('todo_name');
const projectEl = document.getElementById('select_project');
const teamEl = document.getElementById('select_team');


document.getElementById('saveBtn').addEventListener('click', function (e) {
    
    e.preventDefault();
    const form = document.getElementById('todoForm');

  const title = titleEl.value.trim();
  const project = projectEl.value;
  const team = teamEl.value;

    const priorityHidden = document.getElementById('priorityHidden').value;
    const reminderHidden = document.getElementById('reminderHidden').value;
    const timeHidden = document.getElementById('timeHidden').value;
    const todoType = document.getElementById('todo_type').value;
    const todoVisibility = document.getElementById('todo_visibility').value;

    const startDate = document.getElementById('dateInput')?.value;
    const endDate = document.getElementById('enddateInput')?.value;
    const endTime = document.getElementById('endTimeSelect')?.value;

    let checkprojteam = 0;
    

    if (!todoVisibility) {
        alert("Please select 'Shared ToDo's' or 'Private ToDo's' before submitting.");
        return;
    }

    if (!todoType) {
        alert("Please select 'Today ToDo's' or 'Scheduled ToDo's' before submitting.");
        return;
    }

    if (todoVisibility === 'shared') {
        const activeUser = document.querySelector('.user_div.user_active');
        if (!activeUser) {
            alert('Please select at least one user for Shared ToDo.');
            return;
        }
        checkprojteam = 1;
    }

    if (todoType === 'scheduled') {
        if (!startDate) {
            alert('Please select a Start Date.');
            return;
        }
        if (!endDate) {
            alert('Please select a Deliver Date.');
            return;
        }
        if (!endTime) {
            alert('Please select a Deliver Time.');
            return;
        }

        // Optional: check that end date >= start date
        if (new Date(endDate) < new Date(startDate)) {
            alert('Deliver Date cannot be earlier than Start Date.');
            return;
        }
    }else if(!timeHidden){
        alert('Please provide Deliver time before submitting.');
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


document.querySelectorAll('.user_div').forEach(div => {
    div.addEventListener('click', () => {
        
        document.getElementById('selected_user').value = div.dataset.userId;
    });
});


        </script>
        @endsection