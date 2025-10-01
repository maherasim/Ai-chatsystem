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
    

@media screen and (max-width: 767px) {
    .project-succes{
        display:block !important;
    }
}

.reminder-btn {
    border: none;
    background-color: white;
    color: #64748b;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 12px;
}
.reminder-btn.active {
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
                                <h3 style="margin: 0;">TOday ToDo's</h3>
                                <strong>Total ToDo's: {{count($todayTodos)}}</strong>
                            </div>

                            <div class="d-flex flex-wrap justify-content-end" style="background: #f8fafc; border-radius: 8px; padding: 6px 10px; gap: 8px; max-width: 100%;">
                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#todomodel" style="white-space: nowrap;">
                                    Add TODO
                                </button>
                                <button type="button" class="btn" style="background: #32b768; border: 1px solid #32b768; color: white; border-radius: 6px; font-weight: 500; font-size: 14px; padding: 6px 18px; white-space: nowrap;">
                                    All
                                </button>
                                <button type="button" class="btn" style="background: #f8fafc; color: #566a7f; border-radius: 6px; font-weight: 500; font-size: 14px; padding: 6px 18px; white-space: nowrap;">
                                    Private
                                </button>
                                <button type="button" class="btn" style="background: #f8fafc; color: #566a7f; border-radius: 6px; font-weight: 500; font-size: 14px; padding: 6px 18px; white-space: nowrap;">
                                    Shared
                                </button>
                                <button type="button" class="btn" style="background: #f8fafc; color: #566a7f; border-radius: 6px; font-weight: 500; font-size: 14px; padding: 6px 18px; white-space: nowrap;">
                                    All
                                </button>
                                <button type="button" class="btn" style="background: #32b768; border: 1px solid #32b768; color: white; border-radius: 6px; font-weight: 500; font-size: 14px; padding: 6px 18px; white-space: nowrap;">
                                    Low
                                </button>
                                <button type="button" class="btn" style="background: #f8fafc; color: #566a7f; border-radius: 6px; font-weight: 500; font-size: 14px; padding: 6px 18px; white-space: nowrap;">
                                    Middle
                                </button>
                                <button type="button" class="btn" style="background: #f8fafc; color: #566a7f; border-radius: 6px; font-weight: 500; font-size: 14px; padding: 6px 18px; white-space: nowrap;">
                                    High
                                </button>
                            </div>

                        </div>

                        <!-- CARD CONTAINER -->
                        <div class="row g-3">

                            @forelse($todayTodos as $todo)
                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="card" style=" border-radius: 12px; overflow: hidden; box-shadow: 0 2px 6px rgba(0,0,0,0.1); height:max-content;">
                                    <!-- Card Header -->
                                    <div class="d-flex justify-content-between align-items-center" style="background-color: #ececec;">
                                        <div class="d-flex">
                                            <img src="{{ asset('storage/' . $todo->user->profile_image) }}" class=" me-2" alt="image" style="width: 40px; height: 40px;">
                                            <div>
                                                <div style="font-weight: bold;">{{$user->name;}}</div>
                                                <small style="color: gray;">{{$todo->created_at}}</small>
                                            </div>
                                        </div>
                                        <!--<div style="font-size: 20px; cursor: pointer; margin-right:12px">&#8942;</div>-->
                                        <!-- edit delete starts -->

                                        <div class="dropdown">
    <div class="dropdown-toggle1" id="todoMenu{{$todo->id}}" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 20px; cursor: pointer; margin-right:12px; ">
        ⋮
    </div>
    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="todoMenu{{$todo->id}}" style="height:40px; overflow:hidden; text-align:center;">
        
            <button type="submit" class="btn btn-sm btn-icon"   >
                <a href="javascript:void(0);" 
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
               <i class="fa fa-trash"></i> 
                </a>
                
            </button>

            <button type="button" class="btn btn-sm btn-icon "   >
                <a href="javascript:void(0);" 
               class="dropdown-item text-primary viewTodo" 
               data-id="{{ $todo->id }}"
   data-title="{{ $todo->title }}"
   data-description=""
   data-start_date="{{ $todo->start_date }}"
   data-start_time="{{ $todo->start_time }}"
   data-end_time="{{ $todo->end_time }}"
   data-is_private="{{ $todo->is_private }}"
   data-priority="{{ $todo->priority }}"
   data-reminder="{{ $todo->reminder }}"
   data-sections='@json($todo->description)'
   data-members='@json($todo->members_data)'
    data-bs-toggle="modal" data-bs-target="#inreject">
               <i class="fa fa-eye"></i>  
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


                                        <!-- edit delete ends -->
                                    </div>

                                    <!-- Card Body -->
                                    <div class="card-body ">
                                        <!-- Title & Avatars -->
                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <div class="d-flex align-items-center">
                                                <img src="{{URL::asset('/build/img/yekbon.svg')}}" class="me-2" style="width: 36px; height: 36px;" />
                                                <div>
                                                    <h6 class="mb-0 fw-bold" style="font-size: 14px;">{{$todo->title}}</h6>
                                                    
                                                    @if($todo->is_private == 0)
                                                        <small class="text-muted">
                                                            <img src="{{URL::asset('/build/img/share.svg')}}" style="width: 20px; height: 20px;" /> Shared
                                                        </small>
                                                    @else
                                                        <small class="text-muted">
                                                            <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}" class="rounded-circle me-1" alt="image" style="width: 20px; height: 20px;"> private
                                                        </small>
                                                    @endif
                                                </div>
                                            </div>
                                            <!-- Avatars -->
                                            <div class="d-flex" style="margin-left: auto;">
                                                <div style="position: relative; width: 60px; height: 30px;">
                                                   <!-- <img src="https://via.placeholder.com/30" class="rounded-circle" style="position: absolute; left: 0; z-index: 3; border: 2px solid white;" />
                                                    <img src="https://via.placeholder.com/30" class="rounded-circle" style="position: absolute; left: 15px; z-index: 2; border: 2px solid white;" />
                                                    <img src="https://via.placeholder.com/30" class="rounded-circle" style="position: absolute; left: 30px; z-index: 1; border: 2px solid white;" />-->
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Description -->
                                        <p class="mb-3 mt-3" style="font-size: 13px; color: #333;">
                                            
                                        </p>

                                        <!-- Date & Priority Row -->
                                        <div class="d-flex justify-content-between align-items-center p-1 rounded" style="background-color: #f8f8f8; font-size: 11px;margin-top: 20px;border-radius:10px;">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="text-success fw-semibold">Start: {{$todo->start_time}}</span>
                                                <span></span>
                                                <span class="text-muted">|</span>
                                                <span class="text-success fw-semibold">Deliver:</span>
                                                <span style="color: #f44336;">Today</span>
                                            </div>
                                            <div class="d-flex align-items-center gap-1" style="background: #fff; padding: 2px 8px; border-radius: 12px;">
                                                <span style="width: 8px; height: 8px; background-color: #4caf50; border-radius: 50%;"></span>
                                                <span style="color: #4caf50; font-weight: 500;">{{$todo->priority}}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Footer Button -->
                                    <div class="d-flex justify-content-center py-2" style="margin-top: -10px;">
                                        <button style="background-color: #fbbc05; color: white; border: none; padding: 6px 20px; border-radius: 10px; font-size: 14px; font-weight: 500;margin-bottom:3px;">
                                            Need Counte
                                        </button>
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
                                <h3 style="margin: 0;">Private ToDo's</h3>
                                <strong>Total private ToDo's: {{count($privateTodos)}}</strong>
                            </div>

                            <div class="d-flex" style="gap: 8px; background: #f8fafc; padding: 6px 10px; border-radius: 8px;margin-right:20px;">


                                <button type="button" class="btn"
                                    style="background: #32b768; border: 1px solid #32b768; color: white; border-radius: 6px; font-weight: 500; font-size: 14px; padding: 6px 18px;">
                                    All
                                </button>
                                <button type="button" class="btn"
                                    style="background: #f8fafc; color: #566a7f; border-radius: 6px; font-weight: 500; font-size: 14px; padding: 6px 18px;">
                                    Low
                                </button>
                                <button type="button" class="btn"
                                    style="background: #f8fafc;  color: #566a7f; border-radius: 6px; font-weight: 500; font-size: 14px; padding: 6px 18px; mar">
                                    Middle
                                </button>
                                <button type="button" class="btn" style="background: #f8fafc; color: #566a7f; border-radius: 6px; font-weight: 500; font-size: 14px; padding: 6px 18px; white-space: nowrap;">
                                    High
                                </button>

                            </div>

                        </div>
                        <!-- CARD CONTAINER -->
                        <div class="row g-3">
                            <!-- Start of Card 1 -->
                             @forelse($privateTodos as $todo)
                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="card" style="border-radius: 12px; overflow: hidden; box-shadow: 0 2px 6px rgba(0,0,0,0.1); height:max-content;">
                                    <!-- Card Header -->
                                    <div class="d-flex justify-content-between align-items-center" style="background-color: #ececec;">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('storage/' . $todo->user->profile_image) }}" class=" me-2" alt="image" style="width: 40px; height: 40px;">
                                            <div>
                                                <div style="font-weight: bold;">{{$user->name;}}</div>
                                                <small style="color: gray;">{{$todo->created_at}}</small>
                                            </div>
                                        </div>
                                        

