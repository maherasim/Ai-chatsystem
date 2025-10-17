<?php $page = 'index'; ?>
@extends('layout.mainlayout')
@section('content')


<style>
    /* Ensure base styles don't interfere */
    .project-details {
        max-height: 0;
        overflow: hidden;
        opacity: 0;
        transition: max-height 0.7s ease, opacity 0.6s ease;
    }
    .px-4 {
    padding-right: 1.5rem !important;
    padding-left: 3.5rem !important;
}
    .project-details.show {
        opacity: 1;
    }

    .toggle-icon {
        transition: transform 0.6s ease;
    }

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

    /* Make dropdown chevron icon much smaller and better aligned */
    .form-select {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23666' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m2 6 6 6 6-6'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 8px center;
        background-size: 8px 8px;
        padding-right: 20px !important;
        text-align: center;
    }

    /* Custom thin red scrollbar for individual cards */
    .ticket-card-container {
        overflow-y: auto;
        max-height: 400px;
        padding-right: 5px;
    }

    .ticket-card-container::-webkit-scrollbar {
        width: 3px;
    }

    .ticket-card-container::-webkit-scrollbar-track {
        background: transparent;
    }

    .ticket-card-container::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 2px;
    }

    .ticket-card-container::-webkit-scrollbar-thumb:hover {
        background: #a8a8a8;
    }

    /* Center text in ticket items */
    .ticket-item-text {
        text-align: center;
    }

    .ticket-header-text {
        text-align: center;
    }

    .ticket-task-line {
        text-align: center;
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
                    <div class="project-succes pt-1 pb-1 d-flex justify-content-between align-items-center" style="flex-wrap: wrap; gap: 10px;">

                        <!-- Left Side -->
                        <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                            <!-- Left Side -->
                            <div>
                                <h3 class="mb-1">Ticket Overview</h3>
                                <strong>Total Tickets: <span id="total-tickets-count">0</span></strong>
                            </div>
                        
                            <!-- Right Side -->
                            <div style="padding-left: 1000px;">
                                <button
                                    type="button"
                                    data-bs-toggle="modal"
                                    data-bs-target="#ticketModal"
                                    style="background-color: #E87326; color: white; border: none; padding: 7px 14px; border-radius: 6px; font-weight: 500; display: flex; align-items: center; gap: 6px; cursor: pointer;">
                                    + Create Ticket
                                </button>
                            </div>
                        </div>
                        

                        <!-- Right Side -->
                      
                    </div>
                    <!-- Container for the full width -->
                    <div class="container-fluid px-4">
                        <div class="py-1" style="display: flex; gap: 80px; padding-left: 20px;">
                            <!-- Card 1: Total Projects -->
                            <div style="flex: 1; max-width: 250px;">
                                <div class="px-3 py-2" style="border-radius: 10px; height: 100px; background: #fff; position: relative; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);">

                                    <!-- Top Row -->
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div style="font-size: 0.9rem; color: #1e2b4d;">Total Tickets</div>
                                        <div style="background-color: #eae8fd; border-radius: 50%; padding: 5px;">
                                            <img src="{{URL::asset('/build/img/sigma.svg')}}" alt="icon" style="width: 20px; height: 20px;" />
                                        </div>
                                    </div>

                                    <!-- Project Number -->
                                    <div class="fw-bold mt-1" style="font-size: 1.5rem; color: #1e2b4d;" id="total-tickets-card">0</div>

                                    <!-- Percentage Change (Bottom Right) -->
                                    <div style="position: absolute; bottom: 8px; right: 16px; font-size: 0.9rem; color: #28c76f;">
                                        <i class="bi bi-arrow-up-right"></i> <span id="total-tickets-percentage">0</span>%
                                    </div>

                                </div>
                            </div>

                            <!-- card-2 -->
                            <div style="flex: 1; max-width: 250px;">
                                <div class="px-3 py-2" style="border-radius: 10px; height: 100px; background: #fff; position: relative; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);">

                                    <!-- Top Row -->
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="d-flex align-items-center" style="gap: 6px;">
                                            <div style="font-size: 0.9rem; color: #1e2b4d;">In Progress</div>
                                            <img src="{{ asset('assets/spin-loader.gif') }}" alt="loading" style="width: 18px; height: 18px;" />
                                        </div>
                                        <div style="background-color: #e9f8dd; border-radius: 50%; padding: 5px;">
                                            <img src="{{URL::asset('/build/img/greenflag.svg')}}" alt="icon" style="width: 20px; height: 20px;" />
                                        </div>
                                    </div>

                                    <!-- Project Number -->
                                    <div class="fw-bold mt-1" style="font-size: 1.5rem; color: #1e2b4d;" id="in-progress-card">0</div>

                                    <!-- Percentage Change (Bottom Right) -->
                                    <div style="position: absolute; bottom: 8px; right: 16px; font-size: 0.9rem; color: #28c76f;">
                                        <i class="bi bi-arrow-up-right"></i> <span id="in-progress-percentage">0</span>%
                                    </div>

                                </div>
                            </div>
                            <!-- card 3 -->

                            <div style="flex: 1; max-width: 250px;">
                                <div class="px-3 py-2" style="border-radius: 10px; height: 100px; background: #fff; position: relative; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);">

                                    <!-- Top Row -->
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="d-flex align-items-center" style="gap: 6px;">
                                            <div style="font-size: 0.9rem; color: #1e2b4d;">In Hold</div>
                                            <img src="{{ asset('assets/spin-loader.gif') }}" alt="loading" style="width: 18px; height: 18px;" />
                                        </div>
                                        <div style="background-color: #fff3cd; border-radius: 50%; padding: 5px;">
                                            <img src="{{URL::asset('/build/img/yelowflag.svg')}}" alt="icon" style="width: 20px; height: 20px;" />
                                        </div>
                                    </div>

                                    <!-- Project Number -->
                                    <div class="fw-bold mt-1" style="font-size: 1.5rem; color: #1e2b4d;" id="in-hold-card">0</div>

                                    <!-- Percentage Change (Bottom Right) -->
                                    <div style="position: absolute; bottom: 8px; right: 16px; font-size: 0.9rem; color: #ff2e2e">
                                        <i class="bi bi-arrow-down-right"></i> <span id="in-hold-percentage">0</span>%
                                    </div>

                                </div>
                            </div>


                            <!-- card 4 -->

                            <div style="flex: 1; max-width: 250px;">
                                <div class="px-3 py-2" style="border-radius: 10px; height: 100px; background: #fff; position: relative; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);">

                                    <!-- Top Row -->
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="d-flex align-items-center" style="gap: 6px;">
                                            <div style="font-size: 0.9rem; color: #1e2b4d;">In Delayed</div>
                                            <img src="{{ asset('assets/spin-loader.gif') }}" alt="loading" style="width: 18px; height: 18px;" />
                                        </div>
                                        <div style="background-color: #fddede; border-radius: 50%; padding: 5px;">
                                            <img src="{{URL::asset('/build/img/redflag.svg')}}" alt="icon" style="width: 20px; height: 20px;" />
                                        </div>
                                    </div>

                                    <!-- Project Number -->
                                    <div class="fw-bold mt-1" style="font-size: 1.5rem; color: #1e2b4d;" id="in-delayed-card">0</div>

                                    <!-- Percentage Change (Bottom Right) -->
                                    <div style="position: absolute; bottom: 8px; right: 16px; font-size: 0.9rem; color: #ff2e2e;">
                                        <i class="bi bi-arrow-down-right"></i> <span id="in-delayed-percentage">0</span>%
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- project overview -->
                    
                    <div class="project-succes pt-1 pb-1 d-flex flex-column flex-md-row align-items-start align-items-md-center" style="margin-top: 10px;">
                        <!-- Left -->
                        <div>
                          <h3 style="margin: 0;">Ticket Status</h3>
                          <strong>Total Shared ToDO's: 10</strong>
                        </div>
                      
                        <!-- Right (ms-auto pushes this to the end of the row) -->
                       
                      </div>
                      
                    <!-- tickers -->
                    <div class="container" style="margin-bottom: 15px;">
                        <div class="row ">
                            <div class="col-auto">
                                <div class="d-flex flex-wrap justify-content-center align-items-center rounded shadow-sm px-3 py-2" style="background-color: #f8f9fa; gap: 20px;">

                                    <!-- New Ticket -->
                                    <div class="d-flex align-items-center">
                                        <div class="text-center bg-white p-2 rounded-3 shadow-sm status-card" data-status="new" style="width: 130px; cursor: pointer; transition: all 0.3s ease;" onclick="centerSliderCard('new')">
                                            <div style="border-radius: 50%; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; margin: 0 auto 4px;">
                                                <img src="{{URL::asset('/build/img/newtask.svg')}}" style="width: 30px; height: 30px;" alt="New Ticket">
                                            </div>
                                            <div style="font-size: 13px; color: #4A4A4A;">New Ticket</div>
                                            <div style="font-weight: bold; font-size: 14px; color: #000;" id="new-ticket-status-count">0</div>
                                        </div>
                                        <div class="vr d-none d-md-block align-self-center mx-3" style="opacity: 0.2; height: 45px;"></div>
                                    </div>

                                    <!-- In Progress -->
                                    <div class="d-flex align-items-center">
                                        <div class="text-center bg-white p-2 rounded-3 shadow-sm status-card" data-status="progress" style="width: 130px; cursor: pointer; transition: all 0.3s ease;" onclick="centerSliderCard('progress')">
                                            <div style="border-radius: 50%; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; margin: 0 auto 4px;">
                                                <img src="{{URL::asset('/build/img/progress.svg')}}" style="width: 30px; height: 30px;" alt="In Progress">
                                            </div>
                                            <div style="font-size: 13px; color: #4A4A4A;">In Progress</div>
                                            <div style="font-weight: bold; font-size: 14px; color: #000;" id="in-progress-status-count">0</div>
                                        </div>
                                        <div class="vr d-none d-md-block align-self-center mx-3" style="opacity: 0.2; height: 45px;"></div>
                                    </div>

                                    <!-- In Hold -->
                                    <div class="d-flex align-items-center">
                                        <div class="text-center bg-white p-2 rounded-3 shadow-sm status-card" data-status="hold" style="width: 130px; cursor: pointer; transition: all 0.3s ease;" onclick="centerSliderCard('hold')">
                                            <div style="border-radius: 50%; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; margin: 0 auto 4px;">
                                                <img src="{{URL::asset('/build/img/inhold.svg')}}" style="width: 30px; height: 30px;" alt="In Hold">
                                            </div>
                                            <div style="font-size: 13px; color: #4A4A4A;">In Hold</div>
                                            <div style="font-weight: bold; font-size: 14px; color: #000;" id="in-hold-status-count">0</div>
                                        </div>
                                        <div class="vr d-none d-md-block align-self-center mx-3" style="opacity: 0.2; height: 45px;"></div>
                                    </div>

                                    <!-- In Delayed -->
                                    <div class="d-flex align-items-center">
                                        <div class="text-center bg-white p-2 rounded-3 shadow-sm status-card" data-status="delayed" style="width: 130px; cursor: pointer; transition: all 0.3s ease;" onclick="centerSliderCard('delayed')">
                                            <div style="border-radius: 50%; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; margin: 0 auto 4px;">
                                                <img src="{{URL::asset('/build/img/delayed.svg')}}" style="width: 30px; height: 30px;" alt="In Delayed">
                                            </div>
                                            <div style="font-size: 13px; color: #4A4A4A;">In Delayed</div>
                                            <div style="font-weight: bold; font-size: 14px; color: #000;" id="in-delayed-status-count">0</div>
                                        </div>
                                        <div class="vr d-none d-md-block align-self-center mx-3" style="opacity: 0.2; height: 45px;"></div>
                                    </div>

                                    <!-- In Done -->
                                    <div class="d-flex align-items-center">
                                        <div class="text-center bg-white p-2 rounded-3 shadow-sm status-card" data-status="done" style="width: 130px; cursor: pointer; transition: all 0.3s ease;" onclick="centerSliderCard('done')">
                                            <div style="border-radius: 50%; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; margin: 0 auto 4px;">
                                                <img src="{{URL::asset('/build/img/indone.svg')}}" style="width: 30px; height: 30px;" alt="In Done">
                                            </div>
                                            <div style="font-size: 13px; color: #4A4A4A;">In Done</div>
                                            <div style="font-weight: bold; font-size: 14px; color: #000;" id="in-done-status-count">0</div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>



                    <div id="ticketsSlider1" class="mb-2 tickets-slider-new">
                        <div class="slider-container">
                            <!-- 1-->
                            <div class="col-6 col-md-3 col-lg-3" data-ticket-status="progress">
                                <div class="card shadow-sm p-1" style="border-radius: 20px; font-family: 'Segoe UI', sans-serif;">
                                    <!-- Top Section -->
                                    <div class="d-flex justify-content-between align-items-center mb-2" style="margin-top: 15px;">
                                        <div style="margin-left: 15px;">
                                            <div style="color: #7ED957; font-weight: 600; font-size: 16px;">Ticket In Progress</div>
                                            <div style="font-size: 13px; color: #7ED957;">Total Tasks: <span id="in-progress-count">0</span></div>
                                        </div>
                                        <div class="d-flex gap-2">
                                            
                                            <select class="form-select form-select-sm" id="in-progress-project-filter" onchange="filterByProjectAndPriority()" style="font-size: 12px; border-radius: 6px; border: 1px solid #e0e0e0; padding: 4px 8px; background-color: #fff; box-shadow: 0 1px 2px rgba(0,0,0,0.1); min-width: 100px; height: 28px;">
                                                <option value="" selected>All Projects</option>
                                                @foreach ($projects as $project)
                                                <option value="{{ $project->id }}">{{ $project->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <!-- Scrollable Content Container -->
                                    <div class="ticket-card-container" id="in-progress-tickets">
                                        <!-- Dynamic tickets will be loaded here -->
                                        <div class="text-center p-4" id="loading-tickets">
                                            <div class="spinner-border text-primary" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            <p class="mt-2 text-muted">Loading tickets...</p>
                                        </div>
                                    </div> <!-- End Scrollable Content Container -->
                                </div>

                            </div>
                            <!-- 2 -->
                            <div class="col-12 col-sm-6 col-md-3 col-lg-3" data-ticket-status="hold">
                                <div class="card shadow-sm p-1" style="border-radius: 20px; font-family: 'Segoe UI', sans-serif;">
                                    <!-- Top Section -->
                                    <div class="d-flex justify-content-between align-items-center mb-2" style="margin-top: 15px;">
                                        <div style="margin-left: 15px;">
                                            <div style="color: #F5A623; font-weight: 600; font-size: 16px;"> Ticket In Hold</div>
                                            <div style="font-size: 13px; color: #F5A623;">Total Tasks: <span id="hold-count">0</span></div>
                                        </div>
                                        <div class="d-flex gap-2">
                                            
                                            <select name="type" id="hold-project-filter" onchange="filterByProjectAndPriority()" required="required"
                    style="border: 1px solid #e5e7eb; border-radius: 8px; padding: 6px 12px; font-size: 13px; color: #333; width: 120px; background-color: white;">
                    <option value="" selected>All Projects</option>
                   @foreach ($projects as $project)
                   <option value="{{ $project->id }}">{{ $project->title }}</option>
                   @endforeach
                   
                    
                </select>
                                        </div>
                                    </div>
                                    
                                    <!-- Scrollable Content Container -->
                                    <div class="ticket-card-container" id="hold-tickets">
                                        <!-- Dynamic tickets will be loaded here -->
                                        <div class="text-center p-4" id="loading-hold-tickets">
                                            <div class="spinner-border text-warning" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            <p class="mt-2 text-muted">Loading hold tickets...</p>
                                        </div>

                                    <div class=" mt-2" style=" background-color: #f8f9fa; border-radius: 10px;padding:2px;font-size: 11px;">

                                        <!-- Header -->
                                        <div class="d-flex justify-content-between flex-wrap">
                                            <div class="ticket-header-text">
                                                <img src="{{ asset('build/img/yekbon.svg') }}" alt="yekbon" style="width: 35px; height: 35px;">
                                            </div>
                                            <div class="ticket-header-text" style="color: #1a73e8;"><strong>Tickets</strong><br>#1 - ID</div>
                                            <div class="ticket-header-text" style="color: #1a73e8;"><strong>Section</strong><br>User Profile</div>
                                            <div class="ticket-header-text" style="color: #1a73e8;"><strong>Ticket Title</strong><br>User Profile Bugs</div>
                                        </div>

                                        <!-- Task Line -->
                                        <div class="ticket-task-line" style="margin-top: 1rem; display: flex; align-items: center;text-align:center; flex-wrap: wrap;justify-content:space-between; background-color: #fff; border-radius: 10px; padding: 6px; font-size: 12px; color: #333;font-size:12px;">

                                            <!-- Task Count -->
                                            <span class="ticket-item-text" style="margin-right: 5px; font-weight: bold; color: #28a745;">Tasks
                                                <p style="color: black;">5</p>
                                            </span>

                                            <!-- Divider -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Start Date -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #28a745;">Start:
                                                <p style="color: black;">22.10.2024</p>
                                            </span>

                                            <!-- Divider -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Delivery Date -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #28a745;">Deliver: <p style="color: black;">22.10.2024</p></span>

                                            <!-- Divider -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Overlapping Profile Avatars -->
                                            <div class="ticket-item-text" style="display: flex; align-items: center;">
                                                <img src="{{ asset('assets/spin-loader.gif') }}" alt="User" style="width: 19px; height: 19px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                                                <img src="{{ asset('assets/spin-loader.gif') }}" alt="User" style="width: 19px; height: 19px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                                                <img src="{{ asset('assets/spin-loader.gif') }}" alt="User" style="width: 19px; height: 19px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">

                                            </div>
                                        </div>



                                        <!-- Progress Bar -->
                                        <div class="d-flex justify-content-between align-items-center mt-1 mb-1" style="flex-wrap: nowrap; background:#fff;padding:5px;border-radius:10px;">
                                            <!-- Progress Bar + Percentage -->
                                            <div class="d-flex align-items-center" style="flex: 1;">
                                                <div class="d-flex align-items-center" style="flex: 1;">
                                                    <div class="progress" style="height: 8px; width: 100px; background-color: #e0e0e0; border-radius: 5px; overflow: hidden;">
                                                        <div class="progress-bar" role="progressbar" style="width: 0%; background-color: #4fc3f7;"></div>
                                                    </div>
                                                    <div style="font-size: 12px; color: #4fc3f7; margin-left: 7px;">0%</div>
                                                </div>
                                                <span style="margin-left: 8px; color: #ccc;">|</span>
                                            </div>
                                            <!-- Status Colors -->
                                            <div class="d-flex align-items-center ms-3" style="font-size: 11px; gap: 3px; margin-right:4px;">
                                                <span style="color: #8BC34A;">● 0</span>
                                                <span style="color: #FF9800;">● 0</span>
                                                <span style="color: #F44336;">● 0</span>
                                                <span style="color: #9C27B0;">● 0</span>
                                                <span style="color: #4CAF50;">● 0</span>
                                                <span style="margin-left: 12px; color: #ccc; margin-right:5px;">|</span>
                                                <span style="background-color: #e9f8dd; border-radius: 10; padding: 5px;">
                                                    <img src="{{ URL::asset('/build/img/greenflag.svg') }}" alt="alt" width="20px;">
                                                </span>
                                            </div>


                                        </div>
                                        <!-- tasks -->
                                    </div>
                                    <!-- 2 -->
                                    <div class=" mt-2" style=" background-color: #f8f9fa; border-radius: 10px;padding:2px;font-size: 11px;">

                                        <!-- Header -->
                                        <div class="d-flex justify-content-between flex-wrap">
                                            <div class="ticket-header-text">
                                                <img src="{{ asset('build/img/yekbon.svg') }}" alt="yekbon" style="width: 35px; height: 35px;">
                                            </div>
                                            <div class="ticket-header-text" style="color: #1a73e8;"><strong>Tickets</strong><br>#1 - ID</div>
                                            <div class="ticket-header-text" style="color: #1a73e8;"><strong>Section</strong><br>User Profile</div>
                                            <div class="ticket-header-text" style="color: #1a73e8;"><strong>Ticket Title</strong><br>User Profile Bugs</div>
                                        </div>

                                        <!-- Task Line -->
                                        <div class="ticket-task-line" style="margin-top: 1rem; display: flex; align-items: center;text-align:center; flex-wrap: wrap;justify-content:space-between; background-color: #fff; border-radius: 10px; padding: 6px; font-size: 12px; color: #333;font-size:12px;">

                                            <!-- Task Count -->
                                            <span class="ticket-item-text" style="margin-right: 5px; font-weight: bold; color: #28a745;">Tasks
                                                <p style="color: black;">5</p>
                                            </span>

                                            <!-- Divider -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Start Date -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #28a745;">Start:
                                                <p style="color: black;">22.10.2024</p>
                                            </span>

                                            <!-- Divider -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Delivery Date -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #28a745;">Deliver: <p style="color: black;">22.10.2024</p></span>

                                            <!-- Divider -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Overlapping Profile Avatars -->
                                            <div class="ticket-item-text" style="display: flex; align-items: center;">
                                                <img src="{{ asset('assets/spin-loader.gif') }}" alt="User" style="width: 19px; height: 19px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                                                <img src="{{ asset('assets/spin-loader.gif') }}" alt="User" style="width: 19px; height: 19px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                                                <img src="{{ asset('assets/spin-loader.gif') }}" alt="User" style="width: 19px; height: 19px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">

                                            </div>
                                        </div>


                                        <!-- Progress Bar -->
                                        <div class="d-flex justify-content-between align-items-center mt-1 mb-1" style="flex-wrap: nowrap; background:#fff;padding:5px;border-radius:10px;">
                                            <!-- Progress Bar + Percentage -->
                                            <div class="d-flex align-items-center" style="flex: 1;">
                                                <div class="d-flex align-items-center" style="flex: 1;">
                                                    <div class="progress" style="height: 8px; width: 100px; background-color: #e0e0e0; border-radius: 5px; overflow: hidden;">
                                                        <div class="progress-bar" role="progressbar" style="width: 0%; background-color: #4fc3f7;"></div>
                                                    </div>
                                                    <div style="font-size: 12px; color: #4fc3f7; margin-left: 7px;">0%</div>
                                                </div>
                                                <span style="margin-left: 8px; color: #ccc;">|</span>
                                            </div>
                                            <!-- Status Colors -->
                                            <div class="d-flex align-items-center ms-3" style="font-size: 11px; gap: 3px; margin-right:4px;">
                                                <span style="color: #8BC34A;">● 0</span>
                                                <span style="color: #FF9800;">● 0</span>
                                                <span style="color: #F44336;">● 0</span>
                                                <span style="color: #9C27B0;">● 0</span>
                                                <span style="color: #4CAF50;">● 0</span>
                                                <span style="margin-left: 12px; color: #ccc; margin-right:5px;">|</span>
                                                <span style="background-color: #e9f8dd; border-radius: 10; padding: 5px;">
                                                    <img src="{{ URL::asset('/build/img/greenflag.svg') }}" alt="alt" width="20px;">
                                                </span>
                                            </div>


                                        </div>
                                        <!-- tasks -->
                                    </div>
                                    <!-- 3 -->
                                    <div class=" mt-2" style=" background-color: #f8f9fa; border-radius: 10px;padding:2px;font-size: 11px;">

                                        <!-- Header -->
                                        <div class="d-flex justify-content-between flex-wrap">
                                            <div class="ticket-header-text">
                                                <img src="{{ asset('build/img/yekbon.svg') }}" alt="yekbon" style="width: 35px; height: 35px;">
                                            </div>
                                            <div class="ticket-header-text" style="color: #1a73e8;"><strong>Tickets</strong><br>#1 - ID</div>
                                            <div class="ticket-header-text" style="color: #1a73e8;"><strong>Section</strong><br>User Profile</div>
                                            <div class="ticket-header-text" style="color: #1a73e8;"><strong>Ticket Title</strong><br>User Profile Bugs</div>
                                        </div>

                                        <!-- Task Line -->
                                        <div class="ticket-task-line" style="margin-top: 1rem; display: flex; align-items: center;text-align:center; flex-wrap: wrap;justify-content:space-between; background-color: #fff; border-radius: 10px; padding: 6px; font-size: 12px; color: #333;font-size:12px;">

                                            <!-- Task Count -->
                                            <span class="ticket-item-text" style="margin-right: 5px; font-weight: bold; color: #28a745;">Tasks
                                                <p style="color: black;">5</p>
                                            </span>

                                            <!-- Divider -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Start Date -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #28a745;">Start:
                                                <p style="color: black;">22.10.2024</p>
                                            </span>

                                            <!-- Divider -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Delivery Date -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #28a745;">Deliver: <p style="color: black;">22.10.2024</p></span>

                                            <!-- Divider -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Overlapping Profile Avatars -->
                                            <div class="ticket-item-text" style="display: flex; align-items: center;">
                                                <img src="{{ asset('assets/spin-loader.gif') }}" alt="User" style="width: 19px; height: 19px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                                                <img src="{{ asset('assets/spin-loader.gif') }}" alt="User" style="width: 19px; height: 19px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                                                <img src="{{ asset('assets/spin-loader.gif') }}" alt="User" style="width: 19px; height: 19px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">

                                            </div>
                                        </div>



                                        <!-- Progress Bar -->
                                        <div class="d-flex justify-content-between align-items-center mt-1 mb-1" style="flex-wrap: nowrap; background:#fff;padding:5px;border-radius:10px;">
                                            <!-- Progress Bar + Percentage -->
                                            <div class="d-flex align-items-center" style="flex: 1;">
                                                <div class="d-flex align-items-center" style="flex: 1;">
                                                    <div class="progress" style="height: 8px; width: 100px; background-color: #e0e0e0; border-radius: 5px; overflow: hidden;">
                                                        <div class="progress-bar" role="progressbar" style="width: 0%; background-color: #4fc3f7;"></div>
                                                    </div>
                                                    <div style="font-size: 12px; color: #4fc3f7; margin-left: 7px;">0%</div>
                                                </div>
                                                <span style="margin-left: 8px; color: #ccc;">|</span>
                                            </div>
                                            <!-- Status Colors -->
                                            <div class="d-flex align-items-center ms-3" style="font-size: 11px; gap: 3px; margin-right:4px;">
                                                <span style="color: #8BC34A;">● 0</span>
                                                <span style="color: #FF9800;">● 0</span>
                                                <span style="color: #F44336;">● 0</span>
                                                <span style="color: #9C27B0;">● 0</span>
                                                <span style="color: #4CAF50;">● 0</span>
                                                <span style="margin-left: 12px; color: #ccc; margin-right:5px;">|</span>
                                                <span style="background-color: #e9f8dd; border-radius: 10; padding: 5px;">
                                                    <img src="{{ URL::asset('/build/img/greenflag.svg') }}" alt="alt" width="20px;">
                                                </span>
                                            </div>


                                        </div>
                                        <!-- tasks -->
                                    </div>
                                    
                                    </div> <!-- End Scrollable Content Container -->
                                </div>

                            </div>
                            <!-- 3 -->
                            <div class="col-12 col-sm-6 col-md-3 col-lg-3" data-ticket-status="delayed">
                                <div class="card shadow-sm p-1" style="border-radius: 20px; font-family: 'Segoe UI', sans-serif;">
                                    <!-- Top Section -->
                                    <div class="d-flex justify-content-between align-items-center mb-2" style="margin-top: 15px;">
                                        <div style="margin-left: 15px;">
                                            <div style="color: #ED1C24; font-weight: 600; font-size: 16px;"> Ticket In Delayed</div>
                                            <div style="font-size: 13px; color: #ED1C24;">Total Tasks: <span id="delayed-count">0</span></div>
                                        </div>
                                        <div class="d-flex gap-2">
                                             
                                            <select name="type" id="delayed-project-filter" onchange="filterByProjectAndPriority()" required="required"
                    style="border: 1px solid #e5e7eb; border-radius: 8px; padding: 6px 12px; font-size: 13px; color: #333; width: 120px; background-color: white;">
                    <option value="" selected>All Projects</option>
                    @foreach ($projects as $project)
                    <option value="{{ $project->id }}">{{ $project->title }}</option>
                    @endforeach
                    
                </select>
                                        </div>
                                    </div>
                                    
                                    <!-- Scrollable Content Container -->
                                    <div class="ticket-card-container" id="delayed-tickets">
                                        <!-- Dynamic tickets will be loaded here -->
                                        <div class="text-center p-4" id="loading-delayed-tickets">
                                            <div class="spinner-border text-danger" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            <p class="mt-2 text-muted">Loading delayed tickets...</p>
                                        </div>

                                    <div class=" mt-2" style=" background-color: #f8f9fa; border-radius: 10px;padding:2px;font-size: 11px;">

                                        <!-- Header -->
                                        <div class="d-flex justify-content-between flex-wrap">
                                            <div class="ticket-header-text">
                                                <img src="{{ asset('build/img/yekbon.svg') }}" alt="yekbon" style="width: 35px; height: 35px;">
                                            </div>
                                            <div class="ticket-header-text" style="color: #1a73e8;"><strong>Tickets</strong><br>#1 - ID</div>
                                            <div class="ticket-header-text" style="color: #1a73e8;"><strong>Section</strong><br>User Profile</div>
                                            <div class="ticket-header-text" style="color: #1a73e8;"><strong>Ticket Title</strong><br>User Profile Bugs</div>
                                        </div>

                                        <!-- Task Line -->
                                        <div class="ticket-task-line" style="margin-top: 1rem; display: flex; align-items: center;text-align:center; flex-wrap: wrap;justify-content:space-between; background-color: #fff; border-radius: 10px; padding: 6px; font-size: 12px; color: #333;font-size:12px;">

                                            <!-- Task Count -->
                                            <span class="ticket-item-text" style="margin-right: 5px; font-weight: bold; color: #28a745;">Tasks
                                                <p style="color: black;">5</p>
                                            </span>

                                            <!-- Divider -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Start Date -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #28a745;">Start:
                                                <p style="color: black;">22.10.2024</p>
                                            </span>

                                            <!-- Divider -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Delivery Date -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #28a745;">Deliver: <p style="color: black;">22.10.2024</p></span>

                                            <!-- Divider -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Overlapping Profile Avatars -->
                                            <div class="ticket-item-text" style="display: flex; align-items: center;">
                                                <img src="{{ asset('assets/spin-loader.gif') }}" alt="User" style="width: 19px; height: 19px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                                                <img src="{{ asset('assets/spin-loader.gif') }}" alt="User" style="width: 19px; height: 19px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                                                <img src="{{ asset('assets/spin-loader.gif') }}" alt="User" style="width: 19px; height: 19px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">

                                            </div>
                                        </div>


                                        <!-- Progress Bar -->
                                        <div class="d-flex justify-content-between align-items-center mt-1 mb-1" style="flex-wrap: nowrap; background:#fff;padding:5px;border-radius:10px;">
                                            <!-- Progress Bar + Percentage -->
                                            <div class="d-flex align-items-center" style="flex: 1;">
                                                <div class="d-flex align-items-center" style="flex: 1;">
                                                    <div class="progress" style="height: 8px; width: 100px; background-color: #e0e0e0; border-radius: 5px; overflow: hidden;">
                                                        <div class="progress-bar" role="progressbar" style="width: 0%; background-color: #4fc3f7;"></div>
                                                    </div>
                                                    <div style="font-size: 12px; color: #4fc3f7; margin-left: 7px;">0%</div>
                                                </div>
                                                <span style="margin-left: 8px; color: #ccc;">|</span>
                                            </div>
                                            <!-- Status Colors -->
                                            <div class="d-flex align-items-center ms-3" style="font-size: 11px; gap: 3px; margin-right:4px;">
                                                <span style="color: #8BC34A;">● 0</span>
                                                <span style="color: #FF9800;">● 0</span>
                                                <span style="color: #F44336;">● 0</span>
                                                <span style="color: #9C27B0;">● 0</span>
                                                <span style="color: #4CAF50;">● 0</span>
                                                <span style="margin-left: 12px; color: #ccc; margin-right:5px;">|</span>
                                                <span style="background-color: #e9f8dd; border-radius: 10; padding: 5px;">
                                                    <img src="{{ URL::asset('/build/img/greenflag.svg') }}" alt="alt" width="20px;">
                                                </span>
                                            </div>


                                        </div>
                                        <!-- tasks -->
                                    </div>
                                    <div class=" mt-2" style=" background-color: #f8f9fa; border-radius: 10px;padding:2px;font-size: 11px;">

                                        <!-- Header -->
                                        <div class="d-flex justify-content-between flex-wrap">
                                            <div class="ticket-header-text">
                                                <img src="{{ asset('build/img/yekbon.svg') }}" alt="yekbon" style="width: 35px; height: 35px;">
                                            </div>
                                            <div class="ticket-header-text" style="color: #1a73e8;"><strong>Tickets</strong><br>#1 - ID</div>
                                            <div class="ticket-header-text" style="color: #1a73e8;"><strong>Section</strong><br>User Profile</div>
                                            <div class="ticket-header-text" style="color: #1a73e8;"><strong>Ticket Title</strong><br>User Profile Bugs</div>
                                        </div>

                                        <!-- Task Line -->
                                        <div class="ticket-task-line" style="margin-top: 1rem; display: flex; align-items: center;text-align:center; flex-wrap: wrap;justify-content:space-between; background-color: #fff; border-radius: 10px; padding: 6px; font-size: 12px; color: #333;font-size:12px;">

                                            <!-- Task Count -->
                                            <span class="ticket-item-text" style="margin-right: 5px; font-weight: bold; color: #28a745;">Tasks
                                                <p style="color: black;">5</p>
                                            </span>

                                            <!-- Divider -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Start Date -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #28a745;">Start:
                                                <p style="color: black;">22.10.2024</p>
                                            </span>

                                            <!-- Divider -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Delivery Date -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #28a745;">Deliver: <p style="color: black;">22.10.2024</p></span>

                                            <!-- Divider -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Overlapping Profile Avatars -->
                                            <div class="ticket-item-text" style="display: flex; align-items: center;">
                                                <img src="{{ asset('assets/spin-loader.gif') }}" alt="User" style="width: 19px; height: 19px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                                                <img src="{{ asset('assets/spin-loader.gif') }}" alt="User" style="width: 19px; height: 19px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                                                <img src="{{ asset('assets/spin-loader.gif') }}" alt="User" style="width: 19px; height: 19px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">

                                            </div>
                                        </div>


                                        <!-- Progress Bar -->
                                        <div class="d-flex justify-content-between align-items-center mt-1 mb-1" style="flex-wrap: nowrap; background:#fff;padding:5px;border-radius:10px;">
                                            <!-- Progress Bar + Percentage -->
                                            <div class="d-flex align-items-center" style="flex: 1;">
                                                <div class="d-flex align-items-center" style="flex: 1;">
                                                    <div class="progress" style="height: 8px; width: 100px; background-color: #e0e0e0; border-radius: 5px; overflow: hidden;">
                                                        <div class="progress-bar" role="progressbar" style="width: 0%; background-color: #4fc3f7;"></div>
                                                    </div>
                                                    <div style="font-size: 12px; color: #4fc3f7; margin-left: 7px;">0%</div>
                                                </div>
                                                <span style="margin-left: 8px; color: #ccc;">|</span>
                                            </div>
                                            <!-- Status Colors -->
                                            <div class="d-flex align-items-center ms-3" style="font-size: 11px; gap: 3px; margin-right:4px;">
                                                <span style="color: #8BC34A;">● 0</span>
                                                <span style="color: #FF9800;">● 0</span>
                                                <span style="color: #F44336;">● 0</span>
                                                <span style="color: #9C27B0;">● 0</span>
                                                <span style="color: #4CAF50;">● 0</span>
                                                <span style="margin-left: 12px; color: #ccc; margin-right:5px;">|</span>
                                                <span style="background-color: #e9f8dd; border-radius: 10; padding: 5px;">
                                                    <img src="{{ URL::asset('/build/img/greenflag.svg') }}" alt="alt" width="20px;">
                                                </span>
                                            </div>


                                        </div>
                                        <!-- tasks -->
                                    </div>
                                    <!-- 2 -->
                                    <div class=" mt-2" style=" background-color: #f8f9fa; border-radius: 10px;padding:2px;font-size: 11px;">

                                        <!-- Header -->
                                        <div class="d-flex justify-content-between flex-wrap">
                                            <div class="ticket-header-text">
                                                <img src="{{ asset('build/img/yekbon.svg') }}" alt="yekbon" style="width: 35px; height: 35px;">
                                            </div>
                                            <div class="ticket-header-text" style="color: #1a73e8;"><strong>Tickets</strong><br>#1 - ID</div>
                                            <div class="ticket-header-text" style="color: #1a73e8;"><strong>Section</strong><br>User Profile</div>
                                            <div class="ticket-header-text" style="color: #1a73e8;"><strong>Ticket Title</strong><br>User Profile Bugs</div>
                                        </div>

                                        <!-- Task Line -->
                                        <div class="ticket-task-line" style="margin-top: 1rem; display: flex; align-items: center;text-align:center; flex-wrap: wrap;justify-content:space-between; background-color: #fff; border-radius: 10px; padding: 6px; font-size: 12px; color: #333;font-size:12px;">

                                            <!-- Task Count -->
                                            <span class="ticket-item-text" style="margin-right: 5px; font-weight: bold; color: #28a745;">Tasks
                                                <p style="color: black;">5</p>
                                            </span>

                                            <!-- Divider -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Start Date -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #28a745;">Start:
                                                <p style="color: black;">22.10.2024</p>
                                            </span>

                                            <!-- Divider -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Delivery Date -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #28a745;">Deliver: <p style="color: black;">22.10.2024</p></span>

                                            <!-- Divider -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Overlapping Profile Avatars -->
                                            <div class="ticket-item-text" style="display: flex; align-items: center;">
                                                <img src="{{ asset('assets/spin-loader.gif') }}" alt="User" style="width: 19px; height: 19px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                                                <img src="{{ asset('assets/spin-loader.gif') }}" alt="User" style="width: 19px; height: 19px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                                                <img src="{{ asset('assets/spin-loader.gif') }}" alt="User" style="width: 19px; height: 19px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">

                                            </div>
                                        </div>



                                        <!-- Progress Bar -->
                                        <div class="d-flex justify-content-between align-items-center mt-1 mb-1" style="flex-wrap: nowrap; background:#fff;padding:5px;border-radius:10px;">
                                            <!-- Progress Bar + Percentage -->
                                            <div class="d-flex align-items-center" style="flex: 1;">
                                                <div class="d-flex align-items-center" style="flex: 1;">
                                                    <div class="progress" style="height: 8px; width: 100px; background-color: #e0e0e0; border-radius: 5px; overflow: hidden;">
                                                        <div class="progress-bar" role="progressbar" style="width: 0%; background-color: #4fc3f7;"></div>
                                                    </div>
                                                    <div style="font-size: 12px; color: #4fc3f7; margin-left: 7px;">0%</div>
                                                </div>
                                                <span style="margin-left: 8px; color: #ccc;">|</span>
                                            </div>
                                            <!-- Status Colors -->
                                            <div class="d-flex align-items-center ms-3" style="font-size: 11px; gap: 3px; margin-right:4px;">
                                                <span style="color: #8BC34A;">● 0</span>
                                                <span style="color: #FF9800;">● 0</span>
                                                <span style="color: #F44336;">● 0</span>
                                                <span style="color: #9C27B0;">● 0</span>
                                                <span style="color: #4CAF50;">● 0</span>
                                                <span style="margin-left: 12px; color: #ccc; margin-right:5px;">|</span>
                                                <span style="background-color: #e9f8dd; border-radius: 10; padding: 5px;">
                                                    <img src="{{ URL::asset('/build/img/greenflag.svg') }}" alt="alt" width="20px;">
                                                </span>
                                            </div>


                                        </div>
                                        <!-- tasks -->
                                    </div>
                                    <!-- 3 -->
                                    <div class=" mt-2" style=" background-color: #f8f9fa; border-radius: 10px;padding:2px;font-size: 11px;">

                                        <!-- Header -->
                                        <div class="d-flex justify-content-between flex-wrap">
                                            <div class="ticket-header-text">
                                                <img src="{{ asset('build/img/yekbon.svg') }}" alt="yekbon" style="width: 35px; height: 35px;">
                                            </div>
                                            <div class="ticket-header-text" style="color: #1a73e8;"><strong>Tickets</strong><br>#1 - ID</div>
                                            <div class="ticket-header-text" style="color: #1a73e8;"><strong>Section</strong><br>User Profile</div>
                                            <div class="ticket-header-text" style="color: #1a73e8;"><strong>Ticket Title</strong><br>User Profile Bugs</div>
                                        </div>

                                        <!-- Task Line -->
                                        <div class="ticket-task-line" style="margin-top: 1rem; display: flex; align-items: center;text-align:center; flex-wrap: wrap;justify-content:space-between; background-color: #fff; border-radius: 10px; padding: 6px; font-size: 12px; color: #333;font-size:12px;">

                                            <!-- Task Count -->
                                            <span class="ticket-item-text" style="margin-right: 5px; font-weight: bold; color: #28a745;">Tasks
                                                <p style="color: black;">5</p>
                                            </span>

                                            <!-- Divider -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Start Date -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #28a745;">Start:
                                                <p style="color: black;">22.10.2024</p>
                                            </span>

                                            <!-- Divider -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Delivery Date -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #28a745;">Deliver: <p style="color: black;">22.10.2024</p></span>

                                            <!-- Divider -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Overlapping Profile Avatars -->
                                            <div class="ticket-item-text" style="display: flex; align-items: center;">
                                                <img src="{{ asset('assets/spin-loader.gif') }}" alt="User" style="width: 19px; height: 19px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                                                <img src="{{ asset('assets/spin-loader.gif') }}" alt="User" style="width: 19px; height: 19px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                                                <img src="{{ asset('assets/spin-loader.gif') }}" alt="User" style="width: 19px; height: 19px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">

                                            </div>
                                        </div>



                                        <!-- Progress Bar -->
                                        <div class="d-flex justify-content-between align-items-center mt-1 mb-1" style="flex-wrap: nowrap; background:#fff;padding:5px;border-radius:10px;">
                                            <!-- Progress Bar + Percentage -->
                                            <div class="d-flex align-items-center" style="flex: 1;">
                                                <div class="d-flex align-items-center" style="flex: 1;">
                                                    <div class="progress" style="height: 8px; width: 100px; background-color: #e0e0e0; border-radius: 5px; overflow: hidden;">
                                                        <div class="progress-bar" role="progressbar" style="width: 0%; background-color: #4fc3f7;"></div>
                                                    </div>
                                                    <div style="font-size: 12px; color: #4fc3f7; margin-left: 7px;">0%</div>
                                                </div>
                                                <span style="margin-left: 8px; color: #ccc;">|</span>
                                            </div>
                                            <!-- Status Colors -->
                                            <div class="d-flex align-items-center ms-3" style="font-size: 11px; gap: 3px; margin-right:4px;">
                                                <span style="color: #8BC34A;">● 0</span>
                                                <span style="color: #FF9800;">● 0</span>
                                                <span style="color: #F44336;">● 0</span>
                                                <span style="color: #9C27B0;">● 0</span>
                                                <span style="color: #4CAF50;">● 0</span>
                                                <span style="margin-left: 12px; color: #ccc; margin-right:5px;">|</span>
                                                <span style="background-color: #e9f8dd; border-radius: 10; padding: 5px;">
                                                    <img src="{{ URL::asset('/build/img/greenflag.svg') }}" alt="alt" width="20px;">
                                                </span>
                                            </div>


                                        </div>
                                        <!-- tasks -->
                                    </div>
                                    
                                    </div> <!-- End Scrollable Content Container -->
                                </div>

                            </div>
                            <!-- 4 -->
                            <div class="col-12 col-sm-6 col-md-3 col-lg-3" data-ticket-status="done">
                                <div class="card shadow-sm p-1" style="border-radius: 20px; font-family: 'Segoe UI', sans-serif;">
                                    <!-- Top Section -->
                                    <div class="d-flex justify-content-between align-items-center mb-2" style="margin-top: 15px;">
                                        <div style="margin-left: 15px;">
                                            <div style="color: #00C853; font-weight: 600; font-size: 16px;"> Ticket In Done</div>
                                            <div style="font-size: 13px; color: #00C853;">Total Tasks: <span id="done-count">0</span></div>
                                        </div>
                                        <div class="d-flex gap-2">
                                            
                                            <select name="type" id="done-project-filter" onchange="filterByProjectAndPriority()" required="required"
                                style="border: 1px solid #e5e7eb; border-radius: 8px; padding: 6px 12px; font-size: 13px; color: #333; width: 120px; background-color: white;">
                                <option value="" selected>All Projects</option>
                                @foreach ($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->title }}</option>
                                @endforeach
                    
                </select>
                                        </div>
                                    </div>
                                    
                                    <!-- Scrollable Content Container -->
                                    <div class="ticket-card-container" id="done-tickets">
                                        <!-- Dynamic tickets will be loaded here -->
                                        <div class="text-center p-4" id="loading-done-tickets">
                                            <div class="spinner-border text-success" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            <p class="mt-2 text-muted">Loading done tickets...</p>
                                        </div>
                                    <div class=" mt-2" style=" background-color: #f8f9fa; border-radius: 10px;padding:2px;font-size: 11px;">

                                        <!-- Header -->
                                        <div class="d-flex justify-content-between flex-wrap">
                                            <div class="ticket-header-text">
                                                <img src="{{ asset('build/img/yekbon.svg') }}" alt="yekbon" style="width: 35px; height: 35px;">
                                            </div>
                                            <div class="ticket-header-text" style="color: #1a73e8;"><strong>Tickets</strong><br>#1 - ID</div>
                                            <div class="ticket-header-text" style="color: #1a73e8;"><strong>Section</strong><br>User Profile</div>
                                            <div class="ticket-header-text" style="color: #1a73e8;"><strong>Ticket Title</strong><br>User Profile Bugs</div>
                                        </div>

                                        <!-- Task Line -->
                                        <div class="ticket-task-line" style="margin-top: 1rem; display: flex; align-items: center;text-align:center; flex-wrap: wrap;justify-content:space-between; background-color: #fff; border-radius: 10px; padding: 6px; font-size: 12px; color: #333;font-size:12px;">

                                            <!-- Task Count -->
                                            <span class="ticket-item-text" style="margin-right: 5px; font-weight: bold; color: #28a745;">Tasks
                                                <p style="color: black;">5</p>
                                            </span>

                                            <!-- Divider -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Start Date -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #28a745;">Start:
                                                <p style="color: black;">22.10.2024</p>
                                            </span>

                                            <!-- Divider -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Delivery Date -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #28a745;">Deliver: <p style="color: black;">22.10.2024</p></span>

                                            <!-- Divider -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Overlapping Profile Avatars -->
                                            <div class="ticket-item-text" style="display: flex; align-items: center;">
                                                <img src="{{ asset('assets/spin-loader.gif') }}" alt="User" style="width: 19px; height: 19px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                                                <img src="{{ asset('assets/spin-loader.gif') }}" alt="User" style="width: 19px; height: 19px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                                                <img src="{{ asset('assets/spin-loader.gif') }}" alt="User" style="width: 19px; height: 19px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">

                                            </div>
                                        </div>



                                        <!-- Progress Bar -->
                                        <div class="d-flex justify-content-between align-items-center mt-1 mb-1" style="flex-wrap: nowrap; background:#fff;padding:5px;border-radius:10px;">
                                            <!-- Progress Bar + Percentage -->
                                            <div class="d-flex align-items-center" style="flex: 1;">
                                                <div class="d-flex align-items-center" style="flex: 1;">
                                                    <div class="progress" style="height: 8px; width: 100px; background-color: #e0e0e0; border-radius: 5px; overflow: hidden;">
                                                        <div class="progress-bar" role="progressbar" style="width: 0%; background-color: #4fc3f7;"></div>
                                                    </div>
                                                    <div style="font-size: 12px; color: #4fc3f7; margin-left: 7px;">0%</div>
                                                </div>
                                                <span style="margin-left: 8px; color: #ccc;">|</span>
                                            </div>
                                            <!-- Status Colors -->
                                            <div class="d-flex align-items-center ms-3" style="font-size: 11px; gap: 3px; margin-right:4px;">
                                                <span style="color: #8BC34A;">● 0</span>
                                                <span style="color: #FF9800;">● 0</span>
                                                <span style="color: #F44336;">● 0</span>
                                                <span style="color: #9C27B0;">● 0</span>
                                                <span style="color: #4CAF50;">● 0</span>
                                                <span style="margin-left: 12px; color: #ccc; margin-right:5px;">|</span>
                                                <span style="background-color: #e9f8dd; border-radius: 10; padding: 5px;">
                                                    <img src="{{ URL::asset('/build/img/greenflag.svg') }}" alt="alt" width="20px;">
                                                </span>
                                            </div>


                                        </div>
                                        <!-- tasks -->
                                    </div>
                                    <!-- 2 -->
                                    <div class=" mt-2" style=" background-color: #f8f9fa; border-radius: 10px;padding:2px;font-size: 11px;">

                                        <!-- Header -->
                                        <div class="d-flex justify-content-between flex-wrap">
                                            <div class="ticket-header-text">
                                                <img src="{{ asset('build/img/yekbon.svg') }}" alt="yekbon" style="width: 35px; height: 35px;">
                                            </div>
                                            <div class="ticket-header-text" style="color: #1a73e8;"><strong>Tickets</strong><br>#1 - ID</div>
                                            <div class="ticket-header-text" style="color: #1a73e8;"><strong>Section</strong><br>User Profile</div>
                                            <div class="ticket-header-text" style="color: #1a73e8;"><strong>Ticket Title</strong><br>User Profile Bugs</div>
                                        </div>

                                        <!-- Task Line -->
                                        <div class="ticket-task-line" style="margin-top: 1rem; display: flex; align-items: center;text-align:center; flex-wrap: wrap;justify-content:space-between; background-color: #fff; border-radius: 10px; padding: 6px; font-size: 12px; color: #333;font-size:12px;">

                                            <!-- Task Count -->
                                            <span class="ticket-item-text" style="margin-right: 5px; font-weight: bold; color: #28a745;">Tasks
                                                <p style="color: black;">5</p>
                                            </span>

                                            <!-- Divider -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Start Date -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #28a745;">Start:
                                                <p style="color: black;">22.10.2024</p>
                                            </span>

                                            <!-- Divider -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Delivery Date -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #28a745;">Deliver: <p style="color: black;">22.10.2024</p></span>

                                            <!-- Divider -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Overlapping Profile Avatars -->
                                            <div class="ticket-item-text" style="display: flex; align-items: center;">
                                                <img src="{{ asset('assets/spin-loader.gif') }}" alt="User" style="width: 19px; height: 19px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                                                <img src="{{ asset('assets/spin-loader.gif') }}" alt="User" style="width: 19px; height: 19px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                                                <img src="{{ asset('assets/spin-loader.gif') }}" alt="User" style="width: 19px; height: 19px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">

                                            </div>
                                        </div>



                                        <!-- Progress Bar -->
                                        <div class="d-flex justify-content-between align-items-center mt-1 mb-1" style="flex-wrap: nowrap; background:#fff;padding:5px;border-radius:10px;">
                                            <!-- Progress Bar + Percentage -->
                                            <div class="d-flex align-items-center" style="flex: 1;">
                                                <div class="d-flex align-items-center" style="flex: 1;">
                                                    <div class="progress" style="height: 8px; width: 100px; background-color: #e0e0e0; border-radius: 5px; overflow: hidden;">
                                                        <div class="progress-bar" role="progressbar" style="width: 0%; background-color: #4fc3f7;"></div>
                                                    </div>
                                                    <div style="font-size: 12px; color: #4fc3f7; margin-left: 7px;">0%</div>
                                                </div>
                                                <span style="margin-left: 8px; color: #ccc;">|</span>
                                            </div>
                                            <!-- Status Colors -->
                                            <div class="d-flex align-items-center ms-3" style="font-size: 11px; gap: 3px; margin-right:4px;">
                                                <span style="color: #8BC34A;">● 0</span>
                                                <span style="color: #FF9800;">● 0</span>
                                                <span style="color: #F44336;">● 0</span>
                                                <span style="color: #9C27B0;">● 0</span>
                                                <span style="color: #4CAF50;">● 0</span>
                                                <span style="margin-left: 12px; color: #ccc; margin-right:5px;">|</span>
                                                <span style="background-color: #e9f8dd; border-radius: 10; padding: 5px;">
                                                    <img src="{{ URL::asset('/build/img/greenflag.svg') }}" alt="alt" width="20px;">
                                                </span>
                                            </div>


                                        </div>
                                        <!-- tasks -->
                                    </div>
                                    <!-- 3 -->
                                    <div class=" mt-2" style=" background-color: #f8f9fa; border-radius: 10px;padding:2px;font-size: 11px;">

                                        <!-- Header -->
                                        <div class="d-flex justify-content-between flex-wrap">
                                            <div class="ticket-header-text">
                                                <img src="{{ asset('build/img/yekbon.svg') }}" alt="yekbon" style="width: 35px; height: 35px;">
                                            </div>
                                            <div class="ticket-header-text" style="color: #1a73e8;"><strong>Tickets</strong><br>#1 - ID</div>
                                            <div class="ticket-header-text" style="color: #1a73e8;"><strong>Section</strong><br>User Profile</div>
                                            <div class="ticket-header-text" style="color: #1a73e8;"><strong>Ticket Title</strong><br>User Profile Bugs</div>
                                        </div>

                                        <!-- Task Line -->
                                        <div class="ticket-task-line" style="margin-top: 1rem; display: flex; align-items: center;text-align:center; flex-wrap: wrap;justify-content:space-between; background-color: #fff; border-radius: 10px; padding: 6px; font-size: 12px; color: #333;font-size:12px;">

                                            <!-- Task Count -->
                                            <span class="ticket-item-text" style="margin-right: 5px; font-weight: bold; color: #28a745;">Tasks
                                                <p style="color: black;">5</p>
                                            </span>

                                            <!-- Divider -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Start Date -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #28a745;">Start:
                                                <p style="color: black;">22.10.2024</p>
                                            </span>

                                            <!-- Divider -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Delivery Date -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #28a745;">Deliver: <p style="color: black;">22.10.2024</p></span>

                                            <!-- Divider -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Overlapping Profile Avatars -->
                                            <div class="ticket-item-text" style="display: flex; align-items: center;">
                                                <img src="{{ asset('assets/spin-loader.gif') }}" alt="User" style="width: 19px; height: 19px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                                                <img src="{{ asset('assets/spin-loader.gif') }}" alt="User" style="width: 19px; height: 19px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                                                <img src="{{ asset('assets/spin-loader.gif') }}" alt="User" style="width: 19px; height: 19px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">

                                            </div>
                                        </div>


                                        <!-- Progress Bar -->
                                        <div class="d-flex justify-content-between align-items-center mt-1 mb-1" style="flex-wrap: nowrap; background:#fff;padding:5px;border-radius:10px;">
                                            <!-- Progress Bar + Percentage -->
                                            <div class="d-flex align-items-center" style="flex: 1;">
                                                <div class="d-flex align-items-center" style="flex: 1;">
                                                    <div class="progress" style="height: 8px; width: 100px; background-color: #e0e0e0; border-radius: 5px; overflow: hidden;">
                                                        <div class="progress-bar" role="progressbar" style="width: 0%; background-color: #4fc3f7;"></div>
                                                    </div>
                                                    <div style="font-size: 12px; color: #4fc3f7; margin-left: 7px;">0%</div>
                                                </div>
                                                <span style="margin-left: 8px; color: #ccc;">|</span>
                                            </div>
                                            <!-- Status Colors -->
                                            <div class="d-flex align-items-center ms-3" style="font-size: 11px; gap: 3px; margin-right:4px;">
                                                <span style="color: #8BC34A;">● 0</span>
                                                <span style="color: #FF9800;">● 0</span>
                                                <span style="color: #F44336;">● 0</span>
                                                <span style="color: #9C27B0;">● 0</span>
                                                <span style="color: #4CAF50;">● 0</span>
                                                <span style="margin-left: 12px; color: #ccc; margin-right:5px;">|</span>
                                                <span style="background-color: #e9f8dd; border-radius: 10; padding: 5px;">
                                                    <img src="{{ URL::asset('/build/img/greenflag.svg') }}" alt="alt" width="20px;">
                                                </span>
                                            </div>


                                        </div>
                                        <!-- tasks -->
                                    </div>
                                    
                                    </div> <!-- End Scrollable Content Container -->
                                </div>

                            </div>
                            <div class="col-12 col-sm-6 col-md-3 col-lg-3" data-ticket-status="new">
                                <div class="card shadow-sm p-1" style="border-radius: 20px; font-family: 'Segoe UI', sans-serif;">
                                    <!-- Top Section -->
                                    <div class="d-flex justify-content-between align-items-center mb-2" style="margin-top: 15px;">
                                        <div style="margin-left: 15px;">
                                            <div style="color: #2196F3; font-weight: 600; font-size: 16px;">New Ticket</div>
                                            <div style="font-size: 13px; color: #2196F3;">Total Tasks: <span id="new-ticket-count">0</span></div>
                                        </div>
                                        <div class="d-flex gap-2">
                                          
                                            <select name="type" id="new-ticket-project-filter" onchange="filterByProjectAndPriority()" required="required"
                    style="border: 1px solid #e5e7eb; border-radius: 8px; padding: 6px 12px; font-size: 13px; color: #333; width: 120px; background-color: white;">
                    <option value="" selected>All Projects</option>
                        @foreach ($projects as $project)
                        <option value="{{ $project->id }}">{{ $project->title }}</option>
                        @endforeach
                    
                </select>
                                        </div>
                                    </div>
                                    
                                    <!-- Scrollable Content Container -->
                                    <div class="ticket-card-container" id="new-tickets">
                                        <!-- Dynamic tickets will be loaded here -->
                                        <div class="text-center p-4" id="loading-new-tickets">
                                            <div class="spinner-border text-primary" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            <p class="mt-2 text-muted">Loading new tickets...</p>
                                        </div>
                                    </div> <!-- End Scrollable Content Container -->
                                </div>

                            </div>
                            <!-- 2 -->
                            {{-- <div class="col-12 col-sm-6 col-md-3 col-lg-3" data-ticket-status="hold">



                                        <!-- Progress Bar -->
                                        <div class="d-flex justify-content-between align-items-center mt-1 mb-1" style="flex-wrap: nowrap; background:#fff;padding:5px;border-radius:10px;">
                                            <!-- Progress Bar + Percentage -->
                                            <div class="d-flex align-items-center" style="flex: 1;">
                                                <div class="d-flex align-items-center" style="flex: 1;">
                                                    <div class="progress" style="height: 8px; width: 100px; background-color: #e0e0e0; border-radius: 5px; overflow: hidden;">
                                                        <div class="progress-bar" role="progressbar" style="width: 0%; background-color: #4fc3f7;"></div>
                                                    </div>
                                                    <div style="font-size: 12px; color: #4fc3f7; margin-left: 7px;">0%</div>
                                                </div>
                                                <span style="margin-left: 8px; color: #ccc;">|</span>
                                            </div>
                                            <!-- Status Colors -->
                                            <div class="d-flex align-items-center ms-3" style="font-size: 11px; gap: 3px; margin-right:4px;">
                                                <span style="color: #8BC34A;">● 0</span>
                                                <span style="color: #FF9800;">● 0</span>
                                                <span style="color: #F44336;">● 0</span>
                                                <span style="color: #9C27B0;">● 0</span>
                                                <span style="color: #4CAF50;">● 0</span>
                                                <span style="margin-left: 12px; color: #ccc; margin-right:5px;">|</span>
                                                <span style="background-color: #e9f8dd; border-radius: 10; padding: 5px;">
                                                    <img src="{{ URL::asset('/build/img/greenflag.svg') }}" alt="alt" width="20px;">
                                                </span>
                                            </div>


                                        </div>
                                        <!-- tasks -->
                                    </div>
                                    <!-- 3 -->
                                    <div class=" mt-2" style=" background-color: #f8f9fa; border-radius: 10px;padding:2px;font-size: 11px;">

                                        <!-- Header -->
                                        <div class="d-flex justify-content-between flex-wrap">
                                            <div class="ticket-header-text">
                                                <img src="{{ asset('build/img/yekbon.svg') }}" alt="yekbon" style="width: 25px; height: 35px;">
                                            </div>
                                            <div class="ticket-header-text" style="color: #1a73e8;"><strong>Tickets</strong><br>#1 - ID</div>
                                            <div class="ticket-header-text" style="color: #1a73e8;"><strong>Section</strong><br>User Profile</div>
                                            <div class="ticket-header-text" style="color: #1a73e8;"><strong>Ticket Title</strong><br>User Profile Bugs</div>
                                        </div>

                                        <!-- Task Line -->
                                        <div class="ticket-task-line" style="margin-top: 1rem; display: flex; align-items: center;text-align:center; flex-wrap: wrap;justify-content:space-between; background-color: #fff; border-radius: 10px; padding: 6px; font-size: 12px; color: #333;font-size:12px;">

                                            <!-- Task Count -->
                                            <span class="ticket-item-text" style="margin-right: 5px; font-weight: bold; color: #28a745;">Tasks
                                                <p style="color: black;">5</p>
                                            </span>

                                            <!-- Divider -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Start Date -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #28a745;">Start:
                                                <p style="color: black;">22.10.2024</p>
                                            </span>

                                            <!-- Divider -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Delivery Date -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #28a745;">Deliver: <p style="color: black;">22.10.2024</p></span>

                                            <!-- Divider -->
                                            <span class="ticket-item-text" style="margin-right: 5px; color: #ccc;">|</span>

                                            <!-- Overlapping Profile Avatars -->
                                            <div class="ticket-item-text" style="display: flex; align-items: center;">
                                                <img src="{{ asset('assets/spin-loader.gif') }}" alt="User" style="width: 19px; height: 19px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                                                <img src="{{ asset('assets/spin-loader.gif') }}" alt="User" style="width: 19px; height: 19px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                                                <img src="{{ asset('assets/spin-loader.gif') }}" alt="User" style="width: 19px; height: 19px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">

                                            </div>
                                        </div>


                                        <!-- Progress Bar -->
                                        <div class="d-flex justify-content-between align-items-center mt-1 mb-1" style="flex-wrap: nowrap; background:#fff;padding:5px;border-radius:10px;">
                                            <!-- Progress Bar + Percentage -->
                                            <div class="d-flex align-items-center" style="flex: 1;">
                                                <div class="d-flex align-items-center" style="flex: 1;">
                                                    <div class="progress" style="height: 8px; width: 100px; background-color: #e0e0e0; border-radius: 5px; overflow: hidden;">
                                                        <div class="progress-bar" role="progressbar" style="width: 0%; background-color: #4fc3f7;"></div>
                                                    </div>
                                                    <div style="font-size: 12px; color: #4fc3f7; margin-left: 7px;">0%</div>
                                                </div>
                                                <span style="margin-left: 8px; color: #ccc;">|</span>
                                            </div>
                                            <!-- Status Colors -->
                                            <div class="d-flex align-items-center ms-3" style="font-size: 11px; gap: 3px; margin-right:4px;">
                                                <span style="color: #8BC34A;">● 0</span>
                                                <span style="color: #FF9800;">● 0</span>
                                                <span style="color: #F44336;">● 0</span>
                                                <span style="color: #9C27B0;">● 0</span>
                                                <span style="color: #4CAF50;">● 0</span>
                                                <span style="margin-left: 12px; color: #ccc; margin-right:5px;">|</span>
                                                <span style="background-color: #e9f8dd; border-radius: 10; padding: 5px;">
                                                    <img src="{{ URL::asset('/build/img/greenflag.svg') }}" alt="alt" width="20px;">
                                                </span>
                                            </div>


                                        </div>
                                        <!-- tasks -->
                                    </div>
                                    
                                    </div> <!-- End Scrollable Content Container -->
                                </div>

                            </div> --}}
                        </div>
                    </div>

                    <style>
                        /* New Slider Design - Custom Flexbox Approach */
                        .tickets-slider-new {
                            position: relative;
                            width: 100%;
                            overflow: hidden;
                            padding: 20px 0;
                        }

                        .slider-container {
                            display: flex;
                            gap: 20px;
                            overflow-x: auto;
                            overflow-y: visible;
                            scroll-behavior: smooth;
                            scroll-snap-type: x mandatory; /* enable snapping to center */
                            /* Normal padding */
                            padding: 10px 20px;
                            /* Hide scrollbar but keep functionality */
                            scrollbar-width: none; /* Firefox */
                            -ms-overflow-style: none; /* IE/Edge */
                            will-change: scroll-position; /* hint for smoother horizontal scroll */
                            overscroll-behavior-inline: contain; /* prevent parent/page scroll on horizontal overscroll */
                        }
                        
                        /* Remove edge spacers to avoid empty gaps */
                        .slider-container::before,
                        .slider-container::after {
                            content: '';
                            flex-shrink: 0;
                            width: 0; /* no artificial spacing at edges */
                        }

                        .slider-container::-webkit-scrollbar {
                            display: none; /* Chrome/Safari/Opera */
                        }

                        .slider-container > * {
                            flex: 0 0 auto;
                            width: 320px; /* Fixed width for each card */
                            min-width: 320px;
                            scroll-snap-align: center; /* snap each card to center */
                            transition: transform 0.3s ease, opacity 0.3s ease, filter 0.3s ease;
                        }

                        /* Override Bootstrap column classes inside slider */
                        .slider-container > [class*="col-"] {
                            max-width: 320px !important;
                            width: 320px !important;
                            flex: 0 0 320px !important;
                        }

                        /* Card styling */
                        .slider-container .card {
                            opacity: 0.6;
                            filter: blur(2px);
                            transform: scale(0.95);
                            transition: all 0.4s ease;
                        }

                        .slider-container .card.is-active {
                            opacity: 1 !important;
                            filter: none !important;
                            transform: scale(1.05) !important;
                            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15) !important;
                            z-index: 10 !important;
                            position: relative;
                        }

                        /* Old slider styles */
                        .tickets-slider {
                            position: relative;
                        }

                        .tickets-slider.is-slider .row {
                            flex-wrap: nowrap !important;
                            overflow-x: auto;
                            scroll-behavior: smooth;
                            scroll-snap-type: x mandatory;
                            scroll-padding: 0 50%;
                        }

                        .tickets-slider.is-slider .row>* {
                            scroll-snap-align: center;
                        }

                        .tickets-slider .row {
                            perspective: 1100px;
                            transform-style: preserve-3d;
                        }

                        .tickets-slider.is-slider .row::-webkit-scrollbar {
                            display: none;
                        }

                        .tickets-slider .slider-arrow {
                            display: none !important;
                        }

                        .tickets-slider .slider-prev {
                            left: -12px;
                        }

                        .tickets-slider .slider-next {
                            right: -12px;
                        }

                        .tickets-slider.is-slider .slider-arrow {
                            display: none !important;
                        }

                        .tickets-slider.overlay .row {
                            position: relative;
                            overflow: hidden;
                            flex-wrap: nowrap !important;
                        }

                        .tickets-slider.overlay .row>* {
                            position: absolute;
                            top: 0;
                            left: 50%;
                            transform: translateX(-50%);
                            transition: left .45s cubic-bezier(.22, .61, .36, 1), opacity .35s ease, z-index .2s;
                        }

                        /* Overlay positional classes for container items */
                        .tickets-slider.overlay .pos-none {
                            left: 50%;
                            opacity: 0;
                            z-index: 0;
                            pointer-events: none;
                        }

                        .tickets-slider.overlay .pos-1 {
                            left: 20%;
                            opacity: 1;
                            z-index: 1;
                        }

                        .tickets-slider.overlay .pos-2 {
                            left: 35%;
                            opacity: 1;
                            z-index: 2;
                        }

                        .tickets-slider.overlay .pos-3 {
                            left: 50%;
                            opacity: 1;
                            z-index: 4;
                        }

                        .tickets-slider.overlay .pos-4 {
                            left: 65%;
                            opacity: 1;
                            z-index: 2;
                        }

                        .tickets-slider.overlay .pos-5 {
                            left: 80%;
                            opacity: 1;
                            z-index: 1;
                        }

                        /* Bloom/blur effect */
                        .tickets-slider .card {
                            position: relative;
                            transition: transform .45s cubic-bezier(.22, .61, .36, 1), filter .35s ease, opacity .35s ease, box-shadow .35s ease;
                            filter: blur(4px);
                            opacity: .6;
                            transform-origin: center center;
                            will-change: transform;
                            transform: translateX(var(--cf-shift, 0px)) translateZ(-140px) rotateY(0) scale(.94);
                        }

                        .tickets-slider .card.is-active {
                            filter: none !important;
                            opacity: 1 !important;
                            transform: translateX(var(--cf-shift, 0px)) translateZ(0) rotateY(0) scale(1.03) !important;
                            box-shadow: 0 12px 30px rgba(0, 0, 0, .14) !important;
                            z-index: 2 !important;
                        }

                        .tickets-slider .card::before {
                            content: "";
                            position: absolute;
                            inset: 0;
                            border-radius: 20px;
                            pointer-events: none;
                            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, .35);
                        }

                        .tickets-slider .card.is-active::before {
                            content: "";
                            position: absolute;
                            inset: -6px;
                            border-radius: 22px;
                            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.6), 0 0 40px rgba(79, 195, 247, 0.35);
                            pointer-events: none;
                        }

                        /* Coverflow states via relative position attribute */
                        .tickets-slider .card[data-pos="-3"],
                        .tickets-slider .card[data-pos="3"] {
                            opacity: .35;
                            filter: blur(3px);
                        }

                        .tickets-slider .card[data-pos="-3"] {
                            transform: translateX(calc(var(--cf-shift, 0px) - 220px)) rotateY(28deg) translateZ(-220px) scale(.82);
                            z-index: 0;
                        }

                        .tickets-slider .card[data-pos="-2"] {
                            transform: translateX(calc(var(--cf-shift, 0px) - 160px)) rotateY(24deg) translateZ(-170px) scale(.86);
                            z-index: 0;
                        }

                        .tickets-slider .card[data-pos="-1"] {
                            transform: translateX(calc(var(--cf-shift, 0px) - 100px)) rotateY(18deg) translateZ(-110px) scale(.9);
                            z-index: 1;
                        }

                        .tickets-slider .card[data-pos="1"] {
                            transform: translateX(calc(var(--cf-shift, 0px) + 100px)) rotateY(-18deg) translateZ(-110px) scale(.9);
                            z-index: 1;
                        }

                        .tickets-slider .card[data-pos="2"] {
                            transform: translateX(calc(var(--cf-shift, 0px) + 160px)) rotateY(-24deg) translateZ(-170px) scale(.86);
                            z-index: 0;
                        }

                        .tickets-slider .card[data-pos="3"] {
                            transform: translateX(calc(var(--cf-shift, 0px) + 220px)) rotateY(-28deg) translateZ(-220px) scale(.82);
                            z-index: 0;
                        }

                        @media (max-width: 576px) {
                            .tickets-slider .slider-prev {
                                left: 4px;
                            }

                            .tickets-slider .slider-next {
                                right: 4px;
                            }
                        }

                        /* Minimal slider (no blur) */

                        /* Status card hover and active states */
                        .status-card:hover {
                            transform: translateY(-2px);
                            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
                        }

                        .status-card.active {
                            background-color: #e3f2fd !important;
                            border: 2px solid #2196f3 !important;
                            transform: translateY(-2px);
                            box-shadow: 0 4px 12px rgba(33, 150, 243, 0.3) !important;
                        }
                        .tickets-slider-simple {
                            position: relative;
                        }

                        .tickets-slider-simple .row {
                            flex-wrap: nowrap !important;
                            overflow-x: auto;
                            scroll-behavior: smooth;
                            -ms-overflow-style: none;
                            scrollbar-width: none;
                        }

                        .tickets-slider-simple .row::-webkit-scrollbar {
                            display: none;
                        }

                        .tickets-slider-simple .slider-arrow {
                            display: none !important;
                        }

                        .tickets-slider-simple .slider-prev {
                            left: 4px;
                        }

                        .tickets-slider-simple .slider-next {
                            right: 4px;
                        }

                        .tickets-slider-simple.is-slider .slider-arrow {
                            display: none !important;
                        }

                        .tickets-slider-simple .slider-arrow[disabled] {
                            opacity: .4;
                            pointer-events: none;
                        }
                    </style>

                    <script>
                        (function() {
                            function initSlider(root) {
                                var row = root.querySelector('.row');
                                if (!row) return;
                                var items = Array.prototype.slice.call(row.children).filter(function(n) {
                                    return n && n.nodeType === 1;
                                });

                                // Always apply bloom/blur effect; slider arrows appear only if items > 3
                                var cards = items.map(function(el) {
                                    return el.querySelector('.card');
                                }).filter(Boolean);
                                var activeIndex = 0;

                                function applyCoverflow() {
                                    var maxSide = 3;
                                    var len = cards.length;
                                    if (!len) return;
                                    var half = len / 2;
                                    cards.forEach(function(card, i) {
                                        var raw = i - activeIndex;
                                        if (raw > half) raw -= len; // wrap right-to-left
                                        if (raw < -half) raw += len; // wrap left-to-right
                                        var offset = Math.max(-maxSide, Math.min(maxSide, raw));
                                        card.dataset.pos = String(offset);
                                        // Don't auto-set active class - let user clicks handle this
                                        card.setAttribute('aria-hidden', i === activeIndex ? 'false' : 'true');
                                    });
                                }

                                function setActive(index) {
                                    var len = cards.length;
                                    if (!len) return;
                                    // circular wrap
                                    index = ((index % len) + len) % len;
                                    activeIndex = index;
                                    applyCoverflow();
                                    centerOnActive();
                                }

                                function centerOnActive() {
                                    var target = items[activeIndex];
                                    if (!target) return;
                                    var rowWidth = row.clientWidth;
                                    var targetWidth = target.clientWidth;
                                    var targetLeft = target.offsetLeft;
                                    var overflows = row.scrollWidth > rowWidth + 1;

                                    if (overflows) {
                                        var desired = targetLeft - (rowWidth - targetWidth) / 2;
                                        var maxScroll = Math.max(0, row.scrollWidth - rowWidth);
                                        desired = Math.max(0, Math.min(desired, maxScroll));
                                        row.scrollTo({
                                            left: desired,
                                            behavior: 'smooth'
                                        });
                                        cards.forEach(function(c) {
                                            c.style.removeProperty('--cf-shift');
                                        });
                                    } else {
                                        var rowRect = row.getBoundingClientRect();
                                        var cardRect = target.getBoundingClientRect();
                                        var shift = -(cardRect.left - (rowRect.left + (rowRect.width - cardRect.width) / 2));
                                        cards.forEach(function(c) {
                                            c.style.setProperty('--cf-shift', shift + 'px');
                                        });
                                    }
                                }

                                // Don't auto-set active card on page load
                                // setActive(0);
                                // Don't auto-center on page load - let cards stay in their original positions

                                var shouldSlide = items.length > 3;
                                if (shouldSlide) {
                                    root.classList.add('is-slider');
                                } else {
                                    root.classList.remove('is-slider');
                                }

                                var prev = root.querySelector('.slider-prev');
                                var next = root.querySelector('.slider-next');
                                if (prev) prev.addEventListener('click', function() {
                                    setActive(activeIndex - 1);
                                    centerOnActive();
                                });
                                if (next) next.addEventListener('click', function() {
                                    setActive(activeIndex + 1);
                                    centerOnActive();
                                });

                                // Click to focus
                                row.addEventListener('click', function(e) {
                                    var card = e.target && e.target.closest('.card');
                                    if (!card) return;
                                    var idx = cards.indexOf(card);
                                    if (idx === -1) return;
                                    setActive(idx);
                                    centerOnActive();
                                });
                                // Keyboard navigation
                                root.setAttribute('tabindex', '0');
                                root.addEventListener('keydown', function(e) {
                                    if (e.key === 'ArrowLeft') {
                                        e.preventDefault();
                                        setActive(activeIndex - 1);
                                        centerOnActive();
                                    }
                                    if (e.key === 'ArrowRight') {
                                        e.preventDefault();
                                        setActive(activeIndex + 1);
                                        centerOnActive();
                                    }
                                });

                                // Wheel / trackpad navigation - DISABLED
                                // root.addEventListener('wheel', function(e) {
                                //     if (Math.abs(e.deltaX) > Math.abs(e.deltaY)) {
                                //         e.preventDefault();
                                //         if (e.deltaX > 0) {
                                //             setActive(activeIndex + 1);
                                //         } else {
                                //             setActive(activeIndex - 1);
                                //         }
                                //     } else {
                                //         e.preventDefault();
                                //         if (e.deltaY > 0) {
                                //             setActive(activeIndex + 1);
                                //         } else {
                                //             setActive(activeIndex - 1);
                                //         }
                                //     }
                                //     centerOnActive();
                                // }, {
                                //     passive: false
                                // });

                                // Don't auto-center on resize - only center when user clicks
                                window.addEventListener('load', function() {
                                    // Don't auto-center on load - just apply coverflow effect without active states
                                    applyCoverflow();
                                });
                            }
                            document.addEventListener('DOMContentLoaded', function() {
                                document.querySelectorAll('.tickets-slider').forEach(initSlider);
                                
                                // Don't auto-center on page load - let cards stay in their original positions
                            });
                        })();

                        // NEW APPROACH: Simple and Direct Centering Function
                        function centerSliderCard(status) {
                            const slider = document.getElementById('ticketsSlider1');
                            const container = slider.querySelector('.slider-container');
                            
                            if (!container) {
                                return;
                            }

                            // Find all card wrappers
                            const cardWrappers = Array.from(container.children);

                            // Find the target card wrapper
                            const targetWrapper = cardWrappers.find(wrapper => {
                                return wrapper.getAttribute('data-ticket-status') === status;
                            });

                            if (!targetWrapper) return;

                            // Reorder items using CSS 'order' so the selected card is visually centered
                            const getWrappers = () => Array.from(container.children);
                            function getStepWidth() {
                                const items = getWrappers();
                                if (items.length >= 2) {
                                    const step = items[1].offsetLeft - items[0].offsetLeft;
                                    return step > 0 ? step : items[0].offsetWidth;
                                }
                                return targetWrapper.offsetWidth;
                            }
                            function rotateUsingOrder(targetEl) {
                                const items = getWrappers();
                                const total = items.length;
                                if (!total) return;
                                const viewport = container.clientWidth;
                                const cardWidth = targetEl.offsetWidth;
                                const stepWidth = getStepWidth();
                                const sideSlots = Math.max(0, Math.floor((viewport - cardWidth) / (2 * stepWidth)));
                                const desiredIndex = Math.min(Math.max(sideSlots, 0), Math.max(total - 1, 0));
                                const idx = items.indexOf(targetEl);
                                items.forEach((el, i) => {
                                    const order = (i - idx + desiredIndex + total) % total;
                                    el.style.order = String(order);
                                });
                            }
                            rotateUsingOrder(targetWrapper);

                            // Remove active class from all cards
                            cardWrappers.forEach(wrapper => {
                                const card = wrapper.querySelector('.card');
                                if (card) card.classList.remove('is-active');
                            });

                            // Add active class to target card
                            const targetCardElement = targetWrapper.querySelector('.card');
                            if (targetCardElement) targetCardElement.classList.add('is-active');

                            // Manually center horizontally to avoid any vertical page scroll
                            {
                                const containerRect = container.getBoundingClientRect();
                                const targetRect = targetWrapper.getBoundingClientRect();
                                let left = container.scrollLeft
                                    + (targetRect.left - containerRect.left)
                                    + (targetRect.width / 2)
                                    - (container.clientWidth / 2);
                                const maxScroll = Math.max(0, container.scrollWidth - container.clientWidth);
                                if (left < 0) left = 0;
                                if (left > maxScroll) left = maxScroll;
                                container.scrollTo({ left, behavior: 'smooth' });
                            }

                            // Update status card active state
                            updateStatusCardActive(status);
                            
                            // No debug logs
                        }

                        // Function to update status card active state
                        function updateStatusCardActive(activeStatus) {
                            // Remove active class from all status cards
                            document.querySelectorAll('.status-card').forEach(card => {
                                card.classList.remove('active');
                            });

                            // Add active class to clicked status card
                            const activeCard = document.querySelector(`.status-card[data-status="${activeStatus}"]`);
                            if (activeCard) {
                                activeCard.classList.add('active');
                            }
                        }
                        
                        // Initialize default state on page load - NO AUTO CENTERING
                        document.addEventListener('DOMContentLoaded', function() {
                            setTimeout(() => {
                                // Set default active status card to "In Delayed"
                                updateStatusCardActive('delayed');
                                
                                // Make the delayed card active and center it
                                const slider = document.getElementById('ticketsSlider1');
                                if (slider) {
                                    const container = slider.querySelector('.slider-container');
                                    if (container) {
                                        // Find all card wrappers
                                        const cardWrappers = Array.from(container.children);
                                        
                                        // Find the delayed card wrapper
                                        const delayedWrapper = cardWrappers.find(wrapper => {
                                            return wrapper.getAttribute('data-ticket-status') === 'delayed';
                                        });
                                        
                                        if (delayedWrapper) {
                                            // Remove active class from all cards
                                            cardWrappers.forEach(wrapper => {
                                                const card = wrapper.querySelector('.card');
                                                if (card) card.classList.remove('is-active');
                                            });
                                            
                                            // Add active class to delayed card
                                            const delayedCard = delayedWrapper.querySelector('.card');
                                            if (delayedCard) {
                                                delayedCard.classList.add('is-active');
                                            }
                                            
                                            // Reorder items using CSS 'order' on load so delayed card is visually centered
                                            (function rotateUsingOrderOnLoad() {
                                                function getWrappers() { return Array.from(container.children); }
                                                function getStepWidth() {
                                                    const items = getWrappers();
                                                    if (items.length >= 2) {
                                                        const step = items[1].offsetLeft - items[0].offsetLeft;
                                                        return step > 0 ? step : items[0].offsetWidth;
                                                    }
                                                    return delayedWrapper.offsetWidth;
                                                }
                                                const items = getWrappers();
                                                const total = items.length;
                                                if (!total) return;
                                                const viewport = container.clientWidth;
                                                const cardWidth = delayedWrapper.offsetWidth;
                                                const stepWidth = getStepWidth();
                                                const sideSlots = Math.max(0, Math.floor((viewport - cardWidth) / (2 * stepWidth)));
                                                const desiredIndex = Math.min(Math.max(sideSlots, 0), Math.max(total - 1, 0));
                                                const idx = items.indexOf(delayedWrapper);
                                                items.forEach((el, i) => {
                                                    const order = (i - idx + desiredIndex + total) % total;
                                                    el.style.order = String(order);
                                                });
                                            })();

                                            // Center the delayed card horizontally without affecting page vertical scroll
                                            {
                                                const containerRect = container.getBoundingClientRect();
                                                const targetRect = delayedWrapper.getBoundingClientRect();
                                                let left = container.scrollLeft
                                                    + (targetRect.left - containerRect.left)
                                                    + (targetRect.width / 2)
                                                    - (container.clientWidth / 2);
                                                const maxScroll = Math.max(0, container.scrollWidth - container.clientWidth);
                                                if (left < 0) left = 0;
                                                if (left > maxScroll) left = maxScroll;
                                                container.scrollTo({ left, behavior: 'smooth' });
                                            }
                                        }
                                    }
                                }
                                
                                // Add test function to window for debugging
                                window.testCentering = function(status) {
                                    centerSliderCard(status);
                                };
                            }, 300);
                        });
                    </script>

                    <script>
                        (function() {
                            function initSimpleSlider(root) {
                                var row = root.querySelector('.row');
                                if (!row) return;
                                var items = Array.prototype.slice.call(row.children).filter(function(n) {
                                    return n && n.nodeType === 1;
                                });

                                // Activate minimal slider if more than 3 cards
                                var shouldSlide = items.length > 3;
                                if (shouldSlide) {
                                    root.classList.add('is-slider');
                                } else {
                                    root.classList.remove('is-slider');
                                }

                                function updateArrows() {
                                    var prev = root.querySelector('.slider-prev');
                                    var next = root.querySelector('.slider-next');
                                    if (!prev || !next) return;
                                    var maxScroll = Math.max(0, row.scrollWidth - row.clientWidth);
                                    var left = Math.round(row.scrollLeft);
                                    prev.disabled = left <= 0;
                                    next.disabled = left >= maxScroll;
                                }

                                function scrollByCards(direction) {
                                    // Scroll by one visible column width (includes gap)
                                    var sample = items[0];
                                    if (!sample) return;
                                    var style = window.getComputedStyle(sample);
                                    var marginLeft = parseFloat(style.marginLeft) || 0;
                                    var marginRight = parseFloat(style.marginRight) || 0;
                                    var delta = sample.getBoundingClientRect().width + marginLeft + marginRight;
                                    var target = row.scrollLeft + (direction > 0 ? delta : -delta);
                                    row.scrollTo({
                                        left: target,
                                        behavior: 'smooth'
                                    });
                                    setTimeout(updateArrows, 350);
                                }

                                var prev = root.querySelector('.slider-prev');
                                var next = root.querySelector('.slider-next');
                                if (prev) prev.addEventListener('click', function() {
                                    scrollByCards(-1);
                                });
                                if (next) next.addEventListener('click', function() {
                                    scrollByCards(1);
                                });

                                row.addEventListener('scroll', updateArrows, {
                                    passive: true
                                });
                                window.addEventListener('resize', updateArrows);
                                updateArrows();
                                // Ensure initial state after images/fonts load
                                window.addEventListener('load', updateArrows);
                            }

                            document.addEventListener('DOMContentLoaded', function() {
                                document.querySelectorAll('.tickets-slider-simple').forEach(initSimpleSlider);
                            });
                        })();
                    </script>

                    <!--  current task -->
                    <div class="project-succes pt-3 pb-3 d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">

                        <!-- Left Title -->
                        <div>
                            <h3 style="margin: 0;">Current Tasks</h3>
                            <strong>Task Overview</strong>
                        </div>

                        <!-- Filter + Dropdown -->
                        <div style="background: #f8fafc; padding: 6px 10px; border-radius: 8px;  padding-right: 310px ;display: flex; flex-wrap: wrap; gap: 10px; align-items: center;">

                            <!-- Filter Buttons -->
                            <div style="display: flex; gap: 10px; flex-wrap: wrap; flex: 1 1 auto;">
                                <button id="priority-all" onclick="setActivePriority(this, 'all')" style="background: #28c76f; color: white; border: none; padding: 6px 16px; border-radius: 6px; font-weight: 500; font-size: 14px; cursor: pointer;">All</button>
                                <button id="priority-low" onclick="setActivePriority(this, 'low')" style="background: transparent; color: #6c757d; border: none; padding: 6px 16px; border-radius: 6px; font-weight: 500; font-size: 14px; cursor: pointer;">Low</button>
                                <button id="priority-middle" onclick="setActivePriority(this, 'middle')" style="background: transparent; color: #6c757d; border: none; padding: 6px 16px; border-radius: 6px; font-weight: 500; font-size: 14px; cursor: pointer;">Middle</button>
                                <button id="priority-high" onclick="setActivePriority(this, 'high')" style="background: transparent; color: #6c757d; border: none; padding: 6px 16px; border-radius: 6px; font-weight: 500; font-size: 14px; cursor: pointer;">High</button>
                            </div>

                            <!-- Dropdown -->
                            <div style="flex-shrink: 0;">
                                <select id="project-filter" onchange="filterByProjectAndPriority()" style="font-size: 14px; padding: 6px 12px; border-radius: 6px; border: 1px solid #ddd; color: #6c757d; background-color: #f8f9fa; min-width: 140px;">
                                    <option value="" selected>All Projects</option>
                                    @foreach ($projects as $project)
                                    <option value="{{ $project->id }}">{{ $project->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Inline JS -->
                        <script>
                            // Global variables to track current filters
                            let currentPriority = 'all';
                            let currentProjectId = '';

                            function setActivePriority(el, priority) {
                                // Reset all priority buttons
                                const priorityButtons = document.querySelectorAll('[id^="priority-"]');
                                priorityButtons.forEach(btn => {
                                    btn.style.background = 'transparent';
                                    btn.style.color = '#6c757d';
                                });
                                
                                // Set active button
                                el.style.background = '#28c76f';
                                el.style.color = 'white';
                                
                                // Update current priority
                                currentPriority = priority;
                                
                                // Apply filters
                                filterByProjectAndPriority();
                            }

                            function filterByProjectAndPriority() {
                                // Get the project filter value from any of the dropdowns
                                const mainProjectFilter = document.getElementById('project-filter');
                                const inProgressFilter = document.getElementById('in-progress-project-filter');
                                const holdFilter = document.getElementById('hold-project-filter');
                                const delayedFilter = document.getElementById('delayed-project-filter');
                                const doneFilter = document.getElementById('done-project-filter');
                                const newTicketFilter = document.getElementById('new-ticket-project-filter');
                                
                                // Determine which filter was changed and get its value
                                let selectedProjectId = '';
                                if (mainProjectFilter) selectedProjectId = mainProjectFilter.value;
                                if (inProgressFilter && inProgressFilter.value) selectedProjectId = inProgressFilter.value;
                                if (holdFilter && holdFilter.value) selectedProjectId = holdFilter.value;
                                if (delayedFilter && delayedFilter.value) selectedProjectId = delayedFilter.value;
                                if (doneFilter && doneFilter.value) selectedProjectId = doneFilter.value;
                                if (newTicketFilter && newTicketFilter.value) selectedProjectId = newTicketFilter.value;
                                
                                // Sync all dropdowns to the selected value
                                syncAllProjectFilters(selectedProjectId);
                                
                                currentProjectId = selectedProjectId;
                                
                                // Apply filters to all ticket sections
                                filterTicketsByPriorityAndProject();
                            }

                            function filterTicketsByPriorityAndProject() {
                                // Get all project cards
                                const projectCards = document.querySelectorAll('.col-12.col-md-6.col-lg-4');
                                
                                projectCards.forEach(card => {
                                    let shouldShow = true;
                                    
                                    // Check project filter
                                    if (currentProjectId) {
                                        const projectId = card.querySelector('[data-project-id]')?.getAttribute('data-project-id');
                                        if (projectId !== currentProjectId) {
                                            shouldShow = false;
                                        }
                                    }
                                    
                                    // Check priority filter
                                    if (currentPriority !== 'all') {
                                        const priorityElement = card.querySelector('[style*="background-color: #4caf50"]');
                                        if (priorityElement) {
                                            const priorityText = priorityElement.nextElementSibling?.textContent?.toLowerCase();
                                            if (priorityText !== currentPriority) {
                                                shouldShow = false;
                                            }
                                        }
                                    }
                                    
                                    // Show/hide card
                                    card.style.display = shouldShow ? 'block' : 'none';
                                });
                            }

                            // Initialize with "All" selected
                            document.addEventListener('DOMContentLoaded', function() {
                                setActivePriority(document.getElementById('priority-all'), 'all');
                            });

                            // Helper function to build URL with filters
                            function buildFilteredUrl(baseUrl, status) {
                                let url = baseUrl;
                                const params = [];
                                
                                if (currentProjectId) {
                                    params.push(`project_id=${currentProjectId}`);
                                }
                                
                                if (currentPriority !== 'all') {
                                    params.push(`priority=${currentPriority}`);
                                }
                                
                                if (params.length > 0) {
                                    url += (url.includes('?') ? '&' : '?') + params.join('&');
                                }
                                
                                return url;
                            }

                            // Function to sync all project filter dropdowns
                            function syncAllProjectFilters(selectedValue) {
                                const allFilters = [
                                    'project-filter',
                                    'in-progress-project-filter', 
                                    'hold-project-filter',
                                    'delayed-project-filter',
                                    'done-project-filter',
                                    'new-ticket-project-filter'
                                ];
                                
                                allFilters.forEach(filterId => {
                                    const filter = document.getElementById(filterId);
                                    if (filter) {
                                        filter.value = selectedValue;
                                    }
                                });
                            }
                        </script>

                    </div>

                    <div class="mb-2">
                        <div class="row g-3">
                            @php
                            $ticketsByProject = ($tickets instanceof \Illuminate\Pagination\LengthAwarePaginator || $tickets instanceof \Illuminate\Pagination\Paginator)
                            ? $tickets->getCollection()->groupBy('project_id')
                            : collect($tickets)->groupBy('project_id');
                            @endphp

                            @foreach ($ticketsByProject as $projectId => $projectTickets)
                            @php $ticket = $projectTickets->first(); @endphp

                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="card shadow-sm p-1" style="border-radius: 20px; font-family: 'Segoe UI', sans-serif;">
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

                                            <!-- Dynamic Flag based on ticket status -->
                                            <div style="background-color: 
                                                @if($ticket->status == 'new_ticket') #e3f2fd
                                                @elseif($ticket->status == 'in_progress') #D1FAE5
                                                @elseif($ticket->status == 'in_hold') #fff3cd
                                                @elseif($ticket->status == 'in_delayed') #ffebee
                                                @elseif($ticket->status == 'in_done') #D1FAE5
                                                @else #D1FAE5
                                                @endif; border-radius: 6px; padding: 4px; display: flex; align-items: center; justify-content: center;">
                                                <img src="{{ URL::asset('/build/img/' . 
                                                    ($ticket->status == 'new_ticket' ? 'blueflag.svg' : 
                                                     ($ticket->status == 'in_progress' ? 'greenflag.svg' : 
                                                      ($ticket->status == 'in_hold' ? 'yelowflag.svg' : 
                                                       ($ticket->status == 'in_delayed' ? 'redflag.svg' : 
                                                        ($ticket->status == 'in_done' ? 'greenflag.svg' : 'greenflag.svg'))))) 
                                                ) }}" alt="Flag" width="35px" height="35px">
                                            </div>

                                            <!-- Logo (center) -->
                                            <div class="text-center" style="flex-grow: 1;">
                                                <div style=" display: flex; justify-content: center; height: 55px; width: 55px; margin: 0 auto;">
                                                    @if($ticket->project && $ticket->project->logo_path)
                                                        <img src="{{ asset('storage/' . $ticket->project->logo_path) }}" alt="Project Logo" style="height: 35px; width: 35px; object-fit: cover;">
                                                    @else
                                                        <img src="{{ URL::asset('/build/img/yekbon.svg') }}" alt="Project Logo" style="height: 35px; width: 35px; object-fit: cover;">
                                                    @endif
                                                </div>
                                                <div>
                                                    <h5 class="text-center" title="{{ $ticket->project->title }}" style="font-size: 12px !important; margin: 0 auto; font-weight: bold; color: #2e2e5d; max-width: 100%; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; display: block;">
                                                        {{ $ticket->project->title }}
                                                    </h5>
                                                </div>
                                            </div>

                                            <!-- Priority -->
                                            <div style="background: #ffffff; padding: 3px 8px; border-radius: 12px; display: flex; align-items: center; gap: 4px; margin-top: 2px;">
                                                <span style="width: 8px; height: 8px; background-color: #4caf50; border-radius: 50%;"></span>
                                                <span style="color: #4caf50; font-size: 12px; font-weight: 500;">Low</span>
                                            </div>

                                        </div>


                                        <!-- Ticket Icon -->
                                        <img src="{{ URL::asset('/build/img/ticket_icon_black.svg') }}"
                                            style="height: 32px; width: 32px; cursor: pointer;background:#F5F5F5;padding:3px;border-radius:5px;"
                                            alt="ticket"
                                            data-bs-toggle="modal"
                                            data-bs-target="#ticketModal"
                                            data-project-id="{{ $ticket->project_id }}"
                                            @if(!empty($ticket->section_name)) data-section-name="{{ $ticket->section_name }}" @endif>
                                    </div>
                                    <!-- Project Stats -->
                                    <div class="d-flex justify-content-between flex-wrap align-items-center px-2 mt-1"
                                        style="font-size: 13px; background-color: #f9f9f9; border-radius: 10px; gap: 3px; padding: 8px 10px;margin:7px;">
                                        <div style="color: #10b981;text-align:center"><strong>Tickets:</strong>
                                            <p style="color: black;text-align:center">{{ $projectTickets->count() }}</p>
                                        </div>
                                        <div style="height: 16px; width: 1px; background-color: #cbd5e1;"></div>
                                        <div style="color: #10b981;text-align:center"><strong>Tasks:</strong>
                                            <p> <img src="{{ asset('assets/spin-loader.gif') }}" style="width: 18px; height: 18px;" /></p>
                                        </div>
                                        <div style="height: 16px; width: 1px; background-color: #cbd5e1;"></div>
                                        <div style="color: #10b981;text-align:center"><strong>Begining:</strong>
                                            <p style="color: black;">{{ \Carbon\Carbon::parse($ticket->start_date)->format('Y-m-d') }}</p>
                                        </div>
                                        <div style="height: 16px; width: 1px; background-color: #cbd5e1;"></div>
                                        <div style="color: #10b981;text-align:center"><strong>End:</strong>
                                            <p style="color: black;"> {{ \Carbon\Carbon::parse($ticket->end_date)->format('Y-m-d') }} </p>
                                        </div>
                                    </div>

                                    <!-- Progress Bar -->
                                    <!-- <div class="d-flex align-items-center mb-2" style="flex: 1;">
                                            <div class="progress"
                                                style="height: 8px; width: 100px; background-color: #e0e0e0; border-radius: 5px; overflow: hidden;">
                                                <div class="progress-bar" role="progressbar"
                                                    style="width: 0%; background-color: #4fc3f7;"></div>
                                            </div>
                                            <div style="font-size: 12px; color: #4fc3f7; margin-left: 7px;">0%</div>
                                        </div> -->

                                    <!-- Title and Toggle -->
                                    <div class="d-flex justify-content-between align-items-center toggle-btn"
                                        style="cursor: pointer;">



                                        <div style="display: flex; align-items: center; width: 100%; margin: 8px 0;">
                                            <img src="{{ asset('build/img/up_arrow.svg') }}"
                                                alt="toggle-icon" width="18" height="18"
                                                style="margin-right: 6px; transition: transform 0.3s;"
                                                class="toggle-icon">
                                            <hr style="flex: 1; height: 2.5px; border: none; 
                                             background: linear-gradient(to right, #b0b7c3, #b0b7c3); 
                                               margin: 0;">
                                        </div>

                                    </div>

                                    <!-- Expandable Project Details -->
                                    <div class="project-details" style="display: block;">
                                        <!-- Description Row -->
                                        <!-- <div class="d-flex justify-content-between align-items-center px-2 py-1 mb-1"
                                            style="background-color: #f1f5f9; border-radius: 10px;">
                                            <div class="d-flex align-items-center gap-2" style="background: #ecfbdc;">
                                                <img src="{{ URL::asset('/build/img/flag.svg') }}" width="16" height="16" alt="flag">
                                            </div>
                                            <div>
                                                <small style="color: #64748b; font-size: 14px;">{{ $ticket->description }}</small>
                                            </div>
                                            <div class="d-flex align-items-center gap-1">
                                                <span style="width: 8px; height: 8px; background-color: #22c55e; border-radius: 50%; display: inline-block;"></span>
                                                <small style="font-size: 12px; color: #22c55e;">{{ $ticket->priority }}</small>
                                            </div>
                                        </div> -->



                                        <!-- Ticket Items -->
                                        @foreach ($projectTickets as $pt)
                                        <div class="mt-2" style="background-color: #f8f9fa; border-radius: 10px; padding: 2px; font-size: 13px;margin:7px;">
                                            <!-- Ticket Header -->
                                            <div class="d-flex justify-content-between flex-wrap">

                                                <div style="color: #1a73e8; margin-left: 8px;"><strong>Tickets</strong><br>{{ $pt->code }}</div>
                                                <div style="color: #1a73e8;"><strong>Section</strong><br>{{ $pt->section_name }}</div>
                                                <div style="color: #1a73e8;"><strong>Ticket Title</strong><br>{{ $pt->title }}</div>
                                                <div class="ticket-edit-trigger"
                                                    data-bs-toggle="modal" data-bs-target="#ticketModal"
                                                    data-ticket-id="{{ $pt->_id ?? $pt->id }}"
                                                    data-project-id="{{ $pt->project_id }}"
                                                    @if(!empty($pt->section_name)) data-section-name="{{ $pt->section_name }}" @endif
                                                    title="Edit ticket" style="cursor: pointer;">
                                                    <img src="{{ URL::asset('/build/img/pen.svg') }}" alt="Edit" width="20px;" height="20px"
                                                        data-bs-toggle="modal" data-bs-target="#ticketModal"
                                                        data-ticket-id="{{ $pt->_id ?? $pt->id }}"
                                                        data-project-id="{{ $pt->project_id }}"
                                                        @if(!empty($pt->section_name)) data-section-name="{{ $pt->section_name }}" @endif>
                                                </div>
                                            </div>

                                            <!-- Task Info -->
                                            <div style="margin-top: 1rem; display: flex; align-items: center;text-align:center; flex-wrap: wrap; justify-content:space-between; background-color: #fff; border-radius: 10px; padding: 6px; font-size: 14px; color: #333;margin: 7px;">
                                                <span style="margin-right: 5px; font-weight: bold;"> Tasks <p>
                                                        <img src="{{ asset('assets/spin-loader.gif') }}" style="width: 18px; height: 18px;" />
                                                    </p></span>
                                                <span style="margin-right: 5px; color: #ccc;">|</span>
                                                <span style="margin-right: 5px; color: #28a745;">Start:
                                                    <p style="color: black;">{{ \Carbon\Carbon::parse($pt->start_date)->format('Y-m-d') }}</p>
                                                </span>
                                                <span style="margin-right: 5px; color: #ccc;">|</span>
                                                <span style="margin-right: 5px; color: #28a745;">Deliver:
                                                    <p style="color: black;">{{ \Carbon\Carbon::parse($pt->end_date)->format('Y-m-d') }}</p>
                                                </span>
                                                <span style="margin-right: 5px; color: #ccc;">|</span>

                                                <!-- Avatars -->
                                                <div style="display: flex; align-items: center; margin-left: 10px;">
                                                    @for ($i = 0; $i < 3; $i++)
                                                        <img src="{{ asset('assets/spin-loader.gif') }}" style="width: 30px; height: 30px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;" alt="User">
                                                        @endfor
                                                </div>
                                            </div>


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
                                                        <span>0</span>
                                                        <span style="margin-left: 9px;">0</span>
                                                        <span style="margin-left: 9px;">0</span>
                                                        <span style="margin-left: 9px;">0</span>
                                                        <span style="margin-left: 9px;">0</span>
                                                    </div>
                                                </div>

                                                <!-- Separator -->
                                                <div style="color: #ccc;">|</div>

                                                <!-- Right Side Flag -->
                                                <div style="background-color: 
                                                    @if($pt->status == 'new_ticket') #e3f2fd
                                                    @elseif($pt->status == 'in_progress') #e9f8dd
                                                    @elseif($pt->status == 'in_hold') #fff3cd
                                                    @elseif($pt->status == 'in_delayed') #ffebee
                                                    @elseif($pt->status == 'in_done') #e9f8dd
                                                    @else #e9f8dd
                                                    @endif; border-radius: 2px; padding: 6px;margin-right:27px">
                                                    <img src="{{ URL::asset('/build/img/' . 
                                                        ($pt->status == 'new_ticket' ? 'blueflag.svg' : 
                                                         ($pt->status == 'in_progress' ? 'greenflag.svg' : 
                                                          ($pt->status == 'in_hold' ? 'yelowflag.svg' : 
                                                           ($pt->status == 'in_delayed' ? 'redflag.svg' : 
                                                            ($pt->status == 'in_done' ? 'greenflag.svg' : 'greenflag.svg'))))) 
                                                    ) }}" alt="flag" width="24px" height="24px;">
                                                </div>


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
                                    </div>
                                    @endforeach
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

