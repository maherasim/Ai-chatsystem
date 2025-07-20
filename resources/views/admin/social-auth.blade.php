<?php $page = 'social-auth'; ?>
@extends('layout.mainlayout_admin')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        @component('admin.components.breadcrumb_admin')
        @slot('title')
        Social Authentication
        @endslot
        @slot('li_1')
           index_admin
        @endslot
        @slot('li_3')
        App Settings
        @endslot
        @slot('li_2')
        Social Authentication
        @endslot
    @endcomponent
        <!-- Social-Authentication Settings -->
        <div class="card setting-card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card d-inline-flex setting-header mb-3">
                            <div class="card-body d-flex align-items-center flex-wrap row-gap-2 p-0">
                                <a href="{{url('admin/profile-settings')}}"><i class="ti ti-settings-cog me-2"></i>General
                                    Settings</a>
                                <a href="{{url('admin/app-settings')}}" class="active ps-3"><i
                                        class="ti ti-apps me-2"></i>App Settings</a>
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
                                    <a href="{{url('admin/app-settings')}}" class=" rounded flex-fill"><i
                                            class="ti ti-building me-2"></i>Company Settings</a>
                                </div>
                                <div class="d-flex">
                                    <a href="{{url('admin/authentication-settings')}}" class="rounded flex-fill"><i
                                            class="ti ti-forms me-2"></i>Authentication</a>
                                </div>
                                <div class="d-flex">
                                    <a href="{{url('admin/social-auth')}}" class=" active rounded flex-fill"><i
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
                                    <a href="{{url('admin/custom-fields')}}" class="rounded flex-fill"><i
                                            class="ti ti-text-plus me-2"></i>Custom Fields</a>
                                </div>
                                <div class="d-flex">
                                    <a href="{{url('admin/integrations')}}" class="rounded flex-fill"><i
                                            class="ti ti-plug-connected me-2"></i>Integrations</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Social Autentication -->
                    <div class="col-xl-9 col-md-8">
                        <div class="card setting-content mb-0">
                            <div class="card-header px-0 mx-3">
                                <h4>Social Authentication</h4>
                            </div>
                            <div class="card-body pb-0 ">
                                <div class="company-img pt-0">
                                    <div class="row gx-3">
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="card social-auth mb-3">
                                                <div class="card-body">
                                                    <div class="header-section">
                                                        <div class="company-img-title">
                                                            <div class="social-icons">
                                                                <span><img
                                                                        src="{{URL::asset('assets/img/Settings/google-icon.svg')}}"
                                                                        alt="icons" class="img-fluid"></span>
                                                                <h6>Google </h6>
                                                            </div>
                                                            <span class="badge badge-success">Connected</span>
                                                        </div>
                                                        <p>Sign in securely with your Google account for quick
                                                            and easy access.</p>
                                                    </div>
                                                    <div class="body-footer">
                                                        <div class="footer-content">
                                                            <a href="#" class="btn btn-sm btn-light"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#add_google">View
                                                                Integration</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="card social-auth mb-3">
                                                <div class="card-body">
                                                    <div class="header-section">
                                                        <div class="company-img-title">
                                                            <div class="social-icons">
                                                                <span><img
                                                                        src="{{URL::asset('assets/img/Settings/face-book-icons.svg')}}"
                                                                        alt="icons" class="img-fluid"></span>
                                                                <h6>Facebook </h6>
                                                            </div>
                                                            <span class="badge badge-light text-dark">Not
                                                                Connected</span>
                                                        </div>
                                                        <p>Connect easily using your Facebook account for fast
                                                            and secure access.</p>
                                                    </div>
                                                    <div class="body-footer">
                                                        <div class="footer-content">
                                                            <a href="#" class="btn btn-sm btn-light"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#add_facebook">View
                                                                Integration</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="card social-auth mb-3">
                                                <div class="card-body">
                                                    <div class="header-section">
                                                        <div class="company-img-title">
                                                            <div class="social-icons">
                                                                <span><img
                                                                        src="{{URL::asset('assets/img/Settings/apple-icons.svg')}}"
                                                                        alt="icons" class="img-fluid"></span>
                                                                <h6>Apple </h6>
                                                            </div>
                                                            <span class="badge badge-success">Connected</span>
                                                        </div>
                                                        <p>Sign in securely with your Apple ID for a seamless
                                                            and private login experience</p>
                                                    </div>
                                                    <div class="body-footer">
                                                        <div class="footer-content">
                                                            <a href="#" class="btn btn-sm btn-light"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#add_apple">Connect Now</a>
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
                    <!-- /Social Autentication -->
                </div>

            </div>

        </div>
        <!-- /Social-Authentication Settings -->

    </div>
</div>
<!-- /Page Wrapper -->


    @component('admin.components.model-popup_admin')
    @endcomponent
    @component('admin.components.themesettings')
    @endcomponent
    @endsection
