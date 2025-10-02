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
            <div style="overflow-y: auto;flex:1;height: 92vh;">
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin: 10px;">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="ti ti-x"></i></button>
                </div>
                @endif
                <div class="chat-body chat-page-group">
                    <div class="project-succes pt-2 pb-2 d-flex justify-content-between align-items-center" style="flex-wrap: wrap; gap: 10px;">
                       
                        <!-- Left Side -->
                        <div>
                            <h3 style="margin: 0;">Ticket Overview</h3>
                            <strong>Total Tickets:10</strong>
                        </div>

                        <!-- Right Side -->
                        <div class="d-flex align-items-center flex-wrap" style="gap: 8px;">
                            <button
                                type="button"
                                data-bs-toggle="modal"
                                data-bs-target="#ticketModal"
                                style="background-color: orange; color: white; border: none; padding: 7px 14px; border-radius: 6px; font-weight: 500; display: flex; align-items: center; gap: 6px; cursor: pointer;">
                                + Create Ticket
                            </button>
                        </div>
                    </div>
                    <!-- Container for the full width -->
                    <div class="container-fluid px-4">
                        <div class="row g-3 py-2">
                            <!-- Card 1: Total Projects -->
                            <div class="col-md-3 mb-1">
                                <div class="px-3 py-2" style="border-radius: 10px; height: 100px; background: #fff; position: relative; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);">

                                    <!-- Top Row -->
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div style="font-size: 0.9rem; color: #1e2b4d;">Total Tickets</div>
                                        <div style="background-color: #eae8fd; border-radius: 50%; padding: 5px;">
                                            <img src="{{URL::asset('/build/img/sigma.svg')}}" alt="icon" style="width: 20px; height: 20px;" />
                                        </div>
                                    </div>

                                    <!-- Project Number -->
                                    <div class="fw-bold mt-1" style="font-size: 1.5rem; color: #1e2b4d;">10</div>

                                    <!-- Percentage Change (Bottom Right) -->
                                    <div style="position: absolute; bottom: 8px; right: 16px; font-size: 0.9rem; color: #28c76f;">
                                        <i class="bi bi-arrow-up-right"></i> 8.5%
                                    </div>

                                </div>
                            </div>

                            <!-- card-2 -->
                            <div class="col-md-3 mb-3">
                                <div class="px-3 py-2" style="border-radius: 10px; height: 100px; background: #fff; position: relative; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);">

                                    <!-- Top Row -->
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div style="font-size: 0.9rem; color: #1e2b4d;">In Progress</div>
                                        <div style="background-color: #e9f8dd; border-radius: 50%; padding: 5px;">
                                            <img src="{{URL::asset('/build/img/greenflag.svg')}}" alt="icon" style="width: 20px; height: 20px;" />
                                        </div>
                                    </div>

                                    <!-- Project Number -->
                                    <div class="fw-bold mt-1" style="font-size: 1.5rem; color: #1e2b4d;">10</div>

                                    <!-- Percentage Change (Bottom Right) -->
                                    <div style="position: absolute; bottom: 8px; right: 16px; font-size: 0.9rem; color: #28c76f;">
                                        <i class="bi bi-arrow-up-right"></i> 8.5%
                                    </div>

                                </div>
                            </div>
                            <!-- card 3 -->

                            <div class="col-md-3 mb-3">
                                <div class="px-3 py-2" style="border-radius: 10px; height: 100px; background: #fff; position: relative; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);">

                                    <!-- Top Row -->
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div style="font-size: 0.9rem; color: #1e2b4d;">In Hold</div>
                                        <div style="background-color: #fff3cd; border-radius: 50%; padding: 5px;">
                                            <img src="{{URL::asset('/build/img/yelowflag.svg')}}" alt="icon" style="width: 20px; height: 20px;" />
                                        </div>
                                    </div>

                                    <!-- Project Number -->
                                    <div class="fw-bold mt-1" style="font-size: 1.5rem; color: #1e2b4d;">10</div>

                                    <!-- Percentage Change (Bottom Right) -->
                                    <div style="position: absolute; bottom: 8px; right: 16px; font-size: 0.9rem; color: #ff2e2e">
                                        <i class="bi bi-arrow-down-right"></i> 8.5%
                                    </div>

                                </div>
                            </div>


                            <!-- card 4 -->

                            <div class="col-md-3 mb-3">
                                <div class="px-3 py-2" style="border-radius: 10px; height: 100px; background: #fff; position: relative; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);">

                                    <!-- Top Row -->
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div style="font-size: 0.9rem; color: #1e2b4d;">In Delayed</div>
                                        <div style="background-color: #fddede; border-radius: 50%; padding: 5px;">
                                            <img src="{{URL::asset('/build/img/redflag.svg')}}" alt="icon" style="width: 20px; height: 20px;" />
                                        </div>
                                    </div>

                                    <!-- Project Number -->
                                    <div class="fw-bold mt-1" style="font-size: 1.5rem; color: #1e2b4d;">10</div>

                                    <!-- Percentage Change (Bottom Right) -->
                                    <div style="position: absolute; bottom: 8px; right: 16px; font-size: 0.9rem; color: #ff2e2e;">
                                        <i class="bi bi-arrow-down-right"></i> 8.5%
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- project overview -->
                    <div class="project-succes pt-4 pb-2 d-flex flex-column flex-md-row  align-items-start align-items-md-center gap-3">
                        <div>
                            <h3 style="margin: 0;">Ticket Status</h3>
                            <strong>Total Shared ToDO's: 10</strong>
                        </div>
                    </div>

                    <div class="mb-2">
                        <div class="row g-3">
                            @foreach ($tickets as $ticket)
                            <!-- card -->
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                <div class="card shadow-sm p-1" style="border-radius: 20px; font-family: 'Segoe UI', sans-serif;">
                                    <!-- Top Section -->
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div>
                                            <div style="color: #7ED957; font-weight: 600; font-size: 16px;">{{ $ticket->status }}</div>
                                            <div style="font-size: 13px; color: #7ED957;">Total Tasks:34</div>
                                        </div>
                                        <div>
                                            <select class="form-select form-select-sm" style=" font-size: 13px;">
                                                <option selected>Select Projects</option>
                                                <option selected>{{ $ticket->project_title }}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class=" mt-2" style=" background-color: #f8f9fa; border-radius: 10px;padding:2px;font-size: 11px;">

                                        <!-- Header -->
                                        <div class="d-flex justify-content-between flex-wrap">
                                            <div>
                                                <img src="{{ asset('build/img/yekbon.svg') }}" alt="yekbon" style="width: 25px; height: 35px;">
                                            </div>
                                            <div style="color: #1a73e8;"><strong>Tickets</strong><br>{{ $ticket->id }}</div>
                                            <div style="color: #1a73e8;"><strong>Section</strong><br>{{ $ticket->section_name }}</div>
                                            <div style="color: #1a73e8;"><strong>Ticket Title</strong><br>{{ $ticket->title }}</div>
                                        </div>

                                        <!-- Task Line -->
                                        <div style="margin-top: 1rem; display: flex; align-items: center; flex-wrap: wrap; background-color: #fff; border-radius: 10px; padding: 6px; font-size: 12px; color: #333;font-size:11px;">

                                            <!-- Task Count -->
                                            <span style="margin-right: 5px; font-weight: bold;">5 Tasks</span>

                                            <!-- Divider -->
                                            <span style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Start Date -->
                                            <span style="margin-right: 5px; color: #28a745;">Start: 22.10.2024</span>

                                            <!-- Divider -->
                                            <span style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Delivery Date -->
                                            <span style="margin-right: 5px; color: #28a745;">Deliver: 22.10.2024</span>

                                            <!-- Divider -->
                                            <span style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Overlapping Profile Avatars -->
                                            <div style="display: flex; align-items: center; margin-left: 10px;">
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="User" style="width: 16px; height: 16px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="User" style="width: 16px; height: 16px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="User" style="width: 16px; height: 16px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">

                                            </div>
                                        </div>



                                        <!-- Progress Bar -->
                                        <div class="d-flex justify-content-between align-items-center mt-3" style="flex-wrap: nowrap;">
                                            <!-- Progress Bar + Percentage -->
                                            <div class="d-flex align-items-center" style="flex: 1;">
                                                <div class="progress" style="height: 8px; width: 100px; background-color: #e0e0e0; border-radius: 5px; overflow: hidden;">
                                                    <div class="progress-bar" role="progressbar" style="width: 75%; background-color: #4fc3f7;"></div>
                                                </div>
                                                <div style="font-size: 12px; color: #4fc3f7; margin-left: 7px;">75%</div>
                                            </div>

                                            <!-- Status Dots -->
                                            <div class="d-flex align-items-center ms-3" style="font-size: 11px; gap: 5px;margin-right:4px;">
                                                <span style="color: #8BC34A;">● 1</span>
                                                <span style="color: #FF9800;">● 3</span>
                                                <span style="color: #F44336;">● 0</span>
                                                <span style="color: #9C27B0;">● 0</span>
                                                <span style="color: #4CAF50;">● 0</span>

                                            </div>
                                            <div>
                                                <img src="{{URL::asset('/build/img/yelowflag.svg')}}" style="width: 20px; background-color: #fef3e3; border-radius: 5px; padding: 4px; " alt="flag">
                                            </div>

                                        </div>
                                        <!-- tasks -->
                                    </div>
                                    <!-- 2 -->
                                    <div class=" mt-2" style=" background-color: #f8f9fa; border-radius: 10px;padding:2px;font-size: 11px;">

                                        <!-- Header -->
                                        <div class="d-flex justify-content-between flex-wrap">
                                            <div>
                                                <img src="{{ asset('build/img/yekbon.svg') }}" alt="yekbon" style="width: 25px; height: 35px;">
                                            </div>
                                            <div style="color: #1a73e8;"><strong>Tickets</strong><br>#1 - ID</div>
                                            <div style="color: #1a73e8;"><strong>Section</strong><br>User Profile</div>
                                            <div style="color: #1a73e8;"><strong>Ticket Title</strong><br>User Profile Bugs</div>
                                        </div>

                                        <!-- Task Line -->
                                       <div style="margin-top: 1rem; display: flex; align-items: center; flex-wrap: wrap; background-color: #fff; border-radius: 10px; padding: 6px; font-size: 12px; color: #333;font-size:11px;">

                                            <!-- Task Count -->
                                            <span style="margin-right: 5px; font-weight: bold;">5 Tasks</span>

                                            <!-- Divider -->
                                            <span style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Start Date -->
                                            <span style="margin-right: 5px; color: #28a745;">Start: 22.10.2024</span>

                                            <!-- Divider -->
                                            <span style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Delivery Date -->
                                            <span style="margin-right: 5px; color: #28a745;">Deliver: 22.10.2024</span>

                                            <!-- Divider -->
                                            <span style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Overlapping Profile Avatars -->
                                            <div style="display: flex; align-items: center; margin-left: 10px;">
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="User" style="width: 16px; height: 16px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="User" style="width: 16px; height: 16px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="User" style="width: 16px; height: 16px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">

                                            </div>
                                        </div>



                                        <!-- Progress Bar -->
                                        <div class="d-flex justify-content-between align-items-center mt-3" style="flex-wrap: nowrap;">
                                            <!-- Progress Bar + Percentage -->
                                            <div class="d-flex align-items-center" style="flex: 1;">
                                                <div class="progress" style="height: 8px; width: 100px; background-color: #e0e0e0; border-radius: 5px; overflow: hidden;">
                                                    <div class="progress-bar" role="progressbar" style="width: 75%; background-color: #4fc3f7;"></div>
                                                </div>
                                                <div style="font-size: 12px; color: #4fc3f7; margin-left: 7px;">75%</div>
                                            </div>

                                            <!-- Status Dots -->
                                            <div class="d-flex align-items-center ms-3" style="font-size: 11px; gap: 5px;margin-right:4px;">
                                                <span style="color: #8BC34A;">● 1</span>
                                                <span style="color: #FF9800;">● 3</span>
                                                <span style="color: #F44336;">● 0</span>
                                                <span style="color: #9C27B0;">● 0</span>
                                                <span style="color: #4CAF50;">● 0</span>

                                            </div>
                                            <div>
                                                <img src="{{URL::asset('/build/img/yelowflag.svg')}}" style="width: 20px; background-color: #fef3e3; border-radius: 5px; padding: 4px; " alt="flag">
                                            </div>

                                        </div>
                                        <!-- tasks -->
                                    </div>
                                    <!-- 3 -->
                                    <div class=" mt-2" style=" background-color: #f8f9fa; border-radius: 10px;padding:2px;font-size: 11px;">

                                        <!-- Header -->
                                        <div class="d-flex justify-content-between flex-wrap">
                                            <div>
                                                <img src="{{ asset('build/img/yekbon.svg') }}" alt="yekbon" style="width: 25px; height: 35px;">
                                            </div>
                                            <div style="color: #1a73e8;"><strong>Tickets</strong><br>#1 - ID</div>
                                            <div style="color: #1a73e8;"><strong>Section</strong><br>User Profile</div>
                                            <div style="color: #1a73e8;"><strong>Ticket Title</strong><br>User Profile Bugs</div>
                                        </div>

                                        <!-- Task Line -->
                                          <div style="margin-top: 1rem; display: flex; align-items: center; flex-wrap: wrap; background-color: #fff; border-radius: 10px; padding: 6px; font-size: 12px; color: #333;font-size:11px;">

                                            <!-- Task Count -->
                                            <span style="margin-right: 5px; font-weight: bold;">5 Tasks</span>

                                            <!-- Divider -->
                                            <span style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Start Date -->
                                            <span style="margin-right: 5px; color: #28a745;">Start: 22.10.2024</span>

                                            <!-- Divider -->
                                            <span style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Delivery Date -->
                                            <span style="margin-right: 5px; color: #28a745;">Deliver: 22.10.2024</span>

                                            <!-- Divider -->
                                            <span style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Overlapping Profile Avatars -->
                                            <div style="display: flex; align-items: center; margin-left: 10px;">
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="User" style="width: 16px; height: 16px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="User" style="width: 16px; height: 16px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="User" style="width: 16px; height: 16px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">

                                            </div>
                                        </div>



                                        <!-- Progress Bar -->
                                        <div class="d-flex justify-content-between align-items-center mt-3" style="flex-wrap: nowrap;">
                                            <!-- Progress Bar + Percentage -->
                                            <div class="d-flex align-items-center" style="flex: 1;">
                                                <div class="progress" style="height: 8px; width: 100px; background-color: #e0e0e0; border-radius: 5px; overflow: hidden;">
                                                    <div class="progress-bar" role="progressbar" style="width: 75%; background-color: #4fc3f7;"></div>
                                                </div>
                                                <div style="font-size: 12px; color: #4fc3f7; margin-left: 7px;">75%</div>
                                            </div>

                                            <!-- Status Dots -->
                                            <div class="d-flex align-items-center ms-3" style="font-size: 11px; gap: 5px;margin-right:4px;">
                                                <span style="color: #8BC34A;">● 1</span>
                                                <span style="color: #FF9800;">● 3</span>
                                                <span style="color: #F44336;">● 0</span>
                                                <span style="color: #9C27B0;">● 0</span>
                                                <span style="color: #4CAF50;">● 0</span>

                                            </div>
                                            <div>
                                                <img src="{{URL::asset('/build/img/yelowflag.svg')}}" style="width: 20px; background-color: #fef3e3; border-radius: 5px; padding: 4px; " alt="flag">
                                            </div>

                                        </div>
                                        <!-- tasks -->
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
 
                    <!--  current task -->
                    <div class="project-succes pt-3 pb-3 d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">

                        <!-- Left Title -->
                        <div>
                            <h3 style="margin: 0;">Current Tasks</h3>
                            <strong>Task Overview</strong>
                        </div>

                        <!-- Filter + Dropdown -->
                        <div style="background: #f8fafc; padding: 6px 10px; border-radius: 8px; display: flex; flex-wrap: wrap; gap: 10px; align-items: center;">

                            <!-- Filter Buttons -->
                            <div style="display: flex; gap: 10px; flex-wrap: wrap; flex: 1 1 auto;">
                                <button onclick="setActive(this)" style="background: transparent; color: #6c757d; border: none; padding: 6px 16px; border-radius: 6px; font-weight: 500; font-size: 14px; cursor: pointer;">All</button>
                                <button onclick="setActive(this)" style="background: #28c76f; color: white; border: none; padding: 6px 16px; border-radius: 6px; font-weight: 500; font-size: 14px; cursor: pointer;">Low</button>
                                <button onclick="setActive(this)" style="background: transparent; color: #6c757d; border: none; padding: 6px 16px; border-radius: 6px; font-weight: 500; font-size: 14px; cursor: pointer;">Middle</button>
                                <button onclick="setActive(this)" style="background: transparent; color: #6c757d; border: none; padding: 6px 16px; border-radius: 6px; font-weight: 500; font-size: 14px; cursor: pointer;">High</button>
                            </div>

                            <!-- Dropdown -->
                            <div style="flex-shrink: 0;">
                                <select style="font-size: 14px; padding: 6px 12px; border-radius: 6px; border: 1px solid #ddd; color: #6c757d; background-color: #f8f9fa; min-width: 140px;">
                                    <option selected>Select Projects</option>
                                    <option>Project 1</option>
                                    <option>Project 2</option>
                                </select>
                            </div>
                        </div>

                        <!-- Inline JS -->
                        <script>
                            function setActive(el) {
                                const buttons = el.parentElement.querySelectorAll('button');
                                buttons.forEach(btn => {
                                    btn.style.background = 'transparent';
                                    btn.style.color = '#6c757d';
                                });
                                el.style.background = '#28c76f';
                                el.style.color = 'white';
                            }
                        </script>

                    </div>
                    <!-- cards -->
                    {{-- <div class="mb-2">
                        <div class="row g-1">
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                <div class="card shadow-sm p-1" style="border-radius: 20px; font-family: 'Segoe UI', sans-serif;">
                                    <!-- Top Section -->
                                    <div class="d-flex justify-content-between align-items-start mb-3">

                                        <!-- Progress Circle (Left) -->
                                        <div style="width: 50px; height: 50px; position: relative;">
                                            <svg width="50" height="50">
                                                <defs>
                                                    <linearGradient id="grad" x1="0%" y1="0%" x2="100%" y2="0%">
                                                        <stop offset="0%" stop-color="#ff7f00" />
                                                        <stop offset="100%" stop-color="#fcd34d" />
                                                    </linearGradient>
                                                </defs>
                                                <circle cx="25" cy="25" r="21" stroke="#d1d1d1" stroke-width="6" fill="none" />
                                                <circle
                                                    cx="25"
                                                    cy="25"
                                                    r="21"
                                                    stroke="url(#grad)"
                                                    stroke-width="6"
                                                    fill="none"
                                                    stroke-dasharray="131.88"
                                                    stroke-dashoffset="39.56" <!-- 70% -->
                                                    stroke-linecap="round"
                                                    transform="rotate(-90 25 25)" />
                                            </svg>
                                            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 10px; font-weight: bold; color: #333;">
                                                70%
                                            </div>
                                        </div>

                                        <!-- Logo in center -->
                                        <div class="text-center" style="flex-grow: 1;">
                                            <img src="{{URL::asset('/build/img/yekbon.svg')}}" class="rounded-circle mb-1" style="height: 55px; width: 55px; object-fit: cover;" alt="Project Logo">
                                        </div>

                                        <!-- Dropdown (Right) -->
                                        <img src="{{URL::asset('/build/img/ticket_icon_black.svg')}}" style="height: 25px; width: 25px;cursor:pointer" alt="ticke" data-bs-toggle="modal" data-bs-target="#ticketModal">
                                    </div>
                                    <!-- Project Title and Up Icon -->
                                    <!-- Project Header (Clickable to Toggle) -->
                                    <div class="d-flex justify-content-between align-items-center mb-2"
                                        style="cursor: pointer;"
                                        onclick="var details=this.nextElementSibling;
                                          var icon=this.querySelector('.toggle-icon');
                                       if(details.style.display==='block'||details.style.display===''){
                                      details.style.display='none';
                                         icon.src='{{ URL::asset('/build/img/top_arrow.svg') }}';
                                            }else{
                                        details.style.display='block';
                                                 icon.src='{{ URL::asset('/build/img/below-arrow.svg') }}';
                                          }">

                                        <div></div>
                                        <div>
                                            <h5 class="text-center" style="margin: 0 auto; font-weight: bold; color: #2e2e5d;">
                                                Project Title
                                            </h5>
                                        </div>
                                        <div>
                                            <img src="{{ URL::asset('/build/img/below-arrow.svg') }}"
                                                alt="toggle-icon"
                                                width="20"
                                                height="20"
                                                style="margin-left: auto;"
                                                class="toggle-icon">
                                        </div>
                                    </div>

                                    <!-- Toggleable Content -->
                                    <div class="project-details" style="display: block;">
                                        <div class="d-flex justify-content-between align-items-center px-2 py-1 mb-1"
                                            style="background-color: #f1f5f9; border-radius: 10px;">
                                            <div class="d-flex align-items-center gap-2" style="background: #ecfbdc;">
                                                <img src="{{URL::asset('/build/img/flag.svg')}}" width="16" height="16" alt="flag">
                                            </div>
                                            <div>
                                                <small style="color: #64748b; font-size: 14px;">Description will be here</small>
                                            </div>
                                            <div class="d-flex align-items-center gap-1">
                                                <span style="width: 8px; height: 8px; background-color: #22c55e; border-radius: 50%; display: inline-block;"></span>
                                                <small style="font-size: 12px; color: #22c55e;">Low</small>
                                            </div>
                                        </div>
                                        <!-- Bottom Stats Row -->
                                        <div class="d-flex justify-content-between flex-wrap align-items-center px-2 mt-1"
                                            style="font-size: 10px; background-color: #f1f5f9; border-radius: 10px;  gap: 3px; padding: 8px 10px;">

                                            <!-- Tickets -->
                                            <div style="color: #1e293b; white-space: nowrap;">
                                                <strong>Tickets:</strong> 5
                                            </div>

                                            <!-- Divider -->
                                            <div style="height: 16px; width: 1px; background-color: #cbd5e1;"></div>

                                            <!-- Tasks -->
                                            <div style="color: #1e293b; white-space: nowrap;">
                                                <strong>Tasks:</strong> 15
                                            </div>

                                            <!-- Divider -->
                                            <div style="height: 16px; width: 1px; background-color: #cbd5e1;"></div>

                                            <!-- Start -->
                                            <div style="color: #10b981; white-space: nowrap;">
                                                <strong>Start:</strong> 22.10.2024
                                            </div>

                                            <!-- Divider -->
                                            <div style="height: 16px; width: 1px; background-color: #cbd5e1;"></div>

                                            <!-- End -->
                                            <div style="color: #ef4444; white-space: nowrap;">
                                                <strong>End:</strong> 22.10.2024
                                            </div>
                                        </div>
                                        <!-- 1 -->
                                        <div class=" mt-2" style=" background-color: #f8f9fa; border-radius: 10px;padding:2px;font-size: 11px;">

                                            <!-- Header -->
                                            <div class="d-flex justify-content-between flex-wrap">
                                                <div>
                                                    <img src="{{ asset('build/img/yekbon.svg') }}" alt="yekbon" style="width: 25px; height: 35px;">
                                                </div>
                                                <div style="color: #1a73e8;"><strong>Tickets</strong><br>#1 - ID</div>
                                                <div style="color: #1a73e8;"><strong>Section</strong><br>User Profile</div>
                                                <div style="color: #1a73e8;"><strong>Ticket Title</strong><br>User Profile Bugs</div>
                                            </div>

                                            <!-- Task Line -->
                                             <div style="margin-top: 1rem; display: flex; align-items: center; flex-wrap: wrap; background-color: #fff; border-radius: 10px; padding: 6px; font-size: 12px; color: #333;font-size:11px;">

                                            <!-- Task Count -->
                                            <span style="margin-right: 5px; font-weight: bold;">5 Tasks</span>

                                            <!-- Divider -->
                                            <span style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Start Date -->
                                            <span style="margin-right: 5px; color: #28a745;">Start: 22.10.2024</span>

                                            <!-- Divider -->
                                            <span style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Delivery Date -->
                                            <span style="margin-right: 5px; color: #28a745;">Deliver: 22.10.2024</span>

                                            <!-- Divider -->
                                            <span style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Overlapping Profile Avatars -->
                                            <div style="display: flex; align-items: center; margin-left: 10px;">
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="User" style="width: 16px; height: 16px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="User" style="width: 16px; height: 16px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="User" style="width: 16px; height: 16px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">

                                            </div>
                                        </div>



                                            <!-- Progress Bar -->
                                            <div class="d-flex justify-content-between align-items-center mt-3" style="flex-wrap: nowrap;">
                                                <!-- Progress Bar + Percentage -->
                                                <div class="d-flex align-items-center" style="flex: 1;">
                                                    <div class="progress" style="height: 8px; width: 100px; background-color: #e0e0e0; border-radius: 5px; overflow: hidden;">
                                                        <div class="progress-bar" role="progressbar" style="width: 75%; background-color: #4fc3f7;"></div>
                                                    </div>
                                                    <div style="font-size: 12px; color: #4fc3f7; margin-left: 7px;">75%</div>
                                                </div>

                                                <!-- Status Dots -->
                                                <div class="d-flex align-items-center ms-3" style="font-size: 11px; gap: 5px;margin-right:4px;">
                                                    <span style="color: #8BC34A;">● 1</span>
                                                    <span style="color: #FF9800;">● 3</span>
                                                    <span style="color: #F44336;">● 0</span>
                                                    <span style="color: #9C27B0;">● 0</span>
                                                    <span style="color: #4CAF50;">● 0</span>

                                                </div>
                                                <div>
                                                    <img src="{{URL::asset('/build/img/yelowflag.svg')}}" style="width: 20px; background-color: #fef3e3; border-radius: 5px; padding: 4px; " alt="flag">
                                                </div>

                                            </div>
                                            <!-- tasks -->
                                        </div>
                                        <div class=" mt-2" style=" background-color: #f8f9fa; border-radius: 10px;padding:2px;font-size: 11px;">

                                            <!-- Header -->
                                            <div class="d-flex justify-content-between flex-wrap">
                                                <div>
                                                    <img src="{{ asset('build/img/yekbon.svg') }}" alt="yekbon" style="width: 25px; height: 35px;">
                                                </div>
                                                <div style="color: #1a73e8;"><strong>Tickets</strong><br>#1 - ID</div>
                                                <div style="color: #1a73e8;"><strong>Section</strong><br>User Profile</div>
                                                <div style="color: #1a73e8;"><strong>Ticket Title</strong><br>User Profile Bugs</div>
                                            </div>

                                            <!-- Task Line -->
                                            <div style="margin-top: 1rem; display: flex; align-items: center; flex-wrap: wrap; background-color: #fff; border-radius: 10px; padding: 6px; font-size: 12px; color: #333;font-size:11px;">

                                            <!-- Task Count -->
                                            <span style="margin-right: 5px; font-weight: bold;">5 Tasks</span>

                                            <!-- Divider -->
                                            <span style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Start Date -->
                                            <span style="margin-right: 5px; color: #28a745;">Start: 22.10.2024</span>

                                            <!-- Divider -->
                                            <span style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Delivery Date -->
                                            <span style="margin-right: 5px; color: #28a745;">Deliver: 22.10.2024</span>

                                            <!-- Divider -->
                                            <span style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Overlapping Profile Avatars -->
                                            <div style="display: flex; align-items: center; margin-left: 10px;">
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="User" style="width: 16px; height: 16px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="User" style="width: 16px; height: 16px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="User" style="width: 16px; height: 16px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">

                                            </div>
                                        </div>



                                            <!-- Progress Bar -->
                                            <div class="d-flex justify-content-between align-items-center mt-3" style="flex-wrap: nowrap;">
                                                <!-- Progress Bar + Percentage -->
                                                <div class="d-flex align-items-center" style="flex: 1;">
                                                    <div class="progress" style="height: 8px; width: 100px; background-color: #e0e0e0; border-radius: 5px; overflow: hidden;">
                                                        <div class="progress-bar" role="progressbar" style="width: 75%; background-color: #4fc3f7;"></div>
                                                    </div>
                                                    <div style="font-size: 12px; color: #4fc3f7; margin-left: 7px;">75%</div>
                                                </div>

                                                <!-- Status Dots -->
                                                <div class="d-flex align-items-center ms-3" style="font-size: 11px; gap: 5px;margin-right:4px;">
                                                    <span style="color: #8BC34A;">● 1</span>
                                                    <span style="color: #FF9800;">● 3</span>
                                                    <span style="color: #F44336;">● 0</span>
                                                    <span style="color: #9C27B0;">● 0</span>
                                                    <span style="color: #4CAF50;">● 0</span>

                                                </div>
                                                <div>
                                                    <img src="{{URL::asset('/build/img/yelowflag.svg')}}" style="width: 20px; background-color: #fef3e3; border-radius: 5px; padding: 4px; " alt="flag">
                                                </div>

                                            </div>
                                            <!-- tasks -->
                                        </div>

                                    </div>



                                </div>
                            </div>
                            <!-- 2 -->
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                <div class="card shadow-sm p-1" style="border-radius: 20px; font-family: 'Segoe UI', sans-serif;">
                                    <!-- Top Section -->
                                    <div class="d-flex justify-content-between align-items-start mb-3">

                                        <!-- Progress Circle (Left) -->
                                        <div style="width: 50px; height: 50px; position: relative;">
                                            <svg width="50" height="50">
                                                <defs>
                                                    <linearGradient id="grad" x1="0%" y1="0%" x2="100%" y2="0%">
                                                        <stop offset="0%" stop-color="#ff7f00" />
                                                        <stop offset="100%" stop-color="#fcd34d" />
                                                    </linearGradient>
                                                </defs>
                                                <circle cx="25" cy="25" r="21" stroke="#d1d1d1" stroke-width="6" fill="none" />
                                                <circle
                                                    cx="25"
                                                    cy="25"
                                                    r="21"
                                                    stroke="url(#grad)"
                                                    stroke-width="6"
                                                    fill="none"
                                                    stroke-dasharray="131.88"
                                                    stroke-dashoffset="39.56" <!-- 70% -->
                                                    stroke-linecap="round"
                                                    transform="rotate(-90 25 25)" />
                                            </svg>
                                            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 10px; font-weight: bold; color: #333;">
                                                70%
                                            </div>
                                        </div>

                                        <!-- Logo in center -->
                                        <div class="text-center" style="flex-grow: 1;">
                                            <img src="{{URL::asset('/build/img/yekbon.svg')}}" class="rounded-circle mb-1" style="height: 55px; width: 55px; object-fit: cover;" alt="Project Logo">
                                        </div>

                                        <!-- Dropdown (Right) -->
                                        <img src="{{URL::asset('/build/img/ticket_icon_black.svg')}}" style="height: 25px; width: 25px;cursor:pointer" alt="ticke" data-bs-toggle="modal" data-bs-target="#ticketModal">
                                    </div>
                                    <!-- Project Title and Up Icon -->
                                    <!-- Project Header (Clickable to Toggle) -->
                                    <div class="d-flex justify-content-between align-items-center mb-2"
                                        style="cursor: pointer;"
                                        onclick="var details=this.nextElementSibling;
                                          var icon=this.querySelector('.toggle-icon');
                                       if(details.style.display==='block'||details.style.display===''){
                                      details.style.display='none';
                                         icon.src='{{ URL::asset('/build/img/top_arrow.svg') }}';
                                            }else{
                                        details.style.display='block';
                                                 icon.src='{{ URL::asset('/build/img/below-arrow.svg') }}';
                                          }">

                                        <div></div>
                                        <div>
                                            <h5 class="text-center" style="margin: 0 auto; font-weight: bold; color: #2e2e5d;">
                                                Project Title
                                            </h5>
                                        </div>
                                        <div>
                                            <img src="{{ URL::asset('/build/img/below-arrow.svg') }}"
                                                alt="toggle-icon"
                                                width="20"
                                                height="20"
                                                style="margin-left: auto;"
                                                class="toggle-icon">
                                        </div>
                                    </div>

                                    <!-- Toggleable Content -->
                                    <div class="project-details" style="display: block;">
                                        <div class="d-flex justify-content-between align-items-center px-2 py-1 mb-1"
                                            style="background-color: #f1f5f9; border-radius: 10px;">
                                            <div class="d-flex align-items-center gap-2" style="background: #ecfbdc;">
                                                <img src="{{URL::asset('/build/img/flag.svg')}}" width="16" height="16" alt="flag">
                                            </div>
                                            <div>
                                                <small style="color: #64748b; font-size: 14px;">Description will be here</small>
                                            </div>
                                            <div class="d-flex align-items-center gap-1">
                                                <span style="width: 8px; height: 8px; background-color: #22c55e; border-radius: 50%; display: inline-block;"></span>
                                                <small style="font-size: 12px; color: #22c55e;">Low</small>
                                            </div>
                                        </div>
                                        <!-- Bottom Stats Row -->
                                        <div class="d-flex justify-content-between flex-wrap align-items-center px-2 mt-1"
                                            style="font-size: 10px; background-color: #f1f5f9; border-radius: 10px;  gap: 3px; padding: 8px 10px;">

                                            <!-- Tickets -->
                                            <div style="color: #1e293b; white-space: nowrap;">
                                                <strong>Tickets:</strong> 5
                                            </div>

                                            <!-- Divider -->
                                            <div style="height: 16px; width: 1px; background-color: #cbd5e1;"></div>

                                            <!-- Tasks -->
                                            <div style="color: #1e293b; white-space: nowrap;">
                                                <strong>Tasks:</strong> 15
                                            </div>

                                            <!-- Divider -->
                                            <div style="height: 16px; width: 1px; background-color: #cbd5e1;"></div>

                                            <!-- Start -->
                                            <div style="color: #10b981; white-space: nowrap;">
                                                <strong>Start:</strong> 22.10.2024
                                            </div>

                                            <!-- Divider -->
                                            <div style="height: 16px; width: 1px; background-color: #cbd5e1;"></div>

                                            <!-- End -->
                                            <div style="color: #ef4444; white-space: nowrap;">
                                                <strong>End:</strong> 22.10.2024
                                            </div>
                                        </div>
                                        <!-- 1 -->
                                        <div class=" mt-2" style=" background-color: #f8f9fa; border-radius: 10px;padding:2px;font-size: 11px;">

                                            <!-- Header -->
                                            <div class="d-flex justify-content-between flex-wrap">
                                                <div>
                                                    <img src="{{ asset('build/img/yekbon.svg') }}" alt="yekbon" style="width: 25px; height: 35px;">
                                                </div>
                                                <div style="color: #1a73e8;"><strong>Tickets</strong><br>#1 - ID</div>
                                                <div style="color: #1a73e8;"><strong>Section</strong><br>User Profile</div>
                                                <div style="color: #1a73e8;"><strong>Ticket Title</strong><br>User Profile Bugs</div>
                                            </div>

                                            <!-- Task Line -->
                                           <div style="margin-top: 1rem; display: flex; align-items: center; flex-wrap: wrap; background-color: #fff; border-radius: 10px; padding: 6px; font-size: 12px; color: #333;font-size:11px;">

                                            <!-- Task Count -->
                                            <span style="margin-right: 5px; font-weight: bold;">5 Tasks</span>

                                            <!-- Divider -->
                                            <span style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Start Date -->
                                            <span style="margin-right: 5px; color: #28a745;">Start: 22.10.2024</span>

                                            <!-- Divider -->
                                            <span style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Delivery Date -->
                                            <span style="margin-right: 5px; color: #28a745;">Deliver: 22.10.2024</span>

                                            <!-- Divider -->
                                            <span style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Overlapping Profile Avatars -->
                                            <div style="display: flex; align-items: center; margin-left: 10px;">
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="User" style="width: 16px; height: 16px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="User" style="width: 16px; height: 16px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="User" style="width: 16px; height: 16px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">

                                            </div>
                                        </div>


                                            <!-- Progress Bar -->
                                            <div class="d-flex justify-content-between align-items-center mt-3" style="flex-wrap: nowrap;">
                                                <!-- Progress Bar + Percentage -->
                                                <div class="d-flex align-items-center" style="flex: 1;">
                                                    <div class="progress" style="height: 8px; width: 100px; background-color: #e0e0e0; border-radius: 5px; overflow: hidden;">
                                                        <div class="progress-bar" role="progressbar" style="width: 75%; background-color: #4fc3f7;"></div>
                                                    </div>
                                                    <div style="font-size: 12px; color: #4fc3f7; margin-left: 7px;">75%</div>
                                                </div>

                                                <!-- Status Dots -->
                                                <div class="d-flex align-items-center ms-3" style="font-size: 11px; gap: 5px;margin-right:4px;">
                                                    <span style="color: #8BC34A;">● 1</span>
                                                    <span style="color: #FF9800;">● 3</span>
                                                    <span style="color: #F44336;">● 0</span>
                                                    <span style="color: #9C27B0;">● 0</span>
                                                    <span style="color: #4CAF50;">● 0</span>

                                                </div>
                                                <div>
                                                    <img src="{{URL::asset('/build/img/yelowflag.svg')}}" style="width: 20px; background-color: #fef3e3; border-radius: 5px; padding: 4px; " alt="flag">
                                                </div>

                                            </div>
                                            <!-- tasks -->
                                        </div>
                                        <div class=" mt-2" style=" background-color: #f8f9fa; border-radius: 10px;padding:2px;font-size: 11px;">

                                            <!-- Header -->
                                            <div class="d-flex justify-content-between flex-wrap">
                                                <div>
                                                    <img src="{{ asset('build/img/yekbon.svg') }}" alt="yekbon" style="width: 25px; height: 35px;">
                                                </div>
                                                <div style="color: #1a73e8;"><strong>Tickets</strong><br>#1 - ID</div>
                                                <div style="color: #1a73e8;"><strong>Section</strong><br>User Profile</div>
                                                <div style="color: #1a73e8;"><strong>Ticket Title</strong><br>User Profile Bugs</div>
                                            </div>

                                            <!-- Task Line -->
                                            <div style="margin-top: 1rem; display: flex; align-items: center; flex-wrap: wrap; background-color: #fff; border-radius: 10px; padding: 6px; font-size: 12px; color: #333;font-size:11px;">

                                            <!-- Task Count -->
                                            <span style="margin-right: 5px; font-weight: bold;">5 Tasks</span>

                                            <!-- Divider -->
                                            <span style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Start Date -->
                                            <span style="margin-right: 5px; color: #28a745;">Start: 22.10.2024</span>

                                            <!-- Divider -->
                                            <span style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Delivery Date -->
                                            <span style="margin-right: 5px; color: #28a745;">Deliver: 22.10.2024</span>

                                            <!-- Divider -->
                                            <span style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Overlapping Profile Avatars -->
                                            <div style="display: flex; align-items: center; margin-left: 10px;">
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="User" style="width: 16px; height: 16px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="User" style="width: 16px; height: 16px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="User" style="width: 16px; height: 16px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">

                                            </div>
                                        </div>



                                            <!-- Progress Bar -->
                                            <div class="d-flex justify-content-between align-items-center mt-3" style="flex-wrap: nowrap;">
                                                <!-- Progress Bar + Percentage -->
                                                <div class="d-flex align-items-center" style="flex: 1;">
                                                    <div class="progress" style="height: 8px; width: 100px; background-color: #e0e0e0; border-radius: 5px; overflow: hidden;">
                                                        <div class="progress-bar" role="progressbar" style="width: 75%; background-color: #4fc3f7;"></div>
                                                    </div>
                                                    <div style="font-size: 12px; color: #4fc3f7; margin-left: 7px;">75%</div>
                                                </div>

                                                <!-- Status Dots -->
                                                <div class="d-flex align-items-center ms-3" style="font-size: 11px; gap: 5px;margin-right:4px;">
                                                    <span style="color: #8BC34A;">● 1</span>
                                                    <span style="color: #FF9800;">● 3</span>
                                                    <span style="color: #F44336;">● 0</span>
                                                    <span style="color: #9C27B0;">● 0</span>
                                                    <span style="color: #4CAF50;">● 0</span>

                                                </div>
                                                <div>
                                                    <img src="{{URL::asset('/build/img/yelowflag.svg')}}" style="width: 20px; background-color: #fef3e3; border-radius: 5px; padding: 4px; " alt="flag">
                                                </div>

                                            </div>
                                            <!-- tasks -->
                                        </div>

                                    </div>



                                </div>
                            </div>
                            <!-- 3 -->
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                <div class="card shadow-sm p-1" style="border-radius: 20px; font-family: 'Segoe UI', sans-serif;">
                                    <!-- Top Section -->
                                    <div class="d-flex justify-content-between align-items-start mb-3">

                                        <!-- Progress Circle (Left) -->
                                        <div style="width: 50px; height: 50px; position: relative;">
                                            <svg width="50" height="50">
                                                <defs>
                                                    <linearGradient id="grad" x1="0%" y1="0%" x2="100%" y2="0%">
                                                        <stop offset="0%" stop-color="#ff7f00" />
                                                        <stop offset="100%" stop-color="#fcd34d" />
                                                    </linearGradient>
                                                </defs>
                                                <circle cx="25" cy="25" r="21" stroke="#d1d1d1" stroke-width="6" fill="none" />
                                                <circle
                                                    cx="25"
                                                    cy="25"
                                                    r="21"
                                                    stroke="url(#grad)"
                                                    stroke-width="6"
                                                    fill="none"
                                                    stroke-dasharray="131.88"
                                                    stroke-dashoffset="39.56" <!-- 70% -->
                                                    stroke-linecap="round"
                                                    transform="rotate(-90 25 25)" />
                                            </svg>
                                            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 10px; font-weight: bold; color: #333;">
                                                70%
                                            </div>
                                        </div>

                                        <!-- Logo in center -->
                                        <div class="text-center" style="flex-grow: 1;">
                                            <img src="{{URL::asset('/build/img/yekbon.svg')}}" class="rounded-circle mb-1" style="height: 55px; width: 55px; object-fit: cover;" alt="Project Logo">
                                        </div>

                                        <!-- Dropdown (Right) -->
                                        <img src="{{URL::asset('/build/img/ticket_icon_black.svg')}}" style="height: 25px; width: 25px;cursor:pointer" alt="ticke" data-bs-toggle="modal" data-bs-target="#ticketModal">
                                    </div>
                                    <!-- Project Title and Up Icon -->
                                    <!-- Project Header (Clickable to Toggle) -->
                                    <div class="d-flex justify-content-between align-items-center mb-2"
                                        style="cursor: pointer;"
                                        onclick="var details=this.nextElementSibling;
                                          var icon=this.querySelector('.toggle-icon');
                                       if(details.style.display==='block'||details.style.display===''){
                                      details.style.display='none';
                                         icon.src='{{ URL::asset('/build/img/top_arrow.svg') }}';
                                            }else{
                                        details.style.display='block';
                                                 icon.src='{{ URL::asset('/build/img/below-arrow.svg') }}';
                                          }">

                                        <div></div>
                                        <div>
                                            <h5 class="text-center" style="margin: 0 auto; font-weight: bold; color: #2e2e5d;">
                                                Project Title
                                            </h5>
                                        </div>
                                        <div>
                                            <img src="{{ URL::asset('/build/img/below-arrow.svg') }}"
                                                alt="toggle-icon"
                                                width="20"
                                                height="20"
                                                style="margin-left: auto;"
                                                class="toggle-icon">
                                        </div>
                                    </div>

                                    <!-- Toggleable Content -->
                                    <div class="project-details" style="display: block;">
                                        <div class="d-flex justify-content-between align-items-center px-2 py-1 mb-1"
                                            style="background-color: #f1f5f9; border-radius: 10px;">
                                            <div class="d-flex align-items-center gap-2" style="background: #ecfbdc;">
                                                <img src="{{URL::asset('/build/img/flag.svg')}}" width="16" height="16" alt="flag">
                                            </div>
                                            <div>
                                                <small style="color: #64748b; font-size: 14px;">Description will be here</small>
                                            </div>
                                            <div class="d-flex align-items-center gap-1">
                                                <span style="width: 8px; height: 8px; background-color: #22c55e; border-radius: 50%; display: inline-block;"></span>
                                                <small style="font-size: 12px; color: #22c55e;">Low</small>
                                            </div>
                                        </div>
                                        <!-- Bottom Stats Row -->
                                        <div class="d-flex justify-content-between flex-wrap align-items-center px-2 mt-1"
                                            style="font-size: 10px; background-color: #f1f5f9; border-radius: 10px;  gap: 3px; padding: 8px 10px;">

                                            <!-- Tickets -->
                                            <div style="color: #1e293b; white-space: nowrap;">
                                                <strong>Tickets:</strong> 5
                                            </div>

                                            <!-- Divider -->
                                            <div style="height: 16px; width: 1px; background-color: #cbd5e1;"></div>

                                            <!-- Tasks -->
                                            <div style="color: #1e293b; white-space: nowrap;">
                                                <strong>Tasks:</strong> 15
                                            </div>

                                            <!-- Divider -->
                                            <div style="height: 16px; width: 1px; background-color: #cbd5e1;"></div>

                                            <!-- Start -->
                                            <div style="color: #10b981; white-space: nowrap;">
                                                <strong>Start:</strong> 22.10.2024
                                            </div>

                                            <!-- Divider -->
                                            <div style="height: 16px; width: 1px; background-color: #cbd5e1;"></div>

                                            <!-- End -->
                                            <div style="color: #ef4444; white-space: nowrap;">
                                                <strong>End:</strong> 22.10.2024
                                            </div>
                                        </div>
                                        <!-- 1 -->
                                        <div class=" mt-2" style=" background-color: #f8f9fa; border-radius: 10px;padding:2px;font-size: 11px;">

                                            <!-- Header -->
                                            <div class="d-flex justify-content-between flex-wrap">
                                                <div>
                                                    <img src="{{ asset('build/img/yekbon.svg') }}" alt="yekbon" style="width: 25px; height: 35px;">
                                                </div>
                                                <div style="color: #1a73e8;"><strong>Tickets</strong><br>#1 - ID</div>
                                                <div style="color: #1a73e8;"><strong>Section</strong><br>User Profile</div>
                                                <div style="color: #1a73e8;"><strong>Ticket Title</strong><br>User Profile Bugs</div>
                                            </div>

                                            <!-- Task Line -->
                                             <div style="margin-top: 1rem; display: flex; align-items: center; flex-wrap: wrap; background-color: #fff; border-radius: 10px; padding: 6px; font-size: 12px; color: #333;font-size:11px;">

                                            <!-- Task Count -->
                                            <span style="margin-right: 5px; font-weight: bold;">5 Tasks</span>

                                            <!-- Divider -->
                                            <span style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Start Date -->
                                            <span style="margin-right: 5px; color: #28a745;">Start: 22.10.2024</span>

                                            <!-- Divider -->
                                            <span style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Delivery Date -->
                                            <span style="margin-right: 5px; color: #28a745;">Deliver: 22.10.2024</span>

                                            <!-- Divider -->
                                            <span style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Overlapping Profile Avatars -->
                                            <div style="display: flex; align-items: center; margin-left: 10px;">
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="User" style="width: 16px; height: 16px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="User" style="width: 16px; height: 16px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="User" style="width: 16px; height: 16px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">

                                            </div>
                                        </div>



                                            <!-- Progress Bar -->
                                            <div class="d-flex justify-content-between align-items-center mt-3" style="flex-wrap: nowrap;">
                                                <!-- Progress Bar + Percentage -->
                                                <div class="d-flex align-items-center" style="flex: 1;">
                                                    <div class="progress" style="height: 8px; width: 100px; background-color: #e0e0e0; border-radius: 5px; overflow: hidden;">
                                                        <div class="progress-bar" role="progressbar" style="width: 75%; background-color: #4fc3f7;"></div>
                                                    </div>
                                                    <div style="font-size: 12px; color: #4fc3f7; margin-left: 7px;">75%</div>
                                                </div>

                                                <!-- Status Dots -->
                                                <div class="d-flex align-items-center ms-3" style="font-size: 11px; gap: 5px;margin-right:4px;">
                                                    <span style="color: #8BC34A;">● 1</span>
                                                    <span style="color: #FF9800;">● 3</span>
                                                    <span style="color: #F44336;">● 0</span>
                                                    <span style="color: #9C27B0;">● 0</span>
                                                    <span style="color: #4CAF50;">● 0</span>

                                                </div>
                                                <div>
                                                    <img src="{{URL::asset('/build/img/yelowflag.svg')}}" style="width: 20px; background-color: #fef3e3; border-radius: 5px; padding: 4px; " alt="flag">
                                                </div>

                                            </div>
                                            <!-- tasks -->
                                        </div>
                                        <div class=" mt-2" style=" background-color: #f8f9fa; border-radius: 10px;padding:2px;font-size: 11px;">

                                            <!-- Header -->
                                            <div class="d-flex justify-content-between flex-wrap">
                                                <div>
                                                    <img src="{{ asset('build/img/yekbon.svg') }}" alt="yekbon" style="width: 25px; height: 35px;">
                                                </div>
                                                <div style="color: #1a73e8;"><strong>Tickets</strong><br>#1 - ID</div>
                                                <div style="color: #1a73e8;"><strong>Section</strong><br>User Profile</div>
                                                <div style="color: #1a73e8;"><strong>Ticket Title</strong><br>User Profile Bugs</div>
                                            </div>

                                            <!-- Task Line -->
                                             <div style="margin-top: 1rem; display: flex; align-items: center; flex-wrap: wrap; background-color: #fff; border-radius: 10px; padding: 6px; font-size: 12px; color: #333;font-size:11px;">

                                            <!-- Task Count -->
                                            <span style="margin-right: 5px; font-weight: bold;">5 Tasks</span>

                                            <!-- Divider -->
                                            <span style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Start Date -->
                                            <span style="margin-right: 5px; color: #28a745;">Start: 22.10.2024</span>

                                            <!-- Divider -->
                                            <span style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Delivery Date -->
                                            <span style="margin-right: 5px; color: #28a745;">Deliver: 22.10.2024</span>

                                            <!-- Divider -->
                                            <span style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Overlapping Profile Avatars -->
                                            <div style="display: flex; align-items: center; margin-left: 10px;">
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="User" style="width: 16px; height: 16px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="User" style="width: 16px; height: 16px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="User" style="width: 16px; height: 16px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">

                                            </div>
                                        </div>


                                            <!-- Progress Bar -->
                                            <div class="d-flex justify-content-between align-items-center mt-3" style="flex-wrap: nowrap;">
                                                <!-- Progress Bar + Percentage -->
                                                <div class="d-flex align-items-center" style="flex: 1;">
                                                    <div class="progress" style="height: 8px; width: 100px; background-color: #e0e0e0; border-radius: 5px; overflow: hidden;">
                                                        <div class="progress-bar" role="progressbar" style="width: 75%; background-color: #4fc3f7;"></div>
                                                    </div>
                                                    <div style="font-size: 12px; color: #4fc3f7; margin-left: 7px;">75%</div>
                                                </div>

                                                <!-- Status Dots -->
                                                <div class="d-flex align-items-center ms-3" style="font-size: 11px; gap: 5px;margin-right:4px;">
                                                    <span style="color: #8BC34A;">● 1</span>
                                                    <span style="color: #FF9800;">● 3</span>
                                                    <span style="color: #F44336;">● 0</span>
                                                    <span style="color: #9C27B0;">● 0</span>
                                                    <span style="color: #4CAF50;">● 0</span>

                                                </div>
                                                <div>
                                                    <img src="{{URL::asset('/build/img/yelowflag.svg')}}" style="width: 20px; background-color: #fef3e3; border-radius: 5px; padding: 4px; " alt="flag">
                                                </div>

                                            </div>
                                            <!-- tasks -->
                                        </div>

                                    </div>



                                </div>
                            </div>
                            <!-- 4 -->
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                <div class="card shadow-sm p-1" style="border-radius: 20px; font-family: 'Segoe UI', sans-serif;">
                                    <!-- Top Section -->
                                    <div class="d-flex justify-content-between align-items-start mb-3">

                                        <!-- Progress Circle (Left) -->
                                        <div style="width: 50px; height: 50px; position: relative;">
                                            <svg width="50" height="50">
                                                <defs>
                                                    <linearGradient id="grad" x1="0%" y1="0%" x2="100%" y2="0%">
                                                        <stop offset="0%" stop-color="#ff7f00" />
                                                        <stop offset="100%" stop-color="#fcd34d" />
                                                    </linearGradient>
                                                </defs>
                                                <circle cx="25" cy="25" r="21" stroke="#d1d1d1" stroke-width="6" fill="none" />
                                                <circle
                                                    cx="25"
                                                    cy="25"
                                                    r="21"
                                                    stroke="url(#grad)"
                                                    stroke-width="6"
                                                    fill="none"
                                                    stroke-dasharray="131.88"
                                                    stroke-dashoffset="39.56" <!-- 70% -->
                                                    stroke-linecap="round"
                                                    transform="rotate(-90 25 25)" />
                                            </svg>
                                            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 10px; font-weight: bold; color: #333;">
                                                70%
                                            </div>
                                        </div>

                                        <!-- Logo in center -->
                                        <div class="text-center" style="flex-grow: 1;">
                                            <img src="{{URL::asset('/build/img/yekbon.svg')}}" class="rounded-circle mb-1" style="height: 55px; width: 55px; object-fit: cover;" alt="Project Logo">
                                        </div>

                                        <!-- Dropdown (Right) -->
                                        <img src="{{URL::asset('/build/img/ticket_icon_black.svg')}}" style="height: 25px; width: 25px;cursor:pointer" alt="ticke" data-bs-toggle="modal" data-bs-target="#ticketModal">
                                    </div>
                                    <!-- Project Title and Up Icon -->
                                    <!-- Project Header (Clickable to Toggle) -->
                                    <div class="d-flex justify-content-between align-items-center mb-2"
                                        style="cursor: pointer;"
                                        onclick="var details=this.nextElementSibling;
                                          var icon=this.querySelector('.toggle-icon');
                                       if(details.style.display==='block'||details.style.display===''){
                                      details.style.display='none';
                                         icon.src='{{ URL::asset('/build/img/top_arrow.svg') }}';
                                            }else{
                                        details.style.display='block';
                                                 icon.src='{{ URL::asset('/build/img/below-arrow.svg') }}';
                                          }">

                                        <div></div>
                                        <div>
                                            <h5 class="text-center" style="margin: 0 auto; font-weight: bold; color: #2e2e5d;">
                                                Project Title
                                            </h5>
                                        </div>
                                        <div>
                                            <img src="{{ URL::asset('/build/img/below-arrow.svg') }}"
                                                alt="toggle-icon"
                                                width="20"
                                                height="20"
                                                style="margin-left: auto;"
                                                class="toggle-icon">
                                        </div>
                                    </div>

                                    <!-- Toggleable Content -->
                                    <div class="project-details" style="display: block;">
                                        <div class="d-flex justify-content-between align-items-center px-2 py-1 mb-1"
                                            style="background-color: #f1f5f9; border-radius: 10px;">
                                            <div class="d-flex align-items-center gap-2" style="background: #ecfbdc;">
                                                <img src="{{URL::asset('/build/img/flag.svg')}}" width="16" height="16" alt="flag">
                                            </div>
                                            <div>
                                                <small style="color: #64748b; font-size: 14px;">Description will be here</small>
                                            </div>
                                            <div class="d-flex align-items-center gap-1">
                                                <span style="width: 8px; height: 8px; background-color: #22c55e; border-radius: 50%; display: inline-block;"></span>
                                                <small style="font-size: 12px; color: #22c55e;">Low</small>
                                            </div>
                                        </div>
                                        <!-- Bottom Stats Row -->
                                        <div class="d-flex justify-content-between flex-wrap align-items-center px-2 mt-1"
                                            style="font-size: 10px; background-color: #f1f5f9; border-radius: 10px;  gap: 3px; padding: 8px 10px;">

                                            <!-- Tickets -->
                                            <div style="color: #1e293b; white-space: nowrap;">
                                                <strong>Tickets:</strong> 5
                                            </div>

                                            <!-- Divider -->
                                            <div style="height: 16px; width: 1px; background-color: #cbd5e1;"></div>

                                            <!-- Tasks -->
                                            <div style="color: #1e293b; white-space: nowrap;">
                                                <strong>Tasks:</strong> 15
                                            </div>

                                            <!-- Divider -->
                                            <div style="height: 16px; width: 1px; background-color: #cbd5e1;"></div>

                                            <!-- Start -->
                                            <div style="color: #10b981; white-space: nowrap;">
                                                <strong>Start:</strong> 22.10.2024
                                            </div>

                                            <!-- Divider -->
                                            <div style="height: 16px; width: 1px; background-color: #cbd5e1;"></div>

                                            <!-- End -->
                                            <div style="color: #ef4444; white-space: nowrap;">
                                                <strong>End:</strong> 22.10.2024
                                            </div>
                                        </div>
                                        <!-- 1 -->
                                         <div class=" mt-2" style=" background-color: #f8f9fa; border-radius: 10px;padding:2px;font-size: 11px;">

                                        <!-- Header -->
                                        <div class="d-flex justify-content-between flex-wrap">
                                            <div>
                                                <img src="{{ asset('build/img/yekbon.svg') }}" alt="yekbon" style="width: 25px; height: 35px;">
                                            </div>
                                            <div style="color: #1a73e8;"><strong>Tickets</strong><br>#1 - ID</div>
                                            <div style="color: #1a73e8;"><strong>Section</strong><br>User Profile</div>
                                            <div style="color: #1a73e8;"><strong>Ticket Title</strong><br>User Profile Bugs</div>
                                        </div>

                                        <!-- Task Line -->
                                         <div style="margin-top: 1rem; display: flex; align-items: center; flex-wrap: wrap; background-color: #fff; border-radius: 10px; padding: 6px; font-size: 12px; color: #333;font-size:11px;">

                                            <!-- Task Count -->
                                            <span style="margin-right: 5px; font-weight: bold;">5 Tasks</span>

                                            <!-- Divider -->
                                            <span style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Start Date -->
                                            <span style="margin-right: 5px; color: #28a745;">Start: 22.10.2024</span>

                                            <!-- Divider -->
                                            <span style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Delivery Date -->
                                            <span style="margin-right: 5px; color: #28a745;">Deliver: 22.10.2024</span>

                                            <!-- Divider -->
                                            <span style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Overlapping Profile Avatars -->
                                            <div style="display: flex; align-items: center; margin-left: 10px;">
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="User" style="width: 16px; height: 16px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="User" style="width: 16px; height: 16px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="User" style="width: 16px; height: 16px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">

                                            </div>
                                        </div>



                                        <!-- Progress Bar -->
                                        <div class="d-flex justify-content-between align-items-center mt-3" style="flex-wrap: nowrap;">
                                            <!-- Progress Bar + Percentage -->
                                            <div class="d-flex align-items-center" style="flex: 1;">
                                                <div class="progress" style="height: 8px; width: 100px; background-color: #e0e0e0; border-radius: 5px; overflow: hidden;">
                                                    <div class="progress-bar" role="progressbar" style="width: 75%; background-color: #4fc3f7;"></div>
                                                </div>
                                                <div style="font-size: 12px; color: #4fc3f7; margin-left: 7px;">75%</div>
                                            </div>

                                            <!-- Status Dots -->
                                            <div class="d-flex align-items-center ms-3" style="font-size: 11px; gap: 5px;margin-right:4px;">
                                                <span style="color: #8BC34A;">● 1</span>
                                                <span style="color: #FF9800;">● 3</span>
                                                <span style="color: #F44336;">● 0</span>
                                                <span style="color: #9C27B0;">● 0</span>
                                                <span style="color: #4CAF50;">● 0</span>

                                            </div>
                                            <div>
                                                <img src="{{URL::asset('/build/img/yelowflag.svg')}}" style="width: 20px; background-color: #fef3e3; border-radius: 5px; padding: 4px; " alt="flag">
                                            </div>

                                        </div>
                                        <!-- tasks -->
                                    </div>
                                            <!-- tasks -->
                                        </div>
                                        <div class=" mt-2" style=" background-color: #f8f9fa; border-radius: 10px;padding:2px;font-size: 11px;">

                                            <!-- Header -->
                                            <div class="d-flex justify-content-between flex-wrap">
                                                <div>
                                                    <img src="{{ asset('build/img/yekbon.svg') }}" alt="yekbon" style="width: 25px; height: 35px;">
                                                </div>
                                                <div style="color: #1a73e8;"><strong>Tickets</strong><br>#1 - ID</div>
                                                <div style="color: #1a73e8;"><strong>Section</strong><br>User Profile</div>
                                                <div style="color: #1a73e8;"><strong>Ticket Title</strong><br>User Profile Bugs</div>
                                            </div>

                                            <!-- Task Line -->
                                             <div style="margin-top: 1rem; display: flex; align-items: center; flex-wrap: wrap; background-color: #fff; border-radius: 10px; padding: 6px; font-size: 12px; color: #333;font-size:11px;">

                                            <!-- Task Count -->
                                            <span style="margin-right: 5px; font-weight: bold;">5 Tasks</span>

                                            <!-- Divider -->
                                            <span style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Start Date -->
                                            <span style="margin-right: 5px; color: #28a745;">Start: 22.10.2024</span>

                                            <!-- Divider -->
                                            <span style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Delivery Date -->
                                            <span style="margin-right: 5px; color: #28a745;">Deliver: 22.10.2024</span>

                                            <!-- Divider -->
                                            <span style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Overlapping Profile Avatars -->
                                            <div style="display: flex; align-items: center; margin-left: 10px;">
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="User" style="width: 16px; height: 16px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="User" style="width: 16px; height: 16px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                                                <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="User" style="width: 16px; height: 16px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">

                                            </div>
                                        </div>



                                            <!-- Progress Bar -->
                                            <div class="d-flex justify-content-between align-items-center mt-3" style="flex-wrap: nowrap;">
                                                <!-- Progress Bar + Percentage -->
                                                <div class="d-flex align-items-center" style="flex: 1;">
                                                    <div class="progress" style="height: 8px; width: 100px; background-color: #e0e0e0; border-radius: 5px; overflow: hidden;">
                                                        <div class="progress-bar" role="progressbar" style="width: 75%; background-color: #4fc3f7;"></div>
                                                    </div>
                                                    <div style="font-size: 12px; color: #4fc3f7; margin-left: 7px;">75%</div>
                                                </div>

                                                <!-- Status Dots -->
                                                <div class="d-flex align-items-center ms-3" style="font-size: 11px; gap: 5px;margin-right:4px;">
                                                    <span style="color: #8BC34A;">● 1</span>
                                                    <span style="color: #FF9800;">● 3</span>
                                                    <span style="color: #F44336;">● 0</span>
                                                    <span style="color: #9C27B0;">● 0</span>
                                                    <span style="color: #4CAF50;">● 0</span>

                                                </div>
                                                <div>
                                                    <img src="{{URL::asset('/build/img/yelowflag.svg')}}" style="width: 20px; background-color: #fef3e3; border-radius: 5px; padding: 4px; " alt="flag">
                                                </div>

                                            </div>
                                            <!-- tasks -->
                                        </div>

                                    </div>



                                </div>
                            </div>
                        </div>
                    </div> --}}

                </div>
            </div>

        </div>
    </div>


