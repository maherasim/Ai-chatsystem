@if (Route::is(['ban-address']))
<!-- Add Ban Address -->
<div class="modal fade" id="add_ban">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New IP Address</h4>
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <form action="{{url('admin/ban-address')}}">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">IP Address</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div>
                                <label class="form-label">Reason</label>
                                <textarea class="form-control"></textarea>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer pt-0">
                    <div class="d-flex w-100 justify-content-between">
                        <a href="#" class="btn btn-outline-primary me-2 d-flex justify-content-center w-100" data-bs-dismiss="modal">Cancel</a>
                        <button type="submit" class="btn btn-primary d-flex justify-content-center w-100">Add IP Addresss</button>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</div>
<!-- / Add Ban Address -->

<!-- Edit Ban Address -->
<div class="modal fade" id="edit_ban">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Ban IP Address</h4>
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <form action="{{url('admin/ban-address')}}">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">IP Address</label>
                                <input type="text" class="form-control" value="198.120.16.01">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div>
                                <label class="form-label">Reason</label>
                                <textarea class="form-control">Temporarily block to protect user accounts from internet fraudsters</textarea>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer pt-0">
                    <div class="d-flex w-100 justify-content-between">
                        <a href="#" class="btn btn-outline-primary me-2 d-flex justify-content-center w-100" data-bs-dismiss="modal">Cancel</a>
                        <button type="submit" class="btn btn-primary d-flex justify-content-center w-100">Add IP Addresss</button>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</div>
<!-- /Edit Ban Address -->
@endif
@if (Route::is(['abuse-message']))
	<!-- Delete Modal -->
    <div class="modal fade" id="delete-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{url('admin/abuse-message')}}">
                    <div class="modal-body text-center">
                        <span class="delete-icon">
                            <i class="ti ti-trash-x"></i>
                        </span>
                        <h4>Confirm Deletion</h4>
                        <p>You want to delete all the marked items, this cant be undone once you delete.</p>
                        <div class="d-flex justify-content-center">
                            <a href="javascript:void(0);" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</a>
                            <button type="submit" class="btn btn-danger">Yes, Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Delete Modal -->
@endif

@if (Route::is(['call']))

<!-- Delete Modal -->
<div class="modal fade" id="delete-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{url('admin/call')}}">
                <div class="modal-body text-center">
                    <span class="delete-icon">
                        <i class="ti ti-trash-x"></i>
                    </span>
                    <h4>Confirm Deletion</h4>
                    <p>You want to delete all the marked items, this cant be undone once you delete.</p>
                    <div class="d-flex justify-content-center">
                        <a href="javascript:void(0);" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</a>
                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Delete Modal -->
@endif
@if (Route::is(['chat']))
<!-- Delete Modal -->
<div class="modal fade" id="delete-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{url('admin/chat')}}">
                <div class="modal-body text-center">
                    <span class="delete-icon">
                        <i class="ti ti-trash-x"></i>
                    </span>
                    <h4>Confirm Deletion</h4>
                    <p>You want to delete all the marked items, this cant be undone once you delete.</p>
                    <div class="d-flex justify-content-center">
                        <a href="javascript:void(0);" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</a>
                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Delete Modal -->
@endif
@if (Route::is(['chat-settings']))
<!-- Gif -->
<div class="modal fade" id="add_gif">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Gif Settings</h4>
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <form action="{{url('admin/chat-settings')}}">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Tenor API Key</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div>
                                <label class="form-label">GIF Limit</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer pt-0">
                    <div class="d-flex w-100 justify-content-between">
                        <a href="#" class="btn btn-outline-primary me-2 d-flex justify-content-center w-100"
                            data-bs-dismiss="modal">Cancel</a>
                        <button type="submit"
                            class="btn btn-primary d-flex justify-content-center w-100">Submit</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- /Gif -->
@endif
@if (Route::is(['custom-fields']))
<!-- Add New Fields -->
<div class="modal fade" id="new-field">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Add Custom Field
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('admin/custom-fields')}}">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Module</label>
                                <select class="select">
                                    <option>Select</option>
                                    <option>User</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Label</label>
                                <input class="form-control" type="text">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Default Value</label>
                                <input class="form-control" type="text">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Input Type</label>
                                <select class="select">
                                    <option>Select</option>
                                    <option>Text</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="d-flex mb-3">
                                <label class="form-label me-3">Required</label>
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="radio" name="required" id="required1" checked>
                                    <label class="form-check-label" for="required1">Yes</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="required" type="radio" id="required2">
                                    <label class="form-check-label" for="required2">No</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <Select class="select">
                                    <option>Active</option>
                                    <option>Inactive</option>
                                </Select>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">       
                        <div class="col-6">                  
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>     
                        <div class="col-6">      
                            <button type="submit" class="btn btn-primary w-100">Save Changes</button>
                        </div> 
                    </div>
                </form>
            </div>       
        </div>
    </div>