</div>
</div>


</div>





<!-- Modal -->
<div class="modal fade" id="ticketModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content" style="border-radius: 12px; background-color: white;">

            <div class="modal-body p-4">
                <h5 id="ticketModalTitle" style="font-weight: bold;">Create new Ticket</h5>
                <p id="ticketModalSubtitle" style="color: #888;">Create a Ticket</p>

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
                    <div class="row  g-2">
                        <!-- Start Date -->
                        <div class="col-md-4" id="startDateFieldWrapper" style="position: relative;">
                            <div style="background-color: #fff; border-radius: 12px; padding: 2px 16px;  border: 1px solid #e0e0e0;  display: flex; flex-direction: column; justify-content: center;">
                                <div style="font-weight: 600; font-size: 14px; color: #7d7f85;margin-right:30px;">Start Date</div>
                                <div id="startDateDisplay" style="font-size: 13px; color: #a0a4ab;margin-right:32px;">DD:MM:YYYY</div>
                                <div style="position: absolute; top: 50%; right: 16px; transform: translateY(-50%);">
                                    <img src="{{ URL::asset('/build/img/timeicon.svg') }}"
                                        onclick="document.getElementById('startDateInput').showPicker()"
                                        style="width: 20px; height: 20px; cursor: pointer;" />
                                    <input type="date" id="startDateInput" min="{{ date('Y-m-d') }}"
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
                                    <input type="date" id="expiredDateInput" min="{{ date('Y-m-d') }}"
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
                                <button type="button" class="btn" data-reminder="6" style="background-color: #00C853; color: white; white-space: nowrap;">6&nbsp;Hr</button>
                                <button type="button" class="btn" data-reminder="12" style="background-color: #f0f0f0; white-space: nowrap;">12&nbsp;Hr</button>
                                <button type="button" class="btn" data-reminder="24" style="background-color: #f0f0f0; white-space: nowrap;">24&nbsp;Hr</button>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Buttons -->
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <button id="saveCloseTicketBtn" class="btn" style="background-color: #00C853; color: white; min-width: 160px;margin-bottom:3px;">Save and Close</button>
                    <button id="saveAddAnotherTicketBtn" class="btn" style="background-color: #E87326; color: white; min-width: 160px;">Save & add Ticket</button>
                    <button id="updateTicketBtn" class="btn" style="background-color: #00C853; color: white; min-width: 160px;margin-bottom:3px;">Update and Close</button>
                    <button id="removeTicketBtn" class="btn btn-danger" style="min-width: 160px;margin-bottom:3px;">Remove Ticket</button>
                </div>


            </div>
        </div>
    </div>