</div>





<!-- Modal -->
<div class="modal fade" id="ticketModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content" style="border-radius: 12px; background-color: white;">

            <div class="modal-body p-4">
                <h5 style="font-weight: bold;">Create new Ticket</h5>
                <p style="color: #888;">Create a Ticket</p>

                <!-- Ticket Details -->
                <div class="p-3 mb-3" style="background-color: #f6f6f6; border-radius: 10px;">
                    <h6 style="font-weight: 600;">Ticket Details</h6>
                    <div class="row g-2 mt-2">
                        <div class="col-md-4">
                            <select id="ticketProjectSelect" class="form-control" style="background-color: white;">
                                <option value="">Select the Project</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <div>
                                <select id="ticketSectionSelect" class="form-control" style="background-color: white;">
                                    <option value="">Select the Section</option>
                                </select>
                                
                            </div>
                        </div>
                        <div class="col-md-4">
                            <input type="text" id="ticketTitle" class="form-control" placeholder="Ticket Title" style="background-color: white;">
                        </div>
                        <div class="col-12 mt-2">
                            <textarea id="ticketDescription" class="form-control" rows="2" placeholder="Ticket Description" style="background-color: white;"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Ticket Start and Expired Date -->
                <div class="p-3 mb-3 text-center" style="background-color: #f6f6f6; border-radius: 10px;">
                    <h6 style="font-weight: 600;">Ticket Start and Expired Date</h6>
                    <p style="color: #888;">Set activation Date</p>
                    <div class="row justify-content-center g-2">
                        <!-- Start Date -->
                        <div class="col-md-4" id="startDateFieldWrapper" style="position: relative;">
                            <div style="background-color: #fff; border-radius: 12px; padding: 2px 16px;  border: 1px solid #e0e0e0;  display: flex; flex-direction: column; justify-content: center;">
                                <div style="font-weight: 600; font-size: 14px; color: #7d7f85;margin-right:30px;">Start Date</div>
                                <div id="startDateDisplay" style="font-size: 13px; color: #a0a4ab;margin-right:32px;">DD:MM:YYYY</div>
                                <div style="position: absolute; top: 50%; right: 16px; transform: translateY(-50%);">
                                    <img src="{{ URL::asset('/build/img/timeicon.svg') }}"
                                        onclick="document.getElementById('startDateInput').showPicker()"
                                        style="width: 20px; height: 20px; cursor: pointer;" />
                                    <input type="date" id="startDateInput"
                                        onchange="let d=new Date(this.value); if(this.value)document.getElementById('startDateDisplay').innerText=('0'+d.getDate()).slice(-2)+':' + ('0'+(d.getMonth()+1)).slice(-2)+':'+d.getFullYear();"
                                        style="opacity:0; position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none;" />
                                </div>
                            </div>
                        </div>

                        <!-- Expired Date -->
                        <div class="col-md-4" id="expiredDateFieldWrapper" style="position: relative;">
                            <div style="background-color: #fff; border-radius: 12px; padding: 2px 16px; width: 100%; border: 1px solid #e0e0e0; height: 45px; display: flex; flex-direction: column; justify-content: center;">
                                <div style="font-weight: 600; font-size: 14px; color: #7d7f85;margin-right:15px;">Expired Date</div>
                                <div id="expiredDateDisplay" style="font-size: 13px; color: #a0a4ab;margin-right:30px;">DD:MM:YYYY</div>
                                <div style="position: absolute; top: 50%; right: 16px; transform: translateY(-50%);">
                                    <img src="{{ URL::asset('/build/img/timeicon.svg') }}"
                                        onclick="document.getElementById('expiredDateInput').showPicker()"
                                        style="width: 20px; height: 20px; cursor: pointer;" />
                                    <input type="date" id="expiredDateInput"
                                        onchange="let d=new Date(this.value); if(this.value)document.getElementById('expiredDateDisplay').innerText=('0'+d.getDate()).slice(-2)+':' + ('0'+(d.getMonth()+1)).slice(-2)+':'+d.getFullYear();"
                                        style="opacity:0; position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none;" />
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Priority and Reminder -->
                <div class="p-3 mb-4" style="background-color: #f6f6f6; border-radius: 10px;">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 style="font-weight: 600;">Ticket Priority</h6>
                            <p style="color: #888;">Set the Priority of the Ticket</p>
                            <div class="d-flex gap-2">
                                <input type="hidden" id="ticketPriority" value="low">
                                <button type="button" class="btn" data-priority="low" style="background-color: #00C853; color: white;">Low</button>
                                <button type="button" class="btn" data-priority="medium" style="background-color: #f0f0f0;">Middle</button>
                                <button type="button" class="btn" data-priority="high" style="background-color: #f0f0f0;">High</button>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <h6 style="font-weight: 600;">Expired Reminder</h6>
                            <p style="color: #888;">Set a reminder before expired</p>
                            <div class="d-flex  gap-2">
                                <input type="hidden" id="ticketReminderHours" value="6">
                                <button type="button" class="btn" data-reminder="6" style="background-color: #00C853; color: white;">6 Hr</button>
                                <button type="button" class="btn" data-reminder="12" style="background-color: #f0f0f0;">12 Hr</button>
                                <button type="button" class="btn" data-reminder="24" style="background-color: #f0f0f0;">24 Hr</button>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Buttons -->
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <button id="saveCloseTicketBtn" class="btn" style="background-color: #00C853; color: white; min-width: 160px;margin-bottom:3px;">
                        Save and Close
                    </button>
                    <button id="saveAddAnotherTicketBtn" class="btn" style="background-color: #F5A623; color: white; min-width: 160px;">
                        Save & add Ticket
                    </button>
                </div>


            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS Required -->






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



