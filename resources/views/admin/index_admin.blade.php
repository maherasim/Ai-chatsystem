<?php $page = 'index_admin'; ?>
@extends('layout.mainlayout_admin')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        @component('admin.components.breadcrumb_admin')
        @slot('title')
        Dashboard
        @endslot
        @slot('li_1')
          admin/index
        @endslot
        @slot('li_2')
        Dashboard
        @endslot
    @endcomponent

        <div class="row justify-content-center">
            <div class="col-md-6 col-xl-3 d-flex">
                <div class="card total-users flex-fill">
                    <div class="card-body">
                        <div class="total-counts">
                            <div class="d-flex align-items-center">
                                <span class="total-count-icons"><i class="ti ti-user-share"></i></span>
                                <div>
                                    <p>Total Users </p>
                                    <h5>200</h5>
                                </div>
                            </div>
                            <div class="percentage">
                                <span class="bg-success">+5.63%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3 d-flex">
                <div class="card total-users flex-fill">
                    <div class="card-body">
                        <div class="total-counts">
                            <div class="d-flex align-items-center">
                                <span class="bg-dark total-count-icons"><i class="ti ti-users-group"></i></span>
                                <div>
                                    <p>Total Groups</p>
                                    <h5>150</h5>
                                </div>
                            </div>
                            <div class="percentage">
                                <span class="bg-danger">-42.05%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3 d-flex">
                <div class="card total-users flex-fill">
                    <div class="card-body">
                        <div class="total-counts">
                            <div class="d-flex align-items-center">
                                <span class="bg-purple total-count-icons"><i class="ti ti-brand-hipchat"></i></span>
                                <div>
                                    <p>Total Chats</p>
                                    <h5>2,584</h5>
                                </div>
                            </div>
                            <div class="percentage">
                                <span class="bg-success">+5.63%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3 d-flex">
                <div class="card total-users flex-fill">
                    <div class="card-body">
                        <div class="total-counts">
                            <div class="d-flex align-items-center">
                                <span class="bg-info total-count-icons"><i class="ti ti-circle-dot"></i></span>
                                <div>
                                    <p>Total Stories</p>
                                    <h5>1,640</h5>
                                </div>
                            </div>
                            <div class="percentage">
                                <span class=" bg-success ">+5.63%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-6 d-flex">
                <div class="card user-details flex-fill">
                    <div class="card-header">
                        <h5>Recent Joined Members</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Reg Date</th>
                                        <th>Login Time</th>
                                        <th>Country</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="{{url('admin/users')}}" class="avatar avatar-md"><img
                                                        src="{{URL::asset('assets/img/users/user-01.jpg')}}"
                                                        class="img-fluid rounded-circle" alt="img"></a>
                                                <div class="ms-2 profile-name">
                                                    <p class="text-dark mb-0"><a href="{{url('admin/users')}}">Aaryian Jose</a></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>02 Sep 2024</td>
                                        <td>10:00 AM</td>
                                        <td>United States</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="{{url('admin/users')}}" class="avatar avatar-md"><img
                                                        src="{{URL::asset('assets/img/users/user-02.jpg')}}"
                                                        class="img-fluid rounded-circle" alt="img"></a>
                                                <div class="ms-2 profile-name">
                                                    <p class="text-dark mb-0"><a href="{{url('admin/users')}}">Sarika Jain</a></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>14 Sep 2024</td>
                                        <td>11:30 AM</td>
                                        <td>Canada</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="{{url('admin/users')}}" class="avatar avatar-md"><img
                                                        src="{{URL::asset('assets/img/users/user-03.jpg')}}"
                                                        class="img-fluid rounded-circle" alt="img"></a>
                                                <div class="ms-2 profile-name">
                                                    <p class="text-dark mb-0"><a href="{{url('admin/users')}}">Clyde Smith</a></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>28 Sep 2024</td>
                                        <td>08:15 AM</td>
                                        <td>United Kingdom</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="{{url('admin/users')}}" class="avatar avatar-md"><img
                                                        src="{{URL::asset('assets/img/users/user-04.jpg')}}"
                                                        class="img-fluid rounded-circle" alt="img"></a>
                                                <div class="ms-2 profile-name">
                                                    <p class="text-dark mb-0"><a href="{{url('admin/users')}}">Carla Jenkins</a></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>12 Oct 2024</td>
                                        <td>06:40 PM</td>
                                        <td>Germany</td>
                                    </tr>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 d-flex">
                <div class="card user-details flex-fill">
                    <div class="card-header">
                        <h5>Recent Created Groups</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Reg Date</th>
                                        <th>Login Time</th>
                                        <th>Members</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="{{url('admin/group')}}" class="avatar avatar-md"><img
                                                        src="{{URL::asset('assets/img/group-chat/group-01.jpg')}}"
                                                        class="img-fluid rounded-circle" alt="img"></a>
                                                <div class="ms-2 profile-name">
                                                    <p class="text-dark mb-0"><a href="{{url('admin/group')}}">The Dream Team</a></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>02 Sep 2024</td>
                                        <td>10:00 AM</td>
                                        <td>105</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="{{url('admin/group')}}" class="avatar avatar-md"><img
                                                        src="{{URL::asset('assets/img/group-chat/group-02.jpg')}}"
                                                        class="img-fluid rounded-circle" alt="img"></a>
                                                <div class="ms-2 profile-name">
                                                    <p class="text-dark mb-0"><a href="{{url('admin/group')}}">The Meme Team</a></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>14 Sep 2024</td>
                                        <td>11:30 AM</td>
                                        <td>120</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="{{url('admin/group')}}" class="avatar avatar-md"><img
                                                        src="{{URL::asset('assets/img/group-chat/group-03.jpg')}}"
                                                        class="img-fluid rounded-circle" alt="img"></a>
                                                <div class="ms-2 profile-name">
                                                    <p class="text-dark mb-0"><a href="{{url('admin/group')}}">Tech Talk Tribe</a></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>28 Sep 2024</td>
                                        <td>08:15 AM</td>
                                        <td>200</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="{{url('admin/group')}}" class="avatar avatar-md"><img
                                                        src="{{URL::asset('assets/img/group-chat/group-04.jpg')}}"
                                                        class="img-fluid rounded-circle" alt="img"></a>
                                                <div class="ms-2 profile-name">
                                                    <p class="text-dark mb-0"><a href="{{url('admin/group')}}">The Academic Alliance</a></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>12 Oct 2024</td>
                                        <td>06:40 PM</td>
                                        <td>250</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-8 d-flex">
                <div class="card user-details flex-fill">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title">Attendance</h5>
                        <div class="dropdown dashboard-chart">
                            <a href="javascript:void(0);" class="bg-white dropdown-toggle"
                                data-bs-toggle="dropdown"><i class="ti ti-calendar-due me-1"></i>This Year
                            </a>
                            <ul class="dropdown-menu mt-2 p-3">
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">
                                        This Week
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">
                                        Last Week
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">
                                        Last Week
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body pb-0">
                        <div id="school-area"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4 d-flex">
                <div class="card user-details flex-fill">
                    <div class="card-header">
                        <h5>Invited User</h5>
                    </div>
                    <div class="card-body pt-2">
                        <div class="user-list">
                            <div class="d-flex align-items-center">
                                <a href="{{url('admin/invite-user')}}" class="avatar avatar-md"><img src="{{URL::asset('assets/img/users/user-05.jpg')}}" class="img-fluid rounded-circle" alt="img"></a>
                                <div class="ms-2 profile-name">
                                    <p class="text-dark mb-0"><a href="{{url('admin/invite-user')}}">Federico Wells</a></p>
                                </div>
                            </div>
                            <div class="check-list">
                                <a href="#"><span><i class="ti ti-check"></i></span></a>
                                <a href="#" class="close-btn"><span><i class="ti ti-x"></i></span></a>
                            </div>
                        </div>
                        <div class="user-list">
                            <div class="d-flex align-items-center">
                                <a href="{{url('admin/invite-user')}}" class="avatar avatar-md"><img src="{{URL::asset('assets/img/users/user-06.jpg')}}" class="img-fluid rounded-circle" alt="img"></a>
                                <div class="ms-2 profile-name">
                                    <p class="text-dark mb-0"><a href="{{url('admin/invite-user')}}">Federico Wells</a></p>
                                </div>
                            </div>
                            <div class="check-list">
                                <a href="#"><span><i class="ti ti-check"></i></span></a>
                                <a href="#" class="close-btn"><span><i class="ti ti-x"></i></span></a>
                            </div>
                        </div>
                        <div class="user-list">
                            <div class="d-flex align-items-center">
                                <a href="{{url('admin/invite-user')}}" class="avatar avatar-md"><img src="{{URL::asset('assets/img/users/user-07.jpg')}}" class="img-fluid rounded-circle" alt="img"></a>
                                <div class="ms-2 profile-name">
                                    <p class="text-dark mb-0"><a href="{{url('admin/invite-user')}}">Sharon Ford</a></p>
                                </div>
                            </div>
                            <div class="check-list">
                                <a href="#"><span><i class="ti ti-check"></i></span></a>
                                <a href="#" class="close-btn"><span><i class="ti ti-x"></i></span></a>
                            </div>
                        </div>
                        <div class="user-list">
                            <div class="d-flex align-items-center">
                                <a href="{{url('admin/invite-user')}}" class="avatar avatar-md"><img src="{{URL::asset('assets/img/users/user-08.jpg')}}" class="img-fluid rounded-circle" alt="img"></a>
                                <div class="ms-2 profile-name">
                                    <p class="text-dark mb-0"><a href="{{url('admin/invite-user')}}">Thomas Rethman</a></p>
                                </div>
                            </div>
                            <div class="check-list">
                                <a href="#"><span><i class="ti ti-check"></i></span></a>
                                <a href="#" class="close-btn"><span><i class="ti ti-x"></i></span></a>
                            </div>
                        </div>
                        <div class="user-list pb-0">
                            <div class="d-flex align-items-center">
                                <a href="{{url('admin/invite-user')}}" class="avatar avatar-md"><img src="{{URL::asset('assets/img/users/user-09.jpg')}}" class="img-fluid rounded-circle" alt="img"></a>
                                <div class="ms-2 profile-name">
                                    <p class="text-dark mb-0"><a href="{{url('admin/invite-user')}}">Wilbur Martinez</a></p>
                                </div>
                            </div>
                            <div class="check-list">
                                <a href="#"><span><i class="ti ti-check"></i></span></a>
                                <a href="#" class="close-btn"><span><i class="ti ti-x"></i></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- /Page Wrapper -->
@component('admin.components.themesettings')
@endcomponent
@endsection