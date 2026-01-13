<?php $page = 'chat'; ?>
@extends('layout.mainlayout')
@section('content')

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Delete Confirmation Function -->
<script>
function confirmDelete(deleteUrl, userName) {
    Swal.fire({
        title: 'Are you sure?',
        text: `Are you sure you want to delete.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel',
        reverseButtons: true,
        customClass: {
            popup: 'swal2-popup-custom',
            confirmButton: 'swal2-confirm-custom',
            cancelButton: 'swal2-cancel-custom'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // Show loading
            Swal.fire({
                title: 'Deleting...',
                text: 'Please wait while we delete the user.',
                allowOutsideClick: false,
                customClass: {
                    popup: 'swal2-popup-custom'
                },
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            // Redirect to delete URL
            window.location.href = deleteUrl;
        }
    });
}
</script>

<style>
    body {
        overflow-x: hidden;
    }
    .user-typ{
        position:absolute;
        top:5px;
        left:5px;
    }
    #attachmentsContainer{
        width: 100%;
    }

    /* SweetAlert Custom Styles */
    .swal2-popup-custom {
        border-radius: 12px !important;
    }
    
    .swal2-confirm-custom {
        border-radius: 8px !important;
    }
    
    .swal2-cancel-custom {
        border-radius: 8px !important;
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
    @include('Chats.notification', ['groups' => $groups ?? collect([])])
    <!-- /Sidebar group -->

    <!-- Chat -->
    <div class="chat chat-messages show" id="middle" style="overflow-y: hidden;">
        <div>
            @include('Chats.header')
            <!-- Flash Messages -->
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin: 10px;">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="ti ti-x"></i></button>
            </div>
            @endif

            <!-- Wrapper -->
            <div style="visibility:visible;height: 92vh; overflow-y: auto; scrollbar-width: thin;">
                <div class="chat-body chat-page-group ">
                    <div class="container mt-4">
                        <div class="row g-3">

                            <!-- Card 1 -->
                            <div class="col-12 col-sm-6 col-lg-3 position-relative">
                                <!-- +4% Box -->
                                <div style="position: absolute; right: 20px; background: white; padding: 10px 6px; font-size: 14px; color: #1cc88a; font-weight: 600; border-radius: 6px;">
                                    &#9650; +4%
                                </div>

                                <!-- Main Card -->
                                <div class="d-flex align-items-center justify-content-start px-3"
                                    style="width: 100%; height: 100px; background-color: #fff; border-radius: 12px; font-family: 'Segoe UI', sans-serif; font-size: 14px; color: #2e3a59; cursor: pointer; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);">

                                    <!-- Icon section -->
                                    <div style="width: 80px; height: 80px; background-color: #e6eef5; border-radius: 12px; display: flex; align-items: center; justify-content: center;padding:10px;">
                                        <img src="{{URL::asset('/build/img/card1.svg')}}" alt="Members Icon" style="width: 80px; height: 80px;">
                                    </div>

                                    <!-- Text section -->
                                    <div style="margin-left: 15px;">
                                        <div style="font-size: 24px; font-weight: 600; color: #2e3a59;">{{$membersCount ?? 0}}</div>
                                        <div style="color: #8c94a3; font-weight: 500;">Members</div>
                                    </div>
                                </div>
                            </div>



                            <!-- Card 2 -->
                            <div class="col-12 col-sm-6 col-lg-3 position-relative">
                                <!-- -4% Box -->
                                <div style="position: absolute;  right: 20px; background: white; padding: 10px 6px; font-size: 14px; color: #e74a3b; font-weight: 600; border-radius: 6px;">
                                    &#9660; -4%
                                </div>

                                <!-- Main Card -->
                                <div class="d-flex align-items-center justify-content-start px-3"
                                    style="width: 100%; height: 100px; background-color: #fff; border-radius: 12px; font-family: 'Segoe UI', sans-serif; font-size: 14px; color: #2e3a59; cursor: pointer; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);">

                                    <!-- Icon section -->
                                    <div style="width: 80px; height: 80px; background-color: #c8f1da; border-radius: 12px; display: flex; align-items: center; justify-content: center;padding:10px;">
                                        <img src="{{URL::asset('/build/img/card2.svg')}}" alt="Admins Icon" style="width: 80px; height: 80px;">
                                    </div>

                                    <!-- Text section -->
                                    <div style="margin-left: 15px;">
                                        <div style="font-size: 24px; font-weight: 600; color: #2e3a59;">{{$adminsCount ?? 0}}</div>
                                        <div style="color: #8c94a3; font-weight: 500;">Admins</div>
                                    </div>
                                </div>
                            </div>


                            <!-- Card 3 -->
                            <div class="col-12 col-sm-6 col-lg-3 position-relative">
                                <!-- +4% Box -->
                                <div style="position: absolute; right: 20px; background: white; padding: 10px 6px; font-size: 14px; color: #1cc88a; font-weight: 600; border-radius: 6px;">
                                    &#9650; +4%
                                </div>

                                <!-- Main Card -->
                                <div class="d-flex align-items-center justify-content-start px-3"
                                    style="width: 100%; height: 100px; background-color: #fff; border-radius: 12px; font-family: 'Segoe UI', sans-serif; font-size: 14px; color: #2e3a59; cursor: pointer; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);">

                                    <!-- Icon section -->
                                    <div style="width: 80px; height: 80px; background-color: #a3bacb; border-radius: 12px; display: flex; align-items: center; justify-content: center;padding:10px;">
                                        <img src="{{URL::asset('/build/img/card3.svg')}}" alt="Developer Icon" style="width: 80px; height: 80px;">
                                    </div>

                                    <!-- Text section -->
                                    <div style="margin-left: 15px;">
                                        <div style="font-size: 24px; font-weight: 600; color: #2e3a59;">{{$developersCount ?? 0}}</div>
                                        <div style="color: #8c94a3; font-weight: 500;">Developer</div>
                                    </div>
                                </div>
                            </div>


                            <!-- Card 4 -->
                            <div class="col-12 col-sm-6 col-lg-3 position-relative">
                                <!-- -4% Box -->
                                <div style="position: absolute;  right: 20px; background: white; padding: 10px 6px; font-size: 14px; color: #e74a3b; font-weight: 600; border-radius: 6px;">
                                    &#9660; -4%
                                </div>

                                <!-- Main Card -->
                                <div class="d-flex align-items-center justify-content-start px-3"
                                    style="width: 100%; height: 100px; background-color: #fff; border-radius: 12px; font-family: 'Segoe UI', sans-serif; font-size: 14px; color: #2e3a59; cursor: pointer; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);">

                                    <!-- Icon section -->
                                    <div style="width: 80px; height: 80px; background-color: #1166c1; border-radius: 12px; display: flex; align-items: center; justify-content: center;padding:10px;">
                                        <img src="{{URL::asset('/build/img/card4.svg')}}" alt="Employee Icon" style="width: 80px; height: 80px;">
                                    </div>

                                    <!-- Text section -->
                                    <div style="margin-left: 15px;">
                                        <div style="font-size: 24px; font-weight: 600; color: #2e3a59;">{{$employeesCount ?? 0}}</div>
                                        <div style="color: #8c94a3; font-weight: 500;">Employee</div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- members overwiew -->
                    <div class="project-succes pt-4 pb-2 d-flex justify-content-between align-items-center" style="flex-wrap: wrap; gap: 10px;">

                        <!-- Left Side -->
                        <div>
                            <h3 style="margin: 0;">Members's Overview</h3>
                            <strong>Total members: {{$totalUsers}}</strong>
                        </div>

                        <!-- Right Side -->
                        <div class="d-flex align-items-center flex-wrap" style="gap: 8px;">
                            <button id="addUserButton" onclick="openCreateUser()"
                                type="button"
                                data-bs-toggle="modal"
                                data-bs-target="#add_user"
                                style="background-color: #ff7700; color: white; border: none; padding: 7px 14px; border-radius: 6px; font-weight: 500; display: flex; align-items: center; gap: 6px; cursor: pointer;">
                                Add User
                            </button>

                            <button type="button" class="btn"
                                style="background: #32b768; border: 1px solid #32b768; color: white; border-radius: 6px; font-weight: 500; font-size: 14px; padding: 6px 18px;">
                                All
                            </button>

                            <button type="button" class="btn"
                                style="background: #f8fafc; color: #566a7f; border-radius: 6px; font-weight: 500; font-size: 14px; padding: 6px 18px;">
                                Developer
                            </button>

                            <button type="button" class="btn"
                                style="background: #f8fafc; color: #566a7f; border-radius: 6px; font-weight: 500; font-size: 14px; padding: 6px 18px;">
                                Employe
                            </button>

                            <button type="button" class="btn"
                                style="background: #f8fafc; color: #566a7f; border-radius: 6px; font-weight: 500; font-size: 14px; padding: 6px 18px;">
                                Admin
                            </button>
                        </div>
                    </div>
                    <!-- users cards -->
                    <div class="row g-2">
                        
                        @foreach($users as $user)
                        @if((strtolower($user->type ?? '') === 'member') && (strtolower($user->email ?? '') === 'admin@gmail.com'))
                        @continue
                        @endif
                        <!-- card 4 -->
                        <div class="col-md-3 col-sm-6 mb-4">
                            <div class="card " style=" border-radius: 15px; overflow: hidden; font-family: sans-serif; position: relative;">

                                <!-- Top Background with Overlay Elements -->
                                <div style="position: relative;">
                                    <img src="{{ $user->banner ? asset($user->banner) : asset('build/img/bgblack.svg') }}" class="img-fluid" style="width: 100%; height: 80px; object-fit: cover;" alt="BG Image">

                                    <!-- Top-right overlay group -->
                                    <div style="position: absolute; top: 7px; right: 10px; z-index: 5;">
                                        <div class="d-flex flex-column align-items-end gap-2" style="z-index: 2;">
                                            <!-- Trigger Button (Styled) -->
                                            <div
                                                style="width: 35px; height: 35px; background-color: #dddddd; border-radius: 10px; display: flex; align-items: center; justify-content: center; cursor: pointer;"
                                                onclick="this.nextElementSibling.style.display = this.nextElementSibling.style.display === 'block' ? 'none' : 'block'; event.stopPropagation();">
                                                <div style="width: 24px; height: 24px; border: 1.8px solid #7a7a9d; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                    <span style="color: #2e3a59; font-size: 18px; font-weight: bold; margin-bottom: 8px;">...</span>
                                                </div>
                                            </div>

                                            <!-- Popup Menu -->
                                            <div
                                                class="menu-box"
                                                style="display: none; background: #fff; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); padding: 10px; width: 176px; text-align: center;"
                                                onclick="event.stopPropagation();">
                                                <div style="font-size: 13px; color: #7a7a9d; font-weight: 600; margin-bottom: 8px;">Options</div>
                                                <div class="d-flex justify-content-center align-items-center px-2" style="gap: 18px;">

                                                    <a href="#" onclick="confirmDelete('{{ route('user.destroy', $user->id) }}', '{{ $user->name }}'); return false;">
                                                        <img src="{{URL::asset('/build/img/delete1.svg')}}" alt="Delete" style="width: 22px; cursor: pointer;">
                                                    </a>

                                                    <!-- Vertical Divider -->
                                                    <div style="width: 1px; height: 18px; background-color: #ccc;"></div>

                                                    <img src="{{URL::asset('/build/img/Edit1.svg')}}" alt="Edit" style="width: 22px; cursor: pointer;" data-user='{{ json_encode([
                                                        "id" => $user->id,
                                                        "name" => $user->name,
                                                        "email" => $user->email,
                                                        "title" => $user->title ?? "",
                                                        "user_description" => $user->user_description ?? "",
                                                        "gender" => $user->gender,
                                                        "type" => $user->type,
                                                        "image_url" => $user->image ? asset($user->image) : "",
                                                        "banner_url" => $user->banner ? asset($user->banner) : "",
                                                        "card_image" => $user->card_image ? asset($user->card_image) : "",
                                                        "permissions" => $user->permissions,
                                                    ], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) }}' onclick="openEditUser(JSON.parse(this.getAttribute('data-user')))" data-bs-toggle="modal" data-bs-target="#add_user">

                                                    <!-- Vertical Divider -->
                                                    {{-- <div style="width: 1px; height: 18px; background-color: #ccc;"></div>

                                                    <img src="{{URL::asset('/build/img/flow.svg')}}" alt="Flow" style="width: 22px; cursor: pointer;" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"> --}}

                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- Profile Image (overlapping) -->
                                    <div style="position: absolute; bottom: -40px; left: 50%; transform: translateX(-50%); border: 3px solid #fff; border-radius: 50%; background: white;">
                                        <img src="{{ $user->image ? asset($user->image) : asset('build/img/profileuser.svg') }}" class="rounded-circle" style="width: 80px; height: 80px;" alt="Profile">
                                    </div>
                                </div>

                                <!-- Content Below Image -->
                                <div style="padding-top: 40px;" class="text-center">
                                    <div style="font-weight: bold; font-size: 16px; cursor: pointer;" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" data-user='{{ json_encode([
                                                      "id" => $user->user_id,
                                                        "name" => $user->name,
                                                        "email" => $user->email,
                                                        "title" => $user->title ?? "",
                                                        "user_description" => $user->user_description ?? "",
                                                        "gender" => $user->gender ?? "",
                                                        "type" => $user->type ?? "",
                                                        "country" => $user->country ?? "",
                                                        "team" => $user->team ?? "",
                                                        "group" => $user->group ?? "",
                                                        "phone" => $user->phone ?? "",
                                                        "card_image" => $user->card_image ?? "",
                                                        "attachments" => ($user->attachments ?? collect())->map(function ($attachment) {
                                                                return [
                                                                    "file_name" => $attachment->file_name ?? "",
                                                                    "id" => $attachment->_id ?? "",
                                                                    "file_path" => asset('storage/' . ($attachment->file_path ?? "")),
                                                                    "file_type" => $attachment->file_type ?? "",
                                                                    "size"      => $attachment->size ?? "",
                                                                ];
                                                            })->toArray(),
                                                        "image_url" => $user->image ? asset($user->image) : "",
                                                        "join_date" => optional($user->created_at)->format('d.m.Y')
                                                    ], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) }}' onclick="openUserOffcanvas(JSON.parse(this.getAttribute('data-user')))"> {{$user->name}}</div>
                                    @if(!empty($user->title))
                                    <div style="font-size: 13px; color: #6b7280;">{{$user->title}}</div>
                                    @endif

                                    <!-- Developer Badge -->
                                    <div style="margin-top: 5px;">
                                        <span class="user-typ" style=" background-color: #f1f1f1;  /* slightly darker than #f8f9fb */ color: #e53935;             /* deeper red tone */ font-size: 13px; padding: 4px 12px; border-radius: 12px; font-weight: 600; display: inline-block; ">
                                            {{$user->type}}
                                        </span>
                                        <span style=" background-color: #f1f1f1;  /* slightly darker than #f8f9fb */ color: #e53935;             /* deeper red tone */ font-size: 13px; padding: 4px 12px; border-radius: 12px; font-weight: 600; display: inline-block; ">
                                            {{$user->user_description}}
                                        </span>
                                    </div>


                                </div>
                                <div class="d-flex justify-content-between" style="padding: 10px;">
                                    <!-- Stars -->
                                    <div style="font-size: 18px; color: #fbc02d; margin-top: -2px;background-color: #f8f9fb;border-radius:9px;padding:3px">
                                        ★★★☆☆
                                    </div>

                                    <!-- Date with icon -->
                                    <div style="font-size: 12px; color:green; display: flex; align-items: center; justify-content: center;margin-top: -6px;color: green;background-color: #f8f9fb;border-radius:9px;padding:3px">
                                        <img src="{{ asset('build/img/member.svg') }}" alt="icon" style="width: 14px; margin-right: 4px;">
                                        {{ $user->created_at->format('d.m.Y') }}
                                    </div>
                                </div>

                                <!-- Assigned Projects -->
                                <div class="text-center mt-2 " style="background-color: #f8f9fb;border-radius:10px ;padding:10px;margin:6px;">
                                    <div style="font-weight: 600; color: #1e293b;">Assigned Projects</div>
                                    <div id="userProjectsDetailContainer" class="text-center mt-1" style="min-height: 40px;">
                                        <img src="{{ asset('assets/spin-loader.gif') }}" alt="Loading" style="width: 20px; height: 20px;" />
                                        <span style="font-size: 12px; color: #6c757d; margin-left: 6px;">Loading...</span>
                                    </div>
                                </div>


                                <!-- Stats -->
                                <div class="d-flex justify-content-around mt-1" style="background-color: #f8f9fb;border-radius:10px;padding:10px;margin:6px;font-size: 14px;">
                                    <div class="text-center">
                                        <div style="font-weight: bold;">Total Tickets</div>
                                        <div id="userTicketsCount" style="font-weight: 600; color: #1e293b;">0</div>
                                    </div>
                                    <div class="text-center">
                                        <div style="font-weight: bold;">Total Tasks</div>
                                        <div id="userTasksCount" style="font-weight: 600; color: #1e293b;">0</div>
                                    </div>
                                </div>

                                <!-- Productivity (loader since value is 0%) -->
                                <div class="text-center mt-1 mb-1" style="background-color: #f8f9fb; border-radius: 10px; padding: 10px; margin: 6px; font-size: 14px; font-family: sans-serif;">
                                    <div style="font-weight: 600; color: #4a90e2; display:flex; align-items:center; justify-content:center; gap:8px;">
                                        Productivity
                                        <img src="{{ asset('assets/spin-loader.gif') }}" alt="Loading" style="width: 18px; height: 18px;" />
                                    </div>
                                    <div style="height: 8px; width: 90%; margin: 6px auto; background-color: #e6e6e6; border-radius: 5px;">
                                        <div style="width: 0%; height: 100%; background-color: #4acbff; border-radius: 5px;"></div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        @endforeach

                    </div>

                </div>
            </div>

        </div>

    </div>

</div>

<script>
    function setText(id, value) {
        var el = document.getElementById(id);
        if (!el) return;
        el.textContent = (value && String(value).trim().length) ? value : '-';
    }

    function setImage(id, src, fallback) {
        var img = document.getElementById(id);
        if (!img) return;
        img.src = (src && String(src).trim().length) ? src : fallback;
    }

    function openUserOffcanvas(user) {
        try {
            setImage('offcanvasProfileImageTop', user.image_url, '{{URL::asset('/build/img/profileuser.svg')}}');
            setImage('offcanvasProfileImageMain', user.image_url, '{{URL::asset('/build/img/profileuser.svg')}}');
            
            setText('offcanvasRealName', user.name);
            setText('offcanvasType', user.type);
            setText('offcanvasDescription', user.user_description);
            setText('offcanvasGender', user.gender);
            setText('offcanvasUserId', user.id);
            setText('offcanvasCountry', user.country);
            setText('offcanvasTeam', user.team);
            setText('offcanvasJoinDate', user.join_date);
            setText('offcanvasPhone', user.phone);
            setText('offcanvasEmail', user.email);
            
            // Set group name with @ prefix
            const groupEl = document.getElementById('offcanvasGroup');
            if (groupEl) {
                groupEl.textContent = user.group ? '@' + user.group : '-';
            }

            document.getElementById('userid').value = user.id;

            // Load user projects
            if (user.id) {
                loadUserProjects(user.id);
            }

           // const baseUrl = "{{ asset('storage') }}/"; // Laravel storage base URL
           // const fileUrl = baseUrl + user.card_image;

           // const fileName = user.card_image.split('/').pop();
          //  const ext = fileName.split('.').pop().toLowerCase();

          //  const docName = document.getElementById('doc_name');
         //   const docImage = document.getElementById('doc_img');

           

          //  let icon = 'https://admin.onlinesystems.info/build/img/file-icon.svg';
          ////  if (['pdf'].includes(ext)) icon = 'https://admin.onlinesystems.info/build/img/pdf-icon.svg';
           // if (['jpg','jpeg','png','gif','webp'].includes(ext)) icon = fileUrl;
           // if (['mp4','mov','avi','mkv'].includes(ext)) icon = 'https://cdn-icons-png.flaticon.com/512/711/711245.png';


          //  let dispname  = fileName.replace(/^cards\//, '');

            // limit to 50 characters max
           // if (dispname.length > 25) {
           //     dispname = dispname.substring(0, 25) + '...';
          //  }

            // set the text content
            //docName.textContent = dispname;
           // docImage.src = icon;

            //docImage.style.cursor = 'pointer';
            //docImage.onclick = () => {
            //    window.open(fileUrl, '_blank');
            //};


            const container = document.getElementById('attachmentsContainer');
            container.innerHTML = '';

            // Display card_image if available
            if (user.card_image && user.card_image.trim() !== '') {
                const staticBaseUrl = 'https://logiteam.it-supportline.de/storage/';
                const cardImageUrl = staticBaseUrl + user.card_image;
                const fileName = user.card_image.split('/').pop() || user.card_image;
                const ext = fileName.split('.').pop().toLowerCase();

                // Determine icon/thumbnail
                let icon = cardImageUrl;
                let isImage = ['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(ext);
                if (!isImage) {
                    icon = '{{URL::asset("/build/img/file-icon.svg")}}';
                    if (['pdf'].includes(ext)) icon = '{{URL::asset("/build/img/pdf-icon.svg")}}';
                    if (['mp4', 'mov', 'avi', 'mkv'].includes(ext)) icon = 'https://cdn-icons-png.flaticon.com/512/711/711245.png';
                }

                // Truncate name
                let dispname = fileName.length > 25 ? fileName.substring(0, 25) + '...' : fileName;

                // Build HTML block for card_image
                const cardImageBlock = document.createElement('div');
                cardImageBlock.className = "d-flex justify-content-between align-items-center p-2 mb-2 rounded";
                cardImageBlock.style.backgroundColor = "white";
                cardImageBlock.style.boxShadow = "0 0 6px rgba(0,0,0,0.05)";

                cardImageBlock.innerHTML = `
                    <div class="d-flex align-items-center">
                        <img src="${icon}" style="width: 35px; height: 40px; object-fit: contain; margin-right: 10px; cursor: pointer;"
                            onclick="window.open('${cardImageUrl}', '_blank')" />
                        <div>
                            <div style="font-weight: 500; font-size: 14px; color: #2e3a59;">${dispname}</div>
                        </div>
                    </div>

                    <div style="position: relative; display: inline-block;">
                        <div
                            style="width: 28px; height: 28px; border: 1px solid #a6aec1; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; background:#fff;"
                            onclick="let menu=this.nextElementSibling; menu.style.display = (menu.style.display==='block')?'none':'block'; event.stopPropagation();">
                            <i class="bi bi-three-dots" style="font-size: 16px; color: #2e3a59;"></i>
                        </div>

                        <div class="menu-box"
                            style="display: none; position: absolute; top: 35px; right: 0; background: #fff; width:100px; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); padding: 10px; text-align: center; z-index:1000;"
                            onclick="event.stopPropagation();">
                            <div style="font-size: 13px; color: #7a7a9d; font-weight: 600; margin-bottom: 8px;">Options</div>
                            <div style="display:flex; justify-content: space-between; align-items:center;">
                                <a href="${cardImageUrl}" download>
                                    <img src="{{URL::asset('/build/img/download.svg')}}" alt="Download" style="width: 22px; cursor: pointer;">
                                </a>
                                <a href="${cardImageUrl}" target="_blank">
                                    <img src="{{URL::asset('/build/img/flow.svg')}}" alt="View" style="width: 22px; cursor: pointer;">
                                </a>
                            </div>
                        </div>
                    </div>
                `;

                container.appendChild(cardImageBlock);
            }

            // Display other attachments
            if (user.attachments && Array.isArray(user.attachments) && user.attachments.length > 0) {
                user.attachments.forEach((file, index) => {
                    const fileUrl = file.file_path;
                    const fileName = file.file_name;
                    const ext = fileName.split('.').pop().toLowerCase();

                    // Determine icon
                    let icon = '{{URL::asset("/build/img/file-icon.svg")}}';
                    if (['pdf'].includes(ext)) icon = '{{URL::asset("/build/img/pdf-icon.svg")}}';
                    if (['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(ext)) icon = fileUrl;
                    if (['mp4', 'mov', 'avi', 'mkv'].includes(ext)) icon = 'https://cdn-icons-png.flaticon.com/512/711/711245.png';

                    // Truncate name
                    let dispname = fileName.length > 25 ? fileName.substring(0, 25) + '...' : fileName;

                    // Build HTML block
                    const block = document.createElement('div');
                    block.className = "d-flex justify-content-between align-items-center p-2 mb-2 rounded";
                    block.style.backgroundColor = "white";
                    block.style.boxShadow = "0 0 6px rgba(0,0,0,0.05)";

                    block.innerHTML = `
                        <div class="d-flex align-items-center">
                            <img src="${icon}" style="width: 35px; height: 40px; object-fit: contain; margin-right: 10px; cursor: pointer;"
                                onclick="window.open('${fileUrl}', '_blank')" />
                            <div>
                                <div style="font-weight: 500; font-size: 14px; color: #2e3a59;">${dispname}</div>
                            </div>
                        </div>

                        <div style="position: relative; display: inline-block;">
                            <div
                                style="width: 28px; height: 28px; border: 1px solid #a6aec1; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; background:#fff;"
                                onclick="let menu=this.nextElementSibling; menu.style.display = (menu.style.display==='block')?'none':'block'; event.stopPropagation();">
                                <i class="bi bi-three-dots" style="font-size: 16px; color: #2e3a59;"></i>
                            </div>

                            <div class="menu-box"
                                style="display: none; position: absolute; top: 35px; right: 0; background: #fff; width:100px; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); padding: 10px; text-align: center; z-index:1000;"
                                onclick="event.stopPropagation();">
                                <div style="font-size: 13px; color: #7a7a9d; font-weight: 600; margin-bottom: 8px;">Options</div>
                                <div style="display:flex; justify-content: space-between; align-items:center;">
                                    <img src="{{URL::asset('/build/img/delete1.svg')}}" alt="Delete"
                                        style="width: 22px; cursor: pointer;"
                                        onclick="deleteAttachment('${file.id}', this)">
                                    <a href="${fileUrl}" download>
                                        <img src="{{URL::asset('/build/img/download.svg')}}" alt="Download" style="width: 22px; cursor: pointer;">
                                    </a>
                                </div>
                            </div>
                        </div>
                    `;

                    container.appendChild(block);
                });
            }

            
            



        } catch (e) {
            console.error('Failed to populate user offcanvas', e);
        }
    }

    function loadUserProjects(userId) {
        if (!userId) {
            console.error('loadUserProjects called without userId');
            return;
        }
        
        // Get both containers
        const detailContainer = document.getElementById('userProjectsDetailContainer');
        const mainContainer = document.getElementById('userProjectsContainer');
        
        if (!detailContainer) {
            console.error('userProjectsDetailContainer not found');
        }
        
        // Show loading in detail container
        if (detailContainer) {
            detailContainer.innerHTML = '<div style="color: #6c757d;"><img src="{{ asset("assets/spin-loader.gif") }}" alt="Loading" style="width: 20px; height: 20px;" /> Loading...</div>';
        }
        
        // Show loading in main container
        if (mainContainer) {
            mainContainer.innerHTML = '<div class="col-12 text-center p-4"><div style="color: #6c757d;"><img src="{{ asset("assets/spin-loader.gif") }}" alt="Loading" style="width: 20px; height: 20px;" /> Loading projects...</div></div>';
        }
        
        console.log('Loading projects for user:', userId);
        
        fetch(`/users/${userId}/projects`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Projects API Response:', data); // Debug log
                
                if (data.success) {
                    const projects = data.projects || [];
                    
                    // Update ticket and task counts
                    const ticketsCountEl = document.getElementById('userTicketsCount');
                    const tasksCountEl = document.getElementById('userTasksCount');
                    if (ticketsCountEl) {
                        ticketsCountEl.textContent = data.tickets_count || 0;
                    }
                    if (tasksCountEl) {
                        tasksCountEl.textContent = data.tasks_count || 0;
                    }
                    
                    // Update detail container (in user card) with simple list
                    if (detailContainer) {
                        if (projects.length === 0) {
                            detailContainer.innerHTML = '<div style="color: #6c757d; font-size: 12px;">No projects assigned</div>';
                        } else {
                            const projectsHtml = projects.slice(0, 3).map(project => {
                                return `<div style="font-size: 12px; color: #1e293b; margin-top: 4px; text-align: left; padding: 4px 8px; background: #fff; border-radius: 6px;">
                                    <strong>${project.title || 'Project'}</strong>
                                </div>`;
                            }).join('');
                            const moreText = projects.length > 3 ? `<div style="font-size: 11px; color: #6c757d; margin-top: 4px;">+${projects.length - 3} more</div>` : '';
                            detailContainer.innerHTML = projectsHtml + moreText;
                        }
                    }
                    
                    // Update main container with full project cards
                    if (mainContainer) {
                        renderProjects(projects);
                        if (data.summary) {
                            renderProjectSummary(data.summary);
                        }
                    }
                } else {
                    console.error('API returned success: false', data);
                    if (detailContainer) {
                        detailContainer.innerHTML = '<div style="color: #6c757d; font-size: 12px;">No projects found.</div>';
                    }
                    if (mainContainer) {
                        mainContainer.innerHTML = '<div class="col-12 text-center p-4"><div style="color: #6c757d;">No projects found.</div></div>';
                    }
                }
            })
            .catch(error => {
                console.error('Error loading projects:', error);
                if (detailContainer) {
                    detailContainer.innerHTML = '<div style="color: #e74a3b; font-size: 12px;">Error loading projects. Check console.</div>';
                }
                if (mainContainer) {
                    mainContainer.innerHTML = '<div class="col-12 text-center p-4"><div style="color: #e74a3b;">Error loading projects. Check console for details.</div></div>';
                }
            });
    }

    function renderProjects(projects) {
        try {
            const container = document.getElementById('userProjectsContainer');
            const template = document.getElementById('projectCardTemplate');
            if (!container) {
                console.error('Container userProjectsContainer not found');
                return;
            }
            if (!template) {
                console.error('Template projectCardTemplate not found');
                return;
            }
            
            console.log('Rendering projects:', projects);
            container.innerHTML = '';
            if (!projects || projects.length === 0) {
                container.innerHTML = '<div class="col-12 text-center p-4"><div style="color: #6c757d;">No projects found.</div></div>';
                return;
            }
            
            projects.forEach(project => {
                try {
                    const clone = document.importNode(template.content, true);
                    const progressPercent = project.progress_percent || 0;
                    
                    // Update progress circle
                    const progressText = clone.querySelector('div[style*="position: absolute"]');
                    if (progressText) progressText.textContent = progressPercent + '%';
                    const progressPath = clone.querySelector('svg path:last-child');
                    if (progressPath) progressPath.setAttribute('stroke-dasharray', `${progressPercent}, 100`);
                    
                    // Update logo
                    const logoImg = clone.querySelector('.mx-auto img');
                    if (logoImg && project.logo_url) logoImg.src = project.logo_url;
                    
                    // Update title
                    const titleEl = clone.querySelector('h6');
                    if (titleEl) titleEl.textContent = project.title || 'Project';
                    
                    // Update priority dynamically with color
                    const prioritySpan = clone.querySelector('span[style*="color: #4b5c74"]');
                    if (prioritySpan) {
                        const priority = (project.priority || 'low').toLowerCase();
                        prioritySpan.textContent = priority.toUpperCase();
                        
                        // Set priority color dynamically
                        const priorityColors = {
                            'high': '#ea5455',
                            'medium': '#ffc107',
                            'low': '#28c76f'
                        };
                        const priorityBgColors = {
                            'high': '#fdd7d7',
                            'medium': '#fef3d3',
                            'low': '#f1f3f4'
                        };
                        const color = priorityColors[priority] || priorityColors['low'];
                        const bgColor = priorityBgColors[priority] || priorityBgColors['low'];
                        
                        // Update the priority container background
                        const priorityContainer = prioritySpan.closest('div[style*="background"]');
                        if (priorityContainer) {
                            priorityContainer.style.background = bgColor;
                        }
                        
                        // Update the dot color
                        const dot = priorityContainer ? priorityContainer.querySelector('span[style*="border-radius: 50%"]') : null;
                        if (dot) {
                            dot.style.background = color;
                        }
                    }
                    
                    // Update flag icon dynamically based on priority
                    const flagContainer = clone.querySelector('div[style*="background: #fff3cd"]');
                    if (flagContainer) {
                        const priority = (project.priority || 'low').toLowerCase();
                        const flagColors = {
                            'high': '#fdd7d7',
                            'medium': '#fef3d3',
                            'low': '#fff3cd'
                        };
                        flagContainer.style.background = flagColors[priority] || flagColors['low'];
                        
                        // Update flag icon based on priority
                        const flagImg = flagContainer.querySelector('img');
                        if (flagImg) {
                            const flagIcons = {
                                'high': '{{ asset("build/img/redflag.svg") }}',
                                'medium': '{{ asset("build/img/yelowflag.svg") }}',
                                'low': '{{ asset("build/img/yelowflag.svg") }}'
                            };
                            flagImg.src = flagIcons[priority] || flagIcons['low'];
                        }
                    }
                    
                    // Update dates - find the specific date div (the one with "Ticket ID" text)
                    const allDateDivs = clone.querySelectorAll('div[style*="font-size: 12px"]');
                    const dateDiv = Array.from(allDateDivs).find(div => div.textContent && div.textContent.includes('Ticket ID'));
                    if (dateDiv) {
                        // Get section names dynamically
                        const sectionNames = project.sections && project.sections.length > 0 
                            ? project.sections.map(s => s.name || 'Section').join(', ') 
                            : 'Section';
                        const sectionText = project.sections && project.sections.length > 0 
                            ? `<strong>${sectionNames}</strong>` 
                            : '<strong>Section</strong>';
                        
                        const dateContent = project.start_date && project.end_date
                            ? `<div><strong>${project.code || 'N/A'}</strong> | ${sectionText}</div><div><span style="color: #28c76f;">Start:</span> ${project.start_date}</div><div><span style="color: #28c76f;">Deliver:</span> ${project.end_date}</div>`
                            : `<div><strong>${project.code || 'N/A'}</strong> | ${sectionText}</div>${project.start_date ? `<div><span style="color: #28c76f;">Start:</span> ${project.start_date}</div>` : ''}${project.end_date ? `<div><span style="color: #28c76f;">Deliver:</span> ${project.end_date}</div>` : ''}`;
                        dateDiv.innerHTML = dateContent;
                    }
                    
                    // Update stats
                    const statsDivs = clone.querySelectorAll('div[style*="flex: 1"]');
                    if (statsDivs.length >= 4) {
                        const lastChild0 = statsDivs[0].querySelector('div:last-child');
                        if (lastChild0) lastChild0.textContent = `#${project.in_progress_tickets || 0} of #${project.total_tickets || 0}`;
                        const lastChild1 = statsDivs[1].querySelector('div:last-child');
                        if (lastChild1) lastChild1.textContent = `#${project.total_tasks || 0}`;
                        const lastChild2 = statsDivs[2].querySelector('div:last-child');
                        if (lastChild2) lastChild2.textContent = `#${project.days_left || 0}`;
                        const lastChild3 = statsDivs[3].querySelector('div:last-child');
                        if (lastChild3) lastChild3.textContent = `${progressPercent}%`;
                    }
                    
                    // Update progress bar
                    const progressBar = clone.querySelector('.progress-bar');
                    if (progressBar) progressBar.style.width = progressPercent + '%';
                    
                    // Update PM
                    const pmImg = clone.querySelector('div[style*="Project Manager"] + img');
                    if (pmImg && project.project_manager && project.project_manager.avatar) {
                        pmImg.src = project.project_manager.avatar;
                    }
                    
                    // Update developers - display ALL developers dynamically
                    const devContainer = clone.querySelector('div[style*="Developers"] + div');
                    if (devContainer && project.developers && project.developers.length > 0) {
                        devContainer.innerHTML = '';
                        // Adjust container width based on number of developers
                        const maxVisible = 5; // Show up to 5 avatars
                        const visibleDevs = project.developers.slice(0, maxVisible);
                        const containerWidth = Math.min(visibleDevs.length * 18 + 32, 120);
                        devContainer.style.width = containerWidth + 'px';
                        
                        visibleDevs.forEach((dev, index) => {
                            const img = document.createElement('img');
                            img.src = dev.avatar || '{{ asset("build/img/profileuser.svg") }}';
                            img.className = 'rounded-circle border border-white shadow-sm';
                            img.style.cssText = `width: 32px; height: 32px; position: absolute; left: ${index * 18}px; z-index: ${maxVisible - index};`;
                            img.title = dev.name || 'Developer';
                            devContainer.appendChild(img);
                        });
                        
                        // If there are more developers, show a count badge
                        if (project.developers.length > maxVisible) {
                            const badge = document.createElement('span');
                            badge.className = 'badge bg-primary';
                            badge.style.cssText = `position: absolute; left: ${maxVisible * 18}px; z-index: 0; font-size: 10px; padding: 2px 6px;`;
                            badge.textContent = `+${project.developers.length - maxVisible}`;
                            badge.title = `Total: ${project.developers.length} developers`;
                            devContainer.appendChild(badge);
                        }
                    }
                    
                    // Update tickets & tasks with dynamic task status breakdown
                    const ticketsTasksDiv = clone.querySelector('div[style*="Ticket & Tasks"] + div');
                    if (ticketsTasksDiv) {
                        const taskStatus = project.task_status_breakdown || {};
                        const statusText = [
                            taskStatus.new ? `${taskStatus.new} New` : '',
                            taskStatus.in_progress ? `${taskStatus.in_progress} Progress` : '',
                            taskStatus.completed ? `${taskStatus.completed} Done` : ''
                        ].filter(Boolean).join(', ');
                        
                        ticketsTasksDiv.innerHTML = `
                            <div style="font-size: 11px; color: #6c757d; margin-top: 10px;">
                                <div><strong>${project.total_tickets || 0}</strong> Tickets - <strong>${project.total_tasks || 0}</strong> Tasks</div>
                                ${statusText ? `<div style="font-size: 10px; color: #28c76f; margin-top: 4px;">${statusText}</div>` : ''}
                            </div>
                        `;
                    }
                    
                    // Update sections - find by structure
                    const sectionsContainer = clone.querySelector('div.flex-grow-1.mt-1');
                    if (sectionsContainer && project.sections && project.sections.length > 0) {
                        // Find labels div (contains spans with Section#1)
                        const labelsDiv = Array.from(sectionsContainer.querySelectorAll('div')).find(div => 
                            div.textContent && div.textContent.includes('Section#1')
                        );
                        // Find bars div (contains progress bars)
                        const barsDiv = Array.from(sectionsContainer.querySelectorAll('div')).find(div => 
                            div.querySelectorAll('.progress').length > 0
                        );
                        
                        if (labelsDiv && barsDiv) {
                            labelsDiv.innerHTML = '';
                            barsDiv.innerHTML = '';
                            project.sections.slice(0, 4).forEach((section, index) => {
                                const span = document.createElement('span');
                                span.style.cssText = 'margin-left:10px;margin-right:10px;';
                                span.textContent = `${section.name || 'Section'} ${section.progress || 0}%`;
                                labelsDiv.appendChild(span);
                                const progressDiv = document.createElement('div');
                                progressDiv.className = 'progress';
                                progressDiv.style.cssText = `width: 24%; height: 10px; background-color: ${index % 3 === 0 ? '#d3f4dc' : index % 3 === 1 ? '#fef3d3' : '#fdd7d7'}; border-radius: 10px;`;
                                const bar = document.createElement('div');
                                bar.className = 'progress-bar';
                                bar.style.cssText = `width: ${section.progress || 0}%; background-color: ${index % 3 === 0 ? '#28c76f' : index % 3 === 1 ? '#ffc107' : '#ea5455'}; border-radius: 10px;`;
                                progressDiv.appendChild(bar);
                                barsDiv.appendChild(progressDiv);
                            });
                        }
                    }
                    
                    // Update teams section dynamically
                    const teamsContainer = clone.querySelector('#teamsContainer');
                    if (teamsContainer && project.teams && project.teams.length > 0) {
                        teamsContainer.innerHTML = '';
                        project.teams.forEach((team, teamIndex) => {
                            const teamDiv = document.createElement('div');
                            teamDiv.style.cssText = 'background: white; border-radius: 8px; padding: 10px; border-left: 3px solid ' + (team.timeline_color || '#4dc3ff') + ';';
                            
                            // Team title
                            const teamTitle = document.createElement('div');
                            teamTitle.style.cssText = 'font-weight: 600; font-size: 13px; color: #2b3e5f; margin-bottom: 8px;';
                            teamTitle.textContent = team.title || 'Team';
                            teamDiv.appendChild(teamTitle);
                            
                            // Team PM if available
                            if (team.pm) {
                                const pmDiv = document.createElement('div');
                                pmDiv.style.cssText = 'display: flex; align-items: center; gap: 8px; margin-bottom: 6px; font-size: 11px; color: #6c757d;';
                                const pmImg = document.createElement('img');
                                pmImg.src = team.pm.avatar || '{{ asset("build/img/profileuser.svg") }}';
                                pmImg.style.cssText = 'width: 20px; height: 20px; border-radius: 50%;';
                                pmImg.alt = 'PM';
                                pmDiv.appendChild(pmImg);
                                const pmText = document.createElement('span');
                                pmText.textContent = 'PM: ' + (team.pm.name || 'N/A');
                                pmDiv.appendChild(pmText);
                                teamDiv.appendChild(pmDiv);
                            }
                            
                            // Team developers
                            if (team.developers && team.developers.length > 0) {
                                const devsDiv = document.createElement('div');
                                devsDiv.style.cssText = 'display: flex; align-items: center; gap: 6px; margin-bottom: 6px; flex-wrap: wrap;';
                                const devsLabel = document.createElement('span');
                                devsLabel.style.cssText = 'font-size: 11px; color: #6c757d; font-weight: 600;';
                                devsLabel.textContent = 'Developers:';
                                devsDiv.appendChild(devsLabel);
                                
                                const devsContainer = document.createElement('div');
                                devsContainer.style.cssText = 'display: flex; gap: 4px;';
                                team.developers.slice(0, 5).forEach(dev => {
                                    const devImg = document.createElement('img');
                                    devImg.src = dev.avatar || '{{ asset("build/img/profileuser.svg") }}';
                                    devImg.style.cssText = 'width: 24px; height: 24px; border-radius: 50%; border: 1px solid #e0e0e0;';
                                    devImg.title = dev.name || 'Developer';
                                    devsContainer.appendChild(devImg);
                                });
                                if (team.developers.length > 5) {
                                    const moreBadge = document.createElement('span');
                                    moreBadge.style.cssText = 'font-size: 10px; color: #6c757d; padding: 2px 6px; background: #f0f0f0; border-radius: 10px;';
                                    moreBadge.textContent = '+' + (team.developers.length - 5);
                                    devsContainer.appendChild(moreBadge);
                                }
                                devsDiv.appendChild(devsContainer);
                                teamDiv.appendChild(devsDiv);
                            }
                            
                            // Team tasks
                            if (team.tasks && team.tasks.length > 0) {
                                const tasksDiv = document.createElement('div');
                                tasksDiv.style.cssText = 'font-size: 11px; color: #6c757d; margin-top: 6px;';
                                const taskCounts = {};
                                team.tasks.forEach(task => {
                                    const status = task.status || 'new';
                                    taskCounts[status] = (taskCounts[status] || 0) + 1;
                                });
                                
                                const taskText = Object.entries(taskCounts)
                                    .map(([status, count]) => `${count} ${status}`)
                                    .join(', ');
                                tasksDiv.innerHTML = `<strong>Tasks:</strong> ${team.total_tasks || 0} total (${taskText})`;
                                teamDiv.appendChild(tasksDiv);
                            } else {
                                const noTasksDiv = document.createElement('div');
                                noTasksDiv.style.cssText = 'font-size: 11px; color: #6c757d; margin-top: 6px;';
                                noTasksDiv.textContent = 'No tasks assigned';
                                teamDiv.appendChild(noTasksDiv);
                            }
                            
                            teamsContainer.appendChild(teamDiv);
                        });
                    } else if (teamsContainer) {
                        teamsContainer.innerHTML = '<div class="text-center p-2" style="color: #6c757d; font-size: 12px;">No teams available</div>';
                    }
                    
                    container.appendChild(clone);
                } catch (e) {
                    console.error('Error rendering project:', project, e);
                }
            });
        } catch (e) {
            console.error('Error in renderProjects:', e);
            const container = document.getElementById('userProjectsContainer');
            if (container) {
                container.innerHTML = '<div class="col-12 text-center p-4"><div style="color: #e74a3b;">Error rendering projects. Check console for details.</div></div>';
            }
        }
    }

    function renderProjectSummary(summary) {
        if (!summary) return;
        const titleEl = document.getElementById('totalProjectsTitle');
        if (titleEl && summary.total_projects !== undefined) {
            titleEl.textContent = `Total Projects (${summary.total_projects})`;
        }
        const tagsContainer = document.getElementById('projectTagsContainer');
        if (tagsContainer && summary.project_summary) {
            tagsContainer.innerHTML = '';
            if (summary.project_summary.length === 0) {
                tagsContainer.innerHTML = '<div class="col-12 text-center p-2"><div style="color: #6c757d; font-size: 12px;">No projects</div></div>';
            } else {
                summary.project_summary.forEach(project => {
                    const tagDiv = document.createElement('div');
                    tagDiv.className = 'd-flex flex-wrap align-items-center gap-2';
                    tagDiv.style.cssText = 'background: #f7f7f7; padding: 6px 10px; border-radius: 8px; font-size: 13px;';
                    tagDiv.innerHTML = `<img src="${project.logo_url || '{{ URL::asset("/build/img/yekbon.svg") }}'}" alt="Logo" style="width: 24px; height: 24px;"><div class="d-flex flex-wrap flex-column" style="line-height: 1.2;"><strong style="color: #1a2343; font-size: 13px;">${project.title || 'Project'}</strong><div class="d-flex flex-wrap gap-2 mt-1"><span style="color: #1a2343;">Tickets<span style="background: #ff4d4f; color: #fff; border-radius: 50%; padding: 2px 6px; font-size: 10px;">${project.tickets_count || 0}</span></span><span style="color: #1a2343;">Tasks<span style="background: #ff4d4f; color: #fff; border-radius: 50%; padding: 2px 6px; font-size: 10px;">${project.tasks_count || 0}</span></span></div></div>`;
                    tagsContainer.appendChild(tagDiv);
                });
            }
        }
        if (summary.task_stats) {
            const stats = summary.task_stats;
            const updateCount = (id, count) => {
                const el = document.getElementById(id);
                if (el) el.textContent = count || 0;
            };
            updateCount('newTaskCount', stats.new_tasks);
            updateCount('totalTaskCount', stats.total_tasks);
            updateCount('progressTaskCount', stats.progress_tasks);
            updateCount('inHoldTaskCount', stats.in_hold_tasks);
            updateCount('inCheckTaskCount', stats.in_check_tasks);
            updateCount('delayedTaskCount', stats.delayed_tasks);
            updateCount('rejectedTaskCount', stats.rejected_tasks);
        }
    }

    function deleteAttachment(id, el) {
        
        Swal.fire({
            title: 'Delete Document?',
            text: "Are you sure you want to delete this file?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {

                // Fire the DELETE request
                fetch(`/attachments/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'The attachment has been deleted.',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false
                        });

                        // remove the element smoothly
                        const block = el.closest('.d-flex');
                        block.style.transition = 'opacity 0.3s ease';
                        block.style.opacity = '0';
                        setTimeout(() => block.remove(), 300);

                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: data.message || 'Failed to delete the file.',
                            icon: 'error'
                        });
                    }
                })
                .catch(err => {
                    console.error('Error deleting attachment:', err);
                    Swal.fire({
                        title: 'Error!',
                        text: 'Something went wrong while deleting the file.',
                        icon: 'error'
                    });
                });
            }
        });
    }


</script>

<!-- user pop-up -->

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel"
    style="width: 65vw; max-width: 100%; overflow-x: hidden;">

    <!-- Offcanvas Header -->
    <div class="offcanvas-header p-0 position-relative" style="height: 180px;">
        <!-- Background image -->
        <img src="{{URL::asset('/build/img/bgblack.svg')}}" alt="Header Image"
            style="width: 100%; height: 100%; object-fit: cover;">

        <!-- Profile Image (top-right, overlapping) -->
        <img id="offcanvasProfileImageTop" src="{{URL::asset('/build/img/profileuser.svg')}}" alt="Profile"
            style="position: absolute; top: 20px; right: 50px; width: 80px; height: 80px; border-radius: 50%; border: 3px solid #fff; box-shadow: 0 0 10px rgba(0,0,0,0.3); z-index: 10;">
        <div style="font-size: 18px; color: #fbc02d;border-radius:9px;padding:3px;position: absolute; top: 107px; right: 50px;">
            ★★★☆☆
        </div>



        <!-- Close Button -->
        <button type="button" data-bs-dismiss="offcanvas" aria-label="Close"
            style="position: absolute; top: 10px; right: 10px; background-color: white; color: black; border: none; border-radius: 50%; width: 36px; height: 36px; font-size: 24px; font-weight: bold; z-index: 9999; display: flex; align-items: center; justify-content: center; box-shadow: 0 0 6px rgba(0, 0, 0, 0.2)">
            &times;
        </button>

    </div>

    <!-- Buttons Under Header -->
    <!-- <div class="px-4 py-2">
    <button class="btn btn-success me-2" id="btnOverview" onclick="showTab('overview')">Overview</button>
    <button class="btn btn-light border" id="btnStatistics" onclick="showTab('statistics')">Statistics</button>
  </div> -->
    <div class="px-4 py-2">
        <button class="btn btn-success me-2" id="btnOverview" onclick="showContent('overview')">Overview</button>
        <button class="btn btn-light border" id="btnStatistics" onclick="showContent('statistics')">Statistics</button>
    </div>


    <!-- Main Content Grid -->
    <div  style="display: block;">
        <div class="row m-0  py-2">
            <!-- Left Panel: col-3 -->
            <div class="col-lg-4 col-md-8 col-sm-12">
                <!-- Add left side profile card/info -->
                <div class="card mb-3">
                    <div style=" font-family: 'Segoe UI', sans-serif;">
                        <!-- Header with Blue Background -->
                        <div style="background: linear-gradient(to right, #1565c0, #4fc3f7); height: 140px; position: relative; border-top-left-radius: 10px; border-top-right-radius: 10px;"></div>

                        <!-- Info Section Background -->
                        <div style="background-color: #fafcfc; padding: 20px; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                            <!-- Profile Image (Overlapping) -->
                            <div style="position: relative; margin-top: -60px; text-align: center;" class="mb-3">
                                <img id="offcanvasProfileImageMain" src="{{URL::asset('/build/img/profileuser.svg')}}" alt="Profile" style="width: 100px; height: 100px; border-radius: 50%; border: 4px solid white; object-fit: cover; box-shadow: 0 0 8px rgba(0,0,0,0.2);">
                                <h5 id="offcanvasRealName" class="mt-2 mb-1">&nbsp;</h5>
                                <span id="offcanvasType" class="badge  text-danger" style="font-size: 12px;background:white;border-radius:10px;"></span>
                                <span id="offcanvasDescription" class="badge  text-danger" style="font-size: 12px;background:white;border-radius:10px;"></span>
                            </div>
                            <!-- Info Rows -->
                            <div class="card mb-2 p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div> <img src="{{URL::asset('/build/img/User11.svg')}}" alt="" style="width: 20px;"> Gender</div>
                                    <div id="offcanvasGender" class="fw-bold">-</div>
                                </div>
                            </div>

                            <div class="card mb-2 p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><img src="{{URL::asset('/build/img/user_od.svg')}}" alt="" style="width: 20px;"> User ID</div>
                                    <div id="offcanvasUserId" class="fw-bold">-</div>
                                </div>
                            </div>

                            <div class="card mb-2 p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><img src="{{URL::asset('/build/img/Globus.svg')}}" alt="" style="width: 20px;"> Country</div>
                                    <div id="offcanvasCountry" class="fw-bold">-</div>
                                </div>
                            </div>

                            <div class="card mb-2 p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><img src="{{URL::asset('/build/img/teamicon.svg')}}" alt="" style="width: 20px;"> Team</div>
                                    <div id="offcanvasTeam" class="fw-bold">-</div>
                                </div>
                            </div>

                            <div class="card mb-2 p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><img src="{{URL::asset('/build/img/timeicon.svg')}}" alt="" style="width: 20px;"> Join Date</div>
                                    <div id="offcanvasJoinDate" class="fw-bold">-</div>
                                </div>
                            </div>

                            <div class="card mb-2 p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><img src="{{URL::asset('/build/img/calling.svg')}}" alt="" style="width: 20px;"> Phone</div>
                                    <div id="offcanvasPhone" class="fw-bold">-</div>
                                </div>
                            </div>

                            <div class="card mb-2 p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div> <img src="{{URL::asset('/build/img/Letter.svg')}}" alt="" style="width: 20px;"> E-Mail</div>
                                    <div id="offcanvasEmail" class="fw-bold">-</div>
                                </div>
                            </div>

                            <div class="card mb-2 p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div> <img src="{{URL::asset('/build/img/msg.svg')}}" alt="" style="width: 20px;"> Message</div>
                                    <div id="offcanvasGroup" class="fw-bold text-primary">-</div>
                                </div>
                            </div>





                        </div>

                        <!-- pdf -->

                        <div class="mt-2" style="background-color: #fafcfc; padding: 20px;">
                            <h6 class="mb-3" style="color: #6c7a89;">Documents</h6>
                            <div class="row">
                                <!-- Document Card -->
                                <div class="col-12 mb-3">
                                    <div class="d-flex justify-content-between align-items-center p-2 rounded"
                                        style="background-color: white; box-shadow: 0 0 6px rgba(0,0,0,0.05);">
                                        
                                        

                                        <div id="attachmentsContainer"></div>
   

                                    </div>



                                    <form  id="uploaddoc" action="{{ route('users.document') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="user" value="" id="userid" />
                                        <div class="pdf-add-tile d-flex align-items-center justify-content-center text-center" style="margin:auto; margin-top:10px; width: 160px; height: 60px; border: 1px dashed #cfd3d9; border-radius: 10px; cursor: pointer; background:#fff;" onclick="createAddPdfFile()">
                                            <div style="font-size: 22px; color: #a0a4ab; line-height: 1;">+</div>
                                        </div>
                                
                                    </form>
                                </div>

                                

                            </div>
                        </div>
                        <!-- 5 starts -->
                        <div class="mt-2" style="font-family: 'Segoe UI', sans-serif;background-color: #fafcfc; padding: 20px;">
                            <div>
                                <!-- Top Rating -->
                                <div class="d-flex  mb-3">
                                    <h2 class="me-2" style="font-size: 36px; color: #2e3a59;">5</h2>
                                    <!-- Star Rating -->
                                    <div>
                                        <i class="bi bi-star-fill" style="color: #ffc107;"></i>
                                        <i class="bi bi-star-fill" style="color: #ffc107;"></i>
                                        <i class="bi bi-star-fill" style="color: #ffc107;"></i>
                                        <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                        <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                    </div>
                                </div>

                                <!-- Individual Ratings -->
                                <div class="d-grid gap-2">
                                    <!-- One row -->
                                    <div class="d-flex justify-content-between align-items-center p-2"
                                        style="background-color: white;">
                                        <div style="color: #6c7a89;">Reliability</div>
                                        <div>
                                            <i class="bi bi-star-fill" style="color: #ffc107;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                        </div>
                                    </div>

                                    <!-- Repeat for other traits -->
                                    <div class="d-flex justify-content-between align-items-center p-2 rounded"
                                        style="background-color: white;">
                                        <div style="color: #6c7a89;">Accuracy</div>
                                        <div>
                                            <i class="bi bi-star-fill" style="color: #ffc107;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center p-2 rounded"
                                        style="background-color: white;">
                                        <div style="color: #6c7a89;">Punctuality</div>
                                        <div>
                                            <i class="bi bi-star-fill" style="color: #ffc107;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center p-2 rounded"
                                        style="background-color: white;">
                                        <div style="color: #6c7a89;">Quality</div>
                                        <div>
                                            <i class="bi bi-star-fill" style="color: #ffc107;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center p-2 rounded"
                                        style="background-color: white;">
                                        <div style="color: #6c7a89;">Work independent</div>
                                        <div>
                                            <i class="bi bi-star-fill" style="color: #ffc107;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                            <i class="bi bi-star" style="color: #d6dbe3;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


            <!-- here can set -->
             <!-- Right Panel: col-9 -->
            <div id="statisticsContent" class="toggle-content  col-md-8 col-sm-12" style="display:none";>

                <div style="background: #eef0f4; padding: 20px; border-radius: 12px;  font-family: 'Segoe UI', sans-serif;">
                    <!-- Title Outside Card -->
                    <div style="color: #2b3e5f; font-weight: 600; font-size: 15px;">Task Activities</div>
                    <div style="color: #6c757d; font-size: 12px; margin-bottom: 10px;">Total Asigned 250</div>

                    <!-- Card -->
                    <div style="background: white; border-radius: 12px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); padding: 15px 10px 10px 10px; position: relative;">
                        <div style="display: flex; align-items: flex-end; height: 353px; position: relative;">
                            <!-- Y-Axis Labels -->
                            <!-- Y-Axis Labels -->
                            <div style="position: absolute; bottom: 0; left: 0; height: 310px; width: 30px; display: flex; flex-direction: column; justify-content: space-between; z-index: 2; font-size: 10px; color: #666;">
                                <div style="margin-top: -56px;">250</div>
                                <div style="margin-top: 6px;">200</div>
                                <div style="margin-top: 11px;">150</div>
                                <div style="margin-top: 8px;">100</div>
                                <div style="margin-top: 8px;">50</div>
                                <div style="margin-bottom: -7px;">0</div>
                                <div style="margin-top: -2px;"></div>
                                <div style="margin-top: -2px;"></div>
                            </div>


                            <!-- Graph Area -->
                            <div style="margin-left: 30px; width: 100%; position: relative;">
                                <!-- Dotted Lines -->
                                <div style="position: absolute; top: 0; width: 100%; height: 100%; z-index: 0;margin-top:-59px;">
                                    <div style="border-top: 3px dashed #ccc; height: 20%;"></div>
                                    <div style="border-top: 3px dashed #ccc; height: 20%;"></div>
                                    <div style="border-top: 3px dashed #ccc; height: 20%;"></div>
                                    <div style="border-top: 3px dashed #ccc; height: 20%;"></div>
                                    <div style="border-top: 3px dashed #ccc; height: 20%;"></div>
                                    <div style="border-top: 1px solid #ccc; height: 1%;"></div>
                                </div>

                                <!-- Bars -->
                                <!-- Bars -->
                                <div style="display: flex; justify-content: space-between; align-items: flex-end; height: 100%; z-index: 2;position: relative;">

                                    <!-- Progress -->
                                    <div style="text-align: center;">
                                        <div style="height: calc(15 / 123 * 310px); width: 36px; background: #a7e92f; border-radius: 4px; margin-bottom: 5px; font-size: 10px; color: white; line-height: 20px;">15</div>
                                        <img src="{{ asset('build/img/progress.svg') }}" style="width: 24px;">
                                        <div style="font-size: 10px; color: #444;">Progress</div>
                                        <div style="font-size: 10px; color: #444;">15</div>
                                    </div>

                                    <!-- In Hold -->
                                    <div style="text-align: center;">
                                        <div style="height: calc(55 / 250 * 310px); width: 36px; background: #f5a623; border-radius: 4px; margin-bottom: 5px; font-size: 10px; color: white; line-height: 20px;">55</div>
                                        <img src="{{ asset('build/img/inhold.svg') }}" style="width: 24px;">
                                        <div style="font-size: 10px; color: #444;">In Hold</div>
                                        <div style="font-size: 10px; color: #444;">15</div>
                                    </div>

                                    <!-- Delayed -->
                                    <div style="text-align: center;">
                                        <div style="height: calc(184 / 294 * 310px); width: 36px; background: #f44336; border-radius: 4px; margin-bottom: 5px; font-size: 10px; color: white; line-height: 20px;">155</div>
                                        <img src="{{ asset('build/img/delayed.svg') }}" style="width: 24px;">
                                        <div style="font-size: 10px; color: #444;">Delayed</div>
                                        <div style="font-size: 10px; color: #444;">15</div>
                                    </div>

                                    <!-- Rejected -->
                                    <div style="text-align: center;">
                                        <div style="height: calc(45 / 250 * 310px); width: 36px; background: #f54ea2; border-radius: 4px; margin-bottom: 5px; font-size: 10px; color: white; line-height: 20px;">45</div>
                                        <img src="{{ asset('build/img/rejected.svg') }}" style="width: 24px;">
                                        <div style="font-size: 10px; color: #444;">Rejected</div>
                                        <div style="font-size: 10px; color: #444;">15</div>
                                    </div>

                                    <!-- Done -->
                                    <div style="text-align: center;">
                                        <div style="height: calc(245 / 317 * 310px); width: 36px; background: #00d36d; border-radius: 4px; margin-bottom: 5px; font-size: 10px; color: white; line-height: 20px;">199</div>
                                        <img src="{{ asset('build/img/Done.svg') }}" style="width: 24px;">
                                        <div style="font-size: 10px; color: #444;">Done</div>
                                        <div style="font-size: 10px; color: #444;">15</div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- timeboxes -->
                <div style="background-color: #f0f2f5; padding: 20px; border-radius: 12px; font-family: 'Segoe UI', sans-serif;" class="mt-2">
                    <div class="d-flex justify-content-between mb-2">
                        <div class="wh">
                            <h5>Working Times</h5>
                        </div>
                        <div>
                            <select class="form-select form-select-sm" style="width: 140px; font-size: 13px;border-radius:8px">
                                <option selected>Select Projects</option>
                                <option selected>Yekbon</option>
                                <option selected>CMS</option>
                            </select>
                        </div>

                    </div>

                    <!-- Box 1 -->
                    <div style="background-color: #ffffff; border-radius: 12px; padding: 16px; margin-bottom: 16px;">
                        <!-- Date -->
                        <div style="display: flex; align-items: baseline; gap: 6px; margin-bottom: 10px;">
                            <span style="font-size: 22px; font-weight: bold; color: #2196f3;">27</span>
                            <span style="font-size: 13px; color: #00bcd4;">September 2019</span>
                        </div>

                        <!-- Time + Bar -->
                        <div style="position: relative; height: 60px;">
                            <!-- Time Labels -->
                            <div style="display: flex; justify-content: space-between; font-size: 12px; color: #4b5c74; margin-bottom: 8px;">
                                <span>8:00</span>
                                <span>12:00</span>
                                <span>16:00</span>
                                <span>20:00</span>
                            </div>

                            <!-- Dotted line -->


                            <!-- Blue Bars -->
                            <div style="position: absolute; top: 33px; left: 0%; width: 18%; height: 6px; background: linear-gradient(to right, #00c6ff, #0072ff); border-radius: 4px;"></div>
                            <div style="position: absolute; top: 33px; left: 24%; width: 20%; height: 6px; background: linear-gradient(to right, #00c6ff, #0072ff); border-radius: 4px;"></div>
                            <div style="position: absolute; top: 33px; left: 52%; width: 44%; height: 6px; background: linear-gradient(to right, #00c6ff, #0072ff); border-radius: 4px;"></div>
                        </div>
                    </div>

                    <!-- Duplicate this Box for second row -->
                    <div style="background-color: #ffffff; border-radius: 12px; padding: 16px;">
                        <div style="display: flex; align-items: baseline; gap: 6px; margin-bottom: 10px;">
                            <span style="font-size: 22px; font-weight: bold; color: #2196f3;">27</span>
                            <span style="font-size: 13px; color: #00bcd4;">September 2019</span>
                        </div>

                        <div style="position: relative; height: 60px;">
                            <div style="display: flex; justify-content: space-between; font-size: 12px; color: #4b5c74; margin-bottom: 8px;">
                                <span>8:00</span>
                                <span>12:00</span>
                                <span>16:00</span>
                                <span>20:00</span>
                            </div>


                            <div style="position: absolute; top: 33px; left: 0%; width: 18%; height: 6px; background: linear-gradient(to right, #00c6ff, #0072ff); border-radius: 4px;"></div>
                            <div style="position: absolute; top: 33px; left: 24%; width: 20%; height: 6px; background: linear-gradient(to right, #00c6ff, #0072ff); border-radius: 4px;"></div>
                            <div style="position: absolute; top: 33px; left: 52%; width: 44%; height: 6px; background: linear-gradient(to right, #00c6ff, #0072ff); border-radius: 4px;"></div>
                        </div>
                    </div>
                </div>
                <!-- system log -->
                <div class="mt-2" style="background-color: #f0f2f5; padding: 20px;padding-bottom:10px; border-radius: 14px;">
                    <!-- Header -->

                    <div class="d-flex justify-content-between mb-2">
                        <div class="wh">
                            <h5 style="font-weight: 600; color: #1a1a3c; margin-bottom: 16px;">System Logs</h5>
                        </div>
                        <div>
                            <select class="form-select form-select-sm" style="width: 140px; font-size: 13px;border-radius:8px">
                                <option selected>Select Projects</option>
                                <option selected>Yekbon</option>
                                <option selected>CMS</option>
                            </select>
                        </div>

                    </div>
                    <!-- Log Entry Card #1 -->
                    <div class="p-3 mb-3" style="background: #ffffff; border-radius: 12px; font-family: 'Segoe UI', sans-serif;">
                        <div class="d-flex align-items-center justify-content-center gap-3" style="font-size: 17px; font-weight: 500; color: #4b5c74;">
                            <img src="{{ asset('build/img/groups/group-01.jpg') }}" alt="User" style="width: 40px; height: 40px; border-radius: 50%;">
                            <div style="flex: 1;margin-right:45px;">
                                <div style="color: #1d6fa5;">Login Date</div>
                                <div style="font-size: 15px;">DD.MM.YYYY</div>
                            </div>
                            <div style="flex: 1;margin-right:45px;">
                                <div style="color: #1d6fa5;">Login Time</div>
                                <div style="font-size: 15px;">HH:MM</div>
                            </div>
                            <div style="flex: 1;margin-right:45px;">
                                <div style="color: #1d6fa5;">Logout</div>
                                <div style="font-size: 15px;">HH:MM</div>
                            </div>
                            <div style="flex: 1;">
                                <div style="color: #1d6fa5;">Total</div>
                                <div style="font-size: 15px;">HH:MM</div>
                            </div>
                        </div>
                    </div>

                    <!-- Log Entry Card #2 -->

                    <div class="p-3 mb-3" style="background: #ffffff; border-radius: 12px; font-family: 'Segoe UI', sans-serif;">
                        <div class="d-flex align-items-center justify-content-center gap-3" style="font-size: 17px; font-weight: 500; color: #4b5c74;">
                            <img src="{{ asset('build/img/groups/group-01.jpg') }}" alt="User" style="width: 40px; height: 40px; border-radius: 50%;">
                            <div style="flex: 1;margin-right:45px;">
                                <div style="color: #1d6fa5;">Login Date</div>
                                <div style="font-size: 15px;">DD.MM.YYYY</div>
                            </div>
                            <div style="flex: 1;margin-right:45px;">
                                <div style="color: #1d6fa5;">Login Time</div>
                                <div style="font-size: 15px;">HH:MM</div>
                            </div>
                            <div style="flex: 1;margin-right:45px;">
                                <div style="color: #1d6fa5;">Logout</div>
                                <div style="font-size: 15px;">HH:MM</div>
                            </div>
                            <div style="flex: 1;">
                                <div style="color: #1d6fa5;">Total</div>
                                <div style="font-size: 15px;">HH:MM</div>
                            </div>
                        </div>
                    </div>
                    <!-- Log Entry Card #3 -->
                    <div class="p-3 mb-3" style="background: #ffffff; border-radius: 12px; font-family: 'Segoe UI', sans-serif;">
                        <div class="d-flex align-items-center justify-content-center gap-3" style="font-size: 17px; font-weight: 500; color: #4b5c74;">
                            <img src="{{ asset('build/img/groups/group-01.jpg') }}" alt="User" style="width: 40px; height: 40px; border-radius: 50%;">
                            <div style="flex: 1;margin-right:45px;">
                                <div style="color: #1d6fa5;">Login Date</div>
                                <div style="font-size: 15px;">DD.MM.YYYY</div>
                            </div>
                            <div style="flex: 1;margin-right:45px;">
                                <div style="color: #1d6fa5;">Login Time</div>
                                <div style="font-size: 15px;">HH:MM</div>
                            </div>
                            <div style="flex: 1;margin-right:45px;">
                                <div style="color: #1d6fa5;">Logout</div>
                                <div style="font-size: 15px;">HH:MM</div>
                            </div>
                            <div style="flex: 1;">
                                <div style="color: #1d6fa5;">Total</div>
                                <div style="font-size: 15px;">HH:MM</div>
                            </div>
                        </div>
                    </div>
                    <!-- Log Entry Card #4 -->
                    <div class="p-3 mb-3" style="background: #ffffff; border-radius: 12px; font-family: 'Segoe UI', sans-serif;">
                        <div class="d-flex align-items-center justify-content-center gap-3" style="font-size: 17px; font-weight: 500; color: #4b5c74;">
                            <img src="{{ asset('build/img/groups/group-01.jpg') }}" alt="User" style="width: 40px; height: 40px; border-radius: 50%;">
                            <div style="flex: 1;margin-right:45px;">
                                <div style="color: #1d6fa5;">Login Date</div>
                                <div style="font-size: 15px;">DD.MM.YYYY</div>
                            </div>
                            <div style="flex: 1;margin-right:45px;">
                                <div style="color: #1d6fa5;">Login Time</div>
                                <div style="font-size: 15px;">HH:MM</div>
                            </div>
                            <div style="flex: 1;margin-right:45px;">
                                <div style="color: #1d6fa5;">Logout</div>
                                <div style="font-size: 15px;">HH:MM</div>
                            </div>
                            <div style="flex: 1;">
                                <div style="color: #1d6fa5;">Total</div>
                                <div style="font-size: 15px;">HH:MM</div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <!-- Right Panel: col-9 -->
            <div id="overviewContent" class="toggle-content col-md-8 col-sm-12" style="display:block;">

                <!-- Project Card Template (Hidden) -->
                <template id="projectCardTemplate" style="display: none;">
                    <div class="col-12 col-md-6">
                            <div class="card shadow-sm  p-2" style="border-radius: 20px; font-family:    'Segoe UI', sans-serif;">

                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <!-- Left: Circular Progress -->
                                    <div style="position: relative; width: 45px; height: 45px;">
                                        <svg viewBox="0 0 36 36" width="45" height="45">
                                            <path
                                                style="fill: none; stroke:#b7b7b7; stroke-width: 3.8;"
                                                d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                            <path
                                                style="fill: none; stroke: #f9a825; stroke-width: 3.8; stroke-linecap: round;"
                                                stroke-dasharray="70, 100"
                                                d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                        </svg>
                                        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 12px; font-weight: bold; color: #f9a825;">
                                            70%
                                        </div>
                                    </div>

                                    <!-- Center: Yekbon Logo -->
                                    <div class="mx-auto">
                                        <img src="{{URL::asset('/build/img/yekbon.svg')}}" class="rounded-circle" style="height: 55px;" alt="Project Logo">
                                    </div>

                                    <!-- Right: Empty space for balance (optional) -->
                                    <div style="width: 45px;"></div>
                                </div>



                                <div class="text-center" style="cursor: pointer;">
                                    <h6 style="cursor: pointer;"
                                        data-bs-toggle="offcanvas"
                                        data-bs-target="#offcanvasRight"
                                        aria-controls="offcanvasRight">
                                        Project Title
                                    </h6>
                                    <!-- Project ID styled exactly like screenshot -->
                                </div>


                                <!-- Progress Status -->
                                <div class="text-center mb-2 d-flex justify-content-center gap-2">
                                    <!-- Status with green dot and soft gray/green background -->
                                    <div style="background: #f1f3f4; border-radius: 12px; display: inline-flex; align-items: center; gap: 6px; padding: 4px 12px;">
                                        <span style="width: 10px; height: 10px; border-radius: 50%; background: #28c76f; display: inline-block;"></span>
                                        <span style="color: #4b5c74; font-weight: 500; font-size: 13px;">Low</span>
                                    </div>
                                    <!-- Red Flag with soft red background -->
                                    <div style="background: #fff3cd; border-radius: 12px; display: inline-flex; align-items: center; justify-content: center; padding: 4px 10px;">
                                        <img src="{{ asset('build/img/yelowflag.svg') }}" style="height: 16px; width: 16px;" alt="flag" />
                                    </div>
                                </div>

                                <div style="font-size: 12px;color: #6c757d;display: flex;justify-content: center;align-items: center;gap: 4px;flex-wrap: wrap;background: #f8f9fa;width: 100%;border-radius: 7px;padding: 6px 12px;text-align: center;">
                                    <div><strong>Ticket ID</strong> | <strong>Section</strong></div>
                                    <div><span style="color: #28c76f;">Start:</span> 22.10.2024</div>
                                    <div><span style="color: #28c76f;">Deliver:</span> 22.10.2024</div>
                                </div>

                                <!-- Section Progress Block -->
                                <div class="flex-grow-1  mt-1" style=" flex-wrap: wrap; background:#f8f9fa;border-radius:10px;">
                                    <!-- Stats -->
                                    <div class="d-flex justify-content-between text-center mb-2">
                                        <div style="flex: 1;">
                                            <div style="font-weight: 600; font-size: 15px; color: #1d6fa5;">Tickets</div>
                                            <div style="font-size: 12px; color: #649bc3;">#1 of #05</div>
                                        </div>
                                        <div style="flex: 1;">
                                            <div style="font-weight: 600; font-size: 15px; color: #1d6fa5;">Total Tasks</div>
                                            <div style="font-size: 13px; color: #649bc3;">#05</div>
                                        </div>
                                        <div style="flex: 1;">
                                            <div style="font-weight: 600; font-size: 15px; color: #1d6fa5;">Days Left</div>
                                            <div style="font-size: 13px; color: #649bc3;">#05</div>
                                        </div>
                                        <div style="flex: 1;">
                                            <div style="font-weight: 600; font-size: 15px; color: #1d6fa5;">Status</div>
                                            <div style="font-size: 13px; color: #649bc3;">75%</div>
                                        </div>
                                    </div>

                                    <!-- Blue Progress Bar -->
                                    <div class="progress w-100" style="height: 8px; background-color: #e9ecef; border-radius: 10px;">
                                        <div class="progress-bar" style="width: 75%; background-color: #4dc3ff; border-radius: 10px;"></div>
                                    </div>
                                </div>


                                <!-- Team & Tickets Info -->
                                <div class="mt-1 py-1" style="background: #f8f9fa; border-radius: 15px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
                                    <!-- Project Manager -->
                                    <div class="text-center" style="flex: 1; min-width: 100px;">
                                        <div style="color: #2b3e5f; font-weight: 600; font-size: 13px;">Project Manager</div>
                                        <img src="{{ asset('build/img/profileuser.svg') }}" alt="PM" class="rounded-circle border border-white shadow-sm"
                                            style="width: 32px; height: 32px; margin-top: 4px;">
                                    </div>

                                    <!-- Developers -->
                                    <div class="text-center" style="flex: 1; min-width: 100px;">
                                        <div style="color: #2b3e5f; font-weight: 600; font-size: 13px;">Developers</div>
                                        <div class="position-relative d-inline-block mt-1" style="height: 32px; width: 80px;">
                                            <img src="{{ asset('build/img/profileuser.svg') }}" class="rounded-circle border border-white shadow-sm"
                                                style="width: 32px; height: 32px; position: absolute; left: 0; z-index: 3;">
                                            <img src="{{ asset('build/img/profileuser.svg') }}" class="rounded-circle border border-white shadow-sm"
                                                style="width: 32px; height: 32px; position: absolute; left: 18px; z-index: 2;">
                                            <img src="{{ asset('build/img/profileuser.svg') }}" class="rounded-circle border border-white shadow-sm"
                                                style="width: 32px; height: 32px; position: absolute; left: 36px; z-index: 1;">
                                        </div>
                                    </div>

                                    <!-- Tickets & Tasks -->
                                    <div class="text-center" style="flex: 1; min-width: 100px;margin-top: -10px;">
                                        <div style="color: #2b3e5f; font-weight: 600; font-size: 13px;">Ticket & Tasks</div>
                                        <div style="font-size: 11px; color: #6c757d; margin-top: 10px;">5 Tickets - 10 Tasks</div>
                                    </div>
                                </div>

                                <!-- sections -->
                                <div class="flex-grow-1 mt-1 " style="background:#f8f9fa;border-radius:10px;">
                                    <!-- Section Labels -->
                                    <div class="d-flex justify-content-between flex-wrap mb-2" style="font-size: 13px; font-weight: 600; color: #2e3a59;" style="margin-left:10px;margin-right:10px;">
                                        <span style="margin-left:10px;margin-right:10px;">Section#1 75%</span>
                                        <span style="margin-left:10px;margin-right:10px;">Section#1 75%</span>
                                        <span style="margin-left:10px;margin-right:10px;">Section#1 75%</span>
                                        <span style="margin-left:10px;margin-right:10px;">Section#1 75%</span>
                                    </div>

                                    <!-- Section Progress Bars -->
                                    <div class="d-flex justify-content-between align-items-center gap-2" style="margin-left:10px;margin-right:10px;margin-bottom:10px;">
                                        <div class="progress" style="width: 24%; height: 10px; background-color: #d3f4dc; border-radius: 10px;">
                                            <div class="progress-bar" style="width: 75%; background-color: #28c76f; border-radius: 10px;"></div>
                                        </div>
                                        <div class="progress" style="width: 24%; height: 10px; background-color: #fef3d3; border-radius: 10px;">
                                            <div class="progress-bar" style="width: 75%; background-color: #ffc107; border-radius: 10px;"></div>
                                        </div>
                                        <div class="progress" style="width: 24%; height: 10px; background-color: #fdd7d7; border-radius: 10px;">
                                            <div class="progress-bar" style="width: 75%; background-color: #ea5455; border-radius: 10px;"></div>
                                        </div>

                                    </div>
                                </div>

                                <!-- Teams Section -->
                                <div class="mt-1 py-2" style="background: #f8f9fa; border-radius: 10px; padding: 8px;">
                                    <div style="color: #2b3e5f; font-weight: 600; font-size: 13px; margin-bottom: 8px; padding-left: 8px;">Teams</div>
                                    <div id="teamsContainer" class="d-flex flex-column gap-2" style="padding: 0 8px;">
                                        <!-- Teams will be dynamically inserted here -->
                                        <div class="text-center p-2" style="color: #6c757d; font-size: 12px;">No teams available</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>

                <!-- Our projects -->
                <div style="background-color: #f4f6f8;  border-radius: 12px;padding-left:3px;padding-right:3px;padding-bottom: 10px;" class="mb-2">
                    <div>
                        <h3 class="pb-1 ps-2" style="font-weight: 600;">Our Projects</h3>
                    </div>
                    <div id="userProjectsContainer" class="row g-1">
                        <div class="col-12 text-center p-4">
                            <div style="color: #6c757d;">Select a user to view their projects</div>
                        </div>
                    </div>
                </div>

                <!-- Total projects -->
                <div style="background-color: #f7f7f7; padding: 16px; border-radius: 12px; font-family: 'Segoe UI', sans-serif;">
                    <div class="d-flex flex-wrap justify-content-between align-items-start mb-3">

                        <!-- Left Icon -->
                        <img src="{{ asset('build/img/lato.svg') }}" alt="Icon" style="width: 50px; height: auto; margin-bottom:3px;">

                        <!-- Project Summary -->
                        <div id="projectSummaryContainer" style="background-color: white;border-radius:6px;padding:5px;">
                            <div id="totalProjectsTitle" style="font-size: 15px; font-weight: 600; color: #2e3a59;">Total Projects</div>
                            <div id="projectTagsContainer" class="d-flex gap-1 mt-1 flex-nowrap">
                                <div class="col-12 text-center p-2">
                                    <div style="color: #6c757d; font-size: 12px;">Select a user to view projects</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Task Status Cards -->
                    <div class="d-flex flex-wrap justify-content-start" style="background:#fff; border-radius: 10px; padding: 5px; padding-left: 1px;">
                        <!-- Card Template -->
                        <div style="flex: 1; min-width: 80px; border-right: 3px solid #e2e8f0; padding: 0 8px;">
                            <img src="{{ asset('build/img/newtask.svg') }}" style="width: 26px;" alt="">
                            <div style="font-size: 12px; color: #4b5c74; margin-top: 4px;">New Task</div>
                            <div id="newTaskCount" style="font-weight: 600; font-size: 13px;">0</div>
                        </div>

                        <div style="flex: 1; min-width: 80px;  border-right: 3px solid #e2e8f0; padding: 0 8px;">
                            <img src="{{ asset('build/img/totaltask.svg') }}" style="width: 26px;" alt="">
                            <div style="font-size: 12px; color: #4b5c74; margin-top: 4px;">Total Tasks</div>
                            <div id="totalTaskCount" style="font-weight: 600; font-size: 13px;">0</div>
                        </div>

                        <div style="flex: 1; min-width: 80px; border-right: 3px solid #e2e8f0; padding: 0 8px;">
                            <img src="{{ asset('build/img/progress.svg') }}" style="width: 26px;" alt="">
                            <div style="font-size: 12px; color: #4b5c74; margin-top: 4px;">Progress</div>
                            <div id="progressTaskCount" style="font-weight: 600; font-size: 13px;">0</div>
                        </div>

                        <div style="flex: 1; min-width: 80px; border-right: 3px solid #e2e8f0; padding: 0 8px;">
                            <img src="{{ asset('build/img/inhold.svg') }}" style="width: 26px;" alt="">
                            <div style="font-size: 12px; color: #4b5c74; margin-top: 4px;">In Hold</div>
                            <div id="inHoldTaskCount" style="font-weight: 600; font-size: 13px;">0</div>
                        </div>

                        <div style="flex: 1; min-width: 80px; border-right: 3px solid #e2e8f0; padding: 0 8px;">
                            <img src="{{ asset('build/img/incheck.svg') }}" style="width: 26px;" alt="">
                            <div style="font-size: 12px; color: #4b5c74; margin-top: 4px;">In Check</div>
                            <div id="inCheckTaskCount" style="font-weight: 600; font-size: 13px;">0</div>
                        </div>

                        <div style="flex: 1; min-width: 80px; border-right: 3px solid #e2e8f0; padding: 0 8px;">
                            <img src="{{ asset('build/img/delayed.svg') }}" style="width: 26px;" alt="">
                            <div style="font-size: 12px; color: #4b5c74; margin-top: 4px;">Delayed</div>
                            <div id="delayedTaskCount" style="font-weight: 600; font-size: 13px;">0</div>
                        </div>

                        <!-- Last item: No border-right -->
                        <div style="flex: 1; min-width: 80px; padding: 0 8px;">
                            <img src="{{ asset('build/img/rejected.svg') }}" style="width: 26px;" alt="">
                            <div style="font-size: 12px; color: #4b5c74; margin-top: 4px;">Rejected</div>
                            <div id="rejectedTaskCount" style="font-weight: 600; font-size: 13px;">0</div>
                        </div>
                    </div>

                </div>
                <!-- reminder -->
                <div class="mt-2 pt-2" style="background-color: #f7f7f7; padding: 16px; border-radius: 12px; font-family: 'Segoe UI', sans-serif; padding-bottom: 1px;">
                    <!-- Header: Reminder & Member Count -->
                    <div class="d-flex align-items-center" style="gap: 8px;">
                        <img src="{{ asset('build/img/bell.svg') }}" style="width: 30px;" alt="Reminder Icon">
                        <div>
                            <div style="font-weight: 600; font-size: 18px; color: #0f1b3d;">Reminder</div>
                            <div style="font-size: 13px; color: #4b5563;">{{$membersCount ?? 0}} Member</div>
                        </div>
                    </div>

                    <!-- Task Card -->
                    <div class="d-flex justify-content-between align-items-start flex-wrap" style="margin-bottom: 16px; background: #fff; padding: 10px; border-radius: 10px;">

                        <!-- Left: Task Title + Badges + Meta Info -->
                        <div style="background: #fff;">
                            <!-- Task Title & Badges -->
                            <div class="d-flex flex-wrap justify-content-between mb-1">
                                <!-- Task Title -->
                                <div style="font-weight: 600; font-size: 16px; color: #2e3a59;">
                                    Task Title
                                </div>

                                <!-- Badges -->
                                <div class="d-flex flex-wrap align-items-center gap-2" style="margin-left: 14px;">
                                    <!-- Red Badge -->
                                    <span style="display: inline-flex; align-items: center; border-radius: 8px; font-weight: 600; font-size: 12px;">
                                        <span style="background: #f4f4f4; padding: 6px 8px; display: flex; align-items: center;">
                                            <img src="{{ asset('build/img/tera.svg') }}" alt="Icon" width="14" height="14" />
                                        </span>
                                        <span style="background: #f44336; color: #fff; padding: 6px 10px; display: flex; align-items: center; gap: 4px;">
                                            <span style="font-weight: bold;">·</span> 01 <span style="font-weight: bold;">·</span>
                                        </span>
                                    </span>

                                    <!-- LOW Badge -->
                                    <span style="display: inline-flex; align-items: center; gap: 6px; background: #f3f4f6; color: #8F98A0; font-weight: 600; font-size: 12px; padding: 4px 10px; border-radius: 20px;">
                                        <span style="width: 10px; height: 10px; border-radius: 50%; background: #28c76f; display: inline-block;"></span>
                                        LOW
                                    </span>

                                    <!-- Yellow Flag -->
                                    <span style="display: inline-flex; align-items: center; background: #fff3cd; padding: 4px 8px; border-radius: 10px;">
                                        <img src="{{ asset('build/img/yelowflag.svg') }}" alt="Icon" width="14" height="14" />
                                    </span>
                                </div>
                            </div>

                            <!-- Meta Info: Ticket ID, Start, Deliver -->
                            <div class="mt-1" style="font-size: 10px; color: #6c757d; display: flex; gap: 8px; flex-wrap: wrap; background:#f8f9fa; border-radius:7px; padding: 3px 6px; width: fit-content;">
                                <div><strong>Ticket ID</strong> | <strong>Section</strong> |</div>
                                <div><span style="color: #28c76f;">Start:</span> 22.10.2024 |</div>
                                <div><span style="color: #28c76f;">Deliver:</span> 22.10.2024</div>
                            </div>
                        </div>

                        <!-- Right: Metrics -->
                        <div>
                            <div class="d-flex flex-wrap align-items-center gap-3 mt-md-0">
                                <div style="background: #f8f9fa; border-radius: 10px; padding: 8px 1px; flex-grow: 1; max-width: 100%;">
                                    <div style="display: flex; gap: 25px; align-items: center;">
                                        <div class="text-center">
                                            <div style="color: #1d6fa5; font-weight: 600; font-size: 14px;">Tickets</div>
                                            <div style="color: #649bc3; font-size: 12px;">#1 of #05</div>
                                        </div>
                                        <div class="text-center">
                                            <div style="color: #1d6fa5; font-weight: 600; font-size: 14px;">Total Tasks</div>
                                            <div style="color: #649bc3; font-size: 12px;">#05</div>
                                        </div>
                                        <div class="text-center">
                                            <div style="color: #1d6fa5; font-weight: 600; font-size: 14px;">Days Left</div>
                                            <div style="color: #649bc3; font-size: 12px;">#05</div>
                                        </div>
                                    </div>

                                    <!-- Progress Bar -->
                                    <div style="height: 8px; background: #e0e0e0; border-radius: 5px; margin-top: 10px;">
                                        <div style="width: 70%; height: 100%; background: #34c6f3; border-radius: 5px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


                <!-- Assigned Tickets -->
                <div class="mt-2 pt-2" style="background-color: #f7f7f7; padding: 16px; border-radius: 12px; font-family: 'Segoe UI', sans-serif;padding-bottom: 35px;">
                    <div class="d-flex align-items-center" style="gap: 8px; font-family: 'Segoe UI', sans-serif;">
                        <img src="{{ asset('build/img/inhold.svg') }}" style="width: 30px;" alt="Reminder Icon">
                        <div>
                            <div style="font-weight: 600; font-size: 18px; color: #0f1b3d;">Assigned Tickets</div>
                            <div style="font-size: 13px; color: #4b5563;">3 Tickets</div>
                        </div>
                    </div>
                    <!-- Ticket Title + Status and Metrics -->
                    <div class="d-flex justify-content-between align-items-start flex-wrap " style="margin-bottom: 16px;background:#fff;border-radius: 10px;">
                        <!-- Ticket Title & Status -->
                        <div style="background:#fff">
                            <!-- Ticket Title -->
                            <div class="d-flex justify-content-between  mb-3">
                                <!-- Ticket Title on the left -->
                                <div style="font-weight: 600; font-size: 16px; color: #2e3a59;">
                                    Ticket Title
                                </div>

                                <!-- Status badges on the right -->
                                <div class="d-flex align-items-center">
                                    <!-- Red Badge with Lightning Icon -->
                                    <span style="display: inline-flex; align-items: center; border-radius: 8px; overflow: hidden; font-weight: 600; font-size: 12px;">

                                        <!-- Left icon area -->
                                        <span style=" padding: 6px 8px; display: flex; align-items: center;">
                                            <img src="{{ asset('build/img/yekbon.svg') }}" alt="Icon" width="20" height="20" />
                                        </span>

                                        <!-- Red badge area -->
                                        <div style="background: #fddede; border-radius: 12px; display: inline-flex; align-items: center; justify-content: center; padding: 4px 10px;">
                                            <img src="{{URL::asset('/build/img/redflag.svg')}}" style="height: 16px; width: 16px;" alt="flag" />
                                        </div>

                                    </span>


                                    <!-- Low Badge with Green Dot -->
                                    <span style="display: inline-flex; align-items: center; gap: 6px; background: #f3f4f6; color: #8F98A0; font-weight: 600; font-size: 12px; padding: 4px 10px; border-radius: 20px;">
                                        <span style="width: 10px; height: 10px; border-radius: 50%; background: #28c76f; display: inline-block;"></span>
                                        LOW
                                    </span>

                                    <!-- Yellow Badge with Flag -->


                                    <!--  -->
                                    <span class="position-relative d-inline-block mt-1" style="height: 32px; width: 80px;">
                                        <img src="{{ asset('build/img/profileuser.svg') }}" class="rounded-circle border border-white shadow-sm"
                                            style="width: 32px; height: 32px; position: absolute; left: 0; z-index: 3;">
                                        <img src="{{ asset('build/img/profileuser.svg') }}" class="rounded-circle border border-white shadow-sm"
                                            style="width: 32px; height: 32px; position: absolute; left: 18px; z-index: 2;">

                                    </span>
                                </div>

                            </div>

                        </div>

                        <!-- Ticket Metrics Box -->
                        <div style="max-width: 450px;">
                            <div class="d-flex align-items-center gap-3 mt-md-0 flex-wrap">
                                <!-- Metrics Box -->
                                <div style="background: #f8f9fa; border-radius: 10px; padding: 10px 3px; flex-grow: 1; max-width: 100%;margin-bottom: 9px; margin-top: 4px; margin-right: 4px;">
                                    <div style="display: flex; gap: 25px; align-items: center;">
                                        <div class="text-center">
                                            <div style="color: #1d6fa5; font-weight: 600; font-size: 14px;">Tickets</div>
                                            <div style="color: #649bc3; font-size: 12px;">#1 of #05</div>
                                        </div>
                                        <div class="text-center">
                                            <div style="color: #1d6fa5; font-weight: 600; font-size: 14px;">Total Tasks</div>
                                            <div style="color: #649bc3; font-size: 12px;">#05</div>
                                        </div>
                                        <div class="text-center">
                                            <div style="color: #1d6fa5; font-weight: 600; font-size: 14px;">Days Left</div>
                                            <div style="color: #649bc3; font-size: 12px;">#05</div>
                                        </div>
                                    </div>

                                    <!-- Blue Progress Bar Underneath OUTSIDE the flex row -->
                                    <div style="height: 8px; background: #e0e0e0; border-radius: 5px; margin-top: 10px;">
                                        <div style="width: 70%; height: 100%; background: #34c6f3; border-radius: 5px;"></div>
                                    </div>

                                </div>


                                <!-- Circular Progress -->

                            </div>
                        </div>
                    </div>
                    <!-- Ticket meta info -->
                    <div style="font-size: 10px; color: #6c757d; display: flex; gap: 8px; flex-wrap: wrap;margin-top:-58px;margin-left:5px;background:#f8f9fa;width:323px;border-radius:7px;width:fit-content;padding-bottom:3px;padding-left:3px;padding-right:3px;padding-top:2px;">
                        <div><strong>Ticket ID</strong> | <strong>Section |</strong></div>
                        <div><span style="color: #28c76f;">Start:</span> 22.10.2024 |</div>
                        <div><span style="color: #28c76f;">Deliver:</span> 22.10.2024</div>

                    </div>
                    <div class="d-flex justify-content-center mt-3 mb-3" style="background-color: #fff;padding:3px;border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                        <div class="d-flex align-items-center gap-2 px-3 py-2 rounded" style="background-color: #fdf6ec; font-size: 12px; border-radius: 10px;margin-bottom:6px;">

                            <!-- Avatar and Username -->
                            <div class="d-flex align-items-center gap-2">
                                <img src="https://i.pravatar.cc/28" class="rounded-circle" width="28" height="28" alt="Avatar">
                                <span style="color: #000; font-weight: 500;">Username</span>
                            </div>

                            <!-- Start Date -->
                            <div style="color: #22c55e;">
                                <strong>Start:</strong> 22.10.2024
                            </div>

                            <!-- Deliver Date -->
                            <div style="color: #ef4444;">
                                <strong>Deliver:</strong> 22.10.2024
                            </div>

                            <!-- Reason -->
                            <div style="color: #ef4444;">
                                <strong>! We will get the reason here</strong>
                            </div>

                        </div>
                    </div>
                    <!-- 2 -->
                    <!-- Ticket Title + Status and Metrics -->
                    <div class="d-flex justify-content-between align-items-start flex-wrap " style="margin-bottom: 16px;background:#fff;border-radius: 10px;">
                        <!-- Ticket Title & Status -->
                        <div style="background:#fff">
                            <!-- Ticket Title -->
                            <div class="d-flex justify-content-between  mb-3">
                                <!-- Ticket Title on the left -->
                                <div style="font-weight: 600; font-size: 16px; color: #2e3a59;">
                                    Ticket Title
                                </div>

                                <!-- Status badges on the right -->
                                <div class="d-flex align-items-center">
                                    <!-- Red Badge with Lightning Icon -->
                                    <span style="display: inline-flex; align-items: center; border-radius: 8px; overflow: hidden; font-weight: 600; font-size: 12px;">

                                        <!-- Left icon area -->
                                        <span style=" padding: 6px 8px; display: flex; align-items: center;">
                                            <img src="{{ asset('build/img/yekbon.svg') }}" alt="Icon" width="20" height="20" />
                                        </span>

                                        <!-- Red badge area -->
                                        <div style="background: #fddede; border-radius: 12px; display: inline-flex; align-items: center; justify-content: center; padding: 4px 10px;">
                                            <img src="{{URL::asset('/build/img/redflag.svg')}}" style="height: 16px; width: 16px;" alt="flag" />
                                        </div>

                                    </span>


                                    <!-- Low Badge with Green Dot -->
                                    <span style="display: inline-flex; align-items: center; gap: 6px; background: #f3f4f6; color: #8F98A0; font-weight: 600; font-size: 12px; padding: 4px 10px; border-radius: 20px;">
                                        <span style="width: 10px; height: 10px; border-radius: 50%; background: #28c76f; display: inline-block;"></span>
                                        LOW
                                    </span>

                                    <!-- Yellow Badge with Flag -->


                                    <!--  -->
                                    <span class="position-relative d-inline-block mt-1" style="height: 32px; width: 80px;">
                                        <img src="{{ asset('build/img/profileuser.svg') }}" class="rounded-circle border border-white shadow-sm"
                                            style="width: 32px; height: 32px; position: absolute; left: 0; z-index: 3;">
                                        <img src="{{ asset('build/img/profileuser.svg') }}" class="rounded-circle border border-white shadow-sm"
                                            style="width: 32px; height: 32px; position: absolute; left: 18px; z-index: 2;">

                                    </span>
                                </div>

                            </div>

                        </div>

                        <!-- Ticket Metrics Box -->
                        <div style="max-width: 450px;">
                            <div class="d-flex align-items-center gap-3 mt-md-0 flex-wrap">
                                <!-- Metrics Box -->
                                <div style="background: #f8f9fa; border-radius: 10px; padding: 10px 3px; flex-grow: 1; max-width: 100%;margin-bottom: 9px; margin-top: 4px; margin-right: 4px;">
                                    <div style="display: flex; gap: 25px; align-items: center;">
                                        <div class="text-center">
                                            <div style="color: #1d6fa5; font-weight: 600; font-size: 14px;">Tickets</div>
                                            <div style="color: #649bc3; font-size: 12px;">#1 of #05</div>
                                        </div>
                                        <div class="text-center">
                                            <div style="color: #1d6fa5; font-weight: 600; font-size: 14px;">Total Tasks</div>
                                            <div style="color: #649bc3; font-size: 12px;">#05</div>
                                        </div>
                                        <div class="text-center">
                                            <div style="color: #1d6fa5; font-weight: 600; font-size: 14px;">Days Left</div>
                                            <div style="color: #649bc3; font-size: 12px;">#05</div>
                                        </div>
                                    </div>

                                    <!-- Blue Progress Bar Underneath OUTSIDE the flex row -->
                                    <div style="height: 8px; background: #e0e0e0; border-radius: 5px; margin-top: 10px;">
                                        <div style="width: 70%; height: 100%; background: #34c6f3; border-radius: 5px;"></div>
                                    </div>

                                </div>


                                <!-- Circular Progress -->

                            </div>
                        </div>
                    </div>
                    <!-- Ticket meta info -->
                    <div style="font-size: 10px; color: #6c757d; display: flex; gap: 8px; flex-wrap: wrap;margin-top:-58px;margin-left:5px;background:#f8f9fa;width:323px;border-radius:7px;width:fit-content;padding-bottom:3px;padding-left:3px;padding-right:3px;padding-top:2px;">
                        <div><strong>Ticket ID</strong> | <strong>Section |</strong></div>
                        <div><span style="color: #28c76f;">Start:</span> 22.10.2024 |</div>
                        <div><span style="color: #28c76f;">Deliver:</span> 22.10.2024</div>

                    </div>
                    <div class="d-flex justify-content-center mt-3 mb-3" style="background-color: #fff;padding:3px;border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                        <div class="d-flex align-items-center gap-2 px-3 py-2 rounded" style="background-color: #fdf6ec; font-size: 12px; border-radius: 10px;margin-bottom:6px;">

                            <!-- Avatar and Username -->
                            <div class="d-flex align-items-center gap-2">
                                <img src="https://i.pravatar.cc/28" class="rounded-circle" width="28" height="28" alt="Avatar">
                                <span style="color: #000; font-weight: 500;">Username</span>
                            </div>

                            <!-- Start Date -->
                            <div style="color: #22c55e;">
                                <strong>Start:</strong> 22.10.2024
                            </div>

                            <!-- Deliver Date -->
                            <div style="color: #ef4444;">
                                <strong>Deliver:</strong> 22.10.2024
                            </div>

                            <!-- Reason -->
                            <div style="color: #ef4444;">
                                <strong>! We will get the reason here</strong>
                            </div>

                        </div>
                    </div>
                </div>
                <!--new tasks -->
                <div class="mt-2 pt-2" style="background-color: #f7f7f7; padding: 16px; border-radius: 12px; font-family: 'Segoe UI', sans-serif;padding-bottom: 35px;">
                    <div class="d-flex align-items-center" style="gap: 8px; font-family: 'Segoe UI', sans-serif;">
                        <img src="{{ asset('build/img/newtask.svg') }}" style="width: 30px;" alt="Reminder Icon">
                        <div>
                            <div style="font-weight: 600; font-size: 18px; color: #0f1b3d;">New Tasks</div>
                            <div style="font-size: 13px; color: #4b5563;">{{$membersCount ?? 0}} Member</div>
                        </div>
                    </div>
                    <!-- Ticket Title + Status and Metrics -->
                    <div class="d-flex justify-content-between align-items-start flex-wrap " style="margin-bottom: 16px;background:#fff;padding: 10px;border-radius: 10px;">
                        <!-- Ticket Title & Status -->
                        <div style="background:#fff">
                            <!-- Ticket Title -->
                            <div class="d-flex justify-content-between  mb-3">
                                <!-- Ticket Title on the left -->
                                <div style="font-weight: 600; font-size: 16px; color: #2e3a59;">
                                    Task Title
                                </div>

                                <!-- Status badges on the right -->
                                <div class="d-flex align-items-center gap-2" style="margin-left: 14px;">
                                    <!-- Red Badge with Lightning Icon -->
                                    <span style="display: inline-flex; align-items: center; border-radius: 8px; overflow: hidden; font-weight: 600; font-size: 12px;">

                                        <!-- Left icon area -->
                                        <span style="background: #f4f4f4; padding: 6px 8px; display: flex; align-items: center;">
                                            <img src="{{ asset('build/img/tera.svg') }}" alt="Icon" width="14" height="14" />
                                        </span>

                                        <!-- Red badge area -->
                                        <span style="background: #f44336; color: #fff; padding: 6px 10px; display: flex; align-items: center; gap: 4px;">
                                            <span style="font-weight: bold;">·</span>
                                            01
                                            <span style="font-weight: bold;">·</span>
                                        </span>

                                    </span>


                                    <!-- Low Badge with Green Dot -->
                                    <span style="display: inline-flex; align-items: center; gap: 6px; background: #f3f4f6; color: #8F98A0; font-weight: 600; font-size: 12px; padding: 4px 10px; border-radius: 20px;">
                                        <span style="width: 10px; height: 10px; border-radius: 50%; background: #28c76f; display: inline-block;"></span>
                                        LOW
                                    </span>

                                    <!-- Yellow Badge with Flag -->
                                    <span style="display: inline-flex; align-items: center; background: #e1effe; padding: 4px 8px; border-radius: 10px;">

                                        <span>
                                            <img src="{{ asset('build/img/blueflag.svg') }}" alt="Icon" width="14" height="14" />
                                        </span>
                                    </span>
                                </div>

                            </div>

                        </div>

                        <!-- Ticket Metrics Box -->
                        <div style="max-width: 450px;">

                            <div class="d-flex align-items-center gap-3 mt-md-0 flex-wrap">
                                <!-- Metrics Box -->
                                <div style="background: #f8f9fa; border-radius: 10px; padding: 10px 7px; flex-grow: 1; max-width: 100%;">
                                    <div style="display: flex; gap: 25px; align-items: center;">
                                        <div class="text-center">
                                            <div style="color: #1d6fa5; font-weight: 600; font-size: 14px;">Tickets</div>
                                            <div style="color: #649bc3; font-size: 12px;">#1 of #05</div>
                                        </div>
                                        <div class="text-center">
                                            <div style="color: #1d6fa5; font-weight: 600; font-size: 14px;">Total Tasks</div>
                                            <div style="color: #649bc3; font-size: 12px;">#05</div>
                                        </div>
                                        <div class="text-center">
                                            <div style="color: #1d6fa5; font-weight: 600; font-size: 14px;">Days Left</div>
                                            <div style="color: #649bc3; font-size: 12px;">#05</div>
                                        </div>
                                    </div>

                                    <!-- Blue Progress Bar Underneath OUTSIDE the flex row -->
                                    <div style="height: 8px; background: #e0e0e0; border-radius: 5px; margin-top: 10px;">
                                        <div style="width: 70%; height: 100%; background: #34c6f3; border-radius: 5px;"></div>
                                    </div>
                                </div>


                                <!-- Circular Progress -->

                            </div>
                        </div>
                    </div>
                    <!-- Ticket meta info -->
                    <div style="font-size: 10px; color: #6c757d; display: flex; gap: 8px; flex-wrap: wrap;margin-top:-58px;margin-left:5px;background:#f8f9fa;width:323px;border-radius:7px;width:fit-content;padding-bottom:3px;padding-left:3px;padding-right:3px;padding-top:2px;">
                        <div><strong>Ticket ID</strong> | <strong>Section |</strong></div>
                        <div><span style="color: #28c76f;">Start:</span> 22.10.2024 |</div>
                        <div><span style="color: #28c76f;">Deliver:</span> 22.10.2024</div>
                    </div>

                </div>
                <!-- task in progress -->
                <div class="mt-2 pt-2" style="background-color: #f7f7f7; padding: 16px; border-radius: 12px; font-family: 'Segoe UI', sans-serif;padding-bottom: 35px;">
                    <div class="d-flex align-items-center" style="gap: 8px; font-family: 'Segoe UI', sans-serif;">
                        <img src="{{ asset('build/img/progress.svg') }}" style="width: 30px;" alt="Reminder Icon">
                        <div>
                            <div style="font-weight: 600; font-size: 18px; color: #0f1b3d;">Tasks in Progress</div>
                            <div style="font-size: 13px; color: #4b5563;">3 Tasks</div>
                        </div>
                    </div>
                    <!-- Ticket Title + Status and Metrics -->
                    <div class="d-flex justify-content-between align-items-start flex-wrap " style="margin-bottom: 16px;background:#fff;padding: 10px;border-radius: 10px;">
                        <!-- Ticket Title & Status -->
                        <div style="background:#fff">
                            <!-- Ticket Title -->
                            <div class="d-flex justify-content-between  mb-3">
                                <!-- Ticket Title on the left -->
                                <div style="font-weight: 600; font-size: 16px; color: #2e3a59;">
                                    Task Title
                                </div>

                                <!-- Status badges on the right -->
                                <div class="d-flex align-items-center gap-2" style="margin-left: 14px;">
                                    <!-- Red Badge with Lightning Icon -->
                                    <span style="display: inline-flex; align-items: center; border-radius: 8px; overflow: hidden; font-weight: 600; font-size: 12px;">

                                        <!-- Left icon area -->
                                        <span style="background: #f4f4f4; padding: 6px 8px; display: flex; align-items: center;">
                                            <img src="{{ asset('build/img/tera.svg') }}" alt="Icon" width="14" height="14" />
                                        </span>

                                        <!-- Red badge area -->
                                        <span style="background: #f44336; color: #fff; padding: 6px 10px; display: flex; align-items: center; gap: 4px;">
                                            <span style="font-weight: bold;">·</span>
                                            01
                                            <span style="font-weight: bold;">·</span>
                                        </span>

                                    </span>


                                    <!-- Low Badge with Green Dot -->
                                    <span style="display: inline-flex; align-items: center; gap: 6px; background: #f3f4f6; color: #8F98A0; font-weight: 600; font-size: 12px; padding: 4px 10px; border-radius: 20px;">
                                        <span style="width: 10px; height: 10px; border-radius: 50%; background: #28c76f; display: inline-block;"></span>
                                        LOW
                                    </span>

                                    <!-- Yellow Badge with Flag -->
                                    <span style="display: inline-flex; align-items: center; background: #ecfbdc; padding: 4px 8px; border-radius: 10px;">

                                        <span>
                                            <img src="{{ asset('build/img/greenflag.svg') }}" alt="Icon" width="14" height="14" />
                                        </span>
                                    </span>
                                </div>

                            </div>

                        </div>

                        <!-- Ticket Metrics Box -->
                        <div style="max-width: 450px;">

                            <div class="d-flex align-items-center gap-3 mt-md-0 flex-wrap">
                                <!-- Metrics Box -->
                                <div style="background: #f8f9fa; border-radius: 10px; padding: 10px 7px; flex-grow: 1; max-width: 100%;">
                                    <div style="display: flex; gap: 25px; align-items: center;">
                                        <div class="text-center">
                                            <div style="color: #1d6fa5; font-weight: 600; font-size: 14px;">Tickets</div>
                                            <div style="color: #649bc3; font-size: 12px;">#1 of #05</div>
                                        </div>
                                        <div class="text-center">
                                            <div style="color: #1d6fa5; font-weight: 600; font-size: 14px;">Total Tasks</div>
                                            <div style="color: #649bc3; font-size: 12px;">#05</div>
                                        </div>
                                        <div class="text-center">
                                            <div style="color: #1d6fa5; font-weight: 600; font-size: 14px;">Days Left</div>
                                            <div style="color: #649bc3; font-size: 12px;">#05</div>
                                        </div>
                                    </div>

                                    <!-- Blue Progress Bar Underneath OUTSIDE the flex row -->
                                    <div style="height: 8px; background: #e0e0e0; border-radius: 5px; margin-top: 10px;">
                                        <div style="width: 70%; height: 100%; background: #34c6f3; border-radius: 5px;"></div>
                                    </div>
                                </div>


                                <!-- Circular Progress -->

                            </div>
                        </div>
                    </div>
                    <!-- Ticket meta info -->
                    <div style="font-size: 10px; color: #6c757d; display: flex; gap: 8px; flex-wrap: wrap;margin-top:-58px;margin-left:5px;background:#f8f9fa;width:323px;border-radius:7px;width:fit-content;padding-bottom:3px;padding-left:3px;padding-right:3px;padding-top:2px;">
                        <div><strong>Ticket ID</strong> | <strong>Section |</strong></div>
                        <div><span style="color: #28c76f;">Start:</span> 22.10.2024 |</div>
                        <div><span style="color: #28c76f;">Deliver:</span> 22.10.2024</div>
                    </div>

                </div>
                <!-- task in hold -->
                <div class="mt-2 pt-2" style="background-color: #f7f7f7; padding: 16px; border-radius: 12px; font-family: 'Segoe UI', sans-serif;padding-bottom: 35px;">
                    <div class="d-flex align-items-center" style="gap: 8px; font-family: 'Segoe UI', sans-serif;">
                        <img src="{{ asset('build/img/inhold.svg') }}" style="width: 30px;" alt="Reminder Icon">
                        <div>
                            <div style="font-weight: 600; font-size: 18px; color: #0f1b3d;">Task in Hold</div>
                            <div style="font-size: 13px; color: #4b5563;">{{$membersCount ?? 0}} Member</div>
                        </div>
                    </div>
                    <!-- Ticket Title + Status and Metrics -->
                    <div class="d-flex justify-content-between align-items-start flex-wrap " style="margin-bottom: 16px;background:#fff;padding: 10px;border-radius: 10px;">
                        <!-- Ticket Title & Status -->
                        <div style="background:#fff">
                            <!-- Ticket Title -->
                            <div class="d-flex justify-content-between  mb-3">
                                <!-- Ticket Title on the left -->
                                <div style="font-weight: 600; font-size: 16px; color: #2e3a59;">
                                    Task Title
                                </div>

                                <!-- Status badges on the right -->
                                <div class="d-flex align-items-center gap-2" style="margin-left: 14px;">
                                    <!-- Red Badge with Lightning Icon -->
                                    <span style="display: inline-flex; align-items: center; border-radius: 8px; overflow: hidden; font-weight: 600; font-size: 12px;">

                                        <!-- Left icon area -->
                                        <span style="background: #f4f4f4; padding: 6px 8px; display: flex; align-items: center;">
                                            <img src="{{ asset('build/img/tera.svg') }}" alt="Icon" width="14" height="14" />
                                        </span>

                                        <!-- Red badge area -->
                                        <span style="background: #f44336; color: #fff; padding: 6px 10px; display: flex; align-items: center; gap: 4px;">
                                            <span style="font-weight: bold;">·</span>
                                            01
                                            <span style="font-weight: bold;">·</span>
                                        </span>

                                    </span>


                                    <!-- Low Badge with Green Dot -->
                                    <span style="display: inline-flex; align-items: center; gap: 6px; background: #f3f4f6; color: #8F98A0; font-weight: 600; font-size: 12px; padding: 4px 10px; border-radius: 20px;">
                                        <span style="width: 10px; height: 10px; border-radius: 50%; background: #28c76f; display: inline-block;"></span>
                                        LOW
                                    </span>

                                    <!-- Yellow Badge with Flag -->
                                    <span style="display: inline-flex; align-items: center; background: #e1effe; padding: 4px 8px; border-radius: 10px;">

                                        <span>
                                            <img src="{{ asset('build/img/blueflag.svg') }}" alt="Icon" width="14" height="14" />
                                        </span>
                                    </span>
                                </div>

                            </div>

                        </div>

                        <!-- Ticket Metrics Box -->
                        <div style="max-width: 450px;">
                            <div class="d-flex align-items-center gap-3 mt-md-0 flex-wrap">
                                <!-- Metrics Box -->
                                <div style="background: #f8f9fa; border-radius: 10px; padding: 10px 7px; flex-grow: 1; max-width: 100%;">
                                    <div style="display: flex; gap: 25px; align-items: center;">
                                        <div class="text-center">
                                            <div style="color: #1d6fa5; font-weight: 600; font-size: 14px;">Tickets</div>
                                            <div style="color: #649bc3; font-size: 12px;">#1 of #05</div>
                                        </div>
                                        <div class="text-center">
                                            <div style="color: #1d6fa5; font-weight: 600; font-size: 14px;">Total Tasks</div>
                                            <div style="color: #649bc3; font-size: 12px;">#05</div>
                                        </div>
                                        <div class="text-center">
                                            <div style="color: #1d6fa5; font-weight: 600; font-size: 14px;">Days Left</div>
                                            <div style="color: #649bc3; font-size: 12px;">#05</div>
                                        </div>
                                    </div>

                                    <!-- Blue Progress Bar Underneath OUTSIDE the flex row -->
                                    <div style="height: 8px; background: #e0e0e0; border-radius: 5px; margin-top: 10px;">
                                        <div style="width: 70%; height: 100%; background: #34c6f3; border-radius: 5px;"></div>
                                    </div>

                                </div>


                                <!-- Circular Progress -->

                            </div>
                        </div>
                    </div>
                    <!-- Ticket meta info -->
                    <div style="font-size: 10px; color: #6c757d; display: flex; gap: 8px; flex-wrap: wrap;margin-top:-58px;margin-left:5px;background:#f8f9fa;width:323px;border-radius:7px;width:fit-content;padding-bottom:3px;padding-left:3px;padding-right:3px;padding-top:2px;">
                        <div><strong>Ticket ID</strong> | <strong>Section |</strong></div>
                        <div><span style="color: #28c76f;">Start:</span> 22.10.2024 |</div>
                        <div><span style="color: #28c76f;">Deliver:</span> 22.10.2024</div>

                    </div>


                    <div class="d-flex justify-content-center mt-3" style="background-color: #fff;padding:3px;border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                        <div class="d-flex align-items-center gap-2 px-3 py-2 rounded" style="background-color: #fdf6ec; font-size: 12px; border-radius: 10px;margin-bottom:6px;">

                            <!-- Avatar and Username -->
                            <div class="d-flex align-items-center gap-2">
                                <img src="https://i.pravatar.cc/28" class="rounded-circle" width="28" height="28" alt="Avatar">
                                <span style="color: #000; font-weight: 500;">Username</span>
                            </div>

                            <!-- Start Date -->
                            <div style="color: #22c55e;">
                                <strong>Start:</strong> 22.10.2024
                            </div>

                            <!-- Deliver Date -->
                            <div style="color: #ef4444;">
                                <strong>Deliver:</strong> 22.10.2024
                            </div>

                            <!-- Reason -->
                            <div style="color: #ef4444;">
                                <strong>! We will get the reason here</strong>
                            </div>

                        </div>
                    </div>

                </div>
                <!-- task in check -->
                <div class="mt-2 pt-2" style="background-color: #f7f7f7; padding: 16px; border-radius: 12px; font-family: 'Segoe UI', sans-serif;padding-bottom: 35px;">
                    <div class="d-flex align-items-center" style="gap: 8px; font-family: 'Segoe UI', sans-serif;">
                        <img src="{{ asset('build/img/incheck.svg') }}" style="width: 30px;" alt="Reminder Icon">
                        <div>
                            <div style="font-weight: 600; font-size: 18px; color: #0f1b3d;">Tasks in Check</div>
                            <div style="font-size: 13px; color: #4b5563;">3 Tasks</div>
                        </div>
                    </div>
                    <!-- Ticket Title + Status and Metrics -->
                    <div class="d-flex justify-content-between align-items-start flex-wrap " style="margin-bottom: 16px;background:#fff;padding: 10px;border-radius: 10px;">
                        <!-- Ticket Title & Status -->
                        <div style="background:#fff">
                            <!-- Ticket Title -->
                            <div class="d-flex justify-content-between  mb-3">
                                <!-- Ticket Title on the left -->
                                <div style="font-weight: 600; font-size: 16px; color: #2e3a59;">
                                    Task Title
                                </div>

                                <!-- Status badges on the right -->
                                <div class="d-flex align-items-center gap-2" style="margin-left: 14px;">
                                    <!-- Red Badge with Lightning Icon -->
                                    <span style="display: inline-flex; align-items: center; border-radius: 8px; overflow: hidden; font-weight: 600; font-size: 12px;">

                                        <!-- Left icon area -->
                                        <span style="background: #f4f4f4; padding: 6px 8px; display: flex; align-items: center;">
                                            <img src="{{ asset('build/img/tera.svg') }}" alt="Icon" width="14" height="14" />
                                        </span>

                                        <!-- Red badge area -->
                                        <span style="background: #f44336; color: #fff; padding: 6px 10px; display: flex; align-items: center; gap: 4px;">
                                            <span style="font-weight: bold;">·</span>
                                            01
                                            <span style="font-weight: bold;">·</span>
                                        </span>

                                    </span>


                                    <!-- Low Badge with Green Dot -->
                                    <span style="display: inline-flex; align-items: center; gap: 6px; background: #f3f4f6; color: #8F98A0; font-weight: 600; font-size: 12px; padding: 4px 10px; border-radius: 20px;">
                                        <span style="width: 10px; height: 10px; border-radius: 50%; background: #28c76f; display: inline-block;"></span>
                                        LOW
                                    </span>

                                    <!-- Yellow Badge with Flag -->
                                    <span style="display: inline-flex; align-items: center; background: #ecfbdc; padding: 4px 8px; border-radius: 10px;">

                                        <span>
                                            <img src="{{ asset('build/img/greenflag.svg') }}" alt="Icon" width="14" height="14" />
                                        </span>
                                    </span>
                                </div>

                            </div>

                        </div>

                        <!-- Ticket Metrics Box -->
                        <div style="max-width: 450px;">

                            <div class="d-flex align-items-center gap-3 mt-md-0 flex-wrap">
                                <!-- Metrics Box -->
                                <div style="background: #f8f9fa; border-radius: 10px; padding: 10px 7px; flex-grow: 1; max-width: 100%;">
                                    <div style="display: flex; gap: 25px; align-items: center;">
                                        <div class="text-center">
                                            <div style="color: #1d6fa5; font-weight: 600; font-size: 14px;">Tickets</div>
                                            <div style="color: #649bc3; font-size: 12px;">#1 of #05</div>
                                        </div>
                                        <div class="text-center">
                                            <div style="color: #1d6fa5; font-weight: 600; font-size: 14px;">Total Tasks</div>
                                            <div style="color: #649bc3; font-size: 12px;">#05</div>
                                        </div>
                                        <div class="text-center">
                                            <div style="color: #1d6fa5; font-weight: 600; font-size: 14px;">Days Left</div>
                                            <div style="color: #649bc3; font-size: 12px;">#05</div>
                                        </div>
                                    </div>

                                    <!-- Blue Progress Bar Underneath OUTSIDE the flex row -->
                                    <div style="height: 8px; background: #e0e0e0; border-radius: 5px; margin-top: 10px;">
                                        <div style="width: 70%; height: 100%; background: #34c6f3; border-radius: 5px;"></div>
                                    </div>
                                </div>


                                <!-- Circular Progress -->

                            </div>
                        </div>
                    </div>
                    <!-- Ticket meta info -->
                    <div style="font-size: 10px; color: #6c757d; display: flex; gap: 8px; flex-wrap: wrap;margin-top:-58px;margin-left:5px;background:#f8f9fa;width:323px;border-radius:7px;width:fit-content;padding-bottom:3px;padding-left:3px;padding-right:3px;padding-top:2px;">
                        <div><strong>Ticket ID</strong> | <strong>Section |</strong></div>
                        <div><span style="color: #28c76f;">Start:</span> 22.10.2024 |</div>
                        <div><span style="color: #28c76f;">Deliver:</span> 22.10.2024</div>
                    </div>

                </div>
                <!-- Rejected -->
                <div class="mt-2 pt-2" style="background-color: #f7f7f7; padding: 16px; border-radius: 12px; font-family: 'Segoe UI', sans-serif;padding-bottom: 35px;">
                    <div class="d-flex align-items-center" style="gap: 8px; font-family: 'Segoe UI', sans-serif;">
                        <img src="{{ asset('build/img/inhold.svg') }}" style="width: 30px;" alt="Reminder Icon">
                        <div>
                            <div style="font-weight: 600; font-size: 18px; color: #0f1b3d;">Rejected Task</div>
                            <div style="font-size: 13px; color: #4b5563;">3 Task</div>
                        </div>
                    </div>
                    <!-- Ticket Title + Status and Metrics -->
                    <div class="d-flex justify-content-between align-items-start flex-wrap " style="margin-bottom: 16px;background:#fff;padding: 10px;border-radius: 10px;">
                        <!-- Ticket Title & Status -->
                        <div style="background:#fff">
                            <!-- Ticket Title -->
                            <div class="d-flex justify-content-between  mb-3">
                                <!-- Ticket Title on the left -->
                                <div style="font-weight: 600; font-size: 16px; color: #2e3a59;">
                                    Task Title
                                </div>

                                <!-- Status badges on the right -->
                                <div class="d-flex align-items-center gap-2" style="margin-left: 14px;">
                                    <!-- Red Badge with Lightning Icon -->
                                    <span style="display: inline-flex; align-items: center; border-radius: 8px; overflow: hidden; font-weight: 600; font-size: 12px;">

                                        <!-- Left icon area -->
                                        <span style="background: #f4f4f4; padding: 6px 8px; display: flex; align-items: center;">
                                            <img src="{{ asset('build/img/tera.svg') }}" alt="Icon" width="14" height="14" />
                                        </span>

                                        <!-- Red badge area -->
                                        <span style="background: #f44336; color: #fff; padding: 6px 10px; display: flex; align-items: center; gap: 4px;">
                                            <span style="font-weight: bold;">·</span>
                                            01
                                            <span style="font-weight: bold;">·</span>
                                        </span>

                                    </span>


                                    <!-- Low Badge with Green Dot -->
                                    <span style="display: inline-flex; align-items: center; gap: 6px; background: #f3f4f6; color: #8F98A0; font-weight: 600; font-size: 12px; padding: 4px 10px; border-radius: 20px;">
                                        <span style="width: 10px; height: 10px; border-radius: 50%; background: #28c76f; display: inline-block;"></span>
                                        LOW
                                    </span>

                                    <!-- Yellow Badge with Flag -->
                                    <span style="display: inline-flex; align-items: center; background: #e1effe; padding: 4px 8px; border-radius: 10px;">

                                        <span>
                                            <img src="{{ asset('build/img/blueflag.svg') }}" alt="Icon" width="14" height="14" />
                                        </span>
                                    </span>
                                </div>

                            </div>

                        </div>

                        <!-- Ticket Metrics Box -->
                        <div style="max-width: 450px;">
                            <div class="d-flex align-items-center gap-3 mt-md-0 flex-wrap">
                                <!-- Metrics Box -->
                                <div style="background: #f8f9fa; border-radius: 10px; padding: 10px 7px; flex-grow: 1; max-width: 100%;">
                                    <div style="display: flex; gap: 25px; align-items: center;">
                                        <div class="text-center">
                                            <div style="color: #1d6fa5; font-weight: 600; font-size: 14px;">Tickets</div>
                                            <div style="color: #649bc3; font-size: 12px;">#1 of #05</div>
                                        </div>
                                        <div class="text-center">
                                            <div style="color: #1d6fa5; font-weight: 600; font-size: 14px;">Total Tasks</div>
                                            <div style="color: #649bc3; font-size: 12px;">#05</div>
                                        </div>
                                        <div class="text-center">
                                            <div style="color: #1d6fa5; font-weight: 600; font-size: 14px;">Days Left</div>
                                            <div style="color: #649bc3; font-size: 12px;">#05</div>
                                        </div>
                                    </div>

                                    <!-- Blue Progress Bar Underneath OUTSIDE the flex row -->
                                    <div style="height: 8px; background: #e0e0e0; border-radius: 5px; margin-top: 10px;">
                                        <div style="width: 70%; height: 100%; background: #34c6f3; border-radius: 5px;"></div>
                                    </div>

                                </div>


                                <!-- Circular Progress -->

                            </div>
                        </div>
                    </div>
                    <!-- Ticket meta info -->
                    <div style="font-size: 10px; color: #6c757d; display: flex; gap: 8px; flex-wrap: wrap;margin-top:-58px;margin-left:5px;background:#f8f9fa;width:323px;border-radius:7px;width:fit-content;padding-bottom:3px;padding-left:3px;padding-right:3px;padding-top:2px;">
                        <div><strong>Ticket ID</strong> | <strong>Section |</strong></div>
                        <div><span style="color: #28c76f;">Start:</span> 22.10.2024 |</div>
                        <div><span style="color: #28c76f;">Deliver:</span> 22.10.2024</div>

                    </div>


                    <div class="d-flex justify-content-center mt-3" style="background-color: #fff;padding:3px;border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                        <div class="d-flex align-items-center gap-2 px-3 py-2 rounded" style="background-color: #fdf6ec; font-size: 12px; border-radius: 10px;margin-bottom:6px;">

                            <!-- Avatar and Username -->
                            <div class="d-flex align-items-center gap-2">
                                <img src="https://i.pravatar.cc/28" class="rounded-circle" width="28" height="28" alt="Avatar">
                                <span style="color: #000; font-weight: 500;">Username</span>
                            </div>

                            <!-- Start Date -->
                            <div style="color: #22c55e;">
                                <strong>Start:</strong> 22.10.2024
                            </div>

                            <!-- Deliver Date -->
                            <div style="color: #ef4444;">
                                <strong>Deliver:</strong> 22.10.2024
                            </div>

                            <!-- Reason -->
                            <div style="color: #ef4444;">
                                <strong>! We will get the reason here</strong>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Statistics Content -->

    </div>
    
    <!-- Statistics Content -->

</div>
</div>
<!-- add user -->
<div class="modal fade" id="add_user" tabindex="-1" style="visibility: visible;">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius: 16px; background-color: #ffffff; padding: 24px;">
            <!-- Header -->
            <div style="margin-bottom: 16px; position: relative;">
                <h5 id="userModalTitle"
                    style="font-weight: 700; font-size: 18px; color: #2a2b4c; margin: 0;">
                    Add new Member
                </h5>
                <p id="userModalSubtitle" style="font-size: 13px; color: #7c7e9b; margin: 0;">
                    Add new User to Team
                </p>
                <!-- Bootstrap close button -->
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                    style="position: absolute; top: 0; right: 0; font-size: 22px; color: #999;"></button>
            </div>
<form id="userCreateForm" method="post" action="{{ route('user.store') }}" enctype="multipart/form-data" >
    @csrf
    <input type="hidden" name="_method" id="userFormMethod" value="post">
    <input type="hidden" id="editingUserId" value="">
            <!-- Upload Banner -->
            <div id="sectionBanner">
            <div
                onclick="document.getElementById('bannerInput').click();"
                style="background-color: #f6f6f9; border-radius: 12px; height: 120px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px; cursor: pointer; position: relative; overflow: hidden;">
                <img
                    id="bannerPreview"
                    src=""
                    alt="Banner Preview"
                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; border-radius: 12px; display: none;" />

                <div
                    id="bannerPlaceholder"
                    style="text-align: center; color: #9ca3af; z-index: 1;">
                    <div style="font-size: 28px; font-weight: 400;">+</div>
                    <div style="font-size: 14px; font-weight: 500;">Upload banner</div>
                    <div style="font-size: 12px;">JPG or PNG</div>
                </div>

                <input name="banner"
                    type="file"
                    id="bannerInput"
                    accept=".png, .jpg" required="required"
                    style="display: none;"
                    onchange="(function(event) { const input = event.target; const file = input.files && input.files[0]; const preview = document.getElementById('bannerPreview'); const placeholder = document.getElementById('bannerPlaceholder'); const errorEl = document.getElementById('bannerError'); if (!file) { return; } const ext = (file.name.split('.').pop() || '').toLowerCase(); const allowedExt = ['jpg','png']; const allowedMime = ['image/jpeg','image/png']; if (allowedExt.indexOf(ext) === -1 || allowedMime.indexOf(file.type) === -1) { if (errorEl) { errorEl.textContent = 'Only .jpg or .png files are allowed.'; errorEl.style.display = 'block'; } preview.style.display = 'none'; preview.src = ''; if (placeholder) placeholder.style.display = 'block'; input.value = ''; return; } if (errorEl) { errorEl.textContent = ''; errorEl.style.display = 'none'; } const reader = new FileReader(); reader.onload = function(e) { preview.src = e.target.result; preview.style.display = 'block'; if (placeholder) placeholder.style.display = 'none'; }; reader.readAsDataURL(file); })(event)" />
            </div>
            <div id="bannerError" style="color: #ef4444; font-size: 12px; margin-top: 6px; display: none;"></div>
            </div>
            <!-- User Info Section -->
            <div id="sectionUserInfo">
            <div
                style="background-color: #f9f9fb; border-radius: 12px; padding: 16px; display: flex; gap: 16px; flex-wrap: wrap; position: relative;">
                <!-- User Type (Top-right) -->
                <select name="type" id="typeSelect" required="required"
                    style="position: absolute; top: 16px; right: 16px; border: 1px solid #e5e7eb; border-radius: 8px; padding: 6px 12px; font-size: 13px; color: #333; width: 120px; background-color: white;">
                    <option value="" disabled selected>User type</option>
                   
                    <option value="subadmin">Subadmin</option>
                    <option value="employee">Employee</option>
                    <option value="developer">Developer</option>
                </select>


                <!-- User Image Upload -->
                <div
                    onclick="document.getElementById('userImgInput').click();"
                    style="flex: 0 0 100px; height: 100px; background-color: #f9fafb; border: 2px dashed #e5e7eb; border-radius: 12px; display: flex; align-items: center; justify-content: center; cursor: pointer; position: relative;">
                    <img
                        id="userImgPreview"
                        src=""
                        alt="Preview"
                        style="width: 100%; height: 100%; object-fit: cover; border-radius: 10px; display: none;" />
                    <div
                        id="userImgPlaceholder"
                        style="text-align: center; color: #9ca3af; font-size: 24px;">
                        +
                    </div>
                    <input name="image"
                        type="file"
                        id="userImgInput"
                        accept=".png, .jpg" required="required"
                        style="display: none;"
                        onchange="(function(event){ const input = event.target; const preview = document.getElementById('userImgPreview'); const placeholder = document.getElementById('userImgPlaceholder'); const errorEl = document.getElementById('userImgError'); if (input.files && input.files[0]) { const file = input.files[0]; const ext = (file.name.split('.').pop() || '').toLowerCase(); const allowedExt = ['jpg','png']; const allowedMime = ['image/jpeg','image/png']; if (allowedExt.indexOf(ext) === -1 || allowedMime.indexOf(file.type) === -1) { if (errorEl) { errorEl.textContent = 'Only .jpg or .png files are allowed.'; errorEl.style.display = 'block'; } preview.style.display = 'none'; preview.src = ''; if (placeholder) placeholder.style.display = 'block'; input.value=''; return; } if (errorEl) { errorEl.textContent = ''; errorEl.style.display = 'none'; } const reader = new FileReader(); reader.onload = function (e) { preview.src = e.target.result;  preview.style.display = 'block';  if (placeholder) placeholder.style.display = 'none'; }; reader.readAsDataURL(file); } })(event)" />
                </div>
                <div id="userImgError" style="color: #ef4444; font-size: 12px; margin-top: 6px; display: none;"></div>

                <!-- Info Fields -->
                <div style="flex: 1;margin-top: 10px;">
                    <div
                        style="font-weight: 600; font-size: 15px; color: #2a2b4c;">
                        User Info
                    </div>
                    <div
                        style="font-size: 12px; color: #9ca3af; margin-bottom: 8px;">
                        Add the User info here
                    </div>

                    <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                        <select name="gender" id="genderSelect" required="required"
                            style="flex: 1; border: 1px solid #e5e7eb; border-radius: 8px; padding: 6px 12px; font-size: 13px; color: #333; background-color: white;">
                            <option value="" disabled selected>Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            
                        </select>
                        <input type="text" placeholder="Username and Lastname" required name="name" id="nameInput"
                            style="flex: 2; border: 1px solid #e5e7eb; border-radius: 8px; padding: 6px 12px; font-size: 13px; color: #333; background-color: white;" />
                        <input type="text" placeholder="User Title (e.g., Senior Developer)" name="title" id="titleInput"
                            style="flex: 2; border: 1px solid #e5e7eb; border-radius: 8px; padding: 6px 12px; font-size: 13px; color: #333; background-color: white;" />
                        <input
                            type="text" name="user_description" id="descriptionInput" required="required"
                            placeholder="Describe User"
                            style="flex: 2; border: 1px solid #e5e7eb; border-radius: 8px; padding: 6px 12px; font-size: 13px; color: #333; background-color: white;" />

                    </div>
                </div>


            </div>
            </div>
            <!-- Email Section -->
            <div id="sectionEmail" class="mt-3" style="background-color: #f9f9fb; border-radius: 12px; padding: 16px; margin-bottom: 16px">
                <!-- Title -->
                <div style="display:flex; align-items:center; justify-content:space-between; font-weight: 600; font-size: 15px; color: #2a2b4c;">User E-Mail
                    <button type="button" id="editEmailBtn" style="background: transparent; border: none; color: #2563eb; font-weight: 600; font-size: 12px; display: none;">Edit</button>
                </div>
                <div style="font-size: 12px; color: #9ca3af; margin-bottom: 12px;">Type the User Mail here</div>

                <!-- Input Row -->
                <div id="emailFieldsRow" style="display: flex; gap: 12px; flex-wrap: wrap;">

                    <!-- Email Input -->
                    <div style="flex: 1; display: flex; align-items: center; background-color: white; border: 1px solid #e5e7eb; border-radius: 8px; padding: 6px 12px;">
                        <span style="color: #9ca3af; margin-right: 8px;">
                            <img src="{{URL::asset('/build/img/Letter.svg')}}" alt="" style="width: 20px;">
                        </span>
                        <input id="emailInput" name="email" required="required" type="email" placeholder="Type User mail here" style="border: none; outline: none; font-size: 13px; color: #333; flex: 1; background: transparent;" />
                    </div>

                    <!-- Confirm Email Input -->
                    <div id="confirmEmailWrapper" style="flex: 1; display: flex; align-items: center; background-color: white; border: 1px solid #e5e7eb; border-radius: 8px; padding: 6px 12px;">
                        <span style="color: #9ca3af; margin-right: 8px;">
                            <img src="{{URL::asset('/build/img/Letter.svg')}}" alt="" style="width: 20px;">
                        </span>
                        <input id="confirmEmailInput" type="email" name="confirm_email" required="required" placeholder="Repeat User mail here" style="border: none; outline: none; font-size: 13px; color: #333; flex: 1; background: transparent;" />
                    </div>

                </div>
            </div>
            <!-- Password Section -->
            <div id="sectionPassword" class="mt-2" style="background-color: #f9f9fb; border-radius: 12px; padding: 16px; margin-bottom: 16px;">
                <!-- Header -->
                <div style="display:flex; align-items:center; justify-content:space-between; font-weight: 600; font-size: 15px; color: #2a2b4c;">User Password
                    <button type="button" id="editPasswordBtn" style="background: transparent; border: none; color: #2563eb; font-weight: 600; font-size: 12px; display: none;">Edit</button>
                </div>
                <div style="font-size: 12px; color: #9ca3af; margin-bottom: 12px;">Set a Password for the User</div>

                <!-- Input Fields Row -->
                <div id="passwordFieldsRow" style="display: flex; gap: 12px; flex-wrap: wrap;">
                    <!-- Password Field -->
                    <div style="flex: 1 1 250px; display: flex; align-items: center; background-color: white; border: 1px solid #e5e7eb; border-radius: 8px; padding: 6px 12px; min-width: 240px;">
                        <img src="{{URL::asset('/build/img/password.svg')}}" alt="" style="width: 20px; margin-right: 8px;">
                        <input name="passw" required="required" type="password" placeholder="Type User Password (leave blank to keep)" id="password1" style="border: none; outline: none; font-size: 13px; color: #333; flex: 1; background: transparent;">
                        <img src="{{URL::asset('/build/img/eye.svg')}}" alt="" style="width: 20px; cursor: pointer;" onclick="togglePassword('password1')">
                    </div>

                    <!-- Confirm Password Field -->
                    <div style="flex: 1 1 250px; display: flex; align-items: center; background-color: white; border: 1px solid #e5e7eb; border-radius: 8px; padding: 6px 12px; min-width: 240px;">
                        <img src="{{URL::asset('/build/img/password.svg')}}" alt="" style="width: 20px; margin-right: 8px;">
                        <input name="rpassw" required="required" type="password" placeholder="Repeat User Password (leave blank to keep)" id="password2" style="border: none; outline: none; font-size: 13px; color: #333; flex: 1; background: transparent;">
                        <img src="{{URL::asset('/build/img/eye.svg')}}" alt="" style="width: 20px; cursor: pointer;" onclick="togglePassword('password2')">
                    </div>
                </div>

            </div>
            <div id="sectionPermissions">
            <div style="background-color: #f9f9fb; border-radius: 12px; padding: 16px; margin-bottom: 10px; font-family: sans-serif;">
                <!-- Section Title -->
                <div style="font-weight: 600; font-size: 14px; color: #2a2b4c; margin-bottom: 12px;">User Permission</div>

                <!-- Permission Toggles -->
                
                <!-- chat -->
                <div class="mb-2" style="display: flex; justify-content: space-between;background:#fff;border-radius:10px;padding:10px; align-items: center; flex-wrap: wrap;">

                    <!-- Left: Chat -->
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <label style="position: relative; display: inline-block; width: 34px; height: 18px; background-color: #10b981; border-radius: 18px;">
                            <input type="checkbox" name="permissions[chat][enabled]" checked onchange="this.nextElementSibling.style.left = this.checked ? '18px' : '2px'; this.parentElement.style.backgroundColor = this.checked ? '#10b981' : '#ccc';"
                                style="opacity: 0; width: 0; height: 0;">
                            <span style="position: absolute; top: 2px; left: 18px; width: 14px; height: 14px; background-color: white; border-radius: 50%; transition: 0.2s;"></span>
                        </label>
                        <span style="font-weight: 600; font-size: 14px; color: #7a7a7a;">Chat</span>
                    </div>

                    <!-- Right: Write / Read / Delete -->
                    <div style="display: flex; align-items: center; gap: 16px;">

                        <!-- Write -->
                        <div style="display: flex; align-items: center; gap: 6px;">
                            <label style="position: relative; display: inline-block; width: 34px; height: 18px; background-color: #10b981; border-radius: 18px;">
                                <input type="checkbox" name="permissions[chat][write]" checked onchange="this.nextElementSibling.style.left = this.checked ? '18px' : '2px'; this.parentElement.style.backgroundColor = this.checked ? '#10b981' : '#ccc';"
                                    style="opacity: 0; width: 0; height: 0;">
                                <span style="position: absolute; top: 2px; left: 18px; width: 14px; height: 14px; background-color: white; border-radius: 50%; transition: 0.2s;"></span>
                            </label>
                            <span style="font-size: 14px; color: #7a7a7a;">Write</span>
                        </div>

                        <!-- Read -->
                        <div style="display: flex; align-items: center; gap: 6px;">
                            <label style="position: relative; display: inline-block; width: 34px; height: 18px; background-color: #ccc; border-radius: 18px;">
                                <input type="checkbox" name="permissions[chat][read]" onchange="this.nextElementSibling.style.left = this.checked ? '18px' : '2px'; this.parentElement.style.backgroundColor = this.checked ? '#10b981' : '#ccc';"
                                    style="opacity: 0; width: 0; height: 0;">
                                <span style="position: absolute; top: 2px; left: 2px; width: 14px; height: 14px; background-color: white; border-radius: 50%; transition: 0.2s;"></span>
                            </label>
                            <span style="font-size: 14px; color: #7a7a7a;">Read</span>
                        </div>

                        <!-- Delete -->
                        <div style="display: flex; align-items: center; gap: 6px;">
                            <label style="position: relative; display: inline-block; width: 34px; height: 18px; background-color: #10b981; border-radius: 18px;">
                                <input type="checkbox" name="permissions[chat][delete]" checked onchange="this.nextElementSibling.style.left = this.checked ? '18px' : '2px'; this.parentElement.style.backgroundColor = this.checked ? '#10b981' : '#ccc';"
                                    style="opacity: 0; width: 0; height: 0;">
                                <span style="position: absolute; top: 2px; left: 18px; width: 14px; height: 14px; background-color: white; border-radius: 50%; transition: 0.2s;"></span>
                            </label>
                            <span style="font-size: 14px; color: #7a7a7a;">Delete</span>
                        </div>

                    </div>
                </div>
                <!-- meeting -->
                <div class="mb-2" style="display: flex; justify-content: space-between;background:#fff;border-radius:10px;padding:10px; align-items: center; flex-wrap: wrap;">

                    <!-- Left: Meeting -->
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <label style="position: relative; display: inline-block; width: 34px; height: 18px; background-color: #10b981; border-radius: 18px;">
                            <input type="checkbox" name="permissions[meeting][enabled]" checked onchange="this.nextElementSibling.style.left = this.checked ? '18px' : '2px'; this.parentElement.style.backgroundColor = this.checked ? '#10b981' : '#ccc';"
                                style="opacity: 0; width: 0; height: 0;">
                            <span style="position: absolute; top: 2px; left: 18px; width: 14px; height: 14px; background-color: white; border-radius: 50%; transition: 0.2s;"></span>
                        </label>
                        <span style="font-weight: 600; font-size: 14px; color: #7a7a7a;">Meeting</span>
                    </div>

                    <!-- Right: Write / Read / Delete -->
                    <div style="display: flex; align-items: center; gap: 16px;">

                        <!-- Write -->
                        <div style="display: flex; align-items: center; gap: 6px;">
                            <label style="position: relative; display: inline-block; width: 34px; height: 18px; background-color: #10b981; border-radius: 18px;">
                                <input type="checkbox" name="permissions[meeting][write]" checked onchange="this.nextElementSibling.style.left = this.checked ? '18px' : '2px'; this.parentElement.style.backgroundColor = this.checked ? '#10b981' : '#ccc';"
                                    style="opacity: 0; width: 0; height: 0;">
                                <span style="position: absolute; top: 2px; left: 18px; width: 14px; height: 14px; background-color: white; border-radius: 50%; transition: 0.2s;"></span>
                            </label>
                            <span style="font-size: 14px; color: #7a7a7a;">Write</span>
                        </div>

                        <!-- Read -->
                        <div style="display: flex; align-items: center; gap: 6px;">
                            <label style="position: relative; display: inline-block; width: 34px; height: 18px; background-color: #ccc; border-radius: 18px;">
                                <input type="checkbox" name="permissions[meeting][read]" onchange="this.nextElementSibling.style.left = this.checked ? '18px' : '2px'; this.parentElement.style.backgroundColor = this.checked ? '#10b981' : '#ccc';"
                                    style="opacity: 0; width: 0; height: 0;">
                                <span style="position: absolute; top: 2px; left: 2px; width: 14px; height: 14px; background-color: white; border-radius: 50%; transition: 0.2s;"></span>
                            </label>
                            <span style="font-size: 14px; color: #7a7a7a;">Read</span>
                        </div>

                        <!-- Delete -->
                        <div style="display: flex; align-items: center; gap: 6px;">
                            <label style="position: relative; display: inline-block; width: 34px; height: 18px; background-color: #10b981; border-radius: 18px;">
                                <input type="checkbox" name="permissions[meeting][delete]" checked onchange="this.nextElementSibling.style.left = this.checked ? '18px' : '2px'; this.parentElement.style.backgroundColor = this.checked ? '#10b981' : '#ccc';"
                                    style="opacity: 0; width: 0; height: 0;">
                                <span style="position: absolute; top: 2px; left: 18px; width: 14px; height: 14px; background-color: white; border-radius: 50%; transition: 0.2s;"></span>
                            </label>
                            <span style="font-size: 14px; color: #7a7a7a;">Delete</span>
                        </div>

                    </div>
                </div>
                <!-- Todo -->
                <div class="mb-2" style="display: flex; justify-content: space-between;background:#fff;border-radius:10px;padding:10px; align-items: center; flex-wrap: wrap;">

                    <!-- Left: ToDO -->
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <label style="position: relative; display: inline-block; width: 34px; height: 18px; background-color: #10b981; border-radius: 18px;">
                            <input type="checkbox" name="permissions[todo][enabled]" checked onchange="this.nextElementSibling.style.left = this.checked ? '18px' : '2px'; this.parentElement.style.backgroundColor = this.checked ? '#10b981' : '#ccc';"
                                style="opacity: 0; width: 0; height: 0;">
                            <span style="position: absolute; top: 2px; left: 18px; width: 14px; height: 14px; background-color: white; border-radius: 50%; transition: 0.2s;"></span>
                        </label>
                        <span style="font-weight: 600; font-size: 14px; color: #7a7a7a;">ToDo</span>
                    </div>

                    <!-- Right: Write / Read / Delete -->
                    <div style="display: flex; align-items: center; gap: 16px;">

                        <!-- Write -->
                        <div style="display: flex; align-items: center; gap: 6px;">
                            <label style="position: relative; display: inline-block; width: 34px; height: 18px; background-color: #10b981; border-radius: 18px;">
                                <input type="checkbox" name="permissions[todo][write]" checked onchange="this.nextElementSibling.style.left = this.checked ? '18px' : '2px'; this.parentElement.style.backgroundColor = this.checked ? '#10b981' : '#ccc';"
                                    style="opacity: 0; width: 0; height: 0;">
                                <span style="position: absolute; top: 2px; left: 18px; width: 14px; height: 14px; background-color: white; border-radius: 50%; transition: 0.2s;"></span>
                            </label>
                            <span style="font-size: 14px; color: #7a7a7a;">Write</span>
                        </div>

                        <!-- Read -->
                        <div style="display: flex; align-items: center; gap: 6px;">
                            <label style="position: relative; display: inline-block; width: 34px; height: 18px; background-color: #ccc; border-radius: 18px;">
                                <input type="checkbox" name="permissions[todo][read]" onchange="this.nextElementSibling.style.left = this.checked ? '18px' : '2px'; this.parentElement.style.backgroundColor = this.checked ? '#10b981' : '#ccc';"
                                    style="opacity: 0; width: 0; height: 0;">
                                <span style="position: absolute; top: 2px; left: 2px; width: 14px; height: 14px; background-color: white; border-radius: 50%; transition: 0.2s;"></span>
                            </label>
                            <span style="font-size: 14px; color: #7a7a7a;">Read</span>
                        </div>

                        <!-- Delete -->
                        <div style="display: flex; align-items: center; gap: 6px;">
                            <label style="position: relative; display: inline-block; width: 34px; height: 18px; background-color: #10b981; border-radius: 18px;">
                                <input type="checkbox" name="permissions[todo][delete]" checked onchange="this.nextElementSibling.style.left = this.checked ? '18px' : '2px'; this.parentElement.style.backgroundColor = this.checked ? '#10b981' : '#ccc';"
                                    style="opacity: 0; width: 0; height: 0;">
                                <span style="position: absolute; top: 2px; left: 18px; width: 14px; height: 14px; background-color: white; border-radius: 50%; transition: 0.2s;"></span>
                            </label>
                            <span style="font-size: 14px; color: #7a7a7a;">Delete</span>
                        </div>

                    </div>
                </div>
                <!-- Project -->
                <div class="mb-2" style="display: flex; justify-content: space-between;background:#fff;border-radius:10px;padding:10px; align-items: center; flex-wrap: wrap;">

                    <!-- Left: Project -->
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <label style="position: relative; display: inline-block; width: 34px; height: 18px; background-color: #10b981; border-radius: 18px;">
                            <input type="checkbox" name="permissions[project][enabled]" checked onchange="this.nextElementSibling.style.left = this.checked ? '18px' : '2px'; this.parentElement.style.backgroundColor = this.checked ? '#10b981' : '#ccc';"
                                style="opacity: 0; width: 0; height: 0;">
                            <span style="position: absolute; top: 2px; left: 18px; width: 14px; height: 14px; background-color: white; border-radius: 50%; transition: 0.2s;"></span>
                        </label>
                        <span style="font-weight: 600; font-size: 14px; color: #7a7a7a;">Project</span>
                    </div>

                    <!-- Right: Write / Read / Delete -->
                    <div style="display: flex; align-items: center; gap: 16px;">

                        <!-- Write -->
                        <div style="display: flex; align-items: center; gap: 6px;">
                            <label style="position: relative; display: inline-block; width: 34px; height: 18px; background-color: #10b981; border-radius: 18px;">
                                <input type="checkbox" name="permissions[project][write]" checked onchange="this.nextElementSibling.style.left = this.checked ? '18px' : '2px'; this.parentElement.style.backgroundColor = this.checked ? '#10b981' : '#ccc';"
                                    style="opacity: 0; width: 0; height: 0;">
                                <span style="position: absolute; top: 2px; left: 18px; width: 14px; height: 14px; background-color: white; border-radius: 50%; transition: 0.2s;"></span>
                            </label>
                            <span style="font-size: 14px; color: #7a7a7a;">Write</span>
                        </div>

                        <!-- Read -->
                        <div style="display: flex; align-items: center; gap: 6px;">
                            <label style="position: relative; display: inline-block; width: 34px; height: 18px; background-color: #ccc; border-radius: 18px;">
                                <input type="checkbox" name="permissions[project][read]" onchange="this.nextElementSibling.style.left = this.checked ? '18px' : '2px'; this.parentElement.style.backgroundColor = this.checked ? '#10b981' : '#ccc';"
                                    style="opacity: 0; width: 0; height: 0;">
                                <span style="position: absolute; top: 2px; left: 2px; width: 14px; height: 14px; background-color: white; border-radius: 50%; transition: 0.2s;"></span>
                            </label>
                            <span style="font-size: 14px; color: #7a7a7a;">Read</span>
                        </div>

                        <!-- Delete -->
                        <div style="display: flex; align-items: center; gap: 6px;">
                            <label style="position: relative; display: inline-block; width: 34px; height: 18px; background-color: #10b981; border-radius: 18px;">
                                <input type="checkbox" name="permissions[project][delete]" checked onchange="this.nextElementSibling.style.left = this.checked ? '18px' : '2px'; this.parentElement.style.backgroundColor = this.checked ? '#10b981' : '#ccc';"
                                    style="opacity: 0; width: 0; height: 0;">
                                <span style="position: absolute; top: 2px; left: 18px; width: 14px; height: 14px; background-color: white; border-radius: 50%; transition: 0.2s;"></span>
                            </label>
                            <span style="font-size: 14px; color: #7a7a7a;">Delete</span>
                        </div>

                    </div>
                </div>
                <!-- Tickets -->
                <div class="mb-2" style="display: flex; justify-content: space-between;background:#fff;border-radius:10px;padding:10px; align-items: center; flex-wrap: wrap;">

                    <!-- Left: Tickets -->
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <label style="position: relative; display: inline-block; width: 34px; height: 18px; background-color: #10b981; border-radius: 18px;">
                            <input type="checkbox" name="permissions[tickets][enabled]" checked onchange="this.nextElementSibling.style.left = this.checked ? '18px' : '2px'; this.parentElement.style.backgroundColor = this.checked ? '#10b981' : '#ccc';"
                                style="opacity: 0; width: 0; height: 0;">
                            <span style="position: absolute; top: 2px; left: 18px; width: 14px; height: 14px; background-color: white; border-radius: 50%; transition: 0.2s;"></span>
                        </label>
                        <span style="font-weight: 600; font-size: 14px; color: #7a7a7a;">Tickets</span>
                    </div>

                    <!-- Right: Write / Read / Delete -->
                    <div style="display: flex; align-items: center; gap: 16px;">

                        <!-- Write -->
                        <div style="display: flex; align-items: center; gap: 6px;">
                            <label style="position: relative; display: inline-block; width: 34px; height: 18px; background-color: #10b981; border-radius: 18px;">
                                <input type="checkbox" name="permissions[tickets][write]" checked onchange="this.nextElementSibling.style.left = this.checked ? '18px' : '2px'; this.parentElement.style.backgroundColor = this.checked ? '#10b981' : '#ccc';"
                                    style="opacity: 0; width: 0; height: 0;">
                                <span style="position: absolute; top: 2px; left: 18px; width: 14px; height: 14px; background-color: white; border-radius: 50%; transition: 0.2s;"></span>
                            </label>
                            <span style="font-size: 14px; color: #7a7a7a;">Write</span>
                        </div>

                        <!-- Read -->
                        <div style="display: flex; align-items: center; gap: 6px;">
                            <label style="position: relative; display: inline-block; width: 34px; height: 18px; background-color: #ccc; border-radius: 18px;">
                                <input type="checkbox" name="permissions[tickets][read]" onchange="this.nextElementSibling.style.left = this.checked ? '18px' : '2px'; this.parentElement.style.backgroundColor = this.checked ? '#10b981' : '#ccc';"
                                    style="opacity: 0; width: 0; height: 0;">
                                <span style="position: absolute; top: 2px; left: 2px; width: 14px; height: 14px; background-color: white; border-radius: 50%; transition: 0.2s;"></span>
                            </label>
                            <span style="font-size: 14px; color: #7a7a7a;">Read</span>
                        </div>

                        <!-- Delete -->
                        <div style="display: flex; align-items: center; gap: 6px;">
                            <label style="position: relative; display: inline-block; width: 34px; height: 18px; background-color: #10b981; border-radius: 18px;">
                                <input type="checkbox" name="permissions[tickets][delete]" checked onchange="this.nextElementSibling.style.left = this.checked ? '18px' : '2px'; this.parentElement.style.backgroundColor = this.checked ? '#10b981' : '#ccc';"
                                    style="opacity: 0; width: 0; height: 0;">
                                <span style="position: absolute; top: 2px; left: 18px; width: 14px; height: 14px; background-color: white; border-radius: 50%; transition: 0.2s;"></span>
                            </label>
                            <span style="font-size: 14px; color: #7a7a7a;">Delete</span>
                        </div>

                    </div>
                </div>
                <!-- Task -->
                <div class="mb-2" style="display: flex; justify-content: space-between;background:#fff;border-radius:10px;padding:10px; align-items: center; flex-wrap: wrap;">

                    <!-- Left: Tasks -->
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <label style="position: relative; display: inline-block; width: 34px; height: 18px; background-color: #10b981; border-radius: 18px;">
                            <input type="checkbox" name="permissions[tasks][enabled]" checked onchange="this.nextElementSibling.style.left = this.checked ? '18px' : '2px'; this.parentElement.style.backgroundColor = this.checked ? '#10b981' : '#ccc';"
                                style="opacity: 0; width: 0; height: 0;">
                            <span style="position: absolute; top: 2px; left: 18px; width: 14px; height: 14px; background-color: white; border-radius: 50%; transition: 0.2s;"></span>
                        </label>
                        <span style="font-weight: 600; font-size: 14px; color: #7a7a7a;">Task</span>
                    </div>

                    <!-- Right: Write / Read / Delete -->
                    <div style="display: flex; align-items: center; gap: 16px;">

                        <!-- Write -->
                        <div style="display: flex; align-items: center; gap: 6px;">
                            <label style="position: relative; display: inline-block; width: 34px; height: 18px; background-color: #10b981; border-radius: 18px;">
                                <input type="checkbox" name="permissions[tasks][write]" checked onchange="this.nextElementSibling.style.left = this.checked ? '18px' : '2px'; this.parentElement.style.backgroundColor = this.checked ? '#10b981' : '#ccc';"
                                    style="opacity: 0; width: 0; height: 0;">
                                <span style="position: absolute; top: 2px; left: 18px; width: 14px; height: 14px; background-color: white; border-radius: 50%; transition: 0.2s;"></span>
                            </label>
                            <span style="font-size: 14px; color: #7a7a7a;">Write</span>
                        </div>

                        <!-- Read -->
                        <div style="display: flex; align-items: center; gap: 6px;">
                            <label style="position: relative; display: inline-block; width: 34px; height: 18px; background-color: #ccc; border-radius: 18px;">
                                <input type="checkbox" name="permissions[tasks][read]" onchange="this.nextElementSibling.style.left = this.checked ? '18px' : '2px'; this.parentElement.style.backgroundColor = this.checked ? '#10b981' : '#ccc';"
                                    style="opacity: 0; width: 0; height: 0;">
                                <span style="position: absolute; top: 2px; left: 2px; width: 14px; height: 14px; background-color: white; border-radius: 50%; transition: 0.2s;"></span>
                            </label>
                            <span style="font-size: 14px; color: #7a7a7a;">Read</span>
                        </div>

                        <!-- Delete -->
                        <div style="display: flex; align-items: center; gap: 6px;">
                            <label style="position: relative; display: inline-block; width: 34px; height: 18px; background-color: #10b981; border-radius: 18px;">
                                <input type="checkbox" name="permissions[tasks][delete]" checked onchange="this.nextElementSibling.style.left = this.checked ? '18px' : '2px'; this.parentElement.style.backgroundColor = this.checked ? '#10b981' : '#ccc';"
                                    style="opacity: 0; width: 0; height: 0;">
                                <span style="position: absolute; top: 2px; left: 18px; width: 14px; height: 14px; background-color: white; border-radius: 50%; transition: 0.2s;"></span>
                            </label>
                            <span style="font-size: 14px; color: #7a7a7a;">Delete</span>
                        </div>

                    </div>
                </div>
                <!-- Team -->
                <div class="mb-2" style="display: flex; justify-content: space-between;background:#fff;border-radius:10px;padding:10px; align-items: center; flex-wrap: wrap;">

                    <!-- Left: Team -->
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <label style="position: relative; display: inline-block; width: 34px; height: 18px; background-color: #10b981; border-radius: 18px;">
                            <input type="checkbox" name="permissions[team][enabled]" checked onchange="this.nextElementSibling.style.left = this.checked ? '18px' : '2px'; this.parentElement.style.backgroundColor = this.checked ? '#10b981' : '#ccc';"
                                style="opacity: 0; width: 0; height: 0;">
                            <span style="position: absolute; top: 2px; left: 18px; width: 14px; height: 14px; background-color: white; border-radius: 50%; transition: 0.2s;"></span>
                        </label>
                        <span style="font-weight: 600; font-size: 14px; color: #7a7a7a;">Team</span>
                    </div>

                    <!-- Right: Write / Read / Delete -->
                    <div style="display: flex; align-items: center; gap: 16px;">

                        <!-- Write -->
                        <div style="display: flex; align-items: center; gap: 6px;">
                            <label style="position: relative; display: inline-block; width: 34px; height: 18px; background-color: #10b981; border-radius: 18px;">
                                <input type="checkbox" name="permissions[team][write]" checked onchange="this.nextElementSibling.style.left = this.checked ? '18px' : '2px'; this.parentElement.style.backgroundColor = this.checked ? '#10b981' : '#ccc';"
                                    style="opacity: 0; width: 0; height: 0;">
                                <span style="position: absolute; top: 2px; left: 18px; width: 14px; height: 14px; background-color: white; border-radius: 50%; transition: 0.2s;"></span>
                            </label>
                            <span style="font-size: 14px; color: #7a7a7a;">Write</span>
                        </div>

                        <!-- Read -->
                        <div style="display: flex; align-items: center; gap: 6px;">
                            <label style="position: relative; display: inline-block; width: 34px; height: 18px; background-color: #ccc; border-radius: 18px;">
                                <input type="checkbox" name="permissions[team][read]" onchange="this.nextElementSibling.style.left = this.checked ? '18px' : '2px'; this.parentElement.style.backgroundColor = this.checked ? '#10b981' : '#ccc';"
                                    style="opacity: 0; width: 0; height: 0;">
                                <span style="position: absolute; top: 2px; left: 2px; width: 14px; height: 14px; background-color: white; border-radius: 50%; transition: 0.2s;"></span>
                            </label>
                            <span style="font-size: 14px; color: #7a7a7a;">Read</span>
                        </div>

                        <!-- Delete -->
                        <div style="display: flex; align-items: center; gap: 6px;">
                            <label style="position: relative; display: inline-block; width: 34px; height: 18px; background-color: #10b981; border-radius: 18px;">
                                <input type="checkbox" name="permissions[team][delete]" checked onchange="this.nextElementSibling.style.left = this.checked ? '18px' : '2px'; this.parentElement.style.backgroundColor = this.checked ? '#10b981' : '#ccc';"
                                    style="opacity: 0; width: 0; height: 0;">
                                <span style="position: absolute; top: 2px; left: 18px; width: 14px; height: 14px; background-color: white; border-radius: 50%; transition: 0.2s;"></span>
                            </label>
                            <span style="font-size: 14px; color: #7a7a7a;">Delete</span>
                        </div>

                    </div>
                </div>

                
            </div>
            </div>

            <div class="d-flex justify-content-center">
                <div class="d-flex px-3 py-2"
                    style="background-color: #f8f9fa; border-radius: 8px; gap: 12px;">

                    

                    
                    <button  id="saveBtn" type="submit" class="btn" disabled  style="background-color: #00C853; color: white; min-width: 160px;margin-bottom:3px;">
                        Save
                    </button>


                </div>
            </div>

            <!-- Modal Body -->
            <!-- <div class="modal-body"> -->

                <!-- Tabs -->
                <!-- <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link"
                            data-bs-toggle="tab"
                            href="#basicInfo">

                        </a>
                    </li>

                </ul> -->
            <!-- </div> -->
                </form>
        </div>
    </div>
</div>





<script>
    const toggleIcon = document.getElementById("toggleIcon");
    const chevron = document.getElementById("chevronIcon");
    if (toggleIcon && chevron) {
        toggleIcon.addEventListener("click", () => {
            setTimeout(() => {
                chevron.classList.toggle("ti-chevron-down");
                chevron.classList.toggle("ti-chevron-up");
            }, 150);
        });
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const body = document.body;
        body.addEventListener('click', function(){
            document.querySelectorAll('.menu-box').forEach(function(el){ el.style.display = 'none'; });
        });
        const darkBtn = document.getElementById('dark-mode-toggle');
        const lightBtn = document.getElementById('light-mode-toggle');

        if (darkBtn && lightBtn) {
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
        }
    });
</script>
<!-- JavaScript Function -->
<script>
    function showContent(tab) {
        // Show/hide content
        document.getElementById("overviewContent").style.display = tab === 'overview' ? 'block' : 'none';
        document.getElementById("statisticsContent").style.display = tab === 'statistics' ? 'block' : 'none';

        // Toggle button styles
        document.getElementById("btnOverview").className = tab === 'overview' ?
            'btn btn-success me-2' :
            'btn btn-light border me-2';

        document.getElementById("btnStatistics").className = tab === 'statistics' ?
            'btn btn-success' :
            'btn btn-light border';
    }
</script>
<!-- Show/Hide Password Script -->
<script>
    function togglePassword(id) {
        const input = document.getElementById(id);
        input.type = input.type === "password" ? "text" : "password";
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var parentToggles = document.querySelectorAll('input[type="checkbox"][name^="permissions["][name$="[enabled]"]');
        parentToggles.forEach(function(parentInput) {
            parentInput.addEventListener('change', function() {
                if (parentInput.checked) return;
                var match = parentInput.name.match(/^permissions\[(.+?)\]\[enabled\]$/);
                if (!match) return;
                var moduleKey = match[1];
                ['write', 'read', 'delete'].forEach(function(action) {
                    var childList = document.getElementsByName('permissions[' + moduleKey + '][' + action + ']');
                    if (childList && childList.length > 0) {
                        var childInput = childList[0];
                        if (childInput.checked) {
                            childInput.checked = false;
                            childInput.dispatchEvent(new Event('change', { bubbles: true }));
                        }
                    }
                });
            });
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var form = document.getElementById('userCreateForm');
        var saveBtn = document.getElementById('saveBtn');
        var emailInput = document.getElementById('emailInput');
        var confirmEmailInput = document.getElementById('confirmEmailInput');
        var editingUserIdInput = document.getElementById('editingUserId');
        var userFormMethod = document.getElementById('userFormMethod');
        var pw1 = document.getElementById('password1');
        var pw2 = document.getElementById('password2');
        var editEmailBtn = document.getElementById('editEmailBtn');
        var editPasswordBtn = document.getElementById('editPasswordBtn');
        var emailFieldsRow = document.getElementById('emailFieldsRow');
        var passwordFieldsRow = document.getElementById('passwordFieldsRow');
        var confirmEmailWrapper = document.getElementById('confirmEmailWrapper');
        var bannerInput = document.getElementById('bannerInput');
        var userImgInput = document.getElementById('userImgInput');
        var userImgPreview = document.getElementById('userImgPreview');
        var typeSelect = document.getElementById('typeSelect');
        var genderSelect = document.getElementById('genderSelect');
        var nameInput = document.getElementById('nameInput');
        var descriptionInput = document.getElementById('descriptionInput');
        var sectionBanner = document.getElementById('sectionBanner');
        var sectionUserInfo = document.getElementById('sectionUserInfo');
        var sectionEmail = document.getElementById('sectionEmail');
        var sectionPassword = document.getElementById('sectionPassword');
        var sectionPermissions = document.getElementById('sectionPermissions');
        var emailExists = false;
        if (!form || !saveBtn) return;

        function updateSaveButton() {
            var isEditing = editingUserIdInput && editingUserIdInput.value;
            var isValid = false;
            
            if (isEditing) {
                // During editing, always enable save button (no validation checks)
                isValid = true;
            } else {
                // During creation, check full form validity and email uniqueness
                isValid = form.checkValidity() && !emailExists;
            }
            
            saveBtn.disabled = !isValid;
            saveBtn.style.opacity = isValid ? '1' : '0.6';
            saveBtn.style.cursor = isValid ? 'pointer' : 'not-allowed';
        }

        function showEmailError(show, message) {
            if (!emailInput) return;
            
            // Don't show email errors during editing
            if (editingUserIdInput && editingUserIdInput.value) {
                emailInput.setCustomValidity('');
                emailInput.reportValidity();
                return;
            }
            
            emailInput.setCustomValidity(show ? (message || 'Email already exists') : '');
            emailInput.reportValidity();
        }

        var debounceTimer = null;
        function checkEmailUniqueness() {
            // Skip ALL email validation while editing existing users
            if (editingUserIdInput && editingUserIdInput.value) { 
                emailExists = false; 
                showEmailError(false); 
                updateSaveButton(); 
                return; 
            }
            
            if (!emailInput || !emailInput.value) { 
                emailExists = false; 
                showEmailError(false); 
                updateSaveButton(); 
                return; 
            }
            
            // If email matches original email during editing, allow it
            if (window.originalEmail && emailInput.value === window.originalEmail) { 
                emailExists = false; 
                showEmailError(false); 
                updateSaveButton(); 
                return; 
            }
            
            // Only check uniqueness for new emails or when not editing
            var url = '{{ route('users.checkEmail') }}' + '?email=' + encodeURIComponent(emailInput.value);
            if (editingUserIdInput && editingUserIdInput.value) {
                url += '&ignore_id=' + encodeURIComponent(editingUserIdInput.value);
            }
            
            fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                .then(function(r){ return r.json(); })
                .then(function(data){
                    emailExists = !!(data && data.exists);
                    showEmailError(emailExists, 'This email is already registered.');
                    updateSaveButton();
                    if (typeof updateUserFormSections === 'function') { updateUserFormSections(); }
                })
                .catch(function(){ 
                    emailExists = false; 
                    showEmailError(false); 
                    updateSaveButton();
                    if (typeof updateUserFormSections === 'function') { updateUserFormSections(); }
                });
        }

        if (emailInput) {
            emailInput.addEventListener('input', function(){
                clearTimeout(debounceTimer); debounceTimer = setTimeout(checkEmailUniqueness, 350);
            });
            emailInput.addEventListener('blur', checkEmailUniqueness);
        }
        if (confirmEmailInput) {
            confirmEmailInput.addEventListener('input', function(){
                // Skip confirm email validation during editing
                if (editingUserIdInput && editingUserIdInput.value) {
                    confirmEmailInput.setCustomValidity('');
                    return;
                }
                
                if (emailInput && confirmEmailInput.value && emailInput.value !== confirmEmailInput.value) {
                    confirmEmailInput.setCustomValidity('Emails do not match');
                } else {
                    confirmEmailInput.setCustomValidity('');
                }
            });
        }

        function syncPasswordRequirements() {
            var isEdit = userFormMethod && (userFormMethod.value || '').toUpperCase() === 'PUT';
            if (isEdit) {
                var anyValue = (pw1 && pw1.value) || (pw2 && pw2.value);
                if (pw1) pw1.required = !!anyValue;
                if (pw2) pw2.required = !!anyValue;
            } else {
                if (pw1) pw1.required = true;
                if (pw2) pw2.required = true;
            }
            if (pw1 && pw2) {
                if (pw1.value && pw2.value && pw1.value !== pw2.value) {
                    pw2.setCustomValidity('Passwords do not match');
                } else {
                    pw2.setCustomValidity('');
                }
            }
            updateSaveButton();
        }

        if (pw1) pw1.addEventListener('input', syncPasswordRequirements);
        if (pw2) pw2.addEventListener('input', syncPasswordRequirements);

        form.addEventListener('input', updateSaveButton, true);
        form.addEventListener('change', updateSaveButton, true);
        // Clear any lingering email validity on submit during edit
        form.addEventListener('submit', function(){
            if (editingUserIdInput && editingUserIdInput.value) {
                if (emailInput) emailInput.setCustomValidity('');
                if (confirmEmailInput) confirmEmailInput.setCustomValidity('');
            }
        }, true);

        // Expose helpers for global access (used by openEditUser/openCreateUser)
        window.updateSaveButton = updateSaveButton;
        window.showEmailError = showEmailError;
        window.checkEmailUniqueness = checkEmailUniqueness;

        // Progressive section visibility during CREATE
        function validateSectionBanner() {
            // In create mode, banner is required
            var isEditing = editingUserIdInput && editingUserIdInput.value;
            if (isEditing) return true;
            if (!bannerInput) return false;
            return bannerInput.files && bannerInput.files.length > 0;
        }

        function validateSectionUserInfo() {
            var isEditing = editingUserIdInput && editingUserIdInput.value;
            var hasType = !!(typeSelect && typeSelect.value);
            var hasGender = !!(genderSelect && genderSelect.value);
            var hasName = !!(nameInput && nameInput.value && nameInput.value.trim().length > 0);
            var hasDesc = !!(descriptionInput && descriptionInput.value && descriptionInput.value.trim().length > 0);
            var hasUserImage = false;
            if (userImgInput && userImgInput.files && userImgInput.files.length > 0) {
                hasUserImage = true;
            } else if (userImgPreview && userImgPreview.style && userImgPreview.style.display === 'block') {
                hasUserImage = true;
            }
            // In edit mode we do not block by image
            if (isEditing) {
                return hasType && hasGender && hasName && hasDesc;
            }
            return hasType && hasGender && hasName && hasDesc && hasUserImage;
        }

        function validateSectionEmail() {
            if (!emailInput || !confirmEmailInput) return false;
            // Skip uniqueness check here; rely on emailExists flag
            var emailsEntered = emailInput.value && confirmEmailInput.value;
            var emailsMatch = emailInput.value === confirmEmailInput.value;
            return emailsEntered && emailsMatch && !emailExists;
        }

        function validateSectionPassword() {
            // In edit mode, password may be optional; treat as valid to show permissions
            var isEditing = editingUserIdInput && editingUserIdInput.value;
            if (isEditing) return true;
            if (!pw1 || !pw2) return false;
            var bothEntered = pw1.value && pw2.value;
            var match = pw1.value === pw2.value;
            return bothEntered && match;
        }

        function setSectionVisible(el, visible) {
            if (!el) return;
            el.style.display = visible ? '' : 'none';
        }

        function updateSectionVisibility() {
            var isEditing = editingUserIdInput && editingUserIdInput.value;
            if (isEditing) {
                setSectionVisible(sectionBanner, true);
                setSectionVisible(sectionUserInfo, true);
                setSectionVisible(sectionEmail, true);
                setSectionVisible(sectionPassword, true);
                setSectionVisible(sectionPermissions, true);
                return;
            }
            // Always show banner section first
            setSectionVisible(sectionBanner, true);
            var bannerOk = validateSectionBanner();
            setSectionVisible(sectionUserInfo, bannerOk);
            var userOk = bannerOk && validateSectionUserInfo();
            setSectionVisible(sectionEmail, userOk);
            var emailOk = userOk && validateSectionEmail();
            setSectionVisible(sectionPassword, emailOk);
            var passwordOk = emailOk && validateSectionPassword();
            setSectionVisible(sectionPermissions, passwordOk);
        }

        // Expose globally for create/edit helpers
        window.updateUserFormSections = updateSectionVisibility;

        // Wire listeners to progressively reveal
        [bannerInput, userImgInput, typeSelect, genderSelect, nameInput, descriptionInput,
         emailInput, confirmEmailInput, pw1, pw2]
        .forEach(function(el){ if (el) { el.addEventListener('input', updateSectionVisibility); el.addEventListener('change', updateSectionVisibility); } });

        // Initialize section visibility on load
        updateSectionVisibility();

        // Ensure sections update when modal is shown
        var addUserModalEl = document.getElementById('add_user');
        if (addUserModalEl) {
            addUserModalEl.addEventListener('shown.bs.modal', function(){
                if (typeof updateUserFormSections === 'function') { updateUserFormSections(); }
            });
        }

        function applyEditViewToggles() {
            var isEditing = editingUserIdInput && editingUserIdInput.value;
            if (editEmailBtn) editEmailBtn.style.display = isEditing ? 'inline' : 'none';
            if (editPasswordBtn) editPasswordBtn.style.display = isEditing ? 'inline' : 'none';

            if (isEditing) {
                // Hide confirm email by default until user clicks Edit
                if (confirmEmailWrapper) confirmEmailWrapper.style.display = 'none';
                if (confirmEmailInput) confirmEmailInput.required = false;
                if (pw1) pw1.placeholder = 'Leave blank to keep current password';
                if (pw2) pw2.placeholder = 'Leave blank to keep current password';
            } else {
                if (confirmEmailWrapper) confirmEmailWrapper.style.display = '';
                if (confirmEmailInput) confirmEmailInput.required = true;
                if (pw1) pw1.placeholder = 'Type User Password (leave blank to keep)';
                if (pw2) pw2.placeholder = 'Repeat User Password (leave blank to keep)';
            }
        }

        if (editEmailBtn) {
            editEmailBtn.addEventListener('click', function(){
                if (confirmEmailWrapper) {
                    var currentlyHidden = confirmEmailWrapper.style.display === 'none';
                    confirmEmailWrapper.style.display = currentlyHidden ? '' : 'none';
                    if (confirmEmailInput) confirmEmailInput.required = currentlyHidden;
                }
            });
        }

        if (editPasswordBtn) {
            editPasswordBtn.addEventListener('click', function(){
                if (pw1) pw1.focus();
            });
        }

        applyEditViewToggles();
        syncPasswordRequirements();
        updateSaveButton();
    });
    </script>
<script>
    function resetUserFormForCreate() {
        document.getElementById('userModalTitle').innerText = 'Add new Member';
        document.getElementById('userModalSubtitle').innerText = 'Add new User to Team';
        document.getElementById('userCreateForm').action = '{{ route('user.store') }}';
        document.getElementById('userFormMethod').value = 'POST';
        document.getElementById('userFormMethod').value = 'POST';
        document.getElementById('editingUserId').value = '';
        window.originalEmail = null;

        document.getElementById('nameInput').value = '';
        document.getElementById('emailInput').value = '';
        document.getElementById('confirmEmailInput').value = '';
        document.getElementById('confirmEmailInput').required = true;
        document.getElementById('password1').required = true;
        document.getElementById('password2').required = true;
        document.getElementById('password1').value = '';
        document.getElementById('password2').value = '';
        document.getElementById('genderSelect').value = '';
        document.getElementById('typeSelect').value = '';
        var desc = document.getElementById('descriptionInput'); if (desc) desc.value = '';

        var userImgPreview = document.getElementById('userImgPreview');
        var userImgPlaceholder = document.getElementById('userImgPlaceholder');
        var userImgInput = document.getElementById('userImgInput');
        userImgPreview.style.display = 'none';
        userImgPreview.src = '';
        userImgPlaceholder.style.display = 'block';
        if (userImgInput) userImgInput.required = true;

        var bannerPreview = document.getElementById('bannerPreview');
        var bannerPlaceholder = document.getElementById('bannerPlaceholder');
        var bannerInput = document.getElementById('bannerInput');
        bannerPreview.style.display = 'none';
        bannerPreview.src = '';
        bannerPlaceholder.style.display = 'block';
        if (bannerInput) bannerInput.required = true;

        // Refresh form validity/UI state
        document.getElementById('userCreateForm').dispatchEvent(new Event('input', { bubbles: true }));
        if (typeof updateUserFormSections === 'function') { updateUserFormSections(); }
    }

    function openCreateUser() {
        resetUserFormForCreate();
    }

    function openEditUser(user) {

        document.getElementById('userModalTitle').innerText = 'Edit Member';
        document.getElementById('userModalSubtitle').innerText = 'Update user details';
        document.getElementById('userCreateForm').action = '{{ route('user.update', '__ID__') }}'.replace('__ID__', user.id);
        document.getElementById('userFormMethod').value = 'PUT';
        document.getElementById('editingUserId').value = user.id;

        // Immediately enable save button for editing
        if (typeof emailExists !== 'undefined') {
            emailExists = false;
        }
        if (typeof updateSaveButton === 'function') {
            updateSaveButton();
        }
        
        // Clear any existing email validation errors
        if (typeof showEmailError === 'function') {
            showEmailError(false);
        }

        document.getElementById('nameInput').value = user.name || '';
        document.getElementById('emailInput').value = user.email || '';
        document.getElementById('confirmEmailInput').value = user.email || '';
        window.originalEmail = user.email || '';
        var desc = document.getElementById('descriptionInput'); if (desc) desc.value = user.user_description || '';
        var title = document.getElementById('titleInput'); if (title) title.value = user.title || '';
        document.getElementById('password1').required = false;
        document.getElementById('password2').required = false;
        document.getElementById('confirmEmailInput').required = false;
        document.getElementById('password1').value = '';
        document.getElementById('password2').value = '';

        if (user.gender) document.getElementById('genderSelect').value = user.gender;
        if (user.type) document.getElementById('typeSelect').value = user.type;

        var userImgPreview = document.getElementById('userImgPreview');
        var userImgPlaceholder = document.getElementById('userImgPlaceholder');
        var userImgInput = document.getElementById('userImgInput');
        if (userImgInput) userImgInput.required = false;
        if (user.image_url) {
            userImgPreview.src = user.image_url;
            userImgPreview.style.display = 'block';
            userImgPlaceholder.style.display = 'none';
        } else {
            userImgPreview.style.display = 'none';
            userImgPreview.src = '';
            userImgPlaceholder.style.display = 'block';
        }

        var bannerPreview = document.getElementById('bannerPreview');
        var bannerPlaceholder = document.getElementById('bannerPlaceholder');
        var bannerInput = document.getElementById('bannerInput');
        
        if (bannerInput) bannerInput.required = false;
        if (user.banner_url) {
            bannerPreview.src = user.banner_url;
            bannerPreview.style.display = 'block';
            bannerPlaceholder.style.display = 'none';
        } else {
            bannerPreview.style.display = 'none';
            bannerPreview.src = '';
            bannerPlaceholder.style.display = 'block';
        }

        // Refresh form validity/UI state
        document.getElementById('userCreateForm').dispatchEvent(new Event('input', { bubbles: true }));
        
        // Validate email state for editing
        if (typeof checkEmailUniqueness === 'function') {
            checkEmailUniqueness();
        }

        // Apply edit view toggles if available
        if (typeof applyEditViewToggles === 'function') {
            applyEditViewToggles();
        }

        // Show all sections in edit mode
        if (typeof updateUserFormSections === 'function') { updateUserFormSections(); }
    }


    window.createAddPdfFile = function() {
    // Create file input
    var input = document.createElement('input');
    input.type = 'file';
    input.accept = 'application/pdf, image/png, image/jpeg, image/jpg';
    input.name = 'attachment'; // or 'attachments[]' if multiple
    input.style.display = 'none';

    // When file selected
    input.addEventListener('change', function() {
        if (input.files.length === 0) return;

        // Append to form
        var form = document.getElementById('uploaddoc');
        form.appendChild(input);

        // Submit form
        form.submit();
    });

    // Trigger file picker
    input.click();
};


</script>
@endsection