<?php $page = 'group'; ?>
@extends('layout.mainlayout_admin')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        @component('admin.components.breadcrumb_admin')
        @slot('title')
        Group
        @endslot
        @slot('li_1')
           index_admin
        @endslot
        @slot('li_2')
        Group
        @endslot
    @endcomponent
         <!-- User List -->
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between flex-wrap pb-0">
                    <h6 class="mb-3">Group List<span>200</span> </h6>
                    <div class="d-flex align-items-center flex-wrap">
                        <div class="input-icon-start mb-3 me-2 position-relative">
                            <span class="icon-addon">
                                <i class="ti ti-calendar"></i>
                            </span>
                            <input type="text" class="form-control date-range bookingrange" placeholder="Select"
                            value="dd/mm/yyyy - dd/mm/yyyy ">
                        </div>
                        
                        <div class="dropdown mb-3 me-2">
                            <div>
                                <select class="select">
                                    <option>Select Group</option>
                                    <option>The Dream Team</option>
                                    <option>The Meme Team</option>
                                    <option>Tech Talk Tribe</option>
                                    <option>Game Changers</option>
                                </select>
                            </div>
                        </div>
                        <div class="dropdown mb-3">
                            <a href="javascript:void(0);" class="btn btn-white border  dropdown-toggle"
                                data-bs-toggle="dropdown"><i class="ti ti-sort-ascending-2 me-2"></i>Sort By : Last 7 Days
                            </a>
                            <ul class="dropdown-menu p-3">
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item rounded-1 active">
                                        Ascending
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">
                                        Descending
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">
                                        Recently Viewed
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">
                                        Recently Added
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Group List -->
                <div class="card-body p-0">
                    <div class="custom-datatable-filter table-responsive">
                        <table class="table datatable">
                            <thead class="thead-light">
                                <tr>
                                    <th class="no-sort">
                                        <div class="form-check form-check-md">
                                            <input class="form-check-input" type="checkbox" id="select-all">
                                        </div>
                                    </th>
                                    <th>Group Name</th>
                                    <th>Group Description</th>
                                    <th>Members</th>
                                    <th>Total Chat Count</th>
                                    <th>Created Date </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-md">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="avatar avatar-md"><img
                                                    src="{{URL::asset('assets/img/group-chat/group-01.jpg')}}"
                                                    class="img-fluid rounded-circle" alt="img"></a>
                                            <div class="ms-2 profile-name">
                                                <p class="text-dark mb-0"><a href="#">The Dream Team</a></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Design enthusiasts unite! Share, learn, and create together!</td>
                                    <td>
                                        <div class="avatar-list-stacked avatar-group-sm">
                                        <span class="avatar border-0">
                                            <img src="{{URL::asset('assets/img/users/user-01.jpg')}}" class="rounded-circle"
                                                alt="img">
                                        </span>
                                        <span class="avatar border-0">
                                            <img src="{{URL::asset('assets/img/users/user-02.jpg')}}" class="rounded-circle"
                                                alt="img">
                                        </span>
                                        <span class="avatar border-0">
                                            <img src="{{URL::asset('assets/img/users/user-03.jpg')}}" class="rounded-circle"
                                                alt="img">
                                        </span>
                                        <span class="avatar border-0">
                                            <img src="{{URL::asset('assets/img/users/user-04.jpg')}}" class="rounded-circle"
                                                alt="img">
                                        </span>
                                        <span class="avatar border-0">
                                            <img src="{{URL::asset('assets/img/users/user-05.jpg')}}" class="rounded-circle"
                                                alt="img">
                                        </span>
                                        <span class="avatar group-counts bg-primary rounded-circle border-0 fs-10">
                                            35+
                                        </span>
                                        </div>
                                    </td>
                                    <td>105</td>
                                    <td>02 Sep 2024, 10:00 AM</td>
                                    <td>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#delete-modal"><span class="file-icon"><i class="ti ti-trash"></i></span></a>
                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-md">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="avatar avatar-md"><img
                                                    src="{{URL::asset('assets/img/group-chat/group-02.jpg')}}"
                                                    class="img-fluid rounded-circle" alt="img"></a>
                                            <div class="ms-2 profile-name">
                                                <p class="text-dark mb-0"><a href="#">The Meme Team</a></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Welcome to the Meme Team! Share and enjoy memes!</td>
                                    <td>
                                        <div class="avatar-list-stacked avatar-group-sm">
                                        <span class="avatar border-0">
                                            <img src="{{URL::asset('assets/img/users/user-06.jpg')}}" class="rounded-circle"
                                                alt="img">
                                        </span>
                                        <span class="avatar border-0">
                                            <img src="{{URL::asset('assets/img/users/user-07.jpg')}}" class="rounded-circle"
                                                alt="img">
                                        </span>
                                        <span class="avatar border-0">
                                            <img src="{{URL::asset('assets/img/users/user-08.jpg')}}" class="rounded-circle"
                                                alt="img">
                                        </span>
                                        <span class="avatar border-0">
                                            <img src="{{URL::asset('assets/img/users/user-09.jpg')}}" class="rounded-circle"
                                                alt="img">
                                        </span>
                                        <span class="avatar border-0">
                                            <img src="{{URL::asset('assets/img/users/user-10.jpg')}}" class="rounded-circle"
                                                alt="img">
                                        </span>
                                        <span class="avatar group-counts bg-primary rounded-circle border-0 fs-10">
                                            40+
                                        </span>
                                        </div>
                                    </td>
                                    <td>120</td>
                                    <td>14 Sep 2024, 11:30 AM</td>
                                    <td>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#delete-modal"><span class="file-icon"><i class="ti ti-trash"></i></span></a>
                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-md">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="avatar avatar-md"><img
                                                    src="{{URL::asset('assets/img/group-chat/group-03.jpg')}}"
                                                    class="img-fluid rounded-circle" alt="img"></a>
                                            <div class="ms-2 profile-name">
                                                <p class="text-dark mb-0"><a href="#">Tech Talk Tribe</a></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Share insights, ask questions, and explore new trends!</td>
                                    <td>
                                        <div class="avatar-list-stacked avatar-group-sm">
                                        <span class="avatar border-0">
                                            <img src="{{URL::asset('assets/img/users/user-03.jpg')}}" class="rounded-circle"
                                                alt="img">
                                        </span>
                                        <span class="avatar border-0">
                                            <img src="{{URL::asset('assets/img/users/user-02.jpg')}}" class="rounded-circle"
                                                alt="img">
                                        </span>
                                        <span class="avatar border-0">
                                            <img src="{{URL::asset('assets/img/users/user-01.jpg')}}" class="rounded-circle"
                                                alt="img">
                                        </span>
                                        <span class="avatar border-0">
                                            <img src="{{URL::asset('assets/img/users/user-08.jpg')}}" class="rounded-circle"
                                                alt="img">
                                        </span>
                                        <span class="avatar border-0">
                                            <img src="{{URL::asset('assets/img/users/user-05.jpg')}}" class="rounded-circle"
                                                alt="img">
                                        </span>
                                        <span class="avatar group-counts bg-primary rounded-circle border-0 fs-10">
                                            20+
                                        </span>
                                        </div>
                                    </td>
                                    <td>200</td>
                                    <td>28 Sep 2024, 08:15 AM</td>
                                    <td>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#delete-modal"><span class="file-icon"><i class="ti ti-trash"></i></span></a>
                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-md">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="avatar avatar-md"><img
                                                    src="{{URL::asset('assets/img/group-chat/group-04.jpg')}}"
                                                    class="img-fluid rounded-circle" alt="img"></a>
                                            <div class="ms-2 profile-name">
                                                <p class="text-dark mb-0"><a href="#">Game Changers</a></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Game on! Share tips, play together, and have fun!</td>
                                    <td>
                                        <div class="avatar-list-stacked avatar-group-sm">
                                        <span class="avatar border-0">
                                            <img src="{{URL::asset('assets/img/users/user-04.jpg')}}" class="rounded-circle"
                                                alt="img">
                                        </span>
                                        <span class="avatar border-0">
                                            <img src="{{URL::asset('assets/img/users/user-09.jpg')}}" class="rounded-circle"
                                                alt="img">
                                        </span>
                                        <span class="avatar border-0">
                                            <img src="{{URL::asset('assets/img/users/user-06.jpg')}}" class="rounded-circle"
                                                alt="img">
                                        </span>
                                        <span class="avatar border-0">
                                            <img src="{{URL::asset('assets/img/users/user-01.jpg')}}" class="rounded-circle"
                                                alt="img">
                                        </span>
                                        <span class="avatar border-0">
                                            <img src="{{URL::asset('assets/img/users/user-02.jpg')}}" class="rounded-circle"
                                                alt="img">
                                        </span>
                                        <span class="avatar group-counts bg-primary rounded-circle border-0 fs-10">
                                            15+
                                        </span>
                                        </div>
                                    </td>
                                    <td>250</td>
                                    <td>12 Oct 2024, 06:40 PM</td>
                                    <td>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#delete-modal"><span class="file-icon"><i class="ti ti-trash"></i></span></a>
                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-md">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="avatar avatar-md"><img
                                                    src="{{URL::asset('assets/img/group-chat/group-05.jpg')}}"
                                                    class="img-fluid rounded-circle" alt="img"></a>
                                            <div class="ms-2 profile-name">
                                                <p class="text-dark mb-0"><a href="#">The Chill Zone</a></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Chill vibes only! Relax, chat, and unwind.</td>
                                    <td>
                                        <div class="avatar-list-stacked avatar-group-sm">
                                        <span class="avatar border-0">
                                            <img src="{{URL::asset('assets/img/users/user-01.jpg')}}" class="rounded-circle"
                                                alt="img">
                                        </span>
                                        <span class="avatar border-0">
                                            <img src="{{URL::asset('assets/img/users/user-02.jpg')}}" class="rounded-circle"
                                                alt="img">
                                        </span>
                                        <span class="avatar border-0">
                                            <img src="{{URL::asset('assets/img/users/user-03.jpg')}}" class="rounded-circle"
                                                alt="img">
                                        </span>
                                        <span class="avatar border-0">
                                            <img src="{{URL::asset('assets/img/users/user-04.jpg')}}" class="rounded-circle"
                                                alt="img">
                                        </span>
                                        <span class="avatar border-0">
                                            <img src="{{URL::asset('assets/img/users/user-09.jpg')}}" class="rounded-circle"
                                                alt="img">
                                        </span>
                                        <span class="avatar group-counts bg-primary rounded-circle border-0 fs-10">
                                            30+
                                        </span>
                                        </div>
                                    </td>
                                    <td>300</td>
                                    <td>20 Oct 2024, 04:18 PM</td>
                                    <td>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#delete-modal"><span class="file-icon"><i class="ti ti-trash"></i></span></a>
                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-md">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="avatar avatar-md"><img
                                                    src="{{URL::asset('assets/img/group-chat/group-06.jpg')}}"
                                                    class="img-fluid rounded-circle" alt="img"></a>
                                            <div class="ms-2 profile-name">
                                                <p class="text-dark mb-0"><a href="#">Squad Goals</a></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Squad goals! Connect, plan, and have a blast together.</td>
                                    <td>
                                        <div class="avatar-list-stacked avatar-group-sm">
                                        <span class="avatar border-0">
                                            <img src="{{URL::asset('assets/img/users/user-05.jpg')}}" class="rounded-circle"
                                                alt="img">
                                        </span>
                                        <span class="avatar border-0">
                                            <img src="{{URL::asset('assets/img/users/user-08.jpg')}}" class="rounded-circle"
                                                alt="img">
                                        </span>
                                        <span class="avatar border-0">
                                            <img src="{{URL::asset('assets/img/users/user-06.jpg')}}" class="rounded-circle"
                                                alt="img">
                                        </span>
                                        <span class="avatar border-0">
                                            <img src="{{URL::asset('assets/img/users/user-10.jpg')}}" class="rounded-circle"
                                                alt="img">
                                        </span>
                                        <span class="avatar border-0">
                                            <img src="{{URL::asset('assets/img/users/user-04.jpg')}}" class="rounded-circle"
                                                alt="img">
                                        </span>
                                        <span class="avatar group-counts bg-primary rounded-circle border-0 fs-10">
                                            25+
                                        </span>
                                        </div>
                                    </td>
                                    <td>180</td>
                                    <td>30 Oct 2024, 07:25 AM</td>
                                    <td>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#delete-modal"><span class="file-icon"><i class="ti ti-trash"></i></span></a>
                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-md">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="avatar avatar-md"><img
                                                    src="{{URL::asset('assets/img/group-chat/group-07.jpg')}}	"
                                                    class="img-fluid rounded-circle" alt="img"></a>
                                            <div class="ms-2 profile-name">
                                                <p class="text-dark mb-0"><a href="#">Scholars Society</a></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Share knowledge, discuss ideas, and support each other.</td>
                                    <td>
                                        <div class="avatar-list-stacked avatar-group-sm">
                                        <span class="avatar border-0">
                                            <img src="{{URL::asset('assets/img/users/user-01.jpg')}}" class="rounded-circle"
                                                alt="img">
                                        </span>
                                        <span class="avatar border-0">
                                            <img src="{{URL::asset('assets/img/users/user-02.jpg')}}" class="rounded-circle"
                                                alt="img">
                                        </span>
                                        <span class="avatar border-0">
                                            <img src="{{URL::asset('assets/img/users/user-03.jpg')}}" class="rounded-circle"
                                                alt="img">
                                        </span>
                                        <span class="avatar border-0">
                                            <img src="{{URL::asset('assets/img/users/user-04.jpg')}}" class="rounded-circle"
                                                alt="img">
                                        </span>
                                        <span class="avatar border-0">
                                            <img src="{{URL::asset('assets/img/users/user-05.jpg')}}" class="rounded-circle"
                                                alt="img">
                                        </span>
                                        <span class="avatar group-counts bg-primary rounded-circle border-0 fs-10">
                                            28+
                                        </span>
                                        </div>
                                    </td>
                                    <td>200</td>
                                    <td>01 Nov 2024, 08:50 AM</td>
                                    <td>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#delete-modal"><span class="file-icon"><i class="ti ti-trash"></i></span></a>
                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-md">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="avatar avatar-md"><img
                                                    src="{{URL::asset('assets/img/group-chat/group-08.jpg')}}"
                                                    class="img-fluid rounded-circle" alt="img"></a>
                                            <div class="ms-2 profile-name">
                                                <p class="text-dark mb-0"><a href="#">Travel Tribe</a></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>"Explore together! Share travel tips, stories, and adventures"</td>
                                    <td>
                                        <div class="avatar-list-stacked avatar-group-sm">
                                        <span class="avatar border-0">
                                            <img src="{{URL::asset('assets/img/users/user-03.jpg')}}" class="rounded-circle"
                                                alt="img">
                                        </span>
                                        <span class="avatar border-0">
                                            <img src="{{URL::asset('assets/img/users/user-08.jpg')}}" class="rounded-circle"
                                                alt="img">
                                        </span>
                                        <span class="avatar border-0">
                                            <img src="{{URL::asset('assets/img/users/user-01.jpg')}}" class="rounded-circle"
                                                alt="img">
                                        </span>
                                        <span class="avatar border-0">
                                            <img src="{{URL::asset('assets/img/users/user-04.jpg')}}" class="rounded-circle"
                                                alt="img">
                                        </span>
                                        <span class="avatar border-0">
                                            <img src="{{URL::asset('assets/img/users/user-03.jpg')}}" class="rounded-circle"
                                                alt="img">
                                        </span>
                                        <span class="avatar group-counts bg-primary rounded-circle border-0 fs-10">
                                            35+
                                        </span>
                                        </div>
                                    </td>
                                    <td>320</td>
                                    <td>10 Nov 2024, 11:20 AM</td>
                                    <td>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#delete-modal"><span class="file-icon"><i class="ti ti-trash"></i></span></a>
                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-md">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="avatar avatar-md"><img
                                                    src="{{URL::asset('assets/img/group-chat/group-09.jpg')}}"
                                                    class="img-fluid rounded-circle" alt="img"></a>
                                            <div class="ms-2 profile-name">
                                                <p class="text-dark mb-0"><a href="#">Fitness Fanatics</a></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Get fit together! Share workouts, tips, and motivation.</td>
                                    <td>
                                        <div class="avatar-list-stacked avatar-group-sm">
                                        <span class="avatar border-0">
                                            <img src="{{URL::asset('assets/img/users/user-01.jpg')}}" class="rounded-circle"
                                                alt="img">
                                        </span>
                                        <span class="avatar border-0">
                                            <img src="{{URL::asset('assets/img/users/user-02.jpg')}}" class="rounded-circle"
                                                alt="img">
                                        </span>
                                        <span class="avatar border-0">
                                            <img src="{{URL::asset('assets/img/users/user-03.jpg')}}" class="rounded-circle"
                                                alt="img">
                                        </span>
                                        <span class="avatar border-0">
                                            <img src="{{URL::asset('assets/img/users/user-09.jpg')}}" class="rounded-circle"
                                                alt="img">
                                        </span>
                                        <span class="avatar border-0">
                                            <img src="{{URL::asset('assets/img/users/user-07.jpg')}}" class="rounded-circle"
                                                alt="img">
                                        </span>
                                        <span class="avatar group-counts bg-primary rounded-circle border-0 fs-10">
                                            40+
                                        </span>
                                        </div>
                                    </td>
                                    <td>400</td>
                                    <td>17 Nov 2024, 04:50 PM</td>
                                    <td>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#delete-modal"><span class="file-icon"><i class="ti ti-trash"></i></span></a>
                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-md">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="avatar avatar-md"><img
                                                    src="{{URL::asset('assets/img/group-chat/group-10.jpg')}}"
                                                    class="img-fluid rounded-circle" alt="img"></a>
                                            <div class="ms-2 profile-name">
                                                <p class="text-dark mb-0"><a href="#">Movie Buffs</a></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Movie buffs unite! Discuss, review, and enjoy films together.</td>
                                    <td>
                                        <div class="avatar-list-stacked avatar-group-sm">
                                        <span class="avatar border-0">
                                            <img src="{{URL::asset('assets/img/users/user-05.jpg')}}" class="rounded-circle"
                                                alt="img">
                                        </span>
                                        <span class="avatar border-0">
                                            <img src="{{URL::asset('assets/img/users/user-02.jpg')}}" class="rounded-circle"
                                                alt="img">
                                        </span>
                                        <span class="avatar border-0">
                                            <img src="{{URL::asset('assets/img/users/user-03.jpg')}}" class="rounded-circle"
                                                alt="img">
                                        </span>
                                        <span class="avatar border-0">
                                            <img src="{{URL::asset('assets/img/users/user-09.jpg')}}" class="rounded-circle"
                                                alt="img">
                                        </span>
                                        <span class="avatar border-0">
                                            <img src="{{URL::asset('assets/img/users/user-07.jpg')}}" class="rounded-circle"
                                                alt="img">
                                        </span>
                                        <span class="avatar group-counts bg-primary rounded-circle border-0 fs-10">
                                            50+
                                        </span>
                                        </div>
                                    </td>
                                    <td>210</td>
                                    <td>12 Dec 2024, 09:30 AM</td>
                                    <td>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#delete-modal"><span class="file-icon"><i class="ti ti-trash"></i></span></a>
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /Cities List -->
                </div>
            </div>
             <!-- /Group List -->

        </div>
    </div>
    <!-- /Page Wrapper -->	
    @component('admin.components.model-popup_admin')
    @endcomponent
    @component('admin.components.themesettings')
    @endcomponent
    @endsection