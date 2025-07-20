<?php $page = 'custom-fields'; ?>
@extends('layout.mainlayout_admin')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        @component('admin.components.breadcrumb_admin')
        @slot('title')
        Custom Fields
        @endslot
        @slot('li_1')
        admin/index
        @endslot
        @slot('li_3')
        App Settings
        @endslot
        @slot('li_2')
        Custom Fields
        @endslot
    @endcomponent
     <!-- App Settings -->
        <div class="card setting-card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card d-inline-flex setting-header mb-3">
                            <div class="card-body d-flex align-items-center flex-wrap row-gap-2 p-0">
                                <a href="{{url('admin/profile-settings')}}"><i class="ti ti-settings-cog me-2"></i>General Settings</a>
                                <a href="{{url('admin/app-settings')}}" class="active ps-3"><i class="ti ti-apps me-2"></i>App Settings</a>
                                <a href="{{url('admin/localization-settings')}}"><i class="ti ti-device-ipad-horizontal-cog me-2"></i>System
                                    Settings</a>
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
                                    <a href="{{url('admin/app-settings')}}" class="rounded flex-fill"><i
                                            class="ti ti-building me-2"></i>Company Settings</a>
                                </div>
                                <div class="d-flex">
                                    <a href="{{url('admin/authentication-settings')}}" class="rounded flex-fill"><i
                                            class="ti ti-forms me-2"></i>Authentication</a>
                                </div>
                                <div class="d-flex">
                                    <a href="{{url('admin/social-auth')}}" class="rounded flex-fill"><i
                                            class="ti ti-social me-2"></i>Social Authentication </a>
                                </div>
                                <div class="d-flex">
                                    <a href="{{url('admin/chat-settings')}}" class="rounded flex-fill"><i
                                            class="ti ti-message-circle-cog me-2"></i>Chat Settings </a>
                                </div>
                                <div class="d-flex">
                                    <a href="{{url('admin/video-audio-settings')}}" class="rounded flex-fill"><i
                                            class="ti ti-settings-automation me-2"></i>Video/Audio Settings</a>
                                </div>
                                <div class="d-flex">
                                    <a href="{{url('admin/custom-fields')}}" class="active rounded flex-fill"><i
                                            class="ti ti-text-plus me-2"></i>Custom Fields</a>
                                </div>
                                <div class="d-flex">
                                    <a href="{{url('admin/integrations')}}" class="rounded flex-fill"><i
                                            class="ti ti-plug-connected me-2"></i>Integrations</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Autentication Settings -->
                    <div class="col-xl-9 col-md-8">
                        <div class="card setting-content mb-0">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4>Custom Fields</h4>
                                    <a href="#" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#new-field"><i class="ti ti-circle-plus me-2"></i>Add New Fields</a>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th class="no-sort">
                                                    <div class="form-check form-check-md">
                                                        <input class="form-check-input" type="checkbox" id="select-all">
                                                    </div>
                                                </th>
                                                <th class="fw-semibold">Module</th>
                                                <th class="fw-semibold">Label</th>
                                                <th class="fw-semibold">Type</th>
                                                <th class="fw-semibold">Default Value</th>
                                                <th class="fw-semibold">Required</th>
                                                <th class="fw-semibold">Status</th>
                                                <th class="fw-semibold">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th class="no-sort">
                                                    <div class="form-check form-check-md">
                                                        <input class="form-check-input" type="checkbox">
                                                    </div>
                                                </th>
                                                <th>User</th>
                                                <th class="text-gray fw-normal">Middle Name</th>
                                                <th class="text-gray fw-normal">Text</th>
                                                <th class="text-gray fw-normal">-</th>
                                                <th>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch" checked>
                                                    </div>
                                                </th>
                                                <th class="d-flex">
                                                    <span class="badge badge-success badge-sm d-flex align-items-center"><i class="ti ti-point-filled"></i>Active</span>
                                                </th>
                                                <th>
                                                    <div class="dropdown">
                                                        <a href="javascript:void(0);" class="text-gray" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></a>
                                                        <div class="dropdown-menu">
                                                            <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-field"><i class="ti ti-edit me-2"></i>Edit</a>
                                                            <a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-trash me-2"></i>Delete</a>
                                                        </div>
                                                    </div>
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Autentication Settings -->
                </div>


            </div>

        </div>
        <!-- /App Settings -->

    </div>
</div>
<!-- /Page Wrapper -->
@component('admin.components.model-popup_admin')
@endcomponent
@component('admin.components.themesettings')
@endcomponent
@endsection