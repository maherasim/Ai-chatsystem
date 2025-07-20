<?php $page = 'notification-settings'; ?>
@extends('layout.mainlayout_admin')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        @component('admin.components.breadcrumb_admin')
        @slot('title')
        Notification
        @endslot
        @slot('li_1')
           index_admin
        @endslot
        @slot('li_3')
        General Settings  
        @endslot
        @slot('li_2')
        Notification
        @endslot
    @endcomponent
        <!-- General Settings -->
        <div class="card setting-card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card d-inline-flex setting-header mb-3">
                            <div class="card-body d-flex align-items-center flex-wrap row-gap-2 p-0">
                                <a href="{{url('admin/profile-settings')}}" class="active ps-3"><i class="ti ti-settings-cog me-2"></i>General Settings</a>
                                <a href="{{url('admin/app-settings')}}"><i class="ti ti-apps me-2"></i>App Settings</a>
                                <a href="{{url('admin/localization-settings')}}"><i class="ti ti-device-ipad-horizontal-cog me-2"></i>System Settings</a>
                                <a href="{{url('admin/appearance-settings')}}"><i class="ti ti-layers-subtract me-2"></i>Theme Settings</a>
                                <a href="{{url('admin/storage')}}" class="pe-3"><i class="ti ti-settings-2 me-2"></i>Other Settings</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row gx-3">
                    <div class="col-xl-3 col-md-4">
                        <div class="card mb-3 mb-md-0">
                            <div class="card-body setting-sidebar">
                                <div class="d-flex">
                                    <a href="{{url('admin/profile-settings')}}" class=" rounded flex-fill"><i class="ti ti-user-circle me-2"></i>Profile Settings</a>
                                </div>
                                <div class="d-flex">
                                    <a href="{{url('admin/change-password')}}" class="rounded flex-fill"><i class="ti ti-lock-cog me-2"></i>Change Password</a>
                                </div>
                                <div class="d-flex">
                                    <a href="{{url('admin/notification-settings')}}" class="active rounded flex-fill"><i class="ti ti-bell-ringing me-2"></i>Notification</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Notification Settings -->
                    <div class="col-xl-9 col-md-8">
                        <div class="card setting-content mb-0">
                            <div class="card-header px-0 mx-3">
                                <h4>Notifications</h4>
                            </div>
                            <div class="card-body">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h6 class="fw-medium">Mobile Push Notifications</h6>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch" checked>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h6 class="fw-medium">Desktop Notifications</h6>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch" checked>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h6 class="fw-medium">Email Notifications</h6>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch" checked>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6 class="fw-medium">SMS Notification</h6>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch" checked>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h5 class="mb-3">General Notifications</h5>
                                <div class="card notification-table mb-0">
                                    <div class="card-body pb-0">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th class="fw-semibold fs-18">Modules</th>
                                                        <th class="fw-semibold fs-18">Push</th>
                                                        <th class="fw-semibold fs-18">Email</th>
                                                        <th class="fw-semibold fs-18">SMS</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><h6 class="fw-medium">Payment</h6></td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch" checked>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch" checked>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><h6 class="fw-medium">Transaction</h6></td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch" checked>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch" checked>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch" checked>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><h6 class="fw-medium">Email Verification</h6></td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch" checked>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch" checked>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><h6 class="fw-medium">OTP</h6></td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch" checked>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch" checked>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><h6 class="fw-medium">Activity</h6></td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch" checked>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch" checked>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch" checked>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><h6 class="fw-medium">Account</h6></td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch" checked>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch" checked>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch" checked>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Notification Settings -->
                </div>

            </div>

        </div>
        <!-- /General Settings -->
    </div>
</div>
<!-- /Page Wrapper -->
@component('admin.components.themesettings')
@endcomponent
@endsection