<!-- edit delete starts -->

                                        <div class="dropdown">
    <div class="dropdown-toggle1" id="todoMenu{{$todo->id}}" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 20px; cursor: pointer; margin-right:12px; ">
        ⋮
    </div>
    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="todoMenu{{$todo->id}}" style="height:40px; overflow:hidden; text-align:center;">
        
            <button type="submit" class="btn btn-sm btn-icon"   >
                <a href="javascript:void(0);" 
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
               <i class="fa fa-trash"></i> 
                </a>
                
            </button>
            <button type="button" class="btn btn-sm btn-icon "    >
                <a href="javascript:void(0);" 
               class="dropdown-item text-primary viewTodo" 
               data-id="{{ $todo->id }}"
   data-title="{{ $todo->title }}"
   data-description=""
   data-start_date="{{ $todo->start_date }}"
   data-start_time="{{ $todo->start_time }}"
   data-end_time="{{ $todo->end_time }}"
   data-is_private="{{ $todo->is_private }}"
   data-priority="{{ $todo->priority }}"
   data-reminder="{{ $todo->reminder }}"
   data-sections='@json($todo->description)'
   data-members='@json($todo->members_data)'
    data-bs-toggle="modal" data-bs-target="#inreject">
               <i class="fa fa-eye"></i>  
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


                                        <!-- edit delete ends -->


                                    </div>

                                    <!-- Card Body -->
                                    <div class="card-body ">
                                        <!-- Title & Avatars -->
                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <div class="d-flex align-items-center">
                                                <img src="{{URL::asset('/build/img/yekbon.svg')}}" class="me-2" style="width: 36px; height: 36px;" />
                                                <div>
                                                    <h6 class="mb-0 fw-bold" style="font-size: 14px;">{{$todo->title}}</h6>
                                                    <small class="text-muted">
                                                        <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}" class="rounded-circle me-1" alt="image" style="width: 20px; height: 20px;"> private
                                                    </small>
                                                </div>
                                            </div>

                                        </div>

                                        <!-- Description -->
                                        <p class=" mt-3" style="font-size: 13px; color: #333;">
                                            
                                        </p>

                                        <!-- Date & Priority Row -->
                                        
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center p-1 rounded" style="background-color: #f8f8f8; font-size: 9px;border-radius:10px;">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="text-success fw-semibold">Start:</span>
                                                <span>{{$todo->start_date}}</span>
                                                <span class="text-muted">|</span>
                                                <span class="text-success fw-semibold">Deliver:</span>
                                                <span>{{$todo->end_time}}</span>
                                            </div>
                                            <div class="d-flex align-items-center gap-1" style="background: #fff; padding: 2px 8px; border-radius: 12px;">
                                                <span style="width: 8px; height: 8px; background-color: #4caf50; border-radius: 50%;"></span>
                                                <span style="color: #4caf50; font-weight: 500;">{{$todo->priority}}</span>
                                            </div>
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
                                <h3 style="margin: 0;">Shared ToDo's</h3>
                                <strong>Total private ToDo's: {{count($sharedTodos)}}</strong>
                            </div>

                            <div class="d-flex" style="gap: 8px; background: #f8fafc; padding: 6px 10px; border-radius: 8px;margin-right:20px;">


                                <button type="button" class="btn"
                                    style="background: #32b768; border: 1px solid #32b768; color: white; border-radius: 6px; font-weight: 500; font-size: 14px; padding: 6px 18px;">
                                    All
                                </button>
                                <button type="button" class="btn"
                                    style="background: #f8fafc; color: #566a7f; border-radius: 6px; font-weight: 500; font-size: 14px; padding: 6px 18px;">
                                    Low
                                </button>
                                <button type="button" class="btn"
                                    style="background: #f8fafc;  color: #566a7f; border-radius: 6px; font-weight: 500; font-size: 14px; padding: 6px 18px;">
                                    Middle
                                </button>
                                <button type="button" class="btn" style="background: #f8fafc; color: #566a7f; border-radius: 6px; font-weight: 500; font-size: 14px; padding: 6px 18px; white-space: nowrap;">
                                    High
                                </button>

                            </div>

                        </div>
                        <!-- CARD CONTAINER -->
                        <div class="row g-3">
                            @forelse($sharedTodos as $todo)
                            <!-- Start of Card 1 -->
                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="card" style=" border-radius: 12px; overflow: hidden; box-shadow: 0 2px 6px rgba(0,0,0,0.1); height:max-content;">
                                    <!-- Card Header -->
                                    <div class="d-flex justify-content-between align-items-center" style="background-color: #ececec;">
                                        <div class="d-flex">
                                            <img src="{{ asset('storage/' . $todo->user->profile_image) }}" class=" me-2" alt="image" style="width: 40px; height: 40px;">
                                            <div>
                                                <div style="font-weight: bold;">{{$user->name;}}</div>
                                                <small style="color: gray;">{{$todo->created_at}}</small>
                                            </div>
                                        </div>
                                        <!--<div style="font-size: 20px; cursor: pointer; margin-right:12px">&#8942;</div>-->
                                        <!-- edit delete starts -->

                                        <div class="dropdown">
    <div class="dropdown-toggle1" id="todoMenu{{$todo->id}}" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 20px; cursor: pointer; margin-right:12px; ">
        ⋮
    </div>
    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="todoMenu{{$todo->id}}" style="height:40px; overflow:hidden; text-align:center;">
        

            <button type="button" class="btn btn-sm btn-icon "   >
                <a href="javascript:void(0);" 
               class="dropdown-item text-primary viewTodo" 
               data-id="{{ $todo->id }}"
   data-title="{{ $todo->title }}"
   data-description=""
   data-start_date="{{ $todo->start_date }}"
   data-start_time="{{ $todo->start_time }}"
   data-end_time="{{ $todo->end_time }}"
   data-is_private="{{ $todo->is_private }}"
   data-priority="{{ $todo->priority }}"
   data-reminder="{{ $todo->reminder }}"
   data-sections='@json($todo->description)'
   data-members='@json($todo->members_data)'
    data-bs-toggle="modal" data-bs-target="#inreject">
               <i class="fa fa-eye"></i>  
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


                                        <!-- edit delete ends -->
                                    </div>

                                    <!-- Card Body -->
                                    <div class="card-body ">
                                        <!-- Title & Avatars -->
                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <div class="d-flex align-items-center">
                                                <img src="{{URL::asset('/build/img/yekbon.svg')}}" class="me-2" style="width: 36px; height: 36px;" />
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
                                                    <!--<img src="https://via.placeholder.com/30" class="rounded-circle" style="position: absolute; left: 0; z-index: 3; border: 2px solid white;" />
                                                    <img src="https://via.placeholder.com/30" class="rounded-circle" style="position: absolute; left: 15px; z-index: 2; border: 2px solid white;" />
                                                    <img src="https://via.placeholder.com/30" class="rounded-circle" style="position: absolute; left: 30px; z-index: 1; border: 2px solid white;" />-->
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Description -->
                                        <p class=" mt-3" style="font-size: 13px; color: #333;">
                                            
                                        </p>
                                        </div>
                                        <!-- Date & Priority Row -->
                                        <div class="d-flex justify-content-between align-items-center p-1 rounded" style="background-color: #f8f8f8; font-size: 9px;border-radius:10px;">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="text-success fw-semibold">Start:</span>
                                                <span>{{$todo->start_date}}</span>
                                                <span class="text-muted">|</span>
                                                <span class="text-success fw-semibold">Deliver:</span>
                                                <span>{{$todo->end_time}}</span>
                                            </div>
                                            <div class="d-flex align-items-center gap-1" style="background: #fff; padding: 2px 8px; border-radius: 12px;">
                                                <span style="width: 8px; height: 8px; background-color: #4caf50; border-radius: 50%;"></span>
                                                <span style="color: #4caf50; font-weight: 500;">{{$todo->priority}}</span>
                                            </div>
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

            <!-- Close Button -->
            <button type="button"
                data-bs-dismiss="modal"
                aria-label="Close"
                onclick="this.closest('.modal').classList.remove('show'); this.closest('.modal').style.display='none';"
                style="color: #1e293b; font-weight: bold; z-index: 999; width: 32px; height: 32px; line-height: 28px; text-align: center; font-size: 20px; position: absolute; top: 8px; right: 12px; border: none; background-color: transparent; border-radius: 50%; transition: all 0.3s ease;">
                ×
            </button>

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
                                <input name="title" id="editTitle" type="text" class="form-control"
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

            <!-- Close Button -->
            <button type="button"
                data-bs-dismiss="modal"
                aria-label="Close"
                onclick="this.closest('.modal').classList.remove('show'); this.closest('.modal').style.display='none';"
                onmouseover="this.style.backgroundColor='red'; this.style.color='white';"
                onmouseout="this.style.backgroundColor='transparent'; this.style.color='#1e293b';"
                style="color: #1e293b; font-weight: bold; z-index: 999; width: 32px; height: 32px; line-height: 28px; text-align: center; font-size: 20px; position: absolute; top: 8px; right: 12px; border: none; background-color: transparent; border-radius: 50%; transition: all 0.3s ease;">
                ×
            </button>

            <form action="{{ route('todos.store') }}" method="POST">
                @csrf

                <input type="hidden" name="start_date" id="startDateHidden">
                <input type="hidden" name="start_time" id="startTimeHidden">
                <input type="hidden" name="end_time" id="endTimeHidden">
                <input type="hidden" name="is_private" id="isPrivateHidden" value="0">
                <input type="hidden" name="priority" id="priorityHidden" value="low">
                <input type="hidden" name="reminder" id="reminderHidden" value="6">

                <!-- new changes -->
            <div class="modal-body p-4" style="background-color: white;">
                <!-- Header -->
                <h5 style="font-weight: 600; color: #1e293b;">Create new ToDo
                    <!-- Toggle Buttons -->
                        <div style="background-color: white; background-color: #f9f9fb; border-radius: 12px; padding:8px; float:right; border-radius: 10px; padding: 4px; display: flex; gap: 8px;">
                            <button type="button" id="btnShared"
                                onclick="this.style.backgroundColor='#22c55e'; this.style.color='white'; document.getElementById('btnPrivate').style.backgroundColor='transparent'; document.getElementById('btnPrivate').style.color='#64748b';"
                                style="border: none; background-color: #22c55e; color: white; padding: 4px 10px; border-radius: 6px; font-size: 13px; font-weight: 500;">
                                Shared ToDo's
                            </button>
                            <button type="button" id="btnPrivate"
                                onclick="this.style.backgroundColor='#22c55e'; this.style.color='white'; document.getElementById('btnShared').style.backgroundColor='transparent'; document.getElementById('btnShared').style.color='#64748b';"
                                style="border: none; background-color: transparent; color: #64748b; padding: 4px 10px; border-radius: 6px; font-size: 13px; font-weight: 500;">
                                Private ToDo's
                            </button>
                        </div>




                </h5>
                <p style="color: #64748b; font-size: 14px;">Manage your Time</p>

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
                            <input name="title" type="text" class="form-control" placeholder="ToDo Title"
                                style="font-size: 13px; background-color: white; border-radius: 8px;">
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex gap-2">
                                <button type="button" id="priorityLow" onclick="this.style.backgroundColor='#22c55e'; this.style.color='white'; document.getElementById('priorityMiddle').style.backgroundColor='white'; document.getElementById('priorityMiddle').style.color='#64748b'; document.getElementById('priorityHigh').style.backgroundColor='white'; document.getElementById('priorityHigh').style.color='#64748b';" style="border: none; background-color: #22c55e; color: white; padding: 6px 12px; border-radius: 6px; font-size: 12px;">Low</button>
                                <button type="button" id="priorityMiddle" onclick="this.style.backgroundColor='#22c55e'; this.style.color='white'; document.getElementById('priorityLow').style.backgroundColor='white'; document.getElementById('priorityLow').style.color='#64748b'; document.getElementById('priorityHigh').style.backgroundColor='white'; document.getElementById('priorityHigh').style.color='#64748b';" style="border: none; background-color: white; color: #64748b; padding: 6px 12px; border-radius: 6px; font-size: 12px;">Middle</button>
                                <button type="button" id="priorityHigh" onclick="this.style.backgroundColor='#22c55e'; this.style.color='white'; document.getElementById('priorityLow').style.backgroundColor='white'; document.getElementById('priorityLow').style.color='#64748b'; document.getElementById('priorityMiddle').style.backgroundColor='white'; document.getElementById('priorityMiddle').style.color='#64748b';" style="border: none; background-color: white; color: #64748b; padding: 6px 12px; border-radius: 6px; font-size: 12px;">High</button>
                            </div>
                        </div>
                        
                    </div>
                    <!--
                    <div class="row g-2 mt-2">
                        <div class="col-md-12">
                            <input name="description" type="text" class="form-control" placeholder="Section Description"
                                style="font-size: 13px; background-color: white; border-radius: 8px;">
                        </div>

                    </div>-->

                    <div class="row g-2 mt-2" id="sectionsWrapper">
                        <div class="col-md-12 d-flex align-items-center section-item">
                            <input name="sections[]" type="text" class="form-control" placeholder="Section Description" 
                                style="font-size: 13px; background-color: white; border-radius: 8px;">
                            <button type="button" class="btn btn-success btn-sm ms-2 add-btn">+</button>
                        </div>
                    </div>


                </div>

                <div class="mb-3" id="selectUsersBox" style="background-color: #f9f9fb; border-radius:10px; padding:16px;">
                    <h5>Select Users</h5>
                    <p>Project - Team</p>

                    <div class="row">
                        @foreach($users as $cuser)
                            <div class="col-md-3 user_div invit-box text-center" 
                                id="user_{{$cuser->_id}}" 
                                data-user-id="{{$cuser->_id}}">
                                <div class="invit-img">
                                    <img src="{{ asset('storage/' . $cuser->profile_image) }}" />
                                </div>
                                <div class="invit-txt">{{$cuser->name}}</div>
                            </div>
                        @endforeach
                    </div>


                </div>


                 

                <!-- Today/Scheduled Toggle + Date/Time Section -->
                <div style="background-color: #f9f9fb; border-radius:10px;">
                    <!-- Toggle Today/Scheduled -->
                    <div style="display: flex;  margin-bottom: 6px; margin-top: 4px;">
                        <div style="border-radius: 10px; padding: 8px; display: flex; gap: 8px;">
                            <button id="btnToday" type="button"
                                onclick="
                    this.style.backgroundColor='#22c55e';
                    this.style.color='white';
                    document.getElementById('btnScheduled').style.backgroundColor='transparent';
                    document.getElementById('btnScheduled').style.color='#64748b';
                    document.getElementById('startDateField').style.display='none';
                    document.getElementById('timeRow').classList.add('justify-content-center1');"
                                style="border: none; background-color: #22c55e; color: white; padding: 6px 12px; border-radius: 6px; font-size: 13px; font-weight: 500;">
                                Today ToDo's
                            </button>

                            <button id="btnScheduled" type="button"
                                onclick="
                    this.style.backgroundColor='#22c55e';
                    this.style.color='white';
                    document.getElementById('btnToday').style.backgroundColor='transparent';
                    document.getElementById('btnToday').style.color='#64748b';
                    document.getElementById('startDateField').style.display='block';
                    document.getElementById('timeRow').classList.remove('justify-content-center');"
                                style="border: none; background-color: transparent; color: #64748b; padding: 6px 12px; border-radius: 6px; font-size: 13px; font-weight: 500;">
                                Scheduled ToDo's
                            </button>
                        </div>
                    </div>

                    <!-- Date & Time Inputs -->
                    <div class="row g-2 align-items-center1 mb-3 justify-content-center1" id="timeRow" style="padding: 8px; display: flex;">

                        <!-- Start Date (hidden by default) -->
                        <div class="col-md-4" id="startDateField" style="position: relative; display: none;">
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
    <div style="background-color: #fff; border-radius: 12px; padding: 2px 16px; width: 100%; border: 1px solid #e0e0e0; height: 45px; display: flex; flex-direction: column; justify-content: center;">
        
        <select name="start_time" id="startTimeSelect" 
            style="border: none; font-size: 13px; color: #333; background: transparent; width: 100%; outline: none;">
            <option value="">Select Time</option>
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
        
        <select name="end_time" id="endTimeSelect" 
            style="border: none; font-size: 13px; color: #333; background: transparent; width: 100%; outline: none;">
            <option value="">Select Time</option>
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
                                <div class="d-flex gap-2">
                                    <button type="button" class="reminder-btn active" data-value="30">30 Min</button>
                                    <button type="button" class="reminder-btn" data-value="60">60 Min</button>
                                    <button type="button" class="reminder-btn" data-value="120">2 Hour</button>
                                    <button type="button" class="reminder-btn" data-value="180">3 Hour</button>
                                    <button type="button" class="reminder-btn" data-value="240">4 Hour</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Create Button -->
                <div class="text-center">
                    <button class="btn" style="background-color: #5b21b6; color: white; padding: 8px 40px; border-radius: 8px; font-size: 14px;">
                        Create
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
                <input type="text" name="reason" required placeholder="Type the Reason"
                    style="width: 100%; padding: 12px 14px; margin-bottom: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px; background-color: #fff;">

            </div>

            <!-- Save Button -->
            <div class="text-center" style="margin-top: 15px;">
                <button type="submit" class="btn" 
                    style="background-color: #f7f7f7; border: 1px solid #ddd; border-radius: 8px; padding: 6px 20px; font-size: 14px; font-weight: 500;">
                    Save & Close
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
                    <div style="position: absolute; bottom: -30px; left: 50%; transform: translateX(-50%); background: white; border-radius: 50%; padding: 5px;">
                        <img src="{{ URL::asset('/build/img/yekbon.svg') }}" alt="Logo" style="width: 60px; height: 60px; border-radius: 50%;">
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
                            <span class="todo-type  badge bg-secondary">Priviatess Todo's</span>
                            <span class="todo-type badge rounded-pill todo-priority" style="color: #22c55e; font-size: 13px; padding: 8px 12px;">
                                <i class="bi bi-circle-fill me-1" style="font-size: 8px;"></i> Low
                            </span>
                        </p>

                        
                    </div>

                    <div class="mt-2 mb-3 " style="background-color: #f8f9fa; padding:10px; border-radius: 15px; box-shadow: 0px 0px 5px rgba(0,0,0,0.05);">

                        <!-- Title -->
                        <h5 class="text-center fw-bold mb-3" style="color: #1c2233;">Todo Start & Deliver Time</h5>

                        <!-- Info Row -->
                        <div class="d-flex flex-wrap justify-content-around text-center" style="font-size: 13px;">
                            
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

                    </div>

                    <!-- Invited User -->
                    <div class="mt-2 mb-3 invited-users-block" style="background-color: #f8f9fa; padding:10px; border-radius: 15px; box-shadow: 0px 0px 5px rgba(0,0,0,0.05);">

                        
                        <h5 class=" fw-bold" style="color: #1c2233;">Invited Users</h5>
                        <p>Shared Todo with </p>

                        <!-- Info Row -->
                        <div class="row text-center invited-users-list todo-members" style="font-size: 14px; margin:auto;">
                            
                            <div class="col-md-3 invit-box">
                                <div class="invit-img">
                                    <img src="http://127.0.0.1:8000/storage/profiles/VOXSJ0zTCVhJBEj1bOAFYiZbRnJPaCmJ1mXWvU07.png" class=" me-2" alt="image" style="width: 40px; height: 40px;">
                                </div>
                                <div class="invit-txt">User name</div>
                            </div>
                        </div>

                    </div>
                   
                    
                    <!-- Notes -->
                    <!-- Notes Section (Exact Match) -->
                    <div class="p-3" style="background-color: #f5f5f5; border-radius: 10px;">
                        <div style="font-weight: 600; color: #333; font-size: 14px; margin-bottom: 10px;">• Description •</div>
                        <div class="sections-list"></div>
                        
                    </div>
                    


                    <div style="display: flex; justify-content: space-around; background: #f8f9fa; padding: 20px; border-radius: 10px;" class="mt-3">

                        <!-- Edit the Project -->
                        <div style="text-align: center; flex: 1;cursor:pointer; display:none;">
                            <div style="background: #316b9e; padding: 10px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;">
                                <img src="{{ asset('build/img/editp.svg') }}" alt="Edit" width="30" height="30">
                            </div>
                            <div style="margin-top: 6px; color: #1c2b48; font-size: 12px; font-weight: 600;">Edit The Project</div>
                        </div>


                        <!-- Remove the Project -->
                        <div style="text-align: center; flex: 1; cursor: pointer;"
                            data-bs-toggle="modal" data-bs-target="#removeModel">

                            <div style="background: #f44336; padding: 10px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;">
                                <img src="{{ asset('build/img/deletep.svg') }}" alt="Delete" width="30" height="30">
                            </div>

                            <div style="margin-top: 6px; color: #1c2b48; font-size: 12px; font-weight: 600;">
                                Remove The Todo
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
                ×
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


                <!-- ✅ Priority & Reminder Section Styled Box -->
                <div class="p-3 mb-3 rounded" style="background-color: #f5f7fa; box-shadow: inset 0 0 2px rgba(0,0,0,0.05);">
                    <div class="row g-3">
                        <!-- Meeting Priority -->
                        <div class="col-md-6">
                            <p style="font-size: 12px; font-weight: 600; color: #334155;">Meeting Priority</p>
                            <p style="font-size: 11px; color: #6b7280;">Set the Priority of the Meeting</p>
                            <div class="d-flex gap-2">
                                <button id="priorityLow" onclick="
          this.style.backgroundColor='#22c55e';
          this.style.color='white';
          document.getElementById('priorityMiddle').style.backgroundColor='white';
          document.getElementById('priorityMiddle').style.color='#64748b';
          document.getElementById('priorityHigh').style.backgroundColor='white';
          document.getElementById('priorityHigh').style.color='#64748b';
        " style="border: none; background-color: #22c55e; color: white; padding: 6px 12px; border-radius: 6px; font-size: 12px;">
                                    Low
                                </button>

                                <button id="priorityMiddle" onclick="
          this.style.backgroundColor='#22c55e';
          this.style.color='white';
          document.getElementById('priorityLow').style.backgroundColor='white';
          document.getElementById('priorityLow').style.color='#64748b';
          document.getElementById('priorityHigh').style.backgroundColor='white';
          document.getElementById('priorityHigh').style.color='#64748b';
        " style="border: none; background-color: white; color: #64748b; padding: 6px 12px; border-radius: 6px; font-size: 12px;">
                                    Middle
                                </button>

                                <button id="priorityHigh" onclick="
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
});
document.getElementById('priorityMiddle').addEventListener('click', function (e) {
    e.preventDefault();
    document.getElementById('priorityHidden').value = 'middle';
});
document.getElementById('priorityHigh').addEventListener('click', function (e) {
    e.preventDefault();
    document.getElementById('priorityHidden').value = 'high';
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


document.addEventListener("DOMContentLoaded", function () {
    const membersSelect = document.getElementById("members");

    document.querySelectorAll(".user_div").forEach(div => {
        div.addEventListener("click", function () {
            let userId = this.getAttribute("data-user-id");

            // toggle active class
            this.classList.toggle("user_active");

            // check if selected
            let option = membersSelect.querySelector(`option[value="${userId}"]`);
            if (this.classList.contains("user_active")) {
                option.selected = true;
            } else {
                option.selected = false;
            }
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
        if (e.target.classList.contains("add-btn")) {
            // create new section row
            const div = document.createElement("div");
            div.className = "col-md-12 d-flex align-items-center section-item mt-2";
            div.innerHTML = `
                <input name="sections[]" type="text" class="form-control" placeholder="Section Description" 
                       style="font-size: 13px; background-color: white; border-radius: 8px;">
                <button type="button" class="btn btn-danger btn-sm ms-2 remove-btn">-</button>
            `;
            wrapper.appendChild(div);
        }

        if (e.target.classList.contains("remove-btn")) {
            e.target.closest(".section-item").remove();
        }
    });
});

let timerInterval;

document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("inreject");

    document.querySelectorAll(".viewTodo").forEach(btn => {
        btn.addEventListener("click", function () {
            // Get attributes
            let dataid      = this.dataset.id;

            document.getElementById("remid").value = dataid;
            

            let title       = this.dataset.title;
            let description = this.dataset.description;
            let priority    = this.dataset.priority || "Normal";
            let isPrivate   = this.dataset.is_private;
            
            let sections    = JSON.parse(this.dataset.sections || "[]");

            let startDate   = this.dataset.start_date || "";
            let startTime   = this.dataset.start_time || "";
            let endTime     = this.dataset.end_time || "";

            let endDateTime = new Date(`${startDate} ${endTime}`).getTime();
            const CIRC = 157; 

            if (timerInterval) clearInterval(timerInterval);

            function updateTimer() {
        const now = new Date().getTime();
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
    timerInterval = setInterval(updateTimer, 60000);

            modal.querySelector(".todo-start-date").innerText = formatDate(startDate);
            // Deliver → start_time
            modal.querySelector(".todo-deliver-date").innerText = startTime || "--";
            // Deliver Time → end_time
            modal.querySelector(".todo-deliver-time").innerText = endTime || "--";

            // Set title & description
            modal.querySelector(".todo-title").innerText = title;
           // modal.querySelector(".todo-description").innerText = description || "No description.";

            // Priority
            let priorityBadge = modal.querySelector(".todo-priority");
            priorityBadge.innerHTML = `<i class="bi bi-circle-fill me-1" style="font-size: 8px;"></i> ${priority}`;

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

            if (members.length) {
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

function formatDate(dateStr) {
    if (!dateStr) return "--";
    const d = new Date(dateStr);
    if (isNaN(d)) return dateStr; // fallback if invalid
    return `${String(d.getDate()).padStart(2,'0')}.${String(d.getMonth()+1).padStart(2,'0')}.${d.getFullYear()}`;
}

        </script>
        @endsection