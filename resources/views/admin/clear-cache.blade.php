<?php $page = 'clear-cache'; ?>
@extends('layout.mainlayout_admin')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        @component('admin.components.breadcrumb_admin')
        @slot('title')
        Clear Cache
        @endslot
        @slot('li_1')
          index_admin
        @endslot
        @slot('li_3')
        Other Settings
        @endslot
        @slot('li_2')
        Clear Cache
        @endslot
    @endcomponent

        <!-- Social-Authentication Settings -->
        <div class="card setting-card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card d-inline-flex setting-header mb-3">
                            <div class="card-body d-flex align-items-center flex-wrap row-gap-2 p-0">
                                <a href="{{url('admin/profile-settings')}}"><i class="ti ti-settings-cog me-2"></i>General Settings</a>
                                <a href="{{url('admin/app-settings')}}"><i class="ti ti-apps me-2"></i>App Settings</a>
                                <a href="{{url('admin/localization-settings')}}"><i class="ti ti-device-ipad-horizontal-cog me-2"></i>System Settings</a>
                                <a href="{{url('admin/appearance-settings')}}" ><i class="ti ti-layers-subtract me-2"></i>Theme Settings</a>
                                <a href="{{url('admin/storage')}}"  class="active pe-3"><i class="ti ti-settings-2 me-2"></i>Other Settings</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row gx-3">
                    <div class="col-xl-3 col-md-4">
                        <div class="card mb-3 mb-md-0">
                            <div class="card-body setting-sidebar">
                                <div class="d-flex">
                                    <a href="{{url('admin/storage')}}" class=" rounded flex-fill"><i
                                            class="ti ti-server-cog me-2"></i>Storage</a>
                                </div>
                                <div class="d-flex">
                                    <a href="{{url('admin/backup')}}" class="  rounded flex-fill"><i
                                            class="ti ti-arrow-back-up me-2"></i>Backup & Restore</a>
                                </div>
                                <div class="d-flex">
                                    <a href="{{url('admin/clear-cache')}}" class="active  rounded flex-fill"><i
                                            class="ti ti-clear-all me-2"></i>Clear Cache</a>
                                </div>
                                <div class="d-flex">
                                    <a href="{{url('admin/ban-address')}}" class="rounded flex-fill"><i
                                            class="ti ti-ban me-2"></i>Ban IP Address</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-md-8">
                        <div class="card setting-content mb-0">
                            <div class="card-header px-0 mx-3">
                                <h4>Clear Cache</h4>
                            </div>
                            <div class="card-body pb-0 ">
                                <div class="cache-content">
                                    <p class="fs-14 text-dark mb-3"> <span class="me-2"><i class="ti ti-info-circle text-danger"></i></span>Clearing the cache may improve performance but will remove temporary files, stored preferences, and cached data from websites and applications.</p>
                                    <div class="d-flex align-items-center justify-content-end mb-3">
                                        <a href="#" class="btn btn-outline-primary me-3">Cancel</a>
                                        <a href="#" class="btn btn-primary">Clear Cache</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <!-- /Social-Authentication Settings -->

    </div>
</div>
<!-- /Page Wrapper -->

@component('admin.components.themesettings')
@endcomponent  
@endsection