</div>
<!-- /Add New Fields -->

<!-- Edit New Fields -->
<div class="modal fade" id="edit-field">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Edit Custom Field
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('admin/custom-fields')}}">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Module</label>
                                <select class="select">
                                    <option>Select</option>
                                    <option>User</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Label</label>
                                <input class="form-control" type="text" value="Middle Name">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Default Value</label>
                                <input class="form-control" type="text">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Input Type</label>
                                <select class="select">
                                    <option>Select</option>
                                    <option selected>Text</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="d-flex mb-3">
                                <label class="form-label me-3">Required</label>
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="radio" name="required" id="required1" checked>
                                    <label class="form-check-label" for="required1">Yes</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="required" type="radio" id="required2">
                                    <label class="form-check-label" for="required2">No</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <Select class="select">
                                    <option selected>Active</option>
                                    <option>Inactive</option>
                                </Select>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">       
                        <div class="col-6">                  
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>     
                        <div class="col-6">      
                            <button type="submit" class="btn btn-primary w-100">Save Changes</button>
                        </div> 
                    </div>
                </form>
            </div>       
        </div>
    </div>
</div>
<!-- /Edit New Fields -->
@endif
@if (Route::is(['email-settings']))
<!-- Php Mail -->
<div class="modal fade" id="php_mail">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">PHP EMail</h4>
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <form action="{{url('admin/email-settings')}}">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">From Email Address </label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email Password  </label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">From Name </label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="row gx-3">
                        <div class="col-6">
                            <button type="button" class="btn btn-outline-primary w-100" data-bs-dismiss="modal">Cancel</button>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Php Mail -->

<!-- Smtp Mail -->
<div class="modal fade" id="smtp_mail">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">SMTP</h4>
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <form action="{{url('admin/email-settings')}}">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">From Email Address </label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email Password  </label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Host</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Port</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="row gx-3">
                        <div class="col-6">
                            <button type="button" class="btn btn-outline-primary w-100" data-bs-dismiss="modal">Cancel</button>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Smtp Mail -->
@endif
@if(Route::is(['group']))
<!-- Delete Modal -->
<div class="modal fade" id="delete-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{url('admin/group')}}">
                <div class="modal-body text-center">
                    <span class="delete-icon">
                        <i class="ti ti-trash-x"></i>
                    </span>
                    <h4>Confirm Deletion</h4>
                    <p>You want to delete all the marked items, this cant be undone once you delete.</p>
                    <div class="d-flex justify-content-center">
                        <a href="javascript:void(0);" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</a>
                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Delete Modal -->
@endif
@if(Route::is(['integrations']))
	<!-- Captcha -->
    <div class="modal fade" id="add_captcha">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Configure Google Captcha</h4>
                    <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
                <form action="{{url('admin/integrations')}}">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Google Rechaptcha Site Key </label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div>
                                    <label class="form-label">Google Rechaptcha Secret Key </label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer pt-0">
                        <div class="d-flex w-100 justify-content-between">
                            <a href="#" class="btn btn-outline-primary me-2 d-flex justify-content-center w-100"
                                data-bs-dismiss="modal">Cancel</a>
                            <button type="submit"
                                class="btn btn-primary d-flex justify-content-center w-100">Submit</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- /Captcha -->

    <!-- agora -->
    <div class="modal fade" id="add_agora">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Agora Configuration</h4>
                    <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
                <form action="{{url('admin/integrations')}}">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Agora Application key </label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div>
                                    <label class="form-label">APNS Key </label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer pt-0">
                        <div class="d-flex w-100 justify-content-between">
                            <a href="#" class="btn btn-outline-primary me-2 d-flex justify-content-center w-100"
                                data-bs-dismiss="modal">Cancel</a>
                            <button type="submit"
                                class="btn btn-primary d-flex justify-content-center w-100">Submit</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- /Agora -->

    <!-- Firebase -->
    <div class="modal fade" id="add_fire">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Firebase Configuration</h4>
                    <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
                <form action="{{url('admin/integrations')}}">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Firebase Server Key </label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div>
                                    <label class="form-label">APNS Key </label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer pt-0">
                        <div class="d-flex w-100 justify-content-between">
                            <a href="#" class="btn btn-outline-primary me-2 d-flex justify-content-center w-100"
                                data-bs-dismiss="modal">Cancel</a>
                            <button type="submit"
                                class="btn btn-primary d-flex justify-content-center w-100">Submit</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- /Apple -->
    @endif
    @if(Route::is(['invite-user']))
    <!-- Delete Modal -->
		<div class="modal fade" id="delete-modal">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<form action="{{url('admin/invite-user')}}">
						<div class="modal-body text-center">
							<span class="delete-icon">
								<i class="ti ti-trash-x"></i>
							</span>
							<h4>Confirm Deletion</h4>
							<p>You want to delete all the marked items, this cant be undone once you delete.</p>
							<div class="d-flex justify-content-center">
								<a href="javascript:void(0);" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</a>
								<button type="submit" class="btn btn-danger">Yes, Delete</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- /Delete Modal -->
 @endif
 @if(Route::is(['sms-settings']))
