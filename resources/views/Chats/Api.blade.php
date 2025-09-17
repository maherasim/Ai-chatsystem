<?php $page = 'chat'; ?>
@extends('layout.mainlayout')
@section('content')

<style>
    body {
        overflow-x: hidden;
    }

    .dropdown-menu {
        max-height: 300px;
        /* or adjust */
        overflow-y: auto;
        overflow-x: hidden;
    }

    /* Prevent parent containers from overflowing */
    .main_content,
    .chat-body,
    .sidebar-group {
        overflow: visible !important;
    }

    /* Ensure base styles don't interfere */
    .task-icon-link {
        position: relative;
        display: inline-block;
        width: 30px;
        height: 30px;
    }

    .chat-dropdown {
        display: block !important;
        opacity: 1 !important;
        visibility: visible !important;
    }


    .task-icon-link img {
        width: 25px !important;
        height: 25px !important;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        transition: opacity 0.2s ease-in-out;
    }


    /* Stack both icons centered */
    .task-icon-link img {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        transition: opacity 0.2s ease-in-out;
        width: 16px;
        height: 16px;
    }

    /* Default: show black icon */
    .task-icon-link .icon-black {
        opacity: 1;
    }

    /* Default: hide white icon */
    .task-icon-link .icon-white {
        opacity: 0;
    }

    /* On hover (only if not active): show white icon */
    .task-icon-link:hover:not(.active) .icon-black {
        opacity: 0;
    }

    .task-icon-link:hover:not(.active) .icon-white {
        opacity: 1;
    }

    /* Active state (white icon always shown) */
    .task-icon-link.active .icon-black {
        opacity: 0;
    }

    .task-icon-link.active .icon-white {
        opacity: 1;
    }
</style>


<!-- content -->
<div class="content main_content">

    <!-- Left Sidebar Menu -->

    <div style="visibility: visible;">
        @include('Chats.chatsidebar')
    </div>
    <!-- /Left Sidebar Menu -->

    <!-- sidebar group -->
    @include('Chats.notification')
    <!-- /Sidebar group -->

    <!-- Chat -->
    <div class="chat chat-messages show" id="middle" style="overflow-y: hidden;">
        <div>
             @include('Chats.header')

            <!-- Wrapper -->
            <div class="chat-body chat-page-group slimscroll">
                <div class="messages mb-3">
                    <div class="d-flex justify-content-between align-items-center w-100">

                        <!-- Left Side: Title + Breadcrumb -->
                        <div>
                            <h5 style="font-weight: 700; color: #1e2b4d; margin-bottom: 4px;">API Keys</h5>
                            <div style="font-size: 0.85rem; color: #7a7a7a;">
                                <i class="ti ti-smart-home"></i>
                                <span class="ms-1">Content</span>
                                <span class="mx-1">/</span>
                                <span style="color: #1e2b4d; font-weight: 500;">API Keys</span>
                            </div>
                        </div>

                        <!-- Right Side: Add Key Button -->
                        <div>
                            <button class="btn" style="  background-color: #f46c22;  color: white;font-weight: 500; padding: 6px 16px; border-radius: 6px; font-size: 0.9rem;display: flex;align-items: center; " data-bs-toggle="modal" data-bs-target="#addkey">
                                <i class="ti ti-circle-plus me-2"></i> Add Key
                            </button>
                        </div>

                    </div>
                </div>
                <div class="container mt-4">
                    <div class="card">
                        <div class="card-body" style="border: 1px solid #E6EAEE;">

                            <!-- Header Row: API Keys List + Filters -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="mb-0" style="font-weight: 600;">API Keys List</h6>

                            </div>

                            <!-- Horizontal line -->
                            <hr style="border-top: 1px solid #82868A; margin: 8px -20px;">


                            <!-- Entries + Search -->
                            <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                                <div class="d-flex align-items-center flex-grow-1 flex-wrap">
                                    <span class="me-2">Row Per Page</span>
                                    <select class="form-select form-select-sm w-auto">
                                        <option>10</option>
                                        <option selected>50</option>
                                        <option>100</option>
                                    </select>
                                    <span class="ms-2">Entries</span>
                                </div>
                                <div class="mt-2 mt-md-0">
                                    <input type="search" class="form-control form-control-sm" placeholder="Search">
                                </div>
                            </div>


                            <!-- Table -->
                            <div class="table-responsive">
                                <table class="table  align-middle text-nowrap">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width: 40px;"><input type="checkbox"></th>
                                            <th>Service Name</th>
                                            <th>Created By</th>
                                            <th>API Key</th>
                                            <th>Status</th>
                                            <th>Created Date</th>
                                            <th style="width: 80px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="checkbox"></td>
                                            <td>Paytm</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="https://via.placeholder.com/30" class="rounded-circle me-2" />
                                                    <span><strong>Anthony Lewis</strong></span>
                                                </div>
                                            </td>
                                            <td>
                                                paytm1234567890abcdef

                                                <i class="ti ti-clipboard"></i>
                                            </td>
                                            <td>
                                                <span class="badge bg-success">Success</span>
                                            </td>
                                            <td>14 Jan 2024</td>
                                            <td>
                                                <!-- Edit Icon -->
                                                <i class="ti ti-edit me-2" role="button" data-bs-toggle="modal"
                                                    data-bs-target="#editKeyModal"></i>


                                                <!-- Delete Icon triggers modal -->
                                                <i class="ti ti-trash " role="button"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteConfirmModal">
                                                </i>
                                            </td>

                                        </tr>
                                        <!-- Add more rows as needed -->
                                        <tr>
                                            <td><input type="checkbox"></td>
                                            <td>Paytm</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="https://via.placeholder.com/30" class="rounded-circle me-2" />
                                                    <span><strong>Anthony Lewis</strong></span>
                                                </div>
                                            </td>
                                            <td>
                                                paytm1234567890abcdef
                                                <i class="ti ti-clipboard"></i>
                                            </td>
                                            <td>
                                                <span class="badge bg-danger">Rejected</span>
                                            </td>
                                            <td>14 Jan 2024</td>
                                            <td>
                                                <i class="ti ti-edit me-2 " role="button"></i>
                                                <i class="ti ti-trash " role="button"></i>
                                            </td>
                                        </tr>
                                        <!-- 3 -->
                                        <tr>
                                            <td><input type="checkbox"></td>
                                            <td>Paytm</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="https://via.placeholder.com/30" class="rounded-circle me-2" />
                                                    <span><strong>Anthony Lewis</strong></span>
                                                </div>
                                            </td>
                                            <td>
                                                paytm1234567890abcdef
                                                <i class="ti ti-clipboard"></i>
                                            </td>
                                            <td>
                                                <span class="badge bg-success">Success</span>
                                            </td>
                                            <td>14 Jan 2024</td>
                                            <td>
                                                <i class="ti ti-edit me-2 " role="button"></i>
                                                <i class="ti ti-trash " role="button"></i>
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







