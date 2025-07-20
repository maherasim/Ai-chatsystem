<!-- Header -->
<div class="header">

    <!-- Logo -->
    <div class="header-left active">
        <a href="{{url('admin/index')}}" class="logo logo-normal">
            <img src="{{URL::asset('assets/img/full-logo.svg')}}" alt="Logo">
        </a>
        <a href="{{url('admin/index')}}" class="logo-small">
            <img src="{{URL::asset('assets/img/logo-small.svg')}}" alt="Logo">
        </a>
    </div>
    <!-- /Logo -->

    <a id="mobile_btn" class="mobile_btn" href="javascript:void(0);sidebar">
        <span class="bar-icon">
            <span></span>
            <span></span>
            <span></span>
        </span>
    </a>

    <div class="header-user">
        <div class="nav user-menu">

            <!-- Search -->
            <div class="nav-item nav-search-inputs me-auto">
                <div class="top-nav-search">
                    <a href="javascript:void(0);" class="responsive-search">
                        <i class="fa fa-search"></i>
                    </a>
                    <div class="d-flex align-items-center">
                    <a id="toggle_btn" href="javascript:void(0);" class="me-2">
                        <i class="ti ti-menu-2"></i>
                    </a>
                        <form action="javascript:void(0);" class="dropdown">
                            <div class="searchinputs" id="dropdownMenuClickable">
                                <input type="text" placeholder="Search">
                                <div class="search-addon">
                                    <span><i class="ti ti-search"></i></span>
                                </div>
                                <div class="search-addon-command">
                                    <span><i class="ti ti-command"></i></span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /Search -->

            <div class="d-flex align-items-center">
                <div class="provider-head-links ">
                    <div class="dark-mode">
                        <a href="javascript:void(0);" id="dark-mode-toggle" class="dark-mode-toggle header-icon">
                            <i class="fa-regular fa-moon"></i>
                        </a>
                        <a href="javascript:void(0);" id="light-mode-toggle" class="dark-mode-toggle header-icon">
                            <i class="ti ti-sun-filled"></i>
                        </a>
                    </div>
                </div>
                <div class="dropdown">
                    <a href="#" class="header-icon flag-icon" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{URL::asset('assets/img/flag/flag-01.png')}}" alt="Language" class="img-fluid rounded-pill">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right p-3">
                        <a href="javascript:void(0);" class="dropdown-item active d-flex align-items-center">
                            <img class="me-2 rounded-pill" src="{{URL::asset('assets/img/flag/flag-01.png')}}" alt="Img" height="22" width="22"> English
                        </a>
                        <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">
                            <img class="me-2 rounded-pill" src="{{URL::asset('assets/img/flag/flag-02.png')}}" alt="Img" height="22" width="22"> French
                        </a>
                        <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">
                            <img class="me-2 rounded-pill" src="{{URL::asset('assets/img/flag/flag-03.png')}}" alt="Img" height="22" width="22"> Spanish
                        </a>
                        <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">
                            <img class="me-2 rounded-pill" src="{{URL::asset('assets/img/flag/flag-04.png')}}" alt="Img" height="22" width="22"> German
                        </a>
                    </div>
                </div>
                <div class="provider-head-links">
                    <a href="{{url('admin/chat')}}" class="d-flex align-items-center justify-content-center header-icon active-dot">
                        <i class="ti ti-message fs-16"></i>
                    </a>
                </div>
                <div class="provider-head-links">
                    <a href="javascript:void(0);" class="d-flex align-items-center justify-content-center dropdown-toggle header-icon active-dot" data-bs-toggle="dropdown">
                        <i class="feather-bell fs-16"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end notification-dropdown p-4">
                        <div
                            class="d-flex dropdown-body align-items-center justify-content-between border-bottom p-0 pb-3 mb-3">
                            <h6 class="notification-title">Notifications <span class="fs-18 text-gray">
                                    (2)</span></h6>
                            <div class="d-flex align-items-center">
                                <a href="#" class="text-primary fs-15 me-3 lh-1">Mark all as read</a>
                                <div class="dropdown">
                                    <a href="javascript:void(0);" class="bg-white dropdown-toggle"
                                        data-bs-toggle="dropdown" data-bs-auto-close="outside"><i
                                            class="ti ti-calendar-due me-1"></i>Today
                                    </a>
                                    <ul class="dropdown-menu mt-2 p-3">
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item rounded-1">
                                                This Week
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item rounded-1">
                                                Last Week
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item rounded-1">
                                                Last Week
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="noti-content">
                            <div class="d-flex flex-column">
                                <div class="border-bottom mb-3 pb-3">
                                    <a href="javascript:void(0);">
                                        <div class="d-flex">
                                            <span class="avatar avatar-lg me-2 flex-shrink-0">
                                                <img src="{{URL::asset('assets/img/profiles/avatar-52.jpg')}}" alt="Profile"
                                                    class="rounded-circle">
                                            </span>
                                            <div class="flex-grow-1">
                                                <div class="d-flex align-items-center">
                                                    <p class="mb-1 w-100"><span
                                                            class="text-dark fw-semibold">Stephan Peralt</span>
                                                        rescheduled the service to 14/01/2024. </p>
                                                    <span class="d-flex justify-content-end "> <i
                                                            class="ti ti-point-filled text-primary"></i></span>
                                                </div>
                                                <span>Just Now</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="border-bottom mb-3 pb-3">
                                    <a href="javascript:void(0);" class="pb-0">
                                        <div class="d-flex">
                                            <span class="avatar avatar-lg me-2 flex-shrink-0">
                                                <img src="{{URL::asset('assets/img/profiles/avatar-36.jpg')}}" alt="Profile"
                                                    class="rounded-circle">
                                            </span>
                                            <div class="flex-grow-1">
                                                <div class="d-flex align-items-center">
                                                    <p class="mb-1 w-100"><span
                                                            class="text-dark fw-semibold">Harvey Smith</span>
                                                        has requested your service.</p>
                                                    <span class="d-flex justify-content-end "> <i
                                                            class="ti ti-point-filled text-primary"></i></span>
                                                </div>
                                                <span>5 mins ago</span>
                                                <div
                                                    class="d-flex justify-content-start align-items-center mt-2">
                                                    <span class="btn btn-light btn-sm me-2">Deny</span>
                                                    <span class="btn btn-dark btn-sm">Accept</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="border-bottom mb-3 pb-3">
                                    <a href="javascript:void(0);">
                                        <div class="d-flex">
                                            <span class="avatar avatar-lg me-2 flex-shrink-0">
                                                <img src="{{URL::asset('assets/img/profiles/avatar-02.jpg')}}" alt="Profile"
                                                    class="rounded-circle">
                                            </span>
                                            <div class="flex-grow-1">
                                                <p class="mb-1"><span class="text-dark fw-semibold"> Anthony
                                                        Lewis</span> has left feedback for your recent service
                                                </p>
                                                <span>10 mins ago</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="border-0 mb-3 pb-0">
                                    <a href="javascript:void(0);">
                                        <div class="d-flex">
                                            <span class="avatar avatar-lg me-2 flex-shrink-0">
                                                <img src="{{URL::asset('assets/img/profiles/avatar-22.jpg')}}" alt="Profile"
                                                    class="rounded-circle">
                                            </span>
                                            <div class="flex-grow-1">
                                                <p class="mb-1"><span class="text-dark fw-semibold">Brian
                                                        Villaloboshas </span> cancelled the service scheduled
                                                    for 14/01/2024.
                                                </p>
                                                <span>15 mins ago</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex p-0 notification-footer-btn">
                            <a href="#" class="btn btn-light rounded  me-2">Cancel</a>
                            <a href="#" class="btn btn-dark rounded ">View All</a>
                        </div>
                    </div>
                </div>
                
                <div class="dropdown">
                    <a href="javascript:void(0);" data-bs-toggle="dropdown">
                        <div class="booking-user d-flex align-items-center">
                            <span class="user-img me-2">
                                <img src="{{URL::asset('assets/img/users/user-08.jpg')}}" alt="user">
                            </span>
                            <div>
                                <h6 class="fs-14 fw-medium">Thomas Rethman</h6>
                                <span class="text-primary fs-12">Administrator</span>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu p-2">
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{url('admin/login')}}">
                                <i class="ti ti-logout me-1"></i>Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="dropdown mobile-user-menu">
        <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
            aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-end">
            <a class="dropdown-item" href="{{url('admin/profile')}}">My Profile</a>
            <a class="dropdown-item" href="{{url('admin/profile-settings')}}">Settings</a>
            <a class="dropdown-item" href="{{url('admin/login')}}">Logout</a>
        </div>
    </div>
    <!-- /Mobile Menu -->

</div>
<!-- /Header -->
