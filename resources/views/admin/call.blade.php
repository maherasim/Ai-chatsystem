<?php $page = 'call'; ?>
@extends('layout.mainlayout_admin')
@section('content')

<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        @component('admin.components.breadcrumb_admin')
        @slot('title')
        Calls
        @endslot
        @slot('li_1')
           index
        @endslot
        @slot('li_2')
        Calls
        @endslot
    @endcomponent

        <!-- User List -->
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between flex-wrap pb-0">
                <h6 class="mb-3">Calls List<span>200</span> </h6>
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

            <!-- Call List -->
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
                                <th>Total Incoming Call</th>
                                <th>Total Outgoing Call</th>
                                <th>Total Missed Call</th>
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
                                <td>80</td>
                                <td>
                                    100
                                </td>
                                <td>30</td>
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
                                                src="{{URL::asset('assets/img/users/user-02.jpg')}}"
                                                class="img-fluid rounded-circle" alt="img"></a>
                                        <div class="ms-2 profile-name">
                                            <p class="text-dark mb-0"><a href="#">Sarika Jain</a></p>
                                        </div>
                                    </div>
                                </td>
                                <td>120</td>
                                <td>
                                    120
                                </td>
                                <td>120</td>
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
                                                src="{{URL::asset('assets/img/users/user-03.jpg')}}"
                                                class="img-fluid rounded-circle" alt="img"></a>
                                        <div class="ms-2 profile-name">
                                            <p class="text-dark mb-0"><a href="#">Clyde Smith</a></p>
                                        </div>
                                    </div>
                                </td>
                                <td>200</td>
                                <td>
                                    200
                                </td>
                                <td>200</td>
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
                                                src="{{URL::asset('assets/img/users/user-04.jpg')}}"
                                                class="img-fluid rounded-circle" alt="img"></a>
                                        <div class="ms-2 profile-name">
                                            <p class="text-dark mb-0"><a href="#">Carla Jenkins</a></p>
                                        </div>
                                    </div>
                                </td>
                                <td>250</td>
                                <td>
                                    250
                                </td>
                                <td>250</td>
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
                                                src="{{URL::asset('assets/img/users/user-05.jpg')}}"
                                                class="img-fluid rounded-circle" alt="img"></a>
                                        <div class="ms-2 profile-name">
                                            <p class="text-dark mb-0"><a href="#">Federico Wells</a></p>
                                        </div>
                                    </div>
                                </td>
                                <td>300</td>
                                <td>
                                    300
                                </td>
                                <td>300</td>
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
                                                src="{{URL::asset('assets/img/users/user-06.jpg')}}"
                                                class="img-fluid rounded-circle" alt="img"></a>
                                        <div class="ms-2 profile-name">
                                            <p class="text-dark mb-0"><a href="#">Edward Lietz</a></p>
                                        </div>
                                    </div>
                                </td>
                                <td>180</td>
                                <td>
                                    180
                                </td>
                                <td>180</td>
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
                                                src="{{URL::asset('assets/img/users/user-07.jpg')}}"
                                                class="img-fluid rounded-circle" alt="img"></a>
                                        <div class="ms-2 profile-name">
                                            <p class="text-dark mb-0"><a href="#">Sharon Ford</a></p>
                                        </div>
                                    </div>
                                </td>
                                <td>200</td>
                                <td>
                                    200
                                </td>
                                <td>200</td>
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
                                                src="{{URL::asset('assets/img/users/user-08.jpg')}}"
                                                class="img-fluid rounded-circle" alt="img"></a>
                                        <div class="ms-2 profile-name">
                                            <p class="text-dark mb-0"><a href="#">Thomas Rethman</a></p>
                                        </div>
                                    </div>
                                </td>
                                <td>320</td>
                                <td>
                                    320
                                </td>
                                <td>320</td>
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
                                                src="{{URL::asset('assets/img/users/user-09.jpg')}}"
                                                class="img-fluid rounded-circle" alt="img"></a>
                                        <div class="ms-2 profile-name">
                                            <p class="text-dark mb-0"><a href="#">Wilbur Martinez</a></p>
                                        </div>
                                    </div>
                                </td>
                                <td>400</td>
                                <td>
                                    400
                                </td>
                                <td>400</td>
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
                                                src="{{URL::asset('assets/img/users/user-10.jpg')}}"
                                                class="img-fluid rounded-circle" alt="img"></a>
                                        <div class="ms-2 profile-name">
                                            <p class="text-dark mb-0"><a href="#">Danielle Baker</a></p>
                                        </div>
                                    </div>
                                </td>
                                <td>210</td>
                                <td>
                                    210
                                </td>
                                <td>210</td>
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
         <!-- /Call List -->

    </div>
</div>
<!-- /Page Wrapper -->	 		

@component('admin.components.model-popup_admin')
@endcomponent
@component('admin.components.themesettings')
@endcomponent
@endsection