<!-- Php Mail -->
<div class="modal fade" id="sms_mail">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nexmo</h4>
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <form action="{{url('admin/sms-settings')}}">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">API Key </label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">API Secret Key </label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sender ID </label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="row gx-3">
                        <div class="col-6">
                            <button type="button" class="btn btn-outline-primary w-100" data-bs-dismiss="modal">Cancel</button>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Php Mail -->

 @endif
 @if(Route::is(['social-auth']))
 <!-- Google -->
 <div class="modal fade" id="add_google">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Google Login Settings</h4>
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <form action="{{url('admin/social-auth')}}">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Client ID </label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Consumer Secret (Secret Key) </label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div>
                                <label class="form-label">Login Redirect URL </label>
                                <input type="email" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer pt-0">
                    <div class="d-flex w-100 justify-content-between">
                        <a href="#" class="btn btn-outline-primary me-2 d-flex justify-content-center w-100"
                            data-bs-dismiss="modal">Cancel</a>
                        <button type="submit"
                            class="btn btn-primary d-flex justify-content-center w-100">Submit</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- /Google -->

<!-- Facebook -->
<div class="modal fade" id="add_facebook">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Facebook Login Settings</h4>
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <form action="{{url('admin/social-auth')}}">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Consumer Key (API Key) </label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Consumer Secret (Secret Key) </label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div>
                                <label class="form-label">Login Redirect URL </label>
                                <input type="email" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer pt-0">
                    <div class="d-flex w-100 justify-content-between">
                        <a href="#" class="btn btn-outline-primary me-2 d-flex justify-content-center w-100"
                            data-bs-dismiss="modal">Cancel</a>
                        <button type="submit"
                            class="btn btn-primary d-flex justify-content-center w-100">Submit</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- /Facebook -->

<!-- Apple -->
<div class="modal fade" id="add_apple">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Apple Login Settings</h4>
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <form action="{{url('admin/social-auth')}}">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Client ID </label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Consumer Secret (Secret Key) </label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div>
                                <label class="form-label">Login Redirect URL </label>
                                <input type="email" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer pt-0">
                    <div class="d-flex w-100 justify-content-between">
                        <a href="#" class="btn btn-outline-primary me-2 d-flex justify-content-center w-100"
                            data-bs-dismiss="modal">Cancel</a>
                        <button type="submit"
                            class="btn btn-primary d-flex justify-content-center w-100">Submit</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- /Apple -->

 @endif
 @if(Route::is(['storage']))
	<!-- AWS -->
    <div class="modal fade" id="add_aws">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">AWS Settings</h4>
                    <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
                <form action="{{url('admin/storage')}}">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">AWS Access Key </label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Secret Key </label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Bucket Name </label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Region </label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div>
                                    <label class="form-label">Base URL </label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer pt-0">
                        <div class="d-flex w-100 justify-content-between">
                            <a href="#" class="btn btn-outline-primary me-2 d-flex justify-content-center w-100"
                                data-bs-dismiss="modal">Cancel</a>
                            <button type="submit"
                                class="btn btn-primary d-flex justify-content-center w-100">Submit</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- /AWS -->
 @endif
 @if(Route::is(['stories']))
