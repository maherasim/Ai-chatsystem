<?php $page = 'report-user'; ?>
@extends('layout.mainlayout_admin')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        @component('admin.components.breadcrumb_admin')
        @slot('title')
        Report Users
        @endslot
        @slot('li_1')
        index_admin
        @endslot
        @slot('li_3')
        Users
        @endslot
        @slot('li_2')
        Report Users
        @endslot
    @endcomponent
<!-- Page Wrapper -->

        <!-- User List -->
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between flex-wrap pb-0">
                <h6 class="mb-3">Report Users List<span>200</span> </h6>
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
                                <option>Select Country</option>
                                <option>Los Angeles</option>
                                <option>New York</option>
                                <option>Texas</option>
                                <option>Bavaria</option>
                            </select>
                        </div>
                    </div>
                    <div class="dropdown mb-3 me-2">
                        <div>
                            <select class="select">
                                <option>Select User</option>
                                <option>Aaryian Jose</option>
                                <option>Sarika Jain</option>
                                <option>Clyde Smith</option>
                                <option>Carla Jenkins</option>
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

            <!-- Report-User List -->
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
                                <th>Name</th>
                                <th>Email Address</th>
                                <th>Phone Number</th>
                                <th>Report  Date</th>
                                <th>Reported By </th>
                                <th>Reason </th>
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
                                                src="{{URL::asset('assets/img/users/user-01.jpg')}}"
                                                class="img-fluid rounded-circle" alt="img"></a>
                                        <div class="ms-2 profile-name">
                                            <p class="text-dark mb-0"><a href="#">Aaryian Jose</a></p>
                                        </div>
                                    </div>
                                </td>
                                <td>aaryian@example.com</td>
                                <td>514-245-98315</td>
                                <td>02 Sep 2024, 10:00 AM</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a href="javascript:void(0);" class="avatar avatar-md"><img
                                                src="{{URL::asset('assets/img/users/user-01.jpg')}}"
                                                class="img-fluid rounded-circle" alt="img"></a>
                                        <div class="ms-2 profile-name">
                                            <p class="text-dark mb-0"><a href="#">Aaryian Jose</a></p>
                                        </div>
                                    </div>
                                </td>
                                <td><a href="#" data-bs-toggle="modal" data-bs-target="#report_reason"><span class="file-icon"><i class="ti ti-file-text"></i></span></a></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="dropdown">
                                            <a href="#"
                                                class="btn btn-white btn-icon btn-sm d-flex align-items-center justify-content-center rounded-circle p-0"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ti ti-dots-vertical fs-14"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-right p-3">
                                                <li>
                                                    <a class="dropdown-item rounded-1" href="#"
                                                        data-bs-toggle="modal" data-bs-target="#delete-modal"><i
                                                            class="ti ti-trash me-2"></i>Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
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
                                                src="{{URL::asset('assets/img/users/user-02.jpg')}}"
                                                class="img-fluid rounded-circle" alt="img"></a>
                                        <div class="ms-2 profile-name">
                                            <p class="text-dark mb-0"><a href="#">Sarika Jain</a></p>
                                        </div>
                                    </div>
                                </td>
                                <td>sarika@example.com</td>
                                <td>156-348-85496</td>
                                <td>14 Sep 2024, 11:30 AM</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a href="javascript:void(0);" class="avatar avatar-md"><img
                                                src="{{URL::asset('assets/img/users/user-02.jpg')}}"
                                                class="img-fluid rounded-circle" alt="img"></a>
                                        <div class="ms-2 profile-name">
                                            <p class="text-dark mb-0"><a href="#">Sarika Jain</a></p>
                                        </div>
                                    </div>
                                </td>
                                <td><a href="#" data-bs-toggle="modal" data-bs-target="#report_reason"><span class="file-icon"><i class="ti ti-file-text"></i></span></a></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="dropdown">
                                            <a href="#"
                                                class="btn btn-white btn-icon btn-sm d-flex align-items-center justify-content-center rounded-circle p-0"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ti ti-dots-vertical fs-14"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-right p-3">
                                                <li>
                                                    <a class="dropdown-item rounded-1" href="#"
                                                        data-bs-toggle="modal" data-bs-target="#delete-modal"><i
                                                            class="ti ti-trash me-2"></i>Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
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
                                                src="{{URL::asset('assets/img/users/user-03.jpg')}}"
                                                class="img-fluid rounded-circle" alt="img"></a>
                                        <div class="ms-2 profile-name">
                                            <p class="text-dark mb-0"><a href="#">Clyde Smith</a></p>
                                        </div>
                                    </div>
                                </td>
                                <td>clyde@example.com</td>
                                <td>315-975-31849</td>
                                <td>28 Sep 2024, 08:15 AM</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a href="javascript:void(0);" class="avatar avatar-md"><img
                                                src="{{URL::asset('assets/img/users/user-03.jpg')}}"
                                                class="img-fluid rounded-circle" alt="img"></a>
                                        <div class="ms-2 profile-name">
                                            <p class="text-dark mb-0"><a href="#">Clyde Smith</a></p>
                                        </div>
                                    </div>
                                </td>
                                <td><a href="#" data-bs-toggle="modal" data-bs-target="#report_reason"><span class="file-icon"><i class="ti ti-file-text"></i></span></a></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="dropdown">
                                            <a href="#"
                                                class="btn btn-white btn-icon btn-sm d-flex align-items-center justify-content-center rounded-circle p-0"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ti ti-dots-vertical fs-14"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-right p-3">
                                                <li>
                                                    <a class="dropdown-item rounded-1" href="#"
                                                        data-bs-toggle="modal" data-bs-target="#delete-modal"><i
                                                            class="ti ti-trash me-2"></i>Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
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
                                                src="{{URL::asset('assets/img/users/user-04.jpg')}}"
                                                class="img-fluid rounded-circle" alt="img"></a>
                                        <div class="ms-2 profile-name">
                                            <p class="text-dark mb-0"><a href="#">Carla Jenkins</a></p>
                                        </div>
                                    </div>
                                </td>
                                <td>carla@example.com</td>
                                <td>325-859-20194</td>
                                <td>12 Oct 2024, 06:40 PM</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a href="javascript:void(0);" class="avatar avatar-md"><img
                                                src="{{URL::asset('assets/img/users/user-04.jpg')}}"
                                                class="img-fluid rounded-circle" alt="img"></a>
                                        <div class="ms-2 profile-name">
                                            <p class="text-dark mb-0"><a href="#">Carla Jenkins</a></p>
                                        </div>
                                    </div>
                                </td>
                                <td><a href="#" data-bs-toggle="modal" data-bs-target="#report_reason"><span class="file-icon"><i class="ti ti-file-text"></i></span></a></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="dropdown">
                                            <a href="#"
                                                class="btn btn-white btn-icon btn-sm d-flex align-items-center justify-content-center rounded-circle p-0"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ti ti-dots-vertical fs-14"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-right p-3">
                                                <li>
                                                    <a class="dropdown-item rounded-1" href="#"
                                                        data-bs-toggle="modal" data-bs-target="#delete-modal"><i
                                                            class="ti ti-trash me-2"></i>Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
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
                                                src="{{URL::asset('assets/img/users/user-05.jpg')}}"
                                                class="img-fluid rounded-circle" alt="img"></a>
                                        <div class="ms-2 profile-name">
                                            <p class="text-dark mb-0"><a href="#">Federico Wells</a></p>
                                        </div>
                                    </div>
                                </td>
                                <td>federico@example.com</td>
                                <td>314-829-30175</td>
                                <td>20 Oct 2024, 04:18 PM</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a href="javascript:void(0);" class="avatar avatar-md"><img
                                                src="{{URL::asset('assets/img/users/user-05.jpg')}}"
                                                class="img-fluid rounded-circle" alt="img"></a>
                                        <div class="ms-2 profile-name">
                                            <p class="text-dark mb-0"><a href="#">Federico Wells</a></p>
                                        </div>
                                    </div>
                                </td>
                                <td><a href="#" data-bs-toggle="modal" data-bs-target="#report_reason"><span class="file-icon"><i class="ti ti-file-text"></i></span></a></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="dropdown">
                                            <a href="#"
                                                class="btn btn-white btn-icon btn-sm d-flex align-items-center justify-content-center rounded-circle p-0"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ti ti-dots-vertical fs-14"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-right p-3">
                                                <li>
                                                    <a class="dropdown-item rounded-1" href="#"
                                                        data-bs-toggle="modal" data-bs-target="#delete-modal"><i
                                                            class="ti ti-trash me-2"></i>Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
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
                                                src="{{URL::asset('assets/img/users/user-06.jpg')}}"
                                                class="img-fluid rounded-circle" alt="img"></a>
                                        <div class="ms-2 profile-name">
                                            <p class="text-dark mb-0"><a href="#">Edward Lietz</a></p>
                                        </div>
                                    </div>
                                </td>
                                <td>edward@example.com</td>
                                <td>219-831-49521</td>
                                <td>30 Oct 2024, 07:25 AM</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a href="javascript:void(0);" class="avatar avatar-md"><img
                                                src="{{URL::asset('assets/img/users/user-06.jpg')}}"
                                                class="img-fluid rounded-circle" alt="img"></a>
                                        <div class="ms-2 profile-name">
                                            <p class="text-dark mb-0"><a href="#">Edward Lietz</a></p>
                                        </div>
                                    </div>
                                </td>
                                <td><a href="#" data-bs-toggle="modal" data-bs-target="#report_reason"><span class="file-icon"><i class="ti ti-file-text"></i></span></a></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="dropdown">
                                            <a href="#"
                                                class="btn btn-white btn-icon btn-sm d-flex align-items-center justify-content-center rounded-circle p-0"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ti ti-dots-vertical fs-14"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-right p-3">
                                                <li>
                                                    <a class="dropdown-item rounded-1" href="#"
                                                        data-bs-toggle="modal" data-bs-target="#delete-modal"><i
                                                            class="ti ti-trash me-2"></i>Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
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
                                                src="{{URL::asset('assets/img/users/user-07.jpg')}}"
                                                class="img-fluid rounded-circle" alt="img"></a>
                                        <div class="ms-2 profile-name">
                                            <p class="text-dark mb-0"><a href="#">Sharon Ford</a></p>
                                        </div>
                                    </div>
                                </td>
                                <td>sharon@example.com</td>
                                <td>198-301-75341</td>
                                <td>01 Nov 2024, 08:50 AM</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a href="javascript:void(0);" class="avatar avatar-md"><img
                                                src="{{URL::asset('assets/img/users/user-07.jpg')}}"
                                                class="img-fluid rounded-circle" alt="img"></a>
                                        <div class="ms-2 profile-name">
                                            <p class="text-dark mb-0"><a href="#">Sharon Ford</a></p>
                                        </div>
                                    </div>
                                </td>
                                <td><a href="#" data-bs-toggle="modal" data-bs-target="#report_reason"><span class="file-icon"><i class="ti ti-file-text"></i></span></a></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="dropdown">
                                            <a href="#"
                                                class="btn btn-white btn-icon btn-sm d-flex align-items-center justify-content-center rounded-circle p-0"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ti ti-dots-vertical fs-14"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-right p-3">
                                                <li>
                                                    <a class="dropdown-item rounded-1" href="#"
                                                        data-bs-toggle="modal" data-bs-target="#delete-modal"><i
                                                            class="ti ti-trash me-2"></i>Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
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
                                                src="{{URL::asset('assets/img/users/user-08.jpg')}}"
                                                class="img-fluid rounded-circle" alt="img"></a>
                                        <div class="ms-2 profile-name">
                                            <p class="text-dark mb-0"><a href="#">Thomas Rethman</a></p>
                                        </div>
                                    </div>
                                </td>
                                <td>thomas@example.com</td>
                                <td>301-978-30986</td>
                                <td>10 Nov 2024, 11:20 AM</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a href="javascript:void(0);" class="avatar avatar-md"><img
                                                src="{{URL::asset('assets/img/users/user-08.jpg')}}"
                                                class="img-fluid rounded-circle" alt="img"></a>
                                        <div class="ms-2 profile-name">
                                            <p class="text-dark mb-0"><a href="#">Thomas Rethman</a></p>
                                        </div>
                                    </div>
                                </td>
                                <td><a href="#" data-bs-toggle="modal" data-bs-target="#report_reason"><span class="file-icon"><i class="ti ti-file-text"></i></span></a></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="dropdown">
                                            <a href="#"
                                                class="btn btn-white btn-icon btn-sm d-flex align-items-center justify-content-center rounded-circle p-0"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ti ti-dots-vertical fs-14"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-right p-3">
                                                <li>
                                                    <a class="dropdown-item rounded-1" href="#"
                                                        data-bs-toggle="modal" data-bs-target="#delete-modal"><i
                                                            class="ti ti-trash me-2"></i>Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
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
                                                src="{{URL::asset('assets/img/users/user-09.jpg')}}"
                                                class="img-fluid rounded-circle" alt="img"></a>
                                        <div class="ms-2 profile-name">
                                            <p class="text-dark mb-0"><a href="#">Wilbur Martinez</a></p>
                                        </div>
                                    </div>
                                </td>
                                <td>wilbur@example.com</td>
                                <td>383-248-34968</td>
                                <td>17 Nov 2024, 04:50 PM</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a href="javascript:void(0);" class="avatar avatar-md"><img
                                                src="{{URL::asset('assets/img/users/user-09.jpg')}}"
                                                class="img-fluid rounded-circle" alt="img"></a>
                                        <div class="ms-2 profile-name">
                                            <p class="text-dark mb-0"><a href="#">Wilbur Martinez</a></p>
                                        </div>
                                    </div>
                                </td>
                                <td><a href="#" data-bs-toggle="modal" data-bs-target="#report_reason"><span class="file-icon"><i class="ti ti-file-text"></i></span></a></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="dropdown">
                                            <a href="#"
                                                class="btn btn-white btn-icon btn-sm d-flex align-items-center justify-content-center rounded-circle p-0"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ti ti-dots-vertical fs-14"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-right p-3">
                                                <li>
                                                    <a class="dropdown-item rounded-1" href="#"
                                                        data-bs-toggle="modal" data-bs-target="#delete-modal"><i
                                                            class="ti ti-trash me-2"></i>Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
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
                                                src="{{URL::asset('assets/img/users/user-10.jpg')}}"
                                                class="img-fluid rounded-circle" alt="img"></a>
                                        <div class="ms-2 profile-name">
                                            <p class="text-dark mb-0"><a href="#">Danielle Baker</a></p>
                                        </div>
                                    </div>
                                </td>
                                <td>danielle@example.com</td>
                                <td>736-795-34895</td>
                                <td>12 Dec 2024, 09:30 AM</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a href="javascript:void(0);" class="avatar avatar-md"><img
                                                src="{{URL::asset('assets/img/users/user-10.jpg')}}"
                                                class="img-fluid rounded-circle" alt="img"></a>
                                        <div class="ms-2 profile-name">
                                            <p class="text-dark mb-0"><a href="#">Danielle Baker</a></p>
                                        </div>
                                    </div>
                                </td>
                                <td><a href="#" data-bs-toggle="modal" data-bs-target="#report_reason"><span class="file-icon"><i class="ti ti-file-text"></i></span></a></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="dropdown">
                                            <a href="#"
                                                class="btn btn-white btn-icon btn-sm d-flex align-items-center justify-content-center rounded-circle p-0"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ti ti-dots-vertical fs-14"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-right p-3">
                                                <li>
                                                    <a class="dropdown-item rounded-1" href="#"
                                                        data-bs-toggle="modal" data-bs-target="#delete-modal"><i
                                                            class="ti ti-trash me-2"></i>Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /Cities List -->
            </div>
        </div>
         <!-- /Report-User List -->

    </div>
</div>
<!-- /Page Wrapper -->


@component('admin.components.model-popup_admin')
@endcomponent
@component('admin.components.themesettings')
@endcomponent
@endsection