<?php $page = 'change-password'; ?>
@extends('layout.mainlayout_admin')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        @component('admin.components.breadcrumb_admin')
        @slot('title')
        Change Password
        @endslot
        @slot('li_1')
          admin/index
        @endslot
        @slot('li_3')
        General Settings
        @endslot
        @slot('li_2')
        Change Password
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
											<a href="{{url('admin/change-password')}}" class=" active rounded flex-fill"><i class="ti ti-lock-cog me-2"></i>Change Password</a>
										</div>
										<div class="d-flex">
											<a href="{{url('admin/notification-settings')}}" class="rounded flex-fill"><i class="ti ti-bell-ringing me-2"></i>Notification </a>
										</div>
									</div>
								</div>
							</div>
							<!-- Change Password -->
							<div class="col-xl-9 col-md-8">
								<div class="card setting-content mb-0">
									<div class="card-header px-0 mx-3">
										<h4>Change Password</h4>
									</div>
									<div class="card-body pb-0">
										<div class="row">
											<div class="col-md-10 col-lg-10">
												<div class="row change-password d-flex align-items-center">
													<div class="col-md-5">
														<label class="form-label flex-fill">Current Password</label>
													</div>
													<div class="col-md-6">
														<div class="pass-group flex-fill">
															<input type="password" class="pass-inputs form-control">
															<span class="ti toggle-passwords ti-eye-off"></span>
														</div>
													</div>
													
												</div>
											</div>
											<div class="col-md-10 col-lg-10">
												<div class="row change-password d-flex align-items-center">
													<div class="col-md-5">
														<label class="form-label flex-fill">New Password</label>
													</div>
													<div class="col-md-6">
														<div class="pass-group flex-fill">
															<input type="password" class="pass-inputs form-control">
															<span class="ti toggle-passwords ti-eye-off"></span>
														</div>
													</div>
													
												</div>
											</div>
											<div class="col-md-10 col-lg-10">
												<div class="row change-password d-flex align-items-center mb-3">
													<div class="col-md-5">
														<label class="form-label flex-fill">Confirm Password</label>
													</div>
													<div class="col-md-6">
														<div class="pass-group flex-fill">
															<input type="password" class="conform-pass-input form-control">
															<span class="ti conform-toggle-password ti-eye-off"></span>
														</div>
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
							<!-- /Change Password -->
						</div>
					</div>

				 </div>
				 <!-- /General Settings -->

			</div>
		</div>
		<!-- /Page Wrapper -->


    @endsection