<!-- Delete Modal -->
<div class="modal fade" id="delete-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{url('admin/stories')}}">
                <div class="modal-body text-center">
                    <span class="delete-icon">
                        <i class="ti ti-trash-x"></i>
                    </span>
                    <h4>Confirm Deletion</h4>
                    <p>You want to delete all the marked items, this cant be undone once you delete.</p>
                    <div class="d-flex justify-content-center">
                        <a href="javascript:void(0);" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</a>
                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Delete Modal -->

 @endif

 @if(Route::is(['users']))
 <!-- Add user -->
 <div class="modal fade" id="add_user">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New User</h4>
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <form action="{{url('admin/users')}}">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex align-items-center row-gap-2 mb-3 upload-frames">                                                
                                <div class="outer-frames">
                                    <a href="#" id="uploadLink">
                                        <div class="frames">
                                        </div>
                                        <span class="frame-add rounded-circle"><i class="ti ti-plus"></i></span>   
                                    </a>
                                    <input type="file" id="imageInput" accept="image/*" style="display: none;">
                                </div>                                           
                                <div class="profile-upload">
                                    <div class="profile-content">
                                        <p class="fs-14">Upload Image</p>
                                        <span>Image should be below 4 mb</span>
                                    </div>
                                    <div class="profile-uploader d-flex align-items-center">
                                        <div class="drag-upload-btn mb-0">
                                            Upload
                                            <input type="file" class="form-control image-sign" multiple="">
                                        </div>
                                        <a href="javascript:void(0);" class="btn btn-md btn-outline-primary mb-0">Remove</a>
                                    </div>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="email" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Phone Number</label>
                                <input type="email" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
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
                </div>
                <div class="modal-footer pt-0">
                    <div class="d-flex w-100 justify-content-between">
                        <a href="#" class="btn btn-outline-primary me-2 d-flex justify-content-center w-100" data-bs-dismiss="modal">Cancel</a>
                        <button type="submit" class="btn btn-primary d-flex justify-content-center w-100">Add  User</button>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</div>
<!-- /Add user -->

<!-- Edit user -->
<div class="modal fade" id="edit_user">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit User</h4>
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <form action="{{url('admin/users')}}">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex align-items-center row-gap-2 mb-3 upload-frames">                                                
                                <div class="outer-frames">
                                    <a href="#">
                                        <div class="frames d-flex justify-content-center align-items-end">
                                            <img src="{{URL::asset('assets/img/users/user-01.jpg')}}" alt="image" class="img-fluid avatar avatar-xl  rounded-circle">
                                        </div>
                                        <span class="frame-add rounded-circle"><i class="ti ti-plus"></i></span>   
                                    </a>
                                </div>                                           
                                <div class="profile-upload">
                                    <div class="profile-content">
                                        <p class="fs-14">Upload Image</p>
                                        <span>Image should be below 4 mb</span>
                                    </div>
                                    <div class="profile-uploader d-flex align-items-center">
                                        <div class="drag-upload-btn mb-0">
                                            Upload
                                            <input type="file" class="form-control image-sign" multiple="">
                                        </div>
                                        <a href="javascript:void(0);" class="btn btn-md btn-outline-primary mb-0">Remove</a>
                                    </div>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" value="Aaryian ">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" value="Jose">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="email" class="form-control" value="aaryian@example.com">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Phone Number</label>
                                <input type="email" class="form-control" value="514-245-98315">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Country</label>
                                <select class="select">
                                    <option>Select</option>
                                    <option selected>United States</option>
                                    <option>Germany</option>
                                    <option>Canada</option>
                                    <option>Australia</option>
                                </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer pt-0">
                    <div class="d-flex w-100 justify-content-between">
                        <a href="#" class="btn btn-outline-primary me-2 d-flex justify-content-center w-100" data-bs-dismiss="modal">Cancel</a>
                        <button type="submit" class="btn btn-primary d-flex justify-content-center w-100">Save Changes</button>
                    </div>
                </div>
            </form>					
        </div>
    </div>
</div>
<!-- /Edit user -->



<!-- Delete Modal -->
<div class="modal fade" id="delete-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{url('admin/users')}}">
                <div class="modal-body text-center">
                    <span class="delete-icon">
                        <i class="ti ti-trash-x"></i>
                    </span>
                    <h4>Confirm Deletion</h4>
                    <p>You want to delete all the marked items, this cant be undone once you delete.</p>
                    <div class="d-flex justify-content-center">
                        <a href="javascript:void(0);" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</a>
                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Delete Modal -->
@endif
@if (Route::is(['report-user']))
<!-- Delete Modal -->
<div class="modal fade" id="delete-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{url('admin/report-user')}}">
                <div class="modal-body text-center">
                    <span class="delete-icon">
                        <i class="ti ti-trash-x"></i>
                    </span>
                    <h4>Confirm Deletion</h4>
                    <p>You want to delete all the marked items, this cant be undone once you delete.</p>
                    <div class="d-flex justify-content-center">
                        <a href="javascript:void(0);" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</a>
                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Delete Modal -->
<!-- Report Reason -->
<div class="modal fade" id="report_reason">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Report Reason</h4>
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <p><i class="ti ti-info-circle me-2"></i>Directing hate against a protected category (e.g., race, religion, 
                    gender, orientation, disability)</p>
                <div class="close-btn">
                    <a href="#" class="btn btn-primary close-btn" data-bs-dismiss="modal">Close</a>
                </div>
            </div>
            
        </div>
    </div>
</div>
<!-- Report Reason -->
@endif