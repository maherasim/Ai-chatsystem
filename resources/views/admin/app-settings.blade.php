<?php $page = 'app-settings'; ?>
@extends('layout.mainlayout_admin')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        @component('admin.components.breadcrumb_admin')
        @slot('title')
        Company Settings
        @endslot
        @slot('li_1')
           index
        @endslot
        @slot('li_3')
        App Settings
        @endslot
        @slot('li_2')
        Company Settings
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
                                    <a href="{{url('admin/app-settings')}}" class="active rounded flex-fill"><i
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
                    <!-- Company Settings -->
                    <div class="col-xl-9 col-md-8">
                        <div class="card setting-content mb-0">
                            <div class="card-header px-0 mx-3">
                                <h4>Company Settings</h4>
                            </div>
                            <div class="card-body pb-0">
                                <div class="border-bottom">
                                    <div class="company-title mb-3">
                                        <h6>Basic Information</h6>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label">Site Name</label>
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
                                                <label class="form-label">Phone</label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label">Fax</label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="company-img">
                                    <div class="mb-3">
                                        <h6>Company Images</h6>
                                    </div>
                                    <div class="row gx-3">
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="card mb-3">
                                                <div class="card-body">
                                                    <div class="company-img-title">
                                                        <h6>Logo</h6>
                                                        <p>Upload Logo of your Company to display in website</p>
                                                    </div>
                                                    <div class="row align-items-center row-gap-3">
                                                        <div class="col-sm-6">
                                                            <div class="company-img-content">
                                                                <img src="{{URL::asset('assets/img/full-logo.svg')}}" alt="" class="img-fluid">
                                                                <a href="#"><span><i class="ti ti-trash"></i></span></a>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="d-flex align-items-end justify-content-end flex-column flex-wrap">
                                                                <div class="profile-uploader d-flex align-items-center mb-2">
                                                                    <div class="drag-upload-btn btn-sm btn mb-0">
                                                                        Change Photo 
                                                                        <input type="file" class="form-control image-sign" multiple="">
                                                                    </div>
                                                                </div>
                                                                <p class="fs-10">Recommended size is <br> 250px * 100px</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="card mb-3">
                                                <div class="card-body">
                                                    <div class="company-img-title">
                                                        <h6>Dark Logo</h6>
                                                        <p>Upload Dark Logo of your Company to display in website</p>
                                                    </div>
                                                    <div class="row align-items-center row-gap-3">
                                                        <div class="col-sm-6">
                                                            <div class="company-img-content img-dark ">
                                                                <img src="{{URL::asset('assets/img/dark-logo.svg')}}" alt="" class="img-fluid">
                                                                <a href="#"><span><i class="ti ti-trash"></i></span></a>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="d-flex align-items-end justify-content-end flex-column flex-wrap">
                                                                <div class="profile-uploader d-flex align-items-center mb-2">
                                                                    <div class="drag-upload-btn btn-sm btn mb-0">
                                                                        Change Photo 
                                                                        <input type="file" class="form-control image-sign" multiple="">
                                                                    </div>
                                                                </div>
                                                                <p class="fs-10">Recommended size is <br> 250px * 100px</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="card mb-3">
                                                <div class="card-body">
                                                    <div class="company-img-title">
                                                        <h6>Mini Icon</h6>
                                                        <p>Upload Mini Icon of your Company to display in website</p>
                                                    </div>
                                                    <div class="row align-items-center row-gap-3">
                                                        <div class="col-sm-6">
                                                            <div class="company-img-content mini-icon">
                                                                <a href="#"><span><i class="ti ti-trash"></i></span></a>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="d-flex align-items-end justify-content-end flex-column flex-wrap">
                                                                <div class="profile-uploader d-flex align-items-center mb-2">
                                                                    <div class="drag-upload-btn btn-sm btn mb-0">
                                                                        Upload Photo 
                                                                        <input type="file" class="form-control image-sign" multiple="">
                                                                    </div>
                                                                </div>
                                                                <p class="fs-10">Recommended size is <br> 30px * 30px</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="card mb-3">
                                                <div class="card-body">
                                                    <div class="company-img-title">
                                                        <h6>Dark Mini Icon</h6>
                                                        <p>Upload Mini Icon of your Company to display in website</p>
                                                    </div>
                                                    <div class="row align-items-center row-gap-3">
                                                        <div class="col-sm-6">
                                                            <div class="company-img-content dark-mini-icon">
                                                                <img src="{{URL::asset('assets/img/dark-mini-logo.svg')}}" alt="image" class="img-fluid">
                                                                <a href="#"><span><i class="ti ti-trash"></i></span></a>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="d-flex align-items-end justify-content-end flex-column flex-wrap">
                                                                <div class="profile-uploader d-flex align-items-center mb-2">
                                                                    <div class="drag-upload-btn btn-sm btn mb-0">
                                                                        Change Photo 
                                                                        <input type="file" class="form-control image-sign" multiple="">
                                                                    </div>
                                                                </div>
                                                                <p class="fs-10">Recommended size is <br> 30px * 30px</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="card mb-3">
                                                <div class="card-body">
                                                    <div class="company-img-title">
                                                        <h6>Favicon</h6>
                                                        <p>Upload Favicon of your Company to display in website</p>
                                                    </div>
                                                    <div class="row align-items-center row-gap-3">
                                                        <div class="col-sm-6">
                                                            <div class="company-img-content favicon-logo">
                                                                <img src="{{URL::asset('assets/img/logo-small.svg')}}" alt="image" class="img-fluid">
                                                                <a href="#"><span><i class="ti ti-trash"></i></span></a>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="d-flex align-items-end justify-content-end flex-column flex-wrap">
                                                                <div class="profile-uploader d-flex align-items-center mb-2">
                                                                    <div class="drag-upload-btn btn-sm btn mb-0">
                                                                        Change Photo 
                                                                        <input type="file" class="form-control image-sign" multiple="">
                                                                    </div>
                                                                </div>
                                                                <p class="fs-10">Recommended size is <br> 128px * 128px</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="card mb-3">
                                                <div class="card-body">
                                                    <div class="company-img-title">
                                                        <h6>Apple Icon</h6>
                                                        <p>Upload App Icon of your Company to display in website</p>
                                                    </div>
                                                    <div class="row align-items-center row-gap-3">
                                                        <div class="col-sm-6">
                                                            <div class="company-img-content favicon-logo">
                                                                <img src="{{URL::asset('assets/img/logo-small.svg')}}" alt="image" class="img-fluid">
                                                                <a href="#"><span><i class="ti ti-trash"></i></span></a>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="d-flex align-items-end justify-content-end flex-column flex-wrap">
                                                                <div class="profile-uploader d-flex align-items-center mb-2">
                                                                    <div class="drag-upload-btn btn-sm btn mb-0">
                                                                        Change Photo 
                                                                        <input type="file" class="form-control image-sign" multiple="">
                                                                    </div>
                                                                </div>
                                                                <p class="fs-10">Recommended size is <br> 180px * 180px</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="address-info">
                                    <div class="company-title mb-3">
                                        <h6>Address Information</h6>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label">Address</label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label">City</label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label">State</label>
                                                <select class="select">
                                                    <option>Select</option>
                                                    <option>Wyoming</option>
                                                    <option>Vermont </option>
                                                    <option>Texas </option>
                                                    <option>Florida </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label">Country</label>
                                                <select class="select">
                                                    <option>Select</option>
                                                    <option>United States</option>
                                                    <option>Germany</option>
                                                    <option>Canada</option>
                                                    <option>Australia</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label">Postal Code</label>
                                                <input type="text" class="form-control">
                                            </div>
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
                    <!-- /Company Settings -->
                </div>

            </div>

        </div>
        <!-- /App Settings -->

    </div>
</div>
<!-- /Page Wrapper -->
@component('admin.components.themesettings')
@endcomponent

@endsection