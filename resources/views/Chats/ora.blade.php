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


    @include('Chats.chatsidebar')

    <!-- /Left Sidebar Menu -->

    <!-- sidebar group -->
    <div class="sidebar-group">

        <div class="tab-content">


            <!-- Chats sidebar -->
            <div id="chats" class="sidebar-content active slimscroll">

                <div class="slimscroll">

                    <div class="chat-search-header">
                        <div class="header-title d-flex align-items-center justify-content-between">
                            <h4 class="mb-3">Libary</h4>
                            <div class="d-flex align-items-center mb-3">
                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#new-chat" class="add-icon btn btn-primary p-0 d-flex align-items-center justify-content-center fs-16 me-2"><i class="ti ti-plus"></i></a>
                                <div class="dropdown">
                                    <a href="javascript:void(0);" data-bs-toggle="dropdown" class="fs-16 text-default">
                                        <i class="ti ti-dots-vertical"></i>
                                    </a>
                                    <ul class="dropdown-menu p-3">
                                        <li><a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#invite"><i class="ti ti-send me-2"></i>Invite Others</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Chat Search -->
                        <!-- <div class="search-wrap">
                                <form action="{{url('chat')}}">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search For Contacts or Messages">
                                        <span class="input-group-text"><i class="ti ti-search"></i></span>
                                    </div>
                                </form>
                            </div> -->
                        <!-- /Chat Search -->
                        <div style="background-color: white;">
                            <div class="modal-dialog modal-dialog-centered pb-2">
                                <div class="modal-content" style="padding-left: 16px; padding-right: 16px;">

                                    <!-- Top-Right Large Toggle Icon -->
                                    <div class="d-flex justify-content-end px-3 pt-3">
                                        <a data-bs-toggle="collapse" href="#collapseSubjectForm" role="button" aria-expanded="true" aria-controls="collapseSubjectForm" id="toggleIcon">
                                            <i class="ti ti-chevron-up fs-3" id="chevronIcon"></i> <!-- fs-3 makes it larger -->
                                        </a>
                                    </div>

                                    <!-- Collapsible Form -->
                                    <div class="collapse show" id="collapseSubjectForm">
                                        <div class="modal-body">
                                            <form action="{{ url('index') }}">


                                                <!-- Subject Title -->
                                                <div class="row mb-3">
                                                    <div class="col-12">
                                                        <label class="form-label">Add A Word</label>
                                                        <input type="text" class="form-control" placeholder="Enter A Word">
                                                    </div>
                                                </div>

                                                <!-- Submit Button -->
                                                <div class="row">
                                                    <div class="col-12 pb-1">
                                                        <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#add-group">Create</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /collapse -->

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Online Contacts -->
                    <div class="top-online-contacts">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="mb-3">Recent Library</h5>
                            <div class="dropdown mb-3">
                                <a href="#" class="text-default" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-dots-vertical"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                    <li><a class="dropdown-item mb-1" href="#"><i class="ti ti-eye-off me-2"></i>Hide Recent</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="feather-users me-2"></i>Active Contacts</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <a href="{{url('chat')}}" class="chat-status text-center">
                                        <div class="avatar avatar-lg online d-block">
                                            <img src="{{URL::asset('/build/img/profiles/avatar-11.jpg')}}" alt="Image" class="rounded-circle">
                                        </div>
                                        <p>Nichol</p>
                                    </a>
                                </div>
                                <div class="swiper-slide">
                                    <a href="{{url('chat')}}" class="chat-status text-center">
                                        <div class="avatar avatar-lg online d-block">
                                            <img src="{{URL::asset('/build/img/profiles/avatar-12.jpg')}}" alt="Image" class="rounded-circle">
                                        </div>
                                        <p>Titus</p>
                                    </a>
                                </div>
                                <div class="swiper-slide">
                                    <a href="{{url('chat')}}" class="chat-status text-center">
                                        <div class="avatar avatar-lg online d-block">
                                            <img src="{{URL::asset('/build/img/profiles/avatar-14.jpg')}}" alt="Image" class="rounded-circle">
                                        </div>
                                        <p>Geoffrey</p>
                                    </a>
                                </div>
                                <div class="swiper-slide">
                                    <a href="{{url('chat')}}" class="chat-status text-center">
                                        <div class="avatar avatar-lg online d-block">
                                            <img src="{{URL::asset('/build/img/profiles/avatar-15.jpg')}}" alt="Image" class="rounded-circle">
                                        </div>
                                        <p>Laverty</p>
                                    </a>
                                </div>
                                <div class="swiper-slide">
                                    <a href="{{url('chat')}}" class="chat-status text-center">
                                        <div class="avatar avatar-lg online bg-primary avatar-rounded">
                                            <span class="avatar-title fs-14 fw-medium">KG</span>
                                        </div>
                                        <p>Kitamura</p>
                                    </a>
                                </div>
                                <div class="swiper-slide">
                                    <a href="{{url('chat')}}" class="chat-status text-center">
                                        <div class="avatar avatar-lg online d-block">
                                            <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" alt="Image" class="rounded-circle">
                                        </div>
                                        <p>Mark</p>
                                    </a>
                                </div>
                                <div class="swiper-slide">
                                    <a href="{{url('chat')}}" class="chat-status text-center">
                                        <div class="avatar avatar-lg online d-block">
                                            <img src="{{URL::asset('/build/img/profiles/avatar-05.jpg')}}" alt="Image" class="rounded-circle">
                                        </div>
                                        <p>Smith</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Online Contacts -->

                    <div class="sidebar-body chat-body">

                        <!-- Left Chat Title -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5>Kurd Library</h5>
                        </div>
                        <!-- /Left Chat Title -->

                        <div class="chat-users-wrap">

                            <!-- REUSABLE USER BOX FUNCTION -->
                            <!-- You can duplicate this block and change the letter (A, B, ...) and name -->
                            <!-- Start of user block -->
                            <!-- Just replace `Label` and `Clyde Smith PW Website` accordingly -->

                            <!-- A -->
                            <div class="mb-2">
                                <h6 class="mb-1" style="font-size: 14px;">A</h6>
                                <div style="display: flex; align-items: center; justify-content: space-between; background-color: transparent; border: none; border-radius: 14px; padding: 4px 8px; min-height: 36px;" onmouseover="this.style.backgroundColor='rgba(0,0,0,0.05)'" onmouseout="this.style.backgroundColor='transparent'">
                                    <a href="#" style="flex-grow: 1; text-decoration: none; background-color: transparent;">
                                        <p style="font-size: 14px; color:black; margin: 0; line-height: 1.2;">Clyde Smith PW Website</p>
                                    </a>
                                    <div style="margin-left: auto; display: flex; align-items: center;">
                                        <a href="#" data-bs-toggle="dropdown" style="display: flex; align-items: center; justify-content: center; width: 24px; height: 24px;">
                                            <i class="bi bi-three-dots" style="font-size: 16px;"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end p-2" style="background-color: transparent !important; border: none !important; box-shadow: none !important; margin: 0;">
                                            <li><a class="dropdown-item" href="#" style="background-color: transparent;" onmouseover="this.style.backgroundColor='transparent'" onmouseout="this.style.backgroundColor='transparent'"><img src="{{ asset('/build/img/Subjects.svg') }}" width="12" height="12" class="me-2">Play</a></li>
                                            <li><a class="dropdown-item" href="#" style="background-color: transparent;" onmouseover="this.style.backgroundColor='transparent'" onmouseout="this.style.backgroundColor='transparent'"><img src="{{ asset('/build/img/Edit.svg') }}" width="12" height="12" class="me-2">Edit</a></li>
                                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat" style="background-color: transparent;" onmouseover="this.style.backgroundColor='transparent'" onmouseout="this.style.backgroundColor='transparent'"><img src="{{ asset('/build/img/Remove.svg') }}" width="16" height="16" class="me-2">Remove</a></li>
                                        </ul>
                                    </div>
                                </div>
                                 <div style="display: flex; align-items: center; justify-content: space-between; background-color: transparent; border: none; border-radius: 14px; padding: 4px 8px; min-height: 36px;" onmouseover="this.style.backgroundColor='rgba(0,0,0,0.05)'" onmouseout="this.style.backgroundColor='transparent'">
                                    <a href="#" style="flex-grow: 1; text-decoration: none; background-color: transparent;">
                                        <p style="font-size: 14px; color:black; margin: 0; line-height: 1.2;">Clyde Smith PW Website</p>
                                    </a>
                                    <div style="margin-left: auto; display: flex; align-items: center;">
                                        <a href="#" data-bs-toggle="dropdown" style="display: flex; align-items: center; justify-content: center; width: 24px; height: 24px;">
                                            <i class="bi bi-three-dots" style="font-size: 16px;"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end p-2" style="background-color: transparent !important; border: none !important; box-shadow: none !important; margin: 0;">
                                            <li><a class="dropdown-item" href="#" style="background-color: transparent;" onmouseover="this.style.backgroundColor='transparent'" onmouseout="this.style.backgroundColor='transparent'"><img src="{{ asset('/build/img/Subjects.svg') }}" width="12" height="12" class="me-2">Play</a></li>
                                            <li><a class="dropdown-item" href="#" style="background-color: transparent;" onmouseover="this.style.backgroundColor='transparent'" onmouseout="this.style.backgroundColor='transparent'"><img src="{{ asset('/build/img/Edit.svg') }}" width="12" height="12" class="me-2">Edit</a></li>
                                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat" style="background-color: transparent;" onmouseover="this.style.backgroundColor='transparent'" onmouseout="this.style.backgroundColor='transparent'"><img src="{{ asset('/build/img/Remove.svg') }}" width="16" height="16" class="me-2">Remove</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- C -->
                            <div class="mb-2">
                                <h6 class="mb-1" style="font-size: 14px;">C</h6>
                                <div style="display: flex; align-items: center; justify-content: space-between; background-color: transparent; border: none; border-radius: 14px; padding: 4px 8px; min-height: 36px;" onmouseover="this.style.backgroundColor='rgba(0,0,0,0.05)'" onmouseout="this.style.backgroundColor='transparent'">
                                    <a href="#" style="flex-grow: 1; text-decoration: none; background-color: transparent;">
                                        <p style="font-size: 14px; color:black; margin: 0; line-height: 1.2;">Clyde Smith PW Website</p>
                                    </a>
                                    <div style="margin-left: auto; display: flex; align-items: center;">
                                        <a href="#" data-bs-toggle="dropdown" style="display: flex; align-items: center; justify-content: center; width: 24px; height: 24px;">
                                            <i class="bi bi-three-dots" style="font-size: 16px;"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end p-2" style="background-color: transparent !important; border: none !important; box-shadow: none !important; margin: 0;">
                                            <li><a class="dropdown-item" href="#" style="background-color: transparent;" onmouseover="this.style.backgroundColor='transparent'" onmouseout="this.style.backgroundColor='transparent'"><img src="{{ asset('/build/img/Subjects.svg') }}" width="12" height="12" class="me-2">Play</a></li>
                                            <li><a class="dropdown-item" href="#" style="background-color: transparent;" onmouseover="this.style.backgroundColor='transparent'" onmouseout="this.style.backgroundColor='transparent'"><img src="{{ asset('/build/img/Edit.svg') }}" width="12" height="12" class="me-2">Edit</a></li>
                                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat" style="background-color: transparent;" onmouseover="this.style.backgroundColor='transparent'" onmouseout="this.style.backgroundColor='transparent'"><img src="{{ asset('/build/img/Remove.svg') }}" width="16" height="16" class="me-2">Remove</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

 <div style="display: flex; align-items: center; justify-content: space-between; background-color: transparent; border: none; border-radius: 14px; padding: 4px 8px; min-height: 36px;" onmouseover="this.style.backgroundColor='rgba(0,0,0,0.05)'" onmouseout="this.style.backgroundColor='transparent'">
                                    <a href="#" style="flex-grow: 1; text-decoration: none; background-color: transparent;">
                                        <p style="font-size: 14px; color:black; margin: 0; line-height: 1.2;">Clyde Smith PW Website</p>
                                    </a>
                                    <div style="margin-left: auto; display: flex; align-items: center;">
                                        <a href="#" data-bs-toggle="dropdown" style="display: flex; align-items: center; justify-content: center; width: 24px; height: 24px;">
                                            <i class="bi bi-three-dots" style="font-size: 16px;"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end p-2" style="background-color: transparent !important; border: none !important; box-shadow: none !important; margin: 0;">
                                            <li><a class="dropdown-item" href="#" style="background-color: transparent;" onmouseover="this.style.backgroundColor='transparent'" onmouseout="this.style.backgroundColor='transparent'"><img src="{{ asset('/build/img/Subjects.svg') }}" width="12" height="12" class="me-2">Play</a></li>
                                            <li><a class="dropdown-item" href="#" style="background-color: transparent;" onmouseover="this.style.backgroundColor='transparent'" onmouseout="this.style.backgroundColor='transparent'"><img src="{{ asset('/build/img/Edit.svg') }}" width="12" height="12" class="me-2">Edit</a></li>
                                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat" style="background-color: transparent;" onmouseover="this.style.backgroundColor='transparent'" onmouseout="this.style.backgroundColor='transparent'"><img src="{{ asset('/build/img/Remove.svg') }}" width="16" height="16" class="me-2">Remove</a></li>
                                        </ul>
                                    </div>
                                </div>
                            <!-- D -->
                            <div class="mb-2">
                                <h6 class="mb-1" style="font-size: 14px;">D</h6>
                                <div style="display: flex; align-items: center; justify-content: space-between; background-color: transparent; border: none; border-radius: 14px; padding: 4px 8px; min-height: 36px;" onmouseover="this.style.backgroundColor='rgba(0,0,0,0.05)'" onmouseout="this.style.backgroundColor='transparent'">
                                    <a href="#" style="flex-grow: 1; text-decoration: none; background-color: transparent;">
                                        <p style="font-size: 14px; color:black; margin: 0; line-height: 1.2;">Clyde Smith PW Website</p>
                                    </a>
                                    <div style="margin-left: auto; display: flex; align-items: center;">
                                        <a href="#" data-bs-toggle="dropdown" style="display: flex; align-items: center; justify-content: center; width: 24px; height: 24px;">
                                            <i class="bi bi-three-dots" style="font-size: 16px;"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end p-2" style="background-color: transparent !important; border: none !important; box-shadow: none !important; margin: 0;">
                                            <li><a class="dropdown-item" href="#" style="background-color: transparent;" onmouseover="this.style.backgroundColor='transparent'" onmouseout="this.style.backgroundColor='transparent'"><img src="{{ asset('/build/img/Subjects.svg') }}" width="12" height="12" class="me-2">Play</a></li>
                                            <li><a class="dropdown-item" href="#" style="background-color: transparent;" onmouseover="this.style.backgroundColor='transparent'" onmouseout="this.style.backgroundColor='transparent'"><img src="{{ asset('/build/img/Edit.svg') }}" width="12" height="12" class="me-2">Edit</a></li>
                                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat" style="background-color: transparent;" onmouseover="this.style.backgroundColor='transparent'" onmouseout="this.style.backgroundColor='transparent'"><img src="{{ asset('/build/img/Remove.svg') }}" width="16" height="16" class="me-2">Remove</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- E -->
                            <div class="mb-2">
                                <h6 class="mb-1" style="font-size: 14px;">E</h6>
                                <div style="display: flex; align-items: center; justify-content: space-between; background-color: transparent; border: none; border-radius: 14px; padding: 4px 8px; min-height: 36px;" onmouseover="this.style.backgroundColor='rgba(0,0,0,0.05)'" onmouseout="this.style.backgroundColor='transparent'">
                                    <a href="#" style="flex-grow: 1; text-decoration: none; background-color: transparent;">
                                        <p style="font-size: 14px; color:black; margin: 0; line-height: 1.2;">Clyde Smith PW Website</p>
                                    </a>
                                    <div style="margin-left: auto; display: flex; align-items: center;">
                                        <a href="#" data-bs-toggle="dropdown" style="display: flex; align-items: center; justify-content: center; width: 24px; height: 24px;">
                                            <i class="bi bi-three-dots" style="font-size: 16px;"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end p-2" style="background-color: transparent !important; border: none !important; box-shadow: none !important; margin: 0;">
                                            <li><a class="dropdown-item" href="#" style="background-color: transparent;" onmouseover="this.style.backgroundColor='transparent'" onmouseout="this.style.backgroundColor='transparent'"><img src="{{ asset('/build/img/Subjects.svg') }}" width="12" height="12" class="me-2">Play</a></li>
                                            <li><a class="dropdown-item" href="#" style="background-color: transparent;" onmouseover="this.style.backgroundColor='transparent'" onmouseout="this.style.backgroundColor='transparent'"><img src="{{ asset('/build/img/Edit.svg') }}" width="12" height="12" class="me-2">Edit</a></li>
                                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat" style="background-color: transparent;" onmouseover="this.style.backgroundColor='transparent'" onmouseout="this.style.backgroundColor='transparent'"><img src="{{ asset('/build/img/Remove.svg') }}" width="16" height="16" class="me-2">Remove</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- F -->
                            <div class="mb-2">
                                <h6 class="mb-1" style="font-size: 14px;">F</h6>
                                <div style="display: flex; align-items: center; justify-content: space-between; background-color: transparent; border: none; border-radius: 14px; padding: 4px 8px; min-height: 36px;" onmouseover="this.style.backgroundColor='rgba(0,0,0,0.05)'" onmouseout="this.style.backgroundColor='transparent'">
                                    <a href="#" style="flex-grow: 1; text-decoration: none; background-color: transparent;">
                                        <p style="font-size: 14px; color:black; margin: 0; line-height: 1.2;">Clyde Smith PW Website</p>
                                    </a>
                                    <div style="margin-left: auto; display: flex; align-items: center;">
                                        <a href="#" data-bs-toggle="dropdown" style="display: flex; align-items: center; justify-content: center; width: 24px; height: 24px;">
                                            <i class="bi bi-three-dots" style="font-size: 16px;"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end p-2" style="background-color: transparent !important; border: none !important; box-shadow: none !important; margin: 0;">
                                            <li><a class="dropdown-item" href="#" style="background-color: transparent;" onmouseover="this.style.backgroundColor='transparent'" onmouseout="this.style.backgroundColor='transparent'"><img src="{{ asset('/build/img/Subjects.svg') }}" width="12" height="12" class="me-2">Play</a></li>
                                            <li><a class="dropdown-item" href="#" style="background-color: transparent;" onmouseover="this.style.backgroundColor='transparent'" onmouseout="this.style.backgroundColor='transparent'"><img src="{{ asset('/build/img/Edit.svg') }}" width="12" height="12" class="me-2">Edit</a></li>
                                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat" style="background-color: transparent;" onmouseover="this.style.backgroundColor='transparent'" onmouseout="this.style.backgroundColor='transparent'"><img src="{{ asset('/build/img/Remove.svg') }}" width="16" height="16" class="me-2">Remove</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>
            <!-- / Chats sidebar -->







            <!-- Profile -->
            <div class="tab-pane fade" id="profile-menu">
                <!-- Profile sidebar -->
                <div class="sidebar-content active slimscroll">
                    <div class="slimscroll">
                        <div class="chat-search-header">
                            <div class="header-title d-flex align-items-center justify-content-between">
                                <h4 class="mb-3">Profile</h4>
                            </div>
                        </div>

                        <!-- Profile -->
                        <div class="profile mx-3">
                            <div class="border-bottom text-center pb-3 mx-1">
                                <div class="d-flex justify-content-center ">
                                    <span class="avatar avatar-xxxl online mb-4">
                                        <img src="{{URL::asset('/build/img/profiles/avatar-16.jpg')}}" class="rounded-circle" alt="user">
                                    </span>
                                </div>
                                <div>
                                    <h6 class="fs-16">Salom Katherine</h6>
                                    <div class="d-flex justify-content-center">
                                        <span class="fs-14 text-center">Web Designer</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Profile -->

                        <div class="sidebar-body chat-body">

                            <!-- Profile Info -->
                            <h5 class="mb-2">Profile Info</h5>
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex profile-list justify-content-between align-items-center border-bottom mb-3 pb-3">
                                        <div>
                                            <h6 class="fs-14">Name</h6>
                                            <p class="fs-16 ">Salom Katherine</p>
                                        </div>
                                        <span><i class="ti ti-user-circle fs-16"></i></span>
                                    </div>
                                    <div class="d-flex profile-list justify-content-between align-items-center border-bottom mb-3 pb-3">
                                        <div>
                                            <h6 class="fs-14">Phone</h6>
                                            <p class="fs-16">514-245-98315</p>
                                        </div>
                                        <span><i class="ti ti-phone-check fs-16"></i></span>
                                    </div>
                                    <div class="d-flex profile-list  profile-list justify-content-between align-items-center border-bottom mb-3 pb-3">
                                        <div>
                                            <h6 class="fs-14">Gender</h6>
                                            <p class="fs-16">Female</p>
                                        </div>
                                        <span><i class="ti ti-user-star fs-16"></i></span>
                                    </div>
                                    <div class="d-flex profile-list justify-content-between align-items-center border-bottom mb-3 pb-3">
                                        <div>
                                            <h6 class="fs-14">Email Address</h6>
                                            <p class="fs-16">info@example.com</p>
                                        </div>
                                        <span><i class="ti ti-mail-heart fs-16"></i></span>
                                    </div>
                                    <div class="d-flex profile-list profile-list justify-content-between align-items-center border-bottom mb-3 pb-3">
                                        <div>
                                            <h6 class="fs-14">Bio</h6>
                                            <p class="fs-16">Web Designer</p>
                                        </div>
                                        <span><i class="ti ti-user-check fs-16"></i></span>
                                    </div>
                                    <div class="d-flex profile-list justify-content-between align-items-center border-bottom mb-3 pb-3">
                                        <div>
                                            <h6 class="fs-14">Location</h6>
                                            <p class="fs-16">Portland, USA</p>
                                        </div>
                                        <span><i class="ti ti-map-2 fs-16"></i></span>
                                    </div>
                                    <div class="d-flex profile-list justify-content-between align-items-center">
                                        <div>
                                            <h6 class="fs-14">Join Date</h6>
                                            <p class="fs-16">01 July 2024</p>
                                        </div>
                                        <span><i class="ti ti-calendar-event fs-16"></i></span>
                                    </div>
                                </div>
                            </div>
                            <!-- /Profile Info -->

                            <!-- Status -->
                            <h5 class="mb-2">Status</h5>
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex profile-list justify-content-between align-items-center border-bottom mb-3 pb-3">
                                        <div>
                                            <h6 class="fs-14">Active Status</h6>
                                            <p class="fs-16 ">Show when you’re active</p>
                                        </div>
                                        <div class="form-check form-switch d-flex justify-content-end align-items-center">
                                            <input class="form-check-input" type="checkbox" role="switch" checked>
                                        </div>
                                    </div>
                                    <div class="d-flex profile-list justify-content-between align-items-center">
                                        <div>
                                            <h6 class="fs-14">Friends Status</h6>
                                            <p class="fs-16 ">Show friends status in chat</p>
                                        </div>
                                        <div class="form-check form-switch d-flex justify-content-end align-items-center">
                                            <input class="form-check-input" type="checkbox" role="switch" checked>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Status -->

                            <!-- Social Media -->
                            <h5 class="mb-2">Social Media</h5>
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex profile-list justify-content-between align-items-center border-bottom mb-3 pb-3">
                                        <div>
                                            <h6 class="fs-14">Facebook</h6>
                                            <p class="fs-16 ">@SalomKatherine</p>
                                        </div>
                                        <span><i class="ti ti-brand-facebook fs-16"></i></span>
                                    </div>
                                    <div class="d-flex profile-list justify-content-between align-items-center border-bottom mb-3 pb-3">
                                        <div>
                                            <h6 class="fs-14">Instagram Linkedin</h6>
                                            <p class="fs-16 ">@SalomKatherine</p>
                                        </div>
                                        <span><i class="ti ti-brand-instagram fs-16"></i></span>
                                    </div>
                                    <div class="d-flex profile-list justify-content-between align-items-center">
                                        <div>
                                            <h6 class="fs-14">Linkedin</h6>
                                            <p class="fs-16 ">@SalomKatherine</p>
                                        </div>
                                        <span><i class="ti ti-brand-linkedin fs-16"></i></span>
                                    </div>
                                </div>
                            </div>
                            <!-- /Social Media -->

                            <!-- Deactivate -->
                            <h5 class="mb-2">Deactivate </h5>
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex profile-list justify-content-between align-items-center">
                                        <div>
                                            <h6 class="fs-14">Deactivate Account</h6>
                                            <p class="fs-16 ">Deactivate your Account</p>
                                        </div>
                                        <div class="form-check form-switch d-flex justify-content-end align-items-center">
                                            <input class="form-check-input" type="checkbox" role="switch">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Deactivate -->

                            <!-- Logout -->
                            <h5 class="mb-2">Logout</h5>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="d-flex profile-list justify-content-between align-items-center">
                                        <div>
                                            <h6 class="fs-14">Logout</h6>
                                            <p class="fs-16 ">Sign out from this Device</p>
                                        </div>
                                        <a href="{{url('signin')}}" class="link-icon"><i class="ti ti-logout fs-16"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!-- /Logout -->

                        </div>

                    </div>

                </div>
                <!-- / Profile sidebar -->
            </div>
            <!-- /Profile -->

            <!-- Calls -->
            <div class="tab-pane fade" id="call-menu">
                <div class="sidebar-content active slimscroll">

                    <div class="slimscroll">

                        <div class="chat-search-header">
                            <div class="header-title d-flex align-items-center justify-content-between">
                                <h4 class="mb-3">Calls</h4>
                                <div class="d-flex align-items-center mb-3">
                                    <a href="#" class="call-icon d-flex justify-content-center align-items-center text-white bg-primary rounded-circle me-2" data-bs-toggle="modal" data-bs-target="#new-call">
                                        <i class="ti ti-phone-plus fs-16"></i>
                                    </a>
                                    <div class="dropdown">
                                        <a href="javascript:void(0);" data-bs-toggle="dropdown" class="fs-16 text-default">
                                            <i class="ti ti-dots-vertical"></i>
                                        </a>
                                        <ul class="dropdown-menu p-3">
                                            <li>
                                                <a href="javascript:;" class="dropdown-item d-flex align-items-center">
                                                    <span><i class="ti ti-phone-x me-2"></i></span>
                                                    Clear Call Log
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Chat Search -->
                            <div class="search-wrap">
                                <form action="#">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search">
                                        <span class="input-group-text"><i class="ti ti-search"></i></span>
                                    </div>
                                </form>
                            </div>
                            <!-- /Chat Search -->
                        </div>

                        <div class="sidebar-body chat-body" id="chatsidebar1">

                            <!-- Left Chat Title -->
                            <div class="d-flex  align-items-center mb-3">
                                <h5 class="chat-title2 me-2">All Calls</h5>
                                <div class="dropdown">
                                    <a href="#" class="text-default fs-16" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-chevron-down"></i></a>
                                    <ul class=" dropdown-menu dropdown-menu-end p-3" id="innerTab1" role="tablist">
                                        <li role="presentation">
                                            <a class="dropdown-item active" id="all-calls-tab" data-bs-toggle="tab" href="#all-calls" role="tab" aria-controls="all-calls" aria-selected="true" onclick="changeChat2('All Calls')">All Calls</a>
                                        </li>
                                        <li role="presentation">
                                            <a class="dropdown-item" id="audio-calls-tab" data-bs-toggle="tab" href="#audio-calls" role="tab" aria-controls="audio-calls" aria-selected="false" onclick="changeChat2('Audio Calls')">Audio Calls</a>
                                        </li>
                                        <li role="presentation">
                                            <a class="dropdown-item" id="video-calls-tab" data-bs-toggle="tab" href="#video-calls" role="tab" aria-controls="video-calls" aria-selected="false" onclick="changeChat2('Video Calls')">Video Calls</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /Left Chat Title -->
                            <div class="tab-content" id="callTabContent">
                                <div class="tab-pane fade show active" id="all-calls" role="tabpanel" aria-labelledby="all-calls-tab">
                                    <div class="chat-users-wrap">
                                        <div class="chat-list">
                                            <a href="{{url('all-calls')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Edward Lietz</h6>
                                                        <p><i class="ti ti-phone-outgoing text-purple me-2"></i>20 Min Ago</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">08m 12s</span>
                                                        <div>
                                                            <i class="ti ti-phone-call text-pink"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('all-calls')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6 class="">Mark Villiams</h6>
                                                        <p class="fs-14">
                                                            <i class="ti ti-phone-incoming me-2 fs-14 text-success"></i>
                                                            20 Min Ago
                                                        </p>
                                                    </div>
                                                    <div class="chat-user ">
                                                        <span class="mb-2">08m 12s</span>
                                                        <div class="d-flex justify-content-end">
                                                            <i class="ti ti-phone-call text-pink"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('all-calls')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-05.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Federico Wells</h6>
                                                        <p><i class="ti ti-video-off text-danger me-2"></i>20 Min Ago</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">08m 12s</span>
                                                        <div>
                                                            <i class="ti ti-video text-pink"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('all-calls')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-03.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Clyde Smith</h6>
                                                        <p><i class="ti ti-phone-outgoing text-purple me-2"></i>20 Min Ago</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">08m 12s</span>
                                                        <div>
                                                            <i class="ti ti-phone-call text-pink"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('all-calls')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-04.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Carla Jenkins</h6>
                                                        <p><i class="ti ti-video text-success me-2"></i>20 Min Ago</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">08m 12s</span>
                                                        <div>
                                                            <i class="ti ti-video text-pink"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('all-calls')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-02.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Sarika Jain</h6>
                                                        <p><i class="ti ti-phone-off text-danger me-2"></i>20 Min Ago</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">08m 12s</span>
                                                        <div>
                                                            <i class="ti ti-phone-call text-pink"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('all-calls')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg bg-purple offline avatar-rounded me-2">
                                                    <span class="avatar-title fs-14 fw-medium">AG</span>
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Amfr_boys_Group</h6>
                                                        <p><i class="ti ti-video-minus text-purple me-2"></i>20 Min Ago</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">08m 12s</span>
                                                        <div>
                                                            <i class="ti ti-video text-pink"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('all-calls')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-10.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Wilbur Martinez</h6>
                                                        <p><i class="ti ti-phone-off text-danger me-2"></i>20 Min Ago</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">08m 12s</span>
                                                        <div>
                                                            <i class="ti ti-phone-call text-pink"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="audio-calls" role="tabpanel" aria-labelledby="audio-calls-tab">
                                    <div class="chat-users-wrap">
                                        <div class="chat-list">
                                            <a href="{{url('all-calls')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Edward Lietz</h6>
                                                        <p><i class="ti ti-phone-outgoing text-purple me-2"></i>20 Min Ago</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">08m 12s</span>
                                                        <div>
                                                            <i class="ti ti-phone-call text-pink"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('all-calls')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6 class="">Mark Villiams</h6>
                                                        <p class="fs-14">
                                                            <i class="ti ti-phone-incoming me-2 fs-14 text-success"></i>
                                                            20 Min Ago
                                                        </p>
                                                    </div>
                                                    <div class="chat-user ">
                                                        <span class="mb-2">08m 12s</span>
                                                        <div class="d-flex justify-content-end">
                                                            <i class="ti ti-phone-call text-pink"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('all-calls')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-05.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Federico Wells</h6>
                                                        <p class="fs-14">
                                                            <i class="ti ti-phone-incoming me-2 fs-14 text-success"></i>
                                                            20 Min Ago
                                                        </p>
                                                    </div>
                                                    <div class="chat-user ">
                                                        <span class="mb-2">08m 12s</span>
                                                        <div class="d-flex justify-content-end">
                                                            <i class="ti ti-phone-call text-pink"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('all-calls')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-03.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Clyde Smith</h6>
                                                        <p><i class="ti ti-phone-outgoing text-purple me-2"></i>20 Min Ago</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">08m 12s</span>
                                                        <div>
                                                            <i class="ti ti-phone-call text-pink"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('all-calls')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-04.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Carla Jenkins</h6>
                                                        <p><i class="ti ti-phone-off text-danger me-2"></i>20 Min Ago</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">08m 12s</span>
                                                        <div>
                                                            <i class="ti ti-phone-call text-pink"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('all-calls')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-02.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Sarika Jain</h6>
                                                        <p><i class="ti ti-phone-off text-danger me-2"></i>20 Min Ago</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">08m 12s</span>
                                                        <div>
                                                            <i class="ti ti-phone-call text-pink"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('all-calls')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg bg-purple avatar-rounded me-2">
                                                    <span class="avatar-title fs-14 fw-medium">AG</span>
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Amfr_boys_Group</h6>
                                                        <p class="fs-14">
                                                            <i class="ti ti-phone-incoming me-2 fs-14 text-success"></i>
                                                            20 Min Ago
                                                        </p>
                                                    </div>
                                                    <div class="chat-user ">
                                                        <span class="mb-2">08m 12s</span>
                                                        <div class="d-flex justify-content-end">
                                                            <i class="ti ti-phone-call text-pink"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('all-calls')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-10.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Wilbur Martinez</h6>
                                                        <p><i class="ti ti-phone-off text-danger me-2"></i>20 Min Ago</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">08m 12s</span>
                                                        <div>
                                                            <i class="ti ti-phone-call text-pink"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="video-calls" role="tabpanel" aria-labelledby="video-calls-tab">
                                    <div class="chat-users-wrap">
                                        <div class="chat-list">
                                            <a href="{{url('all-calls')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Edward Lietz</h6>
                                                        <p><i class="ti ti-video text-success me-2"></i>20 Min Ago</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">08m 12s</span>
                                                        <div>
                                                            <i class="ti ti-video text-pink"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('all-calls')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6 class="">Mark Villiams</h6>
                                                        <p><i class="ti ti-video-off text-danger me-2"></i>20 Min Ago</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">08m 12s</span>
                                                        <div>
                                                            <i class="ti ti-video text-pink"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('all-calls')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-05.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Federico Wells</h6>
                                                        <p><i class="ti ti-video-off text-danger me-2"></i>20 Min Ago</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">08m 12s</span>
                                                        <div>
                                                            <i class="ti ti-video text-pink"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('all-calls')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-03.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Clyde Smith</h6>
                                                        <p><i class="ti ti-video-minus text-purple me-2"></i>20 Min Ago</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">08m 12s</span>
                                                        <div>
                                                            <i class="ti ti-video text-pink"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('all-calls')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-04.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Carla Jenkins</h6>
                                                        <p><i class="ti ti-video text-success me-2"></i>20 Min Ago</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">08m 12s</span>
                                                        <div>
                                                            <i class="ti ti-video text-pink"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('all-calls')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-02.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Sarika Jain</h6>
                                                        <p><i class="ti ti-video-minus text-purple me-2"></i>20 Min Ago</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">08m 12s</span>
                                                        <div>
                                                            <i class="ti ti-video text-pink"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('all-calls')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg bg-purple avatar-rounded me-2">
                                                    <span class="avatar-title fs-14 fw-medium">AG</span>
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Amfr_boys_Group</h6>
                                                        <p><i class="ti ti-video-off text-danger me-2"></i>20 Min Ago</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">08m 12s</span>
                                                        <div>
                                                            <i class="ti ti-video text-pink"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="chat-list">
                                            <a href="{{url('all-calls')}}" class="chat-user-list">
                                                <div class="avatar avatar-lg online me-2">
                                                    <img src="{{URL::asset('/build/img/profiles/avatar-10.jpg')}}" class="rounded-circle" alt="image">
                                                </div>
                                                <div class="chat-user-info">
                                                    <div class="chat-user-msg">
                                                        <h6>Wilbur Martinez</h6>
                                                        <p><i class="ti ti-video-minus text-purple me-2"></i>20 Min Ago</p>
                                                    </div>
                                                    <div class="chat-user-time">
                                                        <span class="time">08m 12s</span>
                                                        <div>
                                                            <i class="ti ti-video text-pink"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <!-- /Calls -->



        </div>
    </div>
    <!-- /Sidebar group -->

    <!-- Chat -->





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
@component('components.model-popup')
@endcomponent
@endsection