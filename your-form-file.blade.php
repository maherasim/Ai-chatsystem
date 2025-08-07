<x-master-layout>
    <script src="https://cdn.tiny.cloud/1/m5d82gd2rwdlg96hsxpx0e5wwmfrl2zzkcw35ys8o3glilgq/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-block card-stretch">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between align-items-center p-3 flex-wrap gap-3">
                            <h5 class="fw-bold">{{ $pageTitle ?? __('messages.list') }}</h5>
                            <a href="{{ route('service.index') }}" class=" float-end btn btn-sm btn-primary"><i
                                    class="fa fa-angle-double-left"></i> {{ __('messages.back') }}</a>
                            @if ($auth_user->can('service list'))
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        {{ html()->form('POST', route('service.store'))->attribute('enctype', 'multipart/form-data')->attribute('data-toggle', 'validator')->id('service')->open() }}
                        {{ html()->hidden('id', $servicedata->id ?? null) }}

                        <div class="row">
                            <div class="form-group col-md-2">
                                {{ html()->label(__('messages.name') . ' <span class="text-danger">*</span>', 'name')->class('form-control-label') }}
                                {{ html()->text('name', $servicedata->name)->placeholder(__('messages.name'))->class('form-control')->attributes(['title' => 'Please enter alphabetic characters and spaces only']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>

                            <div class="form-group col-md-2">
                                {{ html()->label(__('messages.select_name', ['select' => __('messages.category')]) . ' <span class="text-danger">*</span>', 'name')->class('form-control-label') }}
                                <br />
                                {{ html()->select(
                                        'category_id',
                                        [optional($servicedata->category)->id => optional($servicedata->category)->name],
                                        optional($servicedata->category)->id,
                                    )->class('select2js form-group category')->required()->id('category_id')->attribute('data-placeholder', __('messages.select_name', ['select' => __('messages.category')]))->attribute('data-ajax--url', route('ajax-list', ['type' => 'category'])) }}

                            </div>
                            <div class="form-group col-md-2">
                                {{ html()->label(__('messages.select_name', ['select' => __('messages.subcategory')]), 'subcategory_id')->class('form-control-label') }}
                                <br />
                                {{ html()->select('subcategory_id', [])->class('select2js form-group subcategory_id')->attribute('data-placeholder', __('messages.select_name', ['select' => __('messages.subcategory')])) }}
                            </div>

                            <div class="col-md-2">
                                <label
                                    for="country_id">{{ __('messages.select_name', ['select' => __('messages.country')]) }}</label>
                                <br />
                                <select name="country_id" id="country_id" class="select2js country"
                                    data-placeholder="{{ __('messages.select_name', ['select' => __('messages.country')]) }}"
                                    data-ajax--url="{{ route('ajax-list', ['type' => 'country']) }}">
                                    <option value="{{ optional($servicedata->country)->id }}" selected>
                                        {{ optional($servicedata->country)->name }}
                                    </option>
                                </select>
                            </div>
                            <div class=" col-md-2">
                                <label
                                    for="country_id">{{ __('messages.select_name', ['select' => __('Tax Country')]) }}</label>
                                {{ html()->select('tax_country_id_display', 
                                        optional($servicedata->tax_country)
                                            ? [optional($servicedata->tax_country)->id => optional($servicedata->tax_country)->name] 
                                            : []
                                    )
                                    ->class('form-group select2js tax_country')
                                    ->attribute('data-placeholder', __('messages.select_name', ['select' => __('messages.tax_country')]))
                                    ->attribute('data-ajax--url', route('ajax-list', ['type' => 'country']))
                                    ->attribute('disabled', true)
                                    ->id('tax_country_id_display')
                                }}
                            </div>

                            <div class="form-group col-md-2">
                                <label
                                    for="state_id">{{ __('messages.select_name', ['select' => __('messages.state')]) }}
                                    <span class="text-danger">*</span></label>
                                <select name="state_id" id="state_id" class="select2js form-group category" required
                                    data-placeholder="{{ __('messages.select_name', ['select' => __('messages.state')]) }}">
                                    <!-- State options will be populated dynamically -->
                                </select>
                            </div>

                            <div class="form-group col-md-2">
                                <label
                                    for="city_id">{{ __('messages.select_name', ['select' => __('messages.city')]) }}
                                    <span class="text-danger">*</span></label>
                                <select name="city_id" id="city_id" class="select2js form-group category" required
                                    data-placeholder="{{ __('messages.select_name', ['select' => __('messages.city')]) }}">
                                    <!-- City options will be populated dynamically -->
                                </select>
                            </div>

                            <input type="hidden" name="tax_country_id" id="tax_country_id" value="{{ old('tax_country_id', optional($servicedata->tax_country)->id) }}">

                            @if (auth()->user()->hasAnyRole(['admin', 'demo_admin']))
                                <div class="form-group col-md-4">
                                    {{ html()->label(__('messages.select_name', ['select' => __('messages.provider')]) . ' <span class="text-danger">*</span>', 'name')->class('form-control-label') }}
                                    <br />
                                    {{ html()->select(
                                            'provider_id',
                                            [optional($servicedata->providers)->id => optional($servicedata->providers)->display_name],
                                            optional($servicedata->providers)->id,
                                        )->class('select2js form-group')->id('provider_id')->attribute('onchange', 'selectprovider(this)')->required()->attribute('data-placeholder', __('messages.select_name', ['select' => __('messages.provider')]))->attribute('data-ajax--url', route('ajax-list', ['type' => 'provider'])) }}
                                </div>
                            @endif
                            <div class="form-group col-md-4">
                                {{ html()->label(__('messages.select_name', ['select' => __('messages.provider_address')]), 'name')->class('form-control-label') }}
                                <br />
                                {{ html()->select('provider_address_id[]', [], old('provider_address_id'))->class('select2js form-group provider_address_id')->id('provider_address_id')->multiple()->attribute('data-placeholder', __('messages.select_name', ['select' => __('messages.provider_address')])) }}

                                @if (auth()->user()->hasAnyRole(['provider']))
                                    <a href="{{ route('provideraddress.create', ['provideraddress' => auth()->id()]) }}"
                                        id="add_provider_address_link" class=""><i
                                            class="fa fa-plus-circle mt-2"></i>
                                        {{ trans('messages.add_form_title', ['form' => trans('messages.provider_address')]) }}</a>
                                @else
                                    <a href="{{ route('provideraddress.create', ['provideraddress' => auth()->id()]) }}"
                                        id="add_provider_address_link" class=""><i
                                            class="fa fa-plus-circle mt-2"></i>
                                        {{ trans('messages.add_form_title', ['form' => trans('messages.provider_address')]) }}</a>
                                @endif
                            </div>

                            <div class="form-group col-md-4">
                                {{ html()->label(__('messages.price_type') . ' <span class="text-danger">*</span>', 'type')->class('form-control-label') }}
                                {{ html()->select(
                                        'type',
                                        [
                                            'fixed' => __('messages.fixed'),
                                            'hourly' => __('messages.hourly'),
                                            'Daily' => __('Daily'), // Add 'daily' option here
                                            'free' => __('messages.free'),
                                        ],
                                        $servicedata->type,
                                    )->class('form-control select2js')->required()->id('price_type') }}
                            </div>
                            <div class="form-group col-md-4" id="price_div">
                                {{ html()->label(__('messages.price') . ' <span class="text-danger">*</span>', 'price')->class('form-control-label') }}
                                {{ html()->text('price', null)->attributes(['min' => 1, 'step' => 'any', 'pattern' => '^\\d+(\\.\\d{1,2})?$'])->placeholder(__('messages.price'))->class('form-control')->required()->id('price') }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>

                            <div class="form-group col-md-4" id="minimum_booking_div">
                                {{ html()->label(__('Minimum Booking'), 'minimum_booking')->class('form-control-label') }}
                                {{ html()->text('minimum_booking', isset($servicedata->minimum_booking) ? $servicedata->minimum_booking : null)->attributes(['step' => 'any'])->placeholder(__('minimum booking'))->class('form-control')->id('minimum_booking') }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>

                            <div class="form-group col-md-4" id="discount_div">
                                {{ html()->label(__('messages.discount') . ' %', 'discount')->class('form-control-label') }}
                                {{ html()->number('discount', null)->attributes(['min' => 0, 'max' => 99, 'step' => 'any'])->placeholder(__('messages.discount'))->class('form-control')->id('discount') }}
                                <span id="discount-error" class="text-danger"></span>
                            </div>

                            <div class="form-group col-md-4">
                                {{ html()->label(__('messages.duration') . ' (hours) ', 'duration')->class('form-control-label') }}
                                {{ html()->text('duration', $servicedata->duration)->placeholder(__('messages.duration'))->class('form-control min-datetimepicker-time') }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>

                            <div class="form-group col-md-4">
                                {{ html()->label(__('messages.status') . ' <span class="text-danger">*</span>', 'status')->class('form-control-label') }}
                                {{ html()->select('status', ['1' => __('messages.active'), '0' => __('messages.inactive')], $servicedata->status)->class('form-control select2js')->required() }}
                            </div>

                            <div class="form-group col-md-4">
                                {{ html()->label(__('messages.visit_type') . ' ', 'visit_type')->class('form-control-label') }}
                                <br />
                                {{ html()->select('visit_type', $visittype, $servicedata->visit_type)->id('visit_type')->class('form-control select2js')->required() }}
                            </div> 

                            <div class="form-group col-md-4">
                                @php
                                    // Comprehensive attachment loading logic
                                    $existingAttachments = collect();
                                    $hasExistingAttachments = false;
                                    
                                    // Check if we have service data and it has an ID (editing mode)
                                    if (isset($servicedata) && $servicedata && isset($servicedata->id) && $servicedata->id) {
                                        // Try multiple methods to get attachments
                                        if (method_exists($servicedata, 'getMedia')) {
                                            try {
                                                $existingAttachments = $servicedata->getMedia('service_attachment');
                                            } catch (Exception $e) {
                                                // Log error for debugging
                                                \Log::warning('Failed to load media attachments: ' . $e->getMessage());
                                            }
                                        }
                                        
                                        // Alternative: Check if there's a media relationship
                                        if ($existingAttachments->isEmpty() && method_exists($servicedata, 'media')) {
                                            try {
                                                $existingAttachments = $servicedata->media()->where('collection_name', 'service_attachment')->get();
                                            } catch (Exception $e) {
                                                \Log::warning('Failed to load media via relationship: ' . $e->getMessage());
                                            }
                                        }
                                        
                                        // Another alternative: Check for attachments table
                                        if ($existingAttachments->isEmpty()) {
                                            try {
                                                // This assumes you might have a direct attachments relationship
                                                if (method_exists($servicedata, 'attachments')) {
                                                    $existingAttachments = $servicedata->attachments;
                                                }
                                            } catch (Exception $e) {
                                                \Log::warning('Failed to load attachments via direct relationship: ' . $e->getMessage());
                                            }
                                        }
                                    }
                                    
                                    $hasExistingAttachments = $existingAttachments && $existingAttachments->count() > 0;
                                @endphp
                                <label class="form-control-label" for="service_attachment">{{ __('messages.image') }}
                                    <span class="text-danger attachment-required" @if($hasExistingAttachments) style="display: none;" @endif>*</span>
                                </label>
                                <div class="custom-file">
                                    <input type="file" 
                                           onchange="handleFilePreview(this)" 
                                           name="service_attachment[]"
                                           id="service_attachment"
                                           class="custom-file-input"
                                           data-file-error="{{ __('messages.files_not_allowed') }}" 
                                           accept="image/*"
                                           multiple
                                           @if(!$hasExistingAttachments) required @endif>
                                    <label class="custom-file-label upload-label" for="service_attachment">
                                        {{ __('messages.choose_file', ['file' => __('messages.attachments')]) }}
                                    </label>
                                </div>
                                <small class="form-text text-muted">
                                    {{ __('messages.allowed_file_types') }}: JPG, JPEG, PNG, GIF, WEBP
                                </small>
                            </div>
                            <div class="col-md-12">
                                <div id="service_attachment_preview_container" style="display: none; margin-top: 10px;">
                                    <label class="form-control-label">{{ __('messages.preview') }}:</label>
                                    <div id="service_attachment_previews" class="d-flex flex-wrap gap-2"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row service_attachment_div">
                            <div class="col-md-12">
                                @if ($hasExistingAttachments)
                                    @php
                                        $file_extention = config('constant.IMAGE_EXTENTIONS', ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'svg']);
                                    @endphp
                                    <div class="card">
                                        <div class="card-header">
                                            <h6 class="card-title mb-0">
                                                <i class="fas fa-images me-2"></i>{{ __('messages.existing_attachments') }} 
                                                <span class="badge bg-primary ms-2">{{ $existingAttachments->count() }}</span>
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row" id="existing_attachments_container">
                                                @foreach ($existingAttachments as $attachment)
                                                    @php
                                                        // Enhanced file URL handling
                                                        $fileUrl = '';
                                                        $fileName = '';
                                                        $fileSize = 0;
                                                        
                                                        // Try different methods to get file info
                                                        if (method_exists($attachment, 'getFullUrl')) {
                                                            $fileUrl = $attachment->getFullUrl();
                                                        } elseif (isset($attachment->url)) {
                                                            $fileUrl = $attachment->url;
                                                        } elseif (isset($attachment->path)) {
                                                            $fileUrl = asset('storage/' . $attachment->path);
                                                        }
                                                        
                                                        if (isset($attachment->file_name)) {
                                                            $fileName = $attachment->file_name;
                                                        } elseif (isset($attachment->name)) {
                                                            $fileName = $attachment->name;
                                                        } else {
                                                            $fileName = 'attachment_' . $attachment->id;
                                                        }
                                                        
                                                        if (isset($attachment->size)) {
                                                            $fileSize = $attachment->size;
                                                        }
                                                        
                                                        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                                                        $isImage = in_array($fileExtension, $file_extention);
                                                    @endphp
                                                    
                                                    <input type="hidden" name="existing_attachments[]" value="{{ $attachment->id }}" class="existing-attachment-input">
                                                    
                                                    <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3" id="attachment_{{ $attachment->id }}">
                                                        <div class="card h-100 attachment-card position-relative">
                                                            <div class="attachment-preview" style="height: 120px; overflow: hidden;">
                                                                @if ($isImage && $fileUrl)
                                                                    <a href="{{ $fileUrl }}" 
                                                                       class="attachment-link" 
                                                                       data-bs-toggle="modal" 
                                                                       data-bs-target="#imageModal"
                                                                       data-image-src="{{ $fileUrl }}"
                                                                       data-image-title="{{ $fileName }}">
                                                                        <img src="{{ $fileUrl }}" 
                                                                             class="card-img-top attachment-image" 
                                                                             alt="{{ $fileName }}"
                                                                             style="width: 100%; height: 120px; object-fit: cover;"
                                                                             loading="lazy"
                                                                             onerror="this.src='{{ asset('images/image-placeholder.png') }}'; this.onerror=null;">
                                                                    </a>
                                                                @else
                                                                    <div class="d-flex align-items-center justify-content-center h-100 bg-light">
                                                                        <i class="fas fa-file fa-2x text-muted"></i>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            
                                                            <div class="card-body p-2">
                                                                <h6 class="card-title text-truncate mb-1" style="font-size: 0.8rem;" title="{{ $fileName }}">
                                                                    {{ Str::limit($fileName, 20) }}
                                                                </h6>
                                                                @if($fileSize > 0)
                                                                    <small class="text-muted">{{ formatBytes($fileSize) }}</small>
                                                                @endif
                                                            </div>
                                                            
                                                            <button type="button" 
                                                                    class="btn btn-danger btn-sm position-absolute remove-attachment-btn"
                                                                    style="top: 5px; right: 5px; width: 25px; height: 25px; border-radius: 50%; padding: 0;"
                                                                    data-attachment-id="{{ $attachment->id }}"
                                                                    data-remove-url="{{ route('remove.file', ['id' => $attachment->id, 'type' => 'service_attachment']) }}"
                                                                    title="{{ __('messages.remove_file') }}">
                                                                <i class="fas fa-times" style="font-size: 0.7rem;"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle me-2"></i>
                                        {{ __('messages.no_attachments_found') }}. {{ __('messages.please_upload_images') }}.
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12">
                                {{ html()->label(__('messages.description'), 'description')->class('form-control-label') }}
                                {{ html()->textarea('description', $servicedata->description)->class('form-control textarea')->rows(3)->placeholder(__('messages.description')) }}
                            </div>
                            <div class="form-group col-md-12">
                                {{ html()->label(__('Cancellation Policy & Fees'), 'cancellation_policy')->class('form-control-label') }}
                                {{ html()->textarea('cancellation_policy', $servicedata->cancellation_policy)->class('form-control textarea')->rows(3)->placeholder(__('cancellation_policy')) }}
                            </div>
                            @if (!empty($slotservice) && $slotservice == 1)
                                <div class="form-group col-md-3">
                                    <div class="custom-control custom-switch">
                                        {{ html()->checkbox('is_slot', $servicedata->is_slot)->class('custom-control-input')->id('is_slot') }}
                                        <label class="custom-control-label"
                                            for="is_slot">{{ __('messages.slot') }}</label>
                                    </div>
                                </div>
                            @endif
                            @if (auth()->check() && auth()->user()->user_type === 'provider')
                                <div class="form-group col-md-3">
                                    <div class="custom-control custom-switch">
                                        {{ html()->checkbox('is_featured', $servicedata->is_featured)->class('custom-control-input')->id('is_featured') }}
                                        <label class="custom-control-label"
                                            for="is_featured">{{ __('messages.set_as_featured') }}</label>
                                    </div>
                                </div>
                            @endif
                            <div class="form-group col-md-3">
                                <div class="custom-control custom-switch">
                                    {{ html()->checkbox('is_enable_advance_payment', $servicedata->is_enable_advance_payment)->class('custom-control-input')->id('is_enable_advance_payment') }}
                                    <label class="custom-control-label"
                                        for="is_enable_advance_payment">{{ __('messages.enable_advanced_payment') }}
                                    </label>
                                </div>
                            </div>
                            <div class="form-group col-md-4" id="amount">
                                {{ html()->label(__('messages.advance_payment_amount') . ' <span class="text-danger"></span> (%)', 'advance_payment_amount')->class('form-control-label') }}
                                {{ html()->number('advance_payment_amount', $servicedata->advance_payment_amount)->placeholder(__('messages.amount'))->class('form-control')->id('advance_payment_amount')->attributes(['min' => 1, 'max' => 99]) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                        </div>

                        {{ html()->submit(__('messages.save'))->class('btn btn-md btn-primary float-end') }}
                        {{ html()->form()->close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Modal for viewing attachments -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">{{ __('messages.view_attachment') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" class="img-fluid" alt="Attachment">
                </div>
            </div>
        </div>
    </div>

    @php
        // Helper function for file size formatting
        if (!function_exists('formatBytes')) {
            function formatBytes($size, $precision = 2) {
                if ($size == 0) return '0 B';
                $base = log($size, 1024);
                $suffixes = array('B', 'KB', 'MB', 'GB', 'TB');
                return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
            }
        }
    @endphp
    @php
        $data = $servicedata->providerServiceAddress->pluck('provider_address_id')->implode(',');
    @endphp
    @section('bottom_script')
        <script type="text/javascript">
            // Global variables for attachment handling
            let attachmentValidation = {
                hasExistingAttachments: false,
                newFilesSelected: false
            };

            // Enhanced file preview function
            function handleFilePreview(input) {
                const previewContainer = document.getElementById('service_attachment_preview_container');
                const previewsDiv = document.getElementById('service_attachment_previews');
                
                if (input.files && input.files.length > 0) {
                    previewsDiv.innerHTML = '';
                    previewContainer.style.display = 'block';
                    attachmentValidation.newFilesSelected = true;
                    
                    Array.from(input.files).forEach((file, index) => {
                        if (file.type.startsWith('image/')) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                const previewDiv = document.createElement('div');
                                previewDiv.className = 'position-relative';
                                previewDiv.innerHTML = `
                                    <img src="${e.target.result}" 
                                         class="img-thumbnail" 
                                         style="width: 100px; height: 100px; object-fit: cover;"
                                         alt="Preview ${index + 1}">
                                    <button type="button" 
                                            class="btn btn-danger btn-sm position-absolute remove-preview-btn"
                                            style="top: -5px; right: -5px; width: 20px; height: 20px; border-radius: 50%; padding: 0;"
                                            data-file-index="${index}">
                                        <i class="fas fa-times" style="font-size: 0.6rem;"></i>
                                    </button>
                                `;
                                previewsDiv.appendChild(previewDiv);
                            };
                            reader.readAsDataURL(file);
                        }
                    });
                    
                    // Update file input label
                    const label = input.nextElementSibling;
                    if (label) {
                        label.textContent = `${input.files.length} file(s) selected`;
                    }
                } else {
                    previewContainer.style.display = 'none';
                    attachmentValidation.newFilesSelected = false;
                    
                    // Reset label
                    const label = input.nextElementSibling;
                    if (label) {
                        label.textContent = '{{ __('messages.choose_file', ['file' => __('messages.attachments')]) }}';
                    }
                }
                
                // Re-validate after file selection
                validateAttachments();
            }

            // Comprehensive attachment validation
            function validateAttachments() {
                const existingAttachments = document.querySelectorAll('.existing-attachment-input');
                const fileInput = document.getElementById('service_attachment');
                const requiredSpan = document.querySelector('.attachment-required');
                
                attachmentValidation.hasExistingAttachments = existingAttachments.length > 0;
                
                const hasAnyAttachments = attachmentValidation.hasExistingAttachments || 
                                        attachmentValidation.newFilesSelected ||
                                        (fileInput && fileInput.files && fileInput.files.length > 0);
                
                console.log('Attachment validation:', {
                    existingCount: existingAttachments.length,
                    newFilesSelected: attachmentValidation.newFilesSelected,
                    hasAnyAttachments: hasAnyAttachments
                });
                
                if (fileInput) {
                    if (hasAnyAttachments) {
                        fileInput.removeAttribute('required');
                        if (requiredSpan) requiredSpan.style.display = 'none';
                    } else {
                        fileInput.setAttribute('required', 'required');
                        if (requiredSpan) requiredSpan.style.display = 'inline';
                    }
                }
                
                return hasAnyAttachments;
            }

            // Enhanced file removal handler
            function handleAttachmentRemoval() {
                document.addEventListener('click', function(e) {
                    const removeBtn = e.target.closest('.remove-attachment-btn');
                    if (removeBtn) {
                        e.preventDefault();
                        
                        const attachmentId = removeBtn.dataset.attachmentId;
                        const removeUrl = removeBtn.dataset.removeUrl;
                        const attachmentContainer = document.getElementById(`attachment_${attachmentId}`);
                        
                        if (confirm('{{ __('messages.are_you_sure_remove_attachment') }}')) {
                            // Show loading state
                            removeBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                            removeBtn.disabled = true;
                            
                            // Make AJAX call to remove from server
                            fetch(removeUrl, {
                                method: 'GET',
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                                }
                            })
                            .then(response => {
                                if (response.ok) {
                                    // Remove from DOM
                                    if (attachmentContainer) {
                                        attachmentContainer.remove();
                                    }
                                    
                                    // Remove hidden input
                                    const hiddenInput = document.querySelector(`input[value="${attachmentId}"]`);
                                    if (hiddenInput) {
                                        hiddenInput.remove();
                                    }
                                    
                                    // Update validation
                                    setTimeout(validateAttachments, 100);
                                    
                                    // Show success message
                                    showNotification('{{ __('messages.attachment_removed_successfully') }}', 'success');
                                    
                                    // Check if no more attachments exist
                                    const remainingAttachments = document.querySelectorAll('.existing-attachment-input');
                                    if (remainingAttachments.length === 0) {
                                        const alertDiv = document.createElement('div');
                                        alertDiv.className = 'alert alert-info';
                                        alertDiv.innerHTML = `
                                            <i class="fas fa-info-circle me-2"></i>
                                            {{ __('messages.no_attachments_found') }}. {{ __('messages.please_upload_images') }}.
                                        `;
                                        document.getElementById('existing_attachments_container').parentElement.parentElement.replaceWith(alertDiv);
                                    }
                                } else {
                                    throw new Error('Failed to remove attachment');
                                }
                            })
                            .catch(error => {
                                console.error('Error removing attachment:', error);
                                showNotification('{{ __('messages.error_removing_attachment') }}', 'error');
                                
                                // Reset button state
                                removeBtn.innerHTML = '<i class="fas fa-times"></i>';
                                removeBtn.disabled = false;
                            });
                        }
                    }
                });
            }

            // Notification helper
            function showNotification(message, type = 'info') {
                const alertClass = type === 'success' ? 'alert-success' : 
                                 type === 'error' ? 'alert-danger' : 'alert-info';
                
                const notification = document.createElement('div');
                notification.className = `alert ${alertClass} alert-dismissible fade show position-fixed`;
                notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; max-width: 300px;';
                notification.innerHTML = `
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                `;
                
                document.body.appendChild(notification);
                
                // Auto-remove after 5 seconds
                setTimeout(() => {
                    if (notification.parentElement) {
                        notification.remove();
                    }
                }, 5000);
            }

            // Form submission validation
            function validateFormSubmission() {
                const isValid = validateAttachments();
                
                if (!isValid) {
                    showNotification('{{ __('messages.please_upload_at_least_one_image') }}', 'error');
                    return false;
                }
                
                return true;
            }

            // Initialize everything when DOM is ready
            document.addEventListener('DOMContentLoaded', function() {
                // Initialize attachment validation
                validateAttachments();
                
                // Setup file removal handler
                handleAttachmentRemoval();
                
                // Provider selection handler
                const initialProviderId = document.getElementById('provider_id')?.value;
                if (initialProviderId) {
                    selectprovider({ value: initialProviderId });
                }
                
                // Provider address link handler
                const addProviderAddressLink = document.getElementById('add_provider_address_link');
                if (addProviderAddressLink) {
                    addProviderAddressLink.addEventListener('click', function(event) {
                        event.preventDefault();
                        const providerId = document.getElementById('provider_id').value;
                        let providerAddressCreateUrl = "{{ route('provideraddress.create', ['provideraddress' => '']) }}";
                        providerAddressCreateUrl = providerAddressCreateUrl.replace('provideraddress=', 'provideraddress=' + providerId);
                        window.location.href = providerAddressCreateUrl;
                    });
                }
                
                // Form submission handler
                const form = document.getElementById('service');
                if (form) {
                    form.addEventListener('submit', function(e) {
                        if (!validateFormSubmission()) {
                            e.preventDefault();
                            return false;
                        }
                    });
                }
                
                // Initialize discount validation
                const discountInput = document.getElementById('discount');
                const discountError = document.getElementById('discount-error');
                
                if (discountInput) {
                    discountInput.addEventListener('input', function() {
                        const discountValue = parseFloat(discountInput.value);
                        if (isNaN(discountValue) || discountValue < 0 || discountValue > 99) {
                            discountError.textContent = "{{ __('Discount value should be between 0 to 99') }}";
                        } else {
                            discountError.textContent = "";
                        }
                    });
                }
                
                // Initialize image modal functionality
                document.addEventListener('click', function(e) {
                    const attachmentLink = e.target.closest('.attachment-link');
                    if (attachmentLink) {
                        e.preventDefault();
                        const imageSrc = attachmentLink.dataset.imageSrc;
                        const imageTitle = attachmentLink.dataset.imageTitle;
                        
                        document.getElementById('modalImage').src = imageSrc;
                        document.getElementById('imageModalLabel').textContent = imageTitle || '{{ __('messages.view_attachment') }}';
                        
                        // Show modal (Bootstrap 5)
                        const modal = new bootstrap.Modal(document.getElementById('imageModal'));
                        modal.show();
                    }
                });
                
                console.log('Service attachment system initialized successfully');
            });

            function selectprovider(selectElement) {
                const providerId = selectElement.value;
                const addProviderAddressLink = document.getElementById('add_provider_address_link');

                if (addProviderAddressLink) {
                    if (providerId) {
                        addProviderAddressLink.classList.remove('d-none');
                    } else {
                        addProviderAddressLink.classList.add('d-none');
                    }
                }
            }



            var isEnableAdvancePayment = $("input[name='is_enable_advance_payment']").prop('checked');
            var priceType = $("#price_type").val();

            enableAdvancePayment(priceType);
            checkEnablePayment(isEnableAdvancePayment);

            $("#is_enable_advance_payment").change(function() {
                isEnableAdvancePayment = $(this).prop('checked');
                checkEnablePayment(isEnableAdvancePayment);
                updateAmountVisibility(priceType, isEnableAdvancePayment);
            });

            $("#price_type").change(function() {
                priceType = $(this).val();
                enableAdvancePayment(priceType);
                updateAmountVisibility(priceType, isEnableAdvancePayment);
                handleDurationField(priceType);
            });

            function checkEnablePayment(value) {
                $("#amount").toggleClass('d-none', !value);
                $('#advance_payment_amount').prop('required', value);
            }

            function enableAdvancePayment(type) {
                $("#is_enable_advance").toggleClass('d-none', !(type === 'fixed' || type === 'hourly' || type.toLowerCase() === 'daily'));
            }

            function updateAmountVisibility(type, isEnableAdvancePayment) {
                const allowedTypes = ['fixed', 'hourly', 'daily'];
                const typeLower = type.toLowerCase();

                if (allowedTypes.includes(typeLower) && !$("#is_enable_advance").hasClass('d-none') && isEnableAdvancePayment) {
                    $("#amount").removeClass('d-none');
                } else {
                    $("#amount").addClass('d-none');
                }
            }

            function handleDurationField(type) {
                var $duration = $('#duration');

                if (type === 'hourly') {
                    $duration.val(1).prop('readonly', true).prop('disabled', true);
                } else if (type.toLowerCase() === 'daily') {
                    $duration.val(8).prop('readonly', true).prop('disabled', true);
                } else {
                    $duration.prop('readonly', false).prop('disabled', false);
                }
            }

            (function($) {
                "use strict";
                $(document).ready(function() {
                    var provider_id = "{{ isset($servicedata->provider_id) ? $servicedata->provider_id : '' }}";
                    var provider_address_id = "{{ isset($data) ? $data : [] }}";
                    var category_id = "{{ isset($servicedata->category_id) ? $servicedata->category_id : '' }}";
                    var subcategory_id = "{{ isset($servicedata->subcategory_id) ? $servicedata->subcategory_id : '' }}";
                    var country_id = "{{ isset($servicedata->country_id) ? $servicedata->country_id : '' }}";
                    var tax_country_id = "{{ isset($servicedata->tax_country_id) ? $servicedata->tax_country_id : '' }}";
                    var state_id = "{{ isset($servicedata->state_id) ? $servicedata->state_id : '' }}";
                    var city_id = "{{ isset($servicedata->city_id) ? $servicedata->city_id : '' }}";
                    var price_type = "{{ isset($servicedata->type) ? $servicedata->type : '' }}";

                    // Initialize all components
                    providerAddress(provider_id, provider_address_id);
                    getSubCategory(category_id, subcategory_id);
                    getStates(country_id, state_id);
                    getCities(state_id, city_id);
                    priceformat(price_type);
                    handleDurationField(price_type);

                    // Initialize tax country
                    if (tax_country_id) {
                        var taxCountryName = $('#tax_country_id_display option:selected').text();
                        setTaxCountry(tax_country_id, taxCountryName);
                    } else if (country_id) {
                        var selectedCountryName = $('#country_id option:selected').text();
                        setTaxCountry(country_id, selectedCountryName);
                    }

                    // Event handlers
                    $(document).on('change', '#provider_id', function() {
                        var provider_id = $(this).val();
                        $('#provider_address_id').empty();
                        providerAddress(provider_id, provider_address_id);
                    });

                    $(document).on('change', '#category_id', function() {
                        var category_id = $(this).val();
                        $('#subcategory_id').empty();
                        getSubCategory(category_id, subcategory_id);
                    });

                    $(document).on('change', '#country_id', function() {
                        var selectedCountryId = $(this).val();
                        var selectedCountryName = $('#country_id option:selected').text();
                        
                        var currentTaxVal = $('#tax_country_id').val();
                        if (!currentTaxVal || currentTaxVal === country_id) {
                            setTaxCountry(selectedCountryId, selectedCountryName);
                        }

                        getStates(selectedCountryId, '');
                        $('#city_id').empty();

                        $('#tax_country_id_display').empty()
                            .append(new Option(selectedCountryName, selectedCountryId, true, true))
                            .trigger('change');
                        $('#tax_country_id').val(selectedCountryId).trigger('change');
                    });

                    $(document).on('change', '#state_id', function() {
                        var selectedStateId = $(this).val();
                        getCities(selectedStateId, '');
                    });

                    // Gallery initialization
                    $('.galary').each(function(index, value) {
                        let galleryClass = $(value).attr('data-gallery');
                        $(galleryClass).magnificPopup({
                            delegate: 'a#attachment_files',
                            type: 'image',
                            gallery: {
                                enabled: true,
                                navigateByImgClick: true,
                                preload: [0, 1]
                            },
                            callbacks: {
                                elementParse: function(item) {
                                    if (item.el[0].className.includes('video')) {
                                        item.type = 'iframe';
                                        item.iframe = {
                                            markup: '<div class="mfp-iframe-scaler">' +
                                                '<div class="mfp-close"></div>' +
                                                '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>' +
                                                '<div class="mfp-title">Some caption</div>' +
                                                '</div>'
                                        };
                                    } else {
                                        item.type = 'image';
                                        item.tLoading = 'Loading image #%curr%...';
                                        item.mainClass = 'mfp-img-mobile';
                                        item.image = {
                                            tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
                                        };
                                    }
                                }
                            }
                        });
                    });
                });

                // Helper functions
                function setTaxCountry(id, name) {
                    if (!id || !name) return;
                    $('#tax_country_id').val(id).trigger('change');
                    $('#tax_country_id_display').empty()
                        .append(new Option(name, id, true, true))
                        .trigger('change');
                }

                function providerAddress(provider_id, provider_address_id = "") {
                    if (!provider_id) return;
                    
                    var provider_address_route =
                        "{{ route('ajax-list', ['type' => 'provider_address', 'provider_id' => '']) }}" + provider_id;
                    provider_address_route = provider_address_route.replace('amp;', '');

                    $.ajax({
                        url: provider_address_route,
                        success: function(result) {
                            $('#provider_address_id').select2({
                                width: '100%',
                                placeholder: "{{ trans('messages.select_name', ['select' => trans('messages.provider_address')]) }}",
                                data: result.results
                            });
                            if (provider_address_id != "") {
                                $('#provider_address_id').val(provider_address_id.split(',')).trigger('change');
                            }
                        }
                    });
                }

                function getSubCategory(category_id, subcategory_id = "") {
                    if (!category_id) return;
                    
                    var get_subcategory_list =
                        "{{ route('ajax-list', ['type' => 'subcategory_list', 'category_id' => '']) }}" + category_id;
                    get_subcategory_list = get_subcategory_list.replace('amp;', '');

                    $.ajax({
                        url: get_subcategory_list,
                        success: function(result) {
                            $('#subcategory_id').select2({
                                width: '100%',
                                placeholder: "{{ trans('messages.select_name', ['select' => trans('messages.subcategory')]) }}",
                                data: result.results
                            });
                            if (subcategory_id != "") {
                                $('#subcategory_id').val(subcategory_id).trigger('change');
                            }
                        }
                    });
                }

                function getStates(country_id, selectedState = "") {
                    if (!country_id) return;
                    
                    var getStateListUrl = "{{ route('ajax-list', ['type' => 'state', 'country_id' => '']) }}" + country_id;
                    getStateListUrl = getStateListUrl.replace('amp;', '');

                    $('#state_id').select2({
                        width: '100%',
                        placeholder: "{{ __('messages.select_name', ['select' => __('messages.state')]) }}"
                    });

                    $.ajax({
                        url: getStateListUrl,
                        success: function(result) {
                            $('#state_id').empty();
                            result.results.forEach(function(state) {
                                var option = new Option(state.text, state.id, false, false);
                                $('#state_id').append(option);
                            });

                            if (selectedState !== null && selectedState !== 0) {
                                $("#state_id").val(selectedState).trigger('change');
                            }
                        }
                    });
                }

                function getCities(state_id, selectedCity = "") {
                    if (!state_id) return;
                    
                    var getCityListUrl = "{{ route('ajax-list', ['type' => 'city', 'state_id' => '']) }}" + state_id;
                    getCityListUrl = getCityListUrl.replace('amp;', '');

                    $('#city_id').select2({
                        width: '100%',
                        placeholder: "{{ __('messages.select_name', ['select' => __('messages.city')]) }}"
                    });

                    $.ajax({
                        url: getCityListUrl,
                        success: function(result) {
                            $('#city_id').empty();
                            result.results.forEach(function(city) {
                                var option = new Option(city.text, city.id, false, false);
                                $('#city_id').append(option);
                            });

                            if (selectedCity !== null && selectedCity !== 0) {
                                $("#city_id").val(selectedCity).trigger('change');
                            }
                        }
                    });
                }

                var price = "{{ isset($servicedata->price) ? $servicedata->price : '' }}";
                var discount = "{{ isset($servicedata->discount) ? $servicedata->discount : '' }}";

                function priceformat(value) {
                    if (value == 'free') {
                        $('#price').val(0);
                        $('#price').attr("readonly", true);
                        $('#discount').val(0);
                        $('#discount').attr("readonly", true);
                    } else {
                        $('#price').val(price);
                        $('#price').attr("readonly", false);
                        $('#discount').val(discount);
                        $('#discount').attr("readonly", false);
                    }
                }
            })(jQuery);
        </script>

        <!-- TinyMCE Scripts -->
        <script>
            tinymce.init({
                selector: '#description',
                plugins: 'lists link image preview',
                toolbar: 'undo redo | bold italic | bullist numlist | link image preview',
                menubar: false
            });

            tinymce.init({
                selector: '#cancellation_policy',
                plugins: 'lists link image preview',
                toolbar: 'undo redo | bold italic | bullist numlist | link image preview',
                menubar: false
            });
        </script>
    @endsection
</x-master-layout>