</div>

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
    document.addEventListener('DOMContentLoaded', function() {
        const projectSelect = document.getElementById('ticketProjectSelect');
        const sectionSelect = document.getElementById('ticketSectionSelect');


        const priorityHidden = document.getElementById('ticketPriority');
        const reminderHidden = document.getElementById('ticketReminderHours');

        const saveCloseBtn = document.getElementById('saveCloseTicketBtn');
        const saveAddAnotherBtn = document.getElementById('saveAddAnotherTicketBtn');
        const updateBtn = document.getElementById('updateTicketBtn');
        const modalTitle = document.getElementById('ticketModalTitle');
        const modalSubtitle = document.getElementById('ticketModalSubtitle');
        let editingTicketId = null;

        // Helper to set active button style for grouped buttons (generic, used for reminders)
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

        // Priority-specific styling: Low (green), Medium (orange), High (red)
        function setPriorityStyles() {
            const buttons = document.querySelectorAll('[data-priority]');
            buttons.forEach(btn => {
                const level = btn.getAttribute('data-priority');
                const isActive = (priorityHidden.value === level);
                if (isActive) {
                    if (level === 'low') {
                        btn.style.backgroundColor = '#00C853';
                        btn.style.color = 'white';
                    } else if (level === 'medium') {
                        btn.style.backgroundColor = '#F5A623';
                        btn.style.color = 'white';
                    } else if (level === 'high') {
                        btn.style.backgroundColor = '#ED1C24';
                        btn.style.color = 'white';
                    }
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
                setPriorityStyles();
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
        async function loadProjects(prefill) {
            try {
                const resp = await fetch('/tickets/projects', {
                    credentials: 'same-origin'
                });
                const data = await resp.json();
                projectSelect.innerHTML = '<option value="">Select the Project</option>' +
                    data.map(p => `<option value="${p.id}">${p.title ?? 'Untitled'}</option>`).join('');
                if (prefill?.projectId) {
                    projectSelect.value = prefill.projectId;
                    await loadSections(prefill.projectId);
                    if (prefill.sectionName) {
                        sectionSelect.value = prefill.sectionName;
                    }
                }
            } catch (e) {
                console.error('Failed to load projects', e);
            }
        }

        // Fetch sections when project changes
        async function loadSections(projectId) {
            sectionSelect.innerHTML = '<option value="">Select the Section</option>';
            if (!projectId) return;
            try {
                const resp = await fetch(`/tickets/projects/${projectId}/sections`, {
                    credentials: 'same-origin'
                });
                const data = await resp.json();
                sectionSelect.innerHTML = '<option value="">Select the Section</option>' +
                    (Array.isArray(data) ? data.map(s => `<option value="${s.name}">${s.name}</option>`).join('') : '');
            } catch (e) {
                console.error('Failed to load sections', e);
            }
        }

        projectSelect?.addEventListener('change', function() {
            loadSections(this.value);
            try {
                localStorage.setItem('ticket.lastProjectId', this.value || '');
            } catch (e) {}
        });



        // Submit ticket helper
        async function submitTicket(closeAfter) {
            const payload = {
                project_id: projectSelect.value || '',
                section_name: sectionSelect.value || '',
                title: document.getElementById('ticketTitle')?.value || '',
                description: document.getElementById('ticketDescription')?.value || '',
                status: 'new_ticket',
                priority: priorityHidden.value || 'low',
                start_date: document.getElementById('startDateInput')?.value || null,
                end_date: document.getElementById('expiredDateInput')?.value || null,
                reminder_hours: parseInt(reminderHidden.value || '6', 10),
            };

            try {
                // Prevent double submit
                saveCloseBtn?.setAttribute('disabled', 'disabled');
                saveAddAnotherBtn?.setAttribute('disabled', 'disabled');
                const resp = await fetch('/tickets', {
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
                        // Inline success alert inside modal (not closing)
                        const modalBody = document.querySelector('#ticketModal .modal-body');
                        if (modalBody) {
                            const old = modalBody.querySelector('.ticket-success-banner');
                            if (old) old.remove();
                            const banner = document.createElement('div');
                            banner.className = 'alert alert-success alert-dismissible fade show ticket-success-banner';
                            banner.style.borderRadius = '8px';
                            banner.role = 'alert';
                            banner.innerHTML = 'Ticket created successfully.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                            modalBody.prepend(banner);
                            setTimeout(() => {
                                try {
                                    banner.classList.remove('show');
                                    banner.remove();
                                } catch (e) {}
                            }, 3000);
                        }
                        // Keep project/section for quick multi-ticket creation
                        try {
                            if (projectSelect.value) {
                                localStorage.setItem('ticket.lastProjectId', projectSelect.value);
                            }
                            if (sectionSelect.value) {
                                localStorage.setItem('ticket.lastSectionName', sectionSelect.value);
                            }
                        } catch (e) {}
                        // Reset only mutable fields for new ticket
                        const titleEl = document.getElementById('ticketTitle');
                        const descEl = document.getElementById('ticketDescription');
                        if (titleEl) titleEl.value = '';
                        if (descEl) descEl.value = '';
                        const sd = document.getElementById('startDateInput');
                        const ed = document.getElementById('expiredDateInput');
                        const sdDisp = document.getElementById('startDateDisplay');
                        const edDisp = document.getElementById('expiredDateDisplay');
                        if (sd) sd.value = '';
                        if (ed) ed.value = '';
                        if (sdDisp) sdDisp.innerText = 'DD:MM:YYYY';
                        if (edDisp) edDisp.innerText = 'DD:MM:YYYY';
                        // Reset priority and reminder to defaults and styles
                        priorityHidden.value = 'low';
                        reminderHidden.value = '6';
                        setPriorityStyles();
                        setActive('[data-reminder]', 'data-reminder', reminderHidden.value);
                        // Focus first field
                        titleEl?.focus();
                    }
                    // Reset minimal fields
                    // (already reset above when staying open)
                } else {
                    const err = await resp.json();
                    alert(err?.message || 'Failed to create ticket');
                }
            } catch (e) {
                console.error('Failed to create ticket', e);
            } finally {
                saveCloseBtn?.removeAttribute('disabled');
                saveAddAnotherBtn?.removeAttribute('disabled');
            }
        }

        // Update ticket helper
        async function updateTicket() {
            if (!editingTicketId) return;
            const payload = {
                project_id: projectSelect.value || '',
                section_name: sectionSelect.value || '',
                title: document.getElementById('ticketTitle')?.value || '',
                description: document.getElementById('ticketDescription')?.value || '',
                status: 'new_ticket',
                priority: priorityHidden.value || 'low',
                start_date: document.getElementById('startDateInput')?.value || null,
                end_date: document.getElementById('expiredDateInput')?.value || null,
                reminder_hours: parseInt(reminderHidden.value || '6', 10),
            };

            try {
                updateBtn?.setAttribute('disabled', 'disabled');
                const resp = await fetch(`/tickets/${editingTicketId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                    },
                    credentials: 'same-origin',
                    body: JSON.stringify(payload)
                });
                if (resp.ok) {
                    const modalEl = document.getElementById('ticketModal');
                    const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
                    modal.hide();
                    window.location.reload();
                } else {
                    let errMsg = 'Failed to update ticket';
                    try {
                        const err = await resp.json();
                        errMsg = err?.message || errMsg;
                    } catch (_) {}
                    alert(errMsg);
                }
            } catch (e) {
                console.error('Failed to update ticket', e);
            } finally {
                updateBtn?.removeAttribute('disabled');
            }
        }

        saveCloseBtn?.addEventListener('click', function(e) {
            e.preventDefault();
            submitTicket(true);
        });
        saveAddAnotherBtn?.addEventListener('click', function(e) {
            e.preventDefault();
            submitTicket(false);
        });

        // Modal prefill on open from a ticket card or last used
        const ticketModalEl = document.getElementById('ticketModal');
        if (ticketModalEl) {
            ticketModalEl.addEventListener('show.bs.modal', function(event) {
                // Accept triggers on child nodes and climb to wrapper if needed
                let trigger = event.relatedTarget;
                if (trigger && !trigger.getAttribute('data-ticket-id')) {
                    const wrapper = trigger.closest?.('.ticket-edit-trigger');
                    if (wrapper) trigger = wrapper;
                }
                let prefill = {};
                if (trigger) {
                    const trigProjectId = trigger.getAttribute('data-project-id');
                    const trigSectionName = trigger.getAttribute('data-section-name');
                    const trigTicketId = trigger.getAttribute('data-ticket-id');
                    if (trigProjectId) prefill.projectId = trigProjectId;
                    if (trigSectionName) prefill.sectionName = trigSectionName;
                    if (trigTicketId) editingTicketId = trigTicketId;
                }
                // Reset UI mode by default to create
                modalTitle.textContent = editingTicketId ? 'Edit Ticket' : 'Create new Ticket';
                modalSubtitle.textContent = editingTicketId ? 'Update this ticket' : 'Create a Ticket';
                updateBtn.style.display = editingTicketId ? 'inline-block' : 'none';
                saveCloseBtn.style.display = editingTicketId ? 'none' : 'inline-block';
                saveAddAnotherBtn.style.display = editingTicketId ? 'none' : 'inline-block';

                // Show/hide remove button only when editing
                const removeBtn = document.getElementById('removeTicketBtn');
                if (removeBtn) {
                    removeBtn.style.display = editingTicketId ? 'inline-block' : 'none';
                }
                if (!prefill.projectId) {
                    try {
                        const lastPid = localStorage.getItem('ticket.lastProjectId');
                        if (lastPid) prefill.projectId = lastPid;
                    } catch (e) {}
                }
                if (!prefill.sectionName) {
                    try {
                        const lastSec = localStorage.getItem('ticket.lastSectionName');
                        if (lastSec) prefill.sectionName = lastSec;
                    } catch (e) {}
                }
                // If editing, load the ticket and prefill all fields
                if (editingTicketId) {
                    (async () => {
                        try {
                            const resp = await fetch(`/tickets/${editingTicketId}`, {
                                credentials: 'same-origin'
                            });
                            const t = await resp.json();
                            await loadProjects({
                                projectId: t.project_id,
                                sectionName: t.section_name
                            });
                            document.getElementById('ticketTitle').value = t.title || '';
                            document.getElementById('ticketDescription').value = t.description || '';
                            priorityHidden.value = t.priority || 'low';
                            setPriorityStyles();
                            reminderHidden.value = String(t.reminder_hours ?? '6');
                            setActive('[data-reminder]', 'data-reminder', reminderHidden.value);
                            const sd = document.getElementById('startDateInput');
                            const ed = document.getElementById('expiredDateInput');
                            const sdDisp = document.getElementById('startDateDisplay');
                            const edDisp = document.getElementById('expiredDateDisplay');
                            if (sd) {
                                sd.value = t.start_date || '';
                                sdDisp.innerText = t.start_date ? t.start_date.split('-').reverse().join(':') : 'DD:MM:YYYY';
                            }
                            if (ed) {
                                ed.value = t.end_date || '';
                                edDisp.innerText = t.end_date ? t.end_date.split('-').reverse().join(':') : 'DD:MM:YYYY';
                            }
                        } catch (e) {
                            try {
                                const txt = await (e?.response?.text?.() || Promise.resolve(''));
                                console.error('Failed to prefill ticket', e, txt);
                            } catch (_) {
                                console.error('Failed to prefill ticket', e);
                            }
                        }
                    })();
                } else {
                    loadProjects(prefill);
                }
            });

            ticketModalEl.addEventListener('hidden.bs.modal', function() {
                // Reset mode back to create defaults
                editingTicketId = null;
                modalTitle.textContent = 'Create new Ticket';
                modalSubtitle.textContent = 'Create a Ticket';
                updateBtn.style.display = 'none';
                saveCloseBtn.style.display = 'inline-block';
                saveAddAnotherBtn.style.display = 'inline-block';
                // Clear fields
                const titleEl = document.getElementById('ticketTitle');
                const descEl = document.getElementById('ticketDescription');
                if (titleEl) titleEl.value = '';
                if (descEl) descEl.value = '';
                const sd = document.getElementById('startDateInput');
                const ed = document.getElementById('expiredDateInput');
                const sdDisp = document.getElementById('startDateDisplay');
                const edDisp = document.getElementById('expiredDateDisplay');
                if (sd) sd.value = '';
                if (ed) ed.value = '';
                if (sdDisp) sdDisp.innerText = 'DD:MM:YYYY';
                if (edDisp) edDisp.innerText = 'DD:MM:YYYY';
            });
        }

        // Initial load (no prefill if modal not opened yet)
        loadProjects();
        // Initialize priority visual styles on first paint
        setPriorityStyles();

        // Delegate edit clicks
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.ticket-edit-trigger');
            if (btn) {
                const id = btn.getAttribute('data-ticket-id');
                if (!id) return;
                const modalEl = document.getElementById('ticketModal');
                if (!modalEl) return;
                editingTicketId = id;
                const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
                modal.show(btn);
            }
        });

        updateBtn?.addEventListener('click', function(e) {
            e.preventDefault();
            updateTicket();
        });

        // Remove ticket functionality with SweetAlert confirmation
        const removeBtn = document.getElementById('removeTicketBtn');
        removeBtn?.addEventListener('click', function(e) {
            e.preventDefault();

            if (!editingTicketId) {
                Swal.fire('Error', 'No ticket selected for deletion', 'error');
                return;
            }

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this action!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    try {
                        removeBtn.setAttribute('disabled', 'disabled');
                        removeBtn.textContent = 'Deleting...';

                        const resp = await fetch(`/tickets/${editingTicketId}`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                            },
                            credentials: 'same-origin'
                        });

                        if (resp.ok) {
                            Swal.fire(
                                'Deleted!',
                                'Ticket has been deleted successfully.',
                                'success'
                            ).then(() => {
                                const modalEl = document.getElementById('ticketModal');
                                const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
                                modal.hide();
                                window.location.reload();
                            });
                        } else {
                            let errMsg = 'Failed to delete ticket';
                            try {
                                const err = await resp.json();
                                errMsg = err?.message || errMsg;
                            } catch (_) {}

                            Swal.fire('Error', errMsg, 'error');
                        }
                    } catch (e) {
                        console.error('Failed to delete ticket', e);
                        Swal.fire('Error', 'An error occurred while deleting the ticket', 'error');
                    } finally {
                        removeBtn.removeAttribute('disabled');
                        removeBtn.textContent = 'Remove Ticket';
                    }
                }
            });
        });
    });

    // Function to load dashboard statistics
    async function loadDashboardStats() {
        try {
            const response = await fetch('/tickets/dashboard-stats', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                credentials: 'same-origin'
            });

            if (response.ok) {
                const stats = await response.json();
                
                // Update overview section
                const totalTicketsCount = document.getElementById('total-tickets-count');
                if (totalTicketsCount) {
                    totalTicketsCount.textContent = stats.total_tickets;
                }

                // Update dashboard cards
                const totalTicketsCard = document.getElementById('total-tickets-card');
                if (totalTicketsCard) {
                    totalTicketsCard.textContent = stats.total_tickets;
                }

                const totalTicketsPercentage = document.getElementById('total-tickets-percentage');
                if (totalTicketsPercentage) {
                    totalTicketsPercentage.textContent = stats.percentages.total;
                }

                const inProgressCard = document.getElementById('in-progress-card');
                if (inProgressCard) {
                    inProgressCard.textContent = stats.in_progress;
                }

                const inProgressPercentage = document.getElementById('in-progress-percentage');
                if (inProgressPercentage) {
                    inProgressPercentage.textContent = stats.percentages.in_progress;
                }

                const inHoldCard = document.getElementById('in-hold-card');
                if (inHoldCard) {
                    inHoldCard.textContent = stats.in_hold;
                }

                const inHoldPercentage = document.getElementById('in-hold-percentage');
                if (inHoldPercentage) {
                    inHoldPercentage.textContent = Math.abs(stats.percentages.in_hold);
                }

                const inDelayedCard = document.getElementById('in-delayed-card');
                if (inDelayedCard) {
                    inDelayedCard.textContent = stats.in_delayed;
                }

                const inDelayedPercentage = document.getElementById('in-delayed-percentage');
                if (inDelayedPercentage) {
                    inDelayedPercentage.textContent = Math.abs(stats.percentages.in_delayed);
                }

                // Update status card counts
                const newTicketStatusCount = document.getElementById('new-ticket-status-count');
                if (newTicketStatusCount) {
                    newTicketStatusCount.textContent = stats.new_ticket || 0;
                }

                const inProgressStatusCount = document.getElementById('in-progress-status-count');
                if (inProgressStatusCount) {
                    inProgressStatusCount.textContent = stats.in_progress || 0;
                }

                const inHoldStatusCount = document.getElementById('in-hold-status-count');
                if (inHoldStatusCount) {
                    inHoldStatusCount.textContent = stats.in_hold || 0;
                }

                const inDelayedStatusCount = document.getElementById('in-delayed-status-count');
                if (inDelayedStatusCount) {
                    inDelayedStatusCount.textContent = stats.in_delayed || 0;
                }

                const inDoneStatusCount = document.getElementById('in-done-status-count');
                if (inDoneStatusCount) {
                    inDoneStatusCount.textContent = stats.in_done || 0;
                }
            }
        } catch (error) {
            console.error('Error loading dashboard stats:', error);
        }
    }

    // Function to load in-progress tickets dynamically
    async function loadInProgressTickets(projectId = '') {
        const refreshBtn = document.querySelector('button[onclick="loadInProgressTickets()"]');
        const originalContent = refreshBtn ? refreshBtn.innerHTML : '';
        
        try {
            // Show loading state on refresh button
            if (refreshBtn) {
                refreshBtn.disabled = true;
                refreshBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            }

            const url = buildFilteredUrl('/tickets/by-status?status=in_progress', 'in_progress');
            const response = await fetch(url, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                credentials: 'same-origin'
            });

            if (response.ok) {
                const data = await response.json();
                const tickets = data.tickets;
                const count = data.count;
                
                // Update the count
                const countElement = document.getElementById('in-progress-count');
                if (countElement) {
                    countElement.textContent = count;
                }

                // Clear loading and populate tickets
                const container = document.getElementById('in-progress-tickets');
                if (container) {
                    container.innerHTML = '';
                    
                    if (tickets.length === 0) {
                        container.innerHTML = `
                            <div class="text-center p-4">
                                <p class="text-muted">No tickets in progress</p>
                            </div>
                        `;
                        return;
                    }

                    tickets.forEach(ticket => {
                        const ticketHtml = createTicketCard(ticket);
                        container.insertAdjacentHTML('beforeend', ticketHtml);
                    });
                }
            } else {
                console.error('Failed to load tickets');
                const container = document.getElementById('in-progress-tickets');
                if (container) {
                    container.innerHTML = `
                        <div class="text-center p-4">
                            <p class="text-danger">Failed to load tickets</p>
                        </div>
                    `;
                }
            }
        } catch (error) {
            console.error('Error loading tickets:', error);
            const container = document.getElementById('in-progress-tickets');
            if (container) {
                container.innerHTML = `
                    <div class="text-center p-4">
                        <p class="text-danger">Error loading tickets</p>
                    </div>
                `;
            }
        } finally {
            // Restore refresh button
            if (refreshBtn) {
                refreshBtn.disabled = false;
                refreshBtn.innerHTML = originalContent;
            }
        }
    }

    // Function to create ticket card HTML
    function createTicketCard(ticket) {
        const startDate = ticket.start_date || 'N/A';
        const endDate = ticket.end_date || 'N/A';
        const assigneesCount = ticket.assignees ? ticket.assignees.length : 0;
        
        // Calculate progress percentage (you can modify this logic based on your needs)
        const progressPercentage = 0; // Default for now, you can calculate based on actual progress
        
        return `
            <div class="mt-2" style="background-color: #f8f9fa; border-radius: 10px; padding: 2px; font-size: 11px;">
                <!-- Header -->
                <div class="d-flex justify-content-between flex-wrap">
                    <div class="ticket-header-text">
                        ${ticket.project_logo_path ? 
                            `<img src="/storage/${ticket.project_logo_path}" alt="Project Logo" style="width: 35px; height: 35px;">` : 
                            `<img src="{{ asset('build/img/yekbon.svg') }}" alt="Project Logo" style="width: 35px; height: 35px;">`
                        }
                    </div>
                    <div class="ticket-header-text" style="color: #1a73e8;">
                        <strong>Tickets</strong><br>${ticket.code}
                    </div>
                    <div class="ticket-header-text" style="color: #1a73e8;">
                        <strong>Section</strong><br>${ticket.section_name || 'N/A'}
                    </div>
                    <div class="ticket-header-text" style="color: #1a73e8;">
                        <strong>Ticket Title</strong><br>${ticket.title}
                    </div>
                </div>

                <!-- Task Line -->
                <div class="ticket-task-line" style="margin-top: 1rem; display: flex; align-items: center; text-align: center; flex-wrap: wrap; justify-content: space-between; background-color: #fff; border-radius: 10px; padding: 6px; font-size: 12px; color: #333;">
                    <!-- Task Count -->
                    <span class="ticket-item-text" style="margin-right: 5px; font-weight: bold; color: #28a745;">
                        Tasks
                        <p style="color: black;">${assigneesCount}</p>
                    </span>

                    <!-- Divider -->
                    <span class="ticket-item-text" style="margin-right: 5px; color: #ccc;">|</span>

                    <!-- Start Date -->
                    <span class="ticket-item-text" style="margin-right: 5px; color: #28a745;">
                        Start:
                        <p style="color: black;">${startDate}</p>
                    </span>

                    <!-- Divider -->
                    <span class="ticket-item-text" style="margin-right: 5px; color: #ccc;">|</span>

                    <!-- Delivery Date -->
                    <span class="ticket-item-text" style="margin-right: 5px; color: #28a745;">
                        Deliver: 
                        <p style="color: black;">${endDate}</p>
                    </span>

                    <!-- Divider -->
                    <span class="ticket-item-text" style="margin-right: 5px; color: #ccc;">|</span>

                    <!-- Overlapping Profile Avatars -->
                    <div class="ticket-item-text" style="display: flex; align-items: center;">
                        <img src="{{ asset('assets/spin-loader.gif') }}" alt="User" style="width: 19px; height: 19px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                        <img src="{{ asset('assets/spin-loader.gif') }}" alt="User" style="width: 19px; height: 19px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                        <img src="{{ asset('assets/spin-loader.gif') }}" alt="User" style="width: 19px; height: 19px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                    </div>
                </div>

                <!-- Progress Bar -->
                <div class="d-flex justify-content-between align-items-center mt-1 mb-1" style="flex-wrap: nowrap; background: #fff; padding: 5px; border-radius: 10px;">
                    <!-- Progress Bar + Percentage -->
                    <div class="d-flex align-items-center" style="flex: 1;">
                        <div class="d-flex align-items-center" style="flex: 1;">
                            <div class="progress" style="height: 8px; width: 100px; background-color: #e0e0e0; border-radius: 5px; overflow: hidden;">
                                <div class="progress-bar" role="progressbar" style="width: ${progressPercentage}%; background-color: #4fc3f7;"></div>
                            </div>
                            <div style="font-size: 12px; color: #4fc3f7; margin-left: 7px;">${progressPercentage}%</div>
                        </div>
                        <span style="margin-left: 8px; color: #ccc;">|</span>
                    </div>
                    <!-- Status Colors -->
                    <div class="d-flex align-items-center ms-3" style="font-size: 11px; gap: 3px; margin-right: 4px;">
                        <span style="color: #8BC34A;">● 0</span>
                        <span style="color: #FF9800;">● 0</span>
                        <span style="color: #F44336;">● 0</span>
                        <span style="color: #9C27B0;">● 0</span>
                        <span style="color: #4CAF50;">● 0</span>
                        <span style="margin-left: 12px; color: #ccc; margin-right: 5px;">|</span>
                        <span style="background-color: #e9f8dd; border-radius: 10; padding: 5px;">
                            <img src="{{ URL::asset('/build/img/greenflag.svg') }}" alt="alt" width="20px;">
                        </span>
                    </div>
                </div>
            </div>
        `;
    }

    // Function to generate profile avatars
    function generateProfileAvatars(count) {
        let avatars = '';
        const maxAvatars = Math.min(count, 3); // Show max 3 avatars
        
        for (let i = 0; i < maxAvatars; i++) {
            avatars += `<img src="{{ asset('assets/spin-loader.gif') }}" alt="User" style="width: 19px; height: 19px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">`;
        }
        
        return avatars;
    }

    // Function to load delayed tickets dynamically
    async function loadDelayedTickets(projectId = '') {
        const refreshBtn = document.querySelector('button[onclick="loadDelayedTickets()"]');
        const originalContent = refreshBtn ? refreshBtn.innerHTML : '';
        
        try {
            // Show loading state on refresh button
            if (refreshBtn) {
                refreshBtn.disabled = true;
                refreshBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            }

            const url = buildFilteredUrl('/tickets/by-status?status=in_delayed', 'in_delayed');
            const response = await fetch(url, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                credentials: 'same-origin'
            });

            if (response.ok) {
                const data = await response.json();
                const tickets = data.tickets;
                const count = data.count;
                
                // Update the count
                const countElement = document.getElementById('delayed-count');
                if (countElement) {
                    countElement.textContent = count;
                }

                // Clear loading and populate tickets
                const container = document.getElementById('delayed-tickets');
                if (container) {
                    container.innerHTML = '';
                    
                    if (tickets.length === 0) {
                        container.innerHTML = `
                            <div class="text-center p-4">
                                <p class="text-muted">No tickets delayed</p>
                            </div>
                        `;
                        return;
                    }

                    tickets.forEach(ticket => {
                        const ticketHtml = createDelayedTicketCard(ticket);
                        container.insertAdjacentHTML('beforeend', ticketHtml);
                    });
                }
            } else {
                console.error('Failed to load delayed tickets');
                const container = document.getElementById('delayed-tickets');
                if (container) {
                    container.innerHTML = `
                        <div class="text-center p-4">
                            <p class="text-danger">Failed to load delayed tickets</p>
                        </div>
                    `;
                }
            }
        } catch (error) {
            console.error('Error loading delayed tickets:', error);
            const container = document.getElementById('delayed-tickets');
            if (container) {
                container.innerHTML = `
                    <div class="text-center p-4">
                        <p class="text-danger">Error loading delayed tickets</p>
                    </div>
                `;
            }
        } finally {
            // Restore refresh button
            if (refreshBtn) {
                refreshBtn.disabled = false;
                refreshBtn.innerHTML = originalContent;
            }
        }
    }

    // Function to create delayed ticket card HTML
    function createDelayedTicketCard(ticket) {
        const startDate = ticket.start_date || 'N/A';
        const endDate = ticket.end_date || 'N/A';
        const assigneesCount = ticket.assignees ? ticket.assignees.length : 0;
        
        // Calculate progress percentage (you can modify this logic based on your needs)
        const progressPercentage = 0; // Lower percentage for delayed tickets
        
        return `
            <div class="mt-2" style="background-color: #f8f9fa; border-radius: 10px; padding: 2px; font-size: 11px;">
                <!-- Header -->
                <div class="d-flex justify-content-between flex-wrap">
                    <div class="ticket-header-text">
                        ${ticket.project_logo_path ? 
                            `<img src="/storage/${ticket.project_logo_path}" alt="Project Logo" style="width: 35px; height: 35px;">` : 
                            `<img src="{{ asset('build/img/yekbon.svg') }}" alt="Project Logo" style="width: 35px; height: 35px;">`
                        }
                    </div>
                    <div class="ticket-header-text" style="color: #1a73e8;">
                        <strong>Tickets</strong><br>${ticket.code}
                    </div>
                    <div class="ticket-header-text" style="color: #1a73e8;">
                        <strong>Section</strong><br>${ticket.section_name || 'N/A'}
                    </div>
                    <div class="ticket-header-text" style="color: #1a73e8;">
                        <strong>Ticket Title</strong><br>${ticket.title}
                    </div>
                </div>

                <!-- Task Line -->
                <div class="ticket-task-line" style="margin-top: 1rem; display: flex; align-items: center; text-align: center; flex-wrap: wrap; justify-content: space-between; background-color: #fff; border-radius: 10px; padding: 6px; font-size: 12px; color: #333;">
                    <!-- Task Count -->
                    <span class="ticket-item-text" style="margin-right: 5px; font-weight: bold; color: #28a745;">
                        Tasks
                        <p style="color: black;">${assigneesCount}</p>
                    </span>

                    <!-- Divider -->
                    <span class="ticket-item-text" style="margin-right: 5px; color: #ccc;">|</span>

                    <!-- Start Date -->
                    <span class="ticket-item-text" style="margin-right: 5px; color: #28a745;">
                        Start:
                        <p style="color: black;">${startDate}</p>
                    </span>

                    <!-- Divider -->
                    <span class="ticket-item-text" style="margin-right: 5px; color: #ccc;">|</span>

                    <!-- Delivery Date -->
                    <span class="ticket-item-text" style="margin-right: 5px; color: #28a745;">
                        Deliver: 
                        <p style="color: black;">${endDate}</p>
                    </span>

                    <!-- Divider -->
                    <span class="ticket-item-text" style="margin-right: 5px; color: #ccc;">|</span>

                    <!-- Overlapping Profile Avatars -->
                    <div class="ticket-item-text" style="display: flex; align-items: center;">
                        <img src="{{ asset('assets/spin-loader.gif') }}" alt="User" style="width: 19px; height: 19px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                        <img src="{{ asset('assets/spin-loader.gif') }}" alt="User" style="width: 19px; height: 19px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                        <img src="{{ asset('assets/spin-loader.gif') }}" alt="User" style="width: 19px; height: 19px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                    </div>
                </div>

                <!-- Progress Bar -->
                <div class="d-flex justify-content-between align-items-center mt-1 mb-1" style="flex-wrap: nowrap; background: #fff; padding: 5px; border-radius: 10px;">
                    <!-- Progress Bar + Percentage -->
                    <div class="d-flex align-items-center" style="flex: 1;">
                        <div class="d-flex align-items-center" style="flex: 1;">
                            <div class="progress" style="height: 8px; width: 100px; background-color: #e0e0e0; border-radius: 5px; overflow: hidden;">
                                <div class="progress-bar" role="progressbar" style="width: ${progressPercentage}%; background-color: #ED1C24;"></div>
                            </div>
                            <div style="font-size: 12px; color: #ED1C24; margin-left: 7px;">${progressPercentage}%</div>
                        </div>
                        <span style="margin-left: 8px; color: #ccc;">|</span>
                    </div>
                    <!-- Status Colors -->
                    <div class="d-flex align-items-center ms-3" style="font-size: 11px; gap: 3px; margin-right: 4px;">
                        <span style="color: #8BC34A;">● 0</span>
                        <span style="color: #FF9800;">● 0</span>
                        <span style="color: #F44336;">● 0</span>
                        <span style="color: #9C27B0;">● 0</span>
                        <span style="color: #4CAF50;">● 0</span>
                        <span style="margin-left: 12px; color: #ccc; margin-right: 5px;">|</span>
                        <span style="background-color: #ffebee; border-radius: 10; padding: 5px;">
                            <img src="{{ URL::asset('/build/img/redflag.svg') }}" alt="alt" width="20px;">
                        </span>
                    </div>
                </div>
            </div>
        `;
    }

    // Function to load new tickets dynamically
    async function loadNewTickets(projectId = '') {
        const refreshBtn = document.querySelector('button[onclick="loadNewTickets()"]');
        const originalContent = refreshBtn ? refreshBtn.innerHTML : '';
        
        try {
            // Show loading state on refresh button
            if (refreshBtn) {
                refreshBtn.disabled = true;
                refreshBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            }

            const url = buildFilteredUrl('/tickets/by-status?status=new_ticket', 'new_ticket');
            const response = await fetch(url, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                credentials: 'same-origin'
            });

            if (response.ok) {
                const data = await response.json();
                const tickets = data.tickets;
                const count = data.count;
                
                // Update the count
                const countElement = document.getElementById('new-ticket-count');
                if (countElement) {
                    countElement.textContent = count;
                }

                // Clear loading and populate tickets
                const container = document.getElementById('new-tickets');
                if (container) {
                    container.innerHTML = '';
                    
                    if (tickets.length === 0) {
                        container.innerHTML = `
                            <div class="text-center p-4">
                                <p class="text-muted">No new tickets</p>
                            </div>
                        `;
                        return;
                    }

                    tickets.forEach(ticket => {
                        const ticketHtml = createNewTicketCard(ticket);
                        container.insertAdjacentHTML('beforeend', ticketHtml);
                    });
                }
            } else {
                console.error('Failed to load new tickets');
                const container = document.getElementById('new-tickets');
                if (container) {
                    container.innerHTML = `
                        <div class="text-center p-4">
                            <p class="text-danger">Failed to load new tickets</p>
                        </div>
                    `;
                }
            }
        } catch (error) {
            console.error('Error loading new tickets:', error);
            const container = document.getElementById('new-tickets');
            if (container) {
                container.innerHTML = `
                    <div class="text-center p-4">
                        <p class="text-danger">Error loading new tickets</p>
                    </div>
                `;
            }
        } finally {
            // Restore refresh button
            if (refreshBtn) {
                refreshBtn.disabled = false;
                refreshBtn.innerHTML = originalContent;
            }
        }
    }

    // Function to create new ticket card HTML
    function createNewTicketCard(ticket) {
        const startDate = ticket.start_date || 'N/A';
        const endDate = ticket.end_date || 'N/A';
        const assigneesCount = ticket.assignees ? ticket.assignees.length : 0;
        
        // Calculate progress percentage (you can modify this logic based on your needs)
        const progressPercentage = 0; // Very low percentage for new tickets
        
        return `
            <div class="mt-2" style="background-color: #f8f9fa; border-radius: 10px; padding: 2px; font-size: 11px;">
                <!-- Header -->
                <div class="d-flex justify-content-between flex-wrap">
                    <div class="ticket-header-text">
                        ${ticket.project_logo_path ? 
                            `<img src="/storage/${ticket.project_logo_path}" alt="Project Logo" style="width: 35px; height: 35px;">` : 
                            `<img src="{{ asset('build/img/yekbon.svg') }}" alt="Project Logo" style="width: 35px; height: 35px;">`
                        }
                    </div>
                    <div class="ticket-header-text" style="color: #1a73e8;">
                        <strong>Tickets</strong><br>${ticket.code}
                    </div>
                    <div class="ticket-header-text" style="color: #1a73e8;">
                        <strong>Section</strong><br>${ticket.section_name || 'N/A'}
                    </div>
                    <div class="ticket-header-text" style="color: #1a73e8;">
                        <strong>Ticket Title</strong><br>${ticket.title}
                    </div>
                </div>

                <!-- Task Line -->
                <div class="ticket-task-line" style="margin-top: 1rem; display: flex; align-items: center; text-align: center; flex-wrap: wrap; justify-content: space-between; background-color: #fff; border-radius: 10px; padding: 6px; font-size: 12px; color: #333;">
                    <!-- Task Count -->
                    <span class="ticket-item-text" style="margin-right: 5px; font-weight: bold; color: #28a745;">
                        Tasks
                        <p style="color: black;">${assigneesCount}</p>
                    </span>

                    <!-- Divider -->
                    <span class="ticket-item-text" style="margin-right: 5px; color: #ccc;">|</span>

                    <!-- Start Date -->
                    <span class="ticket-item-text" style="margin-right: 5px; color: #28a745;">
                        Start:
                        <p style="color: black;">${startDate}</p>
                    </span>

                    <!-- Divider -->
                    <span class="ticket-item-text" style="margin-right: 5px; color: #ccc;">|</span>

                    <!-- Delivery Date -->
                    <span class="ticket-item-text" style="margin-right: 5px; color: #28a745;">
                        Deliver: 
                        <p style="color: black;">${endDate}</p>
                    </span>

                    <!-- Divider -->
                    <span class="ticket-item-text" style="margin-right: 5px; color: #ccc;">|</span>

                    <!-- Overlapping Profile Avatars -->
                    <div class="ticket-item-text" style="display: flex; align-items: center;">
                        <img src="{{ asset('assets/spin-loader.gif') }}" alt="User" style="width: 19px; height: 19px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                        <img src="{{ asset('assets/spin-loader.gif') }}" alt="User" style="width: 19px; height: 19px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                        <img src="{{ asset('assets/spin-loader.gif') }}" alt="User" style="width: 19px; height: 19px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                    </div>
                </div>

                <!-- Progress Bar -->
                <div class="d-flex justify-content-between align-items-center mt-1 mb-1" style="flex-wrap: nowrap; background: #fff; padding: 5px; border-radius: 10px;">
                    <!-- Progress Bar + Percentage -->
                    <div class="d-flex align-items-center" style="flex: 1;">
                        <div class="d-flex align-items-center" style="flex: 1;">
                            <div class="progress" style="height: 8px; width: 100px; background-color: #e0e0e0; border-radius: 5px; overflow: hidden;">
                                <div class="progress-bar" role="progressbar" style="width: ${progressPercentage}%; background-color: #2196F3;"></div>
                            </div>
                            <div style="font-size: 12px; color: #2196F3; margin-left: 7px;">${progressPercentage}%</div>
                        </div>
                        <span style="margin-left: 8px; color: #ccc;">|</span>
                    </div>
                    <!-- Status Colors -->
                    <div class="d-flex align-items-center ms-3" style="font-size: 11px; gap: 3px; margin-right: 4px;">
                        <span style="color: #8BC34A;">● 0</span>
                        <span style="color: #FF9800;">● 0</span>
                        <span style="color: #F44336;">● 0</span>
                        <span style="color: #9C27B0;">● 0</span>
                        <span style="color: #4CAF50;">● 0</span>
                        <span style="margin-left: 12px; color: #ccc; margin-right: 5px;">|</span>
                        <span style="background-color: #e3f2fd; border-radius: 10; padding: 5px;">
                            <img src="{{ URL::asset('/build/img/blueflag.svg') }}" alt="alt" width="20px;">
                        </span>
                    </div>
                </div>
            </div>
        `;
    }

    // Function to load hold tickets dynamically
    async function loadHoldTickets(projectId = '') {
        const refreshBtn = document.querySelector('button[onclick="loadHoldTickets()"]');
        const originalContent = refreshBtn ? refreshBtn.innerHTML : '';
        
        try {
            // Show loading state on refresh button
            if (refreshBtn) {
                refreshBtn.disabled = true;
                refreshBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            }

            const url = buildFilteredUrl('/tickets/by-status?status=in_hold', 'in_hold');
            const response = await fetch(url, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                credentials: 'same-origin'
            });

            if (response.ok) {
                const data = await response.json();
                const tickets = data.tickets;
                const count = data.count;
                
                // Update the count
                const countElement = document.getElementById('hold-count');
                if (countElement) {
                    countElement.textContent = count;
                }

                // Clear loading and populate tickets
                const container = document.getElementById('hold-tickets');
                if (container) {
                    container.innerHTML = '';
                    
                    if (tickets.length === 0) {
                        container.innerHTML = `
                            <div class="text-center p-4">
                                <p class="text-muted">No tickets on hold</p>
                            </div>
                        `;
                        return;
                    }

                    tickets.forEach(ticket => {
                        const ticketHtml = createHoldTicketCard(ticket);
                        container.insertAdjacentHTML('beforeend', ticketHtml);
                    });
                }
            } else {
                console.error('Failed to load hold tickets');
                const container = document.getElementById('hold-tickets');
                if (container) {
                    container.innerHTML = `
                        <div class="text-center p-4">
                            <p class="text-danger">Failed to load hold tickets</p>
                        </div>
                    `;
                }
            }
        } catch (error) {
            console.error('Error loading hold tickets:', error);
            const container = document.getElementById('hold-tickets');
            if (container) {
                container.innerHTML = `
                    <div class="text-center p-4">
                        <p class="text-danger">Error loading hold tickets</p>
                    </div>
                `;
            }
        } finally {
            // Restore refresh button
            if (refreshBtn) {
                refreshBtn.disabled = false;
                refreshBtn.innerHTML = originalContent;
            }
        }
    }

    // Function to create hold ticket card HTML
    function createHoldTicketCard(ticket) {
        const startDate = ticket.start_date || 'N/A';
        const endDate = ticket.end_date || 'N/A';
        const assigneesCount = ticket.assignees ? ticket.assignees.length : 0;
        
        // Calculate progress percentage (you can modify this logic based on your needs)
        const progressPercentage = 0; // Medium percentage for hold tickets
        
        return `
            <div class="mt-2" style="background-color: #f8f9fa; border-radius: 10px; padding: 2px; font-size: 11px;">
                <!-- Header -->
                <div class="d-flex justify-content-between flex-wrap">
                    <div class="ticket-header-text">
                        ${ticket.project_logo_path ? 
                            `<img src="/storage/${ticket.project_logo_path}" alt="Project Logo" style="width: 35px; height: 35px;">` : 
                            `<img src="{{ asset('build/img/yekbon.svg') }}" alt="Project Logo" style="width: 35px; height: 35px;">`
                        }
                    </div>
                    <div class="ticket-header-text" style="color: #1a73e8;">
                        <strong>Tickets</strong><br>${ticket.code}
                    </div>
                    <div class="ticket-header-text" style="color: #1a73e8;">
                        <strong>Section</strong><br>${ticket.section_name || 'N/A'}
                    </div>
                    <div class="ticket-header-text" style="color: #1a73e8;">
                        <strong>Ticket Title</strong><br>${ticket.title}
                    </div>
                </div>

                <!-- Task Line -->
                <div class="ticket-task-line" style="margin-top: 1rem; display: flex; align-items: center; text-align: center; flex-wrap: wrap; justify-content: space-between; background-color: #fff; border-radius: 10px; padding: 6px; font-size: 12px; color: #333;">
                    <!-- Task Count -->
                    <span class="ticket-item-text" style="margin-right: 5px; font-weight: bold; color: #28a745;">
                        Tasks
                        <p style="color: black;">${assigneesCount}</p>
                    </span>

                    <!-- Divider -->
                    <span class="ticket-item-text" style="margin-right: 5px; color: #ccc;">|</span>

                    <!-- Start Date -->
                    <span class="ticket-item-text" style="margin-right: 5px; color: #28a745;">
                        Start:
                        <p style="color: black;">${startDate}</p>
                    </span>

                    <!-- Divider -->
                    <span class="ticket-item-text" style="margin-right: 5px; color: #ccc;">|</span>

                    <!-- Delivery Date -->
                    <span class="ticket-item-text" style="margin-right: 5px; color: #28a745;">
                        Deliver: 
                        <p style="color: black;">${endDate}</p>
                    </span>

                    <!-- Divider -->
                    <span class="ticket-item-text" style="margin-right: 5px; color: #ccc;">|</span>

                    <!-- Overlapping Profile Avatars -->
                   
                </div>

                <!-- Progress Bar -->
                <div class="d-flex justify-content-between align-items-center mt-1 mb-1" style="flex-wrap: nowrap; background: #fff; padding: 5px; border-radius: 10px;">
                    <!-- Progress Bar + Percentage -->
                    <div class="d-flex align-items-center" style="flex: 1;">
                        <div class="d-flex align-items-center" style="flex: 1;">
                            <div class="progress" style="height: 8px; width: 100px; background-color: #e0e0e0; border-radius: 5px; overflow: hidden;">
                                <div class="progress-bar" role="progressbar" style="width: ${progressPercentage}%; background-color: #F5A623;"></div>
                            </div>
                            <div style="font-size: 12px; color: #F5A623; margin-left: 7px;">${progressPercentage}%</div>
                        </div>
                        <span style="margin-left: 8px; color: #ccc;">|</span>
                    </div>
                    <!-- Status Colors -->
                    <div class="d-flex align-items-center ms-3" style="font-size: 11px; gap: 3px; margin-right: 4px;">
                        <span style="color: #8BC34A;">● 0</span>
                        <span style="color: #FF9800;">● 0</span>
                        <span style="color: #F44336;">● 0</span>
                        <span style="color: #9C27B0;">● 0</span>
                        <span style="color: #4CAF50;">● 0</span>
                        <span style="margin-left: 12px; color: #ccc; margin-right: 5px;">|</span>
                        <span style="background-color: #fff3cd; border-radius: 10; padding: 5px;">
                            <img src="{{ URL::asset('/build/img/yelowflag.svg') }}" alt="alt" width="20px;">
                        </span>
                    </div>
                </div>
            </div>
        `;
    }

    // Function to load done tickets dynamically
    async function loadDoneTickets(projectId = '') {
        const refreshBtn = document.querySelector('button[onclick="loadDoneTickets()"]');
        const originalContent = refreshBtn ? refreshBtn.innerHTML : '';
        
        try {
            // Show loading state on refresh button
            if (refreshBtn) {
                refreshBtn.disabled = true;
                refreshBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            }

            const url = buildFilteredUrl('/tickets/by-status?status=in_done', 'in_done');
            const response = await fetch(url, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                credentials: 'same-origin'
            });

            if (response.ok) {
                const data = await response.json();
                const tickets = data.tickets;
                const count = data.count;
                
                // Update the count
                const countElement = document.getElementById('done-count');
                if (countElement) {
                    countElement.textContent = count;
                }

                // Clear loading and populate tickets
                const container = document.getElementById('done-tickets');
                if (container) {
                    container.innerHTML = '';
                    
                    if (tickets.length === 0) {
                        container.innerHTML = `
                            <div class="text-center p-4">
                                <p class="text-muted">No tickets completed</p>
                            </div>
                        `;
                        return;
                    }

                    tickets.forEach(ticket => {
                        const ticketHtml = createDoneTicketCard(ticket);
                        container.insertAdjacentHTML('beforeend', ticketHtml);
                    });
                }
            } else {
                console.error('Failed to load done tickets');
                const container = document.getElementById('done-tickets');
                if (container) {
                    container.innerHTML = `
                        <div class="text-center p-4">
                            <p class="text-danger">Failed to load done tickets</p>
                        </div>
                    `;
                }
            }
        } catch (error) {
            console.error('Error loading done tickets:', error);
            const container = document.getElementById('done-tickets');
            if (container) {
                container.innerHTML = `
                    <div class="text-center p-4">
                        <p class="text-danger">Error loading done tickets</p>
                    </div>
                `;
            }
        } finally {
            // Restore refresh button
            if (refreshBtn) {
                refreshBtn.disabled = false;
                refreshBtn.innerHTML = originalContent;
            }
        }
    }

    // Function to create done ticket card HTML
    function createDoneTicketCard(ticket) {
        const startDate = ticket.start_date || 'N/A';
        const endDate = ticket.end_date || 'N/A';
        const assigneesCount = ticket.assignees ? ticket.assignees.length : 0;
        
        // Calculate progress percentage (you can modify this logic based on your needs)
        const progressPercentage = 0; // 100% for done tickets
        
        return `
            <div class="mt-2" style="background-color: #f8f9fa; border-radius: 10px; padding: 2px; font-size: 11px;">
                <!-- Header -->
                <div class="d-flex justify-content-between flex-wrap">
                    <div class="ticket-header-text">
                        ${ticket.project_logo_path ? 
                            `<img src="/storage/${ticket.project_logo_path}" alt="Project Logo" style="width: 35px; height: 35px;">` : 
                            `<img src="{{ asset('build/img/yekbon.svg') }}" alt="Project Logo" style="width: 35px; height: 35px;">`
                        }
                    </div>
                    <div class="ticket-header-text" style="color: #1a73e8;">
                        <strong>Tickets</strong><br>${ticket.code}
                    </div>
                    <div class="ticket-header-text" style="color: #1a73e8;">
                        <strong>Section</strong><br>${ticket.section_name || 'N/A'}
                    </div>
                    <div class="ticket-header-text" style="color: #1a73e8;">
                        <strong>Ticket Title</strong><br>${ticket.title}
                    </div>
                </div>

                <!-- Task Line -->
                <div class="ticket-task-line" style="margin-top: 1rem; display: flex; align-items: center; text-align: center; flex-wrap: wrap; justify-content: space-between; background-color: #fff; border-radius: 10px; padding: 6px; font-size: 12px; color: #333;">
                    <!-- Task Count -->
                    <span class="ticket-item-text" style="margin-right: 5px; font-weight: bold; color: #28a745;">
                        Tasks
                        <p style="color: black;">${assigneesCount}</p>
                    </span>

                    <!-- Divider -->
                    <span class="ticket-item-text" style="margin-right: 5px; color: #ccc;">|</span>

                    <!-- Start Date -->
                    <span class="ticket-item-text" style="margin-right: 5px; color: #28a745;">
                        Start:
                        <p style="color: black;">${startDate}</p>
                    </span>

                    <!-- Divider -->
                    <span class="ticket-item-text" style="margin-right: 5px; color: #ccc;">|</span>

                    <!-- Delivery Date -->
                    <span class="ticket-item-text" style="margin-right: 5px; color: #28a745;">
                        Deliver: 
                        <p style="color: black;">${endDate}</p>
                    </span>

                    <!-- Divider -->
                    <span class="ticket-item-text" style="margin-right: 5px; color: #ccc;">|</span>

                    <!-- Overlapping Profile Avatars -->
                    <div class="ticket-item-text" style="display: flex; align-items: center;">
                        <img src="{{ asset('assets/spin-loader.gif') }}" alt="User" style="width: 19px; height: 19px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                        <img src="{{ asset('assets/spin-loader.gif') }}" alt="User" style="width: 19px; height: 19px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                        <img src="{{ asset('assets/spin-loader.gif') }}" alt="User" style="width: 19px; height: 19px; border-radius: 50%; border: 2px solid #e8ecef; margin-left: -5px;">
                    </div>
                </div>

                <!-- Progress Bar -->
                <div class="d-flex justify-content-between align-items-center mt-1 mb-1" style="flex-wrap: nowrap; background: #fff; padding: 5px; border-radius: 10px;">
                    <!-- Progress Bar + Percentage -->
                    <div class="d-flex align-items-center" style="flex: 1;">
                        <div class="d-flex align-items-center" style="flex: 1;">
                            <div class="progress" style="height: 8px; width: 100px; background-color: #e0e0e0; border-radius: 5px; overflow: hidden;">
                                <div class="progress-bar" role="progressbar" style="width: ${progressPercentage}%; background-color: #00C853;"></div>
                            </div>
                            <div style="font-size: 12px; color: #00C853; margin-left: 7px;">${progressPercentage}%</div>
                        </div>
                        <span style="margin-left: 8px; color: #ccc;">|</span>
                    </div>
                    <!-- Status Colors -->
                    <div class="d-flex align-items-center ms-3" style="font-size: 11px; gap: 3px; margin-right: 4px;">
                        <span style="color: #8BC34A;">● 0</span>
                        <span style="color: #FF9800;">● 0</span>
                        <span style="color: #F44336;">● 0</span>
                        <span style="color: #9C27B0;">● 0</span>
                        <span style="color: #4CAF50;">● 0</span>
                        <span style="margin-left: 12px; color: #ccc; margin-right: 5px;">|</span>
                        <span style="background-color: #e8f5e8; border-radius: 10; padding: 5px;">
                            <img src="{{ URL::asset('/build/img/greenflag.svg') }}" alt="alt" width="20px;">
                        </span>
                    </div>
                </div>
            </div>
        `;
    }

    // Load tickets when page loads
    document.addEventListener('DOMContentLoaded', function() {
        // Load dashboard stats first, then load tickets
        loadDashboardStats().then(() => {
            loadInProgressTickets();
            loadDelayedTickets();
            loadNewTickets();
            loadHoldTickets();
            loadDoneTickets();
        });

        // Add event listeners for project filters
        const inProgressFilter = document.getElementById('in-progress-project-filter');
        const holdFilter = document.getElementById('hold-project-filter');
        const delayedFilter = document.getElementById('delayed-project-filter');
        const newTicketFilter = document.getElementById('new-ticket-project-filter');
        const doneFilter = document.getElementById('done-project-filter');

        if (inProgressFilter) {
            inProgressFilter.addEventListener('change', function() {
                loadInProgressTickets(this.value);
            });
        }

        if (holdFilter) {
            holdFilter.addEventListener('change', function() {
                loadHoldTickets(this.value);
            });
        }

        if (delayedFilter) {
            delayedFilter.addEventListener('change', function() {
                loadDelayedTickets(this.value);
            });
        }

        if (newTicketFilter) {
            newTicketFilter.addEventListener('change', function() {
                loadNewTickets(this.value);
            });
        }

        if (doneFilter) {
            doneFilter.addEventListener('change', function() {
                loadDoneTickets(this.value);
            });
        }
    });
</script>

<script>
    document.querySelectorAll('.toggle-btn').forEach(btn => {
        if (!btn) return; // Skip if button is null
        btn.addEventListener('click', function() {
            var details = this.nextElementSibling;
            var icon = this.querySelector('.toggle-icon');

            if (details.classList.contains('show')) {
                // Close the currently open section
                details.style.maxHeight = details.scrollHeight + 'px';
                setTimeout(function() {
                    details.style.maxHeight = '0';
                    details.classList.remove('show');
                }, 10);
                if (icon) icon.style.transform = 'rotate(0deg)';
            } else {
                // Close any other open sections first
                document.querySelectorAll('.project-details.show').forEach(function(open) {
                    if (open === details) return;
                    open.style.maxHeight = open.scrollHeight + 'px';
                    setTimeout(function() {
                        open.style.maxHeight = '0';
                        open.classList.remove('show');
                    }, 10);
                    var otherIcon = open.previousElementSibling && open.previousElementSibling.querySelector('.toggle-icon');
                    if (otherIcon) otherIcon.style.transform = 'rotate(0deg)';
                });

                // Open the clicked section
                details.classList.add('show');
                details.style.maxHeight = details.scrollHeight + 'px';
                if (icon) icon.style.transform = 'rotate(180deg)';
            }
        });
    });
</script>


<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->
@component('components.model-popup')
@endcomponent
@endsection