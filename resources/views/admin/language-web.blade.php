<?php $page = 'language-web'; ?>
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
										<h4>Language</h4>
									</div>
									<div class="card-body pb-0">
										<div class="card mb-3">
											<div class="card-header">
												<div class="row align-items-center g-3">
													<div class="col-lg-6 col-sm-4">
														<h6>Language</h6>
													</div>
													<div class="col-lg-6 col-sm-8">
														<div class="d-flex align-items-center justify-content-sm-end">
															<a href="{{url('admin/language')}}" class="btn btn-sm btn-primary d-inline-flex align-items-center me-3">
																<i class="ti ti-arrow-left me-2"></i>
																Back to Translations
															</a>
															<a href="#" class="btn btn-sm btn-outline-dark d-inline-flex align-items-center">
																<img src="{{URL::asset('assets/img/flag/ar.png')}}" class="me-2" alt="">
																Arabic
															</a>
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
																<th>Module Name</th>
																<th>Total</th>
																<th>Complete</th>
																<th>Progress </th>
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
																	<h6 class="fw-medium fs-14">Chat</h6>
																</td>
																<td>560</td>
																<td>560</td>
																<td>
																	<div class="d-flex align-items-center">
																		<div class="progress progress-xs" style="width: 120px;">
																			<div class="progress-bar bg-success rounded" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
																		</div>
																		<span class="d-inline-flex fs-12 ms-2">100%</span>
																	</div>
																</td>
																<td>
																	<a href="#" class="btn btn-sm btn-icon border btn-light"><i class="ti ti-edit"></i></a>
																</td>
															</tr>
															<tr>
																<td>
																	<div class="form-check form-check-md">
																		<input class="form-check-input" type="checkbox">
																	</div>
																</td>
																<td>
																	<h6 class="fw-medium fs-14">Group</h6>
																</td>
																<td>320</td>
																<td>262</td>
																<td>
																	<div class="d-flex align-items-center">
																		<div class="progress progress-xs" style="width: 120px;">
																			<div class="progress-bar bg-warning rounded" role="progressbar" style="width: 80%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
																		</div>
																		<span class="d-inline-flex fs-12 ms-2">80%</span>
																	</div>
																</td>
																<td>
																	<a href="#" class="btn btn-sm btn-icon border btn-light"><i class="ti ti-edit"></i></a>
																</td>
															</tr>
															<tr>
																<td>
																	<div class="form-check form-check-md">
																		<input class="form-check-input" type="checkbox">
																	</div>
																</td>
																<td>
																	<h6 class="fw-medium fs-14">Contacts</h6>
																</td>
																<td>270</td>
																<td>180</td>
																<td>
																	<div class="d-flex align-items-center">
																		<div class="progress progress-xs" style="width: 120px;">
																			<div class="progress-bar bg-pink rounded" role="progressbar" style="width: 70%;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
																		</div>
																		<span class="d-inline-flex fs-12 ms-2">70%</span>
																	</div>
																</td>
																<td>
																	<a href="#" class="btn btn-sm btn-icon border btn-light"><i class="ti ti-edit"></i></a>
																</td>
															</tr>
															<tr>
																<td>
																	<div class="form-check form-check-md">
																		<input class="form-check-input" type="checkbox">
																	</div>
																</td>
																<td>
																	<h6 class="fw-medium fs-14">Calls</h6>
																</td>
																<td>250</td>
																<td>154</td>
																<td>
																	<div class="d-flex align-items-center">
																		<div class="progress progress-xs" style="width: 120px;">
																			<div class="progress-bar bg-purple rounded" role="progressbar" style="width: 40%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
																		</div>
																		<span class="d-inline-flex fs-12 ms-2">40%</span>
																	</div>
																</td>
																<td>
																	<a href="#" class="btn btn-sm btn-icon border btn-light"><i class="ti ti-edit"></i></a>
																</td>
															</tr>
															<tr>
																<td>
																	<div class="form-check form-check-md">
																		<input class="form-check-input" type="checkbox">
																	</div>
																</td>
																<td>
																	<h6 class="fw-medium fs-14">Settings</h6>
																</td>
																<td>220</td>
																<td>140</td>
																<td>
																	<div class="d-flex align-items-center">
																		<div class="progress progress-xs" style="width: 120px;">
																			<div class="progress-bar bg-skyblue rounded" role="progressbar" style="width: 60%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
																		</div>
																		<span class="d-inline-flex fs-12 ms-2">60%</span>
																	</div>
																</td>
																<td>
																	<a href="#" class="btn btn-sm btn-icon border btn-light"><i class="ti ti-edit"></i></a>
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