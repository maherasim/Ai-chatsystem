<?php $page = 'otp'; ?>
@extends('layout.mainlayout_admin')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        @component('admin.components.breadcrumb_admin')
        @slot('title')
        OTP Settings
        @endslot
        @slot('li_1')
        index_admin
        @endslot
        @slot('li_3')
        System Settings
        @endslot
        @slot('li_2')
        OTP Settings
        @endslot
    @endcomponent
      <!-- Profile Settings -->
        <div class="card setting-card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card d-inline-flex setting-header mb-3">
                            <div class="card-body d-flex align-items-center flex-wrap row-gap-2 p-0">
                                <a href="{{url('admin/profile-settings')}}" class=" ps-3"><i class="ti ti-settings-cog me-2"></i>General Settings</a>
                                <a href="{{url('admin/app-settings')}}"><i class="ti ti-apps me-2"></i>App Settings</a>
                                <a href="{{url('admin/localization-settings')}}" class="active"><i class="ti ti-device-ipad-horizontal-cog me-2"></i>System Settings</a>
                                <a href="{{url('admin/appearance-settings')}}"><i class="ti ti-layers-subtract me-2"></i>Theme Settings</a>
                                <a href="{{url('admin/storage')}}" class="pe-3"><i class="ti ti-settings-2 me-2"></i>Other Settings</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row gx-3">
                    <div class="col-md-3">
                        <div class="card mb-3 mb-md-0">
                            <div class="card-body setting-sidebar">
                                <div class="d-flex">
                                    <a href="{{url('admin/localization-settings')}}" class="rounded flex-fill"><i class="ti ti-globe me-2"></i>Localization</a>
                                </div>
                                <div class="d-flex">
                                    <a href="{{url('admin/email-settings')}}" class="rounded flex-fill"><i class="ti ti-mail-cog me-2"></i>Email Settings</a>
                                </div>
                                <div class="d-flex">
                                    <a href="{{url('admin/sms-settings')}}" class="rounded flex-fill"><i class="ti ti-message-cog me-2"></i>SMS Settings</a>
                                </div>
                                <div class="d-flex">
                                    <a href="{{url('admin/otp')}}" class="active rounded flex-fill"><i class="ti ti-password me-2"></i>OTP Settings</a>
                                </div>
                                <div class="d-flex">
                                    <a href="{{url('admin/language')}}" class="rounded flex-fill"><i class="ti ti-language me-2"></i>Language</a>
                                </div>
                                <div class="d-flex">
                                    <a href="{{url('admin/gdpr')}}" class="rounded flex-fill"><i class="ti ti-cookie me-2"></i>GDPR Cookies</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card setting-content mb-0">
                            <div class="card-header px-0 mx-3">
                                <h4>OTP Settings</h4>
                            </div>
                            <div class="card-body pb-0">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="row align-items-center">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <h6 class="mb-2 fw-medium">OTP Type </h6>
                                                    <p>Your can configure the type</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-5">
                                                <div class="mb-3">
                                                    <select class="select">
                                                        <option>SMS</option>
                                                        <option>Email</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <h6 class="mb-2 fw-medium">OTP Digit Limit</h6>
                                                    <p>Select size of the format</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-5">
                                                <div class="mb-3">
                                                    <select class="select">
                                                        <option>4</option>
                                                        <option>6</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <h6 class="mb-2 fw-medium">OTP Expire Time</h6>
                                                    <p>Select expire time of OTP </p>
                                                </div>
                                            </div>
                                            <div class="col-lg-5">
                                                <div class="mb-3">
                                                    <select class="select">
                                                        <option>5 Mins</option>
                                                        <option>10 Mins</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Profile Settings -->
    </div>
</div>
<!-- /Page Wrapper -->

@component('admin.components.model-popup_admin')
@endcomponent
@component('admin.components.themesettings')
@endcomponent
@endsection