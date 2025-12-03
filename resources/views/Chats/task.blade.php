<?php $page = 'index'; ?>
@extends('layout.mainlayout')
@section('content')


    <style>
        /* Ensure base styles don't interfere */

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

        .elevated-card {
            border-radius: 12px;
            border: 1px solid #dee2e6;
            /* Light-dark border */
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
            /* very light shadow */
            transform: translateY(-2px);
            /* very slight lift */
            background-color: #fff;
            padding: 20px;
            text-align: center;
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
            color: #888;
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
            background-color: #ccc;
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
        @include('Chats.notification')
        <!-- /Sidebar group -->

        <!-- Chat -->





        <div class="chat chat-messages show" id="middle">
            <div>
                @include('Chats.header')
                <!-- body -->
                <div style="overflow-y: auto;flex:1;height: 100vh;">
                    <div class="chat-body chat-page-group">
                        <!-- Container for the full width -->
                        <div class="row py-2" style="gap: 47px;">
                            <!-- Card 1 -->
                            <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                                <div class="px-3 py-2 h-100"
                                    style="border-radius: 10px; background: #fff; position: relative; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div style="font-size: 0.9rem; color: #1e2b4d;">Received Tasks</div>
                                        <div style="background-color: #eae8fd; border-radius: 50%; padding: 5px;">
                                            <img src="{{ URL::asset('/build/img/sigma.svg') }}" alt="icon"
                                                style="width: 18px; height: 18px;" />
                                        </div>
                                    </div>
                                    <div class="fw-bold mt-1" style="font-size: 1.5rem; color: #1e2b4d;"><i class="fas fa-spinner fa-spin" style="font-size: 18px; color: #1e2b4d;"></i></div>
                                    <div
                                        style="position: absolute; bottom: 8px; right: 16px; font-size: 0.9rem; color: #28c76f;">
                                        <i class="bi bi-arrow-up-right"></i> 8.5%
                                    </div>
                                </div>
                            </div>

                            <!-- Card 2 -->
                            <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                                <div class="px-3 py-2 h-100"
                                    style="border-radius: 10px; background: #fff; position: relative; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div style="font-size: 0.9rem; color: #1e2b4d;">On time Deliver</div>
                                        <div style="background-color: #e9f8dd; border-radius: 50%; padding: 5px;">
                                            <img src="{{ URL::asset('/build/img/like.svg') }}" alt="icon"
                                                style="width: 20px; height: 20px;" />
                                        </div>
                                    </div>
                                    <div class="fw-bold mt-1" style="font-size: 1.5rem; color: #1e2b4d;"><i class="fas fa-spinner fa-spin" style="font-size: 18px; color: #1e2b4d;"></i></div>
                                    <div
                                        style="position: absolute; bottom: 8px; right: 16px; font-size: 0.9rem; color: #28c76f;">
                                        <i class="bi bi-arrow-up-right"></i> 8.5%
                                    </div>
                                </div>
                            </div>

                            <!-- Card 3 -->
                            <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                                <div class="px-3 py-2 h-100"
                                    style="border-radius: 10px; background: #fff; position: relative; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div style="font-size: 0.9rem; color: #1e2b4d;">Delayed Deliver</div>
                                        <div style="background-color: #fde6e6; border-radius: 50%; padding: 5px;">
                                            <img src="{{ URL::asset('/build/img/delayed.svg') }}" alt="icon"
                                                style="width: 20px; height: 20px;" />
                                        </div>
                                    </div>
                                    <div class="fw-bold mt-1" style="font-size: 1.5rem; color: #1e2b4d;"><i class="fas fa-spinner fa-spin" style="font-size: 18px; color: #1e2b4d;"></i></div>
                                    <div
                                        style="position: absolute; bottom: 8px; right: 16px; font-size: 0.9rem; color: #ff2e2e;">
                                        <i class="bi bi-arrow-down-right"></i> 8.5%
                                    </div>
                                </div>
                            </div>

                            <!-- Card 4 -->
                            <div class="col-12 col-sm-6 col-md-6 col-lg-2">
                                <div class="px-3 py-2 h-100"
                                    style="border-radius: 10px; background: #fff; position: relative; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div style="font-size: 0.9rem; color: #1e2b4d;">Rejected Task</div>
                                        <div style="background-color: #fddede; border-radius: 50%; padding: 5px;">
                                            <img src="{{ URL::asset('/build/img/rejected.svg') }}" alt="icon"
                                                style="width: 20px; height: 20px;" />
                                        </div>
                                    </div>
                                    <div class="fw-bold mt-1" style="font-size: 1.5rem; color: #1e2b4d;"><i class="fas fa-spinner fa-spin" style="font-size: 18px; color: #1e2b4d;"></i></div>
                                    <div
                                        style="position: absolute; bottom: 8px; right: 16px; font-size: 0.9rem; color: #ff2e2e;">
                                        <i class="bi bi-arrow-down-right"></i> 8.5%
                                    </div>
                                </div>
                            </div>

                            <!-- Card 5 -->
                            <div class="col-12 col-sm-6 col-md-6 col-lg-2">
                                <div class="px-3 py-2 h-100"
                                    style="border-radius: 10px; background: #fff; position: relative; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div style="font-size: 0.9rem; color: #1e2b4d;">Total Done</div>
                                        <div style="background-color: #d9f5e8; border-radius: 50%; padding: 5px;">
                                            <img src="{{ URL::asset('/build/img/Done.svg') }}" alt="icon"
                                                style="width: 20px; height: 20px;" />
                                        </div>
                                    </div>
                                    <div class="fw-bold mt-1" style="font-size: 1.5rem; color: #1e2b4d;"><i class="fas fa-spinner fa-spin" style="font-size: 18px; color: #1e2b4d;"></i></div>
                                    <div
                                        style="position: absolute; bottom: 8px; right: 16px; font-size: 0.9rem; color: #28c76f;">
                                        <i class="bi bi-arrow-up-right"></i> 8.5%
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin: 10px;">
                            {{ session('success') }}
                             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin: 10px;">
                            {{ session('error') }}
                             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <!-- project overview -->
                        <div
                            class="project-succes pt-4 pb-2 d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3" style="display:flex !important; flex-wrap:wrap;padding-right:490px">
                            <div>
                                <h3 >Current Tasks</h3>
                                <strong>Task Overview</strong>
                            </div>
                       <!---
                            <div class="d-flex justify-content-start"
                                style="gap: 8px; background: #f8fafc;padding-right: 492px padding: 6px 10px; border-radius: 8px;">
                                <button type="button" class="btn" data-bs-toggle="modal"
                                    data-bs-target="#createTaskModal"
                                    style="background: #32b768; border: 1px solid #32b768; color: white; border-radius: 6px; font-weight: 500; font-size: 14px; padding: 6px 18px;">
                                    + Mobile Task
                                </button>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#webtask2"
                                    style="background-color:blue ; color: white; border: none; padding: 8px 14px; border-radius: 6px; font-weight: 500; cursor:pointer;">
                                    + Web Task
                                </button>

                                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#emptask"
                                    style="background-color: red; color: white; border: none; padding: 8px 14px; border-radius: 6px; font-weight: 500; cursor:pointer;">
                                    + Employee Task
                                </button>


                            </div>
    -->
                        </div>
                        <div
                            style="background-color: #f7f7f7; padding: 16px; border-radius: 12px; font-family: 'Segoe UI', sans-serif;">
                            <div class="d-flex flex-wrap justify-content-between align-items-start mb-3">

                                <!-- Left Icon -->
                                <img src="{{ asset('build/img/lato.svg') }}" alt="Icon"
                                    style="width: 50px; height: auto; margin-bottom:3px;">

                                <!-- Project Summary -->
                                <div style="background-color: white;border-radius:6px;padding:5px; padding-right:450px;">

                                    <div class="d-flex gap-1 mt-1 flex-nowrap">
                                        @if(isset($projects) && count($projects))
                                            @foreach($projects as $project)
                                                <div class="d-flex align-items-center gap-2" style="background: #f7f7f7; padding: 6px 10px; border-radius: 8px; font-size: 13px;">
                                                    <!-- Logo -->
                                                    @if(!empty($project->logo_path))
                                                        <img src="{{ asset('storage/' . $project->logo_path) }}" alt="Logo" style="width: 30px; height: 30px; object-fit: cover; border-radius: 4px;">
                                                    @else
                                                        <img src="{{ URL::asset('/build/img/yekbon.svg') }}" alt="Logo" style="width: 30px; height: 30px;">
                                                    @endif

                                                    <!-- Project Title and Badges -->
                                                    <div class="d-flex flex-column" style="line-height: 1.2;">
                                                        <strong style="color: #1a2343; font-size: 13px;">
                                                            {{ $project->title }}
                                                        </strong>
                                                        <div class="d-flex gap-2 mt-1">
                                                            <span style="color: #1a2343;">Tickets
                                                                <span style="background: #ff4d4f; color: #fff; border-radius: 50%; padding: 2px 6px; font-size: 10px;">
                                                                    {{ $project->tickets()->count() }}
                                                                </span>
                                                            </span>
                                                            <span style="color: #1a2343;">Tasks
                                                                <span style="background: #ff4d4f; color: #fff; border-radius: 50%; padding: 2px 6px; font-size: 10px;">
                                                                    @php
                                                                        $pid = (string) ($project->_id ?? $project->id);
                                                                        $taskCount  = collect($tasks ?? [])->filter(function($t) use ($pid){ return (string)($t->project_id ?? '') === $pid; })->count();
                                                                        $taskCount += collect($webtasks ?? ($webTasks ?? []))->filter(function($t) use ($pid){ return (string)($t->project_id ?? '') === $pid; })->count();
                                                                        $taskCount += collect($employeetasks ?? ($employeeTasks ?? []))->filter(function($t) use ($pid){ return (string)($t->project_id ?? '') === $pid; })->count();
                                                                    @endphp
                                                                    {{ $taskCount }}
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>

                                        <!-- Project Tag 2 -->
                                         
                                        <!-- project tag 3 -->
                                         
                                        <!-- project tag 4 -->
                                         

                                        <!-- Marker details modal -->
                                        <div class="modal fade" id="markerDetailsModal" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content" style="border-radius:12px;">
                                                    <div class="modal-header" style="background:#fff;">
                                                        <div>
                                                            <h6 class="modal-title mb-0" style="font-weight:600;">Add
                                                                Issue</h6>
                                                            <small class="text-muted">Create a Issue</small>
                                                        </div>

                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-2">
                                                            <label class="form-label"
                                                                style="font-weight:600;color:#2b2d42;">Type the
                                                                Title</label>
                                                            <div style="position:relative;">
                                                                <input type="text" id="marker-title" name="title"
                                                                    class="form-control form-control-sm"
                                                                    placeholder="Type the Title"
                                                                    style="border:3px solid #ced4da;border-radius:10px;background:#fff;color:#2b2d42;height:38px;padding-right:38px;" />
                                                                <img src="{{ asset('assets/img/title.svg') }}"
                                                                    alt="title"
                                                                    style="position:absolute;right:10px;top:50%;transform:translateY(-50%);width:16px;height:16px;opacity:.8;" />
                                                            </div>
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label"
                                                                style="font-weight:600;color:#2b2d42;">Describe the issue
                                                            </label>
                                                            <div style="position:relative;">
                                                                <input type="text" id="marker-description"
                                                                    name="description"
                                                                    class="form-control form-control-sm"
                                                                    placeholder="Describe the issue"
                                                                    style="border:3px solid #ced4da;border-radius:10px;background:#fff;color:#2b2d42;height:38px;padding-right:38px;" />
                                                                <img src="{{ asset('assets/img/title.svg') }}"
                                                                    alt="title"
                                                                    style="position:absolute;right:10px;top:50%;transform:translateY(-50%);width:16px;height:16px;opacity:.8;" />
                                                            </div>
                                                        </div>
                                                        <div class="d-flex gap-2 mb-2">
                                                            <div class="flex-fill">
                                                                <label class="form-label">Start Date</label>
                                                                <div style="position:relative;">
                                                                    <input type="date" id="marker-start"
                                                                        class="form-control form-control-sm"
                                                                        style="padding-right:38px;border-radius:10px;" />
                                                                    <img src="{{ asset('assets/img/date.png') }}"
                                                                        alt="date"
                                                                        style="position:absolute;right:10px;top:50%;transform:translateY(-50%);width:16px;height:16px;opacity:.8;" />
                                                                </div>
                                                            </div>
                                                            <div class="flex-fill">
                                                                <label class="form-label">Deliver Date</label>
                                                                <div style="position:relative;">
                                                                    <input type="date" id="marker-end"
                                                                        class="form-control form-control-sm"
                                                                        style="padding-right:38px;border-radius:10px;" />
                                                                    <img src="{{ asset('assets/img/date.png') }}"
                                                                        alt="date"
                                                                        style="position:absolute;right:10px;top:50%;transform:translateY(-50%);width:16px;height:16px;opacity:.8;" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{-- <div class="mb-2">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <div>
                                        <div class="form-label m-0" style="font-weight:600;color:#2b2d42;">Checkpoints</div>
                                        <small class="text-muted">Create Checkpoints</small>
                                    </div>
                                    <button type="button" id="add-checkpoint" class="btn btn-sm p-0" style="color:#fff;width:28px;height:28px;border-radius:50%;display:flex;align-items:center;justify-content:center;">
                                        <img src="{{ asset('assets/img/add.svg') }}" alt="add" style="width:14px;height:14px;"/>
                                    </button>
                                </div>
                                <div id="checkpoints-list" class="d-flex flex-column gap-2"></div>
                                                        </div> --}}
                                                    </div>
                                                    <div class="modal-footer d-flex justify-content-between">
                                                        <button type="button" id="save-marker"
                                                            class="btn btn-light btn-sm">Save & Close</button>
                                                        <button type="button" class="btn btn-light btn-sm"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                           


                            <!-- Task Status Cards -->
                            <div id="taskStatusSlider" class="task-status-slider"
                                style="background:#fff; border-radius:10px; padding:1px;">
                                <div class="task-status-slider-container">

                                <!-- Card 1 -->
                                <div class="task-status-card" data-task-status="total"
                                    style="flex:0 0 130px; min-width:130px; text-align:center; border-radius:8px; padding:8px; margin:7px; transition:0.3s; cursor:pointer; background:#fff;"
                                    onmouseover="this.style.background='#f1f1f1'"
                                    onmouseout="this.style.background='#fff'">
                                    <img src="{{ asset('build/img/totaltask.svg') }}"
                                        style="width:26px; margin-bottom:6px;" alt="">
                                    <div style="font-size:13px; color:#4b5c74; font-weight:500;">Total Tasks</div>
                                    <div style="font-weight:700; font-size:14px; color:#1e293b;"><i class="fas fa-spinner fa-spin" style="font-size: 18px; color: #1e2b4d;"></i></div>
                                </div>

                                <!-- Divider -->
                                <div style="width:2px; height:42px; background:#e2e8f0; align-self:center;"></div>

                                <!-- Card 2 -->
                                <div class="task-status-card" data-task-status="new"
                                    onclick="centerTaskSliderCard('new')"
                                    style="flex:0 0 130px; min-width:130px; text-align:center; border-radius:8px; padding:8px; margin:7px; transition:0.3s; cursor:pointer; background:#fff;"
                                    onmouseover="this.style.background='#f1f1f1'"
                                    onmouseout="this.style.background='#fff'">
                                    <img src="{{ asset('build/img/newtask.svg') }}"
                                        style="width:26px; margin-bottom:6px;" alt="">
                                    <div style="font-size:13px; color:#4b5c74; font-weight:500;">New Task</div>
                                    <div style="font-weight:700; font-size:14px; color:#1e293b;"><i class="fas fa-spinner fa-spin" style="font-size: 18px; color: #1e2b4d;"></i></div>
                                </div>

                                <!-- Divider -->
                                <div style="width:2px; height:42px; background:#e2e8f0; align-self:center;"></div>

                                <!-- Card 3 -->
                                <div class="task-status-card" data-task-status="progress"
                                    onclick="centerTaskSliderCard('progress')"
                                    style="flex:0 0 130px; min-width:130px; text-align:center;  border-radius:8px; padding:8px; margin:7px; transition:0.3s; cursor:pointer; background:#fff;"
                                    onmouseover="this.style.background='#f1f1f1'"
                                    onmouseout="this.style.background='#fff'">
                                    <img src="{{ asset('build/img/progress.svg') }}"
                                        style="width:26px; margin-bottom:6px;" alt="">
                                    <div style="font-size:13px; color:#4b5c74; font-weight:500;">In Progress</div>
                                    <div style="font-weight:700; font-size:14px; color:#1e293b;"><i class="fas fa-spinner fa-spin" style="font-size: 18px; color: #1e2b4d;"></i></div>
                                </div>

                                <!-- Divider -->
                                <div style="width:2px; height:42px; background:#e2e8f0; align-self:center;"></div>

                                <!-- Card 4 -->
                                <div class="task-status-card" data-task-status="hold"
                                    onclick="centerTaskSliderCard('hold')"
                                    style="flex:0 0 130px; min-width:130px; text-align:center; border-radius:8px; padding:8px; margin:7px; transition:0.3s; cursor:pointer; background:#fff;"
                                    onmouseover="this.style.background='#f1f1f1'"
                                    onmouseout="this.style.background='#fff'">
                                    <img src="{{ asset('build/img/inhold.svg') }}" style="width:26px; margin-bottom:6px;"
                                        alt="">
                                    <div style="font-size:13px; color:#4b5c74; font-weight:500;">In Hold</div>
                                    <div style="font-weight:700; font-size:14px; color:#1e293b;"><i class="fas fa-spinner fa-spin" style="font-size: 18px; color: #1e2b4d;"></i></div>
                                </div>

                                <!-- Divider -->
                                <div style="width:2px; height:42px; background:#e2e8f0; align-self:center;"></div>

                                <!-- Card 5 -->
                                <div class="task-status-card" data-task-status="checked"
                                    onclick="centerTaskSliderCard('checked')"
                                    style="flex:0 0 130px; min-width:130px; text-align:center; border-radius:8px; padding:8px; margin:7px; transition:0.3s; cursor:pointer; background:#fff;"
                                    onmouseover="this.style.background='#f1f1f1'"
                                    onmouseout="this.style.background='#fff'">
                                    <img src="{{ asset('build/img/incheck.svg') }}"
                                        style="width:26px; margin-bottom:6px;" alt="">
                                    <div style="font-size:13px; color:#4b5c74; font-weight:500;">In Checked</div>
                                    <div style="font-weight:700; font-size:14px; color:#1e293b;"><i class="fas fa-spinner fa-spin" style="font-size: 18px; color: #1e2b4d;"></i></div>
                                </div>

                                <!-- Divider -->
                                <div style="width:2px; height:42px; background:#e2e8f0; align-self:center;"></div>

                                <!-- Card 6 -->
                                <div class="task-status-card" data-task-status="delayed"
                                    onclick="centerTaskSliderCard('delayed')"
                                    style="flex:0 0 130px; min-width:130px; text-align:center; border-radius:8px; padding:8px; margin:7px; transition:0.3s; cursor:pointer; background:#fff;"
                                    onmouseover="this.style.background='#f1f1f1'"
                                    onmouseout="this.style.background='#fff'">
                                    <img src="{{ asset('build/img/delayed.svg') }}"
                                        style="width:26px; margin-bottom:6px;" alt="">
                                    <div style="font-size:13px; color:#4b5c74; font-weight:500;">In Delayed</div>
                                    <div style="font-weight:700; font-size:14px; color:#1e293b;"><i class="fas fa-spinner fa-spin" style="font-size: 18px; color: #1e2b4d;"></i></div>
                                </div>

                                <!-- Divider -->
                                <div style="width:2px; height:42px; background:#e2e8f0; align-self:center;"></div>

                                <!-- Card 7 -->
                                <div class="task-status-card" data-task-status="rejected"
                                    onclick="centerTaskSliderCard('rejected')"
                                    style="flex:0 0 130px; min-width:130px; text-align:center; border-radius:8px; padding:8px; margin:7px; transition:0.3s; cursor:pointer; background:#fff;"
                                    onmouseover="this.style.background='#f1f1f1'"
                                    onmouseout="this.style.background='#fff'">
                                    <img src="{{ asset('build/img/rejected.svg') }}"
                                        style="width:26px; margin-bottom:6px;" alt="">
                                    <div style="font-size:13px; color:#4b5c74; font-weight:500;">In Rejected</div>
                                    <div style="font-weight:700; font-size:14px; color:#1e293b;"><i class="fas fa-spinner fa-spin" style="font-size: 18px; color: #1e2b4d;"></i></div>
                                </div>

                                <!-- Divider -->
                                <div style="width:2px; height:42px; background:#e2e8f0; align-self:center;"></div>

                                <!-- Card 8 (Last without divider) -->
                                <div class="task-status-card" data-task-status="done"
                                    onclick="centerTaskSliderCard('done')"
                                    style="flex:0 0 130px; min-width:130px; text-align:center; border-radius:8px; padding:8px; margin:7px; transition:0.3s; cursor:pointer; background:#fff;"
                                    onmouseover="this.style.background='#f1f1f1'"
                                    onmouseout="this.style.background='#fff'">
                                    <img src="{{ asset('build/img/indone.svg') }}" style="width:26px; margin-bottom:6px;"
                                        alt="">
                                    <div style="font-size:13px; color:#4b5c74; font-weight:500;">In Done</div>
                                    <div style="font-weight:700; font-size:14px; color:#1e293b;"><i class="fas fa-spinner fa-spin" style="font-size: 18px; color: #1e2b4d;"></i></div>
                                </div>

                                </div>

                                <!-- Task slider styles and behavior -->
                                <style>
                                    /* Status chips horizontal scroll */
                                    .task-status-slider-container{
                                        display: flex;
                                        gap: 12px;
                                        overflow-x: auto;
                                        overflow-y: hidden;
                                        scroll-behavior: smooth;
                                        scroll-snap-type: x proximity;
                                        -ms-overflow-style: none;
                                        scrollbar-width: none;
                                        padding: 4px 8px;
                                    }
                                    .task-status-slider-container::-webkit-scrollbar{ display:none; }
                                    .task-status-slider-container > .task-status-card{
                                        flex: 0 0 130px !important;
                                        min-width: 130px !important;
                                        scroll-snap-align: center;
                                    }

                                    .task-slider {
                                        position: relative;
                                        width: 100%;
                                        overflow: hidden;
                                        padding: 10px 0;
                                    }

                                    .task-slider-container {
                                        display: flex;
                                        gap: 20px;
                                        overflow-x: auto;
                                        overflow-y: visible;
                                        scroll-behavior: smooth;
                                        scroll-snap-type: x mandatory;
                                        padding: 10px 12px;
                                        scrollbar-width: none;
                                        -ms-overflow-style: none;
                                        will-change: scroll-position;
                                        overscroll-behavior-inline: contain;
                                    }

                                    .task-slider-container::-webkit-scrollbar {
                                        display: none;
                                    }

                                    .task-slider-container>* {
                                        flex: 0 0 auto;
                                        width: 320px;
                                        min-width: 320px;
                                        scroll-snap-align: center;
                                        transition: transform 0.3s ease, opacity 0.3s ease, filter 0.3s ease;
                                    }

                                    .task-slider-container>[class*="col-"] {
                                        max-width: 320px !important;
                                        width: 320px !important;
                                        flex: 0 0 320px !important;
                                    }

                                    .task-slider-container .card {
                                        opacity: .6;
                                        filter: blur(2px);
                                        transform: scale(.95);
                                        transition: all .35s ease;
                                    }

                                    .task-slider-container .card.is-active {
                                        opacity: 1 !important;
                                        filter: none !important;
                                        transform: scale(1.05) !important;
                                        box-shadow: 0 12px 30px rgba(0, 0, 0, .15) !important;
                                        z-index: 10 !important;
                                        position: relative;
                                    }

                                    .task-status-card.active {
                                        background-color: #e3f2fd !important;
                                        border: 2px solid #2196f3 !important;
                                    }
                                </style>
                                <script>
                                    function updateTaskStatusCardActive(activeStatus) {
                                        try {
                                            document.querySelectorAll('.task-status-card').forEach(function(card) {
                                                card.classList.remove('active');
                                            });
                                            var activeCard = document.querySelector('.task-status-card[data-task-status="' + activeStatus + '"]');
                                            if (activeCard) {
                                                activeCard.classList.add('active');
                                            }
                                        } catch (_) {}
                                    }

                                    function centerTaskSliderCard(status) {
                                        var slider = document.getElementById('taskSlider');
                                        if (!slider) return;
                                        var container = slider.querySelector('.task-slider-container');
                                        if (!container) return;
                                        var wrappers = Array.prototype.slice.call(container.children);
                                        var targetWrapper = wrappers.find(function(w) {
                                            return w.getAttribute('data-task-status') === status;
                                        });
                                        if (!targetWrapper) return;

                                        function getWrappers() {
                                            return Array.prototype.slice.call(container.children);
                                        }

                                        function getStepWidth() {
                                            var items = getWrappers();
                                            if (items.length >= 2) {
                                                var step = items[1].offsetLeft - items[0].offsetLeft;
                                                return step > 0 ? step : items[0].offsetWidth;
                                            }
                                            return targetWrapper.offsetWidth;
                                        }
                                        (function rotateUsingOrder(targetEl) {
                                            var items = getWrappers();
                                            var total = items.length;
                                            if (!total) return;
                                            var viewport = container.clientWidth;
                                            var cardWidth = targetEl.offsetWidth;
                                            var stepWidth = getStepWidth();
                                            var sideSlots = Math.max(0, Math.floor((viewport - cardWidth) / (2 * stepWidth)));
                                            var desiredIndex = Math.min(Math.max(sideSlots, 0), Math.max(total - 1, 0));
                                            var idx = items.indexOf(targetEl);
                                            items.forEach(function(el, i) {
                                                var order = (i - idx + desiredIndex + total) % total;
                                                el.style.order = String(order);
                                            });
                                        })(targetWrapper);
                                        wrappers.forEach(function(w) {
                                            var card = w.querySelector('.card');
                                            if (card) card.classList.remove('is-active');
                                        });
                                        var cardEl = targetWrapper.querySelector('.card');
                                        if (cardEl) cardEl.classList.add('is-active');
                                        (function centerHorizontally() {
                                            var containerRect = container.getBoundingClientRect();
                                            var targetRect = targetWrapper.getBoundingClientRect();
                                            var left = container.scrollLeft +
                                                (targetRect.left - containerRect.left) +
                                                (targetRect.width / 2) -
                                                (container.clientWidth / 2);
                                            var maxScroll = Math.max(0, container.scrollWidth - container.clientWidth);
                                            if (left < 0) left = 0;
                                            if (left > maxScroll) left = maxScroll;
                                            container.scrollTo({
                                                left: left,
                                                behavior: 'smooth'
                                            });
                                        })();
                                        updateTaskStatusCardActive(status);
                                    }
                                </script>
                            </div>


                        </div> </div>
                        <!-- cards -->

                        @php
                            // Merge tasks from multiple sources: Task, WebTask, EmployeeTask
                            $allTasks = collect($tasks ?? []);
                            $possibleWeb = [$webtasks ?? null, $webTasks ?? null, $web_tasks ?? null];
                            $possibleEmp = [$employeetasks ?? null, $employeeTasks ?? null, $employee_tasks ?? null, $employeetask ?? null];
                            foreach ($possibleWeb as $mix) { if ($mix) { $allTasks = $allTasks->concat(collect($mix)); break; } }
                            foreach ($possibleEmp as $mix) { if ($mix) { $allTasks = $allTasks->concat(collect($mix)); break; } }
                            // Helpers to safely read and normalize
                            $get = function($item, $key) {
                                if (is_array($item)) return $item[$key] ?? null;
                                if (is_object($item)) return $item->{$key} ?? null;
                                return null;
                            };
                            $norm = function($v) {
                                return is_string($v) ? strtolower(str_replace([' ', '-'], '_', $v)) : $v;
                            };
                        @endphp
                        @if(request()->has('debug'))
                            @php
                                $tasksCount      = isset($tasks) ? collect($tasks)->count() : 0;
                                $webMix          = $possibleWeb[0] ?? $possibleWeb[1] ?? $possibleWeb[2] ?? [];
                                $empMix          = $possibleEmp[0] ?? $possibleEmp[1] ?? $possibleEmp[2] ?? $possibleEmp[3] ?? [];
                                $webCount        = collect($webMix)->count();
                                $empCount        = collect($empMix)->count();
                                $allCount        = ($allTasks ?? collect())->count();
                                $statusHistogram = ($allTasks ?? collect())
                                    ->map(function($t) use ($get,$norm){ return $norm($get($t,'status')); })
                                    ->countBy()
                                    ->toArray();
                                $sampleNew = ($allTasks ?? collect())
                                    ->filter(function($t) use ($get,$norm){
                                        $s = $norm($get($t,'status'));
                                        return in_array($s, ['new','new_task','newtask'], true);
                                    })
                                    ->take(5)
                                    ->map(function($t) use ($get){
                                        return [
                                            'title'  => $get($t,'title'),
                                            'status' => $get($t,'status'),
                                            'model'  => is_object($t) ? class_basename($t) : 'array'
                                        ];
                                    })
                                    ->values()
                                    ->toArray();
                            @endphp
                            <div class="alert alert-info" style="margin: 6px 10px; border-radius: 8px;">
                                <div><strong>Debug:</strong> tasks={{ $tasksCount }}, webTasks={{ $webCount }}, employeeTasks={{ $empCount }}, merged={{ $allCount }}</div>
                                <div><strong>Status histogram</strong></div>
                                <pre style="white-space: pre-wrap; margin:6px 0;">{{ json_encode($statusHistogram, JSON_PRETTY_PRINT) }}</pre>
                                <div><strong>Sample New Tasks (max 5)</strong></div>
                                <pre style="white-space: pre-wrap; margin:6px 0;">{{ json_encode($sampleNew, JSON_PRETTY_PRINT) }}</pre>
                            </div>
                        @endif
                        <div id="taskSlider" class="task-slider">
                            <div class="task-slider-container">
                                <!-- in progress -->
                                <div class="col-12 col-sm-6 col-lg-3" data-task-status="progress">
                                    <div class="card p-1 mb-3 shadow-sm"
                                        style="background: #ffffff; border-radius: 12px; font-family: 'Segoe UI', sans-serif;">

                                        <!-- Header Row -->
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <div>
                                                <div style="color: #7ED957; font-weight: 600; font-size: 16px;">In Progress
                                                </div>
                                                @php
                                                    $progressTasks = ($allTasks ?? collect())->filter(function ($t) use ($get, $norm) {
                                                $status = $norm($get($t,'status'));
                                                return in_array($status, ['in_progress', 'progress', 'inprogress'], true);
                                            });
                                                @endphp
                                                <div style="font-size: 13px; color: #7ED957;">Total Tasks: {{ $progressTasks->count() }}</div>
                                            </div>
                                            <div>
                                                <select class="form-select form-select-sm"
                                                    style="width: 140px; font-size: 13px;">
                                                    <option selected>Select Projects</option>
                                                    <option selected>Yekbon</option>
                                                    <option selected>CMS</option>
                                                </select>
                                            </div>
                                        </div>

                                        @php
                                            $progressTasks = ($allTasks ?? collect())->filter(function ($t) use ($get, $norm) {
                                                $status = $norm($get($t,'status'));
                                                return in_array($status, ['in_progress', 'progress', 'inprogress'], true);
                                            });
                                        @endphp
                                        <script></script>
                                        @forelse ($progressTasks as $task)
                                            <div class="d-flex p-2 rounded mt-2" style="background-color: #ebebeb;cursor:pointer" data-bs-toggle="modal" data-bs-target="#progressmodel">
                                                <!-- Task Image -->
                                                <div class="me-2">
                                                    @php
                                                        $markImage = !empty($task->mark_image_path)
                                                            ? asset('storage/' . ltrim($task->mark_image_path, '/'))
                                                            : asset('build/img/dooted img.svg');
                                                    @endphp
                                                    <img src="{{ $markImage }}" alt="Task Image" style="width: 100px; height: 100px; border-radius: 8px; object-fit: contain; background: transparent; border: none; padding: 0; display:block;">
                                                </div>
                                                <!-- Task Content -->
                                                <div class="flex-grow-1">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div style="font-weight: 600; font-size: 14px; display: flex; align-items: center;">
                                                            @php
                                                                $projectLogo = optional($task->project)->logo_path;
                                                                $projectLogoUrl = $projectLogo ? asset('storage/' . ltrim($projectLogo, '/')) : asset('build/img/yekbon.svg');
                                                            @endphp
                                                            <img src="{{ $projectLogoUrl }}" alt="Project Logo" style="width: 30px; height: 30px; margin-right: 6px; object-fit: cover; border-radius: 4px;">
                                                            {{ $task->title ?? 'Task Title' }}
                                                        </div>
                                                        <div class="d-flex align-items-center gap-2">
                                                            <span style="width: 12px; height: 12px; background-color: #7ED957; border-radius: 50%; display: inline-block;"></span>
                                                            <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile" style="width: 24px; height: 24px; border-radius: 50%;">
                                                        </div>
                                                    </div>
                                                    <div style="font-size: 12px; color: #6c757d;">
                                                        Ticket {{ optional($task->ticket)->code ?? '—' }} - {{ $task->ticket_title ?? ($task->title ?? 'Ticket Title') }}
                                                    </div>
                                                    <div style="font-size: 13px; margin-top: 2px;">
                                                        {{ $task->description ?? 'Task description will be here' }}
                                                    </div>
                                                    <div class="d-flex justify-content-between mt-2 flex-nowrap" style="background-color: #fff; border-radius: 10px; padding: 4px;gap:3px;">
                                                        <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                            <small>Start: {{ optional($task->start_date)->format('d.m.Y') ?? (optional(\Carbon\Carbon::parse($task->start_date ?? null))->format('d.m.Y') ?: '--') }}</small>
                                                        </div>
                                                        <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                            <small>Deliver: {{ optional($task->end_date)->format('d.m.Y') ?? (optional(\Carbon\Carbon::parse($task->end_date ?? null))->format('d.m.Y') ?: '--') }}</small>
                                                        </div>
                                                        <div class="d-flex align-items-center" style="font-size: 11px; background-color: #ff4d4f; color: white; padding: 2px 6px; border-radius: 6px;">
                                                            <img src="https://img.icons8.com/ios-filled/16/ffffff/flash-on.png" alt="Urgent" style="margin-right: 4px;">
                                                            01
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="text-center text-muted p-3">No task exist</div>
                                        @endforelse
                                    </div>
                                </div>
                                <!-- In checking -->
                                <div class="col-12 col-sm-6 col-lg-3" data-task-status="checked">
                                    <div class="card p-1 mb-3 shadow-sm"
                                        style="background: #ffffff; border-radius: 12px; font-family: 'Segoe UI', sans-serif;">

                                        <!-- Header Row -->
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <div>
                                                <div style="color:purple; font-weight: 600; font-size: 16px;">In Checking
                                                </div>
                                                @php
                                                    $checkedTasks = ($allTasks ?? collect())->filter(function ($t) use ($get, $norm) {
                                                        $status = $norm($get($t,'status'));
                                                        return in_array($status, ['in_checked', 'checked', 'inchecked'], true);
                                                    });
                                                @endphp
                                                <div style="font-size: 13px; color: purple;">Total Tasks: {{ $checkedTasks->count() }}</div>
                                            </div>
                                            <div>
                                                <select class="form-select form-select-sm"
                                                    style="width: 140px; font-size: 13px;">
                                                    <option selected>Select Projects</option>
                                                    <option selected>Yekbon</option>
                                                    <option selected>CMS</option>
                                                </select>
                                            </div>
                                        </div>

                                        @forelse ($checkedTasks as $task)
                                            <div class="d-flex p-2 rounded mt-2" style="background-color: #ebebeb;cursor:pointer" data-bs-toggle="modal" data-bs-target="#incheck">
                                                <!-- Task Image -->
                                                <div class="me-2">
                                                    @php
                                                        $markImage = !empty($task->mark_image_path)
                                                            ? asset('storage/' . ltrim($task->mark_image_path, '/'))
                                                            : asset('build/img/dooted img.svg');
                                                    @endphp
                                                    <img src="{{ $markImage }}" alt="Task Image" style="width: 100px; height: 100px; border-radius: 8px; object-fit: contain; background: transparent; border: none; padding: 0; display:block;">
                                                </div>
                                                <!-- Task Content -->
                                                <div class="flex-grow-1">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div style="font-weight: 600; font-size: 14px; display: flex; align-items: center;">
                                                            @php
                                                                $projectLogo = optional($task->project)->logo_path;
                                                                $projectLogoUrl = $projectLogo ? asset('storage/' . ltrim($projectLogo, '/')) : asset('build/img/yekbon.svg');
                                                            @endphp
                                                            <img src="{{ $projectLogoUrl }}" alt="Project Logo" style="width: 30px; height: 30px; margin-right: 6px; object-fit: cover; border-radius: 4px;">
                                                            {{ $task->title ?? 'Task Title' }}
                                                        </div>
                                                        <div class="d-flex align-items-center gap-2">
                                                            <span style="width: 12px; height: 12px; background-color: #7ED957; border-radius: 50%; display: inline-block;"></span>
                                                            <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile" style="width: 24px; height: 24px; border-radius: 50%;">
                                                        </div>
                                                    </div>
                                                    <div style="font-size: 12px; color: #6c757d;">
                                                        Ticket {{ optional($task->ticket)->code ?? '—' }} - {{ $task->ticket_title ?? ($task->title ?? 'Ticket Title') }}
                                                    </div>
                                                    <div style="font-size: 13px; margin-top: 2px;">
                                                        {{ $task->description ?? 'Task description will be here' }}
                                                    </div>
                                                    <div class="d-flex justify-content-between mt-2 flex-nowrap" style="background-color: #fff; border-radius: 10px; padding: 4px;gap: 3px;">
                                                        <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                            <small>Start: {{ optional($task->start_date)->format('d.m.Y') ?? (optional(\Carbon\Carbon::parse($task->start_date ?? null))->format('d.m.Y') ?: '--') }}</small>
                                                        </div>
                                                        <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                            <small>Deliver: {{ optional($task->end_date)->format('d.m.Y') ?? (optional(\Carbon\Carbon::parse($task->end_date ?? null))->format('d.m.Y') ?: '--') }}</small>
                                                        </div>
                                                        <div class="d-flex align-items-center" style="font-size: 11px; background-color: #ff4d4f; color: white; padding: 2px 6px; border-radius: 6px;">
                                                            <img src="https://img.icons8.com/ios-filled/16/ffffff/flash-on.png" alt="Urgent" style="margin-right: 4px;">
                                                            01
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="text-center text-muted p-3">No task exist</div>
                                        @endforelse
                                    </div>
                                </div>
                                <!-- In Rejected -->
                                <div class="col-12 col-sm-6 col-lg-3" data-task-status="rejected">
                                    <div class="card p-1 mb-3 shadow-sm"
                                        style="background: #ffffff; border-radius: 12px; font-family: 'Segoe UI', sans-serif;">

                                        <!-- Header Row -->
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <div>
                                                <div style="color:red; font-weight: 600; font-size: 16px;">In Rejected
                                                </div>
                                                @php
                                                    $rejectedTasks = ($allTasks ?? collect())->filter(function ($t) use ($get, $norm) {
                                                        $status = $norm($get($t,'status'));
                                                        return in_array($status, ['in_rejected', 'rejected', 'inrejected'], true);
                                                    });
                                                @endphp
                                                <div style="font-size: 13px; color: red;">Total Tasks: {{ $rejectedTasks->count() }}</div>
                                            </div>
                                            <div>
                                                <select class="form-select form-select-sm"
                                                    style="width: 140px; font-size: 13px;">
                                                    <option selected>Select Projects</option>
                                                    <option selected>Yekbon</option>
                                                    <option selected>CMS</option>
                                                </select>
                                            </div>
                                        </div>

                                        @forelse ($rejectedTasks as $task)
                                            <div class="d-flex p-2 rounded mt-2" style="background-color: #ebebeb;cursor:pointer" data-bs-toggle="modal" data-bs-target="#inreject">
                                                <!-- Task Image -->
                                                <div class="me-2">
                                                    @php
                                                        $markImage = !empty($task->mark_image_path)
                                                            ? asset('storage/' . ltrim($task->mark_image_path, '/'))
                                                            : asset('build/img/dooted img.svg');
                                                    @endphp
                                                    <img src="{{ $markImage }}" alt="Task Image" style="width: 100px; height: 100px; border-radius: 8px; object-fit: contain; background: transparent; border: none; padding: 0; display:block;">
                                                </div>
                                                <!-- Task Content -->
                                                <div class="flex-grow-1">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div style="font-weight: 600; font-size: 14px; display: flex; align-items: center;">
                                                            @php
                                                                $projectLogo = optional($task->project)->logo_path;
                                                                $projectLogoUrl = $projectLogo ? asset('storage/' . ltrim($projectLogo, '/')) : asset('build/img/yekbon.svg');
                                                            @endphp
                                                            <img src="{{ $projectLogoUrl }}" alt="Project Logo" style="width: 30px; height: 30px; margin-right: 6px; object-fit: cover; border-radius: 4px;">
                                                            {{ $task->title ?? 'Task Title' }}
                                                        </div>
                                                        <div class="d-flex align-items-center gap-2">
                                                            <span style="width: 12px; height: 12px; background-color: #7ED957; border-radius: 50%; display: inline-block;"></span>
                                                            <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile" style="width: 24px; height: 24px; border-radius: 50%;">
                                                        </div>
                                                    </div>
                                                    <div style="font-size: 12px; color: #6c757d;">
                                                        Ticket {{ optional($task->ticket)->code ?? '—' }} - {{ $task->ticket_title ?? ($task->title ?? 'Ticket Title') }}
                                                    </div>
                                                    <div style="font-size: 13px; margin-top: 2px;">
                                                        {{ $task->description ?? 'Task description will be here' }}
                                                    </div>
                                                    <div class="d-flex justify-content-between mt-2 flex-nowrap" style="background-color: #fff; border-radius: 10px; padding: 4px;gap:3px;">
                                                        <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                            <small>Start: {{ optional($task->start_date)->format('d.m.Y') ?? (optional(\Carbon\Carbon::parse($task->start_date ?? null))->format('d.m.Y') ?: '--') }}</small>
                                                        </div>
                                                        <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                            <small>Deliver: {{ optional($task->end_date)->format('d.m.Y') ?? (optional(\Carbon\Carbon::parse($task->end_date ?? null))->format('d.m.Y') ?: '--') }}</small>
                                                        </div>
                                                        <div class="d-flex align-items-center" style="font-size: 11px; background-color: #ff4d4f; color: white; padding: 2px 6px; border-radius: 6px;">
                                                            <img src="https://img.icons8.com/ios-filled/16/ffffff/flash-on.png" alt="Urgent" style="margin-right: 4px;">
                                                            01
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="text-center text-muted p-3">No task exist</div>
                                        @endforelse
                                    </div>
                                </div>
                                <!-- In Hold -->
                                <div class="col-12 col-sm-6 col-lg-3" data-task-status="hold">
                                    <div class="card p-1 mb-3 shadow-sm"
                                        style="background: #ffffff; border-radius: 12px; font-family: 'Segoe UI', sans-serif;">

                                        <!-- Header Row -->
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <div>
                                                <div style="color:yellow; font-weight: 600; font-size: 16px;">In Hold</div>
                                                @php
                                                    $holdTasks = ($allTasks ?? collect())->filter(function ($t) use ($get, $norm) {
                                                        $status = $norm($get($t,'status'));
                                                        return in_array($status, ['in_hold', 'hold', 'inhold'], true);
                                                    });
                                                @endphp
                                                <div style="font-size: 13px; color: yellow;">Total Tasks: {{ $holdTasks->count() }}</div>
                                            </div>
                                            <div>
                                                <select class="form-select form-select-sm"
                                                    style="width: 140px; font-size: 13px;">
                                                    <option selected>Select Projects</option>
                                                    <option selected>Yekbon</option>
                                                    <option selected>CMS</option>
                                                </select>
                                            </div>
                                        </div>

                                        @forelse ($holdTasks as $task)
                                            <div class="d-flex p-2 rounded mt-2" style="background-color: #ebebeb;cursor:pointer" data-bs-toggle="modal" data-bs-target="#inhold">
                                                <!-- Task Image -->
                                                <div class="me-2">
                                                    @php
                                                        $markImage = !empty($task->mark_image_path)
                                                            ? asset('storage/' . ltrim($task->mark_image_path, '/'))
                                                            : asset('build/img/dooted img.svg');
                                                    @endphp
                                                    <img src="{{ $markImage }}" alt="Task Image" style="width: 100px; height: 100px; border-radius: 8px; object-fit: contain; background: transparent; border: none; padding: 0; display:block;">
                                                </div>
                                                <!-- Task Content -->
                                                <div class="flex-grow-1">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div style="font-weight: 600; font-size: 14px; display: flex; align-items: center;">
                                                            @php
                                                                $projectLogo = optional($task->project)->logo_path;
                                                                $projectLogoUrl = $projectLogo ? asset('storage/' . ltrim($projectLogo, '/')) : asset('build/img/yekbon.svg');
                                                            @endphp
                                                            <img src="{{ $projectLogoUrl }}" alt="Project Logo" style="width: 30px; height: 30px; margin-right: 6px; object-fit: cover; border-radius: 4px;">
                                                            {{ $task->title ?? 'Task Title' }}
                                                        </div>
                                                        <div class="d-flex align-items-center gap-2">
                                                            <span style="width: 12px; height: 12px; background-color: #7ED957; border-radius: 50%; display: inline-block;"></span>
                                                            <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile" style="width: 24px; height: 24px; border-radius: 50%;">
                                                        </div>
                                                    </div>
                                                    <div style="font-size: 12px; color: #6c757d;">
                                                        Ticket {{ optional($task->ticket)->code ?? '—' }} - {{ $task->ticket_title ?? ($task->title ?? 'Ticket Title') }}
                                                    </div>
                                                    <div style="font-size: 13px; margin-top: 2px;">
                                                        {{ $task->description ?? 'Task description will be here' }}
                                                    </div>
                                                    <div class="d-flex justify-content-between mt-2 flex-nowrap" style="background-color: #fff; border-radius: 10px; padding: 4px;gap:3px;">
                                                        <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                            <small>Start: {{ optional($task->start_date)->format('d.m.Y') ?? (optional(\Carbon\Carbon::parse($task->start_date ?? null))->format('d.m.Y') ?: '--') }}</small>
                                                        </div>
                                                        <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                            <small>Deliver: {{ optional($task->end_date)->format('d.m.Y') ?? (optional(\Carbon\Carbon::parse($task->end_date ?? null))->format('d.m.Y') ?: '--') }}</small>
                                                        </div>
                                                        <div class="d-flex align-items-center" style="font-size: 11px; background-color: #ff4d4f; color: white; padding: 2px 6px; border-radius: 6px;">
                                                            <img src="https://img.icons8.com/ios-filled/16/ffffff/flash-on.png" alt="Urgent" style="margin-right: 4px;">
                                                            01
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="text-center text-muted p-3">No task exist</div>
                                        @endforelse
                                    </div>
                                </div>
                                <!-- In delayed -->
                                <div class="col-12 col-sm-6 col-lg-3" data-task-status="delayed">
                                    <div class="card p-1 mb-3 shadow-sm"
                                        style="background: #ffffff; border-radius: 12px; font-family: 'Segoe UI', sans-serif;">

                                        <!-- Header Row -->
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <div>
                                                <div style="color:#f28b82; font-weight: 600; font-size: 16px;">In Delayed
                                                </div>
                                                @php
                                                    $delayedTasks = ($allTasks ?? collect())->filter(function ($t) use ($get, $norm) {
                                                        $status = $norm($get($t,'status'));
                                                        return in_array($status, ['in_delayed', 'delayed', 'indelayed'], true);
                                                    });
                                                @endphp
                                                <div style="font-size: 13px; color:#f28b82;">Total Tasks: {{ $delayedTasks->count() }}</div>
                                            </div>
                                            <div>
                                                <select class="form-select form-select-sm"
                                                    style="width: 140px; font-size: 13px;">
                                                    <option selected>Select Projects</option>
                                                    <option selected>Yekbon</option>
                                                    <option selected>CMS</option>
                                                </select>
                                            </div>
                                        </div>

                                        @forelse ($delayedTasks as $task)
                                            <div class="d-flex p-2 rounded mt-2" style="background-color: #ebebeb;cursor:pointer" data-bs-toggle="modal" data-bs-target="#indelayed">
                                                <!-- Task Image -->
                                                <div class="me-2">
                                                    @php
                                                        $markImage = !empty($task->mark_image_path)
                                                            ? asset('storage/' . ltrim($task->mark_image_path, '/'))
                                                            : asset('build/img/dooted img.svg');
                                                    @endphp
                                                    <img src="{{ $markImage }}" alt="Task Image" style="width: 100px; height: 100px; border-radius: 8px; object-fit: contain; background: transparent; border: none; padding: 0; display:block;">
                                                </div>
                                                <!-- Task Content -->
                                                <div class="flex-grow-1">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div style="font-weight: 600; font-size: 14px; display: flex; align-items: center;">
                                                            @php
                                                                $projectLogo = optional($task->project)->logo_path;
                                                                $projectLogoUrl = $projectLogo ? asset('storage/' . ltrim($projectLogo, '/')) : asset('build/img/yekbon.svg');
                                                            @endphp
                                                            <img src="{{ $projectLogoUrl }}" alt="Project Logo" style="width: 30px; height: 30px; margin-right: 6px; object-fit: cover; border-radius: 4px;">
                                                            {{ $task->title ?? 'Task Title' }}
                                                        </div>
                                                        <div class="d-flex align-items-center gap-2">
                                                            <span style="width: 12px; height: 12px; background-color: #7ED957; border-radius: 50%; display: inline-block;"></span>
                                                            <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile" style="width: 24px; height: 24px; border-radius: 50%;">
                                                        </div>
                                                    </div>
                                                    <div style="font-size: 12px; color: #6c757d;">
                                                        Ticket {{ optional($task->ticket)->code ?? '—' }} - {{ $task->ticket_title ?? ($task->title ?? 'Ticket Title') }}
                                                    </div>
                                                    <div style="font-size: 13px; margin-top: 2px;">
                                                        {{ $task->description ?? 'Task description will be here' }}
                                                    </div>
                                                    <div class="d-flex justify-content-between mt-2 flex-nowrap" style="background-color: #fff; border-radius: 10px; padding: 4px;gap:3px;">
                                                        <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                            <small>Start: {{ optional($task->start_date)->format('d.m.Y') ?? (optional(\Carbon\Carbon::parse($task->start_date ?? null))->format('d.m.Y') ?: '--') }}</small>
                                                        </div>
                                                        <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                            <small>Deliver: {{ optional($task->end_date)->format('d.m.Y') ?? (optional(\Carbon\Carbon::parse($task->end_date ?? null))->format('d.m.Y') ?: '--') }}</small>
                                                        </div>
                                                        <div class="d-flex align-items-center" style="font-size: 11px; background-color: #ff4d4f; color: white; padding: 2px 6px; border-radius: 6px;">
                                                            <img src="https://img.icons8.com/ios-filled/16/ffffff/flash-on.png" alt="Urgent" style="margin-right: 4px;">
                                                            01
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="text-center text-muted p-3">No task exist</div>
                                        @endforelse
                                    </div>
                                </div>
                                <!-- In Done -->
                                <div class="col-12 col-sm-6 col-lg-3" data-task-status="done">
                                    <div class="card p-1 mb-3 shadow-sm"
                                        style="background: #ffffff; border-radius: 12px; font-family: 'Segoe UI', sans-serif;">

                                        <!-- Header Row -->
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <div>
                                                <div style="color:#1ec963; font-weight: 600; font-size: 16px;">In Done
                                                </div>
                                                @php
                                                    $doneTasks = ($allTasks ?? collect())->filter(function ($t) use ($get, $norm) {
                                                        $status = $norm($get($t,'status'));
                                                        return in_array($status, ['in_done', 'done', 'indone'], true);
                                                    });
                                                @endphp
                                                <div style="font-size: 13px; color:#1ec963;">Total Tasks: {{ $doneTasks->count() }}</div>
                                            </div>
                                            <div>
                                                <select class="form-select form-select-sm"
                                                    style="width: 140px; font-size: 13px;">
                                                    <option selected>Select Projects</option>
                                                    <option selected>Yekbon</option>
                                                    <option selected>CMS</option>
                                                </select>
                                            </div>
                                        </div>

                                        @forelse ($doneTasks as $task)
                                            <div class="d-flex p-2 rounded mt-2" style="background-color: #ebebeb;cursor:pointer" data-bs-toggle="modal" data-bs-target="#indone">
                                                <!-- Task Image -->
                                                <div class="me-2">
                                                    @php
                                                        $markImage = !empty($task->mark_image_path)
                                                            ? asset('storage/' . ltrim($task->mark_image_path, '/'))
                                                            : asset('build/img/dooted img.svg');
                                                    @endphp
                                                    <img src="{{ $markImage }}" alt="Task Image" style="width: 100px; height: 100px; border-radius: 8px; object-fit: contain; background: transparent; border: none; padding: 0; display:block;">
                                                </div>
                                                <!-- Task Content -->
                                                <div class="flex-grow-1">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div style="font-weight: 600; font-size: 14px; display: flex; align-items: center;">
                                                            @php
                                                                $projectLogo = optional($task->project)->logo_path;
                                                                $projectLogoUrl = $projectLogo ? asset('storage/' . ltrim($projectLogo, '/')) : asset('build/img/yekbon.svg');
                                                            @endphp
                                                            <img src="{{ $projectLogoUrl }}" alt="Project Logo" style="width: 30px; height: 30px; margin-right: 6px; object-fit: cover; border-radius: 4px;">
                                                            {{ $task->title ?? 'Task Title' }}
                                                        </div>
                                                        <div class="d-flex align-items-center gap-2">
                                                            <span style="width: 12px; height: 12px; background-color: #7ED957; border-radius: 50%; display: inline-block;"></span>
                                                            <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile" style="width: 24px; height: 24px; border-radius: 50%;">
                                                        </div>
                                                    </div>
                                                    <div style="font-size: 12px; color: #6c757d;">
                                                        Ticket {{ optional($task->ticket)->code ?? '—' }} - {{ $task->ticket_title ?? ($task->title ?? 'Ticket Title') }}
                                                    </div>
                                                    <div style="font-size: 13px; margin-top: 2px;">
                                                        {{ $task->description ?? 'Task description will be here' }}
                                                    </div>
                                                    <div class="d-flex justify-content-between mt-2 flex-nowrap" style="background-color: #fff; border-radius: 10px; padding: 4px;gap:3px;">
                                                        <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                            <small>Start: {{ optional($task->start_date)->format('d.m.Y') ?? (optional(\Carbon\Carbon::parse($task->start_date ?? null))->format('d.m.Y') ?: '--') }}</small>
                                                        </div>
                                                        <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                            <small>Deliver: {{ optional($task->end_date)->format('d.m.Y') ?? (optional(\Carbon\Carbon::parse($task->end_date ?? null))->format('d.m.Y') ?: '--') }}</small>
                                                        </div>
                                                        <div class="d-flex align-items-center" style="font-size: 11px; background-color: #ff4d4f; color: white; padding: 2px 6px; border-radius: 6px;">
                                                            <img src="https://img.icons8.com/ios-filled/16/ffffff/flash-on.png" alt="Urgent" style="margin-right: 4px;">
                                                            01
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="text-center text-muted p-3">No task exist</div>
                                        @endforelse
                                    </div>
                                </div>
                                <!-- Total Tasks -->
                        <div class="col-12 col-sm-6 col-lg-3" data-task-status="new">
                                    <div class="card p-1 mb-3 shadow-sm"
                                        style="background: #ffffff; border-radius: 12px; font-family: 'Segoe UI', sans-serif;">

                                        <!-- Header Row -->
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <div>
                                                <div style="color:#869da2; font-weight: 600; font-size: 16px;">New Task
                                                </div>
                                        @php
                                            $newTasks = ($allTasks ?? collect())->filter(function ($t) use ($get, $norm) {
                                                $status = $norm($get($t,'status'));
                                                return in_array($status, ['new', 'new_task', 'newtask'], true);
                                            });
                                        @endphp
                                        <div style="font-size: 13px; color: #869da2;">Total Tasks: {{ $newTasks->count() }}</div>
                                            </div>
                                            <div>
                                                <select class="form-select form-select-sm"
                                                    style="width: 140px; font-size: 13px;">
                                                    <option selected>Select Projects</option>
                                                    <option selected>Yekbon</option>
                                                    <option selected>CMS</option>
                                                </select>
                                            </div>
                                        </div>

                                @forelse ($newTasks as $task)
                                    <div class="d-flex p-2 rounded mt-2" style="background-color: #ebebeb;cursor:pointer" data-bs-toggle="modal" data-bs-target="#totaltask">
                                        <!-- Task Image -->
                                        <div class="me-2">
                                            @php
                                                $markImage = !empty($task->mark_image_path)
                                                    ? asset('storage/' . ltrim($task->mark_image_path, '/'))
                                                    : asset('build/img/dooted img.svg');
                                            @endphp
                                            <img src="{{ $markImage }}" alt="Task Image" style="width: 100px; height: 100px; border-radius: 8px; object-fit: contain; background: transparent; border: none; padding: 0; display:block;">
                                        </div>
                                        <!-- Task Content -->
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div style="font-weight: 600; font-size: 14px; display: flex; align-items: center;">
                                                    @php
                                                        $projectLogo = optional($task->project)->logo_path;
                                                        $projectLogoUrl = $projectLogo ? asset('storage/' . ltrim($projectLogo, '/')) : asset('build/img/yekbon.svg');
                                                    @endphp
                                                    <img src="{{ $projectLogoUrl }}" alt="Project Logo" style="width: 30px; height: 30px; margin-right: 6px; object-fit: cover; border-radius: 4px;">
                                                    {{ $task->title ?? 'Task Title' }}
                                                </div>
                                                <div class="d-flex align-items-center gap-2">
                                                    <span style="width: 12px; height: 12px; background-color: #7ED957; border-radius: 50%; display: inline-block;"></span>
                                                    <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile" style="width: 24px; height: 24px; border-radius: 50%;">
                                                </div>
                                            </div>
                                            <div style="font-size: 12px; color: #6c757d;">
                                                 {{ optional($task->ticket)->code ?? '—' }} - {{ $task->ticket_title ?? ($task->title ?? 'Ticket Title') }}
                                            </div>
                                            <div style="font-size: 13px; margin-top: 2px;">
                                                {{ $task->description ?? 'Task description will be here' }}
                                            </div>
                                            <div class="d-flex justify-content-between mt-2 flex-nowrap" style="background-color: #fff; border-radius: 10px; padding: 4px;gap:3px;">
                                                <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                    <small>Start: {{ optional($task->start_date)->format('d.m.Y') ?? (optional(\Carbon\Carbon::parse($task->start_date ?? null))->format('d.m.Y') ?: '--') }}</small>
                                                </div>
                                                <div style="font-size: 10px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                    <small>Deliver: {{ optional($task->end_date)->format('d.m.Y') ?? (optional(\Carbon\Carbon::parse($task->end_date ?? null))->format('d.m.Y') ?: '--') }}</small>
                                                </div>
                                                <div class="d-flex align-items-center" style="font-size: 11px; background-color: #ff4d4f; color: white; padding: 2px 6px; border-radius: 6px;">
                                                    <img src="https://img.icons8.com/ios-filled/16/ffffff/flash-on.png" alt="Urgent" style="margin-right: 4px;">
                                                    01
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center text-muted p-3">No task exist</div>
                                @endforelse
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!--  current task -->
                        <div
                            class="project-succes pt-4 pb-4 d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">

                            <!-- Left Title -->
                            <div>
                                <h3 style="margin: 0;">Current Tasks</h3>
                                <strong>Task Overview </strong>
                            </div>

                           
                        </div>
                        <div class="mb-2">
                            <div style="display:flex; flex-wrap:nowrap; gap:10px; overflow-x:auto;">

    @foreach ( $projectsdone as $project)
    <div style="flex: 0 0 calc(33.333% - 8px); min-width: 300px; max-width: 400px;padding-left: 12px;" class="current-task-card">
        <div class="card shadow-sm p-1" style="border-radius: 20px; font-family: 'Segoe UI', sans-serif; margin-bottom: 97px;padding-left:10px">
            <!-- Top Section -->
            <div class="d-flex justify-content-between  mb-2" style="gap: 10px;">

                <!-- Progress Circle -->
                <div style="width: 36px; height: 36px; position: relative;">
                    <svg width="36" height="36">
                        <defs>
                            <linearGradient id="grad" x1="0%" y1="0%" x2="100%" y2="0%">
                                <stop offset="0%" stop-color="#ff7f00" />
                                <stop offset="100%" stop-color="#fcd34d" />
                            </linearGradient>
                        </defs>
                        <circle cx="18" cy="18" r="15.12" stroke="#d1d1d1" stroke-width="4.32" fill="none" />
                        <circle
                            cx="18"
                            cy="18"
                            r="15.12"
                            stroke="url(#grad)"
                            stroke-width="4.32"
                            fill="none"
                            stroke-dasharray="95.04"
                            stroke-dashoffset="28.51" <!-- 70% progress -->
                            stroke-linecap="round"
                            transform="rotate(-90 18 18)" />
                    </svg>
                    <span style="position:absolute; top:50%; left:50%; transform:translate(-50%,-50%); font-size:9.5px; font-weight:600;">70%</span>
                </div>


                <!-- Middle Card -->
                <div style="background-color: #f9f9f9; display: flex; justify-content: space-between; align-items: flex-start; width: 220px; border-radius: 10px; padding: 6px 8px; position: relative;">

                    <!-- Static Flag -->
                    <div style="background-color:#D1FAE5; border-radius: 4px; padding: 4px; display: flex; align-items: center; justify-content: center;">
                        <img src="{{ URL::asset('/build/img/greenflag.svg') }}" alt="Flag" width="18px" height="18px">
                    </div>

                    <!-- Logo (center) -->
                    <div class="text-center" style="flex-grow: 1;">
                        <div style=" display: flex; justify-content: center; height: 55px; width: 55px; margin: 0 auto;">
                            <img src="{{ URL::asset('/build/img/yekbon.svg') }}" alt="Project Logo" style="height: 45px; width: 45px; object-fit: cover;" class="rounded-cirle">
                        </div>
                        <div>
                            <h5 class="text-center" title="Project Title" style="font-size: 12px !important; margin: 0 auto; font-weight: bold; color: #2e2e5d; max-width: 100%; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; display: block;">
                               {{$project->title}}
                            </h5>
                        </div>
                    </div>

                    <!-- Priority -->
                    <div style="background: #ffffff; padding: 3px 4px; border-radius: 2px; display: flex; align-items: center; gap: 8px; margin-top: 2px;">
                        <span style="width: 8px; height: 8px; background-color: #4caf50; border-radius: 50%;"></span>
                        <span style="color: #4caf50; font-size: 12px; font-weight: 500;">{{ $project->priority }}</span>
                    </div>

                </div>


                <!-- Ticket Icon -->
                <img src="{{ URL::asset('/build/img/ticket_icon_black.svg') }}"
                    style="height: 40px; width: 38px; cursor: pointer;background:#F5F5F5;padding:5px;border-radius:5px;"
                    alt="ticket">
            </div>
                                        <!-- Project Stats -->
            <div class="d-flex justify-content-between flex-wrap align-items-center px-2 mt-1"
                style="font-size: 13px; background-color: #f9f9f9; border-radius: 10px; gap: 3px; padding: 8px 10px;margin:7px;">
                                            @php
                                                $___pid = isset($__project) ? (string) ($__project->_id ?? $__project->id) : (isset($project) ? (string) ($project->_id ?? $project->id) : null);
                                                $___tickets = $___pid ? \App\Models\Ticket::where('project_id', $___pid)->count() : 0;
                                                $___tasks = $___pid ? \App\Models\Task::where('project_id', $___pid)->count() : 0;
                                            @endphp
                <div style="color: #10b981;text-align:center"><strong>Tickets:</strong>
                                                <p style="color: black;text-align:center">{{ $___tickets }}</p>
                </div>
                <div style="height: 16px; width: 1px; background-color: #cbd5e1;"></div>
                <div style="color: #10b981;text-align:center"><strong>Tasks:</strong>
                                                <p style="color: black;text-align:center">{{ $___tasks }}</p>
                </div>
                <div style="height: 16px; width: 1px; background-color: #cbd5e1;"></div>
                <div style="color: #10b981;text-align:center"><strong>Begining:</strong>
                    <p style="color: black;">{{ $project->start_date->format('d.m.Y') }}</p>
                </div>
                <div style="height: 16px; width: 1px; background-color: #cbd5e1;"></div>
                <div style="color: #10b981;text-align:center"><strong>End:</strong>
                    <p style="color: black;">{{ $project->end_date->format('d.m.Y') }}</p>
                </div>
            </div>

           
            <div class="d-flex justify-content-between align-items-center toggle-btn"
                style="cursor: pointer;">



                <div style="display: flex; align-items: center; width: 100%; margin: 8px 0;">
                    <img src="{{ asset('build/img/up_arrow.svg') }}"
                        alt="toggle-icon" width="20" height="20"
                        style="margin-right: 6px; transition: transform 0.3s; transform: rotate(180deg);"
                        class="toggle-icon">
                    <hr style="flex: 1; height: 2.5px; border: none; 
                     background: linear-gradient(to right, #b0b7c3, #b0b7c3); 
                       margin: 0;">
                </div>

            </div>

            <!-- Expandable Project Details -->
            <div class="project-details" style="overflow:hidden; max-height:1200px; transition:max-height 0.3s ease;">

        <!-- Tickets header + tabs (optimized) -->
        <style>
            .tickets-block { background:#f3f6fa; border-radius:12px; padding:8px 10px; margin:6px; }
            .tickets-title { font-weight:800; color:#182a4a; font-size:14px; margin-bottom:6px; }
            .tickets-tab-scroll { display:flex; gap:10px; overflow-x:auto; white-space:nowrap; padding-bottom:6px; -ms-overflow-style:none; scrollbar-width:none; }
            .tickets-tab-scroll::-webkit-scrollbar { display:none; }
            .ticket-tab { background:#ffffff; color:#1f2d4a; border:1px solid #e5e7eb; border-radius:10px; padding:8px 12px; min-width:180px; text-align:left; }
            .ticket-tab .title { font-weight:700; font-size:13px; }
            .ticket-tab .subtitle { opacity:.6; font-size:12px; }
            .ticket-tab.active { background:#22c55e; color:#ffffff; border:none; }
            .ticket-tab.active .subtitle { opacity:.95; }
            .ticket-indicators { display:flex; justify-content:center; gap:12px; padding:0 6px 4px; }
            .ticket-indicators .bar { width:38px; height:4px; border-radius:4px; background:#e5e7eb; }
            .ticket-indicators .bar.active { background:#22c55e; }
        </style>
        <div class="tickets-block">
            <div class="tickets-title">Tickets: {{ $___tickets }}</div>
            @php
                $__pidTabs = isset($__project) ? (string) ($__project->_id ?? $__project->id) : (isset($project) ? (string) ($project->_id ?? $project->id) : null);
                $__ticketList = collect();
                if ($__pidTabs) {
                    $__ticketList = \App\Models\Ticket::where('project_id', $__pidTabs)
                        ->orderByDesc('created_at')
                        ->limit(10)
                        ->get();
                }
            @endphp
            <div class="tickets-tab-scroll">
                @forelse($__ticketList as $__idx => $__tk)
                    @php $__tid = (string) ($__tk->_id ?? $__tk->id); @endphp
                    <button
                        type="button"
                        class="ticket-tab {{ $__idx === 0 ? 'active' : '' }}"
                        data-ticket-id="{{ $__tid }}"
                        data-code="{{ $__tk->code ?? '' }}"
                        data-title="{{ $__tk->title ?? '' }}"
                        data-section="{{ $__tk->section_name ?? '' }}"
                        data-start="{{ optional($__tk->start_date)->toDateString() }}"
                        data-end="{{ optional($__tk->end_date)->toDateString() }}"
                    >
                        <div class="title">{{ $__tk->code ?? '' }}</div>
                        <div class="subtitle">{{ $__tk->title ?? '' }}</div>
                    </button>
                @empty
                    <button type="button" class="ticket-tab active">
                        <div class="title">No tickets</div>
                        <div class="subtitle">Create ticket to see here</div>
                    </button>
                @endforelse
            </div>
            <div class="ticket-indicators"></div>
            <div class="dynamic-ticket-details" style="margin-top:8px;"></div>
        </div>
        <script>
            (function () {
                var blocks = document.currentScript.previousElementSibling;
                // If script insertion context changes, fall back to query
                if (!blocks || !blocks.classList || !blocks.classList.contains('tickets-block')) {
                    blocks = document.querySelectorAll('.tickets-block');
                } else {
                    blocks = [blocks];
                }
                (blocks instanceof NodeList ? blocks : Array.from(blocks)).forEach(function (block) {
                    var tabs = block.querySelectorAll('.ticket-tab');
                    var indicators = block.querySelector('.ticket-indicators');
                    var detailsPane = block.querySelector('.dynamic-ticket-details');
                    var cardRoot = block.closest('.card');
                    var summary = cardRoot ? cardRoot.querySelector('.ticket-summary') : null;
                    var taskContainer = cardRoot ? cardRoot.querySelector('.task-cards-container') : null;

                    function renderDetailsFromTab(tab) {
                        if (!detailsPane || !tab) return;
                        var code = tab.getAttribute('data-code') || '';
                        var title = tab.getAttribute('data-title') || '';
                        var section = tab.getAttribute('data-section') || '-';
                        var start = tab.getAttribute('data-start') || '-';
                        var end = tab.getAttribute('data-end') || '-';
                        var ticketId = tab.getAttribute('data-ticket-id') || '';
                        // Also update the visible ticket-summary block, so tasks area persists
                        if (summary) {
                            var c = summary.querySelector('.js-ticket-code'); if (c) c.textContent = code;
                            var s = summary.querySelector('.js-ticket-section'); if (s) s.textContent = section;
                            var t = summary.querySelector('.js-ticket-title'); if (t) t.textContent = title;
                            var sd = summary.querySelector('.js-ticket-start'); if (sd) sd.textContent = start;
                            var ed = summary.querySelector('.js-ticket-end'); if (ed) ed.textContent = end;
                        }
                        detailsPane.innerHTML =
                            '<div class="d-flex justify-content-between flex-wrap" style="background:#fff;border-radius:10px;padding:6px;">'
                            + '<div style="color:#1a73e8;margin-left:8px;"><strong>Tickets</strong><br>' + code + '</div>'
                            + '<div style="color:#1a73e8;"><strong>Section</strong><br>' + section + '</div>'
                            + '<div style="color:#1a73e8;"><strong>Ticket Title</strong><br>' + title + '</div>'
                            + '</div>'
                            + '<div style="margin-top:0.6rem;display:flex;align-items:center;text-align:center;flex-wrap:nowrap;justify-content:space-between;background:#fff;border-radius:10px;padding:6px;font-size:14px;color:#333;">'
                            +   '<span style="margin-right:5px;font-weight:bold;"> Tasks <p id="__tasksCount" style="margin:0;color:#111">...</p></span>'
                            +   '<span style="margin-right:5px;color:#ccc;">|</span>'
                            +   '<span style="margin-right:5px;color:#28a745;">Start:<p style="color:black;margin:0;">' + start + '</p></span>'
                            +   '<span style="margin-right:5px;color:#ccc;">|</span>'
                            +   '<span style="margin-right:5px;color:#28a745;">Deliver:<p style="color:black;margin:0;">' + end + '</p></span>'
                            + '</div>';
                        if (ticketId) {
                            fetch('{{ url('/team/tasks') }}?ticket_id=' + encodeURIComponent(ticketId), { credentials: 'same-origin' })
                                .then(function(res){ return res.ok ? res.json() : []; })
                                .then(function(data){
                                    var cnt = Array.isArray(data) ? data.length : (Array.isArray(data.tasks) ? data.tasks.length : 0);
                                    var el = detailsPane.querySelector('#__tasksCount');
                                    if (el) el.textContent = String(cnt);
                                    if (summary) {
                                        var sc = summary.querySelector('.js-ticket-tasks-count');
                                        if (sc) sc.textContent = String(cnt);
                                    }

                                    // Render tasks list below (mute/hide if zero)
                                    if (taskContainer) {
                                        var tasks = Array.isArray(data) ? data : (Array.isArray(data.tasks) ? data.tasks : []);
                                        if (!tasks || tasks.length === 0) {
                                            taskContainer.style.display = 'none';
                                            taskContainer.innerHTML = '';
                                        } else {
                                            taskContainer.style.display = 'flex';
                                            var defaultLogo = "{{ URL::asset('/build/img/yekbon.svg') }}";
                                            var defaultThumb = "{{ URL::asset('/build/img/dooted img.svg') }}";
                                            var teraSrc = "{{ URL::asset('/build/img/tera.svg') }}";
                                            function toUrl(p, def) {
                                                if (!p) return def;
                                                try { if (/^https?:\/\//i.test(p)) return p; } catch(e) {}
                                                p = String(p).replace(/^\/+/, '');
                                                return '/storage/' + p;
                                            }
                                            taskContainer.innerHTML = tasks.map(function(t) {
                                                var tTitle = t.title || 'Task Title';
                                                var tDesc = t.description || 'Task description will be here';
                                                var startD = t.start_date || '-';
                                                var endD = t.end_date || '-';
                                                var logo = toUrl(t.project_logo_path, defaultLogo);
                                                var thumb = toUrl(t.mark_image_path, defaultThumb);
                                                var issues = (typeof t.issues_count === 'number') ? String(t.issues_count).padStart(2,'0') : '01';
                                                return ''
                                                    + '<div style="background:#ffffff; border:1px solid #e9ecef; border-radius:12px; padding:10px 12px; display:flex; align-items:center; gap:12px; width:100%;">'
                                                    +   '<div style="width:70px; height:100px; border-radius:8px; overflow:hidden; background:#ccc; flex-shrink:0;">'
                                                    +       '<img src="'+ thumb +'" alt="icon" style="width:100%; height:100%; object-fit:cover;">'
                                                    +   '</div>'
                                                    +   '<div style="flex:1; display:flex; flex-direction:column; gap:6px;">'
                                                    +       '<div style="display:flex; justify-content:space-between; flex-wrap:wrap; align-items:flex-start;">'
                                                    +           '<div style="display:flex; align-items:center; gap:8px;">'
                                                    +               '<img src="'+ logo +'" alt="Logo" style="height:32px; width:32px; flex-shrink:0;" />'
                                                    +               '<div>'
                                                    +                   '<div style="font-weight:700; font-size:14px; color:#1b1b3a;">'+ tTitle +'</div>'
                                                    +                   '<div style="font-size:12px; color:#999;">'+ (code || '') +' - '+ (title || '') +'</div>'
                                                    +               '</div>'
                                                    +           '</div>'
                                                    +       '</div>'
                                                    +       '<div style="font-size:12px; color:#7a7a9d;">'+ tDesc +'</div>'
                                                    +       '<div style="display:flex; flex-wrap:wrap; align-items:center; justify-content:space-between; gap:10px; background:#fff; border-radius:10px; padding:5px;">'
                                                    +           '<div style="display:flex; gap:5px; align-items:center; flex-wrap:nowrap; white-space:nowrap;">'
                                                    +               '<div style="font-size:13px; color:#1ca672; display:inline-flex; align-items:center; gap:5px; white-space:nowrap;"><strong>Start:</strong><span style="color:#1b1b3a;">'+ startD +'</span></div>'
                                                    +               '<div style="width:1px; height:20px; background-color:#ccc;"></div>'
                                                    +               '<div style="font-size:12px; color:#00cc88; display:inline-flex; align-items:center; gap:5px; white-space:nowrap;"><strong>Deliver:</strong><span style="color:#1b1b3a;">'+ endD +'</span></div>'
                                                    +           '</div>'
                                                    +           '<div style="display:flex; align-items:center; gap:6px;">'
                                                    +               '<div style="background:#ef4444; color:#ffffff; display:flex; align-items:center; gap:6px; border-radius:8px; padding:6px 10px; font-size:12px; font-weight:700;">'
                                                    +                   '<img src="'+ teraSrc +'" alt="!" style="width:14px; height:14px;">'
                                                    +                   '<span>'+ issues +'</span>'
                                                    +               '</div>'
                                                    +           '</div>'
                                                    +       '</div>'
                                                    +   '</div>'
                                                    + '</div>';
                                            }).join('');
                                        }
                                    }
                                })
                                .catch(function(){});
                        }
                    }
                    if (indicators) {
                        indicators.innerHTML = '';
                        tabs.forEach(function (t, i) {
                            var bar = document.createElement('div');
                            bar.className = 'bar' + (t.classList.contains('active') ? ' active' : '');
                            indicators.appendChild(bar);
                        });
                    }
                    tabs.forEach(function (tab, idx) {
                        tab.addEventListener('click', function (e) {
                            e.preventDefault();
                            tabs.forEach(function (t) { t.classList.remove('active'); });
                            tab.classList.add('active');
                            var bars = block.querySelectorAll('.ticket-indicators .bar');
                            bars.forEach(function (b, i) { b.classList.toggle('active', i === idx); });
                            renderDetailsFromTab(tab);
                        });
                    });
                    var initial = block.querySelector('.ticket-tab.active') || tabs[0];
                    if (initial) renderDetailsFromTab(initial);
                    var scroller = block.querySelector('.tickets-tab-scroll');
                    if (scroller) {
                        scroller.addEventListener('wheel', function (e) {
                            if (e.deltaY === 0) return;
                            e.preventDefault();
                            scroller.scrollLeft += e.deltaY;
                        }, { passive: false });
                    }
                });
            })();
        </script>

                <!-- Description Row -->
                <!-- <div class="d-flex justify-content-between align-items-center px-2 py-1 mb-1"
                    style="background-color: #f1f5f9; border-radius: 10px;">
                    <div class="d-flex align-items-center gap-2" style="background: #ecfbdc;">
                        <img src="{{ URL::asset('/build/img/flag.svg') }}" width="16" height="16" alt="flag">
                    </div>
                    <div>
                        <small style="color: #64748b; font-size: 14px;">task descirtion </small>
                    </div>
                    <div class="d-flex align-items-center gap-1">
                        <span style="width: 8px; height: 8px; background-color: #22c55e; border-radius: 50%; display: inline-block;"></span>
                        <small style="font-size: 12px; color: #22c55e;">low prieorry</small>
                    </div>
                </div> -->



                <!-- Ticket Items -->
                <!-- Tickets list (static) -->
                <div class="mt-2 ticket-summary" style="background-color: #f8f9fa; border-radius: 10px; padding: 2px; font-size: 13px;margin:7px;">
                    <!-- Ticket Header -->
                    @php
                        $__pidHeader = isset($__project) ? (string) ($__project->_id ?? $__project->id) : (isset($project) ? (string) ($project->_id ?? $project->id) : null);
                        $__ticketsHeader = collect();
                        if ($__pidHeader) {
                            $__ticketsHeader = \App\Models\Ticket::where('project_id', $__pidHeader)
                                ->orderByDesc('created_at')
                                ->limit(20)
                                ->get();
                        }
                    @endphp
                   
                   

                  

                    <!-- Task Progress & Status -->
                    <div class="d-flex justify-content-between align-items-center mt-1 mb-1 " style="background-color: #fff;padding:5px;border-radius:10px;margin:7px;">
                        <div style="text-align: center;">
                            <div style="font-size: 12px; color: #4fc3f7;">0%</div>
                            <div class="progress"
                                style="height: 8px; width: 90px; background-color: #e0e0e0; border-radius: 5px; overflow: hidden; margin-top: 3px;">
                                <div class="progress-bar" role="progressbar"
                                    style="width: 0%; background-color: #4fc3f7;"></div>
                            </div>
                        </div>

                        <!-- Separator -->
                        <div style="color: #ccc;">
                            <p>|</p>
                        </div>


                        <!-- Center Section -->
                        <div style="text-align: center;">
                            <div style="font-size: 26px;">
                                <span style="color: #8BC34A;">●</span>
                                <span style="color: #FF9800;">●</span>
                                <span style="color: #F44336;">●</span>
                                <span style="color: #9C27B0;">●</span>
                                <span style="color: #4CAF50;">●</span>
                            </div>
                        <div style="font-size: 15px; margin-top: 2px; color: #555;">
                                <span>1</span>
                                <span style="margin-left: 9px;">2</span>
                                <span style="margin-left: 9px;">3</span>
                                <span style="margin-left: 9px;">1</span>
                                <span style="margin-left: 9px;">8</span>
                            </div>
                        </div>

                        <!-- Separator -->
                        <div style="color: #ccc;">|</div>

                        <!-- Right Side Flag -->
                        <div style="background-color:#e9f8dd; border-radius: 2px; padding: 6px;margin-right:27px">
                            <img src="{{ URL::asset('/build/img/greenflag.svg') }}" alt="flag" width="24px" height="24px;">
                        </div>

                        <!-- Task Card -->
                      


                        {{-- <div class="d-flex align-items-center gap-2">
                                    <img src="{{ URL::asset('/build/img/yelowflag.svg') }}" style="width: 20px; background-color: #fef3e3; border-radius: 5px; padding: 4px;" alt="flag">
                        <button type="button" class="btn btn-sm btn-outline-primary ticket-edit-trigger"
                            data-bs-toggle="modal" data-bs-target="#ticketModal"
                            data-ticket-id="{{ $pt->_id ?? $pt->id }}"
                            data-project-id="{{ $pt->project_id }}"
                            @if(!empty($pt->section_name)) data-section-name="{{ $pt->section_name }}" @endif
                            >Edit</button>
                    </div> --}}
                </div>  

                <div class="container-fluid mt-2 task-cards-container" data-task-container="1" style="background-color: #f4f4f4; border-radius: 10px; padding: 10px; display: none; gap: 10px; flex-wrap: wrap; align-items: flex-start;"></div>
            </div>
        </div>
    </div> 
    
</div>     
    @endforeach()
                               

                            
                        </div>  
                                           
                    </div>

                    
                </div>

            </div>
        </div>
    </div>
    <script>
        (function () {
            if (window.__taskDetailsToggleBound) return;
            window.__taskDetailsToggleBound = true;
            document.querySelectorAll('.toggle-btn').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    var details = this.nextElementSibling;
                    var icon = this.querySelector('.toggle-icon');
                    if (!details) return;

                    if (details.classList && details.classList.contains('show')) {
                        // Close current
                        details.style.maxHeight = details.scrollHeight + 'px';
                        setTimeout(function () {
                            details.style.maxHeight = '0';
                            details.classList.remove('show');
                        }, 10);
                        if (icon) icon.style.transform = 'rotate(0deg)';
                    } else {
                        // Close others
                        document.querySelectorAll('.project-details.show').forEach(function (open) {
                            if (open === details) return;
                            open.style.maxHeight = open.scrollHeight + 'px';
                            setTimeout(function () {
                                open.style.maxHeight = '0';
                                open.classList.remove('show');
                            }, 10);
                            var otherIcon = open.previousElementSibling && open.previousElementSibling.querySelector('.toggle-icon');
                            if (otherIcon) otherIcon.style.transform = 'rotate(0deg)';
                        });
                        // Open this
                        if (details.classList) details.classList.add('show');
                        details.style.maxHeight = details.scrollHeight + 'px';
                        if (icon) icon.style.transform = 'rotate(180deg)';
                    }
                });
            });
        })();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var createTaskModalEl = document.getElementById('createTaskModal');
            if (!createTaskModalEl) return;

            // Ensure newly opened modals stack above currently open ones (Bootstrap 5)
            document.addEventListener('show.bs.modal', function(ev) {
                try {
                    var openCount = document.querySelectorAll('.modal.show').length;
                    var zIndex = 1050 + 10 * openCount; // ensure new modal sits above existing
                    ev.target.style.zIndex = String(zIndex);
                    setTimeout(function() {
                        document.querySelectorAll('.modal-backdrop:not(.modal-stack)').forEach(
                            function(bd) {
                                bd.style.zIndex = String(zIndex - 1);
                                bd.classList.add('modal-stack');
                            });
                    }, 0);
                } catch (_) {}
            }, true);

            // Task edit opens the main Create Task modal with prefilled data
            window.taskEdit = function(taskId) {
                try {
                    fetch(`{{ url('/tasks') }}/${taskId}`, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(function(res) {
                            return res.json();
                        })
                        .then(function(resp) {
                            if (!resp || !resp.success) return;
                            var t = resp.task || {};

                            // Switch modal title to Edit
                            try {
                                (document.querySelector('#createTaskModal .modal-title') || {}).textContent
                                    = 'Edit Task';
                            } catch (_) {}

                            // Prefill project and load/select ticket deterministically
                            try {
                                if (projectSelect && t.project_id) {
                                    projectSelect.value = String(t.project_id);
                                    loadTickets(String(t.project_id)).then(function() {
                                        try {
                                            if (ticketSelect && t.ticket_id) {
                                                ticketSelect.value = String(t.ticket_id);
                                                var changeEvent = new Event('change');
                                                ticketSelect.dispatchEvent(changeEvent);
                                            }
                                        } catch (_) {}
                                    });
                                }
                            } catch (_) {}

                            // Prefill preview image (board preferred, else mark) and render existing issues
                            try {
                                var src = null;
                                if (t.board_image_path) src = '/storage/' + String(t.board_image_path)
                                    .replace(/^\/+/, '');
                                else if (t.mark_image_path) src = '/storage/' + String(t.mark_image_path)
                                    .replace(/^\/+/, '');
                                if (src && previewImg) {
                                    var renderExistingIssues = function() {
                                        try {
                                            if (markerLayer) {
                                                markerLayer.style.display = 'block';
                                                markerLayer.innerHTML = '';
                                            }
                                            var mtb = document.getElementById('markerToolbar');
                                            if (mtb) mtb.style.display = 'flex';
                                            var issues = Array.isArray(t.issues) ? t.issues : [];
                                            var layerRect = markerLayer ? markerLayer
                                                .getBoundingClientRect() : {
                                                    width: 0,
                                                    height: 0
                                                };
                                            var maxNumber = 0;
                                            issues.forEach(function(iss, idx) {
                                                var pos = iss && iss.position ? iss.position :
                                                    null;
                                                if (!pos) return;
                                                var saved = iss.layer || null;
                                                var scaleX = 1,
                                                    scaleY = 1;
                                                if (saved && saved.width && saved.height &&
                                                    layerRect.width && layerRect.height) {
                                                    scaleX = layerRect.width / saved.width;
                                                    scaleY = layerRect.height / saved.height;
                                                }
                                                var left = (pos.left || 0) * scaleX;
                                                var top = (pos.top || 0) * scaleY;
                                                var num = Number(iss.number || (idx + 1));
                                                if (num > maxNumber) maxNumber = num;
                                                var badge = document.createElement('div');
                                                badge.className = 'marker-badge';
                                                badge.textContent = String(num);
                                                badge.style.position = 'absolute';
                                                badge.style.left = left + 'px';
                                                badge.style.top = top + 'px';
                                                badge.style.transform = 'translate(-50%, -50%)';
                                                badge.style.color = (iss.color || '#28c76f');
                                                badge.style.fontWeight = '800';
                                                badge.style.fontSize = '18px';
                                                badge.style.textShadow =
                                                    '0 1px 2px rgba(0,0,0,0.25)';
                                                badge.style.cursor = 'pointer';
                                                badge.style.zIndex = '25';
                                                badge.addEventListener('mousedown', function(
                                                ev) {
                                                    ev.stopPropagation();
                                                });
                                                badge.addEventListener('mouseup', function(ev) {
                                                    ev.stopPropagation();
                                                });
                                                badge.addEventListener('click', function(ev) {
                                                    ev.stopPropagation();
                                                });
                                                if (markerLayer) markerLayer.appendChild(badge);
                                            });
                                            try {
                                                badgeCounter = Math.max(badgeCounter || 0, maxNumber ||
                                                    0);
                                            } catch (_) {
                                                badgeCounter = maxNumber || 0;
                                            }
                                        } catch (_) {}
                                    };
                                    if (previewImg.complete) {
                                        renderExistingIssues();
                                    } else {
                                        previewImg.onload = function() {
                                            renderExistingIssues();
                                        };
                                    }
                                    previewImg.src = src;
                                    previewImg.style.display = 'block';
                                }
                            } catch (_) {}

                            // Reset any staged issues for a clean edit state (keep numbering from existing badges)
                            try {
                                createdTasks = [];
                            } catch (_) {}

                            // Mark Create & Save as editing
                            try {
                                (document.getElementById('create-task-save') || {}).dataset.editingId =
                                    String(taskId);
                            } catch (_) {}

                            // Enter editing guard and close any open small menus
                            window.__editingTaskMode = true;
                            // Close any open small menus
                            try {
                                document.querySelectorAll('.menu-box').forEach(function(m) {
                                    m.style.display = 'none';
                                });
                            } catch (_) {}
                            // Close any currently open modal, then open the edit modal
                            try {
                                document.querySelectorAll('.modal.show').forEach(function(el) {
                                    try {
                                        bootstrap.Modal.getInstance(el)?.hide();
                                    } catch (_) {}
                                });
                            } catch (_) {}
                            // Open the main task modal (used for editing)
                            setTimeout(function() {
                                var modalEl = document.getElementById('createTaskModal');
                                if (modalEl && modalEl.parentNode !== document.body) {
                                    document.body.appendChild(modalEl);
                                }
                                new bootstrap.Modal(modalEl, {
                                    backdrop: true,
                                    focus: true
                                }).show();
                            }, 150);
                        });
                } catch (_) {}
            };

            window.taskDelete = function(taskId) {
                if (!(window.Swal && typeof Swal.fire === 'function')) {
                    if (!confirm('Delete this task?')) return;
                    fetch(`{{ url('/tasks') }}/${taskId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(function(res) {
                            return res.json();
                        }).then(function() {
                            try {
                                var note = document.createElement('div');
                                note.className = 'position-fixed top-0 end-0 p-3';
                                note.style.zIndex = '1060';
                                note.innerHTML =
                                    '<div class="alert alert-success shadow" role="alert" style="border-radius:8px;">Task deleted</div>';
                                document.body.appendChild(note);
                                window.location.reload();
                                setTimeout(function() {
                                    try {
                                        note.remove();
                                    } catch (_) {}
                                }, 1500);
                            } catch (_) {}
                        });
                    return;
                }
                Swal.fire({
                    title: 'Delete Task?',
                    text: 'This action cannot be undone.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ea5455',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete',
                    cancelButtonText: 'Cancel'
                }).then(function(result) {
                    if (!result.isConfirmed) return;
                    fetch(`{{ url('/tasks') }}/${taskId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    }).then(function(res) {
                        return res.json();
                    }).then(function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted',
                            timer: 900,
                            showConfirmButton: false
                        });
                        window.location.reload();
                    });
                });
            };

            // Web task delete (SweetAlert)
            window.webTaskDelete = function(id) {
                if (!(window.Swal && typeof Swal.fire === 'function')) {
                    if (!confirm('Delete this web task?')) return;
                    fetch(`{{ url('/webtasks') }}/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(function(res) {
                            return res.json();
                        })
                        .then(function() {
                            window.location.reload();
                        });
                    return;
                }
                Swal.fire({
                    title: 'Delete Web Task?',
                    text: 'This action cannot be undone.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ea5455',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete',
                    cancelButtonText: 'Cancel'
                }).then(function(result) {
                    if (!result.isConfirmed) return;
                    fetch(`{{ url('/webtasks') }}/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(function(res) {
                            return res.json();
                        })
                        .then(function() {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted',
                                timer: 900,
                                showConfirmButton: false
                            });
                            window.location.reload();
                        });
                });
            };

            var projectSelect = document.getElementById('select-project');
            var ticketSelect = document.getElementById('select-ticket');
            var ticketCache = {};
            var startDateSpan = document.getElementById('ticket-start-date');
            var endDateSpan = document.getElementById('ticket-end-date');
            var markerLayer = document.getElementById('markerLayer');
            var previewImg = document.getElementById('previewImage');
            var currentMarker = null;
            var currentShape = 'square';
            var currentColor = '#ea5455';
            var placingActive = false; // only place marker when explicitly activated
            var createdTasks = [];
            var badgeCounter = 0;
            // editing guard to prevent reset/clears when editing an existing task
            window.__editingTaskMode = window.__editingTaskMode || false;

            // Prevent marker label overlap by nudging new badges to a nearby free spot
            function getExistingBadgePositions() {
                try {
                    return Array.from((markerLayer || {}).querySelectorAll?.('.marker-badge') || []).map(function(
                        el) {
                        var l = parseFloat(el.style.left || '0');
                        var t = parseFloat(el.style.top || '0');
                        return {
                            left: l,
                            top: t
                        };
                    });
                } catch (_) {
                    return [];
                }
            }

            function isFarEnough(left, top, positions, minDist) {
                minDist = minDist || 24; // pixels center-to-center
                for (var i = 0; i < positions.length; i++) {
                    var p = positions[i];
                    var dx = (left - (p.left || 0));
                    var dy = (top - (p.top || 0));
                    if (Math.sqrt(dx * dx + dy * dy) < minDist) return false;
                }
                return true;
            }

            function clamp(val, min, max) {
                return Math.max(min, Math.min(max, val));
            }

            function findFreePosition(baseLeft, baseTop) {
                var positions = getExistingBadgePositions();
                var layerRect = (markerLayer || {}).getBoundingClientRect ? markerLayer.getBoundingClientRect() : {
                    width: 0,
                    height: 0
                };
                var half =
                0; // we use transform translate(-50%, -50%), so centers can be anywhere; we'll clamp inside
                var maxLeft = Math.max(half, (layerRect.width || 0) - half);
                var maxTop = Math.max(half, (layerRect.height || 0) - half);
                var baseL = clamp(baseLeft, half, maxLeft);
                var baseT = clamp(baseTop, half, maxTop);
                if (isFarEnough(baseL, baseT, positions)) return {
                    left: baseL,
                    top: baseT
                };
                var deltas = [];
                for (var r = 16; r <= 96; r += 16) {
                    for (var a = 0; a < 360; a += 30) {
                        var rad = a * Math.PI / 180;
                        deltas.push([Math.round(Math.cos(rad) * r), Math.round(Math.sin(rad) * r)]);
                    }
                }
                for (var j = 0; j < deltas.length; j++) {
                    var candL = clamp(baseL + deltas[j][0], half, maxLeft);
                    var candT = clamp(baseT + deltas[j][1], half, maxTop);
                    if (isFarEnough(candL, candT, positions)) return {
                        left: candL,
                        top: candT
                    };
                }
                return {
                    left: baseL,
                    top: baseT
                };
            }

            function formatDate(value) {
                if (!value) return '--';
                var iso = typeof value === 'string' ? value : '';
                if (!iso) return '--';
                // normalize to first 10 chars (YYYY-MM-DD) even if ISO with timezone
                var ymd = iso.substring(0, 10);
                var parts = ymd.split('-');
                if (parts.length !== 3) return '--';
                var yyyy = parts[0];
                var mm = parts[1];
                var dd = parts[2];
                return dd + ':' + mm + ':' + yyyy; // DD:MM:YYYY
            }

            function renderTicketDates(ticket) {
                if (!startDateSpan || !endDateSpan) return;
                if (!ticket) {
                    startDateSpan.textContent = '--';
                    endDateSpan.textContent = '--';
                    return;
                }
                startDateSpan.textContent = formatDate(ticket.start_date);
                endDateSpan.textContent = formatDate(ticket.end_date);
            }

            function setSelectLoading(selectEl, loading) {
                if (!selectEl) return;
                selectEl.disabled = !!loading;
                if (loading) {
                    selectEl.innerHTML = '<option>Loading...</option>';
                }
            }

            // marker controls
            var shapeSquareBtn = document.getElementById('marker-shape-square');
            var shapeCircleBtn = document.getElementById('marker-shape-circle');
            if (shapeSquareBtn) shapeSquareBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                currentShape = 'square';
                this.style.background = '#e9ecef';
                if (shapeCircleBtn) shapeCircleBtn.style.background = '#f8f9fa';
                // enter place mode; do not auto-create marker
                placingActive = true;
                if (markerLayer) {
                    try {
                        previewImg.style.display = 'block';
                        markerLayer.style.display = 'block';
                    } catch (_) {}
                    markerLayer.style.cursor = 'crosshair';
                }
            });
            if (shapeCircleBtn) shapeCircleBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                currentShape = 'circle';
                this.style.background = '#e9ecef';
                if (shapeSquareBtn) shapeSquareBtn.style.background = '#f8f9fa';
                // enter place mode; do not auto-create marker
                placingActive = true;
                if (markerLayer) {
                    try {
                        previewImg.style.display = 'block';
                        markerLayer.style.display = 'block';
                    } catch (_) {}
                    markerLayer.style.cursor = 'crosshair';
                }
            });
            var markerToolbarEl = document.getElementById('markerToolbar');
            if (markerToolbarEl) {
                markerToolbarEl.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
            }
            document.querySelectorAll('.marker-color').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    currentColor = this.getAttribute('data-color') || '#ea5455';
                });
            });
            var clearBtn = document.getElementById('marker-clear');
            if (clearBtn) clearBtn.addEventListener('click', function() {
                if (currentMarker) {
                    currentMarker.remove();
                    currentMarker = null;
                }
            });

            function openMarkerDetailsSwal() {
                if (!(window.Swal && typeof Swal.fire === 'function')) return;
                Swal.fire({
                    title: 'Add Task',
                    html: (
                        '<div id="swal-marker-form">\
                        <div class="mb-2">\
                            <label class="form-label" style="font-weight:600;color:#2b2d42;">Type the Title</label>\
                            <div style="position:relative;">\
                                <input type="text" id="swal-title" class="form-control form-control-sm" placeholder="Type the Title"\
                                       style="border:3px solid #ced4da;border-radius:6px;background:#fff;color:#2b2d42;height:38px;padding-right:38px;" />\
                                <img src=\"{{ asset('assets/img/title.svg') }}\" alt=\"title\"\
                                     style=\"position:absolute;right:10px;top:50%;transform:translateY(-50%);width:16px;height:16px;opacity:.8;\" />\
                            </div>\
                        </div>\
                        <div class="mb-2">\
                            <label class="form-label" style="font-weight:600;color:#2b2d42;">Describe the Issue</label>\
                            <textarea id="swal-description" class="form-control form-control-sm" rows="4" placeholder="Describe the Issue"\
                                      style="border:3px solid #ced4da;border-radius:6px;background:#fff;color:#2b2d42;min-height:110px;"></textarea>\
                        </div>\
                        <div class="d-flex gap-2 mb-2">\
                            <div class="flex-fill">\
                                <label class="form-label">Start Date</label>\
                                <div style=\"position:relative;\">\
                                    <input type=\"date\" id=\"swal-start\" class=\"form-control form-control-sm\"\
                                           style=\"padding-right:38px;\" />\
                                    <img src=\"{{ asset('assets/img/date.png') }}\" alt=\"date\"\
                                         style=\"position:absolute;right:10px;top:50%;transform:translateY(-50%);width:16px;height:16px;opacity:.8;\" />\
                                </div>\
                            </div>\
                            <div class="flex-fill">\
                                <label class="form-label">Deliver Date</label>\
                                <div style=\"position:relative;\">\
                                    <input type=\"date\" id=\"swal-end\" class=\"form-control form-control-sm\"\
                                           style=\"padding-right:38px;\" />\
                                    <img src=\"{{ asset('assets/img/date.png') }}\" alt=\"date\"\
                                         style=\"position:absolute;right:10px;top:50%;transform:translateY(-50%);width:16px;height:16px;opacity:.8;\" />\
                                </div>\
                            </div>\
                        </div>\
                        <div class="mb-2">\
                            <div class="d-flex justify-content-between align-items-center mb-1">\
                                <label class="form-label m-0">Checkpoints</label>\
                                <button type="button" id="swal-add-checkpoint" class="btn btn-sm p-0" style="background:#28c76f;color:#fff;width:28px;height:28px;border-radius:50%;display:flex;align-items:center;justify-content:center;">\
                                    <img src=\"{{ asset('assets/img/add.png') }}\" alt=\"add\" style=\"width:14px;height:14px;\"/>\
                                </button>\
                            </div>\
                            <div id="swal-checkpoints-list" class="d-flex flex-column gap-2"></div>\
                        </div>\
                    </div>'
                    ),
                    allowEnterKey: true,
                    allowOutsideClick: true,
                    allowEscapeKey: true,
                    focusConfirm: false,
                    returnFocus: false,
                    width: 480,
                    showCancelButton: true,
                    cancelButtonText: 'Close',
                    confirmButtonText: 'Save & Close',
                    didOpen: function() {
                        var list = document.getElementById('swal-checkpoints-list');
                        var addBtn = document.getElementById('swal-add-checkpoint');
                        var titleEl = document.getElementById('swal-title');
                        if (titleEl) titleEl.focus();
                        // Prefill dates from selected ticket
                        try {
                            var sEl = document.getElementById('swal-start');
                            var eEl = document.getElementById('swal-end');
                            if (ticketSelect && ticketSelect.value && ticketCache[ticketSelect.value]) {
                                var t = ticketCache[ticketSelect.value];
                                if (sEl && t.start_date) sEl.value = ('' + t.start_date).substring(0,
                                    10);
                                if (eEl && t.end_date) eEl.value = ('' + t.end_date).substring(0, 10);
                            }
                        } catch (_) {}
                        var iconTitleUrl = "{{ asset('assets/img/title.svg') }}";
                        var iconRemoveUrl = "{{ asset('assets/img/remove.svg') }}";

                        function addRow(value) {
                            var row = document.createElement('div');
                            row.className = 'd-flex align-items-center gap-2';
                            // input with right icon
                            var wrap = document.createElement('div');
                            wrap.style.position = 'relative';
                            wrap.style.flex = '1';
                            var input = document.createElement('input');
                            input.type = 'text';
                            input.placeholder = 'Describe the Checkpoint';
                            input.className = 'form-control form-control-sm';
                            input.style.paddingRight = '38px';
                            if (value) input.value = value;
                            var icon = document.createElement('img');
                            icon.src = iconTitleUrl;
                            icon.alt = 'title';
                            icon.style.position = 'absolute';
                            icon.style.right = '10px';
                            icon.style.top = '50%';
                            icon.style.transform = 'translateY(-50%)';
                            icon.style.width = '16px';
                            icon.style.height = '16px';
                            icon.style.opacity = '.8';
                            wrap.appendChild(input);
                            wrap.appendChild(icon);
                            var remove = document.createElement('button');
                            remove.type = 'button';
                            remove.className = 'btn btn-sm p-0';
                            remove.style.background = 'transparent';
                            remove.style.color = '#ea5455';
                            remove.style.width = '28px';
                            remove.style.height = '28px';
                            remove.style.borderRadius = '50%';
                            remove.innerHTML = '<img src="' + iconRemoveUrl +
                                '" alt="remove" style="width:14px;height:14px;" />';
                            remove.addEventListener('click', function() {
                                row.remove();
                            });
                            row.appendChild(wrap);
                            row.appendChild(remove);
                            list.appendChild(row);
                        }
                        if (addBtn) addBtn.addEventListener('click', function() {
                            addRow('');
                        });
                        // start with a single empty row
                        addRow('');
                    },
                    preConfirm: function() {
                        var title = (document.getElementById('swal-title') || {}).value || '';
                        var description = (document.getElementById('swal-description') || {}).value ||
                            '';
                        var startDate = (document.getElementById('swal-start') || {}).value || '';
                        var endDate = (document.getElementById('swal-end') || {}).value || '';
                        var checkpoints = Array.from((document.getElementById(
                                'swal-checkpoints-list') || {}).children || [])
                            .map(function(row) {
                                return row.querySelector('input')?.value || '';
                            })
                            .filter(Boolean);
                        var base64 = (typeof cropMarkerToBase64 === 'function') ? cropMarkerToBase64() :
                            null;
                        return {
                            title: title,
                            description: description,
                            start_date: startDate,
                            end_date: endDate,
                            checkpoints: checkpoints,
                            shape: currentShape,
                            color: currentColor,
                            mark_image: base64,
                        };
                    }
                }).then(function(result) {
                    if (!result.isConfirmed) return;
                    // Create a task object and badge on the image
                    var taskData = result.value || {};
                    badgeCounter += 1;
                    taskData.number = badgeCounter;
                    taskData.color = currentColor;
                    taskData.position = (function() {
                        var layerRect = markerLayer.getBoundingClientRect();
                        var mRect = (currentMarker || {}).getBoundingClientRect ? currentMarker
                            .getBoundingClientRect() : layerRect;
                        return {
                            left: (mRect.left - layerRect.left) + mRect.width / 2,
                            top: (mRect.top - layerRect.top) + mRect.height / 2
                        };
                    })();
                    createdTasks.push(taskData);

                    var badge = document.createElement('div');
                    badge.className = 'marker-badge';
                    badge.textContent = String(taskData.number);
                    badge.style.position = 'absolute';
                    badge.style.left = taskData.position.left + 'px';
                    badge.style.top = taskData.position.top + 'px';
                    badge.style.transform = 'translate(-50%, -50%)';
                    badge.style.color = taskData.color || '#28c76f';
                    badge.style.fontWeight = '800';
                    badge.style.fontSize = '18px';
                    badge.style.textShadow = '0 1px 2px rgba(0,0,0,0.25)';
                    badge.style.cursor = 'pointer';
                    badge.style.zIndex = '25';
                    badge.addEventListener('click', function(ev) {
                        ev.stopPropagation();
                        if (!(window.Swal && typeof Swal.fire === 'function')) return;
                        var cp = Array.isArray(taskData.checkpoints) ? taskData.checkpoints : [];
                        var checkpointsHtml = cp.length ? ('<ul style="text-align:left;">' + cp.map(
                            function(c) {
                                return '<li>' + c + '</li>';
                            }).join('') + '</ul>') : '<em>No checkpoints</em>';
                        Swal.fire({
                            title: taskData.title || 'Task',
                            html: (
                                '<div style="text-align:left;">' +
                                '<div><strong>Description:</strong> ' + (taskData
                                    .description || '-') + '</div>' +
                                '<div class="mt-1"><strong>Start:</strong> ' + (taskData
                                    .start_date || '-') +
                                ' &nbsp; <strong>End:</strong> ' + (taskData.end_date ||
                                    '-') + '</div>'

                                +
                                '</div>'
                            ),
                            confirmButtonText: 'Close'
                        });
                    });
                    // Avoid triggering upload
                    badge.addEventListener('mousedown', function(ev) {
                        ev.stopPropagation();
                    });
                    badge.addEventListener('mouseup', function(ev) {
                        ev.stopPropagation();
                    });
                    markerLayer.appendChild(badge);

                    // Remove the drawn marker box/plus; keep only the number
                    if (currentMarker) {
                        try {
                            currentMarker.remove();
                        } catch (_) {}
                        currentMarker = null;
                    }

                    Swal.fire({
                        icon: 'success',
                        title: 'Task created',
                        timer: 1000,
                        showConfirmButton: false
                    });
                });
            }

            function createMarker(x, y) {
                if (!markerLayer) return;
                if (currentMarker) {
                    currentMarker.remove();
                    currentMarker = null;
                }
                var marker = document.createElement('div');
                marker.className = 'marker-box';
                marker.style.position = 'absolute';
                marker.style.left = (x - 40) + 'px';
                marker.style.top = (y - 40) + 'px';
                marker.style.width = '80px';
                marker.style.height = '80px';
                marker.style.border = '2px solid ' + currentColor;
                marker.style.background = 'rgba(0,0,0,0.0)';
                marker.style.cursor = 'move';
                marker.style.userSelect = 'none';
                marker.style.pointerEvents = 'auto';
                marker.style.borderRadius = currentShape === 'circle' ? '50%' : '6px';

                var plus = document.createElement('div');
                plus.textContent = '+';
                plus.title = 'Add details';
                plus.style.position = 'absolute';
                plus.style.right = '-10px';
                plus.style.top = '-10px';
                plus.style.width = '24px';
                plus.style.height = '24px';
                plus.style.borderRadius = '50%';
                plus.style.background = currentColor;
                plus.style.color = '#fff';
                plus.style.display = 'flex';
                plus.style.alignItems = 'center';
                plus.style.justifyContent = 'center';
                plus.style.cursor = 'pointer';
                marker.appendChild(plus);

                // prevent marker interactions from bubbling to upload box (which opens file chooser)
                marker.addEventListener('mousedown', function(e) {
                    e.stopPropagation();
                });
                marker.addEventListener('mouseup', function(e) {
                    e.stopPropagation();
                });
                marker.addEventListener('click', function(e) {
                    e.stopPropagation();
                });

                markerLayer.appendChild(marker);
                currentMarker = marker;

                // enable drag + resize (requires jQuery UI loaded in page assets)
                if (typeof $ === 'function' && typeof $.fn.draggable === 'function' && typeof $.fn.resizable ===
                    'function') {
                    $(marker).draggable({
                        containment: markerLayer
                    });
                    $(marker).resizable({
                        aspectRatio: currentShape === 'circle',
                        containment: markerLayer,
                        handles: 'n, e, s, w, ne, se, sw, nw',
                        resize: function() {
                            if (currentShape === 'circle') {
                                var w = $(this).width();
                                $(this).height(w);
                            }
                        }
                    });
                }

                function removeInlineColorRows() {
                    document.querySelectorAll('.marker-color-row').forEach(function(el) {
                        el.remove();
                    });
                }

                plus.addEventListener('click', function(e) {
                    e.stopPropagation();
                    removeInlineColorRows();
                    var mRect = marker.getBoundingClientRect();
                    var lRect = markerLayer.getBoundingClientRect();
                    var row = document.createElement('div');
                    row.className = 'marker-color-row';
                    row.style.position = 'absolute';
                    row.style.left = (mRect.right - lRect.left + 8) + 'px';
                    row.style.top = (mRect.top - lRect.top) + 'px';
                    row.style.background = '#ffffff';
                    row.style.padding = '8px 10px';
                    row.style.borderRadius = '10px';
                    row.style.boxShadow = '0 2px 8px rgba(0,0,0,0.15)';
                    row.style.display = 'flex';
                    row.style.alignItems = 'center';
                    row.style.gap = '8px';
                    row.style.zIndex = '20';

                    var palette = ['#ea5455', '#28c76f', '#ffde59', '#00cfe8'];
                    palette.forEach(function(c) {
                        var b = document.createElement('button');
                        b.type = 'button';
                        b.style.width = '24px';
                        b.style.height = '24px';
                        b.style.borderRadius = '50%';
                        b.style.border = '2px solid ' + (c === currentColor ? '#111' : '#e0e6ed');
                        b.style.background = c;
                        b.style.cursor = 'pointer';
                        b.addEventListener('click', function(ev) {
                            ev.stopPropagation();
                            currentColor = c;
                            marker.style.border = '2px solid ' + currentColor;
                            plus.style.background = currentColor;
                            // update selection borders
                            row.querySelectorAll('button').forEach(function(btn) {
                                if (btn !== createBtn) btn.style.borderColor =
                                    '#e0e6ed';
                            });
                            b.style.borderColor = '#111';
                        });
                        row.appendChild(b);
                    });

                    var createBtn = document.createElement('button');
                    createBtn.type = 'button';
                    createBtn.className = 'btn btn-sm';
                    createBtn.textContent = 'Create Issue';
                    createBtn.style.background = '#28c76f';
                    createBtn.style.color = '#fff';
                    createBtn.style.borderRadius = '6px';
                    createBtn.addEventListener('click', function(ev) {
                        ev.stopPropagation();
                        removeInlineColorRows();
                        // Ensure image and layers stay visible when opening the issue modal
                        try {
                            if (previewImg) previewImg.style.display = 'block';
                            if (markerLayer) markerLayer.style.display = 'block';
                            var mtb = document.getElementById('markerToolbar');
                            if (mtb) mtb.style.display = 'flex';
                        } catch (_) {}
                        try {
                            // Prefill dates from selected ticket into modal fields
                            var sEl = document.getElementById('marker-start');
                            var eEl = document.getElementById('marker-end');
                            if (ticketSelect && ticketSelect.value && ticketCache[ticketSelect
                                    .value]) {
                                var t = ticketCache[ticketSelect.value];
                                if (sEl && t.start_date) sEl.value = ('' + t.start_date).substring(
                                    0, 10);
                                if (eEl && t.end_date) eEl.value = ('' + t.end_date).substring(0,
                                    10);
                            }
                        } catch (_) {}
                        // reset checkpoints list with four empty rows
                        try {
                            var list = document.getElementById('checkpoints-list');
                            list.innerHTML = '';
                            var addBtn = document.getElementById('add-checkpoint');
                            var addRow = function(value) {
                                var row = document.createElement('div');
                                row.className = 'd-flex align-items-center gap-2';
                                var wrap = document.createElement('div');
                                wrap.style.position = 'relative';
                                wrap.style.flex = '1';
                                var input = document.createElement('input');
                                input.type = 'text';
                                input.placeholder = 'Describe the Checkpoint';
                                input.className = 'form-control form-control-sm';
                                input.style.paddingRight = '38px';
                                if (value) input.value = value;
                                var icon = document.createElement('img');
                                icon.src = "{{ asset('assets/img/title.svg') }}";
                                icon.alt = 'title';
                                icon.style.position = 'absolute';
                                icon.style.right = '10px';
                                icon.style.top = '50%';
                                icon.style.transform = 'translateY(-50%)';
                                icon.style.width = '16px';
                                icon.style.height = '16px';
                                icon.style.opacity = '.8';
                                wrap.appendChild(input);
                                wrap.appendChild(icon);
                                var remove = document.createElement('button');
                                remove.type = 'button';
                                remove.className = 'btn btn-sm p-0';
                                remove.style.background = 'transparent';
                                remove.style.color = '#ea5455';
                                remove.style.width = '28px';
                                remove.style.height = '28px';
                                remove.style.borderRadius = '50%';
                                remove.innerHTML =
                                    '<img src="{{ asset('assets/img/remove.png') }}" alt="remove" style="width:14px;height:14px;" />';
                                remove.addEventListener('click', function() {
                                    row.remove();
                                });
                                row.appendChild(wrap);
                                row.appendChild(remove);
                                list.appendChild(row);
                            };
                            addRow('');
                            if (addBtn && !addBtn._bound) {
                                addBtn.addEventListener('click', function() {
                                    addRow('');
                                });
                                addBtn._bound = true;
                            }
                        } catch (_) {}
                        // open bootstrap modal
                        try {
                            var modalEl = document.getElementById('markerDetailsModal');
                            // append to body to avoid parent stacking contexts
                            if (modalEl && modalEl.parentNode !== document.body) {
                                document.body.appendChild(modalEl);
                            }
                            new bootstrap.Modal(modalEl, {
                                backdrop: true,
                                focus: true
                            }).show();
                        } catch (e) {}
                    });
                    row.appendChild(createBtn);

                    markerLayer.appendChild(row);
                    // keep inside right edge
                    try {
                        var rRect = row.getBoundingClientRect();
                        var overflowX = rRect.right - lRect.right;
                        if (overflowX > 0) {
                            row.style.left = (parseFloat(row.style.left) - overflowX - 8) + 'px';
                        }
                    } catch (_) {}
                });
            }

            if (markerLayer && previewImg) {
                markerLayer.addEventListener('click', function(e) {
                    // Prevent bubbling to #uploadBox which would open file chooser
                    e.stopPropagation();
                    if (!placingActive) return; // only place when a shape was explicitly chosen
                    var rect = markerLayer.getBoundingClientRect();
                    createMarker(e.clientX - rect.left, e.clientY - rect.top);
                    placingActive = false;
                    markerLayer.style.cursor = 'default';
                });
                // Right-click: add circular marker at cursor (only in place mode)
                markerLayer.addEventListener('contextmenu', function(e) {
                    if (!placingActive) return;
                    e.preventDefault();
                    e.stopPropagation();
                    var rect = markerLayer.getBoundingClientRect();
                    var prevShape = currentShape;
                    currentShape = 'circle';
                    createMarker(e.clientX - rect.left, e.clientY - rect.top);
                    currentShape = prevShape;
                    placingActive = false;
                    markerLayer.style.cursor = 'default';
                });
                // Escape cancels place mode
                document.addEventListener('keydown', function(ev) {
                    if (ev.key === 'Escape') {
                        placingActive = false;
                        markerLayer.style.cursor = 'default';
                    }
                });
            }

            // Changing project/ticket cancels place mode
            if (projectSelect) projectSelect.addEventListener('change', function() {
                placingActive = false;
                if (markerLayer) markerLayer.style.cursor = 'default';
            });
            if (ticketSelect) ticketSelect.addEventListener('change', function() {
                placingActive = false;
                if (markerLayer) markerLayer.style.cursor = 'default';
            });

            // Clear any existing markers when a new image is uploaded
            var uploadInput = document.getElementById('fileInput');
            if (uploadInput) {
                uploadInput.addEventListener('change', function() {
                    if (markerLayer) {
                        markerLayer.innerHTML = '';
                    }
                    if (currentMarker) {
                        currentMarker = null;
                    }
                });
            }

            // Projects are rendered server-side; no client-side fetching needed

            function loadTickets(projectId) {
                if (!ticketSelect) return Promise.resolve();
                if (!projectId) {
                    ticketSelect.innerHTML = '<option value="">Select the Ticket</option>';
                    return Promise.resolve();
                }
                setSelectLoading(ticketSelect, true);
                var url = new URL('{{ route('tasks.tickets') }}', window.location.origin);
                url.searchParams.set('project_id', projectId);
                return fetch(url.toString(), {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(function(res) {
                        return res.json();
                    })
                    .then(function(resp) {
                        ticketSelect.innerHTML = '<option value="">Select the Ticket</option>';
                        var items = (resp && Array.isArray(resp.tickets)) ? resp.tickets : [];
                        // cache tickets by id for quick lookup on change
                        ticketCache = {};
                        items.forEach(function(t) {
                            var opt = document.createElement('option');
                            opt.value = t.id;
                            opt.textContent = (t.title || 'Untitled');
                            ticketSelect.appendChild(opt);
                            ticketCache[t.id] = t;
                        });
                        ticketSelect.disabled = false;
                        // reset displayed dates when list refreshes
                        renderTicketDates(null);
                        return items;
                    })
                    .catch(function() {
                        ticketSelect.innerHTML = '<option value="">Failed to load tickets</option>';
                        ticketSelect.disabled = false;
                        return [];
                    });
            }

            createTaskModalEl.addEventListener('shown.bs.modal', function() {
                if (window.__editingTaskMode) return; // don't reset when editing
                if (ticketSelect) {
                    ticketSelect.innerHTML = '<option value="">Select the Ticket</option>';
                    ticketSelect.disabled = true;
                }
            });

            if (projectSelect) {
                projectSelect.addEventListener('change', function(e) {
                    loadTickets(e.target.value);
                });
            }

            if (ticketSelect) {
                ticketSelect.addEventListener('change', function(e) {
                    var selectedId = e.target.value;
                    var ticket = ticketCache[selectedId];
                    renderTicketDates(ticket || null);
                    if (window.__editingTaskMode) return; // don't clear the image/markers while editing
                    try {
                        var p = document.getElementById('previewImage');
                        var t = document.getElementById('uploadText');
                        var ml = document.getElementById('markerLayer');
                        var mt = document.getElementById('markerToolbar');
                        if (p) {
                            p.src = '';
                            p.style.display = 'none';
                        }
                        if (t) {
                            t.style.display = 'block';
                            t.innerHTML = 'Upload Or Drag<br><small>PDF, JPG, PNG</small>';
                        }
                        if (ml) {
                            ml.style.display = 'none';
                            ml.innerHTML = '';
                        }
                        if (mt) {
                            mt.style.display = 'none';
                        }
                        var fi = document.getElementById('fileInput');
                        if (fi) fi.value = '';
                        var wfi = document.getElementById('web-fileInput');
                        if (wfi) wfi.value = '';
                        var wpi = document.getElementById('web-previewImage');
                        if (wpi) {
                            wpi.src = '';
                            wpi.style.display = 'none';
                        }
                        var wut = document.getElementById('web-uploadText');
                        if (wut) {
                            wut.style.display = 'block';
                            wut.innerHTML = 'Upload Or Drag<br><small>PDF, JPG, PNG</small>';
                        }
                    } catch (_) {}
                });
            }

            // checkpoints handling inside marker modal (Figma-style)
            var checkpointsList = document.getElementById('checkpoints-list');
            var addCheckpointBtn = document.getElementById('add-checkpoint');

            function addCheckpointRow(value) {
                if (!checkpointsList) return;
                var row = document.createElement('div');
                row.className = 'd-flex align-items-center gap-2';
                var wrap = document.createElement('div');
                wrap.style.position = 'relative';
                wrap.style.flex = '1';
                var input = document.createElement('input');
                input.type = 'text';
                input.placeholder = 'Describe the Checkpoint';
                input.className = 'form-control form-control-sm';
                input.style.paddingRight = '38px';
                if (value) input.value = value;
                var icon = document.createElement('img');
                icon.src = "{{ asset('assets/img/title.svg') }}";
                icon.alt = 'title';
                icon.style.position = 'absolute';
                icon.style.right = '10px';
                icon.style.top = '50%';
                icon.style.transform = 'translateY(-50%)';
                icon.style.width = '16px';
                icon.style.height = '16px';
                icon.style.opacity = '.8';
                wrap.appendChild(input);
                wrap.appendChild(icon);
                var remove = document.createElement('button');
                remove.type = 'button';
                remove.className = 'btn btn-sm p-0';
                remove.style.background = 'transparent';
                remove.style.color = '#ea5455';
                remove.style.width = '28px';
                remove.style.height = '28px';
                remove.style.borderRadius = '50%';
                remove.innerHTML =
                    '<img src="{{ asset('assets/img/remove.png') }}" alt="remove" style="width:14px;height:14px;" />';
                remove.addEventListener('click', function() {
                    row.remove();
                });
                row.appendChild(wrap);
                row.appendChild(remove);
                checkpointsList.appendChild(row);
            }
            // Do not bind here to avoid duplicate handlers; binding occurs when opening the modal

            // Reset modal inputs when shown
            var markerDetailsModalEl = document.getElementById('markerDetailsModal');
            if (markerDetailsModalEl) {
                markerDetailsModalEl.addEventListener('shown.bs.modal', function() {
                    try {
                        // focus title
                        var titleEl = document.getElementById('marker-title');
                        if (titleEl) titleEl.focus();
                        // prefill dates from ticket
                        var sEl = document.getElementById('marker-start');
                        var eEl = document.getElementById('marker-end');
                        if (ticketSelect && ticketSelect.value && ticketCache[ticketSelect.value]) {
                            var t = ticketCache[ticketSelect.value];
                            if (sEl && t.start_date) sEl.value = ('' + t.start_date).substring(0, 10);
                            if (eEl && t.end_date) eEl.value = ('' + t.end_date).substring(0, 10);
                        }
                    } catch (_) {}
                    if (checkpointsList) {
                        checkpointsList.innerHTML = '';
                        addCheckpointRow('');
                    }
                });
            }

            // save marker: return the FULL base image (no cropping)
            var saveMarkerBtn = document.getElementById('save-marker');

            function cropMarkerToBase64() {
                if (!previewImg) return null;
                try {
                    var src = previewImg.src || '';
                    return (src && src.indexOf('data:image') === 0) ? src : null;
                } catch (_) {
                    return null;
                }
            }
            if (saveMarkerBtn) saveMarkerBtn.addEventListener('click', function() {
                var payload = {
                    title: (document.getElementById('marker-title') || {}).value || '',
                    description: (document.getElementById('marker-description') || {}).value || '',
                    start_date: (document.getElementById('marker-start') || {}).value || '',
                    end_date: (document.getElementById('marker-end') || {}).value || '',
                    checkpoints: Array.from((checkpointsList || {}).children || []).map(function(row) {
                        return row.querySelector('input')?.value || '';
                    }).filter(Boolean),
                    shape: currentShape,
                    color: currentColor,
                    mark_image: cropMarkerToBase64(),
                    project_id: (projectSelect || {}).value || null,
                    ticket_id: (ticketSelect || {}).value || null,
                    position: (function() {
                        if (!markerLayer) return null;
                        var layerRect = markerLayer.getBoundingClientRect();
                        var markerRect = (currentMarker || {}).getBoundingClientRect ?
                            currentMarker.getBoundingClientRect() : layerRect;
                        return {
                            left: (markerRect.left - layerRect.left) + markerRect.width / 2,
                            top: (markerRect.top - layerRect.top) + markerRect.height / 2
                        };
                    })(),
                    number: badgeCounter + 1
                };
                // If editing an existing task, do NOT update immediately; accumulate locally
                try {
                    var editingId = (document.getElementById('save-marker') || {}).dataset?.editingId;
                    if (editingId) {
                        // fall through to push into createdTasks and create a badge; final PUT happens on Save & Close
                    }
                } catch (_) {}
                // Do not post per-issue; accumulate locally until Save & Close
                // Create badge and store task like SweetAlert flow
                var taskData = payload || {};
                badgeCounter += 1;
                taskData.number = badgeCounter;
                taskData.color = currentColor;
                taskData.position = (function() {
                    var layerRect = markerLayer.getBoundingClientRect();
                    var mRect = (currentMarker || {}).getBoundingClientRect ? currentMarker
                        .getBoundingClientRect() : layerRect;
                    var base = {
                        left: (mRect.left - layerRect.left) + mRect.width / 2,
                        top: (mRect.top - layerRect.top) + mRect.height / 2
                    };
                    var free = findFreePosition(base.left, base.top);
                    return {
                        left: free.left,
                        top: free.top
                    };
                })();
                // Store the current layer size for later scaling in viewer
                try {
                    var lRectPersist = markerLayer.getBoundingClientRect();
                    taskData.layer = {
                        width: Math.round(lRectPersist.width || 0),
                        height: Math.round(lRectPersist.height || 0)
                    };
                } catch (_) {
                    taskData.layer = null;
                }
                createdTasks.push(taskData);

                var badge = document.createElement('div');
                badge.className = 'marker-badge';
                badge.textContent = String(taskData.number);
                badge.style.position = 'absolute';
                badge.style.left = taskData.position.left + 'px';
                badge.style.top = taskData.position.top + 'px';
                badge.style.transform = 'translate(-50%, -50%)';
                badge.style.color = taskData.color || '#28c76f';
                badge.style.fontWeight = '800';
                badge.style.fontSize = '18px';
                badge.style.textShadow = '0 1px 2px rgba(0,0,0,0.25)';
                badge.style.cursor = 'pointer';
                badge.style.zIndex = '25';
                badge.addEventListener('click', function(ev) {
                    ev.stopPropagation();
                    var cp = Array.isArray(taskData.checkpoints) ? taskData.checkpoints : [];
                    var checkpointsHtml = cp.length ? ('<ul style="text-align:left;">' + cp.map(
                        function(c) {
                            return '<li>' + c + '</li>';
                        }).join('') + '</ul>') : '<em>No checkpoints</em>';
                    if (window.Swal && typeof Swal.fire === 'function') {
                        Swal.fire({
                            title: taskData.title || 'Task',
                            html: ('<div style="text-align:left;">' +
                                '<div><strong>Description:</strong> ' + (taskData
                                    .description || '-') + '</div>' +
                                '<div class="mt-1"><strong>Start:</strong> ' + (taskData
                                    .start_date || '-') +
                                ' &nbsp; <strong>End:</strong> ' + (taskData.end_date ||
                                    '-') + '</div>'

                                +
                                '</div>'),
                            confirmButtonText: 'Close'
                        });
                    }
                });
                // Avoid triggering upload
                badge.addEventListener('mousedown', function(ev) {
                    ev.stopPropagation();
                });
                badge.addEventListener('mouseup', function(ev) {
                    ev.stopPropagation();
                });
                markerLayer.appendChild(badge);

                // Remove drawn marker box; keep number
                if (currentMarker) {
                    try {
                        currentMarker.remove();
                    } catch (_) {}
                    currentMarker = null;
                }

                // No immediate backend request here; task will be created on Save & Close
                try {
                    bootstrap.Modal.getInstance(document.getElementById('markerDetailsModal')).hide();
                } catch (e) {}
            });
            // Save aggregated issues into a single task on main modal Save & Close
            try {
                var createTaskSaveBtn = document.getElementById('create-task-save');
                if (createTaskSaveBtn && !createTaskSaveBtn._bound) {
                    createTaskSaveBtn.addEventListener('click', function() {
                        try {
                            // Editing mode: PUT update instead of creating a new task
                            var editingId = (document.getElementById('create-task-save') || {}).dataset
                                ?.editingId;
                            if (editingId) {
                                var updatePayload = {
                                    // Use selected ticket title as task title (same as create flow)
                                    title: (function() {
                                        try {
                                            var opt = ticketSelect?.selectedOptions?.[0];
                                            return opt ? (opt.textContent || '').trim() :
                                            'Task';
                                        } catch (_) {
                                            return 'Task';
                                        }
                                    })(),
                                    description: '',
                                    start_date: (function() {
                                        try {
                                            var t = ticketCache[(ticketSelect || {}).value];
                                            return t ? (t.start_date || null) : null;
                                        } catch (_) {
                                            return null;
                                        }
                                    })(),
                                    end_date: (function() {
                                        try {
                                            var t = ticketCache[(ticketSelect || {}).value];
                                            return t ? (t.end_date || null) : null;
                                        } catch (_) {
                                            return null;
                                        }
                                    })(),
                                    checkpoints: [],
                                    issues: (Array.isArray(createdTasks) ? createdTasks : []),
                                    mark_image: (function() {
                                        try {
                                            var src = (previewImg || {}).src || '';
                                            return (src.indexOf('data:image') === 0) ? src :
                                                null;
                                        } catch (_) {
                                            return null;
                                        }
                                    })()
                                };
                                fetch(`{{ url('/tasks') }}/${editingId}`, {
                                    method: 'PUT',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'X-Requested-With': 'XMLHttpRequest'
                                    },
                                    body: JSON.stringify(updatePayload)
                                }).then(function(res) {
                                    return res.json();
                                }).then(function(resp) {
                                    try {
                                        delete(document.getElementById('create-task-save') || {})
                                            .dataset.editingId;
                                    } catch (_) {}
                                    if (resp && resp.success) {
                                        try {
                                            var note = document.createElement('div');
                                            note.className = 'position-fixed top-0 end-0 p-3';
                                            note.style.zIndex = '1060';
                                            note.innerHTML =
                                                '<div class="alert alert-success shadow" role="alert" style="border-radius:8px;">Task updated</div>';
                                            document.body.appendChild(note);
                                            setTimeout(function() {
                                                try {
                                                    note.remove();
                                                } catch (_) {}
                                            }, 1500);
                                        } catch (_) {}
                                        try {
                                            bootstrap.Modal.getOrCreateInstance(document
                                                .getElementById('createTaskModal')).hide();
                                        } catch (e) {}
                                        try {
                                            createdTasks = [];
                                        } catch (_) {}
                                        setTimeout(function() {
                                            window.location.reload();
                                        }, 300);
                                    } else {
                                        alert('Failed to update task');
                                    }
                                }).catch(function() {
                                    alert('Failed to update task');
                                });
                                return;
                            }
                            if (!Array.isArray(createdTasks) || createdTasks.length === 0) {
                                alert('Please add at least one issue on the image before saving the task.');
                                return;
                            }
                            var ticketText = (function() {
                                try {
                                    var opt = ticketSelect?.selectedOptions?.[0];
                                    return opt ? (opt.textContent || '').trim() : '';
                                } catch (_) {
                                    return '';
                                }
                            })();
                            var taskTitle = ticketText ? ticketText : 'Task';
                            var payload = {
                                project_id: (projectSelect || {}).value || null,
                                ticket_id: (ticketSelect || {}).value || null,
                                title: taskTitle,
                                description: '',
                                // Persist task-level dates from the selected ticket
                                start_date: (function() {
                                    try {
                                        var t = ticketCache[(ticketSelect || {}).value];
                                        return t ? (t.start_date || null) : null;
                                    } catch (_) {
                                        return null;
                                    }
                                })(),
                                end_date: (function() {
                                    try {
                                        var t = ticketCache[(ticketSelect || {}).value];
                                        return t ? (t.end_date || null) : null;
                                    } catch (_) {
                                        return null;
                                    }
                                })(),
                                issues: createdTasks,
                                // Include board image if present and still a dataURL (not yet persisted)
                                board_image: (function() {
                                    try {
                                        var src = (previewImg || {}).src || '';
                                        return (src && src.indexOf('data:image') === 0) ? src :
                                            null;
                                    } catch (_) {
                                        return null;
                                    }
                                })()
                            };
                            fetch("{{ route('tasks.store') }}", {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'X-Requested-With': 'XMLHttpRequest'
                                },
                                body: JSON.stringify(payload)
                            }).then(function(res) {
                                return res.json();
                            }).then(function(resp) {
                                if (resp && resp.success) {
                                    try {
                                        var note = document.createElement('div');
                                        note.className = 'position-fixed top-0 end-0 p-3';
                                        note.style.zIndex = '1060';
                                        note.innerHTML =
                                            '<div class="alert alert-success shadow" role="alert" style="border-radius:8px;">Task created with issues</div>';
                                        document.body.appendChild(note);
                                        setTimeout(function() {
                                            try {
                                                note.remove();
                                            } catch (_) {}
                                        }, 1500);
                                    } catch (_) {}
                                    // Optionally reset accumulator
                                    try {
                                        createdTasks = [];
                                        badgeCounter = 0;
                                        // remove badges from layer
                                        var existing = markerLayer?.querySelectorAll(
                                            '.marker-badge') || [];
                                        existing.forEach?.(function(n) {
                                            try {
                                                n.remove();
                                            } catch (_) {}
                                        });
                                    } catch (_) {}
                                    // Close modal and reload the page to reflect the new task
                                    try {
                                        bootstrap.Modal.getOrCreateInstance(document.getElementById(
                                            'createTaskModal')).hide();
                                    } catch (_) {}
                                    setTimeout(function() {
                                        window.location.reload();
                                    }, 300);
                                } else {
                                    alert('Failed to create task');
                                }
                            }).catch(function() {
                                alert('Failed to create task');
                            });
                        } catch (_) {}
                    });
                    createTaskSaveBtn._bound = true;
                }
                // Save & add Task: save and keep modal open for another task
                var createTaskSaveAddBtn = document.getElementById('create-task-save-add');
                if (createTaskSaveAddBtn && !createTaskSaveAddBtn._bound) {
                    createTaskSaveAddBtn.addEventListener('click', function() {
                        try {
                            // Do not allow edit mode here; if editing, fall back to simple update but keep open
                            var editingId = (document.getElementById('create-task-save') || {}).dataset
                                ?.editingId;
                            if (editingId) {
                                var updatePayload = {
                                    title: (function() {
                                        try {
                                            var opt = ticketSelect?.selectedOptions?.[0];
                                            return opt ? (opt.textContent || '').trim() :
                                            'Task';
                                        } catch (_) {
                                            return 'Task';
                                        }
                                    })(),
                                    description: '',
                                    start_date: (function() {
                                        try {
                                            var t = ticketCache[(ticketSelect || {}).value];
                                            return t ? (t.start_date || null) : null;
                                        } catch (_) {
                                            return null;
                                        }
                                    })(),
                                    end_date: (function() {
                                        try {
                                            var t = ticketCache[(ticketSelect || {}).value];
                                            return t ? (t.end_date || null) : null;
                                        } catch (_) {
                                            return null;
                                        }
                                    })(),
                                    checkpoints: [],
                                    issues: (Array.isArray(createdTasks) ? createdTasks : []),
                                    mark_image: (function() {
                                        try {
                                            var src = (previewImg || {}).src || '';
                                            return (src.indexOf('data:image') === 0) ? src :
                                                null;
                                        } catch (_) {
                                            return null;
                                        }
                                    })()
                                };
                                fetch(`{{ url('/tasks') }}/${editingId}`, {
                                    method: 'PUT',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'X-Requested-With': 'XMLHttpRequest'
                                    },
                                    body: JSON.stringify(updatePayload)
                                }).then(function(res) {
                                    return res.json();
                                }).then(function(resp) {
                                    if (resp && resp.success) {
                                        try {
                                            var note = document.createElement('div');
                                            note.className = 'position-fixed top-0 end-0 p-3';
                                            note.style.zIndex = '1060';
                                            note.innerHTML =
                                                '<div class="alert alert-success shadow" role="alert" style="border-radius:8px;">Task updated</div>';
                                            document.body.appendChild(note);
                                            setTimeout(function() {
                                                try {
                                                    note.remove();
                                                } catch (_) {}
                                            }, 1500);
                                        } catch (_) {}
                                        try {
                                            createdTasks = [];
                                            badgeCounter = 0;
                                            var existing = markerLayer?.querySelectorAll(
                                                '.marker-badge') || [];
                                            existing.forEach?.(function(n) {
                                                try {
                                                    n.remove();
                                                } catch (_) {}
                                            });
                                            currentMarker = null;
                                        } catch (_) {}
                                    } else {
                                        alert('Failed to update task');
                                    }
                                }).catch(function() {
                                    alert('Failed to update task');
                                });
                                return;
                            }
                            if (!Array.isArray(createdTasks) || createdTasks.length === 0) {
                                alert('Please add at least one issue on the image before saving the task.');
                                return;
                            }
                            var ticketText = (function() {
                                try {
                                    var opt = ticketSelect?.selectedOptions?.[0];
                                    return opt ? (opt.textContent || '').trim() : '';
                                } catch (_) {
                                    return '';
                                }
                            })();
                            var taskTitle = ticketText ? ticketText : 'Task';
                            var payload = {
                                project_id: (projectSelect || {}).value || null,
                                ticket_id: (ticketSelect || {}).value || null,
                                title: taskTitle,
                                description: '',
                                start_date: (function() {
                                    try {
                                        var t = ticketCache[(ticketSelect || {}).value];
                                        return t ? (t.start_date || null) : null;
                                    } catch (_) {
                                        return null;
                                    }
                                })(),
                                end_date: (function() {
                                    try {
                                        var t = ticketCache[(ticketSelect || {}).value];
                                        return t ? (t.end_date || null) : null;
                                    } catch (_) {
                                        return null;
                                    }
                                })(),
                                issues: createdTasks,
                                board_image: (function() {
                                    try {
                                        var src = (previewImg || {}).src || '';
                                        return (src && src.indexOf('data:image') === 0) ? src :
                                            null;
                                    } catch (_) {
                                        return null;
                                    }
                                })()
                            };
                            fetch("{{ route('tasks.store') }}", {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'X-Requested-With': 'XMLHttpRequest'
                                },
                                body: JSON.stringify(payload)
                            }).then(function(res) {
                                return res.json();
                            }).then(function(resp) {
                                if (resp && resp.success) {
                                    try {
                                        var note = document.createElement('div');
                                        note.className = 'position-fixed top-0 end-0 p-3';
                                        note.style.zIndex = '1060';
                                        note.innerHTML =
                                            '<div class="alert alert-success shadow" role="alert" style="border-radius:8px;">Task added</div>';
                                        document.body.appendChild(note);
                                        setTimeout(function() {
                                            try {
                                                note.remove();
                                            } catch (_) {}
                                        }, 1200);
                                    } catch (_) {}
                                    // Reset for next task: clear selections, dates, image, badges
                                    try {
                                        createdTasks = [];
                                        badgeCounter = 0;
                                        currentMarker = null;
                                        // clear badges
                                        var existing = markerLayer?.querySelectorAll(
                                            '.marker-badge') || [];
                                        existing.forEach?.(function(n) {
                                            try {
                                                n.remove();
                                            } catch (_) {}
                                        });
                                        // reset ticket select (keep project as is)
                                        if (ticketSelect) {
                                            try {
                                                ticketSelect.value = '';
                                            } catch (_) {}
                                        }
                                        // reset dates
                                        try {
                                            (startDateSpan || {}).textContent = '--';
                                            (endDateSpan || {}).textContent = '--';
                                        } catch (_) {}
                                        // reset image area
                                        var ut = document.getElementById('uploadText');
                                        var fi = document.getElementById('fileInput');
                                        if (previewImg) {
                                            previewImg.src = '';
                                            previewImg.style.display = 'none';
                                        }
                                        if (ut) {
                                            ut.style.display = 'block';
                                            ut.innerHTML =
                                                'Upload Or Drag<br><small>PDF, JPG, PNG</small>';
                                        }
                                        if (markerLayer) {
                                            markerLayer.style.display = 'none';
                                            markerLayer.innerHTML = '';
                                        }
                                        var mtb = document.getElementById('markerToolbar');
                                        if (mtb) mtb.style.display = 'none';
                                        if (fi) fi.value = '';
                                    } catch (_) {}
                                } else {
                                    alert('Failed to create task');
                                }
                            }).catch(function() {
                                alert('Failed to create task');
                            });
                        } catch (_) {}
                    });
                    createTaskSaveAddBtn._bound = true;
                }
            } catch (_) {}
        });
    </script>

    <script>
        function taskDelete(taskId) {
            try {
                if (!taskId) return;
                var url = "{{ route('tasks.destroy', '__ID__') }}".replace('__ID__', encodeURIComponent(taskId));
                fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                }).then(function(r) {
                    return r.json();
                }).then(function() {
                    window.location.reload();
                }).catch(function() {
                    window.location.reload();
                });
            } catch (_) {
                window.location.reload();
            }
        }
        // Mobile-specific confirm wrapper
        function taskDeleteConfirm(taskId) {
            try {
                if (window.Swal && typeof Swal.fire === 'function') {
                    Swal.fire({
                        title: 'Delete Mobile Task?',
                        text: 'This will remove the task and its issues.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ea5455',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Delete'
                    }).then(function(result) {
                        if (!result.isConfirmed) return;
                        fetch(`{{ url('/tasks') }}/${taskId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        }).then(function(res) {
                            return res.json();
                        }).then(function() {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted',
                                timer: 900,
                                showConfirmButton: false
                            });
                            window.location.reload();
                        });
                    });
                } else {
                    if (!confirm('Delete Mobile Task?')) return;
                    fetch(`{{ url('/tasks') }}/${taskId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    }).then(function(res) {
                        return res.json();
                    }).then(function() {
                        window.location.reload();
                    });
                }
            } catch (_) {
                /* noop */ }
        }

        // Web tasks: dedicated delete hitting webtasks.destroy with its own confirm
        function webTaskDelete(taskId) {
            try {
                var exec = function() {
                    if (!taskId) return;
                    var url = "{{ route('webtasks.destroy', '__ID__') }}".replace('__ID__', encodeURIComponent(
                        taskId));
                    fetch(url, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    }).then(function(r) {
                        return r.json();
                    }).then(function() {
                        window.location.reload();
                    }).catch(function() {
                        window.location.reload();
                    });
                };
                if (window.Swal && typeof Swal.fire === 'function') {
                    Swal.fire({
                        title: 'Delete Web Task?',
                        text: 'This will remove the web task and its issues.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ea5455',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Delete'
                    }).then(function(result) {
                        if (result.isConfirmed) {
                            exec();
                        }
                    });
                } else {
                    if (confirm('Delete Web Task?')) {
                        exec();
                    }
                }
            } catch (_) {
                /* noop */ }
        }

        // Employee tasks: delete with confirm, hitting emptasks.destroy
        function emptaskDelete(taskId) {
            try {
                var exec = function() {
                    if (!taskId) return;
                    var url = "{{ route('emptasks.destroy', '__ID__') }}".replace('__ID__', encodeURIComponent(
                        taskId));
                    fetch(url, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    }).then(function(r) {
                        return r.json();
                    }).then(function() {
                        window.location.reload();
                    }).catch(function() {
                        window.location.reload();
                    });
                };
                if (window.Swal && typeof Swal.fire === 'function') {
                    Swal.fire({
                        title: 'Delete Employee Task?',
                        text: 'This will remove the employee task.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ea5455',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Delete'
                    }).then(function(result) {
                        if (result.isConfirmed) {
                            exec();
                        }
                    });
                } else {
                    if (confirm('Delete Employee Task?')) {
                        exec();
                    }
                }
            } catch (_) {
                /* noop */ }
        }
    </script>







    <!-- createTaskModal Modal -->
    <div class="modal fade" id="createTaskModal" tabindex="-1" aria-hidden="true" data-bs-focus="false">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="border-radius: 12px;">
                <!-- Modal Header -->
                <div class="modal-header d-flex justify-content-between flex-wrap align-items-start"
                    style="background: #fff;border-bottom:none;">
                    <!-- Title + Subtitle -->
                    <div>
                        <h5 class="modal-title mb-0" style="font-weight: 600;">Create new Task</h5>
                        <small class="text-muted">Create Task</small>
                    </div>
                    
                    <!--  -->
                     <div>
                       <!-- <label class="form-label fw-bold mb-0" style="color: #2b2d42;">Ticket Start & Deliver
                                Date</label><br>
                            <small class="text-muted">Tasks must be done in this duration</small> -->
                            <div class="d-flex gap-2 mt-0">
                                <div class="text-center p-2 text-white"
                                    style="background: #28c76f; border-radius: 8px;">
                                    <small>Start Date :</small>
                                    <span id="ticket-start-date" class="fw-bold">--</span>
                                </div>
                                <div class="text-center p-2 text-white"
                                    style="background: #ea5455; border-radius: 8px;">
                                    <small>Deliver Date :</small>
                                    <span id="ticket-end-date" class="fw-bold">--</span>
                                </div>
                            </div>
                             </div>



                </div>


                <!-- Modal Body -->
                <div class="modal-body"  style="padding: 6px 19px;">
                    <!-- Task Tabs -->


                    <!-- Top Controls -->
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            // Employee Task selectors (separate from mobile/web)
                            var etProjectSelect = document.getElementById('et-select-project');
                            var etTicketSelect = document.getElementById('et-select-ticket');
                            var etStartSpan = document.getElementById('et-ticket-start-date');
                            var etEndSpan = document.getElementById('et-ticket-end-date');
                            var etTicketCache = {};

                            function etFormatDate(iso) {
                                if (!iso) return '--';
                                var s = ('' + iso).substring(0, 10);
                                var p = s.split('-');
                                if (p.length !== 3) return '--';
                                return p[2] + ':' + p[1] + ':' + p[0];
                            }

                            function etRenderDates(t) {
                                if (!etStartSpan || !etEndSpan) return;
                                if (!t) {
                                    etStartSpan.textContent = '--';
                                    etEndSpan.textContent = '--';
                                    return;
                                }
                                etStartSpan.textContent = etFormatDate(t.start_date);
                                etEndSpan.textContent = etFormatDate(t.end_date);
                            }

                            function etSetLoading(sel, loading) {
                                if (!sel) return;
                                sel.disabled = !!loading;
                                if (loading) sel.innerHTML = '<option>Loading...</option>';
                            }

                            function etLoadTickets(projectId) {
                                if (!etTicketSelect) return;
                                if (!projectId) {
                                    etTicketSelect.innerHTML = '<option value=\"\">Select the Ticket</option>';
                                    etRenderDates(null);
                                    return;
                                }
                                etSetLoading(etTicketSelect, true);
                                var url = new URL('{{ route('tasks.tickets') }}', window.location.origin);
                                url.searchParams.set('project_id', projectId);
                                fetch(url.toString(), {
                                        headers: {
                                            'X-Requested-With': 'XMLHttpRequest'
                                        }
                                    })
                                    .then(function(r) {
                                        return r.json();
                                    })
                                    .then(function(resp) {
                                        etTicketSelect.innerHTML = '<option value=\"\">Select the Ticket</option>';
                                        var items = (resp && Array.isArray(resp.tickets)) ? resp.tickets : [];
                                        etTicketCache = {};
                                        items.forEach(function(t) {
                                            var opt = document.createElement('option');
                                            opt.value = t.id;
                                            opt.textContent = t.title || 'Untitled';
                                            etTicketSelect.appendChild(opt);
                                            etTicketCache[t.id] = t;
                                        });
                                        etTicketSelect.disabled = false;
                                        etRenderDates(null);
                                    })
                                    .catch(function() {
                                        etTicketSelect.innerHTML = '<option value=\"\">Failed to load tickets</option>';
                                        etTicketSelect.disabled = false;
                                    });
                            }

                            if (etProjectSelect) etProjectSelect.addEventListener('change', function(e) {
                                etLoadTickets(e.target.value);
                            });
                            if (etTicketSelect) etTicketSelect.addEventListener('change', function(e) {
                                var t = etTicketCache[e.target.value];
                                etRenderDates(t || null);
                            });

                            // When Employee Task modal opens, reset ticket list and dates
                            try {
                                var etModal = document.getElementById('emptask');
                                if (etModal) {
                                    etModal.addEventListener('shown.bs.modal', function() {
                                        if (etTicketSelect) {
                                            etTicketSelect.innerHTML = '<option value=\"\">Select the Ticket</option>';
                                            etTicketSelect.disabled = true;
                                        }
                                        etRenderDates(null);
                                    });
                                }
                            } catch (_) {}
                        });
                    </script>
                  


                    <!-- Task Container -->
                    <div class="row">
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                // Employee Task secondary controls (unique IDs: et2-*) - kept separate
                                var et2Project = document.getElementById('et2-select-project');
                                var et2Ticket = document.getElementById('et2-select-ticket');
                                var et2Start = document.getElementById('et2-ticket-start-date');
                                var et2End = document.getElementById('et2-ticket-end-date');
                                var et2Cache = {};
                                try {
                                    window.__etCache = et2Cache;
                                } catch (_) {}

                                function et2Fmt(iso) {
                                    if (!iso) return '--';
                                    var s = ('' + iso).substring(0, 10);
                                    var p = s.split('-');
                                    return (p.length === 3) ? (p[2] + ':' + p[1] + ':' + p[0]) : '--';
                                }

                                function et2Dates(t) {
                                    if (!et2Start || !et2End) return;
                                    if (!t) {
                                        et2Start.textContent = '--';
                                        et2End.textContent = '--';
                                        return;
                                    }
                                    et2Start.textContent = et2Fmt(t.start_date);
                                    et2End.textContent = et2Fmt(t.end_date);
                                }

                                function et2Load(pid) {
                                    if (!et2Ticket) return;
                                    if (!pid) {
                                        et2Ticket.innerHTML = '<option value=\"\">Select the Ticket</option>';
                                        et2Dates(null);
                                        return;
                                    }
                                    et2Ticket.disabled = true;
                                    et2Ticket.innerHTML = '<option>Loading...</option>';
                                    var url = new URL('{{ route('tasks.tickets') }}', window.location.origin);
                                    url.searchParams.set('project_id', pid);
                                    fetch(url.toString(), {
                                            headers: {
                                                'X-Requested-With': 'XMLHttpRequest'
                                            }
                                        })
                                        .then(function(r) {
                                            return r.json();
                                        })
                                        .then(function(resp) {
                                            et2Ticket.innerHTML = '<option value=\"\">Select the Ticket</option>';
                                            var items = (resp && Array.isArray(resp.tickets)) ? resp.tickets : [];
                                            et2Cache = {};
                                            try {
                                                window.__etCache = et2Cache;
                                            } catch (_) {}
                                            items.forEach(function(t) {
                                                var opt = document.createElement('option');
                                                opt.value = t.id;
                                                opt.textContent = t.title || 'Untitled';
                                                et2Ticket.appendChild(opt);
                                                et2Cache[t.id] = t;
                                            });
                                            et2Ticket.disabled = false;
                                            et2Dates(null);
                                        })
                                        .catch(function() {
                                            et2Ticket.innerHTML = '<option value=\"\">Failed to load tickets</option>';
                                            et2Ticket.disabled = false;
                                        });
                                }
                                if (et2Project) et2Project.addEventListener('change', function(e) {
                                    et2Load(e.target.value);
                                });
                                if (et2Ticket) et2Ticket.addEventListener('change', function(e) {
                                    var t = et2Cache[e.target.value];
                                    et2Dates(t || null);
                                });
                                // Initialize if pre-filled
                                try {
                                    if (et2Project && et2Project.value) et2Load(et2Project.value);
                                } catch (_) {}
                            });
                        </script>
                        <!-- Left Upload Area -->
                        <div class="col-md-5">

                            <div id="uploadBox" onclick="document.getElementById('fileInput').click();"
                                ondragover="event.preventDefault(); this.style.borderColor='#28c76f';"
                                ondragleave="this.style.borderColor='#ccc';"
                                ondrop="event.preventDefault(); this.style.borderColor='#ccc'; var dtFile=(event.dataTransfer&&event.dataTransfer.files&&event.dataTransfer.files[0])||null; if(!dtFile) return; var input=document.getElementById('fileInput'); try{var dT=new DataTransfer(); dT.items.add(dtFile); input.files=dT.files;}catch(_){ } if(dtFile.type.startsWith('image/')){ var reader=new FileReader(); reader.onload=function(e){ var previewImg=document.getElementById('previewImage'); var text=document.getElementById('uploadText'); var markerLayer=document.getElementById('markerLayer'); var markerToolbar=document.getElementById('markerToolbar'); previewImg.src=e.target.result; previewImg.style.display='block'; text.style.display='none'; if(markerLayer){ markerLayer.style.display='block'; } if(markerToolbar){ markerToolbar.style.display='flex'; } }; reader.readAsDataURL(dtFile); } else { var previewImg=document.getElementById('previewImage'); var text=document.getElementById('uploadText'); var markerLayer=document.getElementById('markerLayer'); var markerToolbar=document.getElementById('markerToolbar'); previewImg.style.display='none'; text.innerHTML='📄 ' + dtFile.name; if(markerLayer){ markerLayer.style.display='none'; } if(markerToolbar){ markerToolbar.style.display='none'; } }"
                                style="background-color: #f7f7f7;
      height: 100%;
      min-height: 250px;
      cursor: pointer;
      border: 2px dashed #ccc;
      border-radius: 10px;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      flex-direction: column;
      position: relative;
    ">
                                <p id="uploadText" class="text-muted m-0">
                                    Upload Or Drag<br><small>PDF, JPG, PNG</small>
                                </p>
                                <img id="previewImage" src=""
                                    style="display:none; position:absolute; inset:10px; width:calc(100% - 20px); height:calc(100% - 20px); " />
                                <div id="markerLayer"
                                    style="display:none; position:absolute; inset:10px; pointer-events:auto;"
                                    ondragover="event.preventDefault();"
                                    ondrop="event.preventDefault(); var dtFile=(event.dataTransfer&&event.dataTransfer.files&&event.dataTransfer.files[0])||null; if(!dtFile) return; var input=document.getElementById('fileInput'); try{var dT=new DataTransfer(); dT.items.add(dtFile); input.files=dT.files;}catch(_){ } if(dtFile.type.startsWith('image/')){ var reader=new FileReader(); reader.onload=function(e){ var previewImg=document.getElementById('previewImage'); var text=document.getElementById('uploadText'); var markerLayer=document.getElementById('markerLayer'); var markerToolbar=document.getElementById('markerToolbar'); previewImg.src=e.target.result; previewImg.style.display='block'; if(text){ text.style.display='none'; } if(markerLayer){ markerLayer.style.display='block'; } if(markerToolbar){ markerToolbar.style.display='flex'; } }; reader.readAsDataURL(dtFile); } else { var previewImg=document.getElementById('previewImage'); var text=document.getElementById('uploadText'); var markerToolbar=document.getElementById('markerToolbar'); if(previewImg){ previewImg.style.display='none'; } if(text){ text.innerHTML='📄 ' + dtFile.name; } var ml=document.getElementById('markerLayer'); if(ml){ ml.style.display='none'; } if(markerToolbar){ markerToolbar.style.display='none'; } }">
                                </div>
                                <div id="markerToolbar"
                                    style="display:none; position:absolute; top:10px; left:10px; z-index:11; gap:6px; background:#ffffff; padding:6px; border-radius:10px; box-shadow:0 2px 8px rgba(0,0,0,0.08);">
                                    <button id="marker-shape-square" type="button" class="btn btn-sm"
                                        style="background:transparent; border:0; width:34px; height:34px; border-radius:8px; display:flex; align-items:center; justify-content:center;">
                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <rect x="5" y="5" width="14" height="14" rx="2"
                                                fill="none" stroke="#1f2a57" stroke-width="2" />
                                            <circle cx="5" cy="5" r="2" fill="#1f2a57" />
                                            <circle cx="19" cy="5" r="2" fill="#1f2a57" />
                                            <circle cx="5" cy="19" r="2" fill="#1f2a57" />
                                            <circle cx="19" cy="19" r="2" fill="#1f2a57" />
                                        </svg>
                                    </button>
                                    <button id="marker-shape-circle" type="button" class="btn btn-sm"
                                        style="background:transparent; border:0; width:34px; height:34px; border-radius:8px; display:flex; align-items:center; justify-content:center;">
                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <circle cx="12" cy="12" r="8" fill="none"
                                                stroke="#1f2a57" stroke-width="2" />
                                            <path d="M15 6 A8 8 0 0 1 18 12" fill="none" stroke="#8fa3bf"
                                                stroke-linecap="round" stroke-width="2" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Hidden file input -->
                            <input type="file" id="fileInput" accept=".jpg,.jpeg,.png,.pdf" style="display:none;"
                                onchange="
      var file = this.files[0];
      var previewImg = document.getElementById('previewImage');
      var text = document.getElementById('uploadText');
      var markerLayer = document.getElementById('markerLayer');
      var markerToolbar = document.getElementById('markerToolbar');

      if (!file) return;

      if (file.type.startsWith('image/')) {
        var reader = new FileReader();
        reader.onload = function(e) {
          previewImg.src = e.target.result;
          previewImg.style.display = 'block';
          text.style.display = 'none';
          markerLayer.style.display = 'block';
          if (markerToolbar) markerToolbar.style.display = 'flex';
          // Removed auto-persist to server to avoid 404 GET on preview
        };
        reader.readAsDataURL(file);
      } else {
        previewImg.style.display = 'none';
        text.innerHTML = '📄 ' + file.name;
        markerLayer.style.display = 'none';
        if (markerToolbar) markerToolbar.style.display = 'none';
      }
    " />
                        </div>


                        <!-- Right Task List -->
                        <div class="col-md-7" >
                            <div class="mt-1 mb-2" style="background-color:#F7F7FF;border-radius:10px;padding:6px;">
                            <label class="form-label fw-bold mb-0" style="color: #2b2d42;">Ticket Details</label><br>
                            <small class="text-muted">Ticket Details</small>
                            <div class="d-flex gap-2 mt-2">
                                <select id="select-project" name="project_id" class="form-select form-select-sm"
                                    style="background: #fff; border-radius: 8px;">
                                    <option value="">Select the Project</option>
                                    @if (isset($projects) && count($projects))
                                        @foreach ($projects as $project)
                                            <option value="{{ (string) ($project->_id ?? $project->id) }}">
                                                {{ $project->title }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <select id="select-ticket" name="ticket_id" class="form-select form-select-sm"
                                    style="background: #fff; border-radius: 8px;">
                                    <option value="">Select the Ticket</option>
                                </select>
                            </div>
                        </div>
                            <div style="border: 3px solid #f7f7f7;margin-top:12px;padding:6px;border-radius:12px;">
                                <div class="d-flex justify-content-between align-items-start mb-2" style="border-bottom:2px solid #ECECEC">
                                    <!-- Left Side: Title + Subtitle -->
                                    <div>
                                        <div class="fw-bold" style="color: #2b2d42;">Project Title Task</div>
                                        <small class="text-muted">Total Task: 5 – Total Checkpoint: 20</small>
                                    </div>

                                    <!-- Right Side: Red note -->
                                    <div style="color: #ea5455; font-size: 12px;">
                                        Max. 4 Tasks each Ticket
                                    </div>
                                </div>


                                <!-- Task Cards -->
                                @foreach ($tasks ?? [] as $task)
                                    @php
                                        $logo = optional($task->project)->logo_path
                                            ? asset('storage/' . ltrim(optional($task->project)->logo_path, '/'))
                                            : asset('build/img/yekbon.svg');
                                        $thumb = !empty($task->board_image_path)
                                            ? asset('storage/' . ltrim($task->board_image_path, '/'))
                                            : (!empty($task->mark_image_path)
                                                ? asset('storage/' . ltrim($task->mark_image_path, '/'))
                                                : asset('build/img/dooted img.svg'));
                                        $viewerImg = !empty($task->board_image_path)
                                            ? asset('storage/' . ltrim($task->board_image_path, '/'))
                                            : (!empty($task->mark_image_path)
                                                ? asset('storage/' . ltrim($task->mark_image_path, '/'))
                                                : asset('build/img/dooted img.svg'));
                                    @endphp
                                    <div class="d-flex p-2 rounded mt-2 task-card"
                                        style="background:#ebebeb; border:1px solid #e9ecef; box-shadow:0 2px 8px rgba(0,0,0,.04); cursor:pointer; align-items:center; gap:8px;"
                                        data-board="{{ $viewerImg }}" data-issues='@json($task->issues ?? [])'
                                        data-title="{{ e($task->title) }}"
                                        data-project-id="{{ (string) ($task->project_id ?? (optional($task->project)->_id ?? optional($task->project)->id)) }}"
                                        data-ticket-id="{{ (string) ($task->ticket_id ?? (optional($task->ticket)->_id ?? optional($task->ticket)->id)) }}"
                                        data-project-title="{{ e(optional($task->project)->title ?? '') }}"
                                        data-project-logo="{{ $logo }}"
                                        data-ticket-code="{{ e(optional($task->ticket)->code ?? '') }}"
                                        data-ticket-title="{{ e(optional($task->ticket)->title ?? '') }}"
                                        data-task-id="{{ 'TSK-' . str_pad((string) (1000 + $loop->iteration), 4, '0', STR_PAD_LEFT) }}"
                                        data-section="{{ e(optional($task->ticket)->section_name ?? 'Section') }}"
                                        data-start="{{ optional($task->ticket)->start_date ? \Carbon\Carbon::parse(optional($task->ticket)->start_date)->toDateString() : ($task->start_date ? \Carbon\Carbon::parse($task->start_date)->toDateString() : '') }}"
                                        data-deliver="{{ optional($task->ticket)->end_date ? \Carbon\Carbon::parse(optional($task->ticket)->end_date)->toDateString() : ($task->end_date ? \Carbon\Carbon::parse($task->end_date)->toDateString() : '') }}"
                                        onclick="openTaskViewer(this)">
                                        <div class="me-2">
                                            <img src="{{ $thumb }}" alt="Task Image"
                                                style="width: 100px; height: 100px; border-radius: 8px;   background: transparent; border: none; padding: 0; display:block;">
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div
                                                    style="font-weight: 600; font-size: 14px; display: flex; align-items: center;">
                                                    <img src="{{ $logo }}" alt=""
                                                        style="width: 30px; height: 30px; margin-right: 6px;">
                                                    {{ $task->title }}
                                                </div>
                                                <div class="d-flex align-items-center gap-2"
                                                    style="position: relative;">
                                                    <button
                                                        onclick="event.stopPropagation(); var menu = this.nextElementSibling; menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';"
                                                        style="width: 32px; height: 32px; border-radius: 50%; border: 1px solid #a5acc5; background-color: #f9f9f9; display: flex; align-items: center; justify-content: center; padding: 0;">
                                                        <span
                                                            style="font-size: 18px; color: #2b2d42;">&#x2022;&#x2022;&#x2022;</span>
                                                    </button>
                                                    <div class="menu-box"
                                                        style="display: none; background: #fff; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); padding: 8px 10px; width: 80px; text-align: center; position: absolute; top: 100%; right: 0; z-index: 1000;"
                                                        onclick="event.stopPropagation();">
                                                        <div
                                                            style="font-size: 12px; color: #7a7a9d; font-weight: 600; margin-bottom: 6px;">
                                                            Options</div>
                                                        <div
                                                            style="display: flex; justify-content: center; align-items: center; gap: 10px;">
                                                            <img src="{{ URL::asset('/build/img/delete1.svg') }}"
                                                                alt="Delete"
                                                                style="width: 20px; height: 20px; cursor: pointer;"
                                                                onclick="taskDeleteConfirm('{{ (string) ($task->_id ?? $task->id) }}')">
                                                            <img src="{{ URL::asset('/build/img/Edit1.svg') }}"
                                                                alt="Edit"
                                                                style="width: 20px; height: 20px; cursor: pointer;"
                                                                onclick="event.stopPropagation(); taskEdit('{{ (string) ($task->_id ?? $task->id) }}')">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="font-size: 12px; color: #6c757d;">
                                                {{ optional($task->ticket)->code ? optional($task->ticket)->code . ' - ' : '' }}{{ optional($task->ticket)->title ?? 'Ticket' }}
                                            </div>
                                            <div style="font-size: 13px; margin-top: 2px;">
                                                {{ optional($task->ticket)->description ?? '-' }}</div>
                                            <div class="d-flex justify-content-between mt-2 flex-nowrap"
                                                style="background-color: #fff; border-radius: 10px; padding: 4px;">
                                                <div
                                                    style="font-size: 14px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                    <small>Start:
                                                        {{ optional($task->ticket)->start_date ? \Carbon\Carbon::parse(optional($task->ticket)->start_date)->format('d.m.Y') : ($task->start_date ? \Carbon\Carbon::parse($task->start_date)->format('d.m.Y') : '--') }}</small>
                                                </div>
                                                <div
                                                    style="font-size: 14px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                    <small>Deliver:
                                                        {{ optional($task->ticket)->end_date ? \Carbon\Carbon::parse(optional($task->ticket)->end_date)->format('d.m.Y') : ($task->end_date ? \Carbon\Carbon::parse($task->end_date)->format('d.m.Y') : '--') }}</small>
                                                </div>
                                                <div class="d-flex align-items-center"
                                                    style="font-size: 11px; background-color: #ff4d4f; color: white; padding: 2px 6px; border-radius: 6px;">
                                                    <img src="https://img.icons8.com/ios-filled/16/ffffff/flash-on.png"
                                                        alt="Urgent" style="margin-right: 4px;">
                                                    {{ str_pad((string) ($task->number ?? $loop->iteration), 2, '0', STR_PAD_LEFT) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <!-- 2 -->


                              

                            </div>
                              <!-- Add Task -->
                                <!-- Hidden File Input -->
                                <input type="file" id="addTaskFileInput" style="display: none;"
                                    onchange="document.getElementById('addTaskBox').innerText = '+ ' + this.files[0].name">

                                <!-- Clickable Box -->
                                <div id="addTaskBox" class="border border-dashed p-2 text-center rounded"
                                   style="cursor: pointer; margin:5px; height:60px;display:flex; align-items:center; justify-content:center;background:#ECECEC80"
                                    onclick="document.getElementById('addTaskFileInput').click();">
                                    + Add new Task
                                </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer d-flex justify-content-between" style="border-top:none;">
                    <!-- Save and Close (Green) -->
                    <button id="create-task-save" type="button" class="btn text-white"
                        style="background-color: #28c76f; border-radius: 6px;" data-bs-dismiss="modal">
                        Save and Close
                    </button>

                    <!-- Save & add Task (Orange) -->
                    <button id="create-task-save-add" type="button" class="btn text-white"
                        style="background-color: #f98f3e; border-radius: 6px;">
                        Save & add Task
                    </button>
                </div>

            </div>
        </div>
    </div>
    <!--create web modale -->
    <div class="modal fade" id="webtask" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="border-radius: 12px;">
                <!-- Modal Header -->
                <div class="modal-header d-flex justify-content-between flex-wrap align-items-start"
                    style="background: #fff;">
                    <!-- Title + Subtitle -->
                    <div>
                        <h5 class="modal-title mb-0" style="font-weight: 600;">Create new Task</h5>
                        <small class="text-muted">Create a Task</small>
                    </div>

                    <!-- Task Type Buttons -->
                    <div class="d-flex gap-2 p-1 rounded" style="background: #f2f2f2; border-radius: 10px;">

                        <button id="task2-btn-mobile" class="btn btn-sm"
                            style="background-color: #28c76f; color: white;"
                            onclick="
            document.getElementById('task2-btn-mobile').style.backgroundColor = '#28c76f';
            document.getElementById('task2-btn-mobile').style.color = 'white';
            document.getElementById('task2-btn-web').style.backgroundColor = 'transparent';
            document.getElementById('task2-btn-web').style.color = '#6c757d';
            document.getElementById('task2-btn-employee').style.backgroundColor = 'transparent';
            document.getElementById('task2-btn-employee').style.color = '#6c757d';
        ">
                            Mobile Task
                        </button>

                        <button id="task2-btn-web" class="btn btn-sm"
                            style="background-color: transparent; color: #6c757d;"
                            onclick="
            document.getElementById('task2-btn-web').style.backgroundColor = '#28c76f';
            document.getElementById('task2-btn-web').style.color = 'white';
            document.getElementById('task2-btn-mobile').style.backgroundColor = 'transparent';
            document.getElementById('task2-btn-mobile').style.color = '#6c757d';
            document.getElementById('task2-btn-employee').style.backgroundColor = 'transparent';
            document.getElementById('task2-btn-employee').style.color = '#6c757d';
        ">
                            Web Task
                        </button>

                        <button id="task2-btn-employee" class="btn btn-sm"
                            style="background-color: transparent; color: #6c757d;"
                            onclick="
            document.getElementById('task2-btn-employee').style.backgroundColor = '#28c76f';
            document.getElementById('task2-btn-employee').style.color = 'white';
            document.getElementById('task2-btn-mobile').style.backgroundColor = 'transparent';
            document.getElementById('task2-btn-mobile').style.color = '#6c757d';
            document.getElementById('task2-btn-web').style.backgroundColor = 'transparent';
            document.getElementById('task2-btn-web').style.color = '#6c757d';
        ">
                            Employee Task
                        </button>
                    </div>


                    <!-- Close Button -->

                </div>


                <!-- Modal Body -->
                <div class="modal-body">
                    <!-- Task Tabs -->


                    <!-- Top Controls -->
                    <div class="row mb-3" style="background: #f9f9f9; padding: 15px; border-radius: 12px;">
                        <!-- Left: Ticket Details -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold mb-0" style="color: #2b2d42;">Ticket Details</label><br>
                            <small class="text-muted">Ticket Details</small>
                            <div class="d-flex gap-2 mt-2">
                                <select id="et-select-project" class="form-select form-select-sm"
                                    style="background: #fff; border-radius: 8px;">
                                    <option value="">Select the Project</option>
                                    @if (isset($projects) && count($projects))
                                        @foreach ($projects as $project)
                                            <option value="{{ (string) ($project->_id ?? $project->id) }}">
                                                {{ $project->title }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <select id="et-select-ticket" class="form-select form-select-sm"
                                    style="background: #fff; border-radius: 8px;">
                                    <option value="">Select the Ticket</option>
                                </select>
                            </div>
                        </div>

                        <!-- Right: Start & Delivery Dates -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold mb-0" style="color: #2b2d42;">Ticket Start & Deliver
                                Date</label><br>
                            <small class="text-muted">Tasks must be done in this duration</small>
                            <div class="d-flex gap-2 mt-2">
                                <div class="text-center p-2 text-white"
                                    style="background: #28c76f; border-radius: 8px; flex: 1;">
                                    <small>Start Date :</small><br>
                                    <span id="et-ticket-start-date" class="fw-bold">--</span>
                                </div>
                                <div class="text-center p-2 text-white"
                                    style="background: #ea5455; border-radius: 8px; flex: 1;">
                                    <small>Deliver Date :</small><br>
                                    <span id="et-ticket-end-date" class="fw-bold">--</span>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Task Container -->
                    <div class="row">
                        <!-- Left Upload Area -->
                        <div class="col-md-5">
                            <div id="web-uploadBox" onclick="document.getElementById('web-fileInput').click();"
                                ondragover="event.preventDefault(); this.style.borderColor='#28c76f';"
                                ondragleave="this.style.borderColor='#ccc';"
                                ondrop="event.preventDefault(); this.style.borderColor='#ccc'; var dtFile=(event.dataTransfer&&event.dataTransfer.files&&event.dataTransfer.files[0])||null; if(!dtFile) return; var input=document.getElementById('web-fileInput'); try{var dT=new DataTransfer(); dT.items.add(dtFile); input.files=dT.files;}catch(_){ } if(dtFile.type.startsWith('image/')){ var reader=new FileReader(); reader.onload=function(e){ var previewImg=document.getElementById('web-previewImage'); var text=document.getElementById('web-uploadText'); previewImg.src=e.target.result; previewImg.style.display='block'; text.style.display='none'; }; reader.readAsDataURL(dtFile); } else { var previewImg=document.getElementById('web-previewImage'); var text=document.getElementById('web-uploadText'); previewImg.style.display='none'; text.innerHTML='📄 ' + dtFile.name; }"
                                style="background-color: #f7f7f7;
      height: 100%;
      min-height: 250px;
      cursor: pointer;
      border: 2px dashed #ccc;
      border-radius: 10px;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      flex-direction: column;
      position: relative;
    ">
                                <p id="web-uploadText" class="text-muted m-0">
                                    Upload Or Drag<br><small>PDF, JPG, PNG</small>
                                </p>
                                <img id="web-previewImage" src=""
                                    style="display:none; max-width:100%; max-height:200px; margin-top:10px;" />
                            </div>

                            <!-- Hidden file input -->
                            <input type="file" id="web-fileInput" accept=".jpg,.jpeg,.png,.pdf"
                                style="display:none;"
                                onchange="
      var file = this.files[0];
      var previewImg = document.getElementById('web-previewImage');
      var text = document.getElementById('web-uploadText');

      if (!file) return;

      if (file.type.startsWith('image/')) {
        var reader = new FileReader();
        reader.onload = function(e) {
          previewImg.src = e.target.result;
          previewImg.style.display = 'block';
          text.style.display = 'none';
        };
        reader.readAsDataURL(file);
      } else {
        previewImg.style.display = 'none';
        text.innerHTML = '📄 ' + file.name;
      }
    " />
                        </div>


                        <!-- Right Task List -->
                        <div class="col-md-7" style="border: 3px solid #f7f7f7;">
                            <div>
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <!-- Left Side: Title + Subtitle -->
                                    <div>
                                        <div class="fw-bold" style="color: #2b2d42;">Project Title Task</div>
                                        <small class="text-muted">Total Task: 5 – Total Checkpoint: 20</small>
                                    </div>

                                    <!-- Right Side: Red note -->
                                    <div style="color: #ea5455; font-size: 12px;">
                                        Max. 4 Tasks each Ticket
                                    </div>
                                </div>


                                <!-- Task Cards -->
                                <div class="d-flex p-2 rounded mt-2" style="background-color: #ebebeb;">

                                    <!-- Task Image -->
                                    <div class="me-2">
                                        <img src="{{ asset('build/img/dooted img.svg') }}" alt="Task Image"
                                            style="width: 100px; height: 100px; border-radius: 8px; object-fit: contain; background: transparent; border: none; padding: 0; display:block;">
                                    </div>

                                    <!-- Task Content -->
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div
                                                style="font-weight: 600; font-size: 14px; display: flex; align-items: center;">
                                                <img src="{{ asset('build/img/yekbon.svg') }}" alt=""
                                                    style="width: 30px; height: 30px; margin-right: 6px;">
                                                Task Title
                                            </div>
                                            <div class="d-flex align-items-center gap-2" style="position: relative;">
                                                <button
                                                    onclick="event.stopPropagation(); var menu = this.nextElementSibling; menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';"
                                                    style="width: 32px; height: 32px; border-radius: 50%; border: 1px solid #a5acc5; background-color: #f9f9f9; display: flex; align-items: center; justify-content: center; padding: 0;">
                                                    <span
                                                        style="font-size: 18px; color: #2b2d42;">&#x2022;&#x2022;&#x2022;</span>
                                                </button>

                                                <div class="menu-box"
                                                    style="display: none; background: #fff; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); padding: 8px 10px; width: 80px; text-align: center; position: absolute; top: 100%; right: 0; z-index: 1000;"
                                                    onclick="event.stopPropagation();">

                                                    <!-- Optional small title -->
                                                    <div
                                                        style="font-size: 12px; color: #7a7a9d; font-weight: 600; margin-bottom: 6px;">
                                                        Options</div>

                                                    <!-- Icons row -->
                                                    <div
                                                        style="display: flex; justify-content: center; align-items: center; gap: 10px;">
                                                        <img src="{{ URL::asset('/build/img/delete1.svg') }}"
                                                            alt="Delete"
                                                            style="width: 20px; height: 20px; cursor: default;"
                                                            onclick="return false;">

                                                        <img src="{{ URL::asset('/build/img/Edit1.svg') }}"
                                                            alt="Edit"
                                                            style="width: 20px; height: 20px; cursor: default; opacity:.4;">


                                                    </div>
                                                </div>
                                            </div>


                                        </div>

                                        <!-- Sub Text -->
                                        <div style="font-size: 12px; color: #6c757d;">Ticket #1 - Ticket Title</div>

                                        <!-- Description -->
                                        <div style="font-size: 13px; margin-top: 2px;">Task description will be here</div>

                                        <!-- Dates & Badge Row -->
                                        <div class="d-flex justify-content-between mt-2 flex-nowrap"
                                            style="background-color: #fff; border-radius: 10px; padding: 4px;">
                                            <div
                                                style="font-size: 14px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                <small>Start: 22.10.2024</small>
                                            </div>

                                            <div
                                                style="font-size: 14px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                <small>Deliver: 22.10.2024</small>
                                            </div>

                                            <!-- Deadline/Warning -->
                                            <div class="d-flex align-items-center"
                                                style="font-size: 11px; background-color: #ff4d4f; color: white; padding: 2px 6px; border-radius: 6px;">
                                                <img src="https://img.icons8.com/ios-filled/16/ffffff/flash-on.png"
                                                    alt="Urgent" style="margin-right: 4px;">
                                                01
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- 2 -->
                                <div class="d-flex p-2 rounded mt-2" style="background-color: #ebebeb;">

                                    <!-- Task Image -->
                                    <div class="me-2">
                                        <img src="{{ asset('build/img/dooted img.svg') }}" alt="Task Image"
                                            style="width: 100px; height: 100px; border-radius: 8px; object-fit: contain; background: transparent; border: none; padding: 0; display:block;">
                                    </div>

                                    <!-- Task Content -->
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div
                                                style="font-weight: 600; font-size: 14px; display: flex; align-items: center;">
                                                <img src="{{ asset('build/img/yekbon.svg') }}" alt=""
                                                    style="width: 30px; height: 30px; margin-right: 6px;">
                                                Task Title
                                            </div>
                                            <div class="d-flex align-items-center gap-2" style="position: relative;">
                                                <button
                                                    onclick="event.stopPropagation(); var menu = this.nextElementSibling; menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';"
                                                    style="width: 32px; height: 32px; border-radius: 50%; border: 1px solid #a5acc5; background-color: #f9f9f9; display: flex; align-items: center; justify-content: center; padding: 0;">
                                                    <span
                                                        style="font-size: 18px; color: #2b2d42;">&#x2022;&#x2022;&#x2022;</span>
                                                </button>
                                                <div class="menu-box"
                                                    style="display: none; background: #fff; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); padding: 8px 10px; width: 80px; text-align: center; position: absolute; top: 100%; right: 0; z-index: 1000;"
                                                    onclick="event.stopPropagation();">

                                                    <!-- Optional small title -->
                                                    <div
                                                        style="font-size: 12px; color: #7a7a9d; font-weight: 600; margin-bottom: 6px;">
                                                        Options</div>

                                                    <!-- Icons row -->
                                                    <div
                                                        style="display: flex; justify-content: center; align-items: center; gap: 10px;">
                                                        <img src="{{ URL::asset('/build/img/delete1.svg') }}"
                                                            alt="Delete"
                                                            style="width: 20px; height: 20px; cursor: default;"
                                                            onclick="return false;">

                                                        <img src="{{ URL::asset('/build/img/Edit1.svg') }}"
                                                            alt="Edit"
                                                            style="width: 20px; height: 20px; cursor: default; opacity:.4;">


                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Sub Text -->
                                        <div style="font-size: 12px; color: #6c757d;">Ticket #1 - Ticket Title</div>

                                        <!-- Description -->
                                        <div style="font-size: 13px; margin-top: 2px;">Task description will be here</div>

                                        <!-- Dates & Badge Row -->
                                        <div class="d-flex justify-content-between mt-2 flex-nowrap"
                                            style="background-color: #fff; border-radius: 10px; padding: 4px;">
                                            <div
                                                style="font-size: 14px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                <small>Start: 22.10.2024</small>
                                            </div>

                                            <div
                                                style="font-size: 14px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                <small>Deliver: 22.10.2024</small>
                                            </div>

                                            <!-- Deadline/Warning -->
                                            <div class="d-flex align-items-center"
                                                style="font-size: 11px; background-color: #ff4d4f; color: white; padding: 2px 6px; border-radius: 6px;">
                                                <img src="https://img.icons8.com/ios-filled/16/ffffff/flash-on.png"
                                                    alt="Urgent" style="margin-right: 4px;">
                                                01
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- 3 -->
                                <div class="d-flex p-2 rounded mt-2" style="background-color: #ebebeb;">

                                    <!-- Task Image -->
                                    <div class="me-2">
                                        <img src="{{ asset('build/img/dooted img.svg') }}" alt="Task Image"
                                            style="width: 100px; height: 100px; border-radius: 8px; object-fit: contain; background: transparent; border: none; padding: 0; display:block;">
                                    </div>

                                    <!-- Task Content -->
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div
                                                style="font-weight: 600; font-size: 14px; display: flex; align-items: center;">
                                                <img src="{{ asset('build/img/yekbon.svg') }}" alt=""
                                                    style="width: 30px; height: 30px; margin-right: 6px;">
                                                Task Title
                                            </div>
                                            <div class="d-flex align-items-center gap-2" style="position: relative;">
                                                <button
                                                    onclick="event.stopPropagation(); var menu = this.nextElementSibling; menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';"
                                                    style="width: 32px; height: 32px; border-radius: 50%; border: 1px solid #a5acc5; background-color: #f9f9f9; display: flex; align-items: center; justify-content: center; padding: 0;">
                                                    <span
                                                        style="font-size: 18px; color: #2b2d42;">&#x2022;&#x2022;&#x2022;</span>
                                                </button>

                                                <div class="menu-box"
                                                    style="display: none; background: #fff; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); padding: 8px 10px; width: 80px; text-align: center; position: absolute; top: 100%; right: 0; z-index: 1000;"
                                                    onclick="event.stopPropagation();">

                                                    <!-- Optional small title -->
                                                    <div
                                                        style="font-size: 12px; color: #7a7a9d; font-weight: 600; margin-bottom: 6px;">
                                                        Options</div>

                                                    <!-- Icons row -->
                                                    <div
                                                        style="display: flex; justify-content: center; align-items: center; gap: 10px;">
                                                        <img src="{{ URL::asset('/build/img/delete1.svg') }}"
                                                            alt="Delete"
                                                            style="width: 20px; height: 20px; cursor: default;"
                                                            onclick="return false;">

                                                        <img src="{{ URL::asset('/build/img/Edit1.svg') }}"
                                                            alt="Edit"
                                                            style="width: 20px; height: 20px; cursor: default; opacity:.4;">


                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <!-- Sub Text -->
                                        <div style="font-size: 12px; color: #6c757d;">Ticket #1 - Ticket Title</div>

                                        <!-- Description -->
                                        <div style="font-size: 13px; margin-top: 2px;">Task description will be here</div>

                                        <!-- Dates & Badge Row -->
                                        <div class="d-flex justify-content-between mt-2 flex-nowrap"
                                            style="background-color: #fff; border-radius: 10px; padding: 4px;">
                                            <div
                                                style="font-size: 14px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                <small>Start: 22.10.2024</small>
                                            </div>

                                            <div
                                                style="font-size: 14px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                <small>Deliver: 22.10.2024</small>
                                            </div>

                                            <!-- Deadline/Warning -->
                                            <div class="d-flex align-items-center"
                                                style="font-size: 11px; background-color: #ff4d4f; color: white; padding: 2px 6px; border-radius: 6px;">
                                                <img src="https://img.icons8.com/ios-filled/16/ffffff/flash-on.png"
                                                    alt="Urgent" style="margin-right: 4px;">
                                                01
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Add Task -->
                                <!-- Hidden File Input -->
                                <input type="file" id="web-addFileInput" style="display: none;"
                                    onchange="document.getElementById('web-addTaskBox').innerText = '+ ' + this.files[0].name">

                                <!-- Clickable Box -->
                                <div id="web-addTaskBox" class="border border-dashed p-2 text-center rounded"
                                    style="cursor: pointer;"
                                    onclick="document.getElementById('web-addFileInput').click();">
                                    + Add new Task
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer d-flex justify-content-between">
                    <!-- Save and Close (Green) -->
                    <button type="button" class="btn text-white"
                        style="background-color: #28c76f; border-radius: 6px;" data-bs-dismiss="modal">
                        Save and Close
                    </button>

                    <!-- Save & add Task (Orange) -->
                    <button type="button" class="btn text-white"
                        style="background-color: #f98f3e; border-radius: 6px;" data-bs-dismiss="modal">
                        Save & add Task
                    </button>
                </div>

            </div>
        </div>
    </div>
    <!-- Web Task (functional clone) -->
    <div class="modal fade" id="webtask2" tabindex="-1" aria-hidden="true" data-bs-focus="false">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="border-radius: 12px;">
               <div class="modal-header d-flex justify-content-between align-items-start flex-wrap" style="background:#fff;border-bottom:none;">

    <!-- LEFT SECTION -->
    <div class="mb-2">
        <h5 class="modal-title mb-0" style="font-weight: 600;">Create new Web Task</h5>
        <small class="text-muted">Create Task</small>
    </div>


    <!-- RIGHT SECTION -->
    <div >
    

        <div class="d-flex gap-2 mt-0">
            <div class="text-center p-2 text-white"
                style="background: #28c76f; border-radius: 8px;">
                <small>Start Date</small>
                <span id="wt-ticket-start-date" class="fw-bold">--</span>
            </div>

            <div class="text-center p-2 text-white"
                style="background: #ea5455; border-radius: 8px;">
                <small>Deliver Date</small>
                <span id="wt-ticket-end-date" class="fw-bold">--</span>
            </div>
        </div>
    </div>
     
</div>

                <div class="modal-body"  style="padding: 6px 19px;">
                   

                    <div class="row">
                        <div class="col-md-5">
                            <div id="wt-uploadBox" onclick="document.getElementById('wt-fileInput').click();"
                                ondragover="event.preventDefault(); this.style.borderColor='#28c76f';"
                                ondragleave="this.style.borderColor='#ccc';"
                                ondrop="event.preventDefault(); this.style.borderColor='#ccc'; var dtFile=(event.dataTransfer&&event.dataTransfer.files&&event.dataTransfer.files[0])||null; if(!dtFile) return; var input=document.getElementById('wt-fileInput'); try{var dT=new DataTransfer(); dT.items.add(dtFile); input.files=dT.files;}catch(_){ } if(dtFile.type.startsWith('image/')){ var reader=new FileReader(); reader.onload=function(e){ var previewImg=document.getElementById('wt-previewImage'); var text=document.getElementById('wt-uploadText'); var layer=document.getElementById('wt-markerLayer'); var tb=document.getElementById('wt-markerToolbar'); previewImg.src=e.target.result; previewImg.style.display='block'; text.style.display='none'; if(layer){ layer.style.display='block'; } if(tb){ tb.style.display='flex'; } }; reader.readAsDataURL(dtFile); } else { var previewImg=document.getElementById('wt-previewImage'); var text=document.getElementById('wt-uploadText'); var layer=document.getElementById('wt-markerLayer'); var tb=document.getElementById('wt-markerToolbar'); previewImg.style.display='none'; text.innerHTML='📄 ' + dtFile.name; if(layer){ layer.style.display='none'; } if(tb){ tb.style.display='none'; } }"
                                style="background-color: #f7f7f7; height: 100%; min-height: 250px; cursor: pointer; border: 2px dashed #ccc; border-radius: 10px; display: flex; justify-content: center; align-items: center; text-align: center; flex-direction: column; position: relative;">
                                <p id="wt-uploadText" class="text-muted m-0">Upload Or Drag<br><small>PDF, JPG,
                                        PNG</small></p>
                                <img id="wt-previewImage" src=""
                                    style="display:none; position:absolute; inset:10px; width:calc(100% - 20px); height:calc(100% - 20px);  " />
                                <div id="wt-markerLayer"
                                    style="display:none; position:absolute; inset:10px; pointer-events:auto;"></div>
                                <div id="wt-markerToolbar"
                                    style="display:none; position:absolute; top:10px; left:10px; z-index:11; gap:6px; background:#ffffff; padding:6px; border-radius:10px; box-shadow:0 2px 8px rgba(0,0,0,0.08);">
                                    <button id="wt-marker-shape-square" type="button" class="btn btn-sm"
                                        style="background:transparent; border:0; width:34px; height:34px; border-radius:8px; display:flex; align-items:center; justify-content:center;">
                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <rect x="5" y="5" width="14" height="14" rx="2"
                                                fill="none" stroke="#1f2a57" stroke-width="2" />
                                            <circle cx="5" cy="5" r="2" fill="#1f2a57" />
                                            <circle cx="19" cy="5" r="2" fill="#1f2a57" />
                                            <circle cx="5" cy="19" r="2" fill="#1f2a57" />
                                            <circle cx="19" cy="19" r="2" fill="#1f2a57" />
                                        </svg>
                                    </button>
                                    <button id="wt-marker-shape-circle" type="button" class="btn btn-sm"
                                        style="background:transparent; border:0; width:34px; height:34px; border-radius:8px; display:flex; align-items:center; justify-content:center;">
                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <circle cx="12" cy="12" r="8" fill="none"
                                                stroke="#1f2a57" stroke-width="2" />
                                            <path d="M15 6 A8 8 0 0 1 18 12" fill="none" stroke="#8fa3bf"
                                                stroke-linecap="round" stroke-width="2" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <input type="file" id="wt-fileInput" accept=".jpg,.jpeg,.png,.pdf"
                                style="display:none;"
                                onchange="var f=this.files[0]; var p=document.getElementById('wt-previewImage'); var t=document.getElementById('wt-uploadText'); var l=document.getElementById('wt-markerLayer'); var tb=document.getElementById('wt-markerToolbar'); if(!f) return; if(f.type.startsWith('image/')){ var r=new FileReader(); r.onload=function(e){ p.src=e.target.result; p.style.display='block'; t.style.display='none'; l.style.display='block'; if(tb) tb.style.display='flex'; }; r.readAsDataURL(f);} else { p.style.display='none'; t.innerHTML='📄 '+f.name; l.style.display='none'; if(tb) tb.style.display='none'; }" />
                        </div>
                        <div class="col-md-7">
                             <div style="background-color:#F7F7FF;border-radius:10px;padding:6px;">
                            <label class="form-label fw-bold mb-0" style="color: #2b2d42;">Ticket Details</label><br>
                            <small class="text-muted">Ticket Details</small>
                            <div class="d-flex gap-2 mt-2">
                                <select id="wt-select-project" name="project_id" class="form-select form-select-sm"
                                    style="background: #fff; border-radius: 8px;">
                                    <option value="">Select the Project</option>
                                    @if (isset($projects) && count($projects))
                                        @foreach ($projects as $project)
                                            <option value="{{ (string) ($project->_id ?? $project->id) }}">
                                                {{ $project->title }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <select id="wt-select-ticket" name="ticket_id" class="form-select form-select-sm"
                                    style="background: #fff; border-radius: 8px;">
                                    <option value="">Select the Ticket</option>
                                </select>
                            </div>
                             </div>
                            <div style="border: 3px solid #f7f7f7; margin-top:12px;padding:6px;border-radius:12px;">
                                <div class="d-flex justify-content-between align-items-start mb-2 mt-1"style="border-bottom:2px solid #ECECEC">
                                    <div>
                                        <div class="fw-bold" style="color: #2b2d42;">Project Title Task</div>
                                        <small class="text-muted">Total Task:
                                            {{ isset($webtasks) ? count($webtasks) : 0 }}</small>
                                    </div>
                                    <div style="color: #ea5455; font-size: 12px;">Max. 4 Tasks each Ticket</div>
                                </div>

                                @foreach ($webtasks ?? [] as $task)
                                    @php
                                        $logo = optional($task->project)->logo_path
                                            ? asset('storage/' . ltrim(optional($task->project)->logo_path, '/'))
                                            : asset('build/img/yekbon.svg');
                                        $thumb = !empty($task->board_image_path)
                                            ? asset('storage/' . ltrim($task->board_image_path, '/'))
                                            : (!empty($task->mark_image_path)
                                                ? asset('storage/' . ltrim($task->mark_image_path, '/'))
                                                : asset('build/img/dooted img.svg'));
                                        $viewerImg = !empty($task->board_image_path)
                                            ? asset('storage/' . ltrim($task->board_image_path, '/'))
                                            : (!empty($task->mark_image_path)
                                                ? asset('storage/' . ltrim($task->mark_image_path, '/'))
                                                : asset('build/img/dooted img.svg'));
                                    @endphp
                                    <div class="d-flex p-2 rounded mt-2 task-card mb-1"
                                        style="background:#ebebeb; border:1px solid #e9ecef; box-shadow:0 2px 8px rgba(0,0,0,.04); cursor:pointer; align-items:center; gap:8px;"
                                        data-board="{{ $viewerImg }}" data-issues='@json($task->issues ?? [])'
                                        data-title="{{ e($task->title) }}"
                                        data-project-id="{{ (string) ($task->project_id ?? (optional($task->project)->_id ?? optional($task->project)->id)) }}"
                                        data-ticket-id="{{ (string) ($task->ticket_id ?? (optional($task->ticket)->_id ?? optional($task->ticket)->id)) }}"
                                        data-project-title="{{ e(optional($task->project)->title ?? '') }}"
                                        data-project-logo="{{ $logo }}"
                                        data-ticket-code="{{ e(optional($task->ticket)->code ?? '') }}"
                                        data-ticket-title="{{ e(optional($task->ticket)->title ?? '') }}"
                                        data-task-id="{{ 'WTSK-' . str_pad((string) (1000 + $loop->iteration), 4, '0', STR_PAD_LEFT) }}"
                                        data-section="{{ e(optional($task->ticket)->section_name ?? 'Section') }}"
                                        data-start="{{ optional($task->ticket)->start_date ? \Carbon\Carbon::parse(optional($task->ticket)->start_date)->toDateString() : ($task->start_date ? \Carbon\Carbon::parse($task->start_date)->toDateString() : '') }}"
                                        data-deliver="{{ optional($task->ticket)->end_date ? \Carbon\Carbon::parse(optional($task->ticket)->end_date)->toDateString() : ($task->end_date ? \Carbon\Carbon::parse($task->end_date)->toDateString() : '') }}"
                                        onclick="openTaskViewer(this)">
                                        <div class="me-2">
                                            <img src="{{ $thumb }}" alt="Task Image"
                                                style="width: 100px; height: 100px; border-radius: 8px;  background: transparent; border: none; padding: 0; display:block;">
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div
                                                    style="font-weight: 600; font-size: 14px; display: flex; align-items: center;">
                                                    <img src="{{ $logo }}" alt=""
                                                        style="width: 30px; height: 30px; margin-right: 6px;">
                                                    {{ $task->title }}
                                                </div>
                                                <div class="d-flex align-items-center gap-2"
                                                    style="position: relative;">
                                                    <button
                                                        onclick="event.stopPropagation(); var menu = this.nextElementSibling; menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';"
                                                        style="width: 32px; height: 32px; border-radius: 50%; border: 1px solid #a5acc5; background-color: #f9f9f9; display: flex; align-items: center; justify-content: center; padding: 0;">
                                                        <span
                                                            style="font-size: 18px; color: #2b2d42;">&#x2022;&#x2022;&#x2022;</span>
                                                    </button>
                                                    <div class="menu-box"
                                                        style="display: none; background: #fff; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); padding: 8px 10px; width: 80px; text-align: center; position: absolute; top: 100%; right: 0; z-index: 1000;"
                                                        onclick="event.stopPropagation();">
                                                        <div
                                                            style="font-size: 12px; color: #7a7a9d; font-weight: 600; margin-bottom: 6px;">
                                                            Options</div>
                                                        <div
                                                            style="display: flex; justify-content: center; align-items: center; gap: 10px;">
                                                            <img src="{{ URL::asset('/build/img/delete1.svg') }}"
                                                                alt="Delete"
                                                                style="width: 20px; height: 20px; cursor: pointer;"
                                                                onclick="webTaskDelete('{{ (string) ($task->_id ?? $task->id) }}')">
                                                            <img src="{{ URL::asset('/build/img/Edit1.svg') }}"
                                                                alt="Edit"
                                                                style="width: 20px; height: 20px; cursor: pointer;"
                                                                onclick="event.stopPropagation(); webTaskEdit('{{ (string) ($task->_id ?? $task->id) }}')">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="font-size: 12px; color: #6c757d;">
                                                {{ optional($task->ticket)->code ? optional($task->ticket)->code . ' - ' : '' }}{{ optional($task->ticket)->title ?? 'Ticket' }}
                                            </div>
                                            <div style="font-size: 13px; margin-top: 2px;">
                                                {{ optional($task->ticket)->description ?? '-' }}</div>
                                            <div class="d-flex justify-content-between mt-2 flex-nowrap"
                                                style="background-color: #fff; border-radius: 10px; padding: 4px;">
                                                <div
                                                    style="font-size: 14px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                    <small>Start:
                                                        {{ optional($task->ticket)->start_date ? \Carbon\Carbon::parse(optional($task->ticket)->start_date)->format('d.m.Y') : ($task->start_date ? \Carbon\Carbon::parse($task->start_date)->format('d.m.Y') : '--') }}</small>
                                                </div>
                                                <div
                                                    style="font-size: 14px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                    <small>Deliver:
                                                        {{ optional($task->ticket)->end_date ? \Carbon\Carbon::parse(optional($task->ticket)->end_date)->format('d.m.Y') : ($task->end_date ? \Carbon\Carbon::parse($task->end_date)->format('d.m.Y') : '--') }}</small>
                                                </div>
                                                <div class="d-flex align-items-center"
                                                    style="font-size: 11px; background-color: #ff4d4f; color: white; padding: 2px 6px; border-radius: 6px;">
                                                    <img src="https://img.icons8.com/ios-filled/16/ffffff/flash-on.png"
                                                        alt="Urgent" style="margin-right: 4px;">
                                                    {{ str_pad((string) ($task->number ?? $loop->iteration), 2, '0', STR_PAD_LEFT) }}
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <input type="file" id="addwebFileInput" style="display: none;"
                                    onchange="document.getElementById('addwebBox').innerText = '+ ' + this.files[0].name">
                             <!-- Clickable Box -->
                                <div id="addwebBox" class="border border-dashed p-2 text-center rounded"
                                    style="cursor: pointer;margin:5px;height:60px; display:flex; align-items:center; justify-content:center;background:#ECECEC80"
                                    onclick="document.getElementById('addwebFileInput').click();">
                                    + Add new Task
                                </div>
                            <!--  -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between" style="border-top:none;">
                    <button id="wt-create-task-save" type="button" class="btn text-white"
                        style="background-color: #28c76f; border-radius: 6px;" data-bs-dismiss="modal">Save and
                        Close</button>
                    <button id="wt-create-task-save-add" type="button" class="btn text-white"
                        style="background-color: #f98f3e; border-radius: 6px;">Save & add Task </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Web Task Issue Modal -->
    <div class="modal fade" id="wt-markerDetailsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius:12px;">
                <div class="modal-header" style="background:#fff;">
                    <div>
                        <h6 class="modal-title mb-0" style="font-weight:600;">Add Issue</h6>
                        <small class="text-muted">Create an Issue</small>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label class="form-label" style="font-weight:600;color:#2b2d42;">Type the Title</label>
                        <div style="position:relative;">
                            <input type="text" id="wt-marker-title" class="form-control form-control-sm"
                                placeholder="Type the Title"
                                style="border:3px solid #ced4da;border-radius:10px;background:#fff;color:#2b2d42;height:38px;padding-right:38px;" />
                            <img src="{{ asset('assets/img/title.svg') }}" alt="title"
                                style="position:absolute;right:10px;top:50%;transform:translateY(-50%);width:16px;height:16px;opacity:.8;" />
                        </div>
                    </div>
                    <div class="mb-2">
                        <label class="form-label" style="font-weight:600;color:#2b2d42;">Describe the issue</label>
                        <div style="position:relative;">
                            <input type="text" id="wt-marker-description" class="form-control form-control-sm"
                                placeholder="Describe the issue"
                                style="border:3px solid #ced4da;border-radius:10px;background:#fff;color:#2b2d42;height:38px;padding-right:38px;" />
                            <img src="{{ asset('assets/img/title.svg') }}" alt="title"
                                style="position:absolute;right:10px;top:50%;transform:translateY(-50%);width:16px;height:16px;opacity:.8;" />
                        </div>
                    </div>
                    <div class="d-flex gap-2 mb-2">
                        <div class="flex-fill">
                            <label class="form-label">Start Date</label>
                            <div style="position:relative;">
                                <input type="date" id="wt-marker-start" class="form-control form-control-sm"
                                    style="padding-right:38px;border-radius:10px;" />
                                <img src="{{ asset('assets/img/date.png') }}" alt="date"
                                    style="position:absolute;right:10px;top:50%;transform:translateY(-50%);width:16px;height:16px;opacity:.8;" />
                            </div>
                        </div>
                        <div class="flex-fill">
                            <label class="form-label">Deliver Date</label>
                            <div style="position:relative;">
                                <input type="date" id="wt-marker-end" class="form-control form-control-sm"
                                    style="padding-right:38px;border-radius:10px;" />
                                <img src="{{ asset('assets/img/date.png') }}" alt="date"
                                    style="position:absolute;right:10px;top:50%;transform:translateY(-50%);width:16px;height:16px;opacity:.8;" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" id="wt-save-marker" class="btn btn-light btn-sm">Save & Close</button>
                    <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var wtProjectSelect = document.getElementById('wt-select-project');
            var wtTicketSelect = document.getElementById('wt-select-ticket');
            var wtTicketCache = {};
            var wtStartDateSpan = document.getElementById('wt-ticket-start-date');
            var wtEndDateSpan = document.getElementById('wt-ticket-end-date');
            var wtLayer = document.getElementById('wt-markerLayer');
            var wtPreview = document.getElementById('wt-previewImage');
            var wtToolbar = document.getElementById('wt-markerToolbar');
            var wtCurrentMarker = null;
            var wtCurrentShape = 'square';
            var wtCurrentColor = '#ea5455';
            var wtPlacing = false;
            var wtIssues = [];
            var wtBadgeCounter = 0;
            window.__wtEditingMode = window.__wtEditingMode || false;

            function wtFormatDate(iso) {
                if (!iso) return '--';
                var s = ('' + iso).substring(0, 10);
                var p = s.split('-');
                if (p.length !== 3) return '--';
                return p[2] + ':' + p[1] + ':' + p[0];
            }

            function wtRenderDates(t) {
                if (!wtStartDateSpan || !wtEndDateSpan) return;
                if (!t) {
                    wtStartDateSpan.textContent = '--';
                    wtEndDateSpan.textContent = '--';
                    return;
                }
                wtStartDateSpan.textContent = wtFormatDate(t.start_date);
                wtEndDateSpan.textContent = wtFormatDate(t.end_date);
            }

            function wtSetSelectLoading(sel, loading) {
                if (!sel) return;
                sel.disabled = !!loading;
                if (loading) {
                    sel.innerHTML = '<option>Loading...</option>';
                }
            }

            function wtLoadTickets(pid) {
                if (!wtTicketSelect) {
                    return Promise.resolve([]);
                }
                if (!pid) {
                    wtTicketSelect.innerHTML = '<option value="">Select the Ticket</option>';
                    return Promise.resolve([]);
                }
                wtSetSelectLoading(wtTicketSelect, true);
                var url = new URL('{{ route('webtasks.tickets') }}', window.location.origin);
                url.searchParams.set('project_id', pid);
                return fetch(url.toString(), {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                }).then(function(r) {
                    return r.json();
                }).then(function(resp) {
                    wtTicketSelect.innerHTML = '<option value="">Select the Ticket</option>';
                    var items = (resp && Array.isArray(resp.tickets)) ? resp.tickets : [];
                    wtTicketCache = {};
                    items.forEach(function(t) {
                        var opt = document.createElement('option');
                        opt.value = t.id;
                        opt.textContent = t.title || 'Untitled';
                        wtTicketSelect.appendChild(opt);
                        wtTicketCache[t.id] = t;
                    });
                    wtTicketSelect.disabled = false;
                    wtRenderDates(null);
                    return items;
                }).catch(function() {
                    wtTicketSelect.innerHTML = '<option value="">Failed to load tickets</option>';
                    wtTicketSelect.disabled = false;
                    return [];
                });
            }

            if (wtProjectSelect) wtProjectSelect.addEventListener('change', function(e) {
                wtLoadTickets(e.target.value);
            });
            if (wtTicketSelect) wtTicketSelect.addEventListener('change', function(e) {
                var t = wtTicketCache[e.target.value];
                wtRenderDates(t || null);
                if (window.__wtEditingMode) return;
                try {
                    var p = document.getElementById('wt-previewImage');
                    var txt = document.getElementById('wt-uploadText');
                    var l = document.getElementById('wt-markerLayer');
                    var tb = document.getElementById('wt-markerToolbar');
                    if (p) {
                        p.src = '';
                        p.style.display = 'none';
                    }
                    if (txt) {
                        txt.style.display = 'block';
                        txt.innerHTML = 'Upload Or Drag<br><small>PDF, JPG, PNG</small>';
                    }
                    if (l) {
                        l.style.display = 'none';
                        l.innerHTML = '';
                    }
                    if (tb) {
                        tb.style.display = 'none';
                    }
                    var fi = document.getElementById('wt-fileInput');
                    if (fi) fi.value = '';
                } catch (_) {}
            });

            var wtSq = document.getElementById('wt-marker-shape-square');
            var wtCi = document.getElementById('wt-marker-shape-circle');
            if (wtSq) wtSq.addEventListener('click', function(e) {
                e.stopPropagation();
                wtCurrentShape = 'square';
                this.style.background = '#e9ecef';
                if (wtCi) wtCi.style.background = '#f8f9fa';
                wtPlacing = true;
                if (wtLayer) {
                    try {
                        wtPreview.style.display = 'block';
                        wtLayer.style.display = 'block';
                    } catch (_) {}
                    wtLayer.style.cursor = 'crosshair';
                }
            });
            if (wtCi) wtCi.addEventListener('click', function(e) {
                e.stopPropagation();
                wtCurrentShape = 'circle';
                this.style.background = '#e9ecef';
                if (wtSq) wtSq.style.background = '#f8f9fa';
                wtPlacing = true;
                if (wtLayer) {
                    try {
                        wtPreview.style.display = 'block';
                        wtLayer.style.display = 'block';
                    } catch (_) {}
                    wtLayer.style.cursor = 'crosshair';
                }
            });

            function wtCreateMarker(x, y) {
                if (!wtLayer) return;
                if (wtCurrentMarker) {
                    wtCurrentMarker.remove();
                    wtCurrentMarker = null;
                }
                var m = document.createElement('div');
                m.className = 'marker-box';
                m.style.position = 'absolute';
                m.style.left = (x - 40) + 'px';
                m.style.top = (y - 40) + 'px';
                m.style.width = '80px';
                m.style.height = '80px';
                m.style.border = '2px solid ' + wtCurrentColor;
                m.style.background = 'rgba(0,0,0,0.0)';
                m.style.cursor = 'move';
                m.style.userSelect = 'none';
                m.style.pointerEvents = 'auto';
                m.style.borderRadius = (wtCurrentShape === 'circle' ? '50%' : '6px');
                var plus = document.createElement('div');
                plus.textContent = '+';
                plus.title = 'Add details';
                plus.style.position = 'absolute';
                plus.style.right = '-10px';
                plus.style.top = '-10px';
                plus.style.width = '24px';
                plus.style.height = '24px';
                plus.style.borderRadius = '50%';
                plus.style.background = wtCurrentColor;
                plus.style.color = '#fff';
                plus.style.display = 'flex';
                plus.style.alignItems = 'center';
                plus.style.justifyContent = 'center';
                plus.style.cursor = 'pointer';
                m.appendChild(plus);
                m.addEventListener('mousedown', function(ev) {
                    ev.stopPropagation();
                });
                m.addEventListener('mouseup', function(ev) {
                    ev.stopPropagation();
                });
                m.addEventListener('click', function(ev) {
                    ev.stopPropagation();
                });
                wtLayer.appendChild(m);
                wtCurrentMarker = m;
                if (typeof $ === 'function' && $.fn.draggable && $.fn.resizable) {
                    $(m).draggable({
                        containment: wtLayer
                    });
                    $(m).resizable({
                        aspectRatio: wtCurrentShape === 'circle',
                        containment: wtLayer,
                        handles: 'n, e, s, w, ne, se, sw, nw',
                        resize: function() {
                            if (wtCurrentShape === 'circle') {
                                var w = $(this).width();
                                $(this).height(w);
                            }
                        }
                    });
                }
                plus.addEventListener('click', function(ev) {
                    ev.stopPropagation();
                    ev.stopImmediatePropagation();
                    try {
                        if (wtPreview) wtPreview.style.display = 'block';
                        if (wtLayer) wtLayer.style.display = 'block';
                        if (wtToolbar) wtToolbar.style.display = 'flex';
                    } catch (_) {}
                    // Inline color palette and Create Issue button (web)
                    try {
                        document.querySelectorAll('.wt-marker-color-row').forEach(function(el) {
                            el.remove();
                        });
                    } catch (_) {}
                    var mRect = m.getBoundingClientRect();
                    var lRect = wtLayer.getBoundingClientRect();
                    var row = document.createElement('div');
                    row.className = 'wt-marker-color-row';
                    row.style.position = 'absolute';
                    row.style.left = (mRect.right - lRect.left + 8) + 'px';
                    row.style.top = (mRect.top - lRect.top) + 'px';
                    row.style.background = '#ffffff';
                    row.style.padding = '8px 10px';
                    row.style.borderRadius = '10px';
                    row.style.boxShadow = '0 2px 8px rgba(0,0,0,0.15)';
                    row.style.display = 'flex';
                    row.style.alignItems = 'center';
                    row.style.gap = '8px';
                    row.style.zIndex = '20';
                    ['#ea5455', '#28c76f', '#ffde59', '#00cfe8'].forEach(function(c) {
                        var b = document.createElement('button');
                        b.type = 'button';
                        b.style.width = '24px';
                        b.style.height = '24px';
                        b.style.borderRadius = '50%';
                        b.style.border = '2px solid ' + (c === wtCurrentColor ? '#111' : '#e0e6ed');
                        b.style.background = c;
                        b.style.cursor = 'pointer';
                        b.addEventListener('click', function(e2) {
                            e2.stopPropagation();
                            wtCurrentColor = c;
                            m.style.border = '2px solid ' + wtCurrentColor;
                            plus.style.background = wtCurrentColor;
                            row.querySelectorAll('button').forEach(function(btn) {
                                if (btn !== createBtn) btn.style.borderColor =
                                    '#e0e6ed';
                            });
                            b.style.borderColor = '#111';
                        });
                        row.appendChild(b);
                    });
                    var createBtn = document.createElement('button');
                    createBtn.type = 'button';
                    createBtn.className = 'btn btn-sm';
                    createBtn.textContent = 'Create Issue';
                    createBtn.style.background = '#28c76f';
                    createBtn.style.color = '#fff';
                    createBtn.style.borderRadius = '6px';
                    createBtn.addEventListener('click', function(e2) {
                        e2.stopPropagation();
                        try {
                            document.querySelectorAll('.wt-marker-color-row').forEach(function(el) {
                                el.remove();
                            });
                        } catch (_) {}
                        try {
                            var sEl = document.getElementById('wt-marker-start');
                            var eEl = document.getElementById('wt-marker-end');
                            if (wtTicketSelect && wtTicketSelect.value && wtTicketCache[
                                    wtTicketSelect.value]) {
                                var t = wtTicketCache[wtTicketSelect.value];
                                if (sEl && t.start_date) sEl.value = ('' + t.start_date).substring(
                                    0, 10);
                                if (eEl && t.end_date) eEl.value = ('' + t.end_date).substring(0,
                                    10);
                            }
                        } catch (_) {}
                        var mdl = document.getElementById('wt-markerDetailsModal');
                        if (mdl && mdl.parentNode !== document.body) {
                            document.body.appendChild(mdl);
                        }
                        new bootstrap.Modal(mdl, {
                            backdrop: true,
                            focus: true
                        }).show();
                    });
                    row.appendChild(createBtn);
                    wtLayer.appendChild(row);
                    try {
                        var rRect = row.getBoundingClientRect();
                        var overflowX = rRect.right - lRect.right;
                        if (overflowX > 0) {
                            row.style.left = (parseFloat(row.style.left) - overflowX - 8) + 'px';
                        }
                    } catch (_) {}
                });
            }

            if (wtLayer && wtPreview) {
                wtLayer.addEventListener('click', function(e) {
                    e.stopPropagation();
                    if (!wtPlacing) return;
                    var r = wtLayer.getBoundingClientRect();
                    wtCreateMarker(e.clientX - r.left, e.clientY - r.top);
                    wtPlacing = false;
                    wtLayer.style.cursor = 'default';
                });
            }

            function wtCropMarker() {
                try {
                    var src = (wtPreview || {}).src || '';
                    return (src && src.indexOf('data:image') === 0) ? src : null;
                } catch (_) {
                    return null;
                }
            }

            // Prefill dates when the modal is shown as a fallback
            try {
                var wtDetailsModalEl = document.getElementById('wt-markerDetailsModal');
                if (wtDetailsModalEl) {
                    wtDetailsModalEl.addEventListener('shown.bs.modal', function() {
                        try {
                            var sEl = document.getElementById('wt-marker-start');
                            var eEl = document.getElementById('wt-marker-end');
                            if (wtTicketSelect && wtTicketSelect.value && wtTicketCache[wtTicketSelect
                                    .value]) {
                                var t = wtTicketCache[wtTicketSelect.value];
                                if (sEl && !sEl.value && t.start_date) sEl.value = ('' + t.start_date)
                                    .substring(0, 10);
                                if (eEl && !eEl.value && t.end_date) eEl.value = ('' + t.end_date)
                                    .substring(0, 10);
                            }
                        } catch (_) {}
                    });
                }
            } catch (_) {}

            var wtSave = document.getElementById('wt-save-marker');
            if (wtSave) wtSave.addEventListener('click', function() {
                var title = (document.getElementById('wt-marker-title') || {}).value || '';
                var desc = (document.getElementById('wt-marker-description') || {}).value || '';
                var s = (document.getElementById('wt-marker-start') || {}).value || '';
                var e = (document.getElementById('wt-marker-end') || {}).value || '';
                var layerRect = wtLayer ? wtLayer.getBoundingClientRect() : {
                    left: 0,
                    top: 0,
                    width: 0,
                    height: 0
                };
                var mRect = (wtCurrentMarker && wtCurrentMarker.getBoundingClientRect) ? wtCurrentMarker
                    .getBoundingClientRect() : layerRect;
                wtBadgeCounter += 1;
                var item = {
                    title: title,
                    description: desc,
                    start_date: s,
                    end_date: e,
                    shape: wtCurrentShape,
                    color: wtCurrentColor,
                    mark_image: wtCropMarker(),
                    project_id: (wtProjectSelect || {}).value || null,
                    ticket_id: (wtTicketSelect || {}).value || null,
                    position: {
                        left: (mRect.left - layerRect.left) + mRect.width / 2,
                        top: (mRect.top - layerRect.top) + mRect.height / 2
                    },
                    number: wtBadgeCounter,
                    layer: {
                        width: Math.round(layerRect.width || 0),
                        height: Math.round(layerRect.height || 0)
                    }
                };
                wtIssues.push(item);
                var badge = document.createElement('div');
                badge.className = 'marker-badge';
                badge.textContent = String(item.number);
                badge.style.position = 'absolute';
                badge.style.left = item.position.left + 'px';
                badge.style.top = item.position.top + 'px';
                badge.style.transform = 'translate(-50%, -50%)';
                badge.style.color = item.color || '#28c76f';
                badge.style.fontWeight = '800';
                badge.style.fontSize = '18px';
                badge.style.textShadow = '0 1px 2px rgba(0,0,0,0.25)';
                badge.style.cursor = 'pointer';
                badge.style.zIndex = '25';
                badge.addEventListener('mousedown', function(ev) {
                    ev.stopPropagation();
                });
                badge.addEventListener('mouseup', function(ev) {
                    ev.stopPropagation();
                });
                if (wtLayer) wtLayer.appendChild(badge);
                if (wtCurrentMarker) {
                    try {
                        wtCurrentMarker.remove();
                    } catch (_) {}
                    wtCurrentMarker = null;
                }
                try {
                    bootstrap.Modal.getInstance(document.getElementById('wt-markerDetailsModal')).hide();
                } catch (e) {}
            });

            var wtCreateSave = document.getElementById('wt-create-task-save');
            if (wtCreateSave) wtCreateSave.addEventListener('click', function() {
                var editingId = (document.getElementById('wt-create-task-save') || {}).dataset?.editingId;
                var ticketText = (function() {
                    try {
                        var opt = wtTicketSelect?.selectedOptions?.[0];
                        return opt ? (opt.textContent || '').trim() : '';
                    } catch (_) {
                        return '';
                    }
                })();
                var taskTitle = ticketText || 'Task';
                if (editingId) {
                    var updatePayload = {
                        title: taskTitle,
                        description: '',
                        start_date: (function() {
                            try {
                                var t = wtTicketCache[(wtTicketSelect || {}).value];
                                return t ? (t.start_date || null) : null;
                            } catch (_) {
                                return null;
                            }
                        })(),
                        end_date: (function() {
                            try {
                                var t = wtTicketCache[(wtTicketSelect || {}).value];
                                return t ? (t.end_date || null) : null;
                            } catch (_) {
                                return null;
                            }
                        })(),
                        checkpoints: [],
                        issues: (Array.isArray(wtIssues) ? wtIssues : []),
                        mark_image: (function() {
                            try {
                                var src = (wtPreview || {}).src || '';
                                return (src.indexOf('data:image') === 0) ? src : null;
                            } catch (_) {
                                return null;
                            }
                        })()
                    };
                    fetch(`{{ url('/webtasks') }}/${editingId}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify(updatePayload)
                    }).then(function(r) {
                        return r.json();
                    }).then(function(resp) {
                        try {
                            delete(document.getElementById('wt-create-task-save') || {}).dataset
                                .editingId;
                        } catch (_) {}
                        if (resp && resp.success) {
                            try {
                                wtIssues = [];
                            } catch (_) {}
                            try {
                                bootstrap.Modal.getOrCreateInstance(document.getElementById(
                                    'webtask2')).hide();
                            } catch (e) {}
                            setTimeout(function() {
                                window.location.reload();
                            }, 300);
                        } else {
                            alert('Failed to update web task');
                        }
                    }).catch(function() {
                        alert('Failed to update web task');
                    });
                    return;
                }
                if (!Array.isArray(wtIssues) || wtIssues.length === 0) {
                    alert('Please add at least one issue on the image before saving the task.');
                    return;
                }
                var payload = {
                    project_id: (wtProjectSelect || {}).value || null,
                    ticket_id: (wtTicketSelect || {}).value || null,
                    title: taskTitle,
                    description: '',
                    start_date: (function() {
                        try {
                            var t = wtTicketCache[(wtTicketSelect || {}).value];
                            return t ? (t.start_date || null) : null;
                        } catch (_) {
                            return null;
                        }
                    })(),
                    end_date: (function() {
                        try {
                            var t = wtTicketCache[(wtTicketSelect || {}).value];
                            return t ? (t.end_date || null) : null;
                        } catch (_) {
                            return null;
                        }
                    })(),
                    issues: wtIssues,
                    board_image: (function() {
                        try {
                            var src = (wtPreview || {}).src || '';
                            return (src && src.indexOf('data:image') === 0) ? src : null;
                        } catch (_) {
                            return null;
                        }
                    })()
                };
                fetch("{{ route('webtasks.store') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify(payload)
                }).then(function(r) {
                    return r.json();
                }).then(function(resp) {
                    if (resp && resp.success) {
                        try {
                            wtIssues = [];
                            wtBadgeCounter = 0;
                            var existing = wtLayer?.querySelectorAll('.marker-badge') || [];
                            existing.forEach?.(function(n) {
                                try {
                                    n.remove();
                                } catch (_) {}
                            });
                        } catch (_) {}
                    } else {
                        alert('Failed to create web task');
                    }
                });
            });

            // Save & add Task (web)
            var wtCreateSaveAdd = document.getElementById('wt-create-task-save-add');
            if (wtCreateSaveAdd && !wtCreateSaveAdd._bound) {
                wtCreateSaveAdd.addEventListener('click', function() {
                    try {
                        var editingId = (document.getElementById('wt-create-task-save') || {}).dataset
                            ?.editingId;
                        var ticketText = (function() {
                            try {
                                var opt = wtTicketSelect?.selectedOptions?.[0];
                                return opt ? (opt.textContent || '').trim() : '';
                            } catch (_) {
                                return '';
                            }
                        })();
                        var taskTitle = ticketText || 'Task';
                        var resetForNext = function() {
                            try {
                                wtIssues = [];
                                wtBadgeCounter = 0;
                                var ex = wtLayer?.querySelectorAll('.marker-badge') || [];
                                ex.forEach?.(function(n) {
                                    try {
                                        n.remove();
                                    } catch (_) {}
                                });
                                if (wtTicketSelect) {
                                    try {
                                        wtTicketSelect.value = '';
                                    } catch (_) {}
                                }
                                wtRenderDates(null);
                                var txt = document.getElementById('wt-uploadText');
                                var fi = document.getElementById('wt-fileInput');
                                if (wtPreview) {
                                    wtPreview.src = '';
                                    wtPreview.style.display = 'none';
                                }
                                if (txt) {
                                    txt.style.display = 'block';
                                    txt.innerHTML = 'Upload Or Drag<br><small>PDF, JPG, PNG</small>';
                                }
                                if (wtLayer) {
                                    wtLayer.style.display = 'none';
                                    wtLayer.innerHTML = '';
                                }
                                if (wtToolbar) {
                                    wtToolbar.style.display = 'none';
                                }
                                if (fi) fi.value = '';
                            } catch (_) {}
                        };
                        if (editingId) {
                            var updatePayload = {
                                title: taskTitle,
                                description: '',
                                start_date: (function() {
                                    try {
                                        var t = wtTicketCache[(wtTicketSelect || {}).value];
                                        return t ? (t.start_date || null) : null;
                                    } catch (_) {
                                        return null;
                                    }
                                })(),
                                end_date: (function() {
                                    try {
                                        var t = wtTicketCache[(wtTicketSelect || {}).value];
                                        return t ? (t.end_date || null) : null;
                                    } catch (_) {
                                        return null;
                                    }
                                })(),
                                checkpoints: [],
                                issues: (Array.isArray(wtIssues) ? wtIssues : []),
                                mark_image: (function() {
                                    try {
                                        var src = (wtPreview || {}).src || '';
                                        return (src.indexOf('data:image') === 0) ? src : null;
                                    } catch (_) {
                                        return null;
                                    }
                                })()
                            };
                            fetch(`{{ url('/webtasks') }}/${editingId}`, {
                                method: 'PUT',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'X-Requested-With': 'XMLHttpRequest'
                                },
                                body: JSON.stringify(updatePayload)
                            }).then(function(r) {
                                return r.json();
                            }).then(function(resp) {
                                if (resp && resp.success) {
                                    resetForNext();
                                } else {
                                    alert('Failed to update web task');
                                }
                            });
                            return;
                        }
                        if (!Array.isArray(wtIssues) || wtIssues.length === 0) {
                            alert('Please add at least one issue on the image before saving the task.');
                            return;
                        }
                        var payload = {
                            project_id: (wtProjectSelect || {}).value || null,
                            ticket_id: (wtTicketSelect || {}).value || null,
                            title: taskTitle,
                            description: '',
                            start_date: (function() {
                                try {
                                    var t = wtTicketCache[(wtTicketSelect || {}).value];
                                    return t ? (t.start_date || null) : null;
                                } catch (_) {
                                    return null;
                                }
                            })(),
                            end_date: (function() {
                                try {
                                    var t = wtTicketCache[(wtTicketSelect || {}).value];
                                    return t ? (t.end_date || null) : null;
                                } catch (_) {
                                    return null;
                                }
                            })(),
                            issues: wtIssues,
                            board_image: (function() {
                                try {
                                    var src = (wtPreview || {}).src || '';
                                    return (src && src.indexOf('data:image') === 0) ? src :
                                    null;
                                } catch (_) {
                                    return null;
                                }
                            })()
                        };
                        fetch("{{ route('webtasks.store') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: JSON.stringify(payload)
                        }).then(function(r) {
                            return r.json();
                        }).then(function(resp) {
                            if (resp && resp.success) {
                                resetForNext();
                            } else {
                                alert('Failed to create web task');
                            }
                        });
                    } catch (_) {}
                });
                wtCreateSaveAdd._bound = true;
            }

            // Web Task Edit entrypoint
            window.webTaskEdit = function(id) {
                try {
                    window.__wtEditingMode = true;
                    document.querySelectorAll('.menu-box').forEach(function(m) {
                        m.style.display = 'none';
                    });
                    document.querySelectorAll('.modal.show').forEach(function(el) {
                        try {
                            bootstrap.Modal.getInstance(el)?.hide();
                        } catch (_) {}
                    });
                } catch (_) {}
                fetch(`{{ url('/webtasks') }}/${id}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                }).then(function(r) {
                    return r.json();
                }).then(function(resp) {
                    if (!resp || !resp.success) return;
                    var t = resp.task || {};
                    try {
                        (document.querySelector('#webtask2 .modal-title') || {}).textContent =
                            'Edit Web Task';
                    } catch (_) {}
                    try {
                        if (wtProjectSelect && t.project_id) {
                            wtProjectSelect.value = String(t.project_id);
                            wtLoadTickets(String(t.project_id)).then(function() {
                                try {
                                    if (wtTicketSelect && t.ticket_id) {
                                        wtTicketSelect.value = String(t.ticket_id);
                                        var ev = new Event('change');
                                        wtTicketSelect.dispatchEvent(ev);
                                    }
                                } catch (_) {}
                            });
                        }
                    } catch (_) {}
                    try {
                        var src = null;
                        if (t.board_image_path) src = '/storage/' + String(t.board_image_path).replace(
                            /^\/+/, '');
                        else if (t.mark_image_path) src = '/storage/' + String(t.mark_image_path)
                            .replace(/^\/+/, '');
                        if (src && wtPreview) {
                            var render = function() {
                                try {
                                    if (wtLayer) {
                                        wtLayer.style.display = 'block';
                                        wtLayer.innerHTML = '';
                                    }
                                    if (wtToolbar) wtToolbar.style.display = 'flex';
                                    var issues = Array.isArray(t.issues) ? t.issues : [];
                                    var rect = wtLayer ? wtLayer.getBoundingClientRect() : {
                                        width: 0,
                                        height: 0
                                    };
                                    var maxNum = 0;
                                    issues.forEach(function(iss, idx) {
                                        var pos = iss && iss.position ? iss.position : null;
                                        if (!pos) return;
                                        var saved = iss.layer || null;
                                        var sx = 1,
                                            sy = 1;
                                        if (saved && saved.width && saved.height && rect
                                            .width && rect.height) {
                                            sx = rect.width / saved.width;
                                            sy = rect.height / saved.height;
                                        }
                                        var left = (pos.left || 0) * sx;
                                        var top = (pos.top || 0) * sy;
                                        var num = Number(iss.number || (idx + 1));
                                        if (num > maxNum) maxNum = num;
                                        var badge = document.createElement('div');
                                        badge.className = 'marker-badge';
                                        badge.textContent = String(num);
                                        badge.style.position = 'absolute';
                                        badge.style.left = left + 'px';
                                        badge.style.top = top + 'px';
                                        badge.style.transform = 'translate(-50%, -50%)';
                                        badge.style.color = (iss.color || '#28c76f');
                                        badge.style.fontWeight = '800';
                                        badge.style.fontSize = '18px';
                                        badge.style.textShadow =
                                            '0 1px 2px rgba(0,0,0,0.25)';
                                        badge.style.cursor = 'pointer';
                                        badge.style.zIndex = '25';
                                        badge.addEventListener('mousedown', function(ev) {
                                            ev.stopPropagation();
                                        });
                                        badge.addEventListener('mouseup', function(ev) {
                                            ev.stopPropagation();
                                        });
                                        if (wtLayer) wtLayer.appendChild(badge);
                                    });
                                    try {
                                        wtBadgeCounter = Math.max(wtBadgeCounter || 0, maxNum || 0);
                                    } catch (_) {
                                        wtBadgeCounter = maxNum || 0;
                                    }
                                } catch (_) {}
                            };
                            if (wtPreview.complete) {
                                render();
                            } else {
                                wtPreview.onload = function() {
                                    render();
                                };
                            }
                            wtPreview.src = src;
                            wtPreview.style.display = 'block';
                        }
                    } catch (_) {}
                    try {
                        (document.getElementById('wt-create-task-save') || {}).dataset.editingId =
                            String(id);
                    } catch (_) {}
                    var mdl = document.getElementById('webtask2');
                    if (mdl && mdl.parentNode !== document.body) {
                        document.body.appendChild(mdl);
                    }
                    new bootstrap.Modal(mdl, {
                        backdrop: true,
                        focus: true
                    }).show();
                });
            };
        });
    </script>
    <!-- create  employee task -->
    <div class="modal fade" id="emptask" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="border-radius: 12px;">
                <!-- Modal Header -->
                <div class="modal-header d-flex justify-content-between flex-wrap"
                    style="background: #fff;border-bottom:none;">
                    <!-- Title + Subtitle -->
                    <div>
                        <h5 class="modal-title mb-0" style="font-weight: 600;">Create new Task</h5>
                        <small class="text-muted">Create a Task</small>
                    </div>

                    <div class="" style="">
                             <!-- <p style="margin:0;color:black;font-size:14px;">Ticket start & Deliver date</p>
                              <small style="margin:0; display:block;">Task must be done</small> -->
                        <div class="d-flex gap-2 mb-2" > 
                                <div class="text-center p-2 text-white"
                                   style="background:#28c76f; border-radius:8px; flex:1;">
                                     <small>Start Date :</small>
                                     <span id="et2-ticket-start-date" class="fw-bold">--</span>
                                </div>

                             <div class="text-center p-2 text-white"
                                 style="background:#ea5455; border-radius:8px;">
                                 <small>Deliver Date :</small>
                                 <span id="et2-ticket-end-date" class="fw-bold">--</span>
                             </div>
                        </div>
                  </div>

                </div>
                <!-- Modal Body -->
                <div class="modal-body" style="padding: 6px 19px;">
                  

                    <form action="{{ route('emptasks.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                         <!-- Task Tabs -->
                    <div class="">
                            <div >
                                <div class="" >
                                   <!-- <label class="form-label fw-bold mb-0" style="color: #2b2d42;">Ticket Details</label><br>
                                   <small class="text-muted">Ticket Details</small> -->

                                      <!-- <div class="d-flex gap-2 mt-2">
                                      <select id="et2-select-project" name="project_id"
                                                class="form-select form-select-sm"
                                          style="background:#fff; border-radius:8px;">
                                            <option value="">Select the Project</option>
                                       @if (isset($projects) && count($projects))
                                     @foreach ($projects as $project)
                                           <option value="{{ (string)($project->_id ?? $project->id) }}">
                                              {{ $project->title }}
                                        </option>
                                          @endforeach
                                      @endif
                                        </select>

                                   <select id="et2-select-ticket" name="ticket_id"
                                        class="form-select form-select-sm"
                                        style="background:#fff; border-radius:8px;">
                                         <option value="">Select the Ticket</option>
                                    </select>
                                </div> -->
                           </div>
                           
                    </div>

                  
                 </div>


                        <!-- Task Container -->
                        <div class="row">
                            <!-- Left Upload Area -->
                            <div class="col-md-5">

                                <div class="p-3"
                                    style="max-width: 300px; margin: auto; background: #F2F2F280; border-radius: 12px; font-family: 'Segoe UI', sans-serif; font-size: 14px; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">

                                    <!-- Title -->
                                    <p class="fw-semibold mb-2" style="color: #2a2a2a;">Employee Tasks</p>

                                    <!-- Task Image Section -->
                                    <div class="mb-2" style="background-color:#fff;padding:2px;border-radius:7px;">
                                        <label class="form-label fw-semibold text-dark">Task Image</label>
                                        <div class="d-flex justify-content-between flex-wrap gap-1 flex-wrap mb-1" style="margin-left:2px;margin-right:2px;">
                                            <img id="et-img-1" class="et-image-thumb" data-index="1"
                                                data-value="build/img/image1.jpeg"
                                                src="{{ asset('build/img/image1.jpeg') }}" alt="Task Image 1"
                                                style="width: 60px; height: 60px; border-radius: 6px; object-fit: cover; cursor:pointer;">

                                            <img id="et-img-2" class="et-image-thumb" data-index="2"
                                                data-value="build/img/imagw2.jpeg"
                                                src="{{ asset('build/img/imagw2.jpeg') }}" alt="Task Image 2"
                                                style="width: 60px; height: 60px; border-radius: 6px; object-fit: cover; cursor:pointer;">
                                            <img id="et-img-3" class="et-image-thumb" data-index="3"
                                                data-value="build/img/image3.jpeg"
                                                src="{{ asset('build/img/image3.jpeg') }}" alt="Task Image 3"
                                                style="width: 60px; height: 60px; border-radius: 6px; object-fit: cover; cursor:pointer;">
                                            <img id="et-img-4" class="et-image-thumb" data-index="4"
                                                data-value="build/img/image4.jpeg"
                                                src="{{ asset('build/img/image4.jpeg') }}" alt="Task Image 4"
                                                style="width: 60px; height: 60px; border-radius: 6px; object-fit: cover; cursor:pointer;">

                                        </div>
                                        <!-- Hidden selected image input -->
                                        <input type="hidden" id="et-selected-image" name="selected_image" value="">

                                        <div class="modal fade" id="etImageViewer" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content" style="border-radius:12px; overflow:hidden;">
                                                    <div class="modal-body p-0">
                                                        <img id="et-viewer-img" src="" alt="Preview"
                                                            style="width:100%; height:100%; display:block;">
                                                    </div>
                                                    <div class="modal-footer py-2">
                                                        <button type="button" class="btn btn-sm btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                var selectedInput = document.getElementById('et-selected-image');
                                                var thumbs = document.querySelectorAll('.et-image-thumb');
                                                thumbs.forEach(function(img) {
                                                    img.addEventListener('click', function() {
                                                        thumbs.forEach(function(el){ el.style.outline = 'none'; });
                                                        img.style.outline = '2px solid #28c76f';
                                                        var val = img.getAttribute('data-value') || '';
                                                        if (selectedInput) selectedInput.value = val;
                                                    });
                                                });
                                            });
                                        </script>
                                    </div>

                                    <!-- About the Task -->
                                    <div class="mb-2 p-2"  style="background-color:#fff;padding:2px;border-radius:7px;">
                                        <p class="m-0 fw-semibold">About the Task</p>
                                        <small class="text-muted">Employee Task details</small>
                                        <div class="d-flex gap-2 my-2">
                                            <input id="et-title" name="title" type="text"
                                                class="form-control form-control-sm" placeholder="Task Title" style="background-color:#F2F2F2">
                                            <select id="et-priority" name="priority" style="background-color:#F2F2F2"
                                                class="form-select form-select-sm">
                                                <option value="">Select Priority</option>
                                                <option value="low">Low</option>
                                                <option value="medium">Medium</option>
                                                <option value="high">High</option>
                                            </select>
                                        </div>
                                        <textarea id="et-description" name="description" class="form-control form-control-sm" style="background-color:#F2F2F2"
                                            placeholder="Describe the Task"></textarea>
                                    </div>

                                    <!-- Task Execution -->
                                    <div class="mb-2 p-2"  style="background-color:#fff;padding:2px;border-radius:7px;">
                                        <p class="m-0 fw-semibold">Task execution</p>
                                        <small class="text-muted">Select day of the week</small>
                                        <div class="d-flex gap-2 mt-2">
                                            <select id="et-day" name="day" class="form-select form-select-sm" style="background-color:#F2F2F2">
                                                <option>Set the Day</option>
                                                <option>Monday</option>
                                                <option>Tuesday</option>
                                                <option>Wednesday</option>
                                                <option>Thursday</option>
                                                <option>Friday</option>
                                                <option>Saturday</option>
                                                <option>Sunday</option>
                                            </select>
                                            <select id="et-duration" name="duration"
                                                class="form-select form-select-sm" style="background-color:#F2F2F2">
                                                <option value="">Select Duration</option>
                                                <option>One Time Task</option>
                                                <option>Repeatly Task</option>
                                                <option>Every 2 Weeks</option>

                                            </select>
                                        </div>
                                    </div>

                                    <!-- Expired Reminder -->
                                    <div class="mb-2 p-2"  style="background-color:#fff;padding:2px;border-radius:7px;"> 
                                        <p class="m-0 fw-semibold">Expired Reminder</p>
                                        <small class="text-muted">Set a reminder before expired</small>
                                        <div class="d-flex gap-2 mt-2" style="background-color:#F2F2F2;border-radius:4px;">
                                            <label class="reminder-hour-btn" style="flex:1; cursor:pointer; display:block; text-align:center; border-radius:5px; padding:5px 10px; background:#f0f0f0; color:#000;" onclick="selectReminder(this)">
                                                <input type="radio" name="reminder_hours" value="6" checked style="display:none;">
                                                6 Hour
                                            </label>
                                            <label class="reminder-hour-btn" style="flex:1; cursor:pointer; display:block; text-align:center; border-radius:5px; padding:5px 10px; background:#f0f0f0; color:#000;" onclick="selectReminder(this)">
                                                <input type="radio" name="reminder_hours" value="8" style="display:none;">
                                                8 Hour
                                            </label>
                                            <label class="reminder-hour-btn" style="flex:1; cursor:pointer; display:block; text-align:center; border-radius:5px; padding:5px 10px; background:#f0f0f0; color:#000;" onclick="selectReminder(this)">
                                                <input type="radio" name="reminder_hours" value="12" style="display:none;">
                                                12 Hour
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <script>
                                    function selectReminder(label) {
                                        // Unselect all
                                        document.querySelectorAll('.reminder-hour-btn').forEach(l => {
                                            l.style.background = '#f0f0f0';
                                            l.style.color = '#000';
                                        });
                                    
                                        // Select current
                                        label.style.background = 'rgb(52, 211, 153)';
                                        label.style.color = '#fff';
                                        label.querySelector('input').checked = true;
                                    }
                                    </script>
                                    
                                    <!-- Save Button -->
                                    <button id="et-save" type="submit" class="btn w-100 mb-0"
                                        style="background: #28c76f; color: white; font-weight: 500;">Save the
                                        Task</button>
                                </div>

                            </div>

                    </form>

                    <script>
                        // Save handler for Employee Task (emptask) - separate backend
                        document.addEventListener('DOMContentLoaded', function() {
                            // Local styles for reminder buttons (keeps state persistent)
                            try {
                                var styleEl = document.getElementById('reminder-hour-inline-style');
                                if (!styleEl) {
                                    styleEl = document.createElement('style');
                                    styleEl.id = 'reminder-hour-inline-style';
                                    styleEl.textContent = '' +
                                        '.reminder-hour-btn{background:#e5e5e5 !important;color:#444 !important;border:none !important;transition:none !important;}' +
                                        '.reminder-hour-btn.active{background:#28c76f !important;color:#fff !important;border:none !important;}' +
                                        '.reminder-hour-btn:focus,.reminder-hour-btn:active,.reminder-hour-btn:hover,.reminder-hour-btn:focus-visible,.reminder-hour-btn:focus-within{box-shadow:none !important;outline:none !important;border:none !important;background:#e5e5e5 !important;}' +
                                        '.reminder-hour-btn.active:focus,.reminder-hour-btn.active:active,.reminder-hour-btn.active:hover,.reminder-hour-btn.active:focus-visible,.reminder-hour-btn.active:focus-within{background:#28c76f !important;color:#fff !important;box-shadow:none !important;outline:none !important;border:none !important;}' +
                                        '.reminder-hour-btn.btn-check:focus+.btn,.reminder-hour-btn.btn:focus{box-shadow:none !important;}';
                                    document.head.appendChild(styleEl);
                                }
                            } catch (_) {}
                            // Reminder hours visual toggle and value handling
                            try {
                                var reminderRadios = document.querySelectorAll('input[name="reminder_hours"]');
                                if (reminderRadios && reminderRadios.length) {
                                    var resetReminderStyles = function() {
                                        reminderRadios.forEach(function(r) {
                                            var lbl = r.closest('label');
                                            if (lbl) {
                                                lbl.classList.remove('active');
                                            }
                                        });
                                    };
                                    var applyActiveStyle = function(radio) {
                                        var lbl = radio && radio.closest('label');
                                        if (lbl) {
                                            lbl.classList.add('active');
                                        }
                                    };
                                    // Initialize styles based on current checked
                                    resetReminderStyles();
                                    var initial = Array.prototype.find.call(reminderRadios, function(r) {
                                        return r.checked;
                                    });
                                    if (!initial && reminderRadios[0]) {
                                        reminderRadios[0].checked = true;
                                    }
                                    applyActiveStyle(initial || reminderRadios[0]);
                                    // Bind change listeners
                                    var handleSelection = function(radio, lbl) {
                                        // Set this radio as checked
                                        reminderRadios.forEach(function(r) {
                                            r.checked = false;
                                            var l = r.closest('label');
                                            if (l) l.setAttribute('aria-pressed', 'false');
                                        });
                                        radio.checked = true;
                                        if (lbl) lbl.setAttribute('aria-pressed', 'true');
                                        // Update styles immediately
                                        resetReminderStyles();
                                        applyActiveStyle(radio);
                                        // Remove focus to prevent blue outline
                                        if (lbl && lbl.blur) lbl.blur();
                                        if (document.activeElement && document.activeElement.blur) document.activeElement
                                    .blur();
                                    };

                                    reminderRadios.forEach(function(radio) {
                                        var lbl = radio.closest('label');
                                        if (lbl) {
                                            lbl.style.userSelect = 'none';
                                            lbl.style.webkitTapHighlightColor = 'transparent';
                                            lbl.setAttribute('role', 'button');
                                            lbl.setAttribute('aria-pressed', 'false');

                                            // Use mousedown for immediate response
                                            lbl.addEventListener('mousedown', function(e) {
                                                e.preventDefault();
                                                e.stopPropagation();
                                                handleSelection(radio, lbl);
                                                return false;
                                            });
                                            // Prevent click default behavior
                                            lbl.addEventListener('click', function(e) {
                                                e.preventDefault();
                                                e.stopPropagation();
                                                return false;
                                            });
                                            // Prevent focus
                                            lbl.addEventListener('focus', function(e) {
                                                e.preventDefault();
                                                this.blur();
                                            });
                                        }
                                    });
                                }
                            } catch (_) {}
                            var saveBtn = document.getElementById('et-save');
                            if (saveBtn && !saveBtn._bound) {
                                saveBtn.addEventListener('click', function(ev) {
                                        try {
                                            ev.preventDefault();
                                            ev.stopPropagation();
                                        } catch (_) {}
                                        try {
                                            var projectEl = document.getElementById('et2-select-project');
                                            var ticketEl = document.getElementById('et2-select-ticket');
                                            var cache = (window.__etCache || {});
                                            var t = cache[(ticketEl || {}).value];
                                            var imgs = [];
                                            for (var i = 1; i <= 4; i++) {
                                                var im = document.getElementById('et-img-' + i);
                                                if (im && im.src && im.src.indexOf('data:image') === 0) {
                                                    imgs.push(im.src);
                                                }
                                            }
                                            var payload = {
                                                project_id: (projectEl || {}).value || null,
                                                ticket_id: (ticketEl || {}).value || null,
                                                start_date: t ? (t.start_date || null) : null,
                                                end_date: t ? (t.end_date || null) : null,
                                                title: (document.getElementById('et-title') || {}).value || '',
                                                priority: (document.getElementById('et-priority') || {}).value || null,
                                                description: (document.getElementById('et-description') || {}).value || '',
                                                day: (document.getElementById('et-day') || {}).value || null,
                                                duration: (document.getElementById('et-duration') || {}).value || null,
                                                reminder_hours: (function() {
                                                    try {
                                                        var r = document.querySelector(
                                                            'input[name="reminder_hours"]:checked');
                                                        return r ? parseInt(r.value, 10) : 6;
                                                    } catch (_) {
                                                        return 6;
                                                    }
                                                })(),
                                                images: imgs,
                                                selected_image: (document.getElementById('et-selected-image') || {}).value || null
                                            };
                                            fetch(\"{{ route('emptasks.store') }}\", {
                                                method: 'POST',
                                                headers: {
                                                    'Content-Type': 'application/json',
                                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                                    'X-Requested-With': 'XMLHttpRequest'
                                                },
                                                body: JSON.stringify(payload)
                                            }).then(function(r) {
                                            return r.json();
                                        }).then(function(resp) {
                                            if (resp && resp.success) {
                                                try {
                                                    var successBox = document.getElementById('emptask-success');
                                                    if (successBox) {
                                                        successBox.style.display = 'block';
                                                        successBox.innerHTML = '<div class=\"alert alert-success\" role=\"alert\" style=\"margin:0;border-radius:8px;\">Employee Task saved successfully.</div>';
                                                        setTimeout(function() {
                                                            try { successBox.style.display = 'none'; successBox.innerHTML = ''; } catch(_) {}
                                                        }, 2500);
                                                    }
                                                } catch (_) {}
                                            } else {
                                                alert('Failed to save employee task');
                                            }
                                        }).catch(function() {
                                            alert('Failed to save employee task');
                                        });
                                    } catch (_) {
                                        alert('Failed to save employee task');
                                    }
                                });
                            saveBtn._bound = true;
                        }
                        });
                    </script>
                    <!-- Right Task List -->
                    <div class="col-md-7" style="border: 3px solid #f7f7f7;border-radius:10px">
                        
                        <div>
                            <div class="mt-1 mb-2">
                                <label class="form-label fw-bold mb-0" style="color: #2b2d42;">Ticket
                                    Details</label><br>
                                <small class="text-muted">Ticket Details</small>
                                <div class="d-flex gap-2 mt-2">
                                    <select id="et2-select-project" name="project_id"
                                        class="form-select form-select-sm"
                                        style="background: #fff; border-radius: 8px;">
                                        <option value="">Select the Project</option>
                                        @if (isset($projects) && count($projects))
                                            @foreach ($projects as $project)
                                                <option value="{{ (string) ($project->_id ?? $project->id) }}">
                                                    {{ $project->title }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <select id="et2-select-ticket" name="ticket_id" class="form-select form-select-sm"
                                        style="background: #fff; border-radius: 8px;">
                                        <option value="">Select the Ticket</option>
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-start mb-2"style="border-bottom:1px solid #F2F2F2;">
                                <!-- Left Side: Title + Subtitle -->
                                <div>
                                    <div class="fw-bold" style="color: #2b2d42;">Project Title Task</div>
                                    <small class="text-muted">Total Task: 5 – Total Checkpoint: 20 ruk</small>
                                </div>

                                <!-- Right Side: Red note -->
                                <div style="color: #ea5455; font-size: 12px;">
                                    Max. 4 Tasks each Ticket
                                </div>
                            </div>

                            <!-- Inline success message placeholder -->
                            <div id="emptask-success" style="display:none; margin-bottom:8px;"></div>

                            <!-- Task Cards -->
                            <div id="emptask-list" style="overflow-y: auto; max-height: 420px;">
                            @foreach ($emptasks ?? [] as $task)
                                @php
                                    $logo = optional($task->project)->logo_path
                                        ? asset('storage/' . ltrim(optional($task->project)->logo_path, '/'))
                                        : asset('build/img/yekbon.svg');
                                    $firstImage =
                                        is_array($task->images) && count($task->images) > 0 ? $task->images[0] : null;
                                            $thumb = $firstImage
                                                ? (preg_match('/^(build\\/|https?:\\/\\/)/', $firstImage)
                                                    ? asset($firstImage)
                                                    : asset('storage/' . ltrim($firstImage, '/')))
                                                : asset('build/img/dooted img.svg');
                                @endphp
                                <div class="d-flex p-2 rounded mt-2 emptask-card" style="background-color: #ebebeb;">
                                    <div class="me-2">
                                        <img src="{{ $thumb }}" alt="Task Image"
                                            style="width: 100px; height: 100px; border-radius: 8px; object-fit: contain; background: transparent; border: none; padding: 0; display:block;">
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div
                                                style="font-weight: 600; font-size: 14px; display: flex; align-items: center;">
                                                <img src="{{ $logo }}" alt=""
                                                    style="width: 30px; height: 30px; margin-right: 6px;">
                                                {{ $task->title }}
                                            </div>
                                            <div class="d-flex align-items-center gap-2" style="position: relative;">
                                                <button
                                                    onclick="event.stopPropagation(); var menu = this.nextElementSibling; menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';"
                                                    style="width: 32px; height: 32px; border-radius: 50%; border: 1px solid #a5acc5; background-color: #f9f9f9; display: flex; align-items: center; justify-content: center; padding: 0;">
                                                    <span
                                                        style="font-size: 18px; color: #2b2d42;">&#x2022;&#x2022;&#x2022;</span>
                                                </button>
                                                <div class="menu-box"
                                                    style="display: none; background: #fff; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); padding: 8px 10px; width: 80px; text-align: center; position: absolute; top: 100%; right: 0; z-index: 1000;"
                                                    onclick="event.stopPropagation();">
                                                    <div
                                                        style="font-size: 12px; color: #7a7a9d; font-weight: 600; margin-bottom: 6px;">
                                                        Options</div>
                                                    <div
                                                        style="display: flex; justify-content: center; align-items: center; gap: 10px;">
                                                        <img src="{{ URL::asset('/build/img/delete1.svg') }}"
                                                            alt="Delete"
                                                            style="width: 20px; height: 20px; cursor: pointer;"
                                                            onclick="emptaskDelete('{{ (string) ($task->_id ?? $task->id) }}')">
                                                        <img src="{{ URL::asset('/build/img/Edit1.svg') }}"
                                                            alt="Edit"
                                                            style="width: 20px; height: 20px; cursor: default; opacity:.4;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="font-size: 12px; color: #6c757d;">
                                            {{ optional($task->ticket)->code ? optional($task->ticket)->code . ' - ' : '' }}{{ optional($task->ticket)->title ?? 'Ticket' }}
                                        </div>
                                        <div style="font-size: 13px; margin-top: 2px;">{{ $task->description ?? '-' }}
                                        </div>
                                        <div class="d-flex justify-content-between mt-2 flex-nowrap"
                                            style="background-color: #fff; border-radius: 10px; padding: 4px;">
                                            <div
                                                style="font-size: 14px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                <small>Start:
                                                    {{ $task->start_date ? \Carbon\Carbon::parse($task->start_date)->format('d.m.Y') : (optional($task->ticket)->start_date ? \Carbon\Carbon::parse(optional($task->ticket)->start_date)->format('d.m.Y') : '--') }}</small>
                                            </div>
                                            <div
                                                style="font-size: 14px; background-color: #e6fff2;  border-radius: 6px; color: #00aa55;">
                                                <small>Deliver:
                                                    {{ $task->end_date ? \Carbon\Carbon::parse($task->end_date)->format('d.m.Y') : (optional($task->ticket)->end_date ? \Carbon\Carbon::parse(optional($task->ticket)->end_date)->format('d.m.Y') : '--') }}</small>
                                            </div>
                                            <div class="d-flex align-items-center"
                                                style="font-size: 11px; background-color: #ff4d4f; color: white; padding: 2px 6px; border-radius: 6px;">
                                                <img src="https://img.icons8.com/ios-filled/16/ffffff/flash-on.png"
                                                    alt="Urgent" style="margin-right: 4px;">
                                                {{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </div>





                        </div>
                        <div class="mt-2 text-end">
                           <button id="et-save" type="submit" class="btn btn-sm"
                                style="background:#28c76f; color:white; font-weight:500; padding:4px 10px;">
                                Save and Close
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        (function() {
            var modalEl = document.getElementById('markerDetailsModal');
            if (!modalEl) return;

            function resetMarkerForm() {
                var ids = ['marker-title', 'marker-description', 'marker-start', 'marker-end'];
                ids.forEach(function(id) {
                    var el = document.getElementById(id);
                    if (el) el.value = '';
                });
                var list = document.getElementById('checkpoints-list');
                if (list) list.innerHTML = '';
            }
            // Clear when the modal is closed so next open is fresh
            modalEl.addEventListener('hidden.bs.modal', function() {
                resetMarkerForm();
            });
            // Also clear on Save & Close
            var saveBtn = document.getElementById('save-marker');
            if (saveBtn) {
                saveBtn.addEventListener('click', function() {
                    // allow any existing save logic to run, then close and reset
                    setTimeout(function() {
                        var inst = bootstrap.Modal.getOrCreateInstance(modalEl);
                        inst.hide();
                        resetMarkerForm();
                    }, 0);
                });
            }
        })();
    </script>
    </div>
    <!-- Task Viewer Modal (Progress-style copy) -->
    <div class="modal fade" id="taskProgressViewerModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content" style="border-radius: 15px;">
                <div class="modal-body p-0" style="max-height: calc(100vh - 120px); overflow-y: auto;">
                    <div
                        style="background: linear-gradient(to right, #74b749, #c5e1a5); color: white; padding: 25px 20px; position: relative;">
                        <div style="text-align: left;">
                            <h5 id="tpvProject" style="margin: 0;">Project Name aim</h5>
                            <small id="tpvTicket">Ticket #1 - Ticket Title</small>
                        </div>
                        <div
                            style="position: absolute; bottom: -30px; left: 50%; transform: translateX(-50%); background: white; border-radius: 50%; padding: 5px;">
                            <img id="tpvLogo" src="{{ URL::asset('/build/img/yekbon.svg') }}" alt="Logo"
                                style="width: 60px; height: 60px; border-radius: 50%;">
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            style="position:absolute; top:12px; right:12px; filter:invert(1);"></button>
                    </div>
                    <div class="p-2">
                        <div
                            style="background-color: #f8f9fa; border-radius: 15px; box-shadow: 0px 0px 5px rgba(0,0,0,0.05);margin-top:25px;">
                            <h5 id="tpvTaskTitle" class="text-center fw-bold mb-3" style="color: #1c2233;">Task Title
                            </h5>
                            <div class="text-center mb-3">
                                <span id="tpvChipStatus" class="badge rounded-pill"
                                    style="background-color: #e4f1d8; color: #0d6efd; font-size: 13px; padding: 8px 12px;">
                                    <img src="{{ URL::asset('/build/img/greenflag.svg') }}" alt="Logo"
                                        style="width: 16px; height: 16px;"> in progress
                                </span>
                                <span id="tpvChipCount" class="badge rounded-pill"
                                    style="background-color: #ff4d4d; color: white; font-size: 13px; padding: 8px 12px;">
                                    <i class="bi bi-lightning-fill me-1"></i> 01
                                </span>
                                <span id="tpvChipLevel" class="badge rounded-pill"
                                    style="background-color: #f1fdf5; color: #22c55e; font-size: 13px; padding: 8px 12px;">
                                    <i class="bi bi-circle-fill me-1" style="font-size: 8px;"></i> Low
                                </span>
                            </div>
                            <div class="d-flex flex-wrap justify-content-around text-center" style="font-size: 14px;">
                                <div>
                                    <div class="text-muted" id="tpvTaskId">Task ID</div>
                                </div>
                                <div>
                                    <div class="text-muted" id="tpvSection">Section</div>
                                </div>
                                <div>
                                    <div><span class="text-success">Start:</span> <span id="tpvStart">-</span></div>
                                </div>
                                <div>
                                    <div><span class="text-success">Deliver:</span> <span id="tpvDeliver">-</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-2 mb-3" style="background-color: #f8f9fa;padding:10px;border-radius:10px;">
                            <strong>Issue Description :</strong>
                            <p id="tpvIssueDesc" style="font-size: 14px; margin-top: 5px;">-</p>
                        </div>
                        <!-- Image Canvas (replaces sign-in box) -->
                        <div id="tpvCanvas" class="mx-auto my-4"
                            style="position:relative; border: 1px solid #ddd; border-radius: 12px; background-color: #fefefe; text-align: center; overflow:hidden; background-image: linear-gradient(45deg, #e6e6e6 25%, transparent 25%), linear-gradient(-45deg, #e6e6e6 25%, transparent 25%), linear-gradient(45deg, transparent 75%, #e6e6e6 75%), linear-gradient(-45deg, transparent 75%, #e6e6e6 75%); background-size: 20px 20px; background-position: 0 0, 0 10px, 10px -10px, -10px 0px;">
                            <img id="tpvImage" src="" alt="Task Board"
                                style="width:100%; border-radius:8px; display:block;">
                            <div id="tpvLayer" style="position:absolute; inset:0; pointer-events:auto;"></div>
                            <div id="tpvFocus"
                                style="position:absolute; border:3px solid #e74c3c; border-radius:6px; box-shadow:0 4px 12px rgba(231,76,60,.35); pointer-events:none; display:none;">
                            </div>
                        </div>
                        <div class="p-3" style="background-color: #f5f5f5; border-radius: 10px;">
                            <div style="font-weight: 600; color: #333; font-size: 14px; margin-bottom: 10px;">• Notes •
                            </div>
                            <div
                                style="background-color: #fff; border-radius: 6px; padding: 8px 12px; margin-bottom: 8px; display: flex; align-items: center;">
                                <img src="{{ URL::asset('/build/img/tera.svg') }}" alt="icon"
                                    style="width: 18px; height: 18px; margin-right: 10px;">
                                <span style="color: #667085; font-size: 13.5px;">Take Backup before start
                                    Development</span>
                            </div>
                            <div
                                style="background-color: #fff; border-radius: 6px; padding: 8px 12px; margin-bottom: 8px; display: flex; align-items: center;">
                                <img src="{{ URL::asset('/build/img/tera.svg') }}" alt="icon"
                                    style="width: 18px; height: 18px; margin-right: 10px;">
                                <span style="color: #667085; font-size: 13.5px;">Work on your Local Server</span>
                            </div>
                            <div
                                style="background-color: #fff; border-radius: 6px; padding: 8px 12px; display: flex; align-items: center;">
                                <img src="{{ URL::asset('/build/img/tera.svg') }}" alt="icon"
                                    style="width: 18px; height: 18px; margin-right: 10px;">
                                <span style="color: #667085; font-size: 13.5px;">Check your work before u deliver the
                                    work</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .viewer-badge {
                background: #ffffff;
                border: 2px solid #28c76f;
                color: #28c76f;
                border-radius: 999px;
                padding: 2px 8px;
                line-height: 1;
                position: absolute;
                transform: translate(-50%, -50%);
                font-weight: 800;
                font-size: 16px;
                box-shadow: 0 2px 8px rgba(0, 0, 0, .12);
                cursor: pointer;
            }
        </style>
        <script>
            async function fetchJson(url) {
                try {
                    const r = await fetch(url, {
                        headers: {
                            'Accept': 'application/json'
                        }
                    });
                    if (!r.ok) return null;
                    return await r.json();
                } catch (_) {
                    return null;
                }
            }
            async function resolveHeaderFromIds(projectId, ticketId) {
                var header = {
                    projectTitle: null,
                    ticketText: null,
                    start: null,
                    end: null,
                    section: null
                };
                if (ticketId) {
                    var t = await fetchJson('/tickets/' + encodeURIComponent(ticketId));
                    if (t && !t.message) {
                        header.projectTitle = t.project_title || null;
                        var codeTxt = t.code || 'Ticket';
                        header.ticketText = codeTxt + (t.title ? (' - ' + t.title) : '');
                        header.start = t.start_date || null;
                        header.end = t.end_date || null;
                        header.section = t.section_name || null;
                    }
                }
                if (!header.projectTitle && projectId) {
                    var list = await fetchJson('/tickets/projects');
                    if (Array.isArray(list)) {
                        var found = list.find(function(p) {
                            return String(p.id) === String(projectId);
                        });
                        if (found) header.projectTitle = found.title;
                    }
                }
                return header;
            }

            function openTaskViewer(card, focusNumber) {
                try {
                    var title = card.getAttribute('data-title') || 'Task';
                    var board = card.getAttribute('data-board') || '';
                    var issues = [];
                    try {
                        issues = JSON.parse(card.getAttribute('data-issues') || '[]') || [];
                    } catch (_) {
                        issues = [];
                    }
                    // Set header and chips; prefer explicit attributes and override with fetch later
                    var projectTitleAttr = card.getAttribute('data-project-title') || card.getAttribute('data-project');
                    var ticketCodeAttr = card.getAttribute('data-ticket-code');
                    var ticketTitleAttr = card.getAttribute('data-ticket-title') || card.getAttribute('data-ticket-text');
                    document.getElementById('tpvProject').textContent = projectTitleAttr || 'Project Name';
                    if (ticketCodeAttr || ticketTitleAttr) {
                        document.getElementById('tpvTicket').textContent = (ticketCodeAttr || 'Ticket') + (ticketTitleAttr ? (
                            ' - ' + ticketTitleAttr) : '');
                    } else {
                        document.getElementById('tpvTicket').textContent = card.getAttribute('data-ticket') ||
                            'Ticket #1 - Ticket Title';
                    }
                    document.getElementById('tpvTaskTitle').textContent = title;
                    document.getElementById('tpvTaskId').textContent = card.getAttribute('data-task-id') || 'Task ID';
                    document.getElementById('tpvSection').textContent = card.getAttribute('data-section') || 'Section';
                    document.getElementById('tpvStart').textContent = card.getAttribute('data-start') || '-';
                    document.getElementById('tpvDeliver').textContent = card.getAttribute('data-deliver') || '-';
                    var logoEl = document.getElementById('tpvLogo');
                    var logoAttr = card.getAttribute('data-project-logo');
                    if (logoEl && logoAttr) {
                        logoEl.src = logoAttr;
                    }
                    (async function() {
                        var pid = card.getAttribute('data-project-id') || card.getAttribute('data-project_id') || card
                            .getAttribute('data-pid');
                        var tid = card.getAttribute('data-ticket-id') || card.getAttribute('data-ticket_id') || card
                            .getAttribute('data-tid');
                        var h = await resolveHeaderFromIds(pid, tid);
                        if (h.projectTitle) {
                            document.getElementById('tpvProject').textContent = h.projectTitle;
                        }
                        if (h.ticketText) {
                            document.getElementById('tpvTicket').textContent = h.ticketText;
                        }
                        if (h.start) {
                            document.getElementById('tpvStart').textContent = h.start;
                        }
                        if (h.end) {
                            document.getElementById('tpvDeliver').textContent = h.end;
                        }
                        if (h.section) {
                            document.getElementById('tpvSection').textContent = h.section;
                        }
                    })();
                    var img = document.getElementById('tpvImage');
                    var layer = document.getElementById('tpvLayer');
                    var focusRect = document.getElementById('tpvFocus');
                    img.src = board || '';
                    if (layer) layer.innerHTML = '';
                    focusRect.style.display = 'none';
                    // scale helpers
                    var savedW = (issues && issues[0] && issues[0].layer && issues[0].layer.width) ? issues[0].layer.width : 0;
                    var savedH = (issues && issues[0] && issues[0].layer && issues[0].layer.height) ? issues[0].layer.height :
                    0;

                    function applyFocus(it) {
                        var rect = document.getElementById('tpvCanvas').getBoundingClientRect();
                        var sx = savedW ? (rect.width) / savedW : 1;
                        var sy = savedH ? (rect.height) / savedH : 1;
                        var cx = (it && it.position && it.position.left ? it.position.left : rect.width / 2) * sx;
                        var cy = (it && it.position && it.position.top ? it.position.top : rect.height / 2) * sy;
                        var bw = (it && it.box && it.box.width ? it.box.width : 140) * sx;
                        var bh = (it && it.box && it.box.height ? it.box.height : 80) * sy;
                        focusRect.style.left = (cx - bw / 2) + 'px';
                        focusRect.style.top = (cy - bh / 2) + 'px';
                        focusRect.style.width = bw + 'px';
                        focusRect.style.height = bh + 'px';
                        focusRect.style.display = 'block';
                    }

                    function renderBadges() {
                        if (layer) layer.innerHTML = '';
                        var rect = document.getElementById('tpvCanvas').getBoundingClientRect();
                        var sx = savedW ? (rect.width) / savedW : 1;
                        var sy = savedH ? (rect.height) / savedH : 1;
                        var used = {};
                        (issues || []).forEach(function(it, idx) {
                            var n = (it && it.number) ? it.number : (idx + 1);
                            var badge = document.createElement('div');
                            badge.textContent = String(n);
                            badge.className = 'viewer-badge';
                            // fallback layout if position missing
                            var baseLeft = (it && it.position && typeof it.position.left === 'number') ? it.position
                                .left : 24;
                            var baseTop = (it && it.position && typeof it.position.top === 'number') ? it.position.top :
                                (24 + idx * 36);
                            var lx = baseLeft * sx;
                            var ly = baseTop * sy;
                            var key = String(Math.round(lx)) + 'x' + String(Math.round(ly));
                            if (used[key] === undefined) {
                                used[key] = 0;
                            } else {
                                used[key]++;
                            }
                            // if overlapping, nudge subsequent ones
                            var k = used[key];
                            var dx = (k % 3 - 1) * 14; // -14, 0, +14
                            var dy = Math.floor(k / 3) * 14; // stack every 3
                            badge.style.left = (lx + dx) + 'px';
                            badge.style.top = (ly + dy) + 'px';
                            badge.style.zIndex = 10 + idx;
                            badge.style.pointerEvents = 'auto';
                            badge.addEventListener('click', function(ev) {
                                ev.stopPropagation();
                                // Show issue details popup if SweetAlert is available
                                if (window.Swal && typeof Swal.fire === 'function') {
                                    var titleText = (it && it.title) ? it.title : 'Issue';
                                    var desc = (it && it.description) ? it.description : '-';
                                    var start = (it && it.start_date) ? it.start_date : '-';
                                    var end = (it && it.end_date) ? it.end_date : '-';
                                    var accent = (it && it.color) ? it.color : '#28c76f';
                                    Swal.fire({
                                        title: '',
                                        html: (
                                            '<div style="text-align:left;">' +
                                            '<div style="font-weight:700; font-size:16px; margin-bottom:8px; color:' +
                                            accent + ';">' + titleText + '</div>' +
                                            '<div style="background:#f8fafc; border:1px solid #eef2f7; border-radius:10px; padding:10px; color:#334155; margin-bottom:10px;">' +
                                            desc + '</div>' +
                                            '<div style="display:flex; gap:10px; flex-wrap:wrap; margin-bottom:10px;">' +
                                            '<span style="background:#ecfdf3; color:#16a34a; border:1px solid #bbf7d0; padding:4px 8px; border-radius:8px; font-weight:600;">Start: ' +
                                            start + '</span>' +
                                            '<span style="background:#ecfdf3; color:#16a34a; border:1px solid #bbf7d0; padding:4px 8px; border-radius:8px; font-weight:600;">End: ' +
                                            end + '</span>' +
                                            '</div>' +
                                            '</div>'
                                        ),
                                        width: 620,
                                        showCloseButton: true,
                                        confirmButtonText: 'Close'
                                    });
                                } else {
                                    var msg = (it && it.title ? (it.title + '\n') : '') +
                                        'Description: ' + ((it && it.description) ? it.description : '-') +
                                        '\n' +
                                        'Start: ' + ((it && it.start_date) ? it.start_date : '-') + '  End: ' +
                                        ((it && it.end_date) ? it.end_date : '-');
                                    alert(msg);
                                }
                            });
                            layer.appendChild(badge);
                        });
                        // no initial rectangle highlight
                    }
                    var isShown = false;
                    var isImgReady = false;

                    function ensureRender() {
                        if (isShown && isImgReady) {
                            renderBadges();
                        }
                    }
                    if (img.complete) {
                        isImgReady = true;
                    } else {
                        img.onload = function() {
                            isImgReady = true;
                            ensureRender();
                        };
                    }
                    var modalEl = document.getElementById('taskProgressViewerModal');

                    function onShown() {
                        isShown = true;
                        ensureRender();
                        window.addEventListener('resize', renderBadges);
                        modalEl.removeEventListener('shown.bs.modal', onShown);
                    }

                    function onHidden() {
                        window.removeEventListener('resize', renderBadges);
                        modalEl.removeEventListener('hidden.bs.modal', onHidden);
                    }
                    modalEl.addEventListener('shown.bs.modal', onShown);
                    modalEl.addEventListener('hidden.bs.modal', onHidden);
                    new bootstrap.Modal(modalEl, {
                        backdrop: true
                    }).show();
                } catch (e) {}
            }
        </script>
    </div>

    <!-- progress Model -->
    <div class="modal fade" id="progressmodel" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content" style="border-radius: 15px; overflow: hidden;">

                <!-- Modal Body -->
                <div class="modal-body p-0">
                    <!-- Header -->
                    <div
                        style="background: linear-gradient(to right, #74b749, #c5e1a5); color: white; padding: 25px 20px; position: relative;">

                        <!-- Text Left-Aligned -->
                        <div style="text-align: left;">
                            <h5 style="margin: 0;">Project Name</h5>
                            <small>Ticket #1 - Ticket Title</small>
                        </div>

                        <!-- Logo Centered, Half Outside -->
                        <div
                            style="position: absolute; bottom: -30px; left: 50%; transform: translateX(-50%); background: white; border-radius: 50%; padding: 5px;">
                            <img src="{{ URL::asset('/build/img/yekbon.svg') }}" alt="Logo"
                                style="width: 60px; height: 60px; border-radius: 50%;">
                        </div>

                    </div>
                    <!-- Task Card -->
                    <div class="p-2">
                        <div
                            style="background-color: #f8f9fa; border-radius: 15px; box-shadow: 0px 0px 5px rgba(0,0,0,0.05);margin-top:25px;">

                            <!-- Title -->
                            <h5 class="text-center fw-bold mb-3" style="color: #1c2233;">Task Title</h5>

                            <!-- Badges Row -->
                            <div class="text-center mb-3">
                                <!-- New Task -->
                                <span class="badge rounded-pill"
                                    style="background-color: #e4f1d8; color: #0d6efd; font-size: 13px; padding: 8px 12px;">
                                    <img src="{{ URL::asset('/build/img/greenflag.svg') }}" alt="Logo"
                                        style="width: 16px; height: 16px;"> in progress
                                </span>

                                <!-- High Priority -->
                                <span class="badge rounded-pill"
                                    style="background-color: #ff4d4d; color: white; font-size: 13px; padding: 8px 12px;">
                                    <i class="bi bi-lightning-fill me-1"></i> 01
                                </span>

                                <!-- Low Status -->
                                <span class="badge rounded-pill"
                                    style="background-color: #f1fdf5; color: #22c55e; font-size: 13px; padding: 8px 12px;">
                                    <i class="bi bi-circle-fill me-1" style="font-size: 8px;"></i> Low
                                </span>
                            </div>

                            <!-- Info Row -->
                            <div class="d-flex flex-wrap justify-content-around text-center" style="font-size: 14px;">
                                <div>
                                    <div class="text-muted">Task ID</div>
                                </div>
                                <div>
                                    <div class="text-muted">Section</div>
                                </div>
                                <div>
                                    <div><span class="text-success">Start:</span> 22.10.2024</div>
                                </div>
                                <div>
                                    <div><span class="text-success">Deliver:</span> 22.10.2024</div>
                                </div>
                            </div>

                        </div>
                        <!-- Issue Description -->
                        <div class="mt-2 mb-3" style="background-color: #f8f9fa;padding:10px;border-radius:10px;">
                            <strong>Issue Description :</strong>
                            <p style="font-size: 14px; margin-top: 5px;">
                                move the close button more down due to its near on the popup
                            </p>
                        </div>
                        <!-- Sign-in Box -->
                        <div class="mx-auto my-4"
                            style="border: 1px solid #ddd; border-radius: 12px; padding: 20px; background-color: #fefefe; text-align: center;">
                            <img src="https://img.icons8.com/ios-filled/100/40C057/right--v1.png"
                                style="width: 40px; margin-bottom: 10px;" alt="Sign In">
                            <h6 style="font-weight: bold;">Sign in</h6>
                            <p style="font-size: 14px; color: #555;">Please use your Login Details for Access</p>

                            <!-- Close Button (positioned lower) -->
                            <div style="margin-top: 25px;">
                                <button class="btn btn-success px-4" data-bs-dismiss="modal">Close</button>
                            </div>

                        </div>
                        <!-- Notes -->
                        <!-- Notes Section (Exact Match) -->
                        <div class="p-3" style="background-color: #f5f5f5; border-radius: 10px;">
                            <div style="font-weight: 600; color: #333; font-size: 14px; margin-bottom: 10px;">• Notes •
                            </div>

                            <!-- Note Items -->
                            <div
                                style="background-color: #fff; border-radius: 6px; padding: 8px 12px; margin-bottom: 8px; display: flex; align-items: center;">
                                <img src="{{ URL::asset('/build/img/tera.svg') }}" alt="icon"
                                    style="width: 18px; height: 18px; margin-right: 10px;">

                                <span style="color: #667085; font-size: 13.5px;">Take Backup before start
                                    Development</span>
                            </div>

                            <div
                                style="background-color: #fff; border-radius: 6px; padding: 8px 12px; margin-bottom: 8px; display: flex; align-items: center;">
                                <img src="{{ URL::asset('/build/img/tera.svg') }}" alt="icon"
                                    style="width: 18px; height: 18px; margin-right: 10px;">
                                <span style="color: #667085; font-size: 13.5px;">Work on your Local Server</span>
                            </div>

                            <div
                                style="background-color: #fff; border-radius: 6px; padding: 8px 12px; display: flex; align-items: center;">
                                <img src="{{ URL::asset('/build/img/tera.svg') }}" alt="icon"
                                    style="width: 18px; height: 18px; margin-right: 10px;">
                                <span style="color: #667085; font-size: 13.5px;">Check your work before u deliver the
                                    work</span>
                            </div>
                        </div>

                        <div style="display: flex; justify-content: space-around; background: #f8f9fa; padding: 20px; border-radius: 10px;"
                            class="mt-3">

                            <!-- Edit the Project -->
                            <div style="text-align: center; flex: 1;cursor:pointer;">
                                <div
                                    style="background: #316b9e; padding: 10px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;">
                                    <img src="{{ asset('build/img/editp.svg') }}" alt="Edit" width="30"
                                        height="30">
                                </div>
                                <div style="margin-top: 6px; color: #1c2b48; font-size: 12px; font-weight: 600;">Edit The
                                    Project</div>
                            </div>


                            <!-- Remove the Project -->
                            <div style="text-align: center; flex: 1; cursor: pointer;" data-bs-toggle="modal"
                                data-bs-target="#removeproject">

                                <div
                                    style="background: #f44336; padding: 10px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;">
                                    <img src="{{ asset('build/img/deletep.svg') }}" alt="Delete" width="30"
                                        height="30">
                                </div>

                                <div style="margin-top: 6px; color: #1c2b48; font-size: 12px; font-weight: 600;">
                                    Remove The Project
                                </div>
                            </div>

                        </div>

                    </div>








                </div> <!-- End .p-3 -->

            </div> <!-- End .modal-body -->

        </div>
    </div>
    <!-- Reject Model -->
    <div class="modal fade" id="inreject" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content" style="border-radius: 15px; overflow: hidden;">

                <!-- Modal Body -->
                <div class="modal-body p-0">
                    <!-- Header -->
                    <div
                        style="background: linear-gradient(to right, #e53935, #f48fb1); color: white; padding: 25px 20px; position: relative;">

                        <!-- Text Left-Aligned -->
                        <div style="text-align: left;">
                            <h5 style="margin: 0;">Project Name</h5>
                            <small>Ticket #1 - Ticket Title</small>
                        </div>

                        <!-- Logo Centered, Half Outside -->
                        <div
                            style="position: absolute; bottom: -30px; left: 50%; transform: translateX(-50%); background: white; border-radius: 50%; padding: 5px;">
                            <img src="{{ URL::asset('/build/img/yekbon.svg') }}" alt="Logo"
                                style="width: 60px; height: 60px; border-radius: 50%;">
                        </div>

                    </div>
                    <!-- Task Card -->
                    <div class="p-2">
                        <div
                            style="background-color: #f8f9fa; border-radius: 15px; box-shadow: 0px 0px 5px rgba(0,0,0,0.05);margin-top:25px;">

                            <!-- Title -->
                            <h5 class="text-center fw-bold mb-3" style="color: #1c2233;">Task Title</h5>

                            <!-- Badges Row -->
                            <div class="text-center mb-3">
                                <!-- New Task -->
                                <span class="badge rounded-pill"
                                    style="background-color: #fbd2d2; color: #2f2e4c; font-size: 13px; padding: 8px 12px;">
                                    <img src="{{ URL::asset('/build/img/redflag.svg') }}" alt="Logo"
                                        style="width: 16px; height: 16px;"> in Reject
                                </span>

                                <!-- High Priority -->
                                <span class="badge rounded-pill"
                                    style="background-color: #ff4d4d; color: white; font-size: 13px; padding: 8px 12px;">
                                    <i class="bi bi-lightning-fill me-1"></i> 01
                                </span>

                                <!-- Low Status -->
                                <span class="badge rounded-pill"
                                    style="background-color: #f1fdf5; color: #22c55e; font-size: 13px; padding: 8px 12px;">
                                    <i class="bi bi-circle-fill me-1" style="font-size: 8px;"></i> Low
                                </span>
                            </div>

                            <!-- Info Row -->
                            <div class="d-flex flex-wrap justify-content-around text-center" style="font-size: 14px;">
                                <div>
                                    <div class="text-muted">Task ID</div>
                                </div>
                                <div>
                                    <div class="text-muted">Section</div>
                                </div>
                                <div>
                                    <div><span class="text-success">Start:</span> 22.10.2024</div>
                                </div>
                                <div>
                                    <div><span class="text-success">Deliver:</span> 22.10.2024</div>
                                </div>
                            </div>

                        </div>
                        <!-- Issue Description -->
                        <div class="mt-2 mb-3" style="background-color: #f8f9fa;padding:10px;border-radius:10px;">
                            <strong>Issue Description :</strong>
                            <p style="font-size: 14px; margin-top: 5px;">
                                move the close button more down due to its near on the popup
                            </p>
                        </div>
                        <!-- Sign-in Box -->
                        <div class="mx-auto my-4"
                            style="border: 1px solid #ddd; border-radius: 12px; padding: 20px; background-color: #fefefe; text-align: center;">
                            <img src="https://img.icons8.com/ios-filled/100/40C057/right--v1.png"
                                style="width: 40px; margin-bottom: 10px;" alt="Sign In">
                            <h6 style="font-weight: bold;">Sign in</h6>
                            <p style="font-size: 14px; color: #555;">Please use your Login Details for Access</p>

                            <!-- Close Button (positioned lower) -->
                            <div style="margin-top: 25px;">
                                <button class="btn btn-success px-4" data-bs-dismiss="modal">Close</button>
                            </div>

                        </div>
                        <!-- Notes -->
                        <!-- Notes Section (Exact Match) -->
                        <div class="p-3" style="background-color: #f5f5f5; border-radius: 10px;">
                            <div style="font-weight: 600; color: #333; font-size: 14px; margin-bottom: 10px;">• Notes •
                            </div>

                            <!-- Note Items -->
                            <div
                                style="background-color: #fff; border-radius: 6px; padding: 8px 12px; margin-bottom: 8px; display: flex; align-items: center;">
                                <img src="{{ URL::asset('/build/img/tera.svg') }}" alt="icon"
                                    style="width: 18px; height: 18px; margin-right: 10px;">

                                <span style="color: #667085; font-size: 13.5px;">Take Backup before start
                                    Development</span>
                            </div>

                            <div
                                style="background-color: #fff; border-radius: 6px; padding: 8px 12px; margin-bottom: 8px; display: flex; align-items: center;">
                                <img src="{{ URL::asset('/build/img/tera.svg') }}" alt="icon"
                                    style="width: 18px; height: 18px; margin-right: 10px;">
                                <span style="color: #667085; font-size: 13.5px;">Work on your Local Server</span>
                            </div>

                            <div
                                style="background-color: #fff; border-radius: 6px; padding: 8px 12px; display: flex; align-items: center;">
                                <img src="{{ URL::asset('/build/img/tera.svg') }}" alt="icon"
                                    style="width: 18px; height: 18px; margin-right: 10px;">
                                <span style="color: #667085; font-size: 13.5px;">Check your work before u deliver the
                                    work</span>
                            </div>
                        </div>
                        <!-- rejct reason -->
                        <div class="mt-2"
                            style="background-color: #fdebec; border-radius: 10px; padding: 10px; text-align: center; font-family: Arial, sans-serif;  margin: auto;">

                            <!-- Icon -->
                            <div
                                style="background: #f44336; padding: 10px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;">
                                <img src="{{ asset('build/img/deletep.svg') }}" alt="Delete" width="30"
                                    height="30">
                            </div>

                            <!-- Text -->
                            <div style="color: #1c2b48; font-size: 14px; font-weight: 600;">
                                The Hold Reason will be here
                            </div>

                        </div>


                        <div style="display: flex; justify-content: space-around; background: #f8f9fa; padding: 20px; border-radius: 10px;"
                            class="mt-3">

                            <!-- Edit the Project -->
                            <div style="text-align: center; flex: 1;cursor:pointer;">
                                <div
                                    style="background: #316b9e; padding: 10px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;">
                                    <img src="{{ asset('build/img/editp.svg') }}" alt="Edit" width="30"
                                        height="30">
                                </div>
                                <div style="margin-top: 6px; color: #1c2b48; font-size: 12px; font-weight: 600;">Edit The
                                    Project</div>
                            </div>


                            <!-- Remove the Project -->
                            <div style="text-align: center; flex: 1; cursor: pointer;" data-bs-toggle="modal"
                                data-bs-target="#removeproject">

                                <div
                                    style="background: #f44336; padding: 10px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;">
                                    <img src="{{ asset('build/img/deletep.svg') }}" alt="Delete" width="30"
                                        height="30">
                                </div>

                                <div style="margin-top: 6px; color: #1c2b48; font-size: 12px; font-weight: 600;">
                                    Remove The Project
                                </div>
                            </div>

                        </div>

                    </div>








                </div> <!-- End .p-3 -->

            </div> <!-- End .modal-body -->

        </div>
    </div>

    <!-- Inhold Model -->
    <div class="modal fade" id="inhold" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content" style="border-radius: 15px; overflow: hidden;">

                <!-- Modal Body -->
                <div class="modal-body p-0">
                    <!-- Header -->
                    <div
                        style="background: linear-gradient(to right, #f9b412, #fde08d);
 color: white; padding: 25px 20px; position: relative;">

                        <!-- Text Left-Aligned -->
                        <div style="text-align: left;">
                            <h5 style="margin: 0;">Project Name</h5>
                            <small>Ticket #1 - Ticket Title</small>
                        </div>

                        <!-- Logo Centered, Half Outside -->
                        <div
                            style="position: absolute; bottom: -30px; left: 50%; transform: translateX(-50%); background: white; border-radius: 50%; padding: 5px;">
                            <img src="{{ URL::asset('/build/img/yekbon.svg') }}" alt="Logo"
                                style="width: 60px; height: 60px; border-radius: 50%;">
                        </div>

                    </div>
                    <!-- Task Card -->
                    <div class="p-2">
                        <div
                            style="background-color: #f8f9fa; border-radius: 15px; box-shadow: 0px 0px 5px rgba(0,0,0,0.05);margin-top:25px;">

                            <!-- Title -->
                            <h5 class="text-center fw-bold mb-3" style="color: #1c2233;">Task Title</h5>

                            <!-- Badges Row -->
                            <div class="text-center mb-3">
                                <!-- New Task -->
                                <span class="badge rounded-pill"
                                    style="background-color: #fff2cc; color: #2f2e4c; font-size: 13px; padding: 8px 12px;">
                                    <img src="{{ URL::asset('/build/img/yelowflag.svg') }}" alt="Logo"
                                        style="width: 16px; height: 16px;"> in Hold
                                </span>

                                <!-- High Priority -->
                                <span class="badge rounded-pill"
                                    style="background-color: #ff4d4d; color: white; font-size: 13px; padding: 8px 12px;">
                                    <i class="bi bi-lightning-fill me-1"></i> 01
                                </span>

                                <!-- Low Status -->
                                <span class="badge rounded-pill"
                                    style="background-color: #f1fdf5; color: #22c55e; font-size: 13px; padding: 8px 12px;">
                                    <i class="bi bi-circle-fill me-1" style="font-size: 8px;"></i> Low
                                </span>
                            </div>

                            <!-- Info Row -->
                            <div class="d-flex flex-wrap justify-content-around text-center" style="font-size: 14px;">
                                <div>
                                    <div class="text-muted">Task ID</div>
                                </div>
                                <div>
                                    <div class="text-muted">Section</div>
                                </div>
                                <div>
                                    <div><span class="text-success">Start:</span> 22.10.2024</div>
                                </div>
                                <div>
                                    <div><span class="text-success">Deliver:</span> 22.10.2024</div>
                                </div>
                            </div>

                        </div>
                        <!-- Issue Description -->
                        <div class="mt-2 mb-3" style="background-color: #f8f9fa;padding:10px;border-radius:10px;">
                            <strong>Issue Description :</strong>
                            <p style="font-size: 14px; margin-top: 5px;">
                                move the close button more down due to its near on the popup
                            </p>
                        </div>
                        <!-- Sign-in Box -->
                        <div class="mx-auto my-4"
                            style="border: 1px solid #ddd; border-radius: 12px; padding: 20px; background-color: #fefefe; text-align: center;">
                            <img src="https://img.icons8.com/ios-filled/100/40C057/right--v1.png"
                                style="width: 40px; margin-bottom: 10px;" alt="Sign In">
                            <h6 style="font-weight: bold;">Sign in</h6>
                            <p style="font-size: 14px; color: #555;">Please use your Login Details for Access</p>

                            <!-- Close Button (positioned lower) -->
                            <div style="margin-top: 25px;">
                                <button class="btn btn-success px-4" data-bs-dismiss="modal">Close</button>
                            </div>

                        </div>
                        <!-- Notes -->
                        <!-- Notes Section (Exact Match) -->
                        <div class="p-3" style="background-color: #f5f5f5; border-radius: 10px;">
                            <div style="font-weight: 600; color: #333; font-size: 14px; margin-bottom: 10px;">• Notes •
                            </div>

                            <!-- Note Items -->
                            <div
                                style="background-color: #fff; border-radius: 6px; padding: 8px 12px; margin-bottom: 8px; display: flex; align-items: center;">
                                <img src="{{ URL::asset('/build/img/tera.svg') }}" alt="icon"
                                    style="width: 18px; height: 18px; margin-right: 10px;">

                                <span style="color: #667085; font-size: 13.5px;">Take Backup before start
                                    Development</span>
                            </div>

                            <div
                                style="background-color: #fff; border-radius: 6px; padding: 8px 12px; margin-bottom: 8px; display: flex; align-items: center;">
                                <img src="{{ URL::asset('/build/img/tera.svg') }}" alt="icon"
                                    style="width: 18px; height: 18px; margin-right: 10px;">
                                <span style="color: #667085; font-size: 13.5px;">Work on your Local Server</span>
                            </div>

                            <div
                                style="background-color: #fff; border-radius: 6px; padding: 8px 12px; display: flex; align-items: center;">
                                <img src="{{ URL::asset('/build/img/tera.svg') }}" alt="icon"
                                    style="width: 18px; height: 18px; margin-right: 10px;">
                                <span style="color: #667085; font-size: 13.5px;">Check your work before u deliver the
                                    work</span>
                            </div>
                        </div>
                        <!-- rejct reason -->
                        <div class="mt-2"
                            style="background-color: #fdebec; border-radius: 10px; padding: 10px; text-align: center; font-family: Arial, sans-serif;  margin: auto;">

                            <!-- Icon -->
                            <div
                                style="background: #f44336; padding: 10px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;">
                                <img src="{{ asset('build/img/deletep.svg') }}" alt="Delete" width="30"
                                    height="30">
                            </div>

                            <!-- Text -->
                            <div style="color: #1c2b48; font-size: 14px; font-weight: 600;">
                                The Hold Reason will be here
                            </div>

                        </div>


                        <div style="display: flex; justify-content: space-around; background: #f8f9fa; padding: 20px; border-radius: 10px;"
                            class="mt-3">

                            <!-- Edit the Project -->
                            <div style="text-align: center; flex: 1;cursor:pointer;">
                                <div
                                    style="background: #316b9e; padding: 10px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;">
                                    <img src="{{ asset('build/img/editp.svg') }}" alt="Edit" width="30"
                                        height="30">
                                </div>
                                <div style="margin-top: 6px; color: #1c2b48; font-size: 12px; font-weight: 600;">Edit The
                                    Project</div>
                            </div>


                            <!-- Remove the Project -->
                            <div style="text-align: center; flex: 1; cursor: pointer;" data-bs-toggle="modal"
                                data-bs-target="#removeproject">

                                <div
                                    style="background: #f44336; padding: 10px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;">
                                    <img src="{{ asset('build/img/deletep.svg') }}" alt="Delete" width="30"
                                        height="30">
                                </div>

                                <div style="margin-top: 6px; color: #1c2b48; font-size: 12px; font-weight: 600;">
                                    Remove The Project
                                </div>
                            </div>

                        </div>

                    </div>








                </div> <!-- End .p-3 -->

            </div> <!-- End .modal-body -->

        </div>
    </div>
    <!-- delayed Model -->
    <div class="modal fade" id="indelayed" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content" style="border-radius: 15px; overflow: hidden;">

                <!-- Modal Body -->
                <div class="modal-body p-0">
                    <!-- Header -->
                    <div
                        style="background: linear-gradient(to right, #ff4081, #ffb6d5); color: white; padding: 25px 20px; position: relative;">

                        <!-- Text Left-Aligned -->
                        <div style="text-align: left;">
                            <h5 style="margin: 0;">Project Name</h5>
                            <small>Ticket #1 - Ticket Title</small>
                        </div>

                        <!-- Logo Centered, Half Outside -->
                        <div
                            style="position: absolute; bottom: -30px; left: 50%; transform: translateX(-50%); background: white; border-radius: 50%; padding: 5px;">
                            <img src="{{ URL::asset('/build/img/yekbon.svg') }}" alt="Logo"
                                style="width: 60px; height: 60px; border-radius: 50%;">
                        </div>

                    </div>
                    <!-- Task Card -->
                    <div class="p-2">
                        <div
                            style="background-color: #f8f9fa; border-radius: 15px; box-shadow: 0px 0px 5px rgba(0,0,0,0.05);margin-top:25px;">

                            <!-- Title -->
                            <h5 class="text-center fw-bold mb-3" style="color: #1c2233;">Task Title</h5>

                            <!-- Badges Row -->
                            <div class="text-center mb-3">
                                <!-- New Task -->
                                <span class="badge rounded-pill"
                                    style="background-color: #f8d0d1; color: #2c2e4a; font-size: 13px; padding: 8px 12px;">
                                    <img src="{{ URL::asset('/build/img/redflag.svg') }}" alt="Logo"
                                        style="width: 16px; height: 16px;"> in delayed
                                </span>

                                <!-- High Priority -->
                                <span class="badge rounded-pill"
                                    style="background-color: #ff4d4d; color: white; font-size: 13px; padding: 8px 12px;">
                                    <i class="bi bi-lightning-fill me-1"></i> 01
                                </span>

                                <!-- Low Status -->
                                <span class="badge rounded-pill"
                                    style="background-color: #f1fdf5; color: #22c55e; font-size: 13px; padding: 8px 12px;">
                                    <i class="bi bi-circle-fill me-1" style="font-size: 8px;"></i> Low
                                </span>
                            </div>

                            <!-- Info Row -->
                            <div class="d-flex flex-wrap justify-content-around text-center" style="font-size: 14px;">
                                <div>
                                    <div class="text-muted">Task ID</div>
                                </div>
                                <div>
                                    <div class="text-muted">Section</div>
                                </div>
                                <div>
                                    <div><span class="text-success">Start:</span> 22.10.2024</div>
                                </div>
                                <div>
                                    <div><span class="text-success">Deliver:</span> 22.10.2024</div>
                                </div>
                            </div>

                        </div>
                        <!-- Issue Description -->
                        <div class="mt-2 mb-3" style="background-color: #f8f9fa;padding:10px;border-radius:10px;">
                            <strong>Issue Description :</strong>
                            <p style="font-size: 14px; margin-top: 5px;">
                                move the close button more down due to its near on the popup
                            </p>
                        </div>
                        <!-- Sign-in Box -->
                        <div class="mx-auto my-4"
                            style="border: 1px solid #ddd; border-radius: 12px; padding: 20px; background-color: #fefefe; text-align: center;">
                            <img src="https://img.icons8.com/ios-filled/100/40C057/right--v1.png"
                                style="width: 40px; margin-bottom: 10px;" alt="Sign In">
                            <h6 style="font-weight: bold;">Sign in</h6>
                            <p style="font-size: 14px; color: #555;">Please use your Login Details for Access</p>

                            <!-- Close Button (positioned lower) -->
                            <div style="margin-top: 25px;">
                                <button class="btn btn-success px-4" data-bs-dismiss="modal">Close</button>
                            </div>

                        </div>
                        <!-- Notes -->
                        <!-- Notes Section (Exact Match) -->
                        <div class="p-3" style="background-color: #f5f5f5; border-radius: 10px;">
                            <div style="font-weight: 600; color: #333; font-size: 14px; margin-bottom: 10px;">• Notes •
                            </div>

                            <!-- Note Items -->
                            <div
                                style="background-color: #fff; border-radius: 6px; padding: 8px 12px; margin-bottom: 8px; display: flex; align-items: center;">
                                <img src="{{ URL::asset('/build/img/tera.svg') }}" alt="icon"
                                    style="width: 18px; height: 18px; margin-right: 10px;">

                                <span style="color: #667085; font-size: 13.5px;">Take Backup before start
                                    Development</span>
                            </div>

                            <div
                                style="background-color: #fff; border-radius: 6px; padding: 8px 12px; margin-bottom: 8px; display: flex; align-items: center;">
                                <img src="{{ URL::asset('/build/img/tera.svg') }}" alt="icon"
                                    style="width: 18px; height: 18px; margin-right: 10px;">
                                <span style="color: #667085; font-size: 13.5px;">Work on your Local Server</span>
                            </div>

                            <div
                                style="background-color: #fff; border-radius: 6px; padding: 8px 12px; display: flex; align-items: center;">
                                <img src="{{ URL::asset('/build/img/tera.svg') }}" alt="icon"
                                    style="width: 18px; height: 18px; margin-right: 10px;">
                                <span style="color: #667085; font-size: 13.5px;">Check your work before u deliver the
                                    work</span>
                            </div>
                        </div>
                        <!-- rejct reason -->
                        <div class="mt-2"
                            style="background-color: #fdebec; border-radius: 10px; padding: 10px; text-align: center; font-family: Arial, sans-serif;  margin: auto;">

                            <!-- Icon -->
                            <div
                                style="background: #f44336; padding: 10px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;">
                                <img src="{{ asset('build/img/deletep.svg') }}" alt="Delete" width="30"
                                    height="30">
                            </div>

                            <!-- Text -->
                            <div style="color: #1c2b48; font-size: 14px; font-weight: 600;">
                                The Hold Reason will be here
                            </div>

                        </div>


                        <div style="display: flex; justify-content: space-around; background: #f8f9fa; padding: 20px; border-radius: 10px;"
                            class="mt-3">

                            <!-- Edit the Project -->
                            <div style="text-align: center; flex: 1;cursor:pointer;">
                                <div
                                    style="background: #316b9e; padding: 10px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;">
                                    <img src="{{ asset('build/img/editp.svg') }}" alt="Edit" width="30"
                                        height="30">
                                </div>
                                <div style="margin-top: 6px; color: #1c2b48; font-size: 12px; font-weight: 600;">Edit The
                                    Project</div>
                            </div>


                            <!-- Remove the Project -->
                            <div style="text-align: center; flex: 1; cursor: pointer;" data-bs-toggle="modal"
                                data-bs-target="#removeproject">

                                <div
                                    style="background: #f44336; padding: 10px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;">
                                    <img src="{{ asset('build/img/deletep.svg') }}" alt="Delete" width="30"
                                        height="30">
                                </div>

                                <div style="margin-top: 6px; color: #1c2b48; font-size: 12px; font-weight: 600;">
                                    Remove The Project
                                </div>
                            </div>

                        </div>

                    </div>

                </div> <!-- End .p-3 -->

            </div> <!-- End .modal-body -->

        </div>
    </div>
    <!-- total task -->
    <div class="modal fade" id="indone" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content" style="border-radius: 15px; overflow: hidden;">

                <!-- Modal Body -->
                <div class="modal-body p-0">
                    <!-- Header -->
                    <div
                        style="background: linear-gradient(to right, #21c064, #a0eac8);
                   color: white; padding: 25px 20px; position: relative;">

                        <!-- Text Left-Aligned -->
                        <div style="text-align: left;">
                            <h5 style="margin: 0;">Project Name</h5>
                            <small>Ticket #1 - Ticket Title</small>
                        </div>

                        <!-- Logo Centered, Half Outside -->
                        <div
                            style="position: absolute; bottom: -30px; left: 50%; transform: translateX(-50%); background: white; border-radius: 50%; padding: 5px;">
                            <img src="{{ URL::asset('/build/img/yekbon.svg') }}" alt="Logo"
                                style="width: 60px; height: 60px; border-radius: 50%;">
                        </div>

                    </div>
                    <!-- Task Card -->
                    <div class="p-2">
                        <div
                            style="background-color: #f8f9fa; border-radius: 15px; box-shadow: 0px 0px 5px rgba(0,0,0,0.05);margin-top:25px;">

                            <!-- Title -->
                            <h5 class="text-center fw-bold mb-3" style="color: #1c2233;">Task Title</h5>

                            <!-- Badges Row -->
                            <div class="text-center mb-3">
                                <!-- New Task -->
                                <span class="badge rounded-pill"
                                    style="background-color: #d6f5e3; color: #2c3e50; font-size: 13px; padding: 8px 12px;">
                                    <img src="{{ URL::asset('/build/img/greenflag.svg') }}" alt="Logo"
                                        style="width: 16px; height: 16px;">in Done
                                </span>

                                <!-- High Priority -->
                                <span class="badge rounded-pill"
                                    style="background-color: #ff4d4d; color: white; font-size: 13px; padding: 8px 12px;">
                                    <i class="bi bi-lightning-fill me-1"></i> 01
                                </span>

                                <!-- Low Status -->
                                <span class="badge rounded-pill"
                                    style="background-color: #f1fdf5; color: #22c55e; font-size: 13px; padding: 8px 12px;">
                                    <i class="bi bi-circle-fill me-1" style="font-size: 8px;"></i> Low
                                </span>
                            </div>

                            <!-- Info Row -->
                            <div class="d-flex flex-wrap justify-content-around text-center" style="font-size: 14px;">
                                <div>
                                    <div class="text-muted">Task ID</div>
                                </div>
                                <div>
                                    <div class="text-muted">Section</div>
                                </div>
                                <div>
                                    <div><span class="text-success">Start:</span> 22.10.2024</div>
                                </div>
                                <div>
                                    <div><span class="text-success">Deliver:</span> 22.10.2024</div>
                                </div>
                            </div>

                        </div>
                        <!-- Issue Description -->
                        <div class="mt-2 mb-3" style="background-color: #f8f9fa;padding:10px;border-radius:10px;">
                            <strong>Issue Description :</strong>
                            <p style="font-size: 14px; margin-top: 5px;">
                                move the close button more down due to its near on the popup
                            </p>
                        </div>
                        <!-- card -->
                        <div class="card text-center p-3"
                            style="border-radius: 16px; border: none; background: #f9f9f9; box-shadow: 0 4px 10px rgba(0,0,0,0.05);  margin: auto;">

                            <!-- TOP SECTION (Background + Profile + Name + Role) -->
                            <div
                                style="width: 160px; margin: auto; background: #fdfdfd; border-radius: 20px; padding-bottom: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.05);">

                                <!-- Background Image -->
                                <div
                                    style="position: relative; height: 60px; overflow: hidden; border-radius: 20px 20px 0 0;">
                                    <img src="{{ URL::asset('/build/img/bgractangle.svg') }}" alt="Background"
                                        style="width: 100%; height: 100%; object-fit: cover;">
                                </div>

                                <!-- Profile Image -->
                                <div style="position: relative; margin-top: -25px;">
                                    <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile"
                                        class="rounded-circle"
                                        style="width: 50px; height: 50px; object-fit: cover; border: 3px solid white;">
                                </div>

                                <!-- Name & Role -->
                                <div class="mt-1">
                                    <h6 style="margin: 0; font-weight: 600; font-size: 13px;">Name Lastname</h6>
                                    <div style="font-size: 11px; color: #e74c3c; font-weight: 500;">Developer</div>
                                </div>
                            </div>

                            <!-- Status Tag -->
                            <div class="my-2">
                                <span
                                    style="background-color: #d4f4e1; color: #27ae60; font-size: 12px; padding: 4px 12px; border-radius: 20px; font-weight: 600;">On
                                    Time</span>
                            </div>

                            <!-- Start / Deliver / Duration -->
                            <div class="d-flex justify-content-between text-center mb-3 px-2"
                                style="font-size: 12px; font-weight: 500;">
                                <div>
                                    <div style="color: #7f8ea3;">Start:</div>
                                    <div style="color: #27ae60;">22.10.2025 - 12:30</div>
                                </div>
                                <div>
                                    <div style="color: #7f8ea3;">Deliver:</div>
                                    <div style="color: #27ae60;">22.10.2025 - 19:30</div>
                                </div>
                                <div>
                                    <div style="color: #7f8ea3;">Time Left:</div>
                                    <div style="color: #2ecc71;">0 day 7 Hr - 30 min</div>
                                </div>
                            </div>

                            <!-- Footer Info: Meetings, Trys, In Hold, In Delayed -->
                            <div class="d-flex justify-content-around text-center pt-2 border-top"
                                style="font-size: 12px;">
                                <div>
                                    <div style="color: #2c3e50;">Meetings:</div>
                                    <div><span style="color: #2c3e50;">3</span> / <span style="color: red;">2 - 1</span>
                                    </div>
                                </div>
                                <div>
                                    <div style="color: #2c3e50;">Trys:</div>
                                    <div style="color: #2c3e50;">3</div>
                                </div>
                                <div>
                                    <div style="color: #2c3e50;">In Hold:</div>
                                    <div style="color: orange;">1</div>
                                </div>
                                <div>
                                    <div style="color: #2c3e50;">In delayed:</div>
                                    <div style="color: red;">0</div>
                                </div>
                            </div>
                        </div>



                        <!-- Sign-in Box -->
                        <div class="mx-auto my-4"
                            style="border: 1px solid #ddd; border-radius: 12px; padding: 20px; background-color: #fefefe; text-align: center;">
                            <img src="https://img.icons8.com/ios-filled/100/40C057/right--v1.png"
                                style="width: 40px; margin-bottom: 10px;" alt="Sign In">
                            <h6 style="font-weight: bold;">Sign in</h6>
                            <p style="font-size: 14px; color: #555;">Please use your Login Details for Access</p>

                            <!-- Close Button (positioned lower) -->
                            <div style="margin-top: 25px;">
                                <button class="btn btn-success px-4" data-bs-dismiss="modal">Close</button>
                            </div>

                        </div>
                        <!-- Notes -->
                        <!-- Notes Section (Exact Match) -->
                        <div class="p-3" style="background-color: #f5f5f5; border-radius: 10px;">
                            <div style="font-weight: 600; color: #333; font-size: 14px; margin-bottom: 10px;">• Notes •
                            </div>

                            <!-- Note Items -->
                            <div
                                style="background-color: #fff; border-radius: 6px; padding: 8px 12px; margin-bottom: 8px; display: flex; align-items: center;">
                                <img src="{{ URL::asset('/build/img/tera.svg') }}" alt="icon"
                                    style="width: 18px; height: 18px; margin-right: 10px;">

                                <span style="color: #667085; font-size: 13.5px;">Take Backup before start
                                    Development</span>
                            </div>

                            <div
                                style="background-color: #fff; border-radius: 6px; padding: 8px 12px; margin-bottom: 8px; display: flex; align-items: center;">
                                <img src="{{ URL::asset('/build/img/tera.svg') }}" alt="icon"
                                    style="width: 18px; height: 18px; margin-right: 10px;">
                                <span style="color: #667085; font-size: 13.5px;">Work on your Local Server</span>
                            </div>

                            <div
                                style="background-color: #fff; border-radius: 6px; padding: 8px 12px; display: flex; align-items: center;">
                                <img src="{{ URL::asset('/build/img/tera.svg') }}" alt="icon"
                                    style="width: 18px; height: 18px; margin-right: 10px;">
                                <span style="color: #667085; font-size: 13.5px;">Check your work before u deliver the
                                    work</span>
                            </div>
                        </div>

                        <div style="display: flex; justify-content: space-around; background: #f8f9fa; padding: 20px; border-radius: 10px;"
                            class="mt-3">

                            <!-- Edit the Project -->
                            <div style="text-align: center; flex: 1;cursor:pointer;">
                                <div
                                    style="background: #316b9e; padding: 10px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;">
                                    <img src="{{ asset('build/img/editp.svg') }}" alt="Edit" width="30"
                                        height="30">
                                </div>
                                <div style="margin-top: 6px; color: #1c2b48; font-size: 12px; font-weight: 600;">Edit The
                                    Project</div>
                            </div>


                            <!-- Remove the Project -->
                            <div style="text-align: center; flex: 1; cursor: pointer;" data-bs-toggle="modal"
                                data-bs-target="#removeproject">

                                <div
                                    style="background: #f44336; padding: 10px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;">
                                    <img src="{{ asset('build/img/deletep.svg') }}" alt="Delete" width="30"
                                        height="30">
                                </div>

                                <div style="margin-top: 6px; color: #1c2b48; font-size: 12px; font-weight: 600;">
                                    Remove The Project
                                </div>
                            </div>

                        </div>

                    </div>








                </div> <!-- End .p-3 -->

            </div> <!-- End .modal-body -->

        </div>
    </div>
    <!-- incheck -->

    <div class="modal fade" id="incheck" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content" style="border-radius: 15px; overflow: hidden;">

                <!-- Modal Body -->
                <div class="modal-body p-0">
                    <!-- Header -->
                    <div
                        style="background: linear-gradient(to right, #c2185b, #e1bee7); color: white; padding: 25px 20px; position: relative;">

                        <!-- Text Left-Aligned -->
                        <div style="text-align: left;">
                            <h5 style="margin: 0;">Project Name</h5>
                            <small>Ticket #1 - Ticket Title</small>
                        </div>

                        <!-- Logo Centered, Half Outside -->
                        <div
                            style="position: absolute; bottom: -30px; left: 50%; transform: translateX(-50%); background: white; border-radius: 50%; padding: 5px;">
                            <img src="{{ URL::asset('/build/img/yekbon.svg') }}" alt="Logo"
                                style="width: 60px; height: 60px; border-radius: 50%;">
                        </div>

                    </div>
                    <!-- Task Card -->
                    <div class="p-2">
                        <div
                            style="background-color: #f8f9fa; border-radius: 15px; box-shadow: 0px 0px 5px rgba(0,0,0,0.05);margin-top:25px;">

                            <!-- Title -->
                            <h5 class="text-center fw-bold mb-3" style="color: #1c2233;">Task Title</h5>

                            <!-- Badges Row -->
                            <div class="text-center mb-3">
                                <!-- New Task -->
                                <span class="badge rounded-pill"
                                    style="background-color: #f3c9e7; color: black; font-size: 13px; padding: 8px 12px;">
                                    <img src="{{ URL::asset('/build/img/jamni.svg') }}" alt="Logo"
                                        style="width: 16px; height: 16px;">Project is in checking
                                </span>

                                <!-- High Priority -->
                                <span class="badge rounded-pill"
                                    style="background-color: #ff4d4d; color: white; font-size: 13px; padding: 8px 12px;">
                                    <i class="bi bi-lightning-fill me-1"></i> 01
                                </span>

                                <!-- Low Status -->
                                <span class="badge rounded-pill"
                                    style="background-color: #f1fdf5; color: #22c55e; font-size: 13px; padding: 8px 12px;">
                                    <i class="bi bi-circle-fill me-1" style="font-size: 8px;"></i> Low
                                </span>
                            </div>

                            <!-- Info Row -->
                            <div class="d-flex flex-wrap justify-content-around text-center" style="font-size: 14px;">
                                <div>
                                    <div class="text-muted">Task ID</div>
                                </div>
                                <div>
                                    <div class="text-muted">Section</div>
                                </div>
                                <div>
                                    <div><span class="text-success">Start:</span> 22.10.2024</div>
                                </div>
                                <div>
                                    <div><span class="text-success">Deliver:</span> 22.10.2024</div>
                                </div>
                            </div>

                        </div>
                        <!-- Issue Description -->
                        <div class="mt-2 mb-3" style="background-color: #f8f9fa;padding:10px;border-radius:10px;">
                            <strong>Issue Description :</strong>
                            <p style="font-size: 14px; margin-top: 5px;">
                                move the close button more down due to its near on the popup
                            </p>
                        </div>
                        <!-- Sign-in Box -->
                        <div class="mx-auto my-4"
                            style="border: 1px solid #ddd; border-radius: 12px; padding: 20px; background-color: #fefefe; text-align: center;">
                            <img src="https://img.icons8.com/ios-filled/100/40C057/right--v1.png"
                                style="width: 40px; margin-bottom: 10px;" alt="Sign In">
                            <h6 style="font-weight: bold;">Sign in</h6>
                            <p style="font-size: 14px; color: #555;">Please use your Login Details for Access</p>

                            <!-- Close Button (positioned lower) -->
                            <div style="margin-top: 25px;">
                                <button class="btn btn-success px-4" data-bs-dismiss="modal">Close</button>
                            </div>

                        </div>
                        <!-- Notes -->
                        <!-- Notes Section-->
                        <div class="p-3" style="background-color: #f5f5f5; border-radius: 10px;">
                            <div style="font-weight: 600; color: #333; font-size: 14px; margin-bottom: 10px;">• Admin
                                Notes •</div>

                            <!-- Note Items -->
                            <div
                                style="background-color: #fff; border-radius: 6px; padding: 8px 12px; margin-bottom: 8px; display: flex; align-items: center;">
                                <img src="{{ URL::asset('/build/img/tera.svg') }}" alt="icon"
                                    style="width: 18px; height: 18px; margin-right: 10px;">

                                <span style="color: #667085; font-size: 13.5px;">Please check the task atachement before
                                    take action</span>
                            </div>
                        </div>
                        <!-- Video Attachments Section -->
                        <div
                            style="background-color: #f5f5f5; border-radius: 10px; padding: 12px 16px; font-family: Arial, sans-serif;margin-top:5px;">

                            <!-- Title -->
                            <div style="color: #1c2b48; font-weight: 600; font-size: 14px; margin-bottom: 10px;">
                                • Video Attachments •
                            </div>

                            <!-- Attachment Input Box -->
                            <div
                                style="background-color: #ffffff; border-radius: 10px; padding: 10px 15px; display: flex; align-items: center;">

                                <!-- Icon -->
                                <div
                                    style="background-color: #cfd3dc; border-radius: 6px; padding: 6px; display: flex; align-items: center; justify-content: center; margin-right: 10px;">
                                    <img src="{{ URL::asset('/build/img/Videocamera.svg') }}" alt="Video Icon"
                                        style="width: 16px; height: 16px;">
                                </div>

                                <!-- Input -->
                                <input type="text" placeholder="Video Link will be here to check the work"
                                    style="border: none; outline: none; width: 100%; font-size: 14px; color: #1c2b48; background-color: transparent;" />
                            </div>

                        </div>
                        <!-- File Attachments Section -->
                        <div class="p-3" style="background-color: #f5f5f5; border-radius: 10px; margin-top:5px;">
                            <div style="font-weight: 600; color: #333; font-size: 14px; margin-bottom: 15px;">• File
                                Attachments •</div>

                            <div class="d-flex flex-wrap gap-3">

                                <!-- File Box -->
                                <div
                                    style="background-color: #ffffff; border-radius: 10px; padding: 10px 12px; display: flex; align-items: center; gap: 10px; min-width: 200px;">
                                    <img src="#" alt="PDF" style="width: 32px; height: 32px;">
                                    <div style="flex: 1;">
                                        <div style="font-size: 13px; font-weight: 500; color: #374151;">File Title.pdf
                                        </div>
                                        <div style="font-size: 11px; color: #9ca3af;">94 KB of 94 KB</div>
                                    </div>
                                    <img src="#" alt="D" style="width: 16px; height: 16px;">
                                </div>

                                <!-- File Box Copy 2 -->
                                <div
                                    style="background-color: #ffffff; border-radius: 10px; padding: 10px 12px; display: flex; align-items: center; gap: 10px; min-width: 200px;">
                                    <img src="pdf-icon.svg" alt="PDF" style="width: 32px; height: 32px;">
                                    <div style="flex: 1;">
                                        <div style="font-size: 13px; font-weight: 500; color: #374151;">File Title.pdf
                                        </div>
                                        <div style="font-size: 11px; color: #9ca3af;">94 KB of 94 KB</div>
                                    </div>
                                    <img src="download-icon.svg" alt="d" style="width: 16px; height: 16px;">
                                </div>

                                <!-- File Box Copy 3 -->
                                <!-- <div style="background-color: #ffffff; border-radius: 10px; padding: 10px 12px; display: flex; align-items: center; gap: 10px; min-width: 200px;">
                                    <img src="pdf-icon.svg" alt="PDF" style="width: 32px; height: 32px;">
                                    <div style="flex: 1;">
                                        <div style="font-size: 13px; font-weight: 500; color: #374151;">File Title.pdf</div>
                                        <div style="font-size: 11px; color: #9ca3af;">94 KB of 94 KB</div>
                                    </div>
                                    <img src="download-icon.svg" alt="Download" style="width: 16px; height: 16px;">
                                </div> -->

                            </div>
                        </div>



                        <div style="display: flex; justify-content: space-around; background: #f8f9fa; padding: 20px; border-radius: 10px;"
                            class="mt-3">

                            <!-- Edit the Project -->
                            <div style="text-align: center; flex: 1;cursor:pointer;">
                                <div
                                    style="background: #316b9e; padding: 10px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;">
                                    <img src="{{ asset('build/img/editp.svg') }}" alt="Edit" width="30"
                                        height="30">
                                </div>
                                <div style="margin-top: 6px; color: #1c2b48; font-size: 12px; font-weight: 600;">Edit The
                                    Task</div>
                            </div>
                            <!-- reject the task -->
                            <div style="text-align: center; flex: 1;cursor:pointer;" data-bs-toggle="modal"
                                data-bs-target="#moveToRejectModal">
                                <div
                                    style="background: #d86a89; padding: 10px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;">
                                    <img src="{{ asset('build/img/rejecttask.svg') }}" alt="Edit" width="30"
                                        height="30">
                                </div>
                                <div style="margin-top: 6px; color: #1c2b48; font-size: 12px; font-weight: 600;">Reject
                                    The Task</div>
                            </div>


                            <!-- mark  the DOne -->
                            <div style="text-align: center; flex: 1; cursor: pointer;" data-bs-toggle="modal"
                                data-bs-target="#moveToDoneModal">

                                <div
                                    style="background: #1ec963;padding: 10px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;">
                                    <img src="{{ asset('build/img/markdone.svg') }}" alt="Delete" width="30"
                                        height="30">
                                </div>

                                <div style="margin-top: 6px; color: #1c2b48; font-size: 12px; font-weight: 600;">
                                    Mark as Done
                                </div>
                            </div>

                        </div>

                    </div>








                </div> <!-- End .p-3 -->

            </div> <!-- End .modal-body -->

        </div>
    </div>
    <!-- in done -->
    <div class="modal fade" id="totaltask" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content" style="border-radius: 15px; overflow: hidden;">

                <!-- Modal Body -->
                <div class="modal-body p-0">
                    <!-- Header -->
                    <div
                        style="background: linear-gradient(to right, #2980b9, #6dd5fa); color: white; padding: 25px 20px; position: relative;">

                        <!-- Text Left-Aligned -->
                        <div style="text-align: left;">
                            <h5 style="margin: 0;">Project Name</h5>
                            <small>Ticket #1 - Ticket Title</small>
                        </div>

                        <!-- Logo Centered, Half Outside -->
                        <div
                            style="position: absolute; bottom: -30px; left: 50%; transform: translateX(-50%); background: white; border-radius: 50%; padding: 5px;">
                            <img src="{{ URL::asset('/build/img/yekbon.svg') }}" alt="Logo"
                                style="width: 60px; height: 60px; border-radius: 50%;">
                        </div>

                    </div>
                    <!-- Task Card -->
                    <div class="p-2">
                        <div
                            style="background-color: #f8f9fa; border-radius: 15px; box-shadow: 0px 0px 5px rgba(0,0,0,0.05);margin-top:25px;">

                            <!-- Title -->
                            <h5 class="text-center fw-bold mb-3" style="color: #1c2233;">Task Title</h5>

                            <!-- Badges Row -->
                            <div class="text-center mb-3">
                                <!-- New Task -->
                                <span class="badge rounded-pill"
                                    style="background-color: #d7eefe; color: black; font-size: 13px; padding: 8px 12px;">
                                    <img src="{{ URL::asset('/build/img/blueflag.svg') }}" alt="Logo"
                                        style="width: 16px; height: 16px;"> New Task
                                </span>

                                <!-- High Priority -->
                                <span class="badge rounded-pill"
                                    style="background-color: #ff4d4d; color: white; font-size: 13px; padding: 8px 12px;">
                                    <i class="bi bi-lightning-fill me-1"></i> 01
                                </span>

                                <!-- Low Status -->
                                <span class="badge rounded-pill"
                                    style="background-color: #f1fdf5; color: #22c55e; font-size: 13px; padding: 8px 12px;">
                                    <i class="bi bi-circle-fill me-1" style="font-size: 8px;"></i> Low
                                </span>
                            </div>

                            <!-- Info Row -->
                            <div class="d-flex flex-wrap justify-content-around text-center" style="font-size: 14px;">
                                <div>
                                    <div class="text-muted">Task ID</div>
                                </div>
                                <div>
                                    <div class="text-muted">Section</div>
                                </div>
                                <div>
                                    <div><span class="text-success">Start:</span> 22.10.2024</div>
                                </div>
                                <div>
                                    <div><span class="text-success">Deliver:</span> 22.10.2024</div>
                                </div>
                            </div>

                        </div>
                        <!-- Issue Description -->
                        <div class="mt-2 mb-3" style="background-color: #f8f9fa;padding:10px;border-radius:10px;">
                            <strong>Issue Description :</strong>
                            <p style="font-size: 14px; margin-top: 5px;">
                                move the close button more down due to its near on the popup
                            </p>
                        </div>
                        <!-- Sign-in Box -->
                        <div class="mx-auto my-4"
                            style="border: 1px solid #ddd; border-radius: 12px; padding: 20px; background-color: #fefefe; text-align: center;">
                            <img src="https://img.icons8.com/ios-filled/100/40C057/right--v1.png"
                                style="width: 40px; margin-bottom: 10px;" alt="Sign In">
                            <h6 style="font-weight: bold;">Sign in</h6>
                            <p style="font-size: 14px; color: #555;">Please use your Login Details for Access</p>

                            <!-- Close Button (positioned lower) -->
                            <div style="margin-top: 25px;">
                                <button class="btn btn-success px-4" data-bs-dismiss="modal">Close</button>
                            </div>

                        </div>
                        <!-- Notes -->
                        <!-- Notes Section-->
                        <div class="p-3" style="background-color: #f5f5f5; border-radius: 10px;">
                            <div style="font-weight: 600; color: #333; font-size: 14px; margin-bottom: 10px;">• Admin
                                Notes •</div>

                            <!-- Note Items -->
                            <div
                                style="background-color: #fff; border-radius: 6px; padding: 8px 12px; margin-bottom: 8px; display: flex; align-items: center;">
                                <img src="{{ URL::asset('/build/img/tera.svg') }}" alt="icon"
                                    style="width: 18px; height: 18px; margin-right: 10px;">

                                <span style="color: #667085; font-size: 13.5px;">Please check the task atachement before
                                    take action</span>
                            </div>
                        </div>
                        <!-- Video Attachments Section -->
                        <div
                            style="background-color: #f5f5f5; border-radius: 10px; padding: 12px 16px; font-family: Arial, sans-serif;margin-top:5px;">

                            <!-- Title -->
                            <div style="color: #1c2b48; font-weight: 600; font-size: 14px; margin-bottom: 10px;">
                                • Video Attachments •
                            </div>

                            <!-- Attachment Input Box -->
                            <div
                                style="background-color: #ffffff; border-radius: 10px; padding: 10px 15px; display: flex; align-items: center;">

                                <!-- Icon -->
                                <div
                                    style="background-color: #cfd3dc; border-radius: 6px; padding: 6px; display: flex; align-items: center; justify-content: center; margin-right: 10px;">
                                    <img src="{{ URL::asset('/build/img/Videocamera.svg') }}" alt="Video Icon"
                                        style="width: 16px; height: 16px;">
                                </div>

                                <!-- Input -->
                                <input type="text" placeholder="Video Link will be here to check the work"
                                    style="border: none; outline: none; width: 100%; font-size: 14px; color: #1c2b48; background-color: transparent;" />
                            </div>

                        </div>
                        <!-- File Attachments Section -->
                        <div class="p-3" style="background-color: #f5f5f5; border-radius: 10px; margin-top:5px;">
                            <div style="font-weight: 600; color: #333; font-size: 14px; margin-bottom: 15px;">• File
                                Attachments •</div>

                            <div class="d-flex flex-wrap gap-3">

                                <!-- File Box -->
                                <div
                                    style="background-color: #ffffff; border-radius: 10px; padding: 10px 12px; display: flex; align-items: center; gap: 10px; min-width: 200px;">
                                    <img src="pdf-icon.svg" alt="PDF" style="width: 32px; height: 32px;">
                                    <div style="flex: 1;">
                                        <div style="font-size: 13px; font-weight: 500; color: #374151;">File Title.pdf
                                        </div>
                                        <div style="font-size: 11px; color: #9ca3af;">94 KB of 94 KB</div>
                                    </div>
                                    <img src="download-icon.svg" alt="Download" style="width: 16px; height: 16px;">
                                </div>

                                <!-- File Box Copy 2 -->
                                <div
                                    style="background-color: #ffffff; border-radius: 10px; padding: 10px 12px; display: flex; align-items: center; gap: 10px; min-width: 200px;">
                                    <img src="pdf-icon.svg" alt="PDF" style="width: 32px; height: 32px;">
                                    <div style="flex: 1;">
                                        <div style="font-size: 13px; font-weight: 500; color: #374151;">File Title.pdf
                                        </div>
                                        <div style="font-size: 11px; color: #9ca3af;">94 KB of 94 KB</div>
                                    </div>
                                    <img src="download-icon.svg" alt="Download" style="width: 16px; height: 16px;">
                                </div>



                            </div>
                        </div>



                        <div style="display: flex; justify-content: space-around; background: #f8f9fa; padding: 20px; border-radius: 10px;"
                            class="mt-3">

                            <!-- Edit the Project -->
                            <div style="text-align: center; flex: 1;cursor:pointer;">
                                <div
                                    style="background: #316b9e; padding: 10px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;">
                                    <img src="{{ asset('build/img/editp.svg') }}" alt="Edit" width="30"
                                        height="30">
                                </div>
                                <div style="margin-top: 6px; color: #1c2b48; font-size: 12px; font-weight: 600;">Edit The
                                    Project</div>
                            </div>


                            <!-- Remove the Project -->
                            <div style="text-align: center; flex: 1; cursor: pointer;" data-bs-toggle="modal"
                                data-bs-target="#removeproject">

                                <div
                                    style="background: #f44336; padding: 10px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;">
                                    <img src="{{ asset('build/img/deletep.svg') }}" alt="Delete" width="30"
                                        height="30">
                                </div>

                                <div style="margin-top: 6px; color: #1c2b48; font-size: 12px; font-weight: 600;">
                                    Remove The Project
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- moveToDoneModal Modal -->
    <div class="modal fade" id="moveToDoneModal" tabindex="-1" aria-labelledby="moveToDoneLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content p-3"
                style="border-radius: 16px; background-color: #fdfdfd; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">

                <!-- Modal Header -->
                <h5 class=" mb-2" style="font-weight: 600;">Move the Task to Done</h5>

                <!-- Task Info Section -->
                <div style="background: #f9f9fb; padding: 16px; border-radius: 16px;">

                    <!-- Task Title -->
                    <div class="text-center mb-2">
                        <h5 style="font-weight: 700; color: #2c3e50;">Task Title</h5>
                    </div>

                    <!-- Task Badges -->
                    <div class="text-center mb-3 d-flex justify-content-center flex-wrap gap-2">
                        <!-- Status -->
                        <span class="badge rounded-pill d-flex align-items-center gap-1"
                            style="background-color: #f3c9e7; color: black; font-size: 13px; padding: 6px 10px;">
                            <img src="{{ URL::asset('/build/img/jamni.svg') }}" alt="Icon"
                                style="width: 14px; height: 14px;">
                            Project is in Checking
                        </span>

                        <!-- Priority -->
                        <span class="badge rounded-pill d-flex align-items-center gap-1"
                            style="background-color: #ff4d4d; color: white; font-size: 13px; padding: 6px 12px;">
                            <i class="bi bi-lightning-fill"></i> 01
                        </span>

                        <!-- Status Level -->
                        <span class="badge rounded-pill d-flex align-items-center gap-1"
                            style="background-color: #f1fdf5; color: #22c55e; font-size: 13px; padding: 6px 12px;">
                            <i class="bi bi-circle-fill" style="font-size: 8px;"></i> Low
                        </span>
                    </div>

                    <!-- Task Meta Info Row -->
                    <div class="d-flex justify-content-around text-center" style="font-size: 12px; font-weight: 500;">
                        <div style="color: #2c3e50;"><strong>Task ID</strong></div>
                        <div style="color: #2c3e50;"><strong>Section</strong></div>
                        <div><span style="color: #27ae60;">Start:</span> 22.10.2024</div>
                        <div><span style="color: #27ae60;">Deliver:</span> 22.10.2024</div>
                    </div>

                </div>


                <!-- Developer Card -->
                <div class="card text-center p-3 mt-2 mb-3"
                    style="border-radius: 16px; border: none; background: #f9f9f9; ">
                    <div
                        style="width: 160px; margin: auto; background: #fdfdfd; border-radius: 20px; padding-bottom: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.05);">
                        <div style="position: relative; height: 60px; overflow: hidden; border-radius: 20px 20px 0 0;">
                            <img src="{{ URL::asset('/build/img/bgractangle.svg') }}" alt="Background"
                                style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div style="position: relative; margin-top: -25px;">
                            <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile"
                                class="rounded-circle"
                                style="width: 50px; height: 50px; object-fit: cover; border: 3px solid white;">
                        </div>
                        <div class="mt-1">
                            <h6 style="margin: 0; font-weight: 600; font-size: 13px;">Name Lastname</h6>
                            <div style="font-size: 11px; color: #e74c3c; font-weight: 500;">Developer</div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="my-2">
                        <span
                            style="background-color: #d4f4e1; color: #27ae60; font-size: 12px; padding: 4px 12px; border-radius: 20px; font-weight: 600;">On
                            Time</span>
                    </div>

                    <!-- Timeline -->
                    <div class="d-flex justify-content-between text-center mb-3 px-2"
                        style="font-size: 12px; font-weight: 500;">
                        <div>
                            <div style="color: #7f8ea3;">Start:</div>
                            <div style="color: #27ae60;">22.10.2025 - 12:30</div>
                        </div>
                        <div>
                            <div style="color: #7f8ea3;">Deliver:</div>
                            <div style="color: #27ae60;">22.10.2025 - 19:30</div>
                        </div>
                        <div>
                            <div style="color: #7f8ea3;">Time Left:</div>
                            <div style="color: #2ecc71;">0 day 7 Hr - 30 min</div>
                        </div>
                    </div>

                    <!-- Footer Stats -->
                    <div class="d-flex justify-content-around text-center pt-2 border-top" style="font-size: 12px;">
                        <div>
                            <div style="color: #2c3e50;">Meetings:</div>
                            <div><span style="color: #2c3e50;">3</span> / <span style="color: red;">2 - 1</span></div>
                        </div>
                        <div>
                            <div style="color: #2c3e50;">Trys:</div>
                            <div style="color: #2c3e50;">3</div>
                        </div>
                        <div>
                            <div style="color: #2c3e50;">In Hold:</div>
                            <div style="color: orange;">1</div>
                        </div>
                        <div>
                            <div style="color: #2c3e50;">In delayed:</div>
                            <div style="color: red;">0</div>
                        </div>
                    </div>
                </div>

                <!-- Rate the Developer -->
                <div class="mt-3 text-left" style="background: #f9f9fb; padding: 16px; border-radius: 16px;">
                    <strong style="font-size: 13px;">Rate the Developer</strong>

                    <!-- Rating Rows (No PHP) -->
                    <div class="mt-2" style="font-size: 13px;">
                        <div class="d-flex align-items-center justify-content-between mb-2"
                            style="background: #fff; padding: 9px;border-radius:10px;">
                            <span>Reliability</span>
                            <span>⭐⭐⭐☆☆</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2"
                            style="background: #fff; padding: 9px;border-radius:10px;">
                            <span>Punctuality</span>
                            <span>⭐⭐⭐☆☆</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2"
                            style="background: #fff; padding: 9px;border-radius:10px;">
                            <span>Accuracy</span>
                            <span>⭐⭐⭐☆☆</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2"
                            style="background: #fff; padding: 9px;border-radius:10px;">
                            <span>Quality</span>
                            <span>⭐⭐⭐☆☆</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2"
                            style="background: #fff; padding: 9px;border-radius:10px;">
                            <span>Work Independently</span>
                            <span>⭐⭐⭐☆☆</span>
                        </div>
                    </div>
                </div>

                <!-- Modal Buttons -->
                <div class="d-flex justify-content-between mt-3">
                    <button class="btn btn-light" data-bs-dismiss="modal" style="border-radius: 8px;">Close</button>
                    <button class="btn btn-success" data-bs-dismiss="modal" style="border-radius: 8px;">Save &
                        Close</button>
                </div>

            </div>
        </div>
    </div>
    <!-- moveToRejectModal Modal -->
    <div class="modal fade" id="moveToRejectModal" tabindex="-1" aria-labelledby="moveToDoneLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content p-3"
                style="border-radius: 16px; background-color: #fdfdfd; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">

                <!-- Modal Header -->
                <h5 class=" mb-2" style="font-weight: 600;">Reject the Task</h5>

                <!-- Task Info Section -->
                <div style="background: #f9f9fb; padding: 16px; border-radius: 16px;">

                    <!-- Task Title -->
                    <div class="text-center mb-2">
                        <h5 style="font-weight: 700; color: #2c3e50;">Task Title</h5>
                    </div>

                    <!-- Task Badges -->
                    <div class="text-center mb-3 d-flex justify-content-center flex-wrap gap-2">
                        <!-- Status -->
                        <span class="badge rounded-pill d-flex align-items-center gap-1"
                            style="background-color: #f3c9e7; color: black; font-size: 13px; padding: 6px 10px;">
                            <img src="{{ URL::asset('/build/img/jamni.svg') }}" alt="Icon"
                                style="width: 14px; height: 14px;">
                            Project is in Checking
                        </span>

                        <!-- Priority -->
                        <span class="badge rounded-pill d-flex align-items-center gap-1"
                            style="background-color: #ff4d4d; color: white; font-size: 13px; padding: 6px 12px;">
                            <i class="bi bi-lightning-fill"></i> 01
                        </span>

                        <!-- Status Level -->
                        <span class="badge rounded-pill d-flex align-items-center gap-1"
                            style="background-color: #f1fdf5; color: #22c55e; font-size: 13px; padding: 6px 12px;">
                            <i class="bi bi-circle-fill" style="font-size: 8px;"></i> Low
                        </span>
                    </div>

                    <!-- Task Meta Info Row -->
                    <div class="d-flex justify-content-around text-center" style="font-size: 12px; font-weight: 500;">
                        <div style="color: #2c3e50;"><strong>Task ID</strong></div>
                        <div style="color: #2c3e50;"><strong>Section</strong></div>
                        <div><span style="color: #27ae60;">Start:</span> 22.10.2024</div>
                        <div><span style="color: #27ae60;">Deliver:</span> 22.10.2024</div>
                    </div>

                </div>

                <!-- Try Section -->
                <div class="mt-3"
                    style="background: #f9f9fb; padding: 12px 16px; border-radius: 12px; font-size: 13px;">

                    <!-- Try Info -->
                    <div class="d-flex justify-content-between align-items-center mb-3"
                        style="font-weight: 500;background:#fff;padding:4px;border-radius:10px;">
                        <div>
                            <span style="color: #2c3e50;">Try #1 - </span>
                            <span style="color: #7f8ea3;">22.10.2024 - 12:30 ~ 12:55</span>
                        </div>

                        <!-- Rejected Reason -->
                        <div class="d-flex align-items-center" style="gap: 5px;">
                            <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Avatar"
                                class="rounded-circle" style="width: 20px; height: 20px; object-fit: cover;">
                            <span style="color: #ff6699; font-weight: 500;">Rejected Reason here</span>
                        </div>
                    </div>

                    <!-- Timeline Statuses -->
                    <div class="d-flex justify-content-between text-center" style="font-size: 12px; font-weight: 500;">

                        <!-- Started -->
                        <div style="width: 30%;">
                            <div class="d-flex align-items-center justify-content-center gap-1 mb-1">
                                <img src="{{ URL::asset('/build/img/profile.svg') }}" class="rounded-circle"
                                    style="width: 16px; height: 16px;">
                                <span style="color: #4caf50;">Started: 12:55</span>
                            </div>
                            <div style="height: 6px; background-color: #4caf50; border-radius: 10px;"></div>
                        </div>

                        <!-- In Checked -->
                        <div style="width: 30%;">
                            <div class="d-flex align-items-center justify-content-center gap-1 mb-1">
                                <img src="{{ URL::asset('/build/img/profile.svg') }}" class="rounded-circle"
                                    style="width: 16px; height: 16px;">
                                <span style="color: #9b59b6;">In Checked: 12:55</span>
                            </div>
                            <div style="height: 6px; background-color: #9b59b6; border-radius: 10px;"></div>
                        </div>

                        <!-- Rejected -->
                        <div style="width: 30%;">
                            <div class="d-flex align-items-center justify-content-center gap-1 mb-1">
                                <img src="{{ URL::asset('/build/img/profile.svg') }}" class="rounded-circle"
                                    style="width: 16px; height: 16px;">
                                <span style="color: #ec407a;">Rejected: 13:25</span>
                            </div>
                            <div style="height: 6px; background-color: #ec407a; border-radius: 10px;"></div>
                        </div>

                    </div>
                </div>
                <!-- Try Section -->
                <div class="mt-3"
                    style="background: #f9f9fb; padding: 12px 16px; border-radius: 12px; font-size: 13px;">

                    <!-- Try Info -->
                    <div class="d-flex justify-content-between align-items-center mb-3"
                        style="font-weight: 500;background:#fff;padding:4px;border-radius:10px;">
                        <div>
                            <span style="color: #2c3e50;">Try #1 - </span>
                            <span style="color: #7f8ea3;">22.10.2024 - 12:30 ~ 12:55</span>
                        </div>

                        <!-- Rejected Reason -->
                        <div class="d-flex align-items-center" style="gap: 5px;">
                            <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Avatar"
                                class="rounded-circle" style="width: 20px; height: 20px; object-fit: cover;">
                            <span style="color: #ff6699; font-weight: 500;">Rejected Reason here</span>
                        </div>
                    </div>

                    <!-- Timeline Statuses -->
                    <div class="d-flex justify-content-between text-center" style="font-size: 12px; font-weight: 500;">

                        <!-- Started -->
                        <div style="width: 30%;">
                            <div class="d-flex align-items-center justify-content-center gap-1 mb-1">
                                <img src="{{ URL::asset('/build/img/profile.svg') }}" class="rounded-circle"
                                    style="width: 16px; height: 16px;">
                                <span style="color: #4caf50;">Started: 12:55</span>
                            </div>
                            <div style="height: 6px; background-color: #4caf50; border-radius: 10px;"></div>
                        </div>

                        <!-- In Checked -->
                        <div style="width: 30%;">
                            <div class="d-flex align-items-center justify-content-center gap-1 mb-1">
                                <img src="{{ URL::asset('/build/img/profile.svg') }}" class="rounded-circle"
                                    style="width: 16px; height: 16px;">
                                <span style="color: #9b59b6;">In Checked: 12:55</span>
                            </div>
                            <div style="height: 6px; background-color: #9b59b6; border-radius: 10px;"></div>
                        </div>

                        <!-- Rejected -->
                        <div style="width: 30%;">
                            <div class="d-flex align-items-center justify-content-center gap-1 mb-1">
                                <img src="{{ URL::asset('/build/img/profile.svg') }}" class="rounded-circle"
                                    style="width: 16px; height: 16px;">
                                <span style="color: #ec407a;">Rejected: 13:25</span>
                            </div>
                            <div style="height: 6px; background-color: #ec407a; border-radius: 10px;"></div>
                        </div>

                    </div>
                </div>
                <!-- Try Section -->
                <div class="mt-3"
                    style="background: #f9f9fb; padding: 12px 16px; border-radius: 12px; font-size: 13px;">

                    <!-- Try Info -->
                    <div class="d-flex justify-content-between align-items-center mb-3"
                        style="font-weight: 500;background:#fff;padding:4px;border-radius:10px;">
                        <div>
                            <span style="color: #2c3e50;">Try #1 - </span>
                            <span style="color: #7f8ea3;">22.10.2024 - 12:30 ~ 12:55</span>
                        </div>

                        <!-- Rejected Reason -->
                        <div class="d-flex align-items-center" style="gap: 5px;">
                            <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Avatar"
                                class="rounded-circle" style="width: 20px; height: 20px; object-fit: cover;">
                            <span style="color: #ff6699; font-weight: 500;">Rejected Reason here</span>
                        </div>
                    </div>

                    <!-- Timeline Statuses -->
                    <div class="d-flex justify-content-between text-center" style="font-size: 12px; font-weight: 500;">

                        <!-- Started -->
                        <div style="width: 30%;">
                            <div class="d-flex align-items-center justify-content-center gap-1 mb-1">
                                <img src="{{ URL::asset('/build/img/profile.svg') }}" class="rounded-circle"
                                    style="width: 16px; height: 16px;">
                                <span style="color: #4caf50;">Started: 12:55</span>
                            </div>
                            <div style="height: 6px; background-color: #4caf50; border-radius: 10px;"></div>
                        </div>

                        <!-- In Checked -->
                        <div style="width: 30%;">
                            <div class="d-flex align-items-center justify-content-center gap-1 mb-1">
                                <img src="{{ URL::asset('/build/img/profile.svg') }}" class="rounded-circle"
                                    style="width: 16px; height: 16px;">
                                <span style="color: #9b59b6;">In Checked: 12:55</span>
                            </div>
                            <div style="height: 6px; background-color: #9b59b6; border-radius: 10px;"></div>
                        </div>

                        <!-- Rejected -->
                        <div style="width: 30%;">
                            <div class="d-flex align-items-center justify-content-center gap-1 mb-1">
                                <img src="{{ URL::asset('/build/img/profile.svg') }}" class="rounded-circle"
                                    style="width: 16px; height: 16px;">
                                <span style="color: #ec407a;">Rejected: 13:25</span>
                            </div>
                            <div style="height: 6px; background-color: #ec407a; border-radius: 10px;"></div>
                        </div>

                    </div>
                </div>
                <!-- Reject Reason Section -->
                <div class="mt-4 p-3" style="background: #f9f9fb; border-radius: 12px;">

                    <!-- Title -->
                    <div class="text-center mb-2" style="color: #2c3e50; font-weight: 600; font-size: 15px;">
                        Please select the reason to Reject the Task
                    </div>

                    <!-- Dropdown -->
                    <div class="text-center mb-3">
                        <select class="form-select text-center" id="reasonSelect"
                            onchange="document.getElementById('otherReason').style.display = this.value === 'Other' ? 'block' : 'none';"
                            style="max-width: 300px; margin: auto; background-color: #f1f1f1; border: none; border-radius: 8px; padding: 10px 12px; color: #7f8ea3; font-weight: 500; font-size: 14px;">
                            <option selected disabled>Select the reason</option>
                            <option value="Incomplete">Incomplete Work</option>
                            <option value="Wrong">Wrong Implementation</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <!-- Conditional Input -->
                    <div id="otherReason" style="display: none;">
                        <label style="font-size: 13px; color: #2c3e50;">Describe the issue</label>
                        <textarea class="form-control mb-3" placeholder="Describe the issue"
                            style="border-radius: 8px; background: white; resize: none;"></textarea>
                    </div>

                    <!-- Upload Boxes -->
                    <div class="d-flex justify-content-between flex-wrap gap-2">
                        <!-- Upload 1 -->
                        <div style="flex: 1; min-width: 100px; text-align: center;">
                            <label style="cursor: pointer;">
                                <input type="file" accept="image/*,video/*,.pdf" style="display: none;"
                                    onchange="previewFile(this, 'preview1')">
                                <div style="background: white; border-radius: 8px; padding: 16px;">
                                    <div id="preview1" style="font-size: 24px; color: #888;">+</div>
                                    <div style="font-size: 11px; color: #7f8ea3;">MP4 - JPG - PDF - PNG</div>
                                </div>
                            </label>
                        </div>

                        <!-- Upload 2 -->
                        <div style="flex: 1; min-width: 100px; text-align: center;">
                            <label style="cursor: pointer;">
                                <input type="file" accept="image/*,video/*,.pdf" style="display: none;"
                                    onchange="previewFile(this, 'preview2')">
                                <div style="background: white; border-radius: 8px; padding: 16px;">
                                    <div id="preview2" style="font-size: 24px; color: #888;">+</div>
                                    <div style="font-size: 11px; color: #7f8ea3;">MP4 - JPG - PDF - PNG</div>
                                </div>
                            </label>
                        </div>

                        <!-- Upload 3 -->
                        <div style="flex: 1; min-width: 100px; text-align: center;">
                            <label style="cursor: pointer;">
                                <input type="file" accept="image/*,video/*,.pdf" style="display: none;"
                                    onchange="previewFile(this, 'preview3')">
                                <div style="background: white; border-radius: 8px; padding: 16px;">
                                    <div id="preview3" style="font-size: 24px; color: #888;">+</div>
                                    <div style="font-size: 11px; color: #7f8ea3;">MP4 - JPG - PDF - PNG</div>
                                </div>
                            </label>
                        </div>
                    </div>

                </div>
                <div class="d-flex justify-content-center gap-3"
                    style="background-color: #f2f2f2; padding: 12px; border-radius: 12px;">
                    <button type="button" class="btn"
                        style="background-color: #f2f2f2; color: #8a9aa7; border: none; font-weight: 600; padding: 8px 20px; border-radius: 8px;"
                        data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn"
                        style="background-color: #f2f2f2; color: #8a9aa7; border: none; font-weight: 600; padding: 8px 20px; border-radius: 8px;"
                        data-bs-dismiss="modal">
                        Save & Close
                    </button>
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
                        Remove the Task</h5>
                </div>

                <!-- Body -->
                <div class="modal-body" style="text-align: center; padding: 30px 20px 20px;">
                    <!-- Warning Message -->
                    <div
                        style="background-color: #fff;border: 1px solid #f1f1f1;color: #f44336;font-size: 14px;font-weight: 500;text-align: center;display: flex;align-items: center;justify-content: center;gap: 30px;width: fit-content;padding: 6px 12px;border-radius: 6px;margin: 0 auto 15px;margin-bottom: 15px;">
                        <img src="{{ asset('build/img/tera.svg') }}" alt="Pause Icon" width="15"
                            height="15">
                        Task can't be Removed if there Open Tickets
                    </div>

                    <!-- Icon -->
                    <div
                        style="background-color: #f44336; width: 60px; height: 60px; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
                        <img src="{{ asset('build/img/deletep.svg') }}" alt="Pause Icon" width="28"
                            height="28">
                    </div>

                    <!-- Text -->
                    <p style="font-size: 16px; font-weight: 500; color: #1c2b48;">Please select the reason to remove the
                    </p>

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
                    <button type="button" class="btn" data-bs-dismiss="modal"
                        style="background-color: #f1f1f1; color: #1c2b48; border: none; width: 150px;">Save &
                        Close</button>
                </div>

            </div>
        </div>
    </div>


    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->

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
        function previewFile(input, previewId) {
            const file = input.files[0];
            const preview = document.getElementById(previewId);

            if (file) {
                const type = file.type;

                if (type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.innerHTML =
                            `<img src="${e.target.result}" style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px;">`;
                    };
                    reader.readAsDataURL(file);
                } else if (type.startsWith('video/')) {
                    preview.innerHTML = `🎥 ${file.name}`;
                } else if (type === 'application/pdf') {
                    preview.innerHTML = `📄 ${file.name}`;
                } else {
                    preview.innerHTML = `📎 ${file.name}`;
                }
            } else {
                preview.innerHTML = '+';
            }
        }
    </script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->
    @component('components.model-popup')
    @endcomponent
@endsection