<!-- dark and light mode -->
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
    document.addEventListener('DOMContentLoaded', function () {
        const projectSelect = document.getElementById('ticketProjectSelect');
        const sectionSelect = document.getElementById('ticketSectionSelect');
        

        const priorityHidden = document.getElementById('ticketPriority');
        const reminderHidden = document.getElementById('ticketReminderHours');

        const saveCloseBtn = document.getElementById('saveCloseTicketBtn');
        const saveAddAnotherBtn = document.getElementById('saveAddAnotherTicketBtn');

        // Helper to set active button style for grouped buttons
        function setActive(groupSelector, activeAttribute, value) {
            const buttons = document.querySelectorAll(groupSelector);
            buttons.forEach(btn => {
                if (btn.getAttribute(activeAttribute) == value) {
                    btn.style.backgroundColor = '#00C853';
                    btn.style.color = 'white';
                } else {
                    btn.style.backgroundColor = '#f0f0f0';
                    btn.style.color = 'black';
                }
            });
        }

        // Priority buttons
        document.querySelectorAll('[data-priority]')?.forEach(btn => {
            btn.addEventListener('click', () => {
                priorityHidden.value = btn.getAttribute('data-priority');
                setActive('[data-priority]', 'data-priority', priorityHidden.value);
            });
        });

        // Reminder buttons
        document.querySelectorAll('[data-reminder]')?.forEach(btn => {
            btn.addEventListener('click', () => {
                reminderHidden.value = btn.getAttribute('data-reminder');
                setActive('[data-reminder]', 'data-reminder', reminderHidden.value);
            });
        });

        // Fetch projects into dropdown
        async function loadProjects() {
            try {
                const resp = await fetch('/api/tickets/projects', { credentials: 'same-origin' });
                const data = await resp.json();
                projectSelect.innerHTML = '<option value="">Select the Project</option>' +
                    data.map(p => `<option value="${p.id}">${p.title ?? 'Untitled'}</option>`).join('');
            } catch (e) {
                console.error('Failed to load projects', e);
            }
        }

        // Fetch sections when project changes
        async function loadSections(projectId) {
            sectionSelect.innerHTML = '<option value="">Select the Section</option>';
            if (!projectId) return;
            try {
                const resp = await fetch(`/api/tickets/projects/${projectId}/sections`, { credentials: 'same-origin' });
                const data = await resp.json();
                sectionSelect.innerHTML = '<option value="">Select the Section</option>' +
                    (Array.isArray(data) ? data.map(s => `<option value="${s.name}">${s.name}</option>`).join('') : '');
            } catch (e) {
                console.error('Failed to load sections', e);
            }
        }

        projectSelect?.addEventListener('change', function () {
            loadSections(this.value);
        });

        

        // Submit ticket helper
        async function submitTicket(closeAfter) {
            const payload = {
                project_id: projectSelect.value || '',
                section_name: sectionSelect.value || '',
                title: document.getElementById('ticketTitle')?.value || '',
                description: document.getElementById('ticketDescription')?.value || '',
                status: 'in_progress',
                priority: priorityHidden.value || 'low',
                start_date: document.getElementById('startDateInput')?.value || null,
                end_date: document.getElementById('expiredDateInput')?.value || null,
                reminder_hours: parseInt(reminderHidden.value || '6', 10),
            };

            try {
                const resp = await fetch('/api/tickets', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                    },
                    credentials: 'same-origin',
                    body: JSON.stringify(payload)
                });

                if (resp.ok) {
                    // Close modal if needed
                    if (closeAfter) {
                        const modalEl = document.getElementById('ticketModal');
                        const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
                        modal.hide();
                        // Reload to show session success alert
                        window.location.reload();
                    } else {
                        // Inline success alert when staying in modal
                        const banner = document.createElement('div');
                        banner.className = 'alert alert-success alert-dismissible fade show';
                        banner.style.borderRadius = '8px';
                        banner.role = 'alert';
                        banner.innerHTML = 'Ticket created successfully.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                        document.querySelector('.content.main_content')?.prepend(banner);
                    }
                    // Reset minimal fields
                    document.getElementById('ticketTitle').value = '';
                    document.getElementById('ticketDescription').value = '';
                } else {
                    const err = await resp.json();
                    alert(err?.message || 'Failed to create ticket');
                }
            } catch (e) {
                console.error('Failed to create ticket', e);
            }
        }

        saveCloseBtn?.addEventListener('click', function (e) {
            e.preventDefault();
            submitTicket(true);
        });
        saveAddAnotherBtn?.addEventListener('click', function (e) {
            e.preventDefault();
            submitTicket(false);
        });

        // Initial load
        loadProjects();
    });
</script>

<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->
@component('components.model-popup')
@endcomponent
@endsection