<div class="modal fade" id="new-Ai">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Subject</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('index')}}">
                    <div class="row">
                        <label class="form-label">Subject Type</label>
                        <div class="d-flex" style="float: right;">

                            <div class="form-check me-3">
                                <input class="form-check-input" type="radio" name="mute" id="group1">
                                <label class="form-check-label" for="group1">Public</label>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" name="mute" id="group2">
                                <label class="form-check-label" for="group2">Private</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-lg-12">
                            <label class="form-label">Subject Title</label>
                            <div class="input-icon mb-3 position-relative">
                                <input type="text" value="" class="form-control" placeholder="Last Name">

                            </div>
                        </div>

                    </div>
                    <div class="row g-3">

                        <div class="col-12">
                            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#add-group">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</div>
<!-- Confirmation Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="text-align: center; padding: 24px; border-radius: 8px;">

            <!-- Icon -->
            <div style="margin-bottom: 12px;">
                <div style="background-color: #fdecea; display: inline-flex; justify-content: center; align-items: center; width: 64px; height: 64px; border-radius: 50%;">
                    <i class="ti ti-trash-x fs-36" style="color: #e63946; font-size: 36px;"></i>
                </div>
            </div>

            <!-- Title -->
            <h5 style="font-weight: 600; margin-bottom: 8px;">Confirm Delete</h5>

            <!-- Message -->
            <p style="color: #6c757d; margin-bottom: 24px;">
                You want to delete this item, this can't be undone once you delete.
            </p>

            <!-- Buttons -->
            <div style="display: flex; justify-content: center; gap: 8px;">
                <button type="button" class="btn-cancel" data-bs-dismiss="modal"
                    style="background-color: #f8f9fa; color: #000; padding: 8px 18px; border: 1px solid #dee2e6; border-radius: 4px; font-weight: 500;">
                    Cancel
                </button>
                <a id="confirmDeleteBtn" href="#"
                    style="background-color: #e63946; color: #fff; padding: 8px 18px; border: none; border-radius: 4px; font-weight: 500; text-decoration: none;">
                    Yes, Delete
                </a>
            </div>

        </div>
    </div>
</div>
<!-- delete popup end -->
<!-- add key -->
<div class="modal fade" id="addkey" tabindex="-1" aria-labelledby="editKeyModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="editKeyModalLabel">Add Key</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <div class="mb-3">
                    <label for="apiKeyName" class="form-label fw-semibold" style="font-size: 0.9rem;">API Key Name</label>
                    <input type="text" class="form-control" id="apiKeyName" placeholder="">
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn" style="background-color: #f46c22; color: white; font-weight: 500;">
                    Save Key
                </button>
            </div>

        </div>
    </div>
</div>
<!-- end add key -->
<!-- Edit Key Modal -->
<div class="modal fade" id="editKeyModal" tabindex="-1" aria-labelledby="editKeyModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="editKeyModalLabel">Edit Key</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <div class="mb-3">
                    <label for="apiKeyName" class="form-label fw-semibold" style="font-size: 0.9rem;">API Key Name</label>
                    <input type="text" class="form-control" id="apiKeyName" placeholder="">
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn" style="background-color: #f46c22; color: white; font-weight: 500;">
                    Save Key
                </button>
            </div>

        </div>
    </div>
</div>
<!-- end edit -->
<!-- /Content -->
<script>
    const toggleIcon = document.getElementById("toggleIcon");
    const chevron = document.getElementById("chevronIcon");

    toggleIcon.addEventListener("click", () => {
        setTimeout(() => {
            chevron.classList.toggle("ti-chevron-down");
            chevron.classList.toggle("ti-chevron-up");
        }, 150);
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const body = document.body;
        const darkBtn = document.getElementById('dark-mode-toggle');
        const lightBtn = document.getElementById('light-mode-toggle');

        darkBtn.addEventListener('click', function(e) {
            e.preventDefault();
            body.classList.add('dark-mode');
            darkBtn.style.display = 'none';
            lightBtn.style.display = 'inline';
        });

        lightBtn.addEventListener('click', function(e) {
            e.preventDefault();
            body.classList.remove('dark-mode');
            lightBtn.style.display = 'none';
            darkBtn.style.display = 'inline';
        });
    });
</script>
@endsection