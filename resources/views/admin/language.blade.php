<?php $page = 'language'; ?>
@extends('layout.mainlayout_admin')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        @component('admin.components.breadcrumb_admin')
        @slot('title')
        Language
        @endslot
        @slot('li_1')
          index_admin
        @endslot
        @slot('li_3')
        System Settings
      @endslot
        @slot('li_2')
        Language
        @endslot
    @endcomponent

        <!-- Profile Settings -->
        <div class="card setting-card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card d-inline-flex setting-header mb-3">
                            <div class="card-body d-flex align-items-center flex-wrap row-gap-2 p-0">
                                <a href="{{url('admin/profile-settings')}}" class="ps-3"><i class="ti ti-settings-cog me-2"></i>General Settings</a>
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
                                    <a href="{{url('admin/localization-settings')}}" class="rounded flex-fill"><i class="ti ti-globe me-2"></i>Localization</a>
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
                                    <a href="{{url('admin/language')}}" class="active rounded flex-fill"><i class="ti ti-language me-2"></i>Language</a>
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
                                <div class="row g-3 align-items-center">
                                    <div class="col-md-6 col-sm-4">
                                        <h4>Language</h4>
                                    </div>
                                    <div class="col-md-6 col-sm-8">
                                        <div class="d-flex justify-content-sm-end align-items-center flex-wrap row-gap-2">
                                            <div class="me-3">
                                                <select class="select">
                                                    <option>Select Language</option>
                                                    <option>English</option>
                                                    <option>Spanish</option>
                                                </select>
                                            </div>
                                            <a href="{{url('admin/add-language')}}" class="btn btn-primary">Add Language</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pb-0">
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <div class="row align-items-center g-3">
                                            <div class="col-sm-8">
                                                <h6>Language List</h6>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="position-relative search-input">
                                                    <input type="text" class="form-control" placeholder="Search">
                                                    <div class="search-addon">
                                                        <span><i class="ti ti-search"></i></span>
                                                    </div>
                                                </div>
                                            </div>
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
                                                        <th>Language</th>
                                                        <th>Code</th>
                                                        <th>RTL</th>
                                                        <th>Default </th>
                                                        <th>Total</th>
                                                        <th>Done</th>
                                                        <th>Progress</th>
                                                        <th>Status</th>
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
                                                            <h6 class="d-flex align-items-center fw-medium">
                                                                <img src="{{URL::asset('assets/img/flag/ar.png')}}" class="me-2" alt="">
                                                                Arabic
                                                            </h6>
                                                        </td>
                                                        <td>en</td>
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
                                                        <td>1620</td>
                                                        <td>1296</td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="circle-progress" data-value="80">
                                                                    <span class="progress-left">
                                                                        <span class="progress-bar border-warning"></span>
                                                                    </span>
                                                                    <span class="progress-right">
                                                                        <span class="progress-bar border-warning"></span>
                                                                    </span>
                                                                    
                                                                </div>
                                                                <div class="progress-value ms-2">80%</div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch" checked>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <a href="#" class="btn btn-sm btn-icon btn-light border me-2">
                                                                    <i class="ti ti-download"></i>
                                                                </a>
                                                                <a href="{{url('admin/language-web')}}" class="btn btn-sm border me-2">Web</a>
                                                                <a href="{{url('admin/language-web')}}" class="btn btn-sm border me-2">App</a>
                                                                <a href="{{url('admin/language-web')}}" class="btn btn-sm border me-2">Admin</a>
                                                                <a href="#" class="btn btn-sm btn-icon btn-light border">
                                                                    <i class="ti ti-trash"></i>
                                                                </a>
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
                                                            <h6 class="d-flex align-items-center fw-medium">
                                                                <img src="{{URL::asset('assets/img/flag/cn.png')}}" class="me-2" alt="">
                                                                Chinese
                                                            </h6>
                                                        </td>
                                                        <td>zh</td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch">
                                                            </div>
                                                        </td>
                                                        <td>1620</td>
                                                        <td>972</td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="circle-progress" data-value="60">
                                                                    <span class="progress-left">
                                                                        <span class="progress-bar border-skyblue"></span>
                                                                    </span>
                                                                    <span class="progress-right">
                                                                        <span class="progress-bar border-skyblue"></span>
                                                                    </span>
                                                                    
                                                                </div>
                                                                <div class="progress-value ms-2">60%</div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch" checked>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <a href="#" class="btn btn-sm btn-icon btn-light border me-2">
                                                                    <i class="ti ti-download"></i>
                                                                </a>
                                                                <a href="{{url('admin/language-web')}}" class="btn btn-sm border me-2">Web</a>
                                                                <a href="{{url('admin/language-web')}}" class="btn btn-sm border me-2">App</a>
                                                                <a href="{{url('admin/language-web')}}" class="btn btn-sm border me-2">Admin</a>
                                                                <a href="#" class="btn btn-sm btn-icon btn-light border">
                                                                    <i class="ti ti-trash"></i>
                                                                </a>
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
                                                            <h6 class="d-flex align-items-center fw-medium">
                                                                <img src="{{URL::asset('assets/img/flag/us.png')}}" class="me-2" alt="">
                                                                English
                                                            </h6>
                                                        </td>
                                                        <td>en</td>
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
                                                        <td>1620</td>
                                                        <td>810</td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="circle-progress" data-value="50">
                                                                    <span class="progress-left">
                                                                        <span class="progress-bar border-purple"></span>
                                                                    </span>
                                                                    <span class="progress-right">
                                                                        <span class="progress-bar border-purple"></span>
                                                                    </span>
                                                                    
                                                                </div>
                                                                <div class="progress-value ms-2">50%</div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch" checked>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <a href="#" class="btn btn-sm btn-icon btn-light border me-2">
                                                                    <i class="ti ti-download"></i>
                                                                </a>
                                                                <a href="{{url('admin/language-web')}}" class="btn btn-sm border me-2">Web</a>
                                                                <a href="{{url('admin/language-web')}}" class="btn btn-sm border me-2">App</a>
                                                                <a href="{{url('admin/language-web')}}" class="btn btn-sm border me-2">Admin</a>
                                                                <a href="#" class="btn btn-sm btn-icon btn-light border">
                                                                    <i class="ti ti-trash"></i>
                                                                </a>
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
                                                            <h6 class="d-flex align-items-center fw-medium">
                                                                <img src="{{URL::asset('assets/img/flag/in.png')}}" class="me-2" alt="">
                                                                Hindi
                                                            </h6>
                                                        </td>
                                                        <td>hi</td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch">
                                                            </div>
                                                        </td>
                                                        <td>1620</td>
                                                        <td>324</td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="circle-progress" data-value="20">
                                                                    <span class="progress-left">
                                                                        <span class="progress-bar border-danger"></span>
                                                                    </span>
                                                                    <span class="progress-right">
                                                                        <span class="progress-bar border-danger"></span>
                                                                    </span>
                                                                    
                                                                </div>
                                                                <div class="progress-value ms-2">20%</div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch" checked>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <a href="#" class="btn btn-sm btn-icon btn-light border me-2">
                                                                    <i class="ti ti-download"></i>
                                                                </a>
                                                                <a href="{{url('admin/language-web')}}" class="btn btn-sm border me-2">Web</a>
                                                                <a href="{{url('admin/language-web')}}" class="btn btn-sm border me-2">App</a>
                                                                <a href="{{url('admin/language-web')}}" class="btn btn-sm border me-2">Admin</a>
                                                                <a href="#" class="btn btn-sm btn-icon btn-light border">
                                                                    <i class="ti ti-trash"></i>
                                                                </a>
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