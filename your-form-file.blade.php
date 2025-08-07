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
                                    // Handle both edit and create scenarios
                                    $existingAttachments = collect();
                                    if (isset($servicedata) && $servicedata && method_exists($servicedata, 'getMedia')) {
                                        try {
                                            $existingAttachments = $servicedata->getMedia('service_attachment');
                                        } catch (Exception $e) {
                                            // Fallback if getMedia fails
                                            $existingAttachments = collect();
                                        }
                                    }
                                    $hasExistingAttachments = $existingAttachments->count() > 0;
                                @endphp
                                <label class="form-control-label" for="service_attachment">{{ __('messages.image') }}
                                    @if(!$hasExistingAttachments)
                                        <span class="text-danger">*</span>
                                    @endif
                                </label>
                                <div class="custom-file">
                                    <input type="file" onchange="preview()" name="service_attachment[]"
                                        class="custom-file-input"
                                        data-file-error="{{ __('messages.files_not_allowed') }}" multiple
                                        @if(!$hasExistingAttachments) required @endif>
                                    <label
                                        class="custom-file-label upload-label">{{ __('messages.choose_file', ['file' => __('messages.attachments')]) }}</label>
                                </div>
                            </div>
                            <img id="service_attachment_preview" src="" width="150px" style="display: none;" />
                        </div>

                        <div class="row service_attachment_div">
                            <div class="col-md-12">
                                @if ($hasExistingAttachments)
                                    @php
                                        $file_extention = config('constant.IMAGE_EXTENTIONS', ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                                    @endphp
                                    <!-- Debug info -->
                                    <div style="background: #f8f9fa; padding: 10px; margin: 10px 0; border-radius: 5px; font-size: 12px;">
                                        <strong>Debug Info:</strong> Found {{ $existingAttachments->count() }} existing attachments
                                        @if($existingAttachments->count() > 0)
                                            <br>First attachment: {{ $existingAttachments->first()->file_name ?? 'No filename' }}
                                        @endif
                                    </div>
                                    <div class="border-left-2">
                                        <p class="ml-2"><b>{{ __('messages.attached_files') }}</b></p>
                                        <div class="ml-2 my-3">
                                            <div class="row">
                                                @foreach ($existingAttachments as $attchment)
                                                    @php
                                                        $fileUrl = $attchment->getFullUrl();
                                                        $fileName = $attchment->file_name ?? '';
                                                        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                                                        $isImage = in_array($fileExtension, $file_extention);
                                                    @endphp
                                                    <input type="hidden" name="existing_attachments[]" value="{{ $attchment->id }}">
                                                    <div class="col-md-2 pr-10 text-center galary file-gallary-{{ $servicedata->id }}"
                                                        data-gallery=".file-gallary-{{ $servicedata->id }}"
                                                        id="service_attachment_preview_{{ $attchment->id }}">
                                                        @if ($isImage)
                                                            <a id="attachment_files"
                                                                href="{{ $fileUrl }}"
                                                                class="list-group-item-action attachment-list"
                                                                target="_blank">
                                                                <img src="{{ $fileUrl }}"
                                                                    class="attachment-image" alt="{{ $fileName }}"
                                                                    style="width: 100%; height: 100px; object-fit: cover; border-radius: 5px;">
                                                            </a>
                                                        @else
                                                            <a id="attachment_files"
                                                                class="video list-group-item-action attachment-list"
                                                                href="{{ $fileUrl }}">
                                                                <img src="{{ asset('images/file.png') }}"
                                                                    class="attachment-file"
                                                                    style="width: 100%; height: 100px; object-fit: cover; border-radius: 5px;">
                                                            </a>
                                                        @endif
                                                        <a class="text-danger remove-file"
                                                            href="{{ route('remove.file', ['id' => $attchment->id, 'type' => 'service_attachment']) }}"
                                                            data--submit="confirm_form" data--confirmation='true'
                                                            data--ajax="true" data-toggle="tooltip"
                                                            title='{{ __('messages.remove_file_title', ['name' => __('messages.attachments')]) }}'
                                                            data-title='{{ __('messages.remove_file_title', ['name' => __('messages.attachments')]) }}'
                                                            data-message='{{ __('messages.remove_file_msg') }}'
                                                            style="position: absolute; top: 5px; right: 5px; background: white; border-radius: 50%; padding: 2px;">
                                                            <i class="ri-close-circle-line"></i>
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
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
    @php
        $data = $servicedata->providerServiceAddress->pluck('provider_address_id')->implode(',');
    @endphp
    @section('bottom_script')
        <script type="text/javascript">
            function preview() {
                const fileInput = event.target;
                const preview = document.getElementById('service_attachment_preview');
                
                if (fileInput.files && fileInput.files[0]) {
                    preview.src = URL.createObjectURL(fileInput.files[0]);
                    preview.style.display = 'block';
                } else {
                    preview.style.display = 'none';
                }
            }

            var discountInput = document.getElementById('discount');
            var discountError = document.getElementById('discount-error');

            document.addEventListener('DOMContentLoaded', function() {
                var initialProviderId = document.getElementById('provider_id') ? document.getElementById('provider_id').value : '';
                if (initialProviderId) {
                    selectprovider({
                        value: initialProviderId
                    });
                }
                
                var addProviderAddressLink = document.getElementById('add_provider_address_link');
                if (addProviderAddressLink) {
                    addProviderAddressLink.addEventListener('click', function(event) {
                        event.preventDefault();
                        var providerId = document.getElementById('provider_id').value;
                        var providerAddressCreateUrl =
                            "{{ route('provideraddress.create', ['provideraddress' => '']) }}";
                        providerAddressCreateUrl = providerAddressCreateUrl.replace('provideraddress=',
                            'provideraddress=' + providerId);
                        window.location.href = providerAddressCreateUrl;
                    });
                }

                // Initialize form validation
                initializeFormValidation();
                
                // Handle file removal
                handleFileRemoval();
            });

            function selectprovider(selectElement) {
                var providerId = selectElement.value;
                var addProviderAddressLink = document.getElementById('add_provider_address_link');

                if (addProviderAddressLink) {
                    if (providerId) {
                        addProviderAddressLink.classList.remove('d-none');
                    } else {
                        addProviderAddressLink.classList.add('d-none');
                    }
                }
            }

            function initializeFormValidation() {
                // Check if existing attachments are present
                var existingAttachments = document.querySelectorAll('input[name="existing_attachments[]"]');
                var fileInput = document.querySelector('input[name="service_attachment[]"]');
                var requiredSpan = document.querySelector('label[for="service_attachment"] .text-danger');
                
                console.log('Existing attachments found:', existingAttachments.length);
                
                if (fileInput) {
                    if (existingAttachments.length > 0) {
                        // Remove required attribute if existing attachments are present
                        fileInput.removeAttribute('required');
                        if (requiredSpan) {
                            requiredSpan.style.display = 'none';
                        }
                        console.log('Removed required attribute - existing attachments found');
                    } else {
                        // Add required attribute if no existing attachments
                        fileInput.setAttribute('required', 'required');
                        if (requiredSpan) {
                            requiredSpan.style.display = 'inline';
                        }
                        console.log('Added required attribute - no existing attachments');
                    }
                }
            }

            function handleFileRemoval() {
                // Handle file removal clicks
                document.addEventListener('click', function(e) {
                    if (e.target.closest('.remove-file')) {
                        e.preventDefault();
                        var removeLink = e.target.closest('.remove-file');
                        var fileContainer = removeLink.closest('.col-md-2');
                        
                        if (confirm('{{ __('messages.remove_file_msg') }}')) {
                            // Remove the file container from DOM
                            fileContainer.remove();
                            
                            // Re-initialize validation after file removal
                            setTimeout(function() {
                                initializeFormValidation();
                            }, 100);
                            
                            // Make AJAX call to remove file from server
                            var removeUrl = removeLink.getAttribute('href');
                            if (removeUrl) {
                                fetch(removeUrl, {
                                    method: 'GET',
                                    headers: {
                                        'X-Requested-With': 'XMLHttpRequest'
                                    }
                                }).then(function(response) {
                                    if (response.ok) {
                                        console.log('File removed successfully');
                                    }
                                }).catch(function(error) {
                                    console.error('Error removing file:', error);
                                });
                            }
                        }
                    }
                });
            }

            if (discountInput) {
                discountInput.addEventListener('input', function() {
                    var discountValue = parseFloat(discountInput.value);
                    if (isNaN(discountValue) || discountValue < 0 || discountValue > 99) {
                        discountError.textContent = "{{ __('Discount value should be between 0 to 99') }}";
                    } else {
                        discountError.textContent = "";
                    }
                });
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