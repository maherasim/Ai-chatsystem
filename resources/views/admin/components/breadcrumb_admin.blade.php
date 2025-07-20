@if (!Route::is(['abuse-message','block-user','chat','group','invite-user','report-user','stories',
'ui-alerts',
'ui-avatar',
'ui-accordion',
'ui-badges',
'ui-borders',
'ui-breadcrumb',
'ui-buttons-group',
'ui-buttons',
'ui-cards',
'ui-carousel',
'ui-clipboard',
'ui-colors',
'ui-counter',
'ui-drag-drop',
'ui-dropdowns',
'ui-grid',
'ui-images',
'ui-lightbox',
'ui-media',
'ui-modals',
'ui-nav-tabs',
'ui-offcanvas',
'ui-placeholders',
'ui-popovers',
'ui-progress',
'ui-rangeslider',
'ui-rating',
'ui-ribbon',
'ui-scrollbar',
'ui-spinner',
'ui-stickynote',
'ui-sweetalerts',
'ui-text-editor',
'ui-timeline',
'ui-toasts',
'ui-tooltips',
'ui-typography',
'ui-video',
'chart-apex',
'chart-c3',
'chart-flot',
'chart-js',
'chart-morris',
'chart-peity',
'icon-feather',
'icon-flag',
'icon-fontawesome',
'icon-ionic',
'icon-material',
'icon-pe7',
'icon-simpleline',
'icon-themify',
'icon-typicon',
'icon-weather',
'form-checkbox-radios',
'form-grid-gutters',
'form-select',
'form-mask',
'form-fileupload',
'form-horizontal',
'form-vertical',
'form-floating-labels',
'form-validation',
'form-select2',
'form-wizard',
'users'
]))
 <!-- Page Header -->
 <div class="d-md-flex d-block align-items-center justify-content-between mb-4">
    <div class="my-auto">
        <h4 class="page-title mb-1">{{ $title }}</h4>
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ $li_1}}"><i class="ti ti-home text-primary"></i></a>
                </li>
                @if (Route::is(['add-language','appearance-settings','app-settings','authentication-settings',
                'backup','ban-address','change-password','chat-settings','clear-cache','custom-fields','email-settings','gdpr'
                ,'integrations','language','language-web','localization-settings','notification-settings','otp','profile-settings',
                'sms-settings','social-auth','storage','video-audio-settings'
                
                
                ]))
                <li class="breadcrumb-item"><a href="javascript:void(0);">{{ $li_3}}</a></li>
                @endif
                <li class="breadcrumb-item active" aria-current="page">{{ $li_2}}</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header -->
@endif
@if (Route::is(['abuse-message','block-user','chat','group','invite-user','report-user','stories','users']))
  <!-- Page Header -->
  <div class="d-md-flex d-block align-items-center justify-content-between mb-4">
    <div class="my-auto mb-2 mb-md-0">
        <h4 class="page-title mb-1">{{ $title }}</h4>
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ $li_1}}"><i class="ti ti-home text-primary"></i></a>
                </li>
                @if (Route::is(['block-user','invite-user','report-user'
                ]))
                <li class="breadcrumb-item"><a href="javascript:void(0);">{{ $li_3}}</a></li>
                @endif
                <li class="breadcrumb-item active" aria-current="page">{{ $li_2}}</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
        <div class="dropdown me-2 mb-2">
            <a href="javascript:void(0);"
                class="dropdown-toggle btn fw-medium d-inline-flex align-items-center"
                data-bs-toggle="dropdown">
                <i class="ti ti-file-export me-2"></i>Export
            </a>
            <ul class="dropdown-menu  dropdown-menu-end p-3">
                <li>
                    <a href="javascript:void(0);" class="dropdown-item rounded-1"><i
                            class="ti ti-file-type-pdf me-1"></i>Export as PDF</a>
                </li>
                <li>
                    <a href="javascript:void(0);" class="dropdown-item rounded-1"><i
                            class="ti ti-file-type-xls me-1"></i>Export as Excel </a>
                </li>
            </ul>
        </div>
        @if (Route::is(['users']))
        <div class="mb-2">
            <a href="#" class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#add_user"><i class="ti ti-circle-plus me-2"></i>Add New User</a>
        </div>
        @endif
    </div>
</div>
<!-- Page Header -->
@endif

@if (Route::is(['ui-alerts',
'ui-avatar',
'ui-accordion',
'ui-badges',
'ui-borders',
'ui-breadcrumb',
'ui-buttons-group',
'ui-buttons',
'ui-cards',
'ui-carousel',
'ui-clipboard',
'ui-colors',
'ui-counter',
'ui-drag-drop',
'ui-dropdowns',
'ui-grid',
'ui-images',
'ui-lightbox',
'ui-media',
'ui-modals',
'ui-nav-tabs',
'ui-offcanvas',
'ui-placeholders',
'ui-popovers',
'ui-progress',
'ui-rangeslider',
'ui-rating',
'ui-ribbon',
'ui-scrollbar',
'ui-spinner',
'ui-stickynote',
'ui-sweetalerts',
'ui-text-editor',
'ui-timeline',
'ui-toasts',
'ui-tooltips',
'ui-typography',
'ui-video',

'chart-c3',
'chart-flot',
'chart-js',
'chart-morris',
'chart-peity',
'icon-feather',
'icon-flag',
'icon-fontawesome',
'icon-ionic',
'icon-material',
'icon-pe7',
'icon-simpleline',
'icon-themify',
'icon-typicon',
'icon-weather',
'form-checkbox-radios',
'form-grid-gutters',
'form-select',
'form-mask',
'form-fileupload',
'form-horizontal',
'form-vertical',
'form-floating-labels',
'form-validation',
'form-select2',
'form-wizard'


]))
<div class="page-header">
    <div class="page-title">
        <h3>{{ $title }}</h3>
    </div>
</div>
@endif
@if (Route::is(['chart-apex']))
<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="page-title">{{ $title }}</h3>
        </div>
    </div>
</div>
@endif