<?php $page = 'profile-settings'; ?>
@extends('layout.mainlayout_admin')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        @component('admin.components.breadcrumb_admin')
        @slot('title')
        Profile Settings
        @endslot
        @slot('li_1')
        index_admin
        @endslot
        @slot('li_3')
         General Settings
        @endslot
        @slot('li_2')
        Profile Settings
        @endslot
    @endcomponent
<!-- Page Wrapper -->
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
                                    <a href="{{url('admin/profile-settings')}}" class="active rounded flex-fill"><i class="ti ti-user-circle me-2"></i>Profile Settings</a>
                                </div>
                                <div class="d-flex">
                                    <a href="{{url('admin/change-password')}}" class="rounded flex-fill"><i class="ti ti-lock-cog me-2"></i>Change Password</a>
                                </div>
                                <div class="d-flex">
                                    <a href="{{url('admin/notification-settings')}}" class="rounded flex-fill"><i class="ti ti-bell-ringing me-2"></i>Notification </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Profile Settings -->
                    <div class="col-xl-9 col-md-8">
                        <div class="card setting-content mb-0">
                            <div class="card-header px-0 mx-3">
                                <h4>Profile Settings</h4>
                            </div>
                            <div class="card-body pb-0">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar avatar-xxl me-3">
                                        <img src="{{URL::asset('assets/img/users/user-08.jpg')}}" class="rounded img-fluid" alt="user">
                                    </div>
                                    <div>
                                        <p class="text-dark fw-medium mb-0">Upload Project Logo</p>
                                        <p class="fs-13 mb-2">Image support png, jpeg and gif under 10MB</p>
                                        <div class="d-flex align-items-center"> 
                                            <div class="profile-uploader d-flex align-items-center">
                                                <div class="drag-upload-btn btn mb-0">
                                                    Upload
                                                    <input type="file" class="form-control image-sign" multiple="">
                                                </div>
                                                <a href="javascript:void(0);" class="btn btn-md btn-outline-primary">Remove</a>
                                            </div>
                                        
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label">First Name</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label">Last Name</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label">Email Address</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label">Phone Number</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer mx-3 px-0">
                                <div class="d-flex align-items-center justify-content-end m-0">
                                    <a href="#" class="btn btn-outline-primary me-2">Cancel</a>
                                    <a href="#" class="btn btn-primary">Save</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Profile Settings -->
                </div>

            </div>

        </div>
        <!-- /General Settings -->
    </div>
</div>
<!-- /Page Wrapper -->


@component('admin.components.model-popup_admin')
@endcomponent
@component('admin.components.themesettings')
@endcomponent
@endsection