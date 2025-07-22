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
</style>




<!-- content -->
<div class="content main_content">

    <!-- Left Sidebar Menu -->
    <div class="sidebar-menu">

        <div class="logo">
            <a href="{{ url('index') }}" class="logo-normal">
                <img src="{{ URL::asset('/build/img/AI-Logo.svg') }}" alt="Logo" style="max-width: 70% !important;">
            </a>
        </div>
     @include('Chats.chatsidebar')
    </div>
    <!-- /Left Sidebar Menu -->

    <!-- sidebar group -->
    <div class="sidebar-group" style="width: 96%;">

        <div class="tab-content" >
            <!-- Ai -->
             
                <!-- Chats sidebar -->
                <div class="sidebar-content active slimscroll">

                    <div class="slimscroll">

                        <div class="chat-search-header">
                            <div class="header-title d-flex align-items-center justify-content-between">
                                <h4 class="mb-3">Projects</h4>
                                <div class="d-flex align-items-center mb-3">
                                    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#add-contact" class="add-icon btn btn-primary p-0 d-flex align-items-center justify-content-center fs-16 me-2"><i class="ti ti-plus"></i></a>
                                </div>
                            </div>

                            <!-- Chat Search -->
                            <div class="search-wrap">
                                <form action="#">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search Contacts">
                                        <span class="input-group-text"><i class="ti ti-search"></i></span>
                                    </div>
                                </form>
                            </div>
                            <!-- /Chat Search -->
                        </div>

                        <div class="sidebar-body chat-body">

                            <!-- Left Chat Title -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5>All Projects</h5>
                            </div>
                            <!-- /Left Chat Title -->

                            <div class="chat-users-wrap">
                                <div class="mb-4">
                                    <h6 class="mb-2">A</h6>
                                    <div class="chat-list">
                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#contact-details" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Aaryian Jose</h6>
                                                    <p>last seen 5 days ago</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <h6 class="mb-2">C</h6>
                                    <div class="chat-list">
                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#contact-details" class="chat-user-list">
                                            <div class="avatar avatar-lg offline me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-03.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Clyde Smith</h6>
                                                    <p>is busy now!</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="chat-list">
                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#contact-details" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-04.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Carla Jenkins</h6>
                                                    <p>is online now</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <h6 class="mb-2">D</h6>
                                    <div class="chat-list">
                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#contact-details" class="chat-user-list">
                                            <div class="avatar avatar-lg away me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-14.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Danielle Baker</h6>
                                                    <p>last seen a week ago</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <h6 class="mb-2">E</h6>
                                    <div class="chat-list">
                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#contact-details" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Edward Lietz</h6>
                                                    <p>Do you know which App or ...</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <h6 class="mb-2">F</h6>
                                    <div class="chat-list">
                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#contact-details" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-07.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Federico Wells</h6>
                                                    <p>last seen 10 min ago</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- / Chats sidebar -->
      
          
           

            
          


        </div>
    </div>
    <!-- /Sidebar group -->

    <!-- Chat -->


    



</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>






<!-- Bootstrap JS Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@component('components.model-popup')
@endcomponent
@endsection