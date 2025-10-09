<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel"
    style="width: 65vw; max-width: 100%; overflow-x: hidden;">

    <!-- Offcanvas Header -->
    <div class="offcanvas-header p-0 position-relative" style="height: 180px;">
        <!-- Background image -->
        <img src="{{URL::asset('/build/img/bgblack.svg')}}" alt="Header Image"
            style="width: 100%; height: 100%; object-fit: cover;">

        <!-- Profile Image (top-right, overlapping) -->
        <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile"
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
    <div id="overviewContent" class="toggle-content" style="display: block;">
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
                                <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile" style="width: 100px; height: 100px; border-radius: 50%; border: 4px solid white; object-fit: cover; box-shadow: 0 0 8px rgba(0,0,0,0.2);">
                                <h5 class="mt-2 mb-1">{{$user->name}}</h5>
                                <span class="badge  text-danger" style="font-size: 12px;background:white;border-radius:10px;">{{$user->type }}</span>
                                <span class="badge  text-danger" style="font-size: 12px;background:white;border-radius:10px;">{{$user->description}}</span>
                            </div>
                            <!-- Info Rows -->
                            <div class="card mb-2 p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div> <img src="{{URL::asset('/build/img/User11.svg')}}" alt="" style="width: 20px;"> Gender</div>
                                    <div class="fw-bold">{{$user->gender}}</div>
                                </div>
                            </div>

                            <div class="card mb-2 p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><img src="{{URL::asset('/build/img/user_od.svg')}}" alt="" style="width: 20px;"> User ID</div>
                                    <div class="fw-bold">{{$user->user_id}}</div>
                                </div>
                            </div>

                            <div class="card mb-2 p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><img src="{{URL::asset('/build/img/Globus.svg')}}" alt="" style="width: 20px;"> Country</div>
                                    <div class="fw-bold">{{$user->country}}</div>
                                </div>
                            </div>

                            <div class="card mb-2 p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><img src="{{URL::asset('/build/img/teamicon.svg')}}" alt="" style="width: 20px;"> Team</div>
                                    <div class="fw-bold">Ticket ID</div>
                                </div>
                            </div>

                            <div class="card mb-2 p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><img src="{{URL::asset('/build/img/timeicon.svg')}}" alt="" style="width: 20px;"> Join Date</div>
                                    <div class="fw-bold">{{$user->created_at->format('d:m:Y') }}</div>
                                </div>
                            </div>

                            <div class="card mb-2 p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><img src="{{URL::asset('/build/img/calling.svg')}}" alt="" style="width: 20px;"> Phone</div>
                                    <div class="fw-bold">{{$user->phone}}</div>
                                </div>
                            </div>

                            <div class="card mb-2 p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div> <img src="{{URL::asset('/build/img/Letter.svg')}}" alt="" style="width: 20px;"> E-Mail</div>
                                    <div class="fw-bold">{{$user->email}}</div>
                                </div>
                            </div>

                            <div class="card mb-2 p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div> <img src="{{URL::asset('/build/img/msg.svg')}}" alt="" style="width: 20px;"> Message</div>
                                    <div class="fw-bold text-primary">@LogiTeam</div>
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
                                        <div class="d-flex align-items-center">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/8/87/PDF_file_icon.svg"
                                                alt="PDF Icon"
                                                style="width: 35px; height: 40px; object-fit: contain; margin-right: 10px;">
                                            <div>
                                                <div style="font-weight: 500; font-size: 14px; color: #2e3a59;">ID Card Font ...</div>
                                                <div style="font-size: 12px; color: #8c94a3;">94 KB - Date</div>
                                            </div>
                                        </div>
                                        <!-- Trigger Button -->
                                        <div style="position: relative; display: inline-block;">
                                            <div
                                                style="width: 28px; height: 28px; border: 1px solid #a6aec1; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; background:#fff;"
                                                onclick="let menu=this.nextElementSibling; menu.style.display = (menu.style.display==='block')?'none':'block'; event.stopPropagation();">
                                                <i class="bi bi-three-dots" style="font-size: 16px; color: #2e3a59;"></i>
                                            </div>

                                            <!-- Popup Menu -->
                                            <div
                                                class="menu-box"
                                                style="display: none; position: absolute; top: 35px; right: 0; background: #fff; width:100px; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); padding: 10px; text-align: center; z-index:1000;"
                                                onclick="event.stopPropagation();">

                                                <!-- Title -->
                                                <div style="font-size: 13px; color: #7a7a9d; font-weight: 600; margin-bottom: 8px;">Options</div>

                                                <!-- Icons -->
                                                <div style="display:flex; justify-content: space-between; align-items:center;">
                                                    <img src="{{URL::asset('/build/img/delete1.svg')}}" alt="Delete" style="width: 22px; cursor: pointer;">
                                                    <img src="{{URL::asset('/build/img/download.svg')}}" alt="Edit" style="width: 22px; cursor: pointer;" >
                                                   
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Close on outside click -->
                                        <script>
                                            document.addEventListener("click", function() {
                                                document.querySelectorAll(".menu-box").forEach(el => el.style.display = "none");
                                            });
                                        </script>

                                    </div>
                                </div>

                                <div class="col-12 mb-3">
                                    <div class="d-flex justify-content-between align-items-center p-2 rounded"
                                        style="background-color: white; box-shadow: 0 0 6px rgba(0,0,0,0.05);">
                                        <div class="d-flex align-items-center">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/8/87/PDF_file_icon.svg"
                                                alt="PDF Icon"
                                                style="width: 35px; height: 40px; object-fit: contain; margin-right: 10px;">
                                            <div>
                                                <div style="font-weight: 500; font-size: 14px; color: #2e3a59;">ID Card Font ...</div>
                                                <div style="font-size: 12px; color: #8c94a3;">94 KB - Date</div>
                                            </div>
                                        </div>
                                        <!-- Trigger Button -->
                                        <div style="position: relative; display: inline-block;">
                                            <div
                                                style="width: 28px; height: 28px; border: 1px solid #a6aec1; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; background:#fff;"
                                                onclick="let menu=this.nextElementSibling; menu.style.display = (menu.style.display==='block')?'none':'block'; event.stopPropagation();">
                                                <i class="bi bi-three-dots" style="font-size: 16px; color: #2e3a59;"></i>
                                            </div>

                                            <!-- Popup Menu -->
                                            <div
                                                class="menu-box"
                                                style="display: none; position: absolute; top: 35px; right: 0; background: #fff; width:100px; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); padding: 10px; text-align: center; z-index:1000;"
                                                onclick="event.stopPropagation();">

                                                <!-- Title -->
                                                <div style="font-size: 13px; color: #7a7a9d; font-weight: 600; margin-bottom: 8px;">Options</div>

                                                <!-- Icons -->
                                                <div style="display:flex; justify-content: space-between; align-items:center;">
                                                    <img src="{{URL::asset('/build/img/delete1.svg')}}" alt="Delete" style="width: 22px; cursor: pointer;">
                                                    <img src="{{URL::asset('/build/img/download.svg')}}" alt="Edit" style="width: 22px; cursor: pointer;" >
                                                   
                                                </div>
                                            </div>
                                        </div>

                                    </div>
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

            <!-- Right Panel: col-9 -->
            <div class="col-md-8 col-sm-12">

                <!-- Our projects -->
                <div style="background-color: #f4f6f8;  border-radius: 12px;padding-left:3px;padding-right:3px;padding-bottom: 0px;" class="mb-2">
                    <div>
                        <h3 class="pb-1 ps-2" style="font-weight: 600;">Our Projects</h3>
                    </div>
                    <div class="row g-1">

                        <div class=" col-12 col-md-6">
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
                            </div>
                        </div>
                        <!-- card 2 -->
                        <div class=" col-12 col-md-6">
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
                            </div>
                        </div>
                    </div>


                </div>
                <!-- Total projects -->
                <div style="background-color: #f7f7f7; padding: 16px; border-radius: 12px; font-family: 'Segoe UI', sans-serif;">
                    <div class="d-flex flex-wrap justify-content-between align-items-start mb-3">

                        <!-- Left Icon -->
                        <img src="{{ asset('build/img/lato.svg') }}" alt="Icon" style="width: 50px; height: auto; margin-bottom:3px;">

                        <!-- Project Summary -->
                        <div style="background-color: white;border-radius:6px;padding:5px;">
                            <div style="font-size: 15px; font-weight: 600; color: #2e3a59;">Project Title</div>
                            <div class="d-flex gap-1 mt-1 flex-nowrap">
                                <!-- Project Tag 1 -->
                                <div class="d-flex flex-wrap align-items-center gap-2" style="background: #f7f7f7; padding: 6px 10px; border-radius: 8px; font-size: 13px;">
                                    <!-- Logo -->
                                    <img src="{{ URL::asset('/build/img/yekbon.svg') }}" alt="Logo" style="width: 24px; height: 24px;">

                                    <!-- Project Title and Badges -->
                                    <div class="d-flex  flex-wrap flex-column" style="line-height: 1.2;">
                                        <strong style="color: #1a2343; font-size: 13px;">Project Title</strong>
                                        <div class="d-flex flex-wrap gap-2 mt-1">
                                            <span style="color: #1a2343;">Tickets
                                                <span style="background: #ff4d4f; color: #fff; border-radius: 50%; padding: 2px 6px; font-size: 10px;">4</span>
                                            </span>
                                            <span style="color: #1a2343;">Tasks
                                                <span style="background: #ff4d4f; color: #fff; border-radius: 50%; padding: 2px 6px; font-size: 10px;">4</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Project Tag 2 -->
                                <div class="d-flex  flex-wrap align-items-center gap-2" style="background: #f7f7f7; padding: 6px 10px; border-radius: 8px; font-size: 13px;">
                                    <!-- Logo -->
                                    <img src="{{ URL::asset('/build/img/yekbon.svg') }}" alt="Logo" style="width: 24px; height: 24px;">

                                    <!-- Project Title and Badges -->
                                    <div class="d-flex flex-wrap flex-column" style="line-height: 1.2;">
                                        <strong style="color: #1a2343; font-size: 13px;">Project Title</strong>
                                        <div class="d-flex flex-wrap  gap-2 mt-1">
                                            <span style="color: #1a2343;">Tickets
                                                <span style="background: #ff4d4f; color: #fff; border-radius: 50%; padding: 2px 6px; font-size: 10px;">4</span>
                                            </span>
                                            <span style="color: #1a2343;">Tasks
                                                <span style="background: #ff4d4f; color: #fff; border-radius: 50%; padding: 2px 6px; font-size: 10px;">4</span>
                                            </span>
                                        </div>
                                    </div>
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
                            <div style="font-weight: 600; font-size: 13px;">2</div>
                        </div>

                        <div style="flex: 1; min-width: 80px;  border-right: 3px solid #e2e8f0; padding: 0 8px;">
                            <img src="{{ asset('build/img/totaltask.svg') }}" style="width: 26px;" alt="">
                            <div style="font-size: 12px; color: #4b5c74; margin-top: 4px;">Total Tasks</div>
                            <div style="font-weight: 600; font-size: 13px;">2</div>
                        </div>

                        <div style="flex: 1; min-width: 80px; border-right: 3px solid #e2e8f0; padding: 0 8px;">
                            <img src="{{ asset('build/img/progress.svg') }}" style="width: 26px;" alt="">
                            <div style="font-size: 12px; color: #4b5c74; margin-top: 4px;">Progress</div>
                            <div style="font-weight: 600; font-size: 13px;">2</div>
                        </div>

                        <div style="flex: 1; min-width: 80px; border-right: 3px solid #e2e8f0; padding: 0 8px;">
                            <img src="{{ asset('build/img/inhold.svg') }}" style="width: 26px;" alt="">
                            <div style="font-size: 12px; color: #4b5c74; margin-top: 4px;">In Hold</div>
                            <div style="font-weight: 600; font-size: 13px;">2</div>
                        </div>

                        <div style="flex: 1; min-width: 80px; border-right: 3px solid #e2e8f0; padding: 0 8px;">
                            <img src="{{ asset('build/img/incheck.svg') }}" style="width: 26px;" alt="">
                            <div style="font-size: 12px; color: #4b5c74; margin-top: 4px;">In Check</div>
                            <div style="font-weight: 600; font-size: 13px;">2</div>
                        </div>

                        <div style="flex: 1; min-width: 80px; border-right: 3px solid #e2e8f0; padding: 0 8px;">
                            <img src="{{ asset('build/img/delayed.svg') }}" style="width: 26px;" alt="">
                            <div style="font-size: 12px; color: #4b5c74; margin-top: 4px;">Delayed</div>
                            <div style="font-weight: 600; font-size: 13px;">2</div>
                        </div>

                        <!-- Last item: No border-right -->
                        <div style="flex: 1; min-width: 80px; padding: 0 8px;">
                            <img src="{{ asset('build/img/rejected.svg') }}" style="width: 26px;" alt="">
                            <div style="font-size: 12px; color: #4b5c74; margin-top: 4px;">Rejected</div>
                            <div style="font-weight: 600; font-size: 13px;">2</div>
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
                            <div style="font-size: 13px; color: #4b5563;">15 Member</div>
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
                            <div style="font-size: 13px; color: #4b5563;">15 Member</div>
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
                            <div style="font-size: 13px; color: #4b5563;">15 Member</div>
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
<div id="statisticsContent" class="toggle-content" style="display: none;">
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
                                <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile" style="width: 100px; height: 100px; border-radius: 50%; border: 4px solid white; object-fit: cover; box-shadow: 0 0 8px rgba(0,0,0,0.2);">
                                <h5 class="mt-2 mb-1">{{$user->name}}</h5>
                                <span class="badge  text-danger" style="font-size: 12px;background:white;border-radius:10px;">{{$user->type }}</span>
                                <span class="badge  text-danger" style="font-size: 12px;background:white;border-radius:10px;">{{$user->description}}</span>
                            </div>
                            <!-- Info Rows -->
                            <div class="card mb-2 p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div> <img src="{{URL::asset('/build/img/User11.svg')}}" alt="user" style="width: 20px;"> Gender</div>
                                    <div class="fw-bold">{{$user->gender}}</div>
                                </div>
                            </div>

                            <div class="card mb-2 p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><img src="{{URL::asset('/build/img/user_od.svg')}}" alt="" style="width: 20px;"> User ID</div>
                                    <div class="fw-bold">{{$user->user_id}}</div>
                                </div>
                            </div>

                            <div class="card mb-2 p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><img src="{{URL::asset('/build/img/Globus.svg')}}" alt="" style="width: 20px;"> Country</div>
                                    <div class="fw-bold">{{$user->country}}</div>
                                </div>
                            </div>

                            <div class="card mb-2 p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><img src="{{URL::asset('/build/img/teamicon.svg')}}" alt="" style="width: 20px;"> Team</div>
                                    <div class="fw-bold">Ticket ID</div>
                                </div>
                            </div>

                            <div class="card mb-2 p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><img src="{{URL::asset('/build/img/timeicon.svg')}}" alt="" style="width: 20px;"> Join Date</div>
                                    <div class="fw-bold">{{$user->created_at->format('d:m:Y') }}</div>
                                </div>
                            </div>

                            <div class="card mb-2 p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><img src="{{URL::asset('/build/img/calling.svg')}}" alt="" style="width: 20px;"> Phone</div>
                                    <div class="fw-bold">{{$user->phone}}</div>
                                </div>
                            </div>

                            <div class="card mb-2 p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div> <img src="{{URL::asset('/build/img/Letter.svg')}}" alt="" style="width: 20px;"> E-Mail</div>
                                    <div class="fw-bold">{{$user->email}}</div>
                                </div>
                            </div>

                            <div class="card mb-2 p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div> <img src="{{URL::asset('/build/img/msg.svg')}}" alt="" style="width: 20px;"> Message</div>
                                    <div class="fw-bold text-primary">@LogiTeam</div>
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
                                        <div class="d-flex align-items-center">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/8/87/PDF_file_icon.svg"
                                                alt="PDF Icon"
                                                style="width: 35px; height: 40px; object-fit: contain; margin-right: 10px;">
                                            <div>
                                                <div style="font-weight: 500; font-size: 14px; color: #2e3a59;">ID Card Font ...</div>
                                                <div style="font-size: 12px; color: #8c94a3;">94 KB - Date</div>
                                            </div>
                                        </div>
                                         <!-- Trigger Button -->
                                        <div style="position: relative; display: inline-block;">
                                            <div
                                                style="width: 28px; height: 28px; border: 1px solid #a6aec1; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; background:#fff;"
                                                onclick="let menu=this.nextElementSibling; menu.style.display = (menu.style.display==='block')?'none':'block'; event.stopPropagation();">
                                                <i class="bi bi-three-dots" style="font-size: 16px; color: #2e3a59;"></i>
                                            </div>

                                            <!-- Popup Menu -->
                                            <div
                                                class="menu-box"
                                                style="display: none; position: absolute; top: 35px; right: 0; background: #fff; width:100px; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); padding: 10px; text-align: center; z-index:1000;"
                                                onclick="event.stopPropagation();">

                                                <!-- Title -->
                                                <div style="font-size: 13px; color: #7a7a9d; font-weight: 600; margin-bottom: 8px;">Options</div>

                                                <!-- Icons -->
                                                <div style="display:flex; justify-content: space-between; align-items:center;">
                                                    <img src="{{URL::asset('/build/img/delete1.svg')}}" alt="Delete" style="width: 22px; cursor: pointer;">
                                                    <img src="{{URL::asset('/build/img/download.svg')}}" alt="Edit" style="width: 22px; cursor: pointer;" >
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mb-3">
                                    <div class="d-flex justify-content-between align-items-center p-2 rounded"
                                        style="background-color: white; box-shadow: 0 0 6px rgba(0,0,0,0.05);">
                                        <div class="d-flex align-items-center">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/8/87/PDF_file_icon.svg"
                                                alt="PDF Icon"
                                                style="width: 35px; height: 40px; object-fit: contain; margin-right: 10px;">
                                            <div>
                                                <div style="font-weight: 500; font-size: 14px; color: #2e3a59;">ID Card Font ...</div>
                                                <div style="font-size: 12px; color: #8c94a3;">94 KB - Date</div>
                                            </div>
                                        </div>
                                         <!-- Trigger Button -->
                                        <div style="position: relative; display: inline-block;">
                                            <div
                                                style="width: 28px; height: 28px; border: 1px solid #a6aec1; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; background:#fff;"
                                                onclick="let menu=this.nextElementSibling; menu.style.display = (menu.style.display==='block')?'none':'block'; event.stopPropagation();">
                                                <i class="bi bi-three-dots" style="font-size: 16px; color: #2e3a59;"></i>
                                            </div>

                                            <!-- Popup Menu -->
                                            <div
                                                class="menu-box"
                                                style="display: none; position: absolute; top: 35px; right: 0; background: #fff; width:100px; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); padding: 10px; text-align: center; z-index:1000;"
                                                onclick="event.stopPropagation();">

                                                <!-- Title -->
                                                <div style="font-size: 13px; color: #7a7a9d; font-weight: 600; margin-bottom: 8px;">Options</div>

                                                <!-- Icons -->
                                                <div style="display:flex; justify-content: space-between; align-items:center;">
                                                    <img src="{{URL::asset('/build/img/delete1.svg')}}" alt="Delete" style="width: 22px; cursor: pointer;">
                                                    <img src="{{URL::asset('/build/img/download.svg')}}" alt="Edit" style="width: 22px; cursor: pointer;" >
                                                   
                                                </div>
                                            </div>
                                        </div>

                                    </div>
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


            <!-- Right Panel: col-9 -->
            <div class="col-md-8 col-sm-12">

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

        </div>
    </div>
    <!-- Statistics Content -->

</div>
</div>