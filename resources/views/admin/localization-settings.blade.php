<?php $page = 'localization-settings'; ?>
@extends('layout.mainlayout_admin')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        @component('admin.components.breadcrumb_admin')
        @slot('title')
        Localization
        @endslot
        @slot('li_1')
        admin/index
        @endslot
        @slot('li_3')
        System Settings
        @endslot
        @slot('li_2')
        Localization
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
                    <div class="col-xl-3 col-md-4">
                        <div class="card mb-3 mb-md-0">
                            <div class="card-body setting-sidebar">
                                <div class="d-flex">
                                    <a href="{{url('admin/localization-settings')}}" class="active rounded flex-fill"><i class="ti ti-globe me-2"></i>Localization</a>
                                </div>
                                <div class="d-flex">
                                    <a href="{{url('admin/email-settings')}}" class="rounded flex-fill"><i class="ti ti-mail-cog me-2"></i>Email Settings</a>
                                </div>
                                <div class="d-flex">
                                    <a href="{{url('admin/sms-settings')}}" class="rounded flex-fill"><i class="ti ti-message-cog me-2"></i>SMS Settings</a>
                                </div>
                                <div class="d-flex">
                                    <a href="{{url('admin/otp')}}" class="rounded flex-fill"><i class="ti ti-password me-2"></i>OTP Settings</a>
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
                    <div class="col-xl-9 col-md-8">
                        <div class="card setting-content mb-0">
                            <div class="card-header px-0 mx-3">
                                <h4>Localization</h4>
                            </div>
                            <div class="card-body pb-0">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="row align-items-center">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <h6 class="mb-2">Language</h6>
                                                    <p>Select Language of the Website</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-5">
                                                <div class="mb-3">
                                                    <select class="select">
                                                        <option>English</option>
                                                        <option>Spanish</option>
                                                        <option>French</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <h6 class="mb-2">Language Switcher</h6>
                                                    <p>To Display in all the pages</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-5">
                                                <div class="mb-3">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch" checked="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <h6 class="mb-2">Time Zone</h6>
                                                    <p>Select Time zone in website</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-5">
                                                <div class="mb-3">
                                                    <select class="select">
                                                        <option>UTC 5:30</option>
                                                        <option>(UTC+11:00) INR</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <h6 class="mb-2">Date Format</h6>
                                                    <p>Select date format to display in website</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-5">
                                                <div class="mb-3">
                                                    <select class="select">
                                                        <option>16 Sep 2024</option>
                                                        <option>Sep 16 2024</option>
                                                        <option>2024 Sep 16</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <h6 class="mb-2">Time Format</h6>
                                                    <p>Select time format to display in website</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-5">
                                                <div class="mb-3">
                                                    <select class="select">
                                                        <option>12 Hours</option>
                                                        <option>24 Hours</option>
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