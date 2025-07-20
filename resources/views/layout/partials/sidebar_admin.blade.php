<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu d-flex flex-column">
            <ul class="menu-top">
                <li class="{{ Request::is('admin/index_admin') ? 'active' : '' }}">
                    <a href="{{url('admin/index_admin')}}"><i
                            class="ti ti-layout-dashboard"></i><span>Dashboard</span></a>
                </li>
                <li class="submenu">
                    <a href="{{url('admin/users')}}"><i class="ti ti-user"></i><span>Users</span><span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li>
                            <a href="{{url('admin/users')}}" class="{{ Request::is('admin/users') ? 'active' : '' }}"><i
                                    class="ti ti-point-filled me-2"></i>Users List</a>
                        </li>
                        <li>
                            <a href="{{url('admin/block-user')}}" class="{{ Request::is('admin/block-user') ? 'active' : '' }}"><i
                                    class="ti ti-point-filled me-2"></i>Blocked Users</a>
                        </li>
                        <li>
                            <a href="{{url('admin/report-user')}}" class="{{ Request::is('admin/report-user') ? 'active' : '' }}"><i
                                    class="ti ti-point-filled me-2"></i>Reported Users</a>
                        </li>
                        <li>
                            <a href="{{url('admin/invite-user')}}" class="{{ Request::is('admin/invite-user') ? 'active' : '' }}"><i
                                    class="ti ti-point-filled me-2"></i>Invited Users</a>
                        </li>

                    </ul>
                </li>
                <li class="{{ Request::is('admin/group') ? 'active' : '' }}">
                    <a href="{{url('admin/group')}}"><i class="ti ti-users-group"></i><span>Group
                        </span></a>
                </li>
                <li class="{{ Request::is('admin/chat') ? 'active' : '' }}">
                    <a href="{{url('admin/chat')}}" ><i class="ti ti-message-circle"></i><span>Chat</span></a>
                </li>
                <li class="{{ Request::is('admin/call') ? 'active' : '' }}"> 
                    <a href="{{url('admin/call')}}" ><i class="ti ti-phone-call"></i><span>Calls</span></a>
                </li>
                <li class="{{ Request::is('admin/abuse-message') ? 'active' : '' }}">
                    <a href="{{url('admin/abuse-message')}}" ><i class="ti ti-message-report"></i><span>Abuse Messages</span></a>
                </li>
                <li  class="{{ Request::is('admin/stories') ? 'active' : '' }}">
                    <a href="{{url('admin/stories')}}"><i class="ti ti-circle-dot"></i><span>Stories</span></a>
                </li>
                <li class="{{ Request::is('admin/profile-settings','admin/appearance-settings','admin/add-language','admin/app-settings','admin/authentication-settings',
                'admin/backup',
                'admin/ban-address',
                'admin/change-password',
                'admin/chat-settings',
                'admin/custom-fields',
                'admin/email-settings',
                'admin/gdpr',
                'admin/integrations',
                'admin/language',
                'admin/language-web',
                'admin/localization-settings',
                'admin/notification-settings',
                'admin/otp',
                'admin/sms-settings',
                'admin/social-auth',
                'admin/storage',
                'admin/video-audio-settings'
                ) ? 'active' : '' }}">
                    <a href="{{url('admin/profile-settings')}}" ><i class="ti ti-settings"></i><span>Settings</span></a>
                </li>
                <li class="submenu">
                    <h6 class="submenu-hdr"><span>UI Interface</span></h6>
                    <a href="javascript:void(0);">
                        <i class="ti ti-hierarchy-2"></i><span>Base UI</span><span
                            class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="{{url('admin/ui-alerts')}}" class="{{ Request::is('admin/ui-alerts') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Alerts</a></li>
                        <li><a href="{{url('admin/ui-accordion')}}" class="{{ Request::is('admin/ui-accordion') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Accordion</a></li>
                        <li><a href="{{url('admin/ui-avatar')}}" class="{{ Request::is('admin/ui-avatar') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Avatar</a></li>
                        <li><a href="{{url('admin/ui-badges')}}" class="{{ Request::is('admin/ui-badges') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Badges</a></li>
                        <li><a href="{{url('admin/ui-borders')}}" class="{{ Request::is('admin/ui-borders') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Border</a></li>
                        <li><a href="{{url('admin/ui-buttons')}}" class="{{ Request::is('admin/ui-buttons') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Buttons</a></li>
                        <li><a href="{{url('admin/ui-buttons-group')}}" class="{{ Request::is('admin/ui-buttons-group') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Button Group</a></li>
                        <li><a href="{{url('admin/ui-breadcrumb')}}" class="{{ Request::is('admin/ui-breadcrumb') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Breadcrumb</a></li>
                        <li><a href="{{url('admin/ui-cards')}}" class="{{ Request::is('admin/ui-cards') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Card</a></li>
                        <li><a href="{{url('admin/ui-carousel')}}" class="{{ Request::is('admin/ui-carousel') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Carousel</a></li>
                        <li><a href="{{url('admin/ui-colors')}}" class="{{ Request::is('admin/ui-colors') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Colors</a></li>
                        <li><a href="{{url('admin/ui-dropdowns')}}" class="{{ Request::is('admin/ui-dropdowns') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Dropdowns</a></li>
                        <li><a href="{{url('admin/ui-grid')}}" class="{{ Request::is('admin/ui-grid') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Grid</a></li>
                        <li><a href="{{url('admin/ui-images')}}" class="{{ Request::is('admin/ui-images') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Images</a></li>
                        <li><a href="{{url('admin/ui-lightbox')}}" class="{{ Request::is('admin/ui-lightbox') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Lightbox</a></li>
                        <li><a href="{{url('admin/ui-media')}}" class="{{ Request::is('admin/ui-media') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Media</a></li>
                        <li><a href="{{url('admin/ui-modals')}}" class="{{ Request::is('admin/ui-modals') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Modals</a></li>
                        <li><a href="{{url('admin/ui-offcanvas')}}" class="{{ Request::is('admin/ui-offcanvas') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Offcanvas</a></li>
                        <li><a href="{{url('admin/ui-pagination')}}" class="{{ Request::is('admin/ui-pagination') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Pagination</a></li>
                        <li><a href="{{url('admin/ui-popovers')}}" class="{{ Request::is('admin/ui-popovers') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Popovers</a></li>
                        <li><a href="{{url('admin/ui-progress')}}" class="{{ Request::is('admin/ui-alerts') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Progress</a></li>
                        <li><a href="{{url('admin/ui-placeholders')}}" class="{{ Request::is('admin/ui-placeholders') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Placeholders</a></li>
                        <li><a href="{{url('admin/ui-spinner')}}" class="{{ Request::is('admin/ui-spinner') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Spinner</a></li>
                        <li><a href="{{url('admin/ui-sweetalerts')}}" class="{{ Request::is('admin/ui-sweetalerts') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Sweet Alerts</a></li>
                        <li><a href="{{url('admin/ui-nav-tabs')}}" class="{{ Request::is('admin/ui-nav-tabs') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Tabs</a></li>
                        <li><a href="{{url('admin/ui-toasts')}}" class="{{ Request::is('admin/ui-toasts') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Toasts</a></li>
                        <li><a href="{{url('admin/ui-tooltips')}}" class="{{ Request::is('admin/ui-tooltips') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Tooltips</a></li>
                        <li><a href="{{url('admin/ui-typography')}}" class="{{ Request::is('admin/ui-typography') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Typography</a></li>
                        <li><a href="{{url('admin/ui-video')}}" class="{{ Request::is('admin/ui-video') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Video</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);">
                        <i class="ti ti-hierarchy-3"></i><span>Advanced UI</span><span
                            class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="{{url('admin/ui-ribbon')}}" class="{{ Request::is('admin/ui-ribbon') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Ribbon</a></li>
                        <li><a href="{{url('admin/ui-clipboard')}}" class="{{ Request::is('admin/ui-clipboard') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Clipboard</a></li>
                        <li><a href="{{url('admin/ui-drag-drop')}}" class="{{ Request::is('admin/ui-drag-drop') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Drag & Drop</a></li>
                        <li><a href="{{url('admin/ui-rangeslider')}}" class="{{ Request::is('admin/ui-rangeslider') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Range Slider</a></li>
                        <li><a href="{{url('admin/ui-rating')}}" class="{{ Request::is('admin/ui-rating') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Rating</a></li>
                        <li><a href="{{url('admin/ui-text-editor')}}" class="{{ Request::is('admin/ui-text-editor') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Text Editor</a></li>
                        <li><a href="{{url('admin/ui-counter')}}" class="{{ Request::is('admin/ui-counter') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Counter</a></li>
                        <li><a href="{{url('admin/ui-scrollbar')}}" class="{{ Request::is('admin/ui-scrollbar') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Scrollbar</a></li>
                        <li><a href="{{url('admin/ui-stickynote')}}" class="{{ Request::is('admin/ui-stickynote') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Sticky Note</a></li>
                        <li><a href="{{url('admin/ui-timeline')}}" class="{{ Request::is('admin/ui-timeline') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Timeline</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);"><i class="ti ti-chart-line"></i>
                        <span>Charts</span><span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="{{url('admin/chart-apex')}}" class="{{ Request::is('admin/chart-apex') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Apex Charts</a></li>
                        <li><a href="{{url('admin/chart-c3')}}" class="{{ Request::is('admin/chart-c3') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Chart C3</a></li>
                        <li><a href="{{url('admin/chart-js')}}" class="{{ Request::is('admin/chart-js') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Chart Js</a></li>
                        <li><a href="{{url('admin/chart-morris')}}" class="{{ Request::is('admin/chart-morris') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Morris Charts</a></li>
                        <li><a href="{{url('admin/chart-flot')}}" class="{{ Request::is('admin/chart-flot') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Flot Charts</a></li>
                        <li><a href="{{url('admin/chart-peity')}}" class="{{ Request::is('admin/chart-peity') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Peity Charts</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);"><i class="ti ti-icons"></i>
                        <span>Icons</span><span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="{{url('admin/icon-fontawesome')}}" class="{{ Request::is('admin/icon-fontawesome') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Fontawesome Icons</a></li>
                        <li><a href="{{url('admin/icon-feather')}}" class="{{ Request::is('admin/icon-feather') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Feather Icons</a></li>
                        <li><a href="{{url('admin/icon-ionic')}}" class="{{ Request::is('admin/icon-ionic') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Ionic Icons</a></li>
                        <li><a href="{{url('admin/icon-material')}}" class="{{ Request::is('admin/icon-material') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Material Icons</a></li>
                        <li><a href="{{url('admin/icon-pe7')}}" class="{{ Request::is('admin/icon-pe7') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Pe7 Icons</a></li>
                        <li><a href="{{url('admin/icon-simpleline')}}" class="{{ Request::is('admin/icon-simpleline') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Simpleline Icons</a></li>
                        <li><a href="{{url('admin/icon-themify')}}"class="{{ Request::is('admin/icon-themify') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Themify Icons</a></li>
                        <li><a href="{{url('admin/icon-weather')}}" class="{{ Request::is('admin/icon-weather') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Weather Icons</a></li>
                        <li><a href="{{url('admin/icon-typicon')}}" class="{{ Request::is('admin/icon-typicon') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Typicon Icons</a></li>
                        <li><a href="{{url('admin/icon-flag')}}" class="{{ Request::is('admin/icon-flag') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Flag Icons</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);">
                        <i class="ti ti-input-search"></i><span>Forms</span><span
                            class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li class="submenu submenu-two">
                            <a href="javascript:void(0);">Form Elements<span
                                    class="menu-arrow inside-submenu"></span></a>
                            <ul>
                                <li><a href="{{url('admin/form-basic-inputs')}}" class="{{ Request::is('admin/form-basic-inputs') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Basic Inputs</a></li>
                                <li><a href="{{url('admin/form-checkbox-radios')}}" class="{{ Request::is('admin/form-checkbox-radios') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Checkbox & Radios</a></li>
                                <li><a href="{{url('admin/form-input-groups')}}" class="{{ Request::is('admin/form-input-groups') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Input Groups</a></li>
                                <li><a href="{{url('admin/form-grid-gutters')}}" class="{{ Request::is('admin/form-grid-gutters') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Grid & Gutters</a></li>
                                <li><a href="{{url('admin/form-select')}}" class="{{ Request::is('admin/form-select') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Form Select</a></li>
                                <li><a href="{{url('admin/form-mask')}}" class="{{ Request::is('admin/form-mask') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Input Masks</a></li>
                                <li><a href="{{url('admin/form-fileupload')}}" class="{{ Request::is('admin/form-fileupload') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>File Uploads</a></li>
                            </ul>
                        </li>
                        <li class="submenu submenu-two">
                            <a href="javascript:void(0);">Layouts<span
                                    class="menu-arrow inside-submenu"></span></a>
                            <ul>
                                <li><a href="{{url('admin/form-horizontal')}}" class="{{ Request::is('admin/form-horizontal') ? 'active' : '' }}">Horizontal Form</a></li>
                                <li><a href="{{url('admin/form-vertical')}}" class="{{ Request::is('admin/form-vertical') ? 'active' : '' }}">Vertical Form</a></li>
                                <li><a href="{{url('admin/form-floating-labels')}}" class="{{ Request::is('admin/form-floating-labels') ? 'active' : '' }}">Floating Labels</a></li>
                            </ul>
                        </li>
                        <li><a href="{{url('admin/form-validation')}}" class="{{ Request::is('admin/form-validation') ? 'active' : '' }}">Form Validation</a></li>
                        <li><a href="{{url('admin/form-select2')}}" class="{{ Request::is('admin/form-select2') ? 'active' : '' }}">Select2</a></li>
                        <li><a href="{{url('admin/form-wizard')}}" class="{{ Request::is('admin/form-wizard') ? 'active' : '' }}">Form Wizard</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);"><i
                            class="ti ti-table-plus"></i><span>Tables</span><span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{url('admin/tables-basic')}}" class="{{ Request::is('admin/tables-basic') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Basic Tables </a></li>
                        <li><a href="{{url('admin/data-tables')}}" class="{{ Request::is('admin/data-tables') ? 'active' : '' }}"><i class="ti ti-point-filled me-2"></i>Data Table </a></li>
                    </ul>
                </li>

            </ul>
            <ul class="menu-bottom">
                <li>
                    <a href="{{url('admin/index_admin')}}"><i class="ti ti-file-text"></i><span>Documentation</span>
                        <span class="version">4.0.2</span></a>
                </li>
                <li>
                    <a href="#"><i class="ti ti-exchange"></i><span>Changelog
                        </span></a>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);"><i class="ti ti-menu-2"></i><span>Multi
                            Level</span><span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="javascript:void(0);"><i class="ti ti-point-filled me-2"></i>Multilevel 1</a></li>
                        <li class="submenu submenu-two"><a href="javascript:void(0);"><i class="ti ti-point-filled me-2"></i>Multilevel 2<span
                                    class="menu-arrow inside-submenu"></span></a>
                            <ul>
                                <li><a href="javascript:void(0);"><i class="ti ti-point-filled me-2"></i>Multilevel 2.1</a></li>
                                <li class="submenu submenu-two submenu-three"><a
                                        href="javascript:void(0);"><i class="ti ti-point-filled me-2"></i>Multilevel 2.2<span
                                            class="menu-arrow inside-submenu inside-submenu-two"></span></a>
                                    <ul>
                                        <li><a href="javascript:void(0);"><i class="ti ti-point-filled me-2"></i>Multilevel 2.2.1</a></li>
                                        <li><a href="javascript:void(0);"><i class="ti ti-point-filled me-2"></i>Multilevel 2.2.2</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0);"><i class="ti ti-point-filled me-2"></i>Multilevel 3</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->